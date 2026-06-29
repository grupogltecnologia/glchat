<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/QuadroModel.php';
require_once __DIR__ . '/../Models/ContatoModel.php';

class CRMController {
    private QuadroModel $quadroModel;
    private ContatoModel $contatoModel;

    public function __construct() {
        $this->quadroModel = new QuadroModel();
        $this->contatoModel = new ContatoModel();
    }

    public function index(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/crm_clean.php';
    }

    public function etapas(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/14_etapas_do_quadro_ia_chatconversa.php';
    }

    public function listarQuadros(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            $quadros = $this->quadroModel->listarPorConta($contaId);
            
            echo json_encode(['success' => true, 'data' => $quadros]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar quadros']);
        }
    }

    public function criarQuadro(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['nome'])) {
                echo json_encode(['success' => false, 'error' => 'Nome é obrigatório']);
                return;
            }

            $id = $this->quadroModel->criar([
                'contaId' => $contaId,
                'nome' => $data['nome'],
                'descricao' => $data['descricao'] ?? null,
                'cor' => $data['cor'] ?? '#3b82f6',
                'icone' => $data['icone'] ?? null
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $id,
                    'message' => 'Quadro criado com sucesso'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar quadro']);
        }
    }

    public function atualizarQuadro(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $quadro = $this->quadroModel->buscarPorId($data['id'], $contaId);
            if (!$quadro) {
                echo json_encode(['success' => false, 'error' => 'Quadro não encontrado']);
                return;
            }

            $dadosAtualizacao = [];
            if (isset($data['nome'])) $dadosAtualizacao['nome'] = $data['nome'];
            if (isset($data['descricao'])) $dadosAtualizacao['descricao'] = $data['descricao'];
            if (isset($data['cor'])) $dadosAtualizacao['cor'] = $data['cor'];
            if (isset($data['icone'])) $dadosAtualizacao['icone'] = $data['icone'];

            $this->quadroModel->atualizar($data['id'], $contaId, $dadosAtualizacao);

            echo json_encode(['success' => true, 'data' => ['message' => 'Quadro atualizado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar quadro']);
        }
    }

    public function deletarQuadro(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $this->quadroModel->deletar($data['id'], $contaId);
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Quadro deletado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao deletar quadro']);
        }
    }

    public function listarEtapas(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            
            if (!isset($_GET['quadroId'])) {
                echo json_encode(['success' => false, 'error' => 'ID do quadro não informado']);
                return;
            }

            $quadroId = (int)$_GET['quadroId'];
            $etapas = $this->quadroModel->listarEtapas($quadroId, $contaId);
            
            echo json_encode(['success' => true, 'data' => $etapas]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar etapas']);
        }
    }

    public function criarEtapa(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['quadroId']) || !isset($data['nome'])) {
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }

            $id = $this->quadroModel->criarEtapa($data['quadroId'], $contaId, [
                'nome' => $data['nome'],
                'ordem' => $data['ordem'] ?? 0
            ]);

            if (!$id) {
                echo json_encode(['success' => false, 'error' => 'Quadro não encontrado']);
                return;
            }

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $id,
                    'message' => 'Etapa criada com sucesso'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar etapa']);
        }
    }
}
