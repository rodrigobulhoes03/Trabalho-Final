<?php

class Utilizador
{
    public function __construct(private PDO $pdo) {}

    // O perfil é sempre 'candidato': nunca vem do formulário.
    public function criarCandidato(string $username, string $hash, string $nome, string $email): void
    {
        $stmt = $this->pdo->prepare(
            "insert into utilizadores (username, password_hash, perfil, nome, email)
             VALUES (?, ?, 'candidato', ?, ?)"
        );
        $stmt->execute([$username, $hash, $nome, $email]);
    }
}