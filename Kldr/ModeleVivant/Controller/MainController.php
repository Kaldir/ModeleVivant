<?php
namespace Kldr\ModeleVivant\Controller;

class MainController
{
// HOME
    public function home() {
        $this->view('common/home');
    }

// VIEW
	public function view($view = 'common/home', $variables = array()) {
		extract($variables); // fonction qui sert à aller chercher les variables contenues dans une variable contenant un array, et permet de les réutiliser ailleurs
		require('./View/' . $view . '.php');
		if (!empty($_SESSION['admin'])) {
			require('./View/backend/template.php');
		} else {
			require('./View/frontend/template.php');
		}
	}

// ACCOUNTS
/*
	public function sendMailAccount() {
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        if (isset($_POST['submit'])) {
        	$subject = 'Réinitialisation mot de passe - Modèles vivants';
        	$sendMailAccount = '<p>Bonjour '. $_POST['pseudo'] .', votre mot de passe vient d\'être réinitialisé. Connectez vous avec vos informations habituelles et rentrez <div class="mdp">'. $_POST['newPasswordAuto'] .'</div>comme mot de passe.<br />Vous pourrez le modifier par la suite dans vos paramètres de compte.</p>';
        	$mailSended = mail($_POST['mail'], $subject, $sendMailAccount, 'From : <lulu@kldr.fr>');
        	if ($mailSended) {
        		$success = 'Un email avec un mot de passe temporaire vient de vous être envoyé !';
        	}
        } else {
            $this->home();
        }
	}

	public function pseudoUpdate($pseudo, $password) {
		$userManager = new \Kldr\ModeleVivant\Model\UserManager();
		$pseudoUp = $userManager->pseudoUpdate($pseudo, $password);
		if ($pseudoUp > 0) { // rapport au rowCount, on vérifie si une ligne a été modifiée (voir userManager.php méthode pseudoUpdate)
			$_SESSION['pseudo'] = $pseudo;
		    if (!empty($_POST['newPseudo']) && !empty($_POST['password'])) {
		   		header('Location: index.php?action=pseudoUpdate' .$_POST['newPseudo'], $_POST['password']); ;
		    } else {
                $backendControler->error('Tous les champs ne sont pas remplis !');
            }
	    } else {
			$this->error('Impossible de modifier le pseudo !');
	    }
	}

	public function passUpdate($password, $newPassword) {
		$userManager = new \Kldr\ModeleVivant\Model\userManager();
		$passUp = $userManager->passUpdate($password, $newPassword);
		if ($passUp > 0 && $_POST['newPassword'] == $_POST['checkPassword']) {
			if  (!empty($_POST['password']) && !empty($_POST['newPassword']) && !empty($_POST['checkPassword'])) {
				header('Location: index.php?action=accountModify' .$_POST['password'], $_POST['newPassword'].'&success=true');
            } else {
                $backendControler->error('Tous les champs ne sont pas remplis !');
            }
	    } else {
			$this->error('Impossible de modifier le mot de passe !');
	    }
	}

	public function mailUpdate() {
		
	}

	public function avatarUpdate() {
		
	}

	public function logout() {
	    session_destroy();
		header('Location: index.php');
	}
*/
}