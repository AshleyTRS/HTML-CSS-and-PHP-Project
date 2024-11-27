<?php
if(isset($_GET['id_detalle_trans']) && isset($_GET['id_transaccion']) && isset($_GET['id_producto'])){
    $idDT = $_GET['id_detalle_trans'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "transaccion_model.inc.php";
    //control
    require_once "transaccion_contr.inc.php";

    deleteTDWhereID($pdo, $idDT);
    
    //var_dump($_GET['id_producto']);
    //set a message with session variable
    header("Location: ../detalles.php?detalleDeleted&id_transaccion=".$_GET['id_transaccion'] . "&id_producto=" . $_GET['id_producto']);
    die();
} else {
    header("Location: ../detalles.php");
    die();
}