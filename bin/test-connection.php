<?php
// Teste de conexão com o banco
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}

require_once __DIR__ . '/../app/Core/Database.php';

try {
    $pdo = Database::pdo();
    echo "✅ Conexão com MySQL estabelecida com sucesso!\n\n";
    
    // Testar contagem de tabelas
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "📊 Total de tabelas: " . count($tables) . "\n\n";
    
    // Listar tabelas
    echo "📋 Tabelas criadas:\n";
    foreach ($tables as $table) {
        echo "   - $table\n";
    }
    
    // Verificar usuário admin
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM SAAS_Usuarios WHERE super_admin = 1");
    $result = $stmt->fetch();
    echo "\n👤 Usuários super admin: " . $result['total'] . "\n";
    
    // Buscar dados do admin
    $stmt = $pdo->query("SELECT u.nome, u.Email, c.id as contaId FROM SAAS_Usuarios u JOIN SAAS_Contas c ON u.contaId = c.id WHERE u.super_admin = 1 LIMIT 1");
    $admin = $stmt->fetch();
    
    if ($admin) {
        echo "\n✅ Usuário Admin criado:\n";
        echo "   Nome: {$admin['nome']}\n";
        echo "   Email: {$admin['Email']}\n";
        echo "   Conta ID: {$admin['contaId']}\n";
        echo "   Senha: password\n";
    }
    
    echo "\n🎉 Sistema pronto para uso!\n";
    echo "🌐 Acesse: http://localhost/hublabel/public/login\n";
    
} catch (Exception $e) {
    echo "❌ Erro na conexão: " . $e->getMessage() . "\n";
}
