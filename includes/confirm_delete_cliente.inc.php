<?php
if(isset($_GET['id_cliente'])){
    $idCliente = $_GET['id_cliente'];
    //DB connection
    require_once "dbh.inc.php";
    //model
    require_once "cliente_model.inc.php";
    //view

    //first delete from detalles_transaccion
    $idTransaccion = getTransID($pdo, $idCliente);
    foreach ($idTransaccion as $id) {
        deleteClienteTD($pdo, $id['id_transaccion']);
    }

    //then delete from transaccion table
    deleteClienteTrans($pdo, $idCliente);

    //delete from cliente table
    deleteCliente($pdo, $idCliente);

    header("Location: ../clientes.php?id_cliente=". $_GET['id_cliente'] ."&clienteDeleted");
    die();
} else {
    header("Location: ../clientes.php");
    die();
}
