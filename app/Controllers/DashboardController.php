<?php
require_once __DIR__ . '/../Core/App.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/ContatoModel.php';
require_once __DIR__ . '/../Models/ConversaModel.php';
require_once __DIR__ . '/../Models/ConexaoModel.php';
require_once __DIR__ . '/../Models/DisparoModel.php';

class DashboardController {
    private ContatoModel $contatoModel;
    private ConversaModel $conversaModel;
    private ConexaoModel $conexaoModel;
    private DisparoModel $disparoModel;

    public function __construct() {
        $this->contatoModel = new ContatoModel();
        $this->conversaModel = new ConversaModel();
        $this->conexaoModel = new ConexaoModel();
        $this->disparoModel = new DisparoModel();
    }

    public function index(): void {
        if (!Auth::verificar()) {
            App::redirect('/login');
        }
        
        include __DIR__ . '/../Views/pages/dashboard_clean.php';
    }

    public function resumo(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            
            $totalContatos = $this->contatoModel->contarPorConta($contaId);
            
            $conversas = $this->conversaModel->listarPorConta($contaId);
            $totalConversas = count($conversas);
            $conversasNaoLidas = $this->conversaModel->contarNaoLidas($contaId);
            
            $conversasAbertas = count(array_filter($conversas, function($c) {
                return $c['statusAtendimento'] === 'aberto';
            }));
            
            $conversasAguardando = count(array_filter($conversas, function($c) {
                return $c['statusAtendimento'] === 'aguardando';
            }));
            
            $conexoes = $this->conexaoModel->listarPorConta($contaId);
            $totalConexoes = count($conexoes);
            
            $disparos = $this->disparoModel->listarPorConta($contaId);
            $totalDisparos = count($disparos);
            
            $disparosAtivos = count(array_filter($disparos, function($d) {
                return in_array($d['StatusDisparo'], ['processando', 'agendado']);
            }));

            $hoje = date('Y-m-d');
            $conversasHoje = count(array_filter($conversas, function($c) use ($hoje) {
                return strpos($c['created_at'], $hoje) === 0;
            }));

            $usuario = Auth::obterUsuario();
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'usuario' => [
                        'nome' => $usuario['nome'] ?? 'Usuário',
                        'email' => $usuario['Email'] ?? '',
                        'funcao' => $usuario['funcao'] ?? 'admin'
                    ],
                    'totalContatos' => $totalContatos,
                    'totalConversas' => $totalConversas,
                    'totalConexoes' => $totalConexoes,
                    'totalDisparos' => $totalDisparos,
                    'contatos' => [
                        'total' => $totalContatos
                    ],
                    'conversas' => [
                        'total' => $totalConversas,
                        'naoLidas' => $conversasNaoLidas,
                        'abertas' => $conversasAbertas,
                        'aguardando' => $conversasAguardando,
                        'hoje' => $conversasHoje
                    ],
                    'conexoes' => [
                        'total' => $totalConexoes,
                        'ativas' => $totalConexoes
                    ],
                    'disparos' => [
                        'total' => $totalDisparos,
                        'ativos' => $disparosAtivos
                    ]
                ]
            ]);
        } catch (Throwable $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao buscar resumo']);
        }
    }

    public function graficos(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');
        
        try {
            $contaId = Auth::obterContaId();
            
            $conversas = $this->conversaModel->listarPorConta($contaId);
            
            $ultimos7Dias = [];
            for ($i = 6; $i >= 0; $i--) {
                $data = date('Y-m-d', strtotime("-$i days"));
                $ultimos7Dias[$data] = 0;
            }
            
            foreach ($conversas as $conversa) {
                $data = substr($conversa['created_at'], 0, 10);
                if (isset($ultimos7Dias[$data])) {
                    $ultimos7Dias[$data]++;
                }
            }

            echo json_encode([
                'success' => true,
                'data' => [
                    'conversasPorDia' => [
                        'labels' => array_keys($ultimos7Dias),
                        'values' => array_values($ultimos7Dias)
                    ]
                ]
            ]);
        } catch (Throwable $e) {
            echo json_encode(['success' => false, 'error' => 'Erro ao buscar gráficos']);
        }
    }
}
