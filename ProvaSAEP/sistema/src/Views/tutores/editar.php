<div class="card" style="max-width: 650px; margin: 0 auto;">
    <div class="card-header">
        <div>
            <h1 class="card-title">Editar Tutor</h1>
            <p style="color: var(--text-muted); font-size: 0.85rem;">Alteração cadastral com preservação de criptografia do CPF.</p>
        </div>
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
    <form action="/tutores/atualizar" method="POST">
        <input type="hidden" name="id" value="<?= (int)$tutor['id'] ?>">
        <div class="form-group">
            <label for="nome">Nome Completo *</label>
            <input 
                type="text" 
                id="nome" 
                name="nome" 
                class="form-control" 
                value="<?= htmlspecialchars($tutor['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                required
            >
        </div>
        <div class="form-group">
            <label for="cpf">
                CPF do Tutor *
                <small style="color: var(--primary); font-weight: normal;">(Criptografado com AES-256 no banco de dados)</small>
            </label>
            <input 
                    type="text" 
                id="cpf" 
                name="cpf" 
                class="form-control cpf-mask" 
                value="<?= htmlspecialchars($tutor['cpf_formatado'] ?? $tutor['cpf_descriptografado'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
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
                    value="<?= htmlspecialchars($tutor['telefone'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
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
                    value="<?= htmlspecialchars($tutor['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                    required
                >
            </div>
        </div>

         <div style="display: flex; gap: 0.75rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Salvar Alterações</button>
            <a href="/tutores" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>