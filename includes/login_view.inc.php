<?php

declare(strict_types=1);

function output_username(){
    if(isset($_SESSION["user_id"])){
        //echo 'You are logged in as ' . $_SESSION["user_username"];
        header("Location: profile.php");
    /*}else{
        echo 'You are not logged in';*/
    }
}

function check_login_errors(){
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        foreach ($errors as $error) {
            echo '<p class="form-error" ">'. $error . '</p>';
        }
        echo '<script>document.querySelector("#login").setAttribute("value", "' .$_GET['username']. '")</script>';

        echo '<style>#login{border:3px solid red}#password{border:3px solid red}</style>';

        unset($_SESSION["errors_login"]);
    }else if (isset($_GET['login']) && $_GET['login'] === "success") {
        echo '<p class="form-error">Login Success!</p>';
        header("Location: profile.php");
    }
}