<?php

class MetaApiService {
    private const GRAPH_VERSION = 'v20.0';

    public function trocarCodePorToken(string $code, array $config, ?string $redirectUri = null): array {
        if (empty($config['app_id']) || empty($config['app_secret'])) {
            throw new InvalidArgumentException('Configuração da API Oficial incompleta.');
        }

        $payload = [
            'client_id' => $config['app_id'],
            'client_secret' => $config['app_secret'],
            'code' => $code,
        ];

        if ($redirectUri) {
            $payload['redirect_uri'] = $redirectUri;
        }

        return $this->request('GET', '/oauth/access_token', null, $payload);
    }

    public function renovarToken(string $token, array $config): array {
        if (empty($config['app_secret'])) {
            throw new InvalidArgumentException('App secret não configurado.');
        }

        return $this->request('GET', '/oauth/access_token', null, [
            'grant_type' => 'fb_exchange_token',
            'client_id' => $config['app_id'] ?? '',
            'client_secret' => $config['app_secret'],
            'fb_exchange_token' => $token,
        ]);
    }

    public function criarTemplate(string $wabaId, string $accessToken, array $payload): array {
        return $this->request('POST', '/' . $wabaId . '/message_templates', $accessToken, [], $payload);
    }

    public function excluirTemplate(string $wabaId, string $accessToken, string $name): array {
        return $this->request('DELETE', '/' . $wabaId . '/message_templates', $accessToken, ['name' => $name]);
    }

    public function enviarTemplate(string $phoneNumberId, string $accessToken, array $payload): array {
        return $this->request('POST', '/' . $phoneNumberId . '/messages', $accessToken, [], $payload);
    }

    public function enviarTexto(string $phoneNumberId, string $accessToken, string $telefone, string $mensagem): array {
        return $this->request('POST', '/' . $phoneNumberId . '/messages', $accessToken, [], [
            'messaging_product' => 'whatsapp',
            'to' => preg_replace('/\D+/', '', $telefone),
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $mensagem,
            ],
        ]);
    }

    public function atualizarPerfil(string $phoneNumberId, string $accessToken, array $payload): array {
        return $this->request('POST', '/' . $phoneNumberId . '/whatsapp_business_profile', $accessToken, [], $payload);
    }

    public function buscarPerfil(string $phoneNumberId, string $accessToken): array {
        return $this->request('GET', '/' . $phoneNumberId . '/whatsapp_business_profile', $accessToken, [
            'fields' => 'about,address,description,email,profile_picture_url,websites,vertical',
        ]);
    }

    private function request(string $method, string $path, ?string $accessToken = null, array $query = [], ?array $json = null): array {
        $url = 'https://graph.facebook.com/' . self::GRAPH_VERSION . $path;

        if ($query) {
            $url .= '?' . http_build_query($query);
        }

        $headers = ['Content-Type: application/json'];
        if ($accessToken) {
            $headers[] = 'Authorization: Bearer ' . $accessToken;
        }

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 30,
        ]);

        if ($json !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
        }

        $body = curl_exec($ch);
        $error = curl_error($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($body === false) {
            throw new RuntimeException('Erro HTTP Meta: ' . $error);
        }

        $decoded = json_decode($body, true);
        if (!is_array($decoded)) {
            $decoded = ['raw' => $body];
        }

        return [
            'success' => $status >= 200 && $status < 300,
            'status' => $status,
            'data' => $decoded,
        ];
    }
}
