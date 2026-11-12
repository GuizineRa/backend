<div class="card">
    <div class="card-header">
        <div>
            <h1 class="card-title">Gestão de Pets</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Animais cadastrados e vinculados obrigatoriamente a seus tutores.
            </p>
        </div>
        <a href="/pets/cadastrar" class="btn btn-primary">+ Novo Pet</a>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th>Nome do Pet</th>
                    <th>Espécie</th>
                    <th>Raça</th>
                    <th>Data Nasc.</th>
                    <th>Tutor Responsável</th>
                    <th style="width: 140px; text-align: center;">Agendamento</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pets)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                            Nenhum pet cadastrado até o momento.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pets as $pet): ?>
                        <tr>
                            <td><?= (int)$pet['id'] ?></td>
                            <td>
                                <strong><?= htmlspecialchars($pet['nome'], ENT_QUOTES, 'UTF-8') ?></strong>
                            </td>
                            <td><?= 
htmlspecialchars($pet['especie'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($pet['raca'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <?= !empty($pet['data_nascimento']) ? date('d/m/Y', strtotime($pet['data_nascimento'])) : '-' ?>
                            </td>
                            <td>
                                👤 <strong><?= htmlspecialchars($pet['tutor_nome'], ENT_QUOTES, 'UTF-8') ?></strong>
                            </td>
                            <td style="text-align: center;">
                                <a href="/agendamentos/cadastrar?pet_id=<?= (int)$pet['id'] ?>" class="btn btn-secondary btn-sm" title="Agendar nova consulta para este animal">
                                    📅 Agendar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>