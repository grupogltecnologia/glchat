<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/ConexaoModel.php';
require_once __DIR__ . '/../Models/AgenteModel.php';
require_once __DIR__ . '/../Services/WhatsAppServiceFactory.php';

class ConexoesController {
    private ConexaoModel $conexaoModel;
    private AgenteModel $agenteModel;

    public function __construct() {
        $this->conexaoModel = new ConexaoModel();
        $this->agenteModel = new AgenteModel();
    }

    public function index(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/conexoes_clean.php';
    }

    public function listar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $contaId = Auth::obterContaId();
            $conexoes = array_map([$this, 'normalizarConexao'], $this->conexaoModel->listarPorConta($contaId));
            echo json_encode(['success' => true, 'data' => $conexoes]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar conexoes: ' . $e->getMessage()]);
        }
    }

    public function criar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();

            if (empty($data['nomeConexao'])) {
                echo json_encode(['success' => false, 'error' => 'Nome da conexao e obrigatorio']);
                return;
            }

            $provider = $this->normalizarProvider($data['provider'] ?? (!empty($data['apiOficial']) ? 'oficial' : 'evolution'));
            $instanceName = $data['instanceName'] ?? $this->gerarInstanceName($contaId, $provider);

            $id = $this->conexaoModel->criar([
                'contaId' => $contaId,
                'instanceName' => $instanceName,
                'nomeConexao' => trim((string)$data['nomeConexao']),
                'telefone' => $data['telefone'] ?? null,
                'apikey' => $data['apikey'] ?? null,
                'idAgente' => $data['idAgente'] ?? null,
                'apiOficial' => $provider === 'oficial' ? 1 : 0,
                'provider' => $provider,
                'access_token' => $data['access_token'] ?? null,
                'expires_in' => $data['expires_in'] ?? null,
                'business_id' => $data['business_id'] ?? null,
                'waba_id' => $data['waba_id'] ?? null,
                'phone_number_id' => $data['phone_number_id'] ?? null,
                'expires_at' => $data['expires_at'] ?? null
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $id,
                    'instanceName' => $instanceName,
                    'provider' => $provider,
                    'message' => 'Conexao criada com sucesso'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar conexao: ' . $e->getMessage()]);
        }
    }

    public function atualizar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();

            if (empty($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID nao informado']);
                return;
            }

            $conexao = $this->conexaoModel->buscarPorId((int)$data['id'], $contaId);
            if (!$conexao) {
                echo json_encode(['success' => false, 'error' => 'Conexao nao encontrada']);
                return;
            }

            $dadosAtualizacao = [];
            if (isset($data['nomeConexao'])) $dadosAtualizacao['NomeConexao'] = $data['nomeConexao'];
            if (isset($data['telefone'])) $dadosAtualizacao['Telefone'] = $data['telefone'];
            if (isset($data['fotoPerfil'])) $dadosAtualizacao['FotoPerfil'] = $data['fotoPerfil'];
            if (isset($data['idAgente'])) $dadosAtualizacao['idAgente'] = $data['idAgente'];
            if (isset($data['statusConexao'])) $dadosAtualizacao['statusConexao'] = $data['statusConexao'];
            if (isset($data['provider'])) {
                $provider = $this->normalizarProvider($data['provider']);
                $dadosAtualizacao['provider'] = $provider;
                $dadosAtualizacao['apiOficial'] = $provider === 'oficial' ? 1 : 0;
            } elseif (isset($data['apiOficial'])) {
                $dadosAtualizacao['apiOficial'] = $data['apiOficial'] ? 1 : 0;
                $dadosAtualizacao['provider'] = $data['apiOficial'] ? 'oficial' : ($conexao['provider'] ?? 'evolution');
            }
            if (isset($data['access_token'])) $dadosAtualizacao['access_token'] = $data['access_token'];
            if (isset($data['expires_in'])) $dadosAtualizacao['expires_in'] = $data['expires_in'];
            if (isset($data['business_id'])) $dadosAtualizacao['business_id'] = $data['business_id'];
            if (isset($data['waba_id'])) $dadosAtualizacao['waba_id'] = $data['waba_id'];
            if (isset($data['phone_number_id'])) $dadosAtualizacao['phone_number_id'] = $data['phone_number_id'];
            if (isset($data['expires_at'])) $dadosAtualizacao['expires_at'] = $data['expires_at'];

            $this->conexaoModel->atualizar((int)$data['id'], $contaId, $dadosAtualizacao);
            echo json_encode(['success' => true, 'data' => ['message' => 'Conexao atualizada']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar conexao: ' . $e->getMessage()]);
        }
    }

    public function deletar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();

            if (empty($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID nao informado']);
                return;
            }

            $this->conexaoModel->deletar((int)$data['id'], $contaId);
            echo json_encode(['success' => true, 'data' => ['message' => 'Conexao deletada']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao deletar conexao: ' . $e->getMessage()]);
        }
    }

    public function qrcode(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();

            if (empty($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID nao informado']);
                return;
            }

            $conexao = $this->conexaoModel->buscarPorId((int)$data['id'], $contaId);
            if (!$conexao) {
                echo json_encode(['success' => false, 'error' => 'Conexao nao encontrada']);
                return;
            }

            $provider = $this->normalizarProvider($conexao['provider'] ?? (!empty($conexao['apiOficial']) ? 'oficial' : 'evolution'));
            if ($provider === 'oficial') {
                echo json_encode(['success' => false, 'error' => 'A API Oficial usa o fluxo Embedded Signup da Meta, nao QR Code.']);
                return;
            }

            $instanceName = $conexao['instanceName'] ?: $this->gerarInstanceName($contaId, $provider);
            if (empty($conexao['instanceName'])) {
                $this->conexaoModel->atualizar((int)$conexao['id'], $contaId, ['instanceName' => $instanceName]);
            }

            $service = WhatsAppServiceFactory::getServiceForProvider($provider);
            $connectionToken = $provider === 'uazapi' ? ($conexao['apikey'] ?? $conexao['Apikey'] ?? null) : null;
            $create = $service->criarInstancia($instanceName, $connectionToken);
            $instanceName = $this->extrairInstanceName($create) ?: $instanceName;
            $instanceToken = $this->extrairInstanceToken($create);
            if ($instanceToken && method_exists($service, 'setInstanceToken')) {
                $service->setInstanceToken($instanceToken);
            }
            $qrcode = $this->extrairQRCode($create);
            $connect = ['httpCode' => null, 'data' => null];
            $qrResult = ['httpCode' => null, 'data' => null];

            if (!$qrcode) {
                $connect = $service->conectarInstancia($instanceName);
                $qrcode = $this->extrairQRCode($connect);
            }

            if (!$qrcode) {
                $qrResult = $service->obterQRCode($instanceName);
                $qrcode = $this->extrairQRCode($qrResult);
            }

            if (!$qrcode) {
                echo json_encode([
                    'success' => false,
                    'error' => 'A API retornou sem QR Code. Confira a configuracao do provedor.',
                    'debug' => [
                        'provider' => $provider,
                        'httpCode' => $qrResult['httpCode'] ?? $connect['httpCode'] ?? $create['httpCode'] ?? null
                    ]
                ]);
                return;
            }

            $dadosAtualizacao = [
                'instanceName' => $instanceName,
                'statusConexao' => 'conectando'
            ];
            if ($instanceToken) {
                $dadosAtualizacao['Apikey'] = $instanceToken;
            }
            $this->conexaoModel->atualizar((int)$conexao['id'], $contaId, $dadosAtualizacao);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => (int)$conexao['id'],
                    'provider' => $provider,
                    'instanceName' => $instanceName,
                    'qrcode' => $qrcode,
                    'message' => 'QR Code gerado'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao gerar QR Code: ' . $e->getMessage()]);
        }
    }

    public function status(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();

            if (empty($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID nao informado']);
                return;
            }

            $conexao = $this->conexaoModel->buscarPorId((int)$data['id'], $contaId);
            if (!$conexao) {
                echo json_encode(['success' => false, 'error' => 'Conexao nao encontrada']);
                return;
            }

            $provider = $this->normalizarProvider($conexao['provider'] ?? (!empty($conexao['apiOficial']) ? 'oficial' : 'evolution'));
            $status = 'desconectado';
            $telefone = $conexao['Telefone'] ?? $conexao['telefone'] ?? $conexao['numeroConexao'] ?? null;
            $foto = $conexao['FotoPerfil'] ?? $conexao['fotoPerfil'] ?? null;

            if ($provider === 'oficial') {
                $status = !empty($conexao['phone_number_id']) && !empty($conexao['access_token']) ? 'conectado' : 'desconectado';
            } else {
                if (empty($conexao['instanceName'])) {
                    echo json_encode(['success' => false, 'error' => 'Conexao sem instanceName']);
                    return;
                }

                $service = WhatsAppServiceFactory::getServiceForProvider($provider);
                if ($provider === 'uazapi' && method_exists($service, 'setInstanceToken')) {
                    $service->setInstanceToken($conexao['apikey'] ?? $conexao['Apikey'] ?? null);
                }

                $result = $service->verificarStatus($conexao['instanceName']);
                $status = $this->normalizarStatusApi($provider, $result);
                $telefone = $this->extrairTelefoneStatus($provider, $result) ?: $telefone;
                $foto = $this->extrairFotoStatus($result) ?: $foto;
            }

            $update = ['statusConexao' => $status];
            if ($telefone) {
                $update['Telefone'] = $telefone;
                $update['numeroConexao'] = $telefone;
            }
            if ($foto) {
                $update['FotoPerfil'] = $foto;
            }
            $this->conexaoModel->atualizar((int)$conexao['id'], $contaId, $update);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => (int)$conexao['id'],
                    'provider' => $provider,
                    'statusConexao' => $status,
                    'telefone' => $telefone,
                    'fotoPerfil' => $foto,
                    'connected' => $status === 'conectado'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao verificar status: ' . $e->getMessage()]);
        }
    }

    private function normalizarConexao(array $conexao): array {
        $provider = $this->normalizarProvider($conexao['provider'] ?? (!empty($conexao['apiOficial']) ? 'oficial' : 'evolution'));
        $conexao['provider'] = $provider;
        $conexao['apiOficial'] = $provider === 'oficial' ? 1 : (int)($conexao['apiOficial'] ?? 0);
        $conexao['nomeConexao'] = $conexao['nomeConexao'] ?? $conexao['NomeConexao'] ?? null;
        $conexao['statusConexao'] = $conexao['statusConexao'] ?? 'desconectado';
        return $conexao;
    }

    private function normalizarProvider(?string $provider): string {
        $provider = strtolower(trim((string)$provider));
        return in_array($provider, ['evolution', 'oficial', 'uazapi'], true) ? $provider : 'evolution';
    }

    private function gerarInstanceName(string $contaId, string $provider): string {
        $prefix = $provider === 'uazapi' ? 'uaz' : ($provider === 'oficial' ? 'meta' : 'evo');
        return $prefix . '_' . substr(preg_replace('/[^a-zA-Z0-9]/', '', $contaId), 0, 8) . '_' . bin2hex(random_bytes(4));
    }

    private function extrairQRCode(array $result): ?string {
        $data = $result['data'] ?? $result;
        $candidates = [
            $data['base64'] ?? null,
            $data['qrcode'] ?? null,
            $data['qrcode']['base64'] ?? null,
            $data['qrcode']['code'] ?? null,
            $data['qrcode']['pairingCode'] ?? null,
            $data['instance']['qrcode'] ?? null,
            $data['instance']['paircode'] ?? null,
            $data['instance']['pairingCode'] ?? null,
            $data['qrCode'] ?? null,
            $data['code'] ?? null,
            $data['paircode'] ?? null,
            $data['pairingCode'] ?? null,
            $data['data']['base64'] ?? null,
            $data['data']['qrcode'] ?? null,
            $data['data']['qrcode']['base64'] ?? null,
            $data['data']['qrcode']['code'] ?? null,
            $data['data']['qrcode']['pairingCode'] ?? null,
            $data['data']['instance']['qrcode'] ?? null,
            $data['data']['instance']['paircode'] ?? null,
            $data['data']['instance']['pairingCode'] ?? null,
            $data['data']['qrCode'] ?? null,
            $data['data']['paircode'] ?? null,
        ];

        foreach ($candidates as $candidate) {
            if (!is_string($candidate) || trim($candidate) === '') {
                continue;
            }
            $candidate = trim($candidate);
            if (strpos($candidate, 'data:image') === 0) {
                return $candidate;
            }
            if (strlen($candidate) > 100 && preg_match('/^[A-Za-z0-9+\/=\s]+$/', $candidate)) {
                return 'data:image/png;base64,' . preg_replace('/\s+/', '', $candidate);
            }
            return $candidate;
        }

        return null;
    }

    private function extrairInstanceName(array $result): ?string {
        $data = $result['data'] ?? $result;
        $candidate = $data['instanceName']
            ?? $data['name']
            ?? $data['instance']['instanceName']
            ?? $data['instance']['name']
            ?? $data['data']['instanceName']
            ?? $data['data']['name']
            ?? $data['data']['instance']['instanceName']
            ?? $data['data']['instance']['name']
            ?? null;

        return is_string($candidate) && trim($candidate) !== '' ? trim($candidate) : null;
    }

    private function extrairInstanceToken(array $result): ?string {
        $data = $result['data'] ?? $result;
        $candidate = $data['hash']
            ?? $data['token']
            ?? $data['instance']['hash']
            ?? $data['instance']['token']
            ?? $data['data']['hash']
            ?? $data['data']['token']
            ?? $data['data']['instance']['hash']
            ?? $data['data']['instance']['token']
            ?? null;

        return is_string($candidate) && trim($candidate) !== '' ? trim($candidate) : null;
    }

    private function normalizarStatusApi(string $provider, array $result): string {
        $data = $result['data'] ?? $result;
        $raw = $data['instance']['state']
            ?? $data['state']
            ?? $data['connectionState']
            ?? $data['instance']['status']
            ?? $data['status']['status']
            ?? $data['status']
            ?? null;

        $connected = $data['connected']
            ?? $data['loggedIn']
            ?? $data['status']['connected']
            ?? $data['status']['loggedIn']
            ?? null;

        if ($connected === true || $connected === 1 || $connected === 'true') {
            return 'conectado';
        }

        $raw = strtolower(trim(is_scalar($raw) ? (string)$raw : ''));
        if (in_array($raw, ['open', 'connected', 'conectado', 'online'], true)) {
            return 'conectado';
        }
        if (in_array($raw, ['connecting', 'qrcode', 'qr', 'pairing', 'conectando'], true)) {
            return 'conectando';
        }

        return 'desconectado';
    }

    private function extrairTelefoneStatus(string $provider, array $result): ?string {
        $data = $result['data'] ?? $result;
        $candidate = $data['instance']['profileName'] ?? null;
        $jidUser = $data['status']['jid']['user']
            ?? $data['jid']['user']
            ?? $data['instance']['owner']
            ?? $data['instance']['jid']
            ?? null;

        if (is_scalar($jidUser)) {
            $phone = preg_replace('/[^0-9]/', '', (string)$jidUser);
            if ($phone !== '') {
                return $phone;
            }
        }

        return is_string($candidate) && preg_match('/^\+?\d[\d\s().-]+$/', $candidate) ? preg_replace('/[^0-9]/', '', $candidate) : null;
    }

    private function extrairFotoStatus(array $result): ?string {
        $data = $result['data'] ?? $result;
        $candidate = $data['instance']['profilePicUrl']
            ?? $data['profilePicUrl']
            ?? $data['profilePictureUrl']
            ?? null;

        return is_string($candidate) && trim($candidate) !== '' ? trim($candidate) : null;
    }
}
