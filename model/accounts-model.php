<?php
//Accounts Model

//Site Registration Function
function regClient($clientFullname, $clientUsername, $clientEmail, $clientPassword) {
    //Database Connection
    $db = soapangelsConnect();

    //SQL statement
    $sql = 'INSERT INTO clients (clientFullname, clientUsername, clientEmail, clientPassword)
    VALUES (:clientFullname, :clientUsername, :clientEmail, :clientPassword)';

    //Prepare Statement
    $stmt = $db->prepare($sql);

    //Replace placeholders with variables
    $stmt->bindValue(':clientFullname', $clientFullname, PDO::PARAM_STR);
    $stmt->bindValue(':clientUsername', $clientUsername, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    //Execute statement
    $stmt->execute();

    //Verify results
    $rowsChanged = $stmt->rowCount();

    //Close connection
    $stmt->closeCursor();

    //Return rows changed
    return $rowsChanged;
}

//check for existing email address
function emailConfirmation($clientEmail) {
    // Create a connection object using the acme connection function
    $db = soapangelsConnect();   
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchEmail)){
     return 0;
    } else {
     return 1;
    }
   }

   // Get client data based on an email address
function getClient($clientEmail){
    $db = soapangelsConnect();
    $sql = 'SELECT clientId, clientFullname, clientUsername, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }

   //Update Account
function updateAccount($clientFullname, $clientUsername, $clientEmail, $clientId) {
    $db = soapangelsConnect();
    $sql = 'UPDATE clients SET clientFullname = :clientFullname, clientUsername = :clientUsername, '
            . 'clientEmail = :clientEmail WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientFullname', $clientFullname, PDO::PARAM_STR);
    $stmt->bindValue(':clientUsername', $clientUsername, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
     $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//Get updated data
function getClientUpdate($clientId){
 $db = soapangelsConnect();
 $sql = 'SELECT clientId, clientFullname, clientUsername, clientEmail, clientLevel, clientPassword 
         FROM clients
         WHERE clientId = :clientId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
 $stmt->execute();
 $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clientData;
}

//Update Password
function passUpdate($hashedPassword, $clientId) {
    $db = soapangelsConnect();
    $sql = 'UPDATE clients SET clientPassword = :hashedPassword WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->execute();
     $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

?>