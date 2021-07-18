<!DOCTYPE html>
<html lang="en">
<head>
    <title>Please Login</title>
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
            <h1>Login</h1>

            <?php
          
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>

            <form action="/accounts/index.php" method="post" id="form-style">
                <label for="email">Email address: <input type="email" name="clientEmail" id="email" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>></label>
                <span id="top-span">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
                <label for="password">Password: 
                <input type="password" id="password" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ></label>
                <input id="submit" type="submit" value="Login">
                <input type="hidden" name="action" value="Logging">
            </form>
            
                <div id="register">
            <p>Not Registered? Click Here!</p>
            <a href="/accounts/index.php?action=register">Register</a>
                </div>
        </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>