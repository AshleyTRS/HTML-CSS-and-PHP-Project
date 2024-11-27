<?php
declare(strict_types=1);


//there is something wrong with this function
function isInputEmpty(string $nombre_producto, string $descripccion_producto, string $material_producto, float | string $precio_unitario_tienda, int | string $idProveedor) {
    return (empty($nombre_producto) || empty($descripccion_producto) || empty($material_producto) || empty($precio_unitario_tienda) || empty($idProveedor));
}

function isNotEmptyZero(int | string $q) {
    if(($q === 0 || $q === "0") && empty($q)) {
        //if variable is 0 or "0", and it is evaluated as empty then, it is an acceptable value
        return true; //it is true that it is not empty
    } else if ((!($q === 0 || $q === "0")) && !empty($q)) {
        return true;
    }
    return false;
}

function cantidadIncorrectDataType(int | string $cantidad_inventario) {
    if($cantidad_inventario === 0 || $cantidad_inventario === "0"){
        return false;
    }
    if(!filter_var($cantidad_inventario, FILTER_VALIDATE_INT)){
        return true;
    } else {
        return false;
    }
}

function quantityExceedsLength(int $cantidad_inventario) {
    if(($cantidad_inventario < 0 || $cantidad_inventario > 2147483647)){
        return true; //the submitted data is not numeric
    } else return false;
}

function idIncorrectDataType(int | string $id_producto) {
    if(!filter_var($id_producto, FILTER_VALIDATE_INT)){ //!empty($id_producto) && 
        return true;
    } else {
        return false;
    }
}

function idExceedsLength(int $id_producto) {
    if($id_producto < 1 || $id_producto > 2147483647) {
        return true; //the submitted data is not numeric
    } else return false;
}

function precioIncorrectDataType( float | string $precio_unitario_tienda) {
    if(!empty($precio_unitario_tienda) && !filter_var($precio_unitario_tienda, FILTER_VALIDATE_FLOAT)){
        return true;
    } else {
        return false;
    }
}

function priceExceedsLength(int $precio_unitario_tienda) {
    if($precio_unitario_tienda <= 0 || $precio_unitario_tienda > 999999) {
        return true; //the submitted data is not numeric
    } else return false;
}

function createProduct(object $pdo, string $nombre_producto, string $descripccion_producto, string $material_producto, string $categoria_producto, int $cantidad_inventario, float $precio_unitario_tienda, int $idProveedor){
    addToInventory($pdo, $nombre_producto, $descripccion_producto, $material_producto, $categoria_producto, $cantidad_inventario, $precio_unitario_tienda, $idProveedor );
}

function foundProductId(object $pdo, int $id) {
    if(!getProductId($pdo, $id)) return false;
    return true;
}

function nameExceedsLength(string $name){
    return strlen($name) > 60;
}

function descriptionExceedsLength(string $des) {
    return strlen($des) > 200;
}

function materialExceedsLength(string $material) {
    return strlen($material) > 50;
}

function categoryExceedsLength(string $category) {
    return strlen($category) > 60;
}

function deleteAllTransaction(object $pdo, int $idProducto) {
    $count = countProductsOrdered($pdo, $idProducto);
    if($count["num_products"] == 1) return true;
    else return false;
}
