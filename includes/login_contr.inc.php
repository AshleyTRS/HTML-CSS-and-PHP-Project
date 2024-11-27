<?php

declare(strict_types=1);

function isUsernameWrong(bool|array $result) { //accepts a bool or an array
    if (!$result) { //if result is false
        return true; //username is wrong
    } else {
        return false; //username exists in the DB
    }
}

function isPasswordWrong(string $pwd, string $hashedPwd) { 
    if (!password_verify($pwd, $hashedPwd)) { //checks if provided password and hashed password DO NOT match
        return true; //password provided and pasword in DB do not match
    } else {
        return false; //passwords match
    }
}

function isInputEmpty($usuario, $pwd) {
    if(empty($usuario) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}