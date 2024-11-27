<?php
declare(strict_types=1);

function isInputEmpty(string $nombre, string $calle, int | string $no, string $colonia, string $cuidad, string $estado, int | string $cp, string $des, int | string $telefono, string $email) {
    return (empty($nombre) || empty($calle) || empty($no) || empty($colonia) || empty($cuidad) || empty($estado) || empty($cp) || empty($des) || empty($telefono) || empty($email));
}
function idIncorrectDataType(int | string $id) {
    if((!empty($id) && !filter_var($id, FILTER_VALIDATE_INT)) || $id <= 0){
        return true; //the submitted data is not numeric
    } else {
        return false;
    }
}
function foundDistId(object $pdo, int $id) {
    return getDistId($pdo, $id);
}

function findInvalidCharName(string $nombre) { //dont forget letters with accents
    if((!preg_match('/^[\p{L}\d ]+$/u', $nombre)) && (strlen($nombre) != 0)){ //preg_match() is used to perform a regular expression match
        return true;                            //[] => character class definition
                                                /*p{L} => matches any kind of letter character from any language
                                                Space after the p{L} => matches spaces
                                                + => Quantifier — matches between one to unlimited times (greedy)
                                                /u => Unicode modifier.*/
    }
    return false;
}
function findInvalidCharCalle(string $calle) {
    if((!preg_match('/^[\p{L}. ]+$/u', $calle)) && (strlen($calle) != 0)) return true;
    return false;
}
function findInvalidCharColonia(string $colonia) {
    if((!preg_match('/^[\p{L} ]+$/u', $colonia)) && (strlen($colonia) != 0)) return true;
    return false;
}
function findInvalidCharCuidad(string $cuidad) {
    if((!preg_match('/^[\p{L} ]+$/u', $cuidad)) && (strlen($cuidad) != 0)) return true;
    return false;
}
function findInvalidCharEstado(string $estado) {
    if((!preg_match('/^[\p{L} ]+$/u', $estado)) && (strlen($estado) != 0)) return true;
    return false;
}

//length of data
function idExceedsLength(int $id) {
    if($id < 1 || $id > 2147483647) {
        return true; //the submitted data is not numeric
    } else return false;
}
function nameExceedsLength(string $nombre) {
    return (strlen($nombre) > 59);
}
function coloniaExceedsLength(string $colonia) {
    return (strlen($colonia) > 29);
}
function calleExceedsLength(string $calle) {
    return (strlen($calle) > 29);
}
function cuidadExceedsLength(string $cuidad) {
    return (strlen($cuidad) > 29);
}
function estadoExceedsLength(string $cuidad) {
    return (strlen($cuidad) > 19);
}

function emailExceedsLength(string $email) {
    if(strlen($email) > 95) {
        return true;
    }
    return false;
}

//validate numeric data
function invalidBuildingNo(int | string $no) {
    if (ctype_digit($no) && !($no < 1 || $no > 2147483647)) { //if contains only digits, and is within ranges
        return false; //no error caught
    } else {
        return true;
    }
}

function invalidAreaCode(string | int $cp) {
    if(!filter_var($cp, FILTER_VALIDATE_INT) || ($cp < 1 || $cp > 2147483647)){
        return true;
    } else {
        return false;
    }
}

function invalidTelephone(int | string $telefono) {
    if(!filter_var($telefono, FILTER_VALIDATE_INT) || ($telefono < 1 || $telefono > 2147483647)){
        return true;
    } else {
        return false;
    }
}

function telephoneInvalidLength(int | string $telefono){
    $len =strlen(strval($telefono));
    if($len != 10){
        return true;
    }
    return false;
}

/*
function that checks whether the email provided by user is invalid
*/
function isEmailInvalid(string $email) {
    $email = trim($email);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)){
        return true;
    } else {
        return false;
    }
}

function isEmailRegistered(object $pdo, string $email){
    if(getEmail($pdo, $email)){
        return true; //email is taken
    } else{
        return false; //email is not taken 
    }
}

function deleteAllTransaction(object $pdo, int $idProducto) {
    $count = countProductsOrdered($pdo, $idProducto);
    if($count["num_products"] == 1) return true;
    else return false;
}