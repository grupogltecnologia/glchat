-- Remover tabelas duplicadas com prefixo saas_
SET FOREIGN_KEY_CHECKS=0;

-- Remover tabelas com caracteres especiais
SET @tables = NULL;
SELECT GROUP_CONCAT(table_name) INTO @tables
FROM information_schema.tables 
WHERE table_schema = 'hublabel' 
AND table_name LIKE 'saas_%';

SET @tables = CONCAT('DROP TABLE IF EXISTS ', @tables);
PREPARE stmt FROM @tables;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET FOREIGN_KEY_CHECKS=1;

-- Verificar tabelas restantes
SHOW TABLES;
