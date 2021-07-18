<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /');
 exit;
}
?>
<?php
$itemList = '<select name="itemId" id="itemList">';
$itemList .= "<option>Choose An Item</option>";
foreach ($items as $item) {
    $itemList .= "<option value='$item[itemId]'";
    if (isset($itemId)) {
        if ($item['itemId'] === $itemId) {
            $itemList .= " selected";
        } 
    }
    
    $itemList .= ">$item[itemName]</option>";
}
$itemList .= '</select>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css" media="screen">
    <link href="https://fonts.googleapis.com/css2?family=Martel+Sans&display=swap" rel="stylesheet"> 
    <script src="/js/time.js"></script>
</head>
    <body onload="getTime()">
        <main>
            <header>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
            </header>
            <nav>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/navigation.php'; ?>
            </nav>
            <div class="main-page">
            <h1>Add Product</h1>
            <div id="form">
            <div>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
            </div>
            <form method="post" action="/items/index.php" id="form-style">
            <label>Item Type: 
                <?php echo $itemList; ?></label>
                <label for="prodName">Product Name: 
                <input type="text" name="prodName" id="prodName" required <?php if(isset($prodName)){echo "value='$prodName'";}  ?>></label>
                <label for="prodDescription">Product Description: 
                <textarea name="prodDescription" id="prodDescription"><?php if(isset($prodDescription)){echo "$prodDescription";}  ?></textarea></label>
                <label for="prodImage">Product Image: 
                <input type="text" name="prodImage" id="prodImage" value="../images/no-image.png" required <?php if(isset($prodImage)){echo "value='$prodImage'";}  ?>></label>
                <label for="prodPrice">Product Price: 
                <input type="number" step="0.01" name="prodPrice" id="prodPrice" required <?php if(isset($prodPrice)){echo "value='$prodPrice'";}  ?>></label>
                <label for="prodStock">Product Stock: 
                <input type="number" name="prodStock" id="prodStock" required <?php if(isset($prodStock)){echo "value='$prodStock'";}  ?>></label>
                <input type="submit" value="Create">
                
                <input type="hidden" name="action" value="new-product">
            </form>
          </div>
      </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>