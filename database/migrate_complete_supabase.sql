-- ============================================================
-- MIGRAÇÃO COMPLETA PARA ESTRUTURA SUPABASE
-- Este script adiciona TODOS os campos e tabelas do Supabase
-- ============================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='ALLOW_INVALID_DATES';

-- ============================================================
-- TABELA: usuarios
-- ============================================================
ALTER TABLE usuarios 
    ADD COLUMN IF NOT EXISTS auth_user_id CHAR(36) NULL,
    ADD COLUMN IF NOT EXISTS super_admin TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN IF NOT EXISTS telefone VARCHAR(50) NULL;

-- ============================================================
-- TABELA: contas
-- ============================================================
-- Já ajustada anteriormente

-- ============================================================
-- TABELA: planos
-- ============================================================
ALTER TABLE planos
    ADD COLUMN IF NOT EXISTS qntConexoes BIGINT NULL,
    ADD COLUMN IF NOT EXISTS qntContatos BIGINT NULL,
    ADD COLUMN IF NOT EXISTS qntDisparos BIGINT NULL,
    ADD COLUMN IF NOT EXISTS qntQuadros BIGINT NULL,
    ADD COLUMN IF NOT EXISTS qntAgentesIa BIGINT NULL,
    ADD COLUMN IF NOT EXISTS qntCreditosIa BIGINT NULL,
    ADD COLUMN IF NOT EXISTS menu_ocultar JSON NULL,
    ADD COLUMN IF NOT EXISTS qntUsuarios BIGINT NULL;

-- ============================================================
-- TABELA: agentes_ia - TODOS OS CAMPOS
-- ============================================================
ALTER TABLE agentes_ia
    ADD COLUMN IF NOT EXISTS conexaoId BIGINT NULL,
    ADD COLUMN IF NOT EXISTS criatividade DECIMAL(3,2) NULL,
    ADD COLUMN IF NOT EXISTS maxCreditos BIGINT NULL,
    ADD COLUMN IF NOT EXISTS conhecimento JSON NULL,
    ADD COLUMN IF NOT EXISTS cor TEXT NULL,
    ADD COLUMN IF NOT EXISTS separarMensagens TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS ouvirAudio TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS analisarImagens TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS aparecerDigitando TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS pausarAtendimento TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS qntMsgHistorico INT NULL,
    ADD COLUMN IF NOT EXISTS agruparMensagens TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS intervaloEntreMensagens INT NULL,
    ADD COLUMN IF NOT EXISTS CRM JSON NULL,
    ADD COLUMN IF NOT EXISTS abrirAtendimento JSON NULL,
    ADD COLUMN IF NOT EXISTS notificarHumano JSON NULL,
    ADD COLUMN IF NOT EXISTS requisicaoHTTP JSON NULL;

-- ============================================================
-- TABELA: conexoes - TODOS OS CAMPOS
-- ============================================================
ALTER TABLE conexoes
    ADD COLUMN IF NOT EXISTS instanceName TEXT NULL,
    ADD COLUMN IF NOT EXISTS NomeConexao TEXT NULL,
    ADD COLUMN IF NOT EXISTS Telefone TEXT NULL,
    ADD COLUMN IF NOT EXISTS FotoPerfil TEXT NULL,
    ADD COLUMN IF NOT EXISTS Apikey TEXT NULL,
    ADD COLUMN IF NOT EXISTS contaId CHAR(36) NULL,
    ADD COLUMN IF NOT EXISTS idAgente BIGINT NULL;

-- ============================================================
-- TABELA: contatos - TODOS OS CAMPOS
-- ============================================================
ALTER TABLE contatos
    ADD COLUMN IF NOT EXISTS idLista BIGINT NULL,
    ADD COLUMN IF NOT EXISTS variaveis JSON NULL,
    ADD COLUMN IF NOT EXISTS tipo VARCHAR(20) NOT NULL DEFAULT 'contato',
    ADD COLUMN IF NOT EXISTS lid TEXT NULL,
    ADD COLUMN IF NOT EXISTS fotoPerfil TEXT NULL;

-- ============================================================
-- TABELA: conversas (conversas_agentes) - TODOS OS CAMPOS
-- ============================================================
ALTER TABLE conversas
    ADD COLUMN IF NOT EXISTS idAgente BIGINT NULL,
    ADD COLUMN IF NOT EXISTS idConexao BIGINT NULL,
    ADD COLUMN IF NOT EXISTS telefone TEXT NULL,
    ADD COLUMN IF NOT EXISTS pausado TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS pausaAte TIMESTAMP NULL,
    ADD COLUMN IF NOT EXISTS ultimaMensagem TIMESTAMP NULL,
    ADD COLUMN IF NOT EXISTS contatoId BIGINT NULL,
    ADD COLUMN IF NOT EXISTS lida TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN IF NOT EXISTS fotoPerfil TEXT NULL,
    ADD COLUMN IF NOT EXISTS dataFechamento TIMESTAMP NULL,
    ADD COLUMN IF NOT EXISTS nota TEXT NULL,
    ADD COLUMN IF NOT EXISTS atendente CHAR(36) NULL;

