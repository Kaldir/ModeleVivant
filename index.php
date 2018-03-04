<?php
require('constants.php');
session_start();

if (empty($_SESSION['connected'])) {
    $_SESSION['connected'] = false;
}

require('Autoloader/autoloader.php'); // chargement de l'autoloader
Autoloader::register();

$frontendController = new \Kldr\ModeleVivant\Controller\FrontendController();
$backendController = new \Kldr\ModeleVivant\Controller\BackendController();

if (isset($_GET['action'])) {

    switch ($_GET['action']) {
// ACCOUNT
        case 'login':
            $frontendController->login();
            break;

	    case 'createAccount':
            $frontendController->createAccount();
            break;

        case 'createAccount':
            $frontendController->sendMailAccount();
            break;

        case 'forgotPassword':
            $frontendController->forgotPassword();
            break;

        case 'generatePassword':
            $frontendController->generatePassword();
            break;

        case 'updatePassword':
            $frontendController->updatePassword();
            break;
            
        case 'updatePseudo':
            $frontendController->updatePseudo();
            break;

        case 'updateMail':
            $frontendController->updateMail();
            break;

        case 'updateAvatar':
            $frontendController->updateAvatar();
            break;

        case 'modifyAccount':
            $frontendController->modifyAccount();
            break;

    	case 'logout':
            $frontendController->logout();
            break;

// CONTACT
        case 'contact':
            $frontendController->contact();
            break; 

        case 'sendMailContact':
            $frontendController->sendMailContact();
            break;  

// POSTS       
        case 'tutos':
            $frontendController->tutos();
            break; 

        case 'addPost':
            $frontendController->addPost();
            break;

        case 'editPost':
            $frontendController->editPost();
            break; 

        case 'deletePost':
            $frontendController->deletePost();
            break;

        case 'displayOnePost':
            $frontendController->displayOnePost();
            break; 

        case 'getExcerpt':
            $frontendController->getExcerpt();
            break;
            
// MARKETPLACE
        case 'marketplace':
            $frontendController->marketplace();
            break; 

// FRIENDS
        case 'friends':
            $frontendController->friends();
            break;

// COMMENTS
        case 'addComment':
            $frontendController->addComment();
            break;

        case 'editComment':
            $frontendController->editComment();
            break; 

        case 'deleteComment':
            $frontendController->deleteComment();
            break;

        case 'signalComment':
            $frontendController->signalComment();
            break; 

// CATEGORIES

// ADVERTISEMENTS
        case 'advertisements':
            $frontendController->advertisements();
            break; 

        case 'addAdvertisement':
            $frontendController->addAdvertisement();
            break; 

        case 'getAdvertisement':
            $frontendController->getAdvertisement();
            break;          

        case 'editAdvertisement':
            $frontendController->editAdvertisement();
            break;

        case 'deleteAdvertisement':
            $frontendController->deleteAdvertisement();
            break;

        case 'signalAd':
            $frontendController->signalAd();
            break; 

        case 'getAdsSignalised':
            $frontendController->getAdsSignalised();
            break;
            
// RESEARCH
        case 'research':
            $frontendController->research();
            break;            

// PAR DEFAUT, AFFICHAGE DE LA PAGE D'ACCUEIL
        default:
            $frontendController->home();
    }

} else {
    $frontendController->home();
}