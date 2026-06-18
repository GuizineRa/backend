<?php

session_start();

require "conexao.php";


$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$confirmar = $_POST["confirmar"];


if ($senha != $confirmar) {

    echo "As senhas não são iguais!";
    exit;

}


// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);



$sql = "INSERT INTO usuarios (nome, email, senha_hash)
        VALUES (:nome, :email, :senha)";


$stmt = $pdo->prepare($sql);

try {
    $stmt->execute(
        [
            'nome'=> $nome,
            'email'=> $email,
            'senha'=> $senha
        ]
    );

    $_SESSION["usuario"] = $nome;
    $_SESSION["email"] = $email;

    header("Location: ../HTML/login.php");
    exit;

} catch (PDOException $e) {

    echo "Erro ao cadastrar.";

}

?>