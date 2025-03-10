<?php
namespace App\Controller;

use PDO;
use PDOException;

class UserController {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new \PDO(
                'mysql:host=localhost;dbname=wp_db',
                'root',
                'admin',
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    public function getUserById($cliente_id) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, telefone, is_verified FROM Clientes WHERE id = :cliente_id");
        $stmt->execute(['cliente_id' => $cliente_id]);
        return $stmt->fetch();
    }

    // Atualiza os dados do usuário (nome e email)
    public function updateUser($cliente_id, $nome, $email) {
        $stmt = $this->pdo->prepare("UPDATE Clientes SET nome = :nome, email = :email WHERE id = :cliente_id");
        if ($stmt->execute(['nome' => $nome, 'email' => $email, 'cliente_id' => $cliente_id])) {
            return ['success' => true, 'message' => 'Perfil atualizado com sucesso'];
        } else {
            return ['success' => false, 'message' => 'Erro ao atualizar o perfil'];
        }
    }

    // Método para armazenar o código de verificação e a expiração
    public function storeVerificationCode($cliente_id, $code, $expiresAt) {
        $stmt = $this->pdo->prepare("UPDATE Clientes SET verification_code = :code, code_expires_at = :expiresAt, is_verified = 0 WHERE id = :cliente_id");
        return $stmt->execute([
            'code' => $code,
            'expiresAt' => $expiresAt,
            'cliente_id' => $cliente_id
        ]);
    }

    // Método para verificar o código informado pelo usuário
    public function verifyCode($cliente_id, $code) {
        $user = $this->getUserById($cliente_id);
        if ($user) {
            // Checa se o código expirou
            if (strtotime($user['code_expires_at']) < time()) {
                return [
                    'success' => false,
                    'message' => 'O código de verificação expirou'
                ];
            }
            if ($user['verification_code'] === $code) {
                // Atualiza o status do usuário para verificado e limpa o código
                $stmt = $this->pdo->prepare("UPDATE Clientes SET is_verified = 1, verification_code = NULL, code_expires_at = NULL WHERE id = :cliente_id");
                $stmt->execute(['cliente_id' => $cliente_id]);
                return [
                    'success' => true,
                    'message' => 'Número verificado com sucesso'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Código de verificação incorreto'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Usuário não encontrado'
            ];
        }
    }
}
