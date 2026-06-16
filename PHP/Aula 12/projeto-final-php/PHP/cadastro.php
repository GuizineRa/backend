<?php

$host = "localhost";
$porta = "5432";
$banco = "steam_db";
$usuario = "postgres";
$senha = "postgres";

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$porta;dbname=$banco",
        $usuario,
        $senha
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

?>