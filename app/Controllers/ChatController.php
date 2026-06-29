<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/ConversaModel.php';
require_once __DIR__ . '/../Models/MensagemModel.php';
require_once __DIR__ . '/../Models/ContatoModel.php';
require_once __DIR__ . '/../Models/ConexaoModel.php';
require_once __DIR__ . '/../Services/WhatsAppServiceFactory.php';
require_once __DIR__ . '/../Services/MetaApiService.php';
require_once __DIR__ . '/../Services/RealtimeTokenService.php';

class ChatController {
    private ConversaModel $conversaModel;
    private MensagemModel $mensagemModel;
    private ContatoModel $contatoModel;
    private ConexaoModel $conexaoModel;

    public function __construct() {
        $this->conversaModel = new ConversaModel();
        $this->mensagemModel = new MensagemModel();
        $this->contatoModel = new ContatoModel();
        $this->conexaoModel = new ConexaoModel();
    }

    public function index(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/chat_clean.php';
    }

    public function listarConversas(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $contaId = Auth::obterContaId();
            $status = $_GET['status'] ?? null;
            echo json_encode(['success' => true, 'data' => $this->conversaModel->listarPorConta($contaId, $status)]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar conversas: ' . $e->getMessage()]);
        }
    }

    public function listarMensagens(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $contaId = Auth::obterContaId();
            if (!isset($_GET['conversaId'])) {
                echo json_encode(['success' => false, 'error' => 'ID da conversa nao informado']);
                return;
            }

            $conversaId = (int)$_GET['conversaId'];
            $conversa = $this->conversaModel->buscarPorId($conversaId, $contaId);
            if (!$conversa) {
                echo json_encode(['success' => false, 'error' => 'Conversa nao encontrada']);
                return;
            }

            $mensagens = $this->mensagemModel->listarPorConversa($conversaId, $contaId);
            $this->conversaModel->marcarComoLida($conversaId, $contaId);

            echo json_encode(['success' => true, 'data' => $mensagens]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar mensagens: ' . $e->getMessage()]);
        }
    }

    public function criarConversa(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();
            $telefone = $this->normalizarTelefone($data['telefone'] ?? '');
            $conexaoId = (int)($data['conexaoId'] ?? $data['idConexao'] ?? 0);

            if (!$telefone || !$conexaoId) {
                echo json_encode(['success' => false, 'error' => 'Telefone e conexao sao obrigatorios']);
                return;
            }

            $conexao = $this->conexaoModel->buscarPorId($conexaoId, $contaId);
            if (!$conexao) {
                echo json_encode(['success' => false, 'error' => 'Conexao nao encontrada']);
                return;
            }

            $contato = null;
            if (!empty($data['contatoId'])) {
                $contato = $this->contatoModel->buscarPorId((int)$data['contatoId'], $contaId);
            }
            if (!$contato) {
                $contato = $this->contatoModel->buscarPorTelefone($telefone, $contaId);
            }
            if (!$contato && !empty($data['nome'])) {
                $contatoId = $this->contatoModel->criar([
                    'contaId' => $contaId,
                    'nome' => $data['nome'],
                    'telefone' => $telefone,
                    'validado' => 1
                ]);
                $contato = $this->contatoModel->buscarPorId($contatoId, $contaId);
            }

            $conversa = $this->conversaModel->buscarPorTelefone($telefone, $conexaoId, $contaId);
            if (!$conversa) {
                $conversaId = $this->conversaModel->criar([
                    'contaId' => $contaId,
                    'idAgente' => $conexao['idAgente'] ?? null,
                    'idConexao' => $conexaoId,
                    'telefone' => $telefone,
                    'contatoId' => $contato['id'] ?? null,
                    'nomeConversa' => $data['nome'] ?? ($contato['nome'] ?? $telefone),
                    'fotoPerfil' => $contato['fotoPerfil'] ?? null,
                    'lida' => 1,
                    'statusAtendimento' => 'aberto',
                    'atendente' => Auth::obterUsuarioId()
                ]);
                $conversa = $this->conversaModel->buscarPorId($conversaId, $contaId);
            }

            echo json_encode(['success' => true, 'data' => $conversa]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar conversa: ' . $e->getMessage()]);
        }
    }

