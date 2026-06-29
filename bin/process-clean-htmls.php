#!/usr/bin/env php
<?php
/**
 * Processar HTMLs limpos e criar views PHP funcionais
 * Baseado no PROMPT_WINDSURF_HTML_CSS_LIMPO.md
 */

$htmlLimpoDir = __DIR__ . '/../html_css_limpo/telas_html_css_limpo/';
$viewsDir = __DIR__ . '/../app/Views/pages/';

// Mapeamento dos arquivos HTML para as telas do sistema
$mapeamento = [
    '01_html1.html' => ['criar_campanha.php', 'Criar Nova Campanha'],
    '02_html2.html' => ['login_clean.php', 'Login'],
    '03_html4.html' => ['conexoes_clean.php', 'Conexões'],
    '04_html5.html' => ['disparos_clean.php', 'Disparos'],
    '05_html6.html' => ['disparos_grupos.php', 'Disparos em Grupos'],
    '06_html7.html' => ['dashboard_clean.php', 'Dashboard'],
    '07_html9.html' => ['contatos_clean.php', 'Contatos'],
    '08_html11.html' => ['detalhes_disparo.php', 'Detalhes do Disparo'],
    '09_html12.html' => ['configuracoes_clean.php', 'Configurações'],
    '10_html13.html' => ['admin_clean.php', 'Administração'],
    '11_html14.html' => ['cadastro.php', 'Criar Cadastro'],
    '12_html.html' => ['crm_clean.php', 'CRM'],
    '13_html3.html' => ['agentes_clean.php', 'Agentes IA'],
    '14_html15.html' => ['etapas_quadro.php', 'Etapas do Quadro'],
    '15_html16.html' => ['chat_clean.php', 'Chat'],
    '16_html17.html' => ['redefinir_senha.php', 'Redefinir Senha'],
    '17_html18.html' => ['acesso_bloqueado.php', 'Acesso Bloqueado'],
    '18_html19.html' => ['definir_super_admin.php', 'Definir Super Admin'],
    '19_html20.html' => ['ajuda.php', 'Ajuda'],
];

echo "🎨 Processando HTMLs limpos para views PHP...\n\n";

foreach ($mapeamento as $htmlFile => [$phpFile, $titulo]) {
    $sourcePath = $htmlLimpoDir . $htmlFile;
    $destPath = $viewsDir . $phpFile;
    
    if (!file_exists($sourcePath)) {
        echo "⚠️  Arquivo não encontrado: $htmlFile\n";
        continue;
    }
    
    echo "📄 $titulo ($htmlFile -> $phpFile)\n";
    
    $content = file_get_contents($sourcePath);
    
    // 1. Corrigir URLs do Supabase Storage para local
    $content = preg_replace(
        '/https:\/\/[a-z0-9]+\.supabase\.co\/storage\/v1\/object\/public\/arquivos\/([a-zA-Z0-9_-]+)/i',
        '/hublabel/public/assets/images/$1',
        $content
    );
    
    // 2. Corrigir URLs de navegação
    $content = str_replace('href="/', 'href="/hublabel/public/', $content);
    $content = str_replace('action="/', 'action="/hublabel/public/', $content);
    
    // 3. Adicionar comentário PHP no topo
    $phpComment = "<?php\n/**\n * $titulo - HTML/CSS limpo do n8n\n * JavaScript será adicionado separadamente\n */\n?>\n";
    $content = $phpComment . $content;
    
    // 4. Adicionar script de inicialização antes do </body>
    $pageName = str_replace('_clean.php', '', str_replace('.php', '', $phpFile));
    $initScript = <<<SCRIPT

<!-- JavaScript de inicialização -->
<script src="/hublabel/public/assets/js/pages/$pageName.js"></script>
</body>
SCRIPT;
    
    $content = str_replace('</body>', $initScript, $content);
    
    // 5. Salvar arquivo
    file_put_contents($destPath, $content);
    echo "   ✅ Criado\n";
}

echo "\n✅ Processamento concluído!\n";
echo "📁 Views criadas em: $viewsDir\n";
echo "\n📝 Próximos passos:\n";
echo "1. Criar JavaScripts em public/assets/js/pages/\n";
echo "2. Testar cada tela individualmente\n";
echo "3. Conectar com backend PHP/MySQL\n";
