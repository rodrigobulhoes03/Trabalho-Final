<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
    <h1>Login</h1>

    <?php if ($erro): ?>
        <p class="erro"><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Username <input type="text" name="username" maxlength="50" required></label>
        <label>Password <input type="password" name="password" required></label>
        <button type="submit">Entrar</button>
    </form>

    <p>Ainda não tem conta? <a href="registo.php">Registe-se</a></p>
</main>
</body>
</html>