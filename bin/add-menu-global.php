#!/usr/bin/env php
<?php
/**
 * Adicionar menu-global.js em todas as views
 */

$viewsDir = __DIR__ . '/../app/Views/pages/';
$files = glob($viewsDir . '*_clean.php');

$menuScript = '<script src="/hublabel/public/assets/js/menu-global.js"></script>';

echo "🔧 Adicionando menu-global.js em todas as views...\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    $content = file_get_contents($file);
    
    // Verificar se já tem o script
    if (strpos($content, 'menu-global.js') !== false) {
        echo "⏭️  $filename - já tem menu-global.js\n";
        continue;
    }
    
    // Adicionar antes do </body>
    $content = str_replace('</body>', $menuScript . "\n\n</body>", $content);
    
    file_put_contents($file, $content);
    echo "✅ $filename - menu-global.js adicionado\n";
}

echo "\n✅ Menu global adicionado em todas as views!\n";
