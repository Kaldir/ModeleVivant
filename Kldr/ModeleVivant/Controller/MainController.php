<?php
namespace Kldr\ModeleVivant\Controller;

class MainController
{
// TOKENS
	public $token;

    function __construct() {
        $this->token = bin2hex(random_bytes(32));
    }

    public function checkToken() {
    	$errors = array();
		if ($_SESSION['token'] != $_POST['token']) { // vérifie si le token de session correspond ou non à celui qui vient du formulaire
        	return false;
        }
        return true;
    }

// HOME
    public function home() {
        $this->view('common/home');
    }

// VIEW
	public function view($view = 'common/home', $variables = array()) {
		$_SESSION['token'] = $this->token; // stock un token dans $_SESSION à chaque fois que l'on affiche une view
		extract($variables); // fonction qui sert à aller chercher les variables contenues dans une variable contenant un array, et permet de les réutiliser ailleurs
		require('./View/' . $view . '.php');
		if (!empty($_SESSION['admin'])) {
			require('./View/backend/template.php');
		} else {
			require('./View/frontend/template.php');
		}
	}
}