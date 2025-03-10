<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\UserController;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

if (isset($_GET['cliente_id'])) {
    $cliente_id = $_GET['cliente_id'];// Verifica se o parâmetro cliente_id foi fornecido na query string
    $userController = new UserController(); // Instancia o UserController
    $user = $userController->getUserById($cliente_id); // Chama o método getUserById
    if ($user) {
        echo json_encode(['success' => true, 'user' => $user]); // Retorna o usuário encontrado
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não encontrado']); // Usuário não encontrado
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Cliente não informado']); // Cliente não informado
}
