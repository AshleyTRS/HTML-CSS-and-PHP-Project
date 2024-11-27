<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get data that the user submitted
    $nombre_producto = trim($_POST["nombre_producto"]);
    $descripccion_producto = trim($_POST["descripccion_producto"]);
    $material_producto = trim($_POST["material_producto"]);
    if(isset($_POST["categoria_producto"])) {
        $categoria_producto = $_POST["categoria_producto"];
    } else {
        $categoria_producto = "";
    }
    $cantidad_inventario = $_POST["cantidad_inventario"];
    $precio_unitario_tienda = (float)($_POST["precio_unitario_tienda"]);
    if (isset($_POST['proveedor_id'])) {
        $idProveedor = (int)$_POST['proveedor_id'];
    } else {
        $idProveedor = '';
    }
    
    //DB connection
    require_once "dbh.inc.php";
    //model and control
    require_once "producto_model.inc.php";
    require_once "producto_contr.inc.php";

    //error handlers
    $errors = [];
    if(isInputEmpty($nombre_producto, $descripccion_producto, $material_producto, $categoria_producto, $precio_unitario_tienda, $idProveedor) || (!isNotEmptyZero($cantidad_inventario))) {
        $errors["empty_input"] = "Llene todos los campos.";
    }


    if($cantidad_inventario !== "") {
        if(((isNotEmptyZero($cantidad_inventario)) && quantityExceedsLength($cantidad_inventario)) || cantidadIncorrectDataType($cantidad_inventario)) { 
            $errors["incorrect_type_Q"] = "Datos no validos para la cantidad.";
        }
    }
    if(precioIncorrectDataType($precio_unitario_tienda) || (!empty($precio_unitario_tienda) && (priceExceedsLength($precio_unitario_tienda)))) {
        $errors["incorrect_type_P"] = "Datos no validos para el precio.";
    }
    /*if(!idIncorrectDataType($id_producto) && foundProductId($pdo, $id_producto)) {
        $errors["id_exists"] = "Ese ID de producto ya existe.";
    }*/
    if(nameExceedsLength($nombre_producto)) {
        $errors["name_len"] = "El nombre esta muy largo.";
    }
    if(descriptionExceedsLength($descripccion_producto)) {
        $errors["des_len"] = "La descripción esta muy largo.";
    }
    if(materialExceedsLength($material_producto)) {
        $errors["material_len"] = "El nombre del material esta muy largo.";
    }
    if(categoryExceedsLength($categoria_producto)) {
        $errors["category_len"] = "El nombre de la esta muy largo.";
    }
    //link to config file b/c it has a session started
    require_once 'config_session.inc.php';
    if($errors){
        $_SESSION["producto_errors"] = $errors;

        //associative array to store user data
        $productoData = [
            "nombre_producto" => $nombre_producto,
            "descripccion_producto" => $descripccion_producto,
            "material_producto" => $material_producto,
            "categoria_producto" => $categoria_producto,
            "cantidad_producto" => $cantidad_inventario,
            "precio_unitario_tienda" => $precio_unitario_tienda,
            "idProveedor" => $idProveedor
        ];

        $_SESSION["producto_data"] = $productoData;

        header("Location: ../productos.php");// and then user is left at the main page
        die();
    }

    //call function to perform sql query
    $precio_unitario_tienda = sprintf("%.2f", $precio_unitario_tienda, 2, ".");
    createProduct($pdo, $nombre_producto, $descripccion_producto, $material_producto, $categoria_producto, $cantidad_inventario, $precio_unitario_tienda, $idProveedor);
    unset($_SESSION["producto_data"]);
    header("Location: ../productos.php?status=success");// and then user is left at the main page
    die();
} else {
    header("Location: ../productos.php");
    die();
}


