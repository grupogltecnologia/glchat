<?php
require_once __DIR__ . '/../Core/Database.php';

class MetaConfigModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function obter(): array {
        $stmt = $this->pdo->query("SELECT * FROM config_api_oficial WHERE id = 1");
        $config = $stmt->fetch();

        if ($config) {
            $config['app_secret_configurado'] = !empty($config['app_secret']);
            unset($config['app_secret']);
            return $config;
        }

        return [
            'id' => 1,
            'app_id' => null,
            'config_id' => null,
            'verifyToken' => 'hublabel-meta-webhook',
            'visivel' => 0,
            'app_secret_configurado' => false,
        ];
    }

    public function obterComSegredo(): ?array {
        $stmt = $this->pdo->query("SELECT * FROM config_api_oficial WHERE id = 1");
        $config = $stmt->fetch();
        return $config ?: null;
    }

    public function salvar(array $dados): bool {
        $atual = $this->obterComSegredo();
        $appSecret = array_key_exists('app_secret', $dados) && $dados['app_secret'] !== ''
            ? $dados['app_secret']
            : ($atual['app_secret'] ?? null);

        $stmt = $this->pdo->prepare("
            INSERT INTO config_api_oficial (id, app_id, app_secret, config_id, verifyToken, visivel)
            VALUES (1, :app_id, :app_secret, :config_id, :verifyToken, :visivel)
            ON DUPLICATE KEY UPDATE
                app_id = VALUES(app_id),
                app_secret = VALUES(app_secret),
                config_id = VALUES(config_id),
                verifyToken = VALUES(verifyToken),
                visivel = VALUES(visivel)
        ");

        return $stmt->execute([
            'app_id' => $dados['app_id'] ?? ($atual['app_id'] ?? null),
            'app_secret' => $appSecret,
            'config_id' => $dados['config_id'] ?? ($atual['config_id'] ?? null),
            'verifyToken' => $dados['verifyToken'] ?? ($atual['verifyToken'] ?? 'hublabel-meta-webhook'),
            'visivel' => !empty($dados['visivel']) ? 1 : 0,
        ]);
    }
}
