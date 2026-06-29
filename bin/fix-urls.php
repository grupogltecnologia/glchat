#!/usr/bin/env php
<?php
/**
 * Substituir URLs do domínio antigo pelo localhost
 */

$viewsDir = __DIR__ . '/../app/Views/pages/';
$files = glob($viewsDir . '*.php');

// URLs para substituir
$replacements = [
    'https://app.chatconversa.app.br' => '/hublabel/public',
    'http://app.chatconversa.app.br' => '/hublabel/public',
    'app.chatconversa.app.br' => 'localhost/hublabel/public',
    '/login' => '/hublabel/public/login',
    '/dashboard' => '/hublabel/public/dashboard',
    '/chat' => '/hublabel/public/chat',
    '/contatos' => '/hublabel/public/contatos',
    '/conexoes' => '/hublabel/public/conexoes',
    '/disparos' => '/hublabel/public/disparos',
    '/agentes-ia' => '/hublabel/public/agentes-ia',
    '/crm' => '/hublabel/public/crm',
    '/configuracoes' => '/hublabel/public/configuracoes',
    '/adminpannel' => '/hublabel/public/adminpannel',
];

echo "🔧 Substituindo URLs do domínio antigo...\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    echo "📄 Processando: $filename\n";
    
    $content = file_get_contents($file);
    $modified = false;
    
    foreach ($replacements as $old => $new) {
        if (strpos($content, $old) !== false) {
            $content = str_replace($old, $new, $content);
            $modified = true;
        }
    }
    
    if ($modified) {
        file_put_contents($file, $content);
        echo "   ✅ URLs atualizadas\n";
    } else {
        echo "   ⏭️  Nenhuma alteração necessária\n";
    }
}

echo "\n✅ Processamento concluído!\n";
