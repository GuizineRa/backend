<div class="card" style="max-width: 650px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Novo Tutor</h1>
        <a href="/tutores" class="btn btn-secondary btn-sm">&larr; Voltar</a>
    </div>
    <?php if (!empty($erros)): ?>
        <div class="alert alert-erro">
            <ul style="margin-left: 1.25rem;">
                <?php foreach ($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="/tutores/salvar" method="POST">
        <div class="form-group">
            <label for="nome">Nome Completo *</label>
            <input 
                type="text" 
                id="nome" 
                name="nome" 
                class="form-control" 
                placeholder="Ex: Mariana de Souza" 
                value="<?= htmlspecialchars($dados['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                required
            >
        </div>
        <div class="form-group">
            <label for="cpf">
                CPF do Tutor *
                <small style="color: var(--primary); font-weight: normal;">(Armazenado com criptografia AES-256 - LGPD)</small>
            </label>
            <input 
                type="text" 
                id="cpf" 
                name="cpf" 
                class="form-control cpf-mask" 
                placeholder="000.000.000-00" 
                value="<?= 
htmlspecialchars($dados['cpf'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                required
            >
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="telefone">Telefone / WhatsApp *</label>
                <input 
                    type="text" 
                    id="telefone" 
                    name="telefone" 
                    class="form-control" 
                    placeholder="(00) 00000-0000" 
                    value="<?= htmlspecialchars($dados['telefone'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                    required
                >
            </div>
            <div class="form-group">
                <label for="email">E-mail *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    placeholder="tutor@email.com" 
                    value="<?= htmlspecialchars($dados['email'] ?? '', ENT_QUOTES,'UTF-8') ?>" 
                    required
                >
            </div>
        </div>
        <div style="display: flex; gap: 0.75rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Salvar Tutor</button>
            <a href="/tutores" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>