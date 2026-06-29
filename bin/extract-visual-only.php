#!/usr/bin/env php
<?php
/**
 * Extrair apenas HTML/CSS do n8n, remover JavaScript completamente
 */

$htmlDir = __DIR__ . '/../storage/extracted_html/';
$viewsDir = __DIR__ . '/../app/Views/pages/';

$files = [
    '02_login_ia_chatconversa.html' => 'login_clean.php',
    '06_dashboard_ia_chatconversa.html' => 'dashboard_clean.php',
    '15_chat_ia_chatconversa.html' => 'chat_clean.php',
    '07_contatos_ia_chatconversa.html' => 'contatos_clean.php',
    '03_conex_es_ia_chatconversa.html' => 'conexoes_clean.php',
    '05_disparos_ia_chatconversa.html' => 'disparos_clean.php',
    '13_agente_ia_ia_chatconversa.html' => 'agentes_clean.php',
    '12_crm_ia_chatconversa.html' => 'crm_clean.php',
    '09_configura_es_ia_chatconversa.html' => 'configuracoes_clean.php',
    '10_administra_o_ia_chatconversa.html' => 'admin_clean.php',
];

echo "🎨 Extraindo APENAS HTML/CSS (visual puro)...\n\n";

foreach ($files as $htmlFile => $phpFile) {
    $sourcePath = $htmlDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Arquivo não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 Processando: $htmlFile -> $phpFile\n";
    
    $content = file_get_contents($sourcePath);
    
    // 1. REMOVER TODO O JAVASCRIPT (entre <script> e </script>)
    $content = preg_replace('/<script[^>]*>.*?<\/script>/s', '', $content);
    
    // 2. Corrigir URLs do Supabase Storage para local
    $content = preg_replace(
        '/https:\/\/[a-z0-9]+\.supabase\.co\/storage\/v1\/object\/public\/arquivos\/([a-zA-Z0-9_-]+)/i',
        '/hublabel/public/assets/images/$1',
        $content
    );
    
    // 3. Corrigir URLs de navegação
    $content = str_replace('https://app.chatconversa.app.br', '/hublabel/public', $content);
    $content = str_replace('http://app.chatconversa.app.br', '/hublabel/public', $content);
    
    // 4. Adicionar script específico para cada página ANTES do </body>
    $pageName = str_replace('_clean.php', '', $phpFile);
    $scriptTag = "<script src=\"/hublabel/public/assets/js/pages/{$pageName}.js\"></script>\n</body>";
    $content = str_replace('</body>', $scriptTag, $content);
    
    // 5. Adicionar comentário PHP
    $phpComment = "<?php\n/**\n * Visual original do n8n - JavaScript reescrito para PHP/MySQL\n */\n?>\n";
    $content = $phpComment . $content;
    
    file_put_contents($destPath, $content);
    echo "   ✅ HTML/CSS extraído, JavaScript removido\n";
}

echo "\n✅ Processamento concluído!\n";
echo "📝 Agora crie os arquivos JavaScript específicos em public/assets/js/pages/\n";
