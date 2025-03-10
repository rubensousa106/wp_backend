<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\AuthController;
use App\Controller\WhatsAppController;

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

// Verifica a ação definida no JSON
if (isset($data->action) && $data->action === 'sendVerification') { // Verifica se a ação é sendVerification
    $controller = new WhatsAppController(); // Instancia o WhatsAppController
    echo $controller->sendVerificationCode($data); // Chama o método sendVerificationCode
} else {
    // Por padrão, executa a autenticação
    $auth = new AuthController(); // Instancia o AuthController
    echo $auth->login($data); // Chama o método login
}
