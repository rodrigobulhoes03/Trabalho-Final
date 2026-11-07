<?php
// Sessão: guarda quem fez login.

class Auth
{
    public static function iniciarSessao()
    {
        session_start();
    }

    public static function autenticado()
    {
        return isset($_SESSION['user_id']);
    }

    public static function iniciarLogin($utilizador)
    {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $utilizador['id'];
        $_SESSION['username'] = $utilizador['username'];
        $_SESSION['perfil'] = $utilizador['perfil'];
    }

    public static function terminarSessao()
    {
        $_SESSION = [];
        session_destroy();
    }
}