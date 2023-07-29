<?php

require_once 'controllers/UsuarioController.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'listar';
}

$controller = new UsuarioController();

switch ($action) {

    case 'listar':
        $controller->listarUsuarios();
        break;

    case 'cadastrar':
        $controller->cadastrarUsuario();
        break;

    case 'excluir':
        $controller->excluirUsuario();
        break;

    case 'editar':
        $controller->editarUsuario();
        break;

    case 'login':
        $controller->login();
        break;

    case 'logout':
        $controller->logout();
        break;

    case 'pesquisa':
        $controller->pesquisa();
        break;

    default:
        echo "Ação inválida.";
        break;
}
