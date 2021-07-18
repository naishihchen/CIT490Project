<?php
if (!$_SESSION['loggedin'] == TRUE) {
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
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
            
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <div class="main-page">
                <div id="left-align">

			<h1>
                <?php echo $_SESSION['clientData']['clientFullname']; ?>
            </h1>

            <div id="user-info">
            
            <p>You are logged in.</p>
            <ul>
                <li>First name: <?php echo $_SESSION['clientData']['clientFullname']; ?></li>
                <li>Last name: <?php echo $_SESSION['clientData']['clientUsername']; ?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            </ul>

            <h2>Account Management</h2>
            <p>Use this link to update account information:</p>
            <a href="/accounts/index.php?action=accountUpdate">Update Account Information</a>
            
            <?php
                if ($_SESSION['clientData']['clientLevel'] > 1) {
                    echo "<h2 id=\"prod-manage-link\">Product Management</h2><p>Adding, updating and deleting privileges are for administrative use only. For access to product management, please <a href=\"/items/\">click here</a></p>";
                }
            ?>
            </div>

            <br>

            <div id="purchases-header">
                <h2>Your Purchases</h2>
                <hr>
			</div>
            
            <div id="purchases-display">
                <?php if(isset($clientPurchaseDisplay)){ echo $clientPurchaseDisplay; } ?>
            </div>
        </div>
        </div>

            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>