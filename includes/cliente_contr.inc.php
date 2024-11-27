<?php
declare(strict_types=1);


function isInputEmpty(string $primer_nom_clie, string $apellido_p_clie, string $apellido_m_clie, string $movil_cliente) {
    return (empty($primer_nom_clie) || empty($apellido_p_clie) || empty($apellido_m_clie) || empty($movil_cliente));
}
function findInvalidCharName(string $nombre) { //dont forget letters with accents
    if((!preg_match('/^[\p{L} ]+$/u', $nombre)) && (strlen($nombre) != 0)){ //preg_match() is used to perform a regular expression match
        return true;                            //[] => character class definition
                                                /*p{L} => matches any kind of letter character from any language
                                                Space after the p{L} => matches spaces
                                                + => Quantifier — matches between one to unlimited times (greedy)
                                                /u => Unicode modifier.*/
    }
    return false;
}
function nameExceedsLength(string $primer_nom_clie) {
    return (strlen($primer_nom_clie) > 55);
}
function findInvalidCharLast(string $apellidoP) {
    if((!preg_match('/^[\p{L} ]+$/u', $apellidoP)) && (strlen($apellidoP) != 0)) return true;
    return false;
}

function findInvalidCharMaiden(string $apellidoM) {
    if((!preg_match('/^[\p{L} ]+$/u', $apellidoM)) && (strlen($apellidoM) != 0)) return true;
    return false;
}
function lastNameExceedsLength(string $apellidoP){
    if(strlen($apellidoP) > 55) {
        return true;
    }
    return false;
}
function maidenNameExceedsLength(string $apellidoM){
    if(strlen($apellidoM) > 55) {
        return true;
    }
    return false;
}
function stripSpaces(string $nombre, string $apellidoP, string $apellidoM) {
    $nombre = trim($nombre);
    $apellidoP = trim($apellidoP);
    $apellidoM = trim($apellidoM);
    $dataArray = [
        "nombre" => $nombre,
        "apellidoP" => $apellidoP,
        "apellidoM" => $apellidoM
    ];
    return $dataArray;
}

function invalidMobileNo(string $movil_cliente) {
    if(!empty($movil_cliente) && (!preg_match('/^[0-9]{10}$/', $movil_cliente) || strlen($movil_cliente) !=10)) {
        return true;
    }
    return false;
}
function invalidFixedNo(string $fijo_cliente) {
    if(!empty($fijo_cliente) && (!preg_match('/^[0-9]{10}$/', $fijo_cliente) || strlen($fijo_cliente) !=10)) {
        return true;
    }
    return false;
}
function invalidLengthMobileNo(string $movil_cliente) {
    if(strlen($movil_cliente) > 10){
        return true;
    }
    else return false;
}
function invalidLengthFixedNo(string $fijo_cliente) {
    if(strlen($fijo_cliente) > 10){
        return true;
    }
    else return false;
}
function createClient(object $pdo, string $primer_nom_clie, string $apellido_p_clie, string $apellido_m_clie, int $movil_cliente, int $fijo_cliente) {
    registerClient($pdo, $primer_nom_clie, $apellido_p_clie, $apellido_m_clie, $movil_cliente, $fijo_cliente);
}

function mobileNoExists(object $pdo, int $movil_cliente){
    getMobileNo($pdo, $movil_cliente);
}
function fixedNoExists(object $pdo, int $fijo_cliente) {
    getFixedNo($pdo, $fijo_cliente);
}
function idIncorrectDataType(int | string $id_producto) {
    if(!filter_var($id_producto, FILTER_VALIDATE_INT)){ //!empty($id_producto) && 
        return true;
    } else {
        return false;
    }
}
function idExceedsLength(int $id_producto) {
    if($id_producto < 1 || $id_producto > 2147483647) {
        return true; //the submitted data is not numeric
    } else return false;
}