<?php
session_start();
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

        case 'updatePassword':
            $frontendController->updatePassword();
            break;
            
        case 'pseudoUpdate':
            $frontendController->updatePseudo();
            break;

        case 'mailUpdate':
            $frontendController->updateMail();
            break;

        case 'avatarUpdate':
            $frontendController->updateAvatar();
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

// TUTOS       
        case 'tutos':
            $frontendController->tutos();
            break; 

// MARKETPLACE
        case 'marketplace':
            $frontendController->marketplace();
            break; 

// FRIENDS
        case 'friends':
            $frontendController->friends();
            break; 

// ADVERTISEMENTS
        case 'advertisements':
            $frontendController->advertisements();
            break; 

// PAR DEFAUT, AFFICHAGE DE LA PAGE D'ACCUEIL
        default:
            $frontendController->home();
    }

} else {
    $frontendController->home();
}