<?php
require_once __DIR__ . '/../Core/App.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/UsuarioModel.php';
require_once __DIR__ . '/../Models/ContaModel.php';

class AuthController {
    private UsuarioModel $usuarioModel;
    private ContaModel $contaModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
        $this->contaModel = new ContaModel();
    }

    public function exibirLogin(): void {
        if (Auth::verificar()) {
            App::redirect('/dashboard');
        }
        include __DIR__ . '/../Views/pages/login_clean.php';
    }

    public function exibirCadastro(): void {
        if (Auth::verificar()) {
            App::redirect('/dashboard');
        }
        include __DIR__ . '/../Views/pages/cadastro.php';
    }

    public function login(): void {
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            $email = $data['email'] ?? null;
            $senha = $data['password'] ?? $data['senha'] ?? null;
            
            if (!$email || !$senha) {
                echo json_encode(['success' => false, 'error' => 'Email e senha são obrigatórios']);
                return;
            }

            $usuario = $this->usuarioModel->verificarSenha($email, $senha);
            
            if (!$usuario) {
                echo json_encode(['success' => false, 'error' => 'Email ou senha inválidos']);
                return;
            }

            if (!$this->contaModel->verificarStatus($usuario['contaId'])) {
                echo json_encode(['success' => false, 'error' => 'Conta bloqueada ou expirada']);
                return;
            }

            Auth::login($usuario);
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'redirect' => App::url('/dashboard'),
                    'usuario' => [
                        'nome' => $usuario['nome'],
                        'email' => $usuario['Email'],
                        'funcao' => $usuario['funcao']
                    ]
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao processar login']);
        }
    }

    public function logout(): void {
        Auth::logout();
        App::redirect('/login');
    }

    public function cadastrar(): void {
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['nome']) || !isset($data['email']) || !isset($data['senha'])) {
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }

            if ($this->usuarioModel->buscarPorEmail($data['email'])) {
                echo json_encode(['success' => false, 'error' => 'Email já cadastrado']);
                return;
            }

            $contaId = $this->contaModel->criar([
                'email' => $data['email'],
                'status' => 1,
                'plano' => 1,
                'dataValidade' => date('Y-m-d', strtotime('+30 days'))
            ]);

            $usuarioId = $this->usuarioModel->criar([
                'contaId' => $contaId,
                'nome' => $data['nome'],
                'email' => $data['email'],
                'senha' => $data['senha'],
                'funcao' => 'admin',
                'super_admin' => 0
            ]);

            echo json_encode([
                'success' => true,
                'data' => [
                    'message' => 'Cadastro realizado com sucesso',
                    'redirect' => App::url('/login')
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao criar cadastro']);
        }
    }

    public function exibirRedefinirSenha(): void {
        include __DIR__ . '/../Views/pages/16_redefinir_senha_ia_chatconversa.php';
    }

    public function redefinirSenha(): void {
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['email'])) {
                echo json_encode(['success' => false, 'error' => 'Email é obrigatório']);
                return;
            }

            $usuario = $this->usuarioModel->buscarPorEmail($data['email']);
            
            if (!$usuario) {
                echo json_encode(['success' => true, 'data' => ['message' => 'Se o email existir, você receberá instruções']]);
                return;
            }

            echo json_encode(['success' => true, 'data' => ['message' => 'Email de recuperação enviado']]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao processar solicitação']);
        }
    }

    /**
     * Cadastro público de novos clientes
     */
    public function cadastroPublico(): void {
        header('Content-Type: application/json');
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            error_log("Cadastro público - Dados recebidos: " . json_encode($data));
            
            $nome = $data['nome'] ?? null;
            $email = $data['email'] ?? null;
            $telefone = $data['telefone'] ?? null;
            $senha = $data['senha'] ?? null;
            
            // Validações
            if (!$nome || !$email || !$telefone || !$senha) {
                echo json_encode(['success' => false, 'error' => 'Todos os campos são obrigatórios']);
                return;
            }
            
            if (strlen($senha) < 8) {
                echo json_encode(['success' => false, 'error' => 'A senha deve ter no mínimo 8 caracteres']);
                return;
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'error' => 'E-mail inválido']);
                return;
            }
            
            // Verificar se email já existe
            $pdo = Database::pdo();
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE Email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                echo json_encode(['success' => false, 'error' => 'Este e-mail já está cadastrado']);
                return;
            }
            
            // Buscar plano padrão para cadastro
            $stmt = $pdo->prepare("SELECT id FROM planos WHERE plano_cadastro = 1 LIMIT 1");
            $stmt->execute();
            $planoPadrao = $stmt->fetch();
            $planoId = $planoPadrao ? $planoPadrao['id'] : 1; // Se não encontrar, usa ID 1 (Free)
            
            // Buscar dias de teste da configuração
            $stmt = $pdo->prepare("SELECT dias_teste_cadastro FROM configuracoes_sistema WHERE id = 1 LIMIT 1");
            $stmt->execute();
            $config = $stmt->fetch();
            $diasTeste = $config ? (int)$config['dias_teste_cadastro'] : 30; // Padrão: 30 dias
            
            // Calcular data de validade
            $dataValidade = date('Y-m-d', strtotime("+{$diasTeste} days"));
            error_log("Cadastro - Dias de teste: {$diasTeste}, Data validade: {$dataValidade}");
            
            // Iniciar transação
            $pdo->beginTransaction();
            
            try {
                // Criar conta
                $stmt = $pdo->prepare("
                    INSERT INTO contas (nome, email, telefone, plano, status, dataValidade)
                    VALUES (?, ?, ?, ?, 1, ?)
                ");
                $stmt->execute([$nome, $email, $telefone, $planoId, $dataValidade]);
                
                $contaId = $pdo->lastInsertId();
                
                // Criar usuário admin da conta
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                
                $stmt = $pdo->prepare("
                    INSERT INTO usuarios (contaId, nome, Email, Senha, funcao)
                    VALUES (?, ?, ?, ?, 'admin')
                ");
                $stmt->execute([$contaId, $nome, $email, $senhaHash]);
                
                // Commit da transação
                $pdo->commit();
                
                echo json_encode([
                    'success' => true,
                    'data' => [
                        'message' => 'Conta criada com sucesso!',
                        'contaId' => $contaId
                    ]
                ]);
            } catch (Exception $e) {
                $pdo->rollBack();
                error_log("Erro ao criar conta: " . $e->getMessage());
                throw $e;
            }
        } catch (Exception $e) {
            error_log("Erro no cadastro público: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erro ao criar conta. Tente novamente.']);
        }
    }
}
