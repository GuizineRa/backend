<div class="card" style="max-width: 650px; margin: 0 auto;">
    <div class="card-header">
        <div>
            <h1 class="card-title">Novo Agendamento</h1>
            <p style="color: var(--text-muted); font-size: 0.85rem;">Marcar consulta para animal vinculado a tutor.</p>
        </div>
        <a href="/agendamentos" class="btn btn-secondary btn-sm">&larr; Voltar</a>
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
    <form action="/agendamentos/salvar" method="POST">
        <div class="form-group">
            <label for="pet_id">Pet e Tutor Responsável *</label>
            <select id="pet_id" name="pet_id" class="form-control" required>
                <option value="">-- Selecione o Pet --</option>
                <?php 
                $petPreSelecionado = (int)($_GET['pet_id'] ?? ($dados['pet_id'] ?? 0));
                foreach ($pets as $pet): 
                ?>
                    <option 
                        value="<?= (int)$pet['id'] ?>"
                        <?= ($petPreSelecionado === (int)$pet['id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($pet['nome'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($pet['especie'], ENT_QUOTES, 'UTF-8') ?>) &bull; Tutor: <?= htmlspecialchars($pet['tutor_nome'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
               </div>
        <div class="form-group">
            <label for="data_agendamento">Data e Horário da Consulta *</label>
            <input 
                type="datetime-local" 
                id="data_agendamento" 
                name="data_agendamento" 
                class="form-control" 
                value="<?= htmlspecialchars($dados['data_agendamento'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                required
            >
        </div>
        <div class="form-group">
            <label for="motivo">Motivo do Atendimento / Sintomas *</label>
            <textarea 
                id="motivo" 
                name="motivo" 
                class="form-control" 
                rows="3" 
                placeholder="Ex: Consulta de rotina, vacinação, exames..." 
                required
            ><?= htmlspecialchars($dados['motivo'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status Inicial</label>
            <select id="status" name="status" class="form-control">
                <option value="Agendado" selected>Agendado</option>
                <option value="Confirmado">Confirmado</option>
                <option value="Em Atendimento">Em Atendimento</option>
                <option value="Concluído">Concluído</option>
            </select>
        </div>

            <div style="display: flex; gap: 0.75rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Confirmar Agendamento</button>
            <a href="/agendamentos" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>