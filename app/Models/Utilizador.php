<?php

class Utilizador
{
    public function __construct(private PDO $pdo) {}

    // O perfil é sempre 'candidato': nunca vem do formulário.
    public function criarCandidato(string $username, string $hash, string $nome, string $email): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO utilizadores (username, password_hash, perfil, nome, email)
             VALUES (?, ?, 'candidato', ?, ?)"
        );
        $stmt->execute([$username, $hash, $nome, $email]);
    }

    public function porUsername(string $username): array|false
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, username, password_hash, perfil FROM utilizadores WHERE username = ?'
        );
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}