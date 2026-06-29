-- Migração para estrutura compatível com Supabase
-- Ajustando todas as tabelas para ficarem iguais ao schema original

SET FOREIGN_KEY_CHECKS=0;

-- ==================== TABELA: usuarios ====================
-- Ajustar estrutura
ALTER TABLE usuarios 
    ADD COLUMN IF NOT EXISTS auth_user_id CHAR(36) NULL UNIQUE AFTER Email,
    MODIFY COLUMN funcao VARCHAR(20) NOT NULL DEFAULT 'admin',
    ADD COLUMN IF NOT EXISTS super_admin TINYINT(1) NOT NULL DEFAULT 0 AFTER funcao;

-- ==================== TABELA: contas ====================
-- Já ajustada anteriormente, mas vamos garantir
ALTER TABLE contas
    MODIFY COLUMN status TINYINT(1) DEFAULT 1,
    MODIFY COLUMN plano BIGINT NULL,
    ADD COLUMN IF NOT EXISTS apikey_gpt TEXT NULL AFTER email,
    ADD COLUMN IF NOT EXISTS tokens DECIMAL(15,2) NULL DEFAULT 0 AFTER plano;

-- Renomear data_fim para dataValidade se ainda não foi feito
-- ALTER TABLE contas CHANGE COLUMN data_fim dataValidade DATE NULL;

-- ==================== TABELA: planos ====================
-- Ajustar estrutura de planos
ALTER TABLE planos
    ADD COLUMN IF NOT EXISTS qntConexoes BIGINT NULL AFTER preco,
    ADD COLUMN IF NOT EXISTS qntContatos BIGINT NULL AFTER qntConexoes,
    ADD COLUMN IF NOT EXISTS qntDisparos BIGINT NULL AFTER qntContatos,
    ADD COLUMN IF NOT EXISTS qntQuadros BIGINT NULL AFTER qntDisparos,
    ADD COLUMN IF NOT EXISTS qntAgentesIa BIGINT NULL AFTER qntQuadros,
    ADD COLUMN IF NOT EXISTS qntCreditosIa BIGINT NULL AFTER qntAgentesIa,
    ADD COLUMN IF NOT EXISTS menu_ocultar JSON NULL DEFAULT '[]' AFTER qntCreditosIa,
    ADD COLUMN IF NOT EXISTS qntUsuarios BIGINT NULL AFTER menu_ocultar;

-- ==================== TABELA: agentes_ia ====================
ALTER TABLE agentes_ia
    MODIFY COLUMN contaId CHAR(36) NULL,
    ADD COLUMN IF NOT EXISTS conexaoId BIGINT NULL AFTER nome,
    ADD COLUMN IF NOT EXISTS criatividade DECIMAL(3,2) NULL AFTER modelo,
    ADD COLUMN IF NOT EXISTS maxCreditos BIGINT NULL AFTER criatividade,
    ADD COLUMN IF NOT EXISTS conhecimento JSON NULL AFTER ativo,
    ADD COLUMN IF NOT EXISTS cor TEXT NULL AFTER conhecimento,
    ADD COLUMN IF NOT EXISTS separarMensagens TINYINT(1) NULL AFTER cor,
    ADD COLUMN IF NOT EXISTS ouvirAudio TINYINT(1) NULL AFTER separarMensagens,
    ADD COLUMN IF NOT EXISTS analisarImagens TINYINT(1) NULL AFTER ouvirAudio,
    ADD COLUMN IF NOT EXISTS aparecerDigitando TINYINT(1) NULL AFTER analisarImagens,
    ADD COLUMN IF NOT EXISTS pausarAtendimento TINYINT(1) NULL AFTER aparecerDigitando,
    ADD COLUMN IF NOT EXISTS qntMsgHistorico INT NULL AFTER pausarAtendimento,
    ADD COLUMN IF NOT EXISTS agruparMensagens TINYINT(1) NULL AFTER qntMsgHistorico,
    ADD COLUMN IF NOT EXISTS intervaloEntreMensagens INT NULL AFTER agruparMensagens,
    ADD COLUMN IF NOT EXISTS CRM JSON NULL AFTER intervaloEntreMensagens,
    ADD COLUMN IF NOT EXISTS abrirAtendimento JSON NULL AFTER CRM,
    ADD COLUMN IF NOT EXISTS notificarHumano JSON NULL AFTER abrirAtendimento,
    ADD COLUMN IF NOT EXISTS requisicaoHTTP JSON NULL AFTER notificarHumano;

