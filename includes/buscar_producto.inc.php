<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $searchCriteria = $_POST['searchCriteria'];
    $query = trim($_POST['searchQuery']);

     //DB connection
     require_once "dbh.inc.php";
     //model and control
     require_once "producto_model.inc.php";
     require_once "producto_contr.inc.php";

    //error handlers
    $errors = [];
    if(empty($query)) {
        $errors["empty_input"] = "Llene el campo de busqueda.";
    }
    //determine which search criteria the user selected
    if($searchCriteria == "id") {
        if(idIncorrectDataType($query) && !empty($query)) {
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
    } else if($searchCriteria == "category") {
        if(categoryExceedsLength($query)) {
            $errors["category_len"] = "El nombre de la categoria esta muy largo.";
        }
    }
    //link to config file b/c it has a session started
    require_once 'config_session.inc.php';
    //errors array is not empty
    if($errors){
        $_SESSION["prodSearchErrors"] = $errors;
        header("Location: ../productos.php");// and then user is left at the main page
        die();
    }

    $saveData = [
        "criteria" => $searchCriteria,
        "query" => $query,
    ];
    $_SESSION["busqueda"] = $saveData;
    // set session variables before any directing occurrs
    
    //if no errors then perform the sql query based on search criteria
    //$_SESSION['debug'] = "HOLA!";
    
    if($searchCriteria == "id") {
        $result = getProductId($pdo, $query);
    } else if($searchCriteria == "keywords") {
        $result = searchProductKeywords($pdo, $query);
    } else if($searchCriteria == "category") {
        $result = searchProductCategory($pdo, $query);
    }
    //evaluate what the result is
    if(!$result) {
        header("Location: ../productos.php?result=". $searchCriteria ."NOTfound");
    } else {
        header("Location: ../productos.php?result=found&criteria=".$searchCriteria);
    }
    die();
} else {
    header("Location: ../productos.php");
    die();
}