<?php
namespace Kldr\ModeleVivant\Controller;

class BackendController extends MainController
{
// ADVERTISEMENTS
    public function pendingAdvertisements() {
        if (empty($_SESSION['admin'])) {
            header('Location: ./');
        }
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        $ads = $adManager->getPendingAdvertisements();
        $variables = compact('ads');
        $this->view('backend/pendingAdvertisements', $variables);
    }

    public function editAdvertisement() {
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getAdsCategories();
        $ads = array();
        if (empty($_SESSION['admin'])) {
            header('Location: ./');
        }
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
        } elseif (
            empty(trim($_POST['id_category']))
            || empty(trim($_POST['title']))
            || empty(trim($_POST['town']))
            || empty(trim($_POST['county']))
            || !isset($_POST['location'])
            || !isset($_POST['date_event'])
            || empty(trim($_POST['content']))
            || empty(trim($_POST['id_ad']))) {
            $errors[] = 'Tous les champs requis ne sont pas remplis !';
        }
        elseif (empty($categoryManager->getAdCategory($_POST['id_category']))) {
            $errors[] = 'Cette catégorie n\'existe pas...';
        }
        if (!empty($errors)) {
            $variables = compact('errors', 'categories', 'ads');
            $this->view('common/advertisements', $variables);
            exit;
        }
        $result = $adManager->editAdvertisement(
            $_POST['id_category'],
            $_POST['title'],
            $_POST['town'],
            $_POST['county'],
            $_POST['location'],
            $_POST['date_event'],
            $_POST['content'],
            $_POST['id_ad']);
        if ($result == false) {
            $errors[] = 'L\'annonce n\'a pas été modifiée.';
            $variables = compact('errors', 'categories', 'ads');
        } else {
            $success = 'Annonce modifiée avec succès !';
            $variables = compact('success', 'categories', 'ads');
        }            
        $this->view('common/advertisements', $variables);
    }

    public function deleteAdvertisement() {
    	$adManager = new \Kldr\ModeleVivant\Model\AdManager();
    	$categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getAdsCategories();
        $ads = array();
        $errors = array();
    	if (empty($_SESSION['admin'])) {
            header('Location: ./');
    	}
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
            $variables = compact('errors', 'ads');
            $this->view('common/advertisements', $variables);
            exit;
        }
    	$result = $adManager->deleteAdvertisement($_POST['id_ad']);
    	if ($result == false) {
    		$errors[] = 'L\'annonce n\'a pas pu être supprimée...';
        	$variables = compact('errors', 'categories');
    	} else {
        	$success = 'Annonce supprimée avec succès !';
            $variables = compact('success', 'categories', 'ads');
    	}
        $this->view('common/advertisements', $variables);
    }

	public function modifyFormAdvertisement() {
    	$adManager = new \Kldr\ModeleVivant\Model\AdManager();
    	$categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
    	$categories = $categoryManager->getAdsCategories();
    	if (empty($_POST['id_ad'])) {
    		header('Location: ./?action=advertisements');
    	}
    	$ad = $adManager->getAdvertisement($_POST['id_ad']);
		$variables = compact('ad', 'categories');
    	$this->view('backend/modifyFormAdvertisement', $variables);
	}

    public function publishAdvertisement() {
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        $ads = array();
        $errors = array();
        if (empty($_SESSION['admin'])) {
            header('Location: ./');
        }
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
            $variables = compact('errors', 'ads');
            $this->view('backend/pendingAdvertisements', $variables);
            exit;
        }
        if (empty($_POST['id_ad'])) {
            $errors[] = 'Cette annonce n\'existe pas...';
            $variables = compact('errors', 'ads');
            $this->view('backend/pendingAdvertisements', $variables);
            exit;
        }
        $ads = $adManager->getPendingAdvertisements();
        $result = $adManager->publishAdvertisement($_POST['id_ad']);
        if ($result == false) {
            $errors[] = 'L\'annonce n\'existe pas ou a déjà été publiée...';
            $variables = compact('errors');
        } else {
            $success = 'Annonce publiée avec succès !';
            $variables = compact('success', 'ads');
        }
        $this->view('backend/pendingAdvertisements', $variables);
    }

