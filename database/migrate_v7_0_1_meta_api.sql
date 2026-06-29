-- Atualizacao HUBLABEL V7.0.1
-- Converte as novidades do fluxo n8n/Supabase V7 para o banco MySQL local.
-- Seguro para rodar mais de uma vez em MariaDB/MySQL com suporte a IF NOT EXISTS.

ALTER TABLE `conexoes`
  ADD COLUMN IF NOT EXISTS `apiOficial` TINYINT(1) NOT NULL DEFAULT 0 AFTER `idAgente`,
  ADD COLUMN IF NOT EXISTS `access_token` TEXT NULL AFTER `apikey`,
  ADD COLUMN IF NOT EXISTS `expires_in` BIGINT NULL AFTER `access_token`,
  ADD COLUMN IF NOT EXISTS `business_id` VARCHAR(255) NULL AFTER `expires_in`,
  ADD COLUMN IF NOT EXISTS `waba_id` VARCHAR(255) NULL AFTER `business_id`,
  ADD COLUMN IF NOT EXISTS `phone_number_id` VARCHAR(255) NULL AFTER `waba_id`,
  ADD COLUMN IF NOT EXISTS `expires_at` TIMESTAMP NULL AFTER `phone_number_id`,
  ADD COLUMN IF NOT EXISTS `metaPhoneQualityEvent` TEXT NULL AFTER `expires_at`,
  ADD COLUMN IF NOT EXISTS `metaPhoneQualityLimit` TEXT NULL AFTER `metaPhoneQualityEvent`,
  ADD COLUMN IF NOT EXISTS `metaPhoneQualityUpdatedAt` TIMESTAMP NULL AFTER `metaPhoneQualityLimit`,
  ADD COLUMN IF NOT EXISTS `metaMessagingLimit` TEXT NULL AFTER `metaPhoneQualityUpdatedAt`,
  ADD COLUMN IF NOT EXISTS `metaMaxPhoneNumbers` INT NULL AFTER `metaMessagingLimit`,
  ADD COLUMN IF NOT EXISTS `metaBusinessCapabilityUpdatedAt` TIMESTAMP NULL AFTER `metaMaxPhoneNumbers`,
  ADD COLUMN IF NOT EXISTS `metaAccountEvent` TEXT NULL AFTER `metaBusinessCapabilityUpdatedAt`,
  ADD COLUMN IF NOT EXISTS `metaAccountUpdate` JSON NULL AFTER `metaAccountEvent`,
  ADD COLUMN IF NOT EXISTS `metaAccountUpdatedAt` TIMESTAMP NULL AFTER `metaAccountUpdate`,
  ADD COLUMN IF NOT EXISTS `metaUltimoAlerta` JSON NULL AFTER `metaAccountUpdatedAt`,
  ADD COLUMN IF NOT EXISTS `metaAlertasUpdatedAt` TIMESTAMP NULL AFTER `metaUltimoAlerta`,
  ADD COLUMN IF NOT EXISTS `metaPagamento` JSON NULL DEFAULT (JSON_ARRAY()) AFTER `metaAlertasUpdatedAt`,
  ADD COLUMN IF NOT EXISTS `metaPagamentoUpdatedAt` TIMESTAMP NULL AFTER `metaPagamento`,
  ADD COLUMN IF NOT EXISTS `metaNameStatus` TEXT NULL AFTER `metaPagamentoUpdatedAt`,
  ADD COLUMN IF NOT EXISTS `metaNewDisplayName` TEXT NULL AFTER `metaNameStatus`,
  ADD COLUMN IF NOT EXISTS `metaNewNameStatus` TEXT NULL AFTER `metaNewDisplayName`,
  ADD COLUMN IF NOT EXISTS `metaPrimaryFundingId` TEXT NULL AFTER `metaNewNameStatus`,
  ADD COLUMN IF NOT EXISTS `metaWabaStatus` TEXT NULL AFTER `metaPrimaryFundingId`,
  ADD COLUMN IF NOT EXISTS `metaWabaName` TEXT NULL AFTER `metaWabaStatus`,
  ADD COLUMN IF NOT EXISTS `metaWabaCurrency` TEXT NULL AFTER `metaWabaName`,
  ADD COLUMN IF NOT EXISTS `metaWabaTimezoneId` TEXT NULL AFTER `metaWabaCurrency`,
  ADD COLUMN IF NOT EXISTS `metaPerfil` JSON NULL AFTER `metaWabaTimezoneId`,
  ADD COLUMN IF NOT EXISTS `metaPerfilUpdatedAt` TIMESTAMP NULL AFTER `metaPerfil`,
  ADD COLUMN IF NOT EXISTS `metaVerifiedName` TEXT NULL AFTER `metaPerfilUpdatedAt`,
  ADD COLUMN IF NOT EXISTS `metaPhoneStatus` TEXT NULL AFTER `metaVerifiedName`,
  ADD COLUMN IF NOT EXISTS `metaQualityRating` TEXT NULL AFTER `metaPhoneStatus`,
  ADD COLUMN IF NOT EXISTS `metaBusinessVerificationStatus` TEXT NULL AFTER `metaQualityRating`,
  ADD COLUMN IF NOT EXISTS `metaAccountReviewStatus` TEXT NULL AFTER `metaBusinessVerificationStatus`,
  ADD COLUMN IF NOT EXISTS `metaDadosUpdatedAt` TIMESTAMP NULL AFTER `metaAccountReviewStatus`,
  ADD COLUMN IF NOT EXISTS `metaPinVerificacao` TEXT NULL AFTER `metaDadosUpdatedAt`;

