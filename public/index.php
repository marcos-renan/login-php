<?php

// inicio da sessão
session_start();

//carregamento de rotas
$rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';

//definição de rotas
$rota = $_GET['rota'] ?? 'home';

// verifica se o usuario esta logado
if (!isset($_SESSION['usuario']) && $rota != 'login') {
    $rota = 'login';
}

// se o usuario esta logado e tenta acessar a pagina de login
if (isset($_SESSION['usuario']) && $rota == 'login') {
    $rota = 'home';
}

// se a rota nao existe
if (!in_array($rota, $rotas_permitidas)) {
    $rota(404);
}

// preparação da pagina
$script = null;

switch ($rota) {
  case '404':
    $script = '404.php';
    break;

  case 'login':
    $script = 'login.php';
    break;

  case 'home':
    $script = 'home.php';
    break;
}

//apresentação da pagina
require_once __DIR__ . "/../inc/header.php";
require_once __DIR__ . "/../scripts/$script";
require_once __DIR__ . "/../inc/footer.php";