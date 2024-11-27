<?php
declare(strict_types=1);

function addToInventory(object $pdo, string $nombre_producto, string $descripccion_producto, string $material_producto, string $categoria_producto, int $cantidad_inventario, float $precio_unitario_tienda, int $idProveedor){
    try {
        $query = "INSERT INTO producto (descripccion, nombre_producto, material_producto, categoria_producto, cantidad_invetario, precio_unitario_tienda, id_proveedor)
        VALUES (:descripccion, :nombre_producto, :material_producto, :categoria_producto, :cantidad_inventario, :precio_unitario_tienda, :id_proveedor)";
        $prepStmt = $pdo->prepare($query);
        //bind parameters to variable
        $prepStmt->bindParam(":descripccion", $descripccion_producto);
        $prepStmt->bindParam(":nombre_producto", $nombre_producto);
        $prepStmt->bindParam(":material_producto", $material_producto);
        $prepStmt->bindParam(":categoria_producto", $categoria_producto);
        $prepStmt->bindParam(":cantidad_inventario", $cantidad_inventario);
        $prepStmt->bindParam(":precio_unitario_tienda", $precio_unitario_tienda);
        $prepStmt->bindParam(":id_proveedor", $idProveedor);
        $prepStmt->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function updateProduct(object $pdo, int $id_producto, string $nombre_producto, string $descripccion_producto, string $material_producto, string $categoria_producto, int $cantidad_inventario, float $precio_unitario_tienda, int $idProveedor) {
    try {
        $query = "UPDATE producto SET nombre_producto = :nombre_producto, descripccion = :descripccion_producto, material_producto = :material_producto, categoria_producto = :categoria_producto, cantidad_invetario = :cantidad_inventario, precio_unitario_tienda = :precio_unitario_tienda, id_proveedor = :idProveedor WHERE id_producto = :id_producto;";
        $prepStmt = $pdo->prepare($query);
        //bind parameters to variable
        $prepStmt->bindParam(":id_producto", $id_producto);
        $prepStmt->bindParam(":descripccion_producto", $descripccion_producto);
        $prepStmt->bindParam(":nombre_producto", $nombre_producto);
        $prepStmt->bindParam(":material_producto", $material_producto);
        $prepStmt->bindParam(":categoria_producto", $categoria_producto);
        $prepStmt->bindParam(":cantidad_inventario", $cantidad_inventario);
        $prepStmt->bindParam(":precio_unitario_tienda", $precio_unitario_tienda);
        $prepStmt->bindParam(":idProveedor", $idProveedor);
        $prepStmt->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

//search by ID
function getProductId(object $pdo, int $id) {
    try{
        $query = "SELECT * FROM producto WHERE id_producto = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $id);
        $prepStm->execute();
         //result varible is set to the prepared statement, fetch method grabs the first result from the column of the DB
         $result = $prepStm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}



//search by ID
function searchProductoID(object $pdo, int $id) {
    try{
        $query = "SELECT producto.id_producto, producto.descripccion, producto.nombre_producto, producto.material_producto, producto.categoria_producto, producto.cantidad_invetario, producto.precio_unitario_tienda, producto.id_proveedor, proveedor.nombre_proveedor FROM producto INNER JOIN proveedor ON proveedor.id_proveedor = producto.id_proveedor WHERE id_producto = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $id);
        $prepStm->execute();
         //result varible is set to the prepared statement, fetch method grabs the first result from the column of the DB
         $result = $prepStm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}

//search by keywords
function searchProductKeywords(object $pdo, string $keyword) {
    try{
        $query = "SELECT producto.id_producto, producto.descripccion, producto.nombre_producto, producto.material_producto, producto.categoria_producto, producto.cantidad_invetario, producto.precio_unitario_tienda, producto.id_proveedor, proveedor.nombre_proveedor FROM producto INNER JOIN proveedor ON proveedor.id_proveedor = producto.id_proveedor WHERE nombre_producto LIKE CONCAT('%', :keyword, '%');";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":keyword", $keyword);
        $prepStm->execute();
         //result varible is set to the prepared statement, fetch method grabs the first result from the column of the DB
         $result = $prepStm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}

//search by category
function searchProductCategory(object $pdo, string $category) {
    try{
        $query = "SELECT producto.id_producto, producto.descripccion, producto.nombre_producto, producto.material_producto, producto.categoria_producto, producto.cantidad_invetario, producto.precio_unitario_tienda, producto.id_proveedor, proveedor.nombre_proveedor FROM producto INNER JOIN proveedor ON proveedor.id_proveedor = producto.id_proveedor WHERE categoria_producto LIKE CONCAT ('%', :category, '%');";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":category", $category);
        $prepStm->execute();
        $result = $prepStm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}
function deleteProduct(object $pdo, int $id) {
    //SQL query to delete product from data base
    try{
        $query = "DELETE FROM producto WHERE id_producto = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $id);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
        return false;
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return true;
}

//make a sql query that counts how many products there are in the transaction

function countProductsOrdered(object $pdo, int $idProducto) {
    try{
        $query = "SELECT COUNT(id_producto) AS num_products FROM detalles_transaccion WHERE id_producto = :idProducto;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":idProducto", $idProducto);
        $prepStm->execute();
        $result = $prepStm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}

function deleteProductTD(object $pdo, int $idProducto){
    try{
        $query = "DELETE FROM detalles_transaccion WHERE detalles_transaccion.id_producto = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $idProducto);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed DT: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function getTransID(object $pdo, int $idProducto) {
    try{
        $query = "SELECT id_transaccion FROM detalles_transaccion WHERE id_producto = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $idProducto);
        $prepStm->execute();
        $result = $prepStm->fetchALL(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}

function deleteTrans(object $pdo, int $idT) {
    try{
        $query = "DELETE FROM transaccion WHERE id_transaccion = :id";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $idT);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed DT: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

//function used to project all the products on the DB table 'producto'
function productosSelect(object $pdo) {
    try{
        $query = "SELECT producto.id_producto, producto.descripccion, producto.nombre_producto, producto.material_producto, producto.categoria_producto, producto.cantidad_invetario, producto.precio_unitario_tienda, proveedor.id_proveedor, proveedor.nombre_proveedor 
        FROM producto 
        INNER JOIN proveedor ON producto.id_proveedor = proveedor.id_proveedor 
        ORDER BY producto.id_producto;";
        $prepStm = $pdo->prepare($query);
        $prepStm->execute();
        //result varible is set to the prepared statement, fetch method grabs the first result from the column of the DB
        $result = $prepStm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}

function getProveedores(object $pdo) {
    try{
        $query = "SELECT id_proveedor, nombre_proveedor FROM proveedor ORDER BY nombre_proveedor;";
        $prepStm = $pdo->prepare($query);
        $prepStm->execute();
         //result varible is set to the prepared statement, fetch method grabs the first result from the column of the DB
         $result = $prepStm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}

function assignID(object $pdo) {
    try {
        $query = "SHOW TABLE STATUS LIKE 'producto';";
        $prepStm = $pdo->prepare($query);
        $prepStm->execute();
        $result = $prepStm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result['Auto_increment'];
}

