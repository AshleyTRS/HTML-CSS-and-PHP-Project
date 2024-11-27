<?php

declare(strict_types=1); //variable has to be a certain data type

function getUsername(object $pdo, string $username) {
    try{
        $query = "SELECT * FROM usuario_sistema WHERE login_usuario = :username;";
        $prepStm = $pdo->prepare($query);
        $prepStm->bindParam(":username", $username);
        $prepStm->execute();
        $result = $prepStm->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    } finally {
        $pdo = null;
        $prepStm = null;
    }
    return $result;
}