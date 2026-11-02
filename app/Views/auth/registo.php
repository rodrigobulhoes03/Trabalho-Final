<h1>Registo</h1>


<form method="post" action="index.php?rota=registo">
    <label>Username 
        <input type="text" name="username" maxlength="50" value="<?= e($d['username']) ?>" required>
    </label>

    <label>Nome 
        <input type="text" name="nome" maxlength="100" value="<?= e($d['nome']) ?>" required>
    </label>

    <label>Email </label>
        <input type="email" name="email" maxlength="100" value="<?= e($d['email']) ?>" required>
    

    <label>Password (mínimo 8 caracteres) 
        <input type="password" name="password" minlength="8" required>
    </label>
    
    <button type="submit">Registar</button>
</form>