<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 Diagnóstico HUBLABEL</h1>";
echo "<style>body{font-family:Arial;padding:20px;} .ok{color:green;} .error{color:red;} pre{background:#f5f5f5;padding:10px;}</style>";

// 1. Verificar sessão
session_start();
echo "<h2>1. Sessão PHP</h2>";
echo "<pre>";
echo "Session ID: " . session_id() . "\n";
echo "Session Status: " . session_status() . "\n";
echo "Session Data: " . print_r($_SESSION, true) . "\n";
echo "</pre>";

// 2. Limpar sessão
session_destroy();
session_write_close();
setcookie(session_name(), '', time() - 3600, '/');
echo "<p class='ok'>✅ Sessão destruída</p>";

// 3. Verificar arquivos
echo "<h2>2. Arquivos</h2>";
$files = [
    'Login Clean' => __DIR__ . '/../app/Views/pages/login_clean.php',
    'Dashboard Clean' => __DIR__ . '/../app/Views/pages/dashboard_clean.php',
    'Login JS' => __DIR__ . '/assets/js/pages/login.js',
    'Dashboard JS' => __DIR__ . '/assets/js/pages/dashboard.js',
];

foreach ($files as $name => $path) {
    if (file_exists($path)) {
        echo "<p class='ok'>✅ $name existe (" . number_format(filesize($path)) . " bytes)</p>";
    } else {
        echo "<p class='error'>❌ $name NÃO EXISTE: $path</p>";
    }
}

// 4. Verificar rotas
echo "<h2>3. Rotas Configuradas</h2>";
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Auth.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

$router = new Router();
$authController = new AuthController();
$router->get('/login', [$authController, 'exibirLogin']);
$router->post('/login', [$authController, 'login']);
$router->get('/logout', [$authController, 'logout']);

echo "<p class='ok'>✅ Rotas registradas</p>";

// 5. Testar conexão DB
echo "<h2>4. Banco de Dados</h2>";
try {
    $pdo = Database::pdo();
    echo "<p class='ok'>✅ Conexão MySQL OK</p>";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM SAAS_Usuarios");
    $result = $stmt->fetch();
    echo "<p class='ok'>✅ Total de usuários: " . $result['total'] . "</p>";
} catch (Exception $e) {
    echo "<p class='error'>❌ Erro DB: " . $e->getMessage() . "</p>";
}

// 6. Instruções
echo "<h2>5. Próximos Passos</h2>";
echo "<ol>";
echo "<li><strong>Feche TODAS as abas do navegador</strong></li>";
echo "<li><strong>Limpe o cache:</strong> Ctrl + Shift + Delete</li>";
echo "<li><strong>Acesse:</strong> <a href='/hublabel/public/login'>http://localhost/hublabel/public/login</a></li>";
echo "<li><strong>Login:</strong> admin@hublabel.com / password</li>";
echo "</ol>";

echo "<hr>";
echo "<p><a href='/hublabel/public/login' style='background:#667eea;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>→ IR PARA LOGIN</a></p>";
