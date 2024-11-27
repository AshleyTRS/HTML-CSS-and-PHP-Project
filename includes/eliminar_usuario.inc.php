<?php
if(isset($_GET['id_usuario'])){
    $idProducto = $_GET['id_usuario'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "administrar_usuarios_model.inc.php";
    //view
    
    header("Location: ../administrar_usuarios.php?id_usuario=". $_GET['id_usuario'] ."&confirm_delete");
    die();
} else {
    header("Location: ../administrar_usuarios.php");
    die();
}