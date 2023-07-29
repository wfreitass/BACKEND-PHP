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
            $paginaAtual = 1;
            if (isset($_GET['pagina'])) {
                $paginaAtual = $_GET['pagina'];
            }
            $usuario = new Usuario();
            $resultadosPorPagina = 3;
            $total = $usuario->total();
            $totalPaginas = ceil($total / $resultadosPorPagina);
            $resultado = $usuario->paginacao($paginaAtual, $resultadosPorPagina);

            // $lista = $usuario->listar();
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

                if (
                    $usuario->buscarPorCpf($_POST['cpf']) ||
                    $usuario->buscarPorEmail($_POST['email'])
                ) {
                    $usuario = $_POST;
                    require 'views/form.php';
                    return true;
                }

                $_POST['permissao'] = implode(',', $_POST['permissao']);
                $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_BCRYPT);
                $_POST['uuid'] = uniqid('backend_');
                $response = $usuario->criar($_POST);
                return header('Location: index.php');
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
            return header('Location: index.php');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editarUsuario()
    {
        try {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario = $usuario->buscarPorId($id);
            $usuario['permissao'] = explode(',', $usuario['permissao']);

            if ($_POST) {

                $usuario = new Usuario();
                $_POST['permissao'] = implode(',', $_POST['permissao']);
                $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_BCRYPT);
                $response = $usuario->atualizar($id, $_POST);
                return header('Location: index.php');
            }
            require 'views/form.php';
        } catch (Exception $e) {
            throw $e;
        }
    }
}
