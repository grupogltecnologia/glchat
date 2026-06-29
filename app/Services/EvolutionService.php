<?php
require_once __DIR__ . '/WhatsAppServiceInterface.php';

class EvolutionService implements WhatsAppServiceInterface {
    private string $apiUrl;
    private string $apiKey;

    public function __construct(?string $apiUrl = null, ?string $apiKey = null) {
        $this->apiUrl = rtrim($apiUrl ?: getenv('EVOLUTION_API_URL') ?: '', '/');
        $this->apiKey = $apiKey ?: getenv('EVOLUTION_API_KEY') ?: '';
    }

    private function request(string $method, string $endpoint, ?array $data = null): array {
        $url = $this->apiUrl . $endpoint;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        $headers = [
            'Content-Type: application/json',
            'apikey: ' . $this->apiKey
        ];
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        if ($data !== null && in_array($method, ['POST', 'PUT', 'PATCH'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($error) {
            return ['success' => false, 'error' => $error];
        }
        
        $result = json_decode($response, true);
        
        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'data' => $result,
            'httpCode' => $httpCode,
            'raw' => is_array($result) ? null : $response
        ];
    }

    public function criarInstancia(string $instanceName, string $token = null): array {
        $payload = [
            'instanceName' => $instanceName,
            'qrcode' => true,
            'integration' => 'WHATSAPP-BAILEYS',
            'rejectCall' => false,
            'groupsIgnore' => true,
            'alwaysOnline' => false,
            'readMessages' => false,
            'syncFullHistory' => false,
            'readStatus' => false
        ];

        if ($token !== null && trim($token) !== '') {
            $payload['token'] = $token;
        }

        return $this->request('POST', '/instance/create', $payload);
    }

    public function conectarInstancia(string $instanceName): array {
        return $this->request('GET', "/instance/connect/{$instanceName}");
    }

    public function obterQRCode(string $instanceName): array {
        return $this->request('GET', "/instance/qrcode/{$instanceName}");
    }

    public function verificarStatus(string $instanceName): array {
        return $this->request('GET', "/instance/connectionState/{$instanceName}");
    }

    public function desconectarInstancia(string $instanceName): array {
        return $this->request('DELETE', "/instance/logout/{$instanceName}");
    }

    public function deletarInstancia(string $instanceName): array {
        return $this->request('DELETE', "/instance/delete/{$instanceName}");
    }

    public function enviarTexto(string $instanceName, string $numero, string $mensagem): array {
        return $this->request('POST', "/message/sendText/{$instanceName}", [
            'number' => $this->formatarNumero($numero),
            'text' => $mensagem
        ]);
    }

    public function enviarImagem(string $instanceName, string $numero, string $urlImagem, string $caption = ''): array {
        return $this->request('POST', "/message/sendMedia/{$instanceName}", [
            'number' => $this->formatarNumero($numero),
            'mediatype' => 'image',
            'media' => $urlImagem,
            'caption' => $caption
        ]);
    }

    public function enviarAudio(string $instanceName, string $numero, string $urlAudio): array {
        return $this->request('POST', "/message/sendMedia/{$instanceName}", [
            'number' => $this->formatarNumero($numero),
            'mediatype' => 'audio',
            'media' => $urlAudio
        ]);
    }

    public function enviarDocumento(string $instanceName, string $numero, string $urlDocumento, string $filename = ''): array {
        return $this->request('POST', "/message/sendMedia/{$instanceName}", [
            'number' => $this->formatarNumero($numero),
            'mediatype' => 'document',
            'media' => $urlDocumento,
            'fileName' => $filename
        ]);
    }

    public function enviarVideo(string $instanceName, string $numero, string $urlVideo, string $caption = ''): array {
        return $this->request('POST', "/message/sendMedia/{$instanceName}", [
            'number' => $this->formatarNumero($numero),
            'mediatype' => 'video',
            'media' => $urlVideo,
            'caption' => $caption
        ]);
    }

    public function listarGrupos(string $instanceName): array {
        return $this->request('GET', "/group/fetchAllGroups/{$instanceName}");
    }

    public function obterParticipantesGrupo(string $instanceName, string $grupoId): array {
        return $this->request('GET', "/group/participants/{$instanceName}", [
            'groupJid' => $grupoId
        ]);
    }

    public function sincronizarContatos(string $instanceName): array {
        return $this->request('GET', "/chat/findContacts/{$instanceName}");
    }

    public function obterInfoContato(string $instanceName, string $numero): array {
        return $this->request('POST', "/chat/whatsappNumbers/{$instanceName}", [
            'numbers' => [$this->formatarNumero($numero)]
        ]);
    }

    public function marcarComoLida(string $instanceName, string $messageId): array {
        return $this->request('POST', "/chat/markMessageAsRead/{$instanceName}", [
            'readMessages' => [
                ['id' => $messageId, 'fromMe' => false]
            ]
        ]);
    }

    public function obterFotoPerfil(string $instanceName, string $numero): array {
        return $this->request('POST', "/chat/getProfilePicUrl/{$instanceName}", [
            'number' => $this->formatarNumero($numero)
        ]);
    }

    public function configurarWebhook(string $instanceName, string $webhookUrl, array $eventos = []): array {
        $eventosDefault = [
            'QRCODE_UPDATED',
            'CONNECTION_UPDATE',
            'MESSAGES_UPSERT',
            'MESSAGES_UPDATE',
            'SEND_MESSAGE'
        ];
        
        return $this->request('POST', "/webhook/set/{$instanceName}", [
            'webhook' => [
                'enabled' => true,
                'url' => $webhookUrl,
                'byEvents' => false,
                'base64' => false,
                'events' => !empty($eventos) ? $eventos : $eventosDefault
            ]
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