-- ============================================================
-- TABELA: mensagens - TODOS OS CAMPOS
-- ============================================================
ALTER TABLE mensagens
    ADD COLUMN IF NOT EXISTS contaId CHAR(36) NULL,
    ADD COLUMN IF NOT EXISTS conexaoId BIGINT NULL,
    ADD COLUMN IF NOT EXISTS mensagem TEXT NULL,
    ADD COLUMN IF NOT EXISTS tipoMensagem VARCHAR(50) NULL,
    ADD COLUMN IF NOT EXISTS arquivoUrl TEXT NULL,
    ADD COLUMN IF NOT EXISTS fromMe TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN IF NOT EXISTS apagada TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN IF NOT EXISTS messageEvolutionId TEXT NULL,
    ADD COLUMN IF NOT EXISTS mensagemRespondida TEXT NULL,
    ADD COLUMN IF NOT EXISTS enviada TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS IA TINYINT(1) NULL,
    ADD COLUMN IF NOT EXISTS favorita TINYINT(1) NOT NULL DEFAULT 0;

-- ============================================================
-- TABELA: disparos - TODOS OS CAMPOS
-- ============================================================
ALTER TABLE disparos
    ADD COLUMN IF NOT EXISTS Mensagens JSON NULL,
    ADD COLUMN IF NOT EXISTS TipoDisparo TEXT NULL,
    ADD COLUMN IF NOT EXISTS TotalDisparos BIGINT NULL,
    ADD COLUMN IF NOT EXISTS MensagensDisparadas BIGINT NULL,
    ADD COLUMN IF NOT EXISTS StatusDisparo TEXT NULL,
    ADD COLUMN IF NOT EXISTS idExecution TEXT NULL,
    ADD COLUMN IF NOT EXISTS idListas JSON NULL,
    ADD COLUMN IF NOT EXISTS idConexoes JSON NULL,
    ADD COLUMN IF NOT EXISTS intervaloMin INT NULL,
    ADD COLUMN IF NOT EXISTS intervaloMax INT NULL,
    ADD COLUMN IF NOT EXISTS PausaAposMensagens INT NULL,
    ADD COLUMN IF NOT EXISTS PausaMinutos INT NULL,
    ADD COLUMN IF NOT EXISTS StartTime TIME NULL,
    ADD COLUMN IF NOT EXISTS EndTime TIME NULL,
    ADD COLUMN IF NOT EXISTS DiasSelecionados JSON NULL,
    ADD COLUMN IF NOT EXISTS DataAgendamento TIMESTAMP NULL,
    ADD COLUMN IF NOT EXISTS idEtiquetas JSON NULL,
    ADD COLUMN IF NOT EXISTS NomeDisparo TEXT NULL,
    ADD COLUMN IF NOT EXISTS contaId CHAR(36) NULL;

