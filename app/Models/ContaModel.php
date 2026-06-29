<?php
require_once __DIR__ . '/../Core/Database.php';

class ContaModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): string {
        $id = $this->gerarUUID();
        $stmt = $this->pdo->prepare("
            INSERT INTO contas (id, nome, status, plano)
            VALUES (:id, :nome, :status, :plano)
        ");
        $stmt->execute([
            'id' => $id,
            'nome' => $dados['nome'] ?? 'Nova Conta',
            'status' => $dados['status'] ?? 'ativo',
            'plano' => $dados['plano'] ?? 'free'
        ]);
        return $id;
    }

    public function buscarPorId($id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM contas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function atualizar(string $id, array $dados): bool {
        $campos = [];
        $valores = ['id' => $id];
        
        foreach ($dados as $campo => $valor) {
            if (in_array($campo, ['email', 'status', 'plano', 'dataValidade', 'tokens', 'apikey_gpt'])) {
                $campos[] = "$campo = :$campo";
                $valores[$campo] = $valor;
            }
        }
        
        if (empty($campos)) return false;
        
        $sql = "UPDATE contas SET " . implode(', ', $campos) . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
    }

    public function verificarStatus($contaId): bool {
        $conta = $this->buscarPorId($contaId);
        if (!$conta) return false;
        
        // Aceitar tanto 1 (int) quanto 'ativo' (string)
        if ($conta['status'] == 1 || $conta['status'] === 'ativo') {
            // Verificar data de validade se existir
            if (isset($conta['dataValidade']) && $conta['dataValidade']) {
                $dataValidade = strtotime($conta['dataValidade']);
                $hoje = strtotime(date('Y-m-d'));
                return $dataValidade >= $hoje;
            }
            return true;
        }
        
        return false;
    }

    private function gerarUUID(): string {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
