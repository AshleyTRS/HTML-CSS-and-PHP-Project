<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $id = $_POST["id_transaccion"];
    
    if(isset($_POST['fecha_transaccion'])){
        $fecha = $_POST['fecha_transaccion'];
    } else {
        $fecha = '';
    }
    //$total = $_POST['total_transaccion']; //total_transaccion
    $tipo = $_POST['tipo_transaccion'];
    if (isset($_POST['id_cliente_select'])) {
        $idCliente = (int)$_POST['id_cliente_select'];
    } else {
        $idCliente = '';
    }
    if (isset($_POST['id_usuario'])) {
        $idUsuario = (int)$_POST['id_usuario'];
    } else {
        $idUsuario = '';
    }

    //asign arrays to variables
    $productosArray = $_POST['product'];
    $quantityArray = $_POST['quantity'];

    $size = count($productosArray);

    //DB connection
    require_once "dbh.inc.php";
    //model and control
    require_once "transaccion_model.inc.php";
    require_once "transaccion_contr.inc.php";

    $numProdsOrer = countProductsInOrder($pdo, $id);

    //error handlers
    $errors = [];
    if(isInputEmptyEditar($fecha, $tipo, $idCliente, $idUsuario)) {
        $errors["empty_input"] = "Llene todos los campos.";
    }
    

    require_once 'config_session.inc.php';

    if($errors) {
        $_SESSION['transaccion_errors'] = $errors;
        $transData = [
            "fecha" => $fecha,
            "tipo" => $tipo,
            "idCliente" => $idCliente,
            "idUsuario" => $idUsuario
        ]; 
        $_SESSION['transaccion_data'] = $transData;

        header("Location: ../editar_transaccion.php?id_transaccion=". strval($id));// and then user is left at the main page
        die();
    }

    //converts elements of array to int
    $productosArray = array_map('intval', $productosArray); 
    $quantityArray = array_map('intval', $quantityArray);
    
    
    updateTransaccion($pdo, $fecha, $tipo, $idCliente, $idUsuario, $id);

    //get id_detalle_trans
    $idDT = getDetalleTransID($pdo, $id);
    
    //if($size == $numProdsOrer['number_prod']) {
        updateTransaccionDetails($pdo, $idDT, $productosArray, $quantityArray);
    // } else if ($size > $numProdsOrer['number_prod']) {
    //     for($i=1; $i<=$numProdsOrer['number_prod']; $i++){
    //         $auxProd = 
    //         updateTransaccionDetails($pdo, $idDT, $productosArray, $quantityArray);
    //     }
    // }

    header("Location: ../editar_transaccion.php?id_transaccion=" . $id . "&status=success");
    die();
} else {
    header("Location: ../transacciones.php");
    die();
}