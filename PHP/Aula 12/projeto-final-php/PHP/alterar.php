<?php

session_start();
require "conexao.php";

$id = $_SESSION["id_usuario"];

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "UPDATE usuarios
        SET nome = :nome,
            email = :email,
            senha_hash = :senha
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":senha", $senha);
$stmt->bindParam(":id", $id);

$stmt->execute();

// Atualiza o nome armazenado na sessão
$_SESSION["usuario"] = $nome;

header("Location: ../HTML/perfil.php");
exit();