-- ==================== TABELA: conexoes ====================
ALTER TABLE conexoes
    ADD COLUMN IF NOT EXISTS instanceName TEXT NULL AFTER created_at,
    ADD COLUMN IF NOT EXISTS NomeConexao TEXT NULL AFTER instanceName,
    ADD COLUMN IF NOT EXISTS Telefone TEXT NULL AFTER NomeConexao,
    ADD COLUMN IF NOT EXISTS FotoPerfil TEXT NULL AFTER Telefone,
    ADD COLUMN IF NOT EXISTS Apikey TEXT NULL AFTER FotoPerfil,
    ADD COLUMN IF NOT EXISTS contaId CHAR(36) NULL AFTER Apikey,
    ADD COLUMN IF NOT EXISTS idAgente BIGINT NULL AFTER contaId;

-- ==================== TABELA: contatos ====================
ALTER TABLE contatos
    MODIFY COLUMN contaId CHAR(36) NOT NULL,
    ADD COLUMN IF NOT EXISTS idLista BIGINT NULL AFTER telefone,
    ADD COLUMN IF NOT EXISTS variaveis JSON NOT NULL DEFAULT (JSON_OBJECT()) AFTER idLista,
    ADD COLUMN IF NOT EXISTS tipo VARCHAR(20) NOT NULL DEFAULT 'contato' AFTER variaveis,
    ADD COLUMN IF NOT EXISTS lid TEXT NULL AFTER tipo,
    ADD COLUMN IF NOT EXISTS fotoPerfil TEXT NULL AFTER lid;

-- ==================== TABELA: conversas_agentes ====================
ALTER TABLE conversas
    ADD COLUMN IF NOT EXISTS idAgente BIGINT NULL AFTER id,
    ADD COLUMN IF NOT EXISTS idConexao BIGINT NULL AFTER idAgente,
    ADD COLUMN IF NOT EXISTS telefone TEXT NULL AFTER idConexao,
    ADD COLUMN IF NOT EXISTS pausado TINYINT(1) NULL AFTER telefone,
    ADD COLUMN IF NOT EXISTS pausaAte TIMESTAMP NULL AFTER pausado,
    ADD COLUMN IF NOT EXISTS ultimaMensagem TIMESTAMP NULL AFTER pausaAte,
    MODIFY COLUMN contaId CHAR(36) NULL,
    ADD COLUMN IF NOT EXISTS contatoId BIGINT NULL AFTER contaId,
    ADD COLUMN IF NOT EXISTS lida TINYINT(1) NOT NULL DEFAULT 0 AFTER contatoId,
    ADD COLUMN IF NOT EXISTS fotoPerfil TEXT NULL AFTER nomeConversa,
    ADD COLUMN IF NOT EXISTS dataFechamento TIMESTAMP NULL AFTER fotoPerfil,
    ADD COLUMN IF NOT EXISTS nota TEXT NULL AFTER dataFechamento,
    ADD COLUMN IF NOT EXISTS atendente CHAR(36) NULL AFTER nota;

-- ==================== TABELA: mensagens ====================
ALTER TABLE mensagens
    MODIFY COLUMN contaId CHAR(36) NOT NULL,
    ADD COLUMN IF NOT EXISTS fromMe TINYINT(1) NOT NULL DEFAULT 0 AFTER arquivoUrl,
    ADD COLUMN IF NOT EXISTS apagada TINYINT(1) NOT NULL DEFAULT 0 AFTER fromMe,
    ADD COLUMN IF NOT EXISTS messageEvolutionId TEXT NULL AFTER apagada,
    ADD COLUMN IF NOT EXISTS mensagemRespondida TEXT NULL AFTER messageEvolutionId,
    ADD COLUMN IF NOT EXISTS enviada TINYINT(1) NULL AFTER mensagemRespondida,
    ADD COLUMN IF NOT EXISTS IA TINYINT(1) NULL AFTER enviada,
    ADD COLUMN IF NOT EXISTS favorita TINYINT(1) NOT NULL DEFAULT 0 AFTER IA;

