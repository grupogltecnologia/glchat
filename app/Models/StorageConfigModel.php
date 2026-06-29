<?php
require_once __DIR__ . '/../Core/Database.php';

class StorageConfigModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function obter(bool $comSegredo = false): array {
        $stmt = $this->pdo->query("SELECT * FROM storage_config WHERE id = 1");
        $config = $stmt->fetch() ?: [
            'id' => 1,
            'provider' => 'local',
            'endpoint' => null,
            'region' => 'us-east-1',
            'bucket' => null,
            'access_key' => null,
            'secret_key' => null,
            'public_url' => null,
            'use_path_style' => 1,
            'ativo' => 0,
        ];

        $config['secret_key_configurado'] = !empty($config['secret_key']);
        if (!$comSegredo) {
            unset($config['secret_key']);
        }

        return $config;
    }

    public function salvar(array $dados): bool {
        $atual = $this->obter(true);
        $secretKey = array_key_exists('secret_key', $dados) && $dados['secret_key'] !== ''
            ? $dados['secret_key']
            : ($atual['secret_key'] ?? null);

        $stmt = $this->pdo->prepare("
            INSERT INTO storage_config (
                id, provider, endpoint, region, bucket, access_key, secret_key,
                public_url, use_path_style, ativo
            ) VALUES (
                1, :provider, :endpoint, :region, :bucket, :access_key, :secret_key,
                :public_url, :use_path_style, :ativo
            )
            ON DUPLICATE KEY UPDATE
                provider = VALUES(provider),
                endpoint = VALUES(endpoint),
                region = VALUES(region),
                bucket = VALUES(bucket),
                access_key = VALUES(access_key),
                secret_key = VALUES(secret_key),
                public_url = VALUES(public_url),
                use_path_style = VALUES(use_path_style),
                ativo = VALUES(ativo)
        ");

        return $stmt->execute([
            'provider' => $dados['provider'] ?? ($atual['provider'] ?? 'local'),
            'endpoint' => rtrim($dados['endpoint'] ?? ($atual['endpoint'] ?? ''), '/') ?: null,
            'region' => $dados['region'] ?? ($atual['region'] ?? 'us-east-1'),
            'bucket' => $dados['bucket'] ?? ($atual['bucket'] ?? null),
            'access_key' => $dados['access_key'] ?? ($atual['access_key'] ?? null),
            'secret_key' => $secretKey,
            'public_url' => rtrim($dados['public_url'] ?? ($atual['public_url'] ?? ''), '/') ?: null,
            'use_path_style' => !empty($dados['use_path_style']) ? 1 : 0,
            'ativo' => !empty($dados['ativo']) ? 1 : 0,
        ]);
    }
}
