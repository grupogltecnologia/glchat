#!/usr/bin/env php
<?php
/**
 * Criar tabelas para painel de Administração
 */

require_once __DIR__ . '/../app/Core/Database.php';

echo "🔧 Criando tabelas do painel de Administração...\n\n";

try {
    $pdo = Database::pdo();
    
    // 1. Tabela de planos
    echo "📋 Criando tabela planos...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS planos (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            descricao TEXT,
            preco DECIMAL(10,2) DEFAULT 0.00,
            periodo VARCHAR(50) DEFAULT 'mensal',
            limite_usuarios INT DEFAULT 1,
            limite_conexoes INT DEFAULT 1,
            limite_contatos INT DEFAULT 1000,
            limite_disparos INT DEFAULT 1000,
            recursos JSON,
            ativo TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 2. Tabela de assinaturas (relaciona conta com plano)
    echo "💳 Criando tabela assinaturas...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS assinaturas (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            planoId BIGINT NOT NULL,
            status VARCHAR(50) DEFAULT 'ativo',
            data_inicio DATE,
            data_fim DATE,
            renovacao_automatica TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 3. Tabela de transações/pagamentos
    echo "💰 Criando tabela transacoes...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS transacoes (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            contaId CHAR(36) NOT NULL,
            assinaturaId BIGINT,
            valor DECIMAL(10,2) NOT NULL,
            status VARCHAR(50) DEFAULT 'pendente',
            metodo_pagamento VARCHAR(50),
            gateway_transacao_id VARCHAR(255),
            data_pagamento TIMESTAMP NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 4. Tabela de configurações do sistema
    echo "⚙️ Criando tabela configuracoes_sistema...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS configuracoes_sistema (
            id INT PRIMARY KEY DEFAULT 1,
            nome_sistema VARCHAR(255) DEFAULT 'HUBLABEL',
            logo_url TEXT,
            cor_primaria VARCHAR(7) DEFAULT '#6C63FF',
            favicon_url TEXT,
            smtp_host VARCHAR(255),
            smtp_port INT DEFAULT 587,
            smtp_user VARCHAR(255),
            smtp_password VARCHAR(255),
            smtp_from_email VARCHAR(255),
            smtp_from_name VARCHAR(255),
            webhook_pagamento_url TEXT,
            pagina_vendas_url TEXT,
            videos_tutoriais JSON,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 5. Tabela de templates de email
    echo "📧 Criando tabela email_templates...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS email_templates (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            tipo VARCHAR(50) NOT NULL,
            assunto VARCHAR(255) NOT NULL,
            corpo_html TEXT,
            corpo_texto TEXT,
            variaveis JSON,
            ativo TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY unique_tipo (tipo)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 6. Tabela de webhooks/integrações
    echo "🔗 Criando tabela webhooks...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS webhooks (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            url TEXT NOT NULL,
            tipo VARCHAR(50),
            ativo TINYINT(1) DEFAULT 1,
            secret_key VARCHAR(255),
            eventos JSON,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // 7. Tabela de logs de atividades (auditoria)
    echo "📝 Criando tabela logs_atividades...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS logs_atividades (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            usuarioId BIGINT,
            contaId CHAR(36),
            acao VARCHAR(255) NOT NULL,
            descricao TEXT,
            ip VARCHAR(50),
            user_agent TEXT,
            dados_extras JSON,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_conta (contaId),
            INDEX idx_usuario (usuarioId),
            INDEX idx_data (created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    echo "\n✅ Tabelas do painel de Administração criadas!\n\n";
    
    // Inserir configuração padrão
    echo "⚙️ Inserindo configuração padrão do sistema...\n";
    $pdo->exec("
        INSERT INTO configuracoes_sistema (id, nome_sistema, cor_primaria)
        VALUES (1, 'HUBLABEL', '#6C63FF')
        ON DUPLICATE KEY UPDATE nome_sistema = nome_sistema
    ");
    
    // Inserir planos padrão
    echo "📋 Inserindo planos padrão...\n";
    $stmt = $pdo->prepare("
        INSERT INTO planos (nome, descricao, preco, periodo, limite_usuarios, limite_conexoes, limite_contatos, limite_disparos, recursos)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nome = VALUES(nome)
    ");
    
    $planos = [
        [
            'Free',
            'Plano gratuito para teste',
            0.00,
            'mensal',
            1,
            1,
            100,
            100,
            json_encode(['chat' => true, 'agentes_ia' => false, 'crm' => false])
        ],
        [
            'Básico',
            'Plano básico para pequenas empresas',
            97.00,
            'mensal',
            3,
            2,
            1000,
            1000,
            json_encode(['chat' => true, 'agentes_ia' => true, 'crm' => false])
        ],
        [
            'Pro',
            'Plano profissional completo',
            197.00,
            'mensal',
            10,
            5,
            10000,
            10000,
            json_encode(['chat' => true, 'agentes_ia' => true, 'crm' => true])
        ],
        [
            'Enterprise',
            'Plano empresarial ilimitado',
            497.00,
            'mensal',
            -1,
            -1,
            -1,
            -1,
            json_encode(['chat' => true, 'agentes_ia' => true, 'crm' => true, 'api' => true])
        ]
    ];
    
    foreach ($planos as $plano) {
        $stmt->execute($plano);
        echo "   ✅ Plano: {$plano[0]}\n";
    }
    
    // Inserir templates de email padrão
    echo "\n📧 Inserindo templates de email padrão...\n";
    $stmt = $pdo->prepare("
        INSERT INTO email_templates (tipo, assunto, corpo_html, variaveis)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE assunto = VALUES(assunto)
    ");
    
    $templates = [
        [
            'novo_usuario',
            'Bem-vindo ao {{nome_sistema}}!',
            '<h1>Olá {{nome_usuario}}!</h1><p>Sua conta foi criada com sucesso.</p>',
            json_encode(['nome_usuario', 'nome_sistema', 'email', 'senha_temporaria'])
        ],
        [
            'redefinir_senha',
            'Redefinir sua senha - {{nome_sistema}}',
            '<h1>Redefinir Senha</h1><p>Clique no link para redefinir: {{link_redefinir}}</p>',
            json_encode(['nome_usuario', 'link_redefinir', 'nome_sistema'])
        ]
    ];
    
    foreach ($templates as $template) {
        $stmt->execute($template);
        echo "   ✅ Template: {$template[0]}\n";
    }
    
    echo "\n🎉 Painel de Administração configurado com sucesso!\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
