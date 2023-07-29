<?php

// require_once 'ConexaoSingleton.php';
// require_once 'models/Usuario.php';
require_once 'controllers/UsuarioController.php';

// Roteamento
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'listar'; // Ação padrão é listar os usuários
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
        // Outras ações aqui, se necessário

    default:
        echo "Ação inválida.";
        break;
}
