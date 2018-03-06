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

        case 'sendMailAccount':
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

        case 'manageUsersAccounts':
            $backendController->manageUsersAccounts();
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
        case 'posts':
            $frontendController->posts();
            break; 

        case 'addPost':
            $backendController->addPost();
            break;

        case 'editPost':
            $backendController->editPost();
            break; 

        case 'deletePost':
            $backendController->deletePost();
            break;

        case 'modifyFormPost':
            $backendController->modifyFormPost();
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
            $backendController->editComment();
            break; 

        case 'deleteComment':
            $backendController->deleteComment();
            break;

        case 'signalComment':
            $frontendController->signalComment();
            break; 

// SIGNALISED ADVERTISEMENTS AND COMMENTS 
        case 'reportedAdsAndComments':
            $backendController->reportedAdsAndComments();
            break; 

// ADVERTISEMENTS
        case 'advertisements':
            $frontendController->advertisements();
            break; 

        case 'pendingAdvertisements':
            $backendController->pendingAdvertisements();
            break;

        case 'addAdvertisement':
            $frontendController->addAdvertisement();
            break; 

        case 'getAdvertisement':
            $frontendController->getAdvertisement();
            break;

        case 'editAdvertisement':
            $backendController->editAdvertisement();
            break;

        case 'modifyFormAdvertisement':
            $backendController->modifyFormAdvertisement();
            break;

        case 'deleteAdvertisement':
            $backendController->deleteAdvertisement();
            break;

        case 'signalAdvertisement':
            $frontendController->signalAdvertisement();
            break; 

        case 'getSignalisedAdvertisement':
            $backendController->getSignalisedAdvertisement();
            break;

        case 'publishAdvertisement':
            $backendController->publishAdvertisement();
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