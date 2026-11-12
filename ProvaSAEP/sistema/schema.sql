-- =====================================================================
-- SCHEMA: Sistema de Gestão de Clínica Veterinária
-- Banco de Dados: PostgreSQL
-- Conformidade: Segurança e LGPD (Criptografia simétrica de CPF)
-- =====================================================================
-- Limpeza preventiva de tabelas (ordem reversa de dependência)
DROP TABLE IF EXISTS agendamentos CASCADE;
DROP TABLE IF EXISTS pets CASCADE;
DROP TABLE IF EXISTS tutores CASCADE;
DROP TABLE IF EXISTS usuarios CASCADE;
-- ---------------------------------------------------------------------
-- 1. TABELA: usuarios
-- Armazena os operadores do sistema (recepcionistas, veterinários, gestores)
-- ---------------------------------------------------------------------
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL
);
-- ---------------------------------------------------------------------
-- 2. TABELA: tutores
-- Armazena dados cadastrais dos tutores.
-- O campo 'cpf' armazena o texto criptografado em AES-256-CBC (Base64 do IV + Ciphertext),
-- garantindo conformidade com a LGPD.
-- ---------------------------------------------------------------------
CREATE TABLE tutores (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cpf VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    email VARCHAR(120) NOT NULL,
    criado_em TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL
);

-- ---------------------------------------------------------------------
-- 3. TABELA: pets
-- Armazena os dados dos animais atendidos.
-- O pet deve obrigatoriamente estar associado a um tutor existente.
-- ---------------------------------------------------------------------
CREATE TABLE pets (
    id SERIAL PRIMARY KEY,
    tutor_id INTEGER NOT NULL REFERENCES tutores(id) ON DELETE CASCADE,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raca VARCHAR(50) NOT NULL,
    data_nascimento DATE NOT NULL,
    criado_em TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL
);
-- ---------------------------------------------------------------------
-- 4. TABELA: agendamentos
-- Armazena as consultas e atendimentos agendados na clínica.
-- Cada agendamento referencia obrigatoriamente um pet cadastrado.
-- ---------------------------------------------------------------------
CREATE TABLE agendamentos (
    id SERIAL PRIMARY KEY,
    pet_id INTEGER NOT NULL REFERENCES pets(id) ON DELETE CASCADE,
    data_agendamento TIMESTAMP WITHOUT TIME ZONE NOT NULL,
    motivo VARCHAR(255) NOT NULL,
    status VARCHAR(30) DEFAULT 'Agendado' NOT NULL,
    criado_em TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL
);

-- =====================================================================
-- POVOAMENTO INICIAL (Mínimo de 3 registros por tabela)
-- =====================================================================
-- Inserção de Usuários
-- Senhas criptografadas com BCRYPT (custo 12):
-- admin@clinica.com       => senha: admin123
-- maria@clinica.com       => senha: recepcao123
-- carlos@clinica.com      => senha: vet123
INSERT INTO usuarios (nome, email, senha) VALUES
('Administrador Geral', 'admin@clinica.com', '$2y$12$.4/SDnF.aE43llS5t6qXhOkI17sz3kE/GMDo6mc4LpRs5/U7lC/W2'),
('Maria Recepcionista', 'maria@clinica.com', '$2y$12$ivb.iP0BjJg4uo1jLZ55nOEt70EgfzxPN7etnEtwJJJWk6790UPe2'),
('Dr. Carlos Veterinário', 'carlos@clinica.com', '$2y$12$WasR2Af6.SMTEbC1qory2uX5IPPOJxEEWkkMFNQa3QQmCnv./gFvm');
-- Inserção de Tutores
-- CPFs protegidos com AES-256-CBC usando a chave do sistema ('c11n1c4_v3t_53cr3t_k3y_2026_lgpd'):
-- Mariana Souza      => CPF original: 12345678901
-- Carlos Eduardo     => CPF original: 98765432100
-- Fernanda Pereira   => CPF original: 45678912345
INSERT INTO tutores (nome, cpf, telefone, email) VALUES
('Mariana Souza', '0ZPQMc55mW6yY4cr4AX/E9j7vHF3sB+H+aX6a201A7k=', '(11) 98765-4321', 'mariana.souza@email.com'),
('Carlos Eduardo Lima', 'uq3M0WTz5LD0zPZ+GQKFDArLqDBS9oXfyajB2b5Ilj4=', '(21) 99876-5432', 'carlos.lima@email.com'),
('Fernanda Pereira', 'wGa6Fi+mgIflLQS+WCfuTDZJT7XZ0lEbT5PI5bzEc2M=', '(31) 97654-3210', 'fernanda.pereira@email.com');

-- Inserção de Pets (Vinculados aos Tutores existentes)
INSERT INTO pets (tutor_id, nome, especie, raca, data_nascimento) VALUES
(1, 'Thor', 'Cachorro', 'Golden Retriever', '2021-05-10'),
(2, 'Mia', 'Gato', 'Siamês', '2022-08-15'),
(3, 'Pipoca', 'Cachorro', 'Poodle', '2020-03-22');
-- Inserção de Agendamentos (Ordenáveis por data_agendamento)
INSERT INTO agendamentos (pet_id, data_agendamento, motivo, status) VALUES
(1, '2026-11-20 09:30:00', 'Consulta de rotina e vacinação anual V10', 'Agendado'),
(2, '2026-11-21 14:00:00', 'Avaliação dermatológica e alergia', 'Agendado'),
(3, '2026-11-22 10:15:00', 'Limpeza de tártaro e profilaxia odontológica', 'Agendado');