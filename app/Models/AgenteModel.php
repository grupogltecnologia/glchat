<?php
require_once __DIR__ . '/../Core/Database.php';

class AgenteModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO agentes_ia (
                contaId, nome, conexaoId, instrucoes, modelo, criatividade, maxCreditos, ativo,
                conhecimento, cor, separarMensagens, ouvirAudio, analisarImagens, aparecerDigitando,
                pausarAtendimento, qntMsgHistorico, agruparMensagens, intervaloEntreMensagens,
                CRM, abrirAtendimento, notificarHumano, requisicaoHTTP
            ) VALUES (
                :contaId, :nome, :conexaoId, :instrucoes, :modelo, :criatividade, :maxCreditos, :ativo,
                :conhecimento, :cor, :separarMensagens, :ouvirAudio, :analisarImagens, :aparecerDigitando,
                :pausarAtendimento, :qntMsgHistorico, :agruparMensagens, :intervaloEntreMensagens,
                :CRM, :abrirAtendimento, :notificarHumano, :requisicaoHTTP
            )
        ");
        $stmt->execute([
            'contaId' => $dados['contaId'],
            'nome' => $dados['nome'] ?? null,
            'conexaoId' => $dados['conexaoId'] ?? null,
            'instrucoes' => $dados['instrucoes'] ?? null,
            'modelo' => $dados['modelo'] ?? 'gpt-4',
            'criatividade' => $dados['criatividade'] ?? 0.7,
            'maxCreditos' => $dados['maxCreditos'] ?? null,
            'ativo' => $dados['ativo'] ?? 1,
            'conhecimento' => json_encode($dados['conhecimento'] ?? []),
            'cor' => $dados['cor'] ?? '#3b82f6',
            'separarMensagens' => $dados['separarMensagens'] ?? 0,
            'ouvirAudio' => $dados['ouvirAudio'] ?? 0,
            'analisarImagens' => $dados['analisarImagens'] ?? 0,
            'aparecerDigitando' => $dados['aparecerDigitando'] ?? 1,
            'pausarAtendimento' => $dados['pausarAtendimento'] ?? 0,
            'qntMsgHistorico' => $dados['qntMsgHistorico'] ?? 10,
            'agruparMensagens' => $dados['agruparMensagens'] ?? 1,
            'intervaloEntreMensagens' => $dados['intervaloEntreMensagens'] ?? 2000,
            'CRM' => json_encode($dados['CRM'] ?? []),
            'abrirAtendimento' => json_encode($dados['abrirAtendimento'] ?? []),
            'notificarHumano' => json_encode($dados['notificarHumano'] ?? []),
            'requisicaoHTTP' => json_encode($dados['requisicaoHTTP'] ?? [])
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function listarPorConta(string $contaId): array {
        $stmt = $this->pdo->prepare("
            SELECT a.*, c.NomeConexao 
            FROM agentes_ia a
            LEFT JOIN conexoes c ON a.conexaoId = c.id
            WHERE a.contaId = :contaId 
            ORDER BY a.created_at DESC
        ");
        $stmt->execute(['contaId' => $contaId]);
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id, string $contaId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM agentes_ia WHERE id = :id AND contaId = :contaId");
        $stmt->execute(['id' => $id, 'contaId' => $contaId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function atualizar(int $id, string $contaId, array $dados): bool {
        $campos = [];
        $valores = ['id' => $id, 'contaId' => $contaId];
        
        $camposPermitidos = [
            'nome', 'conexaoId', 'instrucoes', 'modelo', 'criatividade', 'maxCreditos', 'ativo',
            'cor', 'separarMensagens', 'ouvirAudio', 'analisarImagens', 'aparecerDigitando',
            'pausarAtendimento', 'qntMsgHistorico', 'agruparMensagens', 'intervaloEntreMensagens'
        ];
        
        $camposJSON = ['conhecimento', 'CRM', 'abrirAtendimento', 'notificarHumano', 'requisicaoHTTP'];
        
        foreach ($dados as $campo => $valor) {
            if (in_array($campo, $camposPermitidos)) {
                $campos[] = "$campo = :$campo";
                $valores[$campo] = $valor;
            } elseif (in_array($campo, $camposJSON)) {
                $campos[] = "$campo = :$campo";
                $valores[$campo] = json_encode($valor);
            }
        }
        
        if (empty($campos)) return false;
        
        $sql = "UPDATE agentes_ia SET " . implode(', ', $campos) . " WHERE id = :id AND contaId = :contaId";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
    }

    public function deletar(int $id, string $contaId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM agentes_ia WHERE id = :id AND contaId = :contaId");
        return $stmt->execute(['id' => $id, 'contaId' => $contaId]);
    }
}
