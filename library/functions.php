<?php

function writeNavDropdown($items) {
    $navList = '<div class="dropmenu-content">';
    foreach ($items as $item) {
        $navList .= "<a href='/items/?action=item&itemId=".urlencode($item['itemId'])."' title='View our $item[itemName] products'>$item[itemName]</a>";
    }
    $navList .= '</div>';

    return $navList;
}

function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
   }


function buildItemsList($items) {
    $itemList = '<select name="itemId" id="itemList">'; 
    $itemList .= "<option>Choose an Item</option>"; 
    foreach ($items as $item) { 
        $itemList .= "<option value='$item[itemId]'>$item[itemName]</option>"; 
    } 
    $itemList .= '</select>'; 
    return $itemList; 
}

function buildItemDisplay($products) {
    $dv = '<ul id="prod-display">';
    foreach ($products as $product) {
        $dv .= '<li class="prod-item">';
        $dv .= "<a href='/items/?action=newview&prodId=".urlencode($product['prodId'])."' title='View the details for our $product[prodName]'>";
        $dv .= "<img src='$product[prodImage]' alt='Image of $product[prodName] on soapangels.com'>";
        $dv .= "<h2>$product[prodName]</h2>";
        $dv .= "</a>";
        $dv .= "<span>$$product[prodPrice].00</span>";
        $dv .= '</li>';
    }
     $dv .= '</ul>';
    return $dv;
}

function buildProductDisplay($prodItem) {
    $productDetails = "<div class=\"main-page\">";
    $productDetails .= "<h1>$prodItem[prodName]</h1>";
    $productDetails .= "<img src='$prodItem[prodImage]' alt='Image of $prodItem[prodName] on soapangels.com' id=\"prod-image\">";
    $productDetails .= '<div id="product-info">';
    $productDetails .= '<div class="product-description">';
    $productDetails .= "<p><strong> $prodItem[prodName]</strong></p>";
    $productDetails .= "<p>$prodItem[prodDescription]</p>";
    $productDetails .= '<br>';
    $productDetails .= "<h3>Price: $$prodItem[prodPrice]</h3>";
    $productDetails .= "<form action='/purchases/index.php?action' method='post' id=\"form-style\">";
    $productDetails .= "<p><strong>How many would you like?</strong></p>";
    $productDetails .= "<input type='number' class='quantity' name='productQuantity' step='1' min='0' onkeypress='return event.charCode >= 48' id=\"bottom-span\">";
    $productDetails .= "<input type='hidden' name='productName' value='$prodItem[prodName]'>";
    $productDetails .= "<input type='hidden' name='prodId' value='$prodItem[prodId]'>";
    $productDetails .= "<input type='hidden' name='productPrice' value='$prodItem[prodPrice]' >";
    $productDetails .= '<br>';
    $productDetails .= "<input type='submit' name='submit' id='cartbtn' value='Add To Cart'>";
    $productDetails .= "<input type='hidden' name='action' value='addcart'>";
    $productDetails .= '</div>';
    $productDetails .= '</div>';
    return $productDetails;
}

function buildClientPurchases($purchases) {
    $clientPurchases = "<div>";
    foreach($purchases as $purchase) {
        $clientPurchases .= "<div class=\"purchase-record\">";
        $clientPurchases .= "<p>Name: ".$purchase['purchaseName']."</p>";
        $clientPurchases .= "<p>Number of items: ".$purchase['purchaseQuantity']. "</p>";
        $clientPurchases .= "<p>Item Price: $".$purchase['purchasePrice']."</p>";
        $clientPurchases .= "<p>Total Price: $".$purchase['purchasePrice'] * $purchase['purchaseQuantity']."</p>";
        $clientPurchases .= "<p>Purchase Date: ".substr($purchase['purchaseTime'], 0, 10)."</p>";
        $clientPurchases .= "</div>";
        $clientPurchases .= "<br>";
    }
    $clientPurchases .= "</div>";
    return $clientPurchases;
}

