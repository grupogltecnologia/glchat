#!/usr/bin/env php
<?php
/**
 * Extrair HTML/CSS original e substituir apenas o JavaScript
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

echo "🎨 Mantendo HTML/CSS original, substituindo apenas JavaScript...\n\n";

foreach ($files as $htmlFile => $phpFile) {
    $sourcePath = $htmlDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Arquivo não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 Processando: $htmlFile -> $phpFile\n";
    
    $content = file_get_contents($sourcePath);
    
    // 1. Remover todo o conteúdo entre <script type="module"> e </script>
    $content = preg_replace(
        '/<script\s+type=["\']module["\']\s*>.*?<\/script>/s',
        '<script type="module">
        // JavaScript original removido - usando versão simplificada
        console.log("✅ Página carregada - JavaScript do n8n removido");
        </script>',
        $content
    );
    
    // 2. Adicionar script de compatibilidade antes do </body>
    $compatScript = '<script src="/hublabel/public/assets/js/app.js"></script>';
    $content = str_replace('</body>', "$compatScript\n</body>", $content);
    
    // 3. Corrigir URLs
    $content = str_replace('https://app.chatconversa.app.br', '/hublabel/public', $content);
    $content = str_replace('http://app.chatconversa.app.br', '/hublabel/public', $content);
    
    // 4. Adicionar comentário PHP no topo
    $phpComment = "<?php\n/**\n * HTML/CSS Original do n8n - JavaScript adaptado para PHP/MySQL\n */\n?>\n";
    $content = $phpComment . $content;
    
    file_put_contents($destPath, $content);
    echo "   ✅ HTML/CSS mantido, JavaScript substituído\n";
}

echo "\n✅ Processamento concluído!\n";
echo "📝 Agora crie o arquivo app.js com o JavaScript necessário\n";
