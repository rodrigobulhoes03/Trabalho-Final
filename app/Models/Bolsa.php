<?php

class Bolsa
{
    public function __construct(private PDO $pdo) {}

    // Lista as bolsas. Se houver texto de pesquisa, filtra.
    public function listar(string $pesquisa = ''): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, designacao, tipo_apoio, area_estudo, montante, prazo
             FROM bolsas
             WHERE designacao LIKE ? OR tipo_apoio LIKE ? OR area_estudo LIKE ?
             ORDER BY prazo'
        );

        $termo = '%' . $pesquisa . '%';
        $stmt->execute([$termo, $termo, $termo]);

        return $stmt->fetchAll();
    }

    // Devolve uma bolsa pelo id (ou false se não existir)
    public function porId(int $id): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * FROM bolsas WHERE id = ?');
        $stmt->execute([$id]);

        return $stmt->fetch();
    }
}