-- ==================== TABELA: disparos ====================
ALTER TABLE disparos
    MODIFY COLUMN contaId CHAR(36) NULL,
    ADD COLUMN IF NOT EXISTS Mensagens JSON NULL AFTER created_at,
    ADD COLUMN IF NOT EXISTS TipoDisparo TEXT NULL AFTER Mensagens,
    ADD COLUMN IF NOT EXISTS TotalDisparos BIGINT NULL AFTER TipoDisparo,
    ADD COLUMN IF NOT EXISTS MensagensDisparadas BIGINT NULL AFTER TotalDisparos,
    ADD COLUMN IF NOT EXISTS StatusDisparo TEXT NULL AFTER MensagensDisparadas,
    ADD COLUMN IF NOT EXISTS idExecution TEXT NULL AFTER StatusDisparo,
    ADD COLUMN IF NOT EXISTS idListas JSON NULL AFTER idExecution,
    ADD COLUMN IF NOT EXISTS idConexoes JSON NULL AFTER idListas,
    ADD COLUMN IF NOT EXISTS intervaloMin INT NULL AFTER idConexoes,
    ADD COLUMN IF NOT EXISTS intervaloMax INT NULL AFTER intervaloMin,
    ADD COLUMN IF NOT EXISTS PausaAposMensagens INT NULL AFTER intervaloMax,
    ADD COLUMN IF NOT EXISTS PausaMinutos INT NULL AFTER PausaAposMensagens,
    ADD COLUMN IF NOT EXISTS StartTime TIME NULL AFTER PausaMinutos,
    ADD COLUMN IF NOT EXISTS EndTime TIME NULL AFTER StartTime,
    ADD COLUMN IF NOT EXISTS DiasSelecionados JSON NULL AFTER EndTime,
    ADD COLUMN IF NOT EXISTS DataAgendamento TIMESTAMP NULL AFTER DiasSelecionados,
    ADD COLUMN IF NOT EXISTS idEtiquetas JSON NULL AFTER DataAgendamento,
    ADD COLUMN IF NOT EXISTS NomeDisparo TEXT NULL AFTER idEtiquetas;

-- ==================== TABELA: etiquetas ====================
ALTER TABLE etiquetas
    MODIFY COLUMN contaId CHAR(36) NOT NULL,
    ADD COLUMN IF NOT EXISTS cor TEXT NULL AFTER descricao;

-- ==================== TABELA: crm_quadros ====================
-- Renomear para quadros
ALTER TABLE crm_quadros
    MODIFY COLUMN contaId CHAR(36) NULL,
    ADD COLUMN IF NOT EXISTS icone TEXT NULL AFTER cor;

-- ==================== TABELA: crm_etapas ====================
-- Renomear para etapas_quadros
ALTER TABLE crm_etapas
    MODIFY COLUMN contaId CHAR(36) NULL;

-- ==================== NOVAS TABELAS ====================

-- Tabela: campos_personalizados
CREATE TABLE IF NOT EXISTS campos_personalizados (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome TEXT NOT NULL,
    descricao TEXT,
    tipo VARCHAR(20) NOT NULL,
    contaId CHAR(36) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (contaId) REFERENCES contas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela: valores_campos_personalizados
CREATE TABLE IF NOT EXISTS valores_campos_personalizados (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idCampo BIGINT NOT NULL,
    idContato BIGINT NOT NULL,
    contaId CHAR(36) NOT NULL,
    valor TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (idCampo) REFERENCES campos_personalizados(id),
    FOREIGN KEY (idContato) REFERENCES contatos(id),
    FOREIGN KEY (contaId) REFERENCES contas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela: cards_quadros
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
    FOREIGN KEY (contatoId) REFERENCES contatos(id),
    FOREIGN KEY (etapaQuadroId) REFERENCES etapas_quadros(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela: contatos_etiquetas (relacionamento N:N)
CREATE TABLE IF NOT EXISTS contatos_etiquetas (
    contatoId BIGINT NOT NULL,
    etiquetaId BIGINT NOT NULL,
    contaId CHAR(36) NOT NULL,
    PRIMARY KEY (contatoId, etiquetaId),
    FOREIGN KEY (contatoId) REFERENCES contatos(id),
    FOREIGN KEY (etiquetaId) REFERENCES etiquetas(id),
    FOREIGN KEY (contaId) REFERENCES contas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela: detalhes_disparos
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
    FOREIGN KEY (idConexao) REFERENCES conexoes(id),
    FOREIGN KEY (idDisparo) REFERENCES disparos(id),
    FOREIGN KEY (idContato) REFERENCES contatos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela: respostas_rapidas
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
    FOREIGN KEY (contaId) REFERENCES contas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela: integracao_pagamento
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
    FOREIGN KEY (planoId) REFERENCES planos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela: config_emails
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

-- Tabela: versao
CREATE TABLE IF NOT EXISTS versao (
    id BIGINT AUTO_INCREMENT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    versaoAtual TEXT,
    ultimaAtualizacao TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;

-- Inserir versão inicial
INSERT INTO versao (versaoAtual, ultimaAtualizacao) 
VALUES ('1.0.0', NOW())
ON DUPLICATE KEY UPDATE versaoAtual = '1.0.0';

SELECT 'Migração concluída com sucesso!' as status;
