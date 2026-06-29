<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}

require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/App.php';
require_once __DIR__ . '/../app/Core/Auth.php';

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/ConexoesController.php';
require_once __DIR__ . '/../app/Controllers/ContatosController.php';
require_once __DIR__ . '/../app/Controllers/ChatController.php';
require_once __DIR__ . '/../app/Controllers/DisparosController.php';
require_once __DIR__ . '/../app/Controllers/AgentesController.php';
require_once __DIR__ . '/../app/Controllers/CRMController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Controllers/MetaController.php';
require_once __DIR__ . '/../app/Controllers/UploadController.php';

$router = new Router();

$router->get('/', function() { App::redirect('/dashboard'); });
$router->get('/health', function () { header('Content-Type: application/json'); echo json_encode(['status'=>'ok']); });

$authController = new AuthController();
$router->get('/login', [$authController, 'exibirLogin']);
$router->get('/cadastro', [$authController, 'exibirCadastro']);
$router->post('/login', [$authController, 'login']);
$router->get('/logout', [$authController, 'logout']);
$router->get('/cadastrar', [$authController, 'exibirCadastro']);
$router->post('/cadastrar', [$authController, 'cadastrar']);
$router->get('/redefinir-senha', [$authController, 'exibirRedefinirSenha']);
$router->post('/redefinir-senha', [$authController, 'redefinirSenha']);

$dashboardController = new DashboardController();
$router->get('/dashboard', [$dashboardController, 'index']);
$router->get('/api/dashboard/resumo', [$dashboardController, 'resumo']);
$router->get('/api/dashboard/graficos', [$dashboardController, 'graficos']);

$conexoesController = new ConexoesController();
$router->get('/conexoes', [$conexoesController, 'index']);
$router->get('/api/conexoes', [$conexoesController, 'listar']);
$router->post('/api/conexoes/criar', [$conexoesController, 'criar']);
$router->post('/api/conexoes/atualizar', [$conexoesController, 'atualizar']);
$router->post('/api/conexoes/deletar', [$conexoesController, 'deletar']);
$router->post('/api/conexoes/qrcode', [$conexoesController, 'qrcode']);
$router->post('/api/conexoes/status', [$conexoesController, 'status']);

$contatosController = new ContatosController();
$router->get('/contatos', [$contatosController, 'index']);
$router->get('/api/contatos', [$contatosController, 'listar']);
$router->post('/api/contatos', [$contatosController, 'criar']);
$router->post('/api/contatos/atualizar', [$contatosController, 'atualizar']);
$router->post('/api/contatos/deletar', [$contatosController, 'deletar']);
$router->post('/api/contatos/importar', [$contatosController, 'importar']);

$chatController = new ChatController();
$router->get('/chat', [$chatController, 'index']);
$router->get('/api/conversas', [$chatController, 'listarConversas']);
$router->post('/api/conversas/criar', [$chatController, 'criarConversa']);
$router->get('/api/mensagens', [$chatController, 'listarMensagens']);
$router->post('/api/mensagens/enviar', [$chatController, 'enviarMensagem']);
$router->post('/api/conversas/status', [$chatController, 'atualizarStatus']);
$router->post('/api/conversas/pausar', [$chatController, 'pausarConversa']);
$router->get('/api/chat/realtime-config', [$chatController, 'realtimeConfig']);
$router->post('/agente-no-whatsapp', [$chatController, 'receberWebhookWhatsApp']);
$router->post('/api/webhooks/whatsapp', [$chatController, 'receberWebhookWhatsApp']);

$disparosController = new DisparosController();
$router->get('/disparos', [$disparosController, 'index']);
$router->get('/disparos-individuais', [$disparosController, 'criar']);
$router->get('/disparos-grupos', [$disparosController, 'grupos']);
$router->get('/detalhes-disparo', [$disparosController, 'detalhes']);
$router->get('/api/disparos', [$disparosController, 'listar']);
$router->post('/api/disparos/criar', [$disparosController, 'criarDisparo']);
$router->post('/api/disparos/iniciar', [$disparosController, 'iniciar']);
$router->post('/api/disparos/pausar', [$disparosController, 'pausar']);
$router->post('/api/disparos/cancelar', [$disparosController, 'cancelar']);
$router->get('/api/disparos/detalhes', [$disparosController, 'detalhesDisparo']);

