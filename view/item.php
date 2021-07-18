<!DOCTYPE html>
<html lang="en">
<head>
	<title>Store | Soap Angels.</title>
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
			<h1>Store</h1>
            
            <?php if(isset($message)){
                echo $message; } 
            ?>
            
            <?php if(isset($itemDisplay)){ 
                echo $itemDisplay; 
            } ?>
        </div>
    </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>