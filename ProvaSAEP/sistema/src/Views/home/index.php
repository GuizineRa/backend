<div class="card" style="border-left: 4px solid var(--primary);">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 1.6rem; color: var(--primary);">Painel Principal</h1>
            <p style="color: var(--text-muted); margin-top: 0.25rem;">
                Usuário autenticado: <strong><?= htmlspecialchars($usuario['nome'] ?? 'Operador', ENT_QUOTES, 'UTF-8') ?></strong> (<?= htmlspecialchars($usuario['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>)
            </p>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="/logout" class="btn btn-secondary btn-sm" title="Finalizar sessão de trabalho">🚪 Sair do Sistema</a>
        </div>
    </div>
</div>
<!-- Cards de Estatísticas e Atalhos de Recursos -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
    <!-- Card Tutores -->
    <div class="card" style="margin-bottom: 0;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <p style="font-size: 0.85rem; text-transform: uppercase; color: var(--text-muted); font-weight: 600;">Tutores Cadastrados</p>
                <h2 style="font-size: 2.2rem; color: var(--text-dark); margin: 0.5rem 0;"><?= (int)$totalTutores ?></h2>
                <span class="badge badge-lgpd">🔐 CPF Criptografado (LGPD)</span>
            </div>
            <span style="font-size: 2rem;">👥</span>
        </div>
        <div style="margin-top: 1.25rem; display: flex; gap: 0.5rem;">
            <a href="/tutores" class="btn btn-primary btn-sm" style="flex: 1;">Gerenciar Tutores</a>
            <a href="/tutores/cadastrar" class="btn btn-secondary btn-sm">+ Novo</a>
        </div>
    </div>

       <!-- Card Pets -->
    <div class="card" style="margin-bottom: 0;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <p style="font-size: 0.85rem; text-transform: uppercase; color: var(--text-muted); font-weight: 600;">Pets Vinculados</p>
                <h2 style="font-size: 2.2rem; color: var(--text-dark); margin: 0.5rem 0;"><?= (int)$totalPets ?></h2>
                <span style="font-size: 0.8rem; color: var(--text-muted);">Vinculados a tutores existentes</span>
            </div>
            <span style="font-size: 2rem;">🐶</span>
        </div>
        <div style="margin-top: 1.25rem; display: flex; gap: 0.5rem;">
            <a href="/pets" class="btn btn-primary btn-sm" style="flex: 1;">Gerenciar Pets</a>
            <a href="/pets/cadastrar" class="btn btn-secondary btn-sm">+ Novo</a>
        </div>
    </div>
    <!-- Card Agendamentos -->
    <div class="card" style="margin-bottom: 0;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <p style="font-size: 0.85rem; text-transform: uppercase; color: var(--text-muted); font-weight: 600;">Total de Consultas</p>
                <h2 style="font-size: 2.2rem; color: var(--text-dark); margin: 0.5rem 0;"><?= (int)$totalAgendamentos ?></h2>
                <span style="font-size: 0.8rem; color: var(--text-muted);">Ordenação cronológica</span>
            </div>
            <span style="font-size: 2rem;">📅</span>
        </div>
           <div style="margin-top: 1.25rem; display: flex; gap: 0.5rem;">
            <a href="/agendamentos" class="btn btn-primary btn-sm" style="flex: 1;">Ver Agendamentos</a>
            <a href="/agendamentos/cadastrar" class="btn btn-secondary btn-sm">+ Novo</a>
        </div>
    </div>
</div>
<!-- Próximos Agendamentos -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Próximos Agendamentos</h2>
        <a href="/agendamentos" class="btn btn-secondary btn-sm">Ver todos ordenados por data &rarr;</a>
    </div>
    <?php if (empty($proximosAgendamentos)): ?>
        <p style="color: var(--text-muted); text-align: center; padding: 1.5rem;">Nenhum agendamento registrado no momento.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Data e Horário</th>
                        <th>Pet</th>
                        <th>Tutor</th>
                        <th>Motivo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proximosAgendamentos as $item): ?>
                                           <tr>
                            <td>
                                <strong><?= date('d/m/Y H:i', strtotime($item['data_agendamento'])) ?></strong>
                            </td>
                            <td>
                                <?= htmlspecialchars($item['pet_nome'], ENT_QUOTES, 'UTF-8') ?>
                                <small style="color: var(--text-muted);">(<?= htmlspecialchars($item['pet_especie'], ENT_QUOTES, 'UTF-8') ?>)</small>
                            </td>
                            <td>
                                <?= htmlspecialchars($item['tutor_nome'], ENT_QUOTES, 'UTF-8') ?>
                            </td>
                            <td><?= htmlspecialchars($item['motivo'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <span class="badge badge-status"><?= htmlspecialchars($item['status'], ENT_QUOTES, 'UTF-8') ?></span>
                            </td>
                            <td>
                                <a href="/agendamentos/editar?id=<?= (int)$item['id'] ?>" class="btn btn-secondary btn-sm" title="Alterar data do agendamento">
                                    Alterar Data
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>