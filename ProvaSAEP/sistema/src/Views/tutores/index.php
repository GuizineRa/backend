<div class="card">
    <div class="card-header">
        <div>
            <h1 class="card-title">Gestão de Tutores</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Cadastro e consulta de tutores com proteção de dados pessoais (LGPD).
            </p>
        </div>
        <a href="/tutores/cadastrar" class="btn btn-primary">+ Novo Tutor</a>
    </div>
    <!-- Formulário de Busca por Nome ou CPF Criptografado -->
    <form action="/tutores" method="GET" class="search-box">
        <input 
            type="text" 
            name="busca" 
            class="form-control" 
            placeholder="Pesquisar tutor por Nome ou CPF..." 
            value="<?= htmlspecialchars($busca ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
        <button type="submit" class="btn btn-primary">🔍 Buscar</button>
        <?php if (!empty($busca)): ?>
            <a href="/tutores" class="btn btn-secondary" title="Limpar filtro de busca">Limpar</a>
        <?php endif; ?>
    </form>
    <?php if (!empty($busca)): ?>
        <p style="margin-bottom: 1rem; font-size: 0.9rem; color: var(--text-muted);">
            Resultados filtrados pelo termo: "<strong><?= htmlspecialchars($busca, ENT_QUOTES, 'UTF-8') ?></strong>" (<?= count($tutores) ?> tutor(es) encontrado(s))
        </p>
    <?php endif; ?>
    <!-- Tabela de Tutores -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                         <th style="width: 60px;">ID</th>
                    <th>Nome do Tutor</th>
                    <th>CPF (LGPD)</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th style="width: 110px; text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tutores)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                            Nenhum tutor encontrado<?= !empty($busca) ? ' para a busca realizada' : '' ?>.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tutores as $tutor): ?>
                        <tr>
                            <td><?= (int)$tutor['id'] ?></td>
                            <td><strong><?= htmlspecialchars($tutor['nome'], ENT_QUOTES, 'UTF-8') ?></strong></td>
                            <td>
                                <span class="badge badge-lgpd" title="Dado criptografado em AES-256 no banco">
                                    <?= htmlspecialchars($tutor['cpf_formatado'], ENT_QUOTES, 'UTF-8') ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($tutor['telefone'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($tutor['email'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td style="text-align: center;">
                                <a href="/tutores/editar?id=<?= (int)$tutor['id'] ?>" class="btn btn-secondary btn-sm" title="Editar dados do tutor">
                                    ✏️ Editar
                                </a>
                            </td>
                                         </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>