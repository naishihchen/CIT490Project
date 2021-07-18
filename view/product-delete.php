<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php if(isset($prodInfo['prodName'])){ 
	 echo "Delete $prodInfo[prodName]";} 
	elseif(isset($prodName)) { 
		echo "Modify $prodName"; }?> | Soap Angels</title>
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

            <h1><?php if(isset($prodInfo['prodName'])){ 
	            echo "Delete $prodInfo[prodName]";} 
                elseif(isset($prodName)) { 
	                echo "Modify $prodName"; }?></h1>
            <div id="form">
            <div>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
            </div>
            <p>Confirm Product Deletion. The delete is permanent.</p>
            <form method="post" action="/items/index.php" id="form-style">
                <label for="prodName">Product Name: 
                <input type="text" name="prodName" id="prodName" readonly <?php
if(isset($prodInfo['prodName'])) {echo "value='$prodInfo[prodName]'"; }?>> </label>
                <label for="prodDescription">Product Description: 
                <textarea name="prodDescription" id="prodDescription" readonly><?php
if(isset($prodInfo['prodDescription'])) {echo "$prodInfo[prodDescription]"; }?></textarea> </label>
                <input type="submit" name="submit" value="Delete Product" id="top-span">
                
                <input type="hidden" name="action" value="deleteProduct">
                <input type="hidden" name="prodId" value="<?php if(isset($prodInfo['prodId'])){
echo $prodInfo['prodId'];} ?>">
            </form>
          </div>
      </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>