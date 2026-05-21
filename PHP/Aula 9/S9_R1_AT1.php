<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soma de 3 números</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
}

form {
    background-color: white;
    width: 300px;
    margin: 30px auto;
    padding: 20px;
    border-radius: 8px;
}

label {
    display: block;
    margin-top: 10px;
    margin-bottom: 5px;
}

input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}

input[type="submit"],
input[type="reset"] {
    padding: 8px 15px;
    margin-top: 10px;
    cursor: pointer;
}

.resultado {
    background-color: white;
    width: 300px;
    margin: 20px auto;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}
</style>


</head>
<body>
    <header>
        <h1>Digie três números, para somar!</h1>
    </header>
<hr>
    <form method="POST">
        <label>Número 1</label>
        <input type="number" name="number" id="number">
        <label>Número 2</label>
        <input type="number" name="dois" id="number">
        <label>Número 3</label>
        <input type="number" name="três" id="number">
        <input type="reset" value="Limpar">
        <input type="submit" value="enviar">
    </form>
    <?php
    function soma($numero1, $numero2, $numero3) {
    $resultado = $numero1 + $numero2 + $numero3;
    echo $resultado;
    
    }
    
    soma($_POST["number"],$_POST["dois"],$_POST["três"])

   

    ?>
</body>
</html>