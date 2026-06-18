<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: cadastro.html");
    exit();
} 
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil - Steam</title>
    <link rel="stylesheet" href="../CSS/perfil.css"> 
</head>
<body>

    <header>
        <div class="header-logo">
            <img src="../IMG/Design sem nome.svg" class="logo" alt="Steam">
        </div>
        
        <nav>
            <div class="menu-esquerda">
                <a href="index.php">Catálogo</a>
                <a href="perfil.php">Perfil</a>
            </div>
            <div class="menu-direita">
                <span>Nome user</span>
                <input type="text" placeholder="Pesquisar jogos...">
                <button>🔍</button>
            </div>
        </nav>
    </header>

    <main>
        <h1>Gerenciamento de Conta</h1> 

        <div class="cadastro-box">
            <h2>Editar Perfil</h2>
            
            <form class="cadastro-form" action="../PHP/alterar.php" method="POST">

                <input type="text" name="nome" placeholder="Novo nome de usuário...">

                <input type="email" name="email" placeholder="Novo e-mail...">

                <input type="password" name="senha" placeholder="Nova senha...">

                <input type="password" name="confirmar_senha" placeholder="Confirmar nova senha...">

                <button type="submit">Salvar Alterações</button>

            </form>

            <form action="../PHP/deletar.php" method="POST">

                <button type="submit" class="btn-excluir">
                    Excluir Conta
                </button>

            </form>
        </div>
    </main>

    <footer>
        <img src="../IMG/Design sem nome.svg" class="footer-logo" alt="Steam Footer">
    </footer>

</body>
</html>