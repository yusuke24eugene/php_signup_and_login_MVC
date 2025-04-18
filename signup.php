<?php
require_once 'includes/config.inc.php';
require_once 'includes/signup_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link href="styles/signup-style.css" rel="stylesheet">
    <link rel="icon" href="images/s_logo.jpg">
</head>
<body>
    <div class="container">
        <a  id="click" href="#bottom" style="display: block; height: 0;"></a>
        <h1 class="login">SIGN UP</h1>
            <form action="includes/signup.inc.php" class="form" method="post">
                <input type="text" name="firstname" id="firstname" placeholder="First Name" size="25" maxlength="25">
                <input type="text" name="lastname" id="lastname" placeholder="Last Name" size="25" maxlength="25">
                <div class="bdate">
                    <label for="birth" class="blabel">Birth date:</label>
                    <input type="date" name="birth" id="birth" value="1990-01-01">
                </div>
                <div class="gender">
                    <span class="genlabel">Gender:</span>
                    <input type="radio" name="gender" id="male" value="male">
                    <label for="male" class="malelabel">Male</label>
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female" class="femalelabel">Female</label>
                    <input type="radio" name="gender" value="others" id="others" checked>
                    <label for="others" class="otherslabel">others</label>
                </div>
                <input type="tel" name="num" id="num" placeholder="Mobile number" size="25">
                <input type="text" name="email" id="email" placeholder="Email address" size="25">
                <input type="text" name="login" id="login" placeholder="Username" size="25" maxlength="25">
                <input type="password" name="password" id="password" placeholder="Password" size="25" maxlength="25">
                <input type="password" name="repassword" id="repassword" placeholder="Confirm Password" size="25" maxlength="25">
                <button  id="signup">SUBMIT</button>
                <p class="or">OR</p>
                <input type="button" value="LOG IN" name="loginbtn" id="loginbtn" onclick="location.href = 'login.php'">           
                <?php
                    check_signup_errors();
                ?>
            </form>
            <div id="bottom" style="display: block; height: 0;"></div>
    </div>
</body>
</html>