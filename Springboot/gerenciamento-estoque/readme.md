# Levantamento de requisitos

## Sistema de gerenciamento de estoque e Ativos Patrimoniais - SENAI-SP

# 1. Requisitos Funcionais (RF)
Os requisitos funcionais descrevem as funcionalidades que o sistema deve executar.

# RF01 - Cadastro de Materias
O sistema deve cadastrar novos materiais no estoque

Dados do material:

- Nome do material

- Descrição

- Categoria

- Quantidade em estoque

- Unidade de medida

- Local de armazenamento

# RF02 - Consulta de materiais

O sistema deve permitir visualizar a lista de materiais cadastrados.

A consulta deve permitir:

- buscar materiais por nome

- filtrar por categoria

- visualizar quantidade disponível

# RF03 – Atualização de Materiais

O sistema deve permitir atualizar informações de materiais cadastrados.

Exemplo:

- alterar descrição

- alterar categoria

- atualizar quantidade

# RF04 – Exclusão de Materiais
O sistema deve permitir remover materiais cadastrados no sistema.

# RF05 – Cadastro de Categorias

O sistema deve permitir cadastrar categorias de materiais.

Exemplos:

- Eletrônicos

- Ferramentas

- Componentes eletrônicos

- Materiais de escritório

# RF06 – Consulta de Categorias

O sistema deve permitir visualizar todas as categorias cadastradas.

# RF07 - Atualização de Categorias

O sistema deve permitir editar informações das categorias.

# RF08 – Exclusão de Categorias

O sistema deve permitir excluir categorias cadastradas.

# RF09 – Registro de Entrada de Estoque

O sistema deve permitir registrar entradas de materiais no estoque.

Dados registrados:

- material

- quantidade

- data da entrada

- responsável

- observação

# RF10 – Registro de Saída de Estoque

O sistema deve permitir registrar saídas de materiais do estoque.

Dados registrados:

- material

- quantidade

- data da saída

- responsável

- destino (laboratório ou sala)

# RF11 – Histórico de Movimentações

O sistema deve manter um histórico completo de movimentações de estoque.

O usuário poderá visualizar:

- entradas

- saídas

- data

- responsável

# RF12 – Cadastro de Ativos Patrimoniais

O sistema deve permitir cadastrar ativos patrimoniais da instituição.

Exemplos:

- computadores

- projetores

- máquinas

- equipamentos de laboratório

# RF13 – Consulta de Ativos Patrimoniais

O sistema deve permitir consultar os ativos cadastrados.

Filtros possíveis:

- localização

- tipo de ativo

- estado de conservação

# RF14 – Atualização de Ativos Patrimoniais

O sistema deve permitir atualizar as informações de um ativo patrimonial.

# RF15 – Exclusão de Ativos Patrimoniais

O sistema deve permitir excluir ativos patrimoniais cadastrados.

# RF16 – Visualização de Inventário

O sistema deve permitir visualizar o inventário completo de materiais e ativos patrimoniais.

# 2. Requisitos não Funcionais (RNF)

# RNF01 – Usabilidade

A interface do sistema deve ser intuitiva e fácil de usar para usuários da unidade escolar.

# RNF02 – Responsividade

A interface deve se adaptar a diferentes tamanhos de tela, incluindo:

- computadores

- tablets

- celulares

# RNF03 – Identidade Visual

A interface deve seguir o Manual de Identidade Visual do SENAI-SP, incluindo:

- cores institucionais

- tipografia

- logotipo

# RNF04 – Performance

O sistema deve responder às requisições da API em até 2 segundos em condições normais de uso.

# RNF05 – Segurança

O sistema deve proteger os dados contra acessos não autorizados.

# RNF06 – Integridade de Dados

O banco de dados deve garantir consistência das informações armazenadas.

# RNF07 – Escalabilidade

O sistema deve permitir expansão futura para suportar mais usuários e funcionalidades.

# RNF08 – Compatibilidade

A interface deve funcionar corretamente nos navegadores modernos:

- Google Chrome

- Microsoft Edge

- Mozilla Firefox

# RNF09 – Manutenibilidade

O código do sistema deve ser organizado e documentado para facilitar manutenção futura.

# RNF10 – Disponibilidade

O sistema deve estar disponível durante o horário de funcionamento da unidade escolar.