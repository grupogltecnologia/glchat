-- Atualizar tabela usuarios para usar contaId INT

-- Primeiro, adicionar coluna temporária
ALTER TABLE usuarios ADD COLUMN contaId_new INT AFTER id;

-- Criar índice
ALTER TABLE usuarios ADD INDEX `idx_contaId` (`contaId_new`);

-- Remover coluna antiga (se existir como CHAR)
ALTER TABLE usuarios DROP COLUMN IF EXISTS contaId;

-- Renomear coluna nova
ALTER TABLE usuarios CHANGE COLUMN contaId_new contaId INT;

SELECT 'Tabela usuarios atualizada com sucesso!' as status;
