<?php
namespace Kldr\ModeleVivant\Controller;

class FrontendController extends MainController
{
// ACCOUNT 
    public function createAccount() {
        if (isset($_POST['submit'])) { // si le formulaire est envoyé
            $errors = array(); // $errors contiendra les différentes erreurs possibles
            if (empty(trim($_POST['pseudo'])) || empty(trim($_POST['mail'])) || empty(trim($_POST['password'])) || empty(trim($_POST['checkPassword']))) { // on vérifie si un ou plusieurs des champs ne sont pas remplis
                $errors[] = 'Tous les champs ne sont pas remplis !'; // sinon, on stocke une erreur dans $error
            } if ($_POST['password'] != $_POST['checkPassword']) {
                $errors[] = 'Les mots de passe ne sont pas identiques !';
            } if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'adresse mail n\'est pas valide !';
            }
            if (!empty($errors)) { // si il y a une erreur avec les champs
                $variables = compact(['errors']); // on compact $errors afin de pouvoir la réutiliser dans la view grâce à extract
                $this->view('frontend/createAccount', $variables); // on affiche la page de creation de compte avec le message d'erreur
            } else {
                $userManager = new \Kldr\ModeleVivant\Model\UserManager(); // on crée l'objet UserManager
                $result = $userManager->createAccount($_POST['pseudo'], $_POST['mail'], $_POST['password']); // on envoie ces infos à la bdd afin de créer un compte
                if ($result['success'] == false) { // si aucun compte n'est créé :
                    $errors[] = $result['message'];
                    $variables = compact(['errors']); // on compact $errors afin de pouvoir la réutiliser dans la view grâce à extract
                    $this->view('frontend/createAccount', $variables); // on affiche la page de creation de compte avec le message d'erreur
                } else {
                    $this->home(); // si tout a fonctionné (un compte est créé), on affiche la page d'accueil
                }
            }
        } else {
            $this->view('frontend/createAccount'); // si le formulaire n'est pas envoyé (c'est à dire lorsqu'on charge la page la première fois), on affiche la page de creation de compte
        }
    }

/*
    public function recoverPassword() {
        if (isset($_POST['submit'])) {
            if (empty(trim($_POST['pseudo'])) || empty(trim($_POST['mail']))) {
                $error = 'Il manque des informations dans les champs !';
            } else {
                if ($_POST['pseudo'] && $_POST['mail'] == NULL) {
                $error = 'Aucun compte attaché à cet email...';
                }
            } if (isset($error)) {
                $variables = compact(['error']);
                $this->view('frontend/recoverPasswordForm', $variables);
            } else {
                $userManager = new \Kldr\ModeleVivant\Model\UserManager();
                $recoverPass = $userManager->recoverPassword($_GET['id'], $_POST['mail']);
                if ($recoverPass > 0) { // rapport au rowCount, on vérifie si une ligne a été modifiée (voir userManager.php méthode recoverPassword)
                    $_SESSION['mail'] = $mail;
                    header('Location: index.php?action=sendMail');
                }
            }
        } else {
            $this->view('frontend/recoverPasswordForm');
        }
    }

	public function checkLogin($password, $email) {
		$userManager = new \Kldr\ModeleVivant\Model\UserManager();
		$userInfo = $userManager->checkLogin($_POST['password'], $_POST['email']);
        if (is_array($userInfo)) { // on vérifie que l'on est en présence d'un tableau, car la méthode checkLogin retourne soit un tableau (dans la variabe $userInfo), soit false.
            $_SESSION['user'] = true;
            $_SESSION['pseudo'] = $userInfo['pseudo']; // va chercher l'info pseudo contenu dans le tableau data contenu dans la variable userInfo lorsque status = ok
            $_SESSION['email'] = $userInfo['email'];
            if (!empty($_POST['password']) AND !empty($_POST['email'])) {
    			$frontendController->checkLogin($_POST['password'], $_POST['email']);
        		header('Location: index.php?action=');
            }
        } else {
    		$this->error('Votre pseudo ou votre mot de passe est incorrect !');
	    }
    }

    public function sendMailContact() {
        if (isset($_POST['submit'])) {
            $subject = 'Modèles vivants - Quelqu\'un vous a écrit !';
            $sendMailAccount = 
            $mailSended = mail('lulu@kldr.fr', $subject, $sendMailAccount, 'From : <'. $_POST['mail'] .'>');
            if ($mailSended) {
                $success = 'Votre email a bien été envoyé !';
            } else {
                $error = 'Echec de l\'envoi du mail...';
            }
        } else {
            $this->view('frontend/contact');
        }
    }
*/
    public function contact() {
        $this->view('frontend/contact');
    }

    public function tutos() {
        $this->view('common/allTutos');
    }

    public function marketplace() {
        $this->view('common/marketplace');
    }

    public function friends() {
        $this->view('common/friends');
    }

    public function advertisements() {
        $this->view('common/advertisements');
    }
}