#!/usr/bin/env php
<?php
/**
 * Criar versões completamente limpas para todas as telas
 */

$viewsDir = __DIR__ . '/../app/Views/pages/';

$template = function($title, $icon, $description, $pageName) {
    return <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <title>$title - HUBLABEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { brand: { 500: '#6C63FF' } }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <header class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-500 text-white flex items-center justify-center text-xl font-bold">H</div>
                <span class="font-extrabold text-xl">HUBLABEL</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/hublabel/public/dashboard" class="text-sm text-gray-600 hover:text-brand-500">Dashboard</a>
                <a href="/hublabel/public/logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">Sair</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <i class="$icon text-6xl text-brand-500 mb-4"></i>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">$title</h1>
            <p class="text-gray-600 mb-6">$description</p>
            <p class="text-sm text-gray-500">Tela em desenvolvimento - Backend funcionando</p>
        </div>
    </main>

    <script src="/hublabel/public/assets/js/pages/$pageName.js"></script>
</body>
</html>
HTML;
};

$telas = [
    'contatos_clean.php' => ['Contatos', 'fas fa-address-book', 'Gerenciar seus contatos', 'contatos'],
    'conexoes_clean.php' => ['Conexões', 'fab fa-whatsapp', 'Gerenciar conexões WhatsApp', 'conexoes'],
    'disparos_clean.php' => ['Disparos', 'fas fa-paper-plane', 'Campanhas de disparo em massa', 'disparos'],
    'agentes_clean.php' => ['Agentes IA', 'fas fa-robot', 'Gerenciar agentes de inteligência artificial', 'agentes'],
    'crm_clean.php' => ['CRM', 'fas fa-chart-line', 'Funil de vendas e gestão de negócios', 'crm'],
    'configuracoes_clean.php' => ['Configurações', 'fas fa-cog', 'Configurações da conta', 'configuracoes'],
    'admin_clean.php' => ['Administração', 'fas fa-users-cog', 'Painel de administração', 'admin'],
];

echo "🎨 Criando versões completamente limpas...\n\n";

foreach ($telas as $filename => [$title, $icon, $description, $pageName]) {
    $filepath = $viewsDir . $filename;
    
    // Deletar arquivo antigo se existir
    if (file_exists($filepath)) {
        unlink($filepath);
    }
    
    $content = $template($title, $icon, $description, $pageName);
    file_put_contents($filepath, $content);
    echo "✅ Criado: $filename\n";
}

echo "\n✅ Todas as telas limpas criadas!\n";
