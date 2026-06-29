<?php
require_once __DIR__ . '/../Core/Database.php';

class TemplateMetaModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function listarPorConexao(int $conexaoId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM templates_meta WHERE conexaoId = :conexaoId ORDER BY updated_at DESC");
        $stmt->execute(['conexaoId' => $conexaoId]);
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id, int $conexaoId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM templates_meta WHERE id = :id AND conexaoId = :conexaoId");
        $stmt->execute(['id' => $id, 'conexaoId' => $conexaoId]);
        $template = $stmt->fetch();
        return $template ?: null;
    }

    public function salvar(array $dados): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO templates_meta (
                conexaoId, wabaId, metaTemplateId, nome, idioma, categoria,
                status, qualidade, motivoRejeicao, componentes, variaveisCampos
            ) VALUES (
                :conexaoId, :wabaId, :metaTemplateId, :nome, :idioma, :categoria,
                :status, :qualidade, :motivoRejeicao, :componentes, :variaveisCampos
            )
        ");

        $stmt->execute([
            'conexaoId' => $dados['conexaoId'],
            'wabaId' => $dados['wabaId'] ?? null,
            'metaTemplateId' => $dados['metaTemplateId'] ?? null,
            'nome' => $dados['nome'] ?? null,
            'idioma' => $dados['idioma'] ?? 'pt_BR',
            'categoria' => $dados['categoria'] ?? null,
            'status' => $dados['status'] ?? 'PENDING',
            'qualidade' => $dados['qualidade'] ?? null,
            'motivoRejeicao' => $dados['motivoRejeicao'] ?? null,
            'componentes' => json_encode($dados['componentes'] ?? []),
            'variaveisCampos' => json_encode($dados['variaveisCampos'] ?? []),
        ]);

        return (int)$this->pdo->lastInsertId();
    }

    public function remover(int $id, int $conexaoId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM templates_meta WHERE id = :id AND conexaoId = :conexaoId");
        return $stmt->execute(['id' => $id, 'conexaoId' => $conexaoId]);
    }
}
