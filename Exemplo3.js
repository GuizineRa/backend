//Estruturas de Dados

//Condicionais (If Else // Switch Case)

//IF - ELSE

var precoProduto = 150;
//Se o preço do produto >= 100 - Desconto de 10%
if (precoProduto >= 100) {
  console.log("Valor a Pagar: " + precoProduto * 0.9);
} else {
  console.log("Valor a pagar: " + precoProduto);
}
//Condicional intermediária (Else if)
// preco > 200 15% desc// preço >100 10% desc //
if (precoProduto >= 200) {
  console.log("Valor do produto: " + precoProduto * 0.85);
} else if (precoProduto >= 100) {
  console.log("Valor do produto: " + precoProduto * 0.9);
} else {
  console.log("Valor do produto: " + precoProduto);
}

//Switch Case
var mes = 4;
switch(mes){
    case 1:
        console.log ("Janeiro");
        break;
    case 2:
        console.log("Fevereiro");
        break;
    case 3:
        console.log("Março");
        break;
    case 4:
        console.log("Abril");
        break;
default:
    console.log("Outro Mês");
    break;
}

//Estrutura de Repetição (For While)

//For ()
for(let i=0; i<=100;i++){
    console.log(i);
}

//While (Incontáveis)
var continuar = true;
var numEscolhido = 3;
var contador = 0;
while(continuar){
    contador++;
    let numeroSorteado = Math.round(Math.random()*10);
    if(numeroSorteado == numEscolhido){
        continuar = false;
        console.log("acertou Miseravi");
        console.log("Tentativas ="+contador);
    }
}

//funções (Functions)
//Ações específicas que podem ser chamadas a qualquer momeno dentro do código
function ola (nome){ //Função com retorno
    return "Olá,"+nome;
}

function hello (nome){ //Function void
    console.log(ola("Hello, "+nome));
}
console.log(ola("Diogo"));

hello("Diogo");

//Explicando o math
//Random ( Sortear um numero entre  e 1)
//Exemplo: 0.954321 / 0.23456 / 0.65432
//Math round - Arredonda para o número para um inteiro
//Exemplo: 0.954321 => 1 / 0.23456 => 0 / 0.65432 => 1
//Math random * 10 - Sorteia um número entre 0 e 10