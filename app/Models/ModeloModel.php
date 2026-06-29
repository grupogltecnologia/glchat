<?php
require_once __DIR__ . '/../Core/Database.php';

class ModeloModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function listar(): array {
        $modelos = $this->pdo->query("SELECT id, nome, tipo, descricao, created_at, updated_at FROM modelos ORDER BY created_at DESC")->fetchAll();

        foreach ($modelos as &$modelo) {
            $modelo['etapas'] = $this->listarEtapas((int)$modelo['id']);
            $modelo['agente'] = $modelo['tipo'] === 'agente_ia' ? $this->obterAgente((int)$modelo['id']) : null;
        }

        return $modelos;
    }

    public function salvar(array $dados): int {
        $id = isset($dados['id']) && $dados['id'] !== '' ? (int)$dados['id'] : null;
        $nome = trim($dados['nome'] ?? '');
        $tipo = $dados['tipo'] ?? 'crm';
        $descricao = trim($dados['descricao'] ?? '');
        $etapas = is_array($dados['etapas'] ?? null) ? $dados['etapas'] : [];

        if ($nome === '') {
            throw new InvalidArgumentException('Informe o nome do modelo.');
        }

        if (!in_array($tipo, ['crm', 'agente_ia'], true)) {
            throw new InvalidArgumentException('Tipo de modelo invalido.');
        }

        $this->pdo->beginTransaction();

        try {
            if ($id) {
                $stmt = $this->pdo->prepare("UPDATE modelos SET nome = ?, tipo = ?, descricao = ? WHERE id = ?");
                $stmt->execute([$nome, $tipo, $descricao ?: null, $id]);
            } else {
                $stmt = $this->pdo->prepare("INSERT INTO modelos (nome, tipo, descricao) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $tipo, $descricao ?: null]);
                $id = (int)$this->pdo->lastInsertId();
            }

            $stmt = $this->pdo->prepare("DELETE FROM modelos_etapas WHERE modeloId = ?");
            $stmt->execute([$id]);
            $this->salvarEtapas($id, $etapas);

            $stmt = $this->pdo->prepare("DELETE FROM modelos_agentes_ia WHERE modeloId = ?");
            $stmt->execute([$id]);
            if ($tipo === 'agente_ia') {
                $this->salvarAgente($id, is_array($dados['agente'] ?? null) ? $dados['agente'] : []);
            }

            $this->pdo->commit();
            return $id;
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function excluir(int $id): void {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("DELETE FROM modelos_etapas WHERE modeloId = ?");
            $stmt->execute([$id]);
            $stmt = $this->pdo->prepare("DELETE FROM modelos_agentes_ia WHERE modeloId = ?");
            $stmt->execute([$id]);
            $stmt = $this->pdo->prepare("DELETE FROM modelos WHERE id = ?");
            $stmt->execute([$id]);
            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    private function listarEtapas(int $modeloId): array {
        $stmt = $this->pdo->prepare("SELECT id, modeloId, nome, ordem, tipoEtapa FROM modelos_etapas WHERE modeloId = ? ORDER BY ordem ASC, id ASC");
        $stmt->execute([$modeloId]);
        return $stmt->fetchAll();
    }

    private function obterAgente(int $modeloId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM modelos_agentes_ia WHERE modeloId = ? LIMIT 1");
        $stmt->execute([$modeloId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    private function salvarEtapas(int $modeloId, array $etapas): void {
        $stmt = $this->pdo->prepare("INSERT INTO modelos_etapas (modeloId, nome, ordem, tipoEtapa) VALUES (?, ?, ?, ?)");
        foreach (array_values($etapas) as $idx => $etapa) {
            $nome = trim(is_array($etapa) ? ($etapa['nome'] ?? '') : (string)$etapa);
            if ($nome === '') continue;
            $stmt->execute([$modeloId, $nome, $idx + 1, is_array($etapa) ? ($etapa['tipoEtapa'] ?? null) : null]);
        }
    }

    private function salvarAgente(int $modeloId, array $agente): void {
        $stmt = $this->pdo->prepare("
            INSERT INTO modelos_agentes_ia (
                modeloId, instrucoes, modelo, criatividade, ouvirAudio, analisarImagens,
                aparecerDigitando, pausarAtendimento, agruparMensagens, intervaloEntreMensagens,
                qntMsgHistorico, abrirAtendimento, notificarHumano, requisicaoHTTP, CRM
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $modeloId,
            $agente['instrucoes'] ?? null,
            $agente['modelo'] ?? 'gpt-5-mini',
            isset($agente['criatividade']) ? (float)$agente['criatividade'] : 0.7,
            !empty($agente['ouvirAudio']) ? 1 : 0,
            !empty($agente['analisarImagens']) ? 1 : 0,
            !empty($agente['aparecerDigitando']) ? 1 : 0,
            !empty($agente['pausarAtendimento']) ? 1 : 0,
            !empty($agente['agruparMensagens']) ? 1 : 0,
            isset($agente['intervaloEntreMensagens']) ? (int)$agente['intervaloEntreMensagens'] : null,
            isset($agente['qntMsgHistorico']) ? (int)$agente['qntMsgHistorico'] : 20,
            isset($agente['abrirAtendimento']) ? json_encode($agente['abrirAtendimento']) : null,
            isset($agente['notificarHumano']) ? json_encode($agente['notificarHumano']) : null,
            isset($agente['requisicaoHTTP']) ? json_encode($agente['requisicaoHTTP']) : null,
            isset($agente['CRM']) ? json_encode($agente['CRM']) : null,
        ]);
    }
}
