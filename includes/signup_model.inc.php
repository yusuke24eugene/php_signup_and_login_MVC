<?php

declare(strict_types=1);

function get_username(object $pdo, string $username){
    $query = "SELECT username FROM user_info WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email){
    $query = "SELECT email FROM user_info WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_number(object $pdo, string $num){
    $query = "SELECT mobile_number FROM user_info WHERE mobile_number = :num;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":num", $num);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $email, string $username, string $bdate, string $firstname, string $lastname, string $num, string $pwd, string $gender){
    $query = "INSERT INTO user_info (username, first_name, last_name, birth_date, email, mobile_number, pwd, gender) VALUES (:username, :firstname, :lastname, :bdate, :email, :num, :pwd, :gender)";
    
    $options = ['cost' => 12];

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":num", $num);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":gender", $gender);
    $stmt->bindParam(":bdate", $bdate);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}