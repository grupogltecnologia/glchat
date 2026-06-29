#!/usr/bin/env php
<?php
/**
 * Desabilitar verificação automática de login que causa loop
 */

$viewsDir = __DIR__ . '/../app/Views/pages/';
$files = glob($viewsDir . '*.php');

echo "🔧 Desabilitando verificação automática de login...\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    echo "📄 Processando: $filename\n";
    
    $content = file_get_contents($file);
    $modified = false;
    
    // Comentar função checkExistingLogin
    $patterns = [
        // Comentar chamada da função
        '/async function checkExistingLogin\(\)\s*{/i' => '// DESABILITADO - causava loop\n        async function checkExistingLogin_DISABLED() {',
        
        // Comentar execução automática
        '/checkExistingLogin\(\);?\s*$/m' => '// checkExistingLogin(); // DESABILITADO',
        
        // Comentar verificação no submit
        '/if\s*\(\s*await\s+checkExistingLogin\(\)\s*\)\s*{[^}]*return;?\s*}/s' => '// Verificação de login existente desabilitada',
    ];
    
    foreach ($patterns as $pattern => $replacement) {
        $newContent = preg_replace($pattern, $replacement, $content);
        if ($newContent !== $content) {
            $content = $newContent;
            $modified = true;
        }
    }
    
    if ($modified) {
        file_put_contents($file, $content);
        echo "   ✅ Verificação automática desabilitada\n";
    } else {
        echo "   ⏭️  Nenhuma alteração necessária\n";
    }
}

echo "\n✅ Processamento concluído!\n";
