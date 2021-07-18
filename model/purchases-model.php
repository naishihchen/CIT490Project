<?php
//Insert review
function insertPurchase($clientId, $prodId, $purchaseQuantity, $purchasePrice, $purchaseName) {
     $db = soapangelsConnect();
     $sql = 'INSERT INTO purchases (clientId, prodId, purchaseQuantity, purchasePrice, purchaseName) VALUES (:clientId, :prodId, :purchaseQuantity, :purchasePrice, :purchaseName)';
     $stmt = $db->prepare($sql);
     $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
     $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
     $stmt->bindValue(':purchaseQuantity', $purchaseQuantity, PDO::PARAM_INT);
     $stmt->bindValue(':purchasePrice', $purchasePrice, PDO::PARAM_FLOAT);
     $stmt->bindValue(':purchaseName', $purchaseName, PDO::PARAM_STR);
     $stmt->execute();
     $rowsChanged = $stmt->rowCount();
     $stmt->closeCursor();
    return $rowsChanged;
}

function getPurchaseByItem($prodId) {
    $db = soapangelsConnect();
    $sql = 'SELECT * FROM purchases WHERE prodId = :prodId ORDER BY purchaseTime DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

function getPurchasesByAccount($clientId) {
    $db = soapangelsConnect();
    $sql = 'SELECT * FROM purchases WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

function getPurchase($purchaseId) {
    $db = soapangelsConnect();
    $sql = 'SELECT * FROM purchases WHERE purchaseId = :purchaseId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':purchaseId', $purchaseId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

?>