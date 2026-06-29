#!/usr/bin/env php
<?php
/**
 * Adicionar script de compatibilidade em todas as views
 */

$viewsDir = __DIR__ . '/../app/Views/pages/';
$scriptTag = '<script src="/hublabel/public/assets/js/supabase-compat.js"></script>';

$files = glob($viewsDir . '*.php');

echo "🔧 Adicionando script de compatibilidade...\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    echo "📄 Processando: $filename\n";
    
    $content = file_get_contents($file);
    
    // Verificar se já tem o script
    if (strpos($content, 'supabase-compat.js') !== false) {
        echo "   ⏭️  Script já existe\n";
        continue;
    }
    
    // Adicionar antes do </head> ou antes do primeiro <script type="module">
    if (strpos($content, '</head>') !== false) {
        $content = str_replace('</head>', "    $scriptTag\n</head>", $content);
    } elseif (strpos($content, '<script type="module">') !== false) {
        $content = str_replace('<script type="module">', "$scriptTag\n    <script type=\"module\">", $content);
    } else {
        // Adicionar antes do </body>
        $content = str_replace('</body>', "    $scriptTag\n</body>", $content);
    }
    
    file_put_contents($file, $content);
    echo "   ✅ Script adicionado\n";
}

echo "\n✅ Concluído!\n";
