<?php

//Session
session_start();


//Database Connection
require_once '../library/connections.php';
require_once '../library/functions.php';

//Main model
require_once '../model/main-model.php';

//Vehicle Model
require_once '../model/items-model.php';

//Reviews Model
require_once '../model/purchases-model.php';

$items = getItems();

//new navlist!
$navList = writeNavDropdown($items);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
    case 'add-product':
      include '../view/add-product.php';
      break;
  
    case 'add-item':
      include '../view/add-item.php';
      break;

    case 'new-item':

      $itemName = filter_input(INPUT_POST, 'itemName', FILTER_SANITIZE_STRING);
  
      if (empty($itemName)) {
        $message = '<p>Please provide an item name.</p>';
        include '../view/add-item.php';
        exit;
      }
  
      $insertItemOutcome = insertItem($itemName);
  
      if($insertItemOutcome === 1){
        header("Location: /items/index.php");
        exit;
       } else {
        $message = "<p>New item function has failed. Please try again.</p>";
        include '../view/add-item.php';
        exit;
       }

      break;

      case 'new-product':

        $prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING);
        $prodDescription = filter_input(INPUT_POST, 'prodDescription', FILTER_SANITIZE_STRING);
        $prodImage = filter_input(INPUT_POST, 'prodImage', FILTER_SANITIZE_STRING);
        $prodPrice = filter_input(INPUT_POST, 'prodPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $prodStock = filter_input(INPUT_POST, 'prodStock', FILTER_SANITIZE_NUMBER_INT);
        $itemId = filter_input(INPUT_POST, 'itemId', FILTER_SANITIZE_NUMBER_INT);
    
        if (empty($prodName) || empty($prodImage) || empty($prodPrice) || empty($prodStock) || empty($itemId)) {
          $message = '<p>Please provide information for all empty form fields.</p>';
          include '../view/add-product.php';
          exit;
        }
    
        $productOutcome = insertProduct($prodName, $prodDescription, $prodImage, $prodPrice, $prodStock, $itemId);
    
        if($productOutcome === 1){
          $message = "<p>Success! Product inserted</p>";
          include '../view/add-product.php';
          exit;
         } else {
          $message = "<p>Failed to insert product. Please try again.</p>";
          include '../view/add-product.php';
          exit;
         }
    
        break;

    case 'getProductItems':

      $itemId = filter_input(INPUT_GET, 'itemId', FILTER_SANITIZE_NUMBER_INT);

      $productArray = getProductByItem($itemId);

      if(isset($productArray)) {
        echo json_encode($productArray);
      }

      break;

    case 'mod':
      $prodId = filter_input(INPUT_GET, 'prodId', FILTER_VALIDATE_INT);
      $prodInfo = getProdItemInfo($prodId);
        if(!isset($prodInfo)){
        $message = 'Sorry, no product information could be found.';
      }
      include '../view/product-update.php';
      exit;
      break;

    case 'del':
      $prodId = filter_input(INPUT_GET, 'prodId', FILTER_VALIDATE_INT);
      $prodInfo = getProdItemInfo($prodId);
        if(!isset($prodInfo)){
        $message = 'Sorry, no product information could be found.';
      }
      include '../view/product-delete.php';
      exit;
      break;

    case 'updateProduct':
        $prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING);
        $prodDescription = filter_input(INPUT_POST, 'prodDescription', FILTER_SANITIZE_STRING);
        $prodImage = filter_input(INPUT_POST, 'prodImage', FILTER_SANITIZE_STRING);
        $prodPrice = filter_input(INPUT_POST, 'prodPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $prodStock = filter_input(INPUT_POST, 'prodStock', FILTER_SANITIZE_NUMBER_INT);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);
    
        if (empty($prodName) || empty($prodImage) || empty($prodPrice) || empty($prodStock) || empty($prodId)) {
          $message = '<p>Please provide information for all empty form fields.</p>';
          include '../view/product-update.php';
          exit;
        }
    
        $updateResult = updateProduct( $prodName, $prodDescription, $prodImage, $prodPrice, $prodStock, $prodId, $itemId);
    
        if($updateResult === 1){
          $message = "<p>Congratulations, the $prodName was successfully updated.</p>";
          $_SESSION['message'] = $message;
          header('location: /items/');
          exit;
         } else {
          $message = "<p>Failed to update product. Please try again.</p>";
          include '../view/product-update.php';
          exit;
         }
      break;

    case 'deleteProduct':
        $prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);
    
        $deleteResult = deleteProduct($prodId);
    
        if($deleteResult === 1){
          $message = "<p>Congratulations, the $prodName was successfully deleted.</p>";
          $_SESSION['message'] = $message;
          header('location: /items/');
          exit;
         } else {
          $message = "<p>Error: $prodName was not deleted.</p>";
          $_SESSION['message'] = $message;
          header('location: /items/');
          exit;
         }
      break;

    case 'item':
      $itemId = filter_input(INPUT_GET, 'itemId', FILTER_SANITIZE_NUMBER_INT);
      $products = getProductByItem($itemId);
      if(!$products){
        $message = "<p class='notice'>Sorry, no items could be found.</p>";
      } else {
       $itemDisplay = buildItemDisplay($products);
      }
      include '../view/item.php';
      break;

    case 'cart':


    if(!empty($_SESSION['cart'])) {

      $totalPrice = 0;

      $cartDisplay = "<div id=\"cart-display\">";
      foreach($_SESSION['cart'] as $cartItem) {
        $clientId = $cartItem[0];
        $prodId = $cartItem[1];
        $prodPrice = $cartItem[2];
        $prodQuantity = $cartItem[3];
        $prodName = $cartItem[4];

        $cartDisplay .= "<div class=\"cart-item\">";
        $cartDisplay .= "<p>Name: ".$prodName."</p>";
        $cartDisplay .= "<p>Number of items: ".$prodQuantity. "</p>";
        $cartDisplay .= "<p>Item Price: $".$prodPrice."</p>";
        $cartDisplay .= "<p>Total Price: $".$prodPrice * $prodQuantity."</p>";
        $cartDisplay .= "</div>";

        $totalPrice += $prodPrice * $prodQuantity;
      }
      $cartDisplay .= "<br>";
      $cartDisplay .= "<p>Cart Price: $".$totalPrice."</p>";
      $cartDisplay .= "</div>";
    }

      include '../view/cart.php';
    break;

    case 'newview':
      $prodId = filter_input(INPUT_GET, 'prodId', FILTER_VALIDATE_INT);
      $prodItem = getProdItemInfo($prodId);
      if(!$prodItem){
        $message = "<p>Sorry, details for this item could not be found.</p>";
      } else {
        $productDisplay = buildProductDisplay($prodItem);
      }
      include '../view/product-display.php';
      break;
  
    default:

      $itemList = buildItemsList($items);

      include '../view/product-management.php';
      break;
  }

?>