$agentesController = new AgentesController();
$router->get('/agentes-ia', [$agentesController, 'index']);
$router->get('/agentes', [$agentesController, 'index']); // Alias
$router->get('/api/agentes', [$agentesController, 'listar']);
$router->post('/api/agentes/criar', [$agentesController, 'criar']);
$router->post('/api/agentes/atualizar', [$agentesController, 'atualizar']);
$router->post('/api/agentes/deletar', [$agentesController, 'deletar']);
$router->post('/api/agentes/testar', [$agentesController, 'testar']);

$crmController = new CRMController();
$router->get('/crm', [$crmController, 'index']);
$router->get('/crm-etapas', [$crmController, 'etapas']);
$router->get('/api/crm/quadros', [$crmController, 'listarQuadros']);
$router->post('/api/crm/quadros/criar', [$crmController, 'criarQuadro']);
$router->post('/api/crm/quadros/atualizar', [$crmController, 'atualizarQuadro']);
$router->post('/api/crm/quadros/deletar', [$crmController, 'deletarQuadro']);
$router->get('/api/crm/etapas', [$crmController, 'listarEtapas']);
$router->post('/api/crm/etapas/criar', [$crmController, 'criarEtapa']);

$adminController = new AdminController();
$router->get('/adminpannel', [$adminController, 'index']);
$router->get('/admin', [$adminController, 'index']); // Alias
$router->get('/configuracoes', [$adminController, 'configuracoes']);
$router->get('/ajuda', [$adminController, 'ajuda']);
$router->get('/api/usuarios', [$adminController, 'listarUsuarios']);
$router->post('/api/usuarios/criar', [$adminController, 'criarUsuario']);
$router->post('/api/usuarios/atualizar', [$adminController, 'atualizarUsuario']);
$router->post('/api/usuarios/senha', [$adminController, 'alterarSenha']);
$router->post('/api/conta/atualizar', [$adminController, 'atualizarConta']);

// Rota para verificar se é super admin
$router->get('/api/auth/check-superadmin', function() {
    header('Content-Type: application/json');
    $isSuperAdmin = Auth::isSuperAdmin();
    
    echo json_encode([
        'success' => true,
        'isSuperAdmin' => $isSuperAdmin
    ]);
});

// Rota de teste
$router->get('/api/test', function() {
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'API funcionando!']);
});

$router->post('/testar-openai', function() {
    header('Content-Type: application/json');
    $key = getenv('OPENAI_API_KEY') ?: getenv('OPENAI_KEY') ?: '';
    echo json_encode(['resposta' => $key ? 'sucesso' : 'pendente']);
});

$router->post('/alterar-openai', function() {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true) ?: [];
    if (empty($data['OpenAiApikey'])) {
        http_response_code(422);
        echo json_encode(['success' => false, 'error' => 'Chave OpenAI nao informada']);
        return;
    }
    echo json_encode(['success' => true, 'message' => 'Chave recebida. Persistencia sera migrada na configuracao de IA.']);
});

// API de Cadastro Público
$router->post('/api/cadastro/criar', [$authController, 'cadastroPublico']);

