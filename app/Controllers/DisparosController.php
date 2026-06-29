<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/DisparoModel.php';
require_once __DIR__ . '/../Models/ContatoModel.php';
require_once __DIR__ . '/../Models/ConexaoModel.php';

class DisparosController {
    private DisparoModel $disparoModel;
    private ContatoModel $contatoModel;
    private ConexaoModel $conexaoModel;

    public function __construct() {
        $this->disparoModel = new DisparoModel();
        $this->contatoModel = new ContatoModel();
        $this->conexaoModel = new ConexaoModel();
    }

    public function index(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/disparos_clean.php';
    }

    public function criar(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/01_criar_nova_campanha_ia_chatconversa.php';
    }

    public function grupos(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/04_disparos_em_grupos_ia_chatconversa.php';
    }

    public function detalhes(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/08_detalhes_do_disparo_ia_chatconversa.php';
    }

    public function listar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            $disparos = $this->disparoModel->listarPorConta($contaId);
            
            echo json_encode(['success' => true, 'data' => $disparos]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar disparos']);
        }
    }

    public function criarDisparo(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['mensagens']) || !isset($data['idConexoes'])) {
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }

            $totalContatos = 0;
            if (isset($data['idListas']) && is_array($data['idListas'])) {
                foreach ($data['idListas'] as $listaId) {
                    $totalContatos += count($this->contatoModel->listarPorConta($contaId));
                }
            }

            $id = $this->disparoModel->criar([
                'contaId' => $contaId,
                'nomeDisparo' => $data['nomeDisparo'] ?? 'Disparo ' . date('d/m/Y H:i'),
                'mensagens' => $data['mensagens'],
                'tipoDisparo' => $data['tipoDisparo'] ?? 'imediato',
                'totalDisparos' => $totalContatos,
                'statusDisparo' => 'pendente',
                'idListas' => $data['idListas'] ?? [],
                'idConexoes' => $data['idConexoes'],
                'idEtiquetas' => $data['idEtiquetas'] ?? [],
                'intervaloMin' => $data['intervaloMin'] ?? 5,
                'intervaloMax' => $data['intervaloMax'] ?? 10,
                'pausaAposMensagens' => $data['pausaAposMensagens'] ?? 20,
                'pausaMinutos' => $data['pausaMinutos'] ?? 5,
                'startTime' => $data['startTime'] ?? null,
                'endTime' => $data['endTime'] ?? null,
                'diasSelecionados' => $data['diasSelecionados'] ?? [],
                'dataAgendamento' => $data['dataAgendamento'] ?? null
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $id,
                    'message' => 'Disparo criado com sucesso',
                    'totalContatos' => $totalContatos
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar disparo']);
        }
    }

    public function iniciar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $disparo = $this->disparoModel->buscarPorId($data['id'], $contaId);
            if (!$disparo) {
                echo json_encode(['success' => false, 'error' => 'Disparo não encontrado']);
                return;
            }

            $this->disparoModel->atualizarStatus($data['id'], $contaId, 'processando');

            echo json_encode([
                'success' => true,
                'data' => [
                    'message' => 'Disparo iniciado - implementar worker de processamento'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao iniciar disparo']);
        }
    }

    public function pausar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $this->disparoModel->atualizarStatus($data['id'], $contaId, 'pausado');

            echo json_encode(['success' => true, 'data' => ['message' => 'Disparo pausado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao pausar disparo']);
        }
    }

    public function cancelar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $this->disparoModel->atualizarStatus($data['id'], $contaId, 'cancelado');

            echo json_encode(['success' => true, 'data' => ['message' => 'Disparo cancelado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao cancelar disparo']);
        }
    }

    public function detalhesDisparo(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            
            if (!isset($_GET['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $disparoId = (int)$_GET['id'];
            $disparo = $this->disparoModel->buscarPorId($disparoId, $contaId);
            
            if (!$disparo) {
                echo json_encode(['success' => false, 'error' => 'Disparo não encontrado']);
                return;
            }

            $detalhes = $this->disparoModel->listarDetalhes($disparoId, $contaId);

            echo json_encode([
                'success' => true,
                'data' => [
                    'disparo' => $disparo,
                    'detalhes' => $detalhes
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao buscar detalhes']);
        }
    }
}
