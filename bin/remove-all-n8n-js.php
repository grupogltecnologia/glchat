#!/usr/bin/env php
<?php
/**
 * SOLUÇÃO DEFINITIVA: Remover TODO JavaScript do n8n
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

echo "🔥 REMOVENDO TODO JAVASCRIPT DO N8N...\n\n";

foreach ($files as $htmlFile => $phpFile) {
    $sourcePath = $htmlDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Arquivo não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 Processando: $htmlFile -> $phpFile\n";
    
    $content = file_get_contents($sourcePath);
    
    // 1. REMOVER TODOS OS <script>...</script> (exceto CDNs)
    // Manter apenas: Tailwind, Google Fonts, Font Awesome
    $content = preg_replace('/<script(?![^>]*src=["\']https:\/\/cdn\.tailwindcss\.com["\'])(?![^>]*src=["\']https:\/\/fonts\.googleapis\.com["\'])(?![^>]*src=["\']https:\/\/cdnjs\.cloudflare\.com["\'])[^>]*>.*?<\/script>/s', '', $content);
    
    // 2. Remover imports do Supabase
    $content = preg_replace('/import\s+.*?from\s+[\'"].*?supabase.*?[\'"];?/s', '', $content);
    
    // 3. Corrigir URLs
    $content = preg_replace(
        '/https:\/\/[a-z0-9]+\.supabase\.co\/storage\/v1\/object\/public\/arquivos\/([a-zA-Z0-9_-]+)/i',
        '/hublabel/public/assets/images/$1',
        $content
    );
    
    $content = str_replace('https://app.chatconversa.app.br', '/hublabel/public', $content);
    $content = str_replace('http://app.chatconversa.app.br', '/hublabel/public', $content);
    
    // 4. Adicionar APENAS nosso script personalizado ANTES do </body>
    $pageName = str_replace('_clean.php', '', $phpFile);
    $scriptTag = "\n<!-- JavaScript reescrito para PHP/MySQL -->\n<script src=\"/hublabel/public/assets/js/pages/{$pageName}.js\"></script>\n</body>";
    $content = str_replace('</body>', $scriptTag, $content);
    
    // 5. Comentário PHP
    $phpComment = "<?php\n/**\n * HTML/CSS original do n8n\n * JavaScript completamente removido e reescrito\n */\n?>\n";
    $content = $phpComment . $content;
    
    file_put_contents($destPath, $content);
    echo "   ✅ TODO JavaScript do n8n removido\n";
}

echo "\n✅ Processamento concluído!\n";
echo "🔥 JavaScript do n8n completamente removido\n";
echo "✅ Apenas nossos scripts personalizados serão carregados\n";
