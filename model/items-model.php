<?php

//Items Model


function insertItem($itemName) {
    $db = soapangelsConnect();
    $sql = 'INSERT INTO items (itemName) VALUES (:itemName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':itemName', $itemName, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function insertProduct($prodName, $prodDescription, $prodImage, $prodPrice, $prodStock, $itemId) {
    $db = soapangelsConnect();
    $sql = 'INSERT INTO products (prodName, prodDescription, prodImage, prodPrice, prodStock, itemId) 
        VALUES (:prodName, :prodDescription, :prodImage, :prodPrice, :prodStock, :itemId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodName', $prodName, PDO::PARAM_STR);
    $stmt->bindValue(':prodDescription', $prodDescription, PDO::PARAM_STR);
    $stmt->bindValue(':prodImage', $prodImage, PDO::PARAM_STR);
    $stmt->bindValue(':prodPrice', $prodPrice, PDO::PARAM_STR);
    $stmt->bindValue(':prodStock', $prodStock, PDO::PARAM_INT);
    $stmt->bindValue(':itemId', $itemId, PDO::PARAM_INT);
    $stmt->execute();
     $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getProductByItem($itemId) {
    $db = soapangelsConnect();
    $sql = 'SELECT * FROM products WHERE itemId = :itemId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':itemId', $itemId, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}



// Get product information by prodId
function getProdItemInfo($prodId){
    $db = soapangelsConnect();
    $sql = 'SELECT * FROM products WHERE prodId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $prodInfo;
   }

   // Get product information by prodId
function getProdName($prodId){
    $db = soapangelsConnect();
    $sql = 'SELECT prodName FROM products WHERE prodId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $prodInfo;
   }

   // Update a product
	function updateProduct($prodName, $prodDescription, $prodImage, $prodPrice, $prodStock, $prodId) {
        $db = soapangelsConnect();
        $sql = 'UPDATE products SET prodName = :prodName, prodDescription = :prodDescription, prodImage = :prodImage, prodPrice = :prodPrice, prodStock = :prodStock WHERE prodId = :prodId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
        $stmt->bindValue(':prodName', $prodName, PDO::PARAM_STR);
        $stmt->bindValue(':prodDescription', $prodDescription, PDO::PARAM_STR);
        $stmt->bindValue(':prodImage', $prodImage, PDO::PARAM_STR);
        $stmt->bindValue(':prodPrice', $prodPrice, PDO::PARAM_STR);
        $stmt->bindValue(':prodStock', $prodStock, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
      }

      function deleteProduct($prodId) {
        $db = soapangelsConnect();
        $sql = 'DELETE FROM products WHERE prodId = :prodId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
       }

       function getProductsByItemName($itemName) {
        $db = soapangelssConnect();
        $sql = 'SELECT * FROM products WHERE itemId IN (SELECT itemId FROM items WHERE itemName = :itemName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':itemName', $itemName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $products;
       }

       // Get information for all products
function getProducts(){
	$db = phpmotorsConnect();
	$sql = 'SELECT prodId, prodName FROM products';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $prodInfo;
}
?>