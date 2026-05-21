<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de aluno</title>

    <style>

        /* RESET */
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body{
    font-family: Arial, Helvetica, sans-serif;

    background: linear-gradient(135deg, #4facfe, #00f2fe);

    min-height: 100vh;

    display: flex;
    flex-direction: column;

    justify-content: center;
    align-items: center;

    padding: 20px;

    transition: 0.4s;
}

/* FORMULÁRIO */
form{
    background-color: white;

    width: 100%;
    max-width: 420px;

    padding: 30px;

    border-radius: 15px;

    box-shadow: 0 8px 20px rgba(0,0,0,0.2);

    display: flex;
    flex-direction: column;

    gap: 15px;

    transition: 0.4s;
}

/* TITULO */
form h2{
    text-align: center;
    color: #333;
}

/* LABEL */
label{
    font-weight: bold;
    color: #555;
}

/* INPUTS */
input{
    padding: 12px;

    border: 1px solid #ccc;

    border-radius: 8px;

    font-size: 15px;

    transition: 0.3s;
}

input:focus{
    border-color: #4facfe;

    outline: none;

    box-shadow: 0 0 8px rgba(79,172,254,0.5);
}

/* BOTÕES */
.botoes{
    display: flex;
    gap: 10px;
}

input[type="submit"],
input[type="reset"]{
    flex: 1;

    cursor: pointer;

    border: none;

    color: white;

    font-weight: bold;
}

input[type="submit"]{
    background-color: #4facfe;
}

input[type="submit"]:hover{
    background-color: #2196f3;
}

input[type="reset"]{
    background-color: #ff5e62;
}

input[type="reset"]:hover{
    background-color: #e53935;
}

/* BOTÃO DARKMODE */
.dark-btn{
    position: absolute;

    top: 20px;
    right: 20px;

    border: none;

    padding: 12px 18px;

    border-radius: 10px;

    cursor: pointer;

    background-color: #222;

    color: white;

    font-weight: bold;

    transition: 0.3s;

    text-decoration: none;
}

.dark-btn:hover{
    transform: scale(1.05);
}

/* INFORMAÇÕES SALVAS */

.infos{
    margin-top: 20px;

    background-color: white;

    padding: 20px;

    border-radius: 10px;

    width: 100%;
    max-width: 420px;

    text-align: left;

    box-shadow: 0 5px 15px rgba(0,0,0,0.2);

    transition: 0.4s;

    color: #333;
}

.infos h3{
    margin-bottom: 15px;

    color: #222;
}

.infos p{
    margin: 8px 0;

    font-size: 16px;
}

/* DARK MODE */

body.dark{
    background: linear-gradient(135deg, #111, #222);
}

body.dark form{
    background-color: #1f1f1f;
}

body.dark form h2{
    color: white;
}

body.dark label{
    color: #ddd;
}

body.dark input{
    background-color: #2d2d2d;

    color: white;

    border: 1px solid #555;
}

body.dark input::placeholder{
    color: #aaa;
}

body.dark .infos{
    background-color: #2b2b2b;

    color: #ddd;
}

body.dark .infos h3{
    color: white;
}

/* Isso é um adicional, tentei fazer isso para colocar o background para cinza, mas não deu certo... */

.infos,
.infos p,
.infos strong,
.infos h3{
    color: #333 !important;
}

body.dark .infos,
body.dark .infos p,
body.dark .infos strong,
body.dark .infos h3{
    color: #252323 !important;
}

    </style>
</head>

<?php

    
    // Cookie Do Tema
    
    $tema = "light";

    if(isset($_COOKIE['tema'])){
        $tema = $_COOKIE['tema'];
    }

    if(isset($_GET['tema'])){

        $tema = $_GET['tema'];

        setcookie("tema", $tema, time() + (86400 * 30));

    }

    $novoTema = ($tema == "dark") ? "light" : "dark";


    
    // Salvar dados do form

    if(isset($_POST['enviar'])){

        setcookie("nome", $_POST['Name'], time() + 3600);

        setcookie("email", $_POST['email'], time() + 3600);

        setcookie("cpf", $_POST['cpf'], time() + 3600);

        setcookie("telefone", $_POST['telefone'], time() + 3600);

    }

?>

<body class="<?php echo $tema; ?>">

    <!-- Botão do dark mode -->

    <a href="?tema=<?php echo $novoTema; ?>" class="dark-btn">
        🌙 Dark Mode
    </a>

    <!-- Formulário -->

    <form method="POST">

        <h2>Cadastro de aluno</h2>

        <label>Nome</label>
        <input
            type="text"
            name="Name"
            placeholder="Nome"
            required
            value="<?php echo $_COOKIE['nome'] ?? ''; ?>"
        >

        <label>E-mail</label>
        <input
            type="email"
            name="email"
            placeholder="E-mail"
            required
            value="<?php echo $_COOKIE['email'] ?? ''; ?>"
        >

        <label>CPF</label>
        <input
            type="number"
            name="cpf"
            placeholder="CPF..."
            required
            value="<?php echo $_COOKIE['cpf'] ?? ''; ?>"
        >

        <label>Telefone</label>
        <input
            type="tel"
            name="telefone"
            placeholder="Telefone"
            required
            value="<?php echo $_COOKIE['telefone'] ?? ''; ?>"
        >

        <label>Senha</label>
        <input
            type="password"
            name="senha"
            placeholder="Inserir senha"
            required
        >

        <div class="botoes">

            <input type="reset" value="Limpar">

            <input
                type="submit"
                name="enviar"
                value="Enviar"
            >

        </div>

    </form>
    <!-- Mostrar dados salvos -->

<div class="infos" style="
    margin-top: 20px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 420px;
">

    <h3>Informações salvas:</h3>

    <p>
        <strong>Nome:</strong>
        <?php echo $_COOKIE['nome'] ?? 'Não informado'; ?>
    </p>

    <p>
        <strong>E-mail:</strong>
        <?php echo $_COOKIE['email'] ?? 'Não informado'; ?>
    </p>

    <p>
        <strong>CPF:</strong>
        <?php echo $_COOKIE['cpf'] ?? 'Não informado'; ?>
    </p>

    <p>
        <strong>Telefone:</strong>
        <?php echo $_COOKIE['telefone'] ?? 'Não informado'; ?>
    </p>

</div>

</body>
</html>