<?php
if(isset($_GET['id_detalle_trans']) && isset($_GET['id_transaccion'])){
    $idTransaccion = $_GET['id_detalle_trans'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "transaccion_model.inc.php";
    //view

    $idProducto = getProductoId($pdo, $idTransaccion);
    
    
    header("Location: ../detalles.php?id_transaccion=". $_GET['id_transaccion'] ."&id_detalle_trans=". $_GET['id_detalle_trans'] ."&confirm_delete&id_producto=".$idProducto['id_producto']);
    die();
} else {
    header("Location: ../detalles?id_transaccion". $_GET['id_transaccion'] . ".php");
    die();
}