<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shopping Cart | Soap Angels</title>
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
			<h1>Your Cart</h1>

            <?php 
                if(isset($cartDisplay)) { 
                    echo $cartDisplay;
                } else {
                    echo "<h2>You don't have anything in your cart yet!</h2>";
                }
            ?>


        </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>