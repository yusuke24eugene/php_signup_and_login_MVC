<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["login"];
    $pwd = $_POST["password"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_cntr.inc.php';

        $errors = [];

        if(is_input_empty($username,$pwd)){
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if(is_username_wrong($result) && !is_input_empty($username, $pwd)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        if(!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"]) && !is_input_empty($username,$pwd)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once 'config.inc.php';

        if($errors){
            $_SESSION["errors_login"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            header("Location: ../login.php?username=" .$username);
        }
        else{
            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["id"];
            session_id($sessionId);

            $_SESSION["user_id"] = $result["id"];
            $_SESSION["user_username"] = htmlspecialchars($result["username"]);

            $_SESSION["last_regeneration"] = time();

            header("Location: ../login.php?login=success");
            $pdo = null;
            $stmt = null;
            die();
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}else {
    header("Location: ../login.php");
    die();
}