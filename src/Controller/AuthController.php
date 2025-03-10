<?php
namespace App\Controller;

use PDO;
use PDOException;

class AuthController {
    protected $pdo;

    public function __construct() {
       /** Cria uma conexão a base de dados utilizando PDO.
         PDO (PHP Data Objects) é uma interface que fornece uma camada de abstração para aceder a bases de dados
         Aqui, é criada uma nova instância do PDO para conectar à base de dados 'wp_db' no servidor 'localhost'
         utilizando as credenciais 'root' e 'admin' */
        $this->pdo = new \PDO('mysql:host=localhost;dbname=wp_db', 'root', 'admin', [
            // Em caso de erro, o PDO lançará uma exceção, o que facilita a depuração
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            /** Define o modo de recuperação como array associativo,significa que cada linha do resultado sera um array
             onde as chave sao os nomes das colunas da tabela */
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function login($email, $password) {
        // Consulta o usuário pelo email
        $stmt = $this->pdo->prepare("SELECT * FROM Clientes WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            // Se a senha foi armazenada usando password_hash, verifique com password_verify
            if (password_verify($password, $user['senha'])) {
                // Login bem-sucedido
                return [
                    'success' => true,
                    'message' => 'Login efetuado com sucesso',
                    'user'    => $user // se desejar retornar dados do usuário
                ];
            } else {
                // Senha incorreta
                return [
                    'success' => false,
                    'message' => 'Senha incorreta'
                ];
            }
        } else {
            // Email não encontrado
            return [
                'success' => false,
                'message' => 'Usuário não encontrado'
            ];
        }
    }
}
