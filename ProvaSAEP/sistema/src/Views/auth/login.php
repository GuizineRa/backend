<div class="auth-header">
    <div style="font-size: 2.5rem;">🐾</div>
    <h1>Clínica Veterinária</h1>
    <p>Acesse seu ambiente de trabalho</p>
</div>
<?php if (!empty($mensagemErro)): ?>
    <div class="alert alert-erro">
        <?= htmlspecialchars($mensagemErro, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>
<?php if (!empty($mensagemSucesso)): ?>
    <div class="alert alert-sucesso">
        <?= htmlspecialchars($mensagemSucesso, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>
<form action="/login" method="POST">
    <div class="form-group">
        <label for="email">E-mail de Acesso</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            class="form-control" 
            placeholder="usuario@clinica.com" 
            value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>" 
            required 
            autofocus
        >
    </div>
    <div class="form-group">
        <label for="senha">Senha</label>
        <input 
            type="password" 
            id="senha" 
            name="senha" 
            class="form-control" 
            placeholder="••••••••" 
            required
        >
    </div>

     <button type="submit" class="btn-submit">Entrar no Sistema</button>
</form>
<div class="auth-footer">
    <p><strong>Credenciais para teste rápido:</strong></p>
    <p style="margin-top: 4px;"><code>admin@clinica.com</code> / <code>admin123</code></p>
    <p style="margin-top: 4px;"><code>maria@clinica.com</code> / <code>recepcao123</code></p>
    <p style="margin-top: 8px; font-size: 0.75rem;">Sessão configurada com expiração por inatividade de 30 minutos.</p>
</div>