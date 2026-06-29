#!/usr/bin/env php
<?php
/**
 * Popular dados de teste para o painel de Administração
 */

require_once __DIR__ . '/../app/Core/Database.php';

echo "🌱 Populando dados de teste para Administração...\n\n";

try {
    $pdo = Database::pdo();
    
    // Buscar conta admin existente
    $stmt = $pdo->query("SELECT id FROM contas LIMIT 1");
    $contaAdmin = $stmt->fetch();
    
    if (!$contaAdmin) {
        echo "❌ Nenhuma conta encontrada. Execute seed-admin.php primeiro.\n";
        exit(1);
    }
    
    $contaAdminId = $contaAdmin['id'];
    
    // 1. Criar contas de clientes de teste
    echo "👥 Criando contas de clientes de teste...\n";
    
    $clientes = [
        ['Empresa ABC Ltda', 'ativo', 'Pro'],
        ['Tech Solutions Inc', 'ativo', 'Básico'],
        ['Marketing Digital XYZ', 'bloqueado', 'Free'],
        ['Vendas Online 123', 'ativo', 'Enterprise'],
        ['Consultoria Premium', 'ativo', 'Pro'],
        ['Startup Inovadora', 'ativo', 'Básico']
    ];
    
    foreach ($clientes as $cliente) {
        // Criar conta
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
        ");
        $stmt->execute([$contaId, $cliente[0], strtolower($cliente[2]), $cliente[1]]);
        
        // Criar usuário para a conta
        $email = strtolower(str_replace(' ', '', $cliente[0])) . '@email.com';
        $senhaHash = password_hash('password123', PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (contaId, nome, Email, Senha, funcao)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$contaId, $cliente[0], $email, $senhaHash, 'admin']);
        
        // Criar assinatura
        $stmt = $pdo->prepare("
            SELECT id FROM planos WHERE nome = ?
        ");
        $stmt->execute([$cliente[2]]);
        $plano = $stmt->fetch();
        
        if ($plano) {
            $dataInicio = date('Y-m-d', strtotime('-' . rand(1, 90) . ' days'));
            $dataFim = date('Y-m-d', strtotime('+30 days'));
            
            $stmt = $pdo->prepare("
                INSERT INTO assinaturas (contaId, planoId, status, data_inicio, data_fim)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$contaId, $plano['id'], $cliente[1], $dataInicio, $dataFim]);
            
            // Criar algumas transações
            $numTransacoes = rand(1, 3);
            for ($i = 0; $i < $numTransacoes; $i++) {
                $valor = rand(50, 500);
                $status = ['pago', 'pendente', 'cancelado'][rand(0, 2)];
                
                $stmt = $pdo->prepare("
                    INSERT INTO transacoes (contaId, assinaturaId, valor, status, metodo_pagamento, data_pagamento)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                    $contaId,
                    $pdo->lastInsertId(),
                    $valor,
                    $status,
                    'cartao_credito',
                    $status === 'pago' ? date('Y-m-d H:i:s', strtotime('-' . rand(1, 30) . ' days')) : null
                ]);
            }
        }
        
        echo "   ✅ {$cliente[0]} - {$cliente[2]}\n";
    }
    
    // 2. Criar alguns webhooks de exemplo
    echo "\n🔗 Criando webhooks de exemplo...\n";
    $stmt = $pdo->prepare("
        INSERT INTO webhooks (nome, url, tipo, ativo)
        VALUES (?, ?, ?, ?)
    ");
    
    $webhooks = [
        ['Stripe - Pagamentos', 'https://api.stripe.com/webhook', 'pagamento', 1],
        ['Hotmart - Vendas', 'https://api.hotmart.com/webhook', 'pagamento', 1],
        ['Slack - Notificações', 'https://hooks.slack.com/services/xxx', 'notificacao', 0]
    ];
    
    foreach ($webhooks as $webhook) {
        $stmt->execute($webhook);
        echo "   ✅ {$webhook[0]}\n";
    }
    
    echo "\n✅ Dados de teste criados com sucesso!\n\n";
    
    // Mostrar resumo
    echo "📊 RESUMO:\n";
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM contas");
    echo "   Contas: " . $stmt->fetch()['total'] . "\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM planos");
    echo "   Planos: " . $stmt->fetch()['total'] . "\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM assinaturas");
    echo "   Assinaturas: " . $stmt->fetch()['total'] . "\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM transacoes");
    echo "   Transações: " . $stmt->fetch()['total'] . "\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM webhooks");
    echo "   Webhooks: " . $stmt->fetch()['total'] . "\n";
    
    echo "\n🎉 Painel de Administração pronto para uso!\n";
    echo "   Acesse: http://localhost/hublabel/public/admin\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
