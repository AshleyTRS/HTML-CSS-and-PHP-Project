<?php
declare(strict_types=1);

function getDistId(object $pdo, int $id) { //used to find only id
    try{
        $query = "SELECT id_proveedor FROM proveedor WHERE id_proveedor = :id;";
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

function getProveedorId(object $pdo, int $id) { //used to find a row by ID
    try{
        $query = "SELECT * FROM proveedor WHERE id_proveedor = :id;";
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

function searchProveedorKeywords(object $pdo, string $name) {
    try{
        $query = "SELECT * FROM proveedor WHERE nombre_proveedor LIKE CONCAT ('%', :nombre, '%');";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":nombre", $name);
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

function createProveedor(object $pdo, string $calle, int $num, string $colonia, string $cuidad, string $estado, int $cp, string $d, string $telefono, string $email, string $nombre) {
    try {
        $query = "INSERT INTO proveedor (calle_p, num_p, colonia_p, cuidad_p, estado_p, CP_p, descripccion, telefono, correo_electronico, nombre_proveedor)
        VALUES (:calle, :num, :colonia, :cuidad, :estado, :cp, :d, :telefono, :email, :nombre);";
        $prepStmt = $pdo->prepare($query);
        //bind parameters to variable
        $prepStmt->bindParam(":calle", $calle);
        $prepStmt->bindParam(":num", $num);
        $prepStmt->bindParam(":colonia", $colonia);
        $prepStmt->bindParam(":cuidad", $cuidad);
        $prepStmt->bindParam(":estado", $estado);
        $prepStmt->bindParam(":cp", $cp);
        $prepStmt->bindParam(":d", $d);
        $prepStmt->bindParam(":telefono", $telefono);
        $prepStmt->bindParam(":email", $email);
        $prepStmt->bindParam(":nombre", $nombre);
        $prepStmt->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function updateProveedor(object $pdo, int $id, string $calle, int $num, string $colonia, string $cuidad, string $estado, int $cp, string $d, string $telefono, string $email, string $nombre) {
    try {
        $query = "UPDATE proveedor SET calle_p = :calle, num_p = :num, colonia_p = :colonia, cuidad_p = :cuidad, estado_p = :estado, CP_p = :cp, descripccion = :d, telefono = :telefono, correo_electronico = :email, nombre_proveedor = :nombre WHERE id_proveedor = :id;";
        $prepStmt = $pdo->prepare($query);
        //bind parameters to variable
        $prepStmt->bindParam(":id", $id);
        $prepStmt->bindParam(":calle", $calle);
        $prepStmt->bindParam(":num", $num);
        $prepStmt->bindParam(":colonia", $colonia);
        $prepStmt->bindParam(":cuidad", $cuidad);
        $prepStmt->bindParam(":estado", $estado);
        $prepStmt->bindParam(":cp", $cp);
        $prepStmt->bindParam(":d", $d);
        $prepStmt->bindParam(":telefono", $telefono);
        $prepStmt->bindParam(":email", $email);
        $prepStmt->bindParam(":nombre", $nombre);
        $prepStmt->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function getEmail(object $pdo, string $email) {
    try{
        $query = "SELECT correo_electronico FROM proveedor WHERE correo_electronico = :email;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":email", $email);
        $prepStm->execute();
        $result = $prepStm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    } finally {
        //set variables to null, so data doesn't collect
        $pdo = null;
        $prepStmt = null;
    }
    
    return $result == false ? $result : true;
}

function proveedoresSelect(object $pdo) {
    try{
        $query = "SELECT * FROM proveedor ORDER BY id_proveedor;";
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

function getProdID(object $pdo, int $idProveedor) {
    try{
        $query = "SELECT id_producto FROM producto WHERE id_proveedor = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $idProveedor);
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

function deleteProvProdFK(object $pdo, int $idProveedor){
    try{
        $query = "DELETE FROM producto WHERE id_proveedor = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $idProveedor);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function deleteProveedor(object $pdo, int $idProveedor) {
    try{
        $query = "DELETE FROM proveedor WHERE id_proveedor = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $idProveedor);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function assignID(object $pdo) {
    try {
        $query = "SHOW TABLE STATUS LIKE 'proveedor';";
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
