#!/usr/bin/env php
<?php
/**
 * Reprocessar HTMLs limpos SEM cortar o conteúdo
 */

$htmlLimpoDir = __DIR__ . '/../html_css_limpo/telas_html_css_limpo/';
$viewsDir = __DIR__ . '/../app/Views/pages/';

// Mapeamento principal
$mapeamento = [
    '02_html2.html' => 'login_clean.php',
    '06_html7.html' => 'dashboard_clean.php',
    '15_html16.html' => 'chat_clean.php',
    '07_html9.html' => 'contatos_clean.php',
    '03_html4.html' => 'conexoes_clean.php',
    '04_html5.html' => 'disparos_clean.php',
    '13_html3.html' => 'agentes_clean.php',
    '12_html.html' => 'crm_clean.php',
    '09_html12.html' => 'configuracoes_clean.php',
    '10_html13.html' => 'admin_clean.php',
];

echo "🔧 Reprocessando HTMLs limpos (conteúdo completo)...\n\n";

foreach ($mapeamento as $htmlFile => $phpFile) {
    $sourcePath = $htmlLimpoDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 $phpFile\n";
    
    // Ler arquivo COMPLETO
    $content = file_get_contents($sourcePath);
    
    // Apenas corrigir URLs duplicadas
    $content = str_replace('/hublabel/public/hublabel/public/', '/hublabel/public/', $content);
    
    // Adicionar comentário PHP
    $phpComment = "<?php\n/**\n * HTML/CSS original do n8n (limpo)\n */\n?>\n";
    
    // Se não tem PHP no início, adicionar
    if (strpos($content, '<?php') !== 0) {
        $content = $phpComment . $content;
    }
    
    // Salvar
    file_put_contents($destPath, $content);
    echo "   ✅ " . number_format(strlen($content)) . " bytes\n";
}

echo "\n✅ Reprocessamento concluído!\n";
