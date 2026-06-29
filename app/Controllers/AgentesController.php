<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/AgenteModel.php';
require_once __DIR__ . '/../Models/ConexaoModel.php';

class AgentesController {
    private AgenteModel $agenteModel;
    private ConexaoModel $conexaoModel;

    public function __construct() {
        $this->agenteModel = new AgenteModel();
        $this->conexaoModel = new ConexaoModel();
    }

    public function index(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/agentes_clean.php';
    }

    public function listar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            $agentes = $this->agenteModel->listarPorConta($contaId);
            
            echo json_encode(['success' => true, 'data' => $agentes]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar agentes']);
        }
    }

    public function criar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['nome']) || !isset($data['instrucoes'])) {
                echo json_encode(['success' => false, 'error' => 'Nome e instruções são obrigatórios']);
                return;
            }

            $id = $this->agenteModel->criar([
                'contaId' => $contaId,
                'nome' => $data['nome'],
                'conexaoId' => $data['conexaoId'] ?? null,
                'instrucoes' => $data['instrucoes'],
                'modelo' => $data['modelo'] ?? 'gpt-4',
                'criatividade' => $data['criatividade'] ?? 0.7,
                'maxCreditos' => $data['maxCreditos'] ?? null,
                'ativo' => $data['ativo'] ?? 1,
                'conhecimento' => $data['conhecimento'] ?? [],
                'cor' => $data['cor'] ?? '#3b82f6',
                'separarMensagens' => $data['separarMensagens'] ?? 0,
                'ouvirAudio' => $data['ouvirAudio'] ?? 0,
                'analisarImagens' => $data['analisarImagens'] ?? 0,
                'aparecerDigitando' => $data['aparecerDigitando'] ?? 1,
                'pausarAtendimento' => $data['pausarAtendimento'] ?? 0,
                'qntMsgHistorico' => $data['qntMsgHistorico'] ?? 10,
                'agruparMensagens' => $data['agruparMensagens'] ?? 1,
                'intervaloEntreMensagens' => $data['intervaloEntreMensagens'] ?? 2000,
                'CRM' => $data['CRM'] ?? [],
                'abrirAtendimento' => $data['abrirAtendimento'] ?? [],
                'notificarHumano' => $data['notificarHumano'] ?? [],
                'requisicaoHTTP' => $data['requisicaoHTTP'] ?? []
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $id,
                    'message' => 'Agente criado com sucesso'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar agente']);
        }
    }

    public function atualizar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $agente = $this->agenteModel->buscarPorId($data['id'], $contaId);
            if (!$agente) {
                echo json_encode(['success' => false, 'error' => 'Agente não encontrado']);
                return;
            }

            $dadosAtualizacao = [];
            $camposPermitidos = [
                'nome', 'conexaoId', 'instrucoes', 'modelo', 'criatividade', 'maxCreditos', 'ativo',
                'conhecimento', 'cor', 'separarMensagens', 'ouvirAudio', 'analisarImagens', 
                'aparecerDigitando', 'pausarAtendimento', 'qntMsgHistorico', 'agruparMensagens',
                'intervaloEntreMensagens', 'CRM', 'abrirAtendimento', 'notificarHumano', 'requisicaoHTTP'
            ];

            foreach ($camposPermitidos as $campo) {
                if (isset($data[$campo])) {
                    $dadosAtualizacao[$campo] = $data[$campo];
                }
            }

            $this->agenteModel->atualizar($data['id'], $contaId, $dadosAtualizacao);

            echo json_encode(['success' => true, 'data' => ['message' => 'Agente atualizado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar agente']);
        }
    }

    public function deletar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $this->agenteModel->deletar($data['id'], $contaId);
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Agente deletado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao deletar agente']);
        }
    }

    public function testar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['id']) || !isset($data['mensagem'])) {
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }

            $agente = $this->agenteModel->buscarPorId($data['id'], $contaId);
            if (!$agente) {
                echo json_encode(['success' => false, 'error' => 'Agente não encontrado']);
                return;
            }

            echo json_encode([
                'success' => true,
                'data' => [
                    'resposta' => 'Resposta do agente - implementar integração OpenAI',
                    'tokens' => 0
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao testar agente']);
        }
    }
}
