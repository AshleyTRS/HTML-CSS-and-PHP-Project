<?php
if(isset($_GET['id_producto'])){
    $idProducto = $_GET['id_producto'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "producto_model.inc.php";
    //control
    require_once "producto_contr.inc.php";

    
    //check how many distinct products there are in a single transaction, if there is only one distinct product, then delete the id_transaccion and id_detalles_transaccion
    if(deleteAllTransaction($pdo, $idProducto)){
        //first get id_transaccion that is related to id_detalles_transaccion
        $idT = getTransID($pdo, $idProducto);

        var_dump($idT);

        //then delete all detalles realted to a particular product id
        deleteProductTD($pdo, $idProducto);
        //and then delte id_transaccion row
        
        deleteTrans($pdo, $idT['id_transaccion']);

    } else {
        //delete from table of detalles_transaccion
        deleteProductTD($pdo, $idProducto);
    }

    
    //then delete from producto table
    deleteProduct($pdo, $idProducto);

    //set a message with session variable
    header("Location: ../productos.php?id_producto=". $_GET['id_producto'] ."&productDeleted");
    die();
} else {
    header("Location: ../productos.php");
    die();
}