<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S4_R1_AT1</title>
    <style>
        body{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
        #Variáveis
        $anoFundacao = 2067;
        $anoAtual = 26767;
        $faturamentoAtual = 879;
        $gastos = 56;
        $emrpesaAtiva =  true;

        $anoEmpresa = $anoAtual - $snoFundacao;
        $lucro = $faturamentoAtual - $gastos;

        echo "A idade da empresa é: " . ($anoEmpresa);
        echo "O Lucro da empresa é: " . ($lucro);
        echo "Status da empresa é: " . ($emrpesaAtiva? "Ativa" : "Desativada");
        
        


    ?>
</body>
</html>