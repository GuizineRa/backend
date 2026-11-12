<div class="card" style="max-width: 650px; margin: 0 auto;">
    <div class="card-header">
        <div>
            <h1 class="card-title">Alterar Data do Agendamento</h1>
            <p style="color: var(--text-muted); font-size: 0.85rem;">Remarcação de data e horário da consulta.</p>
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
    <!-- Informações do Agendamento Existente -->
    <div style="background-color: #f7fafc; border: 1px solid var(--border); border-radius: 4px; padding: 1rem; margin-bottom: 1.5rem;">
        <p><strong>Paciente:</strong> <?= htmlspecialchars($agendamento['pet_nome'] ?? '', ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($agendamento['pet_especie'] ?? '', ENT_QUOTES, 'UTF-8') ?>)</p>
        <p><strong>Tutor:</strong> <?= htmlspecialchars($agendamento['tutor_nome'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Motivo:</strong> <?= htmlspecialchars($agendamento['motivo'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
        <p>
            <strong>Data Atual:</strong> 
            <?= date('d/m/Y \à\s H:i', strtotime($agendamento['data_agendamento'])) ?>
        </p>
    </div>
    <!-- Formulário para Atualização da Data -->
    <form action="/agendamentos/atualizar-data" method="POST">
        <input type="hidden" name="id" value="<?= (int)$agendamento['id'] ?>">

              <div class="form-group">
            <label for="data_agendamento">Nova Data e Horário *</label>
            <?php 
                $dataTimestamp = strtotime($agendamento['data_agendamento']);
                $dataInput = date('Y-m-d\TH:i', $dataTimestamp);
            ?>
            <input 
                type="datetime-local" 
                id="data_agendamento" 
                name="data_agendamento" 
                class="form-control" 
                value="<?= htmlspecialchars($dataInput, ENT_QUOTES, 'UTF-8') ?>" 
                required
            >
            <small style="color: var(--text-muted);">Defina o novo dia e horário para atendimento.</small>
        </div>
        <div style="display: flex; gap: 0.75rem; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Salvar Nova Data</button>
            <a href="/agendamentos" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>