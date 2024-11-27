<?php
if(isset($_GET['id_transaccion'])){
    $idTransaccion = $_GET['id_transaccion'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "transaccion_model.inc.php";
    //control
    require_once "transaccion_contr.inc.php";

    deleteTD($pdo, $idTransaccion);
    deleteTransaccion($pdo, $idTransaccion);
    
    
    //set a message with session variable
    header("Location: ../transacciones.php?id_transaccion=". $_GET['id_transaccion'] ."&transaccionDeleted");
    die();
} else {
    header("Location: ../transacciones.php");
    die();
}