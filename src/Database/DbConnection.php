<?php
namespace App\Database;

class DbConnection {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host     = 'localhost';
        $port     = 3306;
        $dbname   = 'wp_db';
        $username = 'root';
        $password = 'admin';

        // Cria a conexão utilizando mysql
        $this->conn = new \mysqli($host, $username, $password, $dbname, $port);

        // Verifica se houve erro na conexão
        if ($this->conn->connect_error) {
            die("Erro na conexão: " . $this->conn->connect_error);
        }
    }

    // Retorna a instância ativa
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    // Retorna a conexão ativa
    public function getConnection() {
        return $this->conn;
    }
}
