<?php

require_once "./models/Usuario.php";

class UsuarioController
{
    public function login()
    {

        require 'views/login.php';
    }

    public function listarUsuarios()
    {
        try {
            $usuario = new Usuario();
            $lista = $usuario->listar();
        } catch (Exception $e) {
            throw $e;
        }

        require 'views/list.php';
    }

    public function cadastrarUsuario()
    {
        if ($_POST) {
            try {
                $usuario = new Usuario();
                $_POST['permissao'] = implode(',', $_POST['permissao']);
                $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_BCRYPT);
                $response = $usuario->criar($_POST);
            } catch (Exception $e) {
                throw $e;
            }
        }
        require 'views/form.php';
    }

    public function excluirUsuario()
    {
        try {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $response = $usuario->deletar($id);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
