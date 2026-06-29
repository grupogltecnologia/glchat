<?php
require_once __DIR__ . '/../Core/Database.php';

class MensagemModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO mensagens (
                contaId, conexaoId, conversaId, mensagem, conteudo, tipoMensagem, tipo, remetente, arquivoUrl,
                fromMe, messageEvolutionId, metaMessageId, metaStatus, mensagemRespondida, enviada, IA, favorita
            ) VALUES (
                :contaId, :conexaoId, :conversaId, :mensagem, :conteudo, :tipoMensagem, :tipo, :remetente, :arquivoUrl,
                :fromMe, :messageEvolutionId, :metaMessageId, :metaStatus, :mensagemRespondida, :enviada, :IA, :favorita
            )
        ");
        $mensagem = $dados['mensagem'] ?? $dados['conteudo'] ?? null;
        $fromMe = (int)($dados['fromMe'] ?? 0);
        $stmt->execute([
            'contaId' => $dados['contaId'],
            'conexaoId' => $dados['conexaoId'] ?? null,
            'conversaId' => $dados['conversaId'],
            'mensagem' => $mensagem,
            'conteudo' => $mensagem,
            'tipoMensagem' => $dados['tipoMensagem'] ?? 'text',
            'tipo' => $fromMe ? 'enviada' : 'recebida',
            'remetente' => $fromMe ? 'usuario' : 'contato',
            'arquivoUrl' => $dados['arquivoUrl'] ?? null,
            'fromMe' => $fromMe,
            'messageEvolutionId' => $dados['messageEvolutionId'] ?? null,
            'metaMessageId' => $dados['metaMessageId'] ?? null,
            'metaStatus' => $dados['metaStatus'] ?? null,
            'mensagemRespondida' => $dados['mensagemRespondida'] ?? null,
            'enviada' => $dados['enviada'] ?? 1,
            'IA' => $dados['IA'] ?? 0,
            'favorita' => $dados['favorita'] ?? 0
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function listarPorConversa(int $conversaId, string $contaId, int $limit = 50): array {
        $stmt = $this->pdo->prepare("
            SELECT *,
                   COALESCE(mensagem, conteudo) as mensagem,
                   COALESCE(conteudo, mensagem) as conteudo
            FROM mensagens 
            WHERE conversaId = :conversaId AND contaId = :contaId AND apagada = 0
            ORDER BY created_at ASC
            LIMIT :limit
        ");
        $stmt->bindValue('conversaId', $conversaId, PDO::PARAM_INT);
        $stmt->bindValue('contaId', $contaId);
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id, string $contaId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM mensagens WHERE id = :id AND contaId = :contaId");
        $stmt->execute(['id' => $id, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function marcarComoApagada(int $id, string $contaId): bool {
        $stmt = $this->pdo->prepare("UPDATE mensagens SET apagada = 1 WHERE id = :id AND contaId = :contaId");
        return $stmt->execute(['id' => $id, 'contaId' => $contaId]);
    }

    public function marcarComoFavorita(int $id, string $contaId, bool $favorita = true): bool {
        $stmt = $this->pdo->prepare("UPDATE mensagens SET favorita = :favorita WHERE id = :id AND contaId = :contaId");
        return $stmt->execute(['id' => $id, 'contaId' => $contaId, 'favorita' => $favorita ? 1 : 0]);
    }

    public function contarPorConversa(int $conversaId, string $contaId): int {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM mensagens WHERE conversaId = :conversaId AND contaId = :contaId AND apagada = 0");
        $stmt->execute(['conversaId' => $conversaId, 'contaId' => $contaId]);
        return (int)$stmt->fetch()['total'];
    }
}
