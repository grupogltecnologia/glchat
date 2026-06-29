-- Adicionar coluna plano_cadastro na tabela planos
-- Esta coluna indica qual plano será usado para novos cadastros públicos

ALTER TABLE planos 
ADD COLUMN plano_cadastro TINYINT(1) DEFAULT 0 
COMMENT 'Se 1, este plano será usado automaticamente para novos cadastros';

-- Definir o plano Free como padrão para cadastros
UPDATE planos SET plano_cadastro = 1 WHERE id = 1;

-- Garantir que apenas um plano seja marcado como padrão
-- (caso queira mudar, primeiro desmarque todos e depois marque o desejado)

SELECT 'Coluna plano_cadastro adicionada com sucesso!' as status;
