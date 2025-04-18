<?php

declare(strict_types=1);

function is_input_empty(string $firstname, string $lastname, string $bdate, string $gender, string $num, string $email, string $pwd) {
    if (empty($firstname)||empty($lastname)||empty($bdate)||empty($gender)||empty($num)||empty($email)||empty($pwd))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_email_invalid(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return true;
    }
    else
    {
        return false;
    }
} 

function is_email_registered(object $pdo, string $email)
    {
        if(get_email($pdo, $email))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function is_number_registered(object $pdo, string $num)
{
    if(get_number($pdo, $num))
    {
        return true;
    }
    else
    {
        return false;
    }
}


function invalid_number(string $num){
    $length = strlen($num);
    $starts_with_zero = str_starts_with($num, '0');
    if ($length === 11 && $starts_with_zero && is_numeric($num)) {
        return false;
    }else{
        return true;
    }
}

function is_password_wrong(string $pwd, string $hashedPwd){
    if (!password_verify($pwd, $hashedPwd)) {
        return true;
    }else {
        return false;
    }
}

function edit_user_info(object $pdo, string $email, string $bdate, string $firstname, string $lastname, string $num, string $gender)
    {
       edit_user($pdo, $email, $bdate, $firstname, $lastname, $num, $gender);
}