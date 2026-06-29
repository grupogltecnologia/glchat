#!/usr/bin/env php
<?php
/**
 * Criar JavaScripts básicos para as páginas restantes
 */

$pagesDir = __DIR__ . '/../public/assets/js/pages/';

$pages = [
    'contatos' => 'Contatos',
    'conexoes' => 'Conexões',
    'disparos' => 'Disparos',
    'agentes' => 'Agentes IA',
    'crm' => 'CRM',
    'configuracoes' => 'Configurações',
    'admin' => 'Administração',
];

$template = function($pageName) {
    return <<<JS
/**
 * $pageName - JavaScript reescrito para PHP/MySQL
 * Baseado na lógica original do n8n
 */

document.addEventListener('DOMContentLoaded', async () => {
    console.log('✅ $pageName page loaded');
    
    // Carregar dados iniciais
    await loadPageData();
});

async function loadPageData() {
    try {
        // TODO: Implementar carregamento de dados específicos
        console.log('Carregando dados de $pageName...');
    } catch (error) {
        console.error('Erro ao carregar dados:', error);
    }
}
JS;
};

echo "📝 Criando JavaScripts básicos...\n\n";

foreach ($pages as $filename => $pageName) {
    $filepath = $pagesDir . $filename . '.js';
    $content = $template($pageName);
    file_put_contents($filepath, $content);
    echo "✅ Criado: {$filename}.js\n";
}

echo "\n✅ Todos os JavaScripts criados!\n";
