<?php
require_once __DIR__ . '/../Core/Database.php';

class ConversaModel {
    private PDO $pdo;
    private string $table = 'conversas';

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} (
                contaId, idAgente, idConexao, telefone, contatoId, nomeConversa, 
                fotoPerfil, pausado, lida, statusAtendimento, atendente, telefoneConversa
            ) VALUES (
                :contaId, :idAgente, :idConexao, :telefone, :contatoId, :nomeConversa,
                :fotoPerfil, :pausado, :lida, :statusAtendimento, :atendente, :telefoneConversa
            )
        ");
        $telefone = $dados['telefone'] ?? $dados['telefoneConversa'] ?? null;
        $stmt->execute([
            'contaId' => $dados['contaId'],
            'idAgente' => $dados['idAgente'] ?? null,
            'idConexao' => $dados['idConexao'] ?? null,
            'telefone' => $telefone,
            'contatoId' => $dados['contatoId'] ?? null,
            'nomeConversa' => $dados['nomeConversa'] ?? null,
            'fotoPerfil' => $dados['fotoPerfil'] ?? null,
            'pausado' => $dados['pausado'] ?? 0,
            'lida' => $dados['lida'] ?? 0,
            'statusAtendimento' => $dados['statusAtendimento'] ?? 'aguardando',
            'atendente' => $dados['atendente'] ?? null,
            'telefoneConversa' => $telefone
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function listarPorConta(string $contaId, ?string $status = null): array {
        $sql = "
            SELECT c.*, 
                   a.nome as nomeAgente,
                   con.NomeConexao,
                   (SELECT COALESCE(m.mensagem, m.conteudo) FROM mensagens m WHERE m.conversaId = c.id AND m.apagada = 0 ORDER BY m.created_at DESC LIMIT 1) as ultimaMensagemTexto,
                   (SELECT m.tipoMensagem FROM mensagens m WHERE m.conversaId = c.id AND m.apagada = 0 ORDER BY m.created_at DESC LIMIT 1) as ultimaMensagemTipo,
                   (SELECT COUNT(*) FROM mensagens m WHERE m.conversaId = c.id AND m.fromMe = 0 AND c.lida = 0) as naoLidas
            FROM {$this->table} c
            LEFT JOIN agentes_ia a ON c.idAgente = a.id
            LEFT JOIN conexoes con ON c.idConexao = con.id
            WHERE c.contaId = :contaId
        ";
        
        $params = ['contaId' => $contaId];
        
        if ($status) {
            $sql .= " AND c.statusAtendimento = :status";
            $params['status'] = $status;
        }
        
        $sql .= " ORDER BY c.ultimaMensagem DESC, c.created_at DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id, string $contaId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id AND contaId = :contaId");
        $stmt->execute(['id' => $id, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function buscarPorTelefone(string $telefone, int $idConexao, string $contaId): ?array {
        $stmt = $this->pdo->prepare("
            SELECT * FROM {$this->table} 
            WHERE (telefone = :telefone OR telefoneConversa = :telefone) AND idConexao = :idConexao AND contaId = :contaId 
            LIMIT 1
        ");
        $stmt->execute(['telefone' => $telefone, 'idConexao' => $idConexao, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function atualizar(int $id, string $contaId, array $dados): bool {
        $campos = [];
        $valores = ['id' => $id, 'contaId' => $contaId];
        
        $camposPermitidos = [
            'pausado', 'pausaAte', 'lida', 'statusAtendimento', 'nomeConversa', 
            'fotoPerfil', 'dataFechamento', 'nota', 'atendente', 'ultimaMensagem'
        ];
        
        foreach ($dados as $campo => $valor) {
            if (in_array($campo, $camposPermitidos)) {
                $campos[] = "$campo = :$campo";
                $valores[$campo] = $valor;
            }
        }
        
        if (empty($campos)) return false;
        
        $sql = "UPDATE {$this->table} SET " . implode(', ', $campos) . " WHERE id = :id AND contaId = :contaId";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
    }

    public function marcarComoLida(int $id, string $contaId): bool {
        return $this->atualizar($id, $contaId, ['lida' => 1]);
    }

    public function contarNaoLidas(string $contaId): int {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE contaId = :contaId AND lida = 0");
        $stmt->execute(['contaId' => $contaId]);
        return (int)$stmt->fetch()['total'];
    }
}
