<?php

session_start();

require "conexao.php";


$email = $_POST["email"];
$senha = $_POST["senha"];


$sql = "SELECT * FROM usuarios WHERE email = :email";

// Usada para enviar uma consulta SQL para o BD
$stmt = $pdo->prepare($sql);

$stmt->bindParam(":email", $email);

$stmt->execute();


$usuario = $stmt->fetch(PDO::FETCH_ASSOC);



if ($usuario) {
    if ($senha == $usuario["senha"]) {


        $_SESSION["usuario"] = $usuario["nome"];
        $_SESSION["id_usuario"] = $usuario["id"];


        header("Location: ../HTML/index.php");
        exit;


    } else {

        echo "Senha incorreta";

    }


} else {

    echo "Usuário não encontrado";

}


?>