-- Schema MySQL convertido do schema Supabase/PostgreSQL enviado.
-- Recomendado: MySQL 8.0+ / MariaDB 10.6+.
-- Campos jsonb/array/vector foram convertidos para JSON.
-- UUIDs usam CHAR(36) com DEFAULT (UUID()).
-- Observação: caso sua versão do MySQL/MariaDB não aceite DEFAULT (UUID()) ou DEFAULT (JSON_OBJECT()),
-- remova esses defaults e gere os valores no PHP.

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `SAAS_AgentesIA`;
CREATE TABLE `SAAS_AgentesIA` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contaId` CHAR(36),
  `nome` TEXT,
  `conexaoId` BIGINT,
  `instrucoes` TEXT,
  `modelo` TEXT,
  `criatividade` FLOAT,
  `maxCreditos` BIGINT,
  `ativo` TINYINT(1),
  `conhecimento` JSON,
  `cor` TEXT,
  `separarMensagens` TINYINT(1),
  `ouvirAudio` TINYINT(1),
  `analisarImagens` TINYINT(1),
  `aparecerDigitando` TINYINT(1),
  `pausarAtendimento` TINYINT(1),
  `qntMsgHistorico` INT,
  `agruparMensagens` TINYINT(1),
  `intervaloEntreMensagens` INT,
  `CRM` JSON,
  `abrirAtendimento` JSON,
  `notificarHumano` JSON,
  `requisicaoHTTP` JSON,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Campos_Personalizados`;
CREATE TABLE `SAAS_Campos_Personalizados` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` TEXT NOT NULL,
  `descricao` TEXT,
  `tipo` TEXT NOT NULL,
  `contaId` CHAR(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Cards_Quadros`;
CREATE TABLE `SAAS_Cards_Quadros` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quadroId` BIGINT,
  `contatoId` BIGINT,
  `valor` DOUBLE,
  `etapaQuadroId` BIGINT,
  `observacoes` TEXT,
  `tarefas` JSON,
  `ordem` SMALLINT,
  `nome` TEXT,
  `contato` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Conexões`;
CREATE TABLE `SAAS_Conexões` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `instanceName` TEXT,
  `NomeConexao` TEXT,
  `Telefone` TEXT,
  `FotoPerfil` TEXT,
  `Apikey` TEXT,
  `contaId` CHAR(36),
  `idAgente` BIGINT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Config_Emails`;
CREATE TABLE `SAAS_Config_Emails` (
  `id` INT NOT NULL DEFAULT 1,
  `supabase_pat` TEXT,
  `assunto_email_novousuario` TEXT,
  `html_email_novousuario` TEXT,
  `assunto_email_redefinirsenha` TEXT,
  `html_email_redefinirsenha` TEXT,
  `smtp_email` TEXT,
  `smtp_name` TEXT,
  `smtp_host` TEXT,
  `smtp_port` INT,
  `smtp_user` TEXT,
  `smtp_apikey` TEXT,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Conhecimentos`;
CREATE TABLE `SAAS_Conhecimentos` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` TEXT,
  `metadata` JSON,
  `embedding` JSON,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Contas`;
