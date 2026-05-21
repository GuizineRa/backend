<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S6_R1_AT1</title>
</head>
<body>
    <?php
        for ($i = 1; $i < 10; $i++) {
            echo "<p>Funcionário Nº" . $i;
            if ($i == 6 or $i == 7) {
                echo " Esse funcinário é especial ! ! !";
            }
            echo "</p>";
        }
    ?>
</body>
</html>