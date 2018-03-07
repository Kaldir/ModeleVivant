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
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $posts = $postManager->getSliderPosts();
        $variables = compact('posts');
        $this->view('frontend/home', $variables);
    }

// VIEW
	public function view($view = 'frontend/home', $variables = array()) {
		$_SESSION['token'] = $this->token; // stock un token dans $_SESSION à chaque fois que l'on affiche une view
		extract($variables); // fonction qui sert à aller chercher les variables contenues dans une variable contenant un array, et permet de les réutiliser ailleurs
		require('./View/' . $view . '.php');
		require('./View/frontend/template.php');
	}

// EXCERPT
        public function getExcerpt($string, $start = 0, $maxLength = 200) {
            $string = strip_tags($string);
            if (strlen($string) > $maxLength) { // si le texte est supérieur à 100 caractères
                $string = substr($string, $start, $maxLength); // affiche le texte, depuis le premier caractère, jusqu'à 100 caractères
                $string  .= '...';
        }
        return $string;
    }
}