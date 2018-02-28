<?php
namespace Kldr\ModeleVivant\Controller;

class FrontendController extends MainController
{
// ACCOUNT 
    public function createAccount() {
        if (isset($_POST['submit'])) { // si le formulaire est envoyé
            $errors = array(); // $errors contiendra les différentes erreurs possibles
            if (empty(trim($_POST['pseudo'])) || empty(trim($_POST['mail'])) || empty(trim($_POST['password'])) || empty(trim($_POST['checkPassword']))) { // on vérifie si un ou plusieurs des champs ne sont pas remplis
                $errors[] = 'Tous les champs ne sont pas remplis !'; // sinon, on stocke une erreur dans $errors
            }
            if ($_POST['password'] != $_POST['checkPassword']) {
                $errors[] = 'Les mots de passe ne sont pas identiques !';
            }
            if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'adresse mail n\'est pas valide !';
            }
            if (!empty($errors)) { // si il y a une erreur avec les champs
                $variables = compact(['errors']); // on compact $errors afin de pouvoir la réutiliser dans la view grâce à extract
                $this->view('frontend/createAccount', $variables); // on affiche la page de creation de compte avec le message d'erreur
            } else {
                $userManager = new \Kldr\ModeleVivant\Model\UserManager(); // on crée l'objet UserManager
                if ($userManager->checkUserByMail($_POST['mail']) == true) {
                    $errors[] = 'Cet email est déjà utilisé !';
                }
                if ($userManager->checkUserByPseudo($_POST['pseudo']) == true) {
                    $errors[] = 'Ce pseudo est déjà pris !';
                }
                if (!empty($errors)) {
                    $variables = compact(['errors']);
                    $this->view('frontend/createAccount', $variables);
                } else {
                    $userManager = new \Kldr\ModeleVivant\Model\UserManager(); // on crée l'objet UserManager
                    $result = $userManager->createAccount($_POST['pseudo'], $_POST['mail'], $_POST['password']); // on envoie ces infos à la bdd afin de créer un compte
                    if ($result == false) { // si aucun compte n'est créé :
                        $errors[] = $result['Le compte n\'a pas pu être créé...'];
                        $variables = compact(['errors']); // on compact $errors afin de pouvoir la réutiliser dans la view grâce à extract
                        $this->view('frontend/createAccount', $variables); // on affiche la page de creation de compte avec le message d'erreur
                    } else {
                        $this->home(); // si tout a fonctionné (un compte est créé), on affiche la page d'accueil
                    }
                }
            }
        } else {
            $this->view('frontend/createAccount'); // si le formulaire n'est pas envoyé (c'est à dire lorsqu'on charge la page la première fois), on affiche la page de creation de compte
        }
    }

    public function generatePassword() {
        if (isset($_POST['submit'])) {
            $errors = array(); // $errors contiendra les différentes erreurs possibles
            if (empty(trim($_POST['mail']))) {
                $errors[] = 'Il manque des informations dans les champs !';
            } else {
                $userManager = new \Kldr\ModeleVivant\Model\UserManager();
                if ($userManager->checkUserByMail($_POST['mail']) == false) {
                    $errors[] = 'Aucun compte ne correspond à cet email...';
                }
            }
            if (!empty($errors)) { // si il y a des erreurs :
                $variables = compact(['errors']);
                $this->view('frontend/forgotPassword', $variables);
            } else {
                $newPassword = bin2hex(openssl_random_pseudo_bytes(4)); // génère un pass de 8 caractères
                $result = $userManager->updatePassword($newPassword, $_POST['mail']);
                if ($result == false) { // rapport au rowCount, on vérifie si une ligne a été modifiée (voir userManager.php méthode updatePassword)
                    $errors[] = 'Le mot de passe n\'a pas été mis à jour...';
                    $variables = compact(['errors']);
                    $this->view('frontend/forgotPassword', $variables);
                } else {
                    $to = $_POST['mail'];
                    $subject = 'Réinitialisation mot de passe - Modèles vivants';
                    $message = "Bonjour, votre mot de passe vient d'être réinitialisé. Connectez vous avec vos informations habituelles et rentrez " . $newPassword . " comme mot de passe. Vous pourrez le modifier par la suite dans vos paramètres de compte.";
                    $headers = 'From: lulu@kldr.fr';
                    $mailSent = mail($to, $subject, $message, $headers);
                    if ($mailSent == false) {
                        $errors[] = 'Le mail n\'a pu être envoyé...';
                        $variables = compact(['errors']);
                        $this->view('frontend/forgotPassword', $variables);
                    } else {
                        $success = 'Un email contenant un mot de passe temporaire vient de vous être envoyé !';
                        $variables = compact(['success']);
                        $this->view('frontend/forgotPassword', $variables);
                    }
                }
            }
        } else {
            $this->view('frontend/forgotPassword');
        }
    }

    public function updatePassword() {
        if (empty(trim($_POST['password'])) || empty(trim($_POST['newPassword'])) || empty(trim($_POST['checkPassword']))) {
            $errors = array();
            $errors[] = 'Il manque des informations dans les champs !';
            $variables = compact(['errors']);
            $this->view('frontend/modifyAccount', $variables);
    //    } elseif {

// on vérifie que newpassword et checkpassword sont identiques

// on vérifie que le mdp est le bon (avec login du usermanager)
    // si le mdp est bon, on fait une requete qui maj le mdp dans la bdd (rowcount pour checker) - if > 0 ce sera true, alors c'est ok

// on vérifie que la requête a fonctionné
        }
    }

	public function login() {
		$userManager = new \Kldr\ModeleVivant\Model\UserManager();
		$login = $userManager->login($_POST['password'], $_POST['mail']);
        if ($login == false) {
            $errors[] = 'Impossible de se connecter...';
            $variables = compact(['errors']);
            $this->view('common/error', $variables);
        } else {
            $_SESSION['connected'] = true;
            $_SESSION['pseudo'] = $userManager->pseudo;
            $_SESSION['mail'] = $userManager->mail;
            $_SESSION['avatar'] = $userManager->avatar;
            $_SESSION['admin'] = $userManager->admin;
            header('Location: ./?action=modifyAccount');
        }
    }  
/*
    public function sendMailContact() {
        if (isset($_POST['submit'])) {
            $subject = 'Modèles vivants - Quelqu\'un vous a écrit !';
            $sendMailAccount = 
            $mailSended = mail('lulu@kldr.fr', $subject, $sendMailAccount, 'From : <'. $_POST['mail'] .'>');
            if ($mailSended) {
                $success = 'Votre email a bien été envoyé !';
            } else {
                $errors = 'Echec de l\'envoi du mail...';
            }
        } else {
            $this->view('frontend/contact');
        }
    }
*/

    public function modifyAccount() {
        $this->view('common/modifyAccount');
    }

    public function forgotPassword() {
        $this->view('frontend/forgotPassword');
    }

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

    public function logout() {
        session_destroy();
        header('Location: ./');
    }
}