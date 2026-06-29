#!/usr/bin/env php
<?php
/**
 * Executar schema SQL para criar tabelas
 */

require_once __DIR__ . '/../app/Core/Database.php';

echo "🔧 Criando tabelas no banco de dados...\n\n";

try {
    $pdo = Database::pdo();
    
    // Ler arquivo SQL
    $sql = file_get_contents(__DIR__ . '/../database/schema_mysql.sql');
    
    if (!$sql) {
        echo "❌ Erro ao ler arquivo schema_mysql.sql\n";
        exit(1);
    }
    
    // Executar SQL
    $pdo->exec($sql);
    
    echo "✅ Tabelas criadas com sucesso!\n\n";
    
    // Listar tabelas criadas
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "📊 Tabelas criadas (" . count($tables) . "):\n";
    foreach ($tables as $table) {
        echo "   ✅ $table\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
