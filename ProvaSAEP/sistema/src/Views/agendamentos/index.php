<div class="card">
    <div class="card-header">
        <div>
            <h1 class="card-title">Agendamentos de Consultas</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Listagem cronológica ordenada por data e horário de atendimento.
            </p>
        </div>
        <a href="/agendamentos/cadastrar" class="btn btn-primary">+ Novo Agendamento</a>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 150px;">Data e Horário</th>
                    <th>Dados do Pet</th>
                    <th>Dados do Tutor</th>
                    <th>Motivo da Consulta</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 130px; text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($agendamentos)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                            Nenhum agendamento cadastrado.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($agendamentos as $item): ?>
                        <tr>
                            <td>
                                <strong>📅 <?= date('d/m/Y', strtotime($item['data_agendamento'])) ?></strong><br>
                                <span style="color: var(--primary); font-weight: 600;">⏰ <?= date('H:i', strtotime($item['data_agendamento'])) ?></span>
                            </td>
                                                       <td>
                                <strong>🐾 <?= htmlspecialchars($item['pet_nome'], ENT_QUOTES, 'UTF-8') ?></strong><br>
                                <small style="color: var(--text-muted);">
                                    <?= htmlspecialchars($item['pet_especie'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($item['pet_raca'], ENT_QUOTES, 'UTF-8') ?>)
                                </small>
                            </td>
                            <td>
                                <strong>👤 <?= htmlspecialchars($item['tutor_nome'], ENT_QUOTES, 'UTF-8') ?></strong><br>
                                <span class="badge badge-lgpd" title="CPF protegido sob LGPD">
                                    CPF: <?= htmlspecialchars($item['tutor_cpf_formatado'], ENT_QUOTES, 'UTF-8') ?>
                                </span><br>
                                <small style="color: var(--text-muted);">📞 <?= htmlspecialchars($item['tutor_telefone'], ENT_QUOTES, 'UTF-8') ?></small>
                            </td>
                            <td>
                                <?= htmlspecialchars($item['motivo'], ENT_QUOTES, 'UTF-8') ?>
                            </td>
                            <td>
                                <span class="badge badge-status"><?= htmlspecialchars($item['status'], ENT_QUOTES, 'UTF-8') ?></span>
                            </td>
                            <td style="text-align: center;">
                                <a href="/agendamentos/editar?id=<?= (int)$item['id'] ?>" class="btn btn-secondary btn-sm" title="Alterar a data deste agendamento">
                                                                     📅 Alterar Data
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>