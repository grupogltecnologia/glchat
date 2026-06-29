<?php
session_start();
session_destroy();
session_write_close();
setcookie(session_name(), '', 0, '/');

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout - HUBLABEL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
        }
        h1 { color: #333; margin-bottom: 20px; }
        p { color: #666; margin-bottom: 30px; }
        a {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover { background: #5568d3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>✅ Logout realizado com sucesso!</h1>
        <p>Sua sessão foi encerrada.</p>
        <a href="/hublabel/public/login">← Voltar para o Login</a>
    </div>
</body>
</html>
