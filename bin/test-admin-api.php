#!/usr/bin/env php
<?php
/**
 * Testar API do painel de administração
 */

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Auth.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';

echo "🧪 Testando API do painel de administração...\n\n";

// Simular sessão de super admin
session_start();
$_SESSION['usuario_id'] = '1';
$_SESSION['contaId'] = 'aa3913ec-eb28-42e8-8071-35d619467e50';
$_SESSION['nome'] = 'Administrador';
$_SESSION['email'] = 'admin@hublabel.com';
$_SESSION['funcao'] = 'superadmin';
$_SESSION['logado'] = true;

$controller = new AdminController();

echo "📊 Testando Dashboard...\n";
ob_start();
$controller->dashboardAdmin();
$output = ob_get_clean();
$data = json_decode($output, true);

if ($data && $data['success']) {
    echo "✅ Dashboard OK\n";
    echo "   Total Clientes: {$data['data']['totalClientes']}\n";
    echo "   Clientes Ativos: {$data['data']['clientesAtivos']}\n";
    echo "   Faturamento Mês: R$ {$data['data']['faturamentoMes']}\n";
    echo "   Ticket Médio: R$ {$data['data']['ticketMedio']}\n";
} else {
    echo "❌ Erro no Dashboard\n";
    echo "   " . ($data['error'] ?? 'Erro desconhecido') . "\n";
}

echo "\n👥 Testando Clientes...\n";
ob_start();
$controller->listarClientes();
$output = ob_get_clean();
$data = json_decode($output, true);

if ($data && $data['success']) {
    echo "✅ Clientes OK\n";
    echo "   Total: " . count($data['data']) . " clientes\n";
} else {
    echo "❌ Erro em Clientes\n";
}

echo "\n💎 Testando Planos...\n";
ob_start();
$controller->listarPlanos();
$output = ob_get_clean();
$data = json_decode($output, true);

if ($data && $data['success']) {
    echo "✅ Planos OK\n";
    echo "   Total: " . count($data['data']) . " planos\n";
} else {
    echo "❌ Erro em Planos\n";
}

echo "\n🔗 Testando Webhooks...\n";
ob_start();
$controller->listarWebhooks();
$output = ob_get_clean();
$data = json_decode($output, true);

if ($data && $data['success']) {
    echo "✅ Webhooks OK\n";
    echo "   Total: " . count($data['data']) . " webhooks\n";
} else {
    echo "❌ Erro em Webhooks\n";
}

echo "\n⚙️ Testando Configurações...\n";
ob_start();
$controller->obterConfiguracoes();
$output = ob_get_clean();
$data = json_decode($output, true);

if ($data && $data['success']) {
    echo "✅ Configurações OK\n";
    echo "   Nome Sistema: {$data['data']['nome_sistema']}\n";
} else {
    echo "❌ Erro em Configurações\n";
}

echo "\n🎉 Testes concluídos!\n";
