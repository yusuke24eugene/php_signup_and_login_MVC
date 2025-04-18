<?php

declare(strict_types=1);

function check_edit_errors(){
    if (isset($_SESSION["errors_edit"])) {
        $errors = $_SESSION["errors_edit"];

        foreach ($errors as $error) {
            echo '<p class = "form-error">' . $error . '</p>';
        }

        echo '<script>document.querySelector("#firstname").setAttribute("value", "' .$_GET['firstname']. '")</script>';
        echo '<script>document.querySelector("#lastname").setAttribute("value", "' .$_GET['lastname']. '")</script>';
        echo '<script>document.querySelector("#birth").setAttribute("value", "' .$_GET['birthdate']. '")</script>';
        echo '<script>document.querySelector("#num").setAttribute("value", "' .$_GET['number']. '")</script>';
        echo '<script>document.querySelector("#email").setAttribute("value", "' .$_GET['email']. '")</script>';
        if($_GET['gender'] === 'male'){
            echo '<script>document.querySelector("#male").setAttribute("checked", "true")</script>';
            echo '<script>document.querySelector("#male").setAttribute("checked", "false")</script>';
            echo '<script>document.querySelector("#male").setAttribute("checked", "false")</script>';
        }
        else if($_GET['gender'] === 'female'){
            echo '<script>document.querySelector("#male").setAttribute("checked", "false")</script>';
            echo '<script>document.querySelector("#male").setAttribute("checked", "true")</script>';
            echo '<script>document.querySelector("#male").setAttribute("checked", "false")</script>';
        }
        else if($_GET['gender'] === 'others'){
            echo '<script>document.querySelector("#male").setAttribute("checked", "false")</script>';
            echo '<script>document.querySelector("#male").setAttribute("checked", "false")</script>';
            echo '<script>document.querySelector("#male").setAttribute("checked", "true")</script>';
        }

        if(isset($errors["invalid_email"]) or isset($errors["email_used"])){
            echo '<style>#email{border:3px solid red}</style>';
        }

        if(isset($errors["invalid_number"]) or isset($errors["number_used"])){
            echo '<style>#num{border:3px solid red}</style>';
        }

        if(isset($errors["password_incorrect"])){
            echo '<style>#password{border:3px solid red}</style>';
        }

        if(isset($errors["empty_input"])){
            if($_GET['firstname'] === ''){
                echo '<style>#firstname{border:3px solid red}</style>';
            }
            if($_GET['lastname'] === ''){
                echo '<style>#lastname{border:3px solid red}</style>';
            }
            if($_GET['birthdate'] === ''){
                echo '<style>#birth{border:3px solid red}</style>';
            }
            if($_GET['number'] === ''){
                echo '<style>#num{border:3px solid red}</style>';
            }
            if($_GET['email'] === ''){
                echo '<style>#email{border:3px solid red}</style>';
            }
            echo '<style>#password{border:3px solid red}}</style>';
        }

        unset($_SESSION["errors_edit"]);

    }elseif (isset($_GET["edit"]) && $_GET["edit"] === "success") {
        echo '<p class = "form-success">Edit success!</p>';
        header("Location: profile.php");
    }
}