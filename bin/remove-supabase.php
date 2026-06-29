#!/usr/bin/env php
<?php
/**
 * Script para remover Supabase dos HTMLs e adaptar para PHP/MySQL
 */

$htmlDir = __DIR__ . '/../storage/extracted_html/';
$viewsDir = __DIR__ . '/../app/Views/pages/';

// Garantir que o diretório de views existe
if (!is_dir($viewsDir)) {
    mkdir($viewsDir, 0755, true);
}

// Lista de arquivos HTML para processar
$files = [
    '02_login_ia_chatconversa.html' => 'login.php',
    '06_dashboard_ia_chatconversa.html' => 'dashboard.php',
    '15_chat_ia_chatconversa.html' => 'chat.php',
    '07_contatos_ia_chatconversa.html' => 'contatos.php',
    '03_conex_es_ia_chatconversa.html' => 'conexoes.php',
    '05_disparos_ia_chatconversa.html' => 'disparos.php',
    '13_agente_ia_ia_chatconversa.html' => 'agentes.php',
    '12_crm_ia_chatconversa.html' => 'crm.php',
    '09_configura_es_ia_chatconversa.html' => 'configuracoes.php',
    '10_administra_o_ia_chatconversa.html' => 'admin.php',
];

echo "🔧 Processando HTMLs do n8n...\n\n";

foreach ($files as $htmlFile => $phpFile) {
    $sourcePath = $htmlDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Arquivo não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 Processando: $htmlFile -> $phpFile\n";
    
    $content = file_get_contents($sourcePath);
    
    // 1. Remover imports do Supabase
    $content = preg_replace(
        '/import\s+{[^}]+}\s+from\s+[\'"]https:\/\/cdn\.jsdelivr\.net\/npm\/@supabase\/supabase-js[^\'"]+[\'"];?/s',
        '// Supabase removido - usando PHP/MySQL',
        $content
    );
    
    // 2. Remover configuração do Supabase
    $content = preg_replace(
        '/const\s+SUPABASE_URL\s*=\s*[\'"][^\'"]+[\'"];?/s',
        '// Supabase URL removido',
        $content
    );
    
    $content = preg_replace(
        '/const\s+SUPABASE_ANON_KEY\s*=\s*[\'"][^\'"]+[\'"];?/s',
        '// Supabase Key removido',
        $content
    );
    
    // 3. Remover função initSupabase
    $content = preg_replace(
        '/function\s+initSupabase\s*\([^)]*\)\s*{[^}]*}/s',
        '// initSupabase removido',
        $content
    );
    
    // 4. Remover criação do cliente Supabase
    $content = preg_replace(
        '/const\s+supabase\s*=\s*(?:initSupabase\(\)|createClient\([^)]+\));?/s',
        '// Cliente Supabase removido',
        $content
    );
    
    $content = preg_replace(
        '/window\.supabase\s*=\s*createClient\([^)]+\);?/s',
        '// window.supabase removido',
        $content
    );
    
    // 5. Substituir URLs do Supabase Storage por URLs locais
    $content = preg_replace(
        '/https:\/\/[a-z0-9]+\.supabase\.co\/storage\/v1\/object\/public\/arquivos\/([a-zA-Z0-9_-]+)/i',
        '/hublabel/public/assets/images/$1',
        $content
    );
    
    // 6. Adicionar comentário no topo
    $comment = "<?php\n/**\n * Adaptado do n8n para PHP/MySQL\n * Supabase removido - usando backend PHP\n */\n?>\n";
    
    if (strpos($content, '<!DOCTYPE') === 0) {
        $content = $comment . $content;
    }
    
    // 7. Salvar arquivo processado
    file_put_contents($destPath, $content);
    
    echo "   ✅ Salvo em: $phpFile\n";
}

echo "\n✅ Processamento concluído!\n";
echo "📁 Arquivos salvos em: $viewsDir\n";
