//Tipos de operadores

// Operadores Aritméticos (+ - * / %)
var a = 10;
var b = 3;
var c;
//soma
c = a + b;
console.log("Soma: " + c);

//subtração
c = a - b;
console.log("Subtração: " + c);

//multiplicação
c = a * b;
console.log("Multi: " + c);

//Divisão
c = a / b;
console.log("Divisão: " + c);

//Resto da Divisão
c = a % b;
console.log("Resto: " + c);


//Operadores Relacionais(> < >= <= == === != !==)
var a = 10;
var b = 6;
var c = "7";

console.log("relacionais "+(a>b)); //false
//o que importa
console.log("Igualdade Simples"+ (b==c)); //True
console.log("Igualdade Estrita"+ (b===c)); //false
console.log(b+c)

//Operadores Lógicos ( && - E , || - OU , ! - Não)
var nota1 = 5;
var nota2 = 8;

console.log("Aprovação: " +nota1>7 && nota2>7); //false
console.log("Aprovação: " +nota1>7 || nota2>7); //True
console.log("Negação: "+!true); //false

