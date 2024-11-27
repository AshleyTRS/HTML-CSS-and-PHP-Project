<?php
if(isset($_GET['id_cliente'])){
    $idCliente = $_GET['id_cliente'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "cliente_model.inc.php";
    //control
    require_once "cliente_contr.inc.php";

    header("Location: ../clientes.php?id_cliente=". $_GET['id_cliente'] ."&confirm_delete");
    die();
} else {
    header("Location: ../clientes.php");
    die();
}