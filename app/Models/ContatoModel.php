<?php
require_once __DIR__ . '/../Core/Database.php';

class ContatoModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO contatos (contaId, nome, telefone, email, idLista, variaveis, tipo, fotoPerfil, lid, validado)
            VALUES (:contaId, :nome, :telefone, :email, :idLista, :variaveis, :tipo, :fotoPerfil, :lid, :validado)
        ");
        $stmt->execute([
            'contaId' => $dados['contaId'],
            'nome' => $dados['nome'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'email' => $dados['email'] ?? null,
            'idLista' => $dados['idLista'] ?? null,
            'variaveis' => json_encode($dados['variaveis'] ?? []),
            'tipo' => $dados['tipo'] ?? 'contato',
            'fotoPerfil' => $dados['fotoPerfil'] ?? null,
            'lid' => $dados['lid'] ?? null,
            'validado' => !empty($dados['validado']) ? 1 : 0
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function listarPorConta(string $contaId, int $limit = 100, int $offset = 0): array {
        $stmt = $this->pdo->prepare("
            SELECT * FROM contatos 
            WHERE contaId = :contaId 
            ORDER BY created_at DESC 
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue('contaId', $contaId);
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id, string $contaId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM contatos WHERE id = :id AND contaId = :contaId");
        $stmt->execute(['id' => $id, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function buscarPorTelefone(string $telefone, string $contaId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM contatos WHERE telefone = :telefone AND contaId = :contaId LIMIT 1");
        $stmt->execute(['telefone' => $telefone, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function atualizar(int $id, string $contaId, array $dados): bool {
        $campos = [];
        $valores = ['id' => $id, 'contaId' => $contaId];
        
        foreach ($dados as $campo => $valor) {
            if ($campo === 'variaveis') {
                $campos[] = "variaveis = :variaveis";
                $valores['variaveis'] = json_encode($valor);
            } elseif (in_array($campo, ['nome', 'telefone', 'email', 'idLista', 'tipo', 'fotoPerfil', 'lid', 'validado'])) {
                $campos[] = "$campo = :$campo";
                $valores[$campo] = $valor;
            }
        }
        
        if (empty($campos)) return false;
        
        $sql = "UPDATE contatos SET " . implode(', ', $campos) . " WHERE id = :id AND contaId = :contaId";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
    }

    public function deletar(int $id, string $contaId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM contatos WHERE id = :id AND contaId = :contaId");
        return $stmt->execute(['id' => $id, 'contaId' => $contaId]);
    }

    public function contarPorConta(string $contaId): int {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM contatos WHERE contaId = :contaId");
        $stmt->execute(['contaId' => $contaId]);
        return (int)$stmt->fetch()['total'];
    }
}
