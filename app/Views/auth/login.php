<h1>Login</h1>

<?php if (isset($erro) && $erro): ?>
    <p class="erro"><?= escapar($erro) ?></p>
<?php endif; ?>

<form method="post" action="index.php?rota=login">
    <label>Username 
        <input type="text" name="username" maxlength="50" required>
    </label>
    
    <label>Password 
        <input type="password" name="password" required>
    </label>
    <button type="submit">Entrar</button>
</form>

<p>Ainda não tem conta? <a href="index.php?rota=registo">Registe-se</a></p>