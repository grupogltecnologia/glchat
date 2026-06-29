-- Criar tabela contas com ID sequencial (se não existir)
CREATE TABLE IF NOT EXISTS `contas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `telefone` VARCHAR(20),
  `plano` INT DEFAULT 1,
  `status` TINYINT(1) DEFAULT 1 COMMENT '1=ativo, 0=bloqueado',
  `dataValidade` DATE,
  `apikey_gpt` TEXT,
  `tokens` DECIMAL(18,2) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_email` (`email`),
  INDEX `idx_status` (`status`),
  INDEX `idx_plano` (`plano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Adicionar colunas que podem estar faltando (se não existirem)
ALTER TABLE contas 
ADD COLUMN IF NOT EXISTS `telefone` VARCHAR(20) AFTER `email`,
ADD COLUMN IF NOT EXISTS `apikey_gpt` TEXT AFTER `dataValidade`,
ADD COLUMN IF NOT EXISTS `tokens` DECIMAL(18,2) DEFAULT 0 AFTER `apikey_gpt`,
ADD COLUMN IF NOT EXISTS `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

-- Migrar dados da SAAS_Contas se existir
INSERT INTO contas (nome, email, telefone, plano, status, dataValidade, apikey_gpt, tokens, created_at)
SELECT 
    COALESCE(nome, 'Cliente') as nome,
    COALESCE(email, CONCAT('cliente_', id, '@temp.com')) as email,
    telefone,
    COALESCE(plano, 1) as plano,
    COALESCE(status, 1) as status,
    dataValidade,
    apikey_gpt,
    COALESCE(tokens, 0) as tokens,
    created_at
FROM SAAS_Contas
WHERE id IS NOT NULL
ON DUPLICATE KEY UPDATE id=id;

SELECT 'Tabela contas criada com sucesso!' as status;
