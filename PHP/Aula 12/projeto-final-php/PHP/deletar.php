<?php

session_start();

require "conexao.php";

$id = $_SESSION["id_usuario"];

$sql = "DELETE FROM usuarios WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(":id", $id);

$stmt->execute();

session_destroy();

header("Location: ../HTML/cadastro.php");
exit();

?>