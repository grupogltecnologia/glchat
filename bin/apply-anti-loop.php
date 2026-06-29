#!/usr/bin/env php
<?php
/**
 * Solução definitiva: Manter HTML/CSS original e adicionar script que desabilita loops
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

// Script que desabilita loops e redireciona funções problemáticas
$antiLoopScript = <<<'SCRIPT'
<script>
// DESABILITAR LOOPS - Executar ANTES de qualquer outro script
(function() {
    console.log('🛡️ Anti-loop ativado');
    
    // Desabilitar checkExistingLogin
    window.checkExistingLogin = async function() {
        console.log('⏭️ checkExistingLogin desabilitado');
        return false;
    };
    
    // Interceptar window.location para evitar loops
    let redirectCount = 0;
    const originalLocation = window.location;
    
    Object.defineProperty(window, 'location', {
        get: function() {
            return originalLocation;
        },
        set: function(url) {
            redirectCount++;
            if (redirectCount > 3) {
                console.error('🚫 Loop de redirecionamento detectado e bloqueado!');
                return;
            }
            originalLocation.href = url;
        }
    });
    
    console.log('✅ Proteção anti-loop ativada');
})();
</script>
SCRIPT;

echo "🛡️ Aplicando proteção anti-loop...\n\n";

foreach ($files as $htmlFile => $phpFile) {
    $sourcePath = $htmlDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Arquivo não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 Processando: $htmlFile -> $phpFile\n";
    
    $content = file_get_contents($sourcePath);
    
    // 1. Adicionar script anti-loop LOGO APÓS <head>
    $content = preg_replace('/<head>/i', "<head>\n$antiLoopScript", $content);
    
    // 2. Corrigir URLs
    $content = preg_replace(
        '/https:\/\/[a-z0-9]+\.supabase\.co\/storage\/v1\/object\/public\/arquivos\/([a-zA-Z0-9_-]+)/i',
        '/hublabel/public/assets/images/$1',
        $content
    );
    
    $content = str_replace('https://app.chatconversa.app.br', '/hublabel/public', $content);
    $content = str_replace('http://app.chatconversa.app.br', '/hublabel/public', $content);
    
    // 3. Adicionar script de lógica personalizada ANTES do </body>
    $pageName = str_replace('_clean.php', '', $phpFile);
    $scriptTag = "<script src=\"/hublabel/public/assets/js/pages/{$pageName}.js\"></script>\n</body>";
    $content = str_replace('</body>', $scriptTag, $content);
    
    // 4. Comentário PHP
    $phpComment = "<?php\n/**\n * Visual original do n8n com proteção anti-loop\n */\n?>\n";
    $content = $phpComment . $content;
    
    file_put_contents($destPath, $content);
    echo "   ✅ Proteção anti-loop aplicada\n";
}

echo "\n✅ Processamento concluído!\n";
echo "🛡️ Todas as páginas protegidas contra loops\n";
