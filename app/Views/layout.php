<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= escapar($titulo ?? 'Bolsas') ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="<?= !empty($largo) ? 'largo' : '' ?>">
    <?php if (isset($ficheiroView)) require $ficheiroView; ?>
</main>

</body>
</html>