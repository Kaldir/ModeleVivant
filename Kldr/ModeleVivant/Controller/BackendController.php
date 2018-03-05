<?php
namespace Kldr\ModeleVivant\Controller;

class BackendController extends MainController
{
	public function getAdsSignalised() {
        
    }
// ADVERTISEMENTS 
    public function editAdvertisement() {
        $adManager = new \Kldr\ModeleVivant\Model\AdManager();
        if (empty($_SESSION['admin'])) {
        	$adManager->getAdvertisement();
        }
    }

    public function deleteAdvertisement() {
    	$adManager = new \Kldr\ModeleVivant\Model\AdManager();
    	$categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
        $categories = $categoryManager->getAdsCategories();
        $variables = compact('categories');
        $errors = array();
    	if (empty($_SESSION['admin'])) {
    		$this->home();
    	} else {
            if ($this->checkToken() == false) {
                $errors[] = 'Erreur de session...';
                $variables = compact('errors', 'categories');
            } else {
            	$result = $adManager->deleteAdvertisement($_POST['id_ad']);
            	if ($result == false) {
            		$errors[] = 'L\'annonce n\'a pas pu être supprimée...';
                	$variables = compact('errors', 'categories');
            	} else {
	            	$success = 'Annonce supprimée avec succès !';
	                $variables = compact('success', 'categories');
            	}
            }
            $this->view('common/advertisements', $variables);
        }
	}

	public function adModifyForm() {
    	$adManager = new \Kldr\ModeleVivant\Model\AdManager();
    	$categoryManager = new \Kldr\ModeleVivant\Model\CategoryManager();
    	$categories = $categoryManager->getAdsCategories();
    	if (empty($_POST['id_ad'])) {
    		header('Location: ./?action=advertisements');
    	}
    	$ad = $adManager->getAdvertisement($_POST['id_ad']);
		$variables = compact('ad', 'categories');
    	$this->view('backend/adModifyForm', $variables);
	}
}