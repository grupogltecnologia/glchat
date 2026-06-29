<?php
require_once __DIR__ . '/../Core/Database.php';

class ConexaoModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO conexoes (
                contaId, instanceName, NomeConexao, Telefone, FotoPerfil, Apikey, idAgente,
                apiOficial, provider, access_token, expires_in, business_id, waba_id, phone_number_id, expires_at
            ) VALUES (
                :contaId, :instanceName, :nomeConexao, :telefone, :fotoPerfil, :apikey, :idAgente,
                :apiOficial, :provider, :access_token, :expires_in, :business_id, :waba_id, :phone_number_id, :expires_at
            )
        ");
        $provider = $dados['provider'] ?? (!empty($dados['apiOficial']) ? 'oficial' : 'evolution');
        if (!in_array($provider, ['evolution', 'oficial', 'uazapi'], true)) {
            $provider = 'evolution';
        }
        $stmt->execute([
            'contaId' => $dados['contaId'],
            'instanceName' => $dados['instanceName'] ?? null,
            'nomeConexao' => $dados['nomeConexao'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'fotoPerfil' => $dados['fotoPerfil'] ?? null,
            'apikey' => $dados['apikey'] ?? null,
            'idAgente' => $dados['idAgente'] ?? null,
            'apiOficial' => $provider === 'oficial' || !empty($dados['apiOficial']) ? 1 : 0,
            'provider' => $provider,
            'access_token' => $dados['access_token'] ?? null,
            'expires_in' => $dados['expires_in'] ?? null,
            'business_id' => $dados['business_id'] ?? null,
            'waba_id' => $dados['waba_id'] ?? null,
            'phone_number_id' => $dados['phone_number_id'] ?? null,
            'expires_at' => $dados['expires_at'] ?? null
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function listarPorConta(string $contaId): array {
        $stmt = $this->pdo->prepare("
            SELECT c.*, a.nome as nomeAgente 
            FROM conexoes c
            LEFT JOIN agentes_ia a ON c.idAgente = a.id
            WHERE c.contaId = :contaId 
            ORDER BY c.created_at DESC
        ");
        $stmt->execute(['contaId' => $contaId]);
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id, string $contaId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM conexoes WHERE id = :id AND contaId = :contaId");
        $stmt->execute(['id' => $id, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function atualizar(int $id, string $contaId, array $dados): bool {
        $campos = [];
        $valores = ['id' => $id, 'contaId' => $contaId];
        
        foreach ($dados as $campo => $valor) {
            $permitidos = [
                'instanceName', 'NomeConexao', 'Telefone', 'FotoPerfil', 'Apikey', 'apikey', 'idAgente',
                'statusConexao', 'numeroConexao',
                'apiOficial', 'provider', 'access_token', 'expires_in', 'business_id', 'waba_id', 'phone_number_id',
                'expires_at', 'metaPhoneQualityEvent', 'metaPhoneQualityLimit', 'metaPhoneQualityUpdatedAt',
                'metaMessagingLimit', 'metaMaxPhoneNumbers', 'metaBusinessCapabilityUpdatedAt',
                'metaAccountEvent', 'metaAccountUpdate', 'metaAccountUpdatedAt', 'metaUltimoAlerta',
                'metaAlertasUpdatedAt', 'metaPagamento', 'metaPagamentoUpdatedAt', 'metaNameStatus',
                'metaNewDisplayName', 'metaNewNameStatus', 'metaPrimaryFundingId', 'metaWabaStatus',
                'metaWabaName', 'metaWabaCurrency', 'metaWabaTimezoneId', 'metaPerfil',
                'metaPerfilUpdatedAt', 'metaVerifiedName', 'metaPhoneStatus', 'metaQualityRating',
                'metaBusinessVerificationStatus', 'metaAccountReviewStatus', 'metaDadosUpdatedAt',
                'metaPinVerificacao'
            ];

            if ($campo === 'apikey') {
                $campo = 'Apikey';
            }

            if (in_array($campo, $permitidos, true)) {
                $campos[] = "$campo = :$campo";
                $valores[$campo] = is_array($valor) ? json_encode($valor) : $valor;
            }
        }
        
        if (empty($campos)) return false;
        
        $sql = "UPDATE conexoes SET " . implode(', ', $campos) . " WHERE id = :id AND contaId = :contaId";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
    }

    public function deletar(int $id, string $contaId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM conexoes WHERE id = :id AND contaId = :contaId");
        return $stmt->execute(['id' => $id, 'contaId' => $contaId]);
    }
}
