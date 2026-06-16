<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Steam - Catálogo</title>

    <link rel="stylesheet" href="../CSS/index.css">

    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <header>

        <div class="header-logo">
            <img src="../IMG/stam-logooooooooo.jpg" alt="Steam Logo" class="logo">
        </div>

        <div class="header-title">
            <h1>CATÁLOGO</h1>
        </div>

    </header>

    <nav>

        <div class="menu-esquerda">

            <a href="index.php">Catálogo</a>
            <a href="perfil.php">Perfil</a>

        </div>

        <div class="menu-direita">

            <span>
                <?php echo $_SESSION["usuario"]; ?>
            </span>

            <input
                type="text"
                placeholder="Pesquisar jogos...">

            <button>🔍</button>

        </div>

    </nav>

    <main>

        <section class="banner-principal">

        </section>

        <section class="jogos-grid">

            <a href="#">
                <img src="../IMG/Cuphead_capa.png" class="jogo-card cuphead">
            </a>
            <a href="#">
                <img src="../IMG/fnaf.webp" class="jogo-card">
            </a>
            <a href="#">
                <img src="../IMG/hollow-knight.jpg" class="jogo-card">
            </a>


        </section>

    </main>

    <footer>

        <img
            src="../IMG/Design sem nome.svg"
            alt="Steam Logo"
            class="footer-logo">

    </footer>

</body>

</html>