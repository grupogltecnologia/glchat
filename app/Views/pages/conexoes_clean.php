<?php
/**
 * HTML/CSS original do n8n (limpo)
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Versão limpa: HTML + CSS apenas. JavaScript removido. -->
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
    
<!-- scripts removidos para manter somente HTML + CSS -->

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
</head>
<body>
    <!-- Tema antes da primeira pintura: evita flash claro (cookie darkMode, mesma lógica que getCookie) -->
    
<!-- scripts removidos para manter somente HTML + CSS -->

    <div class="toast-container" id="toastContainer"></div>

    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>

    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app-layout">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Botão de fechar para mobile -->
            <button class="mobile-close-btn" id="mobileCloseBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div class="sidebar-header">
                <a href="#" class="sidebar-logo-link">
                    <img class="sidebar-logo-img" src="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/logo" alt="IA Chatconversa">
                </a>
            </div>
            <nav class="sidebar-menu">
                <a href="#" class="menu-item">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">analytics</span>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="chat">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">chat</span>
                    </span>
                    <span class="menu-text">Chat</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="agentes-ia">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">network_intel_node</span>
                    </span>
                    <span class="menu-text">Agentes IA</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="crm">
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
                <a href="#" class="menu-item" data-menu-id="disparos">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">send</span>
                    </span>
                    <span class="menu-text">Disparos</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="contatos">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">contacts</span>
                    </span>
                    <span class="menu-text">Contatos</span>
                </a>
                <div class="sidebar-nav-divider"></div>
                <a href="#" class="menu-item" data-menu-id="ajuda">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">help</span>
                    </span>
                    <span class="menu-text">Ajuda</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="configuracoes">
                    <span class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1 1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </span>
                    <span class="menu-text">Configurações</span>
                </a>
                <a href="#" id="menu-item-admin" class="menu-item menu-item-admin" style="display: none;">
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
                <div class="menu-item theme-toggle-item">
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
                <a href="#" class="menu-item logout-item">
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
                    <input type="text" id="toolbarSearchInput" placeholder="Buscar por número ou nome...">
                </div>
                <div class="toolbar-divider"></div>
                <div class="toolbar-actions">
                    <select class="toolbar-select" id="toolbarFilterSelect">
                        <option value="todas">Todas as conexões</option>
                        <option value="conectadas">Apenas Conectadas</option>
                        <option value="desconectadas">Apenas Desconectadas</option>
                    </select>
                    <button class="toolbar-btn-delete" id="toolbarBtnDelete" style="display: none;">
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
    <button class="btn-delete-disconnected" id="btnDeleteDisconnected" style="display: none;">
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
                <button class="btn-confirm-cancel">
                    Cancelar
                </button>
                <button class="btn-confirm-delete" id="btnConfirmDelete">
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
    <div class="config-conexao-modal" id="configConexaoModal">
        <div class="config-conexao-modal-content">
            <div class="config-conexao-modal-header">
                <h3 class="config-conexao-modal-title">Configurações da conexão</h3>
                <div class="config-conexao-modal-header-actions">
                    <button type="button" class="config-conexao-modal-btn-excluir" title="Excluir conexão">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </button>
                    <button type="button" class="config-conexao-modal-close" title="Fechar">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>
            <div class="config-conexao-tabs">
                <button type="button" class="config-tab active" data-tab="conexao">Conexão</button>
                <button type="button" class="config-tab" data-tab="configuracoes">Configurações</button>
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
                        <button type="button" class="btn-gerar-qr-config" id="configBtnGerarQR" style="display: none;">Gerar QR Code</button>
                        <button type="button" class="btn-desconectar-config" id="configBtnDesconectar" style="display: none;">Desconectar</button>
                    </div>
                </div>
                <div class="config-tab-content" id="configTabConfiguracoes">
                    <h4 class="config-section-title">Sincronizar Contatos</h4>
                    <p class="config-section-desc">Sincronize todos os contatos do seu WhatsApp para a ferramenta.</p>
                    <p id="configSyncAvisoDesconectado" class="config-sync-aviso" style="display: none;">Você precisa conectar o WhatsApp para sincronizar os contatos.</p>
                    <button type="button" class="btn-sincronizar-contatos" id="configBtnSincronizar">
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
                <button class="btn-modal-cancel">
                    Cancelar
                </button>
                <button class="btn-modal-save" id="btnSalvarApiKey">
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
                <button class="modal-close-btn">
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

                        <div class="form-group-modal">
                            <label style="display:block;font-size:13px;font-weight:800;color:#334155;margin-bottom:10px;">Tipo de API</label>
                            <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;" id="providerOptions">
                                <label class="provider-option" style="cursor:pointer;border:1px solid #d6e0ef;border-radius:14px;padding:12px;background:#fff;display:flex;gap:10px;align-items:flex-start;">
                                    <input type="radio" name="connectionProvider" value="evolution" checked style="margin-top:3px;">
                                    <span>
                                        <strong style="display:block;color:#0f172a;font-size:13px;">Evolution</strong>
                                        <small style="color:#64748b;">QR Code via Evolution API</small>
                                    </span>
                                </label>
                                <label class="provider-option" style="cursor:pointer;border:1px solid #d6e0ef;border-radius:14px;padding:12px;background:#fff;display:flex;gap:10px;align-items:flex-start;">
                                    <input type="radio" name="connectionProvider" value="oficial" style="margin-top:3px;">
                                    <span>
                                        <strong style="display:block;color:#0f172a;font-size:13px;">Oficial</strong>
                                        <small style="color:#64748b;">Meta / Embedded Signup</small>
                                    </span>
                                </label>
                                <label class="provider-option" style="cursor:pointer;border:1px solid #d6e0ef;border-radius:14px;padding:12px;background:#fff;display:flex;gap:10px;align-items:flex-start;">
                                    <input type="radio" name="connectionProvider" value="uazapi" style="margin-top:3px;">
                                    <span>
                                        <strong style="display:block;color:#0f172a;font-size:13px;">Uazapi</strong>
                                        <small style="color:#64748b;">QR Code via Uazapi</small>
                                    </span>
                                </label>
                            </div>
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

                        <button class="btn-gerar-qr" id="btnGerarQR">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/><line x1="21" y1="14" x2="21" y2="17"/><line x1="14" y1="21" x2="17" y2="21"/></svg>
                            Gerar QR Code
                        </button>
                        <button class="btn-gerar-qr" id="btnGetCode" style="display: none;">
                            Obter código
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="link-pareamento" id="modalPairingLink">
                        Conectar via código de pareamento
                    </a>
                    <a href="#" class="link-pareamento" id="modalBackToQR" style="display: none;">
                        Voltar para QR Code
                    </a>

                    <button class="instructions-toggle" id="instructionsToggle">
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
                    <button class="btn-modal-back">
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
                    <button class="btn-modal-back">
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

    
<!-- scripts removidos para manter somente HTML + CSS -->

    <script>
        (() => {
            const API = '/hublabel/public/api/conexoes';
            let conexoesList = [];
            let qrTimerInterval = null;
            let qrStatusInterval = null;
            let qrWatchConnectionId = null;
            let statusRefreshRunning = false;

            document.addEventListener('DOMContentLoaded', () => {
                bindConexoesUI();
                carregarConexoes();
            });

            function bindConexoesUI() {
                document.getElementById('toolbarSearchInput')?.addEventListener('input', renderConexoes);
                document.getElementById('toolbarFilterSelect')?.addEventListener('change', renderConexoes);
                document.querySelector('#criarConexaoModal .modal-close-btn')?.addEventListener('click', fecharModalCriarConexao);
                document.querySelectorAll('#criarConexaoModal .btn-modal-back').forEach(btn => btn.addEventListener('click', () => {
                    pararMonitorQr();
                    mostrarFormularioConexao();
                }));
                document.getElementById('btnGerarQR')?.addEventListener('click', criarConexaoPeloModal);
                document.getElementById('closeQrModal')?.addEventListener('click', fecharQrModal);
                document.getElementById('instructionsToggle')?.addEventListener('click', () => {
                    const content = document.getElementById('instructionsContent');
                    if (content) content.style.display = content.style.display === 'none' ? 'block' : 'none';
                });
                document.getElementById('modalPairingLink')?.addEventListener('click', (event) => {
                    event.preventDefault();
                    mostrarMensagem('Codigo de pareamento sera ligado na etapa da API. Use QR Code por enquanto.', 'error');
                });
                document.querySelectorAll('input[name="connectionProvider"]').forEach(input => {
                    input.addEventListener('change', atualizarProviderOptions);
                });
                atualizarProviderOptions();
            }

            async function carregarConexoes() {
                mostrarLoading(true);
                try {
                    const result = await fetchJson(API);
                    if (!result.success) throw new Error(result.error || 'Erro ao carregar conexoes');
                    conexoesList = (result.data || []).map(normalizarConexao);
                    renderConexoes();
                    atualizarStatusEmSegundoPlano();
                } catch (error) {
                    mostrarMensagem(error.message, 'error');
                } finally {
                    mostrarLoading(false);
                }
            }

            function renderConexoes() {
                const grid = document.getElementById('conexoesGrid');
                const toolbar = document.getElementById('conexoesToolbar');
                const empty = document.getElementById('emptyState');
                if (!grid) return;

                const search = (document.getElementById('toolbarSearchInput')?.value || '').toLowerCase();
                const filter = document.getElementById('toolbarFilterSelect')?.value || 'todas';
                const filtered = conexoesList.filter(conn => {
                    const haystack = `${conn.nome} ${conn.telefone} ${conn.providerLabel}`.toLowerCase();
                    const status = statusGrupo(conn.status);
                    return (!search || haystack.includes(search))
                        && (filter === 'todas' || (filter === 'conectadas' && status === 'conectado') || (filter === 'desconectadas' && status !== 'conectado'));
                });

                grid.innerHTML = '';
                filtered.forEach(conn => grid.appendChild(criarCardConexao(conn)));
                grid.appendChild(criarCardAdicionar());
                grid.style.display = 'grid';
                if (toolbar) toolbar.style.display = conexoesList.length ? 'flex' : 'none';
                if (empty) empty.style.display = 'none';
                atualizarKPIs();
            }

            function criarCardConexao(conn) {
                const card = document.createElement('div');
                const status = statusGrupo(conn.status);
                card.className = 'conexao-card' + (status === 'conectado' ? '' : ' card-desconectado');
                const statusClass = status === 'conectado' ? 'status-conectado' : (status === 'conectando' ? 'status-verificando' : 'status-desconectado');
                const statusText = status === 'conectado' ? 'Conectado' : (status === 'conectando' ? 'Conectando' : 'Desconectado');
                const actionButton = conn.provider === 'oficial'
                    ? `<button class="btn-verificar" type="button" data-action="oficial">Configurar Oficial</button>`
                    : status === 'conectado'
                        ? `<button class="btn-verificar" type="button" data-action="status">Verificar</button>`
                        : `<button class="btn-qrcode" type="button" data-action="qrcode">${status === 'conectando' ? 'Mostrar QR Code' : 'Conectar'}</button>`;
                card.innerHTML = `
                    <div class="card-indicator ${status === 'conectado' ? 'connected' : (status === 'conectando' ? 'checking' : 'disconnected')}"></div>
                    <div class="conexao-header">
                        ${conn.foto ? `<img src="${escapeHtml(conn.foto)}" alt="Foto" class="profile-photo">` : `<div class="profile-photo"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg></div>`}
                        <div class="conexao-info">
                            <h3>${escapeHtml(conn.nome)}</h3>
                            <div class="telefone">${escapeHtml(conn.telefone || 'Telefone nao disponivel')}</div>
                            <div style="margin-top:7px;font-size:11px;font-weight:800;color:#635bff;text-transform:uppercase;letter-spacing:.04em;">${escapeHtml(conn.providerLabel)}</div>
                        </div>
                    </div>
                    <div class="card-status-area">
                        <div class="status-badge ${statusClass}">
                            <span class="status-dot"><span class="status-dot-ping"></span><span class="status-dot-core"></span></span>
                            ${statusText}
                        </div>
                    </div>
                    <div class="conexao-actions">
                        ${actionButton}
                        <button class="btn-config-conexao" type="button" data-action="delete" title="Excluir conexao">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"></polyline><path d="M19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"></path></svg>
                        </button>
                    </div>
                `;
                card.querySelector('[data-action="qrcode"]')?.addEventListener('click', () => gerarQRCode(conn.id));
                card.querySelector('[data-action="status"]')?.addEventListener('click', () => verificarStatusConexao(conn.id, true));
                card.querySelector('[data-action="oficial"]')?.addEventListener('click', () => mostrarMensagem('A conexao oficial foi criada. Use o Embedded Signup/API Oficial para concluir as credenciais Meta.', 'success'));
                card.querySelector('[data-action="delete"]')?.addEventListener('click', () => deletarConexao(conn.id));
                return card;
            }

            function criarCardAdicionar() {
                const card = document.createElement('div');
                card.className = 'conexao-card conexao-card-criar';
                card.innerHTML = `
                    <div class="conexao-card-criar-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                    </div>
                    <div class="conexao-card-criar-title">Adicionar Aparelho</div>
                    <div class="conexao-card-criar-desc">Escolha Evolution, API Oficial ou Uazapi para vincular um novo WhatsApp.</div>
                `;
                card.addEventListener('click', abrirModalCriarConexao);
                return card;
            }

            async function criarConexaoPeloModal() {
                const nomeInput = document.getElementById('nomeConexaoInput');
                const btn = document.getElementById('btnGerarQR');
                const nomeConexao = (nomeInput?.value || '').trim();
                const provider = document.querySelector('input[name="connectionProvider"]:checked')?.value || 'evolution';
                if (!nomeConexao) {
                    mostrarMensagem('Informe o nome da conexao.', 'error');
                    nomeInput?.focus();
                    return;
                }

                setButtonLoading(btn, true);
                try {
                    const criado = await fetchJson(API + '/criar', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ nomeConexao, provider, apiOficial: provider === 'oficial' ? 1 : 0 })
                    });
                    if (!criado.success) throw new Error(criado.error || 'Erro ao criar conexao');

                    if (provider === 'oficial') {
                        fecharModalCriarConexao();
                        mostrarMensagem('Conexao oficial criada. Conclua o Embedded Signup para gravar token, WABA e phone number.', 'success');
                        await carregarConexoes();
                        return;
                    }

                    const id = criado.data?.id;
                    if (!id) throw new Error('Conexao criada sem ID');
                    await carregarConexoes();
                    await gerarQRCode(id, true);
                } catch (error) {
                    mostrarMensagem(error.message, 'error');
                } finally {
                    setButtonLoading(btn, false);
                }
            }

            async function gerarQRCode(id, noModal = false) {
                try {
                    pararMonitorQr();
                    qrWatchConnectionId = Number(id);
                    const result = await fetchJson(API + '/qrcode', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id })
                    });
                    if (!result.success) throw new Error(result.error || 'Erro ao gerar QR Code');
                    atualizarConexaoLocal(id, { statusConexao: 'conectando' });
                    renderConexoes();
                    mostrarQRCode(result.data?.qrcode, noModal, id);
                    iniciarContadorQr(noModal, 30);
                    iniciarMonitorStatus(id, noModal);
                } catch (error) {
                    pararMonitorQr();
                    mostrarMensagem(error.message, 'error');
                }
            }

            async function verificarStatusConexao(id, notify = false, closeOnConnected = true) {
                const result = await fetchJson(API + '/status', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                });
                if (!result.success) throw new Error(result.error || 'Erro ao verificar status');

                const status = result.data?.statusConexao || 'desconectado';
                atualizarConexaoLocal(id, {
                    statusConexao: status,
                    telefone: result.data?.telefone,
                    fotoPerfil: result.data?.fotoPerfil
                });
                renderConexoes();

                if (statusGrupo(status) === 'conectado') {
                    if (closeOnConnected) {
                        fecharQrModal();
                        document.getElementById('criarConexaoModal')?.classList.remove('show');
                        mostrarMensagem('WhatsApp conectado com sucesso.', 'success');
                        await carregarConexoes();
                    }
                    return true;
                }

                if (notify) {
                    mostrarMensagem(status === 'conectando' ? 'Conexao ainda aguardando leitura do QR Code.' : 'Conexao ainda nao conectada.', 'error');
                }
                return false;
            }

            async function atualizarStatusEmSegundoPlano() {
                if (statusRefreshRunning) return;
                const targets = conexoesList.filter(conn => conn.provider !== 'oficial' && conn.instanceName);
                if (!targets.length) return;

                statusRefreshRunning = true;
                try {
                    for (const conn of targets) {
                        try {
                            await verificarStatusConexao(conn.id, false, false);
                        } catch (error) {
                            console.warn('Status da conexao nao atualizado:', error.message);
                        }
                    }
                } finally {
                    statusRefreshRunning = false;
                }
            }

            async function deletarConexao(id) {
                if (!confirm('Excluir esta conexao?')) return;
                try {
                    const result = await fetchJson(API + '/deletar', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id })
                    });
                    if (!result.success) throw new Error(result.error || 'Erro ao excluir conexao');
                    mostrarMensagem('Conexao excluida.', 'success');
                    await carregarConexoes();
                } catch (error) {
                    mostrarMensagem(error.message, 'error');
                }
            }

            function abrirModalCriarConexao() {
                document.getElementById('nomeConexaoInput').value = '';
                document.querySelector('input[name="connectionProvider"][value="evolution"]').checked = true;
                atualizarProviderOptions();
                mostrarFormularioConexao();
                document.getElementById('criarConexaoModal')?.classList.add('show');
                setTimeout(() => document.getElementById('nomeConexaoInput')?.focus(), 80);
            }

            function fecharModalCriarConexao() {
                pararMonitorQr();
                document.getElementById('criarConexaoModal')?.classList.remove('show');
            }

            function mostrarFormularioConexao() {
                document.getElementById('modalFormScreen').style.display = '';
                document.getElementById('modalQRScreen').style.display = 'none';
                document.getElementById('modalCodeScreen').style.display = 'none';
            }

            function mostrarQRCode(qrcode, noModal, id) {
                if (!qrcode) {
                    throw new Error('QR Code vazio retornado pela API');
                }
                if (String(qrcode).startsWith('data:image') || String(qrcode).startsWith('http')) {
                    const img = noModal ? document.getElementById('modalQRImage') : document.getElementById('qrImage');
                    if (img) img.src = qrcode;
                    if (noModal) {
                        document.getElementById('modalFormScreen').style.display = 'none';
                        document.getElementById('modalQRScreen').style.display = '';
                    } else {
                        document.getElementById('qrModal')?.classList.add('show');
                    }
                    return;
                }
                document.getElementById('modalPairingCode').textContent = String(qrcode);
                document.getElementById('modalFormScreen').style.display = 'none';
                document.getElementById('modalQRScreen').style.display = 'none';
                document.getElementById('modalCodeScreen').style.display = '';
                document.getElementById('criarConexaoModal')?.classList.add('show');
            }

            function fecharQrModal(stop = true) {
                document.getElementById('qrModal')?.classList.remove('show');
                if (stop) pararMonitorQr();
            }

            function iniciarContadorQr(noModal, seconds) {
                pararContadorQr();
                let remaining = seconds;
                atualizarTextoTimer(noModal, remaining);
                qrTimerInterval = setInterval(() => {
                    remaining -= 1;
                    atualizarTextoTimer(noModal, remaining);
                    if (remaining <= 0) {
                        pararContadorQr();
                    }
                }, 1000);
            }

            function atualizarTextoTimer(noModal, remaining) {
                const el = document.getElementById(noModal ? 'modalQRTimer' : 'qrTimer');
                if (!el) return;
                if (remaining <= 0) {
                    el.textContent = 'QR Code expirado. Gere novamente.';
                    return;
                }
                el.textContent = `Expira em ${remaining} segundo${remaining === 1 ? '' : 's'}`;
            }

            function pararContadorQr() {
                if (qrTimerInterval) {
                    clearInterval(qrTimerInterval);
                    qrTimerInterval = null;
                }
            }

            function iniciarMonitorStatus(id, noModal) {
                pararMonitorStatus();
                let attempts = 0;
                qrStatusInterval = setInterval(async () => {
                    attempts += 1;
                    try {
                        const connected = await verificarStatusConexao(id, false);
                        if (connected || attempts >= 60) {
                            pararMonitorQr();
                        }
                    } catch (error) {
                        if (attempts >= 3) {
                            console.warn('Erro ao verificar status da conexao:', error.message);
                        }
                    }
                }, 2500);
            }

            function pararMonitorStatus() {
                if (qrStatusInterval) {
                    clearInterval(qrStatusInterval);
                    qrStatusInterval = null;
                }
            }

            function pararMonitorQr() {
                pararContadorQr();
                pararMonitorStatus();
                qrWatchConnectionId = null;
            }

            function atualizarConexaoLocal(id, patch) {
                const index = conexoesList.findIndex(conn => Number(conn.id) === Number(id));
                if (index === -1) return;
                const current = conexoesList[index];
                conexoesList[index] = normalizarConexao({
                    ...current,
                    ...patch,
                    statusConexao: patch.statusConexao ?? current.status,
                    Telefone: patch.telefone ?? current.telefone,
                    FotoPerfil: patch.fotoPerfil ?? current.foto
                });
            }

            function atualizarProviderOptions() {
                document.querySelectorAll('.provider-option').forEach(label => {
                    const checked = label.querySelector('input')?.checked;
                    label.style.borderColor = checked ? '#6c5cff' : '#d6e0ef';
                    label.style.background = checked ? '#f4f2ff' : '#fff';
                    label.style.boxShadow = checked ? '0 0 0 2px rgba(108,92,255,.12)' : 'none';
                });
            }

            function atualizarKPIs() {
                const total = conexoesList.length;
                const conectadas = conexoesList.filter(conn => statusGrupo(conn.status) === 'conectado').length;
                const desconectadas = total - conectadas;
                document.getElementById('kpiTotal').textContent = total;
                document.getElementById('kpiConectadas').textContent = conectadas;
                document.getElementById('kpiDesconectadas').textContent = desconectadas;
            }

            function normalizarConexao(conn) {
                const provider = conn.provider || (Number(conn.apiOficial) === 1 ? 'oficial' : 'evolution');
                return {
                    id: Number(conn.id),
                    nome: conn.NomeConexao || conn.nomeConexao || conn.nome || 'Conexao sem nome',
                    telefone: conn.Telefone || conn.telefone || conn.numeroConexao || '',
                    foto: conn.FotoPerfil || conn.fotoPerfil || '',
                    provider,
                    providerLabel: provider === 'oficial' ? 'API Oficial' : (provider === 'uazapi' ? 'Uazapi' : 'Evolution API'),
                    status: conn.statusConexao || 'desconectado',
                    instanceName: conn.instanceName || ''
                };
            }

            function statusGrupo(status) {
                const value = String(status || '').toLowerCase();
                if (['open', 'connected', 'conectado', 'online'].includes(value)) return 'conectado';
                if (['connecting', 'conectando', 'qrcode', 'qr', 'pairing'].includes(value)) return 'conectando';
                return 'desconectado';
            }

            function mostrarLoading(show) {
                const loading = document.getElementById('loadingContainer');
                const grid = document.getElementById('conexoesGrid');
                if (loading) loading.style.display = show ? '' : 'none';
                if (grid) grid.style.display = show ? 'none' : 'grid';
            }

            function mostrarMensagem(message, type) {
                const el = document.getElementById(type === 'success' ? 'successMessage' : 'errorMessage');
                const other = document.getElementById(type === 'success' ? 'errorMessage' : 'successMessage');
                if (other) other.style.display = 'none';
                if (!el) return;
                el.textContent = message;
                el.style.display = 'block';
                setTimeout(() => { el.style.display = 'none'; }, 4500);
            }

            function setButtonLoading(button, loading) {
                if (!button) return;
                button.disabled = loading;
                button.dataset.originalText = button.dataset.originalText || button.innerHTML;
                button.innerHTML = loading ? 'Aguarde...' : button.dataset.originalText;
            }

            async function fetchJson(url, options = {}) {
                const response = await fetch(url, options);
                const text = await response.text();
                try {
                    return JSON.parse(text);
                } catch (error) {
                    throw new Error(text.replace(/<[^>]*>/g, ' ').trim() || 'Resposta invalida do servidor');
                }
            }

            function escapeHtml(value) {
                const div = document.createElement('div');
                div.textContent = value ?? '';
                return div.innerHTML;
            }
        })();
    </script>

    <script src="/hublabel/public/assets/js/menu-global.js"></script>

</body>
</html>
