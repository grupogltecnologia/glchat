-- Criar tabela de configurações do sistema
CREATE TABLE IF NOT EXISTS configuracoes_sistema (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chave VARCHAR(100) UNIQUE NOT NULL,
    valor TEXT,
    descricao TEXT,
    tipo ENUM('texto', 'numero', 'boolean', 'json') DEFAULT 'texto',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir configuração de dias de teste
INSERT INTO configuracoes_sistema (chave, valor, descricao, tipo) VALUES
('dias_teste_cadastro', '30', 'Número de dias de teste para novos cadastros públicos', 'numero')
ON DUPLICATE KEY UPDATE valor = valor;

SELECT 'Tabela configuracoes_sistema criada com sucesso!' as status;
