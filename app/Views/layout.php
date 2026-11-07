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

    <nav>
        <a href="index.php?rota=bolsas">Bolsas</a>

        <?php if (Auth::autenticado()): ?>
            <a href="index.php?rota=inicio">Início</a>
            <span>Olá, <?= escapar($_SESSION['username']) ?></span>
            <form method="post" action="index.php?rota=logout">
                <button type="submit">Terminar sessão</button>
            </form>
        <?php else: ?>
            <a href="index.php?rota=login">Login</a>
            <a href="index.php?rota=registo">Registo</a>
        <?php endif; ?>
    </nav>

    <?php if (isset($ficheiroView)) require $ficheiroView; ?>
</main>
</body>
</html>