// POSTS
    public function addPost() {
        if (!isset($_POST['submit']) || empty($_SESSION['admin'])) {
            header('Location: ./?action=posts');
        }
        $posts = array();
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getpostsCategories();
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
        } elseif (
            empty(trim($_POST['id_category']))
            || empty(trim($_POST['title']))
            || empty(trim($_POST['content']))) {
            $errors[] = 'Tous les champs requis ne sont pas remplis !';
        }
        elseif (empty($categoryManager->getpostCategory($_POST['id_category']))) {
            $errors[] = 'Cette catégorie n\'existe pas...';
        }
        if (!empty($errors)) {
            $variables = compact('errors', 'categories', 'posts');
            $this->view('common/allPosts', $variables);
            exit;
        }
        $result = $postManager->addPost(
            $_SESSION['id_user'],
            $_POST['id_category'],
            $_POST['title'],
            $_POST['content']);
        if ($result == false) {
            $errors[] = 'Impossible de créer le billet';
            $variables = compact('errors', 'categories', 'posts');
            $this->view('common/allPosts', $variables);
        } else {
            $success = 'Billet publié avec succès !';
            $variables = compact('success', 'categories', 'posts');
        }
        $this->view('common/allPosts', $variables);
    }

    public function editPost() {
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        $posts = array();
        if (empty($_SESSION['admin'])) {
            header('Location: ./');
        }
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
        } elseif (
            empty(trim($_POST['id_category']))
            || empty(trim($_POST['title']))
            || empty(trim($_POST['content']))
            || empty(trim($_POST['id_post']))) {
            $errors[] = 'Tous les champs requis ne sont pas remplis !';
        }
        elseif (empty($categoryManager->getPostCategory($_POST['id_category']))) {
            $errors[] = 'Cette catégorie n\'existe pas...';
        }
        if (!empty($errors)) {
            $variables = compact('errors', 'categories', 'posts');
            $this->view('common/allPosts', $variables);
            exit;
        }
        if (empty($_POST['id_post'])) {
            $errors[] = 'Ce billet n\'existe pas...';
            $variables = compact('errors', 'posts');
            $this->view('common/allPosts', $variables);
            exit;
        }
        $result = $postManager->editPost(
            $_POST['id_category'],
            $_POST['title'],
            $_POST['content'],
            $_POST['id_post']);
        if ($result == false) {
            $errors[] = 'Le billet n\'a pas été modifié.';
            $variables = compact('errors', 'categories', 'posts');
        } else {
            $success = 'Billet modifié avec succès !';
            $variables = compact('success', 'categories', 'posts');
        }            
        $this->view('common/allPosts', $variables);
    }

    public function deletePost() {
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        $posts = array();
        $errors = array();
        if (empty($_SESSION['admin'])) {
            header('Location: ./');
        }
        if ($this->checkToken() == false) {
            $errors[] = 'Erreur de session...';
            $variables = compact('errors', 'posts');
            $this->view('common/allPosts', $variables);
            exit;
        }
        $result = $postManager->deletePost($_POST['id_post']);
        if ($result == false) {
            $errors[] = 'Le billet n\'a pas pu être supprimé...';
            $variables = compact('errors', 'categories');
        } else {
            $success = 'Billet supprimé avec succès !';
            $variables = compact('success', 'categories', 'posts');
        }
        $this->view('common/allPosts', $variables);
    }

    public function modifyFormPost() {
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        if (empty($_POST['id_post'])) {
            header('Location: ./?action=posts');
        }
        $post = $postManager->getPost($_POST['id_post']);
        $variables = compact('post', 'categories');
        $this->view('backend/modifyFormPost', $variables);
    }
}