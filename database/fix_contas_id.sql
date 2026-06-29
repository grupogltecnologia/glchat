-- Desabilitar verificação de chaves estrangeiras
SET FOREIGN_KEY_CHECKS=0;

-- Dropar foreign keys
ALTER TABLE campos_personalizados DROP FOREIGN KEY IF EXISTS campos_personalizados_ibfk_1;
ALTER TABLE contatos_etiquetas DROP FOREIGN KEY IF EXISTS contatos_etiquetas_ibfk_3;
ALTER TABLE etapas_quadros DROP FOREIGN KEY IF EXISTS etapas_quadros_ibfk_1;
ALTER TABLE etiquetas DROP FOREIGN KEY IF EXISTS etiquetas_ibfk_1;
ALTER TABLE respostas_rapidas DROP FOREIGN KEY IF EXISTS respostas_rapidas_ibfk_1;
ALTER TABLE valores_campos_personalizados DROP FOREIGN KEY IF EXISTS valores_campos_personalizados_ibfk_3;
ALTER TABLE webhook DROP FOREIGN KEY IF EXISTS webhook_ibfk_1;

-- Alterar ID da tabela contas para INT AUTO_INCREMENT
ALTER TABLE contas MODIFY COLUMN id INT AUTO_INCREMENT;

-- Alterar contaId nas tabelas relacionadas para INT
ALTER TABLE usuarios MODIFY COLUMN contaId INT;
ALTER TABLE campos_personalizados MODIFY COLUMN contaId INT;
ALTER TABLE contatos_etiquetas MODIFY COLUMN contaId INT;
ALTER TABLE etapas_quadros MODIFY COLUMN contaId INT;
ALTER TABLE etiquetas MODIFY COLUMN contaId INT;
ALTER TABLE respostas_rapidas MODIFY COLUMN contaId INT;
ALTER TABLE valores_campos_personalizados MODIFY COLUMN contaId INT;
ALTER TABLE webhook MODIFY COLUMN contaId INT;

-- Reabilitar verificação de chaves estrangeiras
SET FOREIGN_KEY_CHECKS=1;

SELECT 'Tabela contas atualizada para usar ID sequencial!' as status;
