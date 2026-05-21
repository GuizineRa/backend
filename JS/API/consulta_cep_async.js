// Importa prompt-sync para ler a entrada do usuário
const prompt = require('prompt-sync')();

function consultarCEP() {
    // 1. Solicita o CEP | 2.Monta a URL da API | 3. Faz a requisição HTTP (GET) | 4. Retornar os dados do endereço ou mensagem de erro
    const inputCEP = prompt("Digite o CEP para consulta (somente números): ").trim();
    
    const url = `https://viacep.com.br/ws/${inputCEP}/json/`;

    fetch(url).then((resposta) => {
        return resposta.json();
    }).then((dados) => {
        // CEP válido?
        if (dados.erro) {
            console.log("CEP não encontrado! Verifique o número e tente novamente.");
            return;
        }
        // Exibe os dados do CEP
        console.log("Dados do CEP: ");
        console.log(`CEP: ${dados.cep}`);
        console.log(`Logradouro: ${dados.logradouro}`);
        console.log(`Bairro: ${dados.bairro}`);
        console.log(`Localidade: ${dados.localidade}`);
        console.log(`UF: ${dados.uf}`);
    })
    .catch((error) => {
        console.error("Erro ao consultar o CEP: ", error);
    });

}
consultarCEP();