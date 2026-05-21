<?php
function calcularTempoEmpresa($anoFundacao, $anoAtual) {
    $tempo = $anoAtual - $anoFundacao;
    echo "<p>O tempo da empresa é: $tempo</p>";
}



calcularTempoEmpresa(2000, 2067)

?>