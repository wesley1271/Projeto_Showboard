<?php

session_start();

define('CONTROL', true);

$usuario_id = $_SESSION['usuario_id'] ?? null;

$rota = $_GET['rota'] ?? 'login';


// BLOQUEIO DE ROTAS PROTEGIDAS
if (empty($usuario_id) && !in_array($rota, ['login', 'cadastro', 'create'])) {
    $rota = 'login';
}

// SE ESTÁ LOGADO, NÃO PODE VOLTAR PARA LOGIN
if (!empty($usuario_id) && $rota == 'login') {
    $rota = 'home';
}

$rotas = [
    'login'     => 'login.php',
    'cadastro'  => 'cadastro.php',
    'home'      => 'home.php',
    'logout'    => 'logout.php',
    'dashboard' => 'dashboard.php',
    'projeto'   => 'projeto.php',
    'deletar'   => 'deletar.php',
    'editar'    => 'editar.php',
    'perfil'    => 'perfil.php',
    'update' => 'update.php'
];


// IMPEDE ROTAS INEXISTENTES
if (!array_key_exists($rota, $rotas)) {
    die("Acesso negado!");
}


// TRATAMENTO ESPECÍFICO PARA A ROTA PERFIL
if ($rota === 'perfil') {

    // Garante que está logado
    if (empty($usuario_id)) {
        header("Location: index.php?rota=login");
        exit;
    }

    // Se não passar ?id=, usa o ID do usuário logado
    $id_perfil = $_GET['id'] ?? $usuario_id;

    // Para bloquear ver outros perfis:
    // if ($id_perfil != $usuario_id) {
    //     die("Você não tem permissão para acessar este perfil.");
    // }

    // Enviar ID para perfil.php
    $_GET['id'] = $id_perfil;
}


// Carrega a página final
require_once $rotas[$rota];
