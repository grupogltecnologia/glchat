<?php
require_once __DIR__ . '/../Core/Database.php';

class DisparoModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO disparos (
                contaId, NomeDisparo, Mensagens, TipoDisparo, TotalDisparos, StatusDisparo,
                idListas, idConexoes, idEtiquetas, intervaloMin, intervaloMax, 
                PausaAposMensagens, PausaMinutos, StartTime, EndTime, DiasSelecionados, DataAgendamento, apiOficial
            ) VALUES (
                :contaId, :nomeDisparo, :mensagens, :tipoDisparo, :totalDisparos, :statusDisparo,
                :idListas, :idConexoes, :idEtiquetas, :intervaloMin, :intervaloMax,
                :pausaAposMensagens, :pausaMinutos, :startTime, :endTime, :diasSelecionados, :dataAgendamento, :apiOficial
            )
        ");
        $stmt->execute([
            'contaId' => $dados['contaId'],
            'nomeDisparo' => $dados['nomeDisparo'] ?? null,
            'mensagens' => json_encode($dados['mensagens'] ?? []),
            'tipoDisparo' => $dados['tipoDisparo'] ?? 'imediato',
            'totalDisparos' => $dados['totalDisparos'] ?? 0,
            'statusDisparo' => $dados['statusDisparo'] ?? 'pendente',
            'idListas' => json_encode($dados['idListas'] ?? []),
            'idConexoes' => json_encode($dados['idConexoes'] ?? []),
            'idEtiquetas' => json_encode($dados['idEtiquetas'] ?? []),
            'intervaloMin' => $dados['intervaloMin'] ?? 5,
            'intervaloMax' => $dados['intervaloMax'] ?? 10,
            'pausaAposMensagens' => $dados['pausaAposMensagens'] ?? 20,
            'pausaMinutos' => $dados['pausaMinutos'] ?? 5,
            'startTime' => $dados['startTime'] ?? null,
            'endTime' => $dados['endTime'] ?? null,
            'diasSelecionados' => json_encode($dados['diasSelecionados'] ?? []),
            'dataAgendamento' => $dados['dataAgendamento'] ?? null,
            'apiOficial' => !empty($dados['apiOficial']) ? 1 : 0
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function listarPorConta(string $contaId): array {
        $stmt = $this->pdo->prepare("
            SELECT d.*,
                   (SELECT COUNT(*) FROM detalhes_disparos dd WHERE dd.idDisparo = d.id) as totalEnviados
            FROM disparos d
            WHERE d.contaId = :contaId 
            ORDER BY d.created_at DESC
        ");
        $stmt->execute(['contaId' => $contaId]);
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id, string $contaId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM disparos WHERE id = :id AND contaId = :contaId");
        $stmt->execute(['id' => $id, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function atualizarStatus(int $id, string $contaId, string $status, ?int $mensagensDisparadas = null): bool {
        $sql = "UPDATE disparos SET StatusDisparo = :status";
        $params = ['id' => $id, 'contaId' => $contaId, 'status' => $status];
        
        if ($mensagensDisparadas !== null) {
            $sql .= ", MensagensDisparadas = :mensagensDisparadas";
            $params['mensagensDisparadas'] = $mensagensDisparadas;
        }
        
        $sql .= " WHERE id = :id AND contaId = :contaId";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function deletar(int $id, string $contaId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM disparos WHERE id = :id AND contaId = :contaId");
        return $stmt->execute(['id' => $id, 'contaId' => $contaId]);
    }

    public function listarDetalhes(int $disparoId, string $contaId): array {
        $stmt = $this->pdo->prepare("
            SELECT dd.*, c.nome as nomeContato, c.telefone
            FROM detalhes_disparos dd
            INNER JOIN disparos d ON dd.idDisparo = d.id
            LEFT JOIN contatos c ON dd.idContato = c.id
            WHERE dd.idDisparo = :disparoId AND d.contaId = :contaId
            ORDER BY dd.dataEnvio DESC
        ");
        $stmt->execute(['disparoId' => $disparoId, 'contaId' => $contaId]);
        return $stmt->fetchAll();
    }
}
