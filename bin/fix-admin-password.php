#!/usr/bin/env php
<?php
/**
 * Recriar usuário admin com senha correta
 */

require_once __DIR__ . '/../app/Core/Database.php';

echo "🔐 Recriando usuário admin...\n\n";

try {
    $pdo = Database::pdo();
    
    // Buscar conta admin
    $stmt = $pdo->query("SELECT id FROM contas ORDER BY created_at ASC LIMIT 1");
    $conta = $stmt->fetch();
    
    if (!$conta) {
        echo "❌ Nenhuma conta encontrada.\n";
        exit(1);
    }
    
    $contaId = $conta['id'];
    
    // Deletar usuário admin antigo
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE Email = ?");
    $stmt->execute(['admin@hublabel.com']);
    
    // Criar novo usuário admin com senha correta
    $email = 'admin@hublabel.com';
    $senha = 'password';
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("
        INSERT INTO usuarios (contaId, nome, Email, Senha, funcao)
        VALUES (?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $contaId,
        'Administrador',
        $email,
        $senhaHash,
        'superadmin'
    ]);
    
    echo "✅ Usuário admin recriado!\n\n";
    echo "📧 Email: admin@hublabel.com\n";
    echo "🔑 Senha: password\n\n";
    
    // Testar o hash
    echo "🧪 Testando hash...\n";
    $stmt = $pdo->prepare("SELECT Senha FROM usuarios WHERE Email = ?");
    $stmt->execute(['admin@hublabel.com']);
    $usuario = $stmt->fetch();
    
    if ($usuario && password_verify('password', $usuario['Senha'])) {
        echo "✅ Hash verificado com sucesso!\n";
    } else {
        echo "❌ Erro ao verificar hash!\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
