//Importar prompt-sync

const prompt = require('prompt-sync')();

// Função principal
function consultaDragonBall() {
    // 1. Solicitar ao usuário que insira um CEP 2. Monta a URL 3. Faz a req (GET) 4. Retorna os dados.
    const nome = prompt('Digite o nome (Somente letras ): ').trim(); // Remove espaços em branco

  const url = `https://dragonball-api.com/api/characters?name=${nome}`;

fetch(url)
    .then((resposta) => { //Converter a resposta em JSON
        return resposta.json();
    })
    .then((dados) => {
        //Nome Inválido?
        if (dados.erro) {
            console.log('Nome inválido. Por favor, tente novamente.');
            return;
        }
        console.log('Dados do Personagem:');
        console.log("Nome:", dados[0].name);
        console.log("Raça:", dados[0].race);
        console.log("Gênero:", dados[0].gender);
        console.log("Ki:", dados[0].ki);
        console.log("MaxKi:", dados[0].maxKi);
    })
    .catch((error) => {
        console.error('Erro ao consultar o Nome:', error);
    });
}
consultaDragonBall();