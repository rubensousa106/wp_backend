<?php
namespace App\Service;

use GuzzleHttp\Client;

class WpService {
    protected $client;
    protected $bearerToken = '4EZ7XWCd2QTP2PmL6wC3oZr2tuFH8jzt';
    protected $baseUri = 'https://gate.whapi.cloud/';

    public function __construct() {
        $this->client = new Client([
            'base_uri' => $this->baseUri,
        ]);
    }

    // Método para enviar o código de verificação
    public function sendVerificationCode($phone) {
        try {
            $response = $this->client->request('GET', 'users/login/', [
                'headers' => [
                    'Accept'        => 'application/json',
                    'Authorization' => 'Bearer ' . $this->bearerToken,
                ],
                'query' => [
                    'phone' => $phone,
                ],
            ]);

            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }
}
