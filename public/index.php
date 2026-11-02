<?php
ini_set('display_errors', '1'); // só durante o desenvolvimento

require __DIR__ . '/../app/Models/Utilizador.php';
require __DIR__ . '/../app/Controllers/AuthController.php';

// Escapa texto para HTML (protege contra XSS)
function e($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

// Lê um campo de texto do formulário
function param(array $origem, string $chave): string
{
    $v = $origem[$chave] ?? '';
    return is_string($v) ? trim($v) : '';
}

// Mostra uma View dentro do layout
function render(string $view, array $dados = []): void
{
    extract($dados);
    ob_start();
    require __DIR__ . '/../app/Views/' . $view . '.php';
    $conteudo = ob_get_clean();
    require __DIR__ . '/../app/Views/layout.php';
}

$rota = $_GET['rota'] ?? 'registo';
$pdo  = require __DIR__ . '/../config.php';

switch ($rota) {
    case 'registo':
        (new AuthController($pdo))->registo();
        break;
    default:
        http_response_code(404);
        echo 'Página não encontrada.';
}