    public function enviarMensagem(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();
            $mensagem = $data['mensagem'] ?? $data['conteudo'] ?? null;

            if (!isset($data['conversaId']) || ($mensagem === null && empty($data['arquivoUrl']))) {
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }

            $conversaId = (int)$data['conversaId'];
            $conversa = $this->conversaModel->buscarPorId($conversaId, $contaId);
            if (!$conversa) {
                echo json_encode(['success' => false, 'error' => 'Conversa nao encontrada']);
                return;
            }

            $sendResult = $this->enviarParaWhatsApp($conversa, $data, $mensagem);
            $sent = !empty($sendResult['success']);

            $mensagemId = $this->mensagemModel->criar([
                'contaId' => $contaId,
                'conexaoId' => $conversa['idConexao'] ?? null,
                'conversaId' => $conversaId,
                'mensagem' => $mensagem,
                'tipoMensagem' => $data['tipoMensagem'] ?? 'text',
                'arquivoUrl' => $data['arquivoUrl'] ?? null,
                'fromMe' => 1,
                'enviada' => $sent ? 1 : 0,
                'messageEvolutionId' => $this->extrairIdMensagem($sendResult, 'evolution'),
                'metaMessageId' => $this->extrairIdMensagem($sendResult, 'oficial'),
                'metaStatus' => $sent ? 'sent' : 'failed'
            ]);

            $this->conversaModel->atualizar($conversaId, $contaId, [
                'ultimaMensagem' => date('Y-m-d H:i:s')
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $mensagemId,
                    'message' => $sent ? 'Mensagem enviada' : 'Mensagem registrada, mas nao enviada pela API',
                    'api' => $sendResult,
                    'realtime' => true
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao enviar mensagem: ' . $e->getMessage()]);
        }
    }

    public function receberWebhookWhatsApp(): void {
        header('Content-Type: application/json');

        try {
            $payload = json_decode(file_get_contents('php://input'), true) ?: [];
            $idConexao = $_GET['idConexao'] ?? $_GET['id'] ?? $payload['idConexao'] ?? $payload['connectionId'] ?? null;
            $instanceName = $_GET['instance'] ?? $payload['instance'] ?? $payload['instanceName'] ?? ($payload['data']['instanceId'] ?? null);
            $conexao = $this->buscarConexaoWebhook($idConexao, $instanceName);

            if (!$conexao) {
                echo json_encode(['success' => false, 'error' => 'Conexao do webhook nao encontrada']);
                return;
            }

            $mensagem = $this->extrairMensagemWebhook($payload);
            if (!$mensagem || empty($mensagem['telefone'])) {
                echo json_encode(['success' => true, 'data' => ['ignored' => true, 'reason' => 'Payload sem mensagem reconhecida']]);
                return;
            }

            if (!empty($mensagem['fromMe'])) {
                echo json_encode(['success' => true, 'data' => ['ignored' => true, 'reason' => 'Mensagem enviada pela propria API']]);
                return;
            }

            $contaId = (string)$conexao['contaId'];
            $telefone = $this->normalizarTelefone($mensagem['telefone']);
            $contato = $this->contatoModel->buscarPorTelefone($telefone, $contaId);
            if (!$contato) {
                $contatoId = $this->contatoModel->criar([
                    'contaId' => $contaId,
                    'nome' => $mensagem['nome'] ?: $telefone,
                    'telefone' => $telefone,
                    'fotoPerfil' => $mensagem['fotoPerfil'] ?? null,
                    'validado' => 1
                ]);
                $contato = $this->contatoModel->buscarPorId($contatoId, $contaId);
            }

            $conversa = $this->conversaModel->buscarPorTelefone($telefone, (int)$conexao['id'], $contaId);
            if (!$conversa) {
                $conversaId = $this->conversaModel->criar([
                    'contaId' => $contaId,
                    'idAgente' => $conexao['idAgente'] ?? null,
                    'idConexao' => (int)$conexao['id'],
                    'telefone' => $telefone,
                    'contatoId' => $contato['id'] ?? null,
                    'nomeConversa' => $contato['nome'] ?? ($mensagem['nome'] ?: $telefone),
                    'fotoPerfil' => $contato['fotoPerfil'] ?? ($mensagem['fotoPerfil'] ?? null),
                    'lida' => 0,
                    'statusAtendimento' => 'aberto'
                ]);
                $conversa = $this->conversaModel->buscarPorId($conversaId, $contaId);
            }

            $mensagemId = $this->mensagemModel->criar([
                'contaId' => $contaId,
                'conexaoId' => (int)$conexao['id'],
                'conversaId' => (int)$conversa['id'],
                'mensagem' => $mensagem['texto'],
                'tipoMensagem' => $mensagem['tipoMensagem'],
                'arquivoUrl' => $mensagem['arquivoUrl'],
                'fromMe' => 0,
                'enviada' => 1,
                'messageEvolutionId' => $mensagem['messageId'] ?? null
            ]);

            $this->conversaModel->atualizar((int)$conversa['id'], $contaId, [
                'ultimaMensagem' => date('Y-m-d H:i:s'),
                'lida' => 0,
                'nomeConversa' => $contato['nome'] ?? ($mensagem['nome'] ?: $telefone),
                'fotoPerfil' => $contato['fotoPerfil'] ?? ($mensagem['fotoPerfil'] ?? null)
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'conversaId' => (int)$conversa['id'],
                    'mensagemId' => $mensagemId
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao processar webhook: ' . $e->getMessage()]);
        }
    }

    public function realtimeConfig(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $stmt = Database::pdo()->query("SELECT * FROM realtime_config WHERE id = 1");
            $config = $stmt->fetch() ?: [
                'enabled' => 1,
                'port' => 8090,
                'path' => '/chat',
                'public_url' => null,
            ];

            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'wss' : 'ws';
            $url = $config['public_url'] ?: $scheme . '://' . ($_SERVER['SERVER_NAME'] ?? 'localhost') . ':' . $config['port'] . ($config['path'] ?: '/chat');

            echo json_encode([
                'success' => true,
                'data' => [
                    'enabled' => (bool)$config['enabled'],
                    'url' => $url,
                    'token' => RealtimeTokenService::gerar((string)Auth::obterContaId(), (string)Auth::obterUsuarioId()),
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function atualizarStatus(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();

            if (!isset($data['conversaId']) || !isset($data['status'])) {
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }

            $conversaId = (int)$data['conversaId'];
            if (!$this->conversaModel->buscarPorId($conversaId, $contaId)) {
                echo json_encode(['success' => false, 'error' => 'Conversa nao encontrada']);
                return;
            }

            $this->conversaModel->atualizar($conversaId, $contaId, [
                'statusAtendimento' => $data['status'],
                'atendente' => Auth::obterUsuarioId()
            ]);

            echo json_encode(['success' => true, 'data' => ['message' => 'Status atualizado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar status']);
        }
    }

    private function enviarParaWhatsApp(array $conversa, array $data, ?string $mensagem): array {
        $contaId = Auth::obterContaId();
        $conexaoId = (int)($conversa['idConexao'] ?? 0);
        if (!$conexaoId) {
            return ['success' => false, 'error' => 'Conversa sem conexao vinculada'];
        }

        $conexao = $this->conexaoModel->buscarPorId($conexaoId, $contaId);
        if (!$conexao) {
            return ['success' => false, 'error' => 'Conexao nao encontrada'];
        }

        $telefone = $data['telefone'] ?? $conversa['telefone'] ?? $conversa['telefoneConversa'] ?? null;
        if (!$telefone) {
            return ['success' => false, 'error' => 'Telefone da conversa nao encontrado'];
        }

        $provider = $this->normalizarProvider($conexao['provider'] ?? (!empty($conexao['apiOficial']) ? 'oficial' : 'evolution'));
        $tipo = $data['tipoMensagem'] ?? 'text';
        $arquivoUrl = $data['arquivoUrl'] ?? null;

        if ($provider === 'oficial') {
            if (empty($conexao['phone_number_id']) || empty($conexao['access_token'])) {
                return ['success' => false, 'error' => 'Conexao oficial incompleta'];
            }
            if ($tipo !== 'text' || $arquivoUrl) {
                return ['success' => false, 'error' => 'Envio de midia pela API Oficial ainda precisa de media_id/template'];
            }
            $meta = new MetaApiService();
            $result = $meta->enviarTexto($conexao['phone_number_id'], $conexao['access_token'], $telefone, (string)$mensagem);
            $result['provider'] = 'oficial';
            return $result;
        }

        if (empty($conexao['instanceName'])) {
            return ['success' => false, 'error' => 'Conexao sem instanceName'];
        }

        $service = WhatsAppServiceFactory::getServiceForProvider($provider);
        if ($provider === 'uazapi' && method_exists($service, 'setInstanceToken')) {
            $service->setInstanceToken($conexao['apikey'] ?? $conexao['Apikey'] ?? null);
        }

        if ($arquivoUrl) {
            if ($tipo === 'image') {
                $result = $service->enviarImagem($conexao['instanceName'], $telefone, $arquivoUrl, (string)$mensagem);
            } elseif ($tipo === 'audio') {
                $result = $service->enviarAudio($conexao['instanceName'], $telefone, $arquivoUrl);
            } elseif ($tipo === 'video') {
                $result = $service->enviarVideo($conexao['instanceName'], $telefone, $arquivoUrl, (string)$mensagem);
            } else {
                $filename = basename(parse_url($arquivoUrl, PHP_URL_PATH) ?: 'arquivo');
                $result = $service->enviarDocumento($conexao['instanceName'], $telefone, $arquivoUrl, $filename);
            }
        } else {
            $result = $service->enviarTexto($conexao['instanceName'], $telefone, (string)$mensagem);
        }
        $result['provider'] = $provider;
        return $result;
    }

    private function normalizarProvider(?string $provider): string {
        $provider = strtolower(trim((string)$provider));
        return in_array($provider, ['evolution', 'oficial', 'uazapi'], true) ? $provider : 'evolution';
    }

    private function buscarConexaoWebhook($idConexao, $instanceName): ?array {
        $pdo = Database::pdo();
        if ($idConexao) {
            $stmt = $pdo->prepare("SELECT * FROM conexoes WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => (int)$idConexao]);
            $result = $stmt->fetch();
            if ($result) return $result;
        }

        if ($instanceName) {
            $stmt = $pdo->prepare("SELECT * FROM conexoes WHERE instanceName = :instanceName LIMIT 1");
            $stmt->execute(['instanceName' => (string)$instanceName]);
            $result = $stmt->fetch();
            if ($result) return $result;
        }

        return null;
    }

    private function extrairMensagemWebhook(array $payload): ?array {
        $data = $payload['data'] ?? $payload['message'] ?? $payload['messages'][0] ?? $payload;
        if (isset($data['messages']) && is_array($data['messages']) && isset($data['messages'][0])) {
            $data = $data['messages'][0];
        }

        $messageNode = $data['message'] ?? $data['msg'] ?? [];
        $key = $data['key'] ?? $messageNode['key'] ?? [];

        $remoteJid = $this->primeiroValor([
            $key['remoteJid'] ?? null,
            $data['remoteJid'] ?? null,
            $data['chatId'] ?? null,
            $data['chatid'] ?? null,
            $data['from'] ?? null,
            $data['sender'] ?? null,
            $payload['from'] ?? null,
            $payload['phone'] ?? null
        ]);

        $telefone = $this->normalizarTelefone((string)$remoteJid);
        if (!$telefone) return null;

        $texto = $this->primeiroValor([
            $messageNode['conversation'] ?? null,
            $messageNode['extendedTextMessage']['text'] ?? null,
            $messageNode['imageMessage']['caption'] ?? null,
            $messageNode['videoMessage']['caption'] ?? null,
            $messageNode['documentMessage']['caption'] ?? null,
            $data['text'] ?? null,
            $data['body'] ?? null,
            $data['caption'] ?? null,
            $payload['text'] ?? null,
            $payload['body'] ?? null
        ]);

        $arquivoUrl = $this->primeiroValor([
            $data['mediaUrl'] ?? null,
            $data['media'] ?? null,
            $data['file'] ?? null,
            $data['url'] ?? null,
            $messageNode['imageMessage']['url'] ?? null,
            $messageNode['videoMessage']['url'] ?? null,
            $messageNode['audioMessage']['url'] ?? null,
            $messageNode['documentMessage']['url'] ?? null,
            $payload['mediaUrl'] ?? null,
            $payload['file'] ?? null
        ]);

        $tipoRaw = strtolower((string)$this->primeiroValor([
            $data['messageType'] ?? null,
            $data['type'] ?? null,
            $payload['type'] ?? null,
            $messageNode ? implode(' ', array_keys($messageNode)) : null
        ]));

        $tipoMensagem = 'conversation';
        if (str_contains($tipoRaw, 'image')) $tipoMensagem = 'imagemessage';
        if (str_contains($tipoRaw, 'video')) $tipoMensagem = 'videomessage';
        if (str_contains($tipoRaw, 'audio') || str_contains($tipoRaw, 'ptt')) $tipoMensagem = 'audiomessage';
        if (str_contains($tipoRaw, 'document') || str_contains($tipoRaw, 'file')) $tipoMensagem = 'documentmessage';
        if ($arquivoUrl && $tipoMensagem === 'conversation') $tipoMensagem = 'documentmessage';

        return [
            'telefone' => $telefone,
            'nome' => $this->primeiroValor([$data['pushName'] ?? null, $data['senderName'] ?? null, $payload['pushName'] ?? null]),
            'texto' => $texto,
            'tipoMensagem' => $tipoMensagem,
            'arquivoUrl' => $arquivoUrl,
            'messageId' => $this->primeiroValor([$key['id'] ?? null, $data['id'] ?? null, $data['messageId'] ?? null]),
            'fromMe' => filter_var($this->primeiroValor([$key['fromMe'] ?? null, $data['fromMe'] ?? null, $payload['fromMe'] ?? null]), FILTER_VALIDATE_BOOLEAN),
            'fotoPerfil' => $this->primeiroValor([$data['profilePicUrl'] ?? null, $payload['profilePicUrl'] ?? null])
        ];
    }

    private function primeiroValor(array $valores) {
        foreach ($valores as $valor) {
            if (is_string($valor) && trim($valor) !== '') return trim($valor);
            if (is_numeric($valor) || is_bool($valor)) return $valor;
        }
        return null;
    }

    private function normalizarTelefone(string $telefone): string {
        $telefone = preg_replace('/@.*/', '', $telefone);
        $telefone = preg_replace('/\D+/', '', (string)$telefone);
        if (strlen($telefone) === 11 && substr($telefone, 0, 2) !== '55') {
            $telefone = '55' . $telefone;
        }
        return $telefone;
    }

    private function extrairIdMensagem(array $result, string $targetProvider): ?string {
        if (($result['provider'] ?? null) !== $targetProvider) {
            return null;
        }
        $data = $result['data'] ?? [];
        $id = $data['key']['id'] ?? $data['messageId'] ?? $data['id'] ?? $data['messages'][0]['id'] ?? null;
        return is_scalar($id) ? (string)$id : null;
    }

    public function pausarConversa(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $contaId = Auth::obterContaId();

            if (!isset($data['conversaId'])) {
                echo json_encode(['success' => false, 'error' => 'ID da conversa nao informado']);
                return;
            }

            $pausaMinutos = $data['pausaMinutos'] ?? 60;
            $this->conversaModel->atualizar((int)$data['conversaId'], $contaId, [
                'pausado' => 1,
                'pausaAte' => date('Y-m-d H:i:s', strtotime("+$pausaMinutos minutes"))
            ]);

            echo json_encode(['success' => true, 'data' => ['message' => 'Conversa pausada']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao pausar conversa']);
        }
    }
}
