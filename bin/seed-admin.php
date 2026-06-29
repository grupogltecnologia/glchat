#!/usr/bin/env php
<?php
/**
 * Seed inicial - Criar conta e usuário admin
 */

require_once __DIR__ . '/../app/Core/Database.php';

echo "🌱 Seed inicial do banco de dados...\n\n";

try {
    $pdo = Database::pdo();
    
    // 1. Criar conta padrão
    echo "📦 Criando conta padrão...\n";
    $contaId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
    
    $stmt = $pdo->prepare("
        INSERT INTO contas (id, nome, plano, status)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nome = VALUES(nome)
    ");
    $stmt->execute([$contaId, 'HUBLABEL - Conta Principal', 'premium', 'ativo']);
    echo "   ✅ Conta ID: $contaId\n\n";
    
    // 2. Criar usuário admin
    echo "👤 Criando usuário admin...\n";
    $senhaHash = password_hash('password', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("
        INSERT INTO usuarios (contaId, nome, Email, Senha, funcao)
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE Senha = VALUES(Senha), funcao = VALUES(funcao)
    ");
    $stmt->execute([$contaId, 'Administrador', 'admin@hublabel.com', $senhaHash, 'superadmin']);
    echo "   ✅ Email: admin@hublabel.com\n";
    echo "   ✅ Senha: password\n\n";
    
    echo "✅ Seed concluído!\n\n";
    echo "🔐 Você pode fazer login com:\n";
    echo "   Email: admin@hublabel.com\n";
    echo "   Senha: password\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
