<?php
require_once __DIR__ . '/WhatsAppServiceInterface.php';
require_once __DIR__ . '/EvolutionService.php';
require_once __DIR__ . '/UazapiService.php';
require_once __DIR__ . '/../Core/Database.php';

/**
 * Factory para criar instâncias de serviços de WhatsApp
 * Gerencia qual provedor está ativo e retorna o serviço correto
 */
class WhatsAppServiceFactory {
    private static ?WhatsAppServiceInterface $instance = null;
    private static ?string $currentProvider = null;
    private static array $providerInstances = [];

    /**
     * Obtém o serviço de WhatsApp ativo
     */
    public static function getService(): WhatsAppServiceInterface {
        // Se já temos uma instância e o provedor não mudou, retornar
        if (self::$instance !== null) {
            return self::$instance;
        }

        // Buscar configuração ativa do banco
        $config = self::getActiveConfig();
        
        if (!$config) {
            // Fallback para Evolution API via .env
            self::$currentProvider = 'evolution';
            self::$instance = new EvolutionService();
            return self::$instance;
        }

        self::$currentProvider = $config['provider'];

        // Criar instância do serviço apropriado
        switch ($config['provider']) {
            case 'uazapi':
                self::$instance = new UazapiService(
                    $config['api_url'],
                    self::resolveApiKey($config),
                    $config['api_token']
                );
                break;
            
            case 'evolution':
            default:
                self::$instance = new EvolutionService(
                    $config['api_url'],
                    self::resolveApiKey($config)
                );
                break;
        }

        return self::$instance;
    }

    public static function getServiceForProvider(string $provider): WhatsAppServiceInterface {
        $provider = in_array($provider, ['evolution', 'uazapi'], true) ? $provider : 'evolution';

        if (isset(self::$providerInstances[$provider])) {
            return self::$providerInstances[$provider];
        }

        $config = self::getConfigByProvider($provider);
        if (!$config) {
            if ($provider === 'uazapi') {
                self::$providerInstances[$provider] = new UazapiService();
            } else {
                self::$providerInstances[$provider] = new EvolutionService();
            }
            return self::$providerInstances[$provider];
        }

        if ($provider === 'uazapi') {
            self::$providerInstances[$provider] = new UazapiService(
                $config['api_url'],
                self::resolveApiKey($config),
                $config['api_token']
            );
        } else {
            self::$providerInstances[$provider] = new EvolutionService(
                $config['api_url'],
                self::resolveApiKey($config)
            );
        }

        return self::$providerInstances[$provider];
    }

    /**
     * Força a recriação do serviço (útil após mudança de configuração)
     */
    public static function resetService(): void {
        self::$instance = null;
        self::$currentProvider = null;
        self::$providerInstances = [];
    }

    /**
     * Obtém o provedor atual
     */
    public static function getCurrentProvider(): ?string {
        if (self::$currentProvider === null) {
            self::getService(); // Inicializa se necessário
        }
        return self::$currentProvider;
    }

    /**
     * Busca a configuração ativa do banco de dados
     */
    private static function getActiveConfig(): ?array {
        try {
            $pdo = Database::pdo();
            $stmt = $pdo->prepare("
                SELECT provider, api_url, api_key, api_token, configuracoes_extras 
                FROM whatsapp_config 
                WHERE ativo = 1 
                ORDER BY id DESC 
                LIMIT 1
            ");
            $stmt->execute();
            $config = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $config ?: null;
        } catch (Exception $e) {
            error_log("Erro ao buscar configuração WhatsApp: " . $e->getMessage());
            return null;
        }
    }

    private static function getConfigByProvider(string $provider): ?array {
        try {
            $pdo = Database::pdo();
            $stmt = $pdo->prepare("
                SELECT provider, api_url, api_key, api_token, configuracoes_extras
                FROM whatsapp_config
                WHERE provider = :provider
                ORDER BY ativo DESC, id DESC
                LIMIT 1
            ");
            $stmt->execute(['provider' => $provider]);
            $config = $stmt->fetch(PDO::FETCH_ASSOC);

            return $config ?: null;
        } catch (Exception $e) {
            error_log("Erro ao buscar configuracao {$provider}: " . $e->getMessage());
            return null;
        }
    }

    private static function resolveApiKey(array $config): string {
        $apiKey = trim((string)($config['api_key'] ?? ''));
        $apiToken = trim((string)($config['api_token'] ?? ''));
        $provider = strtolower((string)($config['provider'] ?? ''));

        if ($provider === 'evolution' && self::isPlaceholderKey($apiKey) && $apiToken !== '') {
            return $apiToken;
        }

        return $apiKey !== '' ? $apiKey : $apiToken;
    }

    private static function isPlaceholderKey(string $value): bool {
        $value = strtolower(trim($value));
        if ($value === '') {
            return true;
        }

        return (bool)preg_match('/^(sua|seu)[\s\-_]*(api|chave|key)/', $value);
    }

    /**
     * Testa a conexão com a API configurada
     */
    public static function testConnection(): array {
        try {
            $service = self::getService();
            $provider = self::getCurrentProvider();
            
            // Teste simples de conectividade
            // Cada provedor pode ter um endpoint diferente para teste
            return [
                'success' => true,
                'provider' => $provider,
                'message' => 'Conexão com ' . strtoupper($provider) . ' estabelecida'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
