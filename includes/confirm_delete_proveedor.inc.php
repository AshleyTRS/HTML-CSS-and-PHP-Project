<?php
if(isset($_GET['id_proveedor'])){
    $idProveedor = $_GET['id_proveedor'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "proveedor_model.inc.php";
    //control
    require_once "proveedor_contr.inc.php";

    //get product id related to id_proveedor
    $idProducto = getProdID($pdo, $idProveedor);
    //get id DT realted to id_transaccion 


    foreach ($idProducto as $id) {
        if(deleteAllTransaction($pdo, $id['id_producto'])){
            //delete from table transacciones
            //delete from table detalles_transacciones
            //first get id_transaccion that is related to id_detalles_transaccion
            $idT = getTransID($pdo, $id['id_producto']);
            //then delete all detalles realted to a particular product id
            deleteProductTD($pdo, $id['id_producto']);
            //and then delte id_transaccion row
            
            deleteTrans($pdo, $idT['id_transaccion']);
    
        } else {
            //delete from table of detalles_transaccion
            deleteProductTD($pdo, $id['id_producto']);
        }
    }

    //delete from table producto all products related to id_proveedor
    deleteProvProdFK($pdo, $idProveedor);

    //then delete from table poveedor
    deleteProveedor($pdo, $idProveedor);
    
    //set a message with session variable
    header("Location: ../proveedores.php?id_proveedor=". $_GET['id_proveedor'] ."&proveedorDeleted");
    die();
} else {
    header("Location: ../proveedores.php");
    die();
}