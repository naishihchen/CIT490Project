<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /');
 exit;
}

if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Manage Products</title>
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
                <div id="left-align">
                	<h1>Product Management</h1>
            <div id="productManagement">
                <a href="/items/index.php?action=add-product"><p>Click here to add a product</p></a>
				<a href="/items/index.php?action=add-item"><p>Click here to add an item</p></a>
				<br>
				

				<?php
					if (isset($message)) { 
 						echo $message; 
					}

					if (isset($itemList)) { 
 						echo '<h2>Products By Item</h2>'; 
 						echo '<p>Choose an item to see those products</p>'; 
 						echo $itemList; 
					}
				?>
				<noscript>
					<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
				</noscript>
				<table id="productDisplay"></table>
            </div>
        </div>
    </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
		<script src="../js/inventory.js"></script>
	</body>
</html>
<?php unset($_SESSION['message']); ?>