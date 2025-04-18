<?php

declare(strict_types=1);

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

function edit_user(object $pdo, string $email, string $bdate, string $firstname, string $lastname, string $num, string $gender){
    $query = "UPDATE user_info SET first_name = :firstname, last_name = :lastname, email = :email, mobile_number = :num, gender = :gender, birth_date = :bdate WHERE id = :id;";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $_SESSION["user_id"]);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":num", $num);
    $stmt->bindParam(":gender", $gender);
    $stmt->bindParam(":bdate", $bdate);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}