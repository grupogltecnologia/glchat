-- Criar tabela de configurações de WhatsApp API
CREATE TABLE IF NOT EXISTS `whatsapp_config` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `provider` ENUM('evolution', 'uazapi') NOT NULL DEFAULT 'evolution' COMMENT 'Provedor da API',
  `api_url` VARCHAR(500) NOT NULL COMMENT 'URL base da API',
  `api_key` VARCHAR(500) NOT NULL COMMENT 'Chave de API',
  `api_token` VARCHAR(500) COMMENT 'Token adicional (se necessário)',
  `webhook_url` VARCHAR(500) COMMENT 'URL do webhook',
  `ativo` TINYINT(1) DEFAULT 1 COMMENT '1=ativo, 0=inativo',
  `configuracoes_extras` JSON COMMENT 'Configurações adicionais específicas do provedor',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_provider` (`provider`),
  INDEX `idx_ativo` (`ativo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir configuração padrão Evolution API (se não existir)
INSERT INTO whatsapp_config (provider, api_url, api_key, ativo)
SELECT 'evolution', 'https://sua-evolution.com', 'sua-api-key', 1
WHERE NOT EXISTS (SELECT 1 FROM whatsapp_config WHERE provider = 'evolution');

SELECT 'Tabela whatsapp_config criada com sucesso!' as status;
