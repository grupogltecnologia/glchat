<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/ConexaoModel.php';
require_once __DIR__ . '/../Models/MetaConfigModel.php';
require_once __DIR__ . '/../Models/TemplateMetaModel.php';
require_once __DIR__ . '/../Services/MetaApiService.php';

class MetaController {
    private ConexaoModel $conexaoModel;
    private MetaConfigModel $configModel;
    private TemplateMetaModel $templateModel;
    private MetaApiService $metaService;

    public function __construct() {
        $this->conexaoModel = new ConexaoModel();
        $this->configModel = new MetaConfigModel();
        $this->templateModel = new TemplateMetaModel();
        $this->metaService = new MetaApiService();
    }

    public function obterConfig(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $this->configModel->obter()]);
    }

    public function salvarConfig(): void {
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        $data = $this->jsonInput();
        $this->configModel->salvar($data);

        echo json_encode(['success' => true, 'data' => $this->configModel->obter()]);
    }

    public function token(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = $this->jsonInput();
            $contaId = Auth::obterContaId();

            if (empty($data['code']) || empty($data['conexaoId'])) {
                echo json_encode(['success' => false, 'error' => 'code e conexaoId são obrigatórios']);
                return;
            }

            $conexao = $this->conexaoModel->buscarPorId((int)$data['conexaoId'], $contaId);
            if (!$conexao) {
                echo json_encode(['success' => false, 'error' => 'Conexão não encontrada']);
                return;
            }

            $config = $this->configModel->obterComSegredo();
            $resposta = $this->metaService->trocarCodePorToken($data['code'], $config ?? [], $data['redirectUri'] ?? null);

            if (!$resposta['success']) {
                echo json_encode($resposta);
                return;
            }

            $token = $resposta['data']['access_token'] ?? null;
            $expiresIn = $resposta['data']['expires_in'] ?? null;
            $expiresAt = $expiresIn ? date('Y-m-d H:i:s', time() + (int)$expiresIn) : null;

            $this->conexaoModel->atualizar((int)$data['conexaoId'], $contaId, [
                'apiOficial' => 1,
                'provider' => 'oficial',
                'access_token' => $token,
                'expires_in' => $expiresIn,
                'expires_at' => $expiresAt,
                'business_id' => $data['business_id'] ?? null,
                'waba_id' => $data['waba_id'] ?? null,
                'phone_number_id' => $data['phone_number_id'] ?? null,
            ]);

            echo json_encode(['success' => true, 'data' => $resposta['data']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function criarTemplate(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = $this->jsonInput();
            $conexao = $this->obterConexaoDaConta($data, false);
            if (!$conexao) return;

            $payload = [
                'name' => $data['nome'] ?? $data['name'] ?? null,
                'language' => $data['idioma'] ?? $data['language'] ?? 'pt_BR',
                'category' => $data['categoria'] ?? $data['category'] ?? 'MARKETING',
                'components' => $data['componentes'] ?? $data['components'] ?? [],
            ];

            if (empty($payload['name']) || empty($payload['components'])) {
                echo json_encode(['success' => false, 'error' => 'nome e componentes são obrigatórios']);
                return;
            }

            $resposta = $this->metaService->criarTemplate($conexao['waba_id'], $conexao['access_token'], $payload);
            if ($resposta['success']) {
                $templateId = $this->templateModel->salvar([
                    'conexaoId' => (int)$conexao['id'],
                    'wabaId' => $conexao['waba_id'],
                    'metaTemplateId' => $resposta['data']['id'] ?? null,
                    'nome' => $payload['name'],
                    'idioma' => $payload['language'],
                    'categoria' => $payload['category'],
                    'status' => $resposta['data']['status'] ?? 'PENDING',
                    'componentes' => $payload['components'],
                    'variaveisCampos' => $data['variaveisCampos'] ?? [],
                ]);
                $resposta['templateLocalId'] = $templateId;
            }

            echo json_encode($resposta);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function excluirTemplate(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = $this->jsonInput();
            $conexao = $this->obterConexaoDaConta($data, false);
            if (!$conexao) return;

            $nome = $data['nome'] ?? $data['name'] ?? null;
            if (!$nome) {
                echo json_encode(['success' => false, 'error' => 'nome do template é obrigatório']);
                return;
            }

            $resposta = $this->metaService->excluirTemplate($conexao['waba_id'], $conexao['access_token'], $nome);

            if (!empty($data['templateId'])) {
                $this->templateModel->remover((int)$data['templateId'], (int)$conexao['id']);
            }

            echo json_encode($resposta);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function enviarTemplate(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = $this->jsonInput();
            $conexao = $this->obterConexaoDaConta($data);
            if (!$conexao) return;

            if (empty($data['telefone']) || empty($data['template'])) {
                echo json_encode(['success' => false, 'error' => 'telefone e template são obrigatórios']);
                return;
            }

            $payload = [
                'messaging_product' => 'whatsapp',
                'to' => preg_replace('/\D+/', '', $data['telefone']),
                'type' => 'template',
                'template' => $data['template'],
            ];

            echo json_encode($this->metaService->enviarTemplate($conexao['phone_number_id'], $conexao['access_token'], $payload));
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function perfil(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = $this->jsonInput();
            $conexao = $this->obterConexaoDaConta($data);
            if (!$conexao) return;

            if (($data['acao'] ?? 'buscar') === 'atualizar') {
                $payload = $data['perfil'] ?? [];
                $resposta = $this->metaService->atualizarPerfil($conexao['phone_number_id'], $conexao['access_token'], $payload);
                if ($resposta['success']) {
                    $this->conexaoModel->atualizar((int)$conexao['id'], Auth::obterContaId(), [
                        'metaPerfil' => $payload,
                        'metaPerfilUpdatedAt' => date('Y-m-d H:i:s'),
                    ]);
                }
                echo json_encode($resposta);
                return;
            }

            echo json_encode($this->metaService->buscarPerfil($conexao['phone_number_id'], $conexao['access_token']));
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function verificarWebhook(): void {
        $config = $this->configModel->obterComSegredo();
        $token = $config['verifyToken'] ?? 'hublabel-meta-webhook';

        if (($_GET['hub_mode'] ?? $_GET['hub.mode'] ?? null) === 'subscribe'
            && ($_GET['hub_verify_token'] ?? $_GET['hub.verify_token'] ?? null) === $token) {
            header('Content-Type: text/plain');
            echo $_GET['hub_challenge'] ?? $_GET['hub.challenge'] ?? '';
            return;
        }

        http_response_code(403);
        echo 'Forbidden';
    }

    public function receberEventos(): void {
        header('Content-Type: application/json');

        $payload = $this->jsonInput();
        error_log('Meta webhook payload: ' . json_encode($payload));

        echo json_encode(['success' => true]);
    }

    private function obterConexaoDaConta(array $data, bool $exigirTelefoneMeta = true): ?array {
        $contaId = Auth::obterContaId();
        if (empty($data['conexaoId'])) {
            echo json_encode(['success' => false, 'error' => 'conexaoId é obrigatório']);
            return null;
        }

        $conexao = $this->conexaoModel->buscarPorId((int)$data['conexaoId'], $contaId);
        if (!$conexao) {
            echo json_encode(['success' => false, 'error' => 'Conexão não encontrada']);
            return null;
        }

        if (empty($conexao['access_token']) || empty($conexao['waba_id']) || ($exigirTelefoneMeta && empty($conexao['phone_number_id']))) {
            echo json_encode(['success' => false, 'error' => 'Conexão oficial incompleta']);
            return null;
        }

        return $conexao;
    }

    private function jsonInput(): array {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw ?: '{}', true);
        return is_array($data) ? $data : [];
    }
}
