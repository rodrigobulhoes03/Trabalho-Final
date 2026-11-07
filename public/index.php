<?php
ini_set('display_errors', '1');

require __DIR__ . '/../app/Auth.php';
require __DIR__ . '/../app/Models/Utilizador.php';
require __DIR__ . '/../app/Models/Bolsa.php';                    // NOVO
require __DIR__ . '/../app/Controllers/AuthController.php';
require __DIR__ . '/../app/Controllers/BolsaController.php';     // NOVO

function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function param(array $origem, string $chave): string
{
    $valor = $origem[$chave] ?? '';

    if (is_string($valor)) {
        return trim($valor);
    }

    return '';
}

function render(string $view, array $dados = []): void
{
    extract($dados);
    $ficheiroView = __DIR__ . '/../app/Views/' . $view . '.php';
    require __DIR__ . '/../app/Views/layout.php';
}

function redirecionar(string $rota): void
{
    header('Location: index.php?rota=' . $rota);
    exit;
}

Auth::iniciarSessao();

$rota = $_GET['rota'] ?? 'login';
$pdo  = require __DIR__ . '/../config.php';
$auth = new AuthController($pdo);
$bolsa = new BolsaController($pdo);                              // NOVO

switch ($rota) {
    case 'registo':
        $auth->registo();
        break;

    case 'login':
        $auth->login();
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'inicio':
        if (!Auth::autenticado()) {
            redirecionar('login');
        }
        render('auth/inicio', ['titulo' => 'Início']);
        break;

    case 'bolsas':                                               // NOVO
        $bolsa->lista();
        break;

    case 'bolsa':                                                // NOVO
        $bolsa->detalhe();
        break;

    default:
        http_response_code(404);
        echo 'Página não encontrada.';
}