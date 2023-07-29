<?php

require_once "./models/Usuario.php";

class UsuarioController
{
    public function listarUsuarios()
    {
        // $conexao = ConexaoSingleton::getConexao();
        $usuario = new Usuario();
        $lista = $usuario->listar();
        // $usuarios = $usuario->listar();

        // Exibir a lista de usuários usando a view adequada
        require 'views/list.php';
    }

    public function cadastrarUsuario()
    {
        // Lógica para cadastrar um novo usuário
        // ...
        // Exibir o formulário de cadastro usando a view adequada
        require 'views/form.php';
    }

    // Outras ações do usuário aqui, se necessário
}
