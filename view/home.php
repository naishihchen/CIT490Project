<!DOCTYPE html>
<html lang="en">
<head>
    <title>Soap Angels: Heaven Scent</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css" media="screen">
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
            <h1>Soap Angels ~ Heaven Scent</h1>
            <div class="center-content">
                <div id="home-images">
                    <!--<?php //if(isset($_SESSION['cart'][0])){ foreach ($_SESSION['cart'] as $cartitem) {echo var_dump($cartitem); }} ?>-->
                        <h3><strong>The moisturizing magic of Soap Angels works miracles!</strong></h3>
                    <img src="images/site/home-page-soap.png" alt="soap-pic" id="soap-pic">
                </div>
                <div id="details">
                    <h3>Soaps for every season!</h3>
                        <div id="upgrades-flexbox">
                            <div class="upgrade row-1">
                                <img src="images/soaps/honey-soap.png" alt="honey-soap">
                                <p>Soaps</p>
                            </div>
                            <div class="upgrade row-1">
                                <img src="images/soaps/strawberry-lip-balm.png" alt="strawberry-lip-balm">
                                <p href="#">Balms</p>
                            </div>
                            <div class="upgrade row-2">
                                <img src="images/soaps/lavender-lotion.png" alt="lavender-lotion">
                                <p href="#">Lotions</p>
                            </div>
                            <div class="upgrade row-2">
                                <img src="images/soaps/lavender-scrub.png" alt="lavender-scrub">
                                <p href="#">Scrubs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>