-- ============================================================
-- NOVA TABELA: etiquetas
-- ============================================================
CREATE TABLE IF NOT EXISTS etiquetas (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome TEXT NOT NULL,
    descricao TEXT,
    contaId CHAR(36) NOT NULL,
    cor TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (contaId) REFERENCES contas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: contatos_etiquetas (relacionamento N:N)
-- ============================================================
CREATE TABLE IF NOT EXISTS contatos_etiquetas (
    contatoId BIGINT NOT NULL,
    etiquetaId BIGINT NOT NULL,
    contaId CHAR(36) NOT NULL,
    PRIMARY KEY (contatoId, etiquetaId),
    FOREIGN KEY (contatoId) REFERENCES contatos(id) ON DELETE CASCADE,
    FOREIGN KEY (etiquetaId) REFERENCES etiquetas(id) ON DELETE CASCADE,
    FOREIGN KEY (contaId) REFERENCES contas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: detalhes_disparos
-- ============================================================
CREATE TABLE IF NOT EXISTS detalhes_disparos (
    id BIGINT AUTO_INCREMENT NOT NULL,
    idDisparo BIGINT,
    idContato BIGINT,
    Mensagem TEXT,
    idConexao BIGINT,
    dataEnvio TIMESTAMP,
    Status TEXT,
    statusHttp TEXT,
    mensagemErro TEXT,
    respostaHttp JSON,
    Payload JSON,
    KeyRedis TEXT,
    FakeCall TINYINT(1),
    PRIMARY KEY (id),
    FOREIGN KEY (idConexao) REFERENCES conexoes(id) ON DELETE SET NULL,
    FOREIGN KEY (idDisparo) REFERENCES disparos(id) ON DELETE CASCADE,
    FOREIGN KEY (idContato) REFERENCES contatos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: etapas_quadros
-- ============================================================
CREATE TABLE IF NOT EXISTS etapas_quadros (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    quadroId BIGINT,
    nome TEXT,
    ordem SMALLINT,
    contaId CHAR(36),
    PRIMARY KEY (id),
    FOREIGN KEY (contaId) REFERENCES contas(id) ON DELETE CASCADE,
    FOREIGN KEY (quadroId) REFERENCES crm_quadros(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: cards_quadros
-- ============================================================
CREATE TABLE IF NOT EXISTS cards_quadros (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    quadroId BIGINT,
    contatoId BIGINT,
    valor DOUBLE,
    etapaQuadroId BIGINT,
    observacoes TEXT,
    tarefas JSON,
    ordem SMALLINT,
    nome TEXT,
    contato TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (contatoId) REFERENCES contatos(id) ON DELETE CASCADE,
    FOREIGN KEY (etapaQuadroId) REFERENCES etapas_quadros(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: campos_personalizados
-- ============================================================
CREATE TABLE IF NOT EXISTS campos_personalizados (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome TEXT NOT NULL,
    descricao TEXT,
    tipo VARCHAR(20) NOT NULL,
    contaId CHAR(36) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (contaId) REFERENCES contas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: valores_campos_personalizados
-- ============================================================
CREATE TABLE IF NOT EXISTS valores_campos_personalizados (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idCampo BIGINT NOT NULL,
    idContato BIGINT NOT NULL,
    contaId CHAR(36) NOT NULL,
    valor TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (idCampo) REFERENCES campos_personalizados(id) ON DELETE CASCADE,
    FOREIGN KEY (idContato) REFERENCES contatos(id) ON DELETE CASCADE,
    FOREIGN KEY (contaId) REFERENCES contas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: respostas_rapidas
-- ============================================================
CREATE TABLE IF NOT EXISTS respostas_rapidas (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    contaId CHAR(36) NULL,
    nome TEXT,
    atalho TEXT,
    texto TEXT,
    arquivo TEXT,
    tipoMedia TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (contaId) REFERENCES contas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: integracao_pagamento
-- ============================================================
CREATE TABLE IF NOT EXISTS integracao_pagamento (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome TEXT,
    planoId BIGINT,
    tokenWebhook CHAR(36) DEFAULT (UUID()),
    diasValidade INT,
    mapeamento JSON,
    ultimoPayload JSON,
    teste TINYINT(1) DEFAULT 0,
    status TINYINT(1) DEFAULT 1,
    PRIMARY KEY (id),
    FOREIGN KEY (planoId) REFERENCES planos(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: webhook
-- ============================================================
CREATE TABLE IF NOT EXISTS webhook (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    contaId CHAR(36) NULL,
    conexaoId BIGINT,
    tokenWebhook CHAR(36) DEFAULT (UUID()),
    nome TEXT,
    status TINYINT(1),
    teste TINYINT(1),
    mapeamento JSON,
    ultimoPayload JSON,
    idAgente BIGINT,
    mensagemPadrao TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (contaId) REFERENCES contas(id) ON DELETE CASCADE,
    FOREIGN KEY (conexaoId) REFERENCES conexoes(id) ON DELETE CASCADE,
    FOREIGN KEY (idAgente) REFERENCES agentes_ia(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: conhecimentos (para RAG/IA)
-- ============================================================
CREATE TABLE IF NOT EXISTS conhecimentos (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    content TEXT,
    metadata JSON,
    embedding TEXT,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: historico_agenteia
-- ============================================================
CREATE TABLE IF NOT EXISTS historico_agenteia (
    id BIGINT AUTO_INCREMENT NOT NULL,
    session_id VARCHAR(255) NOT NULL,
    message JSON NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_session (session_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: config_emails
-- ============================================================
CREATE TABLE IF NOT EXISTS config_emails (
    id INT NOT NULL DEFAULT 1,
    supabase_pat TEXT,
    assunto_email_novousuario TEXT,
    html_email_novousuario TEXT,
    assunto_email_redefinirsenha TEXT,
    html_email_redefinirsenha TEXT,
    smtp_email TEXT,
    smtp_name TEXT,
    smtp_host TEXT,
    smtp_port INT,
    smtp_user TEXT,
    smtp_apikey TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- NOVA TABELA: versao
-- ============================================================
CREATE TABLE IF NOT EXISTS versao (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    versaoAtual TEXT,
    ultimaAtualizacao TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir versão inicial
INSERT INTO versao (versaoAtual, ultimaAtualizacao) 
VALUES ('1.0.0', NOW())
ON DUPLICATE KEY UPDATE versaoAtual = '1.0.0';

-- ============================================================
-- AJUSTES FINAIS
-- ============================================================

-- Adicionar índices para performance
CREATE INDEX IF NOT EXISTS idx_contatos_contaId ON contatos(contaId);
CREATE INDEX IF NOT EXISTS idx_mensagens_conversaId ON mensagens(conversaId);
CREATE INDEX IF NOT EXISTS idx_mensagens_contaId ON mensagens(contaId);
CREATE INDEX IF NOT EXISTS idx_conversas_contaId ON conversas(contaId);
CREATE INDEX IF NOT EXISTS idx_agentes_contaId ON agentes_ia(contaId);
CREATE INDEX IF NOT EXISTS idx_conexoes_contaId ON conexoes(contaId);

SET FOREIGN_KEY_CHECKS=1;
SET SQL_MODE='';

SELECT '✅ MIGRAÇÃO COMPLETA CONCLUÍDA COM SUCESSO!' as status,
       'Todas as tabelas e campos do Supabase foram adicionados' as mensagem;
