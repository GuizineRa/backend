<div class="card" style="max-width: 650px; margin: 0 auto;">
    <div class="card-header">
        <div>
            <h1 class="card-title">Novo Pet</h1>
            <p style="color: var(--text-muted); font-size: 0.85rem;">Associação obrigatória a um tutor previamente cadastrado.</p>
        </div>
        <a href="/pets" class="btn btn-secondary btn-sm">&larr; Voltar</a>
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
    <form action="/pets/salvar" method="POST">
        <!-- Associação obrigatória de tutor -->
        <div class="form-group">
            <label for="tutor_id">Tutor Responsável * (Obrigatório)</label>
            <select id="tutor_id" name="tutor_id" class="form-control" required>
                <option value="">-- Selecione o tutor responsável --</option>
                <?php foreach ($tutores as $tutor): ?>
                    <option 
                        value="<?= (int)$tutor['id'] ?>"
                        <?= (isset($dados['tutor_id']) && (int)$dados['tutor_id'] === (int)$tutor['id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($tutor['nome'], ENT_QUOTES, 'UTF-8') ?> - CPF: <?= htmlspecialchars($tutor['cpf_formatado'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

              <div class="form-group">
            <label for="nome">Nome do Animal *</label>
            <input 
                type="text" 
                id="nome" 
                name="nome" 
                class="form-control" 
                placeholder="Ex: Thor, Mia, Pipoca" 
                value="<?= htmlspecialchars($dados['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                required
            >
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="especie">Espécie *</label>
                <input 
                    type="text" 
                    id="especie" 
                    name="especie" 
                    class="form-control" 
                    placeholder="Ex: Cachorro, Gato, Ave"
                                        value="<?= htmlspecialchars($dados['especie'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                    required
                >
            </div>
            <div class="form-group">
                <label for="raca">Raça *</label>
                <input 
                    type="text" 
                    id="raca" 
                    name="raca" 
                    class="form-control" 
                    placeholder="Ex: Golden Retriever, Siamês, SRD" 
                    value="<?= htmlspecialchars($dados['raca'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                    required
                >
            </div>
        </div>
        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento *</label>
            <input 
                type="date" 
                id="data_nascimento" 
                name="data_nascimento" 
                class="form-control" 
                value="<?= htmlspecialchars($dados['data_nascimento'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                required
            >
        </div>

           <div style="display: flex; gap: 0.75rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Salvar Pet</button>
            <a href="/pets" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>