<?php

class Usuario extends CRUD
{
    public function __construct($conexao)
    {
        parent::__construct($conexao, 'tabela_usuarios'); // Substitua 'tabela_usuarios' pelo nome da tabela de usuários no seu banco de dados
    }

    // Métodos específicos da classe Usuario
    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE email = :email";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validarCredenciais($email, $senha)
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE email = :email AND senha = :senha";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Outros métodos específicos da classe Usuario
}

// Exemplo de uso:
// Supondo que você já tenha uma conexão com o banco de dados ($conexao) estabelecida:
$usuario = new Usuario($conexao);

// Usando métodos herdados da classe CRUD
$dadosUsuario = array(
    'nome' => 'João Silva',
    'email' => 'joao@example.com',
    'senha' => 'senha123',
    'idade' => 30
);

$usuario->criar($dadosUsuario);
$usuario->atualizar(1, $dadosUsuario);
$usuario->deletar(1);
$usuarios = $usuario->listar();

// Usando métodos específicos da classe Usuario
$usuarioEncontrado = $usuario->buscarPorEmail('joao@example.com');
$usuarioValidado = $usuario->validarCredenciais('joao@example.com', 'senha123');
