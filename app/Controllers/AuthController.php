<?php

class AuthController
{
    private Utilizador $utilizadores;

    public function __construct(PDO $pdo)
    {
        $this->utilizadores = new Utilizador($pdo);
    }

    public function registo(): void
    {
        $mensagem = '';
        $sucesso  = false;
        $d = ['username' => '', 'nome' => '', 'email' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $d['username'] = param($_POST, 'username');
            $d['nome'] = param($_POST, 'nome');
            $d['email'] = param($_POST, 'email');
            $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';

            if (strlen($d['username']) < 3 || strlen($d['username']) > 50) {
                $mensagem = 'O username deve ter entre 3 e 50 caracteres.';
            } elseif ($d['nome'] === '' || strlen($d['nome']) > 100) {
                $mensagem = 'Indique o seu nome (máximo 100 caracteres).';
            } elseif (!filter_var($d['email'], FILTER_VALIDATE_EMAIL) || strlen($d['email']) > 100) {
                $mensagem = 'Indique um email válido.';
            } elseif (strlen($password) < 8) {
                $mensagem = 'A password deve ter pelo menos 8 caracteres.';
            } else {
                try {
                    $this->utilizadores->criarCandidato(
                        $d['username'],
                        password_hash($password, PASSWORD_DEFAULT),
                        $d['nome'],
                        $d['email']
                    );
                    $sucesso  = true;
                    $mensagem = 'Conta criada com sucesso!';
                    $d = ['username' => '', 'nome' => '', 'email' => ''];
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) {
                        $mensagem = 'Este username ou email já existe.';
                    } else {
                        throw $e;
                    }
                }
            }
        }

        render('auth/registo', [
            'titulo' => 'Registo',
            'mensagem' => $mensagem,
            'sucesso' => $sucesso,
            'd' => $d,
        ]);
    }

    public function login()
    {
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = param($_POST, 'username');
            $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';

            // Procura o utilizador na base de dados
            $utilizador = $this->utilizadores->porUsername($username);

            // Existe e a password está certa?
            if ($utilizador && password_verify($password, $utilizador['password_hash'])) {
                Auth::iniciarLogin($utilizador);
                redirecionar('inicio');
            } else {
                $erro = 'Username ou password incorretos.';
            }
        }

        render('auth/login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function logout()
    {
        Auth::terminarSessao();
        redirecionar('login');
    }
}