ALTER TABLE `contatos`
  ADD COLUMN IF NOT EXISTS `validado` TINYINT(1) NOT NULL DEFAULT 0 AFTER `fotoPerfil`;

ALTER TABLE `disparos`
  ADD COLUMN IF NOT EXISTS `apiOficial` TINYINT(1) NOT NULL DEFAULT 0 AFTER `idEtiquetas`;

ALTER TABLE `etapas_quadros`
  ADD COLUMN IF NOT EXISTS `tipoEtapa` VARCHAR(30) NULL AFTER `contaId`;

ALTER TABLE `mensagens`
  ADD COLUMN IF NOT EXISTS `metaMessageId` TEXT NULL AFTER `messageEvolutionId`,
  ADD COLUMN IF NOT EXISTS `metaStatus` VARCHAR(50) NULL AFTER `metaMessageId`;

CREATE TABLE IF NOT EXISTS `config_api_oficial` (
  `id` INT NOT NULL DEFAULT 1,
  `app_id` TEXT NULL,
  `app_secret` TEXT NULL,
  `config_id` TEXT NULL,
  `verifyToken` TEXT NULL,
  `visivel` TINYINT(1) NOT NULL DEFAULT 0,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `modelos` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nome` TEXT NULL,
  `tipo` VARCHAR(50) NULL,
  `descricao` TEXT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `modelos_etapas` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modeloId` BIGINT NULL,
  `nome` TEXT NULL,
  `ordem` SMALLINT NULL,
  `tipoEtapa` VARCHAR(30) NULL,
  PRIMARY KEY (`id`),
  KEY `idx_modelos_etapas_modelo` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `modelos_agentes_ia` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modeloId` BIGINT NULL,
  `instrucoes` TEXT NULL,
  `modelo` TEXT NULL,
  `criatividade` FLOAT NULL,
  `ouvirAudio` TINYINT(1) NULL,
  `analisarImagens` TINYINT(1) NULL,
  `aparecerDigitando` TINYINT(1) NULL,
  `pausarAtendimento` TINYINT(1) NULL,
  `agruparMensagens` TINYINT(1) NULL,
  `intervaloEntreMensagens` INT NULL,
  `qntMsgHistorico` INT NULL,
  `abrirAtendimento` JSON NULL,
  `notificarHumano` JSON NULL,
  `requisicaoHTTP` JSON NULL,
  `CRM` JSON NULL,
  PRIMARY KEY (`id`),
  KEY `idx_modelos_agentes_modelo` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `templates_meta` (
  `id` BIGINT AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `conexaoId` BIGINT NULL,
  `wabaId` TEXT NULL,
  `metaTemplateId` TEXT NULL,
  `nome` TEXT NULL,
  `idioma` VARCHAR(20) NULL,
  `categoria` VARCHAR(100) NULL,
  `status` VARCHAR(100) NULL,
  `qualidade` VARCHAR(100) NULL,
  `motivoRejeicao` TEXT NULL,
  `componentes` JSON NULL,
  `statusUpdatedAt` TIMESTAMP NULL,
  `qualidadeUpdatedAt` TIMESTAMP NULL,
  `categoriaUpdatedAt` TIMESTAMP NULL,
  `variaveisCampos` JSON NULL,
  PRIMARY KEY (`id`),
  KEY `idx_templates_meta_conexao` (`conexaoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `config_api_oficial` (`id`, `verifyToken`, `visivel`)
VALUES (1, 'hublabel-meta-webhook', 0)
ON DUPLICATE KEY UPDATE `id` = `id`;
