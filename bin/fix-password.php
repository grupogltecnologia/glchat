<?php
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}

require_once __DIR__ . '/../app/Core/Database.php';

$pdo = Database::pdo();

$senha = 'password';
$hash = password_hash($senha, PASSWORD_DEFAULT);

echo "Novo hash gerado: $hash\n";
echo "Tamanho: " . strlen($hash) . " caracteres\n\n";

$stmt = $pdo->prepare("UPDATE SAAS_Usuarios SET senha_hash = :hash WHERE Email = 'admin@hublabel.com'");
$stmt->execute(['hash' => $hash]);

echo "✅ Senha atualizada com sucesso!\n\n";

// Verificar
$stmt = $pdo->prepare("SELECT LENGTH(senha_hash) as tamanho, senha_hash FROM SAAS_Usuarios WHERE Email = 'admin@hublabel.com'");
$stmt->execute();
$result = $stmt->fetch();

echo "Hash no banco:\n";
echo "  Tamanho: {$result['tamanho']} caracteres\n";
echo "  Hash: {$result['senha_hash']}\n\n";

// Testar login
if (password_verify($senha, $result['senha_hash'])) {
    echo "✅ LOGIN FUNCIONANDO!\n";
} else {
    echo "❌ Login ainda não funciona\n";
}
