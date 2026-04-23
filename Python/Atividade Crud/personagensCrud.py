import json

import os

#Menu de personagens
def menu():
    print("\n === Menu de Personagens ===")
    print("1. Adicionar")
    print("2. Listar")
    print("3. Atualizar")
    print("4. Excluir")
    print("5. Sair")

#Função para escolher a classe do personagem
def escolher_classe():
    print("\nClasse do personagem")
    print("1. DPS")
    print("2. Tanque")
    print("3. Suporte")

    opcao = input("Escolha: ")

    match (opcao):
        case "1":
            return "dps"
        case "2":
            return "tanques"
        case "3":
            return "suporte"
        case _:
            print("Opção inválida.")
            return None
        
#Função para ler o JSON
def ler_dados():
    with open("personagem.json", "r", encoding="utf-8") as arquivo:
        return json.load(arquivo)
    
def salvar_dados(dados):
    with open("personagem.json", "w", encoding="utf-8") as arquivo:
        json.dump(dados, arquivo, indent=4, ensure_ascii=False)

#adicionar personagem
def adicionar():
    classe = escolher_classe()

    if not classe: 
        return
    
    nome = input("Nome: ")
    tipo = input("Tipo: ")

    dados = ler_dados()

    dados[classe].append({
        "nome": nome,
        "tipo": tipo
    })

    salvar_dados(dados)
    print("Personagem adicionado com sucesso!")

#Função Listar
def listar_personagens():
    dados = ler_dados()

    print("\n=== Lista de Personagens ===")

    for classe, personagens in dados.items():
        print(f"\nClasse: {classe.upper()}")

        if not personagens:
            print("  Nenhum personagem cadastrado.")
        else:
            contador = 1
            for personagem in personagens:
                print(f"  {contador}. Nome: {personagem['nome']} | Tipo: {personagem['tipo']}")
                contador += 1

#Função atualizar o personagem (Modificar tipo, classe, nome.)
def atualizar():
    
    classe = escolher_classe()

    if not classe:
        return
    
    dados = ler_dados()
    personagens = dados[classe]

    if not personagens:
        print("Nenhum personagem para atualizar.")
        return

    print("\nPersonagens disponíveis:")
    for p in personagens:
        print(f"- {p['nome']} ({p['tipo']})")

    nome = input("\nDigite o nome do personagem que deseja atualizar: ")

    for personagem in personagens:
        if personagem["nome"].lower() == nome.lower():
            novo_nome = input("Novo nome: ")
            novo_tipo = input("Novo tipo: ")

            if novo_nome:
                personagem["nome"] = novo_nome
            if novo_tipo:
                personagem["tipo"] = novo_tipo

            salvar_dados(dados)
            print("Personagem atualizado com sucesso!")
            return

    print("Personagem não encontrado.")

#Função excluir
def excluir():
    classe = escolher_classe()

    if not classe:
        return
    
    dados = ler_dados()
    personagens = dados[classe]

    if not personagens:
        print("Nenhum personagem para excluir.")
        return

    print("\nPersonagens disponíveis:")
    for p in personagens:
        print(f"- {p['nome']} ({p['tipo']})")

    nome = input("\nDigite o nome do personagem que deseja excluir: ")

    for personagem in personagens:
        if personagem["nome"].lower() == nome.lower():
            personagens.remove(personagem)
            salvar_dados(dados)
            print("Personagem excluído com sucesso!")
            return

    print("Personagem não encontrado.")


def main():
    if not os.path.exists("personagem.json"):
        with open("personagem.json", "w", encoding="utf-8") as arquivo:
            json.dump({"dps": [], "tanques": [], "suporte": []}, arquivo, indent=4, ensure_ascii=False)

    while True:
        menu()
        opcao = input("Escolha uma opção: ")

        match (opcao):
            case "1":
                adicionar()
            case "2":
                listar_personagens()
            case "3":
                atualizar()
            case "4":
                excluir()
            case "5":
                print("Saindo...")
                break
            case _:
                print("Opção inválida. Tente novamente.")

main()