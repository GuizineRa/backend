//Importar prompt-sync

const prompt = require('prompt-sync')();

// Função principal
function consultaCEP() {
    // 1. Solicitar ao usuário que insira um CEP 2. Monta a URL 3. Faz a req (GET) 4. Retorna os dados.
    let cep = prompt('Digite o CEP (Somente números ): ');
    cep = cep.trim(); // Remove espaços em branco

    const url = `https://viacep.com.br/ws/${cep}/json/`;

fetch(url)
    .then((resposta) => { //Converter a resposta em JSON
        return resposta.json();
    })
    .then((dados) => {
        //CEP Inválido?
        if (dados.erro) {
            console.log('CEP inválido. Por favor, tente novamente.');
            return;
        }
        console.log('Dados do CEP:');
        console.log(dados);
        console.log("Logradouro:", dados.logradouro);
        console.log("Bairro:", dados.bairro);
        console.log("Cidade:", dados.localidade);
        console.log("Estado:", dados.estado);
        console.log("UF:", dados.uf);
    })
    .catch((error) => {
        console.error('Erro ao consultar o CEP:', error);
    });
}
consultaCEP();