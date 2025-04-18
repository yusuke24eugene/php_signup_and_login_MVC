<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $bdate = $_POST["birth"];
    $gender = $_POST["gender"];
    $num = $_POST["num"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    try {

        require_once 'dbh.inc.php';
        require_once 'edit_model.inc.php';
        require_once 'edit_cntr.inc.php';

        $errors = [];

        if(is_input_empty($firstname, $lastname, $bdate, $gender, $num, $email, $pwd)){
            $errors["empty_input"] = "Fill in all fields!";
        }
        else{
            if (is_email_invalid($email)) {
                $errors["invalid_email"] = "Invalid email used!";
            }
    
            if (invalid_number($num)) {
                $errors["invalid_number"] = "Invalid number!";
            }

            require_once 'config.inc.php';
            
            $id = $_SESSION["user_id"];
            $query = "SELECT * FROM user_info WHERE id = :id;";
    
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();        

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(is_password_wrong($pwd, $result["pwd"])){
                $errors["password_incorrect"] = "Incorrect Password!";
            }

            if($email !== $result["email"]){
                if (is_email_registered($pdo, $email)) {
                    $errors["email_used"] = "Email already taken!";
                }
            }

            if($num !== $result["mobile_number"]){
                if (is_number_registered($pdo, $num)) {
                    $errors["number_used"] = "Mobile number already taken!";
                }
            }
        }

        require_once 'config.inc.php';

        if($errors){
            $_SESSION["errors_edit"] = $errors;
            header("Location: ../edit.php?&firstname=".$firstname."&lastname=".$lastname."&birthdate=".$bdate."&gender=".$gender."&number=".$num."&email=".$email);
            die();
        }

        edit_user_info($pdo, $email, $bdate, $firstname, $lastname, $num, $gender);

        header("Location: ../edit.php?edit=success");

        $pdo = null;
        $stmt = null;

        die();
        
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}else {
    header("Location: ../edit.php");
    die();
}