<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\DbConnection;

$db = DbConnection::getInstance()->getConnection();
echo "Conexão estabelecida: " . $db->host_info;
