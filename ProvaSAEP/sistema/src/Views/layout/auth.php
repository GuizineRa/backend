<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso ao Sistema - Clínica Veterinária</title>
    <style>
        :root {
            --primary: #2b6cb0;
            --primary-hover: #2c5282;
            --bg-light: #edf2f7;
            --border: #e2e8f0;
            --text-dark: #2d3748;
            --radius: 8px;
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .auth-container {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: var(--radius);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border);
            padding: 2rem;
        }

         .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-header h1 {
            font-size: 1.5rem;
            color: var(--primary);
            margin-top: 0.5rem;
        }
        .auth-header p {
            color: #718096;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        label {
            display: block;
            margin-bottom: 0.35rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 4px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        }

                .btn-submit {
            width: 100%;
            background-color: var(--primary);
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            background-color: var(--primary-hover);
        }
        .alert {
            padding: 0.85rem;
            border-radius: 4px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }
        .alert-erro {
            background-color: #fed7d7;
            color: #9b2c2c;
            border: 1px solid #feb2b2;
        }
        .alert-sucesso {
            background-color: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }

              .auth-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.8rem;
            color: #718096;
            border-top: 1px solid var(--border);
            padding-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <?= $conteudo ?>
    </div>
</body>
</html>