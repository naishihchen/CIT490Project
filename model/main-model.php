<?php
//Main Soapangels Model

function getItems() {
    //Connection Object
    $db = soapangelsConnect();

    //SQL Statement
    $sql = 'SELECT * FROM items ORDER BY itemName ASC';

    //Prepare the statement
    $stmt = $db->prepare($sql);

    //Execute the statement
    $stmt->execute();

    //Fetch the data
    $items = $stmt->fetchAll();

    //Close database
    $stmt->closeCursor();

    //Return data
    return $items;
}

?>