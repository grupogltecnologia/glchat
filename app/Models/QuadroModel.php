<?php
require_once __DIR__ . '/../Core/Database.php';

class QuadroModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO quadros (contaId, nome, descricao, cor, icone)
            VALUES (:contaId, :nome, :descricao, :cor, :icone)
        ");
        $stmt->execute([
            'contaId' => $dados['contaId'],
            'nome' => $dados['nome'] ?? null,
            'descricao' => $dados['descricao'] ?? null,
            'cor' => $dados['cor'] ?? '#3b82f6',
            'icone' => $dados['icone'] ?? null
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function listarPorConta(string $contaId): array {
        $stmt = $this->pdo->prepare("
            SELECT q.*,
                   (SELECT COUNT(*) FROM etapas_quadros e WHERE e.quadroId = q.id) as totalEtapas,
                   (SELECT COUNT(*) FROM cards_quadros c 
                    INNER JOIN etapas_quadros e ON c.etapaQuadroId = e.id 
                    WHERE e.quadroId = q.id) as totalCards
            FROM quadros q
            WHERE q.contaId = :contaId 
            ORDER BY q.created_at DESC
        ");
        $stmt->execute(['contaId' => $contaId]);
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id, string $contaId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM quadros WHERE id = :id AND contaId = :contaId");
        $stmt->execute(['id' => $id, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function atualizar(int $id, string $contaId, array $dados): bool {
        $campos = [];
        $valores = ['id' => $id, 'contaId' => $contaId];
        
        foreach ($dados as $campo => $valor) {
            if (in_array($campo, ['nome', 'descricao', 'cor', 'icone'])) {
                $campos[] = "$campo = :$campo";
                $valores[$campo] = $valor;
            }
        }
        
        if (empty($campos)) return false;
        
        $sql = "UPDATE quadros SET " . implode(', ', $campos) . " WHERE id = :id AND contaId = :contaId";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
    }

    public function deletar(int $id, string $contaId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM quadros WHERE id = :id AND contaId = :contaId");
        return $stmt->execute(['id' => $id, 'contaId' => $contaId]);
    }

    public function listarEtapas(int $quadroId, string $contaId): array {
        $stmt = $this->pdo->prepare("
            SELECT e.*,
                   (SELECT COUNT(*) FROM cards_quadros c WHERE c.etapaQuadroId = e.id) as totalCards
            FROM etapas_quadros e
            INNER JOIN quadros q ON e.quadroId = q.id
            WHERE e.quadroId = :quadroId AND q.contaId = :contaId
            ORDER BY e.ordem ASC
        ");
        $stmt->execute(['quadroId' => $quadroId, 'contaId' => $contaId]);
        return $stmt->fetchAll();
    }

    public function criarEtapa(int $quadroId, string $contaId, array $dados): ?int {
        $quadro = $this->buscarPorId($quadroId, $contaId);
        if (!$quadro) return null;
        
        $stmt = $this->pdo->prepare("
            INSERT INTO etapas_quadros (quadroId, contaId, nome, ordem)
            VALUES (:quadroId, :contaId, :nome, :ordem)
        ");
        $stmt->execute([
            'quadroId' => $quadroId,
            'contaId' => $contaId,
            'nome' => $dados['nome'],
            'ordem' => $dados['ordem'] ?? 0
        ]);
        return (int)$this->pdo->lastInsertId();
    }
}
