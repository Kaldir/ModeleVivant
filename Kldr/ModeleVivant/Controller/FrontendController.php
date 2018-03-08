<?php
namespace Kldr\ModeleVivant\Controller;

class FrontendController extends MainController
{
// RESEARCH
    public function research() {
        if (!isset($_GET['keywords'])) {
            $this->redirect();
            exit;
        }
        if (isset($_GET['keywords']) && empty(trim($_GET['keywords']))) {
            $this->addError('Le champ n\'est pas rempli !');
            $this->redirect();
            exit;
        }
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        $keywords = trim($_GET['keywords']); // supprimer les espace en début et fin de chaîne
        $keywords = preg_replace('!\s+!', '|', $keywords); // enlève les espaces et les remplace par |
        $posts = $postManager->researchPost($_GET['keywords']);
        $ads = $adManager->researchAd($_GET['keywords']);
        if (empty($posts) && empty($ads))  {
            $this->addError('Aucun résultat ne correspond à votre recherche !');
        }
        $variables = compact('posts', 'ads');
        $this->view('frontend/research', $variables);
    }

// ACCOUNT 
    public function createAccount() {
            $this->view('frontend/createAccount');
        }

    public function createAccountProcessing() {
        if (!$_SESSION['connected'] || !isset($_POST['submit'])) {
            $this->redirect();
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('createAccount');
            exit;
        }
        if (!isset($_POST['pseudo'])
            || empty(trim($_POST['pseudo']))
            || !isset($_POST['mail'])
            || empty(trim($_POST['mail']))
            || !isset($_POST['password'])
            || empty(trim($_POST['password']))
            || !isset($_POST['checkPassword'])
            || empty(trim($_POST['checkPassword']))) {
            $this->addError('Tous les champs ne sont pas remplis !');
            $this->redirect('createAccount');
            exit;
        }
        if ($_POST['password'] != $_POST['checkPassword']) {
            $this->addError('Les mots de passe ne sont pas identiques !');
        }
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $this->addError('L\'adresse mail n\'est pas valide !');
        }
        // CAPTCHA (API GOOGLE reCAPTCHA) - sert à créer une requête POST avec file_get_contents
        $captchaData = http_build_query (array('secret' => '6LdeQEsUAAAAAOKXhznaJoDa01VfTzBvExiYbKwU', 'response' => $_POST['g-recaptcha-response'])); // clef secréte attribuée au captcha de mon site
        $options = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $captchaData));
        $context  = stream_context_create($options);
        $captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context); // retourne un objet JSON qui contient les données fournies par l'API
        $captcha = json_decode($captcha); // transorme l'objet JSON en tableau
        if ($captcha->success == false) {
            $this->addError('Captcha non valide, réessayer !');
        }
        // END CAPTCHA
        if ($this->hasErrors()) {
            $this->redirect('createAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($userManager->checkUserByMail($_POST['mail']) == true) {
                $this->addError('Cet email est déjà utilisé !');
        }
        if ($userManager->checkUserByPseudo($_POST['pseudo']) == true) {
            $this->addError('Ce pseudo est déjà pris !');
        }
        if ($this->hasErrors()) {
            $this->redirect('createAccount');
            exit;
        }
        $result = $userManager->createAccount($_POST['pseudo'], $_POST['mail'], $_POST['password']);
        if ($result == false) {
            $this->addError('Le compte n\'a pas pu être créé...');
            $this->redirect('createAccount');
            exit;
        }
        $this->addSuccess('Votre compte a bien été créé, '. $_POST['pseudo'] .' !');
        $this->redirect();
    }

    public function generatePassword() {
        if (!isset($_POST['submit'])) {
            $this->redirect('forgotPassword');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('forgotPassword');
            exit;
        }
        if (!isset($_POST['mail']) || empty(trim($_POST['mail']))) {
            $this->addError('Il manque des informations dans les champs !');
        } elseif ($userManager->checkUserByMail($_POST['mail']) == false) {
            $this->addError('Aucun compte ne correspond à cet email...');
        }
        if ($this->hasErrors()) {
            $this->redirect('forgotPassword');
            exit;
        }
        $newPassword = bin2hex(openssl_random_pseudo_bytes(4)); // génère un pass de 8 caractères
        $result = $userManager->updatePassword($newPassword, $_POST['mail']);
        if ($result == false) { // rapport au rowCount, on vérifie si une ligne a été modifiée (voir userManager.php méthode updatePassword)
            $this->addError('Le mot de passe n\'a pas été mis à jour...');
            $this->redirect('forgotPassword');
            exit;
        }
        $to = $_POST['mail'];
        $subject = 'Réinitialisation mot de passe - Modèles vivants';
        $message = "Bonjour, votre mot de passe vient d'être réinitialisé. Connectez vous avec vos informations habituelles et rentrez " . $newPassword . " comme mot de passe. Vous pourrez le modifier par la suite dans vos paramètres de compte.";
        $headers = 'From: lulu@kldr.fr';
        $mailSent = mail($to, $subject, $message, $headers);
        if ($mailSent == false) {
            $this->addError('Le mail n\'a pu être envoyé...');
            $this->redirect('forgotPassword');
            exit;
        }
        $this->addSuccess('Un email contenant un mot de passe temporaire vient de vous être envoyé !');
        $this->redirect('forgotPassword');
    }

    public function updatePassword() {
        if (!$_SESSION['connected'] || !isset($_POST['submit'])) {
            $this->redirect('modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('modifyAccount');
            exit;
        }
        if (!isset($_POST['password'])
            || empty(trim($_POST['password']))
            || !isset($_POST['newPassword'])
            || empty(trim($_POST['newPassword']))
            || !isset($_POST['checkPassword'])
            || empty(trim($_POST['checkPassword']))) {
            $this->addError('Il manque des informations dans les champs !');
        } elseif ($_POST['newPassword'] != $_POST['checkPassword']) {
            $this->addError('Les mots de passe ne sont pas identiques !');
        } elseif ($userManager->login($_POST['password'], $_SESSION['mail']) == false) {
            $this->addError('Mauvais mot de passe !');
        }
        if($this->hasErrors()) {
            $this->redirect('modifyAccount');
            exit;
        }
        $result = $userManager->updatePassword($_POST['newPassword'], $_SESSION['mail']);
        if ($result == false) {
            $this->addError('Impossible de modifier le mot de passe, réessayer plus tard...');
            $this->redirect('modifyAccount');
            exit;
        } 
        $this->addSuccess('Mot de passe mis à jour avec succès !');
        $this->redirect('modifyAccount');
    }

    public function updatePseudo() {
        if (!$_SESSION['connected'] || !isset($_POST['submit'])) {
            $this->redirect('modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('modifyAccount');
            exit;
        }
        if (!isset($_POST['newPseudo'])
            || empty(trim($_POST['newPseudo']))
            || !isset($_POST['password'])
            || empty(trim($_POST['password']))) {
            $this->addError('Il manque des informations dans les champs !');
        } elseif ($userManager->checkUserByPseudo($_POST['newPseudo']) == true) {
            $this->addError('Ce pseudo est déjà pris !');
        } elseif ($userManager->login($_POST['password'], $_SESSION['mail']) == false) {
            $this->addError('Mauvais mot de passe !');
        }
        if($this->hasErrors()) {
            $this->redirect('modifyAccount');
            exit;
        }
        $result = $userManager->updatePseudo($_POST['newPseudo'], $_SESSION['mail']);
        if ($result == false) {
            $this->addError('Impossible de modifier le pseudo, réessayer plus tard...');
            $this->redirect('modifyAccount');
            exit;
        }
        $this->addSuccess('Pseudo modifié avec succès !');
        $_SESSION['pseudo'] = $_POST['newPseudo'];
        $this->redirect('modifyAccount');
    }

    public function updateMail() {
        if (!$_SESSION['connected'] || !isset($_POST['submit'])) {
            $this->redirect('modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('modifyAccount');
            exit;
        }
        if ( !isset($_POST['newMail'])
            || empty(trim($_POST['newMail']))
            || !isset($_POST['checkMail'])
            || empty(trim($_POST['checkMail']))
            || !isset($_POST['password'])
            || empty(trim($_POST['password']))) {
            $this->addError('Il manque des informations dans les champs !');
        } elseif (!filter_var($_POST['newMail'], FILTER_VALIDATE_EMAIL)) {
            $this->addError('L\'adresse mail n\'est pas valide !');
        } elseif ($userManager->checkUserByMail($_POST['newMail']) == true) {
            $this->addError('Ce mail est déjà pris !)');
        } elseif ($userManager->login($_POST['password'], $_SESSION['mail']) == false) {
            $this->addError('Mauvais mot de passe !');
        }
        if($this->hasErrors()) {
            $this->redirect('modifyAccount');
            exit;
        }
        $result = $userManager->updateMail($_POST['newMail'], $_SESSION['mail']);
        if ($result == false) {
            $this->addError('Impossible de modifier le mail, réessayer plus tard...');
            $this->redirect('modifyAccount');
            exit;
        }
        $this->addSuccess('Mail modifié avec succès !');
        $_SESSION['mail'] = $_POST['newMail'];
        $this->redirect('modifyAccount');
    }

    public function updateAvatar() {
        if (!$_SESSION['connected'] || !isset($_POST['submit'])) {
            $this->redirect('modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        $size = filesize($_FILES['newAvatar']['tmp_name']);
        $maxSize = 200000;
        $extension = strtolower(strrchr($_FILES['newAvatar']['name'], '.')); // récupère l'extension du fichier uploadé et la met en minuscule
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $file = uniqid(). $extension; // génère un nom aléatoire pour le fichier
        if ($_FILES['newAvatar']['error']) {
            $this->addError('Erreur lors du chargement de l\'image...'); 
        } if (!in_array($extension, $extensions)) { // Si l'extension n'est pas dans le tableau
            $this->addError('Votre avatar doit être de type png, gif, jpg ou jpeg.');
        } if ($size > $maxSize || ($_FILES['newAvatar']['error']) == 2) { // la superglobale $_FILES a déjà une base d'erreurs répertoriées sous diffrents numéros. Le numéro 2 correspond à un fichier torp volumineux
            $this->addError('Le fichier est trop volumineux...200Ko max !');
        }
        if ($this->hasErrors()) {
            $this->redirect('modifyAccount');
            exit;
        }
        $result = move_uploaded_file($_FILES['newAvatar']['tmp_name'], AVATAR_PATH . $file);
        if ($result == false) { // déplace le fichier uploadé (nom temporaire, destination du fichier (chemin + nom du fichier))
            $this->addError('Echec de l\'upload !');
            $this->redirect('modifyAccount');
            exit;
        }
        $result = $userManager->updateAvatar($file, $_SESSION['mail']);
            if ($result == false) {
                $this->addError('Impossible de modifier l\'avatar, réessayer plus tard...');
            } else {
                $this->addSuccess('Avatar modifié avec succès !');
                if (file_exists(AVATAR_PATH . $_SESSION['avatar']) && $_SESSION['avatar'] != 'default.png') { // vérifie que le fichier et son chemin existent et qu'il ne s'agit pas de l'avatar par défaut, afin de ne pas le supprimer du serveur...
                    unlink(AVATAR_PATH . $_SESSION['avatar']); // supprime l'avatar précédent de l'utilisateur  
                }
                $_SESSION['avatar'] = $file; 
            }
            $this->redirect('modifyAccount');
        }
    
	public function login() {
        if (!empty($_SESSION['connected'])) {
            $this->redirect();
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if (!isset($_POST['mail'])
            || empty(trim($_POST['mail']))
            || !isset($_POST['password'])
            || empty(trim($_POST['password']))) {
            $this->addError('Il manque des informations dans les champs !');
            $this->redirect();
            exit;
        }
		$login = $userManager->login($_POST['password'], $_POST['mail']);
        if ($login == false) {
            $this->addError('Impossible de se connecter...');
            $this->redirect();
            exit;
        }
        $_SESSION['connected'] = true;
        $_SESSION['pseudo'] = $userManager->pseudo;
        $_SESSION['mail'] = $userManager->mail;
        $_SESSION['avatar'] = $userManager->avatar;
        $_SESSION['admin'] = $userManager->admin;
        $_SESSION['id_user'] = $userManager->id;
        $this->addSuccess('Bienvenue, '. $_SESSION['pseudo']. '!');
        $this->redirect();
    }

// ADVERTISEMENTS
    public function advertisements() {
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getAdsCategories();
        $ads = array();
        if (empty($_GET['id_category'])) {
            $variables = compact('categories', 'ads');
            $this->view('frontend/advertisements', $variables);
            exit;
        }
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        $ads = $adManager->getAdvertisementsByCategory($_GET['id_category']);
        if (empty($ads)) {
            $this->addError('Aucune annonce dans cette catégorie.');
            $variables = compact('categories', 'ads');
        } else {
            $variables = compact('ads', 'categories');
        }
        $this->view('frontend/advertisements', $variables);
    }


    public function addAdvertisement() {
        if (!$_SESSION['connected'] || !isset($_POST['submit'])) {
            $this->redirect('advertisements');
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('advertisements');
            exit;
        }
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getAdsCategories();
        if (
            !isset($_POST['id_category'])
            || empty(trim($_POST['id_category']))
            || !isset($_POST['title'])
            || empty(trim($_POST['title']))
            || !isset($_POST['town'])
            || empty(trim($_POST['town']))
            || !isset($_POST['county'])
            || empty(trim($_POST['county']))
            || !isset($_POST['location'])
            || !isset($_POST['date_event'])
            || !isset($_POST['content'])
            || empty(trim($_POST['content']))) {
            $this->addError('Tous les champs requis ne sont pas remplis !');
        }
        elseif (empty($categoryManager->getAdCategory($_POST['id_category']))) {
            $this->addError('Cette catégorie n\'existe pas...');
        }
        if ($this->hasErrors()) {
            $this->redirect('advertisements');
            exit;
        }
        $result = $adManager->addAdvertisement(
            $_SESSION['id_user'],
            $_POST['id_category'],
            $_POST['title'],
            $_POST['town'],
            $_POST['county'],
            $_POST['location'],
            $_POST['date_event'],
            $_POST['content']);
        if ($result == false) {
            $this->addError('Impossible de créer l\'annonce');
            $this->redirect('advertisements');
            exit;
        }
        $this->addSuccess('Merci ! Votre annonce doit désormais être validée par l\'administrateur avant d\'être publiée !');
        $variables = compact('success', 'categories', 'ads');
        $to = 'lulu@kldr.fr';
        $subject = 'Modèles vivants - Annonce en attente de validation';
        $message = "Bonjour,\r\n
        Quelqu'un vient de créer une nouvelle annonce. Celle-ci est donc en attente de validation dans votre section administrateur.\r\n
        Titre de l'annonce : ". $_POST['title'] ."\r\n
        Contenu : ".$_POST['content'] ."\r\n.
        Merci et bonne journée !";
        $headers = 'From: <lulu@kldr.fr>';
        mail($to, $subject, $message, $headers);
       $this->redirect('advertisements');
    }

// POSTS
    public function posts() {
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        if (empty($_GET['id_category'])) {
            $variables = compact('categories');
            $this->view('frontend/allPosts', $variables);
            exit;
        }
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $posts = $postManager->getPostsByCategory($_GET['id_category']);
        if (empty($posts)) {
            $this->addError('Aucune publication dans cette catégorie.');
        }
        $variables = compact('posts', 'categories');
        $this->view('frontend/allPosts', $variables);
    }

    public function displayOnePost() {
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $post = $postManager->getPost($_GET['id_post']);
        $imgs = array('random01.jpg', 'random02.jpg', 'random03.jpg', 'random04.jpg', 'random05.jpg', 'random06.jpg', 'random07.jpg', 'random08.jpg', 'random09.jpg', 'random10.jpg' );
        $img_id = mt_rand(0,(count($imgs)-1));
        $img = $imgs[$img_id];
        if (empty($post)) {
            $this->addError('Aucune publication dans cette catégorie.');
        }
        $variables = compact('post', 'img');
        $this->view('frontend/onePost', $variables);
    }

// SEND MAIL CONTACT
    public function sendMailContact() {
        if (!isset($_POST['submit'])) {
            $this->redirect('contact');
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('contact');
            exit;
        }
        if (
            !isset($_POST['pseudo'])
            || empty(trim($_POST['pseudo']))
            || !isset($_POST['mail'])
            || empty(trim($_POST['mail']))
            || !isset($_POST['radioContact'])
            || empty(trim($_POST['radioContact']))
            || !isset($_POST['subject'])
            || empty(trim($_POST['subject']))
            || !isset($_POST['content'])
            || empty(trim($_POST['content']))) {
            $this->addError('Tous les champs requis ne sont pas remplis !');
        }
         if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $this->addError('L\'adresse mail n\'est pas valide !');
            $this->redirect('contact');
            exit;
        }
        $to = 'lulu@kldr.fr';
        $subject = 'Modèles vivants - Quelqu\'un vous a écrit !';
        $message = "Sujet : ". $_POST['subject'] ."\r\n
        Bonjour, je suis ". $_POST['pseudo'] .", je suis ". $_POST['radioContact'] ."\r\n
        Message :".$_POST['content'] ."\r\n.
        Merci et bonne journée !";
        $headers = 'From: <'. $_POST['mail'] .'>';
        $mailSent = mail($to, $subject, $message, $headers);
        if ($mailSent == false) {
            $this->addError('Le mail n\'a pu être envoyé...');
            $this->redirect('contact');
            exit;
        }
        $this->addSuccess('Votre mail a bien été envoyé !');
        $this->redirect('contact');
    }

    public function modifyAccount() {
        if (!$_SESSION['connected']) {
            $this->redirect();
            exit;
        } 
        $this->view('frontend/modifyAccount');
    }

    public function forgotPassword() {
        $this->view('frontend/forgotPassword');
    }

    public function contact() {
        $this->view('frontend/contact');
    }

    public function marketplace() {
        $this->view('frontend/marketplace');
    }

    public function friends() {
        $this->view('frontend/friends');
    }

    public function logout() {
        session_destroy();
        $this->redirect();
    }
}