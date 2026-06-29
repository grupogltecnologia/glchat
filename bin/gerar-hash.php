<?php
$senha = 'password';
$hash = password_hash($senha, PASSWORD_DEFAULT);
echo "Hash gerado: $hash\n";
echo "Tamanho: " . strlen($hash) . " caracteres\n";
