<?php
if(isset($_GET['id_transaccion'])){
    $idTransaccion = $_GET['id_transaccion'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "transaccion_model.inc.php";
    //view
    
    header("Location: ../transacciones.php?id_transaccion=". $_GET['id_transaccion'] ."&confirm_delete");
    die();
} else {
    header("Location: ../transacciones.php");
    die();
}