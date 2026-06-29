#!/usr/bin/env php
<?php
/**
 * Criar tabelas essenciais simplificadas
 */

require_once __DIR__ . '/../app/Core/Database.php';

echo "🔧 Criando tabelas essenciais...\n\n";

try {
    $pdo = Database::pdo();
    
    // Desabilitar foreign key checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    
    // 1. Tabela de contas
    echo "📦 Criando tabela contas...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS contas (
            id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
            nome VARCHAR(255) NOT NULL,
            plano VARCHAR(50) DEFAULT 'free',
            status VARCHAR(50) DEFAULT 'ativo',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 2. Tabela de usuários
    echo "👤 Criando tabela usuarios...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            nome VARCHAR(255) NOT NULL,
            Email VARCHAR(255) UNIQUE NOT NULL,
            Senha VARCHAR(255) NOT NULL,
            funcao VARCHAR(50) DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 3. Tabela de contatos
    echo "📇 Criando tabela contatos...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS contatos (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            nome VARCHAR(255),
            telefone VARCHAR(50),
            email VARCHAR(255),
            etiquetas JSON,
            campos_personalizados JSON,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY unique_telefone_conta (contaId, telefone)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 4. Tabela de conexões
    echo "📱 Criando tabela conexoes...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS conexoes (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            nomeConexao VARCHAR(255),
            numeroConexao VARCHAR(50),
            instanceName VARCHAR(255),
            statusConexao VARCHAR(50) DEFAULT 'desconectado',
            apikey TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 5. Tabela de conversas
    echo "💬 Criando tabela conversas...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS conversas (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            nomeConversa VARCHAR(255),
            telefoneConversa VARCHAR(50),
            statusAtendimento VARCHAR(50) DEFAULT 'aberto',
            naoLida TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 6. Tabela de mensagens
    echo "✉️ Criando tabela mensagens...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS mensagens (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            conversaId BIGINT NOT NULL,
            tipo VARCHAR(50),
            conteudo TEXT,
            remetente VARCHAR(50),
            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 7. Tabela de disparos
    echo "📤 Criando tabela disparos...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS disparos (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            NomeDisparo VARCHAR(255),
            StatusDisparo VARCHAR(50) DEFAULT 'rascunho',
            TotalContatos INT DEFAULT 0,
            Enviados INT DEFAULT 0,
            Falhas INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 8. Tabela de agentes IA
    echo "🤖 Criando tabela agentes_ia...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS agentes_ia (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            nome VARCHAR(255),
            instrucoes TEXT,
            modelo VARCHAR(50) DEFAULT 'gpt-4',
            ativo TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 9. Tabela de quadros CRM
    echo "📊 Criando tabela crm_quadros...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS crm_quadros (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            nome VARCHAR(255),
            descricao TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 10. Tabela de etapas CRM
    echo "📋 Criando tabela crm_etapas...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS crm_etapas (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            quadroId BIGINT NOT NULL,
            nome VARCHAR(255),
            ordem INT DEFAULT 0,
            cor VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // Reabilitar foreign key checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    
    echo "\n✅ Tabelas criadas com sucesso!\n\n";
    
    // Listar tabelas
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "📊 Total de tabelas: " . count($tables) . "\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
