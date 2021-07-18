<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Item</title>
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
            <h1>Add Item</h1>
            <div id="form">
                <div>
                    <?php
                        if (isset($message)) {
                        echo $message;
                        }
                    ?>
                </div>
                <form method="post" action="/items/index.php">
                    <label for="itemName">New Item Name: </label>
                    <input type="text" name="itemName" id="itemName" required>
                    <input type="submit" value="Create">
                
                    <input type="hidden" name="action" value="new-item">
                </form>
            </div>
        </div>
    </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>