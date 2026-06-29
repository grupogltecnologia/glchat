<?php
// Tela extraída do n8n. Próximo passo: separar CSS/JS e substituir chamadas por APIs PHP.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexões - IA Chatconversa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="shortcut icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="apple-touch-icon" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <!-- Google Fonts: Plus Jakarta Sans (design gemini.html) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
    <style>
        .main-content,
        .admin-main-content,
        .main-content-wrapper {
            max-width: none !important;
            width: 100% !important;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --brand-50: rgba(108, 99, 255, 0.1);
            --brand-500: #6C63FF;
            --surface: #fbfcfd;
            --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.03);
            --shadow-softer: 0 4px 20px rgba(0, 0, 0, 0.02);
        }
        body {
            background: #f4f4f5;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #18181b;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            transition: background 0.3s ease, color 0.3s ease;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #e2e8f0;
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - design das imagens */
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
        .sidebar.sidebar-expanded .version-text {
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
            .menu-item { padding: 10px 20px; }
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

        body.light-mode .menu-badge-admin {
            background: #6C63FF;
            color: #fff;
        }
        body.light-mode .menu-badge-novidade {
            background: #6C63FF;
            color: #fff;
        }

        /* Ocultar itens do menu conforme plano */
        body.menu-oculta-chat [data-menu-id="chat"] { display: none !important; }
        body.menu-oculta-agentes-ia [data-menu-id="agentes-ia"] { display: none !important; }
        body.menu-oculta-crm [data-menu-id="crm"] { display: none !important; }
        body.menu-oculta-conexoes [data-menu-id="conexoes"] { display: none !important; }
        body.menu-oculta-disparos [data-menu-id="disparos"] { display: none !important; }
        body.menu-oculta-contatos [data-menu-id="contatos"] { display: none !important; }
        body.menu-oculta-listas [data-menu-id="listas"] { display: none !important; }
        body.menu-oculta-ajuda [data-menu-id="ajuda"] { display: none !important; }
        body.menu-oculta-configuracoes [data-menu-id="configuracoes"] { display: none !important; }

        body.light-mode .sidebar-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .sidebar-nav-divider {
            background: rgba(0, 0, 0, 0.12);
        }

        body.light-mode .header-content p {
            color: #666;
        }

        /* light-mode card overrides are now default (light is the base) */

        body.light-mode .empty-state {
            color: #666;
        }

        body.light-mode .empty-state h3 {
            color: #333;
        }

        body.light-mode .confirm-modal-content,
        body.light-mode .qr-modal-content,
        body.light-mode .chatgpt-modal-content,
        body.light-mode .config-conexao-modal-content {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .criar-conexao-modal-content {
            /* Already white by default - no override needed */
        }
        body.light-mode .config-conexao-modal {
            background: rgba(0, 0, 0, 0.4);
        }

        body.light-mode .modal-title,
        body.light-mode .confirm-header h3 {
            color: #6C63FF;
        }

        body.light-mode .qr-modal h3 {
            color: #6C63FF;
        }

        body.light-mode .chatgpt-modal h3 {
            color: #10a37f;
        }

        body.light-mode .criar-conexao-modal h3 {
            /* Already dark text by default */
        }

        body.light-mode .criar-conexao-section h4 {
            /* Already dark text by default */
        }

        body.light-mode .form-group-modal label {
            color: #333;
        }

        body.light-mode .form-group-modal input,
        body.light-mode .form-group-modal select {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            border-radius: 12px !important;
            color: #333 !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        body.light-mode .form-group-modal input:focus,
        body.light-mode .form-group-modal select:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
        }

        body.light-mode .form-group-modal input::placeholder {
            color: #999;
        }

        body.light-mode .btn-modal-cancel,
        body.light-mode .qr-close {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        body.light-mode .btn-modal-cancel:hover,
        body.light-mode .qr-close:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .confirm-details {
            /* Already light by default */
        }

        body.light-mode .confirm-details li {
            /* Already light by default */
        }

        body.light-mode .header-content h1 {
            color: #222;
        }

        /* light-mode status/profile overrides are now default (light is the base) */

        body.light-mode .qr-code-container {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .qr-timer {
            color: #6C63FF;
        }

        body.light-mode .confirm-body p {
            /* Already dark text by default */
        }

        body.light-mode .confirm-header svg {
            color: #ff3b30;
        }

        body.light-mode .code-container {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .code-container h4 {
            color: #6C63FF;
        }

        body.light-mode .code-container p {
            color: #666;
        }

        body.light-mode .modal-subtitle {
            /* Already light-friendly by default */
        }

        body.light-mode .step-content p {
            /* Already light-friendly by default */
        }

        body.light-mode .instructions-content {
            /* Already white/light by default */
        }

        body.light-mode .instruction-step {
            /* Already transparent by default */
        }

        body.light-mode .link-pareamento {
            /* Already green by default */
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

        body.light-mode .modal-close-btn {
            color: #666;
        }

        body.light-mode .modal-close-btn:hover {
            background: rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .btn-modal-back {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        body.light-mode .btn-modal-back:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .sidebar-header {
            border-bottom: none;
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

        body.light-mode .btn-delete-disconnected {
            box-shadow: 0 4px 15px rgba(255, 59, 48, 0.3);
        }

        body.light-mode .btn-delete-disconnected:hover {
            box-shadow: 0 8px 25px rgba(255, 59, 48, 0.4);
        }

        body.light-mode .mobile-menu-toggle {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .mobile-menu-toggle:hover {
            background: rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.light-mode .mobile-close-btn {
            background: rgba(255, 255, 255, 0.9);
        }

        body.light-mode .mobile-close-btn:hover {
            background: rgba(108, 99, 255, 0.2);
        }

        body.light-mode .sidebar-overlay {
            background: rgba(0, 0, 0, 0.3);
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

        /* Main content */
        .main-content {
            flex: 1;
            padding: 32px 40px;
            overflow-x: auto;
            margin-left: 72px;
            background: var(--surface);
            max-width: 1500px;
            width: 100%;
        }

        body.dark-mode .main-content {
            background: transparent;
        }

        .header {
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 24px;
            flex-wrap: wrap;
        }

        .header-content h1 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.025em;
            color: #0f172a;
        }

        .header-content p {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-nova-conexao {
            background: #6C63FF;
            color: white;
            padding: 14px 24px;
            border-radius: 16px;
            border: none;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
        }

        .btn-nova-conexao:hover {
            background: #6C63FF;
            transform: translateY(-2px);
        }

        body.dark-mode .header-content h1 {
            color: #e2e8f0;
        }

        body.dark-mode .header-content p {
            color: #94a3b8;
        }

        body.dark-mode .btn-nova-conexao {
            background: #6C63FF;
        }

        body.dark-mode .btn-nova-conexao:hover {
            background: #6C63FF;
        }

        /* KPI Stats Cards */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .kpi-card {
            background: white;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
        }

        .kpi-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .kpi-card-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .kpi-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kpi-card-icon.default { background: #f8fafc; color: #64748b; }
        .kpi-card-icon.success { background: #f0fdf4; color: #22c55e; }
        .kpi-card-icon.danger { background: #fef2f2; color: #ef4444; }

        .kpi-card-value {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-top: auto;
        }

        .kpi-card-number {
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -0.05em;
            line-height: 1;
            color: #0f172a;
        }

        .kpi-card-number.success { color: #22c55e; }
        .kpi-card-number.danger { color: #ef4444; }

        .kpi-card-sublabel {
            font-size: 0.875rem;
            font-weight: 500;
            color: #94a3b8;
        }

        .kpi-card-sublabel.danger { color: #f87171; }

        .kpi-card.danger-border {
            border-color: #fef2f2;
            box-shadow: 0 8px 30px rgba(239, 68, 68, 0.03);
        }

        body.dark-mode .kpi-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .kpi-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        }

        body.dark-mode .kpi-card-label { color: #94a3b8; }
        body.dark-mode .kpi-card-number { color: #f8fafc; }
        body.dark-mode .kpi-card-sublabel { color: #64748b; }
        body.dark-mode .kpi-card-icon.default { background: rgba(51, 65, 85, 0.5); color: #94a3b8; }
        body.dark-mode .kpi-card-icon.success { background: rgba(34, 197, 94, 0.15); color: #22c55e; }
        body.dark-mode .kpi-card-icon.danger { background: rgba(239,68,68,0.15); color: #ef4444; }
        body.dark-mode .kpi-card.danger-border { border-color: rgba(239,68,68,0.15); }

        /* Toolbar / Search Bar */
        .conexoes-toolbar {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 8px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 32px;
            position: sticky;
            top: 0;
            z-index: 30;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .toolbar-search {
            position: relative;
            flex: 1;
            min-width: 250px;
            max-width: 400px;
        }

        .toolbar-search svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .toolbar-search input {
            background: transparent;
            border: none;
            color: #0f172a;
            font-size: 0.875rem;
            font-weight: 700;
            width: 100%;
            padding: 12px 16px 12px 44px;
            outline: none;
        }

        .toolbar-search input::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .toolbar-divider {
            width: 1px;
            height: 32px;
            background: #e2e8f0;
        }

        .toolbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toolbar-select {
            appearance: none;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #334155;
            font-weight: 700;
            font-size: 0.75rem;
            border-radius: 12px;
            padding: 10px 32px 10px 16px;
            cursor: pointer;
            transition: all 0.2s;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }

        .toolbar-select:hover { background: #f1f5f9; }
        .toolbar-select:focus { outline: none; border-color: #6C63FF; }

        .toolbar-btn-delete {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            font-weight: 700;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .toolbar-btn-delete:hover { background: #fee2e2; }

        body.dark-mode .conexoes-toolbar {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }
        body.dark-mode .toolbar-search input { color: #f8fafc; }
        body.dark-mode .toolbar-search input::placeholder { color: #64748b; }
        body.dark-mode .toolbar-search svg { color: #64748b; }
        body.dark-mode .toolbar-divider { background: rgba(71, 85, 105, 0.4); }
        /* .toolbar-select no dark: ver <style> após dropdowns-global.css */
        body.dark-mode .toolbar-btn-delete {
            background: rgba(239,68,68,0.15);
            border-color: rgba(239,68,68,0.25);
            color: #f87171;
        }





        .btn-delete-disconnected {
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 14px 24px;
            background: linear-gradient(135deg, #ff3b30 0%, #d70015 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            white-space: nowrap;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(255, 59, 48, 0.4);
        }

        .btn-delete-disconnected:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 59, 48, 0.5);
        }

        .btn-delete-disconnected:disabled {
            background: #444;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        @media (max-width: 768px) {
            .btn-delete-disconnected {
                bottom: 20px;
                right: 20px;
                padding: 12px 18px;
                font-size: 0.85rem;
            }
        }

        .btn-chatgpt {
            padding: 12px 20px;
            background: linear-gradient(135deg, #10a37f 0%, #0d8f6b 100%);
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

        .btn-chatgpt:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 163, 127, 0.3);
        }

        .chatgpt-icon {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        /* Card de Criar Conexão */
        .conexao-card-criar {
            background: transparent;
            border-radius: 24px;
            padding: 32px;
            transition: all 0.3s ease;
            position: relative;
            overflow: visible;
            border: 2px dashed #cbd5e1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            min-height: 250px;
        }

        .conexao-card-criar:hover {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.03);
        }

        .conexao-card-criar.limite-atingido {
            cursor: not-allowed;
            opacity: 0.6;
            border-color: #d1d5db;
            background: rgba(255, 255, 255, 0.02);
            pointer-events: none;
        }

        .conexao-card-criar.limite-atingido:hover {
            border-color: #d1d5db;
            background: rgba(255, 255, 255, 0.02);
        }

        .conexao-card-criar-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .conexao-card-criar:hover .conexao-card-criar-icon {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .conexao-card-criar-icon svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            color: #cbd5e1;
            transition: color 0.3s ease;
        }

        .conexao-card-criar:hover .conexao-card-criar-icon svg {
            color: #6C63FF;
        }

        .conexao-card-criar-title {
            font-size: 1.125rem;
            font-weight: 800;
            margin-bottom: 8px;
            color: #334155;
            transition: color 0.3s ease;
        }

        .conexao-card-criar:hover .conexao-card-criar-title {
            color: #6C63FF;
        }

        .conexao-card-criar-desc {
            font-size: 0.75rem;
            font-weight: 500;
            color: #64748b;
            line-height: 1.5;
            max-width: 220px;
        }

        body.dark-mode .conexao-card-criar {
            border-color: rgba(71, 85, 105, 0.4);
            background: rgba(30, 41, 59, 0.3);
        }

        body.dark-mode .conexao-card-criar:hover {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.08);
        }

        body.dark-mode .conexao-card-criar-icon {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .conexao-card-criar-icon svg {
            color: #94a3b8;
        }

        body.dark-mode .conexao-card-criar:hover .conexao-card-criar-icon svg {
            color: #6C63FF;
        }

        body.dark-mode .conexao-card-criar-title {
            color: rgba(255, 255, 255, 0.7);
        }

        body.dark-mode .conexao-card-criar:hover .conexao-card-criar-title {
            color: #6C63FF;
        }

        body.dark-mode .conexao-card-criar-desc {
            color: rgba(255, 255, 255, 0.4);
        }

        /* light-mode config button overrides are now default (light is the base) */

        /* Loading state - mesmo design dos cards de conexão, cinza piscando (shimmer igual chat.html) */
        .loading-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .loading-skeleton-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 0;
            position: relative;
            min-height: 0;
            box-sizing: border-box;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        body.dark-mode .loading-skeleton-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        /* Indicator bar on left */
        .loading-skeleton-card .skeleton-indicator {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            border-radius: 24px 0 0 24px;
            background: linear-gradient(90deg, #e2e8f0 0%, #f1f5f9 35%, #e2e8f0 70%, #eef2f7 100%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.8s ease-in-out infinite;
        }

        .loading-skeleton-card .skeleton-header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px 24px 0 28px;
            margin-bottom: 16px;
        }

        .loading-skeleton-card .skeleton-avatar {
            width: 56px;
            height: 56px;
            min-width: 56px;
            flex-shrink: 0;
            border-radius: 16px;
            background: linear-gradient(90deg, #e2e8f0 0%, #f1f5f9 35%, #e2e8f0 70%, #eef2f7 100%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.8s ease-in-out infinite;
        }

        .loading-skeleton-card .skeleton-info {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
            justify-content: center;
        }

        .loading-skeleton-card .skeleton-line-name {
            height: 18px;
            border-radius: 6px;
            width: 65%;
            max-width: 160px;
            background: linear-gradient(90deg, #e2e8f0 0%, #f1f5f9 35%, #e2e8f0 70%, #eef2f7 100%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.8s ease-in-out infinite;
        }

        .loading-skeleton-card .skeleton-line-phone {
            height: 12px;
            border-radius: 4px;
            width: 45%;
            max-width: 110px;
            background: linear-gradient(90deg, #e2e8f0 0%, #f1f5f9 35%, #e2e8f0 70%, #eef2f7 100%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.8s ease-in-out infinite 0.2s;
        }

        /* Status badge skeleton */
        .loading-skeleton-card .skeleton-status {
            width: 92px;
            height: 26px;
            border-radius: 8px;
            margin: 0 24px 16px 28px;
            background: linear-gradient(90deg, #e2e8f0 0%, #f1f5f9 35%, #e2e8f0 70%, #eef2f7 100%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.8s ease-in-out infinite 0.15s;
        }

        /* Date skeleton */
        .loading-skeleton-card .skeleton-date {
            width: 130px;
            height: 22px;
            border-radius: 6px;
            margin: 0 24px 24px 28px;
            background: linear-gradient(90deg, #e2e8f0 0%, #f1f5f9 35%, #e2e8f0 70%, #eef2f7 100%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.8s ease-in-out infinite 0.3s;
        }

        .loading-skeleton-card .skeleton-actions {
            display: flex;
            gap: 12px;
            padding: 20px;
            margin-top: auto;
            border-top: 1px solid #f1f5f9;
        }

        body.dark-mode .loading-skeleton-card .skeleton-actions {
            border-top-color: rgba(71, 85, 105, 0.3);
        }

        .loading-skeleton-card .skeleton-btn {
            flex: 1;
            min-height: 0;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(90deg, #e2e8f0 0%, #f1f5f9 35%, #e2e8f0 70%, #eef2f7 100%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.8s ease-in-out infinite 0.4s;
        }

        .loading-skeleton-card .skeleton-btn-small {
            flex: 0;
            width: 44px;
            min-width: 44px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(90deg, #e2e8f0 0%, #f1f5f9 35%, #e2e8f0 70%, #eef2f7 100%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.8s ease-in-out infinite 0.5s;
        }

        @keyframes skeleton-shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        body.dark-mode .loading-skeleton-card .skeleton-indicator,
        body.dark-mode .loading-skeleton-card .skeleton-status,
        body.dark-mode .loading-skeleton-card .skeleton-avatar,
        body.dark-mode .loading-skeleton-card .skeleton-line-name,
        body.dark-mode .loading-skeleton-card .skeleton-line-phone,
        body.dark-mode .loading-skeleton-card .skeleton-date,
        body.dark-mode .loading-skeleton-card .skeleton-btn,
        body.dark-mode .loading-skeleton-card .skeleton-btn-small {
            background: linear-gradient(90deg, rgba(51,65,85,0.5) 0%, rgba(71,85,105,0.5) 35%, rgba(51,65,85,0.5) 70%, rgba(61,75,95,0.5) 100%);
            background-size: 200% 100%;
        }

        /* Conexões Grid */
        .conexoes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .conexao-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 0;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .conexao-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* Left color indicator bar */
        .card-indicator {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            background: #6C63FF;
            border-radius: 24px 0 0 24px;
        }

        .card-indicator.disconnected { background: #ef4444; }
        .card-indicator.checking { background: #f59e0b; }

        .conexao-card.card-desconectado {
            border-color: #fee2e2;
            opacity: 0.9;
        }

        .conexao-header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px 24px 0 28px;
            margin-bottom: 16px;
        }

        .profile-photo {
            width: 56px;
            height: 56px;
            min-width: 56px;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            object-fit: cover;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        img.profile-photo {
            padding: 0;
        }

        .profile-photo svg {
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .profile-photo:hover svg {
            color: #6C63FF;
            transform: scale(1.1);
        }

        .conexao-info h3 {
            font-size: 1.125rem;
            font-weight: 800;
            margin-bottom: 4px;
            color: #0f172a;
            line-height: 1.2;
        }

        .telefone {
            color: #64748b;
            font-size: 0.75rem;
            font-family: 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', monospace;
        }

        .card-status-area {
            padding: 0 24px 0 28px;
            margin-bottom: 20px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            width: fit-content;
        }

        .status-conectado {
            background: #ecfdf5;
            color: #6C63FF;
            border: 1px solid #d1fae5;
        }

        .status-dot {
            position: relative;
            display: inline-flex;
            width: 8px;
            height: 8px;
        }

        .status-dot-ping {
            position: absolute;
            display: inline-flex;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #5ee99a;
            opacity: 0.75;
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .status-dot-core {
            position: relative;
            display: inline-flex;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #6C63FF;
        }

        @keyframes ping {
            75%, 100% { transform: scale(2); opacity: 0; }
        }

        .status-desconectado {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
        }

        .status-desconectado .status-dot-core { background: #ef4444; }
        .status-desconectado .status-dot-ping { background: transparent; animation: none; }

        .status-verificando {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fef3c7;
        }

        .status-verificando .status-dot-core { background: #f59e0b; }
        .status-verificando .status-dot-ping { background: #fbbf24; }

        /* Card date info */
        .card-date-info {
            padding: 0 24px 24px 28px;
        }

        .card-date-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 500;
            color: #94a3b8;
            background: #f8fafc;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #f1f5f9;
        }

        .conexao-actions {
            display: flex;
            gap: 12px;
            padding: 20px;
            margin-top: auto;
            border-top: 1px solid #f1f5f9;
            background: white;
        }

        .btn-verificar {
            flex: 1;
            padding: 10px;
            background: #6C63FF;
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-verificar svg,
        .btn-qrcode svg,
        .btn-excluir svg {
            transition: all 0.3s ease;
        }

        .btn-verificar:hover svg {
            transform: rotate(180deg);
        }

        .btn-qrcode:hover svg {
            transform: scale(1.1);
        }

        .btn-excluir:hover svg {
            transform: scale(1.1);
        }

        .btn-verificar:hover {
            background: #1fb954;
        }

        .btn-verificar:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            transform: none;
        }

        .btn-excluir {
            padding: 12px;
            background: rgba(255, 59, 48, 0.1);
            border: 1px solid rgba(255, 59, 48, 0.3);
            border-radius: 12px;
            color: #ff3b30;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-excluir:hover {
            background: rgba(255, 59, 48, 0.2);
        }

        .btn-config-conexao {
            width: 44px;
            height: 44px;
            min-width: 44px;
            padding: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .btn-config-conexao:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .btn-qrcode {
            flex: 1;
            padding: 10px;
            background: #6C63FF;
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.3);
        }

        .btn-qrcode:hover {
            background: #6C63FF;
        }

        /* Dark mode for cards */
        body.dark-mode .conexao-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .conexao-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border-color: rgba(71, 85, 105, 0.6);
        }

        body.dark-mode .conexao-card.card-desconectado {
            border-color: rgba(239, 68, 68, 0.25);
        }

        body.dark-mode .profile-photo {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .profile-photo svg { color: rgba(255, 255, 255, 0.5); }

        body.dark-mode .conexao-info h3 { color: #e2e8f0; }
        body.dark-mode .telefone { color: #94a3b8; }

        body.dark-mode .status-conectado {
            background: rgba(108, 99, 255, 0.15);
            color: #5ee99a;
            border-color: rgba(108, 99, 255, 0.25);
        }

        body.dark-mode .status-desconectado {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.25);
        }

        body.dark-mode .status-verificando {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.25);
        }

        body.dark-mode .card-date-badge {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
            color: #94a3b8;
        }

        body.dark-mode .conexao-actions {
            border-color: rgba(71, 85, 105, 0.3);
            background: rgba(30, 41, 59, 0.4);
        }

        body.dark-mode .btn-verificar {
            background: rgba(51, 65, 85, 0.6);
            color: #f8fafc;
        }

        body.dark-mode .btn-verificar:hover {
            background: rgba(71, 85, 105, 0.6);
        }

        body.dark-mode .btn-verificar:disabled {
            background: rgba(51, 65, 85, 0.3);
            color: #64748b;
        }

        body.dark-mode .btn-config-conexao {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
            color: #94a3b8;
        }

        body.dark-mode .btn-config-conexao:hover {
            background: rgba(71, 85, 105, 0.5);
            color: #f8fafc;
        }

        body.dark-mode .btn-qrcode {
            background: #6C63FF;
        }

        body.dark-mode .btn-qrcode:hover {
            background: #6C63FF;
        }

        /* QR Code Modal */
        .qr-modal {
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

        .qr-modal.show {
            display: flex;
        }

        .qr-modal-content {
            background: rgba(26, 26, 26, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(20px);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        .qr-modal h3 {
            color: #6C63FF;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .qr-code-container {
            background: white;
            padding: 24px;
            border-radius: 24px;
            margin: 16px auto;
            display: inline-block;
            border: 1px solid #f1f5f9;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
            position: relative;
        }

        .qr-code-container::before {
            content: '';
            position: absolute;
            inset: -4px;
            border: 3px solid rgba(108, 99, 255, 0.2);
            border-radius: 28px;
            pointer-events: none;
            animation: pulse-border 2s ease-in-out infinite;
        }

        @keyframes pulse-border {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .qr-code-container img {
            width: 220px;
            height: 220px;
            object-fit: contain;
            border-radius: 12px;
        }

        .qr-timer {
            color: #6C63FF;
            font-size: 0.8125rem;
            font-weight: 700;
            margin: 12px 0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ecfdf5;
            padding: 6px 14px;
            border-radius: 20px;
        }

        body.dark-mode .qr-code-container {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .qr-code-container::before {
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.dark-mode .qr-timer {
            background: rgba(108, 99, 255, 0.15);
            color: #5ee99a;
        }

        .qr-close {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qr-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Modal Configurações da Conexão (referência chat.html) */
        .config-conexao-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 10001;
            backdrop-filter: blur(5px);
        }
        .config-conexao-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .config-conexao-modal-content {
            background: #1e293b;
            border: 1px solid rgba(71, 85, 105, 0.45);
            border-radius: 16px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            backdrop-filter: none;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
        }
        body.dark-mode .config-conexao-modal {
            background: rgba(0, 0, 0, 0.7);
        }
        .config-conexao-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .config-conexao-modal-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }
        .config-conexao-modal-close {
            background: none;
            border: none;
            color: #888;
            padding: 6px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .config-conexao-modal-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .config-conexao-modal-header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .config-conexao-modal-btn-excluir {
            background: none;
            border: none;
            color: #888;
            padding: 6px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .config-conexao-modal-btn-excluir:hover {
            background: rgba(255, 59, 48, 0.15);
            color: #ff3b30;
        }
        .config-conexao-tabs {
            display: flex;
            gap: 4px;
            margin-bottom: 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .config-tab {
            padding: 10px 18px;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            transition: all 0.2s;
        }
        .config-tab:hover { color: rgba(255, 255, 255, 0.9); }
        .config-tab.active { color: #6C63FF; border-bottom-color: #6C63FF; }
        .config-tab-content { display: none; }
        .config-tab-content.active { display: block; }
        .config-field { margin-bottom: 18px; }
        .config-field label { display: block; color: rgba(255, 255, 255, 0.65); font-size: 0.875rem; font-weight: 500; margin-bottom: 6px; }
        .config-value { color: rgba(255, 255, 255, 0.95); font-size: 1rem; margin: 0; }
        /* Status no popup = mesmo visual do badge do card (borda arredondada, espaçamento) */
        .config-field-status { margin-bottom: 22px; }
        .config-status-badge-wrap {
            display: inline-block;
            margin-top: 4px;
        }
        .config-status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid;
        }
        .config-status-badge.status-conectado {
            background: rgba(108, 99, 255, 0.2);
            color: #6C63FF;
            border-color: rgba(108, 99, 255, 0.3);
        }
        .config-status-badge.status-desconectado {
            background: rgba(255, 59, 48, 0.2);
            color: #ff3b30;
            border-color: rgba(255, 59, 48, 0.3);
        }
        .config-status-badge.status-verificando {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border-color: rgba(255, 193, 7, 0.3);
        }
        .config-conexao-actions { display: flex; gap: 12px; margin-top: 20px; flex-wrap: wrap; }
        .btn-gerar-qr-config, .btn-desconectar-config {
            padding: 12px 18px;
            border-radius: 8px;
            border: 1px solid;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-gerar-qr-config { background: rgba(108, 99, 255, 0.1); border-color: rgba(108, 99, 255, 0.3); color: #6C63FF; }
        .btn-gerar-qr-config:hover { background: rgba(108, 99, 255, 0.2); }
        .btn-desconectar-config { background: rgba(255, 59, 48, 0.1); border-color: rgba(255, 59, 48, 0.3); color: #ff3b30; }
        .btn-desconectar-config:hover { background: rgba(255, 59, 48, 0.2); }
        .config-section-title { color: #fff; font-size: 1.05rem; font-weight: 600; margin-bottom: 8px; }
        .config-section-desc { color: rgba(255, 255, 255, 0.6); font-size: 0.9rem; margin-bottom: 16px; line-height: 1.4; }
        /* Aviso amarelo quando desconectado */
        .config-sync-aviso {
            background: rgba(255, 193, 7, 0.15);
            border: 1px solid rgba(255, 193, 7, 0.35);
            color: #e6b800;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 14px;
            line-height: 1.4;
        }
        .btn-sincronizar-contatos {
            padding: 12px 20px;
            background: rgba(108, 99, 255, 0.15);
            border: 1px solid rgba(108, 99, 255, 0.3);
            border-radius: 8px;
            color: #6C63FF;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-sincronizar-contatos:hover:not(:disabled) { background: rgba(108, 99, 255, 0.25); }
        .btn-sincronizar-contatos:disabled {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.4);
            cursor: not-allowed;
        }
        .config-message { font-size: 0.875rem; margin-top: 10px; }
        .config-message.success { color: #6C63FF; }
        .config-message.error { color: #ff3b30; }
        /* Popup configuração da conexão - Light mode (reforço de especificidade) */
        body.light-mode .config-conexao-modal .config-conexao-modal-content {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.12);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            backdrop-filter: none;
        }
        body.light-mode .config-conexao-modal-title {
            color: #222;
        }
        body.light-mode .config-conexao-modal-close {
            color: #555;
        }
        body.light-mode .config-conexao-modal-close:hover {
            background: rgba(0, 0, 0, 0.08);
            color: #222;
        }
        body.light-mode .config-conexao-modal-btn-excluir {
            color: #555;
        }
        body.light-mode .config-conexao-modal-btn-excluir:hover {
            background: rgba(255, 59, 48, 0.12);
            color: #ff3b30;
        }
        body.light-mode .config-conexao-tabs {
            border-bottom-color: rgba(0, 0, 0, 0.12);
        }
        body.light-mode .config-tab {
            color: #666;
        }
        body.light-mode .config-tab:hover {
            color: #222;
        }
        body.light-mode .config-tab.active {
            color: #6C63FF;
            border-bottom-color: #6C63FF;
        }
        body.light-mode .config-field label {
            color: #555;
        }
        body.light-mode .config-value {
            color: #222;
        }
        body.light-mode .config-section-title {
            color: #222;
        }
        body.light-mode .config-section-desc {
            color: #555;
        }
        body.light-mode .config-sync-aviso {
            background: rgba(255, 193, 7, 0.15);
            border-color: rgba(255, 193, 7, 0.35);
            color: #b38600;
        }
        body.light-mode .btn-sincronizar-contatos {
            background: rgba(108, 99, 255, 0.12);
            border-color: rgba(108, 99, 255, 0.3);
            color: #6C63FF;
        }
        body.light-mode .btn-sincronizar-contatos:hover:not(:disabled) {
            background: rgba(108, 99, 255, 0.2);
        }
        body.light-mode .btn-sincronizar-contatos:disabled {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.1);
            color: #888;
        }
        body.light-mode .config-message.success { color: #15803d; }
        body.light-mode .config-message.error { color: #b91c1c; }
        /* Modal de Confirmação */
        .confirm-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            padding: 16px;
        }

        .confirm-modal.show {
            display: flex;
        }

        .confirm-modal-content {
            background: white;
            border: none;
            border-radius: 2rem;
            padding: 0;
            max-width: 440px;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }

        .confirm-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 24px 32px;
            border-bottom: 1px solid #f1f5f9;
        }

        .confirm-header svg {
            color: #ef4444;
            flex-shrink: 0;
        }

        .confirm-header h3 {
            color: #0f172a;
            font-size: 1.25rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .confirm-body {
            padding: 24px 32px;
            background: #fbfcfd;
        }

        .confirm-body p {
            color: #334155;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .confirm-details {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 16px;
            padding: 16px;
            margin-top: 12px;
        }

        .confirm-details h4 {
            color: #dc2626;
            margin: 0 0 10px 0;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .confirm-details ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .confirm-details li {
            color: #475569;
            padding: 6px 0;
            border-bottom: 1px solid #fecaca;
            font-size: 0.8125rem;
            font-weight: 500;
        }

        .confirm-details li:last-child {
            border-bottom: none;
        }

        .confirm-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding: 20px 32px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-confirm-cancel {
            background: white;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 10px 20px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 700;
            font-size: 0.8125rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .btn-confirm-cancel:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-confirm-delete {
            background: #ef4444;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 700;
            font-size: 0.8125rem;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.3);
        }

        .btn-confirm-delete:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(255, 59, 48, 0.3);
        }

        .btn-confirm-delete:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            color: #94a3b8;
        }

        /* Dark mode confirm modal */
        body.dark-mode .confirm-modal {
            background: rgba(0, 0, 0, 0.7);
        }

        body.dark-mode .confirm-modal-content {
            background: #1e293b;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .confirm-header {
            border-bottom-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .confirm-header h3 {
            color: #f8fafc;
        }

        body.dark-mode .confirm-body {
            background: rgba(15, 23, 42, 0.5);
        }

        body.dark-mode .confirm-body p {
            color: #e2e8f0;
        }

        body.dark-mode .confirm-details {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.25);
        }

        body.dark-mode .confirm-details h4 {
            color: #f87171;
        }

        body.dark-mode .confirm-details li {
            color: #e2e8f0;
            border-bottom-color: rgba(239, 68, 68, 0.15);
        }

        body.dark-mode .confirm-actions {
            border-top-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .btn-confirm-cancel {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
            color: #e2e8f0;
        }

        body.dark-mode .btn-confirm-cancel:hover {
            background: rgba(71, 85, 105, 0.5);
        }

        body.dark-mode .btn-confirm-delete:disabled {
            background: rgba(51, 65, 85, 0.5);
            color: #64748b;
        }

        /* ChatGPT API Key Modal */
        .chatgpt-modal {
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

        .chatgpt-modal.show {
            display: flex;
        }

        .chatgpt-modal-content {
            background: rgba(26, 26, 26, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(20px);
            max-width: 500px;
            width: 90%;
        }

        .chatgpt-modal h3 {
            color: #10a37f;
            margin-bottom: 20px;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chatgpt-modal-body {
            margin: 20px 0;
        }

        .form-group-modal {
            margin-bottom: 20px;
        }

        .form-group-modal label {
            display: block;
            color: #fff;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-group-modal input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 12px 15px;
            color: white;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group-modal input:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }

        .form-group-modal input::placeholder {
            color: #888;
        }

        .chatgpt-modal-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .btn-modal-cancel {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-modal-cancel:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-modal-save {
            background: linear-gradient(135deg, #10a37f 0%, #0d8f6b 100%);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-modal-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 163, 127, 0.3);
        }

        .btn-modal-save:disabled {
            background: #444;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Modal de Criar Conexão */
        .criar-conexao-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            padding: 16px;
        }

        .criar-conexao-modal.show {
            display: flex;
        }

        .criar-conexao-modal-content {
            background: white;
            border: none;
            border-radius: 2rem;
            padding: 0;
            max-width: 440px;
            width: 100%;
            max-height: 90vh;
            text-align: left;
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
            transform: translateY(0);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        /* Modal Header */
        .modal-header-bar {
            padding: 24px 32px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .modal-close-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f8fafc;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            padding: 0;
            flex-shrink: 0;
        }

        .modal-close-btn:hover {
            background: #f1f5f9;
            color: #475569;
        }

        .modal-close-btn svg {
            transition: all 0.2s ease;
        }

        .modal-close-btn:hover svg {
            transform: rotate(90deg);
        }

        .criar-conexao-modal h3 {
            color: #0f172a;
            margin: 0;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        /* Modal Body */
        .modal-body-area {
            padding: 32px;
            overflow-y: auto;
            background: #fbfcfd;
            flex: 1;
        }

        .modal-subtitle {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .criar-conexao-section {
            margin-bottom: 0;
            margin-top: 0;
        }

        .criar-conexao-section h4 {
            color: #334155;
            font-size: 0.875rem;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: left;
        }

        .criar-conexao-section .form-group-modal {
            margin-bottom: 16px;
        }

        .criar-conexao-section .form-group-modal input {
            width: 100%;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
            color: #0f172a;
            font-size: 0.875rem;
            font-weight: 500;
            outline: none;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .criar-conexao-section .form-group-modal input:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.15);
        }

        .criar-conexao-section .form-group-modal input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .btn-gerar-qr {
            width: 100%;
            padding: 14px 20px;
            background: #6C63FF;
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.3);
        }

        .btn-gerar-qr:hover {
            background: #6C63FF;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(108, 99, 255, 0.35);
        }

        .btn-gerar-qr:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            color: #94a3b8;
        }

        .modal-footer {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
            margin-top: 24px;
            flex-shrink: 0;
        }

        .link-pareamento {
            color: #6C63FF;
            text-decoration: none;
            font-size: 0.8125rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .link-pareamento:hover {
            color: #6C63FF;
            text-decoration: underline;
        }

        .instructions-toggle {
            background: none;
            border: none;
            color: #6C63FF;
            cursor: pointer;
            font-size: 0.8125rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
            padding: 8px 14px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .instructions-toggle:hover {
            background: rgba(108, 99, 255, 0.08);
        }

        .instructions-toggle svg {
            transition: transform 0.3s ease;
        }

        .instructions-content {
            margin-top: 16px;
            padding: 20px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            text-align: left;
            animation: slideDown 0.3s ease-out;
            flex: 1;
            overflow-y: auto;
            max-height: 400px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .instructions-content h4 {
            color: #0f172a;
            margin-bottom: 16px;
            font-size: 0.875rem;
            font-weight: 700;
            text-align: left;
        }

        .instruction-step {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
        }

        .instruction-step:last-child {
            margin-bottom: 0;
        }

        .step-number {
            background: #ecfdf5;
            color: #6C63FF;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .step-content h5 {
            color: #334155;
            margin-bottom: 2px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .step-content p {
            color: #64748b;
            font-size: 0.8125rem;
            line-height: 1.5;
            margin: 0;
        }

        .step-content strong {
            color: #0f172a;
            font-weight: 700;
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

        /* Dark mode modal */
        body.dark-mode .criar-conexao-modal {
            background: rgba(0, 0, 0, 0.7);
        }

        body.dark-mode .criar-conexao-modal-content {
            background: #1e293b;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .modal-header-bar {
            border-bottom-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .criar-conexao-modal h3 {
            color: #f8fafc;
        }

        body.dark-mode .modal-close-btn {
            background: rgba(51, 65, 85, 0.5);
            color: #94a3b8;
        }

        body.dark-mode .modal-close-btn:hover {
            background: rgba(71, 85, 105, 0.5);
            color: #f8fafc;
        }

        body.dark-mode .modal-body-area {
            background: rgba(15, 23, 42, 0.5);
        }

        body.dark-mode .modal-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .criar-conexao-section h4 {
            color: #e2e8f0;
        }

        body.dark-mode .criar-conexao-section .form-group-modal input {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(71, 85, 105, 0.4);
            color: #f8fafc;
            box-shadow: none;
        }

        body.dark-mode .criar-conexao-section .form-group-modal input:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        body.dark-mode .criar-conexao-section .form-group-modal input::placeholder {
            color: #64748b;
        }

        body.dark-mode .btn-gerar-qr:disabled {
            background: rgba(51, 65, 85, 0.5);
            color: #64748b;
        }

        body.dark-mode .instructions-content {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .instructions-content h4 {
            color: #f8fafc;
        }

        body.dark-mode .instruction-step {
            background: transparent;
        }

        body.dark-mode .step-number {
            background: rgba(108, 99, 255, 0.15);
            color: #6C63FF;
        }

        body.dark-mode .step-content h5 {
            color: #e2e8f0;
        }

        body.dark-mode .step-content p {
            color: #94a3b8;
        }

        body.dark-mode .step-content strong {
            color: #f8fafc;
        }

        /* Scroll personalizado para o modal */
        .criar-conexao-modal-content::-webkit-scrollbar {
            width: 6px;
        }

        .criar-conexao-modal-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .criar-conexao-modal-content::-webkit-scrollbar-thumb {
            background: rgba(108, 99, 255, 0.5);
            border-radius: 3px;
        }

        .criar-conexao-modal-content::-webkit-scrollbar-thumb:hover {
            background: rgba(108, 99, 255, 0.7);
        }

        .instructions-content::-webkit-scrollbar {
            width: 4px;
        }

        .instructions-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }

        .instructions-content::-webkit-scrollbar-thumb {
            background: rgba(108, 99, 255, 0.4);
            border-radius: 2px;
        }

        .instructions-content::-webkit-scrollbar-thumb:hover {
            background: rgba(108, 99, 255, 0.6);
        }

        /* Estilos para as telas do modal */
        .modal-screen {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .btn-modal-back {
            background: transparent;
            border: none;
            color: #94a3b8;
            padding: 8px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 700;
            font-size: 0.8125rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-modal-back:hover {
            color: #475569;
        }

        body.dark-mode .btn-modal-back {
            color: #94a3b8;
        }

        body.dark-mode .btn-modal-back:hover {
            color: #f8fafc;
        }

        .code-container {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 28px;
            text-align: center;
            margin: 16px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .code-container h4 {
            color: #0f172a;
            margin-bottom: 16px;
            font-size: 0.875rem;
            font-weight: 700;
        }

        .pairing-code {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            background: #6C63FF;
            padding: 16px 32px;
            border-radius: 16px;
            margin: 16px 0;
            letter-spacing: 4px;
            font-family: 'SFMono-Regular', 'Menlo', monospace;
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.3);
        }

        .code-container p {
            color: #64748b;
            font-size: 0.8125rem;
            margin-top: 12px;
            font-weight: 500;
        }

        body.dark-mode .code-container {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .code-container h4 {
            color: #f8fafc;
        }

        body.dark-mode .code-container p {
            color: #94a3b8;
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

        /* Error/Success messages */
        .error-message, .success-message {
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            text-align: center;
        }

        .error-message {
            background: rgba(255, 59, 48, 0.1);
            border: 1px solid rgba(255, 59, 48, 0.3);
            color: #ff3b30;
        }

        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
        }

        /* Animations */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .conexao-card,
        .conexao-card-criar {
            animation: fadeIn 0.5s ease-out;
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
            /* Mobile Menu Toggle - Sempre visível no mobile */
            .mobile-menu-toggle {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
            }

            /* Sidebar Mobile - Desabilitar hover completamente */
            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                height: 100vh;
                z-index: 9999;
                transition: left 0.3s ease;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
                /* IMPORTANTE: Desabilitar hover no mobile */
                pointer-events: none;
            }

            .sidebar.mobile-open {
                left: 0;
                width: 250px;
                pointer-events: auto; /* Reabilitar quando aberto */
            }

            .sidebar.mobile-open .menu-text {
                opacity: 1 !important;
            }

            .sidebar.mobile-open .sidebar-logo-link {
                width: 100%;
                min-width: 180px;
            }

            .sidebar.mobile-open .version-text {
                opacity: 1 !important;
            }

            /* DESABILITAR TODOS OS HOVER NO MOBILE */
            .sidebar:hover {
                width: 250px !important;
                left: -250px !important; /* Manter fora da tela */
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


            /* Main Content Mobile */
            .main-content {
                padding: 20px;
                margin-left: 0;
            }

            .header {
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }

            .header-content h1 {
                font-size: 1.75rem;
            }

            .header-actions {
                justify-content: center;
                flex-direction: column;
                gap: 15px;
            }

            .btn-nova-conexao {
                font-size: 0.85rem;
                padding: 12px 18px;
            }

            .btn-criar-conexao {
                font-size: 0.85rem;
                padding: 10px 16px;
            }

            .btn-chatgpt {
                font-size: 0.85rem;
                padding: 10px 16px;
            }

            .kpi-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .conexoes-toolbar {
                flex-direction: column;
                gap: 8px;
            }

            .toolbar-search {
                min-width: 100%;
                max-width: none;
            }

            .toolbar-divider {
                display: none;
            }

            .toolbar-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .conexoes-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .loading-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                width: 60px;
            }

            .sidebar:hover {
                width: 200px;
            }

            .chatgpt-modal-content {
                padding: 30px 20px;
                margin: 20px;
            }

            .criar-conexao-modal-content {
                padding: 30px 20px;
                margin: 20px;
                max-height: 95vh;
            }

            .criar-conexao-modal h3 {
                font-size: 1.5rem;
            }

            .modal-subtitle {
                font-size: 0.9rem;
            }

            .modal-close-btn {
                top: 10px;
                right: 10px;
                width: 32px;
                height: 32px;
            }

            .modal-close-btn svg {
                width: 18px;
                height: 18px;
            }

            .instructions-content {
                padding: 15px;
                margin-top: 15px;
                max-height: 300px;
            }

            .instruction-step {
                padding: 12px;
                gap: 12px;
            }

            .step-number {
                width: 24px;
                height: 24px;
                font-size: 0.8rem;
            }

            .step-content h5 {
                font-size: 0.95rem;
            }

            .step-content p {
                font-size: 0.85rem;
            }

            .code-container {
                padding: 20px;
            }

            .pairing-code {
                font-size: 2rem;
                padding: 15px 25px;
                letter-spacing: 2px;
            }

            .mobile-menu-toggle {
                top: 15px;
                left: 15px;
                padding: 10px;
                background: rgba(0, 0, 0, 0.8);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 8px;
                backdrop-filter: blur(10px);
            }

            .mobile-menu-toggle svg {
                width: 20px;
                height: 20px;
                color: #6C63FF;
            }

            .mobile-menu-toggle:hover {
                background: rgba(108, 99, 255, 0.2);
                border-color: rgba(108, 99, 255, 0.3);
            }

            /* Mostrar botão de fechar apenas no mobile */
            .mobile-close-btn {
                display: flex;
            }

            .mobile-close-btn:hover {
                background: rgba(108, 99, 255, 0.2);
            }
        }

        /* Toast Notification System */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            pointer-events: none;
        }

        .toast-notification {
            background: rgba(108, 99, 255, 0.1);
            border: 1px solid rgba(108, 99, 255, 0.3);
            color: #6C63FF;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 350px;
            transform: translateX(400px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            pointer-events: auto;
        }

        .toast-notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-notification.success {
            background: rgba(34, 197, 94, 0.1);
            border-color: rgba(34, 197, 94, 0.3);
            color: #22c55e;
        }

        .toast-notification.error {
            background: rgba(255, 68, 68, 0.1);
            border-color: rgba(255, 68, 68, 0.3);
            color: #ff4444;
        }

        .toast-notification.info {
            background: rgba(255, 193, 7, 0.1);
            border-color: rgba(255, 193, 7, 0.3);
            color: #ffc107;
        }
.toast-message {
            flex: 1;
        }

        /* Responsive para toast */

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
        
        console.log('✅ Supabase inicializado globalmente');
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
    <!-- Depois de dropdowns-global.css: filtro da toolbar no dark -->
    <style>
        body.dark-mode .toolbar-select,
        body.dark-mode #toolbarFilterSelect {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: rgba(51, 65, 85, 0.88) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 12px center !important;
            border: 1px solid rgba(71, 85, 105, 0.55) !important;
            border-radius: 12px !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            padding: 10px 32px 10px 16px !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.22) !important;
            cursor: pointer !important;
        }

        body.dark-mode .toolbar-select:hover {
            background-color: rgba(71, 85, 105, 0.8) !important;
            border-color: rgba(100, 116, 139, 0.65) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
        }

        body.dark-mode .toolbar-select:focus {
            outline: none !important;
            border-color: rgba(108, 99, 255, 0.55) !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.18) !important;
        }

        body.dark-mode .toolbar-select option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
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
        <div class="sidebar">
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
                <a href="#" class="menu-item" onclick="navigateToPage('/hublabel/public/hublabel/public/dashboard')">
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
                <a href="#" class="menu-item" data-menu-id="agentes-ia" onclick="navigateToPage('/hublabel/public/hublabel/public/agentes-ia')">
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
                <a href="#" class="menu-item active" data-menu-id="conexoes">
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
                        <input type="checkbox" id="darkModeToggle">
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
            <div class="header">
                <div class="header-content">
                    <h1>Conexões WhatsApp</h1>
                    <p>Gerencie todas as suas conexões e vincule novos números em um só lugar.</p>
                </div>
                <div class="header-actions">
                </div>
            </div>

            <!-- KPI Stats Cards -->
            <div class="kpi-grid" id="kpiGrid">
                <div class="kpi-card">
                    <div class="kpi-card-header">
                        <span class="kpi-card-label">Total de Conexões</span>
                        <div class="kpi-card-icon default">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                        </div>
                    </div>
                    <div class="kpi-card-value">
                        <span class="kpi-card-number" id="kpiTotal">0</span>
                        <span class="kpi-card-sublabel">aparelhos</span>
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-card-header">
                        <span class="kpi-card-label">Conectadas</span>
                        <div class="kpi-card-icon success">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                    </div>
                    <div class="kpi-card-value">
                        <span class="kpi-card-number success" id="kpiConectadas">0</span>
                        <span class="kpi-card-sublabel">ativas</span>
                    </div>
                </div>
                <div class="kpi-card danger-border">
                    <div class="kpi-card-header">
                        <span class="kpi-card-label" style="color: #ef4444;">Desconectadas</span>
                        <div class="kpi-card-icon danger">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        </div>
                    </div>
                    <div class="kpi-card-value">
                        <span class="kpi-card-number danger" id="kpiDesconectadas">0</span>
                        <span class="kpi-card-sublabel danger">inativas</span>
                    </div>
                </div>
            </div>

            <!-- Toolbar / Search / Filters -->
            <div class="conexoes-toolbar" id="conexoesToolbar" style="display: none;">
                <div class="toolbar-search">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="toolbarSearchInput" placeholder="Buscar por número ou nome..." oninput="filtrarConexoes()">
                </div>
                <div class="toolbar-divider"></div>
                <div class="toolbar-actions">
                    <select class="toolbar-select" id="toolbarFilterSelect" onchange="filtrarConexoes()">
                        <option value="todas">Todas as conexões</option>
                        <option value="conectadas">Apenas Conectadas</option>
                        <option value="desconectadas">Apenas Desconectadas</option>
                    </select>
                    <button class="toolbar-btn-delete" onclick="excluirConexoesDesconectadas()" id="toolbarBtnDelete" style="display: none;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"></polyline><path d="M19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path></svg>
                        Excluir Desconectadas
                    </button>
                </div>
            </div>

            <!-- Loading State - mesmo design dos cards, cinza piscando (shimmer igual chat) -->
            <div class="loading-container" id="loadingContainer">
                <div class="loading-skeleton-card">
                    <div class="skeleton-indicator"></div>
                    <div class="skeleton-header">
                        <div class="skeleton-avatar"></div>
                        <div class="skeleton-info">
                            <div class="skeleton-line-name"></div>
                            <div class="skeleton-line-phone"></div>
                        </div>
                    </div>
                    <div class="skeleton-status"></div>
                    <div class="skeleton-date"></div>
                    <div class="skeleton-actions">
                        <div class="skeleton-btn"></div>
                        <div class="skeleton-btn-small"></div>
                    </div>
                </div>
                <div class="loading-skeleton-card">
                    <div class="skeleton-indicator"></div>
                    <div class="skeleton-header">
                        <div class="skeleton-avatar"></div>
                        <div class="skeleton-info">
                            <div class="skeleton-line-name"></div>
                            <div class="skeleton-line-phone"></div>
                        </div>
                    </div>
                    <div class="skeleton-status"></div>
                    <div class="skeleton-date"></div>
                    <div class="skeleton-actions">
                        <div class="skeleton-btn"></div>
                        <div class="skeleton-btn-small"></div>
                    </div>
                </div>
                <div class="loading-skeleton-card">
                    <div class="skeleton-indicator"></div>
                    <div class="skeleton-header">
                        <div class="skeleton-avatar"></div>
                        <div class="skeleton-info">
                            <div class="skeleton-line-name"></div>
                            <div class="skeleton-line-phone"></div>
                        </div>
                    </div>
                    <div class="skeleton-status"></div>
                    <div class="skeleton-date"></div>
                    <div class="skeleton-actions">
                        <div class="skeleton-btn"></div>
                        <div class="skeleton-btn-small"></div>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="error-message" id="errorMessage" style="display: none;"></div>

            <!-- Success Message -->
            <div class="success-message" id="successMessage" style="display: none;"></div>

            <!-- Conexões Grid -->
            <div class="conexoes-grid" id="conexoesGrid" style="display: none;"></div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                </div>
                <h3>Nenhuma conexão encontrada</h3>
                <p>Você ainda não possui conexões WhatsApp.<br>Clique em "Nova Conexão" para começar.</p>
            </div>
        </div>
    </div>

    <!-- Botão Fixo de Excluir Conexões Desconectadas -->
    <button class="btn-delete-disconnected" onclick="excluirConexoesDesconectadas()" id="btnDeleteDisconnected" style="display: none;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="3,6 5,6 21,6"></polyline>
            <path d="M19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
        </svg>
        Excluir conexões desconectadas
    </button>

    <!-- QR Code Modal -->
    <div class="qr-modal" id="qrModal">
        <div class="qr-modal-content">
            <h3>Escaneie o QR Code</h3>
            <div class="qr-code-container">
                <img id="qrImage" src="" alt="QR Code">
            </div>
            <div class="qr-timer" id="qrTimer">Expira em 29 segundos</div>
            <button class="qr-close" id="closeQrModal">Fechar</button>
        </div>
    </div>

    <!-- Modal de Confirmação para Exclusão -->
    <div class="confirm-modal" id="confirmModal">
        <div class="confirm-modal-content">
            <div class="confirm-header">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <h3>Confirmar Exclusão</h3>
            </div>
            <div class="confirm-body">
                <p id="confirmMessage">Tem certeza que deseja excluir as conexões desconectadas?</p>
                <div class="confirm-details" id="confirmDetails"></div>
            </div>
            <div class="confirm-actions">
                <button class="btn-confirm-cancel" onclick="fecharModalConfirmacao()">
                    Cancelar
                </button>
                <button class="btn-confirm-delete" id="btnConfirmDelete" onclick="confirmarExclusaoModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3,6 5,6 21,6"></polyline>
                        <path d="M19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path>
                    </svg>
                    Excluir
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Configurações da Conexão -->
    <div class="config-conexao-modal" id="configConexaoModal" onclick="if(event.target === this) fecharModalConfigConexao()">
        <div class="config-conexao-modal-content" onclick="event.stopPropagation()">
            <div class="config-conexao-modal-header">
                <h3 class="config-conexao-modal-title">Configurações da conexão</h3>
                <div class="config-conexao-modal-header-actions">
                    <button type="button" class="config-conexao-modal-btn-excluir" onclick="excluirConexaoNoModalConfig()" title="Excluir conexão">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </button>
                    <button type="button" class="config-conexao-modal-close" onclick="fecharModalConfigConexao()" title="Fechar">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>
            <div class="config-conexao-tabs">
                <button type="button" class="config-tab active" data-tab="conexao" onclick="switchConfigTab('conexao')">Conexão</button>
                <button type="button" class="config-tab" data-tab="configuracoes" onclick="switchConfigTab('configuracoes')">Configurações</button>
            </div>
            <div class="config-conexao-body">
                <div class="config-tab-content active" id="configTabConexao">
                    <div class="config-field">
                        <label>Nome da conexão</label>
                        <p id="configConexaoNome" class="config-value">—</p>
                    </div>
                    <div class="config-field">
                        <label>Telefone da conexão</label>
                        <p id="configConexaoTelefone" class="config-value">—</p>
                    </div>
                    <div class="config-field config-field-status">
                        <label>Status</label>
                        <div class="config-status-badge-wrap">
                            <span id="configConexaoStatus" class="config-status-badge status-verificando">Verificando...</span>
                        </div>
                    </div>
                    <div class="config-conexao-actions" id="configConexaoActions">
                        <button type="button" class="btn-gerar-qr-config" id="configBtnGerarQR" style="display: none;" onclick="gerarQRNoModalConfig()">Gerar QR Code</button>
                        <button type="button" class="btn-desconectar-config" id="configBtnDesconectar" style="display: none;" onclick="desconectarConexaoConfig()">Desconectar</button>
                    </div>
                </div>
                <div class="config-tab-content" id="configTabConfiguracoes">
                    <h4 class="config-section-title">Sincronizar Contatos</h4>
                    <p class="config-section-desc">Sincronize todos os contatos do seu WhatsApp para a ferramenta.</p>
                    <p id="configSyncAvisoDesconectado" class="config-sync-aviso" style="display: none;">Você precisa conectar o WhatsApp para sincronizar os contatos.</p>
                    <button type="button" class="btn-sincronizar-contatos" id="configBtnSincronizar" onclick="sincronizarContatosConfig()">
                        <span class="btn-sincronizar-text">Sincronizar</span>
                    </button>
                    <p id="configSyncMessage" class="config-message" style="display: none;"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ChatGPT API Key Modal -->
    <div class="chatgpt-modal" id="chatgptModal">
        <div class="chatgpt-modal-content">
            <h3>
                <svg class="chatgpt-icon" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142-.0852 4.783-2.7582a.7712.7712 0 0 0 .7806 0l5.8428 3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.4997-2.6067-1.4997Z"/>
                </svg>
                Configurar API Key do ChatGPT
            </h3>
            <div class="chatgpt-modal-body">
                <div class="form-group-modal">
                    <label for="apiKeyInput">API Key do ChatGPT:</label>
                    <input 
                        type="password" 
                        id="apiKeyInput" 
                        placeholder="sk-..." 
                        autocomplete="off"
                    >
                </div>
                <p style="color: #888; font-size: 0.9rem; margin-top: 10px;">
                    Esta chave será usada para gerar mensagens personalizadas com inteligência artificial.
                </p>
            </div>
            <div class="chatgpt-modal-actions">
                <button class="btn-modal-cancel" onclick="fecharModalChatGPT()">
                    Cancelar
                </button>
                <button class="btn-modal-save" id="btnSalvarApiKey" onclick="salvarApiKeyChatGPT()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17,21 17,13 7,13 7,21"></polyline>
                        <polyline points="7,3 7,8 15,8"></polyline>
                    </svg>
                    Salvar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Criar Conexão -->
    <div class="criar-conexao-modal" id="criarConexaoModal">
        <div class="criar-conexao-modal-content">

            <!-- Header Bar -->
            <div class="modal-header-bar">
                <h3>Nova Conexão</h3>
                <button class="modal-close-btn" onclick="fecharModalCriarConexao()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Body Area -->
            <div class="modal-body-area">

            <!-- Tela 1: Formulário de Criação -->
            <div class="modal-screen" id="modalFormScreen">

                <div class="criar-conexao-section">
                    <h4 id="modalSectionTitle">Nome da Conexão <span style="color: #ef4444;">*</span></h4>

                    <div class="form-section" id="modalFormSection">
                        <div class="form-group-modal">
                            <input
                                type="text"
                                id="nomeConexaoInput"
                                placeholder="Ex: Atendimento Suporte"
                                autocomplete="off"
                            >
                        </div>

                        <div class="phone-input-section" id="modalPhoneInputSection" style="display: none;">
                            <div class="form-group-modal">
                                <input
                                    type="tel"
                                    id="modalPhoneNumber"
                                    placeholder="(55) 11 99999-9999"
                                    maxlength="19"
                                >
                            </div>
                        </div>

                        <button class="btn-gerar-qr" id="btnGerarQR" onclick="gerarQRConexao()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/><line x1="21" y1="14" x2="21" y2="17"/><line x1="14" y1="21" x2="17" y2="21"/></svg>
                            Gerar QR Code
                        </button>
                        <button class="btn-gerar-qr" id="btnGetCode" onclick="getPairingCodeModal()" style="display: none;">
                            Obter código
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="link-pareamento" id="modalPairingLink" onclick="togglePairingModeModal()">
                        Conectar via código de pareamento
                    </a>
                    <a href="#" class="link-pareamento" id="modalBackToQR" onclick="togglePairingModeModal()" style="display: none;">
                        Voltar para QR Code
                    </a>

                    <button class="instructions-toggle" id="instructionsToggle" onclick="toggleInstructions()">
                        <span id="instructionsToggleText">Como conectar?</span>
                        <svg id="instructionsToggleIcon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="6,9 12,15 18,9"></polyline>
                        </svg>
                    </button>

                    <div class="instructions-content" id="instructionsContent" style="display: none;">
                        <h4>Passo a passo</h4>

                        <div class="instruction-step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <p>Abra o <strong>WhatsApp</strong> no seu celular.</p>
                            </div>
                        </div>

                        <div class="instruction-step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <p>Toque em <strong>Dispositivos conectados</strong>.</p>
                            </div>
                        </div>

                        <div class="instruction-step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <p>Toque em <strong>Conectar um dispositivo</strong> e escaneie o QR Code ou digite o código de pareamento.</p>
                            </div>
                        </div>

                        <div class="instruction-step">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <p>Aguarde a confirmação da conexão.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tela 2: Exibição do QR Code -->
            <div class="modal-screen" id="modalQRScreen" style="display: none;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Escaneie o QR Code</h3>
                <p class="modal-subtitle">Escaneie o QR Code ou use o código de pareamento para conectar.</p>

                <div class="qr-code-container">
                    <img id="modalQRImage" src="" alt="QR Code">
                </div>
                <div class="qr-timer" id="modalQRTimer">Expira em 29 segundos</div>

                <div class="modal-footer">
                    <button class="btn-modal-back" onclick="voltarParaFormulario()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15,18 9,12 15,6"></polyline>
                        </svg>
                        Voltar
                    </button>
                </div>
            </div>

            <!-- Tela 3: Exibição do Código de Pareamento -->
            <div class="modal-screen" id="modalCodeScreen" style="display: none;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Digite o código no WhatsApp</h3>
                <p class="modal-subtitle">Digite este código no seu WhatsApp para conectar.</p>

                <div class="code-container">
                    <h4>Código de Pareamento</h4>
                    <div class="pairing-code" id="modalPairingCode">000000</div>
                    <p>Digite este código no seu WhatsApp</p>
                </div>

                <div class="modal-footer">
                    <button class="btn-modal-back" onclick="voltarParaFormulario()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15,18 9,12 15,6"></polyline>
                        </svg>
                        Voltar
                    </button>
                </div>
            </div>

            </div><!-- /modal-body-area -->
        </div>
    </div>

    <script>
        // 🍪 Funções para gerenciar cookies
        function setCookie(name, value, days = 7) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Strict`;
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function deleteCookie(name) {
            document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;`;
        }

        // Flag global para indicar que o status está bloqueado (evita toasts)
        let statusBloqueado = false;

        // Função padrão para obter contaId e verificar status (padrão dashboard/hublabel/public/chat)
        async function obterUserIdComStatus() {
            let contaId = null;
            
            // Primeiro tentar obter do Supabase Auth
            if (window.supabase) {
                try {
                    const { data: { user }, error: userError } = await window.supabase.auth.getUser();
                    if (!userError && user && user.id) {
                        console.log('✅ Usuário obtido do Supabase Auth:', user.email);
                        
                        // Buscar o contaId e status na tabela SAAS_Usuarios usando auth_user_id
                        const { data: usuarioData, error: usuarioError } = await window.supabase
                            .from('SAAS_Usuarios')
                            .select('contaId, SAAS_Contas(status)')
                            .eq('auth_user_id', user.id)
                            .single();
                        
                        if (!usuarioError && usuarioData && usuarioData.contaId) {
                            // Se status for false, fazer logout e redirecionar para acesso-bloqueado
                            const status = usuarioData?.SAAS_Contas?.status;
                            if (status === false) {
                                console.warn('⚠️ Usuário com status inativo. Redirecionando para acesso-bloqueado.');
                                // Redirecionar imediatamente (não aguardar)
                                logoutAndRedirectAcessoBloqueado();
                                // Lançar erro especial que será ignorado nos catch blocks
                                throw new Error('STATUS_BLOQUEADO');
                            }
                            contaId = usuarioData.contaId;
                            console.log('✅ UserId obtido da tabela SAAS_Usuarios:', contaId);
                            
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
                    console.log('✅ UserId obtido dos cookies (fallback):', contaId);
                }
            }
            
            return contaId;
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

        // Autenticação obrigatória ao carregar a página
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
            }
            return contaId;
        }

        // Navegação simplificada (sem parâmetros de autenticação)
        function navigateToPage(url) {
            window.location.href = url;
        }

        // Verificar autenticação ao carregar a página
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

        document.addEventListener('DOMContentLoaded', async function() {
            await checkAuth();
            verificarMostrarMenuAdmin();
        });

        // Variáveis globais
        let conexoesList = [];
        window.limiteConexoesAtingido = false;
        let qrTimer = null;
        let connectionChecker = null;
        let currentReconnectInstance = null;

        // Funções de UI
        function showError(message) {
            // Não exibir toast se o status estiver bloqueado (já foi redirecionado)
            if (statusBloqueado) {
                return;
            }
            const errorEl = document.getElementById('errorMessage');
            errorEl.textContent = message;
            errorEl.style.display = 'block';
            setTimeout(() => {
                errorEl.style.display = 'none';
            }, 5000);
        }

        function showSuccess(message) {
            const successEl = document.getElementById('successMessage');
            successEl.textContent = message;
            successEl.style.display = 'block';
            setTimeout(() => {
                successEl.style.display = 'none';
            }, 3000);
        }

        function showConfirmDialog(message) {
            return new Promise((resolve) => {
                const overlay = document.createElement('div');
                overlay.style.cssText = 'position:fixed;inset:0;background:rgba(15,23,42,.55);display:flex;align-items:center;justify-content:center;z-index:100000;padding:16px;';
                const box = document.createElement('div');
                box.style.cssText = 'width:100%;max-width:460px;background:#fff;border-radius:16px;padding:20px;box-shadow:0 20px 45px rgba(2,6,23,.3);';
                box.innerHTML = `
                    <h3 style="margin:0 0 10px 0;font-size:18px;font-weight:700;color:#0f172a;">Confirmar ação</h3>
                    <p style="margin:0 0 18px 0;font-size:14px;line-height:1.6;color:#334155;">${String(message || '').replace(/</g, '&lt;').replace(/\n/g, '<br>')}</p>
                    <div style="display:flex;justify-content:flex-end;gap:10px;">
                        <button type="button" data-cancel style="border:1px solid #cbd5e1;background:#fff;color:#334155;padding:10px 14px;border-radius:10px;font-weight:600;cursor:pointer;">Cancelar</button>
                        <button type="button" data-confirm style="border:0;background:#dc2626;color:#fff;padding:10px 14px;border-radius:10px;font-weight:600;cursor:pointer;">Confirmar</button>
                    </div>
                `;
                overlay.appendChild(box);
                document.body.appendChild(overlay);
                const close = (value) => {
                    overlay.remove();
                    resolve(value);
                };
                overlay.addEventListener('click', (event) => {
                    if (event.target === overlay) close(false);
                });
                box.querySelector('[data-cancel]').addEventListener('click', () => close(false));
                box.querySelector('[data-confirm]').addEventListener('click', () => close(true));
            });
        }

        function hideLoading() {
            document.getElementById('loadingContainer').style.display = 'none';
        }

        function showConexoes() {
            document.getElementById('conexoesGrid').style.display = 'grid';
        }

        function showEmptyState() {
            document.getElementById('emptyState').style.display = 'block';
        }

        // Simular dados para demonstração (apenas no ambiente Claude)
        function setupDemoData() {
            const isClaudeEnvironment = window.location.hostname.includes('claude.ai') || 
                                      window.location.hostname.includes('anthropic') ||
                                      window.location.protocol === 'blob:';
                                      
            if (isClaudeEnvironment) {
                console.log('Ambiente de demonstração detectado - configurando dados simulados');
                
                // Dados de exemplo
                const demoConexoes = [
                    {
                        nome: 'WhatsApp Pessoal',
                        telefone: '+55 11 99999-1234',
                        instanceName: 'pessoal_ABC123',
                        foto: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiMyNWQzNjYiLz4KPHN2ZyB4PSIxNSIgeT0iMTUiIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJ3aGl0ZSI+CjxwYXRoIGQ9Ik0xMiAyQzYuNDggMiAyIDYuNDggMiAxMnM0LjQ4IDEwIDEwIDEwaDEwVjEyQzIyIDYuNDggMTcuNTIgMiAxMiAyem0wIDNjMS42NiAwIDMgMS4zNCAzIDNzLTEuMzQgMy0zIDMtMy0xLjM0LTMtMyAxLjM0LTMgMy0zem0wIDEyLjJjLTIuNSAwLTQuNzEtMS4yOC02LTMuMjJjLjAzLTEuOTkgNC0zLjA4IDYtMy4wOHM1Ljk3IDEuMDkgNiAzLjA4QzE2LjcxIDE1LjkyIDE0LjUgMTcuMiAxMiAxNy4yeiIvPgo8L3N2Zz4KPC9zdmc+'
                    },
                    {
                        nome: 'WhatsApp Comercial',
                        telefone: '+55 11 88888-5678',
                        instanceName: 'comercial_DEF456',
                        foto: null
                    },
                    {
                        nome: 'Suporte Cliente',
                        telefone: '+55 11 77777-9012',
                        instanceName: 'suporte_GHI789',
                        foto: null
                    }
                ];
                
                return demoConexoes;
            }
            
            return null;
        }

        // Carregar conexões
        async function carregarConexoes() {
            console.log('=== INICIANDO CARREGAMENTO DE CONEXÕES ===');
            
            let contaId;
            try {
                contaId = await obterUserIdComStatus();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return; // Já foi redirecionado
                }
                throw error;
            }
            console.log('UserId obtido:', contaId);

            try {
                // Verificar se é ambiente de demo
                const demoData = setupDemoData();
                if (demoData) {
                    console.log('=== MODO DEMONSTRAÇÃO ===');
                    console.log('Simulando carregamento...');
                    
                    // Simular delay de loading
                    await new Promise(resolve => setTimeout(resolve, 2000));
                    
                    console.log('Dados de demo carregados:', demoData);
                    conexoesList = demoData;
                    window.limiteConexoesAtingido = false;
                    
                    hideLoading();
                    
                    // Sempre renderizar conexões (inclui card de criar)
                    renderConexoes();
                    showConexoes();
                    
                    if (conexoesList.length > 0) {
                        verificarTodasConexoes();
                    }
                    return;
                }
                
                console.log('=== MODO PRODUÇÃO ===');
                console.log('Buscando conexões diretamente no Supabase...');
                
                // Buscar conexões diretamente no Supabase
                if (!window.supabase) {
                    throw new Error('Supabase não está disponível');
                }

                const { data: conexoesData, error: conexoesError } = await window.supabase
                    .from('SAAS_Conexões')
                    .select('*')
                    .eq('contaId', contaId)
                    .order('created_at', { ascending: false });

                if (conexoesError) {
                    console.error('Erro ao buscar conexões no Supabase:', conexoesError);
                    throw new Error(`Erro ao buscar conexões: ${conexoesError.message}`);
                }

                console.log('Conexões recebidas do Supabase:', conexoesData);

                // Verificar limite de conexões do plano
                let limiteConexoesAtingido = false;
                const { data: planoData } = await window.supabase
                    .from('vw_Contas_Com_Plano')
                    .select('plano_qntConexoes, total_conexoes')
                    .eq('id', contaId)
                    .maybeSingle();
                if (planoData && Number(planoData.plano_qntConexoes) > 0) {
                    const limite = Number(planoData.plano_qntConexoes) || 0;
                    const total = Number(planoData.total_conexoes) || 0;
                    limiteConexoesAtingido = total >= limite;
                }
                window.limiteConexoesAtingido = limiteConexoesAtingido;

                // Filtrar apenas objetos válidos com propriedades essenciais
                const conexoesValidas = (conexoesData || []).filter(conexao => {
                    // Verificar se é um objeto válido e não vazio
                    if (!conexao || typeof conexao !== 'object') {
                        return false;
                    }
                    
                    // Verificar se tem pelo menos uma propriedade essencial
                    const temNome = conexao.NomeConexao || conexao.nomeConexao || conexao.nome;
                    const temInstance = conexao.instanceName || conexao.instance_name;
                    
                    return temNome || temInstance;
                });

                console.log(`${conexoesValidas.length} de ${conexoesData?.length || 0} conexões são válidas`);

                // Mapear os campos para o formato esperado
                conexoesList = conexoesValidas.map(conexao => ({
                    nome: conexao.NomeConexao || conexao.nomeConexao || conexao.nome || 'Conexão sem nome',
                    telefone: conexao.Telefone || conexao.telefone || 'Telefone não disponível',
                    instanceName: conexao.instanceName || conexao.instance_name,
                    foto: conexao.FotoPerfil || conexao.foto || null,
                    id: conexao.id,
                    idConexao: conexao.idConexao || conexao.id,
                    apikey: conexao.Apikey || conexao.apikey
                }));

                console.log('Conexões processadas:', conexoesList);
                
                hideLoading();
                
                // Sempre renderizar conexões (inclui card de criar)
                renderConexoes();
                showConexoes();
                
                if (conexoesList.length > 0) {
                    verificarTodasConexoes();
                }

            } catch (error) {
                console.error('ERRO ao carregar conexões:', error);
                hideLoading();
                showError('Erro ao carregar conexões: ' + error.message);
            }
        }

        // Renderizar conexões
        function renderConexoes() {
            const grid = document.getElementById('conexoesGrid');
            const emptyState = document.getElementById('emptyState');
            const toolbar = document.getElementById('conexoesToolbar');

            grid.innerHTML = '';

            // Mostrar toolbar se há conexões
            if (toolbar) {
                toolbar.style.display = conexoesList.length > 0 ? 'flex' : 'none';
            }

            // Adicionar cards das conexões existentes
            conexoesList.forEach((conexao, index) => {
                const card = createConexaoCard(conexao, index);
                grid.appendChild(card);
            });

            // Adicionar card de criar conexão por último (sempre aparece, mesmo sem conexões)
            const criarCard = document.createElement('div');
            criarCard.className = 'conexao-card conexao-card-criar' + (window.limiteConexoesAtingido ? ' limite-atingido' : '');
            criarCard.title = window.limiteConexoesAtingido ? 'Limite atingido' : '';
            criarCard.setAttribute('aria-disabled', window.limiteConexoesAtingido ? 'true' : 'false');
            if (!window.limiteConexoesAtingido) {
                criarCard.onclick = () => abrirModalCriarConexao();
            }
            criarCard.innerHTML = `
                <div class="conexao-card-criar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                </div>
                <div class="conexao-card-criar-title">Adicionar Aparelho</div>
                <div class="conexao-card-criar-desc">
                    Vincule um novo número de WhatsApp lendo o QR Code.
                </div>
            `;
            grid.appendChild(criarCard);

            // Garantir que o grid está visível
            grid.style.display = 'grid';

            // Garantir que o emptyState está escondido
            if (emptyState) {
                emptyState.style.display = 'none';
            }

            // Atualizar KPIs
            updateKPIs();

            // Atualizar visibilidade do botão após renderizar
            setTimeout(() => {
                atualizarVisibilidadeBotaoExcluirDesconectadas();
            }, 100);
        }

        // Atualizar KPI cards
        function updateKPIs() {
            const totalEl = document.getElementById('kpiTotal');
            const conectadasEl = document.getElementById('kpiConectadas');
            const desconectadasEl = document.getElementById('kpiDesconectadas');

            if (totalEl) totalEl.textContent = conexoesList.length;

            // Count based on current status badges
            let conectadas = 0;
            let desconectadas = 0;
            conexoesList.forEach((_, index) => {
                const statusEl = document.getElementById(`status-${index}`);
                if (statusEl) {
                    if (statusEl.classList.contains('status-conectado')) conectadas++;
                    else if (statusEl.classList.contains('status-desconectado')) desconectadas++;
                }
            });

            if (conectadasEl) conectadasEl.textContent = conectadas;
            if (desconectadasEl) desconectadasEl.textContent = desconectadas;
        }

        // Filtrar conexões via toolbar
        function filtrarConexoes() {
            const searchTerm = (document.getElementById('toolbarSearchInput')?.value || '').toLowerCase();
            const filterValue = document.getElementById('toolbarFilterSelect')?.value || 'todas';

            const cards = document.querySelectorAll('#conexoesGrid .conexao-card:not(.conexao-card-criar)');
            cards.forEach((card) => {
                const index = card.dataset.index;
                if (index === undefined) return;
                const conexao = conexoesList[parseInt(index)];
                if (!conexao) return;

                const nome = (conexao.nome || '').toLowerCase();
                const telefone = (conexao.telefone || '').toLowerCase();
                const matchesSearch = !searchTerm || nome.includes(searchTerm) || telefone.includes(searchTerm);

                const statusEl = document.getElementById(`status-${index}`);
                let matchesFilter = true;
                if (filterValue === 'conectadas') {
                    matchesFilter = statusEl && statusEl.classList.contains('status-conectado');
                } else if (filterValue === 'desconectadas') {
                    matchesFilter = statusEl && statusEl.classList.contains('status-desconectado');
                }

                card.style.display = (matchesSearch && matchesFilter) ? '' : 'none';
            });
        }

        // Criar card de conexão
        function createConexaoCard(conexao, index) {
            const card = document.createElement('div');
            card.className = 'conexao-card';
            card.dataset.index = index;

            // Validar dados da conexão
            const nomeSeguro = (conexao.nome && typeof conexao.nome === 'string') ? conexao.nome : 'Conexão sem nome';
            const telefoneSeguro = (conexao.telefone && typeof conexao.telefone === 'string') ? conexao.telefone : 'Telefone não disponível';
            const instanceNameSeguro = (conexao.instanceName && typeof conexao.instanceName === 'string') ? conexao.instanceName : 'instance_indefinida';
            const fotoSegura = (conexao.foto && typeof conexao.foto === 'string') ? conexao.foto : null;

            const photoElement = fotoSegura ?
                `<img src="${fotoSegura}" alt="Foto de perfil" class="profile-photo">` :
                `<div class="profile-photo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                    </svg>
                </div>`;

            // Format date if available
            const createdAt = conexao.created_at || conexao.createdAt;
            let dateStr = '';
            if (createdAt) {
                try {
                    const d = new Date(createdAt);
                    dateStr = d.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
                } catch(e) { dateStr = ''; }
            }

            card.innerHTML = `
                <div class="card-indicator checking" id="indicator-${index}"></div>
                <div class="conexao-header">
                    ${photoElement}
                    <div class="conexao-info">
                        <h3>${nomeSeguro}</h3>
                        <div class="telefone">${telefoneSeguro}</div>
                    </div>
                </div>
                <div class="card-status-area">
                    <div class="status-badge status-verificando" id="status-${index}">
                        <span class="status-dot">
                            <span class="status-dot-ping"></span>
                            <span class="status-dot-core"></span>
                        </span>
                        Verificando...
                    </div>
                </div>
                ${dateStr ? `<div class="card-date-info"><div class="card-date-badge"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Criada em ${dateStr}</div></div>` : ''}
                <div class="conexao-actions">
                    <button class="btn-verificar" onclick="verificarConexao('${instanceNameSeguro}', ${index})" id="btn-verificar-${index}">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23,4 23,10 17,10"></polyline>
                            <polyline points="1,20 1,14 7,14"></polyline>
                            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                        </svg>
                        Verificar
                    </button>
                    <button class="btn-qrcode" onclick="gerarQRCode('${instanceNameSeguro}', ${index})" id="btn-qrcode-${index}" style="display: none;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                        </svg>
                        Conectar
                    </button>
                    <button class="btn-config-conexao" onclick="abrirModalConfigConexao('${instanceNameSeguro}', ${index})" title="Configurações">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </button>
                </div>
            `;

            return card;
        }

        // Verificar todas as conexões em paralelo
        async function verificarTodasConexoes() {
            console.log('🚀 Iniciando verificação paralela de todas as conexões...');
            
            // Verificar se há conexões para verificar
            const conexoesValidas = conexoesList.filter(conexao => conexao.instanceName);
            if (conexoesValidas.length === 0) {
                console.log('⚠️ Nenhuma conexão válida para verificar');
                return;
            }
            

            
            // Marcar todos os status como "Verificando..."
            conexoesList.forEach((conexao, index) => {
                const statusEl = document.getElementById(`status-${index}`);
                if (statusEl) {
                    statusEl.textContent = 'Verificando...';
                    statusEl.className = 'status-badge status-verificando';
                }
            });
            
            // Criar array de promessas para verificação paralela com timeout
            const verificacoes = conexoesValidas.map((conexao, index) => {
                const originalIndex = conexoesList.findIndex(c => c.instanceName === conexao.instanceName);
                return verificarConexaoComTimeout(conexao.instanceName, originalIndex, true);
            });
            
            // Executar todas as verificações em paralelo
            try {
                const resultados = await Promise.allSettled(verificacoes);
                console.log('✅ Todas as verificações de conexão concluídas em paralelo');
                
                // Contar sucessos e falhas
                const sucessos = resultados.filter(r => r.status === 'fulfilled').length;
                const falhas = resultados.filter(r => r.status === 'rejected').length;
                
                console.log(`📊 Resultados: ${sucessos} sucessos, ${falhas} falhas`);
                
                // Atualizar KPIs e visibilidade do botão de excluir desconectadas
                updateKPIs();
                atualizarVisibilidadeBotaoExcluirDesconectadas();

            } catch (error) {
                console.error('❌ Erro durante verificação paralela:', error);
                

            }
        }

        // Verificar conexão individual com timeout
        async function verificarConexaoComTimeout(instanceName, index, silent = false) {
            const timeout = 10000; // 10 segundos de timeout
            
            try {
                const resultado = await Promise.race([
                    verificarConexao(instanceName, index, silent),
                    new Promise((_, reject) => 
                        setTimeout(() => reject(new Error('Timeout')), timeout)
                    )
                ]);
                return resultado;
            } catch (error) {
                console.error(`❌ Timeout ou erro na conexão ${instanceName}:`, error.message);
                
                // Atualizar status para erro
                const statusEl = document.getElementById(`status-${index}`);
                if (statusEl) {
                    statusEl.textContent = 'Timeout';
                    statusEl.className = 'status-badge status-desconectado';
                }
                updateKPIs();

                throw error;
            }
        }

        // Verificar conexão individual
        async function verificarConexao(instanceName, index, silent = false) {
            const statusEl = document.getElementById(`status-${index}`);
            const btnVerificar = document.getElementById(`btn-verificar-${index}`);
            const btnQrcode = document.getElementById(`btn-qrcode-${index}`);

            // Validar instanceName
            if (!instanceName || instanceName === 'instance_indefinida') {
                console.error('InstanceName inválido para verificação:', instanceName);
                if (statusEl) {
                    statusEl.textContent = 'Erro';
                    statusEl.className = 'status-badge status-desconectado';
                }
                if (btnQrcode) {
                    btnQrcode.style.display = 'none';
                }
                return;
            }

            if (!silent && statusEl && btnVerificar) {
                statusEl.textContent = 'Verificando...';
                statusEl.className = 'status-badge status-verificando';
                btnVerificar.disabled = true;
            }

            try {
                // Buscar a apikey da conexão específica
                const conexao = conexoesList[index];
                const apikey = conexao?.apikey;
                
                const response = await fetch(`https://evo.chatconversa.app.br/instance/connectionState/${instanceName}`, {
                    method: 'GET',
                    headers: {
                        'apikey': apikey
                    }
                });

                const data = await response.json();
                console.log(`Status da conexão ${instanceName}:`, data);

                if (data.instance && data.instance.state === 'open') {
                    // Conectado
                    if (statusEl) {
                        statusEl.textContent = 'Conectado';
                        statusEl.className = 'status-badge status-conectado';
                    }
                    if (btnQrcode) {
                        btnQrcode.style.display = 'none';
                    }
                    
                    // Salvar foto do perfil apenas quando clicar no botão Verificar (não em verificações automáticas)
                    if (!silent) {
                        // Executa de forma assíncrona para não ser afetada por timeouts
                        (async () => {
                            try {
                                console.log('Salvando foto do perfil...');
                                let contaId;
                                try {
                                    contaId = await obterUserIdComStatus();
                                } catch (error) {
                                    if (error.message === 'STATUS_BLOQUEADO') {
                                        return;
                                    }
                                    throw error;
                                }
                                
                                const savePhotoResponse = await fetch('/hublabel/public/salvarfoto', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        contaId: contaId,
                                        instanceName: instanceName
                                    })
                                });

                                if (!savePhotoResponse.ok) {
                                    console.error('Erro ao salvar foto:', await savePhotoResponse.text());
                                    // Continua mesmo se falhar ao salvar a foto
                                } else {
                                    console.log('Foto salva com sucesso');
                                }
                                
                            } catch (photoError) {
                                console.error('Erro ao salvar foto:', photoError);
                                // Continua mesmo se falhar ao salvar a foto
                            }
                        })();
                    }
                } else {
                    // Desconectado
                    if (statusEl) {
                        statusEl.textContent = 'Desconectado';
                        statusEl.className = 'status-badge status-desconectado';
                    }
                    if (btnQrcode) {
                        btnQrcode.style.display = 'block';
                    }
                }

                // Atualizar KPIs e visibilidade do botão de excluir desconectadas
                updateKPIs();
                if (!silent) {
                    atualizarVisibilidadeBotaoExcluirDesconectadas();
                }

            } catch (error) {
                console.error('Erro ao verificar conexão:', error);
                if (statusEl) {
                    statusEl.textContent = 'Erro';
                    statusEl.className = 'status-badge status-desconectado';
                }
                if (btnQrcode) {
                    btnQrcode.style.display = 'block';
                }
                updateKPIs();
            } finally {
                if (btnVerificar) {
                    btnVerificar.disabled = false;
                }
            }
        }

        // Gerar QR Code
        async function gerarQRCode(instanceName, index) {
            const btnQrcode = document.getElementById(`btn-qrcode-${index}`);
            
            // Salvar texto original do botão
            const textoOriginal = btnQrcode.innerHTML;
            
            try {
                console.log('Gerando QR Code para:', instanceName);
                
                // Alterar texto do botão para "Gerando..."
                btnQrcode.innerHTML = `
                    <svg style="animation: spin 1s linear infinite;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M16 12a4 4 0 0 0-8 0"/>
                    </svg>
                    Gerando...
                `;
                btnQrcode.disabled = true;
                
                // Buscar a apikey da conexão específica
                const conexao = conexoesList[index];
                const apikey = conexao?.apikey;
                
                const response = await fetch(`https://evo.chatconversa.app.br/instance/connect/${instanceName}`, {
                    method: 'GET',
                    headers: {
                        'apikey': apikey
                    }
                });

                const data = await response.json().catch(() => ({}));
                console.log('QR Code gerado:', data);

                // Evolution retornou erro "instance does not exist": excluir conexão, avisar e abrir modal para criar nova
                if (!response.ok && data) {
                    const errMsg = (data.message || data.error || data.erro || '').toString().toLowerCase();
                    if (errMsg.includes('instance') && errMsg.includes('does not exist')) {
                        await excluirConexaoConfirmado(instanceName, index, true);
                        showError('A instância não existe mais na Evolution. A conexão foi removida. Crie uma nova conexão para conectar o WhatsApp.');
                        abrirModalCriarConexao();
                        return;
                    }
                }

                if (data.base64) {
                    mostrarQRModal(data.base64, instanceName, index);
                } else {
                    throw new Error((data && (data.message || data.error || data.erro)) || 'QR Code não foi retornado pela API');
                }

            } catch (error) {
                console.error('Erro ao gerar QR Code:', error);
                showError('Erro ao gerar QR Code: ' + error.message);
            } finally {
                // Restaurar texto original do botão
                btnQrcode.innerHTML = textoOriginal;
                btnQrcode.disabled = false;
            }
        }

        // Mostrar modal do QR Code
        function mostrarQRModal(qrCodeBase64, instanceName, index) {
            const modal = document.getElementById('qrModal');
            const qrImage = document.getElementById('qrImage');
            const timerEl = document.getElementById('qrTimer');
            
            qrImage.src = qrCodeBase64;
            modal.classList.add('show');
            
            currentReconnectInstance = { instanceName, index };
            
            // Iniciar timer
            let timeLeft = 29;
            timerEl.textContent = `Expira em ${timeLeft} segundos`;
            
            qrTimer = setInterval(() => {
                timeLeft--;
                timerEl.textContent = `Expira em ${timeLeft} segundos`;
                
                if (timeLeft <= 0) {
                    clearInterval(qrTimer);
                    qrTimer = null;
                    timerEl.textContent = 'QR Code expirado';
                    // Parar verificação quando QR expirar
                    if (connectionChecker) {
                        clearInterval(connectionChecker);
                        connectionChecker = null;
                    }
                }
            }, 1000);
            
            // Verificar conexão a cada 5 segundos
            connectionChecker = setInterval(async () => {
                console.log(`🔄 Verificando conexão ${instanceName}...`);
                const isConnected = await verificarConexaoSilenciosa(instanceName);
                if (isConnected) {
                    // Encontrar o nome da conexão
                    const conexao = conexoesList.find(c => c.instanceName === instanceName);
                    const nomeConexao = conexao ? conexao.nome : instanceName;
                    console.log(`✅ Conexão "${nomeConexao}" estabelecida!`);
                    fecharQRModal();
                    fecharModalCriarConexao();
                    showSuccess('WhatsApp conectado com sucesso!');
                    
                    // Salvar foto do perfil após conexão bem-sucedida
                    try {
                        console.log('Salvando foto do perfil...');
                        const contaId = await obterUserIdComStatus();
                        
                        const savePhotoResponse = await fetch('/hublabel/public/salvarfoto', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                contaId: contaId,
                                instanceName: instanceName
                            })
                        });

                        if (!savePhotoResponse.ok) {
                            console.error('Erro ao salvar foto:', await savePhotoResponse.text());
                            // Continua mesmo se falhar ao salvar a foto
                        } else {
                            console.log('Foto salva com sucesso');
                        }
                        
                    } catch (photoError) {
                        console.error('Erro na requisição para salvar foto:', photoError);
                        // Continua mesmo se falhar ao salvar a foto
                    }
                    
                    verificarConexao(instanceName, index);
                }
            }, 5000);
            
            console.log(`🔄 Iniciado verificação para ${instanceName} (a cada 5s)`);
        }

        // Verificar conexão silenciosa (para o modal)
        async function verificarConexaoSilenciosa(instanceName) {
            try {
                // Encontrar a conexão pelo instanceName
                const conexao = conexoesList.find(c => c.instanceName === instanceName);
                const apikey = conexao?.apikey;
                
                const response = await fetch(`https://evo.chatconversa.app.br/instance/connectionState/${instanceName}`, {
                    method: 'GET',
                    headers: {
                        'apikey': apikey
                    }
                });

                const data = await response.json();
                const isConnected = data.instance && data.instance.state === 'open';
                console.log(`🔍 Status silencioso ${instanceName}: ${isConnected ? 'Conectado' : 'Desconectado'}`);
                return isConnected;
            } catch (error) {
                console.error(`❌ Erro na verificação silenciosa ${instanceName}:`, error);
                return false;
            }
        }

        // Fechar modal do QR Code
        function fecharQRModal() {
            console.log('🔒 Fechando modal do QR Code...');
            
            const modal = document.getElementById('qrModal');
            modal.classList.remove('show');
            
            if (qrTimer) {
                console.log('⏹️ Parando timer do QR Code...');
                clearInterval(qrTimer);
                qrTimer = null;
            }
            
            if (connectionChecker) {
                console.log('⏹️ Parando verificação de conexão...');
                clearInterval(connectionChecker);
                connectionChecker = null;
            }
            
            console.log('✅ Modal fechado e verificações paradas');
        }

        // Excluir conexão
        async function excluirConexao(instanceName, index) {
            // Usar modal de confirmação personalizado
            mostrarModalConfirmacaoExclusao(instanceName, index);
        }

        // Mostrar modal de confirmação para exclusão de conexão
        function mostrarModalConfirmacaoExclusao(instanceName, index) {
            const modal = document.getElementById('confirmModal');
            const messageEl = document.getElementById('confirmMessage');
            const detailsEl = document.getElementById('confirmDetails');
            
            // Encontrar o nome da conexão
            const conexao = conexoesList.find(c => c.instanceName === instanceName);
            const nomeConexao = conexao ? conexao.nome : instanceName;
            
            if (!modal || !messageEl) {
                // Fallback para confirm se modal não existir
                showConfirmDialog(`Tem certeza que deseja excluir a conexão "${nomeConexao}"?`).then((confirmou) => {
                    if (confirmou) excluirConexaoConfirmado(instanceName, index);
                });
                return;
            }

            messageEl.textContent = 'Tem certeza que deseja excluir esta conexão?';
            detailsEl.textContent = `Conexão: ${nomeConexao}`;
            
            // Armazenar dados para confirmação (exclusão única)
            modal.dataset.instanceName = instanceName;
            modal.dataset.index = index;
            modal.dataset.conexoesDesconectadas = '';
            
            // Mostrar modal
            modal.classList.add('show');
        }

        // Confirmar exclusão (chamado pelo botão do modal)
        function confirmarExclusaoModal() {
            const modal = document.getElementById('confirmModal');
            const conexoesDesconectadas = modal.dataset.conexoesDesconectadas;
            if (conexoesDesconectadas && conexoesDesconectadas.length > 0) {
                confirmarExclusaoDesconectadas();
                return;
            }
            confirmarExclusaoConexao();
        }

        async function confirmarExclusaoConexao() {
            const modal = document.getElementById('confirmModal');
            const instanceName = modal.dataset.instanceName;
            const index = modal.dataset.index;
            
            if (!instanceName) {
                showError('Erro: dados da conexão não encontrados');
                return;
            }
            
            await excluirConexaoConfirmado(instanceName, index);
            fecharModalConfirmacao();
        }

        // Função original de exclusão (renomeada). silent=true não exibe toast de sucesso.
        async function excluirConexaoConfirmado(instanceName, index, silent) {

            try {
                const conexao = conexoesList.find(c => c.instanceName === instanceName);
                const nomeConexao = conexao ? conexao.nome : instanceName;
                console.log('Excluindo conexão:', nomeConexao);

                const apikey = conexao && (conexao.apikey || conexao.Apikey);
                if (!apikey) {
                    showError('Conexão sem apikey. Não é possível excluir.');
                    return;
                }

                // 1. Excluir na Evolution API
                const response = await fetch(`https://evo.chatconversa.app.br/instance/delete/${encodeURIComponent(instanceName)}`, {
                    method: 'DELETE',
                    headers: {
                        'apikey': apikey
                    }
                });

                console.log('Status da resposta de exclusão (Evolution):', response.status);
                if (!response.ok && response.status !== 404) {
                    const errText = await response.text();
                    let errMsg = `Erro ${response.status}: ${response.statusText}`;
                    try {
                        const errJson = JSON.parse(errText);
                        if (errJson && (errJson.message || errJson.erro)) errMsg = errJson.message || errJson.erro;
                    } catch (_) {}
                    console.warn('Evolution retornou erro na exclusão; removendo do banco mesmo assim:', errMsg);
                } else if (response.status === 404) {
                    console.log('Instância não encontrada na Evolution (404); removendo do banco.');
                }

                // 2. Excluir no Supabase (sempre, independente do resultado na Evolution)
                if (window.supabase && conexao.id) {
                    const { error: deleteError } = await window.supabase
                        .from('SAAS_Conexões')
                        .delete()
                        .eq('id', conexao.id);

                    if (deleteError) {
                        console.error('Erro ao excluir conexão no Supabase:', deleteError);
                        showError('Falha ao excluir conexão no banco: ' + deleteError.message);
                        await carregarConexoes();
                        return;
                    }
                }

                // Remover da lista local e atualizar UI
                conexoesList.splice(index, 1);
                renderConexoes();
                if (conexoesList.length > 0) {
                    verificarTodasConexoes();
                }
                if (!silent) {
                    showSuccess('Conexão excluída com sucesso!');
                }

            } catch (error) {
                console.error('Erro ao excluir conexão:', error);
                showError('Erro ao excluir conexão: ' + error.message);
            }
        }

        // Atualizar visibilidade do botão de excluir conexões desconectadas
        function atualizarVisibilidadeBotaoExcluirDesconectadas() {
            const btnDelete = document.getElementById('btnDeleteDisconnected');
            if (!btnDelete) return;

            // Verificar se há conexões desconectadas
            let temDesconectadas = false;
            for (let i = 0; i < conexoesList.length; i++) {
                const statusEl = document.getElementById(`status-${i}`);
                if (statusEl && statusEl.textContent === 'Desconectado') {
                    temDesconectadas = true;
                    break;
                }
            }

            // Mostrar/ocultar botão baseado na presença de conexões desconectadas
            if (temDesconectadas) {
                btnDelete.style.display = 'flex';
                console.log('🔴 Mostrando botão de excluir conexões desconectadas');
            } else {
                btnDelete.style.display = 'none';
                console.log('🟢 Ocultando botão de excluir conexões desconectadas');
            }
        }

        // ========== Modal Configurações da Conexão ==========
        let configConexaoModalIndex = null;
        let configConexaoModalInstanceName = null;
        let configConexaoIsConnected = false;

        function updateSyncTabState() {
            const btn = document.getElementById('configBtnSincronizar');
            const aviso = document.getElementById('configSyncAvisoDesconectado');
            if (btn) btn.disabled = !configConexaoIsConnected;
            if (aviso) aviso.style.display = configConexaoIsConnected ? 'none' : 'block';
        }

        function switchConfigTab(tabName) {
            document.querySelectorAll('.config-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.config-tab-content').forEach(c => c.classList.remove('active'));
            const tabBtn = document.querySelector(`.config-tab[data-tab="${tabName}"]`);
            const tabContent = document.getElementById(`configTab${tabName.charAt(0).toUpperCase() + tabName.slice(1)}`);
            if (tabBtn) tabBtn.classList.add('active');
            if (tabContent) tabContent.classList.add('active');
            if (tabName === 'configuracoes') {
                updateSyncTabState();
            }
        }

        function abrirModalConfigConexao(instanceName, index) {
            const conexao = conexoesList[index];
            if (!conexao) return;
            configConexaoModalIndex = index;
            configConexaoModalInstanceName = instanceName;

            document.getElementById('configConexaoNome').textContent = conexao.nome || '—';
            document.getElementById('configConexaoTelefone').textContent = conexao.telefone || '—';

            const statusEl = document.getElementById('configConexaoStatus');
            const btnQR = document.getElementById('configBtnGerarQR');
            const btnDesconectar = document.getElementById('configBtnDesconectar');
            statusEl.textContent = 'Verificando...';
            statusEl.className = 'config-status-badge status-verificando';
            btnQR.style.display = 'none';
            btnDesconectar.style.display = 'none';

            document.getElementById('configSyncMessage').style.display = 'none';
            document.getElementById('configConexaoModal').classList.add('show');

            carregarInfoModalConfigConexao(instanceName, statusEl, btnQR, btnDesconectar);
        }

        async function carregarInfoModalConfigConexao(instanceName, statusEl, btnQR, btnDesconectar) {
            const isConnected = await verificarConexaoSilenciosa(instanceName);
            if (configConexaoModalInstanceName !== instanceName) return;
            configConexaoIsConnected = isConnected;
            if (statusEl) {
                if (isConnected) {
                    statusEl.textContent = 'Conectado';
                    statusEl.className = 'config-status-badge status-conectado';
                    if (btnDesconectar) btnDesconectar.style.display = 'inline-block';
                } else {
                    statusEl.textContent = 'Desconectado';
                    statusEl.className = 'config-status-badge status-desconectado';
                    if (btnQR) btnQR.style.display = 'inline-block';
                }
            }
            updateSyncTabState();
        }

        function fecharModalConfigConexao() {
            document.getElementById('configConexaoModal').classList.remove('show');
            configConexaoModalIndex = null;
            configConexaoModalInstanceName = null;
        }

        function excluirConexaoNoModalConfig() {
            if (configConexaoModalInstanceName == null || configConexaoModalIndex == null) return;
            const instanceName = configConexaoModalInstanceName;
            const index = configConexaoModalIndex;
            fecharModalConfigConexao();
            mostrarModalConfirmacaoExclusao(instanceName, index);
        }

        function gerarQRNoModalConfig() {
            if (configConexaoModalInstanceName == null || configConexaoModalIndex == null) return;
            fecharModalConfigConexao();
            gerarQRCode(configConexaoModalInstanceName, configConexaoModalIndex);
        }

        async function desconectarConexaoConfig() {
            if (configConexaoModalInstanceName == null) return;
            const conexao = conexoesList[configConexaoModalIndex];
            const apikey = conexao?.apikey;
            try {
                const response = await fetch(`https://evo.chatconversa.app.br/instance/logout/${configConexaoModalInstanceName}`, {
                    method: 'DELETE',
                    headers: { 'apikey': apikey || '' }
                });
                if (response.ok) {
                    showSuccess('Conexão desconectada.');
                    configConexaoIsConnected = false;
                    updateSyncTabState();
                    verificarConexao(configConexaoModalInstanceName, configConexaoModalIndex);
                    const statusEl = document.getElementById('configConexaoStatus');
                    if (statusEl) {
                        statusEl.textContent = 'Desconectado';
                        statusEl.className = 'config-status-badge status-desconectado';
                    }
                    document.getElementById('configBtnDesconectar').style.display = 'none';
                    document.getElementById('configBtnGerarQR').style.display = 'inline-block';
                } else {
                    const err = await response.json().catch(() => ({}));
                    showError(err.message || 'Falha ao desconectar');
                }
            } catch (e) {
                showError('Erro ao desconectar: ' + e.message);
            }
        }

        async function sincronizarContatosConfig() {
            if (configConexaoModalInstanceName == null || configConexaoModalIndex == null) return;
            if (!configConexaoIsConnected) {
                showError('Sincronização só é possível com a conexão conectada.');
                return;
            }
            const conexao = conexoesList[configConexaoModalIndex];
            let contaId;
            try {
                contaId = await obterUserIdComStatus();
            } catch (e) {
                if (e.message === 'STATUS_BLOQUEADO') return;
                throw e;
            }
            if (!contaId) {
                showError('Sessão inválida.');
                return;
            }
            const instanceName = configConexaoModalInstanceName;
            const idConexao = conexao.idConexao || conexao.id;
            fecharModalConfigConexao();
            showSuccess('Sincronizando contatos. Aguarde alguns minutos.');
            try {
                await fetch('/hublabel/public/sincronizar-contatos', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ contaId, instanceName, idConexao })
                });
            } catch (error) {
                showError(error.message || 'Erro ao sincronizar contatos');
            }
        }

        // Excluir todas as conexões desconectadas
        async function excluirConexoesDesconectadas() {
            // Encontrar todas as conexões desconectadas
            const conexoesDesconectadas = [];
            
            for (let i = 0; i < conexoesList.length; i++) {
                const statusEl = document.getElementById(`status-${i}`);
                if (statusEl && statusEl.textContent === 'Desconectado') {
                    conexoesDesconectadas.push({
                        index: i,
                        conexao: conexoesList[i]
                    });
                }
            }

            if (conexoesDesconectadas.length === 0) {
                showError('Nenhuma conexão desconectada encontrada.');
                return;
            }

            // Mostrar modal de confirmação
            mostrarModalConfirmacao(conexoesDesconectadas);
        }

        // Mostrar modal de confirmação
        function mostrarModalConfirmacao(conexoesDesconectadas) {
            const modal = document.getElementById('confirmModal');
            const messageEl = document.getElementById('confirmMessage');
            const detailsEl = document.getElementById('confirmDetails');
            
            // Atualizar mensagem
            const count = conexoesDesconectadas.length;
            messageEl.textContent = `Tem certeza que deseja excluir ${count} conexão(ões) desconectada(s)?`;
            
            // Mostrar detalhes das conexões
            detailsEl.innerHTML = `
                <h4>Conexões que serão excluídas:</h4>
                <ul>
                    ${conexoesDesconectadas.map(item => 
                        `<li>${item.conexao.nome} (${item.conexao.telefone})</li>`
                    ).join('')}
                </ul>
                <p style="color: #ff6b6b; font-size: 0.9rem; margin-top: 10px;">
                    ⚠️ Esta ação não pode ser desfeita.
                </p>
            `;
            
            // Armazenar dados para uso posterior
            modal.dataset.conexoesDesconectadas = JSON.stringify(conexoesDesconectadas);
            
            // Mostrar modal
            modal.classList.add('show');
        }

        // Fechar modal de confirmação
        function fecharModalConfirmacao() {
            const modal = document.getElementById('confirmModal');
            modal.classList.remove('show');
            modal.dataset.conexoesDesconectadas = '';
        }

        // Confirmar exclusão (chamado pelo botão do modal)
        async function confirmarExclusaoDesconectadas() {
            const modal = document.getElementById('confirmModal');
            const conexoesDesconectadas = JSON.parse(modal.dataset.conexoesDesconectadas || '[]');
            
            if (conexoesDesconectadas.length === 0) {
                showError('Nenhuma conexão para excluir.');
                return;
            }

            // Fechar modal
            fecharModalConfirmacao();

            const btnDelete = document.getElementById('btnDeleteDisconnected');
            const textoOriginal = btnDelete.innerHTML;
            
            try {
                // Desabilitar botão e mostrar loading
                btnDelete.disabled = true;
                btnDelete.innerHTML = `
                    <svg style="animation: spin 1s linear infinite;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M16 12a4 4 0 0 0-8 0"/>
                    </svg>
                    Excluindo...
                `;

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
                    showError('Sessão inválida. Recarregue a página.');
                    btnDelete.disabled = false;
                    btnDelete.innerHTML = textoOriginal;
                    return;
                }
                let sucessos = 0;
                let falhas = 0;
                const nomesNaoExcluidos = [];

                // Excluir cada conexão desconectada: Evolution DELETE + Supabase (continua nas demais se uma falhar)
                for (const { index, conexao } of conexoesDesconectadas) {
                    try {
                        console.log(`Excluindo conexão desconectada: ${conexao.nome}`);
                        const apikey = conexao.apikey || conexao.Apikey;
                        if (!apikey) {
                            falhas++;
                            nomesNaoExcluidos.push(conexao.nome + ' (sem apikey)');
                            console.error(`❌ "${conexao.nome}" sem apikey`);
                            continue;
                        }

                        const response = await fetch(`https://evo.chatconversa.app.br/instance/delete/${encodeURIComponent(conexao.instanceName)}`, {
                            method: 'DELETE',
                            headers: { 'apikey': apikey }
                        });

                        if (!response.ok && response.status !== 404) {
                            const errText = await response.text();
                            console.warn(`Evolution retornou ${response.status} para "${conexao.nome}"; removendo do banco mesmo assim.`, errText);
                        } else if (response.status === 404) {
                            console.log(`Instância "${conexao.nome}" não encontrada na Evolution (404); removendo do banco.`);
                        }

                        if (window.supabase && conexao.id) {
                            const { error: deleteError } = await window.supabase
                                .from('SAAS_Conexões')
                                .delete()
                                .eq('id', conexao.id);
                            if (deleteError) {
                                falhas++;
                                const msg = (deleteError && deleteError.message) ? String(deleteError.message) : '';
                                const textoErro = msg ? (conexao.nome + ': ' + msg) : conexao.nome;
                                nomesNaoExcluidos.push(textoErro);
                                console.error(`❌ Falha Supabase ao excluir "${conexao.nome}":`, deleteError.message || deleteError);
                                continue;
                            }
                        }
                        sucessos++;
                        console.log(`✅ Conexão "${conexao.nome}" excluída com sucesso`);
                    } catch (error) {
                        falhas++;
                        const msg = error && error.message ? String(error.message) : '';
                        nomesNaoExcluidos.push(msg ? (conexao.nome + ': ' + msg) : conexao.nome);
                        console.error(`❌ Erro ao excluir "${conexao.nome}":`, error);
                    }
                }

                fecharModalConfirmacao();

                // Atualizar interface
                if (sucessos > 0) {
                    await carregarConexoes();
                    showSuccess(`${sucessos} conexão(ões) desconectada(s) excluída(s) com sucesso!`);
                } else {
                    showError('Nenhuma conexão foi excluída. Verifique os logs para mais detalhes.');
                }
                if (nomesNaoExcluidos.length > 0) {
                    showError('Não foi possível excluir: ' + nomesNaoExcluidos.join(', '));
                }

            } catch (error) {
                console.error('Erro geral ao excluir conexões desconectadas:', error);
                showError('Erro ao excluir conexões desconectadas: ' + error.message);
            } finally {
                // Restaurar botão
                btnDelete.disabled = false;
                btnDelete.innerHTML = textoOriginal;
            }
        }



        // Event listeners para modais e teclas
        function setupNavigation() {
            // Event listener para fechar modal
            const closeQrModal = document.getElementById('closeQrModal');
            if (closeQrModal) {
                closeQrModal.addEventListener('click', fecharQRModal);
            }
            
            // Fechar modal clicando fora dele
            const qrModal = document.getElementById('qrModal');
            if (qrModal) {
                qrModal.addEventListener('click', (e) => {
                    if (e.target === qrModal) {
                        fecharQRModal();
                    }
                });
            }
            
            // Fechar modal com ESC
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const modal = document.getElementById('qrModal');
                    if (modal && modal.classList.contains('show')) {
                        fecharQRModal();
                    }
                }
            });
            if (qrModal) {
                qrModal.addEventListener('click', function(e) {
                    if (e.target === qrModal) {
                        fecharQRModal();
                    }
                });
            }

            // Event listeners para o modal de confirmação
            const confirmModal = document.getElementById('confirmModal');
            if (confirmModal) {
                confirmModal.addEventListener('click', function(e) {
                    if (e.target === confirmModal) {
                        fecharModalConfirmacao();
                    }
                });
            }

            // Event listeners para o modal do ChatGPT
            const chatgptModal = document.getElementById('chatgptModal');
            if (chatgptModal) {
                chatgptModal.addEventListener('click', function(e) {
                    if (e.target === chatgptModal) {
                        fecharModalChatGPT();
                    }
                });
            }

            // Event listeners para o modal de criar conexão
            const criarConexaoModal = document.getElementById('criarConexaoModal');
            if (criarConexaoModal) {
                criarConexaoModal.addEventListener('click', function(e) {
                    if (e.target === criarConexaoModal) {
                        fecharModalCriarConexao();
                    }
                });
            }

            // Fechar modal com tecla ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (document.getElementById('confirmModal').classList.contains('show')) {
                        fecharModalConfirmacao();
                    }
                    if (document.getElementById('chatgptModal').classList.contains('show')) {
                        fecharModalChatGPT();
                    }
                    if (document.getElementById('criarConexaoModal').classList.contains('show')) {
                        fecharModalCriarConexao();
                    }
                    if (document.getElementById('qrModal').classList.contains('show')) {
                        fecharQRModal();
                    }
                }
            });
            
            // Enviar com Enter no input da API Key
            const apiKeyInput = document.getElementById('apiKeyInput');
            if (apiKeyInput) {
                apiKeyInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        salvarApiKeyChatGPT();
                    }
                });
            }

            // Enviar com Enter no input do nome da conexão
            const nomeConexaoInput = document.getElementById('nomeConexaoInput');
            if (nomeConexaoInput) {
                nomeConexaoInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        gerarQRConexao();
                    }
                });
                
                // Permitir apenas letras (incl. acentuadas), números e espaço
                nomeConexaoInput.addEventListener('input', function(e) {
                    let value = e.target.value;
                    value = value.replace(/[^a-zA-ZÀ-ÿ0-9\s]/g, '');
                    if (value !== e.target.value) {
                        e.target.value = value;
                    }
                });
                
                // Bloquear teclas que não sejam letra, número ou espaço
                nomeConexaoInput.addEventListener('keydown', function(e) {
                    if (!e.ctrlKey && !e.metaKey && !e.altKey && e.key.length === 1 && !/^[a-zA-ZÀ-ÿ0-9\s]$/.test(e.key)) {
                        e.preventDefault();
                    }
                });
            }

            // Enviar com Enter no input do telefone
            const modalPhoneNumber = document.getElementById('modalPhoneNumber');
            if (modalPhoneNumber) {
                modalPhoneNumber.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        getPairingCodeModal();
                    }
                });

                // Formatação automática do telefone (igual à página original)
                modalPhoneNumber.addEventListener('input', function(e) {
                    const cursorPosition = e.target.selectionStart;
                    const oldValue = e.target.value;
                    const formatted = formatPhoneNumber(e.target.value);
                    
                    // Só atualiza se o valor realmente mudou
                    if (oldValue !== formatted) {
                        e.target.value = formatted;
                        
                        // Calcula a nova posição do cursor baseada na quantidade de caracteres não numéricos
                        const numbersBeforeCursor = oldValue.substring(0, cursorPosition).replace(/\D/g, '');
                        const numbersInFormatted = formatted.replace(/\D/g, '');
                        
                        // Encontra a posição correspondente no texto formatado
                        let newCursorPosition = 0;
                        let numbersCount = 0;
                        
                        for (let i = 0; i < formatted.length; i++) {
                            if (/\d/.test(formatted[i])) {
                                numbersCount++;
                                if (numbersCount === numbersBeforeCursor.length) {
                                    newCursorPosition = i + 1;
                                    break;
                                }
                            }
                        }
                        
                        // Se não encontrou posição específica, coloca no final
                        if (newCursorPosition === 0) {
                            newCursorPosition = formatted.length;
                        }
                        
                        // Aplica a nova posição do cursor
                        e.target.setSelectionRange(newCursorPosition, newCursorPosition);
                    }
                });
            }
        }

        // Inicialização
        async function inicializarPagina() {
            console.log('Inicializando página de conexões');
            carregarVersao();
            
            // Verificar autenticação e status ANTES de qualquer coisa
            let contaId;
            try {
                contaId = await checkAuth();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return; // Já foi redirecionado
                }
                throw error;
            }
            if (!contaId) {
                return; // checkAuth já redireciona se necessário
            }
            
            console.log('Configurando navegação e carregando conexões...');
            setupNavigation();
            
            // Carregar conexões
            try {
                await carregarConexoes();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return; // Já foi redirecionado
                }
                throw error;
            }
            

        }

        // Executar quando o DOM estiver pronto
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', inicializarPagina);
        } else {
            inicializarPagina();
        }

        console.log('=== SCRIPT DA PÁGINA DE CONEXÕES CARREGADO ===');
        console.log('🔐 Sistema de autenticação por cookies - navegação simplificada');

        // Função de logout
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
            
            // Limpar todos os cookies
            document.cookie = 'userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'idLista=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'idConexao=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'idDisparo=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            if (typeof clearMenuOcultarCache === 'function') clearMenuOcultarCache();
            
            // Limpar sessionStorage e localStorage
            sessionStorage.clear();
            localStorage.clear();
            
            console.log('🧹 Cookies, sessionStorage e localStorage limpos');
            console.log('🔄 Redirecionando para login...');
            
            // Redirecionar para página de login
            window.location.href = '/hublabel/public/hublabel/public/hublabel/public/hublabel/public/login';
        }

        // Funções para gerenciar o modal do ChatGPT
        async function abrirModalChatGPT() {
            const modal = document.getElementById('chatgptModal');
            const input = document.getElementById('apiKeyInput');
            
            modal.classList.add('show');
            
            // Buscar API key existente
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
                
                const response = await fetch('/hublabel/public/buscar-gpt', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        contaId: contaId
                    })
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('API Key encontrada:', data);
                    
                    // Preencher o campo se existir API key
                    if (data.apikey_gpt) {
                        input.value = data.apikey_gpt;
                    } else {
                        input.value = '';
                    }
                } else {
                    console.error('Erro ao buscar API key:', response.status);
                    input.value = '';
                }
            } catch (error) {
                console.error('Erro ao buscar API key:', error);
                input.value = '';
            }
            
            // Foco no input
            setTimeout(() => {
                input.focus();
            }, 100);
        }

        function fecharModalChatGPT() {
            const modal = document.getElementById('chatgptModal');
            const input = document.getElementById('apiKeyInput');
            
            modal.classList.remove('show');
            input.value = '';
        }

        // Função para salvar API Key do ChatGPT
        async function salvarApiKeyChatGPT() {
            const apiKeyInput = document.getElementById('apiKeyInput');
            const btnSalvar = document.getElementById('btnSalvarApiKey');
            const apiKey = apiKeyInput.value.trim();

            // Validação básica
            if (!apiKey) {
                showError('Por favor, insira uma API Key válida.');
                return;
            }

            if (!apiKey.startsWith('sk-')) {
                showError('A API Key deve começar com "sk-".');
                return;
            }

            // Obter contaId (já validado na inicialização)
            let contaId;
            try {
                contaId = await obterUserIdComStatus();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return;
                }
                throw error;
            }

            // Desabilitar botão e mostrar loading
            btnSalvar.disabled = true;
            btnSalvar.innerHTML = `
                <svg style="animation: spin 1s linear infinite;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M16 12a4 4 0 0 0-8 0"/>
                </svg>
                Salvando...
            `;

            try {
                console.log('Salvando API Key do ChatGPT...');

                const response = await fetch('/hublabel/public/salvar-gpt', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        contaId: contaId,
                        apikeyGpt: apiKey
                    })
                });

                console.log('Status da resposta:', response.status);

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Erro na resposta:', errorText);
                    throw new Error(`Erro ${response.status}: ${response.statusText}`);
                }

                const result = await response.json();
                console.log('Resposta da API:', result);

                showSuccess('API Key do ChatGPT salva com sucesso!');
                fecharModalChatGPT();

            } catch (error) {
                console.error('Erro ao salvar API Key:', error);
                showError(`Erro ao salvar API Key: ${error.message}`);
            } finally {
                // Restaurar botão
                btnSalvar.disabled = false;
                btnSalvar.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17,21 17,13 7,13 7,21"></polyline>
                        <polyline points="7,3 7,8 15,8"></polyline>
                    </svg>
                    Salvar
                `;
            }
        }

        // ===== FUNÇÕES DE MENSAGENS DE FEEDBACK =====
        function showToast(message, type = 'info') {
            if (typeof statusBloqueado !== 'undefined' && statusBloqueado) return;
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

        function showSuccess(message) {
            showToast(message, 'success');
        }

        function showError(message) {
            // Não exibir toast se o status estiver bloqueado (já foi redirecionado)
            if (statusBloqueado) {
                return;
            }
            showToast(message, 'error');
        }

        // ===== FUNÇÕES DO MODAL DE CRIAR CONEXÃO =====
        
        // Abrir modal de criar conexão
        function abrirModalCriarConexao() {
            if (window.limiteConexoesAtingido) {
                showToast('Limite de conexões atingido. Verifique seu plano nas configurações', 'info');
                return;
            }
            const modal = document.getElementById('criarConexaoModal');
            const input = document.getElementById('nomeConexaoInput');
            
            modal.classList.add('show');
            
            // Limpar campo de entrada
            input.value = '';
            
            // Foco no input
            setTimeout(() => {
                input.focus();
            }, 100);
        }

        // Fechar modal de criar conexão
        function fecharModalCriarConexao() {
            const modal = document.getElementById('criarConexaoModal');
            const input = document.getElementById('nomeConexaoInput');
            const phoneInput = document.getElementById('modalPhoneNumber');
            
            modal.classList.remove('show');
            input.value = '';
            phoneInput.value = '';
            
            // Voltar para a tela inicial
            showModalScreen('modalFormScreen');
            
            // Parar timers e verificações se estiverem rodando
            if (qrTimer) {
                clearInterval(qrTimer);
                qrTimer = null;
            }
            if (connectionChecker) {
                clearInterval(connectionChecker);
                connectionChecker = null;
            }
        }

        // Gerar QR Code para nova conexão (igual à página original)
        async function gerarQRConexao() {
            const nomeConexaoInput = document.getElementById('nomeConexaoInput');
            const btnGerarQR = document.getElementById('btnGerarQR');
            if (btnGerarQR.disabled) return;
            btnGerarQR.disabled = true;
            btnGerarQR.innerHTML = `
                <svg style="animation: spin 1s linear infinite;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M16 12a4 4 0 0 0-8 0"/>
                </svg>
                Gerando...
            `;
            const nomeConexao = nomeConexaoInput.value.trim();

            // Validação - nome não pode ser vazio
            if (!nomeConexao) {
                showError('Por favor, digite o nome da conexão');
                nomeConexaoInput.focus();
                btnGerarQR.disabled = false;
                btnGerarQR.innerHTML = 'Gerar QR Code';
                return;
            }
            
            // Validação - apenas letras, números e espaço
            if (/[^a-zA-ZÀ-ÿ0-9\s]/.test(nomeConexao)) {
                showError('O nome da conexão só pode conter letras, números e espaço');
                nomeConexaoInput.focus();
                btnGerarQR.disabled = false;
                btnGerarQR.innerHTML = 'Gerar QR Code';
                return;
            }

            // Obter contaId
            let contaId;
            try {
                contaId = await obterUserIdComStatus();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    btnGerarQR.disabled = false;
                    btnGerarQR.innerHTML = 'Gerar QR Code';
                    return;
                }
                btnGerarQR.disabled = false;
                btnGerarQR.innerHTML = 'Gerar QR Code';
                throw error;
            }
            if (!contaId) {
                showError('Sessão inválida. Recarregue a página.');
                btnGerarQR.disabled = false;
                btnGerarQR.innerHTML = 'Gerar QR Code';
                return;
            }

            console.log('Processando requisição para instância:', nomeConexao);

            try {
                console.log('Fazendo requisição para criar conexão');
                const response = await fetch('/hublabel/public/criarconexaoback', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        contaId: contaId,
                        instanceName: nomeConexao,
                        phoneNumber: '', // Vazio para QR Code
                        pairCode: false // false para QR Code
                    })
                });

                console.log('Status da resposta:', response.status);
                const data = await response.json();
                console.log('Dados recebidos:', data);

                // Verificar se o limite de conexões foi atingido (antes de outras verificações)
                console.log('Verificando plano:', data.plano);
                if (data.plano === 'limite atingido') {
                    window.limiteConexoesAtingido = true;
                    renderConexoes();
                    console.log('Limite atingido detectado, fechando modal e exibindo toast...');
                    // Fechar o modal imediatamente
                    fecharModalCriarConexao();
                    // Mostrar notificação após fechar o modal
                    setTimeout(() => {
                        showToast('Limite de conexões atingido. Verifique seu plano nas configurações', 'info');
                    }, 100);
                    return;
                }

                if (!response.ok) {
                    throw new Error(data.message || 'Erro ao gerar QR Code');
                }

                if (data.instanceName) {
                    let qrBase64 = data.qrcode || null;
                    if (!qrBase64) {
                        let apikey = data.apikey || null;
                        if (!apikey) {
                            await carregarConexoes();
                            const conn = conexoesList.find(c => c.instanceName === data.instanceName);
                            apikey = conn?.apikey || conn?.Apikey || null;
                        }
                        if (apikey) {
                            try {
                                const resConnect = await fetch(`https://evo.chatconversa.app.br/instance/connect/${encodeURIComponent(data.instanceName)}`, {
                                    method: 'GET',
                                    headers: { 'apikey': apikey }
                                });
                                const connectData = await resConnect.json().catch(() => ({}));
                                qrBase64 = connectData.base64 || connectData.qrcode || null;
                            } catch (e) {
                                console.warn('Fallback QR (Evolution connect) falhou:', e);
                            }
                        }
                    }
                    if (!conexoesList.some(c => c.instanceName === data.instanceName)) {
                        await carregarConexoes();
                    }
                    const novaConexaoIndex = conexoesList.findIndex(c => c.instanceName === data.instanceName);
                    if (qrBase64 && novaConexaoIndex !== -1) {
                        console.log('QR Code recebido, exibindo');
                        showSuccess('QR Code gerado! Escaneie com seu WhatsApp.');
                        mostrarQRNoModal(qrBase64, data.instanceName, novaConexaoIndex);
                    } else if (novaConexaoIndex !== -1) {
                        showError('Conexão criada, mas não foi possível obter o QR Code. Use o botão Conectar no card.');
                    } else {
                        console.warn('⚠️ Nova conexão não encontrada na lista após recarregar');
                        showError('Conexão criada, mas não foi possível gerar o QR Code automaticamente.');
                    }
                } else {
                    throw new Error('InstanceName não foi retornado pela API');
                }

            } catch (error) {
                console.error('Erro:', error);
                showError(error.message || 'Erro ao conectar com a API');
            } finally {
                // Restaurar botão
                btnGerarQR.disabled = false;
                btnGerarQR.innerHTML = 'Gerar QR Code';
            }
        }

        // Função para formatar número de telefone (igual à página original)
        function formatPhoneNumber(value) {
            // Remove tudo que não é número
            let numbers = value.replace(/\D/g, '');
            
            // Se não há números, retorna vazio
            if (numbers.length === 0) {
                return '';
            }
            
            // Limita a 13 dígitos (55 + DDD + número)
            if (numbers.length > 13) {
                numbers = numbers.substring(0, 13);
            }
            
            // Formata o número baseado na quantidade de dígitos
            if (numbers.length <= 2) {
                // Apenas os primeiros dígitos
                return numbers;
            } else if (numbers.length <= 4) {
                // (55) DD
                return '(' + numbers.substring(0, 2) + ') ' + numbers.substring(2);
            } else if (numbers.length <= 9) {
                // (55) DD NNNNN
                return '(' + numbers.substring(0, 2) + ') ' + numbers.substring(2, 4) + ' ' + numbers.substring(4);
            } else {
                // (55) DD NNNNN-NNNN
                return '(' + numbers.substring(0, 2) + ') ' + numbers.substring(2, 4) + ' ' + numbers.substring(4, 9) + '-' + numbers.substring(9);
            }
        }

        // Função para obter número limpo (apenas números)
        function getCleanPhoneNumber(value) {
            return value.replace(/\D/g, '');
        }

        // Função para alternar entre QR Code e código de pareamento no modal
        function togglePairingModeModal() {
            const phoneInputSection = document.getElementById('modalPhoneInputSection');
            const btnGerarQR = document.getElementById('btnGerarQR');
            const btnGetCode = document.getElementById('btnGetCode');
            const modalPairingLink = document.getElementById('modalPairingLink');
            const modalBackToQR = document.getElementById('modalBackToQR');
            const modalPhoneNumber = document.getElementById('modalPhoneNumber');
            const nomeConexaoInput = document.getElementById('nomeConexaoInput');

            if (phoneInputSection.style.display === 'none') {
                // Mostrar input de telefone
                phoneInputSection.style.display = 'block';
                btnGerarQR.style.display = 'none';
                btnGetCode.style.display = 'block';
                modalPairingLink.style.display = 'none';
                modalBackToQR.style.display = 'inline';
                modalPhoneNumber.focus();
            } else {
                // Esconder input de telefone
                phoneInputSection.style.display = 'none';
                btnGerarQR.style.display = 'block';
                btnGetCode.style.display = 'none';
                modalPairingLink.style.display = 'inline';
                modalBackToQR.style.display = 'none';
                nomeConexaoInput.focus();
                // Limpar o input de telefone
                modalPhoneNumber.value = '';
            }
        }

        // Função para obter código de pareamento no modal (igual à página original)
        async function getPairingCodeModal() {
            const phoneNumberInput = document.getElementById('modalPhoneNumber');
            const nomeConexaoInput = document.getElementById('nomeConexaoInput');
            const btnGetCode = document.getElementById('btnGetCode');
            if (btnGetCode.disabled) return;
            btnGetCode.disabled = true;
            btnGetCode.innerHTML = `
                <svg style="animation: spin 1s linear infinite;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M16 12a4 4 0 0 0-8 0"/>
                </svg>
                Gerando...
            `;

            const phoneNumber = getCleanPhoneNumber(phoneNumberInput.value);
            const instanceBaseName = nomeConexaoInput.value.trim();
            let contaId;
            try {
                contaId = await obterUserIdComStatus();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    btnGetCode.disabled = false;
                    btnGetCode.innerHTML = 'Obter código';
                    return;
                }
                btnGetCode.disabled = false;
                btnGetCode.innerHTML = 'Obter código';
                throw error;
            }
            
            if (!phoneNumber || phoneNumber.length < 13) {
                showError('Por favor, digite um número de telefone válido com DDD');
                phoneNumberInput.focus();
                btnGetCode.disabled = false;
                btnGetCode.innerHTML = 'Obter código';
                return;
            }

            // Validação - nome não pode ser vazio
            if (!instanceBaseName) {
                showError('Por favor, digite o nome da conexão');
                nomeConexaoInput.focus();
                btnGetCode.disabled = false;
                btnGetCode.innerHTML = 'Obter código';
                return;
            }
            
            // Validação - apenas letras, números e espaço
            if (/[^a-zA-ZÀ-ÿ0-9\s]/.test(instanceBaseName)) {
                showError('O nome da conexão só pode conter letras, números e espaço');
                nomeConexaoInput.focus();
                btnGetCode.disabled = false;
                btnGetCode.innerHTML = 'Obter código';
                return;
            }

            if (!contaId) {
                showError('Sessão inválida. Recarregue a página.');
                btnGetCode.disabled = false;
                btnGetCode.innerHTML = 'Obter código';
                return;
            }

            console.log('Processando requisição para instância:', instanceBaseName, 'com telefone:', phoneNumber);

            try {
                console.log('Fazendo requisição para criar conexão com código de pareamento');
                const response = await fetch('/hublabel/public/criarconexaoback', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        contaId: contaId,
                        instanceName: instanceBaseName,
                        phoneNumber: phoneNumber,
                        pairCode: true // true para código de pareamento
                    })
                });

                console.log('Status da resposta:', response.status);
                const data = await response.json();
                console.log('Dados recebidos:', data);

                // Verificar se o limite de conexões foi atingido (antes de outras verificações)
                console.log('Verificando plano:', data.plano);
                if (data.plano === 'limite atingido') {
                    window.limiteConexoesAtingido = true;
                    renderConexoes();
                    console.log('Limite atingido detectado, fechando modal e exibindo toast...');
                    // Fechar o modal imediatamente
                    fecharModalCriarConexao();
                    // Mostrar notificação após fechar o modal
                    setTimeout(() => {
                        showToast('Limite de conexões atingido. Verifique seu plano nas configurações', 'info');
                    }, 100);
                    return;
                }

                if (!response.ok) {
                    throw new Error(data.message || 'Erro ao obter código de pareamento');
                }

                if (data.pairingCode && data.instanceName) {
                    console.log('Código de pareamento recebido:', data.pairingCode);
                    
                    // Mostrar sucesso
                    showSuccess('Código de pareamento gerado! Digite no seu WhatsApp.');
                    
                    // Recarregar lista de conexões
                    await carregarConexoes();
                    
                    // Encontrar o índice da nova conexão
                    const novaConexaoIndex = conexoesList.findIndex(c => c.instanceName === data.instanceName);
                    
                    if (novaConexaoIndex !== -1) {
                        console.log('🎯 Exibindo código de pareamento no modal...');
                        // Mostrar código de pareamento na tela do modal
                        mostrarCodigoNoModal(data.pairingCode, data.instanceName, novaConexaoIndex);
                    } else {
                        console.warn('⚠️ Nova conexão não encontrada na lista após recarregar');
                        showError('Conexão criada, mas não foi possível gerar o código automaticamente.');
                    }
                } else {
                    throw new Error('Código de pareamento não foi retornado pela API');
                }

            } catch (error) {
                console.error('Erro:', error);
                showError(error.message || 'Erro ao conectar com a API');
            } finally {
                // Restaurar botão
                btnGetCode.disabled = false;
                btnGetCode.innerHTML = 'Obter código';
            }
        }

        // Função para mostrar código de pareamento no modal
        function mostrarCodigoPareamentoModal(code, instanceName, index) {
            // Criar modal específico para código de pareamento
            const modal = document.createElement('div');
            modal.className = 'criar-conexao-modal show';
            modal.id = 'pairingCodeModal';
            
            modal.innerHTML = `
                <div class="criar-conexao-modal-content">
                    <h3>Digite o código no WhatsApp</h3>
                    <p class="modal-subtitle">Digite este código no seu WhatsApp para conectar.</p>
                    
                    <div class="criar-conexao-section">
                        <div class="code-container" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 30px; text-align: center;">
                            <h4 style="color: #6C63FF; margin-bottom: 20px; font-size: 1.2rem;">Código de Pareamento</h4>
                            <div style="font-size: 2.5rem; font-weight: bold; color: #fff; background: #6C63FF; padding: 20px 40px; border-radius: 8px; margin: 20px 0; letter-spacing: 3px; font-family: 'Courier New', monospace;">${code}</div>
                            <p style="color: #888; font-size: 0.9rem; margin-top: 15px;">Digite este código no seu WhatsApp</p>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn-modal-cancel" onclick="fecharCodigoPareamentoModal()">
                            Fechar
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Iniciar verificação de conexão
            iniciarVerificacaoConexaoModal(instanceName, index);
        }

        // Função para fechar modal de código de pareamento
        function fecharCodigoPareamentoModal() {
            const modal = document.getElementById('pairingCodeModal');
            if (modal) {
                modal.remove();
            }
        }

        // Função para iniciar verificação de conexão no modal
        function iniciarVerificacaoConexaoModal(instanceName, index) {
            const checkInterval = setInterval(async () => {
                try {
                    // Encontrar a conexão pelo instanceName
                    const conexao = conexoesList.find(c => c.instanceName === instanceName);
                    const apikey = conexao?.apikey;
                    
                    const response = await fetch(`https://evo.chatconversa.app.br/instance/connectionState/${instanceName}`, {
                        method: 'GET',
                        headers: {
                            'apikey': apikey
                        }
                    });

                    const data = await response.json();
                    
                    if (data.instance && data.instance.state === 'open') {
                        // Conexão estabelecida com sucesso
                        clearInterval(checkInterval);
                        fecharCodigoPareamentoModal();
                        fecharModalCriarConexao();
                        
                        // Encontrar o nome da conexão
                        const conexao = conexoesList.find(c => c.instanceName === instanceName);
                        const nomeConexao = conexao ? conexao.nome : instanceName;
                        console.log(`✅ Conexão "${nomeConexao}" estabelecida!`);
                        
                        showSuccess('✅ WhatsApp conectado com sucesso!');
                        
                        // Salvar foto do perfil
                        try {
                            const contaId = await obterUserIdComStatus();
                            await fetch('/hublabel/public/salvarfoto', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    contaId: contaId,
                                    instanceName: instanceName
                                })
                            });
                        } catch (photoError) {
                            console.error('Erro ao salvar foto:', photoError);
                        }
                        
                        // Recarregar conexões
                        await carregarConexoes();
                    }
                } catch (err) {
                    console.error('Erro ao verificar conexão:', err);
                }
            }, 5000);
        }

        // Função para alternar instruções no modal
        function toggleInstructions() {
            const instructionsContent = document.getElementById('instructionsContent');
            const toggleText = document.getElementById('instructionsToggleText');
            const toggleIcon = document.getElementById('instructionsToggleIcon');
            
            if (instructionsContent.style.display === 'none') {
                // Mostrar instruções
                instructionsContent.style.display = 'block';
                toggleText.textContent = 'Instruções -';
                toggleIcon.style.transform = 'rotate(180deg)';
            } else {
                // Esconder instruções
                instructionsContent.style.display = 'none';
                toggleText.textContent = 'Instruções +';
                toggleIcon.style.transform = 'rotate(0deg)';
            }
        }

        // Função para alternar entre telas do modal
        function showModalScreen(screenId) {
            // Esconder todas as telas
            document.getElementById('modalFormScreen').style.display = 'none';
            document.getElementById('modalQRScreen').style.display = 'none';
            document.getElementById('modalCodeScreen').style.display = 'none';
            
            // Mostrar a tela solicitada
            document.getElementById(screenId).style.display = 'flex';
        }

        // Função para voltar ao formulário
        function voltarParaFormulario() {
            showModalScreen('modalFormScreen');
            
            // Parar timers e verificações se estiverem rodando
            if (qrTimer) {
                clearInterval(qrTimer);
                qrTimer = null;
            }
            if (connectionChecker) {
                clearInterval(connectionChecker);
                connectionChecker = null;
            }
        }

        // Função para mostrar QR Code no modal
        function mostrarQRNoModal(qrCodeBase64, instanceName, index) {
            const qrImage = document.getElementById('modalQRImage');
            const timerEl = document.getElementById('modalQRTimer');
            
            // Definir a imagem do QR Code
            qrImage.src = qrCodeBase64;
            
            // Mostrar a tela do QR Code
            showModalScreen('modalQRScreen');
            
            // Iniciar timer
            let timeLeft = 29;
            timerEl.textContent = `Expira em ${timeLeft} segundos`;
            
            qrTimer = setInterval(() => {
                timeLeft--;
                timerEl.textContent = `Expira em ${timeLeft} segundos`;
                
                if (timeLeft <= 0) {
                    clearInterval(qrTimer);
                    qrTimer = null;
                    timerEl.textContent = 'QR Code expirado';
                    // Parar verificação quando QR expirar
                    if (connectionChecker) {
                        clearInterval(connectionChecker);
                        connectionChecker = null;
                    }
                }
            }, 1000);
            
            // Verificar conexão a cada 5 segundos
            connectionChecker = setInterval(async () => {
                console.log(`🔄 Verificando conexão ${instanceName}...`);
                const isConnected = await verificarConexaoSilenciosa(instanceName);
                if (isConnected) {
                    // Encontrar o nome da conexão
                    const conexao = conexoesList.find(c => c.instanceName === instanceName);
                    const nomeConexao = conexao ? conexao.nome : instanceName;
                    console.log(`✅ Conexão "${nomeConexao}" estabelecida!`);
                    voltarParaFormulario();
                    fecharModalCriarConexao();
                    showSuccess('WhatsApp conectado com sucesso!');
                    
                    // Salvar foto do perfil após conexão bem-sucedida
                    try {
                        console.log('Salvando foto do perfil...');
                        const contaId = await obterUserIdComStatus();
                        
                        const savePhotoResponse = await fetch('/hublabel/public/salvarfoto', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                contaId: contaId,
                                instanceName: instanceName
                            })
                        });

                        if (!savePhotoResponse.ok) {
                            console.error('Erro ao salvar foto:', await savePhotoResponse.text());
                        } else {
                            console.log('Foto salva com sucesso');
                        }
                        
                    } catch (photoError) {
                        console.error('Erro na requisição para salvar foto:', photoError);
                    }
                    
                    verificarConexao(instanceName, index);
                }
            }, 5000);
            
            console.log(`🔄 Iniciado verificação para ${instanceName} (a cada 5s)`);
        }

        // Função para mostrar código de pareamento no modal
        function mostrarCodigoNoModal(code, instanceName, index) {
            const pairingCodeEl = document.getElementById('modalPairingCode');
            
            // Definir o código de pareamento
            pairingCodeEl.textContent = code;
            
            // Mostrar a tela do código
            showModalScreen('modalCodeScreen');
            
            // Iniciar verificação de conexão
            iniciarVerificacaoConexaoModal(instanceName, index);
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

        // ===== MOBILE MENU FUNCTIONS =====
        function toggleMobileMenu() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            console.log('Toggle mobile menu clicked');
            
            if (sidebar.classList.contains('mobile-open')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }

        function openMobileMenu() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            console.log('Opening mobile menu');
            
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Garantir que o menu seja visível
            sidebar.style.pointerEvents = 'auto';
        }

        function closeMobileMenu() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            console.log('Closing mobile menu');
            
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            
            // Garantir que o menu seja desabilitado quando fechado
            sidebar.style.pointerEvents = 'none';
        }

        // Controlar visibilidade do botão baseado no título
        function initMenuToggleVisibility() {
            const menuToggle = document.getElementById('mobileMenuToggle');
            const titleElement = document.querySelector('h1');
            
            if (!menuToggle || !titleElement) return;
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        menuToggle.classList.add('visible');
                    } else {
                        menuToggle.classList.remove('visible');
                    }
                });
            }, {
                threshold: 0.1, // 10% do elemento visível
                rootMargin: '0px 0px -50px 0px' // Margem para considerar "visível"
            });
            
            observer.observe(titleElement);
        }

        // ===== INICIALIZAÇÃO DO MENU MOBILE =====
        function initMobileMenu() {
            console.log('Inicializando menu mobile');
            
            // Fechar menu ao redimensionar para desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeMobileMenu();
                }
            });
            
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
            
            // Fechar menu ao clicar no overlay
            const overlay = document.getElementById('sidebarOverlay');
            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    e.stopPropagation();
                    closeMobileMenu();
                });
            }
            
            // Prevenir propagação de eventos no sidebar
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                sidebar.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
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

        // Inicializar quando DOM estiver pronto
        document.addEventListener('DOMContentLoaded', function() {
            initMobileMenu();
            initDarkMode();
            initMenuOcultar();
        });

        // ===== DARK MODE / LIGHT MODE =====
        function initDarkMode() {
            // Carregar preferência do cookie
            const darkMode = getCookie('darkMode');
            const isDarkMode = darkMode === 'true';
            
            // Aplicar modo
            applyTheme(isDarkMode);
            
            // Configurar switch
            const toggle = document.getElementById('darkModeToggle');
            if (toggle) {
                toggle.checked = isDarkMode;
                toggle.addEventListener('change', function() {
                    const newMode = this.checked;
                    applyTheme(newMode);
                    setCookie('darkMode', newMode ? 'true' : 'false', 365);
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

    </script>

    </body>
</html>