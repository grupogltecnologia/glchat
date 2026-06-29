<?php
require_once __DIR__ . '/App.php';

class Auth {
    public static function iniciar(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login(array $usuario): void {
        self::iniciar();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['contaId'] = $usuario['contaId'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['Email'];
        $_SESSION['funcao'] = $usuario['funcao'];
        $_SESSION['super_admin'] = (int)($usuario['super_admin'] ?? 0);
        $_SESSION['logado'] = true;
    }

    public static function logout(): void {
        self::iniciar();
        session_destroy();
        $_SESSION = [];
    }

    public static function verificar(): bool {
        self::iniciar();
        return isset($_SESSION['logado']) && $_SESSION['logado'] === true;
    }

    public static function obterUsuarioId(): ?string {
        self::iniciar();
        return $_SESSION['usuario_id'] ?? null;
    }

    public static function obterContaId(): ?string {
        self::iniciar();
        return $_SESSION['contaId'] ?? null;
    }
    
    public static function contaId(): ?string {
        return self::obterContaId();
    }

    public static function obterNome(): ?string {
        self::iniciar();
        return $_SESSION['nome'] ?? null;
    }

    public static function obterEmail(): ?string {
        self::iniciar();
        return $_SESSION['email'] ?? null;
    }

    public static function obterFuncao(): ?string {
        self::iniciar();
        return $_SESSION['funcao'] ?? null;
    }

    public static function obterUsuario(): array {
        self::iniciar();
        return [
            'id' => $_SESSION['usuario_id'] ?? null,
            'contaId' => $_SESSION['contaId'] ?? null,
            'nome' => $_SESSION['nome'] ?? null,
            'Email' => $_SESSION['email'] ?? null,
            'email' => $_SESSION['email'] ?? null,
            'funcao' => $_SESSION['funcao'] ?? null,
            'super_admin' => (int)($_SESSION['super_admin'] ?? 0),
        ];
    }

    public static function isSuperAdmin(): bool {
        self::iniciar();
        if (isset($_SESSION['funcao']) && $_SESSION['funcao'] === 'superadmin') {
            return true;
        }

        if (!empty($_SESSION['super_admin'])) {
            return true;
        }

        if (empty($_SESSION['usuario_id']) || !class_exists('Database')) {
            return false;
        }

        try {
            $stmt = Database::pdo()->prepare('SELECT funcao, super_admin FROM usuarios WHERE id = ? LIMIT 1');
            $stmt->execute([$_SESSION['usuario_id']]);
            $usuario = $stmt->fetch();
            if (!$usuario) {
                return false;
            }

            $_SESSION['funcao'] = $usuario['funcao'] ?? ($_SESSION['funcao'] ?? null);
            $_SESSION['super_admin'] = (int)($usuario['super_admin'] ?? 0);

            return ($_SESSION['funcao'] === 'superadmin') || ((int)$_SESSION['super_admin'] === 1);
        } catch (Throwable $e) {
            return false;
        }
    }

    public static function requerAutenticacao(): void {
        if (!self::verificar()) {
            App::redirect('/login');
        }
    }

    public static function requerSuperAdmin(): void {
        self::requerAutenticacao();
        if (!self::isSuperAdmin()) {
            App::redirect('/dashboard');
        }
    }
}
