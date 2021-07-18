<?php

//Session
if(!isset($_SESSION)) {
  session_start();
}
$_SESSION['created'] = TRUE;

if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = FALSE;
}
$_COOKIE['created'] = TRUE;

if (!isset( $_SESSION['cart'] )){
      $_SESSION['cart'] = [];
}

//Database connection file file
require_once 'library/connections.php';
require_once 'library/functions.php';

//PHP Motors Model
require_once 'model/main-model.php';

$items = getItems();

// var_dump($items);
//  	exit;

//new navlist dropdown!
$navList = writeNavDropdown($items);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 //check for cookies
 if(isset($_COOKIE['fullname'])) {
   $cookieFullname = filter_input(INPUT_COOKIE, 'fullname', FILTER_SANITIZE_STRING);
 }

 switch ($action){
 case 'charity':
  include 'view/charity.php';
  break;
  case 'contact-us':
  include 'view/contact-us.php';
  break;
  case 'about-us':
  include 'view/about-us.php';
  break;
 default:
  include 'view/home.php';
}

?>