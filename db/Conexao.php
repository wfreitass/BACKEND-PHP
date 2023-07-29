<?php

class Conexao
{
    private static $conexao = null;

    private function __construct()
    {
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "teste-backend";

        try {
            self::$conexao = new PDO("mysql:host={$host};dbname={$banco}", $usuario, $senha);
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conexao->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        }
    }

    public static function getConexao()
    {
        if (!self::$conexao) {
            new self();
        }

        return self::$conexao;
    }
}
