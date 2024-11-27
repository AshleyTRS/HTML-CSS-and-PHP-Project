<?php

$dsn = "mysql:host=localhost;dbname=proyecto_artesanias_hilda";
$dbusername = "root";
$dbpassword = "DATAbase2k22@"; //check database password
try{
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}