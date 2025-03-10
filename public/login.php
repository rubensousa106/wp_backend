<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\AuthController;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$rawInput = file_get_contents("php://input"); // Lê o corpo da requisição
$data = json_decode($rawInput); // Decodifica o JSON para objeto

if (isset($data->email) && isset($data->password)) { // Verifica se os campos foram informados
    $auth = new AuthController(); // Instancia o AuthController
    $result = $auth->login($data->email, $data->password); // Chama o método login
    echo json_encode($result); // Retorna o resultado
} else {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
}
