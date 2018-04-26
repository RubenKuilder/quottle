<?php
    session_start();

    if ($_SESSION['id'] != "") {
        header('location:home.php');
    
        exit();
    }

    $configs = include('config.php');
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Quottle</title>
	<meta name="Author" content="Ruben Kuilder"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
	<link rel="stylesheet" type="text/css" href="assets/style/main.css">
    <script src="assets/script/main.js"></script>
</head>
<body>
    
    <div class="topbar login">
        <img class="icon-left" src="assets/images/icon-left.svg" />
        <img class="logo" src="assets/images/logo.png" />
        <img class="icon-right" src="assets/images/icon-right.svg" />
    </div>
    
    <div class="page-container">
        <div class="login-page">
            <div class="wrapper">
                <h1 class="welcome">Hi there, <br /> Welcome back!</h1>

                <div class="form-wrapper">
                    <form action="login.php" method="post">
                        <input type="text" name="login-email" placeholder="Email" required>
                        <input type="password" name="login-pass" placeholder="Password" required>
                        <input type="submit" name="submit" value="sign in">
                        <p class="forgot-pw">Forgot password?</p>
                    </form>
                </div>

                <p class="create-one">Don't have an account? <span class="highlight show-register">Create one</span></p>
            </div>
        </div>

        <div class="registration-page">
            <div class="wrapper">
                <h1 class="welcome">Account creation</h1>

                <div class="form-wrapper">
                    <form action="register.php" method="post">
                        <input type="text" name="email" placeholder="Email">
                        <input type="text" name="name" placeholder="First- and lastname">
                        <input type="password" name="pass" placeholder="Password">
                        <input type="password" placeholder="Password verification">
                        <input type="submit" value="Create account">
                    </form>
                </div>

                <p class="tclink">By signing up you indicate that you have read and agreed to the <span class="bold">Terms and Conditions</span></p>
            </div>
        </div>
    </div>

</body>
</html>