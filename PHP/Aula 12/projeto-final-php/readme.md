# GameVault - Catálogo de Jogos

## Projeto Integrador - Desenvolvimento Web com PHP

---

# 1. Introdução

A STEAM é um sistema web desenvolvido em PHP com banco de dados postgresql, inspirado em plataformas de distribuição digital de jogos.

O sistema permite que usuários realizem cadastro, login e gerenciamento de suas informações pessoais, além de visualizar um catálogo de jogos disponível na plataforma.

O projeto tem como objetivo aplicar os conceitos de desenvolvimento web estudados durante a disciplina, incluindo integração com banco de dados, manipulação de formulários e implementação completa do CRUD.

---

# 2. Objetivo

A STEAM permite que usuários criem uma conta, realizem autenticação e acessem um catálogo de jogos disponível, no qual o usuário pode baixar/instalar jogos, apenas para usuários cadastrados.

---

# 3. Escopo

O sistema será composto por duas áreas principais.

## Área do Usuário

- Cadastro de conta.
- Login.
- Visualização de perfil.
- Alteração de dados.
- Exclusão da conta.

## Área do Catálogo

- Exibição dos jogos.
- Visualização de detalhes dos jogos.

---

# 4. Tecnologias Utilizadas

- PHP 8+
- postgreSQL
- PDO
- HTML5
- CSS3
- JavaScript
- Git

---

# 5. Requisitos Funcionais

## RF01

O sistema deve permitir o cadastro de novos usuários.

## RF02

O sistema deve permitir que usuários realizem login.

## RF03

O sistema deve permitir a edição dos dados do usuário.

## RF04

O sistema deve permitir a alteração de senha.

## RF05

O sistema deve permitir a exclusão da conta.

## RF06

O sistema deve exibir um catálogo de jogos.

## RF07

O sistema deve exibir detalhes dos jogos cadastrados.

## RF08

O sistema deve impedir o acesso ao catálogo sem autenticação.+

---

# 6. Requisitos Não Funcionais

## RNF01

O sistema deve utilizar postgresql como banco de dados.

## RNF02

O sistema deve utilizar PHP como linguagem backend.

## RNF03

As senhas devem ser armazenadas utilizando hash.

## RNF04

A interface deve ser acessível via navegador web.

## RNF05

O sistema deve possuir organização modular dos arquivos.

---

# 7. Casos de Uso

## Ator Principal

- Usuário

## Casos de Uso

- Criar conta
- Realizar login
- Editar perfil
- Alterar senha
- Excluir conta
- Visualizar catálogo
- Visualizar detalhes do jogo

---

# 8. Diagrama de Casos de Uso

```mermaid
flowchart LR

Usuario[Usuário]

UC1((Cadastrar Conta))
UC2((Login))
UC3((Editar Perfil))
UC4((Alterar Senha))
UC5((Excluir Conta))
UC6((Visualizar Catálogo))
UC7((Visualizar Jogo))

Usuario --> UC1
Usuario --> UC2
Usuario --> UC3
Usuario --> UC4
Usuario --> UC5
Usuario --> UC6
Usuario --> UC7
```

---

# 9. Modelo Entidade-Relacionamento

```mermaid
erDiagram

USUARIOS {
    INTEGER id
    TEXT nome
    TEXT email
    TEXT senha
}

JOGOS {
    INTEGER id
    TEXT titulo
    TEXT genero
    TEXT desenvolvedora
    INTEGER ano_lancamento
    TEXT descricao
    TEXT imagem
}
```

---

# 10. Banco de Dados

## Tabela usuarios

```sql
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);
```

## Tabela jogos

```sql
CREATE TABLE jogos (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    desenvolvedora VARCHAR(100) NOT NULL,
    ano_lancamento INTEGER,
    descricao TEXT,
    imagem TEXT
);
```

---

# 11. Estrutura de Arquivos

```text
gamevault/
│
├── banco.db
├── conexao.php
│
├── index.php
├── login.php
├── logout.php
│
├── cadastrar.php
├── perfil.php
├── editar_usuario.php
├── excluir_usuario.php
│
├── catalogo.php
├── jogo.php
│
├── css/
│   └── style.css
│
└── imagens/
```

---

# 12. Operações CRUD

## CREATE

Responsável pelo cadastro de novos usuários.

```sql
INSERT INTO usuarios (nome, email, senha)
VALUES (?, ?, ?);
```

## READ

Responsável pela consulta dos dados do usuário.

```sql
SELECT * FROM usuarios;
```

## UPDATE

Responsável pela atualização das informações do usuário.

```sql
UPDATE usuarios
SET nome = ?, email = ?, senha = ?
WHERE id = ?;
```

## DELETE

Responsável pela exclusão da conta.

```sql
DELETE FROM usuarios
WHERE id = ?;
```

---

# 13. Fluxo de Navegação

```mermaid
flowchart TD

Inicio[Início]

Cadastro[Cadastro]
Login[Login]

Catalogo[Catálogo]
Perfil[Perfil]

Editar[Editar Perfil]
Excluir[Excluir Conta]

Inicio --> Cadastro
Inicio --> Login

Login --> Catalogo
Login --> Perfil

Perfil --> Editar
Perfil --> Excluir
```

---

# 14. Segurança

As seguintes práticas serão utilizadas:

- Prepared Statements para consultas SQL.
- PDO para acesso ao banco de dados.
- Armazenamento seguro de senhas utilizando `password_hash()`.
- Validação de formulários.
- Controle de sessão através de `$_SESSION`.
- Proteção contra SQL Injection.

---

# 15. Checklist dos Requisitos da Atividade

| Requisito | Status |
|------------|---------|
| Planejamento do sistema | ✔ |
| Banco postgresql | ✔ |
| CREATE | ✔ |
| READ | ✔ |
| UPDATE | ✔ |
| DELETE | ✔ |
| Organização dos arquivos | ✔ |
| Conexão reutilizada | ✔ |
| Código comentado | ✔ |
| Fluxo funcional completo | ✔ |

---

# 16. Possíveis Melhorias Futuras

- Sistema de favoritos.
- Biblioteca de jogos do usuário.
- Sistema de avaliações.
- Comentários em jogos.
- Upload de foto de perfil.
- Recuperação de senha.

---

