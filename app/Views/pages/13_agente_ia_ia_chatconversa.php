<?php
// Tela extraída do n8n. Próximo passo: separar CSS/JS e substituir chamadas por APIs PHP.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agente IA - IA Chatconversa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="shortcut icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="apple-touch-icon" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <!-- Font Awesome (para ícones como gemini) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Plus Jakarta Sans (igual dashboard/gemini) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
    <!-- Font Awesome (igual gemini) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content,
        .admin-main-content,
        .main-content-wrapper {
            max-width: none !important;
            width: 100% !important;
        }
        body.menu-oculta-chat [data-menu-id="chat"] { display: none !important; }
        body.menu-oculta-agentes-ia [data-menu-id="agentes-ia"] { display: none !important; }
        body.menu-oculta-crm [data-menu-id="crm"] { display: none !important; }
        body.menu-oculta-conexoes [data-menu-id="conexoes"] { display: none !important; }
        body.menu-oculta-disparos [data-menu-id="disparos"] { display: none !important; }
        body.menu-oculta-contatos [data-menu-id="contatos"] { display: none !important; }
        body.menu-oculta-listas [data-menu-id="listas"] { display: none !important; }
        body.menu-oculta-ajuda [data-menu-id="ajuda"] { display: none !important; }
        body.menu-oculta-configuracoes [data-menu-id="configuracoes"] { display: none !important; }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: white;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            transition: background 0.3s ease, color 0.3s ease;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #e2e8f0;
        }

        body.dark-mode .header-content h1 {
            color: #f8fafc;
        }

        body.dark-mode .header-content p {
            color: #94a3b8;
        }

        body.dark-mode .creditos-pill {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.4);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        body.dark-mode .creditos-pill-icon {
            color: #94a3b8;
        }

        body.dark-mode .creditos-pill-label {
            color: #94a3b8;
        }

        body.dark-mode .creditos-pill-numbers {
            color: #f8fafc;
        }

        body.dark-mode .creditos-pill-numbers .creditos-divisor {
            color: #64748b;
        }

        body.dark-mode .creditos-pill-numbers #creditosUsados {
            color: #f8fafc;
        }

        body.dark-mode .agente-card-criar {
            background: rgba(30, 41, 59, 0.3);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .agente-card-criar:hover {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(108, 99, 255, 0.4);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        body.dark-mode .agente-card-criar-icon {
            background: rgba(51, 65, 85, 0.4);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .agente-card-criar:hover .agente-card-criar-icon {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.dark-mode .agente-card-criar-icon svg {
            color: #64748b;
        }

        body.dark-mode .agente-card-criar:hover .agente-card-criar-icon svg {
            color: #6C63FF;
        }

        body.dark-mode .agente-card-criar-title {
            color: #94a3b8;
        }

        body.dark-mode .agente-card-criar:hover .agente-card-criar-title {
            color: #6C63FF;
        }

        body.dark-mode .agente-card-criar-desc {
            color: #64748b;
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - cópia exata do dashboard */
        .sidebar {
            width: 72px;
            overflow: hidden;
            background: #1A202C;
            border-right: none;
            transition: width 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .sidebar.sidebar-expanded {
            width: 250px;
            overflow: visible;
            transition-duration: 0s;
        }

        .sidebar-header {
            padding: 24px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            min-height: 96px;
        }

        .sidebar-logo-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 40px;
            min-width: 32px;
            flex-shrink: 0;
            transition: width 0.3s ease, min-width 0.3s ease;
        }

        .sidebar:hover .sidebar-logo-link,
        .sidebar.sidebar-expanded .sidebar-logo-link,
        .sidebar.mobile-open .sidebar-logo-link {
            width: 100%;
            min-width: 180px;
            justify-content: center;
            padding: 0 16px;
        }

        .sidebar-logo-img {
            width: 32px;
            height: 32px;
            min-width: 32px;
            object-fit: contain;
            transition: width 0.3s ease, height 0.3s ease;
        }

        .sidebar:hover .sidebar-logo-img,
        .sidebar.sidebar-expanded .sidebar-logo-img,
        .sidebar.mobile-open .sidebar-logo-img {
            width: auto;
            max-width: 100%;
            height: 45px;
            min-width: 0;
        }

        .sidebar-menu {
            padding: 4px 0;
            flex: 1;
            min-height: 0;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .sidebar-nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 4px 16px;
            flex-shrink: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0;
            margin: 2px 10px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
            white-space: nowrap;
            border-radius: 16px;
            text-align: left;
        }

        .sidebar:hover .menu-item,
        .sidebar.sidebar-expanded .menu-item,
        .sidebar.mobile-open .menu-item {
            justify-content: flex-start;
            padding: 10px 12px;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .menu-item.active {
            background: #2D3748;
            color: white;
            border-right: none;
        }

        .menu-item-admin { font-weight: 700 !important; }
        .menu-badge-admin {
            display: none;
            margin-left: auto;
            font-size: 0.6rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 999px;
            background: #6C63FF;
            color: #fff;
        }
        .sidebar:hover .menu-badge-admin,
        .sidebar.sidebar-expanded .menu-badge-admin,
        .sidebar.mobile-open .menu-badge-admin { display: inline-block; }

        .menu-icon {
            width: 25px;
            text-align: center;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-icon svg {
            width: 16px;
            height: 16px;
            transition: all 0.3s ease;
        }

        .menu-item:hover .menu-icon svg {
            transform: scale(1.1);
        }


        .menu-icon .material-symbols-rounded {
            font-family: 'Material Symbols Rounded', sans-serif;
            font-size: 16px;
            line-height: 1;
            font-weight: normal;
            font-style: normal;
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-feature-settings: 'liga';
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .menu-item:hover .menu-icon .material-symbols-rounded {
            transform: scale(1.1);
        }

        .menu-text {
            margin-left: 0;
            opacity: 0;
            width: 0;
            overflow: hidden;
            flex: 0;
            transition: opacity 0.3s ease, margin-left 0.3s ease, width 0.3s ease;
        }

        .sidebar:hover .menu-text,
        .sidebar.sidebar-expanded .menu-text,
        .sidebar.mobile-open .menu-text {
            margin-left: 16px;
            opacity: 1;
            width: auto;
            flex: 1;
        }

        .menu-badge-novidade {
            display: none;
            margin-left: auto;
            font-size: 0.6rem;
            font-weight: 500;
            padding: 2px 8px;
            border-radius: 999px;
            background: #6C63FF;
            color: #fff;
        }

        .sidebar:hover .menu-badge-novidade,
        .sidebar.sidebar-expanded .menu-badge-novidade,
        .sidebar.mobile-open .menu-badge-novidade {
            display: inline-block;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 0;
            flex-shrink: 0;
        }

        .version-text {
            color: #666;
            font-size: 0.6rem;
            text-align: center;
            padding: 8px 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .sidebar:hover .version-text,
        .sidebar.sidebar-expanded .version-text,
        .sidebar.mobile-open .version-text {
            opacity: 1;
        }

        .logout-item {
            color: #ff6b6b !important;
        }

        .logout-item:hover {
            background: rgba(255, 107, 107, 0.1) !important;
            color: #ff6b6b !important;
        }

        /* Sidebar: itens menores em telas com pouca altura para caber sem scroll */
        @media (max-height: 800px) {
            .sidebar-header { padding: 12px 20px; }
            .sidebar-logo-img { width: 40px; height: 40px; min-width: 40px; }
            .sidebar-menu { padding: 12px 0; }
            .menu-item { padding: 10px 12px; }
            .menu-icon { width: 26px; }
            .menu-icon svg { width: 18px; height: 18px; }
            .menu-icon .material-symbols-rounded { font-size: 18px; }
            .version-text { padding: 6px 20px; font-size: 0.55rem; }
            .sidebar-footer { padding: 8px 0; }
        }
        @media (max-height: 700px) {
            .sidebar-header { padding: 8px 20px; }
            .sidebar-logo-img { width: 36px; height: 36px; min-width: 36px; }
            .sidebar-menu { padding: 8px 0; }
            .menu-item { padding: 8px 20px; }
            .menu-icon { width: 22px; }
            .menu-icon svg { width: 16px; height: 16px; }
            .menu-icon .material-symbols-rounded { font-size: 16px; }
            .menu-text { font-size: 0.85rem; }
            .version-text { padding: 4px 20px; font-size: 0.5rem; }
            .sidebar-footer { padding: 6px 0; }
            .theme-switch { width: 38px; height: 20px; }
        }
        @media (max-height: 600px) {
            .sidebar-header { padding: 6px 20px; }
            .sidebar-logo-img { width: 32px; height: 32px; min-width: 32px; }
            .sidebar-menu { padding: 4px 0; }
            .menu-item { padding: 6px 20px; }
            .menu-icon { width: 20px; }
            .menu-icon svg { width: 14px; height: 14px; }
            .menu-icon .material-symbols-rounded { font-size: 14px; }
            .menu-text { font-size: 0.8rem; margin-left: 10px; }
            .version-text { padding: 2px 20px; font-size: 0.45rem; }
            .sidebar-footer { padding: 4px 0; }
            .theme-switch { width: 34px; height: 18px; }
        }

        /* Dark Mode Toggle Switch */
        .theme-toggle-item {
            cursor: default;
        }

        .theme-toggle-item:hover {
            background: transparent !important;
            color: inherit !important;
        }

        .theme-switch {
            display: none;
            position: relative;
            width: 44px;
            height: 24px;
            margin-left: auto;
        }

        .sidebar:hover .theme-switch,
        .sidebar.sidebar-expanded .theme-switch,
        .sidebar.mobile-open .theme-switch {
            display: inline-block;
        }

        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .theme-switch .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #444;
            transition: 0.3s;
            border-radius: 24px;
        }

        .theme-switch .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
        }

        .theme-switch input:checked + .slider {
            background-color: #6C63FF;
        }

        .theme-switch input:checked + .slider:before {
            transform: translateX(20px);
        }

        /* Light Mode Styles */
        body.light-mode {
            background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
            color: #333;
        }

        body.light-mode .sidebar {
            background: rgba(255, 255, 255, 0.95);
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        body.light-mode .menu-item {
            color: #666;
        }

        body.light-mode .menu-item:hover {
            background: rgba(108, 99, 255, 0.1);
            color: #6C63FF;
        }

        body.light-mode .menu-item.active {
            background: rgba(108, 99, 255, 0.15);
            color: #6C63FF;
        }

        body.light-mode .version-text {
            color: #999;
        }

        body.light-mode .menu-badge-novidade,
        body.light-mode .menu-badge-admin {
            background: #6C63FF;
            color: #fff;
        }

        body.light-mode .sidebar-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .sidebar-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .logout-item {
            color: #ff6b6b !important;
        }

        body.light-mode .logout-item:hover {
            background: rgba(255, 107, 107, 0.15) !important;
            color: #ff6b6b !important;
        }

        body.light-mode .theme-switch .slider {
            background-color: #ccc;
        }

        body.light-mode .theme-switch input:checked + .slider {
            background-color: #6C63FF;
        }

        body.light-mode .theme-switch .slider:before {
            background-color: white;
        }

        body.light-mode .header-content h1 {
            color: #222;
        }

        body.light-mode .header-content p {
            color: #666;
        }

        body.light-mode .agente-card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        body.light-mode .agente-card:hover {
            border-color: rgba(108, 99, 255, 0.3);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.15);
        }

        body.light-mode .agente-card-nome {
            color: #222;
        }

        body.light-mode .agente-card-modelo {
            color: #666;
        }

        body.light-mode .agente-card-detail-item {
            color: #555;
        }

        body.light-mode .agente-card-subtitle {
            color: #666;
        }

        body.light-mode .agente-card-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }

        body.light-mode .agente-footer-icon {
            background: rgba(0, 0, 0, 0.03);
            color: #666;
        }

        body.light-mode .agente-footer-icon:hover {
            background: rgba(0, 0, 0, 0.08);
            color: #333;
        }

        body.light-mode .agente-card-criar {
            background: rgba(255, 255, 255, 0.98);
            border: 2px dashed rgba(0, 0, 0, 0.2);
        }

        body.light-mode .agente-card-criar:hover {
            border-color: rgba(108, 99, 255, 0.4);
            background: rgba(108, 99, 255, 0.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        body.light-mode .agente-card-criar-icon {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.15);
        }

        body.light-mode .agente-card-criar:hover .agente-card-criar-icon {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.light-mode .agente-card-criar-icon svg {
            color: rgba(0, 0, 0, 0.4);
        }

        body.light-mode .agente-card-criar:hover .agente-card-criar-icon svg {
            color: #6C63FF;
        }

        body.light-mode .agente-card-criar-title {
            color: rgba(0, 0, 0, 0.6);
        }

        body.light-mode .agente-card-criar:hover .agente-card-criar-title {
            color: #6C63FF;
        }

        body.light-mode .agente-card-criar-desc {
            color: rgba(0, 0, 0, 0.4);
        }

        body.light-mode .empty-state {
            color: #666;
        }

        body.light-mode .empty-state h3 {
            color: #333;
        }

        body.light-mode .criar-agente-modal-content,
        body.light-mode .fullscreen-instrucoes-content {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-top: 3px solid rgba(108, 99, 255, 0.6);
            color: #333;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        body.light-mode .criar-agente-modal h3,
        body.light-mode .criar-agente-modal-title,
        body.light-mode .fullscreen-instrucoes-header h3 {
            color: #1f2937;
            font-weight: 700;
        }

        body.light-mode .modal-subtitle {
            color: #6b7280;
        }

        body.light-mode .criar-agente-section h4 {
            color: #222;
        }

        body.light-mode .form-group-modal label {
            color: #333;
        }

        body.light-mode .form-group-modal input[type="text"],
        body.light-mode .form-group-modal input[type="number"],
        body.light-mode .form-group-modal textarea,
        body.light-mode .form-group-modal select {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            border-radius: 8px !important;
            color: #333 !important;
            outline: none !important;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        body.light-mode .form-group-modal input[type="text"]:focus,
        body.light-mode .form-group-modal input[type="number"]:focus,
        body.light-mode .form-group-modal textarea:focus,
        body.light-mode .form-group-modal select:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
        }

        body.light-mode .form-group-modal input::placeholder,
        body.light-mode .form-group-modal textarea::placeholder {
            color: #999;
        }

        body.light-mode .modal-close-btn {
            color: #9ca3af;
        }

        body.light-mode .modal-close-btn:hover {
            background: rgba(0, 0, 0, 0.06);
            color: #4b5563;
        }

        body.light-mode .modal-divider {
            background: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .markdown-toolbar {
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .markdown-toolbar-btn {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #555;
        }

        body.light-mode .markdown-toolbar-btn:hover {
            background: rgba(108, 99, 255, 0.15);
            border-color: #6C63FF;
            color: #6C63FF;
        }

        body.light-mode .rich-text-editor {
            background: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .rich-text-editor h1,
        body.light-mode .rich-text-editor h2,
        body.light-mode .rich-text-editor h3 {
            color: #6C63FF;
        }

        body.light-mode .rich-text-editor blockquote {
            color: #555;
        }

        body.light-mode .rich-text-editor code {
            background: rgba(0, 0, 0, 0.08);
        }

        body.light-mode .instrucoes-textarea-wrapper {
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        body.light-mode .instrucoes-fullscreen-btn {
            background: rgba(108, 99, 255, 0.1);
            border: 1px solid rgba(108, 99, 255, 0.3);
            color: #6C63FF;
        }

        body.light-mode .instrucoes-fullscreen-btn:hover {
            background: rgba(108, 99, 255, 0.2);
        }

        body.light-mode .fullscreen-instrucoes-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .agente-card-details {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .agente-card-status.active {
            background: rgba(108, 99, 255, 0.15);
            border: 1px solid rgba(108, 99, 255, 0.3);
            color: #6C63FF;
        }

        body.light-mode .agente-card-status.inactive {
            background: rgba(255, 59, 48, 0.15);
            border: 1px solid rgba(255, 59, 48, 0.3);
            color: #ff3b30;
        }

        /* Main content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-x: auto;
            margin-left: 72px;
            position: relative;
        }

        .header {
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .header-content h1 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .header-content p {
            color: #94a3b8;
            font-size: 1rem;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-novo-agente {
            padding: 12px 20px;
            background: #6C63FF;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .btn-novo-agente:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }

        .header-agentes {
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 24px;
        }

        .creditos-pill {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 28px;
            min-width: 200px;
            background: #ffffff;
            border: none;
            border-radius: 9999px;
            flex-shrink: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .creditos-pill-inner {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .creditos-pill-label-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .creditos-pill-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 0.85rem;
        }

        .creditos-pill-label {
            font-size: 0.6875rem;
            font-weight: 500;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .creditos-pill-numbers {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
            display: flex;
            align-items: baseline;
        }

        .creditos-pill-numbers #creditosUsados {
            font-weight: 700;
            color: #0f172a;
            font-size: 1.0625rem;
        }

        .creditos-pill-numbers .creditos-divisor {
            font-weight: 500;
            color: #94a3b8;
            font-size: 0.875rem;
            margin-left: 2px;
        }

        body.light-mode .creditos-pill {
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        body.light-mode .creditos-pill-icon {
            color: #64748b;
        }

        body.light-mode .creditos-pill-label {
            color: #94a3b8;
        }

        body.light-mode .creditos-pill-numbers {
            color: #0f172a;
        }

        /* Alerta de Limite Atingido */
        .limite-atingido-alerta {
            margin-top: 20px;
            margin-bottom: 20px;
            background: rgba(239, 68, 68, 0.15);
            border: 2px solid rgba(239, 68, 68, 0.5);
            border-radius: 12px;
            padding: 16px 20px;
            animation: slideDown 0.3s ease-out;
        }

        .limite-atingido-content {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ef4444;
            font-size: 1rem;
            font-weight: 600;
        }

        .limite-atingido-content svg {
            flex-shrink: 0;
            stroke: #ef4444;
        }

        .limite-atingido-link {
            color: #ef4444;
            text-decoration: underline;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .limite-atingido-link:hover {
            opacity: 0.8;
        }

        body.light-mode .limite-atingido-link {
            color: #dc2626;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body.light-mode .limite-atingido-alerta {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.4);
        }

        body.light-mode .limite-atingido-content {
            color: #dc2626;
        }

        body.light-mode .limite-atingido-content svg {
            stroke: #dc2626;
        }

        /* Tag de Pausado por Falta de Créditos */
        .agente-tag-sem-creditos {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }

        body.light-mode .agente-tag-sem-creditos {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #dc2626;
        }

        /* Loading state - blocos piscantes (skeleton) como nas demais páginas */
        .loading-container.skeleton-loading {
            display: grid !important;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
            padding: 0;
            min-height: auto;
            align-items: stretch;
            justify-content: start;
        }

        .skeleton-card {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 20px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .skeleton-card .skeleton-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }

        .skeleton-card .skeleton-line {
            height: 14px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }

        .skeleton-card .skeleton-line.title {
            width: 70%;
            height: 18px;
            margin-bottom: 4px;
        }

        .skeleton-card .skeleton-line.subtitle {
            width: 50%;
            height: 12px;
        }

        .skeleton-card .skeleton-line.desc {
            width: 90%;
            height: 12px;
        }

        .skeleton-card .skeleton-footer {
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            gap: 8px;
        }

        .skeleton-card .skeleton-line.footer {
            width: 60%;
            height: 12px;
        }

        @keyframes skeleton-pulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }

        .skeleton-card:nth-child(1) .skeleton-icon,
        .skeleton-card:nth-child(1) .skeleton-line { animation-delay: 0s; }
        .skeleton-card:nth-child(2) .skeleton-icon,
        .skeleton-card:nth-child(2) .skeleton-line { animation-delay: 0.1s; }
        .skeleton-card:nth-child(3) .skeleton-icon,
        .skeleton-card:nth-child(3) .skeleton-line { animation-delay: 0.2s; }
        .skeleton-card:nth-child(4) .skeleton-icon,
        .skeleton-card:nth-child(4) .skeleton-line { animation-delay: 0.3s; }
        .skeleton-card:nth-child(5) .skeleton-icon,
        .skeleton-card:nth-child(5) .skeleton-line { animation-delay: 0.4s; }
        .skeleton-card:nth-child(6) .skeleton-icon,
        .skeleton-card:nth-child(6) .skeleton-line { animation-delay: 0.5s; }

        body.light-mode .skeleton-card {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.08);
        }

        body.light-mode .skeleton-card .skeleton-icon,
        body.light-mode .skeleton-card .skeleton-line {
            background: rgba(0, 0, 0, 0.08);
        }

        body.light-mode .skeleton-card .skeleton-footer {
            border-top-color: rgba(0, 0, 0, 0.08);
        }

        .loading-spinner-small {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Agentes Grid */
        .agentes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        /* Card do Agente - estilo gemini (rounded-[2rem]) */
        .agente-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 32px;
            border: 1px solid rgba(226, 232, 240, 1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .agente-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .agente-card {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.4);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        body.dark-mode .agente-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.25);
            border-color: rgba(71, 85, 105, 0.6);
        }

        body.dark-mode .agente-card-nome {
            color: #f8fafc;
        }

        body.dark-mode .agente-card-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .agente-card-footer {
            background: rgba(15, 23, 42, 0.4);
            border-top: 1px solid rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .agente-footer-icon {
            color: #94a3b8;
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .agente-footer-icon:hover {
            background: rgba(51, 65, 85, 0.8);
            color: #f8fafc;
        }

        /* Header Section */
        .agente-card-header-section {
            padding: 20px;
        }

        /* Top Section - Header */
        .agente-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .agente-card-avatar-wrapper {
            display: flex;
            gap: 16px;
            flex: 1;
        }

        .agente-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #9333ea 0%, #3b82f6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 6px rgba(147, 51, 234, 0.25);
        }

        .agente-card-icon svg {
            width: 24px;
            height: 24px;
            color: white;
        }

        .agente-card-info {
            flex: 1;
            min-width: 0;
        }

        .agente-card-nome {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: #1e293b;
            line-height: 1.3;
        }

        .agente-card-subtitle {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        body.dark-mode .agente-card-subtitle {
            color: #94a3b8;
        }

        .agente-card-switch-top {
            flex-shrink: 0;
        }

        .agente-card-switch-top .switch {
            width: 44px;
            height: 24px;
        }

        .agente-card-switch-top .slider-switch {
            height: 24px;
            background: #cbd5e1;
        }

        .agente-card-switch-top .slider-switch:before {
            height: 16px;
            width: 16px;
            top: 4px;
            left: 4px;
        }

        .agente-card-switch-top input:checked + .slider-switch {
            background: #6C63FF;
        }

        .agente-card-switch-top input:checked + .slider-switch:before {
            transform: translateX(20px);
        }

        /* Tags Section */
        .agente-card-tags {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .agente-tag {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid;
        }

        .agente-tag svg {
            flex-shrink: 0;
        }

        .agente-tag-modelo {
            background: rgba(99, 102, 241, 0.1);
            color: #4f46e5;
            border-color: rgba(99, 102, 241, 0.2);
        }

        body.dark-mode .agente-tag-modelo {
            background: rgba(51, 65, 85, 0.5);
            color: #cbd5e1;
            border-color: rgba(71, 85, 105, 0.4);
        }

        .agente-tag-status {
            background: rgba(108, 99, 255, 0.1);
            color: #6C63FF;
            border-color: rgba(108, 99, 255, 0.2);
        }

        .agente-tag-status.offline {
            background: rgba(241, 245, 249, 1);
            color: #64748b;
            border-color: rgba(226, 232, 240, 1);
        }

        body.dark-mode .agente-tag-status.offline {
            background: rgba(51, 65, 85, 0.5);
            color: #94a3b8;
            border-color: rgba(71, 85, 105, 0.4);
        }

        .agente-tag-dot-pulse {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 8px;
            height: 8px;
        }

        .agente-tag-dot-ping {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.75;
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .agente-tag-dot {
            position: relative;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
        }

        @keyframes ping {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Recursos: doc, ferramentas */
        .agente-card-resources {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .agente-resource-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }

        .agente-resource-item svg {
            flex-shrink: 0;
            color: #6C63FF;
        }

        .agente-resource-item:last-child svg {
            color: #3b82f6;
        }

        body.dark-mode .agente-resource-item {
            color: #94a3b8;
        }

        .agente-card-whatsapp-icon {
            vertical-align: -0.1em;
            margin-right: 4px;
            color: #6C63FF !important;
        }

        /* Footer Section */
        .agente-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            background: rgba(248, 250, 252, 1);
            border-top: 1px solid rgba(226, 232, 240, 1);
            border-radius: 0 0 32px 32px;
        }

        .agente-card-footer-updated {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        body.dark-mode .agente-card-footer-updated {
            color: #94a3b8;
        }

        .agente-footer-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .agente-footer-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #94a3b8;
            padding: 0;
        }

        body.dark-mode .agente-footer-icon {
            color: #94a3b8;
        }

        .agente-footer-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #6C63FF;
            border-color: rgba(108, 99, 255, 0.3);
            box-shadow: 0 2px 8px rgba(108, 99, 255, 0.2);
            transform: translateY(-1px);
        }

        .agente-footer-icon svg {
            flex-shrink: 0;
        }

        /* Modal de Exclusão de Agente */
        .criar-quadro-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        /* Modal de exclusão de conhecimento deve ficar acima do modal de criação de agente */
        #modalExcluirConhecimento {
            z-index: 10002 !important;
        }

        .criar-quadro-modal.show {
            display: flex;
        }

        .criar-quadro-modal-content {
            background: rgba(26, 26, 26, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(20px);
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            text-align: center;
            position: relative;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        body.light-mode .criar-quadro-modal-content {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .criar-quadro-modal h3 {
            color: #222;
        }

        /* Estilo específico para botão de cancelar no modal de exclusão */
        #modalExcluirAgente .btn-modal-cancel {
            background: rgba(255, 255, 255, 0.25) !important;
            border: 2px solid rgba(255, 255, 255, 0.6) !important;
            color: white !important;
            font-weight: 600 !important;
        }

        #modalExcluirAgente .btn-modal-cancel:hover {
            background: rgba(255, 255, 255, 0.35) !important;
            border-color: rgba(255, 255, 255, 0.8) !important;
            transform: translateY(-1px);
        }

        body.light-mode #modalExcluirAgente .btn-modal-cancel {
            background: rgba(0, 0, 0, 0.1) !important;
            border: 2px solid rgba(0, 0, 0, 0.4) !important;
            color: #333 !important;
        }

        body.light-mode #modalExcluirAgente .btn-modal-cancel:hover {
            background: rgba(0, 0, 0, 0.15) !important;
            border-color: rgba(0, 0, 0, 0.6) !important;
        }

        .agente-footer-btn-testar {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #3b82f6;
            border: 1px solid #3b82f6;
            color: white;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .agente-footer-btn-testar:hover {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .agente-footer-btn-testar svg {
            flex-shrink: 0;
            width: 14px;
            height: 14px;
        }

        body.light-mode .agente-footer-btn-testar {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }

        body.light-mode .agente-footer-btn-testar:hover {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
        }


        /* Card de Criar Agente - estilo gemini */
        .agente-card-criar {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 32px;
            padding: 24px;
            transition: all 0.3s ease;
            position: relative;
            overflow: visible;
            border: 2px dashed rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            min-height: 200px;
        }

        .agente-card-criar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            border-color: rgba(108, 99, 255, 0.4);
            background: rgba(108, 99, 255, 0.05);
        }

        .agente-card-criar-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .agente-card-criar:hover .agente-card-criar-icon {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
        }

        .agente-card-criar-icon svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            color: rgba(255, 255, 255, 0.6);
            transition: color 0.3s ease;
        }

        .agente-card-criar:hover .agente-card-criar-icon svg {
            color: #6C63FF;
        }

        .agente-card-criar-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.3s ease;
        }

        .agente-card-criar:hover .agente-card-criar-title {
            color: #6C63FF;
        }

        .agente-card-criar-desc {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.5;
            max-width: 200px;
        }

        .agente-card-criar.limite-atingido {
            opacity: 0.6;
            cursor: not-allowed;
            pointer-events: none;
        }
        .agente-card-criar.limite-atingido:hover {
            transform: none;
            box-shadow: none;
            border-color: rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.02);
        }
        body.light-mode .agente-card-criar.limite-atingido {
            opacity: 0.6;
        }

        .agente-card-detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #aaa;
        }

        .agente-card-detail-item svg {
            width: 16px;
            height: 16px;
            color: #6C63FF;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #ccc;
        }

        .empty-state p {
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Modal de Criar Agente */
        .criar-agente-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .criar-agente-modal.show {
            display: flex;
        }

        /* Sistema de Abas */
        .modal-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 24px;
            padding: 0 0 0 0;
        }

        .modal-tab {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: transparent;
            border: none;
            border-radius: 10px 10px 0 0;
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.2s ease, background 0.2s ease, border-color 0.2s ease;
            position: relative;
            bottom: -1px;
        }

        .modal-tab .modal-tab-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.85;
        }

        .modal-tab:hover {
            color: rgba(255, 255, 255, 0.85);
            background: rgba(255, 255, 255, 0.06);
        }

        .modal-tab.active {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.08);
            border-bottom: 2px solid #6C63FF;
        }

        .modal-tab.active .modal-tab-icon {
            opacity: 1;
        }

        .modal-tab-novidade {
            display: inline-block;
            padding: 2px 8px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #fff;
            background: #6C63FF;
            border-radius: 4px;
            margin-left: 6px;
        }

        body.light-mode .modal-tab-novidade {
            color: #fff;
            background: #6C63FF;
        }

        .modal-tab-content {
            display: none;
        }

        .modal-tab-content.active {
            display: block;
        }

        body.light-mode .modal-tabs {
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        body.light-mode .modal-tab {
            color: rgba(0, 0, 0, 0.55);
        }

        body.light-mode .modal-tab:hover {
            color: rgba(0, 0, 0, 0.85);
            background: rgba(0, 0, 0, 0.04);
        }

        body.light-mode .modal-tab.active {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.1);
            border-bottom-color: #6C63FF;
        }

        /* Aba Ferramentas - Capacidades do Agente (header + blocos) */
        .ferramentas-capacidades-header {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 16px 20px;
            background: rgba(59, 130, 246, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.15);
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            text-align: left;
        }

        .ferramentas-capacidades-header .ferramentas-capacidades-titulo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            font-weight: 600;
            color: #2563eb;
        }

        .ferramentas-capacidades-header .ferramentas-capacidades-titulo svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .ferramentas-capacidades-desc {
            font-size: 0.875rem;
            color: #3b82f6;
            line-height: 1.45;
            margin: 0;
            padding-left: 30px;
            text-align: left;
        }

        body.light-mode .ferramentas-capacidades-header {
            background: rgba(59, 130, 246, 0.06);
            border-color: rgba(59, 130, 246, 0.2);
        }

        .ferramentas-lista {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .ferramenta-bloco {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 18px 20px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .ferramenta-bloco:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.12);
        }

        .ferramenta-bloco--ativo {
            border-color: rgba(108, 99, 255, 0.3);
        }

        .ferramenta-bloco--ativo .ferramenta-bloco-icon-wrap {
            background: rgba(108, 99, 255, 0.15);
        }

        .ferramenta-bloco--ativo .ferramenta-bloco-icon-wrap svg {
            color: #6C63FF;
        }

        body.light-mode .ferramenta-bloco--ativo {
            border-color: rgba(108, 99, 255, 0.4);
        }

        body.light-mode .ferramenta-bloco--ativo .ferramenta-bloco-icon-wrap {
            background: rgba(108, 99, 255, 0.12);
        }

        body.light-mode .ferramenta-bloco--ativo .ferramenta-bloco-icon-wrap svg {
            color: #6C63FF;
        }

        .ferramenta-bloco-icon-wrap {
            width: 56px;
            height: 56px;
            min-width: 56px;
            min-height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 10px;
        }

        .ferramenta-bloco-icon-wrap svg {
            width: 28px;
            height: 28px;
            color: rgba(255, 255, 255, 0.65);
        }

        .ferramenta-bloco-body {
            flex: 1;
            min-width: 0;
            text-align: left;
        }

        .ferramenta-bloco-titulo {
            font-size: 1rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.95);
            margin: 0 0 4px 0;
            text-align: left;
        }

        .ferramenta-bloco-desc {
            font-size: 0.8125rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.55);
            line-height: 1.4;
            margin: 0;
            text-align: left;
        }

        .ferramenta-bloco-toggle {
            flex-shrink: 0;
        }

        .ferramenta-bloco-em-breve {
            opacity: 0.7;
            pointer-events: none;
        }

        .ferramenta-bloco-titulo-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }

        .ferramenta-bloco-titulo-row .ferramenta-em-breve {
            margin-left: auto;
        }

        .ferramenta-bloco-titulo-row .ferramenta-bloco-titulo {
            margin: 0;
        }

        .ferramenta-em-breve {
            display: inline-block;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: rgba(255, 255, 255, 0.6);
            background: rgba(255, 255, 255, 0.08);
            border-radius: 6px;
            flex-shrink: 0;
        }

        body.light-mode .ferramenta-em-breve {
            color: #64748b;
            background: rgba(0, 0, 0, 0.06);
        }

        .ferramenta-bloco-expandivel {
            flex-wrap: wrap;
        }

        .ferramenta-bloco-expand {
            width: 100%;
            flex-basis: 100%;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .ferramenta-bloco-expand-inner {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .ferramenta-bloco-expand .form-group-modal {
            text-align: left;
        }

        .ferramenta-bloco-expand .form-group-modal label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 8px;
        }

        .ferramenta-bloco-expand .form-group-modal textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            resize: vertical;
            min-height: 72px;
        }

        body.light-mode .ferramenta-bloco-expand {
            border-top-color: rgba(0, 0, 0, 0.08);
        }

        body.light-mode .ferramenta-bloco-expand .form-group-modal label {
            color: #334155;
        }

        body.light-mode .ferramenta-bloco-expand .form-group-modal textarea {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.15);
            color: #1e293b;
        }

        /* Notificar Humano / Abrir Atendimento - Desativado = cinza. Ativo = verde padrão */
        .notify-card {
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(255, 255, 255, 0.04);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: border-color 0.2s, background 0.2s;
        }

        .notify-card.notify-card--ativo {
            border-color: rgba(108, 99, 255, 0.35);
        }

        body.light-mode .notify-card {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.08);
        }

        body.light-mode .notify-card.notify-card--ativo {
            border-color: rgba(108, 99, 255, 0.5);
        }

        .notify-header {
            padding: 18px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: transparent;
            border-bottom: none;
            transition: background 0.2s;
        }

        .notify-card.notify-card--ativo .notify-header {
            background: rgba(108, 99, 255, 0.06);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        body.light-mode .notify-card.notify-card--ativo .notify-header {
            border-bottom-color: rgba(0, 0, 0, 0.06);
            background: rgba(108, 99, 255, 0.08);
        }

        /* Itens múltiplos (Notificar Humano / Requisição HTTP) - expandir/recolher */
        .notify-itens-list, .http-itens-list { padding: 0; }
        .notify-item, .http-item {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            margin-bottom: 12px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.03);
        }
        body.light-mode .notify-item, body.light-mode .http-item {
            background: rgba(0, 0, 0, 0.02);
            border-color: rgba(0, 0, 0, 0.08);
        }
        .notify-item-header, .http-item-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            cursor: pointer;
            user-select: none;
            transition: background 0.2s;
        }
        .notify-item-header:hover, .http-item-header:hover { background: rgba(255, 255, 255, 0.05); }
        body.light-mode .notify-item-header:hover, body.light-mode .http-item-header:hover { background: rgba(0, 0, 0, 0.04); }
        .notify-item-header .item-title, .http-item-header .item-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
        }
        body.light-mode .notify-item-header .item-title, body.light-mode .http-item-header .item-title { color: #1e293b; }
        .notify-item-header .item-chevron, .http-item-header .item-chevron {
            transition: transform 0.2s;
            color: rgba(255, 255, 255, 0.5);
        }
        body.light-mode .notify-item-header .item-chevron,
        body.light-mode .http-item-header .item-chevron {
            color: #64748b;
        }
        .notify-item.expanded .item-chevron, .http-item.expanded .item-chevron { transform: rotate(180deg); }
        .notify-item-body, .http-item-body {
            padding: 18px 16px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        body.light-mode .notify-item-body, body.light-mode .http-item-body { border-top-color: rgba(0, 0, 0, 0.06); }
        .notify-item-body.hidden, .http-item-body.hidden { display: none !important; }
        .notify-item-body .notify-field, .http-item-body .notify-field {
            margin: 0;
        }
        .notify-item-body .notify-canais-grid, .http-item-body .notify-canais-grid {
            margin-top: 2px;
        }
        .btn-add-another {
            margin-top: 12px;
            padding: 10px 16px;
            border: 1px dashed rgba(255, 255, 255, 0.25);
            border-radius: 8px;
            background: transparent;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-add-another:hover { background: rgba(255, 255, 255, 0.06); border-color: rgba(255, 255, 255, 0.35); }
        body.light-mode .btn-add-another {
            border-color: rgba(0, 0, 0, 0.2);
            color: #475569;
        }
        body.light-mode .btn-add-another:hover { background: rgba(0, 0, 0, 0.04); border-color: rgba(0, 0, 0, 0.3); }
        .notify-item .item-remove, .http-item .item-remove {
            background: rgba(255, 59, 48, 0.1);
            border: 1px solid rgba(255, 59, 48, 0.25);
            color: #ff3b30;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 0.75rem;
            cursor: pointer;
            margin-left: 8px;
        }
        .notify-item .item-remove:hover, .http-item .item-remove:hover { background: rgba(255, 59, 48, 0.2); }

        .notify-header-inner {
            display: flex;
            gap: 20px;
        }

        .notify-header-icon {
            width: 56px;
            height: 56px;
            min-width: 56px;
            min-height: 56px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.2s, color 0.2s;
        }

        .notify-card.notify-card--ativo .notify-header-icon {
            background: rgba(108, 99, 255, 0.2);
            color: #6C63FF;
        }

        body.light-mode .notify-header-icon {
            background: rgba(0, 0, 0, 0.05);
            color: #64748b;
        }

        body.light-mode .notify-card.notify-card--ativo .notify-header-icon {
            background: rgba(108, 99, 255, 0.15);
            color: #6C63FF;
        }

        .notify-header-icon svg {
            width: 28px;
            height: 28px;
        }

        .notify-header-text {
            min-width: 0;
            flex: 1;
            text-align: left;
        }

        .notify-header-text .ferramenta-bloco-titulo,
        .notify-header-text .ferramenta-bloco-desc {
            text-align: left;
        }

        .notify-config {
            padding: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            flex-direction: column;
            gap: 24px;
            text-align: left;
        }

        .notify-config.hidden {
            display: none !important;
        }

        body.light-mode .notify-config {
            border-top-color: rgba(0, 0, 0, 0.06);
        }

        .notify-field-label {
            display: block;
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 6px;
            margin-left: 2px;
            text-align: left;
        }

        .notify-label-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 6px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 0.625rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            vertical-align: middle;
            border: 1px solid transparent;
        }

        .notify-label-tag--success {
            background: rgba(34, 197, 94, 0.18);
            color: #22c55e;
            border-color: rgba(34, 197, 94, 0.35);
        }

        .notify-label-tag--danger {
            background: rgba(255, 69, 58, 0.18);
            color: #ff6b6b;
            border-color: rgba(255, 69, 58, 0.35);
        }

        body.light-mode .notify-label-tag--success {
            background: rgba(34, 197, 94, 0.12);
            color: #22c55e;
            border-color: rgba(34, 197, 94, 0.28);
        }

        body.light-mode .notify-label-tag--danger {
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
            border-color: rgba(239, 68, 68, 0.24);
        }

        body.light-mode .notify-field-label {
            color: #64748b;
        }

        .notify-input-wrap {
            position: relative;
        }

        .notify-input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
            pointer-events: none;
        }

        body.light-mode .notify-input-icon {
            color: #94a3b8;
        }

        .notify-input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            text-align: left;
        }

        select.notify-input {
            padding-left: 16px;
            appearance: auto;
        }

        body.light-mode .notify-input {
            border-color: #cbd5e1;
            background: #fff;
            color: #1e293b;
        }

        .notify-field-hint {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.4);
            margin: 4px 0 0 2px;
            text-align: left;
        }

        body.light-mode .notify-field-hint {
            color: #94a3b8;
        }

        .notify-canais-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 520px) {
            .notify-canais-grid {
                grid-template-columns: 1fr;
            }
        }

        .notify-canal-card {
            padding: 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(255, 255, 255, 0.03);
            transition: border-color 0.2s, background 0.2s;
        }

        .notify-canal-card:focus-within {
            border-color: rgba(108, 99, 255, 0.5);
            background: rgba(255, 255, 255, 0.05);
        }

        body.light-mode .notify-canal-card {
            background: #f8fafc;
            border-color: #e2e8f0;
        }

        body.light-mode .notify-canal-card:focus-within {
            border-color: rgba(108, 99, 255, 0.6);
            background: #fff;
        }

        .notify-canal-card-em-breve .notify-canal-input {
            display: none;
        }

        .notify-canal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .notify-canal-name {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.85);
        }

        .notify-canal-name svg {
            color: #6C63FF;
        }

        .notify-canal-name.notify-canal-email svg {
            color: #3b82f6;
        }

        body.light-mode .notify-canal-name {
            color: #334155;
        }

        .notify-canal-toggle {
            cursor: pointer;
            display: inline-flex;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        .notify-canal-toggle {
            position: relative;
        }

        .notify-canal-slider {
            width: 36px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 9999px;
            display: block;
            transition: background 0.2s;
            position: relative;
        }

        .notify-canal-slider::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 16px;
            height: 16px;
            background: #fff;
            border-radius: 50%;
            transition: transform 0.2s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .notify-canal-toggle input:checked + .notify-canal-slider {
            background: #6C63FF;
        }

        .notify-canal-toggle input:checked + .notify-canal-slider::after {
            transform: translateX(16px);
        }

        .notify-canal-toggle input:checked + .notify-canal-slider-email {
            background: #3b82f6;
        }

        body.light-mode .notify-canal-slider {
            background: #cbd5e1;
        }

        body.light-mode .notify-canal-slider::after {
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
        }

        body.light-mode .notify-canal-toggle input:checked + .notify-canal-slider {
            background: #6C63FF;
        }

        body.light-mode .notify-canal-toggle input:checked + .notify-canal-slider-email {
            background: #3b82f6;
        }

        .notify-canal-input {
            width: 100%;
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            transition: background 0.2s, border-color 0.2s;
        }

        .notify-canal-input:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .notify-canal-input:not(:disabled):focus {
            outline: none;
            border-color: #6C63FF;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }

        .notify-canal-input-email:not(:disabled):focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        body.light-mode .notify-canal-input {
            border-color: #e2e8f0;
            background: #f1f5f9;
            color: #1e293b;
        }

        body.light-mode .notify-canal-input:not(:disabled) {
            background: #fff;
        }

        .notify-textarea-wrap {
            position: relative;
        }

        .notify-textarea {
            width: 100%;
            padding: 12px 16px;
            padding-bottom: 36px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            min-height: 100px;
            resize: vertical;
        }

        body.light-mode .notify-textarea {
            border-color: #cbd5e1;
            background: #fff;
            color: #1e293b;
        }

        .notify-var-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            font-size: 10px;
            color: rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.06);
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        body.light-mode .notify-var-badge {
            color: #64748b;
            background: #f1f5f9;
            border-color: #e2e8f0;
        }

        .notify-var-area {
            padding: 16px;
            border-radius: 12px;
            background: rgba(108, 99, 255, 0.08);
            border: 1px solid rgba(108, 99, 255, 0.25);
        }

        .notify-var-area.hidden {
            display: none !important;
        }

        body.light-mode .notify-var-area {
            background: rgba(108, 99, 255, 0.06);
            border-color: rgba(108, 99, 255, 0.3);
        }

        .notify-var-area-title {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6C63FF;
            margin: 0 0 12px 0;
            display: flex;
            align-items: center;
            gap: 8px;
            text-align: left;
        }

        .notify-var-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .notify-var-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notify-var-tag {
            display: inline-block;
            padding: 4px 10px;
            background: rgba(108, 99, 255, 0.2);
            border: 1px solid rgba(108, 99, 255, 0.4);
            border-radius: 6px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #6C63FF;
            min-width: 80px;
        }

        .notify-var-desc-input {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
        }

        body.light-mode .notify-var-desc-input {
            background: #fff;
            border-color: #e2e8f0;
            color: #1e293b;
        }

        .hidden {
            display: none !important;
        }

        /* Requisição HTTP: seções Query / Headers / Body com switch e lista Nome-Valor */
        .http-section-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .http-section-toggle .notify-field-label {
            margin-bottom: 0;
        }

        .http-params-box {
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
            padding: 14px;
            margin-top: 8px;
        }

        body.light-mode .http-params-box {
            border-color: #e2e8f0;
            background: #f8fafc;
        }

        .http-param-row {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 10px;
            align-items: start;
            margin-bottom: 14px;
        }

        .http-param-row:last-of-type {
            margin-bottom: 0;
        }

        .http-param-delete {
            width: 36px;
            height: 36px;
            min-width: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: rgba(255, 255, 255, 0.45);
            cursor: pointer;
            border-radius: 8px;
            margin-top: 2px;
        }

        .http-param-delete:hover {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }

        body.light-mode .http-param-delete {
            color: #64748b;
        }

        body.light-mode .http-param-delete:hover {
            color: #dc2626;
            background: rgba(220, 38, 38, 0.08);
        }

        .http-param-cell {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .http-param-row label {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 4px;
            display: block;
            text-align: left;
        }

        body.light-mode .http-param-row label {
            color: #64748b;
        }

        .http-param-row input {
            width: 100%;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
        }

        body.light-mode .http-param-row input {
            background: #fff;
            border-color: #e2e8f0;
            color: #1e293b;
        }

        .http-params-sep {
            height: 0;
            border: none;
            border-top: 1px dashed rgba(255, 255, 255, 0.15);
            margin: 14px 0;
        }

        body.light-mode .http-params-sep {
            border-top-color: #cbd5e1;
        }

        .http-param-add {
            width: 100%;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px dashed rgba(255, 255, 255, 0.25);
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s, border-color 0.2s;
        }

        .http-param-add:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(108, 99, 255, 0.4);
            color: #6C63FF;
        }

        body.light-mode .http-param-add {
            border-color: #cbd5e1;
            color: #64748b;
        }

        body.light-mode .http-param-add:hover {
            background: rgba(108, 99, 255, 0.08);
            border-color: #6C63FF;
            color: #6C63FF;
        }

        .http-body-box {
            margin-top: 8px;
        }

        .http-body-textarea-wrap {
            overflow: hidden;
            border-radius: 10px;
        }

        .http-curl-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .http-curl-toggle {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid rgba(108, 99, 255, 0.4);
            background: rgba(108, 99, 255, 0.1);
            color: #6C63FF;
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }

        .http-curl-toggle:hover {
            background: rgba(108, 99, 255, 0.18);
            border-color: #6C63FF;
        }

        body.light-mode .http-curl-toggle {
            border-color: rgba(108, 99, 255, 0.5);
            background: rgba(108, 99, 255, 0.08);
            color: #6C63FF;
        }

        .http-curl-popup {
            position: fixed;
            inset: 0;
            z-index: 200300;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .http-curl-popup.hidden {
            display: none !important;
        }

        .http-curl-popup-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(2, 6, 23, 0.7);
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
        }

        .http-curl-popup-card {
            position: relative;
            width: min(760px, calc(100vw - 32px));
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: #101217;
            box-shadow: 0 18px 42px rgba(0, 0, 0, 0.45);
            padding: 18px;
        }

        .http-curl-popup-title {
            margin: 0 0 10px;
            font-size: 1rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.94);
        }

        body.light-mode .http-curl-popup-backdrop {
            background: rgba(15, 23, 42, 0.38);
        }

        body.light-mode .http-curl-popup-card {
            background: #ffffff;
            border-color: #e2e8f0;
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.22);
        }

        body.light-mode .http-curl-popup-title {
            color: #0f172a;
        }

        .http-curl-textarea {
            margin-bottom: 10px;
            font-family: ui-monospace, monospace;
            font-size: 0.8125rem;
        }

        .http-curl-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .http-curl-apply {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: #6C63FF;
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
        }

        .http-curl-apply:hover {
            filter: brightness(1.05);
        }

        .http-curl-cancel {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: transparent;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
            cursor: pointer;
        }

        body.light-mode .http-curl-cancel {
            border-color: #e2e8f0;
            color: #475569;
        }

        .http-test-section {
            margin-top: 8px;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        body.light-mode .http-test-section {
            border-top-color: rgba(0, 0, 0, 0.08);
        }

        .http-test-vars .notify-var-row {
            margin-bottom: 10px;
        }

        .http-test-vars .notify-var-tag {
            min-width: 100px;
        }

        .http-test-actions {
            margin-top: 12px;
        }

        .http-test-response {
            margin-top: 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(0, 0, 0, 0.2);
            padding: 12px;
        }

        body.light-mode .http-test-response {
            border-color: #e2e8f0;
            background: #f1f5f9;
        }

        .http-test-response-header {
            margin-bottom: 8px;
        }

        .http-test-status {
            font-size: 0.8125rem;
            font-weight: 700;
        }

        .http-test-status.ok {
            color: #6C63FF;
        }

        .http-test-status.err {
            color: #ef4444;
        }

        .http-test-body {
            margin: 0;
            padding: 10px;
            font-size: 0.75rem;
            font-family: ui-monospace, monospace;
            white-space: pre-wrap;
            word-break: break-all;
            max-height: 280px;
            overflow: auto;
            border-radius: 6px;
            background: rgba(0, 0, 0, 0.25);
            color: rgba(255, 255, 255, 0.9);
        }

        body.light-mode .http-test-body {
            background: #e2e8f0;
            color: #1e293b;
        }

        .http-body-json-error {
            font-size: 0.75rem;
            color: #ef4444;
            margin: 6px 0 0 0;
            display: block;
            text-align: left;
        }

        body.light-mode .http-body-json-error {
            color: #dc2626;
        }

        .notify-textarea.json-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 1px rgba(239, 68, 68, 0.2);
        }

        body.light-mode .notify-textarea.json-invalid {
            border-color: #dc2626;
            box-shadow: 0 0 0 1px rgba(220, 38, 38, 0.15);
        }

        .ferramenta-canal-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
        }

        .ferramenta-canal-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85);
            flex-shrink: 0;
        }

        body.light-mode .ferramenta-canal-label {
            color: #334155;
        }

        .ferramenta-canal-campo {
            flex: 1;
            min-width: 0;
            display: none;
        }

        .ferramenta-canal-campo.visivel {
            display: flex;
        }

        .ferramenta-canal-campo input {
            width: 100%;
            min-width: 0;
        }

        .ferramenta-canal-row .ferramenta-canal-campo input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
        }

        body.light-mode .ferramenta-canal-campo input {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.15);
            color: #1e293b;
        }

        .ferramenta-var-hint {
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.5);
            margin: 8px 0 12px 0;
        }

        .ferramenta-var-hint code {
            background: rgba(255, 255, 255, 0.08);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        body.light-mode .ferramenta-var-hint {
            color: #64748b;
        }

        body.light-mode .ferramenta-var-hint code {
            background: rgba(0, 0, 0, 0.06);
        }

        .ferramenta-variaveis-box {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        body.light-mode .ferramenta-variaveis-box {
            border-top-color: rgba(0, 0, 0, 0.08);
        }

        .ferramenta-variaveis-titulo {
            font-size: 0.875rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 10px;
        }

        body.light-mode .ferramenta-variaveis-titulo {
            color: #334155;
        }

        .ferramenta-var-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .ferramenta-var-tag {
            display: inline-block;
            padding: 4px 10px;
            background: rgba(108, 99, 255, 0.2);
            border: 1px solid rgba(108, 99, 255, 0.4);
            border-radius: 6px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #6C63FF;
            min-width: 80px;
        }

        body.light-mode .ferramenta-var-tag {
            background: rgba(108, 99, 255, 0.12);
            border-color: rgba(108, 99, 255, 0.35);
            color: #6C63FF;
        }

        .ferramenta-var-row .ferramenta-var-desc-input {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
        }

        body.light-mode .ferramenta-var-row .ferramenta-var-desc-input {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.15);
            color: #1e293b;
        }

        body.light-mode .ferramenta-bloco {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.08);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        body.light-mode .ferramenta-bloco:hover {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.12);
        }

        body.light-mode .ferramenta-bloco-icon-wrap {
            background: rgba(0, 0, 0, 0.05);
        }

        body.light-mode .ferramenta-bloco-icon-wrap svg {
            color: #64748b;
        }

        body.light-mode .ferramenta-bloco-titulo {
            color: #1e293b;
        }

        body.light-mode .ferramenta-bloco-desc {
            color: #64748b;
        }

        .ferramentas-dica {
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.5);
            margin: 20px 0 0 0;
            text-align: left;
        }

        body.light-mode .ferramentas-dica {
            color: #64748b;
        }

        .criar-agente-modal-content {
            background: rgba(26, 26, 26, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 32px;
            backdrop-filter: blur(10px);
            max-width: 1100px;
            width: 95%;
            max-height: 90vh;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        /* Wizard: layout em etapas (estilo gemini) */
        .wizard-sidebar {
            width: 280px;
            min-width: 280px;
            background: rgba(255,255,255,0.03);
            border-right: 1px solid rgba(255,255,255,0.08);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .wizard-sidebar-header {
            padding: 32px 24px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .wizard-sidebar-icon {
            width: 48px;
            height: 48px;
            background: #6C63FF;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 16px;
        }
        .wizard-sidebar-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: white;
            margin-bottom: 4px;
        }
        .wizard-sidebar-subtitle {
            font-size: 0.6875rem;
            font-weight: 600;
            color: rgba(255,255,255,0.5);
        }
        .wizard-steps-list {
            flex: 1;
            padding: 24px 24px 24px 20px;
            overflow-y: auto;
            position: relative;
        }
        .wizard-steps-line {
            position: absolute;
            left: 35px;
            top: 56px;
            bottom: 56px;
            width: 2px;
            background: rgba(255,255,255,0.15);
            z-index: 0;
        }
        .wizard-step-item {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
        }
        .wizard-step-item:last-child { margin-bottom: 0; }
        .wizard-step-num {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 700;
            flex-shrink: 0;
            transition: all 0.2s;
            position: relative;
            z-index: 2;
        }
        .wizard-step-item.active .wizard-step-num,
        .wizard-step-item.done .wizard-step-num {
            background: #6C63FF;
            color: white;
        }
        .wizard-step-item.pending .wizard-step-num {
            background: #1e1e1e;
            border: 2px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.5);
        }
        .wizard-step-item.done .wizard-step-num span { display: none; }
        .wizard-step-item.done .wizard-step-num::after {
            content: '✓';
            font-size: 0.9rem;
        }
        .wizard-step-text h4 { font-size: 0.875rem; font-weight: 700; margin-bottom: 2px; }
        .wizard-step-text p { font-size: 0.625rem; font-weight: 500; color: rgba(255,255,255,0.5); }
        .wizard-step-item.active .wizard-step-text h4,
        .wizard-step-item.done .wizard-step-text h4 { color: white; }
        .wizard-step-item.pending .wizard-step-text h4 { color: rgba(255,255,255,0.5); }
        .wizard-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            text-align: left;
        }
        .wizard-header {
            padding: 24px 32px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            flex-shrink: 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .wizard-header-step { font-size: 0.6875rem; font-weight: 700; color: #6C63FF; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
        .wizard-header-title { font-size: 1.5rem; font-weight: 800; color: white; }
        .wizard-close-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            border: none;
            color: rgba(255,255,255,0.6);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .wizard-close-btn:hover { background: rgba(255,255,255,0.15); color: white; }
        .wizard-body {
            flex: 1;
            overflow-y: auto;
            padding: 32px;
        }
        .wizard-step { display: none; }
        .wizard-step.active { display: block; }
        .wizard-footer {
            padding: 20px 32px;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }
        .wizard-footer .btn-wizard-back {
            background: none;
            border: none;
            color: rgba(255,255,255,0.6);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .wizard-footer .btn-wizard-back:hover { color: white; background: rgba(255,255,255,0.08); }
        .wizard-footer .btn-wizard-skip {
            background: none;
            border: none;
            color: rgba(255,255,255,0.5);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 12px;
            margin-right: 12px;
            transition: all 0.2s;
        }
        .wizard-footer .btn-wizard-skip:hover { color: white; }
        .wizard-footer .btn-wizard-next {
            background: #1A202C;
            border: none;
            color: white;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            padding: 12px 24px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .wizard-footer .btn-wizard-next:hover { background: #2D3748; transform: translateY(-1px); }
        .wizard-footer .btn-wizard-finish {
            background: #6C63FF;
            border: none;
            color: white;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            padding: 12px 24px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .wizard-footer .btn-wizard-finish:hover { background: #1fb954; transform: translateY(-1px); }

        /* Modal Editar: usar sidebar como criar, mas sem números e com clique livre */
        .criar-agente-modal-content.edit-mode .wizard-header { display: none; }
        .criar-agente-modal-content.edit-mode .wizard-footer { display: none; }
        .criar-agente-modal-content.edit-mode .wizard-step-num { display: none !important; }
        .criar-agente-modal-content.edit-mode .wizard-step-item { cursor: pointer; padding-left: 0; gap: 0; }
        .criar-agente-modal-content.edit-mode .wizard-step-text { margin-left: 8px; }
        .criar-agente-modal-content.edit-mode .wizard-steps-line { display: none; }
        .edit-tabs-wrap { display: none; }
        .edit-header { display: none; padding: 24px 32px; border-bottom: 1px solid rgba(255,255,255,0.08); justify-content: space-between; align-items: center; flex-shrink: 0; }
        /* Criar Agente: sem abas em cima, apenas etapas na sidebar */
        .criar-agente-modal-content:not(.edit-mode) .edit-tabs-wrap,
        .criar-agente-modal-content:not(.edit-mode) .edit-header { display: none !important; }
        .criar-agente-modal-content.edit-mode .edit-header { display: flex; }
        .edit-header h2 { font-size: 1.5rem; font-weight: 800; color: white; }
        .edit-tab-btn { padding: 10px 20px; border-radius: 12px; font-size: 0.875rem; font-weight: 700; border: none; background: transparent; color: rgba(255,255,255,0.5); cursor: pointer; transition: all 0.2s; white-space: nowrap; }
        .edit-tab-btn:hover { color: rgba(255,255,255,0.9); background: rgba(255,255,255,0.06); }
        .edit-tab-btn.active { background: rgba(108, 99, 255, 0.15); color: #6C63FF; }
        .edit-footer { display: none; padding: 20px 32px; border-top: 1px solid rgba(255,255,255,0.08); justify-content: flex-end; gap: 12px; flex-shrink: 0; }
        .criar-agente-modal-content.edit-mode .edit-footer { display: flex; }
        .edit-footer .btn-edit-cancel { background: transparent; border: 1px solid rgba(255,255,255,0.3); color: rgba(255,255,255,0.9); padding: 12px 24px; border-radius: 12px; font-weight: 700; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; cursor: pointer; }
        .edit-footer .btn-edit-save { background: #6C63FF; border: none; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; cursor: pointer; }
        body.light-mode .edit-header { border-bottom-color: #e2e8f0; }
        body.light-mode .edit-header h2 { color: #0f172a; }
        body.light-mode .edit-tabs-wrap { border-bottom-color: #e2e8f0; }
        body.light-mode .edit-tab-btn { color: #64748b; }
        body.light-mode .edit-tab-btn:hover { color: #0f172a; background: #f1f5f9; }
        body.light-mode .edit-tab-btn.active { background: rgba(37,211,102,0.15); color: #6C63FF; }
        body.light-mode .edit-footer { border-top-color: #e2e8f0; }
        body.light-mode .edit-footer .btn-edit-cancel { border-color: #cbd5e1; color: #334155; }
        body.light-mode .edit-footer .btn-edit-cancel:hover { background: #f8fafc; }

        @media (max-width: 900px) {
            .wizard-sidebar { width: 0; min-width: 0; overflow: hidden; padding: 0; border: none; }
        }

        body.light-mode .wizard-sidebar { background: #f8fafc; border-right-color: #e2e8f0; }
        body.light-mode .wizard-sidebar-header { border-bottom-color: #e2e8f0; }
        body.light-mode .wizard-sidebar-title { color: #0f172a; }
        body.light-mode .wizard-sidebar-subtitle { color: #64748b; }
        body.light-mode .wizard-steps-line { background: #e2e8f0; }
        body.light-mode .wizard-step-item.done .wizard-step-num,
        body.light-mode .wizard-step-item.active .wizard-step-num { background: #6C63FF; }
        body.light-mode .wizard-step-item.pending .wizard-step-num { background: #f1f5f9; border-color: #cbd5e1; color: #94a3b8; }
        body.light-mode .wizard-step-item.active .wizard-step-text h4,
        body.light-mode .wizard-step-item.done .wizard-step-text h4 { color: #0f172a; }
        body.light-mode .wizard-step-item.pending .wizard-step-text h4 { color: #94a3b8; }
        body.light-mode .wizard-step-item .wizard-step-text p { color: #64748b; }
        body.light-mode .wizard-header { border-bottom-color: #e2e8f0; }
        body.light-mode .wizard-header-title { color: #0f172a; }
        body.light-mode .wizard-close-btn { background: #f1f5f9; color: #64748b; }
        body.light-mode .wizard-close-btn:hover { background: #e2e8f0; color: #0f172a; }
        body.light-mode .wizard-footer { border-top-color: #e2e8f0; }
        body.light-mode .btn-wizard-back { color: #64748b; }
        body.light-mode .btn-wizard-back:hover { color: #0f172a; background: #f1f5f9; }
        body.light-mode .btn-wizard-skip { color: #64748b; }
        body.light-mode .btn-wizard-skip:hover { color: #0f172a; }

        body.dark-mode .wizard-footer .btn-wizard-skip {
            color: #cbd5e1;
            background: rgba(148, 163, 184, 0.08);
            border: 1px solid rgba(148, 163, 184, 0.35);
        }

        body.dark-mode .wizard-footer .btn-wizard-skip:hover {
            color: #f8fafc;
            background: rgba(148, 163, 184, 0.16);
            border-color: rgba(148, 163, 184, 0.55);
        }

        body.dark-mode .wizard-footer .btn-wizard-next {
            background: #6C63FF;
            color: #0b1a12;
        }

        body.dark-mode .wizard-footer .btn-wizard-next:hover {
            background: #1fb954;
            color: #08130d;
            transform: translateY(-1px);
        }

        @media (max-width: 700px) {
            .wizard-sidebar { display: none; }
            .criar-agente-modal-content { max-width: 100%; }
        }

        /* Link para criar instruções com ajuda */
        .criar-instrucoes-link {
            background: none;
            border: none;
            color: #6C63FF;
            font-size: 0.875rem;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
            text-decoration: underline;
        }

        .criar-instrucoes-link:hover {
            color: #1fb954;
            background: rgba(108, 99, 255, 0.1);
        }

        body.light-mode .criar-instrucoes-link {
            color: #6C63FF;
        }

        body.light-mode .criar-instrucoes-link:hover {
            color: #1fb954;
            background: rgba(108, 99, 255, 0.1);
        }

        /* Modal de criar instruções */
        .criar-instrucoes-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            backdrop-filter: blur(5px);
        }

        .criar-instrucoes-modal.show {
            display: flex;
        }

        .criar-instrucoes-modal-content {
            background: rgba(26, 26, 26, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 30px;
            max-width: 600px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
        }
        
        .criar-instrucoes-modal-header,
        .etapa-indicador {
            flex-shrink: 0;
        }
        
        .etapa-conteudo {
            flex: 1;
            min-height: 0;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        body.light-mode .criar-instrucoes-modal-content {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(0, 0, 0, 0.1);
        }

        .criar-instrucoes-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .criar-instrucoes-modal-header h3 {
            margin: 0;
            font-size: 1.5rem;
            color: #fff;
        }

        body.light-mode .criar-instrucoes-modal-header h3 {
            color: #000;
        }

        .criar-instrucoes-close-btn {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .criar-instrucoes-close-btn:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        body.light-mode .criar-instrucoes-close-btn:hover {
            color: #000;
            background: rgba(0, 0, 0, 0.05);
        }

        .etapa-indicador {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            justify-content: center;
        }

        .etapa-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .etapa-dot.ativa {
            background: #6C63FF;
            width: 24px;
            border-radius: 4px;
        }

        body.light-mode .etapa-dot {
            background: rgba(0, 0, 0, 0.2);
        }

        body.light-mode .etapa-dot.ativa {
            background: #6C63FF;
        }

        .etapa-pergunta {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-bottom: 0;
            min-height: 0;
        }

        .etapa-texto {
            color: #ccc;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        body.light-mode .etapa-texto {
            color: #333;
        }

        .etapa-pergunta label {
            display: block;
            color: #fff;
            font-weight: 500;
            margin-bottom: 8px;
        }

        body.light-mode .etapa-pergunta label {
            color: #000;
        }

        .etapa-pergunta textarea {
            width: 100%;
            flex: 1;
            min-height: 0;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            font-family: inherit;
            font-size: 0.9rem;
            resize: none;
            box-sizing: border-box;
        }

        body.light-mode .etapa-pergunta textarea {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .etapa-pergunta textarea:focus {
            outline: none;
            border-color: #6C63FF;
        }

        .etapa-botoes {
            display: flex;
            gap: 12px;
            justify-content: space-between;
            margin-top: 24px;
        }

        .btn-etapa-voltar {
            background: rgba(255, 255, 255, 0.1);
            color: #ccc;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-etapa-voltar:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        body.light-mode .btn-etapa-voltar {
            background: rgba(0, 0, 0, 0.05);
            color: #666;
        }

        body.light-mode .btn-etapa-voltar:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .btn-etapa-continuar:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-etapa {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-etapa-continuar {
            background: #6C63FF;
            color: #fff;
            flex: 1;
        }

        .btn-etapa-continuar:hover {
            background: #1fb954;
        }

        .btn-etapa-pular {
            background: rgba(255, 255, 255, 0.1);
            color: #ccc;
        }

        .btn-etapa-pular:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        body.light-mode .btn-etapa-pular {
            background: rgba(0, 0, 0, 0.05);
            color: #666;
        }

        body.light-mode .btn-etapa-pular:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        /* Animação de carregamento */
        .loading-instrucoes {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            min-height: 300px;
        }

        .loading-instrucoes.show {
            display: flex;
        }

        .loading-spinner-inst {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-top-color: #6C63FF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 30px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-frases {
            height: 80px;
            overflow: hidden;
            position: relative;
            width: 100%;
            text-align: center;
        }

        .loading-frase {
            position: absolute;
            width: 100%;
            left: 0;
            top: 50%;
            color: #6C63FF;
            font-size: 1.1rem;
            font-weight: 500;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .loading-frase.ativa {
            opacity: 1;
            transform: translateY(-50%);
        }

        .loading-frase.saindo {
            opacity: 0;
            transform: translateY(-130%);
        }

        body.light-mode .loading-frase {
            color: #6C63FF;
        }

        .modal-close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }

        .modal-close-btn:hover {
            background: rgba(153, 153, 153, 0.1);
            color: #ccc;
            transform: scale(1.1);
        }

        .modal-close-btn svg {
            transition: all 0.3s ease;
        }

        .modal-close-btn:hover svg {
            transform: rotate(90deg);
        }

        .criar-agente-modal h3 {
            color: #fff;
            margin-bottom: 10px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .modal-subtitle {
            color: #ccc;
            font-size: 1rem;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .criar-agente-section {
            margin-bottom: 30px;
            margin-top: 0;
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex: 1;
            overflow: visible;
        }

        /* Layout da aba identidade */
        .identidade-layout {
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }

        .agente-avatar-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            min-width: 120px;
        }

        .agente-avatar {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #6C63FF;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.3);
        }

        .agente-avatar svg {
            width: 48px;
            height: 48px;
            stroke: white;
        }

        body.light-mode .agente-avatar {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .identidade-campos {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }


        /* Campo de instruções reduzido */
        .instrucoes-container-compact {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .instrucoes-container-compact .instrucoes-textarea-wrapper {
            min-height: 120px;
            max-height: 200px;
        }

        /* Layout lado a lado para Instruções + Arquivos Multimídia */
        .instrucoes-layout-lado-lado {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            margin-top: 20px;
            height: 500px;
            align-items: stretch;
        }

        @media (max-width: 1024px) {
            .instrucoes-layout-lado-lado {
                grid-template-columns: 1fr;
                height: auto;
            }
        }

        /* Editor de Instruções - Lado Esquerdo */
        .instrucoes-editor-container {
            display: flex;
            flex-direction: column;
            min-width: 0;
            flex: 1;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
        }

        body.light-mode .instrucoes-editor-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
        }

        .instrucoes-editor-header {
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        body.light-mode .instrucoes-editor-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .instrucoes-editor-header label {
            font-weight: 600;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.9);
        }

        body.light-mode .instrucoes-editor-header label {
            color: #1e293b;
        }

        .instrucoes-editor-header .markdown-hint {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
        }

        body.light-mode .instrucoes-editor-header .markdown-hint {
            color: #64748b;
        }

        .instrucoes-editor-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
            overflow: hidden;
            position: relative;
        }

        .instrucoes-textarea-wrapper {
            position: relative;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .instrucoes-editor-body .instrucoes-textarea-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
            position: relative;
        }

        .instrucoes-editor-body .markdown-toolbar {
            flex-shrink: 0;
        }

        .instrucoes-editor-body .rich-text-editor-compact {
            flex: 1;
            min-height: 0;
            max-height: none;
            overflow-y: auto;
            text-align: left;
            position: relative;
            padding-bottom: 45px; /* Espaço para a tag de aprimorar */
        }

        /* Painel de Arquivos Multimídia - Lado Direito */
        .instrucoes-arquivos-container {
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            width: 180px;
            flex-shrink: 0;
            align-self: stretch;
        }

        body.light-mode .instrucoes-arquivos-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
        }

        .instrucoes-arquivos-header {
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        body.light-mode .instrucoes-arquivos-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .instrucoes-arquivos-header label {
            font-weight: 600;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        body.light-mode .instrucoes-arquivos-header label {
            color: #1e293b;
        }

        .instrucoes-arquivos-list {
            flex: 1;
            padding: 8px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .arquivo-multimidia-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            cursor: move;
            transition: all 0.2s ease;
            position: relative;
        }

        body.light-mode .arquivo-multimidia-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .arquivo-multimidia-item:hover {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
            transform: translateY(-1px);
        }

        body.light-mode .arquivo-multimidia-item:hover {
            background: #f0fdf4;
            border-color: #6C63FF;
        }

        .arquivo-multimidia-item.dragging {
            opacity: 0.5;
        }

        .arquivo-multimidia-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .arquivo-multimidia-icon.image {
            background: rgba(139, 92, 246, 0.2);
            color: #a78bfa;
        }

        .arquivo-multimidia-icon.video {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .arquivo-multimidia-icon.audio {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
        }

        .arquivo-multimidia-icon.pdf {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .arquivo-multimidia-info {
            flex: 1;
            min-width: 0;
        }

        .arquivo-multimidia-nome {
            font-size: 0.75rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        body.light-mode .arquivo-multimidia-nome {
            color: #1e293b;
        }

        .arquivo-multimidia-dica {
            font-size: 0.65rem;
            color: rgba(108, 99, 255, 0.8);
            font-weight: 500;
        }

        .arquivo-multimidia-drag-icon {
            color: rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
        }

        body.light-mode .arquivo-multimidia-drag-icon {
            color: #cbd5e1;
        }

        .arquivo-multimidia-remove {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 20px;
            height: 20px;
            border-radius: 4px;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .arquivo-multimidia-item:hover .arquivo-multimidia-remove {
            display: flex;
        }

        .arquivo-multimidia-remove:hover {
            background: rgba(239, 68, 68, 0.3);
        }

        .instrucoes-arquivos-upload-zone {
            padding: 8px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.02);
        }

        body.light-mode .instrucoes-arquivos-upload-zone {
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .instrucoes-upload-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .instrucoes-upload-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        body.light-mode .instrucoes-upload-btn {
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .instrucoes-upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .instrucoes-upload-btn.image {
            border-color: rgba(139, 92, 246, 0.3);
        }

        .instrucoes-upload-btn.image:hover {
            background: rgba(139, 92, 246, 0.1);
        }

        .instrucoes-upload-btn.audio {
            border-color: rgba(245, 158, 11, 0.3);
        }

        .instrucoes-upload-btn.audio:hover {
            background: rgba(245, 158, 11, 0.1);
        }

        .instrucoes-upload-btn.video {
            border-color: rgba(239, 68, 68, 0.3);
        }

        .instrucoes-upload-btn.video:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .instrucoes-upload-btn svg {
            width: 18px;
            height: 18px;
            margin-bottom: 4px;
        }

        .instrucoes-upload-btn span {
            font-size: 0.7rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.7);
        }

        body.light-mode .instrucoes-upload-btn span {
            color: #64748b;
        }

        .instrucoes-upload-btn.image svg,
        .instrucoes-upload-btn.image span {
            color: #a78bfa;
        }

        .instrucoes-upload-btn.audio svg,
        .instrucoes-upload-btn.audio span {
            color: #fbbf24;
        }

        .instrucoes-upload-btn.video svg,
        .instrucoes-upload-btn.video span {
            color: #f87171;
        }

        /* Placeholder vazio */
        .instrucoes-arquivos-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px 20px;
            color: rgba(255, 255, 255, 0.4);
        }

        body.light-mode .instrucoes-arquivos-empty {
            color: #94a3b8;
        }

        .instrucoes-arquivos-empty svg {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        .instrucoes-arquivos-empty p {
            font-size: 0.875rem;
        }

        /* Drag and drop zones */
        .instrucoes-editor-body .rich-text-editor-compact.drag-over {
            background: rgba(108, 99, 255, 0.1);
            border: 2px dashed rgba(108, 99, 255, 0.5);
            cursor: text !important;
        }

        body.light-mode .instrucoes-editor-body .rich-text-editor-compact.drag-over {
            background: #f0fdf4;
            border: 2px dashed #6C63FF;
            cursor: text !important;
        }

        /* Cursor de inserção durante drag */
        .instrucoes-editor-body .rich-text-editor-compact.drag-over::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            cursor: text !important;
        }

        /* Tag de arquivo no texto */
        .arquivo-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            background: #3b82f6;
            color: white;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 500;
            margin: 0 2px;
            vertical-align: middle;
            white-space: nowrap;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            pointer-events: none;
        }

        body.light-mode .arquivo-tag {
            background: #3b82f6;
            color: white;
        }

        .arquivo-tag-icon {
            width: 12px;
            height: 12px;
            flex-shrink: 0;
        }

        .arquivo-tag-text {
            display: inline;
            white-space: nowrap;
        }

        .arquivo-tag-uploading {
            background: rgba(59, 130, 246, 0.2) !important;
            border: 1px solid rgba(59, 130, 246, 0.5);
            color: #3b82f6 !important;
            animation: pulse-upload 2s ease-in-out infinite;
        }

        body.light-mode .arquivo-tag-uploading {
            background: rgba(59, 130, 246, 0.1) !important;
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #2563eb !important;
        }

        @keyframes pulse-upload {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        /* Indicador de posição durante drag */
        .cursor-indicator {
            position: fixed;
            width: 2px;
            height: 20px;
            background: #3b82f6;
            pointer-events: none;
            z-index: 10001;
            animation: blink 1s infinite;
            box-shadow: 0 0 4px rgba(59, 130, 246, 0.5);
        }

        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0.3; }
        }

        /* Cursor personalizado durante drag */
        .instrucoes-editor-body .rich-text-editor-compact.drag-over * {
            cursor: text !important;
        }

        /* Tag de aprimorar instruções */
        .instrucoes-aprimorar-tag {
            display: none !important;
            position: absolute;
            bottom: 12px;
            right: 12px;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            background: rgba(148, 163, 184, 0.15);
            color: rgba(148, 163, 184, 0.7);
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
            pointer-events: auto;
            border: none;
            outline: none;
            white-space: nowrap;
        }

        body.light-mode .instrucoes-aprimorar-tag {
            background: rgba(148, 163, 184, 0.1);
            color: #64748b;
        }

        .instrucoes-aprimorar-tag:hover {
            background: rgba(148, 163, 184, 0.25);
            color: rgba(148, 163, 184, 0.9);
        }

        body.light-mode .instrucoes-aprimorar-tag:hover {
            background: rgba(148, 163, 184, 0.2);
            color: #475569;
        }

        .instrucoes-aprimorar-tag svg {
            width: 12px;
            height: 12px;
        }

        .rich-text-editor-compact {
            min-height: 120px;
            max-height: 200px;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.05);
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px 16px;
            color: #fff;
            font-size: 0.9rem;
            line-height: 1.6;
            outline: none;
            white-space: pre-wrap;
        }

        .rich-text-editor-compact p {
            margin: 0 0 10px 0;
            white-space: pre-wrap;
        }

        .rich-text-editor-compact p:last-child {
            margin-bottom: 0;
        }

        .rich-text-editor-compact br {
            display: block;
            content: "";
            margin: 0;
        }

        .rich-text-editor-compact:focus {
            outline: none;
        }

        .rich-text-editor-compact[contenteditable="true"]:empty:before {
            content: attr(placeholder);
            color: #888;
            pointer-events: none;
        }

        body.light-mode .rich-text-editor-compact {
            background: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .rich-text-editor-compact[contenteditable="true"]:empty:before {
            color: #999 !important;
        }

        .identidade-campos .form-group-modal input[type="color"],
        .agente-avatar-container .form-group-modal input[type="color"] {
            width: 100%;
            height: 44px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            padding: 0;
            outline: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            box-sizing: border-box;
        }

        .identidade-campos .form-group-modal input[type="color"]::-webkit-color-swatch-wrapper,
        .agente-avatar-container .form-group-modal input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
            border: none;
            border-radius: 8px;
        }

        .identidade-campos .form-group-modal input[type="color"]::-webkit-color-swatch,
        .agente-avatar-container .form-group-modal input[type="color"]::-webkit-color-swatch {
            border: none;
            border-radius: 8px;
        }

        body.light-mode .identidade-campos .form-group-modal input[type="color"],
        body.light-mode .agente-avatar-container .form-group-modal input[type="color"] {
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        /* Scrollbar para o conteúdo do modal */
        .criar-agente-modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .criar-agente-modal-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
        }

        .criar-agente-modal-content::-webkit-scrollbar-thumb {
            background: rgba(108, 99, 255, 0.3);
            border-radius: 4px;
        }

        .criar-agente-modal-content::-webkit-scrollbar-thumb:hover {
            background: rgba(108, 99, 255, 0.5);
        }


        .modal-column {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .modal-column:first-child {
            flex: 1;
            min-height: 0;
        }

        .modal-column:first-child .form-group-modal:last-child {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .modal-column:first-child .instrucoes-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .modal-column:first-child .instrucoes-textarea {
            flex: 1;
            min-height: 0;
            resize: none;
        }

        .modal-divider {
            width: 2px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1px;
            align-self: stretch;
        }

        .criar-agente-section h4 {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            text-align: left;
        }

        .conhecimentos-section h4 {
            margin-bottom: 12px;
        }

        .conhecimentos-section .form-group-modal {
            margin-bottom: 0;
        }

        .form-group-modal {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group-modal label {
            display: block;
            color: #ccc;
            font-size: 0.9rem;
            margin-bottom: 8px;
            font-weight: 500;
            line-height: 1.4;
            min-height: 20px;
        }

        .form-group-modal input[type="text"],
        .form-group-modal input[type="number"],
        .form-group-modal textarea,
        .form-group-modal select {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 15px;
            color: white;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group-modal textarea {
            resize: vertical;
            min-height: 120px;
        }

        .instrucoes-container {
            position: relative;
            width: 100%;
        }

        .instrucoes-container > label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .instrucoes-fullscreen-btn {
            background: rgba(108, 99, 255, 0.1);
            border: 1px solid rgba(108, 99, 255, 0.3);
            color: #6C63FF;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            margin-left: auto;
        }

        .instrucoes-fullscreen-btn:hover {
            background: rgba(108, 99, 255, 0.2);
            transform: scale(1.05);
        }

        /* Toolbar de Formatação Markdown */
        .markdown-toolbar {
            display: flex;
            gap: 8px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px 8px 0 0;
            border-bottom: none;
            flex-wrap: wrap;
        }

        .markdown-toolbar-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ccc;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .markdown-toolbar-btn:hover {
            background: rgba(108, 99, 255, 0.2);
            border-color: #6C63FF;
            color: #6C63FF;
            transform: translateY(-1px);
        }

        .markdown-toolbar-btn svg {
            width: 14px;
            height: 14px;
        }

        .instrucoes-textarea-wrapper {
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        .instrucoes-textarea-wrapper:focus-within {
            border-color: #6C63FF;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }

        .instrucoes-textarea-wrapper:focus-within .markdown-toolbar {
            border-color: #6C63FF;
        }

        /* Editor de Texto Rico */
        .rich-text-editor {
            min-height: 400px;
            max-height: 500px;
            background: rgba(255, 255, 255, 0.05);
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px;
            color: white;
            font-size: 0.95rem;
            line-height: 1.6;
            overflow-y: auto;
            outline: none;
            border-radius: 0 0 8px 8px;
        }

        .rich-text-editor:focus {
            outline: none;
        }

        .rich-text-editor p {
            margin: 0 0 10px 0;
            white-space: pre-wrap;
        }

        .rich-text-editor p:last-child {
            margin-bottom: 0;
        }

        .rich-text-editor br {
            display: block;
            content: "";
            margin: 0;
        }

        .rich-text-editor h1,
        .rich-text-editor h2,
        .rich-text-editor h3 {
            color: #6C63FF;
            margin: 15px 0 10px 0;
        }

        .rich-text-editor h1 {
            font-size: 1.8rem;
        }

        .rich-text-editor h2 {
            font-size: 1.5rem;
        }

        .rich-text-editor h3 {
            font-size: 1.2rem;
        }

        .rich-text-editor ul,
        .rich-text-editor ol {
            margin: 10px 0 10px 20px;
        }

        .rich-text-editor li {
            margin-bottom: 5px;
        }

        .rich-text-editor code {
            background: rgba(255, 255, 255, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 0.9em;
        }

        .rich-text-editor blockquote {
            border-left: 4px solid #6C63FF;
            padding-left: 15px;
            margin: 10px 0;
            color: #aaa;
            font-style: italic;
        }

        .rich-text-editor[contenteditable="true"]:empty:before {
            content: attr(placeholder);
            color: #888;
            pointer-events: none;
        }

        /* Modal de Tela Cheia para Instruções */
        .fullscreen-instrucoes-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 20000;
            padding: 20px;
        }

        .fullscreen-instrucoes-modal.show {
            display: flex;
        }

        .fullscreen-instrucoes-content {
            background: rgba(26, 26, 26, 0.98);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            width: 90%;
            max-width: 1400px;
            height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
        }

        .fullscreen-instrucoes-header {
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fullscreen-instrucoes-header h3 {
            color: #6C63FF;
            font-size: 1.5rem;
            margin: 0;
        }

        .fullscreen-instrucoes-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .fullscreen-editor-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 0;
            overflow: hidden;
        }

        .fullscreen-editor-panel .markdown-toolbar {
            border-radius: 0;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .fullscreen-editor-panel .rich-text-editor {
            flex: 1;
            min-height: 0;
            max-height: none;
            border: none;
            border-radius: 0;
        }

        .fullscreen-close-btn {
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid rgba(255, 68, 68, 0.3);
            color: #ff4444;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .fullscreen-close-btn:hover {
            background: rgba(255, 68, 68, 0.2);
            transform: scale(1.05);
        }

        .form-group-modal input[type="text"]:focus,
        .form-group-modal input[type="number"]:focus,
        .form-group-modal textarea:focus,
        .form-group-modal select:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }

        .form-group-modal input[type="text"]:not(:focus),
        .form-group-modal input[type="number"]:not(:focus),
        .form-group-modal textarea:not(:focus),
        .form-group-modal select:not(:focus) {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .form-group-modal input[type="text"]::placeholder,
        .form-group-modal textarea::placeholder {
            color: #888;
        }

        .form-group-modal select option {
            background: #1a1a1a;
            color: white;
        }

        /* Container para modelo + explicação + créditos */
        .modelo-container {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .modelo-container > label {
            margin-bottom: 8px;
        }

        .modelo-container > select {
            margin-bottom: 0;
        }

        /* Caixa de explicação do modelo - abaixo do select */
        .modelo-explanation {
            margin-top: 10px;
            padding: 15px;
            background: rgba(108, 99, 255, 0.1);
            border: 1px solid rgba(108, 99, 255, 0.3);
            border-radius: 8px;
            color: #ccc;
            font-size: 0.9rem;
            line-height: 1.5;
            display: none;
            width: 100%;
        }

        .modelo-explanation > div {
            display: inline;
            vertical-align: middle;
        }

        .modelo-explanation.show {
            display: block;
        }

        /* Tag de consumo do modelo */
        .consumo-tag {
            display: inline-block;
            background: rgba(255, 193, 7, 0.2);
            border: 1px solid rgba(255, 193, 7, 0.4);
            color: #ffc107;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 8px;
            vertical-align: middle;
        }

        /* Máximo de créditos dentro do container do modelo */
        .modelo-container > div[style*="margin-top"] {
            margin-top: 20px !important;
        }

        .modelo-container > div[style*="margin-top"] > label {
            margin-bottom: 8px;
        }

        /* Slider de Criatividade */
        .temperature-slider-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .temperature-slider {
            flex: 1;
            -webkit-appearance: none;
            appearance: none;
            height: 8px;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            outline: none;
        }

        .temperature-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #6C63FF;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .temperature-slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
        }

        .temperature-slider::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #6C63FF;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .temperature-slider::-moz-range-thumb:hover {
            transform: scale(1.2);
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
        }

        .temperature-value {
            min-width: 50px;
            text-align: center;
            color: #6C63FF;
            font-weight: 600;
            font-size: 1rem;
        }

        /* Opções do Agente - Acordeon */
        .opcoes-agente-toggle {
            transition: color 0.3s ease;
        }

        .opcoes-agente-toggle:hover {
            color: #6C63FF;
        }

        .opcoes-agente-icon {
            transition: transform 0.3s ease;
        }

        .opcoes-agente-section.open .opcoes-agente-icon {
            transform: rotate(180deg);
        }

        .opcoes-agente-section {
            transition: margin-top 0.3s ease, padding-top 0.3s ease, padding-bottom 0.3s ease, border-top-width 0.3s ease, border-top-color 0.3s ease;
            margin-top: 0;
            padding-top: 0;
            padding-bottom: 0;
            border-top: none;
            position: relative;
        }

        .opcoes-agente-wrapper {
            transition: margin-top 0.3s ease, padding-top 0.3s ease, border-top-width 0.3s ease, max-height 0.3s ease;
            margin-top: 0 !important;
            padding-top: 0 !important;
            border-top: none !important;
            max-height: 0 !important;
            min-height: 0 !important;
            height: 0 !important;
            overflow: hidden;
        }

        .opcoes-agente-wrapper.open {
            margin-top: 20px !important;
            padding-top: 20px !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            max-height: 2000px !important;
            height: auto !important;
            min-height: auto !important;
        }

        .opcoes-agente-toggle {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            user-select: none;
            margin: 0 0 15px 0;
            padding: 0;
            transition: color 0.3s ease;
        }

        .opcoes-agente-section:not(.open) {
            margin-top: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            border-top: none !important;
            max-height: 0 !important;
            min-height: 0 !important;
            height: 0 !important;
            overflow: hidden;
        }

        .opcoes-agente-section.open {
            margin-top: 0;
            padding-top: 0;
            max-height: 2000px;
        }

        .opcoes-agente-section:not(.open) .opcoes-agente-content {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
        }

        .opcoes-agente-section.open {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            height: auto;
            overflow: visible;
        }

        .opcoes-agente-toggle {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            user-select: none;
            margin: 0;
            padding: 0;
            transition: color 0.3s ease;
        }

        .opcoes-agente-section.open .opcoes-agente-toggle {
            position: relative;
            margin-bottom: 15px;
            opacity: 1;
            height: auto;
        }

        .opcoes-agente-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            opacity: 0;
        }

        .opcoes-agente-section.open .opcoes-agente-content {
            max-height: 1000px;
            opacity: 1;
        }

        /* Switch de Agente Ativo */
        .switch-container {
            display: flex;
            align-items: center;
            gap: 15px;
            width: 100%;
        }

        .switch-container > div {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
            flex-wrap: wrap;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider-switch {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.2);
            transition: 0.3s;
            border-radius: 26px;
        }

        .slider-switch:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
        }

        input:checked + .slider-switch {
            background-color: #6C63FF;
        }

        input:checked + .slider-switch:before {
            transform: translateX(24px);
        }

        .switch-label {
            color: #ccc;
            font-size: 0.9rem;
        }

        /* Ícone de ajuda com tooltip instantâneo */
        .help-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.8);
            font-size: 0.7rem;
            color: rgba(148, 163, 184, 0.95);
            cursor: help;
            position: relative;
        }
        .help-icon-tooltip {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 125%;
            background: rgba(15, 23, 42, 0.98);
            color: #e5e7eb;
            padding: 8px 10px;
            border-radius: 8px;
            font-size: 0.75rem;
            line-height: 1.3;
            white-space: normal;
            min-width: 220px;
            max-width: 280px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.65);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.05s ease;
            z-index: 20;
        }
        .help-icon:hover .help-icon-tooltip {
            opacity: 1;
        }
        .help-icon-tooltip::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border-width: 6px;
            border-style: solid;
            border-color: rgba(15, 23, 42, 0.98) transparent transparent transparent;
        }


        /* Aviso modelo não ativa ferramentas */
        .modelo-ferramentas-aviso {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            padding: 10px 12px;
            background: rgba(255, 193, 7, 0.15);
            border: 1px solid rgba(255, 193, 7, 0.5);
            color: #ffc107;
            border-radius: 8px;
            font-size: 0.85rem;
        }
        .modelo-ferramentas-aviso.hidden { display: none !important; }
        .modelo-ferramentas-aviso-icon { font-size: 1.1rem; flex-shrink: 0; }

        /* Aviso de consumo de crédito */
        .credito-aviso {
            display: inline-block;
            background: rgba(255, 193, 7, 0.15);
            border: 1px solid rgba(255, 193, 7, 0.4);
            color: #ffc107;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-left: auto;
            white-space: nowrap;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Upload de Conhecimentos */
        .conhecimentos-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .conhecimentos-section:first-child {
            margin-top: 0;
            padding-top: 0;
            border-top: none;
        }

        .file-upload-area {
            border: 2px dashed rgba(108, 99, 255, 0.3);
            border-radius: 12px;
            padding: 15px 20px;
            text-align: center;
            background: rgba(108, 99, 255, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.1);
        }

        .file-upload-area.dragover {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.15);
        }

        .file-upload-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #6C63FF;
        }
        
        .file-upload-icon svg {
            width: 32px;
            height: 32px;
        }

        .file-upload-text {
            color: #ccc;
            font-size: 0.85rem;
            margin-bottom: 6px;
        }

        .file-upload-hint {
            color: #888;
            font-size: 0.75rem;
        }

        .file-input-hidden {
            display: none;
        }

        .uploaded-files-list {
            margin-top: 20px;
            display: none;
        }

        .uploaded-files-list.show {
            display: block;
        }

        .uploaded-file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .uploaded-file-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .file-icon {
            width: 24px;
            height: 24px;
            color: #6C63FF;
        }

        .file-name {
            color: #ccc;
            font-size: 0.9rem;
            word-break: break-all;
        }

        .file-size {
            color: #888;
            font-size: 0.8rem;
            margin-left: 10px;
        }

        .file-remove-btn {
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid rgba(255, 68, 68, 0.3);
            color: #ff4444;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }

        .file-remove-btn:hover {
            background: rgba(255, 68, 68, 0.2);
            transform: scale(1.05);
        }

        .modal-footer {
            display: flex;
            flex-direction: row;
            gap: 12px;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            flex-shrink: 0;
        }

        .btn-modal-cancel {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.4);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .btn-modal-cancel:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.6);
            color: white;
            transform: translateY(-1px);
        }

        .btn-modal-create {
            background: #6C63FF;
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-modal-create:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.35);
        }

        .btn-modal-create:disabled {
            background: #444;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Botões do modal Criar Agente (visual da imagem: Cancelar outline + Salvar Agente verde com check) */
        .criar-agente-modal .modal-footer .btn-modal-cancel {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.35);
            color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
        }

        .criar-agente-modal .modal-footer .btn-modal-cancel:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .criar-agente-modal .modal-footer .btn-modal-create {
            background: #6C63FF;
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        }

        .criar-agente-modal .modal-footer .btn-modal-create:hover {
            background: #1fa855;
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.35);
        }

        .criar-agente-modal .modal-footer .btn-modal-create svg {
            flex-shrink: 0;
        }
/* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 5px;
            left: 20px;
            z-index: 10001;
            background: transparent;
            border: none;
            border-radius: 0;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }

        .mobile-menu-toggle.visible {
            opacity: 1;
            visibility: visible;
        }

        .mobile-menu-toggle:hover {
            background: transparent;
        }

        .mobile-menu-toggle svg {
            width: 20px;
            height: 20px;
            color: #6C63FF;
        }

        /* Mobile Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Botão de fechar para mobile */
        .mobile-close-btn {
            display: none;
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10001;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            color: #6C63FF;
            cursor: pointer;
            transition: all 0.3s ease;
            align-items: center;
            justify-content: center;
        }

        .mobile-close-btn:hover {
            background: rgba(108, 99, 255, 0.2);
            color: #6C63FF;
        }

        .mobile-close-btn svg {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                height: 100vh;
                z-index: 9999;
                transition: left 0.3s ease;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
                pointer-events: none;
            }

            .sidebar.mobile-open {
                left: 0;
                width: 250px;
                pointer-events: auto;
            }

            .sidebar.mobile-open .menu-text {
                opacity: 1 !important;
            }

            .sidebar.mobile-open .sidebar-logo {
                opacity: 1 !important;
            }

            .sidebar.mobile-open .version-text {
                opacity: 1 !important;
            }

            .sidebar:hover {
                width: 250px !important;
                left: -250px !important;
            }

            .menu-item:hover {
                background: transparent !important;
                color: #ccc !important;
            }

            .menu-item:hover .menu-icon svg {
                transform: none !important;
            }

            .menu-item:hover .menu-icon .material-symbols-rounded {
                transform: none !important;
            }


            .main-content {
                padding: 20px;
                margin-left: 0;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
            }

            .btn-novo-agente {
                width: 100%;
            }

            .agentes-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .mobile-close-btn {
                display: flex;
            }

            .mobile-close-btn:hover {
                background: rgba(108, 99, 255, 0.2);
            }
.criar-agente-modal-content {
                padding: 20px;
                max-width: 95%;
            }

            .criar-agente-section {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .identidade-layout {
                flex-direction: column;
                gap: 20px;
            }

            .agente-avatar-container {
                min-width: auto;
                width: 100%;
            }

            .modal-divider {
                display: none;
            }

        }

        /* Light Mode Styles */
        body.light-mode {
            background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
            color: #333;
        }

        body.light-mode .sidebar {
            background: rgba(255, 255, 255, 0.95);
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        body.light-mode .menu-item {
            color: #666;
        }

        body.light-mode .menu-item:hover {
            background: rgba(108, 99, 255, 0.1);
            color: #6C63FF;
        }

        body.light-mode .menu-item.active {
            background: rgba(108, 99, 255, 0.15);
            color: #6C63FF;
        }

        body.light-mode .version-text {
            color: #999;
        }

        body.light-mode .menu-badge-novidade,
        body.light-mode .menu-badge-admin {
            background: #6C63FF;
            color: #fff;
        }

        body.light-mode .sidebar-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .sidebar-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .logout-item {
            color: #ff6b6b !important;
        }

        body.light-mode .logout-item:hover {
            background: rgba(255, 107, 107, 0.15) !important;
            color: #ff6b6b !important;
        }

        body.light-mode .theme-switch .slider {
            background-color: #ccc;
        }

        body.light-mode .theme-switch input:checked + .slider {
            background-color: #6C63FF;
        }

        body.light-mode .theme-switch .slider:before {
            background-color: white;
        }

        body.light-mode .header-content h1 {
            color: #222;
        }

        body.light-mode .header-content p {
            color: #666;
        }

        body.light-mode .agente-card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        body.light-mode .agente-card:hover {
            border-color: rgba(108, 99, 255, 0.3);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.15);
        }

        body.light-mode .agente-card-nome {
            color: #222;
        }

        body.light-mode .agente-card-modelo {
            color: #666;
        }

        body.light-mode .agente-card-detail-item {
            color: #555;
        }

        body.light-mode .agente-card-subtitle {
            color: #666;
        }

        body.light-mode .agente-card-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }

        body.light-mode .agente-footer-icon {
            background: rgba(0, 0, 0, 0.03);
            color: #666;
        }

        body.light-mode .agente-footer-icon:hover {
            background: rgba(0, 0, 0, 0.08);
            color: #333;
        }

        body.light-mode .agente-card-criar {
            background: rgba(255, 255, 255, 0.98);
            border: 2px dashed rgba(0, 0, 0, 0.2);
        }

        body.light-mode .agente-card-criar:hover {
            border-color: rgba(108, 99, 255, 0.4);
            background: rgba(108, 99, 255, 0.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        body.light-mode .agente-card-criar-icon {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.15);
        }

        body.light-mode .agente-card-criar:hover .agente-card-criar-icon {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.light-mode .agente-card-criar-icon svg {
            color: rgba(0, 0, 0, 0.4);
        }

        body.light-mode .agente-card-criar:hover .agente-card-criar-icon svg {
            color: #6C63FF;
        }

        body.light-mode .agente-card-criar-title {
            color: rgba(0, 0, 0, 0.6);
        }

        body.light-mode .agente-card-criar:hover .agente-card-criar-title {
            color: #6C63FF;
        }

        body.light-mode .agente-card-criar-desc {
            color: rgba(0, 0, 0, 0.4);
        }

        body.light-mode .empty-state {
            color: #666;
        }

        body.light-mode .empty-state h3 {
            color: #333;
        }

        body.light-mode .criar-agente-modal-content,
        body.light-mode .fullscreen-instrucoes-content {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-top: 3px solid rgba(108, 99, 255, 0.6);
            color: #333;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        body.light-mode .criar-agente-modal h3,
        body.light-mode .criar-agente-modal-title,
        body.light-mode .fullscreen-instrucoes-header h3 {
            color: #1f2937;
            font-weight: 700;
        }

        body.light-mode .modal-subtitle {
            color: #6b7280;
        }

        body.light-mode .criar-agente-section h4 {
            color: #222;
        }

        body.light-mode .form-group-modal label {
            color: #333;
        }

        body.light-mode .form-group-modal input[type="text"],
        body.light-mode .form-group-modal input[type="number"],
        body.light-mode .form-group-modal textarea,
        body.light-mode .form-group-modal select {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            border-radius: 8px !important;
            color: #333 !important;
            outline: none !important;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        body.light-mode .form-group-modal input[type="text"]:focus,
        body.light-mode .form-group-modal input[type="number"]:focus,
        body.light-mode .form-group-modal textarea:focus,
        body.light-mode .form-group-modal select:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
        }

        body.light-mode .form-group-modal input::placeholder,
        body.light-mode .form-group-modal textarea::placeholder {
            color: #999;
        }

        body.light-mode .modal-close-btn {
            color: #9ca3af;
        }

        body.light-mode .modal-close-btn:hover {
            background: rgba(0, 0, 0, 0.06);
            color: #4b5563;
        }

        body.light-mode .modal-divider {
            background: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .markdown-toolbar {
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .markdown-toolbar-btn {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #555;
        }

        body.light-mode .markdown-toolbar-btn:hover {
            background: rgba(108, 99, 255, 0.15);
            border-color: #6C63FF;
            color: #6C63FF;
        }

        body.light-mode .rich-text-editor {
            background: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .rich-text-editor h1,
        body.light-mode .rich-text-editor h2,
        body.light-mode .rich-text-editor h3 {
            color: #6C63FF;
        }

        body.light-mode .rich-text-editor blockquote {
            color: #555;
        }

        body.light-mode .rich-text-editor code {
            background: rgba(0, 0, 0, 0.08);
        }

        body.light-mode .instrucoes-textarea-wrapper {
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        body.light-mode .instrucoes-fullscreen-btn {
            background: rgba(108, 99, 255, 0.1);
            border: 1px solid rgba(108, 99, 255, 0.3);
            color: #6C63FF;
        }

        body.light-mode .instrucoes-fullscreen-btn:hover {
            background: rgba(108, 99, 255, 0.2);
        }

        body.light-mode .fullscreen-instrucoes-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .agente-card-details {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .agente-card-status.active {
            background: rgba(108, 99, 255, 0.15);
            border: 1px solid rgba(108, 99, 255, 0.3);
            color: #6C63FF;
        }

        body.light-mode .agente-card-status.inactive {
            background: rgba(255, 59, 48, 0.15);
            border: 1px solid rgba(255, 59, 48, 0.3);
            color: #ff3b30;
        }

        body.light-mode .toast-notification {
            background: rgba(108, 99, 255, 0.15);
            border: 1px solid rgba(108, 99, 255, 0.3);
            color: #6C63FF;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        body.light-mode .toast-notification.success {
            background: rgba(34, 197, 94, 0.15);
            border-color: rgba(34, 197, 94, 0.3);
            color: #22c55e;
        }

        body.light-mode .toast-notification.error {
            background: rgba(255, 68, 68, 0.15);
            border-color: rgba(255, 68, 68, 0.3);
            color: #ff4444;
        }

        body.light-mode .toast-notification.info {
            background: rgba(255, 193, 7, 0.15);
            border-color: rgba(255, 193, 7, 0.3);
            color: #ffc107;
        }

        body.light-mode .mobile-menu-toggle {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .mobile-menu-toggle:hover {
            background: rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.light-mode .sidebar-overlay {
            background: rgba(0, 0, 0, 0.3);
        }

        body.light-mode .btn-modal-cancel {
            background: rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(0, 0, 0, 0.3);
            color: #333;
        }

        body.light-mode .btn-modal-cancel:hover {
            background: rgba(0, 0, 0, 0.12);
            border-color: rgba(0, 0, 0, 0.5);
            transform: translateY(-1px);
        }

        body.light-mode .criar-agente-modal .modal-footer .btn-modal-cancel {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #475569;
        }

        body.light-mode .criar-agente-modal .modal-footer .btn-modal-cancel:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #334155;
        }

        body.light-mode .criar-agente-modal .modal-footer .btn-modal-create {
            background: #6C63FF;
            color: #ffffff;
        }

        body.light-mode .criar-agente-modal .modal-footer .btn-modal-create:hover {
            background: #1fa855;
        }

        body.light-mode .file-upload-area {
            background: rgba(108, 99, 255, 0.08);
            border: 2px dashed rgba(108, 99, 255, 0.3);
        }

        body.light-mode .file-upload-area:hover {
            background: rgba(108, 99, 255, 0.12);
        }

        body.light-mode .file-name {
            color: #555;
        }

        body.light-mode .file-size {
            color: #999;
        }

        body.light-mode .btn-novo-agente {
            background: #6C63FF;
        }

        /* Modal overlay - Light Mode */
        body.light-mode .criar-agente-modal {
            background: rgba(0, 0, 0, 0.6);
        }

        body.light-mode .fullscreen-instrucoes-modal {
            background: rgba(0, 0, 0, 0.7);
        }

        /* Select options - Light Mode */
        body.light-mode .form-group-modal select option {
            background: #ffffff !important;
            color: #333 !important;
        }

        /* Scrollbar - Light Mode */
        /* Scrollbar do modal - Light Mode */
        body.light-mode .criar-agente-modal-content::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        body.light-mode .criar-agente-modal-content::-webkit-scrollbar-thumb {
            background: rgba(108, 99, 255, 0.3);
        }

        body.light-mode .criar-agente-modal-content::-webkit-scrollbar-thumb:hover {
            background: rgba(108, 99, 255, 0.5);
        }


        /* Modelo explanation - Light Mode */
        body.light-mode .modelo-explanation {
            background: rgba(108, 99, 255, 0.1) !important;
            border: 1px solid rgba(108, 99, 255, 0.3) !important;
            color: #333 !important;
        }

        /* Consumo tag - Light Mode */
        body.light-mode .consumo-tag {
            background: rgba(255, 193, 7, 0.2) !important;
            border: 1px solid rgba(255, 193, 7, 0.4) !important;
            color: #d4a017 !important;
        }

        /* Fullscreen close button - Light Mode */
        body.light-mode .fullscreen-close-btn {
            background: rgba(255, 68, 68, 0.1) !important;
            border: 1px solid rgba(255, 68, 68, 0.3) !important;
            color: #ff4444 !important;
        }

        body.light-mode .fullscreen-close-btn:hover {
            background: rgba(255, 68, 68, 0.2) !important;
        }

        /* Button modal create disabled - Light Mode */
        body.light-mode .btn-modal-create:disabled {
            background: #ccc !important;
            color: #666 !important;
            cursor: not-allowed !important;
        }

        /* Temperature slider - Light Mode */
        body.light-mode .temperature-slider {
            background: rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .temperature-slider::-webkit-slider-thumb {
            background: #6C63FF !important;
        }

        body.light-mode .temperature-slider::-moz-range-thumb {
            background: #6C63FF !important;
        }

        body.light-mode .temperature-value {
            color: #333 !important;
        }

        /* Switch - Light Mode */
        body.light-mode .slider-switch {
            background-color: #ccc !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
        }

        body.light-mode input:checked + .slider-switch {
            background-color: #6C63FF !important;
            border-color: #6C63FF !important;
        }

        body.light-mode .slider-switch:before {
            background-color: white !important;
        }

        body.light-mode .switch-label {
            color: #333 !important;
        }

        body.light-mode .intervalo-segundos-label {
            color: #333 !important;
        }

        body.light-mode .intervalo-agrupar-input {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            color: #333 !important;
        }

        body.light-mode .intervalo-agrupar-input:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
        }

        body.light-mode .intervalo-help-icon {
            color: rgba(0, 0, 0, 0.5) !important;
        }

        .intervalo-help-icon {
            pointer-events: auto !important;
        }

        .intervalo-help-icon:hover {
            opacity: 0.8;
        }

        /* Rich text editor placeholder - Light Mode */
        body.light-mode .rich-text-editor[contenteditable="true"]:empty:before {
            color: #999 !important;
        }

        /* Instrucoes textarea wrapper focus - Light Mode */
        body.light-mode .instrucoes-textarea-wrapper:focus-within {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2) !important;
        }

        body.light-mode .instrucoes-textarea-wrapper:focus-within .markdown-toolbar {
            border-color: #6C63FF !important;
        }

        /* File remove button - Light Mode */
        body.light-mode .file-remove-btn {
            background: rgba(255, 68, 68, 0.1) !important;
            border: 1px solid rgba(255, 68, 68, 0.3) !important;
            color: #ff4444 !important;
        }

        body.light-mode .file-remove-btn:hover {
            background: rgba(255, 68, 68, 0.2) !important;
        }

        /* Loading text - Light Mode */
        body.light-mode .loading-text {
            color: #999 !important;
        }

        /* Empty state - Light Mode */
        body.light-mode .empty-state {
            color: #999 !important;
        }

        body.light-mode .empty-state h3 {
            color: #666 !important;
        }

        body.light-mode .empty-state p {
            color: #999 !important;
        }

        /* Campo de data nas tarefas padrão - Light Mode */
        body.light-mode .tarefa-data,
        body.light-mode input[type="date"].tarefa-data {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            color: #333 !important;
        }

        body.light-mode .tarefa-data:focus,
        body.light-mode input[type="date"].tarefa-data:focus {
            border-color: #6C63FF !important;
            outline: none !important;
        }

        body.light-mode .tarefa-data::-webkit-calendar-picker-indicator {
            filter: invert(0.3) !important;
        }

        body.light-mode .tarefa-descricao {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            color: #333 !important;
        }

        body.light-mode .tarefa-descricao:focus {
            border-color: #6C63FF !important;
            outline: none !important;
        }

        /* Header content - Light Mode */
        body.light-mode .header-content h1 {
            color: #222 !important;
        }

        body.light-mode .header-content p {
            color: #666 !important;
        }

        /* Opções do Agente - Light Mode */
        body.light-mode .opcoes-agente-toggle:hover {
            color: #6C63FF !important;
        }

        /* Rich text editor paragraphs and lists - Light Mode */
        body.light-mode .rich-text-editor p {
            color: #333 !important;
        }

        body.light-mode .rich-text-editor li {
            color: #333 !important;
        }

        /* Texto de ajuda nas opções do agente */
        .form-group-modal small {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.4;
        }

        body.light-mode .form-group-modal small {
            color: rgba(0, 0, 0, 0.6) !important;
        }


        body.light-mode .rich-text-editor ul,
        body.light-mode .rich-text-editor ol {
            color: #333 !important;
        }

        body.light-mode .rich-text-editor blockquote {
            border-left-color: #6C63FF !important;
        }

        /* Fullscreen editor panel - Light Mode */
        body.light-mode .fullscreen-editor-panel .markdown-toolbar {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .fullscreen-editor-panel .rich-text-editor {
            background: rgba(0, 0, 0, 0.03) !important;
            border-top: 1px solid rgba(0, 0, 0, 0.1) !important;
            color: #333 !important;
        }

        /* Estilos para campos de QA */
        .qa-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .qa-item textarea {
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 10px;
            color: #fff;
            font-size: 0.875rem;
            resize: vertical;
            font-family: inherit;
        }

        .qa-item textarea:focus {
            border-color: #6C63FF;
            outline: none;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }

        body.light-mode .qa-item {
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .qa-item textarea {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        body.light-mode .qa-item textarea:focus {
            border-color: #6C63FF;
        }

        /* Botão adicionar QA */
        .btn-adicionar-qa {
            background: rgba(108, 99, 255, 0.1);
            border: 1px solid rgba(108, 99, 255, 0.3);
            color: #6C63FF;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .btn-adicionar-qa:hover {
            background: rgba(108, 99, 255, 0.2);
            border-color: rgba(108, 99, 255, 0.5);
        }

        body.light-mode .btn-adicionar-qa {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.light-mode .btn-adicionar-qa:hover {
            background: rgba(108, 99, 255, 0.2);
        }

        /* Conhecimentos section - Light Mode */
        body.light-mode .conhecimentos-section {
            border-top-color: rgba(0, 0, 0, 0.1) !important;
        }

        /* File upload text and hint - Light Mode */
        body.light-mode .file-upload-text {
            color: #555 !important;
        }

        body.light-mode .file-upload-hint {
            color: #999 !important;
        }

        /* Uploaded files - Light Mode */
        body.light-mode .uploaded-file-item {
            background: rgba(0, 0, 0, 0.03) !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .file-name {
            color: #333 !important;
        }

        body.light-mode .file-size {
            color: #999 !important;
        }

        /* Conhecimentos lista - Light Mode */
        body.light-mode #conhecimentosLista {
            background: rgba(0, 0, 0, 0.03) !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode #conhecimentosLista p {
            color: #999 !important;
        }

        /* Conhecimento items - Dark Mode */
        .conhecimento-item {
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            margin-bottom: 8px;
            transition: all 0.2s ease;
        }

        .conhecimento-item:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .conhecimento-item-arquivo {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .conhecimento-item-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .conhecimento-icon {
            color: #6C63FF;
            flex-shrink: 0;
        }

        .conhecimento-nome {
            color: #fff;
            font-size: 0.875rem;
        }

        .conhecimento-tamanho {
            color: #888;
            font-size: 0.75rem;
        }

        .conhecimento-item-qa {
            padding: 10px;
        }

        .conhecimento-qa-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .conhecimento-label {
            color: #6C63FF;
            font-size: 0.875rem;
        }

        .conhecimento-pergunta {
            color: #fff;
            font-size: 0.875rem;
        }

        .conhecimento-qa-resposta {
            margin-left: 26px;
        }

        .conhecimento-resposta {
            color: #ccc;
            font-size: 0.875rem;
        }

        .conhecimento-empty {
            color: #888;
            font-size: 0.875rem;
            margin: 0;
        }

        /* Conhecimento items - Light Mode */
        body.light-mode .conhecimento-item {
            background: rgba(0, 0, 0, 0.03) !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .conhecimento-item:hover {
            background: rgba(0, 0, 0, 0.05) !important;
            border-color: rgba(0, 0, 0, 0.15) !important;
        }

        body.light-mode .conhecimento-nome {
            color: #222 !important;
        }

        body.light-mode .conhecimento-tamanho {
            color: #999 !important;
        }

        body.light-mode .conhecimento-pergunta {
            color: #222 !important;
        }

        body.light-mode .conhecimento-resposta {
            color: #666 !important;
        }

        body.light-mode .conhecimento-empty {
            color: #999 !important;
        }

        /* Modal footer - Light Mode */
        body.light-mode .modal-footer {
            border-top-color: rgba(0, 0, 0, 0.1) !important;
        }

        /* File icon - Light Mode */
        body.light-mode .file-icon {
            color: #6C63FF !important;
        }

        /* Modelo ferramentas aviso - Light Mode */
        body.light-mode .modelo-ferramentas-aviso {
            background: rgba(255, 193, 7, 0.2) !important;
            border-color: rgba(255, 193, 7, 0.5) !important;
            color: #b8860b !important;
        }

        /* Credito aviso - Light Mode */
        body.light-mode .credito-aviso {
            background: rgba(255, 193, 7, 0.15) !important;
            border-color: rgba(255, 193, 7, 0.4) !important;
            color: #d4a017 !important;
        }

        /* QA Item Title - Light Mode */
        .qa-item-title {
            color: #fff;
        }

        body.light-mode .qa-item-title {
            color: #222 !important;
        }

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

        /* Modal criar/editar agente: selects no dark (regra global acima não pode forçar branco/preto) */
        body.dark-mode .form-group-modal select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: rgba(15, 23, 42, 0.88) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center !important;
            border: 1px solid rgba(71, 85, 105, 0.55) !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            padding-right: 42px !important;
        }

        body.dark-mode .form-group-modal select:hover {
            border-color: rgba(100, 116, 139, 0.65) !important;
        }

        body.dark-mode .form-group-modal select:focus {
            border-color: rgba(108, 99, 255, 0.55) !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.18) !important;
        }

        body.dark-mode .form-group-modal select option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }
    </style>
    <script type="module">
        // Importar Supabase via CDN ESM
        import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2.95.0/+esm';
        
        // Configuração do Supabase
        const SUPABASE_URL = 'https://qlennkosykcblbhpbmqt.supabase.co';
        const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFsZW5ua29zeWtjYmxiaHBibXF0Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3Njc5NjY3MjQsImV4cCI6MjA4MzU0MjcyNH0.r_A91BCKivKMPqraRBvFn30ln-G1us1_Q7m6kDCeeN0';
        
        // Criar cliente Supabase e disponibilizar globalmente
        window.supabase = createClient(SUPABASE_URL, SUPABASE_ANON_KEY, {
            auth: {
                persistSession: true,
                autoRefreshToken: true,
                detectSessionInUrl: false
            }
        });
        
    </script>
    <style>
        .toast-container{position:fixed!important;top:max(20px,env(safe-area-inset-top,0px))!important;left:50%!important;right:auto!important;transform:translateX(-50%)!important;z-index:200100!important;display:flex!important;flex-direction:column!important;align-items:stretch!important;gap:8px!important;width:min(380px,calc(100vw - 28px))!important;pointer-events:none!important;box-sizing:border-box!important}
        .toast-notification{pointer-events:auto!important;margin:0!important;padding:10px 14px 10px 0!important;border-radius:12px!important;font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Helvetica,Arial,sans-serif!important;font-size:13px!important;line-height:1.35!important;letter-spacing:-.01em!important;font-weight:400!important;display:flex!important;align-items:center!important;gap:0!important;opacity:0!important;transform:translateY(-8px) scale(.98)!important;transition:opacity .22s ease,transform .22s ease!important;color:rgba(0,0,0,.88)!important;background:rgba(255,255,255,.76)!important;backdrop-filter:saturate(180%) blur(22px)!important;-webkit-backdrop-filter:saturate(180%) blur(22px)!important;border:1px solid rgba(0,0,0,.09)!important;box-shadow:0 4px 16px rgba(0,0,0,.1),0 0 0 .5px rgba(0,0,0,.04) inset!important;max-width:none!important}
        .toast-notification.show{opacity:1!important;transform:translateY(0) scale(1)!important}
        .toast-notification::before{content:''!important;align-self:stretch!important;width:4px!important;min-height:2.5em!important;margin:6px 12px 6px 8px!important;border-radius:3px!important;flex-shrink:0!important;background:rgba(0,122,255,.95)!important}
        .toast-notification.info::before{background:rgba(0,122,255,.95)!important}.toast-notification.success::before{background:rgba(52,199,89,.95)!important}.toast-notification.error::before{background:rgba(255,59,48,.95)!important}
        .toast-notification .toast-message{flex:1!important;min-width:0!important;word-break:break-word!important;padding-right:4px!important}
        body.dark-mode .toast-notification{color:rgba(255,255,255,.92)!important;background:rgba(44,44,46,.78)!important;border:1px solid rgba(255,255,255,.12)!important;box-shadow:0 8px 28px rgba(0,0,0,.45),0 0 0 .5px rgba(255,255,255,.06) inset!important}
        body.dark-mode .toast-notification.info::before{background:rgba(10,132,255,.95)!important}body.dark-mode .toast-notification.success::before{background:rgba(48,209,88,.95)!important}body.dark-mode .toast-notification.error::before{background:rgba(255,69,58,.95)!important}
    </style>
    <link rel="stylesheet" href="dropdowns-global.css">
    <!-- Depois de dropdowns-global.css: modal criar agente (#modeloIASelect, etc.) no dark -->
    <style>
        body.dark-mode #criarAgenteModal select {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: rgba(15, 23, 42, 0.88) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center !important;
            border: 1px solid rgba(71, 85, 105, 0.55) !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            padding-right: 42px !important;
        }
        body.dark-mode #criarAgenteModal select:hover {
            border-color: rgba(100, 116, 139, 0.65) !important;
        }
        body.dark-mode #criarAgenteModal select:focus {
            border-color: rgba(108, 99, 255, 0.55) !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.18) !important;
        }
        body.dark-mode #criarAgenteModal #whatsappSelect,
        body.dark-mode #criarAgenteModal #whatsappSelect:hover,
        body.dark-mode #criarAgenteModal #whatsappSelect:focus {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            -webkit-text-fill-color: white !important;
        }
        body.dark-mode #criarAgenteModal select option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }
        body.dark-mode #criarAgenteModal select:disabled {
            background-color: rgba(30, 41, 59, 0.75) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center !important;
            color: #94a3b8 !important;
            -webkit-text-fill-color: #94a3b8 !important;
            opacity: 1 !important;
            cursor: not-allowed !important;
            border-color: rgba(71, 85, 105, 0.4) !important;
        }

        /* Passo 4: Modelo IA com cinza igual aos demais campos no dark */
        body.dark-mode #criarAgenteModal #modeloIASelect {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            color: rgba(255, 255, 255, 0.9) !important;
            -webkit-text-fill-color: rgba(255, 255, 255, 0.9) !important;
        }

        /* Passo 6 (CRM): reforço de especificidade sobre dropdowns-global / WebKit */
        body.dark-mode #wizard-step-6 .form-group-modal select {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: rgba(15, 23, 42, 0.88) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center !important;
            border: 1px solid rgba(71, 85, 105, 0.55) !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            padding-right: 42px !important;
        }

        body.dark-mode #wizard-step-6 .form-group-modal select option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }

        /* Passo 5 (HTTP): método com mesmo cinza dos inputs notify no dark */
        body.dark-mode #wizard-step-5 select[id^="select-http-method-"].notify-input {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            color: rgba(255, 255, 255, 0.9) !important;
            -webkit-text-fill-color: rgba(255, 255, 255, 0.9) !important;
        }

        body.dark-mode #crmQuadroSelect:not(:disabled),
        body.dark-mode #crmEtapaSelect:not(:disabled) {
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            background-color: rgba(15, 23, 42, 0.88) !important;
        }
    </style>
    <script src="/hublabel/public/assets/js/supabase-compat.js"></script>
</head>
<body>
    <!-- Tema antes da primeira pintura: evita flash claro (cookie darkMode, mesma lógica que getCookie) -->
    <script>
    (function () {
        var dark = false;
        try {
            var s = '; ' + document.cookie;
            var parts = s.split('; darkMode=');
            if (parts.length === 2) dark = parts.pop().split(';').shift() === 'true';
        } catch (e) {}
        document.body.classList.remove('dark-mode', 'light-mode');
        document.body.classList.add(dark ? 'dark-mode' : 'light-mode');
    })();
    </script>
    <div class="toast-container" id="toastContainer"></div>

    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle" onclick="toggleMobileMenu()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>

    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobileMenu()"></div>

    <div class="app-layout">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- Botão de fechar para mobile -->
            <button class="mobile-close-btn" id="mobileCloseBtn" onclick="closeMobileMenu()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div class="sidebar-header">
                <a href="#" class="sidebar-logo-link" onclick="return false;">
                    <img class="sidebar-logo-img" src="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/logo" alt="IA Chatconversa" onerror="this.src='https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon'">
                </a>
            </div>
            <nav class="sidebar-menu">
                <a href="#" class="menu-item" data-menu-id="dashboard" onclick="navigateToPage('/hublabel/public/hublabel/public/dashboard')">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">analytics</span>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="chat" onclick="navigateToPage('/hublabel/public/hublabel/public/chat')">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">chat</span>
                    </span>
                    <span class="menu-text">Chat</span>
                </a>
                <a href="#" class="menu-item active" data-menu-id="agentes-ia">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">network_intel_node</span>
                    </span>
                    <span class="menu-text">Agentes IA</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="crm" onclick="navigateToPage('/hublabel/public/hublabel/public/crm')">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">view_kanban</span>
                    </span>
                    <span class="menu-text">CRM</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="conexoes" onclick="navigateToPage('/hublabel/public/hublabel/public/conexoes')">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">qr_code</span>
                    </span>
                    <span class="menu-text">Conexões</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="disparos" onclick="navigateToPage('/hublabel/public/hublabel/public/disparos')">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">send</span>
                    </span>
                    <span class="menu-text">Disparos</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="contatos" onclick="navigateToPage('/hublabel/public/hublabel/public/contatos')">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">contacts</span>
                    </span>
                    <span class="menu-text">Contatos</span>
                </a>
                <div class="sidebar-nav-divider"></div>
                <a href="#" class="menu-item" data-menu-id="ajuda" onclick="navigateToPage('/hublabel/public/ajuda')">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">help</span>
                    </span>
                    <span class="menu-text">Ajuda</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="configuracoes" onclick="navigateToPage('/hublabel/public/hublabel/public/configuracoes')">
                    <span class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1 1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </span>
                    <span class="menu-text">Configurações</span>
                </a>
                <a href="#" id="menu-item-admin" class="menu-item menu-item-admin" style="display: none;" onclick="if(typeof navigateToPage==='function'){navigateToPage('/hublabel/public/hublabel/public/adminpannel');return false;}">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">admin_panel_settings</span>
                    </span>
                    <span class="menu-text">Administração</span>
                    <span class="menu-badge-admin">Admin</span>
                </a>
            </nav>
            <div class="version-text" id="versaoAtualTexto">Versão atual: -</div>
            <div class="sidebar-footer">
                <!-- Dark Mode Toggle -->
                <div class="menu-item theme-toggle-item" onclick="event.stopPropagation();">
                    <span class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </span>
                    <span class="menu-text" id="themeToggleText">Modo Escuro</span>
                    <label class="theme-switch">
                        <input type="checkbox" id="darkModeToggle" checked>
                        <span class="slider"></span>
                    </label>
                </div>
                <a href="#" class="menu-item logout-item" onclick="logout()">
                    <span class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16,17 21,12 16,7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </span>
                    <span class="menu-text">Sair</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header header-agentes">
                <div class="header-content">
                    <h1>Agentes IA</h1>
                    <p>Configure e treine a sua equipa virtual</p>
                </div>
                <div class="creditos-pill" id="creditosCard" style="display: none;">
                    <div class="creditos-pill-inner">
                        <div class="creditos-pill-label-wrap">
                            <span class="creditos-pill-icon"><i class="fa-solid fa-coins"></i></span>
                            <span class="creditos-pill-label">CRÉDITOS IA</span>
            </div>
                        <span class="creditos-pill-numbers"><span id="creditosUsados">0</span><span class="creditos-divisor"> / <span id="creditosTotal">0</span></span></span>
                </div>
                </div>
            </div>

            <!-- Alerta de Limite Atingido -->
            <div class="limite-atingido-alerta" id="limiteAtingidoAlerta" style="display: none;">
                <div class="limite-atingido-content">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>
                        Seus créditos acabaram! O limite será reiniciado dia <span id="dataProximoMes"></span>, ou faça um upgrade do seu plano. 
                        <a href="#" onclick="window.open('https://wa.me/5591982448542', '_blank'); return false;" class="limite-atingido-link">Falar com suporte</a>.
                    </span>
                </div>
            </div>

            <!-- Loading State (blocos piscantes como nas demais páginas) -->
            <div class="loading-container skeleton-loading" id="loadingContainer" style="display: none;">
                <div class="skeleton-card"><div class="skeleton-icon"></div><div class="skeleton-line title"></div><div class="skeleton-line subtitle"></div><div class="skeleton-line desc"></div><div class="skeleton-footer"><div class="skeleton-line footer"></div></div></div>
                <div class="skeleton-card"><div class="skeleton-icon"></div><div class="skeleton-line title"></div><div class="skeleton-line subtitle"></div><div class="skeleton-line desc"></div><div class="skeleton-footer"><div class="skeleton-line footer"></div></div></div>
                <div class="skeleton-card"><div class="skeleton-icon"></div><div class="skeleton-line title"></div><div class="skeleton-line subtitle"></div><div class="skeleton-line desc"></div><div class="skeleton-footer"><div class="skeleton-line footer"></div></div></div>
            </div>

            <!-- Agentes Grid -->
            <div class="agentes-grid" id="agentesGrid" style="display: none;"></div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <div class="empty-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5"></path>
                        <path d="M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <h3>Nenhum agente criado ainda</h3>
                <p>Você ainda não possui agentes de IA.<br>Clique em "Novo Agente" para começar.</p>
            </div>
        </div>
    </div>

    <!-- Modal de Criar Agente (Wizard em 6 etapas) -->
    <div class="criar-agente-modal" id="criarAgenteModal">
        <div class="criar-agente-modal-content" id="criarAgenteModalContent">
            <!-- Sidebar com passos -->
            <div class="wizard-sidebar">
                <div class="wizard-sidebar-header">
                    <div class="wizard-sidebar-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                    <h2 class="wizard-sidebar-title" id="wizardSidebarTitle">Criar Agente</h2>
                    <p class="wizard-sidebar-subtitle" id="wizardSidebarSubtitle">Siga os passos para configurar</p>
                </div>
                <div class="wizard-steps-list">
                    <div class="wizard-steps-line"></div>
                    <div class="wizard-step-item" data-step="1" onclick="editModeGoToStep(1)"><div class="wizard-step-num"><span>1</span></div><div class="wizard-step-text"><h4>Identidade</h4><p>Nome e conexão</p></div></div>
                    <div class="wizard-step-item" data-step="2" onclick="editModeGoToStep(2)"><div class="wizard-step-num"><span>2</span></div><div class="wizard-step-text"><h4>Comportamento</h4><p>Instruções e prompt</p></div></div>
                    <div class="wizard-step-item" data-step="3" onclick="editModeGoToStep(3)"><div class="wizard-step-num"><span>3</span></div><div class="wizard-step-text"><h4>Conhecimento</h4><p>Arquivos e base de dados</p></div></div>
                    <div class="wizard-step-item" data-step="4" onclick="editModeGoToStep(4)"><div class="wizard-step-num"><span>4</span></div><div class="wizard-step-text"><h4>Configurações</h4><p>Modelo e opções de IA</p></div></div>
                    <div class="wizard-step-item" data-step="5" onclick="editModeGoToStep(5)"><div class="wizard-step-num"><span>5</span></div><div class="wizard-step-text"><h4>Ferramentas</h4><p>Ações permitidas</p></div></div>
                    <div class="wizard-step-item" data-step="6" onclick="editModeGoToStep(6)"><div class="wizard-step-num"><span>6</span></div><div class="wizard-step-text"><h4>CRM</h4><p>Quadros e etapas</p></div></div>
                </div>
            </div>

            <!-- Área de conteúdo -->
            <div class="wizard-content">
                <!-- Edit mode: header com abas (escondido no criar) -->
                <div class="edit-header" id="editHeader">
                    <h2 id="editHeaderTitle">Editar Agente</h2>
                    <button type="button" class="wizard-close-btn" onclick="fecharModalCriarAgente()"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="edit-tabs-wrap" id="editTabsWrap">
                    <button type="button" class="edit-tab-btn active" data-edit-tab="1" onclick="switchEditTab(1)">Identidade</button>
                    <button type="button" class="edit-tab-btn" data-edit-tab="2" onclick="switchEditTab(2)">Comportamento</button>
                    <button type="button" class="edit-tab-btn" data-edit-tab="3" onclick="switchEditTab(3)">Conhecimento</button>
                    <button type="button" class="edit-tab-btn" data-edit-tab="4" onclick="switchEditTab(4)">Configurações</button>
                    <button type="button" class="edit-tab-btn" data-edit-tab="5" onclick="switchEditTab(5)">Ferramentas</button>
                    <button type="button" class="edit-tab-btn" data-edit-tab="6" onclick="switchEditTab(6)">CRM</button>
                </div>
                <div class="wizard-header">
                    <div class="wizard-header-title-wrap">
                        <span class="wizard-header-step" id="wizardHeaderStep">PASSO 1 DE 6</span>
                        <h3 class="wizard-header-title" id="wizardHeaderTitle">Identidade do Agente</h3>
                    </div>
                    <button type="button" class="wizard-close-btn" onclick="fecharModalCriarAgente()"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="wizard-body">
                    <!-- PASSO 1: Identidade -->
                    <div class="wizard-step active" id="wizard-step-1" data-step="1">
                <div class="identidade-layout">
                    <!-- Avatar e Cor -->
                    <div class="agente-avatar-container">
                        <div class="agente-avatar" id="agenteAvatar" style="background: #6C63FF;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="8" width="18" height="12" rx="2"></rect>
                                <circle cx="9" cy="14" r="1"></circle>
                                <circle cx="15" cy="14" r="1"></circle>
                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                <path d="M12 20v-2"></path>
                                <path d="M8 12h2"></path>
                                <path d="M14 12h2"></path>
                                <path d="M12 10v-2"></path>
                            </svg>
                        </div>
                        <div class="form-group-modal" style="margin-top: 20px;">
                            <label for="corAgenteInput">Cor do Agente</label>
                            <input type="color" id="corAgenteInput" value="#6C63FF" oninput="atualizarCorAgente(this.value)">
                        </div>
                    </div>

                    <!-- Campos -->
                    <div class="identidade-campos">
                        <div class="form-group-modal">
                            <label for="nomeAgenteInput">Nome do Agente *</label>
                            <input type="text" id="nomeAgenteInput" placeholder="Digite o nome do agente" required>
                        </div>
                        
                        <div class="form-group-modal">
                            <label for="whatsappSelect">WhatsApp vinculado *</label>
                            <select id="whatsappSelect" required>
                                <option value="">Carregando conexões...</option>
                            </select>
                        </div>
                        </div>
                    </div>
                </div>
                
                    <!-- PASSO 2: Comportamento (Instruções) -->
                    <div class="wizard-step" id="wizard-step-2" data-step="2">
                <div class="instrucoes-layout-lado-lado">
                    <!-- Editor de Instruções - Esquerda -->
                    <div class="instrucoes-editor-container">
                        <div class="instrucoes-editor-header">
                            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                <label for="instrucoesAgenteInput">Instruções do Sistema</label>
                                <button type="button" class="criar-instrucoes-link" onclick="abrirModalCriarInstrucoes()">
                                    Criar instruções com ajuda
                                </button>
                            </div>
                        </div>
                        <div class="instrucoes-editor-body">
                            <div class="instrucoes-textarea-wrapper">
                                <div class="markdown-toolbar">
                                    <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacao('bold')" title="Negrito">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
                                            <path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
                                        </svg>
                                        <span>Negrito</span>
                                    </button>
                                    <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacao('italic')" title="Itálico">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="19" y1="4" x2="10" y2="4"></line>
                                            <line x1="14" y1="20" x2="5" y2="20"></line>
                                            <line x1="15" y1="4" x2="9" y2="20"></line>
                                        </svg>
                                        <span>Itálico</span>
                                    </button>
                                    <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacao('formatBlock', false, 'h1')" title="Título 1">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M6 4v16M18 4v16M6 4h12"></path>
                                        </svg>
                                        <span>H1</span>
                                    </button>
                                    <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacao('formatBlock', false, 'h2')" title="Título 2">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M6 4v8M18 4v8M6 4h12M6 12h12"></path>
                                        </svg>
                                        <span>H2</span>
                                    </button>
                                    <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacao('formatBlock', false, 'h3')" title="Título 3">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M6 4v4M18 4v4M6 4h12M6 8h12M6 12v4M18 12v4M6 12h12"></path>
                                        </svg>
                                        <span>H3</span>
                                    </button>
                                    <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacao('insertUnorderedList')" title="Lista">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="8" y1="6" x2="21" y2="6"></line>
                                            <line x1="8" y1="12" x2="21" y2="12"></line>
                                            <line x1="8" y1="18" x2="21" y2="18"></line>
                                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                        </svg>
                                        <span>Lista</span>
                                    </button>
                                    <button type="button" class="markdown-toolbar-btn" onclick="abrirFullscreenInstrucoes()" title="Tela Cheia" style="margin-left: auto;">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                                        </svg>
                                        <span>Tela Cheia</span>
                                    </button>
                                </div>
                                <div id="instrucoesAgenteInput" class="rich-text-editor-compact" contenteditable="true" placeholder="Digite aqui como o agente deve se comportar. Você pode arrastar os arquivos da direita para cá para dar contexto..."></div>
                                <button class="instrucoes-aprimorar-tag" onclick="aprimorarInstrucoes()" title="Aprimorar instruções com IA">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                        <path d="M2 17l10 5 10-5"></path>
                                        <path d="M2 12l10 5 10-5"></path>
                                    </svg>
                                    Aprimorar instruções
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Painel de Arquivos Multimídia - Direita -->
                    <div class="instrucoes-arquivos-container">
                        <div class="instrucoes-arquivos-list" id="instrucoesArquivosList">
                            <!-- Lista de arquivos será inserida aqui via JavaScript -->
                            <div class="instrucoes-arquivos-empty">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <p>Arraste arquivos aqui</p>
                            </div>
                        </div>
                        <div class="instrucoes-arquivos-upload-zone" style="padding: 8px;">
                            <button class="instrucoes-upload-btn" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px;" onclick="document.getElementById('instrucoesFileInputAll').click()" title="Anexar arquivos">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                <span>Anexar</span>
                                <input type="file" id="instrucoesFileInputAll" accept="*/*" multiple style="display: none;" onchange="handleInstrucoesFileSelect(event)">
                            </button>
                        </div>
                    </div>
                </div>
            </div>

                    <!-- PASSO 3: Conhecimento -->
                    <div class="wizard-step" id="wizard-step-3" data-step="3">
                <div class="criar-agente-section" style="grid-template-columns: 1fr; gap: 12px;">
                    <div class="conhecimentos-section">
                        <h4>Adicionar Conhecimentos</h4>
                        <div class="form-group-modal">
                            <div class="file-upload-area" id="fileUploadArea" onclick="document.getElementById('fileInput').click()">
                                <div class="file-upload-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                </div>
                                <div class="file-upload-text">Clique para fazer upload ou arraste arquivos aqui</div>
                                <div class="file-upload-hint">Formatos suportados: PDF, TXT, CSV (máx. 10MB por arquivo)</div>
                                <input type="file" id="fileInput" class="file-input-hidden" multiple accept=".pdf,.txt,.csv" onchange="handleFileSelect(event)">
                            </div>
                            <div class="uploaded-files-list" id="uploadedFilesList"></div>
                        </div>
                    </div>

                </div>
            </div>

                    <!-- PASSO 4: Configurações -->
                    <div class="wizard-step" id="wizard-step-4" data-step="4">
                <div class="criar-agente-section" style="grid-template-columns: 1fr; gap: 12px;">
                    <div class="form-group-modal">
                        <label for="modeloIASelect">Modelo de IA *</label>
                        <select id="modeloIASelect" required>
                            <option value="">Selecione um modelo</option>
                            <option value="gpt-5-nano">GPT-5 nano</option>
                            <option value="gpt-5-mini" selected>GPT-5 mini</option>
                            <option value="gpt-5">GPT-5</option>
                            <option value="gpt-4.1-nano">GPT-4.1 nano</option>
                            <option value="gpt-4.1-mini">GPT-4.1 mini</option>
                            <option value="gpt-4.1">GPT-4.1</option>
                            <option value="gpt-4o-mini">GPT-4o mini</option>
                            <option value="gpt-4o">GPT-4o</option>
                        </select>
                        <div class="modelo-explanation" id="modeloExplanation"></div>
                        <div id="modeloFerramentasAviso" class="modelo-ferramentas-aviso hidden">
                            <span class="modelo-ferramentas-aviso-icon">⚠</span>
                            Esse modelo de IA não ativa ferramentas, caso queira usar ferramentas, selecione outro modelo
                        </div>
                    </div>

                    <div class="form-group-modal" style="margin-top: 12px; display: none;">
                        <label for="criatividadeSlider">Criatividade: <span class="temperature-value" id="criatividadeValue">0.7</span></label>
                        <div class="temperature-slider-container">
                            <input type="range" id="criatividadeSlider" class="temperature-slider" min="0" max="1" step="0.1" value="0.7">
                        </div>
                    </div>


                    <div class="conhecimentos-section" style="margin-top: 20px; padding-top: 15px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                        <h4 style="margin-bottom: 12px;">Opções do Agente</h4>
                        <div class="form-group-modal">
                            <div class="switch-container" style="margin-bottom: 12px;">
                                <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                                    <label class="switch-label">Ouvir áudio</label>
                                    <label class="switch">
                                        <input type="checkbox" id="ouvirAudioSwitch" checked>
                                        <span class="slider-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="switch-container" style="margin-bottom: 12px;">
                                <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                                    <label class="switch-label">Analisar imagens</label>
                                    <label class="switch">
                                        <input type="checkbox" id="analisarImagensSwitch" checked>
                                        <span class="slider-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="switch-container">
                                <label class="switch-label">Aparecer "Digitando..." / "Gravando..."</label>
                                <label class="switch">
                                    <input type="checkbox" id="aparecerDigitandoSwitch" checked>
                                    <span class="slider-switch"></span>
                                </label>
                            </div>
                            <div class="switch-container" style="margin-top: 12px;">
                            <div style="display: flex; align-items: center; gap: 8px; flex: 1;">
                            <label class="switch-label">
                                Pausar agente no atendimento humano
                                <span class="help-icon" style="margin-left: 6px;">
                                    ?
                                    <span class="help-icon-tooltip">
                                        Quando um atendente enviar uma mensagem pelo chat, ou Whatsapp o agente irá parar de responder automaticamente
                                    </span>
                                </span>
                            </label>
                                    <label class="switch">
                                        <input type="checkbox" id="pausarAgenteAtendimentoSwitch">
                                        <span class="slider-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="switch-container" style="margin-top: 12px;">
                                <div style="display: flex; align-items: center; gap: 8px; flex: 1; flex-wrap: wrap;">
                                    <label class="switch-label">
                                        Agrupar mensagens
                                        <span class="help-icon" style="margin-left: 6px;">
                                            ?
                                            <span class="help-icon-tooltip">
                                                Quando um cliente enviar 3-4 mensagens em sequencia IA irá aguardar o tempo definido ao lado, juntar todas mensagens recebidas no intervalo e gerar apenas 1 resposta.
                                            </span>
                                        </span>
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" id="agruparMensagensSwitch" onchange="toggleIntervaloAgruparMensagens()">
                                        <span class="slider-switch"></span>
                                    </label>
                                    <div id="intervaloAgruparMensagensContainer" style="display: none; margin-left: auto;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <input type="number" id="intervaloAgruparMensagensInput" class="intervalo-agrupar-input" placeholder="10" min="1" step="1" value="10" style="width: 100px; padding: 8px 12px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(255, 255, 255, 0.05); color: rgba(255, 255, 255, 0.9); font-size: 0.875rem;">
                                            <label class="intervalo-segundos-label" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7); white-space: nowrap;">segundos</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-modal" style="margin-top: 12px;">
                                <label for="quantidadeMensagensHistoricoInput">
                                    Quantidade de mensagens de histórico
                                    <span class="help-icon" style="margin-left: 6px;">
                                        ?
                                        <span class="help-icon-tooltip">
                                            Quantidade de mensagens que o agente irá ter de contexto para responder. Quanto mais mensagens, mais gasta créditos
                                        </span>
                                    </span>
                                </label>
                                <input type="number" id="quantidadeMensagensHistoricoInput" placeholder="Digite a quantidade" min="1" step="1" value="20">
                                <small>
                                    O agente irá inserir essa quantidade de mensagens no histórico da conversa, quanto maior quantidade, mais gasta créditos
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    <!-- PASSO 5: Ferramentas -->
                    <div class="wizard-step" id="wizard-step-5" data-step="5">
                <div class="criar-agente-section" style="grid-template-columns: 1fr; gap: 0;">
                    <div class="ferramentas-capacidades-header">
                        <div class="ferramentas-capacidades-titulo">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                            </svg>
                            Capacidades do Agente
                        </div>
                        <p class="ferramentas-capacidades-desc">Habilite ferramentas para que o agente possa executar ações reais além de apenas conversar.</p>
                    </div>

                    <div class="ferramentas-lista">
                        <!-- Ferramenta: Abrir Atendimento (mesmo bloco que Notificar Humano, só gatilho) -->
                        <div class="notify-card" data-ferramenta="abrir-atendimento" id="abrir-atendimento-card-el">
                            <div class="notify-header">
                                <div class="notify-header-inner">
                                    <div class="notify-header-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                        </svg>
                                    </div>
                                    <div class="notify-header-text">
                                        <h4 class="ferramenta-bloco-titulo">Abrir Atendimento</h4>
                                        <p class="ferramenta-bloco-desc">Transfere o status da conversa em Aberto e pausa o Agente de IA.</p>
                                    </div>
                                </div>
                                <div class="ferramenta-bloco-toggle">
                                    <label class="switch">
                                        <input type="checkbox" id="ferramentaAbrirAtendimentoSwitch" onchange="toggleAbrirAtendimentoExpand(this.checked)">
                                        <span class="slider-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div id="abrirAtendimentoExpand" class="notify-config hidden">
                                <div class="notify-field">
                                    <label class="notify-field-label">Quando Ativar (Gatilho)</label>
                                    <div class="notify-input-wrap">
                                        <span class="notify-input-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                        </span>
                                        <input type="text" id="abrirAtendimentoQuandoAtivar" class="notify-input" placeholder="Ex: Quando o cliente pedir para falar com um atendente ou quiser encerrar o chat">
                                    </div>
                                    <p class="notify-field-hint">Descreva quando deseja que a ferramenta seja ativa. Seja extremamente específico.</p>
                                </div>
                                <div class="notify-field">
                                    <label class="notify-field-label">Exemplos <span class="notify-label-tag notify-label-tag--success">Quando ativar</span></label>
                                    <div class="notify-textarea-wrap">
                                        <textarea id="abrirAtendimentoExemplos" class="notify-textarea" placeholder="Ex:&#10;Quero falar com um humano&#10;Preciso de atendente&#10;Pode me transferir?&#10;Encerrar conversa" rows="4"></textarea>
                                    </div>
                                    <p class="notify-field-hint">Uma frase por linha. Esses exemplos serão incluídos na instrução para o agente.</p>
                                </div>
                                <div class="notify-field">
                                    <label class="notify-field-label">Exemplos <span class="notify-label-tag notify-label-tag--danger">Quando não ativar</span></label>
                                    <div class="notify-textarea-wrap">
                                        <textarea id="abrirAtendimentoExemplosNaoAtivar" class="notify-textarea" placeholder="Ex:&#10;Só quero tirar uma dúvida simples&#10;Pode me explicar melhor antes?&#10;Ainda não quero falar com atendente" rows="3"></textarea>
                                    </div>
                                    <p class="notify-field-hint">Uma frase por linha. Esses exemplos ajudam o agente a evitar ativações indevidas.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Ferramenta: Notificar Humano (Expandida) -->
                        <div class="notify-card" data-ferramenta="notificar-humano" id="notify-card-el">
                            <!-- Cabeçalho da Ferramenta (Sempre visível) -->
                            <div class="notify-header">
                                <div class="notify-header-inner">
                                    <div class="notify-header-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                    </div>
                                    <div class="notify-header-text">
                                        <h4 class="ferramenta-bloco-titulo">Notificar Humano</h4>
                                        <p class="ferramenta-bloco-desc">Envia um alerta ou mensagem no WhatsApp ou e-mail para avisar.</p>
                                    </div>
                                </div>
                                <div class="ferramenta-bloco-toggle">
                                    <label class="switch">
                                        <input type="checkbox" id="toggle-notify-main" onchange="toggleNotifyConfig()">
                                        <span class="slider-switch"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Área de Configuração (Visível se Ativo) -->
                            <div id="notify-config" class="notify-config hidden">
                                <div id="notify-itens-list" class="notify-itens-list"></div>
                                <button type="button" class="btn-add-another" id="btn-add-notify" onclick="addNotifyItem()">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"></path></svg>
                                    Adicionar outra notificação
                                </button>
                            </div>
                        </div>

                        <!-- Ferramenta: Requisição HTTP (mesmo bloco que Notificar Humano, com campos HTTP + variáveis) -->
                        <div class="notify-card" data-ferramenta="requisicao-http" id="requisicao-http-card-el">
                            <div class="notify-header">
                                <div class="notify-header-inner">
                                    <div class="notify-header-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                    </div>
                                    <div class="notify-header-text">
                                        <h4 class="ferramenta-bloco-titulo">Requisição HTTP</h4>
                                        <p class="ferramenta-bloco-desc">Permite que o agente chame APIs externas (GET, POST, etc.) para integrar com outros sistemas.</p>
                                    </div>
                                </div>
                                <div class="ferramenta-bloco-toggle">
                                    <label class="switch">
                                        <input type="checkbox" id="ferramentaRequisicaoHttpSwitch" onchange="toggleRequisicaoHttpConfig()">
                                        <span class="slider-switch"></span>
                                    </label>
                                </div>
                            </div>
                            <div id="requisicaoHttpConfig" class="notify-config hidden">
                                <div id="requisicao-http-itens-list" class="http-itens-list"></div>
                                <button type="button" class="btn-add-another" id="btn-add-http" onclick="addHttpItem()">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"></path></svg>
                                    Adicionar outra requisição
                                </button>
                            </div>
                        </div>
                        <div id="http-curl-area-global" class="http-curl-popup hidden" aria-hidden="true">
                            <div class="http-curl-popup-backdrop" onclick="toggleHttpCurlArea(null)"></div>
                            <div class="http-curl-popup-card" role="dialog" aria-modal="true" aria-label="Importar requisição via cURL">
                                <h4 class="http-curl-popup-title">Importar via cURL</h4>
                                <textarea id="http-curl-input-global" class="notify-textarea http-curl-textarea" placeholder="Cole aqui o comando curl..." rows="6"></textarea>
                                <div class="http-curl-actions">
                                    <button type="button" class="http-curl-cancel" onclick="toggleHttpCurlArea(null)">Cancelar</button>
                                    <button type="button" class="http-curl-apply" onclick="aplicarCurlHttpFromGlobal()">Salvar</button>
                                </div>
                            </div>
                        </div>

                        <div class="ferramenta-bloco ferramenta-bloco-em-breve" data-ferramenta="agendamento">
                            <div class="ferramenta-bloco-icon-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <div class="ferramenta-bloco-body">
                                <div class="ferramenta-bloco-titulo-row">
                                    <h4 class="ferramenta-bloco-titulo">Agendamento</h4>
                                    <span class="ferramenta-em-breve">Em breve</span>
                                </div>
                                <p class="ferramenta-bloco-desc">Agende mensagens e ações para serem executadas em data e hora definidas.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

                    <!-- PASSO 6: CRM -->
                    <div class="wizard-step" id="wizard-step-6" data-step="6">
                <div class="criar-agente-section" style="grid-template-columns: 1fr; gap: 12px;">
                    <div class="form-group-modal">
                        <label for="crmQuadroSelect">Quadro CRM *</label>
                        <select id="crmQuadroSelect" onchange="carregarEtapasCRM()">
                            <option value="">Selecione um quadro</option>
                        </select>
                    </div>

                    <div class="form-group-modal">
                        <label for="crmEtapaSelect">Etapa *</label>
                        <select id="crmEtapaSelect" disabled>
                            <option value="">Selecione primeiro um quadro</option>
                        </select>
                    </div>

                    <div class="form-group-modal">
                        <label for="crmValorPadraoInput">Valor padrão no card</label>
                        <input type="text" id="crmValorPadraoInput" placeholder="R$ 0,00" oninput="formatarValorAgente(this)">
                    </div>

                    <div class="form-group-modal">
                        <label for="crmObservacaoPadraoInput">Observação padrão</label>
                        <textarea id="crmObservacaoPadraoInput" placeholder="Digite a observação padrão" rows="4"></textarea>
                    </div>

                    <div class="form-group-modal">
                        <label style="display: block; color: rgba(255, 255, 255, 0.9); font-size: 0.875rem; margin-bottom: 10px; font-weight: 500;">Tarefa padrão</label>
                        <div id="crmTarefasPadraoContainer" style="margin-bottom: 10px;"></div>
                        <button type="button" class="btn-add-tarefa" onclick="adicionarTarefaPadrao()" style="background: rgba(108, 99, 255, 0.1); border: 1px solid rgba(108, 99, 255, 0.3); border-radius: 6px; padding: 8px 12px; color: #6C63FF; font-size: 0.875rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle;">
                                <path d="M12 5v14M5 12h14"></path>
                            </svg>
                            Adicionar Tarefa
                        </button>
                    </div>
                    </div>
                </div>
            </div>

                <!-- Footer do Wizard -->
                <div class="wizard-footer">
                    <div>
                        <button type="button" class="btn-wizard-back" id="btnWizardBack" onclick="wizardPrev()" style="display: none;"><i class="fa-solid fa-arrow-left"></i> Voltar</button>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <button type="button" class="btn-wizard-skip" id="btnWizardSkip" onclick="wizardSkip()" style="display: none;">Pular Etapa</button>
                        <button type="button" class="btn-wizard-skip" id="btnWizardSkipFinish" onclick="wizardSkipAndFinish()" style="display: none;">Pular e Concluir</button>
                        <button type="button" class="btn-wizard-next" id="btnWizardNext" onclick="wizardNext()"><i class="fa-solid fa-arrow-right"></i> Próximo</button>
                        <button type="button" class="btn-wizard-finish" id="btnCriarAgente" onclick="criarAgente()" style="display: none;"><i class="fa-solid fa-check"></i> Finalizar Criação</button>
                    </div>
                </div>
                <!-- Footer do modo Editar (mostra em edit-mode) -->
                <div class="edit-footer" id="editFooter">
                    <button type="button" class="btn-edit-cancel" onclick="fecharModalCriarAgente()">Cancelar</button>
                    <button type="button" class="btn-edit-save" onclick="criarAgente()"><i class="fa-solid fa-check"></i> Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Criar Instruções com Ajuda -->
    <div class="criar-instrucoes-modal" id="criarInstrucoesModal">
        <div class="criar-instrucoes-modal-content">
            <div class="criar-instrucoes-modal-header">
                <h3>Criar Instruções</h3>
                <button class="criar-instrucoes-close-btn" onclick="fecharModalCriarInstrucoes()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            
            <!-- Indicador de Etapas -->
            <div class="etapa-indicador" id="etapaIndicador"></div>
            
            <!-- Conteúdo das Etapas -->
            <div class="etapa-conteudo" id="etapaConteudo">
                <!-- Conteúdo será preenchido dinamicamente -->
            </div>
            
            <!-- Animação de Carregamento -->
            <div class="loading-instrucoes" id="loadingInstrucoes">
                <div class="loading-spinner-inst"></div>
                <div class="loading-frases" id="loadingFrases">
                    <!-- Frases serão adicionadas dinamicamente -->
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Modal de Criar Instruções -->

    <!-- Modal Confirmar Exclusão Agente -->
    <div class="criar-quadro-modal" id="modalExcluirAgente">
        <div class="criar-quadro-modal-content" style="border: 2px solid #ff4444; background: rgba(255, 68, 68, 0.1);">
            <button class="modal-close-btn" onclick="fecharModalExcluirAgente()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <h3 style="color: #ff4444;">Tem certeza que deseja excluir este agente?</h3>
            <p style="color: #ccc; margin: 15px 0;" id="mensagemExcluirAgente">Ao clicar em confirmar, o agente <strong id="nomeAgenteExcluir"></strong> será excluído permanentemente. Esta ação não pode ser desfeita.</p>
            <div class="modal-footer">
                <button class="btn-modal-cancel" onclick="fecharModalExcluirAgente()" style="background: rgba(255, 255, 255, 0.25) !important; border: 2px solid rgba(255, 255, 255, 0.6) !important; color: white !important; font-weight: 600;">Cancelar</button>
                <button class="btn-modal-create" id="btnConfirmarExcluirAgente" onclick="confirmarExcluirAgente()" style="background: #ff4444; border-color: #ff4444;">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Exclusão Conhecimento -->
    <div class="criar-quadro-modal" id="modalExcluirConhecimento">
        <div class="criar-quadro-modal-content" style="border: 2px solid #ff4444; background: rgba(255, 68, 68, 0.1);">
            <button class="modal-close-btn" onclick="fecharModalExcluirConhecimento()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <h3 style="color: #ff4444;">Tem certeza que deseja excluir este conhecimento?</h3>
            <p style="color: #ccc; margin: 15px 0;" id="mensagemExcluirConhecimento">Ao clicar em confirmar, o conhecimento <strong id="nomeExcluirConhecimento"></strong> será excluído permanentemente. Esta ação não pode ser desfeita.</p>
            <div class="modal-footer">
                <button class="btn-modal-cancel" onclick="fecharModalExcluirConhecimento()" style="background: rgba(255, 255, 255, 0.25) !important; border: 2px solid rgba(255, 255, 255, 0.6) !important; color: white !important; font-weight: 600;">Cancelar</button>
                <button class="btn-modal-create" id="btnConfirmarExcluirConhecimento" onclick="confirmarExcluirConhecimento()" style="background: #ff4444; border-color: #ff4444;">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- Modal de Tela Cheia para Instruções -->
    <div class="fullscreen-instrucoes-modal" id="fullscreenInstrucoesModal">
        <div class="fullscreen-instrucoes-content">
            <div class="fullscreen-instrucoes-header">
                <h3>Instruções do Agente</h3>
                <button class="fullscreen-close-btn" onclick="fecharFullscreenInstrucoes()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    Fechar
                </button>
            </div>
            <div class="fullscreen-instrucoes-body">
                <div class="fullscreen-editor-panel">
                    <div class="markdown-toolbar">
                        <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacaoFullscreen('bold')" title="Negrito">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
                                <path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
                            </svg>
                            <span>Negrito</span>
                        </button>
                        <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacaoFullscreen('italic')" title="Itálico">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="19" y1="4" x2="10" y2="4"></line>
                                <line x1="14" y1="20" x2="5" y2="20"></line>
                                <line x1="15" y1="4" x2="9" y2="20"></line>
                            </svg>
                            <span>Itálico</span>
                        </button>
                        <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacaoFullscreen('formatBlock', false, 'h1')" title="Título 1">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 4v16M18 4v16M6 4h12"></path>
                            </svg>
                            <span>H1</span>
                        </button>
                        <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacaoFullscreen('formatBlock', false, 'h2')" title="Título 2">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 4v8M18 4v8M6 4h12M6 12h12"></path>
                            </svg>
                            <span>H2</span>
                        </button>
                        <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacaoFullscreen('formatBlock', false, 'h3')" title="Título 3">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 4v4M18 4v4M6 4h12M6 8h12M6 12v4M18 12v4M6 12h12"></path>
                            </svg>
                            <span>H3</span>
                        </button>
                        <button type="button" class="markdown-toolbar-btn" onclick="executarComandoFormatacaoFullscreen('insertUnorderedList')" title="Lista">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Lista</span>
                        </button>
                    </div>
                    <div id="fullscreenInstrucoesTextarea" class="rich-text-editor" contenteditable="true" placeholder="Digite as instruções para o agente..."></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Biblioteca Marked para converter Markdown para HTML -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script>
        // ===== VARIÁVEIS GLOBAIS =====
        let uploadedFiles = [];
        let connections = [];
        let perguntasRespostas = [];
        let agenteEditandoId = null; // ID do agente sendo editado
        let conexaoAntigaId = null; // ID da conexão antiga quando editando

        // ===== FUNÇÕES DE AUTENTICAÇÃO =====
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = `expires=${date.toUTCString()}`;
            document.cookie = `${name}=${value};${expires};path=/`;
        }

        // Função padrão para obter contaId e verificar status (padrão dashboard/hublabel/public/chat)
        // Flag global para indicar que o status está bloqueado (evita toasts)
        let statusBloqueado = false;
        let contaIdCache = null;
        let contaIdPromise = null;

        async function obterUserIdComStatus() {
            // Reutiliza o resultado em memória para evitar múltiplas consultas iguais no carregamento
            if (contaIdCache) return contaIdCache;
            // Deduplica chamadas concorrentes
            if (contaIdPromise) return contaIdPromise;

            contaIdPromise = (async () => {
            let contaId = null;
            
            // Primeiro tentar obter do Supabase Auth
            if (window.supabase) {
                try {
                    const { data: { user }, error: userError } = await window.supabase.auth.getUser();
                    if (!userError && user && user.id) {
                        
                        // Buscar o contaId e status na tabela SAAS_Usuarios usando auth_user_id
                        const { data: usuarioData, error: usuarioError } = await window.supabase
                            .from('SAAS_Usuarios')
                            .select('contaId, SAAS_Contas(status)')
                            .eq('auth_user_id', user.id)
                            .single();
                        
                        if (!usuarioError && usuarioData && usuarioData.contaId) {
                            const status = usuarioData?.SAAS_Contas?.status;
                            if (status === false) {
                                console.warn('⚠️ Usuário com status inativo. Redirecionando para acesso-bloqueado.');
                                // Redirecionar imediatamente (não aguardar)
                                logoutAndRedirectAcessoBloqueado();
                                // Lançar erro especial que será ignorado nos catch blocks
                                throw new Error('STATUS_BLOQUEADO');
                            }
                            contaId = usuarioData.contaId;
                            
                            // Salvar nos cookies para compatibilidade
                            setCookie('userId', contaId, 7);
                        } else {
                            console.warn('⚠️ Usuário não encontrado na tabela SAAS_Usuarios');
                        }
                    }
                } catch (error) {
                    // Se for erro de status bloqueado, re-lançar
                    if (error.message === 'STATUS_BLOQUEADO') {
                        throw error;
                    }
                    console.error('Erro ao obter usuário do Supabase:', error);
                }
            }
            
            // Fallback: tentar obter dos cookies (compatibilidade)
            if (!contaId) {
                const cookieUserId = getCookie('userId');
                if (cookieUserId && /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i.test(cookieUserId)) {
                    contaId = cookieUserId;
                }
            }
            
                if (contaId) {
                    contaIdCache = contaId;
                }

                return contaId;
            })();

            try {
                return await contaIdPromise;
            } finally {
                contaIdPromise = null;
            }
        }

        // Função legada para compatibilidade (mantida para não quebrar código existente)
        function getSecureUserId() {
            const contaId = getCookie('userId');
            if (contaId && /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i.test(contaId)) {
                console.log('✅ UserId (UUID) obtido dos cookies:', contaId);
                return contaId;
            }
            console.error('❌ UserId (UUID) não encontrado ou formato inválido nos cookies!');
            return null;
        }

        // Logout e redirecionar para página de acesso bloqueado (quando status do usuário é false)
        function logoutAndRedirectAcessoBloqueado() {
            // Marcar flag imediatamente para evitar toasts
            statusBloqueado = true;
            
            // Limpar dados imediatamente
            document.cookie = 'userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'idLista=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'idConexao=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'idDisparo=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            if (typeof clearMenuOcultarCache === 'function') clearMenuOcultarCache();
            sessionStorage.clear();
            localStorage.clear();
            
            // Redirecionar imediatamente (não aguardar signOut)
            window.location.replace('/hublabel/public/acesso-bloqueado');
            
            // Fazer signOut em background (não bloqueia o redirecionamento)
            if (window.supabase) {
                window.supabase.auth.signOut().catch(() => {
                    // Ignorar erros no signOut
                });
            }
        }

        async function carregarVersao() {
            const el = document.getElementById('versaoAtualTexto');
            if (!el || !window.supabase) return;
            try {
                const { data, error } = await window.supabase
                    .from('SAAS_Versao')
                    .select('versaoAtual')
                    .order('ultimaAtualizacao', { ascending: false })
                    .limit(1);
                if (!error && data && data[0] && data[0].versaoAtual) {
                    el.textContent = 'Versão atual: ' + data[0].versaoAtual;
                }
            } catch (e) {
                console.warn('Não foi possível carregar a versão:', e);
            }
        }

        async function checkAuth() {
            let contaId;
            try {
                contaId = await obterUserIdComStatus();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return null; // Já foi redirecionado
                }
                throw error;
            }
            if (!contaId) {
                window.location.href = '/hublabel/public/hublabel/public/hublabel/public/hublabel/public/login';
                return;
            }
            carregarVersao();
            verificarMostrarMenuAdmin();
            // Carregar agentes após autenticação
            await carregarAgentes();
            return contaId;
        }

        async function verificarMostrarMenuAdmin() {
            const el = document.getElementById('menu-item-admin');
            if (!el || !window.supabase) return;
            try {
                const { data: { user } } = await window.supabase.auth.getUser();
                if (!user) return;
                const { data } = await window.supabase.from('SAAS_Usuarios').select('super_admin').eq('auth_user_id', user.id).limit(1);
                if (data && data.length > 0 && data[0].super_admin === true) {
                    el.style.display = '';
                }
            } catch (e) { console.warn('Erro ao verificar super_admin:', e); }
        }

        // ===== FUNÇÕES DE CARREGAMENTO DE AGENTES =====
        // Variável global para armazenar estado de limite atingido
        window.limiteAtingido = false;

        async function carregarAgentes() {
            const loadingContainer = document.getElementById('loadingContainer');
            const agentesGrid = document.getElementById('agentesGrid');
            const emptyState = document.getElementById('emptyState');
            window.limiteAgentesAtingido = false;

            // Mostrar loading e ocultar outros elementos
            loadingContainer.style.display = 'flex';
            agentesGrid.style.display = 'none';
            emptyState.style.display = 'none';

            try {
                let contaId;
                try {
                    contaId = await obterUserIdComStatus();
                } catch (error) {
                    if (error.message === 'STATUS_BLOQUEADO') {
                        return; // Já foi redirecionado
                    }
                    throw error;
                }
                if (!contaId) {
                    if (loadingContainer) loadingContainer.style.setProperty('display', 'none', 'important');
                    return;
                }

                // Carregar conexões primeiro se ainda não foram carregadas
                if (connections.length === 0) {
                    await carregarConexoes();
                }

                const { data: agentesData, error: agentesError } = await window.supabase
                    .from('SAAS_AgentesIA')
                    .select('*')
                    .eq('contaId', contaId);

                if (loadingContainer) loadingContainer.style.setProperty('display', 'none', 'important');

                if (agentesError) {
                    window.agentesData = [];
                    renderizarAgentes([]);
                    return;
                }

                const agentes = Array.isArray(agentesData) ? agentesData : [];
                
                // Salvar agentes globalmente para uso no chat
                window.agentesData = agentes;
                
                // Verificar limite de agentes do plano (view vw_Contas_Com_Plano)
                let limiteAgentesAtingido = false;
                const { data: planoData } = await window.supabase
                    .from('vw_Contas_Com_Plano')
                    .select('"planoQntAgentes", total_agentes')
                    .eq('id', contaId)
                    .maybeSingle();
                if (planoData && planoData.planoQntAgentes != null && Number(planoData.planoQntAgentes) > 0) {
                    const total = Number(planoData.total_agentes) || 0;
                    const limite = Number(planoData.planoQntAgentes) || 0;
                    limiteAgentesAtingido = total >= limite;
                }
                window.limiteAgentesAtingido = limiteAgentesAtingido;
                
                renderizarAgentes(agentes);
                
                // Carregar créditos junto com os agentes
                await carregarCreditos();
            } catch (error) {
                // Não mostrar erro - apenas renderizar lista vazia
                window.agentesData = [];
                renderizarAgentes([]);
            } finally {
                if (loadingContainer) loadingContainer.style.setProperty('display', 'none', 'important');
            }
        }

        async function carregarCreditos() {
            try {
                const contaId = await obterUserIdComStatus();
                if (!contaId) {
                    return;
                }

                const { data: planoRow } = await window.supabase
                    .from('vw_Contas_Com_Plano')
                    .select('"planoQntCreditos", total_creditos')
                    .eq('id', contaId)
                    .maybeSingle();

                const creditosLiberados = planoRow && planoRow.planoQntCreditos != null ? Number(planoRow.planoQntCreditos) : 0;
                const creditosUsados = planoRow && planoRow.total_creditos != null ? Number(planoRow.total_creditos) : 0;
                const data = {
                    creditosUsados,
                    creditosLiberados,
                    LimiteAtingido: creditosLiberados > 0 && creditosUsados >= creditosLiberados
                };
                atualizarExibicaoCreditos(data);
            } catch (error) {
                console.warn('Erro ao carregar créditos:', error);
            }
        }

        function calcularDataProximoMes() {
            const hoje = new Date();
            const proximoMes = new Date(hoje.getFullYear(), hoje.getMonth() + 1, 1);
            const dia = String(proximoMes.getDate()).padStart(2, '0');
            const mes = String(proximoMes.getMonth() + 1).padStart(2, '0');
            const ano = proximoMes.getFullYear();
            return `${dia}/${mes}/${ano}`;
        }

        function atualizarExibicaoCreditos(data) {
            const creditosCard = document.getElementById('creditosCard');
            const creditosUsados = document.getElementById('creditosUsados');
            const creditosTotal = document.getElementById('creditosTotal');
            const limiteAtingidoAlerta = document.getElementById('limiteAtingidoAlerta');
            const dataProximoMes = document.getElementById('dataProximoMes');

            if (!creditosCard || !creditosUsados || !creditosTotal) {
                return;
            }

            // Extrair valores da resposta
            const creditosUsadosValor = data.creditosUsados || 0;
            const creditosTotalValor = data.creditosLiberados || 0;
            const limiteAtingido = data.LimiteAtingido === true || data.LimiteAtingido === 'true' || false;

            // Armazenar estado globalmente para usar na renderização dos cards
            window.limiteAtingido = limiteAtingido;

            // Atualizar valores
            creditosUsados.textContent = creditosUsadosValor;
            creditosTotal.textContent = creditosTotalValor;

            // Mostrar/esconder alerta de limite atingido
            if (limiteAtingidoAlerta) {
                if (limiteAtingido) {
                    // Atualizar data do próximo mês
                    if (dataProximoMes) {
                        dataProximoMes.textContent = calcularDataProximoMes();
                    }
                    limiteAtingidoAlerta.style.display = 'block';
                } else {
                    limiteAtingidoAlerta.style.display = 'none';
                }
            }

            // Mostrar a barra
            creditosCard.style.display = 'block';

            // Re-renderizar agentes para atualizar as tags
            if (window.agentesData && Array.isArray(window.agentesData)) {
                renderizarAgentes(window.agentesData);
            }
        }

        function navigateToPage(url) {
            window.location.href = url;
        }

        async function logout() {
            console.log('🚪 Iniciando logout...');
            
            try {
                // Fazer logout do Supabase Auth
                if (window.supabase) {
                    const { error } = await window.supabase.auth.signOut();
                    if (error) {
                        console.error('Erro ao fazer logout do Supabase:', error);
                    } else {
                        console.log('✅ Logout do Supabase realizado com sucesso');
                    }
                }
            } catch (error) {
                console.error('Erro ao fazer logout:', error);
            }
            
            // Limpar cookies
            document.cookie = 'userId=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;';
            
            // Limpar sessionStorage e localStorage
            sessionStorage.clear();
            localStorage.clear();
            
            // Redirecionar para página de login
            window.location.href = '/hublabel/public/hublabel/public/hublabel/public/hublabel/public/login';
        }

        // ===== FUNÇÕES DE TOAST =====
        function showToast(message, type = 'info') {
            if (typeof statusBloqueado !== 'undefined' && statusBloqueado) {
                return;
            }
            const toastContainer = document.getElementById('toastContainer');
            if (!toastContainer) return;
            const cleanMessage = String(message || '').replace(/^(\u2705|\u274C|\u2139\uFE0F?|\u26A0\uFE0F?)\s*/, '');
            const safeType = type === 'success' || type === 'error' ? type : 'info';
            const toast = document.createElement('div');
            toast.className = 'toast-notification ' + safeType;
            toast.setAttribute('role', safeType === 'error' ? 'alert' : 'status');
            toast.setAttribute('aria-live', safeType === 'error' ? 'assertive' : 'polite');
            const messageSpan = document.createElement('span');
            messageSpan.className = 'toast-message';
            messageSpan.textContent = cleanMessage;
            toast.appendChild(messageSpan);
            toastContainer.appendChild(toast);
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) toast.parentNode.removeChild(toast);
                }, 300);
            }, 5000);
        }

        // ===== FUNÇÕES DO MODAL =====
        function abrirModalCriarAgente(agenteData = null) {
            if (!agenteData && window.limiteAgentesAtingido) {
                showToast('Limite atingido. Verifique seu plano nas configurações', 'info');
                return;
            }
            const modal = document.getElementById('criarAgenteModal');
            const nomeInput = document.getElementById('nomeAgenteInput');
            const corInput = document.getElementById('corAgenteInput');
            const whatsappSelect = document.getElementById('whatsappSelect');
            const instrucoesEditor = document.getElementById('instrucoesAgenteInput');
            const criatividadeSlider = document.getElementById('criatividadeSlider');
            const modeloIASelect = document.getElementById('modeloIASelect');
            const modeloExplanation = document.getElementById('modeloExplanation');
            const btnCriar = document.getElementById('btnCriarAgente');
            
            // Variável para armazenar conexaoId que será preenchido após carregar conexões
            let conexaoIdParaPreencher = null;
            
            // Se está editando, preencher campos com dados do agente
            if (agenteData) {
                // Usar id ou idAgente, o que estiver disponível
                agenteEditandoId = agenteData.id || agenteData.idAgente;
                // Guardar dados das ferramentas para manter config ao desativar (ativo: false)
                window.agenteEmEdicaoFerramentas = {
                    abrirAtendimento: agenteData.abrirAtendimento || agenteData.abrir_atendimento,
                    notificarHumano: agenteData.notificarHumano || agenteData.notificar_humano,
                    requisicaoHTTP: agenteData.requisicaoHTTP || agenteData.requisicao_http
                };
                
                // Preencher campos básicos
                nomeInput.value = agenteData.nome || '';
                corInput.value = agenteData.cor || '#6C63FF';
                atualizarCorAgente(agenteData.cor || '#6C63FF');
                
                // Preencher instruções (pode vir em markdown ou HTML)
                if (agenteData.instrucoes) {
                    // Se já é HTML, usar diretamente, senão converter markdown para HTML
                    if (agenteData.instrucoes.includes('<')) {
                        // Processar links de arquivos mesmo em HTML
                        let html = processarLinksArquivosEmHTML(agenteData.instrucoes);
                        instrucoesEditor.innerHTML = html;
                        
                        // Garantir que os SVGs sejam renderizados corretamente
                        setTimeout(() => {
                            instrucoesEditor.querySelectorAll('.arquivo-tag').forEach(tag => {
                                const icon = tag.querySelector('.arquivo-tag-icon');
                                if (!icon || !icon.innerHTML.trim()) {
                                    // Se o ícone não foi renderizado, recriar a tag
                                    const arquivoId = tag.getAttribute('data-arquivo-id');
                                    const arquivo = instrucoesArquivosMultimidia.find(a => a.id === arquivoId);
                                    if (arquivo) {
                                        const novaTagHTML = criarTagArquivo(arquivo);
                                        const tempDiv = document.createElement('div');
                                        tempDiv.innerHTML = novaTagHTML;
                                        const novaTag = tempDiv.firstElementChild;
                                        tag.parentNode.replaceChild(novaTag, tag);
                                    }
                                }
                            });
                        }, 100);
                    } else {
                        // Converter markdown para HTML e processar links de arquivos
                        let html = markdownParaHTMLComTags(agenteData.instrucoes);
                        instrucoesEditor.innerHTML = html;
                        
                        // Garantir que os SVGs sejam renderizados corretamente
                        setTimeout(() => {
                            instrucoesEditor.querySelectorAll('.arquivo-tag').forEach(tag => {
                                const icon = tag.querySelector('.arquivo-tag-icon');
                                if (!icon || !icon.innerHTML.trim()) {
                                    // Se o ícone não foi renderizado, recriar a tag
                                    const arquivoId = tag.getAttribute('data-arquivo-id');
                                    const arquivo = instrucoesArquivosMultimidia.find(a => a.id === arquivoId);
                                    if (arquivo) {
                                        const novaTagHTML = criarTagArquivo(arquivo);
                                        const tempDiv = document.createElement('div');
                                        tempDiv.innerHTML = novaTagHTML;
                                        const novaTag = tempDiv.firstElementChild;
                                        tag.parentNode.replaceChild(novaTag, tag);
                                    }
                                }
                            });
                        }, 100);
                    }
                } else {
                    instrucoesEditor.innerHTML = '';
                }
                
                // Preencher modelo de IA
                if (agenteData.modelo) {
                    modeloIASelect.value = agenteData.modelo;
                    // Disparar evento change para atualizar explicação
                    modeloIASelect.dispatchEvent(new Event('change'));
                } else {
                    modeloIASelect.value = '';
                    modeloExplanation.classList.remove('show');
                    modeloExplanation.textContent = '';
                }
                
                // Preencher criatividade
                const criatividade = agenteData.criatividade !== undefined ? agenteData.criatividade : 0.7;
                criatividadeSlider.value = criatividade;
                document.getElementById('criatividadeValue').textContent = criatividade;
                
                // Armazenar conexaoId para preencher após carregar conexões
                conexaoIdParaPreencher = agenteData.conexaoId || null;
                // Armazenar conexão antiga para verificar mudanças
                conexaoAntigaId = agenteData.conexaoId || null;
                
                // Preencher switches - verificar múltiplos nomes possíveis dos campos
                const ouvirAudioSwitch = document.getElementById('ouvirAudioSwitch');
                const analisarImagensSwitch = document.getElementById('analisarImagensSwitch');
                const aparecerDigitandoSwitch = document.getElementById('aparecerDigitandoSwitch');
                
                // Mapear valores booleanos dos switches (pode vir como true/false, 1/0, ou string)
                const getBooleanValue = (value, defaultValue) => {
                    if (value === undefined || value === null) return defaultValue;
                    if (typeof value === 'boolean') return value;
                    if (typeof value === 'number') return value !== 0;
                    if (typeof value === 'string') return value.toLowerCase() === 'true' || value === '1';
                    return defaultValue;
                };
                
                if (ouvirAudioSwitch) {
                    const ouvirAudio = agenteData.ouvirAudio !== undefined ? agenteData.ouvirAudio : 
                                      (agenteData.ouvir_audio !== undefined ? agenteData.ouvir_audio : undefined);
                    ouvirAudioSwitch.checked = getBooleanValue(ouvirAudio, true);
                    console.log('ouvirAudio carregado:', ouvirAudioSwitch.checked);
                }
                
                if (analisarImagensSwitch) {
                    const analisarImagens = agenteData.analisarImagens !== undefined ? agenteData.analisarImagens : 
                                           (agenteData.analisar_imagens !== undefined ? agenteData.analisar_imagens : undefined);
                    analisarImagensSwitch.checked = getBooleanValue(analisarImagens, true);
                    console.log('analisarImagens carregado:', analisarImagensSwitch.checked);
                }
                
                if (aparecerDigitandoSwitch) {
                    const aparecerDigitando = agenteData.aparecerDigitando !== undefined ? agenteData.aparecerDigitando : 
                                             (agenteData.aparecer_digitando !== undefined ? agenteData.aparecer_digitando : undefined);
                    aparecerDigitandoSwitch.checked = getBooleanValue(aparecerDigitando, true);
                    console.log('aparecerDigitando carregado:', aparecerDigitandoSwitch.checked);
                }
                
                const pausarAgenteAtendimentoSwitch = document.getElementById('pausarAgenteAtendimentoSwitch');
                if (pausarAgenteAtendimentoSwitch) {
                    const pausarAtendimento = agenteData.pausarAtendimento !== undefined ? agenteData.pausarAtendimento : 
                                             (agenteData.pausar_atendimento !== undefined ? agenteData.pausar_atendimento : 
                                             (agenteData.pausarAgenteAtendimento !== undefined ? agenteData.pausarAgenteAtendimento : undefined));
                    pausarAgenteAtendimentoSwitch.checked = getBooleanValue(pausarAtendimento, false);
                    console.log('pausarAtendimento carregado:', pausarAgenteAtendimentoSwitch.checked);
                }
                
                // Carregar quantidade de mensagens de histórico
                const quantidadeMensagensHistoricoInput = document.getElementById('quantidadeMensagensHistoricoInput');
                if (quantidadeMensagensHistoricoInput) {
                    const quantidadeMensagensHistorico = agenteData.quantidadeMensagensHistorico !== undefined ? agenteData.quantidadeMensagensHistorico : 
                                                          (agenteData.quantidade_mensagens_historico !== undefined ? agenteData.quantidade_mensagens_historico : 20);
                    quantidadeMensagensHistoricoInput.value = quantidadeMensagensHistorico || 20;
                }
                
                // Carregar agrupar mensagens
                const agruparMensagensSwitch = document.getElementById('agruparMensagensSwitch');
                if (agruparMensagensSwitch) {
                    const agruparMensagens = agenteData.agruparMensagens !== undefined ? agenteData.agruparMensagens : 
                                            (agenteData.agrupar_mensagens !== undefined ? agenteData.agrupar_mensagens : false);
                    agruparMensagensSwitch.checked = getBooleanValue(agruparMensagens, false);
                    toggleIntervaloAgruparMensagens();
                }
                
                // Carregar intervalo de agrupar mensagens
                const intervaloAgruparMensagensInput = document.getElementById('intervaloAgruparMensagensInput');
                if (intervaloAgruparMensagensInput) {
                    const intervaloAgruparMensagens = agenteData.intervaloAgruparMensagens !== undefined ? agenteData.intervaloAgruparMensagens : 
                                                      (agenteData.intervalo_agrupar_mensagens !== undefined ? agenteData.intervalo_agrupar_mensagens : 10);
                    intervaloAgruparMensagensInput.value = intervaloAgruparMensagens || 10;
                }
                
                // Carregar conhecimentos se existirem
                uploadedFiles = [];
                perguntasRespostas = [];
                
                if (agenteData.conhecimento && Array.isArray(agenteData.conhecimento)) {
                    agenteData.conhecimento.forEach(item => {
                        if (item.tipo === 'arquivo') {
                            uploadedFiles.push({
                                name: item.nome,
                                size: item.tamanho || 0,
                                type: item.tipoArquivo || 'application/pdf',
                                idUnico: item.idUnico || null,
                                idDocumento: item.idDocumento || item.id || item.idConhecimento || item.idUnico || null, // ID do documento no servidor
                                jaExiste: true // Flag para indicar que já existe no servidor
                            });
                        }
                    });
                }
                
                renderUploadedFiles();
                
                // Carregar dados do CRM se existirem (suporta formato antigo 'crm' e novo 'CRM')
                const crmData = agenteData.CRM || agenteData.crm;
                if (crmData) {
                    const crmQuadroSelect = document.getElementById('crmQuadroSelect');
                    const crmEtapaSelect = document.getElementById('crmEtapaSelect');
                    const crmValorPadraoInput = document.getElementById('crmValorPadraoInput');
                    const crmObservacaoPadraoInput = document.getElementById('crmObservacaoPadraoInput');
                    const crmTarefasPadraoContainer = document.getElementById('crmTarefasPadraoContainer');
                    
                    // Suporta formato antigo (quadroId/etapaId) e novo (idCRM/idEtapa)
                    const crmQuadroId = crmData.idCRM || crmData.quadroId;
                    const crmEtapaId = crmData.idEtapa || crmData.etapaId;
                    
                    // Preencher valor padrão e observação (não dependem de carregamento)
                    if (crmValorPadraoInput && crmData.valorPadrao) {
                        const valorFormatado = formatarValor(String(Math.round(parseFloat(crmData.valorPadrao) * 100)));
                        crmValorPadraoInput.value = valorFormatado;
                    }
                    
                    if (crmObservacaoPadraoInput && crmData.observacaoPadrao) {
                        crmObservacaoPadraoInput.value = crmData.observacaoPadrao;
                    }
                    
                    // Carregar tarefas padrão
                    if (crmTarefasPadraoContainer) {
                        crmTarefasPadraoContainer.innerHTML = '';
                        const tarefas = crmData.tarefasPadrao || (crmData.tarefaPadrao ? [{ descricao: crmData.tarefaPadrao, data: null, concluida: false }] : []);
                        tarefas.forEach(tarefa => {
                            const tarefaDiv = document.createElement('div');
                            tarefaDiv.className = 'tarefa-item';
                            tarefaDiv.style.cssText = 'display: flex; gap: 8px; margin-bottom: 8px; align-items: center;';
                            tarefaDiv.innerHTML = `
                                <input type="text" placeholder="Descrição" class="tarefa-descricao" value="${tarefa.descricao || ''}" style="flex: 1; padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(255, 255, 255, 0.05); color: rgba(255, 255, 255, 0.9); font-size: 0.875rem;">
                                <input type="date" class="tarefa-data" value="${tarefa.data || ''}" style="padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(255, 255, 255, 0.05); color: rgba(255, 255, 255, 0.9); font-size: 0.875rem;">
                                <button type="button" class="btn-remove-tarefa" onclick="this.parentElement.remove()" style="background: rgba(255, 59, 48, 0.1); border: 1px solid rgba(255, 59, 48, 0.3); border-radius: 6px; padding: 8px; color: #ff3b30; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(255, 59, 48, 0.2)'" onmouseout="this.style.background='rgba(255, 59, 48, 0.1)'">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            `;
                            crmTarefasPadraoContainer.appendChild(tarefaDiv);
                        });
                    }
                    
                }

                // Carregar ferramentas: abrirAtendimento, notificarHumano, requisicaoHTTP
                const abrirAtendData = agenteData.abrirAtendimento || agenteData.abrir_atendimento;
                if (abrirAtendData && abrirAtendData.ativo) {
                    const sw = document.getElementById('ferramentaAbrirAtendimentoSwitch');
                    const inp = document.getElementById('abrirAtendimentoQuandoAtivar');
                    const exemplosInp = document.getElementById('abrirAtendimentoExemplos');
                    const exemplosNaoAtivarInp = document.getElementById('abrirAtendimentoExemplosNaoAtivar');
                    if (sw) sw.checked = true;
                    if (inp && abrirAtendData.quandoAtivar) inp.value = abrirAtendData.quandoAtivar;
                    const exemplosAtivar = abrirAtendData.exemplosAtivar || abrirAtendData.exemplos_ativar || abrirAtendData.exemplos;
                    const exemplosNaoAtivar = abrirAtendData.exemplosNaoAtivar || abrirAtendData.exemplos_nao_ativar;
                    if (exemplosInp && exemplosAtivar) {
                        exemplosInp.value = Array.isArray(exemplosAtivar) ? exemplosAtivar.join('\n') : (exemplosAtivar || '');
                    }
                    if (exemplosNaoAtivarInp && exemplosNaoAtivar) {
                        exemplosNaoAtivarInp.value = Array.isArray(exemplosNaoAtivar) ? exemplosNaoAtivar.join('\n') : (exemplosNaoAtivar || '');
                    }
                    toggleAbrirAtendimentoExpand(true);
                }

                const notifyData = agenteData.notificarHumano || agenteData.notificar_humano;
                if (notifyData && notifyData.ativo) {
                    const sw = document.getElementById('toggle-notify-main');
                    if (sw) sw.checked = true;
                    toggleNotifyConfig();
                    const list = document.getElementById('notify-itens-list');
                    if (list) list.innerHTML = '';
                    const itens = notifyData.itens && Array.isArray(notifyData.itens) ? notifyData.itens : (notifyData.quandoAtivar != null || notifyData.modeloMensagem ? [{
                        quandoAtivar: notifyData.quandoAtivar,
                        whatsappAtivo: notifyData.whatsappAtivo,
                        whatsapp: notifyData.whatsapp,
                        modeloMensagem: notifyData.modeloMensagem,
                        variaveis: notifyData.variaveis || []
                    }] : [{ quandoAtivar: '', whatsappAtivo: false, whatsapp: '', modeloMensagem: '', variaveis: [] }]);
                    initNotifyItens();
                    for (let i = 1; i < itens.length; i++) addNotifyItem();
                    itens.forEach((item, idx) => {
                        const quandoInp = document.getElementById('input-quando-ativar-' + idx);
                        if (quandoInp && item.quandoAtivar) quandoInp.value = item.quandoAtivar;
                        const checkWa = document.getElementById('check-whatsapp-' + idx);
                        const waInp = document.getElementById('input-whatsapp-' + idx);
                        if (checkWa && item.whatsappAtivo) checkWa.checked = true;
                        if (waInp && item.whatsapp) waInp.value = item.whatsapp;
                        toggleInput('whatsapp', idx);
                        const msgTa = document.getElementById('message-template-' + idx);
                        if (msgTa && item.modeloMensagem) msgTa.value = item.modeloMensagem;
                        const exemplosAtivarInp = document.getElementById('input-notify-exemplos-ativar-' + idx);
                        const exemplosAtivar = item.exemplosAtivar || item.exemplos_ativar || item.exemplos;
                        if (exemplosAtivarInp && exemplosAtivar) exemplosAtivarInp.value = Array.isArray(exemplosAtivar) ? exemplosAtivar.join('\n') : (exemplosAtivar || '');
                        const exemplosNaoAtivarInp = document.getElementById('input-notify-exemplos-nao-ativar-' + idx);
                        const exemplosNaoAtivar = item.exemplosNaoAtivar || item.exemplos_nao_ativar;
                        if (exemplosNaoAtivarInp && exemplosNaoAtivar) exemplosNaoAtivarInp.value = Array.isArray(exemplosNaoAtivar) ? exemplosNaoAtivar.join('\n') : (exemplosNaoAtivar || '');
                        if (item.variaveis && item.variaveis.length) {
                            setTimeout(() => {
                                parseVariables(idx);
                                item.variaveis.forEach(v => {
                                    const inp = document.querySelector('#variables-list-' + idx + ' input[data-var="' + v.nome + '"]');
                                    if (inp && v.descricao) inp.value = v.descricao;
                                });
                            }, 50 + idx * 30);
                        }
                    });
                }

                const reqHttpData = agenteData.requisicaoHTTP || agenteData.requisicao_http;
                if (reqHttpData && reqHttpData.ativo) {
                    const sw = document.getElementById('ferramentaRequisicaoHttpSwitch');
                    if (sw) sw.checked = true;
                    toggleRequisicaoHttpConfig();
                    const list = document.getElementById('requisicao-http-itens-list');
                    if (list) list.innerHTML = '';
                    const itens = reqHttpData.itens && Array.isArray(reqHttpData.itens) ? reqHttpData.itens : (reqHttpData.quandoAtivar != null || reqHttpData.curl ? [{
                        quandoAtivar: reqHttpData.quandoAtivar,
                        curl: reqHttpData.curl,
                        instrucao: reqHttpData.instrucao
                    }] : [{ quandoAtivar: null, curl: '', instrucao: '' }]);
                    initHttpItens();
                    for (let i = 1; i < itens.length; i++) addHttpItem();
                    itens.forEach((item, idx) => {
                        const quandoInp = document.getElementById('input-http-quando-ativar-' + idx);
                        if (quandoInp && item.quandoAtivar) quandoInp.value = item.quandoAtivar;
                        const httpExemplosAtivarInp = document.getElementById('input-http-exemplos-ativar-' + idx);
                        const httpExemplosAtivar = item.exemplosAtivar || item.exemplos_ativar || item.exemplos;
                        if (httpExemplosAtivarInp && httpExemplosAtivar) httpExemplosAtivarInp.value = Array.isArray(httpExemplosAtivar) ? httpExemplosAtivar.join('\n') : (httpExemplosAtivar || '');
                        const httpExemplosNaoAtivarInp = document.getElementById('input-http-exemplos-nao-ativar-' + idx);
                        const httpExemplosNaoAtivar = item.exemplosNaoAtivar || item.exemplos_nao_ativar;
                        if (httpExemplosNaoAtivarInp && httpExemplosNaoAtivar) httpExemplosNaoAtivarInp.value = Array.isArray(httpExemplosNaoAtivar) ? httpExemplosNaoAtivar.join('\n') : (httpExemplosNaoAtivar || '');
                        if (item.curl) {
                            window._httpCurlTargetIndex = idx;
                            const ta = document.getElementById('http-curl-input-global');
                            if (ta) ta.value = item.curl;
                            aplicarCurlHttpFromGlobal();
                        }
                        const variaveisSalvas = item.variaveis;
                        setTimeout(() => {
                            parseVariablesHttp(idx);
                            updateHttpItemTitle(idx);
                            if (variaveisSalvas && Array.isArray(variaveisSalvas) && variaveisSalvas.length > 0) {
                                variaveisSalvas.forEach(function(v) {
                                    var inp = document.querySelector('#http-variables-list-' + idx + ' input.notify-var-desc-input[data-var="' + v.nome + '"]');
                                    if (inp && v.descricao) inp.value = v.descricao;
                                });
                            }
                        }, 100 + idx * 30);
                    });
                }

                // Mudar texto do botão para "Salvar Agente"
                btnCriar.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Salvar Agente
                `;
            } else {
                // Modo criar - limpar campos
                agenteEditandoId = null;
                conexaoAntigaId = null;
                window.agenteEmEdicaoFerramentas = null;
                
                nomeInput.value = '';
                corInput.value = '#6C63FF';
                atualizarCorAgente('#6C63FF');
                instrucoesEditor.innerHTML = '';
                criatividadeSlider.value = '0.7';
                document.getElementById('criatividadeValue').textContent = '0.7';
                modeloIASelect.value = '';
                modeloExplanation.classList.remove('show');
                modeloExplanation.textContent = '';
                const modeloFerramentasAviso = document.getElementById('modeloFerramentasAviso');
                if (modeloFerramentasAviso) modeloFerramentasAviso.classList.add('hidden');
                whatsappSelect.value = '';
                uploadedFiles = [];
                perguntasRespostas = [];
                renderUploadedFiles();
                
                
                // Resetar switches para valores padrão
                document.getElementById('ouvirAudioSwitch').checked = true;
                document.getElementById('analisarImagensSwitch').checked = true;
                document.getElementById('aparecerDigitandoSwitch').checked = true;
                const pausarAgenteAtendimentoSwitch = document.getElementById('pausarAgenteAtendimentoSwitch');
                if (pausarAgenteAtendimentoSwitch) {
                    pausarAgenteAtendimentoSwitch.checked = false;
                }
                const quantidadeMensagensHistoricoInput = document.getElementById('quantidadeMensagensHistoricoInput');
                if (quantidadeMensagensHistoricoInput) {
                    quantidadeMensagensHistoricoInput.value = 20;
                }
                const agruparMensagensSwitch = document.getElementById('agruparMensagensSwitch');
                if (agruparMensagensSwitch) {
                    agruparMensagensSwitch.checked = false;
                    toggleIntervaloAgruparMensagens();
                }
                const intervaloAgruparMensagensInput = document.getElementById('intervaloAgruparMensagensInput');
                if (intervaloAgruparMensagensInput) {
                    intervaloAgruparMensagensInput.value = 10;
                }
                
                // Limpar campos CRM
                const crmQuadroSelect = document.getElementById('crmQuadroSelect');
                const crmEtapaSelect = document.getElementById('crmEtapaSelect');
                const crmValorPadraoInput = document.getElementById('crmValorPadraoInput');
                const crmObservacaoPadraoInput = document.getElementById('crmObservacaoPadraoInput');
                const crmTarefasPadraoContainer = document.getElementById('crmTarefasPadraoContainer');
                
                if (crmQuadroSelect) crmQuadroSelect.value = '';
                if (crmEtapaSelect) {
                    crmEtapaSelect.value = '';
                    crmEtapaSelect.disabled = true;
                    crmEtapaSelect.innerHTML = '<option value="">Selecione primeiro um quadro</option>';
                }
                if (crmValorPadraoInput) crmValorPadraoInput.value = '';
                if (crmObservacaoPadraoInput) crmObservacaoPadraoInput.value = '';
                if (crmTarefasPadraoContainer) crmTarefasPadraoContainer.innerHTML = '';

                // Resetar ferramentas (abrirAtendimento, notificarHumano, requisicaoHTTP)
                const ferramentaAbrirSw = document.getElementById('ferramentaAbrirAtendimentoSwitch');
                if (ferramentaAbrirSw) ferramentaAbrirSw.checked = false;
                const abrirQuandoInp = document.getElementById('abrirAtendimentoQuandoAtivar');
                if (abrirQuandoInp) abrirQuandoInp.value = '';
                const abrirExemplosInp = document.getElementById('abrirAtendimentoExemplos');
                if (abrirExemplosInp) abrirExemplosInp.value = '';
                toggleAbrirAtendimentoExpand(false);
                const toggleNotifySw = document.getElementById('toggle-notify-main');
                if (toggleNotifySw) toggleNotifySw.checked = false;
                const notifyItensList = document.getElementById('notify-itens-list');
                if (notifyItensList) notifyItensList.innerHTML = '';
                toggleNotifyConfig();
                const reqHttpSw = document.getElementById('ferramentaRequisicaoHttpSwitch');
                if (reqHttpSw) reqHttpSw.checked = false;
                toggleRequisicaoHttpConfig();
                const requisicaoHttpItensList = document.getElementById('requisicao-http-itens-list');
                if (requisicaoHttpItensList) requisicaoHttpItensList.innerHTML = '';
                const httpCurlArea = document.getElementById('http-curl-area-global');
                if (httpCurlArea) httpCurlArea.classList.add('hidden');
                const httpCurlInput = document.getElementById('http-curl-input-global');
                if (httpCurlInput) httpCurlInput.value = '';
                parseVariablesHttp();

                // Mudar texto do botão para "Criar Agente"
                if (btnCriar) btnCriar.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Criar Agente
                `;
            }
            
            const modalContent = document.getElementById('criarAgenteModalContent');
            if (agenteData) {
                // Modo Edição: sidebar igual criar, sem números, clique livre
                if (modalContent) modalContent.classList.add('edit-mode');
                const editTitle = document.getElementById('editHeaderTitle');
                if (editTitle) editTitle.textContent = 'Editar Agente: ' + (agenteData.nome || 'Agente');
                const sidebarTitle = document.getElementById('wizardSidebarTitle');
                const sidebarSubtitle = document.getElementById('wizardSidebarSubtitle');
                if (sidebarTitle) sidebarTitle.textContent = 'Editar Agente';
                if (sidebarSubtitle) sidebarSubtitle.textContent = 'Navegue entre as seções';
                switchEditTab(1);
            } else {
                // Modo Criação: wizard em etapas
                if (modalContent) modalContent.classList.remove('edit-mode');
                const sidebarTitle = document.getElementById('wizardSidebarTitle');
                const sidebarSubtitle = document.getElementById('wizardSidebarSubtitle');
                if (sidebarTitle) sidebarTitle.textContent = 'Criar Agente';
                if (sidebarSubtitle) sidebarSubtitle.textContent = 'Siga os passos para configurar';
                wizardGoToStep(1);
            }
            
            // Carregar conexões e depois preencher WhatsApp se estiver editando
            if (agenteData && conexaoIdParaPreencher) {
                carregarConexoes().then(() => {
                    // Aguardar um pouco para garantir que o select foi populado
                    setTimeout(() => {
                        preencherWhatsAppSelect(conexaoIdParaPreencher);
                    }, 100);
                });
            } else {
                carregarConexoes();
            }
            
            // Carregar quadros CRM e depois preencher dados do CRM se estiver editando
            carregarQuadrosCRM().then(() => {
                // Aguardar um pouco para garantir que o DOM foi atualizado
                setTimeout(() => {
                    if (agenteData && (agenteData.CRM || agenteData.crm)) {
                        const crmData = agenteData.CRM || agenteData.crm;
                        const crmQuadroSelect = document.getElementById('crmQuadroSelect');
                        const crmEtapaSelect = document.getElementById('crmEtapaSelect');
                        
                        console.log('📋 Dados CRM encontrados:', crmData);
                        console.log('📋 Quadro Select:', crmQuadroSelect);
                        console.log('📋 Etapa Select:', crmEtapaSelect);
                        
                        if (crmData && crmQuadroSelect) {
                            const crmQuadroId = crmData.idCRM || crmData.quadroId;
                            const crmEtapaId = crmData.idEtapa || crmData.etapaId;
                            
                            console.log('🔍 Tentando preencher CRM - Quadro ID:', crmQuadroId, 'Etapa ID:', crmEtapaId);
                            console.log('🔍 Opções disponíveis no select:', Array.from(crmQuadroSelect.options).map(opt => ({ value: opt.value, text: opt.text })));
                            
                            if (crmQuadroId) {
                                // Verificar se o valor existe nas opções (comparar como string)
                                const quadroExiste = Array.from(crmQuadroSelect.options).some(opt => String(opt.value) === String(crmQuadroId));
                                console.log('🔍 Quadro existe nas opções?', quadroExiste);
                                
                                if (quadroExiste) {
                                    crmQuadroSelect.value = String(crmQuadroId);
                                    console.log('✅ Quadro selecionado:', crmQuadroId);
                                    
                                    // Disparar evento change para garantir que o handler seja executado
                                    const changeEvent = new Event('change', { bubbles: true });
                                    crmQuadroSelect.dispatchEvent(changeEvent);
                                    
                                    // Carregar etapas após selecionar o quadro
                                    if (crmEtapaId) {
                                        // Aguardar um pouco para garantir que o evento change processou
                                        setTimeout(() => {
                                            console.log('🔄 Carregando etapas para quadro:', crmQuadroId);
                                            carregarEtapasCRM().then(() => {
                                                setTimeout(() => {
                                                    if (crmEtapaSelect) {
                                                        console.log('🔍 Opções de etapa disponíveis:', Array.from(crmEtapaSelect.options).map(opt => ({ value: opt.value, text: opt.text })));
                                                        const etapaExiste = Array.from(crmEtapaSelect.options).some(opt => String(opt.value) === String(crmEtapaId));
                                                        console.log('🔍 Etapa existe nas opções?', etapaExiste, 'Valor buscado:', crmEtapaId);
                                                        
                                                        if (etapaExiste) {
                                                            crmEtapaSelect.value = String(crmEtapaId);
                                                            console.log('✅ Etapa selecionada:', crmEtapaId);
                                                        } else {
                                                            console.warn('❌ Etapa não encontrada. Valor:', crmEtapaId, 'Opções:', Array.from(crmEtapaSelect.options).map(opt => ({ value: opt.value, text: opt.text })));
                                                        }
                                                    }
                                                }, 500);
                                            }).catch(error => {
                                                console.error('Erro ao carregar etapas:', error);
                                            });
                                        }, 200);
                                    }
                                } else {
                                    console.warn('❌ Quadro não encontrado. Valor buscado:', crmQuadroId, 'Opções disponíveis:', Array.from(crmQuadroSelect.options).map(opt => ({ value: opt.value, text: opt.text })));
                                }
                            }
                        }
                    }
                }, 100);
            }).catch(error => {
                console.error('Erro ao carregar quadros:', error);
            });
            
            // Inicializar lista de arquivos multimídia das instruções
            instrucoesArquivosMultimidia = [];
            renderInstrucoesArquivosList();
            
            modal.classList.add('show');
            
        }
        
        // Função auxiliar para preencher o select de WhatsApp após carregar conexões
        function preencherWhatsAppSelect(conexaoId) {
            const whatsappSelect = document.getElementById('whatsappSelect');
            if (!whatsappSelect || !conexaoId) return;
            
            // Tentar encontrar o option pelo valor exato
            let encontrado = false;
            for (let option of whatsappSelect.options) {
                if (option.value == conexaoId) {
                    whatsappSelect.value = conexaoId;
                    encontrado = true;
                    console.log('WhatsApp selecionado:', conexaoId);
                    break;
                }
            }
            
            // Se não encontrou pelo valor exato, tentar encontrar pela comparação com os IDs das conexões
            if (!encontrado && typeof connections !== 'undefined' && Array.isArray(connections)) {
                const conexao = connections.find(conn => {
                    const connId = conn.id || conn.Id || conn.ID || conn.instanceName || conn.instance_name;
                    return connId && connId == conexaoId;
                });
                
                if (conexao) {
                    const conexaoIdEncontrado = conexao.id || conexao.Id || conexao.ID || conexao.instanceName || conexao.instance_name;
                    whatsappSelect.value = conexaoIdEncontrado;
                    console.log('WhatsApp selecionado (por busca):', conexaoIdEncontrado);
                } else {
                    console.warn('Conexão não encontrada para conexaoId:', conexaoId);
                }
            }
        }

        // (Avisos de crédito removidos de ouvir áudio e analisar imagens)

        function toggleIntervaloAgruparMensagens() {
            const switchElement = document.getElementById('agruparMensagensSwitch');
            const containerElement = document.getElementById('intervaloAgruparMensagensContainer');
            if (switchElement && containerElement) {
                if (switchElement.checked) {
                    containerElement.style.display = 'block';
                } else {
                    containerElement.style.display = 'none';
                }
            }
        }

        function toggleOpcoesAgente() {
            const wrapper = document.querySelector('.opcoes-agente-wrapper');
            const section = document.querySelector('.opcoes-agente-section');
            
            if (wrapper && section) {
                const isOpen = wrapper.classList.contains('open');
                
                if (isOpen) {
                    wrapper.classList.remove('open');
                    section.classList.remove('open');
                } else {
                    wrapper.classList.add('open');
                    section.classList.add('open');
                }
            }
        }

        function fecharModalCriarAgente() {
            const modal = document.getElementById('criarAgenteModal');
            const modalContent = document.getElementById('criarAgenteModalContent');
            if (modal) modal.classList.remove('show');
            if (modalContent) modalContent.classList.remove('edit-mode');
            window.agenteEmEdicaoFerramentas = null;
            // Limpar ID de edição ao fechar
            agenteEditandoId = null;
            conexaoAntigaId = null;
            // Limpar arquivos multimídia das instruções
            instrucoesArquivosMultimidia = [];
            renderInstrucoesArquivosList();
        }

        // ===== WIZARD (CRIAÇÃO EM ETAPAS) =====
        let wizardStep = 1;
        const WIZARD_MAX_STEPS = 6;

        const WIZARD_TITLES = {
            1: 'Identidade do Agente',
            2: 'Comportamento e Instruções',
            3: 'Base de Conhecimento',
            4: 'Configurações do Modelo',
            5: 'Ferramentas Avançadas',
            6: 'Integração com CRM'
        };

        function showWizardStep(step) {
            document.querySelectorAll('.wizard-step').forEach(el => {
                el.classList.toggle('active', parseInt(el.dataset.step) === step);
            });
            document.querySelectorAll('.wizard-step-item').forEach(el => {
                const s = parseInt(el.dataset.step, 10);
                el.classList.remove('active', 'done', 'pending');
                if (s < step) el.classList.add('done');
                else if (s === step) el.classList.add('active');
                else el.classList.add('pending');
            });
        }

        function updateWizardHeader(step) {
            const headerStep = document.getElementById('wizardHeaderStep');
            const headerTitle = document.getElementById('wizardHeaderTitle');
            if (headerStep) headerStep.textContent = 'PASSO ' + step + ' DE ' + WIZARD_MAX_STEPS;
            if (headerTitle) headerTitle.textContent = WIZARD_TITLES[step] || '';
        }

        function updateWizardFooter(step) {
            const btnBack = document.getElementById('btnWizardBack');
            const btnSkip = document.getElementById('btnWizardSkip');
            const btnSkipFinish = document.getElementById('btnWizardSkipFinish');
            const btnNext = document.getElementById('btnWizardNext');
            const btnFinish = document.getElementById('btnCriarAgente');
            if (btnBack) btnBack.style.display = step > 1 ? 'flex' : 'none';
            if (btnSkip) btnSkip.style.display = [3, 5].includes(step) ? 'inline-flex' : 'none';
            if (btnSkipFinish) btnSkipFinish.style.display = step === 6 ? 'inline-flex' : 'none';
            if (btnNext) btnNext.style.display = step < WIZARD_MAX_STEPS ? 'flex' : 'none';
            if (btnFinish) btnFinish.style.display = step === WIZARD_MAX_STEPS ? 'flex' : 'none';
        }

        function wizardGoToStep(step) {
            wizardStep = Math.max(1, Math.min(WIZARD_MAX_STEPS, step));
            showWizardStep(wizardStep);
            updateWizardHeader(wizardStep);
            updateWizardFooter(wizardStep);
        }

        function wizardNext() {
            if (wizardStep < WIZARD_MAX_STEPS) wizardGoToStep(wizardStep + 1);
        }

        function wizardPrev() {
            if (wizardStep > 1) wizardGoToStep(wizardStep - 1);
        }

        function wizardSkip() {
            if ([3, 5].includes(wizardStep)) wizardNext();
        }

        function wizardSkipAndFinish() {
            if (wizardStep === 6) criarAgente();
        }

        // ===== MODO EDIÇÃO (ABAS) =====
        let editTabAtivo = 1;

        function switchEditTab(tabNum) {
            editTabAtivo = tabNum;
            document.querySelectorAll('.edit-tab-btn').forEach(btn => {
                btn.classList.toggle('active', parseInt(btn.dataset.editTab) === tabNum);
            });
            document.querySelectorAll('.wizard-step').forEach(step => {
                step.classList.toggle('active', parseInt(step.dataset.step) === tabNum);
            });
            document.querySelectorAll('.wizard-step-item').forEach(el => {
                const s = parseInt(el.dataset.step, 10);
                el.classList.remove('active', 'done', 'pending');
                el.classList.add(s === tabNum ? 'active' : 'pending');
            });
        }

        function editModeGoToStep(stepNum) {
            const modalContent = document.getElementById('criarAgenteModalContent');
            if (modalContent && modalContent.classList.contains('edit-mode')) {
                switchEditTab(stepNum);
            }
        }

        function toggleAbrirAtendimentoExpand(ativa) {
            const expand = document.getElementById('abrirAtendimentoExpand');
            const chk = document.getElementById('ferramentaAbrirAtendimentoSwitch');
            const card = chk && chk.closest('.notify-card');
            if (expand) expand.classList.toggle('hidden', !ativa);
            if (card) card.classList.toggle('notify-card--ativo', !!ativa);
        }

        function toggleNotifyConfig() {
            const chk = document.getElementById('toggle-notify-main');
            const config = document.getElementById('notify-config');
            const card = chk && chk.closest('.notify-card');
            if (chk && config) config.classList.toggle('hidden', !chk.checked);
            if (card) card.classList.toggle('notify-card--ativo', !!chk && chk.checked);
            if (chk && chk.checked) initNotifyItens();
        }

        function getNotifyItemHtml(idx) {
            return `
                <div class="notify-item-header" onclick="toggleNotifyItemExpand(${idx})">
                    <span class="item-title">Notificação ${idx + 1}</span>
                    <div style="display:flex;align-items:center;">
                        ${idx > 0 ? `<button type="button" class="item-remove" onclick="event.stopPropagation();removeNotifyItem(${idx})">Remover</button>` : ''}
                        <svg class="item-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>
                <div class="notify-item-body" id="notify-item-body-${idx}">
                    <div class="notify-field">
                        <label class="notify-field-label">Quando Ativar (Gatilho)</label>
                        <div class="notify-input-wrap">
                            <span class="notify-input-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg></span>
                            <input type="text" id="input-quando-ativar-${idx}" class="notify-input" placeholder="Ex: Quando o cliente pedir atendimento, falar com humano">
                        </div>
                        <p class="notify-field-hint">Descreva quando deseja que a ferramenta seja ativa. Seja extremamente específico.</p>
                    </div>
                    <div class="notify-field">
                        <label class="notify-field-label">Exemplos <span class="notify-label-tag notify-label-tag--success">Quando ativar</span></label>
                        <div class="notify-textarea-wrap">
                            <textarea id="input-notify-exemplos-ativar-${idx}" class="notify-textarea" placeholder="Ex:&#10;Quero falar com um humano&#10;Preciso de atendente" rows="3"></textarea>
                        </div>
                        <p class="notify-field-hint">Uma frase por linha. Serão incluídos na instrução logo abaixo do gatilho.</p>
                    </div>
                    <div class="notify-field">
                        <label class="notify-field-label">Exemplos <span class="notify-label-tag notify-label-tag--danger">Quando não ativar</span></label>
                        <div class="notify-textarea-wrap">
                            <textarea id="input-notify-exemplos-nao-ativar-${idx}" class="notify-textarea" placeholder="Ex:&#10;Estou só explorando opções&#10;Ainda não preciso de ajuda humana" rows="3"></textarea>
                        </div>
                        <p class="notify-field-hint">Uma frase por linha. Use para evitar falso positivo de acionamento.</p>
                    </div>
                    <div class="notify-canais-grid">
                        <div class="notify-canal-card">
                            <div class="notify-canal-header">
                                <span class="notify-canal-name"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> WhatsApp</span>
                                <label class="notify-canal-toggle">
                                    <input type="checkbox" id="check-whatsapp-${idx}" onchange="toggleInput('whatsapp', ${idx})" class="sr-only">
                                    <span class="notify-canal-slider"></span>
                                </label>
                            </div>
                            <input type="text" id="input-whatsapp-${idx}" disabled class="notify-canal-input" placeholder="Ex: 5548991034326">
                        </div>
                        <div class="notify-canal-card notify-canal-card-em-breve">
                            <div class="notify-canal-header">
                                <span class="notify-canal-name notify-canal-email"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Email</span>
                                <span class="ferramenta-em-breve">Em breve</span>
                            </div>
                            <input type="email" disabled class="notify-canal-input notify-canal-input-email" placeholder="seu@email.com" aria-hidden="true" tabindex="-1">
                        </div>
                    </div>
                    <div class="notify-mensagem-box">
                        <div class="notify-field">
                            <label class="notify-field-label">Modelo de Mensagem</label>
                            <div class="notify-textarea-wrap">
                                <textarea id="message-template-${idx}" oninput="parseVariables(${idx})" class="notify-textarea" placeholder="Lead precisando de ajuda. *Nome*: [nome] *telefone*: [telefone]" rows="4"></textarea>
                                <span class="notify-var-badge">Use [colchetes] para variáveis</span>
                            </div>
                        </div>
                        <div id="variables-area-${idx}" class="notify-var-area hidden">
                            <h5 class="notify-var-area-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"></path></svg> Variáveis Detectadas para Coleta</h5>
                            <p class="notify-field-hint" style="margin-top: 4px; margin-bottom: 10px;">Coloque no campo a explicação do que significa a variável. Exemplo: [nome] → nome do lead</p>
                            <div id="variables-list-${idx}" class="notify-var-list"></div>
                        </div>
                    </div>
                </div>
            `;
        }

        function initNotifyItens() {
            const list = document.getElementById('notify-itens-list');
            if (!list || list.querySelectorAll('.notify-item').length > 0) return;
            const wrap = document.createElement('div');
            wrap.className = 'notify-item expanded';
            wrap.setAttribute('data-index', '0');
            wrap.innerHTML = getNotifyItemHtml(0);
            list.appendChild(wrap);
        }

        function addNotifyItem() {
            const list = document.getElementById('notify-itens-list');
            if (!list) return;
            const items = list.querySelectorAll('.notify-item');
            const idx = items.length;
            const wrap = document.createElement('div');
            wrap.className = 'notify-item expanded';
            wrap.setAttribute('data-index', String(idx));
            wrap.innerHTML = getNotifyItemHtml(idx);
            list.appendChild(wrap);
            reindexNotifyItems();
        }

        function removeNotifyItem(idx) {
            const list = document.getElementById('notify-itens-list');
            const item = list && list.querySelector('.notify-item[data-index="' + idx + '"]');
            if (!item || idx === 0) return;
            item.remove();
            reindexNotifyItems();
        }

        function reindexNotifyItems() {
            const list = document.getElementById('notify-itens-list');
            if (!list) return;
            list.querySelectorAll('.notify-item').forEach((el, i) => {
                el.setAttribute('data-index', String(i));
                const header = el.querySelector('.notify-item-header');
                const title = header && header.querySelector('.item-title');
                if (title) title.textContent = 'Notificação ' + (i + 1);
                const removeBtn = el.querySelector('.item-remove');
                if (removeBtn) {
                    removeBtn.onclick = function(ev) { ev.stopPropagation(); removeNotifyItem(i); };
                    removeBtn.style.display = i > 0 ? '' : 'none';
                }
                el.querySelectorAll('[id]').forEach(n => {
                    if (n.id && /-\d+$/.test(n.id)) n.id = n.id.replace(/-\d+$/, '-' + i);
                });
                const checkWa = el.querySelector('[id^="check-whatsapp-"]');
                if (checkWa) checkWa.onchange = function() { toggleInput('whatsapp', i); };
                const msg = el.querySelector('[id^="message-template-"]');
                if (msg) msg.oninput = function() { parseVariables(i); };
                if (header) header.onclick = function() { toggleNotifyItemExpand(i); };
            });
        }

        function toggleNotifyItemExpand(idx) {
            const list = document.getElementById('notify-itens-list');
            const item = list && list.querySelector('.notify-item[data-index="' + idx + '"]');
            if (!item) return;
            const body = item.querySelector('.notify-item-body');
            if (body) body.classList.toggle('hidden');
            item.classList.toggle('expanded', !body || !body.classList.contains('hidden'));
        }

        function toggleRequisicaoHttpConfig() {
            const chk = document.getElementById('ferramentaRequisicaoHttpSwitch');
            const config = document.getElementById('requisicaoHttpConfig');
            const card = chk && chk.closest('.notify-card');
            if (chk && config) config.classList.toggle('hidden', !chk.checked);
            if (card) card.classList.toggle('notify-card--ativo', !!chk && chk.checked);
            if (chk && chk.checked) initHttpItens();
        }

        function getHttpItemHtml(idx) {
            return `
                <div class="http-item-header" onclick="toggleHttpItemExpand(${idx})">
                    <span class="item-title">Requisição ${idx + 1}</span>
                    <div style="display:flex;align-items:center;">
                        ${idx > 0 ? `<button type="button" class="item-remove" onclick="event.stopPropagation();removeHttpItem(${idx})">Remover</button>` : ''}
                        <svg class="item-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>
                <div class="http-item-body" id="http-item-body-${idx}">
                    <div class="notify-field">
                        <label class="notify-field-label">Quando Ativar (Gatilho)</label>
                        <div class="notify-input-wrap">
                            <span class="notify-input-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg></span>
                            <input type="text" id="input-http-quando-ativar-${idx}" class="notify-input" placeholder="Ex: Quando o cliente pedir cotação">
                        </div>
                        <p class="notify-field-hint">Descreva quando deseja que a ferramenta seja ativa.</p>
                    </div>
                    <div class="notify-field">
                        <label class="notify-field-label">Exemplos <span class="notify-label-tag notify-label-tag--success">Quando ativar</span></label>
                        <div class="notify-textarea-wrap">
                            <textarea id="input-http-exemplos-ativar-${idx}" class="notify-textarea" placeholder="Ex:&#10;Quero cotação&#10;Consultar estoque" rows="3"></textarea>
                        </div>
                        <p class="notify-field-hint">Uma frase por linha. Serão incluídos na instrução logo abaixo do gatilho.</p>
                    </div>
                    <div class="notify-field">
                        <label class="notify-field-label">Exemplos <span class="notify-label-tag notify-label-tag--danger">Quando não ativar</span></label>
                        <div class="notify-textarea-wrap">
                            <textarea id="input-http-exemplos-nao-ativar-${idx}" class="notify-textarea" placeholder="Ex:&#10;Só quero uma explicação geral&#10;Não preciso consultar API agora" rows="3"></textarea>
                        </div>
                        <p class="notify-field-hint">Uma frase por linha. Use para impedir chamadas HTTP desnecessárias.</p>
                    </div>
                    <div class="notify-field">
                        <div class="http-curl-row">
                            <label class="notify-field-label">Importar via cURL</label>
                            <button type="button" class="http-curl-toggle" onclick="toggleHttpCurlArea(${idx})">Importar via cURL</button>
                        </div>
                    </div>
                    <div class="notify-field">
                        <label class="notify-field-label">Método HTTP</label>
                        <select id="select-http-method-${idx}" class="notify-input">
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="PUT">PUT</option>
                            <option value="PATCH">PATCH</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                    </div>
                    <div class="notify-field">
                        <label class="notify-field-label">URL</label>
                        <div class="notify-input-wrap">
                            <span class="notify-input-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></span>
                            <input type="text" id="input-http-url-${idx}" class="notify-input" placeholder="https://api.exemplo.com/endpoint" oninput="parseVariablesHttp(${idx}); updateHttpItemTitle(${idx})">
                        </div>
                        <p class="notify-field-hint">Use [variável] na URL para valores dinâmicos.</p>
                    </div>
                    <div class="notify-field">
                        <div class="http-section-toggle">
                            <label class="notify-field-label">Enviar parâmetro query</label>
                            <label class="switch">
                                <input type="checkbox" id="toggle-http-query-${idx}" onchange="toggleHttpSection('query', ${idx})">
                                <span class="slider-switch"></span>
                            </label>
                        </div>
                        <div id="http-query-container-${idx}" class="http-params-box hidden">
                            <div id="http-query-list-${idx}"></div>
                            <hr class="http-params-sep">
                            <button type="button" class="http-param-add" onclick="addHttpParamRow('query', ${idx})"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"></path></svg> Adicionar parâmetro</button>
                        </div>
                    </div>
                    <div class="notify-field">
                        <div class="http-section-toggle">
                            <label class="notify-field-label">Enviar Cabeçalho</label>
                            <label class="switch">
                                <input type="checkbox" id="toggle-http-headers-${idx}" onchange="toggleHttpSection('headers', ${idx})">
                                <span class="slider-switch"></span>
                            </label>
                        </div>
                        <div id="http-headers-container-${idx}" class="http-params-box hidden">
                            <div id="http-headers-list-${idx}"></div>
                            <hr class="http-params-sep">
                            <button type="button" class="http-param-add" onclick="addHttpParamRow('headers', ${idx})"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"></path></svg> Adicionar parâmetro</button>
                        </div>
                    </div>
                    <div class="notify-field">
                        <div class="http-section-toggle">
                            <label class="notify-field-label">Enviar Body</label>
                            <label class="switch">
                                <input type="checkbox" id="toggle-http-body-${idx}" onchange="toggleHttpSection('body', ${idx})">
                                <span class="slider-switch"></span>
                            </label>
                        </div>
                        <div id="http-body-container-${idx}" class="http-body-box hidden">
                            <div class="notify-textarea-wrap http-body-textarea-wrap">
                                <textarea id="textarea-http-body-${idx}" class="notify-textarea" oninput="validateHttpBodyJson(${idx}); parseVariablesHttp(${idx});" placeholder='{"nome": "[nome]"}' rows="6"></textarea>
                                <span class="notify-var-badge">Use [colchetes] para variáveis.</span>
                            </div>
                            <p id="http-body-json-error-${idx}" class="http-body-json-error hidden"></p>
                        </div>
                    </div>
                    <div id="http-variables-area-${idx}" class="notify-var-area hidden">
                        <h5 class="notify-var-area-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"></path></svg> Variáveis Detectadas (URL e Body)</h5>
                        <div id="http-variables-list-${idx}" class="notify-var-list"></div>
                    </div>
                    <div class="notify-field http-test-section">
                        <h5 class="notify-var-area-title">Testar requisição</h5>
                        <p class="notify-field-hint">Preencha os valores das variáveis (se houver) e clique em Enviar teste.</p>
                        <div id="http-test-vars-${idx}" class="notify-var-list http-test-vars"></div>
                        <div class="http-test-actions">
                            <button type="button" class="http-curl-apply" onclick="enviarTesteHttp(${idx})">Enviar teste</button>
                        </div>
                        <div id="http-test-response-${idx}" class="http-test-response hidden">
                            <div class="http-test-response-header"><span class="http-test-status" id="http-test-status-${idx}"></span></div>
                            <pre id="http-test-body-${idx}" class="http-test-body"></pre>
                            <p id="http-test-error-${idx}" class="http-body-json-error hidden"></p>
                        </div>
                    </div>
                </div>
            `;
        }

        function initHttpItens() {
            const list = document.getElementById('requisicao-http-itens-list');
            if (!list || list.querySelectorAll('.http-item').length > 0) return;
            const wrap = document.createElement('div');
            wrap.className = 'http-item expanded';
            wrap.setAttribute('data-index', '0');
            wrap.innerHTML = getHttpItemHtml(0);
            list.appendChild(wrap);
        }

        function addHttpItem() {
            const list = document.getElementById('requisicao-http-itens-list');
            if (!list) return;
            const idx = list.querySelectorAll('.http-item').length;
            const wrap = document.createElement('div');
            wrap.className = 'http-item expanded';
            wrap.setAttribute('data-index', String(idx));
            wrap.innerHTML = getHttpItemHtml(idx);
            list.appendChild(wrap);
            reindexHttpItems();
        }

        function removeHttpItem(idx) {
            const list = document.getElementById('requisicao-http-itens-list');
            const item = list && list.querySelector('.http-item[data-index="' + idx + '"]');
            if (!item || idx === 0) return;
            item.remove();
            reindexHttpItems();
        }

        function toggleHttpItemExpand(idx) {
            const list = document.getElementById('requisicao-http-itens-list');
            const item = list && list.querySelector('.http-item[data-index="' + idx + '"]');
            if (!item) return;
            const body = item.querySelector('.http-item-body');
            if (!body) return;
            const isCollapsed = body.classList.contains('hidden');
            if (isCollapsed) {
                body.classList.remove('hidden');
                item.classList.add('expanded');
            } else {
                body.classList.add('hidden');
                item.classList.remove('expanded');
            }
        }

        function updateHttpItemTitle(idx) {
            const list = document.getElementById('requisicao-http-itens-list');
            const item = list && list.querySelector('.http-item[data-index="' + idx + '"]');
            if (!item) return;
            const titleEl = item.querySelector('.http-item-header .item-title');
            const urlInput = document.getElementById('input-http-url-' + idx);
            const url = (urlInput && urlInput.value || '').trim();
            const base = 'Requisição ' + (idx + 1);
            if (titleEl) titleEl.textContent = url ? base + ' — ' + (url.length > 45 ? url.slice(0, 45) + '…' : url) : base;
        }

        function reindexHttpItems() {
            const list = document.getElementById('requisicao-http-itens-list');
            if (!list) return;
            list.querySelectorAll('.http-item').forEach((el, i) => {
                el.setAttribute('data-index', String(i));
                const header = el.querySelector('.http-item-header');
                const title = header && header.querySelector('.item-title');
                if (title) { title.textContent = 'Requisição ' + (i + 1); updateHttpItemTitle(i); }
                const removeBtn = el.querySelector('.item-remove');
                if (removeBtn) {
                    removeBtn.onclick = function(ev) { ev.stopPropagation(); removeHttpItem(i); };
                    removeBtn.style.display = i > 0 ? '' : 'none';
                }
                el.querySelectorAll('[id]').forEach(n => {
                    if (n.id && /-\d+$/.test(n.id)) n.id = n.id.replace(/-\d+$/, '-' + i);
                });
                el.querySelectorAll('[onclick]').forEach(btn => {
                    const on = btn.getAttribute('onclick');
                    if (!on) return;
                    let atualizado = on;
                    if (/,\s*\d+\)/.test(atualizado)) {
                        atualizado = atualizado.replace(/,\s*\d+\)/, ', ' + i + ')');
                    }
                    if (/\(\d+\)/.test(atualizado)) {
                        atualizado = atualizado.replace(/\(\d+\)/, '(' + i + ')');
                    }
                    if (atualizado !== on) btn.setAttribute('onclick', atualizado);
                });
                if (header) header.onclick = function() { toggleHttpItemExpand(i); };
            });
        }

        function toggleHttpCurlArea(idx) {
            const area = document.getElementById('http-curl-area-global');
            if (!area) return;
            window._httpCurlTargetIndex = typeof idx === 'number' ? idx : null;
            area.classList.toggle('hidden', idx == null);
            area.setAttribute('aria-hidden', idx == null ? 'true' : 'false');
            const ta = document.getElementById('http-curl-input-global');
            if (ta && idx != null) {
                ta.value = '';
                setTimeout(function() {
                    ta.focus();
                    ta.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 0);
            }
        }

        function parseCurlCommand(str) {
            const result = { method: 'GET', url: '', headers: [], query: [], body: '' };
            if (!str || typeof str !== 'string') return result;
            let s = str.replace(/\\\s*\n\s*/g, ' ').replace(/\n/g, ' ').trim();

            const methodMatch = s.match(/-X\s+(\w+)|--request\s+(\w+)/i);
            if (methodMatch) result.method = (methodMatch[1] || methodMatch[2]).toUpperCase();

            const urlMatch = s.match(/https?:\/\/[^\s'"]+/);
            if (urlMatch) {
                const fullUrl = urlMatch[0];
                const q = fullUrl.indexOf('?');
                if (q !== -1) {
                    result.url = fullUrl.slice(0, q);
                    const params = new URLSearchParams(fullUrl.slice(q));
                    params.forEach((val, key) => { result.query.push({ name: key, value: val }); });
                } else {
                    result.url = fullUrl;
                }
            }

            const headerRegex = /-H\s+["']([^"']+)["']|--header\s+["']([^"']+)["']/gi;
            let headerMatch;
            while ((headerMatch = headerRegex.exec(s)) !== null) {
                const h = (headerMatch[1] || headerMatch[2] || '').trim();
                const colon = h.indexOf(':');
                if (colon !== -1) result.headers.push({ name: h.slice(0, colon).trim(), value: h.slice(colon + 1).trim() });
            }

            const dataMatch = s.match(/-d\s+["']([\s\S]*?)["']\s*(?=-|$)|--data\s+["']([\s\S]*?)["']\s*(?=-|$)|--data-raw\s+["']([\s\S]*?)["']\s*(?=-|$)/i);
            if (dataMatch) {
                result.body = (dataMatch[1] || dataMatch[2] || dataMatch[3] || '').trim();
                if (result.body && result.method === 'GET') result.method = 'POST';
            }

            return result;
        }

        function aplicarCurlHttpFromGlobal() {
            const idx = window._httpCurlTargetIndex;
            if (typeof idx !== 'number' && idx !== 0) return;
            const ta = document.getElementById('http-curl-input-global');
            if (!ta) return;
            if (!ta.value || !ta.value.trim()) {
                showToast('Cole um comando cURL antes de salvar.', 'error');
                return;
            }
            const parsed = parseCurlCommand(ta.value);
            const methodSelect = document.getElementById('select-http-method-' + idx);
            const urlInput = document.getElementById('input-http-url-' + idx);
            if (methodSelect) methodSelect.value = parsed.method;
            if (urlInput) urlInput.value = parsed.url;

            if (parsed.query.length > 0) {
                document.getElementById('toggle-http-query-' + idx).checked = true;
                toggleHttpSection('query', idx);
                const list = document.getElementById('http-query-list-' + idx);
                if (list) { list.innerHTML = ''; parsed.query.forEach(() => addHttpParamRow('query', idx)); list.querySelectorAll('input[data-param="name"]').forEach((inp, i) => { inp.value = parsed.query[i].name; }); list.querySelectorAll('input[data-param="value"]').forEach((inp, i) => { inp.value = parsed.query[i].value; }); }
            }
            if (parsed.headers.length > 0) {
                document.getElementById('toggle-http-headers-' + idx).checked = true;
                toggleHttpSection('headers', idx);
                const list = document.getElementById('http-headers-list-' + idx);
                if (list) { list.innerHTML = ''; parsed.headers.forEach(() => addHttpParamRow('headers', idx)); list.querySelectorAll('input[data-param="name"]').forEach((inp, i) => { inp.value = parsed.headers[i].name; }); list.querySelectorAll('input[data-param="value"]').forEach((inp, i) => { inp.value = parsed.headers[i].value; }); }
            }
            if (parsed.body) {
                document.getElementById('toggle-http-body-' + idx).checked = true;
                toggleHttpSection('body', idx);
                const bodyTa = document.getElementById('textarea-http-body-' + idx);
                if (bodyTa) bodyTa.value = parsed.body;
                validateHttpBodyJson(idx);
            }
            parseVariablesHttp(idx);
            toggleHttpCurlArea(null);
        }

        function toggleHttpSection(section, idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const ids = { query: 'http-query-container-' + idx, headers: 'http-headers-container-' + idx, body: 'http-body-container-' + idx };
            const id = ids[section];
            const chkId = (section === 'query' ? 'toggle-http-query' : section === 'headers' ? 'toggle-http-headers' : 'toggle-http-body') + '-' + idx;
            const chk = document.getElementById(chkId);
            const container = document.getElementById(id);
            if (chk && container) {
                container.classList.toggle('hidden', !chk.checked);
                if (chk.checked && (section === 'query' || section === 'headers')) {
                    const listId = (section === 'query' ? 'http-query-list' : 'http-headers-list') + '-' + idx;
                    const list = document.getElementById(listId);
                    if (list && list.querySelectorAll('.http-param-row').length === 0) addHttpParamRow(section, idx);
                }
            }
        }

        function addHttpParamRow(section, idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const listId = (section === 'query' ? 'http-query-list' : 'http-headers-list') + '-' + idx;
            const list = document.getElementById(listId);
            if (!list) return;
            const row = document.createElement('div');
            row.className = 'http-param-row';
            row.innerHTML = `
                <div class="http-param-cell">
                    <label>Nome</label>
                    <input type="text" placeholder="Ex: apikey" data-param="name" oninput="parseVariablesHttp(${idx})">
                </div>
                <div class="http-param-cell">
                    <label>Valor</label>
                    <input type="text" placeholder="Ex: valor ou [variavel]" data-param="value" oninput="parseVariablesHttp(${idx})">
                </div>
                <button type="button" class="http-param-delete" onclick="removeHttpParamRow(this, '${section}', ${idx})" title="Remover">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </button>
            `;
            list.appendChild(row);
        }

        function removeHttpParamRow(btn, section, idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const row = btn && btn.closest('.http-param-row');
            if (row) row.remove();
            parseVariablesHttp(idx);
        }

        function coletarAbrirAtendimento() {
            const chk = document.getElementById('ferramentaAbrirAtendimentoSwitch');
            const input = document.getElementById('abrirAtendimentoQuandoAtivar');
            const exemplosAtivarEl = document.getElementById('abrirAtendimentoExemplos');
            const exemplosNaoAtivarEl = document.getElementById('abrirAtendimentoExemplosNaoAtivar');
            if (!chk || !chk.checked) return null;
            const quandoAtivar = (input && input.value || '').trim();
            if (!quandoAtivar) return null;
            const exemplosAtivarRaw = (exemplosAtivarEl && exemplosAtivarEl.value || '').trim();
            const exemplosAtivarLinhas = exemplosAtivarRaw ? exemplosAtivarRaw.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
            const exemplosAtivar = exemplosAtivarLinhas.length > 0 ? exemplosAtivarLinhas : null;
            const exemplosNaoAtivarRaw = (exemplosNaoAtivarEl && exemplosNaoAtivarEl.value || '').trim();
            const exemplosNaoAtivarLinhas = exemplosNaoAtivarRaw ? exemplosNaoAtivarRaw.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
            const exemplosNaoAtivar = exemplosNaoAtivarLinhas.length > 0 ? exemplosNaoAtivarLinhas : null;

            var exemplosAtivarTexto = (exemplosAtivar && exemplosAtivar.length > 0)
                ? exemplosAtivar.map(function(ex) { return '- ' + ex; }).join('\n')
                : '- (sem exemplos)';
            var exemplosNaoAtivarTexto = (exemplosNaoAtivar && exemplosNaoAtivar.length > 0)
                ? exemplosNaoAtivar.map(function(ex) { return '- ' + ex; }).join('\n')
                : '- (sem exemplos)';
            var instrucoes =
                'FERRAMENTA: ABRIR_ATENDIMENTO\n' +
                'GATILHO:\n' +
                quandoAtivar + '\n' +
                'EXEMPLOS QUE DEVEM ATIVAR:\n' +
                exemplosAtivarTexto + '\n' +
                'EXEMPLOS QUE NÃO DEVEM ATIVAR:\n' +
                exemplosNaoAtivarTexto + '\n' +
                'REGRAS DE EXECUÇÃO E INTERPRETAÇÃO:\n\n' +
                'Ative APENAS quando a intenção do lead for clara e direta em relação ao gatilho\n' +
                'Considere sinônimos diretos, variações ortográficas e erros de digitação óbvios\n' +
                'NÃO ative para mensagens vagas, genéricas ou apenas tangencialmente relacionadas\n' +
                'Na dúvida, NÃO ative. Continue a conversa normalmente.\n' +
                'Quando ativar: chame a ferramenta imediatamente, depois responda ao lead normalmente\n' +
                'Não mencione que chamou a ferramenta\n' +
                'Não peça confirmação adicional ao lead';

            return { ativo: true, quandoAtivar: quandoAtivar, exemplos: exemplosAtivar, exemplosAtivar: exemplosAtivar, exemplosNaoAtivar: exemplosNaoAtivar, instrucoes: instrucoes };
        }

        function formatVariaveisColetarTabela(itens) {
            if (!itens || !itens.length) {
                return '(Nenhuma variável para coletar nesta integração.)';
            }
            const esc = function(s) {
                return String(s || '-').replace(/\|/g, '\\|').replace(/\r?\n/g, ' ').trim();
            };
            const linhas = [
                '| Variável | Origem | Normalização obrigatória |',
                '|----------|--------|--------------------------|'
            ];
            itens.forEach(function(v) {
                linhas.push('| ' + esc('[' + v.nome + ']') + ' | Usuário | ' + esc(v.descricao) + ' |');
            });
            return linhas.join('\n');
        }

        function coletarNotificarHumano() {
            const chk = document.getElementById('toggle-notify-main');
            if (!chk || !chk.checked) return null;
            const list = document.getElementById('notify-itens-list');
            const items = list ? list.querySelectorAll('.notify-item') : [];
            const itens = [];
            items.forEach((el, idx) => {
                const quandoAtivar = (document.getElementById('input-quando-ativar-' + idx) && document.getElementById('input-quando-ativar-' + idx).value || '').trim();
                const checkWhatsapp = document.getElementById('check-whatsapp-' + idx);
                const inputWhatsapp = document.getElementById('input-whatsapp-' + idx);
                const whatsappAtivo = !!(checkWhatsapp && checkWhatsapp.checked);
                const whatsapp = (inputWhatsapp && inputWhatsapp.value || '').trim();
                const modeloMensagem = (document.getElementById('message-template-' + idx) && document.getElementById('message-template-' + idx).value || '').trim();
                const variaveis = [];
                const listVars = document.getElementById('variables-list-' + idx);
                if (listVars) listVars.querySelectorAll('.notify-var-row').forEach(row => {
                    const tag = row.querySelector('.notify-var-tag');
                    const descInp = row.querySelector('.notify-var-desc-input');
                    if (tag && descInp) {
                        const nome = (tag.textContent || '').replace(/^\[|\]$/g, '');
                        if (nome) variaveis.push({ nome, descricao: (descInp.value || '').trim() || '-' });
                    }
                });
                const exemplosAtivarRaw = (document.getElementById('input-notify-exemplos-ativar-' + idx) && document.getElementById('input-notify-exemplos-ativar-' + idx).value || '').trim();
                const exemplosAtivarLinhas = exemplosAtivarRaw ? exemplosAtivarRaw.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
                const exemplosAtivar = exemplosAtivarLinhas.length > 0 ? exemplosAtivarLinhas : null;
                const exemplosNaoAtivarRaw = (document.getElementById('input-notify-exemplos-nao-ativar-' + idx) && document.getElementById('input-notify-exemplos-nao-ativar-' + idx).value || '').trim();
                const exemplosNaoAtivarLinhas = exemplosNaoAtivarRaw ? exemplosNaoAtivarRaw.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
                const exemplosNaoAtivar = exemplosNaoAtivarLinhas.length > 0 ? exemplosNaoAtivarLinhas : null;
                const exemplosAtivarTexto = (exemplosAtivar && exemplosAtivar.length > 0)
                    ? exemplosAtivar.map(function(ex) { return '- ' + ex; }).join('\n')
                    : '- (sem exemplos)';
                const exemplosNaoAtivarTexto = (exemplosNaoAtivar && exemplosNaoAtivar.length > 0)
                    ? exemplosNaoAtivar.map(function(ex) { return '- ' + ex; }).join('\n')
                    : '- (sem exemplos)';
                const instrucoes =
                    'FERRAMENTA: NOTIFICAR_HUMANO\n' +
                    'GATILHO:\n' +
                    quandoAtivar + '\n' +
                    'EXEMPLOS QUE DEVEM ATIVAR:\n' +
                    exemplosAtivarTexto + '\n' +
                    'EXEMPLOS QUE NÃO DEVEM ATIVAR:\n' +
                    exemplosNaoAtivarTexto + '\n' +
                    'VARIÁVEIS A COLETAR:\n\n' +
                    formatVariaveisColetarTabela(variaveis) + '\n\n' +
                    'REGRAS DE EXECUÇÃO E INTERPRETAÇÃO:\n\n' +
                    'Ative APENAS quando a intenção do lead for clara e direta em relação ao gatilho\n' +
                    'Considere sinônimos diretos, variações ortográficas e erros de digitação óbvios\n' +
                    'NÃO ative para mensagens vagas, genéricas ou apenas tangencialmente relacionadas\n' +
                    'Na dúvida, NÃO ative. Continue a conversa normalmente.\n' +
                    'Quando ativar: chame a ferramenta imediatamente, depois responda ao lead normalmente\n' +
                    'Não mencione que chamou a ferramenta\n' +
                    'Não peça confirmação adicional ao lead\n' +
                    'Verifique se possui as variáveis no histórico da conversa antes de chamar\n' +
                    'Se faltar alguma variável, pergunte ao lead antes de chamar a ferramenta';
                itens.push({ quandoAtivar, whatsappAtivo, whatsapp, modeloMensagem, variaveis, exemplos: exemplosAtivar, exemplosAtivar, exemplosNaoAtivar, instrucoes });
            });
            return { ativo: true, itens };
        }

        function construirCurlHttp(idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const method = (document.getElementById('select-http-method-' + idx) && document.getElementById('select-http-method-' + idx).value) || 'GET';
            let url = (document.getElementById('input-http-url-' + idx) && document.getElementById('input-http-url-' + idx).value || '').trim();
            const headers = [];
            if (document.getElementById('toggle-http-headers-' + idx) && document.getElementById('toggle-http-headers-' + idx).checked) {
                const list = document.getElementById('http-headers-list-' + idx);
                if (list) list.querySelectorAll('.http-param-row').forEach(row => {
                    const n = row.querySelector('input[data-param="name"]');
                    const v = row.querySelector('input[data-param="value"]');
                    if (n && v && n.value.trim()) headers.push({ name: n.value.trim(), value: v.value });
                });
            }
            const queryParams = [];
            if (document.getElementById('toggle-http-query-' + idx) && document.getElementById('toggle-http-query-' + idx).checked) {
                const list = document.getElementById('http-query-list-' + idx);
                if (list) list.querySelectorAll('.http-param-row').forEach(row => {
                    const n = row.querySelector('input[data-param="name"]');
                    const v = row.querySelector('input[data-param="value"]');
                    if (n && v && n.value.trim()) queryParams.push({ name: n.value.trim(), value: v.value });
                });
            }
            if (queryParams.length > 0) url += (url.indexOf('?') !== -1 ? '&' : '?') + queryParams.map(p => encodeURIComponent(p.name) + '=' + encodeURIComponent(p.value)).join('&');
            let body = null;
            if (document.getElementById('toggle-http-body-' + idx) && document.getElementById('toggle-http-body-' + idx).checked) {
                const ta = document.getElementById('textarea-http-body-' + idx);
                if (ta && ta.value.trim()) body = ta.value.trim();
            }
            let curl = 'curl -X ' + method + ' "' + url.replace(/"/g, '\\"') + '"';
            headers.forEach(h => { curl += ' -H "' + h.name + ': ' + (h.value || '').replace(/"/g, '\\"') + '"'; });
            if (body && !['GET', 'HEAD'].includes(method)) curl += ' -d \'' + body.replace(/'/g, "'\\''") + '\'';
            return curl;
        }

        function construirInstrucaoHttp(idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const quandoAtivar = (document.getElementById('input-http-quando-ativar-' + idx) && document.getElementById('input-http-quando-ativar-' + idx).value || '').trim();
            const method = (document.getElementById('select-http-method-' + idx) && document.getElementById('select-http-method-' + idx).value) || 'GET';
            const url = (document.getElementById('input-http-url-' + idx) && document.getElementById('input-http-url-' + idx).value || '').trim();
            const titulo = url ? (url.replace(/^https?:\/\//, '').split('/')[0] || 'Integração HTTP') : 'Integração HTTP';
            const linhas = quandoAtivar ? quandoAtivar.split(/[,;]/).map(s => '- ' + s.trim()).filter(s => s !== '- ') : [];
            if (linhas.length === 0 && quandoAtivar) linhas.push('- ' + quandoAtivar);
            const vars = [];
            const listVars = document.getElementById('http-variables-list-' + idx);
            if (listVars) listVars.querySelectorAll('.notify-var-row').forEach(row => {
                const tag = row.querySelector('.notify-var-tag');
                const descInp = row.querySelector('.notify-var-desc-input');
                if (tag && descInp) {
                    const nome = (tag.textContent || '').replace(/^\[|\]$/g, '');
                    if (nome) vars.push({ nome, descricao: (descInp.value || '').trim() || 'Coletar do usuário.' });
                }
            });
            const queryAtivo = document.getElementById('toggle-http-query-' + idx) && document.getElementById('toggle-http-query-' + idx).checked;
            const headersAtivo = document.getElementById('toggle-http-headers-' + idx) && document.getElementById('toggle-http-headers-' + idx).checked;
            const bodyAtivo = document.getElementById('toggle-http-body-' + idx) && document.getElementById('toggle-http-body-' + idx).checked;
            const queryPairs = [];
            if (queryAtivo) {
                const qlist = document.getElementById('http-query-list-' + idx);
                if (qlist) qlist.querySelectorAll('.http-param-row').forEach(row => {
                    const n = row.querySelector('input[data-param="name"]');
                    const v = row.querySelector('input[data-param="value"]');
                    const nome = (n && n.value || '').trim();
                    const valor = (v && v.value || '').trim();
                    if (nome) queryPairs.push({ name: nome, value: valor });
                });
            }
            const headerPairs = [];
            if (headersAtivo) {
                const hlist = document.getElementById('http-headers-list-' + idx);
                if (hlist) hlist.querySelectorAll('.http-param-row').forEach(row => {
                    const n = row.querySelector('input[data-param="name"]');
                    const v = row.querySelector('input[data-param="value"]');
                    const nome = (n && n.value || '').trim();
                    const valor = (v && v.value || '').trim();
                    if (nome) headerPairs.push({ name: nome, value: valor });
                });
            }
            const bodyTa = document.getElementById('textarea-http-body-' + idx);
            const bodyStr = bodyAtivo && bodyTa && bodyTa.value.trim() ? bodyTa.value.trim() : '';
            const exemplosAtivarRaw = (document.getElementById('input-http-exemplos-ativar-' + idx) && document.getElementById('input-http-exemplos-ativar-' + idx).value || '').trim();
            const exemplosAtivarLinhas = exemplosAtivarRaw ? exemplosAtivarRaw.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
            const exemplosAtivar = exemplosAtivarLinhas.length > 0 ? exemplosAtivarLinhas : null;
            const exemplosNaoAtivarRaw = (document.getElementById('input-http-exemplos-nao-ativar-' + idx) && document.getElementById('input-http-exemplos-nao-ativar-' + idx).value || '').trim();
            const exemplosNaoAtivarLinhas = exemplosNaoAtivarRaw ? exemplosNaoAtivarRaw.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
            const exemplosNaoAtivar = exemplosNaoAtivarLinhas.length > 0 ? exemplosNaoAtivarLinhas : null;
            const gatilhoTexto = linhas.length ? linhas.join('\n') : '- (configure o gatilho)';
            const exemplosAtivarTexto = (exemplosAtivar && exemplosAtivar.length > 0)
                ? exemplosAtivar.map(function(ex) { return '- ' + ex; }).join('\n')
                : '- (sem exemplos)';
            const exemplosNaoAtivarTexto = (exemplosNaoAtivar && exemplosNaoAtivar.length > 0)
                ? exemplosNaoAtivar.map(function(ex) { return '- ' + ex; }).join('\n')
                : '- (sem exemplos)';
            const payloadTool = {
                url: url,
                method: method
            };
            if (queryPairs.length > 0) {
                payloadTool.queryParams = {};
                queryPairs.forEach(function(p) { payloadTool.queryParams[p.name] = p.value; });
            }
            if (headerPairs.length > 0) {
                payloadTool.headers = {};
                headerPairs.forEach(function(h) { payloadTool.headers[h.name] = h.value; });
            }
            if (bodyStr) {
                try {
                    payloadTool.body = JSON.parse(bodyStr);
                } catch (e) {
                    payloadTool.body = bodyStr;
                }
            }
            const payloadToolStr = JSON.stringify(payloadTool, null, 2);

            const md =
                'FERRAMENTA: ' + titulo + '\n' +
                'GATILHO:\n' +
                gatilhoTexto + '\n' +
                'EXEMPLOS QUE DEVEM ATIVAR:\n' +
                exemplosAtivarTexto + '\n' +
                'EXEMPLOS QUE NÃO DEVEM ATIVAR:\n' +
                exemplosNaoAtivarTexto + '\n' +
                'VARIÁVEIS A COLETAR:\n\n' +
                formatVariaveisColetarTabela(vars) + '\n\n' +
                'REGRAS DE EXECUÇÃO E INTERPRETAÇÃO:\n\n' +
                'Ative APENAS quando a intenção do lead for clara e direta em relação ao gatilho\n' +
                'Considere sinônimos diretos, variações ortográficas e erros de digitação óbvios\n' +
                'NÃO ative para mensagens vagas, genéricas ou apenas tangencialmente relacionadas\n' +
                'Na dúvida, NÃO ative. Continue a conversa normalmente.\n' +
                'Só ative quando tiver TODAS as variáveis necessárias. Se faltar alguma, pergunte ao lead de forma natural antes de chamar a ferramenta\n' +
                'Quando ativar: chame a ferramenta imediatamente, depois responda ao lead normalmente\n' +
                'Não mencione que chamou a ferramenta\n' +
                'Não peça confirmação adicional ao lead\n\n' +
                payloadToolStr + '\n\n' +
                'NÃO altere a estrutura.\n' +
                'NÃO omita headers.\n' +
                'NÃO omita body.\n' +
                'NÃO coloque dentro de query.\n';
            return md;
        }

        function coletarRequisicaoHttp() {
            const chk = document.getElementById('ferramentaRequisicaoHttpSwitch');
            if (!chk || !chk.checked) return null;
            const list = document.getElementById('requisicao-http-itens-list');
            const items = list ? list.querySelectorAll('.http-item') : [];
            const itens = [];
            items.forEach((el, idx) => {
                const variaveis = [];
                const listVars = document.getElementById('http-variables-list-' + idx);
                if (listVars) listVars.querySelectorAll('.notify-var-row').forEach(row => {
                    const tag = row.querySelector('.notify-var-tag');
                    const descInp = row.querySelector('.notify-var-desc-input');
                    if (tag && descInp) {
                        const nome = (tag.textContent || '').replace(/^\[|\]$/g, '').trim();
                        if (nome) variaveis.push({ nome, descricao: (descInp.value || '').trim() || '' });
                    }
                });
                const exemplosAtivarRaw = (document.getElementById('input-http-exemplos-ativar-' + idx) && document.getElementById('input-http-exemplos-ativar-' + idx).value || '').trim();
                const exemplosAtivarLinhas = exemplosAtivarRaw ? exemplosAtivarRaw.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
                const exemplosAtivar = exemplosAtivarLinhas.length > 0 ? exemplosAtivarLinhas : null;
                const exemplosNaoAtivarRaw = (document.getElementById('input-http-exemplos-nao-ativar-' + idx) && document.getElementById('input-http-exemplos-nao-ativar-' + idx).value || '').trim();
                const exemplosNaoAtivarLinhas = exemplosNaoAtivarRaw ? exemplosNaoAtivarRaw.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
                const exemplosNaoAtivar = exemplosNaoAtivarLinhas.length > 0 ? exemplosNaoAtivarLinhas : null;
                itens.push({
                    quandoAtivar: (document.getElementById('input-http-quando-ativar-' + idx) && document.getElementById('input-http-quando-ativar-' + idx).value || '').trim() || null,
                    curl: construirCurlHttp(idx),
                    instrucao: construirInstrucaoHttp(idx),
                    variaveis: variaveis.length > 0 ? variaveis : null,
                    exemplos: exemplosAtivar,
                    exemplosAtivar: exemplosAtivar,
                    exemplosNaoAtivar: exemplosNaoAtivar
                });
            });
            return { ativo: true, itens };
        }

        function parseLinhasExemplos(raw) {
            const txt = (raw || '').trim();
            return txt ? txt.split(/\r?\n/).map(function(s) { return s.trim(); }).filter(Boolean) : [];
        }

        function obterLinhasHttp(section, idx) {
            const listId = (section === 'query' ? 'http-query-list-' : 'http-headers-list-') + idx;
            const list = document.getElementById(listId);
            if (!list) return [];
            return Array.from(list.querySelectorAll('.http-param-row'));
        }

        function validarLinhasNomeValor(rows) {
            if (!rows || rows.length === 0) return false;
            for (const row of rows) {
                const nameInp = row.querySelector('input[data-param="name"]');
                const valueInp = row.querySelector('input[data-param="value"]');
                const nome = (nameInp && nameInp.value || '').trim();
                const valor = (valueInp && valueInp.value || '').trim();
                if (!nome || !valor) return false;
            }
            return true;
        }

        function validarFerramentasAtivas() {
            const abrirChk = document.getElementById('ferramentaAbrirAtendimentoSwitch');
            if (abrirChk && abrirChk.checked) {
                const quando = (document.getElementById('abrirAtendimentoQuandoAtivar') && document.getElementById('abrirAtendimentoQuandoAtivar').value || '').trim();
                const exemplosAtivar = parseLinhasExemplos(document.getElementById('abrirAtendimentoExemplos') && document.getElementById('abrirAtendimentoExemplos').value);
                const exemplosNaoAtivar = parseLinhasExemplos(document.getElementById('abrirAtendimentoExemplosNaoAtivar') && document.getElementById('abrirAtendimentoExemplosNaoAtivar').value);
                if (!quando) {
                    showToast('Preencha "Quando Ativar" na ferramenta Abrir Atendimento.', 'error');
                    return false;
                }
                if (exemplosAtivar.length === 0) {
                    showToast('Preencha "Exemplos de quando ativar" na ferramenta Abrir Atendimento.', 'error');
                    return false;
                }
                if (exemplosNaoAtivar.length === 0) {
                    showToast('Preencha "Exemplos de quando não ativar" na ferramenta Abrir Atendimento.', 'error');
                    return false;
                }
            }

            const notifyChk = document.getElementById('toggle-notify-main');
            if (notifyChk && notifyChk.checked) {
                const items = document.querySelectorAll('#notify-itens-list .notify-item');
                for (let idx = 0; idx < items.length; idx++) {
                    const quando = (document.getElementById('input-quando-ativar-' + idx) && document.getElementById('input-quando-ativar-' + idx).value || '').trim();
                    const exemplosAtivar = parseLinhasExemplos(document.getElementById('input-notify-exemplos-ativar-' + idx) && document.getElementById('input-notify-exemplos-ativar-' + idx).value);
                    const exemplosNaoAtivar = parseLinhasExemplos(document.getElementById('input-notify-exemplos-nao-ativar-' + idx) && document.getElementById('input-notify-exemplos-nao-ativar-' + idx).value);
                    if (!quando) {
                        showToast(`Preencha "Quando Ativar" na Notificação ${idx + 1}.`, 'error');
                        return false;
                    }
                    if (exemplosAtivar.length === 0) {
                        showToast(`Preencha "Exemplos de quando ativar" na Notificação ${idx + 1}.`, 'error');
                        return false;
                    }
                    if (exemplosNaoAtivar.length === 0) {
                        showToast(`Preencha "Exemplos de quando não ativar" na Notificação ${idx + 1}.`, 'error');
                        return false;
                    }
                    const checkWhatsapp = document.getElementById('check-whatsapp-' + idx);
                    const whatsappAtivo = !!(checkWhatsapp && checkWhatsapp.checked);
                    if (!whatsappAtivo) {
                        showToast(`Ative o canal WhatsApp na Notificação ${idx + 1}.`, 'error');
                        return false;
                    }
                    const whatsapp = (document.getElementById('input-whatsapp-' + idx) && document.getElementById('input-whatsapp-' + idx).value || '').trim();
                    if (!whatsapp) {
                        showToast(`Preencha o número de WhatsApp na Notificação ${idx + 1}.`, 'error');
                        return false;
                    }
                    const modeloMensagem = (document.getElementById('message-template-' + idx) && document.getElementById('message-template-' + idx).value || '').trim();
                    if (!modeloMensagem) {
                        showToast(`Preencha o "Modelo de Mensagem" na Notificação ${idx + 1}.`, 'error');
                        return false;
                    }
                    const varsRows = document.querySelectorAll('#variables-list-' + idx + ' .notify-var-row');
                    for (const row of varsRows) {
                        const descInp = row.querySelector('.notify-var-desc-input');
                        const desc = (descInp && descInp.value || '').trim();
                        if (!desc) {
                            showToast(`Preencha todas as descrições de variáveis na Notificação ${idx + 1}.`, 'error');
                            return false;
                        }
                    }
                }
            }

            const reqChk = document.getElementById('ferramentaRequisicaoHttpSwitch');
            if (reqChk && reqChk.checked) {
                const items = document.querySelectorAll('#requisicao-http-itens-list .http-item');
                for (let idx = 0; idx < items.length; idx++) {
                    const quando = (document.getElementById('input-http-quando-ativar-' + idx) && document.getElementById('input-http-quando-ativar-' + idx).value || '').trim();
                    const exemplosAtivar = parseLinhasExemplos(document.getElementById('input-http-exemplos-ativar-' + idx) && document.getElementById('input-http-exemplos-ativar-' + idx).value);
                    const exemplosNaoAtivar = parseLinhasExemplos(document.getElementById('input-http-exemplos-nao-ativar-' + idx) && document.getElementById('input-http-exemplos-nao-ativar-' + idx).value);
                    if (!quando) {
                        showToast(`Preencha "Quando Ativar" na Requisição ${idx + 1}.`, 'error');
                        return false;
                    }
                    if (exemplosAtivar.length === 0) {
                        showToast(`Preencha "Exemplos de quando ativar" na Requisição ${idx + 1}.`, 'error');
                        return false;
                    }
                    if (exemplosNaoAtivar.length === 0) {
                        showToast(`Preencha "Exemplos de quando não ativar" na Requisição ${idx + 1}.`, 'error');
                        return false;
                    }
                    const method = (document.getElementById('select-http-method-' + idx) && document.getElementById('select-http-method-' + idx).value || '').trim();
                    if (!method) {
                        showToast(`Selecione o método HTTP na Requisição ${idx + 1}.`, 'error');
                        return false;
                    }
                    const url = (document.getElementById('input-http-url-' + idx) && document.getElementById('input-http-url-' + idx).value || '').trim();
                    if (!url) {
                        showToast(`Preencha a URL na Requisição ${idx + 1}.`, 'error');
                        return false;
                    }
                    const queryAtivo = !!(document.getElementById('toggle-http-query-' + idx) && document.getElementById('toggle-http-query-' + idx).checked);
                    if (queryAtivo) {
                        const queryRows = obterLinhasHttp('query', idx);
                        if (!validarLinhasNomeValor(queryRows)) {
                            showToast(`Preencha todos os parâmetros de Query (nome e valor) na Requisição ${idx + 1}.`, 'error');
                            return false;
                        }
                    }
                    const headersAtivo = !!(document.getElementById('toggle-http-headers-' + idx) && document.getElementById('toggle-http-headers-' + idx).checked);
                    if (headersAtivo) {
                        const headersRows = obterLinhasHttp('headers', idx);
                        if (!validarLinhasNomeValor(headersRows)) {
                            showToast(`Preencha todos os Cabeçalhos (nome e valor) na Requisição ${idx + 1}.`, 'error');
                            return false;
                        }
                    }
                    const bodyAtivo = !!(document.getElementById('toggle-http-body-' + idx) && document.getElementById('toggle-http-body-' + idx).checked);
                    if (bodyAtivo) {
                        const body = (document.getElementById('textarea-http-body-' + idx) && document.getElementById('textarea-http-body-' + idx).value || '').trim();
                        if (!body) {
                            showToast(`Preencha o Body na Requisição ${idx + 1}.`, 'error');
                            return false;
                        }
                        const bodyErr = document.getElementById('http-body-json-error-' + idx);
                        if (bodyErr && !bodyErr.classList.contains('hidden')) {
                            showToast(`Corrija o JSON do Body na Requisição ${idx + 1}.`, 'error');
                            return false;
                        }
                    }
                    const httpVarsRows = document.querySelectorAll('#http-variables-list-' + idx + ' .notify-var-row');
                    for (const row of httpVarsRows) {
                        const descInp = row.querySelector('.notify-var-desc-input');
                        const desc = (descInp && descInp.value || '').trim();
                        if (!desc) {
                            showToast(`Preencha todas as descrições de variáveis na Requisição ${idx + 1}.`, 'error');
                            return false;
                        }
                    }
                }
            }

            return true;
        }

        function traduzirErroJson(msg) {
            if (!msg || typeof msg !== 'string') return 'Verifique a sintaxe do JSON.';
            let m = msg
                .replace(/Expected double-quoted property name in JSON at position (\d+)(\s*\(line (\d+) column (\d+)\))?/gi, (_, pos, __, lin, col) => col ? `Esperado nome de propriedade entre aspas duplas na posição ${pos} (linha ${lin}, coluna ${col})` : `Esperado nome de propriedade entre aspas duplas na posição ${pos}`)
                .replace(/Unexpected token .* in JSON at position (\d+)(\s*\(line (\d+) column (\d+)\))?/gi, (_, pos, __, lin, col) => col ? `Token inesperado na posição ${pos} (linha ${lin}, coluna ${col})` : `Token inesperado na posição ${pos}`)
                .replace(/Unexpected end of JSON input/gi, 'Fim inesperado do JSON')
                .replace(/Unexpected number in JSON at position (\d+)/gi, 'Número inesperado na posição $1')
                .replace(/Unexpected string in JSON at position (\d+)/gi, 'Texto inesperado na posição $1')
                .replace(/Unexpected character in JSON at position (\d+)/gi, 'Caractere inesperado na posição $1')
                .replace(/\(line (\d+) column (\d+)\)/gi, '(linha $1, coluna $2)');
            return m;
        }

        function validateHttpBodyJson(idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const ta = document.getElementById('textarea-http-body-' + idx);
            const errEl = document.getElementById('http-body-json-error-' + idx);
            if (!ta || !errEl) return;
            const texto = (ta.value || '').trim();
            if (texto === '') {
                errEl.classList.add('hidden');
                errEl.textContent = '';
                ta.classList.remove('json-invalid');
                return;
            }
            try {
                const paraValidar = texto.replace(/\[[^\]]*\]/g, '__VAR__');
                JSON.parse(paraValidar);
                errEl.classList.add('hidden');
                errEl.textContent = '';
                ta.classList.remove('json-invalid');
            } catch (e) {
                errEl.classList.remove('hidden');
                errEl.textContent = 'JSON inválido. ' + traduzirErroJson(e.message);
                ta.classList.add('json-invalid');
            }
        }

        function parseVariablesHttp(idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const urlInput = document.getElementById('input-http-url-' + idx);
            const bodyTa = document.getElementById('textarea-http-body-' + idx);
            const area = document.getElementById('http-variables-area-' + idx);
            const list = document.getElementById('http-variables-list-' + idx);
            const testVarsEl = document.getElementById('http-test-vars-' + idx);
            if (!list || !area) return;
            let texto = (urlInput && urlInput.value) || '';
            const qlist = document.getElementById('http-query-list-' + idx);
            const hlist = document.getElementById('http-headers-list-' + idx);
            if (qlist) qlist.querySelectorAll('input[data-param="value"]').forEach(inp => { texto += ' ' + (inp.value || ''); });
            if (hlist) hlist.querySelectorAll('input[data-param="value"]').forEach(inp => { texto += ' ' + (inp.value || ''); });
            texto += ' ' + ((bodyTa && bodyTa.value) || '');
            const vars = texto.match(/\[([^\]]+)\]/g);
            const unicas = vars ? [...new Set(vars.map(v => v.replace(/^\[|\]$/g, '')))].filter(Boolean) : [];
            list.innerHTML = '';
            if (testVarsEl) testVarsEl.innerHTML = '';
            if (unicas.length === 0) {
                area.classList.add('hidden');
                return;
            }
            area.classList.remove('hidden');
            unicas.forEach(nome => {
                const row = document.createElement('div');
                row.className = 'notify-var-row';
                row.innerHTML = `
                    <span class="notify-var-tag">[${nome}]</span>
                    <input type="text" class="notify-var-desc-input" data-var="${nome}" placeholder="Descrição para o agente coletar esta informação">
                `;
                list.appendChild(row);
                if (testVarsEl) {
                    const testRow = document.createElement('div');
                    testRow.className = 'notify-var-row';
                    testRow.innerHTML = `
                        <span class="notify-var-tag">[${nome}]</span>
                        <input type="text" class="notify-var-desc-input" data-var-test="${nome}" placeholder="Valor para teste">
                    `;
                    testVarsEl.appendChild(testRow);
                }
            });
        }

        function substituirVariaveis(texto, valores) {
            if (!texto) return texto;
            return String(texto).replace(/\[([^\]]+)\]/g, (_, nome) => (valores[nome] != null && valores[nome] !== '' ? String(valores[nome]) : '[' + nome + ']'));
        }

        async function enviarTesteHttp(idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const statusEl = document.getElementById('http-test-status-' + idx);
            const bodyEl = document.getElementById('http-test-body-' + idx);
            const errorEl = document.getElementById('http-test-error-' + idx);
            const responseEl = document.getElementById('http-test-response-' + idx);
            const testVarsEl = document.getElementById('http-test-vars-' + idx);
            const btn = responseEl && responseEl.querySelector('button.http-curl-apply');
            if (!responseEl || !statusEl || !bodyEl) return;

            const valores = {};
            if (testVarsEl) testVarsEl.querySelectorAll('input[data-var-test]').forEach(inp => {
                const nome = inp.getAttribute('data-var-test');
                if (nome) valores[nome] = inp.value || '';
            });

            const method = (document.getElementById('select-http-method-' + idx) && document.getElementById('select-http-method-' + idx).value) || 'GET';
            let url = (document.getElementById('input-http-url-' + idx) && document.getElementById('input-http-url-' + idx).value) || '';
            url = substituirVariaveis(url, valores);

            const headers = {};
            if (document.getElementById('toggle-http-headers-' + idx) && document.getElementById('toggle-http-headers-' + idx).checked) {
                const list = document.getElementById('http-headers-list-' + idx);
                if (list) list.querySelectorAll('.http-param-row').forEach(row => {
                    const nameInp = row.querySelector('input[data-param="name"]');
                    const valueInp = row.querySelector('input[data-param="value"]');
                    if (nameInp && valueInp && nameInp.value.trim()) headers[nameInp.value.trim()] = substituirVariaveis(valueInp.value, valores);
                });
            }

            let body = null;
            let bodyStr = '';
            if (document.getElementById('toggle-http-body-' + idx) && document.getElementById('toggle-http-body-' + idx).checked) {
                const ta = document.getElementById('textarea-http-body-' + idx);
                if (ta && ta.value.trim()) {
                    bodyStr = substituirVariaveis(ta.value.trim(), valores);
                    body = bodyStr;
                    if (!headers['Content-Type'] && /^\s*[\{\[]/.test(bodyStr)) headers['Content-Type'] = 'application/json';
                }
            }

            const queryParams = [];
            if (document.getElementById('toggle-http-query-' + idx) && document.getElementById('toggle-http-query-' + idx).checked) {
                const list = document.getElementById('http-query-list-' + idx);
                if (list) list.querySelectorAll('.http-param-row').forEach(row => {
                    const nameInp = row.querySelector('input[data-param="name"]');
                    const valueInp = row.querySelector('input[data-param="value"]');
                    if (nameInp && valueInp && nameInp.value.trim()) queryParams.push({ name: nameInp.value.trim(), value: substituirVariaveis(valueInp.value, valores) });
                });
            }
            if (queryParams.length > 0) {
                const sep = url.indexOf('?') !== -1 ? '&' : '?';
                url += sep + queryParams.map(p => encodeURIComponent(p.name) + '=' + encodeURIComponent(p.value)).join('&');
            }

            responseEl.classList.remove('hidden');
            errorEl.classList.add('hidden');
            statusEl.textContent = 'Enviando...';
            statusEl.className = 'http-test-status';
            bodyEl.textContent = '';
            if (btn) btn.disabled = true;

            try {
                const opts = { method, headers };
                if (body && !['GET', 'HEAD'].includes(method)) opts.body = body;
                const res = await fetch(url, opts);
                statusEl.textContent = res.status + ' ' + (res.statusText || '');
                statusEl.className = 'http-test-status ' + (res.ok ? 'ok' : 'err');
                const text = await res.text();
                try {
                    bodyEl.textContent = JSON.stringify(JSON.parse(text), null, 2);
                } catch (_) {
                    bodyEl.textContent = text || '(vazio)';
                }
            } catch (err) {
                statusEl.textContent = 'Erro na requisição';
                statusEl.className = 'http-test-status err';
                bodyEl.textContent = '';
                errorEl.classList.remove('hidden');
                errorEl.textContent = err.message || 'Verifique a URL (CORS pode bloquear requisições para outros domínios).';
            }
            if (btn) btn.disabled = false;
        }

        function toggleInput(canal, idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const chkId = canal === 'whatsapp' ? 'check-whatsapp-' + idx : 'check-email-' + idx;
            const inputId = canal === 'whatsapp' ? 'input-whatsapp-' + idx : 'input-email-' + idx;
            const chk = document.getElementById(chkId);
            const input = document.getElementById(inputId);
            if (chk && input) input.disabled = !chk.checked;
        }

        function parseVariables(idx) {
            if (typeof idx !== 'number' && idx !== 0) idx = 0;
            const ta = document.getElementById('message-template-' + idx);
            const area = document.getElementById('variables-area-' + idx);
            const list = document.getElementById('variables-list-' + idx);
            if (!ta || !area || !list) return;
            const texto = ta.value || '';
            const vars = texto.match(/\[([^\]]+)\]/g);
            const unicas = vars ? [...new Set(vars.map(v => v.replace(/^\[|\]$/g, '')))].filter(Boolean) : [];
            list.innerHTML = '';
            if (unicas.length === 0) {
                area.classList.add('hidden');
                return;
            }
            area.classList.remove('hidden');
            unicas.forEach(nome => {
                const row = document.createElement('div');
                row.className = 'notify-var-row';
                row.innerHTML = `
                    <span class="notify-var-tag">[${nome}]</span>
                    <input type="text" class="notify-var-desc-input" data-var="${nome}" placeholder="Descrição para o agente coletar esta informação">
                `;
                list.appendChild(row);
            });
        }

        // ===== FUNÇÕES DE COR DO AGENTE =====
        function atualizarCorAgente(cor) {
            const avatar = document.getElementById('agenteAvatar');
            if (avatar) {
                avatar.style.background = cor;
                // Calcular sombra com opacidade baseada na cor
                const rgb = hexToRgb(cor);
                if (rgb) {
                    avatar.style.boxShadow = `0 4px 12px rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, 0.3)`;
                }
            }
        }

        function hexToRgb(hex) {
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        // ===== FUNÇÕES DE PERGUNTAS E RESPOSTAS =====
        async function removerPerguntaResposta(id) {
            // Função mantida para compatibilidade, mas não faz mais nada
            // pois a funcionalidade de perguntas e respostas foi removida
            console.log('Função removerPerguntaResposta chamada, mas funcionalidade foi removida');
        }

        // ===== FUNÇÃO PARA EXCLUIR DOCUMENTO DO SERVIDOR =====
        async function excluirDocumento(index, idDocumento) {
            const fileData = uploadedFiles[index];
            if (!fileData) {
                console.error('Documento não encontrado no índice:', index);
                return;
            }

            // Obter idUnico do arquivo (pode estar em idUnico ou idDocumento)
            const idUnico = fileData.idUnico || idDocumento;
            if (!idUnico) {
                console.error('idUnico não fornecido para exclusão');
                showToast('Erro: ID do documento não encontrado', 'error');
                return;
                }

                const idAgente = agenteEditandoId;
                if (!idAgente) {
                    // Se não está editando, apenas remover da visualização sem excluir do servidor
                    console.log('Agente não está sendo editado, removendo apenas da visualização');
                    uploadedFiles.splice(index, 1);
                    renderUploadedFiles();
                    showToast('Documento removido da lista. Para excluir do servidor, edite o agente.', 'info');
                    return;
                }

            // Abrir modal de confirmação
            abrirModalExcluirConhecimento('arquivo', index, idUnico, fileData.name);
        }

        function renderConhecimentosLista() {
            // Função mantida para compatibilidade, mas não faz mais nada
            // pois a seção "Conhecimentos Adicionados" foi removida
        }

        // ===== FUNÇÕES DE CARREGAMENTO DE CONEXÕES =====
        async function carregarConexoes() {
            const whatsappSelect = document.getElementById('whatsappSelect');
            whatsappSelect.innerHTML = '<option value="">Carregando conexões...</option>';
            
            try {
                let contaId;
                try {
                    contaId = await obterUserIdComStatus();
                } catch (error) {
                    if (error.message === 'STATUS_BLOQUEADO') {
                        return;
                    }
                    throw error;
                }
                if (!contaId) {
                    throw new Error('ID do usuário não encontrado');
                }

                const { data: rawConnectionsData, error: conexoesError } = await window.supabase
                    .from('SAAS_Conexões')
                    .select('id, "instanceName", "NomeConexao", "Apikey"')
                    .eq('contaId', contaId)
                    .order('created_at', { ascending: false });

                if (conexoesError) {
                    throw new Error(conexoesError.message || 'Erro ao carregar conexões');
                }

                const rawConnections = Array.isArray(rawConnectionsData) ? rawConnectionsData : [];

                connections = rawConnections
                    .filter(conn => (conn.instanceName || conn.instance_name) && (conn.NomeConexao || conn.nomeConexao || conn.name))
                    .map(conn => ({
                        ...conn,
                        apikey: conn.Apikey || conn.apikey
                    }));

                // Popular dropdown
                whatsappSelect.innerHTML = '<option value="">Selecione uma conexão...</option>';
                connections.forEach((conn, index) => {
                    const option = document.createElement('option');
                    const nome = conn.NomeConexao || conn.nomeConexao || conn.name || 'Sem nome';
                    // Usar o ID da conexão como valor, não o instanceName
                    const conexaoId = conn.id || conn.Id || conn.ID || conn.instanceName || conn.instance_name;
                    option.value = conexaoId;
                    option.textContent = nome;
                    option.dataset.index = index;
                    whatsappSelect.appendChild(option);
                });

                if (connections.length === 0) {
                    whatsappSelect.innerHTML = '<option value="">Nenhuma conexão disponível</option>';
                }
            } catch (error) {
                console.error('Erro ao carregar conexões:', error);
                
                // Verificar se é um erro de rede
                const isNetworkError = error instanceof TypeError && 
                    (error.message.includes('Failed to fetch') || 
                     error.message.includes('NetworkError') ||
                     error.message.includes('ERR_NETWORK'));
                
                if (isNetworkError) {
                    // Para erros de rede, apenas logar e não mostrar toast (pode ser temporário)
                    console.warn('Erro de rede ao carregar conexões (pode ser temporário):', error);
                    whatsappSelect.innerHTML = '<option value="">Erro de conexão. Tente novamente.</option>';
                } else {
                whatsappSelect.innerHTML = '<option value="">Erro ao carregar conexões</option>';
                showToast('Erro ao carregar conexões', 'error');
                }
            }
            
            // Retornar Promise resolvida para permitir encadeamento
            return Promise.resolve();
        }

        // ===== FUNÇÕES DE CRM =====
        async function carregarQuadrosCRM() {
            const quadroSelect = document.getElementById('crmQuadroSelect');
            if (!quadroSelect) return Promise.resolve();

            quadroSelect.innerHTML = '<option value="">Carregando quadros...</option>';
            
            try {
                let contaId;
                try {
                    contaId = await obterUserIdComStatus();
                } catch (error) {
                    if (error.message === 'STATUS_BLOQUEADO') {
                        return;
                    }
                    throw error;
                }
                if (!contaId) {
                    throw new Error('ID do usuário não encontrado');
                }

                const { data: quadrosArray, error: quadrosError } = await window.supabase
                    .from('SAAS_Quadros')
                    .select('id, nome, descricao, cor, icone')
                    .eq('contaId', contaId)
                    .order('created_at', { ascending: false });

                if (quadrosError) {
                    console.error('Erro ao carregar quadros:', quadrosError);
                    quadroSelect.innerHTML = '<option value="">Erro ao carregar quadros</option>';
                    return Promise.resolve();
                }

                const data = Array.isArray(quadrosArray) ? quadrosArray : [];
                console.log('Quadros carregados do Supabase:', data.length);

                // Popular dropdown
                quadroSelect.innerHTML = '<option value="">Selecione um quadro</option>';
                data.forEach(quadro => {
                    const option = document.createElement('option');
                    option.value = quadro.id || quadro.idQuadro;
                    option.textContent = quadro.nome || 'Sem nome';
                    quadroSelect.appendChild(option);
                });

                if (data.length === 0) {
                    quadroSelect.innerHTML = '<option value="">Nenhum quadro disponível</option>';
                }
                
                return Promise.resolve();
            } catch (error) {
                console.error('Erro ao carregar quadros CRM:', error);
                
                // Verificar se é um erro de rede
                const isNetworkError = error instanceof TypeError && 
                    (error.message.includes('Failed to fetch') || 
                     error.message.includes('NetworkError') ||
                     error.message.includes('ERR_NETWORK'));
                
                if (isNetworkError) {
                    // Para erros de rede, apenas logar e não quebrar o fluxo
                    console.warn('Erro de rede ao carregar quadros (pode ser temporário):', error);
                    quadroSelect.innerHTML = '<option value="">Erro de conexão. Tente novamente.</option>';
                } else {
                quadroSelect.innerHTML = '<option value="">Erro ao carregar quadros</option>';
                }
                
                // Retornar Promise resolvida mesmo em caso de erro para não quebrar o fluxo
                return Promise.resolve();
            }
        }

        async function carregarEtapasCRM() {
            const quadroSelect = document.getElementById('crmQuadroSelect');
            const etapaSelect = document.getElementById('crmEtapaSelect');
            
            if (!quadroSelect || !etapaSelect) return;

            const quadroId = quadroSelect.value;
            
            if (!quadroId) {
                etapaSelect.innerHTML = '<option value="">Selecione primeiro um quadro</option>';
                etapaSelect.disabled = true;
                return;
            }

            etapaSelect.innerHTML = '<option value="">Carregando etapas...</option>';
            etapaSelect.disabled = false;
            
            try {
                let contaId;
                try {
                    contaId = await obterUserIdComStatus();
                } catch (error) {
                    if (error.message === 'STATUS_BLOQUEADO') {
                        return;
                    }
                    throw error;
                }
                if (!contaId) {
                    throw new Error('ID do usuário não encontrado');
                }

                const { data: etapasData, error: etapasError } = await window.supabase
                    .from('VW_SAAS_Etapas_Quadros')
                    .select('"etapaId", "nomeEtapa", "ordemEtapa"')
                    .eq('quadroId', quadroId)
                    .order('ordemEtapa', { ascending: true });

                if (etapasError) {
                    console.error('Erro ao carregar etapas:', etapasError);
                    etapaSelect.innerHTML = '<option value="">Erro ao carregar etapas</option>';
                    return;
                }

                const rawEtapas = Array.isArray(etapasData) ? etapasData : [];
                console.log('Etapas carregadas da view VW_SAAS_Etapas_Quadros:', rawEtapas.length);

                const etapasArray = rawEtapas.map((item, index) => ({
                    id: item.etapaId || item.id,
                    nome: item.nomeEtapa || item.nome || 'Sem nome',
                    ordem: item.ordemEtapa !== null && item.ordemEtapa !== undefined ? item.ordemEtapa : (item.ordem || (index + 1))
                }));

                // Ordenar etapas por ordemEtapa
                etapasArray.sort((a, b) => (a.ordem || 0) - (b.ordem || 0));

                console.log('Etapas carregadas (ordenadas por ordemEtapa):', etapasArray);

                // Popular dropdown
                etapaSelect.innerHTML = '<option value="">Selecione uma etapa</option>';
                etapasArray.forEach(etapa => {
                    const option = document.createElement('option');
                    option.value = etapa.id;
                    option.textContent = etapa.nome;
                    etapaSelect.appendChild(option);
                });

                if (etapasArray.length === 0) {
                    etapaSelect.innerHTML = '<option value="">Nenhuma etapa disponível</option>';
                }
            } catch (error) {
                console.error('Erro ao carregar etapas CRM:', error);
                
                // Verificar se é um erro de rede
                const isNetworkError = error instanceof TypeError && 
                    (error.message.includes('Failed to fetch') || 
                     error.message.includes('NetworkError') ||
                     error.message.includes('ERR_NETWORK'));
                
                if (isNetworkError) {
                    // Para erros de rede, apenas logar
                    console.warn('Erro de rede ao carregar etapas (pode ser temporário):', error);
                    etapaSelect.innerHTML = '<option value="">Erro de conexão. Tente novamente.</option>';
                } else {
                etapaSelect.innerHTML = '<option value="">Erro ao carregar etapas</option>';
            }
        }
        }

        // Formatar valor monetário
        function formatarValorAgente(input) {
            const valor = input.value;
            const valorFormatado = formatarValor(valor);
            input.value = valorFormatado;
        }

        // Função para formatar valor (mesma da página crm-etapas)
        function formatarValor(value) {
            // Remove tudo que não é dígito
            const apenasNumeros = value.replace(/\D/g, '');
            
            if (apenasNumeros === '') return '';
            
            // Converte para número e divide por 100 para ter centavos
            const valor = parseFloat(apenasNumeros) / 100;
            
            // Formata com vírgula para decimais e adiciona separador de milhares
            const valorFormatado = valor.toFixed(2).replace('.', ',');
            const partes = valorFormatado.split(',');
            partes[0] = partes[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            
            return 'R$ ' + partes.join(',');
        }

        // Converter valor formatado para número
        function valorParaNumero(valorFormatado) {
            if (!valorFormatado) return null;
            // Remove R$, espaços, pontos (separadores de milhares) e substitui vírgula por ponto
            const valor = valorFormatado.replace('R$', '').replace(/\s/g, '').replace(/\./g, '').replace(',', '.');
            return parseFloat(valor) || null;
        }

        // Adicionar tarefa padrão
        function adicionarTarefaPadrao() {
            const container = document.getElementById('crmTarefasPadraoContainer');
            if (!container) return;
            
            const tarefaDiv = document.createElement('div');
            tarefaDiv.className = 'tarefa-item';
            tarefaDiv.style.cssText = 'display: flex; gap: 8px; margin-bottom: 8px; align-items: center;';
            tarefaDiv.innerHTML = `
                <input type="text" placeholder="Descrição" class="tarefa-descricao" style="flex: 1; padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(255, 255, 255, 0.05); color: rgba(255, 255, 255, 0.9); font-size: 0.875rem;">
                <input type="date" class="tarefa-data" style="padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(255, 255, 255, 0.05); color: rgba(255, 255, 255, 0.9); font-size: 0.875rem;">
                <button type="button" class="btn-remove-tarefa" onclick="this.parentElement.remove()" style="background: rgba(255, 59, 48, 0.1); border: 1px solid rgba(255, 59, 48, 0.3); border-radius: 6px; padding: 8px; color: #ff3b30; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(255, 59, 48, 0.2)'" onmouseout="this.style.background='rgba(255, 59, 48, 0.1)'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            `;
            container.appendChild(tarefaDiv);
        }

        // ===== MAPEAMENTO DE MODELOS =====
        const modelosIA = {
            'gpt-5-nano': {
                nome: 'GPT-5 nano',
                descricao: 'Modelo mais leve e econômico do GPT-5',
                consumo: '0.20x',
                multiplicador: 0.20,
                minCreditos: 1
            },
            'gpt-5-mini': {
                nome: 'GPT-5 mini',
                descricao: 'Versão mais rápida e mais barata do GPT-5, para tarefas com escopo delimitado',
                consumo: '1.00x',
                multiplicador: 1.00,
                minCreditos: 1
            },
            'gpt-5': {
                nome: 'GPT-5',
                descricao: 'O melhor modelo para tarefas agênticas e de programação — em qualquer setor',
                consumo: '5.00x',
                multiplicador: 5.00,
                minCreditos: 5
            },
            'gpt-4.1-nano': {
                nome: 'GPT-4.1 nano',
                descricao: 'Modelo mais leve e econômico do GPT-4.1',
                consumo: '0.22x',
                multiplicador: 0.22,
                minCreditos: 1
            },
            'gpt-4.1-mini': {
                nome: 'GPT-4.1 mini',
                descricao: 'Versão compacta do GPT-4.1 para tarefas simples',
                consumo: '0.89x',
                multiplicador: 0.89,
                minCreditos: 1
            },
            'gpt-4.1': {
                nome: 'GPT-4.1',
                descricao: 'Modelo GPT-4.1 com excelente desempenho',
                consumo: '4.44x',
                multiplicador: 4.44,
                minCreditos: 4
            },
            'gpt-4o-mini': {
                nome: 'GPT-4o mini',
                descricao: 'Versão otimizada e compacta do GPT-4o',
                consumo: '0.33x',
                multiplicador: 0.33,
                minCreditos: 1
            },
            'gpt-4o': {
                nome: 'GPT-4o',
                descricao: 'Modelo GPT-4o otimizado com alto desempenho',
                consumo: '5.56x',
                multiplicador: 5.56,
                minCreditos: 6
            }
        };

        // ===== FUNÇÕES DE CRIATIVIDADE =====
        document.getElementById('criatividadeSlider').addEventListener('input', function(e) {
            const value = parseFloat(e.target.value).toFixed(1);
            document.getElementById('criatividadeValue').textContent = value;
        });

        // ===== FUNÇÕES DE MODELO DE IA =====
        document.getElementById('modeloIASelect').addEventListener('change', function(e) {
            const modeloId = e.target.value;
            const modeloExplanation = document.getElementById('modeloExplanation');
            const modeloFerramentasAviso = document.getElementById('modeloFerramentasAviso');
            
            if (modeloId && modelosIA[modeloId]) {
                const modelo = modelosIA[modeloId];
                modeloExplanation.innerHTML = `
                    <div style="display: inline-block; margin-right: 10px;">${modelo.descricao}</div>
                    <div class="consumo-tag" style="display: inline-block; margin-left: 0;">Consumo: ${modelo.consumo}</div>
                `;
                modeloExplanation.classList.add('show');
            } else {
                modeloExplanation.classList.remove('show');
                modeloExplanation.innerHTML = '';
            }
            if (modeloFerramentasAviso) {
                const naoAtivaFerramentas = (modeloId === 'gpt-5-nano' || modeloId === 'gpt-4.1-nano');
                modeloFerramentasAviso.classList.toggle('hidden', !naoAtivaFerramentas);
            }
        });

        // ===== FUNÇÕES DE UPLOAD DE ARQUIVOS =====
        function handleFileSelect(event) {
            const files = Array.from(event.target.files);
            files.forEach(file => {
                // Validar tipo de arquivo
                const validTypes = ['application/pdf', 'text/plain', 'text/csv'];
                const validExtensions = ['.pdf', '.txt', '.csv'];
                const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
                
                if (!validExtensions.includes(fileExtension)) {
                    showToast(`Arquivo ${file.name} não é um formato válido (PDF, TXT ou CSV)`, 'error');
                    return;
                }
                
                // Validar tamanho (10MB)
                if (file.size > 10 * 1024 * 1024) {
                    showToast(`Arquivo ${file.name} excede o tamanho máximo de 10MB`, 'error');
                    return;
                }
                
                // Gerar ID único para o documento
                const idUnico = 'doc_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                
                // Adicionar arquivo à lista com ID único
                uploadedFiles.push({
                    file: file,
                    name: file.name,
                    size: file.size,
                    type: file.type,
                    idUnico: idUnico
                });
            });
            
            renderUploadedFiles();
            event.target.value = ''; // Limpar input para permitir selecionar o mesmo arquivo novamente
        }

        function renderUploadedFiles() {
            const uploadedFilesList = document.getElementById('uploadedFilesList');
            
            if (uploadedFiles.length === 0) {
                if (uploadedFilesList) uploadedFilesList.classList.remove('show');
                return;
            }
            
            if (uploadedFilesList) {
                uploadedFilesList.classList.add('show');
                uploadedFilesList.innerHTML = '';
                
                uploadedFiles.forEach((fileData, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'uploaded-file-item';
                    
                    const fileIcon = getFileIcon(fileData.type);
                    const fileSize = formatFileSize(fileData.size);
                    const badgeExiste = fileData.jaExiste ? '<span style="margin-left: 8px; padding: 2px 8px; background: rgba(108, 99, 255, 0.2); color: #6C63FF; border-radius: 4px; font-size: 0.75rem;">Já existe</span>' : '';
                    let botaoRemover = '';
                    if (fileData.jaExiste && fileData.idDocumento) {
                        // Documento existe no servidor - botão de excluir do servidor
                        const idUnicoOuDoc = String(fileData.idUnico || fileData.idDocumento || '').replace(/'/g, "\\'");
                        botaoRemover = `<button class="file-remove-btn" onclick="excluirDocumento(${index}, '${idUnicoOuDoc}')" style="padding: 8px; min-width: auto; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;" title="Excluir do servidor">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3,6 5,6 21,6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </button>`;
                    } else if (!fileData.jaExiste) {
                        // Documento novo - botão de remover local
                        botaoRemover = `<button class="file-remove-btn" onclick="removerArquivo(${index})">Remover</button>`;
                    }
                    
                    fileItem.innerHTML = `
                        <div class="uploaded-file-info">
                            <svg class="file-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                ${fileIcon}
                            </svg>
                            <span class="file-name">${fileData.name}</span>
                            <span class="file-size">${fileSize}</span>
                            ${badgeExiste}
                        </div>
                        ${botaoRemover}
                    `;
                    
                    uploadedFilesList.appendChild(fileItem);
                });
            }
            
            renderConhecimentosLista();
        }

        function getFileIcon(fileType) {
            if (fileType === 'application/pdf') {
                return '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14,2 14,8 20,8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>';
            } else {
                return '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14,2 14,8 20,8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>';
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        function removerArquivo(index) {
            uploadedFiles.splice(index, 1);
            renderUploadedFiles();
        }

        // ===== FUNÇÃO PARA ENVIAR ARQUIVOS DE CONHECIMENTO =====
        async function enviarArquivosConhecimento(files, idAgente, contaId) {
            if (!files || files.length === 0) {
                console.log('Nenhum arquivo para enviar');
                return;
            }

            if (!idAgente || !contaId) {
                console.error('idAgente ou contaId não fornecidos');
                throw new Error('idAgente ou contaId não fornecidos');
            }

            const resultados = [];
            const erros = [];

            for (let i = 0; i < files.length; i++) {
                const fileData = files[i];
                const file = fileData.file || fileData;
                
                // Pular arquivos que já existem no servidor
                if (fileData.jaExiste) {
                    console.log(`Arquivo ${i + 1} (${fileData.name}) já existe no servidor, pulando upload...`);
                    continue;
                }
                
                if (!file) {
                    console.warn(`Arquivo ${i + 1} não encontrado, pulando...`);
                    continue;
                }

                try {
                    // Criar FormData com o arquivo
                    const formData = new FormData();
                    formData.append('file', file);
                    formData.append('userId', contaId);
                    formData.append('idAgente', idAgente);
                    
                    // Adicionar idUnico se existir
                    if (fileData.idUnico) {
                        formData.append('idUnico', fileData.idUnico);
                    }

                    console.log(`Enviando arquivo ${i + 1}/${files.length}: ${file.name}`, {
                        fileName: file.name,
                        fileSize: file.size,
                        fileType: file.type,
                        idAgente: idAgente,
                        contaId: contaId
                    });

                    const response = await fetch('/hublabel/public/inserir-conhecimento', {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        const errorText = await response.text();
                        throw new Error(`Erro ao enviar arquivo ${file.name}: ${response.status} - ${errorText}`);
                    }

                    const responseData = await response.json();
                    console.log(`✅ Arquivo ${file.name} enviado com sucesso:`, responseData);
                    resultados.push({ arquivo: file.name, sucesso: true });

                } catch (error) {
                    console.error(`❌ Erro ao enviar arquivo ${file.name}:`, error);
                    erros.push({ arquivo: file.name, erro: error.message });
                }
            }

            // Log dos resultados
            if (resultados.length > 0) {
                console.log(`✅ ${resultados.length} arquivo(s) enviado(s) com sucesso`);
            }

            if (erros.length > 0) {
                console.error(`❌ ${erros.length} arquivo(s) falharam:`, erros);
                // Se houver erros, lançar exceção para ser tratada no catch
                throw new Error(`Falha ao enviar ${erros.length} arquivo(s)`);
            }

            return resultados;
        }

        // Drag and Drop
        const fileUploadArea = document.getElementById('fileUploadArea');
        
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });
        
        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
        });
        
        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            
            const files = Array.from(e.dataTransfer.files);
            files.forEach(file => {
                const validExtensions = ['.pdf', '.txt', '.csv'];
                const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
                
                if (!validExtensions.includes(fileExtension)) {
                    showToast(`Arquivo ${file.name} não é um formato válido (PDF, TXT ou CSV)`, 'error');
                    return;
                }
                
                if (file.size > 10 * 1024 * 1024) {
                    showToast(`Arquivo ${file.name} excede o tamanho máximo de 10MB`, 'error');
                    return;
                }
                
                uploadedFiles.push({
                    file: file,
                    name: file.name,
                    size: file.size,
                    type: file.type
                });
            });
            
            renderUploadedFiles();
        });

        // ===== FUNÇÕES DE CRIAÇÃO =====
        async function criarAgente() {
            let contaId;
            try {
                contaId = await obterUserIdComStatus();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return;
                }
                throw error;
            }
            if (!contaId) {
                showToast('Sessão inválida. Faça login novamente.', 'error');
                return;
            }

            const nomeInput = document.getElementById('nomeAgenteInput');
            const corInput = document.getElementById('corAgenteInput');
            const whatsappSelect = document.getElementById('whatsappSelect');
            const instrucoesEditor = document.getElementById('instrucoesAgenteInput');
            const modeloIASelect = document.getElementById('modeloIASelect');
            const criatividadeSlider = document.getElementById('criatividadeSlider');
            const btnCriar = document.getElementById('btnCriarAgente');
            const ouvirAudioSwitch = document.getElementById('ouvirAudioSwitch');
            const analisarImagensSwitch = document.getElementById('analisarImagensSwitch');
            const aparecerDigitandoSwitch = document.getElementById('aparecerDigitandoSwitch');
            const pausarAgenteAtendimentoSwitch = document.getElementById('pausarAgenteAtendimentoSwitch');
            const quantidadeMensagensHistoricoInput = document.getElementById('quantidadeMensagensHistoricoInput');
            const agruparMensagensSwitch = document.getElementById('agruparMensagensSwitch');
            const intervaloAgruparMensagensInput = document.getElementById('intervaloAgruparMensagensInput');

            const nome = nomeInput.value.trim();
            const cor = corInput ? corInput.value : '#6C63FF';
            const conexaoId = whatsappSelect.value;
            const instrucoesHTML = instrucoesEditor.innerHTML.trim();
            const modelo = modeloIASelect.value;
            const criatividade = parseFloat(criatividadeSlider.value);
            const ouvirAudio = ouvirAudioSwitch.checked;
            const analisarImagens = analisarImagensSwitch.checked;
            const aparecerDigitando = aparecerDigitandoSwitch.checked;
            const pausarAtendimento = pausarAgenteAtendimentoSwitch ? pausarAgenteAtendimentoSwitch.checked : false;
            const quantidadeMensagensHistorico = quantidadeMensagensHistoricoInput ? parseInt(quantidadeMensagensHistoricoInput.value) || 20 : 20;
            const agruparMensagens = agruparMensagensSwitch ? agruparMensagensSwitch.checked : false;
            const intervaloAgruparMensagens = intervaloAgruparMensagensInput ? parseInt(intervaloAgruparMensagensInput.value) || 10 : 10;

            // Validações
            if (!nome) {
                showToast('Por favor, preencha o nome do agente.', 'error');
                return;
            }

            if (nome.length < 3) {
                showToast('O nome do agente deve ter no mínimo 3 caracteres.', 'error');
                return;
            }

            if (!conexaoId) {
                showToast('Por favor, selecione uma conexão WhatsApp.', 'error');
                return;
            }

            // Converter instruções de HTML para Markdown para validação
            const instrucoesMarkdown = htmlParaMarkdown(instrucoesHTML);
            const instrucoesTexto = instrucoesMarkdown.trim();

            if (!instrucoesTexto) {
                showToast('Por favor, preencha as instruções do agente.', 'error');
                return;
            }

            if (instrucoesTexto.length < 50) {
                showToast('As instruções do agente devem ter no mínimo 50 caracteres.', 'error');
                return;
            }

            if (!modelo) {
                showToast('Por favor, selecione um modelo de IA.', 'error');
                return;
            }

            if (!validarFerramentasAtivas()) {
                return;
            }

            // Instruções já convertidas acima para validação
            const instrucoes = instrucoesMarkdown;

            // Desabilitar botão e mostrar loading
            btnCriar.disabled = true;
            const isEditing = agenteEditandoId !== null;
            btnCriar.innerHTML = `
                <div class="loading-spinner-small"></div>
                ${isEditing ? 'Salvando...' : 'Criando...'}
            `;

            try {
                // Buscar instanceName da conexão selecionada
                let instanceName = null;
                console.log('Buscando instanceName para conexaoId:', conexaoId);
                console.log('Array connections disponível:', connections ? connections.length : 0);
                
                if (conexaoId && connections && connections.length > 0) {
                    // Tentar encontrar a conexão por diferentes campos
                    const conexaoSelecionada = connections.find(conn => {
                        const connId = conn.id || conn.Id || conn.ID;
                        const connInstanceName = conn.instanceName || conn.instance_name;
                        
                        // Comparar por ID ou por instanceName (o value do select pode ser qualquer um)
                        const conexaoIdStr = String(conexaoId).trim();
                        return (connId && String(connId).trim() === conexaoIdStr) ||
                               (connInstanceName && String(connInstanceName).trim() === conexaoIdStr);
                    });
                    
                    console.log('Conexão encontrada:', conexaoSelecionada);
                    
                    if (conexaoSelecionada) {
                        instanceName = conexaoSelecionada.instanceName || conexaoSelecionada.instance_name || null;
                        console.log('InstanceName encontrado:', instanceName);
                    } else {
                        console.warn('Conexão não encontrada no array connections');
                        console.log('Tentando buscar todas as conexões:', connections.map(c => ({
                            id: c.id || c.Id || c.ID,
                            instanceName: c.instanceName || c.instance_name
                        })));
                        
                        // Se não encontrou, pode ser que o conexaoId já seja o instanceName
                        // Verificar se algum connection tem esse instanceName
                        const conexaoPorInstanceName = connections.find(conn => {
                            const connInstanceName = conn.instanceName || conn.instance_name;
                            return connInstanceName && String(connInstanceName).trim() === String(conexaoId).trim();
                        });
                        
                        if (conexaoPorInstanceName) {
                            instanceName = conexaoPorInstanceName.instanceName || conexaoPorInstanceName.instance_name;
                            console.log('InstanceName encontrado por busca direta:', instanceName);
                        } else {
                            // Último recurso: usar o próprio conexaoId como instanceName se parecer ser um
                            if (String(conexaoId).includes('@') || String(conexaoId).length > 10) {
                                instanceName = String(conexaoId).trim();
                                console.log('Usando conexaoId como instanceName (fallback):', instanceName);
                            }
                        }
                    }
                } else {
                    console.warn('Não foi possível buscar instanceName - conexaoId:', conexaoId, 'connections:', connections);
                    // Se não encontrou e conexaoId existe, usar como fallback
                    if (conexaoId) {
                        instanceName = String(conexaoId).trim();
                        console.log('Usando conexaoId como instanceName (fallback final):', instanceName);
                    }
                }
                
                // Buscar dados do CRM
                const crmQuadroSelect = document.getElementById('crmQuadroSelect');
                const crmEtapaSelect = document.getElementById('crmEtapaSelect');
                const crmValorPadraoInput = document.getElementById('crmValorPadraoInput');
                const crmObservacaoPadraoInput = document.getElementById('crmObservacaoPadraoInput');
                const crmTarefasPadraoContainer = document.getElementById('crmTarefasPadraoContainer');
                
                const crmQuadroId = crmQuadroSelect ? crmQuadroSelect.value : null;
                const crmEtapaId = crmEtapaSelect ? crmEtapaSelect.value : null;
                const crmValorPadraoFormatado = crmValorPadraoInput ? crmValorPadraoInput.value.trim() : '';
                const crmValorPadrao = crmValorPadraoFormatado ? valorParaNumero(crmValorPadraoFormatado) : null;
                const crmObservacaoPadrao = crmObservacaoPadraoInput ? crmObservacaoPadraoInput.value.trim() : null;
                
                // Coletar tarefas padrão do container
                const crmTarefasPadrao = [];
                if (crmTarefasPadraoContainer) {
                    crmTarefasPadraoContainer.querySelectorAll('.tarefa-item').forEach(item => {
                        const descricao = item.querySelector('.tarefa-descricao') ? item.querySelector('.tarefa-descricao').value.trim() : '';
                        const data = item.querySelector('.tarefa-data') ? item.querySelector('.tarefa-data').value : '';
                        if (descricao) {
                            crmTarefasPadrao.push({ descricao, data: data || null, concluida: false });
                        }
                    });
                }
                
                // Coletar ferramentas (abrirAtendimento, notificarHumano, requisicaoHTTP)
                const abrirAtendimento = coletarAbrirAtendimento();
                const notificarHumano = coletarNotificarHumano();
                const requisicaoHTTP = coletarRequisicaoHttp();

                // Preparar dados do agente
                const agenteData = {
                    contaId,
                    nome,
                    cor: cor || '#6C63FF',
                    conexaoId,
                    instanceName: instanceName || conexaoId || null,
                    instrucoes,
                    modelo,
                    criatividade,
                    ouvirAudio: ouvirAudio || false,
                    analisarImagens: analisarImagens || false,
                    aparecerDigitando: aparecerDigitando || false,
                    pausarAtendimento: pausarAtendimento || false,
                    quantidadeMensagensHistorico: quantidadeMensagensHistorico,
                    agruparMensagens: agruparMensagens || false,
                    intervaloAgruparMensagens: intervaloAgruparMensagens || 10,
                    conhecimento: [
                        // Incluir todos os arquivos (novos e existentes)
                        ...uploadedFiles.filter(f => f.name).map(f => ({
                            tipo: 'arquivo',
                            nome: f.name,
                            tamanho: f.size || 0,
                            idUnico: f.idUnico || null
                        }))
                    ],
                    CRM: (crmQuadroId || crmEtapaId) ? {
                        idCRM: crmQuadroId || null,
                        idEtapa: crmEtapaId || null,
                        valorPadrao: crmValorPadrao || null,
                        observacaoPadrao: crmObservacaoPadrao || null,
                        tarefasPadrao: crmTarefasPadrao.length > 0 ? crmTarefasPadrao : null
                    } : null,
                    abrirAtendimento: abrirAtendimento || (isEditing && window.agenteEmEdicaoFerramentas?.abrirAtendimento && typeof window.agenteEmEdicaoFerramentas.abrirAtendimento === 'object' ? { ...window.agenteEmEdicaoFerramentas.abrirAtendimento, ativo: false } : null),
                    notificarHumano: notificarHumano || (isEditing && window.agenteEmEdicaoFerramentas?.notificarHumano && typeof window.agenteEmEdicaoFerramentas.notificarHumano === 'object' ? { ...window.agenteEmEdicaoFerramentas.notificarHumano, ativo: false } : null),
                    requisicaoHTTP: requisicaoHTTP || (isEditing && window.agenteEmEdicaoFerramentas?.requisicaoHTTP && typeof window.agenteEmEdicaoFerramentas.requisicaoHTTP === 'object' ? { ...window.agenteEmEdicaoFerramentas.requisicaoHTTP, ativo: false } : null)
                };

                // Se está editando, adicionar idAgente do agente e usar endpoint de edição
                if (isEditing) {
                    agenteData.idAgente = agenteEditandoId;
                    
                    // Buscar estado ativo do agente sendo editado
                    const agentes = window.agentesData || [];
                    const agenteEditando = agentes.find(a => (a.id == agenteEditandoId || a.idAgente == agenteEditandoId));
                    const isActive = agenteEditando && agenteEditando.ativo !== undefined ? agenteEditando.ativo : true;
                    
                    // Adicionar campo ativo (bool) no body da requisição
                    agenteData.ativo = isActive === true || isActive === 'true' || isActive === 1;
                    
                }

                const payload = {
                    contaId,
                    nome,
                    cor: cor || '#6C63FF',
                    conexaoId: conexaoId || null,
                    instrucoes,
                    modelo,
                    criatividade,
                    ouvirAudio: ouvirAudio || false,
                    analisarImagens: analisarImagens || false,
                    aparecerDigitando: aparecerDigitando || false,
                    pausarAtendimento: pausarAtendimento || false,
                    qntMsgHistorico: quantidadeMensagensHistorico,
                    agruparMensagens: agruparMensagens || false,
                    intervaloEntreMensagens: intervaloAgruparMensagens || 10,
                    conhecimento: agenteData.conhecimento,
                    CRM: agenteData.CRM,
                    abrirAtendimento: agenteData.abrirAtendimento,
                    notificarHumano: agenteData.notificarHumano,
                    requisicaoHTTP: agenteData.requisicaoHTTP
                };

                console.log('Dados do agente (Supabase):', JSON.stringify(payload, null, 2));

                let idAgente;

                if (isEditing) {
                    const { data: updateData, error: updateError } = await window.supabase
                        .from('SAAS_AgentesIA')
                        .update({
                            nome: payload.nome,
                            cor: payload.cor,
                            conexaoId: payload.conexaoId,
                            instrucoes: payload.instrucoes,
                            modelo: payload.modelo,
                            criatividade: payload.criatividade,
                            ouvirAudio: payload.ouvirAudio,
                            analisarImagens: payload.analisarImagens,
                            aparecerDigitando: payload.aparecerDigitando,
                            pausarAtendimento: payload.pausarAtendimento,
                            qntMsgHistorico: payload.qntMsgHistorico,
                            agruparMensagens: payload.agruparMensagens,
                            intervaloEntreMensagens: payload.intervaloEntreMensagens,
                            conhecimento: payload.conhecimento,
                            CRM: payload.CRM,
                            abrirAtendimento: payload.abrirAtendimento,
                            notificarHumano: payload.notificarHumano,
                            requisicaoHTTP: payload.requisicaoHTTP,
                            ativo: agenteData.ativo !== undefined ? agenteData.ativo : true
                        })
                        .eq('id', agenteEditandoId)
                        .select('id')
                        .maybeSingle();

                    if (updateError) throw new Error(updateError.message || 'Erro ao editar agente');
                    idAgente = updateData?.id ?? agenteEditandoId;
                } else {
                    const { data: insertData, error: insertError } = await window.supabase
                        .from('SAAS_AgentesIA')
                        .insert({
                            contaId: contaId,
                            nome: payload.nome,
                            cor: payload.cor,
                            conexaoId: payload.conexaoId,
                            instrucoes: payload.instrucoes,
                            modelo: payload.modelo,
                            criatividade: payload.criatividade,
                            ouvirAudio: payload.ouvirAudio,
                            analisarImagens: payload.analisarImagens,
                            aparecerDigitando: payload.aparecerDigitando,
                            pausarAtendimento: payload.pausarAtendimento,
                            qntMsgHistorico: payload.qntMsgHistorico,
                            agruparMensagens: payload.agruparMensagens,
                            intervaloEntreMensagens: payload.intervaloEntreMensagens,
                            conhecimento: payload.conhecimento,
                            CRM: payload.CRM,
                            abrirAtendimento: payload.abrirAtendimento,
                            notificarHumano: payload.notificarHumano,
                            requisicaoHTTP: payload.requisicaoHTTP,
                            ativo: true
                        })
                        .select('id')
                        .single();

                    if (insertError) {
                        if (insertError.code === 'PGRST116' || (insertError.message && insertError.message.toLowerCase().includes('limit'))) {
                            fecharModalCriarAgente();
                            setTimeout(() => showToast('Limite atingido. Verifique seu plano nas configurações', 'info'), 100);
                            return;
                        }
                        throw new Error(insertError.message || 'Erro ao criar agente');
                    }
                    idAgente = insertData?.id;
                }
                console.log('idAgente obtido para envio de arquivos:', idAgente);
                
                // Se há arquivos para upload e temos idAgente, enviar os arquivos
                if (uploadedFiles.length > 0 && idAgente) {
                    try {
                        console.log(`Iniciando envio de ${uploadedFiles.length} arquivo(s) de conhecimento...`);
                        await enviarArquivosConhecimento(uploadedFiles, idAgente, contaId);
                        console.log('Todos os arquivos foram enviados com sucesso');
                    } catch (uploadError) {
                        console.error('Erro ao enviar arquivos de conhecimento:', uploadError);
                        // Continuar mesmo se houver erro no upload de arquivos, mas mostrar aviso
                        showToast(`Agente ${isEditing ? 'editado' : 'criado'} com sucesso, mas houve erro ao enviar alguns arquivos.`, 'error');
                    }
                } else {
                    if (uploadedFiles.length > 0) {
                        console.warn('Arquivos selecionados mas idAgente não disponível:', { idAgente, uploadedFilesCount: uploadedFiles.length });
                    }
                }

                // Verificar se precisa fazer requisição ao webhook do WhatsApp
                const whatsappMudou = isEditing ? (conexaoId !== conexaoAntigaId) : true;
                
                if (whatsappMudou && conexaoId && idAgente) {
                    try {
                        const { error: updateErr } = await window.supabase
                            .from('SAAS_Conexões')
                            .update({ idAgente: idAgente })
                            .eq('id', conexaoId)
                            .eq('contaId', contaId);
                        if (updateErr) throw updateErr;
                        console.log('Conexão (SAAS_Conexões.idAgente) atualizada com sucesso');
                    } catch (whatsappError) {
                        console.error('Erro ao atualizar idAgente na conexão:', whatsappError);
                    }
                }

                // Sucesso
                fecharModalCriarAgente();
                showToast(`Agente ${isEditing ? 'editado' : 'criado'} com sucesso!`, 'success');
                // Recarregar a lista de agentes
                carregarAgentes();
            } catch (error) {
                console.error(`Erro ao ${isEditing ? 'editar' : 'criar'} agente:`, error);
                showToast(`Erro ao ${isEditing ? 'editar' : 'criar'} agente. Tente novamente.`, 'error');
            } finally {
                btnCriar.disabled = false;
                btnCriar.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    ${isEditing ? 'Salvar Agente' : 'Criar Agente'}
                `;
            }
        }

        // Sidebar: expandir só quando o mouse está na faixa de 70px (evita abrir "perto" do menu)
        (function() {
            var sidebarCollapseTimer = null;
            var SIDEBAR_EDGE = 70;
            var SIDEBAR_EXPANDED_WIDTH = 250;
            var COLLAPSE_DELAY_MS = 120;
            document.addEventListener('mousemove', function(e) {
                if (window.matchMedia('(max-width: 768px)').matches) return;
                var sidebar = document.querySelector('.sidebar');
                if (!sidebar || sidebar.classList.contains('mobile-open')) return;
                var x = e.clientX;
                if (x < SIDEBAR_EDGE) {
                    if (sidebarCollapseTimer) { clearTimeout(sidebarCollapseTimer); sidebarCollapseTimer = null; }
                    sidebar.classList.add('sidebar-expanded');
                } else if (x > SIDEBAR_EXPANDED_WIDTH) {
                    if (sidebarCollapseTimer) return;
                    sidebarCollapseTimer = setTimeout(function() {
                        sidebar.classList.remove('sidebar-expanded');
                        sidebarCollapseTimer = null;
                    }, COLLAPSE_DELAY_MS);
                } else {
                    if (sidebarCollapseTimer) { clearTimeout(sidebarCollapseTimer); sidebarCollapseTimer = null; }
                }
            });
        })();

        // ===== FUNÇÕES MOBILE =====
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('active');
        }

        function closeMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        }

        // ===== FUNÇÕES DE RENDERIZAÇÃO DE AGENTES =====
        function renderizarAgentes(agentes) {
            const agentesGrid = document.getElementById('agentesGrid');
            const emptyState = document.getElementById('emptyState');
            
            // Sempre mostrar o grid (mesmo sem agentes, terá o card de criar)
            agentesGrid.style.display = 'grid';
            emptyState.style.display = 'none';
            agentesGrid.innerHTML = '';
            
            // Renderizar agentes se existirem
            if (agentes && agentes.length > 0) {
                // Ordenar agentes por created_at (mais antigo primeiro)
                const agentesOrdenados = [...agentes].sort((a, b) => {
                    const createdA = a.created_at || a.createdAt || a.created || a.id || 0;
                    const createdB = b.created_at || b.createdAt || b.created || b.id || 0;
                    
                    // Se ambos são strings de data, converter para Date
                    if (typeof createdA === 'string' && typeof createdB === 'string') {
                        return new Date(createdA) - new Date(createdB);
                    }
                    
                    // Se são números (IDs), ordenar do menor para o maior
                    if (typeof createdA === 'number' && typeof createdB === 'number') {
                        return createdA - createdB;
                    }
                    
                    // Fallback: comparar como strings
                    return String(createdA).localeCompare(String(createdB));
                });
                
                agentesOrdenados.forEach(agente => {
                    const card = document.createElement('div');
                    card.className = 'agente-card';
                    card.dataset.agenteId = agente.id;
                
                // Ajustar campos conforme resposta da API
                let modeloNome = agente.modelo || 'Modelo desconhecido';
                if (typeof modelosIA !== 'undefined' && modelosIA[agente.modelo]) {
                    modeloNome = modelosIA[agente.modelo].nome || modeloNome;
                }
                const isActive = agente.ativo !== undefined ? agente.ativo : true; // Usar campo 'ativo' da API
                
                // Buscar nome da conexão pelo conexaoId
                let conexaoNome = `Conexão ${agente.conexaoId}`;
                if (typeof connections !== 'undefined' && Array.isArray(connections)) {
                    const conexao = connections.find(conn => {
                        const connId = conn.id || conn.Id || conn.ID;
                        return connId && connId == agente.conexaoId;
                    });
                    if (conexao) {
                        conexaoNome = conexao.NomeConexao || conexao.nomeConexao || conexao.name || conexaoNome;
                    }
                }
                
                // Definir subtítulo baseado na conexão (Conexão: 123)
                const subtitulo = conexaoNome ? `Conexão: ${conexaoNome}` : 'Agente IA';
                
                // Obter cor do agente ou usar cor padrão
                const corAgente = agente.cor || '#6C63FF';
                
                // Converter cor hex para RGB para calcular sombra
                const hexToRgb = (hex) => {
                    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                    return result ? {
                        r: parseInt(result[1], 16),
                        g: parseInt(result[2], 16),
                        b: parseInt(result[3], 16)
                    } : null;
                };
                
                const rgb = hexToRgb(corAgente);
                const boxShadow = rgb ? `0 4px 12px rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, 0.3)` : '0 4px 12px rgba(108, 99, 255, 0.3)';
                
                // Doc: conhecimento (arquivos+qa), instrucoesArquivos ou qntDocumentos
                let qntDoc = 0;
                if (agente.conhecimento && Array.isArray(agente.conhecimento)) {
                    qntDoc = agente.conhecimento.length;
                } else if (agente.instrucoesArquivos && Array.isArray(agente.instrucoesArquivos)) {
                    qntDoc = agente.instrucoesArquivos.length;
                } else {
                    qntDoc = agente.qntDocumentos ?? agente.qnt_documentos ?? 0;
                }
                // Ferramentas: se abrirAtendimento, notificarHumano ou requisicaoHTTP tiver algum controle, conta 1 cada
                let qntFerramentas = 0;
                if (agente.ferramentas && Array.isArray(agente.ferramentas)) {
                    qntFerramentas = agente.ferramentas.filter(f => f && f.ativo !== false).length;
                } else {
                    const temControle = (x) => x && (x.ativo === true || x.ativo === 'true' || (x.itens && Array.isArray(x.itens) && x.itens.length > 0) || x.quandoAtivar != null || x.modeloMensagem || x.curl);
                    const abr = agente.abrirAtendimento || agente.abrir_atendimento;
                    const notif = agente.notificarHumano || agente.notificar_humano;
                    const req = agente.requisicaoHTTP || agente.requisicao_http;
                    if (temControle(abr)) qntFerramentas += 1;
                    if (temControle(notif)) qntFerramentas += 1;
                    if (temControle(req)) qntFerramentas += 1;
                    if (qntFerramentas === 0) qntFerramentas = agente.qntFerramentas ?? agente.qnt_ferramentas ?? 0;
                }
                const dtCriado = agente.created_at || agente.createdAt || agente.created;
                let textoAtualizado = '—';
                if (dtCriado) {
                    const d = new Date(dtCriado);
                    if (!isNaN(d.getTime())) {
                        const dia = String(d.getDate()).padStart(2, '0');
                        const mes = String(d.getMonth() + 1).padStart(2, '0');
                        const ano = d.getFullYear();
                        textoAtualizado = `Criado em ${dia}/${mes}/${ano}`;
                    }
                }
                
                card.innerHTML = `
                    <div class="agente-card-header-section">
                        <div class="agente-card-top">
                            <div class="agente-card-avatar-wrapper">
                                <div class="agente-card-icon" style="background: ${corAgente}; box-shadow: ${boxShadow};">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        <path d="M12 15v.01"></path>
                                        <circle cx="9" cy="18" r="1"></circle>
                                        <circle cx="15" cy="18" r="1"></circle>
                                        <path d="M8 11V7a4 4 0 0 1 8 0"></path>
                                    </svg>
                                </div>
                                <div class="agente-card-info">
                                    <div class="agente-card-nome">${agente.nome || 'Sem nome'}</div>
                                    <div class="agente-card-subtitle"><svg class="agente-card-whatsapp-icon" viewBox="0 0 24 24" width="12" height="12"><path fill="currentColor" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> ${subtitulo}</div>
                                </div>
                            </div>
                            <div class="agente-card-switch-top">
                                <label class="switch">
                                    <input type="checkbox" ${isActive ? 'checked' : ''} onchange="toggleAgenteAtivo('${agente.id}', this.checked)">
                                    <span class="slider-switch"></span>
                                </label>
                            </div>
                        </div>
                        <div class="agente-card-tags">
                            <div class="agente-tag agente-tag-modelo">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                    <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                    <path d="M9 9h6v6H9z"></path>
                                </svg>
                                ${modeloNome}
                            </div>
                            ${isActive ? `
                                <div class="agente-tag agente-tag-status">
                                    <span class="agente-tag-dot-pulse">
                                        <span class="agente-tag-dot-ping"></span>
                                        <span class="agente-tag-dot"></span>
                                    </span>
                                    Online
                                </div>
                            ` : `
                                <div class="agente-tag agente-tag-status offline">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                    </svg>
                                    Pausado
                                </div>
                            `}
                            ${(window.limiteAtingido === true) ? `
                                <div class="agente-tag agente-tag-sem-creditos">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                    Pausado por falta de créditos
                                </div>
                            ` : ''}
                        </div>
                        <!-- Recursos: doc, ferramentas -->
                        <div class="agente-card-resources">
                            <span class="agente-resource-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg> ${qntDoc} doc</span>
                            <span class="agente-resource-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg> ${qntFerramentas} ferramentas</span>
                        </div>
                    </div>
                    <div class="agente-card-footer">
                        <span class="agente-card-footer-updated">${textoAtualizado}</span>
                        <div class="agente-footer-actions">
                            <button class="agente-footer-icon" onclick="editarAgente('${agente.id}')" title="Configurações">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                </svg>
                            </button>
                            <button class="agente-footer-icon" data-agente-excluir-id="${agente.id || agente.idAgente}" data-agente-excluir-nome="${String(agente.nome || 'Sem nome').replace(/"/g, '&quot;')}" title="Excluir agente" style="color: #ef4444;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                    
                    agentesGrid.appendChild(card);
                    
                    // Adicionar event listener para o botão de excluir
                    const btnExcluir = card.querySelector('[data-agente-excluir-id]');
                    if (btnExcluir) {
                        btnExcluir.addEventListener('click', function(e) {
                            e.stopPropagation();
                            const agenteId = this.getAttribute('data-agente-excluir-id');
                            const agenteNome = this.getAttribute('data-agente-excluir-nome') || 'este agente';
                            abrirModalExcluirAgente(agenteId, agenteNome);
                        });
                    }
                });
            }
            
            // Adicionar card de criar novo agente no final (sempre aparece)
            const criarCard = document.createElement('div');
            criarCard.className = 'agente-card agente-card-criar';
            criarCard.setAttribute('aria-disabled', window.limiteAgentesAtingido ? 'true' : 'false');
            if (window.limiteAgentesAtingido) {
                criarCard.classList.add('limite-atingido');
                criarCard.title = 'Limite atingido';
            } else {
                criarCard.onclick = () => abrirModalCriarAgente();
            }
            criarCard.innerHTML = `
                <div class="agente-card-criar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                </div>
                <div class="agente-card-criar-title">Novo agente</div>
                <div class="agente-card-criar-desc">Configure um novo agente<br>de inteligência artificial</div>
            `;
            agentesGrid.appendChild(criarCard);
        }

        // ===== FUNÇÕES DE TOGGLE DE AGENTE ATIVO =====
        async function toggleAgenteAtivo(agenteId, ativo) {
            try {
                // Buscar o agente para obter o conexaoId
                let conexaoId = null;
                const agentesData = window.agentesData || [];
                const agente = agentesData.find(a => a.id == agenteId || a.idAgente == agenteId);
                
                if (agente) {
                    conexaoId = agente.conexaoId || agente.conexao_id || agente.ConexaoId || null;
                }
                
                const { error: updateAtivoError } = await window.supabase
                    .from('SAAS_AgentesIA')
                    .update({ ativo: Boolean(ativo) })
                    .eq('id', agenteId);

                if (updateAtivoError) {
                    throw new Error(updateAtivoError.message || 'Erro ao alterar status do agente');
                }

                showToast(`Agente ${ativo ? 'ativado' : 'desativado'} com sucesso!`, 'success');
                
                // Atualizar o status do agente localmente sem recarregar todos os agentes
                const agenteIndex = agentesData.findIndex(a => a.id == agenteId || a.idAgente == agenteId);
                if (agenteIndex !== -1) {
                    agentesData[agenteIndex].ativo = ativo;
                    window.agentesData = agentesData;
                    // Atualizar apenas o card do agente específico
                    const card = document.querySelector(`[data-agente-id="${agenteId}"]`);
                    if (card) {
                        const switchInput = card.querySelector('.switch input');
                        if (switchInput) {
                            switchInput.checked = ativo;
                        }
                        // Atualizar tag de status
                        const statusTag = card.querySelector('.agente-tag-status');
                        if (statusTag) {
                            if (ativo) {
                                statusTag.innerHTML = `
                                    <span class="agente-tag-dot-pulse">
                                        <span class="agente-tag-dot-ping"></span>
                                        <span class="agente-tag-dot"></span>
                                    </span>
                                    Online
                                `;
                                statusTag.classList.remove('offline');
                            } else {
                                statusTag.innerHTML = `
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                    </svg>
                                    Pausado
                                `;
                                statusTag.classList.add('offline');
                            }
                        }
                    }
                }
            } catch (error) {
                console.error('Erro ao alterar status do agente:', error);
                showToast('Erro ao alterar status do agente. Tente novamente.', 'error');
                // Reverter o switch em caso de erro
                const card = document.querySelector(`[data-agente-id="${agenteId}"]`);
                if (card) {
                    const switchInput = card.querySelector('.switch input');
                    if (switchInput) {
                        switchInput.checked = !ativo;
                    }
                }
            }
        }

        // ===== FUNÇÕES DO FOOTER DO CARD =====
        function abrirAnalyticsAgente(agenteId) {
            // TODO: Implementar analytics do agente
            showToast('Funcionalidade de Analytics em desenvolvimento', 'info');
            console.log('Abrir analytics do agente:', agenteId);
        }

        async function editarAgente(agenteId) {
            const agentes = window.agentesData || [];
            const agenteDaLista = agentes.find(a => a.id == agenteId || a.idAgente == agenteId);
            if (!agenteDaLista) {
                console.error('Agente não encontrado. ID buscado:', agenteId);
                showToast('Agente não encontrado', 'error');
                return;
            }
            try {
                const { data: agenteCompleto, error } = await window.supabase
                    .from('SAAS_AgentesIA')
                    .select('*')
                    .eq('id', agenteId)
                    .maybeSingle();
                if (error) throw error;
                const agente = agenteCompleto ? { ...agenteDaLista, ...agenteCompleto } : agenteDaLista;
                abrirModalCriarAgente(agente);
            } catch (err) {
                console.error('Erro ao carregar agente para edição:', err);
                abrirModalCriarAgente(agenteDaLista);
            }
        }

        // ===== FUNÇÕES DE EXCLUSÃO DE AGENTE =====
        let agenteExcluindoId = null;
        let conhecimentoExcluindo = null; // { tipo: 'arquivo' | 'qa', index: number, idUnico: string, nome: string }

        function abrirModalExcluirConhecimento(tipo, index, idUnico, nome) {
            conhecimentoExcluindo = { tipo: tipo, index: index, idUnico: idUnico, nome: nome || 'este conhecimento' };
            var elNome = document.getElementById('nomeExcluirConhecimento');
            if (elNome) elNome.textContent = nome || 'este conhecimento';
            var modal = document.getElementById('modalExcluirConhecimento');
            if (modal) modal.classList.add('show');
        }

        function fecharModalExcluirConhecimento() {
            var modal = document.getElementById('modalExcluirConhecimento');
            if (modal) modal.classList.remove('show');
            conhecimentoExcluindo = null;
        }

        async function confirmarExcluirConhecimento() {
            if (!conhecimentoExcluindo) {
                showToast('Erro: Nenhum conhecimento selecionado', 'error');
                return;
            }
            var btnConfirmar = document.getElementById('btnConfirmarExcluirConhecimento');
            var textoOriginal = btnConfirmar ? btnConfirmar.innerHTML : '';
            if (btnConfirmar) {
                btnConfirmar.disabled = true;
                btnConfirmar.innerHTML = '<div class="loading-spinner-small"></div> Excluindo...';
            }
            try {
                if (conhecimentoExcluindo.tipo === 'arquivo' && typeof conhecimentoExcluindo.index === 'number') {
                    if (conhecimentoExcluindo.idUnico) {
                        try {
                            var rpc = await window.supabase.rpc('f_excluir_conhecimento_por_idunico', { p_idunico: conhecimentoExcluindo.idUnico });
                            if (rpc.error) {
                                console.warn('Erro ao excluir conhecimento no Supabase:', rpc.error);
                                showToast(rpc.error.message || 'Não foi possível excluir no servidor. Removido apenas da lista.', 'warning');
                            }
                        } catch (e) {
                            console.warn('Chamada Supabase para excluir conhecimento:', e);
                            showToast('Erro ao excluir no servidor. Removido apenas da lista.', 'warning');
                        }
                    }
                    uploadedFiles.splice(conhecimentoExcluindo.index, 1);
                    renderUploadedFiles();
                    showToast('Conhecimento removido com sucesso.', 'success');
                }
                fecharModalExcluirConhecimento();
            } catch (error) {
                console.error('Erro ao excluir conhecimento:', error);
                showToast('Erro ao excluir. Tente novamente.', 'error');
            } finally {
                if (btnConfirmar) {
                    btnConfirmar.disabled = false;
                    btnConfirmar.innerHTML = textoOriginal;
                }
            }
        }

        function abrirModalExcluirAgente(agenteId, nomeAgente) {
            agenteExcluindoId = agenteId;
            const modal = document.getElementById('modalExcluirAgente');
            const nomeAgenteElement = document.getElementById('nomeAgenteExcluir');
            
            if (nomeAgenteElement) {
                nomeAgenteElement.textContent = nomeAgente || 'este agente';
            }
            
            if (modal) {
                modal.classList.add('show');
            }
        }

        function fecharModalExcluirAgente() {
            const modal = document.getElementById('modalExcluirAgente');
            if (modal) {
                modal.classList.remove('show');
            }
            agenteExcluindoId = null;
        }

        async function confirmarExcluirAgente() {
            if (!agenteExcluindoId) {
                showToast('Erro: Agente não identificado', 'error');
                return;
            }

            const btnConfirmar = document.getElementById('btnConfirmarExcluirAgente');
            const textoOriginal = btnConfirmar.innerHTML;
            
            // Desabilitar botão e mostrar loading
            btnConfirmar.disabled = true;
            btnConfirmar.innerHTML = `
                <div class="loading-spinner-small"></div>
                Excluindo...
            `;

            try {
                const { error: deleteAgenteError } = await window.supabase
                    .from('SAAS_AgentesIA')
                    .delete()
                    .eq('id', agenteExcluindoId);

                if (deleteAgenteError) {
                    throw new Error(deleteAgenteError.message || 'Erro ao excluir agente');
                }

                console.log('Agente excluído com sucesso (Supabase)');

                // Fechar modal
                fecharModalExcluirAgente();

                // Remover agente da lista local
                if (window.agentesData && Array.isArray(window.agentesData)) {
                    window.agentesData = window.agentesData.filter(a => 
                        String(a.id) !== String(agenteExcluindoId) && 
                        String(a.idAgente) !== String(agenteExcluindoId)
                    );
                }

                // Recarregar lista de agentes
                carregarAgentes();

                showToast('Agente excluído com sucesso!', 'success');
            } catch (error) {
                console.error('Erro ao excluir agente:', error);
                showToast('Erro ao excluir agente. Tente novamente.', 'error');
            } finally {
                // Restaurar botão
                btnConfirmar.disabled = false;
                btnConfirmar.innerHTML = textoOriginal;
            }
        }

        function abrirLinkAgente(agenteId) {
            // TODO: Implementar link externo do agente
            showToast('Funcionalidade de link externo em desenvolvimento', 'info');
            console.log('Abrir link do agente:', agenteId);
        }

        // ===== FUNÇÕES DE CHAT =====
        let agenteAtualId = null;
        let agenteAtual = null;


        // Fechar modal ao clicar fora
        document.getElementById('criarAgenteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                fecharModalCriarAgente();
            }
        });

        // ===== FUNÇÕES DE CONVERSÃO MARKDOWN PARA HTML COM TAGS =====
        // Função auxiliar para criar tag de arquivo de forma consistente
        function criarTagArquivo(arquivo) {
            // Ícone baseado no tipo (em uma única linha para evitar problemas de renderização)
            let iconSvg = '';
            switch(arquivo.type) {
                case 'image':
                    iconSvg = `<svg class="arquivo-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>`;
                    break;
                case 'audio':
                    iconSvg = `<svg class="arquivo-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>`;
                    break;
                case 'video':
                    iconSvg = `<svg class="arquivo-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>`;
                    break;
                case 'pdf':
                    iconSvg = `<svg class="arquivo-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>`;
                    break;
                default:
                    iconSvg = `<svg class="arquivo-tag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>`;
            }
            
            // Criar atributos da tag
            let atributos = `class="arquivo-tag" data-arquivo-id="${arquivo.id}" contenteditable="false"`;
            if (arquivo.url) {
                atributos += ` data-url="${escapeHtml(arquivo.url)}"`;
            }
            
            // Garantir que o nome completo seja inserido como texto único (sem quebras)
            // Usar textContent em vez de innerHTML para o nome para evitar problemas de renderização
            const nomeEscapado = escapeHtml(arquivo.name || 'arquivo');
            
            // Log para debug
            console.log('Criando tag de arquivo:', {
                id: arquivo.id,
                name: arquivo.name,
                nameLength: arquivo.name ? arquivo.name.length : 0,
                nomeEscapado: nomeEscapado,
                nomeEscapadoLength: nomeEscapado.length
            });
            
            return `<span ${atributos}>${iconSvg}<span class="arquivo-tag-text">${nomeEscapado}</span></span>`;
        }


        // Função para processar links de arquivos em HTML já convertido
        function processarLinksArquivosEmHTML(html) {
            if (!html) return '';
            
            // Processar links de arquivos no formato [nome (tipo)](url)
            // Regex melhorada: usa lookahead negativo para capturar tudo até encontrar espaço seguido de (tipo)](url)
            // Isso permite parênteses e outros caracteres no nome do arquivo, incluindo extensões
            const arquivoRegex = /\[((?:(?!\s+\([^)]+\)\]\().)+?)\s+\(([^)]+)\)\]\(([^)]+)\)/g;
            
            let contador = 0;
            let resultado = html;
            let match;
            
            // Processar todos os matches
            while ((match = arquivoRegex.exec(html)) !== null) {
                const matchCompleto = match[0];
                const nomeCompleto = match[1].trim();
                const tipo = match[2].trim();
                const url = match[3].trim();
                
                // Criar ID único para o arquivo com contador para evitar duplicatas
                const arquivoId = 'arquivo_' + Date.now() + '_' + contador + '_' + Math.random().toString(36).substr(2, 9);
                contador++;
                
                // Verificar se o arquivo já existe no array pela URL
                let arquivoExistente = instrucoesArquivosMultimidia.find(a => a.url === url);
                
                if (!arquivoExistente) {
                    // Adicionar ao array de arquivos
                    arquivoExistente = {
                        id: arquivoId,
                        name: nomeCompleto, // Nome completo incluindo extensão
                        type: tipo,
                        url: url,
                        size: 0, // Tamanho desconhecido
                        uploadDate: new Date()
                    };
                    instrucoesArquivosMultimidia.push(arquivoExistente);
                    console.log('Arquivo adicionado ao array:', arquivoExistente);
                } else {
                    console.log('Arquivo já existe no array:', arquivoExistente);
                }
                
                // Substituir o match completo pela tag
                resultado = resultado.replace(matchCompleto, criarTagArquivo(arquivoExistente));
            }
            
            return resultado;
        }

        function markdownParaHTMLComTags(markdown) {
            if (!markdown) return '';
            
            // Primeiro, processar links de arquivos ANTES de converter outros markdowns
            // para evitar que a conversão de markdown interfira nos links de arquivos
            // Regex melhorada: [nome (tipo)](url)
            // Usa lookahead negativo para capturar tudo até encontrar espaço seguido de (tipo)](url)
            // Isso permite parênteses e outros caracteres no nome do arquivo
            const arquivoRegex = /\[((?:(?!\s+\([^)]+\)\]\().)+?)\s+\(([^)]+)\)\]\(([^)]+)\)/g;
            let contador = 0;
            const arquivosEncontrados = [];
            
            // Primeiro, coletar todos os arquivos encontrados usando exec para garantir todos os matches
            let match;
            const regexTemp = new RegExp(arquivoRegex.source, arquivoRegex.flags);
            while ((match = regexTemp.exec(markdown)) !== null) {
                const nomeCompleto = match[1].trim();
                const tipo = match[2].trim();
                const url = match[3].trim();
                
                console.log('Match encontrado:', {
                    completo: match[0],
                    nome: nomeCompleto,
                    nomeLength: nomeCompleto.length,
                    tipo: tipo,
                    url: url,
                    grupos: {
                        grupo1: match[1],
                        grupo2: match[2],
                        grupo3: match[3]
                    }
                });
                
                // Verificar se o nome está completo (deve terminar com extensão se for imagem)
                if (nomeCompleto && !nomeCompleto.match(/\.(jpeg|jpg|png|gif|webp|svg|pdf|mp4|avi|mov|mp3|wav)$/i)) {
                    console.warn('⚠️ Nome do arquivo pode estar incompleto (sem extensão):', nomeCompleto);
                }
                
                arquivosEncontrados.push({
                    match: match[0],
                    nome: nomeCompleto, // Nome completo incluindo extensão e possíveis parênteses
                    tipo: tipo,
                    url: url
                });
            }
            
            console.log('Arquivos encontrados no markdown:', arquivosEncontrados.length, arquivosEncontrados);
            
            // Substituir cada arquivo encontrado por um placeholder temporário
            let htmlComPlaceholders = markdown;
            arquivosEncontrados.forEach((arquivo, index) => {
                const placeholder = `__ARQUIVO_PLACEHOLDER_${index}__`;
                // Usar replace apenas uma vez para cada match único
                htmlComPlaceholders = htmlComPlaceholders.replace(arquivo.match, placeholder);
            });
            
            // Não converter formatação Markdown, apenas preservar quebras de linha
            // Primeiro, proteger os placeholders antes de escapar HTML
            const placeholderMap = {};
            arquivosEncontrados.forEach((arquivo, index) => {
                const placeholder = `__ARQUIVO_PLACEHOLDER_${index}__`;
                const safePlaceholder = `__SAFE_PLACEHOLDER_${index}__`;
                placeholderMap[safePlaceholder] = placeholder;
                htmlComPlaceholders = htmlComPlaceholders.replace(new RegExp(placeholder.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g'), safePlaceholder);
            });
            
            // Escapar HTML para segurança e converter quebras de linha em <br>
            let html = escapeHtml(htmlComPlaceholders)
                .replace(/\n/g, '<br>');
            
            // Restaurar os placeholders originais após o escape
            Object.keys(placeholderMap).forEach(safePlaceholder => {
                html = html.replace(safePlaceholder, placeholderMap[safePlaceholder]);
            });
            
            // Agora substituir os placeholders pelas tags de arquivo
            arquivosEncontrados.forEach((arquivo, index) => {
                const placeholder = `__ARQUIVO_PLACEHOLDER_${index}__`;
                
                // Criar ID único para o arquivo
                const arquivoId = 'arquivo_' + Date.now() + '_' + contador + '_' + Math.random().toString(36).substr(2, 9);
                contador++;
                
                // Verificar se o arquivo já existe no array pela URL
                let arquivoExistente = instrucoesArquivosMultimidia.find(a => a.url === arquivo.url);
                
                if (!arquivoExistente) {
                    // Adicionar ao array de arquivos
                    arquivoExistente = {
                        id: arquivoId,
                        name: arquivo.nome, // Nome completo incluindo extensão
                        type: arquivo.tipo,
                        url: arquivo.url,
                        size: 0, // Tamanho desconhecido
                        uploadDate: new Date()
                    };
                    instrucoesArquivosMultimidia.push(arquivoExistente);
                    console.log('✅ Arquivo adicionado ao array:', {
                        id: arquivoExistente.id,
                        name: arquivoExistente.name,
                        nameLength: arquivoExistente.name.length,
                        type: arquivoExistente.type,
                        url: arquivoExistente.url
                    });
                } else {
                    console.log('ℹ️ Arquivo já existe no array:', {
                        id: arquivoExistente.id,
                        name: arquivoExistente.name,
                        nameLength: arquivoExistente.name.length
                    });
                }
                
                // Substituir placeholder pela tag
                html = html.replace(placeholder, criarTagArquivo(arquivoExistente));
            });
            
            return html;
        }

        // ===== FUNÇÕES DE CONVERSÃO HTML PARA MARKDOWN =====
        function htmlParaMarkdown(html) {
            if (!html) return '';
            
            // Criar um elemento temporário para processar o HTML
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            
            // Processar cada elemento recursivamente
            const processarElemento = (elemento) => {
                if (elemento.nodeType === Node.TEXT_NODE) {
                    return elemento.textContent || '';
                }
                
                if (elemento.nodeType !== Node.ELEMENT_NODE) {
                    return '';
                }
                
                const tag = elemento.tagName.toLowerCase();
                
                // Processar filhos primeiro
                const conteudoFilhos = Array.from(elemento.childNodes)
                    .map(processarElemento)
                    .join('');
                
                switch(tag) {
                    case 'h1':
                        return `# ${conteudoFilhos.trim()}\n\n`;
                    case 'h2':
                        return `## ${conteudoFilhos.trim()}\n\n`;
                    case 'h3':
                        return `### ${conteudoFilhos.trim()}\n\n`;
                    case 'strong':
                    case 'b':
                        return `**${conteudoFilhos.trim()}**`;
                    case 'em':
                    case 'i':
                        return `*${conteudoFilhos.trim()}*`;
                    case 'code':
                        // Se está dentro de um pre, não adicionar backticks extras
                        if (elemento.parentElement && elemento.parentElement.tagName.toLowerCase() === 'pre') {
                            return conteudoFilhos;
                        }
                        return `\`${conteudoFilhos.trim()}\``;
                    case 'pre':
                        return `\`\`\`\n${conteudoFilhos.trim()}\n\`\`\`\n\n`;
                    case 'a':
                        // Manter apenas texto, sem link (evita duplicação de link)
                        return conteudoFilhos.trim();
                    case 'ul':
                        const items = Array.from(elemento.children)
                            .filter(el => el.tagName.toLowerCase() === 'li')
                            .map(li => {
                                const liTexto = Array.from(li.childNodes)
                                    .map(processarElemento)
                                    .join('')
                                    .trim();
                                return `- ${liTexto}`;
                            })
                            .join('\n');
                        return items ? `${items}\n\n` : '';
                    case 'ol':
                        const olItems = Array.from(elemento.children)
                            .filter(el => el.tagName.toLowerCase() === 'li')
                            .map((li, index) => {
                                const liTexto = Array.from(li.childNodes)
                                    .map(processarElemento)
                                    .join('')
                                    .trim();
                                return `${index + 1}. ${liTexto}`;
                            })
                            .join('\n');
                        return olItems ? `${olItems}\n\n` : '';
                    case 'li':
                        return conteudoFilhos.trim();
                    case 'p':
                        const pTexto = conteudoFilhos.trim();
                        return pTexto ? `${pTexto}\n\n` : '\n';
                    case 'br':
                        return '\n';
                    case 'blockquote':
                        return `> ${conteudoFilhos.trim()}\n\n`;
                    case 'div':
                        return conteudoFilhos;
                    case 'span':
                        // Verificar se é uma tag de arquivo
                        if (elemento.classList && elemento.classList.contains('arquivo-tag')) {
                            const arquivoId = elemento.getAttribute('data-arquivo-id');
                            const url = elemento.getAttribute('data-url');
                            
                            // Primeiro, tentar buscar o arquivo no array para obter o nome completo
                            let nomeArquivo = null;
                            let tipoArquivo = 'file';
                            
                            if (arquivoId) {
                                const arquivo = instrucoesArquivosMultimidia.find(a => a.id === arquivoId);
                                if (arquivo) {
                                    nomeArquivo = arquivo.name; // Nome completo do array (incluindo extensão)
                                    tipoArquivo = arquivo.type || 'file';
                                    console.log('Arquivo encontrado no array para conversão:', { id: arquivoId, name: nomeArquivo });
                                } else {
                                    console.log('Arquivo NÃO encontrado no array:', arquivoId, 'Array:', instrucoesArquivosMultimidia);
                                }
                            }
                            
                            // Se não encontrou no array, usar textContent como fallback (remove SVG, mantém só texto)
                            if (!nomeArquivo) {
                                // Tentar pegar do span interno primeiro (se existir)
                                const textSpan = elemento.querySelector('.arquivo-tag-text');
                                if (textSpan) {
                                    nomeArquivo = textSpan.textContent.trim() || textSpan.innerText.trim();
                                    console.log('Nome extraído do span interno:', nomeArquivo);
                                } else {
                                    // Extrair texto de todos os nós de texto, ignorando SVG
                                    const textNodes = [];
                                    const walker = document.createTreeWalker(
                                        elemento,
                                        NodeFilter.SHOW_TEXT,
                                        null,
                                        false
                                    );
                                    let node;
                                    while (node = walker.nextNode()) {
                                        if (node.parentElement && !node.parentElement.classList.contains('arquivo-tag-icon')) {
                                            textNodes.push(node.textContent);
                                        }
                                    }
                                    nomeArquivo = textNodes.join('').trim() || elemento.textContent.trim() || elemento.innerText.trim() || 'arquivo';
                                    console.log('Nome extraído do textContent:', nomeArquivo);
                                }
                            }
                            
                            // Se tem URL, sempre retornar no formato Markdown completo
                            if (url) {
                                // Se ainda não tem tipo, tentar inferir pela extensão
                                if (tipoArquivo === 'file' && nomeArquivo) {
                                    const extensao = nomeArquivo.split('.').pop()?.toLowerCase() || '';
                                    if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(extensao)) {
                                        tipoArquivo = 'image';
                                    } else if (['mp4', 'avi', 'mov', 'webm', 'mkv'].includes(extensao)) {
                                        tipoArquivo = 'video';
                                    } else if (['mp3', 'wav', 'ogg', 'm4a'].includes(extensao)) {
                                        tipoArquivo = 'audio';
                                    } else if (extensao === 'pdf') {
                                        tipoArquivo = 'pdf';
                                    }
                                }
                                
                                // Sempre retornar no formato Markdown completo: [nome (tipo)](url)
                                return `[${nomeArquivo} (${tipoArquivo})](${url})`;
                            } else {
                                // Se não tem URL, tentar buscar no array
                                if (arquivoId) {
                                    const arquivo = instrucoesArquivosMultimidia.find(a => a.id === arquivoId);
                                    if (arquivo && arquivo.url) {
                                        return `[${arquivo.name || nomeArquivo} (${arquivo.type || tipoArquivo})](${arquivo.url})`;
                                    }
                                }
                                // Se não tem URL nem arquivo no array, retornar apenas o nome
                                return nomeArquivo;
                            }
                        }
                        return conteudoFilhos;
                    default:
                        return conteudoFilhos;
                }
            };
            
            // Processar todos os elementos
            let markdown = Array.from(tempDiv.childNodes)
                .map(processarElemento)
                .join('');
            
            // Limpar múltiplas quebras de linha (máximo 2 consecutivas)
            markdown = markdown.replace(/\n{3,}/g, '\n\n');
            
            // Remover espaços em branco no início e fim
            return markdown.trim();
        }

        // ===== FUNÇÕES DE FORMATAÇÃO DE TEXTO RICO =====
        async function executarComandoFormatacao(comando, valorPadrao = false, valorArg = null) {
            const editor = document.getElementById('instrucoesAgenteInput');
            editor.focus();
            
            try {
                if (comando === 'createLink') {
                    const url = await showPromptDialog('Digite a URL do link:', 'https://');
                    if (url) {
                        document.execCommand(comando, false, url);
                    }
                } else if (comando === 'formatBlock' && valorArg) {
                    document.execCommand(comando, false, valorArg);
                } else {
                    document.execCommand(comando, false, valorPadrao);
                }
            } catch (e) {
                console.error('Erro ao executar comando:', e);
            }
        }

        async function executarComandoFormatacaoFullscreen(comando, valorPadrao = false, valorArg = null) {
            const editor = document.getElementById('fullscreenInstrucoesTextarea');
            editor.focus();
            
            try {
                if (comando === 'createLink') {
                    const url = await showPromptDialog('Digite a URL do link:', 'https://');
                    if (url) {
                        document.execCommand(comando, false, url);
                    }
                } else if (comando === 'formatBlock' && valorArg) {
                    document.execCommand(comando, false, valorArg);
                } else {
                    document.execCommand(comando, false, valorPadrao);
                }
            } catch (e) {
                console.error('Erro ao executar comando:', e);
            }
        }

        function showPromptDialog(message, valorInicial = '') {
            return new Promise((resolve) => {
                const overlay = document.createElement('div');
                overlay.style.cssText = 'position:fixed;inset:0;background:rgba(15,23,42,.55);display:flex;align-items:center;justify-content:center;z-index:100000;padding:16px;';
                const box = document.createElement('div');
                box.style.cssText = 'width:100%;max-width:520px;background:#fff;border-radius:16px;padding:20px;box-shadow:0 20px 45px rgba(2,6,23,.3);';
                box.innerHTML = `
                    <h3 style="margin:0 0 10px 0;font-size:18px;font-weight:700;color:#0f172a;">Inserir link</h3>
                    <p style="margin:0 0 12px 0;font-size:14px;line-height:1.6;color:#334155;">${String(message || '').replace(/</g, '&lt;')}</p>
                    <input type="url" data-input style="width:100%;border:1px solid #cbd5e1;border-radius:10px;padding:10px 12px;font-size:14px;color:#0f172a;" placeholder="https://exemplo.com">
                    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:14px;">
                        <button type="button" data-cancel style="border:1px solid #cbd5e1;background:#fff;color:#334155;padding:10px 14px;border-radius:10px;font-weight:600;cursor:pointer;">Cancelar</button>
                        <button type="button" data-confirm style="border:0;background:#2563eb;color:#fff;padding:10px 14px;border-radius:10px;font-weight:600;cursor:pointer;">Aplicar</button>
                    </div>
                `;
                overlay.appendChild(box);
                document.body.appendChild(overlay);
                const input = box.querySelector('[data-input]');
                input.value = valorInicial || '';
                setTimeout(() => input.focus(), 0);
                const close = (value) => {
                    overlay.remove();
                    resolve(value);
                };
                overlay.addEventListener('click', (event) => {
                    if (event.target === overlay) close(null);
                });
                box.querySelector('[data-cancel]').addEventListener('click', () => close(null));
                box.querySelector('[data-confirm]').addEventListener('click', () => {
                    const value = input.value.trim();
                    close(value || null);
                });
            });
        }

        function abrirFullscreenInstrucoes() {
            const modal = document.getElementById('fullscreenInstrucoesModal');
            const editor = document.getElementById('instrucoesAgenteInput');
            const fullscreenEditor = document.getElementById('fullscreenInstrucoesTextarea');
            
            // Copiar conteúdo atual
            fullscreenEditor.innerHTML = editor.innerHTML;
            
            // Abrir modal
            modal.classList.add('show');
            
            // Focar no editor
            setTimeout(() => {
                fullscreenEditor.focus();
            }, 100);
        }

        function fecharFullscreenInstrucoes() {
            const modal = document.getElementById('fullscreenInstrucoesModal');
            const editor = document.getElementById('instrucoesAgenteInput');
            const fullscreenEditor = document.getElementById('fullscreenInstrucoesTextarea');
            
            // Copiar conteúdo de volta
            editor.innerHTML = fullscreenEditor.innerHTML;
            
            // Fechar modal
            modal.classList.remove('show');
        }

        // Fechar modal ao pressionar ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('fullscreenInstrucoesModal');
                if (modal && modal.classList.contains('show')) {
                    fecharFullscreenInstrucoes();
                }
            }
        });

        // Colar como texto puro nos editores de instruções (evita links duplicados)
        function instrucoesPastePlainText(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text/plain');
            document.execCommand('insertText', false, text || '');
        }
        document.addEventListener('DOMContentLoaded', function() {
            const editor = document.getElementById('instrucoesAgenteInput');
            const fullscreenEditor = document.getElementById('fullscreenInstrucoesTextarea');
            if (editor) editor.addEventListener('paste', instrucoesPastePlainText);
            if (fullscreenEditor) fullscreenEditor.addEventListener('paste', instrucoesPastePlainText);
        });

        // ===== ARQUIVOS MULTIMÍDIA PARA INSTRUÇÕES =====
        let instrucoesArquivosMultimidia = [];

        // Função para lidar com seleção de arquivos para instruções
        async function handleInstrucoesFileSelect(event, tipo = null) {
            const files = Array.from(event.target.files);
            if (files.length === 0) return;

            // Adicionar arquivos ao array com estado de uploading
            files.forEach(file => {
                // Detectar tipo automaticamente baseado no MIME type
                let detectedType = tipo;
                if (!detectedType) {
                    if (file.type.startsWith('image/')) {
                        detectedType = 'image';
                    } else if (file.type.startsWith('audio/')) {
                        detectedType = 'audio';
                    } else if (file.type.startsWith('video/')) {
                        detectedType = 'video';
                    } else if (file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf')) {
                        detectedType = 'pdf';
                    } else {
                        detectedType = 'file'; // Tipo genérico para outros arquivos
                    }
                }

                const fileData = {
                    id: Date.now() + '_' + Math.random().toString(36).substr(2, 9),
                    file: file,
                    name: file.name,
                    type: detectedType,
                    size: file.size,
                    uploadDate: new Date(),
                    uploading: true,
                    url: null
                };
                instrucoesArquivosMultimidia.push(fileData);
            });

            // Renderizar lista com estado de loading
            renderInstrucoesArquivosList();

            // Fazer upload de cada arquivo
            const arquivosAdicionados = instrucoesArquivosMultimidia.slice(-files.length);
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileData = arquivosAdicionados[i];

                try {
                    // Criar FormData para enviar o arquivo
                    const formData = new FormData();
                    formData.append('file', file);

                    // Fazer requisição POST para o webhook
                    const response = await fetch('/hublabel/public/uploadmedia', {
                        method: 'POST',
                        body: formData
                    });

                    console.log('📤 Upload Response Status:', response.status);

                    const responseText = await response.text();

                    if (!response.ok) {
                        throw new Error(`Erro no upload: ${response.status} ${response.statusText} - Resposta: ${responseText}`);
                    }

                    let uploadData;
                    try {
                        uploadData = JSON.parse(responseText);
                    } catch (e) {
                        throw new Error('Resposta inválida do servidor');
                    }

                    fileData.url = uploadData.link || uploadData.url || uploadData.mediaUrl;
                    fileData.uploading = false;

                    console.log('✅ Upload realizado com sucesso!', {
                        fileName: file.name,
                        fileSize: file.size,
                        fileType: file.type,
                        uploadLink: fileData.url
                    });

                } catch (error) {
                    console.error('❌ Erro ao fazer upload do arquivo:', error);
                    fileData.uploading = false;
                    fileData.uploadError = error.message;
                    showToast(`Erro ao fazer upload de ${file.name}: ${error.message}`, 'error');
                }

                // Atualizar renderização após cada upload
                renderInstrucoesArquivosList();
            }

            event.target.value = ''; // Reset input
        }

        // Função para renderizar lista de arquivos multimídia
        function renderInstrucoesArquivosList() {
            const container = document.getElementById('instrucoesArquivosList');
            if (!container) return;

            if (instrucoesArquivosMultimidia.length === 0) {
                container.innerHTML = `
                    <div class="instrucoes-arquivos-empty">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        <p>Arraste mais arquivos aqui</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = instrucoesArquivosMultimidia.map((arquivo, index) => {
                const tipoClasse = arquivo.type;
                let iconSvg = '';
                let tamanho = formatFileSize(arquivo.size);

                switch(tipoClasse) {
                    case 'image':
                        iconSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>`;
                        break;
                    case 'audio':
                        iconSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                            <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                        </svg>`;
                        break;
                    case 'video':
                        iconSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                        </svg>`;
                        break;
                    case 'pdf':
                        iconSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>`;
                        break;
                    case 'file':
                    default:
                        iconSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>`;
                        break;
                }

                // Verificar estado do upload
                let statusHtml = '';
                let draggableState = 'true';
                let removeButtonDisabled = '';
                
                if (arquivo.uploading) {
                    statusHtml = `
                        <div class="arquivo-multimidia-dica" style="color: #3b82f6;">
                            <div class="loading-spinner-small" style="width: 12px; height: 12px; margin-right: 4px; display: inline-block; vertical-align: middle; animation: spin 1s linear infinite; border: 2px solid rgba(59, 130, 246, 0.3); border-top: 2px solid #3b82f6; border-radius: 50%;"></div>
                            Fazendo upload...
                        </div>
                    `;
                    draggableState = 'false';
                    removeButtonDisabled = 'disabled style="opacity: 0.3; cursor: not-allowed;"';
                } else if (arquivo.uploadError) {
                    statusHtml = `
                        <div class="arquivo-multimidia-dica" style="color: #ef4444;">
                            ❌ Erro no upload
                        </div>
                    `;
                } else if (arquivo.url) {
                    statusHtml = `
                        <div class="arquivo-multimidia-dica" style="color: #6C63FF;">
                            ✅ Upload concluído • ${tamanho}
                        </div>
                    `;
                } else {
                    statusHtml = `
                        <div class="arquivo-multimidia-dica">Clique p/ inserir • ${tamanho}</div>
                    `;
                }

                return `
                    <div class="arquivo-multimidia-item" draggable="${draggableState}" data-id="${arquivo.id}" data-index="${index}" ${arquivo.url ? `data-url="${escapeHtml(arquivo.url)}"` : ''}>
                        <div class="arquivo-multimidia-icon ${tipoClasse}">
                            ${iconSvg}
                        </div>
                        <div class="arquivo-multimidia-info">
                            <div class="arquivo-multimidia-nome" title="${arquivo.name}">${escapeHtml(arquivo.name)}</div>
                            ${statusHtml}
                        </div>
                        <svg class="arquivo-multimidia-drag-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="${arquivo.uploading ? 'opacity: 0.3;' : ''}">
                            <circle cx="9" cy="12" r="1"></circle>
                            <circle cx="9" cy="5" r="1"></circle>
                            <circle cx="9" cy="19" r="1"></circle>
                            <circle cx="15" cy="12" r="1"></circle>
                            <circle cx="15" cy="5" r="1"></circle>
                            <circle cx="15" cy="19" r="1"></circle>
                        </svg>
                        <button class="arquivo-multimidia-remove" onclick="removerInstrucoesArquivo(${index})" title="Remover" ${removeButtonDisabled}>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                `;
            }).join('');

            // Adicionar event listeners para drag and drop
            container.querySelectorAll('.arquivo-multimidia-item').forEach(item => {
                item.addEventListener('dragstart', handleDragStart);
                item.addEventListener('dragend', handleDragEnd);
                item.addEventListener('click', function() {
                    inserirArquivoNoTexto(this.dataset.id);
                });
            });

            // Adicionar drag and drop no editor
            const editor = document.getElementById('instrucoesAgenteInput');
            if (editor) {
                editor.addEventListener('dragover', handleDragOver);
                editor.addEventListener('drop', handleDrop);
                editor.addEventListener('dragleave', handleDragLeave);
            }
        }

        // Função para remover arquivo das instruções
        function removerInstrucoesArquivo(index) {
            instrucoesArquivosMultimidia.splice(index, 1);
            renderInstrucoesArquivosList();
        }

        // Função para inserir referência ao arquivo no texto
        function inserirArquivoNoTexto(arquivoId) {
            const arquivo = instrucoesArquivosMultimidia.find(a => a.id === arquivoId);
            if (!arquivo) return;

            // Verificar se o arquivo ainda está fazendo upload
            if (arquivo.uploading) {
                showToast('Aguarde o upload do arquivo ser concluído.', 'info');
                return;
            }

            // Verificar se houve erro no upload
            if (arquivo.uploadError) {
                showToast(`Erro no upload do arquivo: ${arquivo.uploadError}`, 'error');
                return;
            }

            // Verificar se o arquivo tem URL
            if (!arquivo.url) {
                showToast('Arquivo ainda não foi enviado. Aguarde o upload.', 'info');
                return;
            }

            const editor = document.getElementById('instrucoesAgenteInput');
            if (!editor) return;

            editor.focus();

            // Criar tag azul arredondada para o arquivo usando função auxiliar
            const tagHTML = criarTagArquivo(arquivo);
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = tagHTML;
            const tag = tempDiv.firstElementChild;
            
            // Inserir no cursor ou no final
            const selection = window.getSelection();
            if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                range.deleteContents();
                range.insertNode(tag);
                
                // Adicionar espaço após a tag e mover cursor
                const spaceNode = document.createTextNode(' ');
                range.setStartAfter(tag);
                range.insertNode(spaceNode);
                range.setStartAfter(spaceNode);
                range.collapse(true);
                selection.removeAllRanges();
                selection.addRange(range);
            } else {
                editor.appendChild(tag);
                editor.appendChild(document.createTextNode(' '));
            }
        }

        // Funções de drag and drop
        function handleDragStart(e) {
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', e.target.dataset.id);
            e.target.classList.add('dragging');
        }

        function handleDragEnd(e) {
            e.target.classList.remove('dragging');
            const editor = document.getElementById('instrucoesAgenteInput');
            if (editor) {
                editor.classList.remove('drag-over');
                editor.style.cursor = '';
            }
            
            // Remover indicador
            if (cursorIndicator) {
                cursorIndicator.remove();
                cursorIndicator = null;
            }
        }

        let cursorIndicator = null;

        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            const editor = document.getElementById('instrucoesAgenteInput');
            if (editor) {
                editor.classList.add('drag-over');
                editor.style.cursor = 'text';
                
                // Remover indicador anterior se existir
                if (cursorIndicator) {
                    cursorIndicator.remove();
                    cursorIndicator = null;
                }
                
                // Criar indicador de posição do cursor
                try {
                    let range = null;
                    if (document.caretRangeFromPoint) {
                        range = document.caretRangeFromPoint(e.clientX, e.clientY);
                    } else if (document.caretPositionFromPoint) {
                        const caretPos = document.caretPositionFromPoint(e.clientX, e.clientY);
                        if (caretPos) {
                            range = document.createRange();
                            range.setStart(caretPos.offsetNode, caretPos.offset);
                            range.collapse(true);
                        }
                    }
                    
                    if (range) {
                        // Verificar se o range está dentro do editor
                        const isInEditor = editor.contains(range.commonAncestorContainer) || 
                                          editor.contains(range.startContainer);
                        
                        if (isInEditor) {
                            // Obter posição do cursor
                            const rect = range.getBoundingClientRect();
                            const editorRect = editor.getBoundingClientRect();
                            
                            cursorIndicator = document.createElement('div');
                            cursorIndicator.className = 'cursor-indicator';
                            cursorIndicator.style.position = 'fixed';
                            cursorIndicator.style.left = e.clientX + 'px';
                            cursorIndicator.style.top = (rect.top || e.clientY) + 'px';
                            cursorIndicator.style.height = (rect.height || 20) + 'px';
                            document.body.appendChild(cursorIndicator);
                        }
                    }
                } catch (err) {
                    // Ignorar erros de range
                }
            }
        }

        function handleDragLeave(e) {
            const editor = document.getElementById('instrucoesAgenteInput');
            if (editor && !editor.contains(e.relatedTarget)) {
                editor.classList.remove('drag-over');
                editor.style.cursor = '';
                if (cursorIndicator) {
                    cursorIndicator.remove();
                    cursorIndicator = null;
                }
            }
        }

        function handleDrop(e) {
            e.preventDefault();
            const editor = document.getElementById('instrucoesAgenteInput');
            if (editor) {
                editor.classList.remove('drag-over');
                editor.style.cursor = '';
            }

            // Remover indicador
            if (cursorIndicator) {
                cursorIndicator.remove();
                cursorIndicator = null;
            }

            const arquivoId = e.dataTransfer.getData('text/plain');
            if (arquivoId) {
                // Verificar se o arquivo está pronto para ser inserido
                const arquivo = instrucoesArquivosMultimidia.find(a => a.id === arquivoId);
                if (arquivo) {
                    if (arquivo.uploading) {
                        showToast('Aguarde o upload do arquivo ser concluído.', 'info');
                        return;
                    }
                    if (arquivo.uploadError) {
                        showToast('Erro no upload do arquivo. Tente novamente.', 'error');
                        return;
                    }
                    if (!arquivo.url) {
                        showToast('Arquivo ainda não foi enviado. Aguarde o upload.', 'info');
                        return;
                    }
                }

                // Calcular posição do cursor baseado no ponto de drop
                try {
                    const range = document.caretRangeFromPoint ? document.caretRangeFromPoint(e.clientX, e.clientY) : null;
                    if (range) {
                        const selection = window.getSelection();
                        selection.removeAllRanges();
                        selection.addRange(range);
                    }
                } catch (err) {
                    // Se não conseguir criar range, inserir no final
                    const editor = document.getElementById('instrucoesAgenteInput');
                    if (editor) {
                        const range = document.createRange();
                        range.selectNodeContents(editor);
                        range.collapse(false);
                        const selection = window.getSelection();
                        selection.removeAllRanges();
                        selection.addRange(range);
                    }
                }
                inserirArquivoNoTexto(arquivoId);
            }
        }

        // Função auxiliar para formatar tamanho de arquivo
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        // Função auxiliar para escapar HTML
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // ===== FUNÇÃO PARA APRIMORAR INSTRUÇÕES =====
        async function aprimorarInstrucoes() {
            const editor = document.getElementById('instrucoesAgenteInput');
            if (!editor) return;

            // Pegar todo o conteúdo HTML do editor
            const instrucoesAtuais = editor.innerHTML || editor.innerText || editor.textContent || '';
            
            if (!instrucoesAtuais.trim()) {
                showToast('Por favor, adicione instruções antes de aprimorar.', 'info');
                return;
            }

            // Pegar contaId e idAgente
            const contaId = getCookie('userId');
            if (!contaId) {
                showToast('Sessão inválida. Faça login novamente.', 'error');
                return;
            }

            const idAgente = agenteEditandoId || null;

            // Mostrar loading
            const btnAprimorar = document.querySelector('.instrucoes-aprimorar-tag');
            let textoOriginal = '';
            if (btnAprimorar) {
                textoOriginal = btnAprimorar.innerHTML;
                btnAprimorar.disabled = true;
                btnAprimorar.style.pointerEvents = 'none';
                btnAprimorar.innerHTML = `
                    <div class="loading-spinner-small" style="width: 12px; height: 12px; margin-right: 4px; display: inline-block; vertical-align: middle; animation: spin 1s linear infinite; border: 2px solid rgba(148, 163, 184, 0.3); border-top: 2px solid rgba(148, 163, 184, 0.9); border-radius: 50%;"></div>
                    Aprimorando...
                `;
            }

            try {
                // Fazer requisição POST
                const response = await fetch('/hublabel/public/aprimorar-instrucao', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        contaId: contaId,
                        idAgente: idAgente,
                        instrucao: instrucoesAtuais
                    })
                });

                const data = await response.json();

                // Verificar se a resposta contém instrucao
                if (data && data.instrucao) {
                    // Processar links de arquivos ANTES do marked.parse() para evitar conversão para <a>
                    let instrucaoMarkdown = data.instrucao;
                    
                    // Substituir temporariamente links de arquivos por placeholders
                    // Regex melhorada para lidar com colchetes aninhados e parênteses no nome: [nome (tipo)](url)
                    // Captura tudo até encontrar espaço seguido de (tipo)](url) - permite parênteses no nome
                    const arquivoPlaceholders = [];
                    const arquivoRegex = /\[([^\]]*?)\s+\(([^)]+)\)\]\(([^)]+)\)/g;
                    let placeholderIndex = 0;
                    let match;
                    
                    // Usar exec para garantir que todos os matches sejam capturados
                    const regexTemp = new RegExp(arquivoRegex.source, arquivoRegex.flags);
                    while ((match = regexTemp.exec(instrucaoMarkdown)) !== null) {
                        const placeholder = `__ARQUIVO_PLACEHOLDER_${placeholderIndex}__`;
                        arquivoPlaceholders.push({ 
                            match: match[0], 
                            nomeCompleto: match[1].trim(), // Nome completo incluindo extensão
                            tipo: match[2].trim(), 
                            url: match[3].trim() 
                        });
                        instrucaoMarkdown = instrucaoMarkdown.replace(match[0], placeholder);
                        placeholderIndex++;
                    }
                    
                    // Não converter formatação Markdown, apenas preservar quebras de linha
                    // Primeiro, proteger os placeholders antes de escapar HTML
                    const placeholderMap = {};
                    arquivoPlaceholders.forEach((placeholder, index) => {
                        const placeholderText = `__ARQUIVO_PLACEHOLDER_${index}__`;
                        const safePlaceholder = `__SAFE_PLACEHOLDER_${index}__`;
                        placeholderMap[safePlaceholder] = placeholderText;
                        instrucaoMarkdown = instrucaoMarkdown.replace(new RegExp(placeholderText.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g'), safePlaceholder);
                    });
                    
                    // Escapar HTML para segurança e converter quebras de linha em <br>
                    let instrucaoHTML = escapeHtml(instrucaoMarkdown)
                        .replace(/\n/g, '<br>');
                    
                    // Restaurar os placeholders originais após o escape
                    Object.keys(placeholderMap).forEach(safePlaceholder => {
                        instrucaoHTML = instrucaoHTML.replace(safePlaceholder, placeholderMap[safePlaceholder]);
                    });
                    
                    // Substituir placeholders pelas tags de arquivo
                    arquivoPlaceholders.forEach((placeholder, index) => {
                        const placeholderText = `__ARQUIVO_PLACEHOLDER_${index}__`;
                        const nomeArquivo = placeholder.nomeCompleto;
                        const tipo = placeholder.tipo;
                        const url = placeholder.url;
                        
                        // Criar ID único para o arquivo
                        const arquivoId = 'arquivo_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                        
                        // Verificar se o arquivo já existe no array
                        let arquivoExistente = instrucoesArquivosMultimidia.find(a => a.url === url);
                        
                        if (!arquivoExistente) {
                            // Adicionar ao array de arquivos
                            arquivoExistente = {
                                id: arquivoId,
                                name: nomeArquivo,
                                type: tipo,
                                url: url,
                                size: 0,
                                uploadDate: new Date()
                            };
                            instrucoesArquivosMultimidia.push(arquivoExistente);
                        }
                        
                        // Criar tag usando função auxiliar e converter para elemento DOM
                        const tagHTML = criarTagArquivo(arquivoExistente);
                        // Usar replace com função para garantir substituição correta
                        instrucaoHTML = instrucaoHTML.replace(new RegExp(placeholderText.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g'), tagHTML);
                    });
                    
                    // Atualizar o campo de instruções
                    editor.innerHTML = instrucaoHTML;
                    
                    // Garantir que os SVGs sejam renderizados corretamente
                    editor.querySelectorAll('.arquivo-tag').forEach(tag => {
                        const icon = tag.querySelector('.arquivo-tag-icon');
                        if (!icon || !icon.innerHTML.trim()) {
                            // Se o ícone não foi renderizado, recriar a tag
                            const arquivoId = tag.getAttribute('data-arquivo-id');
                            const arquivo = instrucoesArquivosMultimidia.find(a => a.id === arquivoId);
                            if (arquivo) {
                                const novaTagHTML = criarTagArquivo(arquivo);
                                const tempDiv = document.createElement('div');
                                tempDiv.innerHTML = novaTagHTML;
                                const novaTag = tempDiv.firstElementChild;
                                tag.parentNode.replaceChild(novaTag, tag);
                            }
                        }
                    });
                    showToast('Instruções aprimoradas com sucesso!', 'success');
                } else {
                    showToast('Erro ao aprimorar instruções. Tente novamente.', 'error');
                }
            } catch (error) {
                console.error('Erro ao aprimorar instruções:', error);
                showToast('Erro ao aprimorar instruções. Tente novamente.', 'error');
            } finally {
                // Restaurar botão
                if (btnAprimorar) {
                    btnAprimorar.disabled = false;
                    btnAprimorar.style.pointerEvents = 'auto';
                    btnAprimorar.innerHTML = textoOriginal;
                }
            }
        }

        // ===== MODAL DE CRIAR INSTRUÇÕES COM AJUDA =====
        let etapaAtualInstrucoes = 0;
        let respostasInstrucoes = {};
        
        const perguntasInstrucoes = [
            {
                tipo: 'texto',
                conteudo: 'Vamos te ajudar a criar instruções para que esse agente de IA vire seu melhor funcionário. Para isso precisamos que você responda cada pergunta com detalhes, como se estivesse explicando para uma criança.'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Qual é o nicho/segmento de atuação do agente de IA?',
                campo: 'nicho'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Qual o nome da empresa e do agente (se houver)?',
                campo: 'nomeEmpresaAgente'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Qual o principal objetivo do atendimento? (ex: triagem, vendas, suporte, etc.)',
                campo: 'objetivo'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Quais produtos/serviços serão oferecidos?',
                campo: 'produtos'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Qual o tom de voz desejado? (ex: informal, técnico, acolhedor...)',
                campo: 'tomVoz'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Quais as 3 perguntas mais frequentes dos clientes?',
                campo: 'perguntasFrequentes'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Quais as 3 objeções mais comuns?',
                campo: 'objecoes'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Qual informação o agente precisa coletar para qualificar?',
                campo: 'infoQualificar',
                opcional: true
            },
            {
                tipo: 'pergunta',
                pergunta: 'Existe alguma restrição sobre o que o agente pode ou não pode fazer?',
                campo: 'restricoes',
                opcional: true
            },
            {
                tipo: 'pergunta',
                pergunta: 'Existe horário de atendimento humano?',
                campo: 'horarioAtendimento'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Como identificar um lead "quente" vs "frio"?',
                campo: 'leadQuenteFrio'
            },
            {
                tipo: 'pergunta',
                pergunta: 'Informações adicionais.',
                campo: 'infoAdicional'
            }
        ];

        const frasesCarregamento = [
            'Enviando perguntas',
            'Analisando Informações',
            'Extraindo detalhes',
            'Reformulando respostas',
            'Criando instrução',
            'Reanalisando',
            'Quase pronto...'
        ];

        function abrirModalCriarInstrucoes() {
            etapaAtualInstrucoes = 0;
            respostasInstrucoes = {};
            const modal = document.getElementById('criarInstrucoesModal');
            const loadingDiv = document.getElementById('loadingInstrucoes');
            const conteudoDiv = document.getElementById('etapaConteudo');
            
            loadingDiv.classList.remove('show');
            conteudoDiv.style.display = 'block';
            
            modal.classList.add('show');
            renderizarEtapa();
        }

        function fecharModalCriarInstrucoes() {
            const modal = document.getElementById('criarInstrucoesModal');
            modal.classList.remove('show');
            etapaAtualInstrucoes = 0;
            respostasInstrucoes = {};
        }

        function renderizarEtapa() {
            const indicadorDiv = document.getElementById('etapaIndicador');
            const conteudoDiv = document.getElementById('etapaConteudo');
            
            // Renderizar indicador de etapas
            indicadorDiv.innerHTML = perguntasInstrucoes.map((_, index) => {
                const isAtiva = index === etapaAtualInstrucoes;
                return `<div class="etapa-dot ${isAtiva ? 'ativa' : ''}"></div>`;
            }).join('');
            
            // Renderizar conteúdo da etapa
            const etapa = perguntasInstrucoes[etapaAtualInstrucoes];
            
            if (etapa.tipo === 'texto') {
                const botaoVoltar = etapaAtualInstrucoes > 0 
                    ? `<button class="btn-etapa btn-etapa-voltar" onclick="voltarEtapaInstrucoes()">Voltar</button>`
                    : '';
                conteudoDiv.innerHTML = `
                    <div class="etapa-texto">${etapa.conteudo}</div>
                    <div class="etapa-botoes">
                        ${botaoVoltar}
                        <button class="btn-etapa btn-etapa-continuar" onclick="avancarEtapaInstrucoes()">Continuar</button>
                    </div>
                `;
            } else if (etapa.tipo === 'pergunta') {
                const valorAtual = respostasInstrucoes[etapa.campo] || '';
                const botaoVoltar = etapaAtualInstrucoes > 0 
                    ? `<button class="btn-etapa btn-etapa-voltar" onclick="voltarEtapaInstrucoes()">Voltar</button>`
                    : '';
                const botoes = etapa.opcional 
                    ? `<div class="etapa-botoes">
                        ${botaoVoltar}
                        <div style="display: flex; gap: 12px; flex: 1;">
                            <button class="btn-etapa btn-etapa-pular" onclick="pularEtapaInstrucoes()">Pular</button>
                            <button class="btn-etapa btn-etapa-continuar" id="btnContinuarEtapa" onclick="avancarEtapaInstrucoes()" disabled>Continuar</button>
                        </div>
                    </div>`
                    : `<div class="etapa-botoes">
                        ${botaoVoltar}
                        <button class="btn-etapa btn-etapa-continuar" id="btnContinuarEtapa" onclick="avancarEtapaInstrucoes()" disabled>Continuar</button>
                    </div>`;
                
                conteudoDiv.innerHTML = `
                    <div class="etapa-pergunta">
                        <label>${etapa.pergunta.replace(/\n/g, '<br>')}</label>
                        <textarea id="respostaEtapa" rows="8">${valorAtual}</textarea>
                        <small style="color: rgba(255,255,255,0.5); font-size: 0.75rem; margin-top: 4px; display: block;">
                            Mínimo de 20 caracteres
                        </small>
                    </div>
                    ${botoes}
                `;
                
                // Adicionar validação em tempo real
                const textarea = document.getElementById('respostaEtapa');
                const btnContinuar = document.getElementById('btnContinuarEtapa');
                if (textarea && btnContinuar) {
                    textarea.addEventListener('input', function() {
                        const texto = this.value.trim();
                        // Para perguntas opcionais, sempre permitir continuar
                        if (etapa.opcional) {
                            btnContinuar.disabled = false;
                        } else {
                            // Para perguntas obrigatórias, só habilitar com 20+ caracteres
                            btnContinuar.disabled = texto.length < 20;
                        }
                    });
                    
                    // Verificar estado inicial
                    if (etapa.opcional || valorAtual.trim().length >= 20) {
                        btnContinuar.disabled = false;
                    }
                }
            }
        }

        function avancarEtapaInstrucoes() {
            const etapa = perguntasInstrucoes[etapaAtualInstrucoes];
            
            // Salvar resposta se for pergunta
            if (etapa.tipo === 'pergunta') {
                const respostaInput = document.getElementById('respostaEtapa');
                if (respostaInput) {
                    const resposta = respostaInput.value.trim();
                    
                    // Validar mínimo de 20 caracteres (exceto se for opcional)
                    if (!etapa.opcional && resposta.length < 20) {
                        showToast('Por favor, escreva pelo menos 20 caracteres para continuar.', 'info');
                        return;
                    }
                    
                    respostasInstrucoes[etapa.campo] = resposta;
                }
            }
            
            // Verificar se é a última etapa
            if (etapaAtualInstrucoes === perguntasInstrucoes.length - 1) {
                enviarInstrucoes();
                return;
            }
            
            etapaAtualInstrucoes++;
            renderizarEtapa();
        }

        function pularEtapaInstrucoes() {
            const etapa = perguntasInstrucoes[etapaAtualInstrucoes];
            if (etapa.opcional) {
                respostasInstrucoes[etapa.campo] = '';
                avancarEtapaInstrucoes();
            }
        }

        function voltarEtapaInstrucoes() {
            if (etapaAtualInstrucoes > 0) {
                // Salvar resposta atual antes de voltar
                const etapa = perguntasInstrucoes[etapaAtualInstrucoes];
                if (etapa.tipo === 'pergunta') {
                    const respostaInput = document.getElementById('respostaEtapa');
                    if (respostaInput) {
                        respostasInstrucoes[etapa.campo] = respostaInput.value.trim();
                    }
                }
                
                etapaAtualInstrucoes--;
                renderizarEtapa();
            }
        }

        function enviarInstrucoes() {
            const conteudoDiv = document.getElementById('etapaConteudo');
            const loadingDiv = document.getElementById('loadingInstrucoes');
            const loadingFrases = document.getElementById('loadingFrases');
            
            conteudoDiv.style.display = 'none';
            loadingDiv.classList.add('show');
            
            // Criar elementos para todas as frases
            loadingFrases.innerHTML = '';
            frasesCarregamento.forEach((frase, index) => {
                const div = document.createElement('div');
                div.className = 'loading-frase';
                div.textContent = frase;
                div.id = `frase-${index}`;
                loadingFrases.appendChild(div);
            });
            
            // Iniciar animação de frases como um rolo
            let indiceFrase = 0;
            
            function mostrarProximaFrase() {
                if (indiceFrase >= frasesCarregamento.length) {
                    return;
                }
                
                // Remover classes de todas as frases
                loadingFrases.querySelectorAll('.loading-frase').forEach(f => {
                    f.classList.remove('ativa', 'saindo');
                });
                
                const fraseAtual = document.getElementById(`frase-${indiceFrase}`);
                if (fraseAtual) {
                    // Adicionar frase anterior na posição saindo
                    if (indiceFrase > 0) {
                        const fraseAnterior = document.getElementById(`frase-${indiceFrase - 1}`);
                        if (fraseAnterior) {
                            fraseAnterior.classList.add('saindo');
                        }
                    }
                    
                    // Mostrar frase atual
                    fraseAtual.classList.add('ativa');
                    indiceFrase++;
                    
                    // Continuar com próxima frase
                    if (indiceFrase < frasesCarregamento.length) {
                        setTimeout(mostrarProximaFrase, 1800);
                    }
                }
            }
            
            // Iniciar animação - mostrar primeira frase imediatamente
            setTimeout(mostrarProximaFrase, 100);
            
            // Preparar dados para envio
            const idAgente = agenteEditandoId || null;
            const userIdCookie = getCookie('userId');
            
            // Formatar respostas como string única com pergunta e resposta juntas
            let respostasFormatadas = '';
            perguntasInstrucoes.forEach((etapa, index) => {
                if (etapa.tipo === 'pergunta') {
                    const resposta = respostasInstrucoes[etapa.campo] || '';
                    if (resposta.trim() !== '') {
                        respostasFormatadas += `${etapa.pergunta}\n${resposta}\n\n`;
                    }
                }
            });
            
            // Remover os últimos \n\n
            respostasFormatadas = respostasFormatadas.trim();
            
            const dados = {
                contaId: userIdCookie,
                idAgente: idAgente,
                respostas: respostasFormatadas
            };
            
            // Enviar requisição
            fetch('/hublabel/public/criar-instrucao', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dados)
            })
            .then(response => response.json())
            .then(data => {
                // Preencher o campo de instruções com a resposta
                const editor = document.getElementById('instrucoesAgenteInput');
                if (editor && data.instrucao) {
                    // Processar links de arquivos ANTES do marked.parse() para evitar conversão para <a>
                    let instrucaoMarkdown = data.instrucao;
                    
                    // Substituir temporariamente links de arquivos por placeholders
                    // Regex melhorada para lidar com colchetes aninhados e parênteses no nome: [nome (tipo)](url)
                    // Captura tudo até encontrar espaço seguido de (tipo)](url) - permite parênteses no nome
                    const arquivoPlaceholders = [];
                    const arquivoRegex = /\[([^\]]*?)\s+\(([^)]+)\)\]\(([^)]+)\)/g;
                    let placeholderIndex = 0;
                    let match;
                    
                    // Usar exec para garantir que todos os matches sejam capturados
                    const regexTemp = new RegExp(arquivoRegex.source, arquivoRegex.flags);
                    while ((match = regexTemp.exec(instrucaoMarkdown)) !== null) {
                        const placeholder = `__ARQUIVO_PLACEHOLDER_${placeholderIndex}__`;
                        arquivoPlaceholders.push({ 
                            match: match[0], 
                            nomeCompleto: match[1].trim(), // Nome completo incluindo extensão
                            tipo: match[2].trim(), 
                            url: match[3].trim() 
                        });
                        instrucaoMarkdown = instrucaoMarkdown.replace(match[0], placeholder);
                        placeholderIndex++;
                    }
                    
                    // Não converter formatação Markdown, apenas preservar quebras de linha
                    // Primeiro, proteger os placeholders antes de escapar HTML
                    const placeholderMap = {};
                    arquivoPlaceholders.forEach((placeholder, index) => {
                        const placeholderText = `__ARQUIVO_PLACEHOLDER_${index}__`;
                        const safePlaceholder = `__SAFE_PLACEHOLDER_${index}__`;
                        placeholderMap[safePlaceholder] = placeholderText;
                        instrucaoMarkdown = instrucaoMarkdown.replace(new RegExp(placeholderText.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g'), safePlaceholder);
                    });
                    
                    // Escapar HTML para segurança e converter quebras de linha em <br>
                    let instrucaoHTML = escapeHtml(instrucaoMarkdown)
                        .replace(/\n/g, '<br>');
                    
                    // Restaurar os placeholders originais após o escape
                    Object.keys(placeholderMap).forEach(safePlaceholder => {
                        instrucaoHTML = instrucaoHTML.replace(safePlaceholder, placeholderMap[safePlaceholder]);
                    });
                    
                    // Substituir placeholders pelas tags de arquivo
                    arquivoPlaceholders.forEach((placeholder, index) => {
                        const placeholderText = `__ARQUIVO_PLACEHOLDER_${index}__`;
                        const nomeArquivo = placeholder.nomeCompleto;
                        const tipo = placeholder.tipo;
                        const url = placeholder.url;
                        
                        // Criar ID único para o arquivo
                        const arquivoId = 'arquivo_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                        
                        // Verificar se o arquivo já existe no array
                        let arquivoExistente = instrucoesArquivosMultimidia.find(a => a.url === url);
                        
                        if (!arquivoExistente) {
                            // Adicionar ao array de arquivos
                            arquivoExistente = {
                                id: arquivoId,
                                name: nomeArquivo,
                                type: tipo,
                                url: url,
                                size: 0,
                                uploadDate: new Date()
                            };
                            instrucoesArquivosMultimidia.push(arquivoExistente);
                        }
                        
                        // Criar tag usando função auxiliar
                        const tagHTML = criarTagArquivo(arquivoExistente);
                        // Usar replace com função para garantir substituição correta
                        instrucaoHTML = instrucaoHTML.replace(new RegExp(placeholderText.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g'), tagHTML);
                    });
                    
                    editor.innerHTML = instrucaoHTML;
                    
                    // Garantir que os SVGs sejam renderizados corretamente
                    editor.querySelectorAll('.arquivo-tag').forEach(tag => {
                        const icon = tag.querySelector('.arquivo-tag-icon');
                        if (!icon || !icon.innerHTML.trim()) {
                            // Se o ícone não foi renderizado, recriar a tag
                            const arquivoId = tag.getAttribute('data-arquivo-id');
                            const arquivo = instrucoesArquivosMultimidia.find(a => a.id === arquivoId);
                            if (arquivo) {
                                const novaTagHTML = criarTagArquivo(arquivo);
                                const tempDiv = document.createElement('div');
                                tempDiv.innerHTML = novaTagHTML;
                                const novaTag = tempDiv.firstElementChild;
                                tag.parentNode.replaceChild(novaTag, tag);
                            }
                        }
                    });
                }
                
                // Mostrar mensagem de sucesso
                showToast('Instruções criadas com sucesso!', 'success');
                
                // Fechar modal após 1 segundo
                setTimeout(() => {
                    fecharModalCriarInstrucoes();
                    loadingDiv.classList.remove('show');
                    conteudoDiv.style.display = 'block';
                }, 1000);
            })
            .catch(error => {
                console.error('Erro ao criar instruções:', error);
                showToast('Erro ao criar instruções. Tente novamente.', 'error');
                loadingDiv.classList.remove('show');
                conteudoDiv.style.display = 'block';
            });
        }

        // ===== INDICADOR DE SCROLL DO MODAL =====
        function atualizarIndicadorScroll() {
            const modalContent = document.getElementById('criarAgenteModalContent');
            const scrollIndicator = document.getElementById('modalScrollIndicator');
            
            if (!modalContent || !scrollIndicator) return;

            const scrollTop = modalContent.scrollTop;
            const scrollHeight = modalContent.scrollHeight;
            const clientHeight = modalContent.clientHeight;
            const scrollPercentage = scrollTop / (scrollHeight - clientHeight);

            // Mostrar indicador se houver scroll disponível e não estiver no final
            if (scrollHeight > clientHeight && scrollPercentage < 0.95) {
                scrollIndicator.classList.add('show');
            } else {
                scrollIndicator.classList.remove('show');
            }
        }


        // ===== DARK MODE / LIGHT MODE =====
        function initDarkMode() {
            // Carregar preferência do cookie
            const darkMode = getCookieDarkMode('darkMode');
            const isDarkMode = darkMode === 'true'; // Padrão: light mode
            
            // Aplicar modo
            applyTheme(isDarkMode);
            
            // Configurar switch
            const toggle = document.getElementById('darkModeToggle');
            if (toggle) {
                toggle.checked = isDarkMode;
                toggle.addEventListener('change', function() {
                    const newMode = this.checked;
                    applyTheme(newMode);
                    setCookieDarkMode('darkMode', newMode ? 'true' : 'false', 365);
                });
            }
        }

        function applyTheme(isDarkMode) {
            const themeText = document.getElementById('themeToggleText');
            
            if (isDarkMode) {
                document.body.classList.remove('light-mode');
                document.body.classList.add('dark-mode');
                if (themeText) themeText.textContent = 'Modo Escuro';
            } else {
                document.body.classList.remove('dark-mode');
                document.body.classList.add('light-mode');
                if (themeText) themeText.textContent = 'Modo Claro';
            }
        }

        function getCookieDarkMode(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function setCookieDarkMode(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = `expires=${date.toUTCString()}`;
            document.cookie = `${name}=${value};${expires};path=/`;
        }

        async function initMenuOcultar() {
            const CACHE_KEY = 'menuOcultarCache';
            const TTL_MS = 30 * 60 * 1000;
            const cached = typeof getCookie === 'function' ? getCookie(CACHE_KEY) : null;
            if (cached) {
                try {
                    const obj = JSON.parse(decodeURIComponent(cached));
                    if (obj && Array.isArray(obj.arr) && obj.exp && Date.now() < obj.exp) {
                        obj.arr.forEach(id => document.body.classList.add('menu-oculta-' + id));
                        return;
                    }
                } catch (e) { /* cache inválido */ }
            }
            if (!window.supabase) return;
            try {
                const { data: { user } } = await window.supabase.auth.getUser();
                if (!user) return;
                const { data: usuario } = await window.supabase.from('SAAS_Usuarios').select('contaId').eq('auth_user_id', user.id).limit(1).maybeSingle();
                if (!usuario?.contaId) return;
                const { data: conta } = await window.supabase.from('SAAS_Contas').select('plano').eq('id', usuario.contaId).limit(1).maybeSingle();
                if (!conta?.plano) return;
                const { data: plano } = await window.supabase.from('SAAS_Planos').select('menu_ocultar').eq('id', conta.plano).limit(1).maybeSingle();
                const arr = Array.isArray(plano?.menu_ocultar) ? plano.menu_ocultar : [];
                arr.forEach(id => document.body.classList.add('menu-oculta-' + id));
                if (typeof setCookie === 'function') setCookie(CACHE_KEY, encodeURIComponent(JSON.stringify({arr, exp: Date.now() + TTL_MS})), 1/48);
            } catch (e) { console.warn('initMenuOcultar:', e); }
        }
        function clearMenuOcultarCache() {
            document.cookie = 'menuOcultarCache=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }

        // Inicializar dark mode e corrigir menu mobile
        document.addEventListener('DOMContentLoaded', function() {
            checkAuth();
            initDarkMode();
            initMenuOcultar();
            
            // Corrigir cliques no mobile - usar touchend para garantir captura
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                const originalOnclick = item.getAttribute('onclick');
                
                if (originalOnclick) {
                    // Adicionar listener para touchend (mobile) - mais confiável que click
                    item.addEventListener('touchend', function(e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            // Fechar menu e overlay
                            const sidebar = document.querySelector('.sidebar');
                            const overlay = document.getElementById('sidebarOverlay');
                            if (sidebar) {
                                sidebar.classList.remove('mobile-open');
                                sidebar.style.pointerEvents = '';
                            }
                            if (overlay) {
                                overlay.classList.remove('active');
                                overlay.style.display = 'none';
                                overlay.style.pointerEvents = 'none';
                            }
                            document.body.style.overflow = '';
                            
                            // Navegar
                            if (originalOnclick.includes('navigateToPage')) {
                                const urlMatch = originalOnclick.match(/navigateToPage\('([^']+)'\)/);
                                if (urlMatch && urlMatch[1]) {
                                    window.location.href = urlMatch[1];
                                }
                            } else if (originalOnclick.includes('window.open')) {
                                const openMatch = originalOnclick.match(/window\.open\('([^']+)'/);
                                if (openMatch && openMatch[1]) {
                                    window.open(openMatch[1], '_blank');
                                }
                            } else if (originalOnclick.includes('logout')) {
                                if (typeof logout === 'function') {
                                    logout();
                                }
                            }
                        }
                    }, { passive: false });
                    
                    // Também adicionar listener para click como fallback
                    item.addEventListener('click', function(e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            // Fechar menu e overlay
                            const sidebar = document.querySelector('.sidebar');
                            const overlay = document.getElementById('sidebarOverlay');
                            if (sidebar) {
                                sidebar.classList.remove('mobile-open');
                                sidebar.style.pointerEvents = '';
                            }
                            if (overlay) {
                                overlay.classList.remove('active');
                                overlay.style.display = 'none';
                                overlay.style.pointerEvents = 'none';
                            }
                            document.body.style.overflow = '';
                            
                            // Navegar
                            if (originalOnclick.includes('navigateToPage')) {
                                const urlMatch = originalOnclick.match(/navigateToPage\('([^']+)'\)/);
                                if (urlMatch && urlMatch[1]) {
                                    window.location.href = urlMatch[1];
                                }
                            } else if (originalOnclick.includes('window.open')) {
                                const openMatch = originalOnclick.match(/window\.open\('([^']+)'/);
                                if (openMatch && openMatch[1]) {
                                    window.open(openMatch[1], '_blank');
                                }
                            } else if (originalOnclick.includes('logout')) {
                                if (typeof logout === 'function') {
                                    logout();
                                }
                            }
                        }
                    }, { capture: true });
                }
            });
        });
    </script>
</body>
</html>
