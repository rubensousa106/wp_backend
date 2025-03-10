<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\ProductController;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

if (isset($_GET['cliente_id'])) {
    $cliente_id = $_GET['cliente_id'];
    $productController = new ProductController();
    $products = $productController->getProductsByCliente($cliente_id);
    echo json_encode([
        'success' => true,
        'data' => $products
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Cliente não informado'
    ]);
}
