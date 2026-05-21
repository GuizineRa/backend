<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S7_R1_AT1</title>
</head>
<body>
   <?php
   //Aqui eu defini a variável $produtos, no qual contém um array
$produtos = ["PS5", "SSD", "Memória RAM", "Fonte de alimentação"];

//Título dos produtos da empresa
echo "<h1>Produtos da Empresa: </h1>";

//Para cada elemento dentro de $produtos, pegue esse elemento e chame de $nome
foreach ($produtos as $nome) {
        echo $nome . "<br>";
    }

?>
</body>
</html>