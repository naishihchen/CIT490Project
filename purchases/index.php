<?php
//Purchases Controller

//Session
session_start();


//Database connection file file
require_once '../library/connections.php';
require_once '../library/functions.php';

//PHP Motors Model
require_once '../model/accounts-model.php';
require_once '../model/items-model.php';
require_once '../model/main-model.php';
require_once '../model/purchases-model.php';

$items = getItems();

// var_dump($items);
//  	exit;

//new navlist!
$navList = writeNavDropdown($items);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
    case 'new-purchase':
        
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);
        $purchaseQuantity = filter_input(INPUT_POST, 'purchaseQuantity', FILTER_SANITIZE_NUMBER_INT);
        $purchasePrice = filter_input(INPUT_POST, 'purchasePrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        

        if(empty($purchaseQuantity)) {
            $message = '<p>There was an error recording your purchase. Please contact Soap Angels management.</p>';
          include '../view/admin.php';
          exit;
        } 

        if(!empty($prodId)) {
            $purchaseName = getProdName($prodId);
        }

        if($clientId && $prodId && $purchaseQuantity && $purchasePrice && $purchaseName) {
            $postOutcome = insertPurchase($clientId, $prodId, $purchaseQuantity, $purchasePrice, $purchaseName);
        }

        if($postOutcome === 1){
            $message = "<p>Your purchase was successfully posted.</p>";
            $_SESSION['loggedin'] = TRUE;
            include '../view/admin.php';
            exit;
           } else {
            $message = "<p>There was an error recording your purchase. Please contact Soap Angels management.</p>";
            include '../view/admin.php';
            exit;
           }
     break;

    case 'addcart':
        if (!isset( $_SESSION['cart'] )){
          $_SESSION['cart'] = [];
        }

        $prodName = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);
        $productPrice = filter_input(INPUT_POST, 'productPrice', FILTER_SANITIZE_NUMBER_FLOAT);
        $productQuantity = filter_input(INPUT_POST, 'productQuantity', FILTER_SANITIZE_NUMBER_INT);


        if(isset($_SESSION['clientData']['clientId'])) {
            array_push($_SESSION['cart'], [$_SESSION['clientData']['clientId'], $prodId, $productPrice, $productQuantity, $prodName]);
        }
        header('Location: /');
        break;

    default:

    if (!$_SESSION['loggedin']) {
        header('Location: /');
    } else {
        include '../accounts/index.php';
    }
    
    break;
 }

?>