#!/usr/bin/env php
<?php
/**
 * Script para popular o banco com dados de teste
 */

require_once __DIR__ . '/../app/Core/Database.php';

echo "🔧 Populando banco de dados com dados de teste...\n\n";

try {
    $pdo = Database::pdo();
    
    // Verificar se já existe o usuário admin
    $stmt = $pdo->prepare("SELECT id, contaId FROM usuarios WHERE Email = ?");
    $stmt->execute(['admin@hublabel.com']);
    $admin = $stmt->fetch();
    
    if (!$admin) {
        echo "❌ Usuário admin não encontrado. Execute o seed primeiro.\n";
        exit(1);
    }
    
    $contaId = $admin['contaId'];
    echo "✅ Conta ID: $contaId\n\n";
    
    // 1. Inserir contatos de teste
    echo "📇 Inserindo contatos de teste...\n";
    $contatos = [
        ['João Silva', '5511999999999'],
        ['Maria Santos', '5511888888888'],
        ['Pedro Oliveira', '5511777777777'],
        ['Ana Costa', '5511666666666'],
        ['Carlos Souza', '5511555555555']
    ];
    
    foreach ($contatos as $contato) {
        $stmt = $pdo->prepare("
            INSERT INTO contatos (contaId, nome, telefone, created_at)
            VALUES (?, ?, ?, NOW())
            ON DUPLICATE KEY UPDATE nome = VALUES(nome)
        ");
        $stmt->execute([$contaId, $contato[0], $contato[1]]);
        echo "   ✅ {$contato[0]}\n";
    }
    
    // 2. Inserir conexões de teste
    echo "\n📱 Inserindo conexões de teste...\n";
    $stmt = $pdo->prepare("
        INSERT INTO conexoes (contaId, nomeConexao, numeroConexao, statusConexao, created_at)
        VALUES (?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE statusConexao = VALUES(statusConexao)
    ");
    $stmt->execute([$contaId, 'WhatsApp Principal', '5511999999999', 'conectado']);
    echo "   ✅ WhatsApp Principal\n";
    
    // 3. Inserir conversas de teste
    echo "\n💬 Inserindo conversas de teste...\n";
    $conversas = [
        ['João Silva', '5511999999999', 'aberto'],
        ['Maria Santos', '5511888888888', 'aguardando'],
        ['Pedro Oliveira', '5511777777777', 'fechado']
    ];
    
    foreach ($conversas as $conversa) {
        $stmt = $pdo->prepare("
            INSERT INTO conversas (contaId, nomeConversa, telefoneConversa, statusAtendimento, created_at, updated_at)
            VALUES (?, ?, ?, ?, NOW(), NOW())
        ");
        $stmt->execute([$contaId, $conversa[0], $conversa[1], $conversa[2]]);
        echo "   ✅ {$conversa[0]} - {$conversa[2]}\n";
    }
    
    // 4. Inserir disparos de teste
    echo "\n📤 Inserindo disparos de teste...\n";
    $stmt = $pdo->prepare("
        INSERT INTO disparos (contaId, NomeDisparo, StatusDisparo, TotalContatos, created_at)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->execute([$contaId, 'Campanha de Boas-vindas', 'concluido', 50]);
    echo "   ✅ Campanha de Boas-vindas\n";
    
    $stmt->execute([$contaId, 'Promoção de Natal', 'processando', 100]);
    echo "   ✅ Promoção de Natal\n";
    
    echo "\n✅ Dados de teste inseridos com sucesso!\n\n";
    
    // Mostrar resumo
    echo "📊 RESUMO:\n";
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM contatos WHERE contaId = ?");
    $stmt->execute([$contaId]);
    echo "   Contatos: " . $stmt->fetch()['total'] . "\n";
    
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM conversas WHERE contaId = ?");
    $stmt->execute([$contaId]);
    echo "   Conversas: " . $stmt->fetch()['total'] . "\n";
    
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM conexoes WHERE contaId = ?");
    $stmt->execute([$contaId]);
    echo "   Conexões: " . $stmt->fetch()['total'] . "\n";
    
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM disparos WHERE contaId = ?");
    $stmt->execute([$contaId]);
    echo "   Disparos: " . $stmt->fetch()['total'] . "\n";
    
    echo "\n🎉 Pronto! Acesse o dashboard para ver os dados.\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
