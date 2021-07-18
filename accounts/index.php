<?php
//Accounts Controller

//Session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


//Database connection file file
require_once '../library/connections.php';
require_once '../library/functions.php';

//Accounts and Main Models
require_once '../model/accounts-model.php';
require_once '../model/main-model.php';

//Purchases Model
require_once '../model/purchases-model.php';

$items = getItems();

//new navlist!
$navList = writeNavDropdown($items);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
  case 'login':
    include '../view/login.php';
    break;

  case 'register':
    include '../view/registration.php';
    break;

  case 'registration':

    $clientFullname = filter_input(INPUT_POST, 'clientFullname', FILTER_SANITIZE_STRING);
    $clientUsername = filter_input(INPUT_POST, 'clientUsername', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    //check for existing email address
    $uniqueEmail = emailConfirmation($clientEmail);

    if($uniqueEmail) {
      $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    if (empty($clientFullname) || empty($clientUsername) || empty($clientEmail) || empty($checkPassword)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit;
    }

    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    $regOutcome = regClient($clientFullname, $clientUsername, $clientEmail, $hashedPassword);

    if($regOutcome === 1){
      setcookie('fullname', $clientFullname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "<p>Thanks for registering, $clientFullname. Please use your email and password to login.</p>";
      header('Location: /accounts/?action=login');
      exit;
     } else {
      $_SESSION['message'] = "<p>Sorry $clientFullname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
     }

    break;

  case 'Logging':

    $loginEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $loginPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    $loginEmail = checkEmail($loginEmail);
    $checkLoginPassword = checkPassword($loginPassword);

    if (empty($loginEmail) || empty($checkLoginPassword)) {
      $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
      include '../view/login.php';
      exit;
    }

    //Get client data based on email
    $clientData = getClient($loginEmail);

    if(!$clientData) {
        $_SESSION['message'] = '<p>Incorrect information. Please check your username and password and try again</p>';
        include '../view/login.php';
        exit;
      }

    if($checkLoginPassword && $clientData) {
      $hashCheck = password_verify($loginPassword, $clientData['clientPassword']);
    }
      if(!$hashCheck) {
        $_SESSION['message'] = '<p>Incorrect information. Please check your username and password and try again.</p>';
        include '../view/login.php';
        exit;
      }
    

    if(isset($_COOKIE['fullname'])) {
      setcookie('fullname', "", time() -3600, '/');
    }

    setcookie('username', $clientData['clientUsername'], strtotime('+1 year'), '/');

    $_SESSION['loggedin'] = TRUE;

    //Remove password data from clientData
    array_pop($clientData);

    $_SESSION['clientData'] = $clientData;

    $purchases = getPurchasesByAccount($clientData['clientId']);

    $clientPurchaseDisplay = buildClientPurchases($purchases);

    include '../view/admin.php';
  
    break;

  case 'accountUpdate':
    include '../view/client-update.php';
    break;

  case 'updateAccount':
    $clientFullname = filter_input(INPUT_POST, 'clientFullname', FILTER_SANITIZE_STRING);
    $clientUsername = filter_input(INPUT_POST, 'clientUsername', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    
    $existingEmail = emailConfirmation($clientEmail);
    
    if ($existingEmail && $clientEmail != $_SESSION['clientData']['clientEmail']) {
        $message = '<p>That email is taken. Please choose another.</p>';
          include '../view/client-update.php';
          exit;
    }
    
    
    
    if(empty($clientEmail)){
        $message = '<p>Please provide an email address.</p>';
        include '../view/client-update.php';
        exit; 
    }
    
    $newInfo = updateAccount($clientFullname, $clientUsername, $clientEmail, $clientId);
    
    $clientUpdatedData = getClientUpdate($clientId);
    
    $_SESSION['clientData'] = $clientUpdatedData;
    
    if($newInfo === 1){
        $message = "<p class='notice'>Account info successfully changed.</p>";
        include '../view/admin.php';
        exit;
    } else {
        $message = "<p>Sorry $clientFullname, but the update failed. Please try again.</p>";
        include '../view/admin.php';
        exit;
    }
    
    include '../view/admin.php';
    break;

  case 'newPassword':
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
     
    $checkPassword = checkPassword($clientPassword);
    // If the password doesn't match, create an error
    if(!$checkPassword) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/client-update.php';
        exit;
    } else {
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    }
    
    $passwordResults = passUpdate($hashedPassword, $_SESSION['clientData']['clientId']);
    
    if ($passwordResults) {
        $message = "<p>Password successfully changed</p>";
        include '../view/admin.php';
        exit;
    } else {
        $message = "<p>Sorry $clientFullname, but the update failed. Please try again.</p>";
        include '../view/admin.php';
        exit;
    }
    break;

  case 'logout':
    session_destroy();
    setcookie('username', "", time() -3600, '/');
    header('Location: /');
    break;

  default:

    if($_SESSION['clientData']) {
     $purchases = getPurchasesByAccount($_SESSION['clientData']['clientId']);

      $clientPurchaseDisplay = buildClientPurchases($purchases);
    }

    include '../view/admin.php';
    break;

}

?>