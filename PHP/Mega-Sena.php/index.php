<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteador de Números</title>
</head>
<style>
    /* CSS simples e bonitinho */

body{
    background-color: #f4f4f4;
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
    margin-top: 50px;
}

h1{
    color: #333;
}

p{
    color: #666;
}

form{
    background-color: white;
    width: 300px;
    margin: auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

input{
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input:hover{
    background-color: #45a049;
}

hr{
    width: 60%;
}
</style>
<body>

    <h1>Sorteador de Números</h1>

    <p>Olá, seja bem-vindo!</p>

    <p>
        Este site sorteia 6 números no seguinte formato:
        01-02-03-04-05-06, até o número 60
    </p>
    <hr>
    <form method="POST">
        <input type="submit" name="sortear" value="Sortear!">
    </form>
    <br>
    <?php

    if(isset($_POST["sortear"])){

        $numeros = [];

        while(count($numeros) < 6){
// De uma escala, ou seja de um número até o outro, nesse caso de 1 a 60
            $numero = mt_rand(1, 60);

            if(!in_array($numero, $numeros)){
                $numeros[] = $numero;
            }
        }
        sort($numeros);

        foreach($numeros as $indice => $n){
//O str_pad serve para completar um texto, pelo o que eu entendi é para ordenar direitinho . . .
            echo str_pad($n, 2, "0", STR_PAD_LEFT);

            if($indice < 5){
                echo "-";
            }
        }
    }
    ?>

</body>
</html>