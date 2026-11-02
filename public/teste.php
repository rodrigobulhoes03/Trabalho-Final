<?php
$pdo = require __DIR__ . '/../config.php';
echo 'Ligado! Utilizadores na tabela: ' . $pdo->query('SELECT COUNT(*) FROM utilizadores')->fetchColumn();