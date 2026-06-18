<?php

$host = "localhost";
$porta = "5432";
$banco = "steam_db";
$usuario = "postgres";
$senha = "postgres";

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$porta;dbname=$banco", $usuario, $senha, 
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
        ]);

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage()); // A funcção die encerra a execução do script emediatamente e pode exibir uma mensagem antes de parar
}

return $pdo;
?>