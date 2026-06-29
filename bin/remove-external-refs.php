#!/usr/bin/env php
<?php
/**
 * SOLUÇÃO DEFINITIVA: Remover TODAS as referências a arquivos externos
 */

$viewsDir = __DIR__ . '/../app/Views/pages/';
$files = glob($viewsDir . '*_clean.php');

echo "🧹 LIMPEZA TOTAL DE REFERÊNCIAS EXTERNAS...\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    echo "📄 Processando: $filename\n";
    
    $content = file_get_contents($file);
    $modified = false;
    
    // 1. Remover TODAS as tags <img> com src do Supabase ou localhost
    $newContent = preg_replace(
        '/<img[^>]*src=["\'](?:https?:\/\/[^"\']*supabase[^"\']*|\/hublabel\/public\/assets\/[^"\']*)["\'][^>]*>/i',
        '<!-- Imagem removida -->',
        $content
    );
    if ($newContent !== $content) {
        $content = $newContent;
        $modified = true;
    }
    
    // 2. Remover background-image com URLs
    $newContent = preg_replace(
        '/background-image:\s*url\([^)]+\);?/i',
        '',
        $content
    );
    if ($newContent !== $content) {
        $content = $newContent;
        $modified = true;
    }
    
    // 3. Remover links de favicon
    $newContent = preg_replace(
        '/<link[^>]*rel=["\'](?:icon|shortcut icon|apple-touch-icon)["\'][^>]*>/i',
        '',
        $content
    );
    if ($newContent !== $content) {
        $content = $newContent;
        $modified = true;
    }
    
    // 4. Remover TODOS os <script type="module">
    $newContent = preg_replace(
        '/<script[^>]*type=["\']module["\'][^>]*>.*?<\/script>/s',
        '',
        $content
    );
    if ($newContent !== $content) {
        $content = $newContent;
        $modified = true;
    }
    
    // 5. Adicionar meta para evitar cache
    if (strpos($content, '<head>') !== false && strpos($content, 'no-cache') === false) {
        $content = str_replace(
            '<head>',
            '<head><meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"><meta http-equiv="Pragma" content="no-cache"><meta http-equiv="Expires" content="0">',
            $content
        );
        $modified = true;
    }
    
    if ($modified) {
        file_put_contents($file, $content);
        echo "   ✅ Referências externas removidas\n";
    } else {
        echo "   ⏭️  Nenhuma alteração necessária\n";
    }
}

echo "\n✅ LIMPEZA TOTAL CONCLUÍDA!\n";
echo "🎯 Agora não deve tentar carregar arquivos externos\n";
