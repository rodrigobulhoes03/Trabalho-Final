<?php

class BolsaController
{
    private Bolsa $bolsas;

    public function __construct(PDO $pdo)
    {
        $this->bolsas = new Bolsa($pdo);
    }

    // Lista de bolsas, com pesquisa opcional
    public function lista()
    {
        $pesquisa = param($_GET, 'pesquisa');

        render('bolsas/lista', [
            'titulo'   => 'Bolsas e apoios',
            'bolsas'   => $this->bolsas->listar($pesquisa),
            'pesquisa' => $pesquisa,
        ]);
    }

    // Detalhes de uma bolsa
    public function detalhe()
    {
        $id    = (int) ($_GET['id'] ?? 0);
        $bolsa = $this->bolsas->porId($id);

        if (!$bolsa) {
            http_response_code(404);
            echo 'Bolsa não encontrada.';
            return;
        }

        $pesquisa = param($_GET, 'pesquisa');

            render('bolsas/lista', [
            'titulo'   => 'Bolsas e apoios',
            'bolsas'   => $this->bolsas->listar($pesquisa),
            'pesquisa' => $pesquisa,
            'largo'    => true,
        ]);
    }
}