<?php
require_once __DIR__ . '/../Core/App.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/UsuarioModel.php';
require_once __DIR__ . '/../Models/ContaModel.php';
require_once __DIR__ . '/../Models/ModeloModel.php';

class AdminController {
    private UsuarioModel $usuarioModel;
    private ContaModel $contaModel;
    private PDO $pdo;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
        $this->contaModel = new ContaModel();
        $this->pdo = Database::pdo();
    }

    public function index(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        include __DIR__ . '/../Views/pages/admin.php';
    }

    public function configuracoes(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/configuracoes_clean.php';
    }

    public function ajuda(): void {
        Auth::requerAutenticacao();
        include __DIR__ . '/../Views/pages/21_ajuda_ia_chatconversa.php';
    }

    public function listarUsuarios(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            $usuarios = $this->usuarioModel->listarPorConta($contaId);
            
            foreach ($usuarios as &$usuario) {
                unset($usuario['senha_hash']);
            }
            
            echo json_encode(['success' => true, 'data' => $usuarios]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar usuários']);
        }
    }

    public function criarUsuario(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            if (!isset($data['nome']) || !isset($data['email']) || !isset($data['senha'])) {
                echo json_encode(['success' => false, 'error' => 'Nome e email são obrigatórios']);
                return;
            }

            if ($this->usuarioModel->buscarPorEmail($data['email'])) {
                echo json_encode(['success' => false, 'error' => 'Email já cadastrado']);
                return;
            }

            $senhaTemporaria = bin2hex(random_bytes(8));

            $id = $this->usuarioModel->criar([
                'contaId' => $contaId,
                'nome' => $data['nome'],
                'email' => $data['email'],
                'senha' => $senhaTemporaria,
                'telefone' => $data['telefone'] ?? null,
                'funcao' => $data['funcao'] ?? 'atendente',
                'super_admin' => 0
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $id,
                    'senhaTemporaria' => $senhaTemporaria,
                    'message' => 'Usuário criado com sucesso'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar usuário']);
        }
    }

    public function atualizarUsuario(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }

            $dadosAtualizacao = [];
            if (isset($data['nome'])) $dadosAtualizacao['nome'] = $data['nome'];
            if (isset($data['Email'])) $dadosAtualizacao['Email'] = $data['Email'];
            if (isset($data['telefone'])) $dadosAtualizacao['telefone'] = $data['telefone'];
            if (isset($data['funcao'])) $dadosAtualizacao['funcao'] = $data['funcao'];

            $this->usuarioModel->atualizar($data['id'], $dadosAtualizacao);

            echo json_encode(['success' => true, 'data' => ['message' => 'Usuário atualizado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar usuário']);
        }
    }

    public function alterarSenha(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $usuarioId = Auth::obterUsuarioId();
            
            if (!isset($data['senhaAtual']) || !isset($data['novaSenha'])) {
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }

            $usuario = $this->usuarioModel->buscarPorId($usuarioId);
            if (!$usuario || !password_verify($data['senhaAtual'], $usuario['senha_hash'])) {
                echo json_encode(['success' => false, 'error' => 'Senha atual incorreta']);
                return;
            }

            $this->usuarioModel->atualizarSenha($usuarioId, $data['novaSenha']);

            echo json_encode(['success' => true, 'data' => ['message' => 'Senha alterada com sucesso']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao alterar senha']);
        }
    }

    public function atualizarConta(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $contaId = Auth::obterContaId();
            
            $dadosAtualizacao = [];
            if (isset($data['apikey_gpt'])) $dadosAtualizacao['apikey_gpt'] = $data['apikey_gpt'];

            $this->contaModel->atualizar($contaId, $dadosAtualizacao);

            echo json_encode(['success' => true, 'data' => ['message' => 'Configurações atualizadas']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar configurações']);
        }
    }

    // ==================== PAINEL DE ADMINISTRAÇÃO ====================

    /**
     * Dashboard do Admin - Métricas gerais do SaaS
     */
    public function dashboardAdmin(): void {
        error_log("AdminController::dashboardAdmin() chamado");
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            // Total de clientes
            $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM contas");
            $totalClientes = $stmt->fetch()['total'];
            
            // Clientes ativos
            $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM contas WHERE status = 'ativo'");
            $clientesAtivos = $stmt->fetch()['total'];
            
            // Faturamento do mês
            $stmt = $this->pdo->query("
                SELECT SUM(valor) as total 
                FROM transacoes 
                WHERE status = 'pago' 
                AND MONTH(data_pagamento) = MONTH(CURRENT_DATE())
                AND YEAR(data_pagamento) = YEAR(CURRENT_DATE())
            ");
            $faturamentoMes = $stmt->fetch()['total'] ?? 0;
            
            // Ticket médio
            $stmt = $this->pdo->query("
                SELECT AVG(valor) as media 
                FROM transacoes 
                WHERE status = 'pago'
            ");
            $ticketMedio = $stmt->fetch()['media'] ?? 0;
            
            // Faturamento por mês (últimos 6 meses)
            $stmt = $this->pdo->query("
                SELECT 
                    DATE_FORMAT(data_pagamento, '%Y-%m') as mes,
                    SUM(valor) as total
                FROM transacoes
                WHERE status = 'pago'
                AND data_pagamento >= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)
                GROUP BY mes
                ORDER BY mes ASC
            ");
            $faturamentoPorMes = $stmt->fetchAll();
            
            // Aquisição de clientes (últimos 6 meses)
            $stmt = $this->pdo->query("
                SELECT 
                    DATE_FORMAT(created_at, '%Y-%m') as mes,
                    COUNT(*) as total
                FROM contas
                WHERE created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)
                GROUP BY mes
                ORDER BY mes ASC
            ");
            $aquisicaoClientes = $stmt->fetchAll();
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'totalClientes' => $totalClientes,
                    'clientesAtivos' => $clientesAtivos,
                    'faturamentoMes' => number_format($faturamentoMes, 2, '.', ''),
                    'ticketMedio' => number_format($ticketMedio, 2, '.', ''),
                    'faturamentoPorMes' => $faturamentoPorMes,
                    'aquisicaoClientes' => $aquisicaoClientes
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao carregar dashboard']);
        }
    }

    /**
     * Listar todos os clientes (contas)
     */
    public function listarClientes(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $stmt = $this->pdo->query("
                SELECT 
                    c.id,
                    c.nome,
                    c.email,
                    c.telefone,
                    c.plano,
                    c.status,
                    c.dataValidade,
                    c.dataValidade as data_fim,
                    c.created_at,
                    u.Email as usuario_email,
                    p.id as plano_id,
                    p.nome as plano_nome,
                    p.preco as plano_preco
                FROM contas c
                LEFT JOIN usuarios u ON u.contaId = c.id AND u.funcao = 'admin'
                LEFT JOIN planos p ON p.id = c.plano
                ORDER BY c.created_at DESC
            ");
            $clientes = $stmt->fetchAll();
            
            // Ajustar dados para o frontend
            foreach ($clientes as &$cliente) {
                if (!$cliente['email']) {
                    $cliente['email'] = $cliente['usuario_email'];
                }
                $cliente['Email'] = $cliente['email'];
                $cliente['status'] = (bool)$cliente['status'];
                $cliente['plano_id'] = $cliente['plano_id'] ?? $cliente['plano'];
                unset($cliente['usuario_email']);
            }
            
            echo json_encode(['success' => true, 'data' => $clientes]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar clientes']);
        }
    }

    /**
     * Criar novo cliente (conta)
     */
    public function criarCliente(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['nome']) || !isset($data['email'])) {
                echo json_encode(['success' => false, 'error' => 'Nome e email são obrigatórios']);
                return;
            }
            
            // Verificar se email já existe
            $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE Email = ?");
            $stmt->execute([$data['email']]);
            if ($stmt->fetch()) {
                echo json_encode(['success' => false, 'error' => 'Email já cadastrado']);
                return;
            }
            
            // Log para debug
            error_log("Criando cliente - Dados recebidos: " . json_encode($data));
            $data['plano'] = $data['plano'] ?? $data['idPlano'] ?? 1;
            $data['data_fim'] = $data['data_fim'] ?? $data['dataValidade'] ?? $data['dataVencimento'] ?? null;
            if ($data['data_fim'] === '') {
                $data['data_fim'] = null;
            }
            if (($data['status'] ?? null) === true || ($data['status'] ?? null) === 'true' || ($data['status'] ?? null) === 1 || ($data['status'] ?? null) === '1') {
                $data['status'] = 'ativo';
            }
            
            // Criar conta (ID será auto-incrementado)
            $stmt = $this->pdo->prepare("
                INSERT INTO contas (nome, email, telefone, plano, status, dataValidade)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $data['nome'],
                $data['email'] ?? null,
                $data['telefone'] ?? null,
                $data['plano'] ?? 1, // ID do plano Free por padrão
                ($data['status'] ?? 'ativo') === 'ativo' ? 1 : 0,
                $data['data_fim'] ?? $data['dataValidade'] ?? null
            ]);
            
            // Pegar o ID gerado
            $contaId = $this->pdo->lastInsertId();
            
            // Criar usuário admin da conta com a senha fornecida
            $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT);
            
            $stmt = $this->pdo->prepare("
                INSERT INTO usuarios (contaId, nome, Email, Senha, funcao)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $contaId,
                $data['nome'],
                $data['email'],
                $senhaHash,
                'admin'
            ]);
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'contaId' => $contaId,
                    'message' => 'Cliente criado com sucesso'
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar cliente: ' . $e->getMessage()]);
        }
    }

    /**
     * Atualizar cliente
     */
    public function atualizarCliente(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            // Log para debug
            error_log("Dados recebidos para atualizar: " . json_encode($data));
            if (isset($data['dataVencimento']) && !isset($data['data_fim']) && !isset($data['dataValidade'])) {
                $data['data_fim'] = $data['dataVencimento'];
            }
            if (($data['data_fim'] ?? null) === '') {
                $data['data_fim'] = null;
            }
            if (($data['dataValidade'] ?? null) === '') {
                $data['dataValidade'] = null;
            }
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID não informado']);
                return;
            }
            
            $updates = [];
            $params = [];
            
            if (isset($data['nome'])) {
                $updates[] = 'nome = ?';
                $params[] = $data['nome'];
            }
            if (isset($data['telefone'])) {
                $updates[] = 'telefone = ?';
                $params[] = $data['telefone'];
            }
            if (isset($data['status'])) {
                $updates[] = 'status = ?';
                // Aceitar tanto 1/0 quanto ativo/bloqueado
                if ($data['status'] === 'ativo' || $data['status'] == 1 || $data['status'] === '1') {
                    $params[] = 1;
                } else {
                    $params[] = 0;
                }
            }
            if (isset($data['plano'])) {
                $updates[] = 'plano = ?';
                $params[] = $data['plano'];
            }
            if (isset($data['data_fim']) || isset($data['dataValidade'])) {
                $updates[] = 'dataValidade = ?';
                $params[] = $data['data_fim'] ?? $data['dataValidade'];
            }
            
            if (empty($updates)) {
                echo json_encode(['success' => false, 'error' => 'Nenhum dado para atualizar']);
                return;
            }
            
            $params[] = $data['id'];
            $sql = "UPDATE contas SET " . implode(', ', $updates) . " WHERE id = ?";
            
            // Log para debug
            error_log("SQL: $sql");
            error_log("Params: " . json_encode($params));
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            if (isset($data['nome']) || isset($data['telefone'])) {
                $usuarioUpdates = [];
                $usuarioParams = [];

                if (isset($data['nome'])) {
                    $usuarioUpdates[] = 'nome = ?';
                    $usuarioParams[] = $data['nome'];
                }
                if (isset($data['telefone'])) {
                    $usuarioUpdates[] = 'telefone = ?';
                    $usuarioParams[] = $data['telefone'];
                }

                if (!empty($usuarioUpdates)) {
                    $usuarioParams[] = $data['id'];
                    $stmtUsuario = $this->pdo->prepare(
                        "UPDATE usuarios SET " . implode(', ', $usuarioUpdates) . " WHERE contaId = ? AND funcao = 'admin'"
                    );
                    $stmtUsuario->execute($usuarioParams);
                }
            }
            
            error_log("Linhas afetadas: " . $stmt->rowCount());
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Cliente atualizado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar cliente']);
        }
    }

    /**
     * Excluir cliente
     */
    public function excluirCliente(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID do cliente é obrigatório']);
                return;
            }
            
            $clienteId = $data['id'];
            
            // Iniciar transação
            $this->pdo->beginTransaction();
            try {
                $tabelasContaId = [
                    'mensagens',
                    'conversas',
                    'contatos_etiquetas',
                    'valores_campos_personalizados',
                    'contatos',
                    'etiquetas',
                    'campos_personalizados',
                    'agentes_ia',
                    'conexoes',
                    'disparos',
                    'respostas_rapidas',
                    'webhook',
                    'etapas_quadros',
                    'crm_quadros',
                    'assinaturas',
                    'transacoes',
                    'logs_atividades',
                ];

                foreach ($tabelasContaId as $tabela) {
                    $stmt = $this->pdo->prepare("DELETE FROM `$tabela` WHERE contaId = ?");
                    $stmt->execute([$clienteId]);
                }

                $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE contaId = ?");
                $stmt->execute([$clienteId]);

                $stmt = $this->pdo->prepare("DELETE FROM contas WHERE id = ?");
                $stmt->execute([$clienteId]);

                $this->pdo->commit();
                echo json_encode(['success' => true, 'data' => ['message' => 'Cliente excluido com sucesso']]);
                return;
            } catch (Exception $e) {
                $this->pdo->rollBack();
                throw $e;
            }
            
            try {
                error_log("🗑️ Iniciando exclusão completa do cliente ID: {$clienteId}");
                
                // 1. Excluir conversas e mensagens
                $stmt = $this->pdo->prepare("DELETE FROM SAAS_Mensagens WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Mensagens excluídas");
                
                $stmt = $this->pdo->prepare("DELETE FROM SAAS_Conversas WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Conversas excluídas");
                
                // 2. Excluir contatos e relacionamentos
                $stmt = $this->pdo->prepare("DELETE FROM valores_campos_personalizados WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                
                $stmt = $this->pdo->prepare("DELETE FROM contatos_etiquetas WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                
                $stmt = $this->pdo->prepare("DELETE FROM SAAS_Contatos WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Contatos excluídos");
                
                // 3. Excluir etiquetas
                $stmt = $this->pdo->prepare("DELETE FROM etiquetas WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Etiquetas excluídas");
                
                // 4. Excluir campos personalizados
                $stmt = $this->pdo->prepare("DELETE FROM campos_personalizados WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Campos personalizados excluídos");
                
                // 5. Excluir agentes de IA e conhecimentos
                $stmt = $this->pdo->prepare("DELETE FROM SAAS_Conhecimentos WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                
                $stmt = $this->pdo->prepare("DELETE FROM SAAS_Agentes WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Agentes IA excluídos");
                
                // 6. Excluir conexões WhatsApp
                $stmt = $this->pdo->prepare("DELETE FROM SAAS_Conexoes WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Conexões excluídas");
                
                // 7. Excluir disparos
                $stmt = $this->pdo->prepare("DELETE FROM SAAS_Disparos WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Disparos excluídos");
                
                // 8. Excluir respostas rápidas
                $stmt = $this->pdo->prepare("DELETE FROM respostas_rapidas WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                
                // 9. Excluir webhooks
                $stmt = $this->pdo->prepare("DELETE FROM webhook WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                
                // 10. Excluir CRM (etapas, quadros, cards)
                $stmt = $this->pdo->prepare("DELETE FROM etapas_quadros WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ CRM excluído");
                
                // 11. Excluir usuários do cliente
                $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE contaId = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Usuários excluídos");
                
                // 12. Excluir a conta (por último)
                $stmt = $this->pdo->prepare("DELETE FROM contas WHERE id = ?");
                $stmt->execute([$clienteId]);
                error_log("✅ Conta excluída");
                
                // Commit da transação
                $this->pdo->commit();
                error_log("🎉 Cliente {$clienteId} excluído completamente com sucesso!");
                
                echo json_encode(['success' => true, 'data' => ['message' => 'Cliente e todos os dados relacionados foram excluídos com sucesso']]);
            } catch (Exception $e) {
                // Rollback em caso de erro
                $this->pdo->rollBack();
                error_log("❌ Erro ao excluir cliente: " . $e->getMessage());
                throw $e;
            }
        } catch (Exception $e) {
            error_log("Erro ao excluir cliente: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao excluir cliente: ' . $e->getMessage()]);
        }
    }

    public function resetarCreditosCliente(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if (empty($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID do cliente e obrigatorio']);
                return;
            }

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("UPDATE contas SET tokens = 0 WHERE id = ?");
            $stmt->execute([$data['id']]);

            $this->pdo->commit();
            echo json_encode(['success' => true, 'data' => ['message' => 'Creditos resetados com sucesso']]);
        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            echo json_encode(['success' => false, 'error' => 'Erro ao resetar creditos']);
        }
    }

    public function listarUsuariosCliente(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $contaId = $_GET['contaId'] ?? null;
            if (!$contaId) {
                echo json_encode(['success' => false, 'error' => 'ID da conta e obrigatorio']);
                return;
            }

            $stmt = $this->pdo->prepare("
                SELECT id, nome, Email, funcao, telefone, created_at
                FROM usuarios
                WHERE contaId = ?
                ORDER BY created_at ASC, id ASC
            ");
            $stmt->execute([$contaId]);

            echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar usuarios da conta']);
        }
    }

    public function excluirUsuarioCliente(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $usuarioId = $data['usuarioId'] ?? null;
            $contaId = $data['contaId'] ?? null;

            if (!$usuarioId || !$contaId) {
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }

            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE contaId = ?");
            $stmt->execute([$contaId]);
            if ((int)$stmt->fetchColumn() <= 1) {
                echo json_encode(['success' => false, 'error' => 'Nao e possivel remover o unico usuario da conta']);
                return;
            }

            $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ? AND contaId = ?");
            $stmt->execute([$usuarioId, $contaId]);

            echo json_encode(['success' => true, 'data' => ['message' => 'Usuario desvinculado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao desvincular usuario']);
        }
    }

    /**
     * Listar planos
     */
    public function listarPlanos(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $stmt = $this->pdo->query("
                SELECT * FROM planos ORDER BY preco ASC
            ");
            $planos = $stmt->fetchAll();

            foreach ($planos as &$plano) {
                $plano['qntConexoes'] = $plano['qntConexoes'] ?? $plano['limite_conexoes'] ?? 0;
                $plano['qntContatos'] = $plano['qntContatos'] ?? $plano['limite_contatos'] ?? 0;
                $plano['qntDisparos'] = $plano['qntDisparos'] ?? $plano['limite_disparos'] ?? 0;
                $plano['qntUsuarios'] = $plano['qntUsuarios'] ?? $plano['limite_usuarios'] ?? 0;
                $plano['qntQuadros'] = $plano['qntQuadros'] ?? 0;
                $plano['qntAgentesIa'] = $plano['qntAgentesIa'] ?? 0;
                $plano['qntCreditosIa'] = $plano['qntCreditosIa'] ?? 0;
            }
            
            echo json_encode(['success' => true, 'data' => $planos]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar planos']);
        }
    }

    /**
     * Alterar plano de cadastro padrão
     */
    public function alterarPlanoCadastro(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['planoId'])) {
                echo json_encode(['success' => false, 'error' => 'ID do plano é obrigatório']);
                return;
            }
            
            $planoId = $data['planoId'];
            $ativo = $data['ativo'] ?? false;
            
            // Iniciar transação
            $this->pdo->beginTransaction();
            
            try {
                if ($ativo) {
                    // Desmarcar todos os outros planos
                    $stmt = $this->pdo->prepare("UPDATE planos SET plano_cadastro = 0");
                    $stmt->execute();
                    
                    // Marcar o plano selecionado
                    $stmt = $this->pdo->prepare("UPDATE planos SET plano_cadastro = 1 WHERE id = ?");
                    $stmt->execute([$planoId]);
                } else {
                    // Desmarcar o plano
                    $stmt = $this->pdo->prepare("UPDATE planos SET plano_cadastro = 0 WHERE id = ?");
                    $stmt->execute([$planoId]);
                }
                
                $this->pdo->commit();
                
                echo json_encode(['success' => true, 'data' => ['message' => 'Plano de cadastro atualizado']]);
            } catch (Exception $e) {
                $this->pdo->rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            error_log("Erro ao alterar plano de cadastro: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar plano de cadastro']);
        }
    }

    /**
     * Atualizar plano
     */
    public function criarPlano(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true);

            if (empty($data['nome'])) {
                echo json_encode(['success' => false, 'error' => 'Nome do plano e obrigatorio']);
                return;
            }

            $stmt = $this->pdo->prepare("
                INSERT INTO planos (
                    nome, descricao, preco, qntConexoes, qntContatos, qntDisparos,
                    qntUsuarios, qntQuadros, qntAgentesIa, qntCreditosIa, menu_ocultar,
                    periodo, ativo, limite_conexoes, limite_contatos, limite_disparos, limite_usuarios
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $qntConexoes = $data['qntConexoes'] ?? null;
            $qntContatos = $data['qntContatos'] ?? null;
            $qntDisparos = $data['qntDisparos'] ?? null;
            $qntUsuarios = $data['qntUsuarios'] ?? null;
            $limiteLegado = function ($valor) {
                if ($valor === null || $valor === '') return null;
                return min((int)$valor, 2147483647);
            };
            $stmt->execute([
                $data['nome'],
                $data['descricao'] ?? null,
                $data['preco'] ?? 0,
                $qntConexoes,
                $qntContatos,
                $qntDisparos,
                $qntUsuarios,
                $data['qntQuadros'] ?? $data['qntQuadrosCrm'] ?? null,
                $data['qntAgentesIa'] ?? $data['qntAgentes'] ?? null,
                $data['qntCreditosIa'] ?? $data['qntCreditos'] ?? null,
                json_encode($data['menu_ocultar'] ?? []),
                $data['periodo'] ?? 'mensal',
                isset($data['ativo']) ? (int)(bool)$data['ativo'] : 1,
                $limiteLegado($qntConexoes),
                $limiteLegado($qntContatos),
                $limiteLegado($qntDisparos),
                $limiteLegado($qntUsuarios),
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id' => $this->pdo->lastInsertId(),
                    'message' => 'Plano criado com sucesso'
                ]
            ]);
        } catch (Exception $e) {
            error_log("Erro ao criar plano: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao criar plano']);
        }
    }

    public function atualizarPlano(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID do plano é obrigatório']);
                return;
            }
            
            $updates = [];
            $params = [];
            
            if (isset($data['nome'])) {
                $updates[] = 'nome = ?';
                $params[] = $data['nome'];
            }
            if (isset($data['preco'])) {
                $updates[] = 'preco = ?';
                $params[] = $data['preco'];
            }
            if (isset($data['descricao'])) {
                $updates[] = 'descricao = ?';
                $params[] = $data['descricao'];
            }

            $mapaCampos = [
                'qntConexoes' => 'qntConexoes',
                'qntContatos' => 'qntContatos',
                'qntDisparos' => 'qntDisparos',
                'qntUsuarios' => 'qntUsuarios',
                'qntQuadros' => 'qntQuadros',
                'qntQuadrosCrm' => 'qntQuadros',
                'qntAgentesIa' => 'qntAgentesIa',
                'qntAgentes' => 'qntAgentesIa',
                'qntCreditosIa' => 'qntCreditosIa',
                'qntCreditos' => 'qntCreditosIa',
                'periodo' => 'periodo',
                'ativo' => 'ativo',
            ];

            foreach ($mapaCampos as $entrada => $coluna) {
                if (array_key_exists($entrada, $data)) {
                    $updates[] = "$coluna = ?";
                    $params[] = $entrada === 'ativo' ? (int)(bool)$data[$entrada] : $data[$entrada];
                }
            }

            $mapaLimitesLegados = [
                'qntConexoes' => 'limite_conexoes',
                'qntContatos' => 'limite_contatos',
                'qntDisparos' => 'limite_disparos',
                'qntUsuarios' => 'limite_usuarios',
            ];
            $limiteLegado = function ($valor) {
                if ($valor === null || $valor === '') return null;
                return min((int)$valor, 2147483647);
            };
            foreach ($mapaLimitesLegados as $entrada => $coluna) {
                if (array_key_exists($entrada, $data)) {
                    $updates[] = "$coluna = ?";
                    $params[] = $limiteLegado($data[$entrada]);
                }
            }

            if (array_key_exists('menu_ocultar', $data)) {
                $updates[] = 'menu_ocultar = ?';
                $params[] = is_string($data['menu_ocultar']) ? $data['menu_ocultar'] : json_encode($data['menu_ocultar'] ?? []);
            }
            
            if (empty($updates)) {
                echo json_encode(['success' => false, 'error' => 'Nenhum dado para atualizar']);
                return;
            }
            
            $params[] = $data['id'];
            $sql = "UPDATE planos SET " . implode(', ', $updates) . " WHERE id = ?";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Plano atualizado com sucesso']]);
        } catch (Exception $e) {
            error_log("Erro ao atualizar plano: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar plano']);
        }
    }

    public function contarClientesPlano(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $planoId = $_GET['id'] ?? null;
            if (!$planoId) {
                echo json_encode(['success' => false, 'error' => 'ID do plano e obrigatorio']);
                return;
            }

            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM contas WHERE plano = ?");
            $stmt->execute([$planoId]);
            echo json_encode(['success' => true, 'data' => (int)$stmt->fetchColumn()]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao contar clientes do plano']);
        }
    }

    public function transferirClientesPlano(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $origem = $data['planoOrigemId'] ?? null;
            $destino = $data['planoDestinoId'] ?? null;

            if (!$origem || !$destino || (int)$origem === (int)$destino) {
                echo json_encode(['success' => false, 'error' => 'Planos de origem e destino sao obrigatorios']);
                return;
            }

            $stmt = $this->pdo->prepare("UPDATE contas SET plano = ? WHERE plano = ?");
            $stmt->execute([$destino, $origem]);

            echo json_encode(['success' => true, 'data' => ['transferidos' => $stmt->rowCount()]]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao transferir clientes']);
        }
    }

    /**
     * Excluir plano
     */
    public function excluirPlano(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID do plano é obrigatório']);
                return;
            }
            
            $planoId = $data['id'];
            
            // Verificar se há clientes vinculados a este plano
            $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM contas WHERE plano = ?");
            $stmt->execute([$planoId]);
            $result = $stmt->fetch();
            
            if ($result['total'] > 0) {
                echo json_encode([
                    'success' => false, 
                    'error' => "Não é possível excluir este plano. Existem {$result['total']} cliente(s) vinculado(s) a ele."
                ]);
                return;
            }
            
            // Excluir o plano
            $stmt = $this->pdo->prepare("DELETE FROM planos WHERE id = ?");
            $stmt->execute([$planoId]);
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Plano excluído com sucesso']]);
        } catch (Exception $e) {
            error_log("Erro ao excluir plano: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao excluir plano']);
        }
    }

    /**
     * Listar webhooks
     */
    public function listarWebhooks(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $stmt = $this->pdo->query("
                SELECT * FROM webhooks ORDER BY created_at DESC
            ");
            $webhooks = $stmt->fetchAll();
            
            echo json_encode(['success' => true, 'data' => $webhooks]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar webhooks']);
        }
    }

    /**
     * Obter configurações do sistema
     */
    public function obterConfiguracoes(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $stmt = $this->pdo->query("SELECT * FROM configuracoes_sistema WHERE id = 1");
            $config = $stmt->fetch();
            
            echo json_encode(['success' => true, 'data' => $config]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao obter configurações']);
        }
    }

    /**
     * Atualizar configurações do sistema
     */
    public function atualizarConfiguracoes(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            $updates = [];
            $params = [];
            
            $campos = ['nome_sistema', 'logo_url', 'cor_primaria', 'telefone_suporte', 'favicon_url', 
                      'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password',
                      'smtp_from_email', 'smtp_from_name', 'webhook_pagamento_url',
                      'pagina_vendas_url', 'videos_tutoriais', 'dias_teste_cadastro'];
            
            foreach ($campos as $campo) {
                if (isset($data[$campo])) {
                    $updates[] = "$campo = ?";
                    $params[] = $data[$campo];
                }
            }
            
            if (empty($updates)) {
                echo json_encode(['success' => false, 'error' => 'Nenhum dado para atualizar']);
                return;
            }
            
            $sql = "UPDATE configuracoes_sistema SET " . implode(', ', $updates) . " WHERE id = 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Configurações atualizadas']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao atualizar configurações']);
        }
    }

    /**
     * Obter configurações de WhatsApp
     */
    public function uploadImagemPersonalizacao(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $tipo = $_POST['tipo'] ?? '';
            if (!in_array($tipo, ['logo', 'favicon'], true)) {
                echo json_encode(['success' => false, 'error' => 'Tipo de imagem invalido']);
                return;
            }

            if (empty($_FILES['arquivo']) || !is_uploaded_file($_FILES['arquivo']['tmp_name'])) {
                echo json_encode(['success' => false, 'error' => 'Arquivo nao enviado']);
                return;
            }

            $arquivo = $_FILES['arquivo'];
            if ($arquivo['size'] > 5 * 1024 * 1024) {
                echo json_encode(['success' => false, 'error' => 'A imagem deve ter no maximo 5MB']);
                return;
            }

            $mime = mime_content_type($arquivo['tmp_name']) ?: '';
            if (strpos($mime, 'image/') !== 0) {
                echo json_encode(['success' => false, 'error' => 'Envie um arquivo de imagem valido']);
                return;
            }

            $extensoes = [
                'image/png' => 'png',
                'image/jpeg' => 'jpg',
                'image/gif' => 'gif',
                'image/webp' => 'webp',
                'image/svg+xml' => 'svg',
                'image/x-icon' => 'ico',
                'image/vnd.microsoft.icon' => 'ico',
            ];
            $ext = $extensoes[$mime] ?? strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION) ?: 'png');
            $ext = preg_replace('/[^a-z0-9]/', '', $ext) ?: 'png';

            $publicDir = realpath(__DIR__ . '/../../public');
            if (!$publicDir) {
                echo json_encode(['success' => false, 'error' => 'Diretorio publico nao encontrado']);
                return;
            }

            $uploadDir = $publicDir . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'personalizacao';
            if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true)) {
                echo json_encode(['success' => false, 'error' => 'Nao foi possivel criar diretorio de upload']);
                return;
            }

            $fileName = $tipo . '.' . $ext;
            $destino = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
            if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
                echo json_encode(['success' => false, 'error' => 'Falha ao salvar arquivo']);
                return;
            }

            $url = App::url('/uploads/personalizacao/' . $fileName);
            echo json_encode(['success' => true, 'data' => ['url' => $url]]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao enviar imagem']);
        }
    }

    public function obterConfigWhatsApp(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $stmt = $this->pdo->query("
                SELECT id, provider, api_url, api_key, api_token, webhook_url, ativo, configuracoes_extras
                FROM whatsapp_config 
                ORDER BY id DESC
            ");
            $configs = $stmt->fetchAll();
            
            echo json_encode(['success' => true, 'data' => $configs]);
        } catch (Exception $e) {
            error_log("Erro ao obter config WhatsApp: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao obter configurações']);
        }
    }

    /**
     * Salvar/Atualizar configuração de WhatsApp
     */
    public function salvarConfigWhatsApp(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['provider']) || !isset($data['api_url']) || !isset($data['api_key'])) {
                echo json_encode(['success' => false, 'error' => 'Dados obrigatórios faltando']);
                return;
            }
            
            $provider = $data['provider'];
            $apiUrl = $data['api_url'];
            $apiKey = $data['api_key'];
            $apiToken = $data['api_token'] ?? null;
            $webhookUrl = $data['webhook_url'] ?? null;
            $ativo = isset($data['ativo']) ? (int)$data['ativo'] : 1;
            $configExtras = isset($data['configuracoes_extras']) ? json_encode($data['configuracoes_extras']) : null;
            
            $this->pdo->beginTransaction();
            
            try {
                if (isset($data['id']) && $data['id']) {
                    // Atualizar existente
                    $stmt = $this->pdo->prepare("
                        UPDATE whatsapp_config 
                        SET provider = ?, api_url = ?, api_key = ?, api_token = ?, 
                            webhook_url = ?, ativo = ?, configuracoes_extras = ?
                        WHERE id = ?
                    ");
                    $stmt->execute([$provider, $apiUrl, $apiKey, $apiToken, $webhookUrl, $ativo, $configExtras, $data['id']]);
                } else {
                    // Inserir novo
                    $stmt = $this->pdo->prepare("
                        INSERT INTO whatsapp_config (provider, api_url, api_key, api_token, webhook_url, ativo, configuracoes_extras)
                        VALUES (?, ?, ?, ?, ?, ?, ?)
                    ");
                    $stmt->execute([$provider, $apiUrl, $apiKey, $apiToken, $webhookUrl, $ativo, $configExtras]);
                }
                
                // Se ativo = 1, desativar outros
                if ($ativo == 1) {
                    $id = $data['id'] ?? $this->pdo->lastInsertId();
                    $stmt = $this->pdo->prepare("UPDATE whatsapp_config SET ativo = 0 WHERE id != ?");
                    $stmt->execute([$id]);
                }
                
                $this->pdo->commit();
                
                echo json_encode(['success' => true, 'data' => ['message' => 'Configuração salva com sucesso']]);
            } catch (Exception $e) {
                $this->pdo->rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            error_log("Erro ao salvar config WhatsApp: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao salvar configuração']);
        }
    }

    /**
     * Ativar/Desativar configuração de WhatsApp
     */
    public function toggleConfigWhatsApp(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID é obrigatório']);
                return;
            }
            
            $this->pdo->beginTransaction();
            
            try {
                // Desativar todas
                $this->pdo->exec("UPDATE whatsapp_config SET ativo = 0");
                
                // Ativar a selecionada
                $stmt = $this->pdo->prepare("UPDATE whatsapp_config SET ativo = 1 WHERE id = ?");
                $stmt->execute([$data['id']]);
                
                $this->pdo->commit();
                
                echo json_encode(['success' => true, 'data' => ['message' => 'Configuração ativada']]);
            } catch (Exception $e) {
                $this->pdo->rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            error_log("Erro ao toggle config WhatsApp: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao alternar configuração']);
        }
    }

    /**
     * Excluir configuração de WhatsApp
     */
    public function excluirConfigWhatsApp(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['id'])) {
                echo json_encode(['success' => false, 'error' => 'ID é obrigatório']);
                return;
            }
            
            $stmt = $this->pdo->prepare("DELETE FROM whatsapp_config WHERE id = ?");
            $stmt->execute([$data['id']]);
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Configuração excluída']]);
        } catch (Exception $e) {
            error_log("Erro ao excluir config WhatsApp: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao excluir configuração']);
        }
    }

    /**
     * Testar conexão com API de WhatsApp
     */
    public function testarConfigWhatsApp(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            require_once __DIR__ . '/../Services/WhatsAppServiceFactory.php';
            
            $result = WhatsAppServiceFactory::testConnection();
            echo json_encode($result);
        } catch (Exception $e) {
            error_log("Erro ao testar config WhatsApp: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao testar conexão: ' . $e->getMessage()]);
        }
    }

    public function obterConfigStorage(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            require_once __DIR__ . '/../Models/StorageConfigModel.php';
            $config = (new StorageConfigModel())->obter(false);
            echo json_encode(['success' => true, 'data' => $config]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao obter configuração de storage']);
        }
    }

    public function salvarConfigStorage(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            require_once __DIR__ . '/../Models/StorageConfigModel.php';
            $data = json_decode(file_get_contents('php://input'), true) ?: [];

            (new StorageConfigModel())->salvar($data);

            echo json_encode(['success' => true, 'data' => ['message' => 'Configuração de storage salva']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao salvar configuração de storage: ' . $e->getMessage()]);
        }
    }

    public function testarConfigStorage(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            require_once __DIR__ . '/../Models/StorageConfigModel.php';
            require_once __DIR__ . '/../Services/MinioStorageService.php';

            $config = (new StorageConfigModel())->obter(true);
            if (($config['provider'] ?? 'local') !== 'minio' || empty($config['ativo'])) {
                echo json_encode(['success' => true, 'data' => ['message' => 'Storage local ativo']]);
                return;
            }

            echo json_encode((new MinioStorageService($config))->testar());
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao testar storage: ' . $e->getMessage()]);
        }
    }

    public function listarModelos(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            echo json_encode(['success' => true, 'data' => (new ModeloModel())->listar()]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao listar modelos: ' . $e->getMessage()]);
        }
    }

    public function salvarModelo(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $id = (new ModeloModel())->salvar($data);
            echo json_encode(['success' => true, 'data' => ['id' => $id]]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function excluirModelo(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');

        try {
            $data = json_decode(file_get_contents('php://input'), true) ?: [];
            $id = (int)($data['id'] ?? 0);
            if ($id <= 0) {
                echo json_encode(['success' => false, 'error' => 'ID e obrigatorio']);
                return;
            }

            (new ModeloModel())->excluir($id);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao excluir modelo: ' . $e->getMessage()]);
        }
    }

    /**
     * Obter dias de teste configurados
     */
    public function obterDiasTeste(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $stmt = $this->pdo->prepare("SELECT dias_teste_cadastro FROM configuracoes_sistema WHERE id = 1 LIMIT 1");
            $stmt->execute();
            $config = $stmt->fetch();
            
            $dias = $config ? (int)$config['dias_teste_cadastro'] : 30;
            
            echo json_encode(['success' => true, 'data' => $dias]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao obter dias de teste']);
        }
    }

    /**
     * Salvar dias de teste para cadastros públicos
     */
    public function salvarDiasTeste(): void {
        Auth::requerAutenticacao();
        Auth::requerSuperAdmin();
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['dias'])) {
                echo json_encode(['success' => false, 'error' => 'Dias é obrigatório']);
                return;
            }
            
            $dias = (int)$data['dias'];
            
            if ($dias < 1 || $dias > 365) {
                echo json_encode(['success' => false, 'error' => 'Dias deve estar entre 1 e 365']);
                return;
            }
            
            // Atualizar configuração
            $stmt = $this->pdo->prepare("
                UPDATE configuracoes_sistema 
                SET dias_teste_cadastro = ? 
                WHERE id = 1
            ");
            $stmt->execute([$dias]);
            
            echo json_encode(['success' => true, 'data' => ['message' => 'Dias de teste atualizados']]);
        } catch (Exception $e) {
            error_log("Erro ao salvar dias de teste: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao salvar dias de teste']);
        }
    }
}
