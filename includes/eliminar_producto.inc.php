<?php
if(isset($_GET['id_producto'])){
    $idProducto = $_GET['id_producto'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "producto_model.inc.php";
    //view
    
    header("Location: ../productos.php?id_producto=". $_GET['id_producto'] ."&confirm_delete");
    die();
} else {
    header("Location: ../productos.php");
    die();
}