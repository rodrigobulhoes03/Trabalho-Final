<h1><?= escapar($bolsa['designacao']) ?></h1>

<p><strong>Tipo de apoio:</strong> <?= escapar($bolsa['tipo_apoio']) ?></p>
<p><strong>Área de estudo:</strong> <?= escapar($bolsa['area_estudo']) ?></p>
<p><strong>Montante:</strong> <?= number_format($bolsa['montante'], 2, ',', ' ') ?> €</p>
<p><strong>Prazo de candidatura:</strong> <?= date('d/m/Y', strtotime($bolsa['prazo'])) ?></p>
<p><strong>Requisitos:</strong><br><?= nl2br(escapar($bolsa['requisitos'])) ?></p>

<p><a href="index.php?rota=bolsas">&larr; Voltar à lista</a></p>