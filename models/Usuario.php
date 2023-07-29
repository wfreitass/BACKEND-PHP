<?php

require_once "./models/Crud.php";

class Usuario extends CRUD
{
    public function __construct()
    {
        parent::__construct('usuario'); // Substitua 'tabela_usuarios' pelo nome da tabela de usuários no seu banco de dados

    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorCpf($cpf)
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE cpf = :cpf";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":cpf", $cpf);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE email = :email";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validarCredenciais($cpf, $senha)
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE cpf = :cpf";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":cpf", $cpf);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!password_verify($senha, $usuario['senha'])) {
            return false;
        }
        return  $usuario;
    }
}

// // Exemplo de uso:
// // Supondo que você já tenha uma conexão com o banco de dados ($conexao) estabelecida:
// $usuario = new Usuario($conexao);

// // Usando métodos herdados da classe CRUD
// $dadosUsuario = array(
//     'nome' => 'João Silva',
//     'email' => 'joao@example.com',
//     'senha' => 'senha123',
//     'idade' => 30
// );

// $usuario->criar($dadosUsuario);
// $usuario->atualizar(1, $dadosUsuario);
// $usuario->deletar(1);
// $usuarios = $usuario->listar();

// // Usando métodos específicos da classe Usuario
// $usuarioEncontrado = $usuario->buscarPorEmail('joao@example.com');
// $usuarioValidado = $usuario->validarCredenciais('joao@example.com', 'senha123');
