!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Veterinária - Gestão & LGPD</title>
    <style>
        :root {
            --primary: #2b6cb0;
            --primary-hover: #2c5282;
            --secondary: #4a5568;
            --success: #2f855a;
            --danger: #c53030;
            --warning: #d69e2e;
            --bg-light: #f7fafc;
            --bg-card: #ffffff;
            --border: #e2e8f0;
            --text-dark: #2d3748;
            --text-muted: #718096;
            --radius: 8px;
            --shadow: 0 2px 4px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

              /* Barra de Navegação */
        .navbar {
            background-color: var(--primary);
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 1.25rem;
            align-items: center;
        }
        .navbar-nav a {
            color: #edf2f7;
            text-decoration: none;
            font-weight: 500;
            padding: 0.35rem 0.65rem;
            border-radius: 4px;
            transition: background-color 0.2s, color 0.2s;
        }

           .navbar-nav a:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }
        .navbar-user {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.9rem;
        }
        .btn-logout {
            background-color: #e53e3e;
            color: white !important;
            padding: 0.35rem 0.75rem !important;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn-logout:hover {
            background-color: #c53030 !important;
        }

           /* Container Principal */
        .container {
            max-width: 1100px;
            width: 100%;
            margin: 2rem auto;
            padding: 0 1rem;
            flex: 1;
        }
        /* Alertas e Mensagens Flash */
        .alert {
            padding: 1rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .alert-sucesso {
            background-color: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }
        .alert-erro {
            background-color: #fed7d7;
            color: #742a2a;
            border: 1px solid #feb2b2;
        }
        .alert-info {
            background-color: #bee3f8;
            color: #2a4365;
            border: 1px solid #90cdf4;
        }

           /* Cards e Painéis */
        .card {
            background: var(--bg-card);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border);
        }
        .card-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        /* Tabelas */
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            padding: 0.85rem;
            border-bottom: 1px solid var(--border);
        }

           th {
            background-color: #edf2f7;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--secondary);
        }
        tr:hover td {
            background-color: #f8fafc;
        }
        /* Formulários e Botões */
        .form-group {
            margin-bottom: 1.25rem;
        }
        label {
            display: block;
            margin-bottom: 0.35rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-dark);
        }
        .form-control {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1px solid var(--border);
            border-radius: 4px;
            font-size: 0.95rem;
            background-color: #ffffff;
            color: var(--text-dark);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

              }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
        }
        .btn {
            display: inline-block;
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 0.9rem;
            transition: background-color 0.2s, opacity 0.2s;
            text-align: center;
        }
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
        }
        .btn-success {
            background-color: var(--success);
            color: white;
        }
        .btn-success:hover {
            opacity: 0.9;
        }
        .btn-secondary {
            background-color: #e2e8f0;
            color: var(--text-dark);
        }
        .btn-secondary:hover {
            background-color: #cbd5e0;
        }

           .btn-sm {
            padding: 0.35rem 0.65rem;
            font-size: 0.8rem;
        }
        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-lgpd {
            background-color: #ebf8ff;
            color: #2b6cb0;
            border: 1px solid #bee3f8;
            font-family: monospace;
        }
        .badge-status {
            background-color: #feebc8;
            color: #7b341e;
        }
        /* Barra de Busca */
        .search-box {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            align-items: center;
        }
        .search-box input {
            flex: 1;
        }

          /* Rodapé */
        footer {
            background-color: #ffffff;
            border-top: 1px solid var(--border);
            padding: 1.25rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Barra de Navegação Superior -->
    <nav class="navbar">
        <a href="/" class="navbar-brand">
            🐾 Clínica Veterinária
        </a>
        <?php if (!empty($usuarioLogado)): ?>
            <ul class="navbar-nav">
                <li><a href="/">Início</a></li>
                <li><a href="/tutores">Tutores</a></li>
                <li><a href="/pets">Pets</a></li>
                <li><a href="/agendamentos">Agendamentos</a></li>
            </ul>

                <div class="navbar-user">
                <span>Olá, <strong><?= htmlspecialchars($usuarioLogado['nome'], ENT_QUOTES, 'UTF-8') ?></strong></span>
                <a href="/logout" class="btn-logout" title="Encerrar sessão de trabalho">Sair</a>
            </div>
        <?php endif; ?>
    </nav>
    <!-- Conteúdo Principal -->
    <main class="container">
        <!-- Alertas de Feedback Flash -->
        <?php if (!empty($mensagemFlash)): ?>
            <div class="alert alert-<?= htmlspecialchars($mensagemFlash['tipo'] ?? 'info', ENT_QUOTES, 'UTF-8') ?>">
                <span><?= htmlspecialchars($mensagemFlash['texto'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
        <?php endif; ?>
        <!-- View Renderizada -->
        <?= $conteudo ?>
    </main>
    <!-- Rodapé -->
    <footer>
        <p>Sistema de Gestão Veterinária &copy; <?= date('Y') ?> &bull; Proteção de Dados Pessoais em conformidade com a LGPD (AES-256)</p>
    </footer>
    <!-- JavaScript Mínimo para Máscaras e Usabilidade -->
    <script>

            // Máscara simplificada de CPF (000.000.000-00)
        document.querySelectorAll('.cpf-mask').forEach(function(input) {
            input.addEventListener('input', function(e) {
                let v = e.target.value.replace(/\D/g, '');
                if (v.length > 11) v = v.slice(0, 11);
                v = v.replace(/(\d{3})(\d)/, '$1.$2');
                v = v.replace(/(\d{3})(\d)/, '$1.$2');
                v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = v;
            });
        });
    </script>
</body>
</html>