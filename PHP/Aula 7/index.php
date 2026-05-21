<?php
    $funcionarios = [
        ["nome" => "Ana", "cargo" => "Analista"],
        ["nome" => "Carlos", "cargo" => "Desenvolvedor"],
        ["nome" => "Mariana", "cargo" => "Gerente"]
    ];

    echo "<strong>Funcionário: </strong>" . $funcionarios[2]["nome"] . "<strong><br>
    cargo: </strong>" . $funcionarios[2]
    ["cargo"];


    foreach ($funcionarios as $f) {
        echo $f["nome"] ." - " . $f["cargo"] . "<br>";
    }
?>