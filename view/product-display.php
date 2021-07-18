<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $prodItem["prodName"]; ?> products | Soap Angels.</title>
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
            
            <?php if(isset($message)){
                echo $message; } 
            ?>

			<div id="itemDisplay">

            
            <?php if(isset($productDisplay)){ 
                echo $productDisplay; 
			} ?>
			
			</div>

			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
		<footer>
		</footer>
	</body>
</html>