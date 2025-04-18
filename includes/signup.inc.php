<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["login"];
    $firstname = ucwords($_POST["firstname"]);
    $lastname = $_POST["lastname"];
    $bdate = $_POST["birth"];
    $gender = $_POST["gender"];
    $num = $_POST["num"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $repwd = $_POST["repassword"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_cntr.inc.php';

        $errors = [];

        if(is_input_empty($username, $firstname, $lastname, $bdate, $gender, $num, $email, $pwd, $repwd)){
            $errors["empty_input"] = "Fill in all fields!";
        }
        else{
            if (is_email_invalid($email)) {
                $errors["invalid_email"] = "Invalid email used!";
            }

            if (is_username_taken($pdo, $username)) {
                $errors["username_taken"] = "Username already taken!";
            }

            if (is_email_registered($pdo, $email)) {
                $errors["email_used"] = "Email already taken!";
            }

            if (pwd_dont_match($pwd, $repwd)) {
                $errors["password_dont_match"] = "Passwords don't match!";
            }

            if (invalid_number($num)) {
                $errors["invalid_number"] = "Invalid number!";
            }
            else if (is_number_registered($pdo, $num)) {
                $errors["number_used"] = "Number already taken!";
            }
        }

        require_once 'config.inc.php';

        if($errors){
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../signup.php?username=".$username."&firstname=".$firstname."&lastname=".$lastname."&birthdate=".$bdate."&gender=".$gender."&number=".$num."&email=".$email);
            die();
        };

        create_user($pdo, $email, $username, $bdate, $firstname, $lastname, $num, $pwd, $gender);

        header("Location: ../signup.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
        
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}else {
    header("Location: ../signup.php");
    die();
}