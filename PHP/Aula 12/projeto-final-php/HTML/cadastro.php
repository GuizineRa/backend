<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam - Cadastro</title>

    <link rel="stylesheet" href="../CSS/cadastro.css">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <header>

    <div class="header-logo">
        <img src="../IMG/Design sem nome.svg"
             alt="Steam Logo"
             class="logo">
    </div>

    <div class="header-title">
        <h1>CADASTRAR</h1>
    </div>

</header>

  <main>

    <section class="cadastro-container">

        <div class="cadastro-box">

            <h2>Cadastre-se</h2>

           <form action="login.php" method="POST">

    <label>Nome:</label>
    <input type="text" name="nome">

    <label>Email:</label>
    <input type="email" name="email">

    <label>Senha:</label>
    <input type="password" name="senha">

    <label>Confirmar senha:</label>
    <input type="password" name="confirmar">

    <button type="submit">
        Cadastrar
    </button>

</form>

        </div>

    </section>

</main>

    <footer>

        <img src="../IMG/Design sem nome.svg" alt="Steam Logo" class="footer-logo">



    </footer>

</body>

</html>