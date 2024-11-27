<?php
declare(strict_types=1);

function getUsers(object $pdo) {
    try{
        $query = "SELECT CONCAT(nombre_usuario, ' ',  apellido_p_usuario, ' ', apellido_m_usuario) AS nombre, id_usuario, login_usuario, email_usuario, is_admin, permission_granted FROM usuario_sistema ORDER BY id_usuario;";
        $prepStm = $pdo->prepare($query);
        // Binds the name parameter
        $prepStm->execute();
        $result = $prepStm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed TOTAL: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}

function deleteUser(object $pdo, int $idUsuario) {
    try{
        $query = "DELETE FROM usuario_sistema WHERE id_usuario = :idUsuario;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":idUsuario", $idUsuario);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed TOTAL: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function getTransaccionID(object $pdo, int $idUsuario) {
    try{
        $query = "SELECT id_transaccion FROM transaccion WHERE id_usuario = :idUsuario;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":idUsuario", $idUsuario);
        $prepStm->execute();
        $result = $prepStm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed getTrans: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
    return $result;
}

function deleteDTWhereIDTransaccion(object $pdo, array $idTransaccion) {
    try{
        $query = "DELETE FROM detalles_transaccion WHERE id_transaccion = :idTransaccion;";
        $prepStm = $pdo->prepare($query);
        
        for ($i = 0; $i < count($idTransaccion); $i++) {
            $prepStm->bindParam(":idTransaccion", $idTransaccion[$i]['id_transaccion']);
            $prepStm->execute();
        }
    } catch (PDOException $e) {
        die("Query failed TOTAL: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}

function deleteTransaccionWhereIDUSer(object $pdo, int $idUsuario) {
    try{
        $query = "DELETE FROM transaccion WHERE id_usuario = :idUsuario;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":idUsuario", $idUsuario);
        $prepStm->execute();
    } catch (PDOException $e) {
        die("Query failed TOTAL: " . $e->getMessage()); 
    } finally {
        $pdo = null;
        $prepStmt = null;
    }
}