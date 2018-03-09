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

// NOTIFICATIONS
     public function hasErrors() {
        if(empty($_SESSION['errors'])) {
            return false;
        }
        return true;
    }

    public function hasSuccess() {
        if(empty($_SESSION['success'])) {
            return false;
        }
        return true;
    }

    public function addError($error) {
        $_SESSION['errors'][] = $error;
    }

    public function addSuccess($success) {
        $_SESSION['success'][] = $success;
    }

// REDIRECTION
    public function redirect($page = false, $vars = []) {
        $path = './'; // correspond à la page index (chemin par défaut)
        if(!empty(trim($page))) { // si on a mis une page en argument
            $path .= 'index.php?action='.$page; // ajoute l'action définie comme argument
            if(is_array($vars) && !empty($vars)) { // si on a mis des données en arguments dans $vars
                $path .= '&'; // ajoute ce symbole au chemin défini précédemment
                $path .= http_build_query($vars); // méthode php qui construit une query string au format url à partir d'un tableau
            }
        }
        header('Location: '.$path);
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

// PAGINATION
    public function pagination($nbElements) {
        // parse_str : extrait les variables de QUERY_STRING et les mets dans le tableau $queryArray
        // QUERY_STRING : retourne les variable GET de l'url sous forme de string
        parse_str($_SERVER['QUERY_STRING'], $queryArray); 
        $nbPages = ceil($nbElements/ELEMENT_PER_PAGE); // ceil : nombre de billet divisé par 3 (voir constants.php) arrondi au nombre supérieur
        for ($i = 1; $i < $nbPages + 1; $i++) {
            $queryArray["page"] = $i; 
            $queryString = http_build_query($queryArray); // reconstruit une url à partir du tableau queryArray
            require('./View/frontend/pagination.php');
        }
    }
}