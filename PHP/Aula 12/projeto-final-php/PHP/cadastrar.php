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



$sql = "INSERT INTO usuarios (nome, email, senha)
        VALUES (:nome, :email, :senha)";


$stmt = $pdo->prepare($sql);


$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":senha", $senhaHash);


if ($stmt->execute()) {

    $_SESSION["usuario"] = $nome;
$_SESSION["email"] = $email;

header("Location: home.php");
exit;

} else {

    echo "Erro ao cadastrar.";

}

?>