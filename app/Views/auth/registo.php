<h1>Registo</h1>

<?php if (!empty($mensagem)): ?>
    <p class="<?= !empty($sucesso) ? 'ok' : 'erro' ?>"><?= escapar($mensagem) ?></p>
<?php endif; ?>

<form method="post" action="index.php?rota=registo">
    <label>Username
        <input type="text" name="username" maxlength="50" value="<?= escapar($d['username']) ?>" required>
    </label>

    <label>Nome
        <input type="text" name="nome" maxlength="100" value="<?= escapar($d['nome']) ?>" required>
    </label>

    <label>Email
        <input type="email" name="email" maxlength="100" value="<?= escapar($d['email']) ?>" required>
    </label>

    <label>Password (mínimo 8 caracteres)
        <input type="password" name="password" minlength="8" required>
    </label>

    <button type="submit">Registar</button>
</form>

<p>Já tem conta? <a href="index.php?rota=login">Iniciar sessão</a></p>