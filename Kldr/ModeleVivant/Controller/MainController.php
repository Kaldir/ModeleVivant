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
	public function pseudoUpdate($pseudo, $password) {
		$userManager = new \Kldr\ModeleVivant\Model\UserManager();
		$pseudoUp = $userManager->pseudoUpdate($pseudo, $password);
		if ($pseudoUp > 0) { // rapport au rowCount, on vérifie si une ligne a été modifiée (voir userManager.php méthode pseudoUpdate)
			$_SESSION['pseudo'] = $pseudo;
		    if (!empty($_POST['newPseudo']) && !empty($_POST['password'])) {
		   		header('Location: ./?action=pseudoUpdate' .$_POST['newPseudo'], $_POST['password']); ;
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
				header('Location: ./?action=accountModify' .$_POST['password'], $_POST['newPassword'].'&success=true');
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
*/

}