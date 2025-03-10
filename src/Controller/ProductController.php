<?php
namespace App\Controller;

use PDO;
use PDOException;

class ProductController {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=wp_db',
                'root',
                'admin',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }


    //Retorna os produtos aos quais o cliente está subscrito.

    public function getProductsByCliente($cliente_id) {
        $stmt = $this->pdo->prepare("
            SELECT p.*
            FROM Produtos p
            INNER JOIN subscricoes s ON s.produto_id = p.id
            WHERE s.cliente_id = :cliente_id
        ");
        $stmt->execute(['cliente_id' => $cliente_id]);
        return $stmt->fetchAll();
    }
}
