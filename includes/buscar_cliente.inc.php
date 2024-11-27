<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $searchCriteria = $_POST['searchCriteria'];
    $query = trim($_POST['searchQuery']);
     //DB connection
     require_once "dbh.inc.php";
     //model and control
     require_once "cliente_model.inc.php";
     require_once "cliente_contr.inc.php";

    //error handlers
    $errors = [];
    if(empty($query)) {
        $errors["empty_input"] = "Llene el campo de busqueda.";
    }
    //determine which search criteria the user selected
    if($searchCriteria == "id") {
        if(!empty($query) && idIncorrectDataType($query)) {
            $errors["incorrect_type_id"] = "Datos no validos para el ID.";
        } else {
            $query = (int) $query;
            if(!empty($query) && (idExceedsLength($query))){
            $errors["incorrect_type_id"] = "Datos no validos para el ID.";
            }
        }
    } else if($searchCriteria == "keywords") {
        if(nameExceedsLength($query)) {
            $errors["name_len"] = "El nombre esta muy largo.";
        }
    }
    //link to config file b/c it has a session started
    require_once 'config_session.inc.php';
    //errors array is not empty
    if($errors){
        $_SESSION["clienteSearchErrors"] = $errors;
        header("Location: ../clientes.php");// and then user is left at the main page
        die();
    }

    $saveData = [
        "criteria" => $searchCriteria,
        "query" => $query,
    ];
    $_SESSION["busquedaCliente"] = $saveData;
    // set session variables before any directing occurrs
    
    //if no errors then perform the sql query based on search criteria
    //$_SESSION['debug'] = "HOLA!";
    
    if($searchCriteria == "id") {
        $result = getClienteID($pdo, $query);
    } else if($searchCriteria == "keywords") {
        $result = searchClienteKeywords($pdo, $query);
    }
    //evaluate what the result is
    if(!$result) {
        header("Location: ../clientes.php?result=". $searchCriteria ."NOTfound");
    } else {
        header("Location: ../clientes.php?result=found&criteria=".$searchCriteria);
    }
    die();
} else {
    header("Location: ../clientes.php");
    die();
}