<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S5_R1_AT1</title>
</head>
<style>
    body{
        text-align: center;
    }
</style>
<body>
    <?php

//Variável
$funcionarios = 120;

//Operação de decisão
if ($funcionarios < 50) {
	echo "Pequeno porte";
} elseif ($funcionarios < 100) {
	echo "Médio porte";
} else {
	echo "Grande porte";
}
?>

</body>
</html>