<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $primer_nom_clie = $_POST["primer_nom_clie"];
    $apellido_p_clie = $_POST["apellido_p_clie"];
    $apellido_m_clie = $_POST["apellido_m_clie"];
    $movil_cliente = $_POST["movil_cliente"];
    $fijo_cliente = $_POST["fijo_cliente"]; //tel fijo can be empty

    //DB connection
    require_once "dbh.inc.php";
    //model and control
    require_once "cliente_model.inc.php";
    require_once "cliente_contr.inc.php";

    $errors = [];
    if(isInputEmpty($primer_nom_clie, $apellido_p_clie, $apellido_m_clie, $movil_cliente)){
        $errors["empty_input"] = "Llene todos los campos requeridos.";
    }
    if (findInvalidCharName($primer_nom_clie) || nameExceedsLength($primer_nom_clie)) {
        $errors["invalid_name"] = "El nombre es invalido."; 
    }
    if (findInvalidCharLast($apellido_p_clie) || lastNameExceedsLength($apellido_p_clie)) {
        $errors["invalid_lastN"] = "El apellido paterno es invalido.";
    }
    if(findInvalidCharMaiden($apellido_m_clie) || maidenNameExceedsLength($apellido_m_clie)){
        $errors["invalid_maidenN"] = "El apellido materno es invalido.";
    }
    if(invalidMobileNo($movil_cliente) || invalidLengthMobileNo($movil_cliente)){
        $errors["invalid_phoneNoM"] = "El teléfono móvil es invalido.";
    }
    if(invalidFixedNo($fijo_cliente) || invalidLengthFixedNo($fijo_cliente)){
        $errors["invalid_phoneNoF"] = "El teléfono fijo es invalido.";
    }
    //
    if(!(invalidMobileNo($movil_cliente) && invalidLengthMobileNo($movil_cliente))) {
        $movil_cliente = intval($movil_cliente);
        if(mobileNoExists($pdo, $movil_cliente)){
            $errors["phoneNoM_taken"] = "Ese teléfono móvil ya esta registrado.";
        }
    }
    if(!(invalidFixedNo($fijo_cliente) && invalidLengthFixedNo($fijo_cliente))) {
        $fijo_cliente = intval($fijo_cliente);
        if(!empty($fijo_cliente) && fixedNoExists($pdo, $fijo_cliente)){
            $errors["phoneNoF_taken"] = "Ese teléfono fijo ya esta registrado.";
        }
    }

    //link to config file b/c it has a session started
    require_once 'config_session.inc.php';

    //check whether or not the errors array is empty
    if($errors){ //if the errors arrays has alements, then it is assigned to the session global variable
        $_SESSION["cliente_errors"] = $errors;
        
        //associative array to store data user submitted and send it back to main page
        $signupData = [
            "name" => $primer_nom_clie,
            "lastName" => $apellido_p_clie,
            "maidenName" => $apellido_m_clie,
            "movil" => $movil_cliente,
            "fijo" => $fijo_cliente
        ];

        //assign array to a session global variable
        $_SESSION["cliente_data"] = $signupData;

        header("Location: ../clientes.php");// and then user is left at the main page
        die(); //exit the script if there are errors
    }
    //cast string phone numbers to int phone numbers before inserting into DB
    $strippedData = stripSpaces($primer_nom_clie, $apellido_p_clie, $apellido_m_clie);
    createClient($pdo, $strippedData["nombre"], $strippedData["apellidoP"], $strippedData["apellidoM"], $movil_cliente, $fijo_cliente);
    unset($_SESSION["cliente_data"]); //if there are no more errors and user is added to DB then unset signup_data
    header("Location: ../clientes.php?status=success");// and then user is left at the main page
    die();
} else{
    header("Location: ../clientes.php");
    die();
}