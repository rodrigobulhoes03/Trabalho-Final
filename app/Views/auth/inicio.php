<h1>Bem-vindo, <?= escapar($_SESSION['username']) ?>!</h1>

<form method="post" action="index.php?rota=logout">
    <button type="submit">Terminar sessão</button>
</form>