#!/usr/bin/env php
<?php
/**
 * SOLUÇÃO FINAL: Limpar completamente e usar apenas HTML/CSS básico
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

echo "🧹 LIMPEZA COMPLETA E FINAL...\n\n";

foreach ($files as $htmlFile => $phpFile) {
    $sourcePath = $htmlDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Arquivo não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 Processando: $htmlFile -> $phpFile\n";
    
    $content = file_get_contents($sourcePath);
    
    // 1. Remover TODOS os <script> tags (mantendo apenas CDNs essenciais)
    $content = preg_replace('/<script\s+type=["\']module["\'][^>]*>.*?<\/script>/s', '', $content);
    
    // 2. Remover links de favicon quebrados
    $content = preg_replace('/<link[^>]*rel=["\'](?:icon|shortcut icon|apple-touch-icon)["\'][^>]*>/i', '', $content);
    
    // 3. Remover imports
    $content = preg_replace('/import\s+.*?;/s', '', $content);
    
    // 4. Corrigir URLs do Supabase
    $content = preg_replace(
        '/https:\/\/[a-z0-9]+\.supabase\.co\/storage\/v1\/object\/public\/[^"\']+/i',
        '/hublabel/public/assets/images/placeholder.png',
        $content
    );
    
    // 5. Corrigir URLs de navegação
    $content = str_replace('https://app.chatconversa.app.br', '/hublabel/public', $content);
    $content = str_replace('http://app.chatconversa.app.br', '/hublabel/public', $content);
    
    // 6. Adicionar nosso script ANTES do </body>
    $pageName = str_replace('_clean.php', '', $phpFile);
    $newScript = <<<SCRIPT

<!-- HUBLABEL - JavaScript Limpo -->
<script src="/hublabel/public/assets/js/pages/{$pageName}.js"></script>
</body>
SCRIPT;
    
    $content = str_replace('</body>', $newScript, $content);
    
    // 7. Comentário PHP
    $phpComment = "<?php\n/**\n * HUBLABEL - Visual original, JavaScript limpo\n */\n?>\n";
    $content = $phpComment . $content;
    
    file_put_contents($destPath, $content);
    echo "   ✅ Limpo e otimizado\n";
}

echo "\n✅ LIMPEZA COMPLETA!\n";
echo "🎯 Agora deve funcionar sem erros\n";
