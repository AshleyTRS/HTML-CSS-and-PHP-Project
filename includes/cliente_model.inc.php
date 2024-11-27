<?php
declare(strict_types=1);

function registerClient(object $pdo, string $primer_nom_clie, string $apellido_p_clie, string $apellido_m_clie, int $movil_cliente, int $fijo_cliente){
    try {
        $query = "INSERT INTO cliente (primer_nom_clie, apellido_p_clie, apellido_m_clie, movil_cliente, fijo_cliente)
        VALUES (:primer_nom_clie, :apellido_p_clie, :apellido_m_clie, :movil_cliente, :fijo_cliente)";
        $prepStmt = $pdo->prepare($query);
        //bind parameters to variable
        $prepStmt->bindParam(":primer_nom_clie", $primer_nom_clie);
        $prepStmt->bindParam(":apellido_p_clie", $apellido_p_clie);
        $prepStmt->bindParam(":apellido_m_clie", $apellido_m_clie);
        $prepStmt->bindParam(":movil_cliente", $movil_cliente);
        $prepStmt->bindParam(":fijo_cliente", $fijo_cliente);
        $prepStmt->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function getMobileNo(object $pdo, int $movil_cliente) {
    try{
        $query = "SELECT movil_cliente FROM cliente WHERE movil_cliente = :movil_cliente;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":movil_cliente", $movil_cliente);
        $prepStm->execute();
         //result varible is set to the prepared statement, fetch method grabs the first result from the column of the DB
         $result = $prepStm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result == false ? false : true;
}

function getFixedNo(object $pdo, int $fijo_cliente) {
    try{
        $query = "SELECT fijo_cliente FROM cliente WHERE fijo_cliente = :fijo_cliente;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":fijo_cliente", $fijo_cliente);
        $prepStm->execute();
         //result varible is set to the prepared statement, fetch method grabs the first result from the column of the DB
         $result = $prepStm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result == false ? false : true;
}

function clientesSelect(object $pdo) {
    try{
        $query = "SELECT * FROM cliente";
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
        $query = "SHOW TABLE STATUS LIKE 'cliente';";
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

function getClienteID(object $pdo, $id) {
    try{
        $query = "SELECT * FROM cliente WHERE id_cliente = :id;";
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

function searchClienteKeywords($pdo, $keyword) {
    try{
        $query = "SELECT * FROM cliente WHERE primer_nom_clie LIKE CONCAT('%', :keyword, '%') ORDER BY primer_nom_clie;";
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

function updateCliente(object $pdo, string $primer_nom_clie, string $apellido_p_clie, string $apellido_m_clie, int $movil_cliente, int $fijo_cliente, int $id_cliente) {
    try {
        $query = "UPDATE cliente SET primer_nom_clie = :nombre, apellido_p_clie = :lastN, apellido_m_clie = :secN, movil_cliente = :movNum, fijo_cliente = :fixNum WHERE id_cliente = :id;";
        $prepStmt = $pdo->prepare($query);
        //bind parameters to variable
        $prepStmt->bindParam(":nombre", $primer_nom_clie);
        $prepStmt->bindParam(":lastN", $apellido_p_clie);
        $prepStmt->bindParam(":secN", $apellido_m_clie);
        $prepStmt->bindParam(":movNum", $movil_cliente);
        $prepStmt->bindParam(":fixNum", $fijo_cliente);
        $prepStmt->bindParam(":id", $id_cliente);
        $prepStmt->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function deleteClienteTD(object $pdo, int $idT) {
    try{
        $query = "DELETE FROM detalles_transaccion WHERE detalles_transaccion.id_transaccion = :id;";
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

function getTransID(object $pdo, int $idCliente) {
    try{
        $query = "SELECT id_transaccion FROM transaccion WHERE id_cliente = :id;";
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

function deleteClienteTrans(object $pdo, int $idCliente) {
    try{
        $query = "DELETE FROM transaccion WHERE id_cliente = :id";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $idCliente);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed DT: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function deleteCliente(object $pdo, int $idCliente){
    try{
        $query = "DELETE FROM cliente WHERE id_cliente = :id;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":id", $idCliente);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }   
}