<?php

declare(strict_types=1);

function is_input_empty(string $username, string $firstname, string $lastname, string $bdate, string $gender, string $num, string $email, string $pwd, string $repwd) {
    if (empty($username)||empty($firstname)||empty($lastname)||empty($bdate)||empty($gender)||empty($num)||empty($email)||empty($pwd)||empty($repwd))
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

function is_username_taken(object $pdo, string $username)
    {
        if(get_username($pdo, $username))
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

function pwd_dont_match(string $pwd, string $repwd){
    if ($pwd === $repwd) {
        return false;
    }else{
        return true;
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

function create_user(object $pdo, string $email, string $username, string $bdate, string $firstname, string $lastname, string $num, string $pwd, string $gender)
    {
       set_user($pdo, $email, $username, $bdate, $firstname, $lastname, $num, $pwd, $gender);
}