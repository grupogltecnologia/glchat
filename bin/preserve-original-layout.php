#!/usr/bin/env php
<?php
/**
 * SOLUÇÃO CORRETA: Manter HTML/CSS original, bloquear APENAS funções problemáticas
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

// Script que bloqueia APENAS as funções problemáticas
$blockScript = <<<'SCRIPT'
<script>
// BLOQUEAR APENAS FUNÇÕES PROBLEMÁTICAS - Executar ANTES de tudo
(function() {
    console.log('🛡️ Proteção anti-loop ativada');
    
    // 1. Desabilitar checkExistingLogin (causa loop)
    window.checkExistingLogin = async function() {
        console.log('⏭️ checkExistingLogin bloqueado');
        return false;
    };
    
    // 2. Bloquear redirecionamentos automáticos excessivos
    let redirectCount = 0;
    const originalLocationSetter = Object.getOwnPropertyDescriptor(window, 'location').set;
    
    Object.defineProperty(window, 'location', {
        set: function(url) {
            redirectCount++;
            if (redirectCount > 3) {
                console.error('🚫 Loop de redirecionamento bloqueado!');
                return;
            }
            originalLocationSetter.call(window, url);
        },
        get: function() {
            return window.location;
        }
    });
    
    // 3. Substituir createClient do Supabase por mock
    if (typeof window.supabase === 'undefined') {
        window.supabase = {
            createClient: function() {
                console.log('⏭️ Supabase.createClient bloqueado - usando PHP backend');
                return {
                    auth: {
                        getSession: async () => ({ data: { session: null }, error: null }),
                        getUser: async () => ({ data: { user: null }, error: null }),
                        signOut: async () => { window.location.href = '/hublabel/public/logout'; }
                    }
                };
            }
        };
    }
    
    console.log('✅ Proteção aplicada - HTML/CSS original mantido');
})();
</script>
SCRIPT;

echo "🎨 Mantendo HTML/CSS original + bloqueio de funções problemáticas...\n\n";

foreach ($files as $htmlFile => $phpFile) {
    $sourcePath = $htmlDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Arquivo não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 Processando: $htmlFile -> $phpFile\n";
    
    $content = file_get_contents($sourcePath);
    
    // 1. Adicionar script de bloqueio LOGO APÓS <head>
    $content = preg_replace('/<head>/i', "<head>\n$blockScript", $content);
    
    // 2. Corrigir URLs do Supabase Storage
    $content = preg_replace(
        '/https:\/\/[a-z0-9]+\.supabase\.co\/storage\/v1\/object\/public\/arquivos\/([a-zA-Z0-9_-]+)/i',
        '/hublabel/public/assets/images/$1',
        $content
    );
    
    // 3. Corrigir URLs de navegação
    $content = str_replace('https://app.chatconversa.app.br', '/hublabel/public', $content);
    $content = str_replace('http://app.chatconversa.app.br', '/hublabel/public', $content);
    
    // 4. Adicionar comentário PHP
    $phpComment = "<?php\n/**\n * HTML/CSS original do n8n - Funções problemáticas bloqueadas\n */\n?>\n";
    $content = $phpComment . $content;
    
    file_put_contents($destPath, $content);
    echo "   ✅ HTML/CSS mantido, apenas funções problemáticas bloqueadas\n";
}

echo "\n✅ Processamento concluído!\n";
echo "🎨 Visual 100% original do n8n preservado\n";
echo "🛡️ Apenas funções que causam loop foram bloqueadas\n";
