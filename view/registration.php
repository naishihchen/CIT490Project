<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Your Account</title>
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
            <h1>Registration</h1>
            <p>Please enter your info in order to register for a Soap Angels account</p>
            <div >

            <?php
          
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/accounts/index.php" method="post" id="form-style">
                    <label for="fullname">Full Name: <input type="text" name="clientFullname" id="fname" required <?php if(isset($clientFullname)){echo "value='$clientFullname'";}  ?>></label>
                    <label for="username">User Name: <input type="text" name="clientUsername" id="uname" required <?php if(isset($clientUsername)){echo "value='$clientUsername'";}  ?>></label>
                    <label for="email">Email address: <input type="email" name="clientEmail" id="email" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>></label>
                    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
                    <label for="password">Password: 
                    <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
                <input type="submit" name="submit" id="regbtn" value="Register">

                <input type="hidden" name="action" value="registration">
            </form>
            </div>
        </div>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
		</main>
	</body>
</html>