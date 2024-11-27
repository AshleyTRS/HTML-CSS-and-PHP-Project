<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchCriteria = $_POST['searchCriteria'];
    $query = trim($_POST['searchQuery']);

     //DB connection
     require_once "dbh.inc.php";
     //model and control
     require_once "transaccion_model.inc.php";
     require_once "transaccion_contr.inc.php";

     $errors = [];
     if(empty($query)) {
         $errors["empty_input"] = "Llene el campo de busqueda.";
     }
     //determine which search criteria the user selected
     if($searchCriteria == "fecha") {
         if(isInvalidDateFormat($query)) {
             $errors["incorrect_date"] = "Datos no validos para la fecha. Debe ser en el formato YYYY-MM-DD.";
         }
     } else if($searchCriteria == "name") {
         if(nameExceedsLength($query)) {
             $errors["name_len"] = "El nombre esta muy largo.";
         }
     } else if($searchCriteria == "tipo") {
         if(isInvalidTransactionType($query)) {
             $errors["tipo_error"] = "Ese tipo de transacción no existe.";
         }
     }
     require_once 'config_session.inc.php';
    //errors array is not empty
    if($errors){
        $_SESSION["tranSearchErrors"] = $errors;
        header("Location: ../transacciones.php");// and then user is left at the main page
        die();
    }

    $saveData = [
        "criteria" => $searchCriteria,
        "query" => $query,
    ];
    $_SESSION["busquedaTran"] = $saveData; 

    if($searchCriteria == "name") {
        $result = searchClienteName($pdo, $query);
    } else if($searchCriteria == "tipo") {
        $result = searchTipoTran($pdo, $query);
    } else if($searchCriteria == "fecha") {
        $result = searchFechaTran($pdo, $query);
    }
    //evaluate what the result is
    if(!$result) {
        header("Location: ../transacciones.php?result=". $searchCriteria ."NOTfound");
    } else {
        header("Location: ../transacciones.php?result=found&criteria=".$searchCriteria);
    }
    die();

} else {
    header("Location: ../transacciones.php");
    die();
}