#!/usr/bin/env php
<?php
/**
 * Testar login e verificar hash
 */

require_once __DIR__ . '/../app/Core/Database.php';

echo "🔍 Testando login...\n\n";

try {
    $pdo = Database::pdo();
    
    $email = 'admin@hublabel.com';
    $senha = 'password';
    
    // Buscar usuário
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE Email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();
    
    if (!$usuario) {
        echo "❌ Usuário não encontrado!\n";
        exit(1);
    }
    
    echo "✅ Usuário encontrado:\n";
    echo "   ID: {$usuario['id']}\n";
    echo "   Nome: {$usuario['nome']}\n";
    echo "   Email: {$usuario['Email']}\n";
    echo "   Função: {$usuario['funcao']}\n";
    echo "   Conta ID: {$usuario['contaId']}\n\n";
    
    // Verificar hash
    echo "🔐 Testando senha...\n";
    echo "   Senha digitada: $senha\n";
    echo "   Hash no banco: " . substr($usuario['Senha'], 0, 50) . "...\n\n";
    
    if (password_verify($senha, $usuario['Senha'])) {
        echo "✅ SENHA CORRETA! Hash verificado com sucesso!\n\n";
    } else {
        echo "❌ SENHA INCORRETA! Hash não confere!\n\n";
        
        // Criar novo hash
        echo "🔧 Criando novo hash...\n";
        $novoHash = password_hash($senha, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("UPDATE usuarios SET Senha = ? WHERE Email = ?");
        $stmt->execute([$novoHash, $email]);
        
        echo "✅ Hash atualizado!\n";
        echo "   Novo hash: " . substr($novoHash, 0, 50) . "...\n\n";
        
        // Testar novamente
        if (password_verify($senha, $novoHash)) {
            echo "✅ Novo hash verificado com sucesso!\n";
        }
    }
    
    // Verificar status da conta
    echo "\n📊 Verificando conta...\n";
    $stmt = $pdo->prepare("SELECT * FROM contas WHERE id = ?");
    $stmt->execute([$usuario['contaId']]);
    $conta = $stmt->fetch();
    
    if ($conta) {
        echo "   Nome: {$conta['nome']}\n";
        echo "   Status: {$conta['status']}\n";
        echo "   Plano: {$conta['plano']}\n";
    } else {
        echo "   ❌ Conta não encontrada!\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
