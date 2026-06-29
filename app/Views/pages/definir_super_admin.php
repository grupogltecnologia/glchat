<?php
/**
 * Definir Super Admin - HTML/CSS limpo do n8n
 * JavaScript será adicionado separadamente
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Versão limpa: HTML + CSS apenas. JavaScript removido. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Definir Super Admin - IA Chatconversa</title>
    <link rel="icon" type="image/png" href="/hublabel/public/hublabel/public/assets/images/favicon">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #e0e0e0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            padding: 32px;
            max-width: 420px;
            width: 100%;
        }
        .card h1 {
            font-size: 1.35rem;
            margin-bottom: 8px;
            color: #fff;
        }
        .card p {
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 24px;
            line-height: 1.45;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #bbb;
        }
        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            background: rgba(0,0,0,0.3);
            color: #fff;
            font-size: 1rem;
        }
        .form-group input::placeholder { color: #666; }
        .form-group input:focus {
            outline: none;
            border-color: #6C63FF;
        }
        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn:disabled { opacity: 0.6; cursor: not-allowed; }
        .btn-primary {
            background: #6C63FF;
            color: #fff;
            margin-bottom: 12px;
        }
        .btn-primary:hover:not(:disabled) { opacity: 0.95; }
        .btn-secondary {
            background: transparent;
            color: #888;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.06); color: #ccc; }
        .msg {
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 16px;
        }
        .msg.error { background: rgba(220,53,69,0.2); border: 1px solid rgba(220,53,69,0.4); color: #f88; }
        .msg.success { background: rgba(37,211,102,0.15); border: 1px solid rgba(37,211,102,0.3); color: #6f6; }

        /* === Dropdowns <select>: fundo branco e texto preto (light e dark) === */
        body.light-mode select,
        body.dark-mode select,
        body:not(.light-mode) select {
            background-color: #ffffff !important;
            color: #000000 !important;
            -webkit-text-fill-color: #000000 !important;
        }
        body.light-mode select option,
        body.dark-mode select option,
        body:not(.light-mode) select option,
        body.light-mode select optgroup,
        body.dark-mode select optgroup,
        body:not(.light-mode) select optgroup {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        body.light-mode select[class],
        body.dark-mode select[class],
        body:not(.light-mode) select[class] {
            background-color: #ffffff !important;
            color: #000000 !important;
            -webkit-text-fill-color: #000000 !important;
        }
        body.light-mode select[class] option,
        body.dark-mode select[class] option,
        body:not(.light-mode) select[class] option {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
    </style>
    
<!-- scripts removidos para manter somente HTML + CSS -->

    <link rel="stylesheet" href="dropdowns-global.css">
</head>
<body>
    <div class="card">
        <h1>Definir primeiro Super Admin</h1>
        <p>Use esta página apenas quando ainda não existir nenhum super admin no sistema. Você precisa estar logado. Ao clicar no botão, esta conta será definida como super admin.</p>
        <div id="msg" class="msg" style="display: none;"></div>
        <form id="form" autocomplete="off">
            <button type="submit" class="btn btn-primary" id="btnSubmit">Tornar-me Super Admin</button>
            <button type="button" class="btn btn-secondary" id="btnVoltar">Voltar ao Dashboard</button>
        </form>
    </div>
    
<!-- scripts removidos para manter somente HTML + CSS -->


<!-- JavaScript de inicialização -->
<script src="/hublabel/public/assets/js/pages/definir_super_admin.js"></script>
</body>
</html>
