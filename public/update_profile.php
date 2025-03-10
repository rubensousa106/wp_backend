<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\UserController;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input")); // Lê o corpo da requisição e descodifica o JSON para objeto

if (isset($data->cliente_id) && isset($data->nome) && isset($data->email)) {// Verifica se os campos obrigatórios foram enviados
    $userController = new UserController(); // Instancia o UserController
    $result = $userController->updateUser($data->cliente_id, $data->nome, $data->email);// Chama o método updateUser
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
}
