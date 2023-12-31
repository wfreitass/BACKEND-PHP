<?php

require_once "./db/Conexao.php";

abstract class CRUD
{

    protected $conexao;
    protected $tabela;

    public function __construct($tabela)
    {
        $this->conexao =  Conexao::getConexao();
        $this->tabela = $tabela;
    }

    public function criar($dados)
    {
        $dados['data_criacao'] = date("Y-m-d");
        $campos = implode(', ', array_keys($dados));
        $valores = ':' . implode(', :', array_keys($dados));

        $sql = "INSERT INTO {$this->tabela} ({$campos}) VALUES ({$valores})";
        $stmt = $this->conexao->prepare($sql);

        foreach ($dados as $campo => $valor) {
            $stmt->bindValue(":{$campo}", $valor);
        }

        return $stmt->execute();
    }

    public function atualizar($id, $dados)
    {
        $dados['data_atualizacao'] = date("Y-m-d");
        $valores = '';
        foreach ($dados as $campo => $valor) {
            $valores .= "{$campo} = :{$campo}, ";
        }
        $valores = rtrim($valores, ', ');

        $sql = "UPDATE {$this->tabela} SET {$valores} WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);

        foreach ($dados as $campo => $valor) {
            $stmt->bindValue(":{$campo}", $valor);
        }
        $stmt->bindValue(":id", $id);

        return $stmt->execute();
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM {$this->tabela} WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(":id", $id);

        return $stmt->execute();
    }

    public function listar()
    {
        $sql = "SELECT * FROM {$this->tabela}";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function total()
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->tabela}";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['total'];
    }

    public function paginacao($paginaAtual, $resultadosPorPagina)
    {
        $offset = ($paginaAtual - 1) * $resultadosPorPagina;
        $sql = "SELECT * FROM {$this->tabela} LIMIT $resultadosPorPagina OFFSET {$offset}";
        return $this->conexao->query($sql);
    }

    public function pesquisar($paginaAtual, $resultadosPorPagina, $texto)
    {
        $offset = ($paginaAtual - 1) * $resultadosPorPagina;

        $sql = "SELECT * FROM {$this->tabela} WHERE nome LIKE '%" . $texto . "%' LIMIT $resultadosPorPagina OFFSET {$offset}";

        return $this->conexao->query($sql);
    }
}
