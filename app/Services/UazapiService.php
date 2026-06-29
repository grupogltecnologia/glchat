<?php
require_once __DIR__ . '/WhatsAppServiceInterface.php';

class UazapiService implements WhatsAppServiceInterface {
    private string $apiUrl;
    private string $adminToken;
    private string $instanceToken;

    public function __construct(?string $apiUrl = null, ?string $apiKey = null, ?string $instanceToken = null) {
        $this->apiUrl = rtrim($apiUrl ?: getenv('UAZAPI_URL') ?: '', '/');
        $this->adminToken = $apiKey ?: getenv('UAZAPI_KEY') ?: '';
        $this->instanceToken = $instanceToken ?: getenv('UAZAPI_INSTANCE_TOKEN') ?: '';
    }

    public function setInstanceToken(?string $token): void {
        if ($token !== null && trim($token) !== '') {
            $this->instanceToken = trim($token);
        }
    }

    private function request(string $method, string $endpoint, ?array $data = null, string $auth = 'instance'): array {
        $url = $this->apiUrl . $endpoint;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $headers = ['Content-Type: application/json'];
        if ($auth === 'admin') {
            $headers[] = 'admintoken: ' . $this->adminToken;
        } else {
            $headers[] = 'token: ' . $this->instanceToken;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($data !== null && in_array($method, ['POST', 'PUT', 'PATCH'], true)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['success' => false, 'error' => $error];
        }

        $result = json_decode((string)$response, true);

        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'data' => $result,
            'httpCode' => $httpCode,
            'raw' => is_array($result) ? null : $response
        ];
    }

    public function criarInstancia(string $instanceName, string $token = null): array {
        if ($token !== null && trim($token) !== '') {
            $this->setInstanceToken($token);
            return [
                'success' => true,
                'data' => [
                    'name' => $instanceName,
                    'token' => $this->instanceToken,
                    'response' => 'Instancia existente'
                ]
            ];
        }

        $result = $this->request('POST', '/instance/create', [
            'name' => $instanceName
        ], 'admin');

        $createdToken = $result['data']['token'] ?? $result['data']['instance']['token'] ?? null;
        if (is_string($createdToken) && trim($createdToken) !== '') {
            $this->setInstanceToken($createdToken);
        }

        return $result;
    }

    public function conectarInstancia(string $instanceName): array {
        return $this->request('POST', '/instance/connect', [
            'browser' => 'auto'
        ]);
    }

    public function obterQRCode(string $instanceName): array {
        return $this->request('GET', '/instance/status');
    }

    public function verificarStatus(string $instanceName): array {
        return $this->request('GET', '/instance/status');
    }

    public function desconectarInstancia(string $instanceName): array {
        return $this->request('POST', '/instance/disconnect');
    }

    public function deletarInstancia(string $instanceName): array {
        return $this->request('POST', '/instance/reset');
    }

    public function enviarTexto(string $instanceName, string $numero, string $mensagem): array {
        return $this->request('POST', '/send/text', [
            'number' => $this->formatarNumero($numero),
            'text' => $mensagem
        ]);
    }

    public function enviarImagem(string $instanceName, string $numero, string $urlImagem, string $caption = ''): array {
        return $this->request('POST', '/send/media', [
            'number' => $this->formatarNumero($numero),
            'type' => 'image',
            'file' => $urlImagem,
            'text' => $caption
        ]);
    }

    public function enviarAudio(string $instanceName, string $numero, string $urlAudio): array {
        return $this->request('POST', '/send/media', [
            'number' => $this->formatarNumero($numero),
            'type' => 'ptt',
            'file' => $urlAudio
        ]);
    }

    public function enviarDocumento(string $instanceName, string $numero, string $urlDocumento, string $filename = ''): array {
        return $this->request('POST', '/send/media', [
            'number' => $this->formatarNumero($numero),
            'type' => 'document',
            'file' => $urlDocumento,
            'docName' => $filename
        ]);
    }

    public function enviarVideo(string $instanceName, string $numero, string $urlVideo, string $caption = ''): array {
        return $this->request('POST', '/send/media', [
            'number' => $this->formatarNumero($numero),
            'type' => 'video',
            'file' => $urlVideo,
            'text' => $caption
        ]);
    }

    public function listarGrupos(string $instanceName): array {
        return $this->request('GET', '/group/findGroups');
    }

    public function obterParticipantesGrupo(string $instanceName, string $grupoId): array {
        return $this->request('POST', '/group/participants', [
            'groupid' => $grupoId
        ]);
    }

    public function sincronizarContatos(string $instanceName): array {
        return $this->request('GET', '/contacts');
    }

    public function obterInfoContato(string $instanceName, string $numero): array {
        return $this->request('POST', '/chat/check', [
            'number' => $this->formatarNumero($numero)
        ]);
    }

    public function marcarComoLida(string $instanceName, string $messageId): array {
        return $this->request('POST', '/message/read', [
            'id' => $messageId
        ]);
    }

    public function obterFotoPerfil(string $instanceName, string $numero): array {
        return $this->request('POST', '/contacts/profile-picture', [
            'number' => $this->formatarNumero($numero)
        ]);
    }

    public function configurarWebhook(string $instanceName, string $webhookUrl, array $eventos = []): array {
        return $this->request('POST', '/webhook', [
            'enabled' => true,
            'url' => $webhookUrl,
            'events' => !empty($eventos) ? $eventos : ['messages', 'connection'],
            'excludeMessages' => ['wasSentByApi']
        ]);
    }

    private function formatarNumero(string $numero): string {
        $numero = preg_replace('/[^0-9]/', '', $numero);

        if (strlen($numero) === 11 && substr($numero, 0, 2) !== '55') {
            $numero = '55' . $numero;
        }

        return $numero;
    }

    public function validarNumero(string $numero): bool {
        $numero = $this->formatarNumero($numero);
        return strlen($numero) >= 12 && strlen($numero) <= 13;
    }
}
