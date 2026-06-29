<?php
// Limpar todas as sessões
session_start();
session_destroy();
session_write_close();
setcookie(session_name(), '', 0, '/');
session_regenerate_id(true);

echo "✅ Sessões limpas! Redirecionando para login...\n";
header('Location: /hublabel/public/login');
exit;
