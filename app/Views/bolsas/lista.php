<h1>Bolsas e apoios disponíveis</h1>

<form method="get" action="index.php">
    <input type="hidden" name="rota" value="bolsas">
    <label>Pesquisar (designação, tipo de apoio ou área de estudo)
        <input type="text" name="pesquisa" maxlength="100" value="<?= escapar($pesquisa) ?>">
    </label>
    <button type="submit">Pesquisar</button>
</form>

<?php if (!$bolsas): ?>
    <p>Nenhuma bolsa encontrada.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Designação</th>
            <th>Tipo de apoio</th>
            <th>Área de estudo</th>
            <th>Montante</th>
            <th>Prazo</th>
            <th></th>
        </tr>
        <?php foreach ($bolsas as $b): ?>
            <tr>
                <td><?= escapar($b['designacao']) ?></td>
                <td><?= escapar($b['tipo_apoio']) ?></td>
                <td><?= escapar($b['area_estudo']) ?></td>
                <td><?= number_format($b['montante'], 2, ',', ' ') ?> €</td>
                <td><?= date('d/m/Y', strtotime($b['prazo'])) ?></td>
                <td><a href="index.php?rota=bolsa&amp;id=<?= (int) $b['id'] ?>">Detalhes</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>