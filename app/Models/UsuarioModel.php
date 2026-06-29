<?php
require_once __DIR__ . '/../Core/Database.php';

class UsuarioModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
    }

    public function criar(array $dados): string {
        $id = $this->gerarUUID();
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios (id, contaId, nome, Email, Senha, telefone, funcao)
            VALUES (:id, :contaId, :nome, :email, :senha_hash, :telefone, :funcao)
        ");
        $stmt->execute([
            'id' => $id,
            'contaId' => $dados['contaId'],
            'nome' => $dados['nome'] ?? null,
            'email' => $dados['email'] ?? null,
            'senha_hash' => isset($dados['senha']) ? password_hash($dados['senha'], PASSWORD_DEFAULT) : null,
            'telefone' => $dados['telefone'] ?? null,
            'funcao' => $dados['funcao'] ?? 'admin',
        ]);
        return $id;
    }

    public function buscarPorEmail(string $email): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE Email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function buscarPorId(string $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function listarPorConta(string $contaId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE contaId = :contaId ORDER BY created_at DESC");
        $stmt->execute(['contaId' => $contaId]);
        return $stmt->fetchAll();
    }

    public function verificarSenha(string $email, string $senha): ?array {
        $usuario = $this->buscarPorEmail($email);
        if (!$usuario || !$usuario['Senha']) {
            return null;
        }
        
        if (password_verify($senha, $usuario['Senha'])) {
            return $usuario;
        }
        
        return null;
    }

    public function atualizarSenha(string $id, string $novaSenha): bool {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET Senha = :senha_hash WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'senha_hash' => password_hash($novaSenha, PASSWORD_DEFAULT)
        ]);
    }

    public function atualizar(string $id, array $dados): bool {
        $campos = [];
        $valores = ['id' => $id];
        
        foreach ($dados as $campo => $valor) {
            if (in_array($campo, ['nome', 'Email', 'telefone', 'funcao'])) {
                $campos[] = "$campo = :$campo";
                $valores[$campo] = $valor;
            }
        }
        
        if (empty($campos)) return false;
        
        $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
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
