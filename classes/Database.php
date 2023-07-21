<?php

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        // Configurações de conexão ao banco de dados
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "opinion_box";

        try {
            // Criação da conexão PDO
            $this->connection = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Tratamento de erros na conexão
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}