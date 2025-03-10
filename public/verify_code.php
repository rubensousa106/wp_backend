<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\UserController;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


$data = json_decode(file_get_contents("php://input"));// Lê o corpo da requisição e descodifica o JSON para objeto

if (isset($data->cliente_id) && isset($data->code)) { // Verifica se os campos obrigatórios foram enviados
    $userController = new UserController(); // Instancia o UserController
    $result = $userController->verifyCode($data->cliente_id, $data->code); // Chama o método verifyCode
    echo json_encode($result); // Retorna o resultado
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Dados incompletos'
    ]);
}
