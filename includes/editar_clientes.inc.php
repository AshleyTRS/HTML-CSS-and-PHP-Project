<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id_cliente = $_GET['id_cliente'];
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

        header("Location: ../editar_cliente.php?id_cliente=" . $_GET['id_cliente']);// and then user is left at the main page
        die(); //exit the script if there are errors
    }
    
    updateCliente($pdo, $primer_nom_clie, $apellido_p_clie, $apellido_m_clie, $movil_cliente, $fijo_cliente, $id_cliente);
    
    header("Location: ../editar_cliente.php?id_cliente=" . $_GET['id_cliente'] . "&status=success");// and then user is left at the main page
    unset($_GET['id_cliente']);
    unset($_GET['status']);
    die();
} else{
    header("Location: ../clientes.php");
    die();
}