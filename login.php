<?php
include_once 'includes/config.inc.php';
include_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
    <link href="styles/login-style.css" rel="stylesheet">
    <link rel="icon" href="images/s_logo.jpg">
</head>
<body>
    <h3>
    <?php
        output_username();
    ?>
    </h3>
    <div class="container">
        <h1 class="login">LOG IN</h1>
            <form class="form" method="post" action="includes/login.inc.php">
                <input type="text" name="login" id="login" placeholder="Username" size="25" maxlength="25">
                <input type="password" name="password" id="password" placeholder="Password" size="25" maxlength="25">
                <input type="submit" value="LOG IN" name="loginbtn" id="loginbtn">
                <p class="or">OR</p>
                <input type="button" value="SIGN UP" name="signup"  id="signup" onclick="location.href= 'signup.php'">
            </form>
            <?php
                check_login_errors();
            ?>
    </div>
</body>
</html>