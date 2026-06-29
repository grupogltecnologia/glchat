-- Base para chat em tempo real e storage MinIO/S3.

ALTER TABLE `mensagens`
  ADD COLUMN IF NOT EXISTS `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `timestamp`;

UPDATE `mensagens`
SET `created_at` = `timestamp`
WHERE `created_at` IS NULL;

CREATE TABLE IF NOT EXISTS `storage_config` (
  `id` INT NOT NULL DEFAULT 1,
  `provider` VARCHAR(30) NOT NULL DEFAULT 'local',
  `endpoint` VARCHAR(500) NULL,
  `region` VARCHAR(100) NOT NULL DEFAULT 'us-east-1',
  `bucket` VARCHAR(255) NULL,
  `access_key` VARCHAR(255) NULL,
  `secret_key` TEXT NULL,
  `public_url` VARCHAR(500) NULL,
  `use_path_style` TINYINT(1) NOT NULL DEFAULT 1,
  `ativo` TINYINT(1) NOT NULL DEFAULT 0,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `storage_config` (`id`, `provider`, `region`, `use_path_style`, `ativo`)
VALUES (1, 'local', 'us-east-1', 1, 0)
ON DUPLICATE KEY UPDATE `id` = `id`;

CREATE TABLE IF NOT EXISTS `realtime_config` (
  `id` INT NOT NULL DEFAULT 1,
  `enabled` TINYINT(1) NOT NULL DEFAULT 1,
  `host` VARCHAR(255) NOT NULL DEFAULT '127.0.0.1',
  `port` INT NOT NULL DEFAULT 8090,
  `path` VARCHAR(100) NOT NULL DEFAULT '/chat',
  `public_url` VARCHAR(500) NULL,
  `poll_interval_ms` INT NOT NULL DEFAULT 1000,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `realtime_config` (`id`, `enabled`, `host`, `port`, `path`, `poll_interval_ms`)
VALUES (1, 1, '127.0.0.1', 8090, '/chat', 1000)
ON DUPLICATE KEY UPDATE `id` = `id`;
