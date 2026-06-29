#!/usr/bin/env php
<?php
/**
 * Adicionar Tailwind CSS em todas as views
 */

$viewsDir = __DIR__ . '/../app/Views/pages/';
$files = glob($viewsDir . '*_clean.php');

$tailwindScript = <<<'TAILWIND'
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-500': '#6C63FF',
                        'brand-50': 'rgba(108, 99, 255, 0.1)',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
TAILWIND;

echo "🎨 Adicionando Tailwind CSS em todas as views...\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    $content = file_get_contents($file);
    
    // Verificar se já tem Tailwind
    if (strpos($content, 'cdn.tailwindcss.com') !== false) {
        echo "⏭️  $filename - já tem Tailwind\n";
        continue;
    }
    
    // Adicionar Tailwind após Font Awesome
    $content = str_replace(
        '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">',
        '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">' . $tailwindScript,
        $content
    );
    
    file_put_contents($file, $content);
    echo "✅ $filename - Tailwind adicionado\n";
}

echo "\n✅ Tailwind CSS adicionado em todas as views!\n";
