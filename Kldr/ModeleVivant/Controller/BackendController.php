<?php
namespace Kldr\ModeleVivant\Controller;

class BackendController extends MainController
{
// ACCOUNT
    public function manageUsersAccounts() {
        if (!$_SESSION['admin']) {
            $this->redirect();
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        $users = $userManager->getUsersAccount();
        $variables = compact('users');
        $this->view('backend/manageUsersAccounts', $variables);
    }

    public function deleteUserAccount() {
        if (!$_SESSION['admin']) {
            $this->redirect();
            exit;
        }
        $userManager = new \Kldr\ModeleVivant\Model\UserManager();
        $users = $userManager->getUsersAccount();
        $variables = compact('users');
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('manageUsersAccounts');
            exit;
        }
        $result = $userManager->deleteUserAccount($_POST['id_user']);
        if ($result == false) {
            $this->addError('Le compte n\'a pas pu être supprimé...');
            $this->redirect('manageUsersAccounts');
            exit;
        }
        $this->addSuccess('Compte supprimé avec succès !');
        $users = $userManager->getUsersAccount();
        $this->redirect('manageUsersAccounts');
    }        

// ADVERTISEMENTS
    public function pendingAdvertisements() {
        if (!$_SESSION['admin']) {
            $this->redirect();
            exit;
        }
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        $ads = $adManager->getPendingAdvertisements();
        $variables = compact('ads');
        $this->view('backend/pendingAdvertisements', $variables);
    }

    public function editAdvertisement() {
        if (!$_SESSION['admin'] || !isset($_POST['submit'])) {
            $this->redirect();
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
            || empty(trim($_POST['content']))
            || !isset($_POST['id_ad'])
            || empty(trim($_POST['id_ad']))) {
            $this->addError('Tous les champs requis ne sont pas remplis !');
        }
        elseif (empty($categoryManager->getAdCategory($_POST['id_category']))) {
            $this->addError('Cette catégorie n\'existe pas...');
        }
        if ($this->hasError()) {
            $this->redirect('advertisements');
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
            $this->addError('L\'annonce n\'a pas été modifiée.');
            $this->redirect('advertisements');
            exit;
        }
        $this->addSuccess('Annonce modifiée avec succès !');          
        $this->redirect('advertisements');
    }

    public function deleteAdvertisement() {
        if (!$_SESSION['admin'] || !isset($_POST['submit'])) {
            $this->redirect();
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('advertisements');
            exit;
        }
    	$adManager = new \Kldr\ModeleVivant\Model\AdManager();
    	$result = $adManager->deleteAdvertisement($_POST['id_ad']);
    	if ($result == false) {
    		$this->addError('L\'annonce n\'a pas pu être supprimée...');
        	$this->redirect('advertisements');
            exit;
    	}
        $this->addSuccess('Annonce supprimée avec succès !');
        $this->redirect('advertisements');
    }

	public function modifyFormAdvertisement() {
        if (!$_SESSION['admin'] || !isset($_POST['submit'])) {
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
    	if (empty($_POST['id_ad'])) {
    		$this->redirect('advertisements');
    	}
    	$ad = $adManager->getAdvertisement($_POST['id_ad']);
		$variables = compact('ad', 'categories');
    	$this->view('backend/modifyFormAdvertisement', $variables);
	}

    public function publishAdvertisement() {
        if (!$_SESSION['admin'] || !isset($_POST['submit'])) {
            $this->redirect();
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('pendingAdvertisements');
            exit;
        }
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        if (empty($_POST['id_ad'])) {
            $this->addError('Cette annonce n\'existe pas...');
            $this->redirect('pendingAdvertisements');
            exit;
        }
        $ads = $adManager->getPendingAdvertisements();
        $result = $adManager->publishAdvertisement($_POST['id_ad']);
        if ($result == false) {
            $this->addError('L\'annonce n\'existe pas ou a déjà été publiée...');
            $this->redirect('pendingAdvertisements');
            exit;
        }
        $this->addSuccess('Annonce publiée avec succès !');
        $this->redirect('pendingAdvertisements');
    }

// POSTS
    public function addPost() {
        if (!$_SESSION['admin'] || !isset($_POST['submit'])) {
            $this->redirect();
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('posts');
            exit;
        }
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getpostsCategories();
        if (
            !isset($_POST['id_category'])
            || empty(trim($_POST['id_category']))
            || !isset($_POST['title'])
            || empty(trim($_POST['title']))
            || !isset($_POST['content'])
            || empty(trim($_POST['content']))) {
            $this->addError('Tous les champs requis ne sont pas remplis !');
        }
        elseif (empty($categoryManager->getpostCategory($_POST['id_category']))) {
            $this->addError('Cette catégorie n\'existe pas...');
        }
        if ($this->hasErrors()) {
            $this->redirect('posts');
            exit;
        }
        $result = $postManager->addPost(
            $_SESSION['id_user'],
            $_POST['id_category'],
            $_POST['title'],
            $_POST['content']);
        if ($result == false) {
            $this->addError('Impossible de créer le billet');
            $this->redirect('posts');
            exit;          
        } 
        $this->addSuccess('Billet publié avec succès !');
        $this->redirect('posts');
    }

    public function editPost() {
        if (!$_SESSION['admin'] || !isset($_POST['submit'])) {
            $this->redirect();
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('posts');
            exit;
        }
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        if (
            !isset($_POST['id_category'])
            || empty(trim($_POST['id_category']))
            || !isset($_POST['title'])
            || empty(trim($_POST['title']))
            || !isset($_POST['content'])
            || empty(trim($_POST['content']))
            || !isset($_POST['id_post'])
            || empty(trim($_POST['id_post']))) {
            $this->addError('Tous les champs requis ne sont pas remplis !');
        }
        elseif (empty($categoryManager->getPostCategory($_POST['id_category']))) {
            $this->addError('Cette catégorie n\'existe pas...');
        }
        if ($this->hasErrors()) {
            $this->redirect('posts');
            exit;
        }
        if (empty($_POST['id_post'])) {
            $this->addError('Ce billet n\'existe pas...');
            $this->redirect('posts');
            exit;
        }
        $result = $postManager->editPost(
            $_POST['id_category'],
            $_POST['title'],
            $_POST['content'],
            $_POST['id_post']);
        if ($result == false) {
            $this->addError('Le billet n\'a pas été modifié.');
            $this->redirect('posts');
            exit;
        }
        $this->addSuccess('Billet modifié avec succès !');
        $this->redirect('posts');
    }

    public function deletePost() {
        if (!$_SESSION['admin'] || !isset($_POST['submit'])) {
            $this->redirect();
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('posts');
            exit;
        }
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        $result = $postManager->deletePost($_POST['id_post']);
        if ($result == false) {
            $this->addError('Le billet n\'a pas pu être supprimé...');
            $this->redirect('posts');
            exit;
        }
        $this->addSuccess('Billet supprimé avec succès !');
        $this->redirect('posts');
    }

    public function modifyFormPost() {
        if (!$_SESSION['admin'] || !isset($_POST['submit'])) {
            $this->redirect();
            exit;
        }
        if ($this->checkToken() == false) {
            $this->addError('Erreur de session...');
            $this->redirect('posts');
            exit;
        }
        $postManager = new \Kldr\ModeleVivant\Model\PostManager();
        $categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getPostsCategories();
        if (empty($_POST['id_post'])) {
            $this->redirect('posts');
            exit;
        }
        $post = $postManager->getPost($_POST['id_post']);
        $variables = compact('post', 'categories');
        $this->view('backend/modifyFormPost', $variables);
    }
}