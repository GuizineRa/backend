<?php

$host = "localhost";
$dbname = "gamevault";
$user = "postgres";
$password = "sua_senha";

try {

    $pdo = new PDO(
        "pgsql:host=$host;dbname=$dbname",
        $user,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch(PDOException $e){

    die("Erro na conexão: " . $e->getMessage());
}