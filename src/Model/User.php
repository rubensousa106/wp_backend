<?php
namespace App\Model;

use App\Database\DbConnection;

class User {
    private $conn;

    public function __construct() {
        $this->conn = DbConnection::getInstance()->getConnection();
    }

    // Metodo para encontrar um usuário pelo email
    public function findByEmail($email) {
        $emailEscaped = $this->conn->real_escape_string($email);
        $query = "SELECT * FROM Clientes WHERE email='$emailEscaped'";

        $result = $this->conn->query($query);
        if ($result) {
            return $result->fetch_assoc();
        }
        return null;
    }
}
