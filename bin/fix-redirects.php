#!/usr/bin/env php
<?php
/**
 * Corrigir redirecionamentos JavaScript
 */

$viewsDir = __DIR__ . '/../app/Views/pages/';
$files = glob($viewsDir . '*.php');

echo "🔧 Corrigindo redirecionamentos JavaScript...\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    echo "📄 Processando: $filename\n";
    
    $content = file_get_contents($file);
    $modified = false;
    
    // Substituir window.location.href com URLs absolutas
    $patterns = [
        // Redirecionamentos absolutos
        "/window\.location\.href\s*=\s*['\"]https?:\/\/app\.chatconversa\.app\.br([^'\"]*)['\"];?/i" => "window.location.href = '/hublabel/public$1';",
        
        // Redirecionamentos relativos que precisam do prefixo
        "/window\.location\.href\s*=\s*['\"]\/([^'\"]+)['\"];?/" => "window.location.href = '/hublabel/public/$1';",
        
        // location.href sem window
        "/location\.href\s*=\s*['\"]https?:\/\/app\.chatconversa\.app\.br([^'\"]*)['\"];?/i" => "location.href = '/hublabel/public$1';",
        
        "/location\.href\s*=\s*['\"]\/([^'\"]+)['\"];?/" => "location.href = '/hublabel/public/$1';",
        
        // window.location = 
        "/window\.location\s*=\s*['\"]https?:\/\/app\.chatconversa\.app\.br([^'\"]*)['\"];?/i" => "window.location = '/hublabel/public$1';",
        
        "/window\.location\s*=\s*['\"]\/([^'\"]+)['\"];?/" => "window.location = '/hublabel/public/$1';",
    ];
    
    foreach ($patterns as $pattern => $replacement) {
        $newContent = preg_replace($pattern, $replacement, $content);
        if ($newContent !== $content) {
            $content = $newContent;
            $modified = true;
        }
    }
    
    // Corrigir redirectTo em resetPasswordForEmail
    $content = preg_replace(
        "/redirectTo:\s*['\"]https?:\/\/app\.chatconversa\.app\.br([^'\"]*)['\"],?/i",
        "redirectTo: 'http://localhost/hublabel/public$1',",
        $content
    );
    
    if ($modified) {
        file_put_contents($file, $content);
        echo "   ✅ Redirecionamentos corrigidos\n";
    } else {
        echo "   ⏭️  Nenhuma alteração necessária\n";
    }
}

echo "\n✅ Processamento concluído!\n";
