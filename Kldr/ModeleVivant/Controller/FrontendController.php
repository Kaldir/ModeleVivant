<?php
namespace Kldr\ModeleVivant\Controller;

class FrontendController extends MainController
{
// RESEARCH
    public function research() {
            $posts = array();
            $ads = array();
            if (empty(trim($_POST['keywords']))) {
                $errors[] = 'Le champ n\'est pas rempli !';
                $variables = compact('errors', 'posts', 'ads');
                $this->view('frontend/research', $variables);
                exit;
            }
            $postManager = new \Kldr\ModeleVivant\Model\PostManager();
            $adManager = new \Kldr\ModeleVivant\Model\AdManager();
            $keywords = trim($_POST['keywords']); // supprimer les espace en début et fin de chaîne
            $keywords = preg_replace('!\s+!', '|', $keywords); // enlève les espaces et les remplace par |
            $posts = $postManager->researchPost($_POST['keywords']);
            $ads = $adManager->researchAd($_POST['keywords']);
            if (empty($posts) && empty($ads))  {
                $errors[] = 'Aucun résultat ne correspond à votre recherche !';
                $variables = compact('errors', 'posts', 'ads'); ; // on compact $errors afin de pouvoir la réutiliser dans la view grâce à extract
            } else {
                $variables = compact('posts', 'ads');
            }
            $this->view('frontend/research', $variables);
        }

// ACCOUNT 
    public function createAccount() {
        if (!isset($_POST['submit'])) { // si le formulaire n'est pas envoyé
            $this->view('frontend/createAccount');
            exit;
        }
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
            $variables = compact('errors');
            $this->view('frontend/createAccount', $variables);
            exit;
        }
        if (empty(trim($_POST['pseudo']))
            || empty(trim($_POST['mail']))
            || empty(trim($_POST['password']))
            || empty(trim($_POST['checkPassword']))) {
            $errors[] = 'Tous les champs ne sont pas remplis !';
        }
        if ($_POST['password'] != $_POST['checkPassword']) {
            $errors[] = 'Les mots de passe ne sont pas identiques !';
        }
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'adresse mail n\'est pas valide !';
        }
        // CAPTCHA (API GOOGLE reCAPTCHA) - sert à créer une requête POST avec file_get_contents
        $captchaData = http_build_query (array('secret' => '6LdeQEsUAAAAAOKXhznaJoDa01VfTzBvExiYbKwU', 'response' => $_POST['g-recaptcha-response'])); // clef secréte attribuée au captcha de mon site
        $options = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $captchaData));
        $context  = stream_context_create($options);
        $captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context); // retourne un objet JSON qui contient les données fournies par l'API
        $captcha = json_decode($captcha); // transorme l'objet JSON en tableau
        if ($captcha->success == false) {
            $errors[] = "Captcha non valide, réessayer";
        }
        // END CAPTCHA
        if (!empty($errors)) {
            $variables = compact('errors');
            $this->view('frontend/createAccount', $variables);
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($userManager->checkUserByMail($_POST['mail']) == true) {
                $errors[] = 'Cet email est déjà utilisé !';
        }
        if ($userManager->checkUserByPseudo($_POST['pseudo']) == true) {
            $errors[] = 'Ce pseudo est déjà pris !';
        }
        if (!empty($errors)) {
            $variables = compact('errors');
            $this->view('frontend/createAccount', $variables);
            exit;
        }
        $result = $userManager->createAccount($_POST['pseudo'], $_POST['mail'], $_POST['password']);
        if ($result == false) {
            $errors[] = 'Le compte n\'a pas pu être créé...';
            $variables = compact('errors');
            $this->view('frontend/createAccount', $variables);
            exit;
        }
        $this->home();
    }

    public function generatePassword() {
        if (!isset($_POST['submit'])) {
            $this->view('frontend/forgotPassword');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
            $variables = compact('errors');
            $this->view('frontend/advertisements', $variables);
            exit;
        }
        if (empty(trim($_POST['mail']))) {
            $errors[] = 'Il manque des informations dans les champs !';
        } elseif ($userManager->checkUserByMail($_POST['mail']) == false) {
                $errors[] = 'Aucun compte ne correspond à cet email...';
        }
        if (!empty($errors)) {
            $variables = compact('errors');
            $this->view('frontend/forgotPassword', $variables);
            exit;
        }
        $newPassword = bin2hex(openssl_random_pseudo_bytes(4)); // génère un pass de 8 caractères
        $result = $userManager->updatePassword($newPassword, $_POST['mail']);
        if ($result == false) { // rapport au rowCount, on vérifie si une ligne a été modifiée (voir userManager.php méthode updatePassword)
            $errors[] = 'Le mot de passe n\'a pas été mis à jour...';
            $variables = compact('errors');
            $this->view('frontend/forgotPassword', $variables);
            exit;
        }
        $to = $_POST['mail'];
        $subject = 'Réinitialisation mot de passe - Modèles vivants';
        $message = "Bonjour, votre mot de passe vient d'être réinitialisé. Connectez vous avec vos informations habituelles et rentrez " . $newPassword . " comme mot de passe. Vous pourrez le modifier par la suite dans vos paramètres de compte.";
        $headers = 'From: lulu@kldr.fr';
        $mailSent = mail($to, $subject, $message, $headers);
        if ($mailSent == false) {
            $errors[] = 'Le mail n\'a pu être envoyé...';
            $variables = compact('errors');
        } else {
            $success = 'Un email contenant un mot de passe temporaire vient de vous être envoyé !';
            $variables = compact('success');
        }
        $this->view('frontend/forgotPassword', $variables);
    }



    public function updatePassword() {
        if (!isset($_POST['submit']) || !$_SESSION['connected']) {
            $this->view('frontend/modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
        } elseif (empty(trim($_POST['password']))
            || empty(trim($_POST['newPassword']))
            || empty(trim($_POST['checkPassword']))) {
            $errors[] = 'Il manque des informations dans les champs !';
        } elseif ($_POST['newPassword'] != $_POST['checkPassword']) {
            $errors[] = 'Les mots de passe ne sont pas identiques !';
        } elseif ($userManager->login($_POST['password'], $_SESSION['mail']) == false) {
            $errors[] = 'Mauvais mot de passe !';
        }
        if(!empty($errors)) {
            $variables = compact('errors');
            $this->view('frontend/modifyAccount', $variables);
            exit;
        }
        $result = $userManager->updatePassword($_POST['newPassword'], $_SESSION['mail']);
        if ($result == false) {
            $errors[] = 'Impossible de modifier le mot de passe, réessayer plus tard...';
            $variables = compact('errors');
        } else {
            $success = 'Mot de passe mis à jour avec succès !';
            $variables = compact('success');
        }
        $this->view('frontend/modifyAccount', $variables);
    }

    public function updatePseudo() {
        if (!isset($_POST['submit']) || !$_SESSION['connected']) {
            $this->view('frontend/modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
        } elseif (empty(trim($_POST['newPseudo']))
            || empty(trim($_POST['password']))) {
            $errors[] = 'Il manque des informations dans les champs !';
        } elseif ($userManager->checkUserByPseudo($_POST['newPseudo']) == true) {
            $errors[] = 'Ce pseudo est déjà pris !';
        } elseif ($userManager->login($_POST['password'], $_SESSION['mail']) == false) {
            $errors[] = 'Mauvais mot de passe !';
        }
        if(!empty($errors)) {
            $variables = compact('errors');
            $this->view('frontend/modifyAccount', $variables);
            exit;
        }
        $result = $userManager->updatePseudo($_POST['newPseudo'], $_SESSION['mail']);
        if ($result == false) {
            $errors[] = 'Impossible de modifier le pseudo, réessayer plus tard...';
            $variables = compact('errors');
        } else {
            $success = 'Pseudo modifié avec succès !';
            $variables = compact('success');
            $_SESSION['pseudo'] = $_POST['newPseudo'];
        }
        $this->view('frontend/modifyAccount', $variables);
    }

    public function updateMail() {
        if (!isset($_POST['submit']) || !$_SESSION['connected']) {
            $this->view('frontend/modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
        } elseif (empty(trim($_POST['newMail']))
            || empty(trim($_POST['checkMail']))
            || empty(trim($_POST['password']))) {
            $errors[] = 'Il manque des informations dans les champs !';
        } elseif (!filter_var($_POST['newMail'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'adresse mail n\'est pas valide !';
        } elseif ($userManager->checkUserByMail($_POST['newMail']) == true) {
            $errors[] = 'Ce mail est déjà pris !';
        } elseif ($userManager->login($_POST['password'], $_SESSION['mail']) == false) {
            $errors[] = 'Mauvais mot de passe !';
        }
        if(!empty($errors)) {
            $variables = compact('errors');
            $this->view('frontend/modifyAccount', $variables);
            exit;
        }
        $result = $userManager->updateMail($_POST['newMail'], $_SESSION['mail']);
        if ($result == false) {
            $errors[] = 'Impossible de modifier le mail, réessayer plus tard...';
            $variables = compact('errors');
        } else {
            $success = 'Mail modifié avec succès !';
            $variables = compact('success');
            $_SESSION['mail'] = $_POST['newMail'];
        }
        $this->view('frontend/modifyAccount', $variables);
    }

    public function updateAvatar() {
        if (!isset($_POST['submit']) || !$_SESSION['connected']) {
            $this->view('frontend/modifyAccount');
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        $size = filesize($_FILES['newAvatar']['tmp_name']);
        $maxSize = 200000;
        $extension = strtolower(strrchr($_FILES['newAvatar']['name'], '.')); // récupère l'extension du fichier uploadé et la met en minuscule
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $file = uniqid(). $extension; // génère un nom aléatoire pour le fichier
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
        } elseif ($_FILES['newAvatar']['error']) {
            $errors[] = 'Erreur lors du chargement de l\'image...'; 
        } if (!in_array($extension, $extensions)) { // Si l'extension n'est pas dans le tableau
            $errors[] = 'Votre avatar doit être de type png, gif, jpg ou jpeg.';
        } if ($size > $maxSize || ($_FILES['newAvatar']['error']) == 2) { // la superglobale $_FILES a déjà une base d'erreurs répertoriées sous diffrents numéros. Le numéro 2 correspond à un fichier torp volumineux
            $errors[] = 'Le fichier est trop volumineux...200Ko max !';
        }
        if (!empty($errors)) {
            $variables = compact('errors');
            $this->view('frontend/modifyAccount', $variables);
            exit;
        }
        $result = move_uploaded_file($_FILES['newAvatar']['tmp_name'], AVATAR_PATH . $file);
        if ($result == false) { // déplace le fichier uploadé (nom temporaire, destination du fichier (chemin + nom du fichier))
            $errors[] = 'Echec de l\'upload !';
            $variables = compact('errors');
            $this->view('frontend/modifyAccount', $variables);
            exit;
        }
        $result = $userManager->updateAvatar($file, $_SESSION['mail']);
            if ($result == false) {
                $errors[] = 'Impossible de modifier l\'avatar, réessayer plus tard...';
                $variables = compact('errors');
            } else {
                $success = 'Avatar modifié avec succès !';
                $variables = compact('success');
                if (file_exists(AVATAR_PATH . $_SESSION['avatar']) && $_SESSION['avatar'] != 'default.png') { // vérifie que le fichier et son chemin existent et qu'il ne s'agit pas de l'avatar par défaut, afin de ne pas le supprimer du serveur...
                    unlink(AVATAR_PATH . $_SESSION['avatar']); // supprime l'avatar précédent de l'utilisateur  
                }
                $_SESSION['avatar'] = $file; 
            }
            $this->view('frontend/modifyAccount', $variables);
        }

    
	public function login() {
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if (empty(trim($_POST['mail'])) || empty(trim($_POST['password']))) {
            $errors[] = 'Il manque des informations dans les champs !';
            $variables = compact('errors');
            $this->view('frontend/error', $variables);
            exit;
        }
		$login = $userManager->login($_POST['password'], $_POST['mail']);
        if ($login == false) {
            $errors[] = 'Impossible de se connecter...';
            $variables = compact('errors');
            $this->view('frontend/error', $variables);
            exit;
        }
        $_SESSION['connected'] = true;
        $_SESSION['pseudo'] = $userManager->pseudo;
        $_SESSION['mail'] = $userManager->mail;
        $_SESSION['avatar'] = $userManager->avatar;
        $_SESSION['admin'] = $userManager->admin;
        $_SESSION['id_user'] = $userManager->id;
        header('Location: ./?action=modifyAccount');
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
            $errors[] = 'Aucune annonce dans cette catégorie.';
            $variables = compact('errors', 'categories', 'ads');
        } else {
            $variables = compact('ads', 'categories');
        }
        $this->view('frontend/advertisements', $variables);
    }


    public function addAdvertisement() {
        if (!isset($_POST['submit']) || !$_SESSION['connected']) {
            header('Location: ./?action=advertisements');
        }
        $ads = array();
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getAdsCategories();
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
        } elseif (
            empty(trim($_POST['id_category']))
            || empty(trim($_POST['title']))
            || empty(trim($_POST['town']))
            || empty(trim($_POST['county']))
            || !isset($_POST['location'])
            || !isset($_POST['date_event'])
            || empty(trim($_POST['content']))) {
            $errors[] = 'Tous les champs requis ne sont pas remplis !';
        }
        elseif (empty($categoryManager->getAdCategory($_POST['id_category']))) {
            $errors[] = 'Cette catégorie n\'existe pas...';
        }
        if (!empty($errors)) {
            $variables = compact('errors', 'categories', 'ads');
            $this->view('frontend/advertisements', $variables);
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
            $errors[] = 'Impossible de créer l\'annonce';
            $variables = compact('errors', 'categories', 'ads');
            $this->view('frontend/advertisements', $variables);
        } else {
            $success = 'Merci ! Votre annonce doit désormais être validée par l\'administrateur avant d\'être publiée !';
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
        }
        $this->view('frontend/advertisements', $variables);
    }

// POSTS
    public function posts() {
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        $posts = array();
        if (empty($_GET['id_category'])) {
            $variables = compact('categories', 'posts');
            $this->view('frontend/allPosts', $variables);
            exit;
        }
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $posts = $postManager->getPostsByCategory($_GET['id_category']);
        if (empty($posts)) {
            $errors[] = 'Aucune publication dans cette catégorie.';
            $variables = compact('errors', 'categories', 'posts');
        } else {
            $posts = $postManager->getPosts(); 
            $variables = compact('posts', 'categories');
        }
        $this->view('frontend/allPosts', $variables);
    }

/*     public function posts() {
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        $posts = array();
        if (empty($_GET['id_category'])) {
            $variables = compact('categories', 'posts');
            $this->view('frontend/allPosts', $variables);
            exit;
        }
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $posts = $postManager->getPostsByCategory($_GET['id_category']);
        $nbPost = $postManager->nbPost($firstPost = 0);
        if ($nbPost < 1 || empty($posts)) {
            $errors[] = 'Aucune publication dans cette catégorie.';
            $variables = compact('errors', 'categories', 'posts');
        } else {
            $posts = $postManager->getPosts($firstPost); 
            $variables = compact('posts', 'categories');
        }
        $this->view('frontend/allPosts', $variables);
    }
*/
    public function displayOnePost() {
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $commentManager = new \Kldr\ModeleVivant\Model\CommentManager();
        $post = $postManager->getPost($_GET['id_post']);
        if (empty($post)) {
            $errors[] = 'Aucune publication dans cette catégorie.';
            $variables = compact('errors', 'post');
        } else {
          //  $comments = $commentManager->getComments();
            $variables = compact('post');
        }
        $this->view('frontend/onePost', $variables);
    }

// SEND MAIL CONTACT
    public function sendMailContact() {
        if (!isset($_POST['submit'])) {
            $this->view('frontend/contact');
            exit;        
        }
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
            $variables = compact('errors');
            $this->view('frontend/contact', $variables);
            exit;
        }
        if (
            empty($_POST['pseudo'])
            || empty($_POST['mail'])
            || empty($_POST['radioContact'])
            || empty($_POST['subject'])
            || empty($_POST['content'])) {
            $errors[] = 'Tous les champs requis ne sont pas remplis !';
            $this->view('frontend/contact', $variables);
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
            $errors[] = 'Le mail n\'a pu être envoyé...';
            $variables = compact('errors');
        } else {
            $success = 'Votre mail a bien été envoyé !';
            $variables = compact('success');
        }
        $this->view('frontend/contact', $variables);
    }

    public function modifyAccount() {
        if (!$_SESSION['connected']) {
            $this->home();
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
        header('Location: ./');
    }
}