<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/ContatoModel.php';

class ContatosController {
    private ContatoModel $contatoModel;

    public function __construct() {
        $this->contatoModel = new ContatoModel();
    }

    public function index(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/contatos_clean.php';
    }

    public function listar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 50;
            $offset = ($page - 1) * $limit;
            
            $contatos = $this->contatoModel->listarPorConta($contaId, $limit, $offset);
            $total = $this->contatoModel->contarPorConta($contaId);
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'contatos' => $contatos,
                    'pagination' => [
                        'page' => $page,
                        'limit' => $limit,
                        'total' => $total,
                        'pages' => ceil($total / $limit)
                    ]
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar contatos']);
        }
    }

    public function criar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['nome']) || !isset($data['telefone'])) {
                echo json_encode(['success' => false, 'error' => 'Nome e telefone são obrigatórios']);
                return;
            }

            $contatoExistente = $this->contatoModel->buscarPorTelefone($data['telefone'], $contaId);
            if ($contatoExistente) {
                echo json_encode(['success' => false, 'error' => 'Contato já existe com este telefone']);
                return;
            }

            $id = $this->contatoModel->criar([
                'contaId' => $contaId,
                'nome' => $data['nome'],
                'telefone' => $data['telefone'],
                'email' => $data['email'] ?? null,
                'variaveis' => $data['variaveis'] ?? [],
                'idLista' => $data['idLista'] ?? null
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $id,
                    'message' => 'Contato criado com sucesso'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar contato']);
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

            $contato = $this->contatoModel->buscarPorId($data['id'], $contaId);
            if (!$contato) {
                echo json_encode(['success' => false, 'error' => 'Contato não encontrado']);
                return;
            }

            $dadosAtualizacao = [];
            if (isset($data['nome'])) $dadosAtualizacao['nome'] = $data['nome'];
            if (isset($data['telefone'])) $dadosAtualizacao['telefone'] = $data['telefone'];
            if (isset($data['email'])) $dadosAtualizacao['email'] = $data['email'];
            if (isset($data['variaveis'])) $dadosAtualizacao['variaveis'] = $data['variaveis'];
            if (isset($data['idLista'])) $dadosAtualizacao['idLista'] = $data['idLista'];

            $this->contatoModel->atualizar($data['id'], $contaId, $dadosAtualizacao);

            echo json_encode(['success' => true, 'data' => ['message' => 'Contato atualizado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar contato']);
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

            $this->contatoModel->deletar($data['id'], $contaId);
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Contato deletado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao deletar contato']);
        }
    }

    public function importar(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['contatos']) || !is_array($data['contatos'])) {
                echo json_encode(['success' => false, 'error' => 'Lista de contatos inválida']);
                return;
            }

            $importados = 0;
            $erros = 0;

            foreach ($data['contatos'] as $contato) {
                try {
                    if (!isset($contato['nome']) || !isset($contato['telefone'])) {
                        $erros++;
                        continue;
                    }

                    $existe = $this->contatoModel->buscarPorTelefone($contato['telefone'], $contaId);
                    if ($existe) {
                        $erros++;
                        continue;
                    }

                    $this->contatoModel->criar([
                        'contaId' => $contaId,
                        'nome' => $contato['nome'],
                        'telefone' => $contato['telefone'],
                        'email' => $contato['email'] ?? null,
                        'variaveis' => $contato['variaveis'] ?? []
                    ]);
                    
                    $importados++;
                } catch (Exception $e) {
                    $erros++;
                }
            }

            echo json_encode([
                'success' => true,
                'data' => [
                    'importados' => $importados,
                    'erros' => $erros,
                    'message' => "$importados contatos importados com sucesso"
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao importar contatos']);
        }
    }
}
