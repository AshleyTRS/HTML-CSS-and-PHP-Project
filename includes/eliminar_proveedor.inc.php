<?php
if(isset($_GET['id_proveedor'])){
    $idProveedor = $_GET['id_proveedor'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "proveedor_model.inc.php";
    //view
    
    // deleteProveedor($pdo, $idProveedor);
    // //set a message with session variable
    // $successMsg = "El proveedor con el ID ". htmlspecialchars($_GET['id_proveedor']) ." fue eliminado!";
    header("Location: ../proveedores.php?id_proveedor=". $_GET['id_proveedor'] ."&confirm_delete");
    die();
} else {
    header("Location: ../proveedores.php");
    die();
}