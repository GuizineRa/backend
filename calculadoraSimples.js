//Calculadora simples em JavaScript
var prompt = require("prompt-sync"); //import da biblioteca

//funcpes de cálculo

//soma
function soma(a, b){
    return(a+b);
}
//sub
function sub (a,b){
    return (a-b);

}
//multi
function multi (a,b){
    return (a*b);

}
function div(a,b){
    return (a/b);

}
//menu
function menu(){
    let operacao;
    let numero1;
    let numero2;
    let resultado;
    console.log("===calculadora Simples===");
    console.log("| 1. Soma           ");
    console.log("| 2. subtração      ");
    console.log("| 3. Multiplicação  ");
    console.log("| ")
}