// APIs do Painel de Administração (Super Admin)
$router->get('/api/admin/dashboard', [$adminController, 'dashboardAdmin']);
$router->get('/api/admin/clientes', [$adminController, 'listarClientes']);
$router->post('/api/admin/clientes/criar', [$adminController, 'criarCliente']);
$router->post('/api/admin/clientes/atualizar', [$adminController, 'atualizarCliente']);
$router->post('/api/admin/clientes/excluir', [$adminController, 'excluirCliente']);
$router->post('/api/admin/clientes/resetar-creditos', [$adminController, 'resetarCreditosCliente']);
$router->get('/api/admin/clientes/usuarios', [$adminController, 'listarUsuariosCliente']);
$router->post('/api/admin/clientes/usuarios/excluir', [$adminController, 'excluirUsuarioCliente']);
$router->get('/api/admin/planos', [$adminController, 'listarPlanos']);
$router->post('/api/admin/planos/criar', [$adminController, 'criarPlano']);
$router->post('/api/admin/planos/atualizar', [$adminController, 'atualizarPlano']);
$router->post('/api/admin/planos/excluir', [$adminController, 'excluirPlano']);
$router->post('/api/admin/planos/cadastro', [$adminController, 'alterarPlanoCadastro']);
$router->get('/api/admin/planos/clientes-count', [$adminController, 'contarClientesPlano']);
$router->post('/api/admin/planos/transferir-clientes', [$adminController, 'transferirClientesPlano']);
$router->get('/api/admin/webhooks', [$adminController, 'listarWebhooks']);
$router->get('/api/admin/configuracoes', [$adminController, 'obterConfiguracoes']);
$router->post('/api/admin/configuracoes/atualizar', [$adminController, 'atualizarConfiguracoes']);
$router->post('/api/admin/configuracoes/upload-imagem', [$adminController, 'uploadImagemPersonalizacao']);
$router->get('/api/admin/configuracoes/dias-teste', [$adminController, 'obterDiasTeste']);
$router->post('/api/admin/configuracoes/dias-teste', [$adminController, 'salvarDiasTeste']);
$router->get('/api/admin/whatsapp/config', [$adminController, 'obterConfigWhatsApp']);
$router->post('/api/admin/whatsapp/config/salvar', [$adminController, 'salvarConfigWhatsApp']);
$router->post('/api/admin/whatsapp/config/toggle', [$adminController, 'toggleConfigWhatsApp']);
$router->post('/api/admin/whatsapp/config/excluir', [$adminController, 'excluirConfigWhatsApp']);
$router->post('/api/admin/whatsapp/config/testar', [$adminController, 'testarConfigWhatsApp']);
$router->get('/api/admin/storage/config', [$adminController, 'obterConfigStorage']);
$router->post('/api/admin/storage/config', [$adminController, 'salvarConfigStorage']);
$router->post('/api/admin/storage/testar', [$adminController, 'testarConfigStorage']);
$router->get('/api/admin/modelos', [$adminController, 'listarModelos']);
$router->post('/api/admin/modelos/salvar', [$adminController, 'salvarModelo']);
$router->post('/api/admin/modelos/excluir', [$adminController, 'excluirModelo']);

$uploadController = new UploadController();
$router->post('/uploadmedia', [$uploadController, 'uploadMedia']);
$router->post('/api/uploadmedia', [$uploadController, 'uploadMedia']);

$metaController = new MetaController();
$router->get('/api/meta/config', [$metaController, 'obterConfig']);
$router->post('/api/meta/config', [$metaController, 'salvarConfig']);
$router->post('/meta-token', [$metaController, 'token']);
$router->post('/meta-criar-template', [$metaController, 'criarTemplate']);
$router->post('/meta-excluir-template', [$metaController, 'excluirTemplate']);
$router->post('/enviar-template', [$metaController, 'enviarTemplate']);
$router->post('/meta-perfil', [$metaController, 'perfil']);
$router->get('/eventsmeta', [$metaController, 'verificarWebhook']);
$router->post('/eventsmeta', [$metaController, 'receberEventos']);

function glchat_rewrite_output(string $output): string {
    if ($output === '') {
        return $output;
    }

    $base = App::basePath();
    $name = App::name();
    $output = str_replace(['/hublabel/public', '/glchat/public'], $base, $output);
    $output = str_replace(['HUBLABEL', 'HubLabel', 'Hublabel'], $name, $output);

    if (stripos($output, '</head>') !== false && strpos($output, 'window.GLCHAT_BASE') === false) {
        $globals = sprintf(
            "<script>(function(){var base=%s;window.GLCHAT_BASE=base;window.HUBLABEL_BASE=base;window.GLCHAT_API_BASE=%s;window.HUBLABEL_API_BASE=%s;var legacy=/^\\/(?:hublabel|glchat)\\/public(?=\\/|$)/;function normalize(path){path=String(path||'/');if(/^https?:\\/\\//i.test(path)){try{var u=new URL(path);u.pathname=u.pathname.replace(legacy,base);return u.toString();}catch(e){return path;}}if(legacy.test(path))return path.replace(legacy,base);if(path.charAt(0)==='/'&&base&&path.indexOf(base)!==0)return base+path;return path;}window.glchatUrl=normalize;window.hublabelUrl=normalize;var nativeFetch=window.fetch;if(nativeFetch){window.fetch=function(input,init){if(typeof input==='string')input=normalize(input);return nativeFetch.call(this,input,init);};}})();</script>\n",
            json_encode($base),
            json_encode(App::url('/api')),
            json_encode(App::url('/api'))
        );
        $output = preg_replace('/<\/head>/i', $globals . '</head>', $output, 1);
    }

    return $output;
}

ob_start('glchat_rewrite_output');
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
