-- Mudar IDs de UUID para sequencial numérico
SET FOREIGN_KEY_CHECKS=0;

-- Alterar tabela contas
ALTER TABLE contas 
    DROP PRIMARY KEY,
    MODIFY COLUMN id BIGINT AUTO_INCREMENT,
    ADD PRIMARY KEY (id);

-- Alterar tabela usuarios para usar BIGINT
ALTER TABLE usuarios
    MODIFY COLUMN contaId BIGINT NULL;

-- Alterar outras tabelas que referenciam contas
ALTER TABLE campos_personalizados MODIFY COLUMN contaId BIGINT NOT NULL;
ALTER TABLE valores_campos_personalizados MODIFY COLUMN contaId BIGINT NOT NULL;
ALTER TABLE contatos MODIFY COLUMN contaId BIGINT NOT NULL;
ALTER TABLE contatos_etiquetas MODIFY COLUMN contaId BIGINT NOT NULL;
ALTER TABLE conversas MODIFY COLUMN contaId BIGINT NULL;
ALTER TABLE conversas MODIFY COLUMN atendente BIGINT NULL;
ALTER TABLE mensagens MODIFY COLUMN contaId BIGINT NULL;
ALTER TABLE disparos MODIFY COLUMN contaId BIGINT NULL;
ALTER TABLE etiquetas MODIFY COLUMN contaId BIGINT NOT NULL;
ALTER TABLE etapas_quadros MODIFY COLUMN contaId BIGINT NULL;
ALTER TABLE respostas_rapidas MODIFY COLUMN contaId BIGINT NULL;
ALTER TABLE webhook MODIFY COLUMN contaId BIGINT NULL;
ALTER TABLE agentes_ia MODIFY COLUMN contaId BIGINT NULL;
ALTER TABLE conexoes MODIFY COLUMN contaId BIGINT NULL;

-- Alterar usuarios.id também
ALTER TABLE usuarios
    DROP PRIMARY KEY,
    MODIFY COLUMN id BIGINT AUTO_INCREMENT,
    ADD PRIMARY KEY (id);

ALTER TABLE usuarios MODIFY COLUMN auth_user_id BIGINT NULL;

SET FOREIGN_KEY_CHECKS=1;

SELECT 'IDs alterados para sequencial!' as status;
