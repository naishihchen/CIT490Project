<?php

/* Proxy connection to site database */

function soapangelsConnect() {
    $server = 'localhost';
    $dbname = 'soapangels';
    $username = 'siteClient';
    $password = 'RRms-PvZ0Z98tWr8';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try{
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        header('Location: /views/500.php');
    }
}

//soapangelsConnect();

?>