<?php
namespace App\Controller;

use App\Service\WpService;

class WhatsAppController {
    public function sendVerificationCode($data) {
        if (!isset($data->phone)) {
            return json_encode([
                'success' => false,
                'message' => 'Telefone não informado'
            ]);
        }

        $phone = $data->phone;
        $service = new WpService();
        $result = $service->sendVerificationCode($phone);

        // Gera um código de verificação aleatório caso o Whapi nao gere um código.
        $verificationCode = rand(100000, 999999);
        // Chamar metodo para armazenar o código de verificação ();

        if (isset($data->cliente_id)) { // Verifica se o cliente_id foi informado
            $userController = new \App\Controller\UserController();
            // Armazena o código com validade de 10 minutos:
            $expiresAt = date('Y-m-d H:i:s', strtotime('+10 minutes')); // Adiciona 10 minutos à hora atual
            $userController->storeVerificationCode($data->cliente_id, $verificationCode, $expiresAt); // Armazena o código de verificação
        }

        return json_encode([
            'success' => true,
            'message' => 'Código de verificação enviado',
            'data' => [
                'sentCode' => $verificationCode,
                'apiResponse' => $result
            ]
        ]);
    }
}