CREATE TABLE `SAAS_Contas` (
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT(1) DEFAULT 1,
  `apikey_gpt` TEXT,
  `id` CHAR(36) NOT NULL,
  `dataValidade` DATE,
  `plano` BIGINT,
  `tokens` DECIMAL(18,2),
  `email` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Contatos`;
CREATE TABLE `SAAS_Contatos` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` TEXT,
  `telefone` TEXT,
  `idLista` BIGINT,
  `variaveis` JSON NOT NULL,
  `contaId` CHAR(36) NOT NULL,
  `tipo` TEXT NOT NULL DEFAULT 'contato',
  `email` TEXT,
  `lid` TEXT,
  `fotoPerfil` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Contatos_Etiquetas`;
CREATE TABLE `SAAS_Contatos_Etiquetas` (
  `contatoId` BIGINT NOT NULL,
  `etiquetaId` BIGINT NOT NULL,
  `contaId` CHAR(36) NOT NULL,
  PRIMARY KEY (`contatoId`, `etiquetaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Conversas_Agentes`;
CREATE TABLE `SAAS_Conversas_Agentes` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idAgente` BIGINT,
  `idConexao` BIGINT,
  `telefone` TEXT,
  `pausado` TINYINT(1),
  `pausaAte` TIMESTAMP NULL,
  `ultimaMensagem` TIMESTAMP NULL,
  `contaId` CHAR(36),
  `contatoId` BIGINT,
  `lida` TINYINT(1) NOT NULL DEFAULT 0,
  `statusAtendimento` TEXT NOT NULL DEFAULT 'aguardando',
  `nomeConversa` TEXT,
  `fotoPerfil` TEXT,
  `dataFechamento` TIMESTAMP NULL,
  `nota` TEXT,
  `atendente` CHAR(36),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Detalhes_Disparos`;
CREATE TABLE `SAAS_Detalhes_Disparos` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `idDisparo` BIGINT,
  `idContato` BIGINT,
  `Mensagem` TEXT,
  `idConexao` BIGINT,
  `dataEnvio` TIMESTAMP NULL,
  `Status` TEXT,
  `statusHttp` TEXT,
  `mensagemErro` TEXT,
  `respostaHttp` JSON,
  `Payload` JSON,
  `KeyRedis` TEXT,
  `FakeCall` TINYINT(1),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Disparos`;
CREATE TABLE `SAAS_Disparos` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Mensagens` JSON,
  `TipoDisparo` TEXT,
  `TotalDisparos` BIGINT,
  `MensagensDisparadas` BIGINT,
  `StatusDisparo` TEXT,
  `idExecution` TEXT,
  `idListas` JSON,
  `idConexoes` JSON,
  `intervaloMin` INT,
  `intervaloMax` INT,
  `PausaAposMensagens` INT,
  `PausaMinutos` INT,
  `StartTime` TIME,
  `EndTime` TIME,
  `DiasSelecionados` JSON,
  `DataAgendamento` TIMESTAMP NULL,
  `contaId` CHAR(36),
  `idEtiquetas` JSON,
  `NomeDisparo` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Etapas_Quadros`;
CREATE TABLE `SAAS_Etapas_Quadros` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quadroId` BIGINT,
  `nome` TEXT,
  `ordem` SMALLINT,
  `contaId` CHAR(36),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Etiquetas`;
CREATE TABLE `SAAS_Etiquetas` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` TEXT NOT NULL,
  `descricao` TEXT,
  `contaId` CHAR(36) NOT NULL,
  `cor` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Historico_AgenteIA`;
CREATE TABLE `SAAS_Historico_AgenteIA` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `session_id` VARCHAR(255) NOT NULL,
  `message` JSON NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_IntegracaoPagamento`;
CREATE TABLE `SAAS_IntegracaoPagamento` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` TEXT,
  `planoId` BIGINT,
  `tokenWebhook` CHAR(36),
  `diasValidade` INT,
  `mapeamento` JSON,
  `ultimoPayload` JSON,
  `teste` TINYINT(1) DEFAULT 0,
  `status` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Mensagens`;
CREATE TABLE `SAAS_Mensagens` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contaId` CHAR(36) NOT NULL,
  `conexaoId` BIGINT,
  `conversaId` BIGINT NOT NULL,
  `mensagem` TEXT,
  `tipoMensagem` TEXT NOT NULL,
  `arquivoUrl` TEXT,
  `fromMe` TINYINT(1) NOT NULL DEFAULT 0,
  `apagada` TINYINT(1) NOT NULL DEFAULT 0,
  `messageEvolutionId` TEXT,
  `mensagemRespondida` TEXT,
  `enviada` TINYINT(1),
  `IA` TINYINT(1),
  `favorita` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Planos`;
CREATE TABLE `SAAS_Planos` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` TEXT,
  `preco` FLOAT,
  `qntConexoes` BIGINT,
  `qntContatos` BIGINT,
  `qntDisparos` BIGINT,
  `qntQuadros` BIGINT,
  `qntAgentesIa` BIGINT,
  `qntCreditosIa` BIGINT,
  `menu_ocultar` JSON,
  `qntUsuarios` BIGINT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Quadros`;
CREATE TABLE `SAAS_Quadros` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` TEXT,
  `descricao` TEXT,
  `cor` TEXT,
  `contaId` CHAR(36),
  `icone` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Resposta_Rapidas`;
CREATE TABLE `SAAS_Resposta_Rapidas` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contaId` CHAR(36),
  `nome` TEXT,
  `atalho` TEXT,
  `texto` TEXT,
  `arquivo` TEXT,
  `tipoMedia` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Usuarios`;
CREATE TABLE `SAAS_Usuarios` (
  `id` CHAR(36) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contaId` CHAR(36),
  `nome` TEXT,
  `Email` TEXT,
  `senha_hash` VARCHAR(255),
  `telefone` TEXT,
  `auth_user_id` CHAR(36),
  `funcao` TEXT NOT NULL DEFAULT 'admin',
  `super_admin` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Valores_Campos_Personalizados`;
CREATE TABLE `SAAS_Valores_Campos_Personalizados` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idCampo` BIGINT NOT NULL,
  `idContato` BIGINT NOT NULL,
  `contaId` CHAR(36) NOT NULL,
  `valor` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Versao`;
CREATE TABLE `SAAS_Versao` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `versaoAtual` TEXT,
  `ultimaAtualizacao` TIMESTAMP NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `SAAS_Webhook`;
CREATE TABLE `SAAS_Webhook` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contaId` CHAR(36),
  `conexaoId` BIGINT,
  `tokenWebhook` CHAR(36),
  `nome` TEXT,
  `status` TINYINT(1),
  `teste` TINYINT(1),
  `mapeamento` JSON,
  `ultimoPayload` JSON,
  `idAgente` BIGINT,
  `mensagemPadrao` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `saas_historico_agenteia`;
CREATE TABLE `saas_historico_agenteia` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `session_id` VARCHAR(255) NOT NULL,
  `message` JSON NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;

-- Foreign keys (comentadas temporariamente - adicionar depois se necessário)
-- ALTER TABLE `SAAS_AgentesIA` ADD CONSTRAINT `SAAS_AgentesIA_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
-- ALTER TABLE `SAAS_AgentesIA` ADD CONSTRAINT `SAAS_AgentesIA_conexaoId_fkey` FOREIGN KEY (`conexaoId`) REFERENCES `SAAS_Conexões` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
-- ALTER TABLE `SAAS_Campos_Personalizados` ADD CONSTRAINT `SAAS_Campos_Personalizados_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
-- ALTER TABLE `SAAS_Cards_Quadros` ADD CONSTRAINT `SAAS_Cards_Quadros_contatoId_fkey` FOREIGN KEY (`contatoId`) REFERENCES `SAAS_Contatos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Cards_Quadros` ADD CONSTRAINT `SAAS_Cards_Quadros_etapaQuadroId_fkey` FOREIGN KEY (`etapaQuadroId`) REFERENCES `SAAS_Etapas_Quadros` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Conexões` ADD CONSTRAINT `SAAS_Conexões_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Conexões` ADD CONSTRAINT `SAAS_Conexões_idAgente_fkey` FOREIGN KEY (`idAgente`) REFERENCES `SAAS_AgentesIA` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Contas` ADD CONSTRAINT `SAAS_Contas_plano_fkey` FOREIGN KEY (`plano`) REFERENCES `SAAS_Planos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Contatos` ADD CONSTRAINT `SAAS_Contatos_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Contatos` ADD CONSTRAINT `SAAS_Contatos_idLista_fkey` FOREIGN KEY (`idLista`) REFERENCES `SAAS_Etiquetas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Contatos_Etiquetas` ADD CONSTRAINT `SAAS_Contatos_Etiquetas_contatoId_fkey` FOREIGN KEY (`contatoId`) REFERENCES `SAAS_Contatos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Contatos_Etiquetas` ADD CONSTRAINT `SAAS_Contatos_Etiquetas_etiquetaId_fkey` FOREIGN KEY (`etiquetaId`) REFERENCES `SAAS_Etiquetas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Contatos_Etiquetas` ADD CONSTRAINT `SAAS_Contatos_Etiquetas_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Conversas_Agentes` ADD CONSTRAINT `SAAS_Conversas_Agentes_idAgente_fkey` FOREIGN KEY (`idAgente`) REFERENCES `SAAS_AgentesIA` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Conversas_Agentes` ADD CONSTRAINT `SAAS_Conversas_Agentes_atendente_fkey` FOREIGN KEY (`atendente`) REFERENCES `SAAS_Usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Conversas_Agentes` ADD CONSTRAINT `SAAS_Conversas_Agentes_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Conversas_Agentes` ADD CONSTRAINT `SAAS_Conversas_Agentes_idConexao_fkey` FOREIGN KEY (`idConexao`) REFERENCES `SAAS_Conexões` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Conversas_Agentes` ADD CONSTRAINT `SAAS_Conversas_Agentes_contatoId_fkey` FOREIGN KEY (`contatoId`) REFERENCES `SAAS_Contatos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Detalhes_Disparos` ADD CONSTRAINT `SAAS_Detalhes_Disparos_idConexao_fkey` FOREIGN KEY (`idConexao`) REFERENCES `SAAS_Conexões` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Detalhes_Disparos` ADD CONSTRAINT `SAAS_Detalhes_Disparos_idDisparo_fkey` FOREIGN KEY (`idDisparo`) REFERENCES `SAAS_Disparos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Detalhes_Disparos` ADD CONSTRAINT `SAAS_Detalhes_Disparos_idContato_fkey` FOREIGN KEY (`idContato`) REFERENCES `SAAS_Contatos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Disparos` ADD CONSTRAINT `SAAS_Disparos_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Etapas_Quadros` ADD CONSTRAINT `SAAS_Etapas_Quadros_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Etapas_Quadros` ADD CONSTRAINT `SAAS_Etapas_Quadros_quadroId_fkey` FOREIGN KEY (`quadroId`) REFERENCES `SAAS_Quadros` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Etiquetas` ADD CONSTRAINT `SAAS_Listas_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_IntegracaoPagamento` ADD CONSTRAINT `SAAS_IntegracaoPagamento_planoId_fkey` FOREIGN KEY (`planoId`) REFERENCES `SAAS_Planos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Mensagens` ADD CONSTRAINT `saas_mensagens_contaid_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Mensagens` ADD CONSTRAINT `SAAS_Mensagens_conversaId_fkey` FOREIGN KEY (`conversaId`) REFERENCES `SAAS_Conversas_Agentes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Quadros` ADD CONSTRAINT `SAAS_Quadros_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Resposta_Rapidas` ADD CONSTRAINT `SAAS_Resposta_Rapidas_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Usuarios` ADD CONSTRAINT `SAAS_Usuarios_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Valores_Campos_Personalizados` ADD CONSTRAINT `SAAS_Valores_Campos_Personalizados_idCampo_fkey` FOREIGN KEY (`idCampo`) REFERENCES `SAAS_Campos_Personalizados` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Valores_Campos_Personalizados` ADD CONSTRAINT `SAAS_Valores_Campos_Personalizados_idContato_fkey` FOREIGN KEY (`idContato`) REFERENCES `SAAS_Contatos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Valores_Campos_Personalizados` ADD CONSTRAINT `SAAS_Valores_Campos_Personalizados_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Webhook` ADD CONSTRAINT `SAAS_Webhook_contaId_fkey` FOREIGN KEY (`contaId`) REFERENCES `SAAS_Contas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Webhook` ADD CONSTRAINT `SAAS_Webhook_conexaoId_fkey` FOREIGN KEY (`conexaoId`) REFERENCES `SAAS_Conexões` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
--  `SAAS_Webhook` ADD CONSTRAINT `SAAS_Webhook_idAgente_fkey` FOREIGN KEY (`idAgente`) REFERENCES `SAAS_AgentesIA` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- Índices recomendados para multiempresa e desempenho
--  idx_SAAS_AgentesIA_contaId ON `SAAS_AgentesIA` (`contaId`);
--  idx_SAAS_AgentesIA_created_at ON `SAAS_AgentesIA` (`created_at`);
--  idx_SAAS_Campos_Personalizados_contaId ON `SAAS_Campos_Personalizados` (`contaId`);
--  idx_SAAS_Campos_Personalizados_created_at ON `SAAS_Campos_Personalizados` (`created_at`);
--  idx_SAAS_Cards_Quadros_created_at ON `SAAS_Cards_Quadros` (`created_at`);
--  idx_SAAS_Conexões_contaId ON `SAAS_Conexões` (`contaId`);
--  idx_SAAS_Conexões_created_at ON `SAAS_Conexões` (`created_at`);
--  idx_SAAS_Conhecimentos_created_at ON `SAAS_Conhecimentos` (`created_at`);
--  idx_SAAS_Contas_created_at ON `SAAS_Contas` (`created_at`);
--  idx_SAAS_Contatos_contaId ON `SAAS_Contatos` (`contaId`);
--  idx_SAAS_Contatos_created_at ON `SAAS_Contatos` (`created_at`);
--  idx_SAAS_Contatos_Etiquetas_contaId ON `SAAS_Contatos_Etiquetas` (`contaId`);
--  idx_SAAS_Conversas_Agentes_contaId ON `SAAS_Conversas_Agentes` (`contaId`);
--  idx_SAAS_Conversas_Agentes_created_at ON `SAAS_Conversas_Agentes` (`created_at`);
--  idx_SAAS_Disparos_contaId ON `SAAS_Disparos` (`contaId`);
--  idx_SAAS_Disparos_created_at ON `SAAS_Disparos` (`created_at`);
--  idx_SAAS_Etapas_Quadros_contaId ON `SAAS_Etapas_Quadros` (`contaId`);
--  idx_SAAS_Etapas_Quadros_created_at ON `SAAS_Etapas_Quadros` (`created_at`);
--  idx_SAAS_Etiquetas_contaId ON `SAAS_Etiquetas` (`contaId`);
--  idx_SAAS_Etiquetas_created_at ON `SAAS_Etiquetas` (`created_at`);
--  idx_SAAS_IntegracaoPagamento_created_at ON `SAAS_IntegracaoPagamento` (`created_at`);
--  idx_SAAS_Mensagens_contaId ON `SAAS_Mensagens` (`contaId`);
--  idx_SAAS_Mensagens_created_at ON `SAAS_Mensagens` (`created_at`);
--  idx_SAAS_Planos_created_at ON `SAAS_Planos` (`created_at`);
--  idx_SAAS_Quadros_contaId ON `SAAS_Quadros` (`contaId`);
--  idx_SAAS_Quadros_created_at ON `SAAS_Quadros` (`created_at`);
--  idx_SAAS_Resposta_Rapidas_contaId ON `SAAS_Resposta_Rapidas` (`contaId`);
--  idx_SAAS_Resposta_Rapidas_created_at ON `SAAS_Resposta_Rapidas` (`created_at`);
--  idx_SAAS_Usuarios_contaId ON `SAAS_Usuarios` (`contaId`);
--  idx_SAAS_Usuarios_created_at ON `SAAS_Usuarios` (`created_at`);
--  idx_SAAS_Valores_Campos_Personalizados_contaId ON `SAAS_Valores_Campos_Personalizados` (`contaId`);
--  idx_SAAS_Valores_Campos_Personalizados_created_at ON `SAAS_Valores_Campos_Personalizados` (`created_at`);
--  idx_SAAS_Versao_created_at ON `SAAS_Versao` (`created_at`);
--  idx_SAAS_Webhook_contaId ON `SAAS_Webhook` (`contaId`);
--  idx_SAAS_Webhook_created_at ON `SAAS_Webhook` (`created_at`);
