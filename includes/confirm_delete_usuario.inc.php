<?php

if(isset($_GET['id_usuario'])){
    $idUsuario = $_GET['id_usuario'];

    require_once "dbh.inc.php";
    //model
    require_once "administrar_usuarios_model.inc.php";
    //control
    require_once "administrar_usuarios_contr.inc.php";

    $idTransaccion = getTransaccionID($pdo, $idUsuario);
    deleteDTWhereIDTransaccion($pdo, $idTransaccion);
    deleteTransaccionWhereIDUSer($pdo, $idUsuario);
    deleteUser($pdo, $idUsuario);

    header("Location: ../administrar_usuarios.php?id_usuario=". $_GET['id_usuario'] ."&userDeleted");
    die();
} else {
    header("Location: ../administrar_usuarios.php");
    die();
}