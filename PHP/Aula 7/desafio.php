<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Nome: </th>
            <th>Cargo: </th>
        </tr>
    </table>
    <?php
    $funcionarios = [
        ["nome" => "Ana", "cargo" => "Analista"],
        ["nome" => "Carlos", "cargo" => "Desenvolvedor"],
        ["nome" => "Mariana", "cargo" => "Gerente"]
    ];
    /*
    echo "<strong>Funcionário: </strong>" . $funcionarios[2]["nome"] . "<strong><br>
    cargo: </strong>" . $funcionarios[2]
    ["cargo"];
    */

    foreach ($funcionarios as $f) {
        echo "<tr> <td>" . $f["nome"] . "</td><td>  " . $f["cargo"] . "</td>";
    }
?>
</body>
</html>