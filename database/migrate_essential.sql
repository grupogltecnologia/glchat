-- Migração Essencial - Apenas campos críticos para funcionamento
-- Executar com cuidado

SET FOREIGN_KEY_CHECKS=0;

-- ==================== CONTAS ====================
-- Já foi ajustada anteriormente

-- ==================== USUARIOS ====================
ALTER TABLE usuarios 
    ADD COLUMN IF NOT EXISTS auth_user_id CHAR(36) NULL AFTER Email,
    ADD COLUMN IF NOT EXISTS super_admin TINYINT(1) NOT NULL DEFAULT 0 AFTER funcao;

-- ==================== PLANOS ====================
ALTER TABLE planos
    ADD COLUMN IF NOT EXISTS qntConexoes BIGINT NULL AFTER preco,
    ADD COLUMN IF NOT EXISTS qntContatos BIGINT NULL AFTER qntConexoes,
    ADD COLUMN IF NOT EXISTS qntDisparos BIGINT NULL AFTER qntContatos,
    ADD COLUMN IF NOT EXISTS qntQuadros BIGINT NULL AFTER qntDisparos,
    ADD COLUMN IF NOT EXISTS qntAgentesIa BIGINT NULL AFTER qntQuadros,
    ADD COLUMN IF NOT EXISTS qntCreditosIa BIGINT NULL AFTER qntAgentesIa,
    ADD COLUMN IF NOT EXISTS menu_ocultar JSON NULL AFTER qntCreditosIa,
    ADD COLUMN IF NOT EXISTS qntUsuarios BIGINT NULL AFTER menu_ocultar;

-- ==================== AGENTES_IA ====================
ALTER TABLE agentes_ia
    ADD COLUMN IF NOT EXISTS conexaoId BIGINT NULL AFTER nome,
    ADD COLUMN IF NOT EXISTS criatividade DECIMAL(3,2) NULL AFTER modelo,
    ADD COLUMN IF NOT EXISTS maxCreditos BIGINT NULL AFTER criatividade,
    ADD COLUMN IF NOT EXISTS conhecimento JSON NULL AFTER ativo,
    ADD COLUMN IF NOT EXISTS cor TEXT NULL AFTER conhecimento;

-- ==================== CONEXOES ====================
ALTER TABLE conexoes
    ADD COLUMN IF NOT EXISTS instanceName TEXT NULL AFTER created_at,
    ADD COLUMN IF NOT EXISTS NomeConexao TEXT NULL AFTER instanceName,
    ADD COLUMN IF NOT EXISTS Telefone TEXT NULL AFTER NomeConexao,
    ADD COLUMN IF NOT EXISTS FotoPerfil TEXT NULL AFTER Telefone,
    ADD COLUMN IF NOT EXISTS Apikey TEXT NULL AFTER FotoPerfil,
    ADD COLUMN IF NOT EXISTS contaId CHAR(36) NULL AFTER Apikey,
    ADD COLUMN IF NOT EXISTS idAgente BIGINT NULL AFTER contaId;

-- ==================== CONTATOS ====================
ALTER TABLE contatos
    ADD COLUMN IF NOT EXISTS idLista BIGINT NULL AFTER telefone,
    ADD COLUMN IF NOT EXISTS variaveis JSON NULL AFTER idLista,
    ADD COLUMN IF NOT EXISTS tipo VARCHAR(20) NOT NULL DEFAULT 'contato' AFTER variaveis,
    ADD COLUMN IF NOT EXISTS lid TEXT NULL AFTER tipo,
    ADD COLUMN IF NOT EXISTS fotoPerfil TEXT NULL AFTER lid;

-- ==================== ETIQUETAS ====================
ALTER TABLE etiquetas
    ADD COLUMN IF NOT EXISTS cor TEXT NULL AFTER descricao;

-- ==================== CONVERSAS ====================
ALTER TABLE conversas
    ADD COLUMN IF NOT EXISTS idAgente BIGINT NULL AFTER id,
    ADD COLUMN IF NOT EXISTS idConexao BIGINT NULL AFTER idAgente,
    ADD COLUMN IF NOT EXISTS telefone TEXT NULL AFTER idConexao,
    ADD COLUMN IF NOT EXISTS pausado TINYINT(1) NULL AFTER telefone,
    ADD COLUMN IF NOT EXISTS contatoId BIGINT NULL AFTER contaId,
    ADD COLUMN IF NOT EXISTS lida TINYINT(1) NOT NULL DEFAULT 0 AFTER contatoId,
    ADD COLUMN IF NOT EXISTS fotoPerfil TEXT NULL AFTER nomeConversa,
    ADD COLUMN IF NOT EXISTS atendente CHAR(36) NULL AFTER fotoPerfil;

-- ==================== MENSAGENS ====================
ALTER TABLE mensagens
    ADD COLUMN IF NOT EXISTS contaId CHAR(36) NULL AFTER id,
    ADD COLUMN IF NOT EXISTS conexaoId BIGINT NULL AFTER contaId,
    ADD COLUMN IF NOT EXISTS mensagem TEXT NULL AFTER conversaId,
    ADD COLUMN IF NOT EXISTS tipoMensagem VARCHAR(50) NULL AFTER mensagem,
    ADD COLUMN IF NOT EXISTS arquivoUrl TEXT NULL AFTER tipoMensagem,
    ADD COLUMN IF NOT EXISTS fromMe TINYINT(1) NOT NULL DEFAULT 0 AFTER arquivoUrl,
    ADD COLUMN IF NOT EXISTS apagada TINYINT(1) NOT NULL DEFAULT 0 AFTER fromMe,
    ADD COLUMN IF NOT EXISTS IA TINYINT(1) NULL AFTER apagada;

-- ==================== DISPAROS ====================
CREATE TABLE IF NOT EXISTS disparos (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    contaId CHAR(36) NULL,
    NomeDisparo TEXT NULL,
    StatusDisparo TEXT NULL,
    TotalDisparos BIGINT NULL,
    MensagensDisparadas BIGINT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (contaId) REFERENCES contas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==================== DETALHES_DISPAROS ====================
CREATE TABLE IF NOT EXISTS detalhes_disparos (
    id BIGINT AUTO_INCREMENT NOT NULL,
    idDisparo BIGINT,
    idContato BIGINT,
    Mensagem TEXT,
    idConexao BIGINT,
    dataEnvio TIMESTAMP,
    Status TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (idDisparo) REFERENCES disparos(id),
    FOREIGN KEY (idContato) REFERENCES contatos(id),
    FOREIGN KEY (idConexao) REFERENCES conexoes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;

SELECT 'Migração essencial concluída!' as status;
