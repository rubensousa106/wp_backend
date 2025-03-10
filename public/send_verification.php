<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\WhatsAppController;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Lê os dados enviados via JSON
$data = json_decode(file_get_contents("php://input"));

// Verifica se o telefone foi informado
if (!isset($data->phone)) {
    echo json_encode([
        'success' => false,
        'message' => 'Telefone não informado'
    ]);
    exit;
}

// Se o cliente estiver autenticado, o cliente_id pode ser passado também
$controller = new WhatsAppController();
echo $controller->sendVerificationCode($data);
