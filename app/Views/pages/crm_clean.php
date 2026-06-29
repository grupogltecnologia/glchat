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
    <title>CRM - IA Chatconversa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="shortcut icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="apple-touch-icon" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <!-- Font Awesome (igual gemini.html) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-500': '#6C63FF',
                        'brand-50': 'rgba(108, 99, 255, 0.1)',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts: Plus Jakarta Sans (igual dashboard) -->
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

        /* ===== Dark Mode - Slate-Blue Palette (igual dashboard) ===== */
        body.dark-mode .main-content {
            background: transparent;
        }

        body.dark-mode .header-content h1 {
            color: #f8fafc;
        }

        body.dark-mode .header-content p {
            color: #94a3b8;
        }

        /* Métricas */
        body.dark-mode .crm-metric-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        body.dark-mode .crm-metric-label {
            color: #94a3b8;
        }

        body.dark-mode .crm-metric-value {
            color: #f8fafc;
        }

        body.dark-mode .crm-metric-icon.deals {
            background: rgba(37, 99, 235, 0.15);
        }

        body.dark-mode .crm-metric-icon.boards {
            background: rgba(71, 85, 105, 0.3);
        }

        /* Busca e controles */
        body.dark-mode .crm-search-input {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
            color: #f8fafc;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        body.dark-mode .crm-search-input::placeholder {
            color: #64748b;
        }

        body.dark-mode .crm-search-icon {
            color: #64748b;
        }

        body.dark-mode .crm-order-label {
            color: #94a3b8;
        }

        /* Cards dos Quadros — .crm-order-select no dark: ver <style> após dropdowns-global.css */
        body.dark-mode .quadro-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        body.dark-mode .quadro-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.25);
            border-color: rgba(71, 85, 105, 0.6);
        }

        body.dark-mode .quadro-card-nome {
            color: #f8fafc;
        }

        body.dark-mode .quadro-card-descricao {
            color: #94a3b8;
        }

        body.dark-mode .quadro-card-icon {
            background: rgba(51, 65, 85, 0.5);
            box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        }

        body.dark-mode .quadro-card-valor {
            color: #f8fafc;
        }

        body.dark-mode .quadro-card-valor-label-pill {
            color: #94a3b8;
        }

        body.dark-mode .quadro-card-stats-header {
            color: #94a3b8;
        }

        body.dark-mode .quadro-card-stats-badge {
            background: rgba(51, 65, 85, 0.5);
            color: #e2e8f0;
        }

        body.dark-mode .quadro-card-progress {
            background: rgba(51, 65, 85, 0.5);
        }

        body.dark-mode .quadro-card-footer {
            border-top-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .quadro-card-footer-info {
            color: #94a3b8;
        }

        body.dark-mode .quadro-card-footer-btn {
            background: rgba(108, 99, 255, 0.15);
            color: #6C63FF;
        }

        body.dark-mode .quadro-card-footer-btn:hover {
            background: #6C63FF;
            color: #ffffff;
        }

        body.dark-mode .quadro-card-menu-btn {
            color: #94a3b8;
        }

        body.dark-mode .quadro-card-menu-btn:hover {
            background: rgba(51, 65, 85, 0.5);
            color: #e2e8f0;
        }

        body.dark-mode .quadro-card-edit-btn {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
            color: #94a3b8;
        }

        body.dark-mode .quadro-card-edit-btn:hover {
            background: rgba(51, 65, 85, 0.8);
            border-color: rgba(71, 85, 105, 0.6);
            color: #e2e8f0;
        }

        body.dark-mode .quadro-card-delete-btn {
            border-color: rgba(255, 68, 68, 0.3);
            color: #ff6b6b;
        }

        body.dark-mode .quadro-card-delete-btn:hover {
            background: rgba(255, 68, 68, 0.15);
            border-color: #ff6b6b;
        }

        /* Card Criar Quadro */
        body.dark-mode .quadro-card-criar {
            background: rgba(30, 41, 59, 0.3);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .quadro-card-criar:hover {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(108, 99, 255, 0.4);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        body.dark-mode .quadro-card-criar-icon {
            background: rgba(51, 65, 85, 0.4);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .quadro-card-criar:hover .quadro-card-criar-icon {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.dark-mode .quadro-card-criar-icon svg {
            color: #64748b;
        }

        body.dark-mode .quadro-card-criar:hover .quadro-card-criar-icon svg {
            color: #6C63FF;
        }

        body.dark-mode .quadro-card-criar-title {
            color: #94a3b8;
        }

        body.dark-mode .quadro-card-criar:hover .quadro-card-criar-title {
            color: #6C63FF;
        }

        body.dark-mode .quadro-card-criar-desc {
            color: #64748b;
        }

        /* Botão criar quadro */
        body.dark-mode .btn-criar-quadro {
            box-shadow: 0 12px 30px rgba(108, 99, 255, 0.2);
        }

        /* Empty state */
        body.dark-mode .empty-state {
            color: #64748b;
        }

        body.dark-mode .empty-state h3 {
            color: #94a3b8;
        }

        /* Loading / Skeleton */
        body.dark-mode .loading-text {
            color: #64748b;
        }

        body.dark-mode .skeleton-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .skeleton-card .skeleton-icon,
        body.dark-mode .skeleton-card .skeleton-line {
            background: rgba(51, 65, 85, 0.5);
        }

        body.dark-mode .skeleton-card .skeleton-footer {
            border-top-color: rgba(71, 85, 105, 0.4);
        }

        /* Modal */
        body.dark-mode .criar-quadro-modal-content {
            background: rgba(15, 23, 42, 0.95);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .criar-quadro-modal h3 {
            color: #f8fafc;
        }

        body.dark-mode .modal-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .criar-quadro-section h4 {
            color: #f8fafc;
        }

        body.dark-mode .form-group-modal label {
            color: #94a3b8;
        }

        body.dark-mode .form-group-modal input[type="text"],
        body.dark-mode .form-group-modal textarea {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
            color: #f8fafc;
        }

        body.dark-mode .form-group-modal input[type="text"]::placeholder,
        body.dark-mode .form-group-modal textarea::placeholder {
            color: #64748b;
        }

        body.dark-mode .form-group-modal input[type="color"] {
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .modal-close-btn {
            color: #94a3b8;
        }

        body.dark-mode .modal-close-btn:hover {
            background: rgba(51, 65, 85, 0.5);
            color: #e2e8f0;
        }

        body.dark-mode .btn-modal-cancel {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
            color: #e2e8f0;
        }

        body.dark-mode .btn-modal-cancel:hover {
            background: rgba(51, 65, 85, 0.8);
        }

        body.dark-mode .btn-modal-create:disabled {
            background: rgba(51, 65, 85, 0.5);
            color: #64748b;
        }

        body.dark-mode .criar-quadro-modal-content--create {
            box-shadow: 0 32px 72px rgba(0, 0, 0, 0.6);
        }

        body.dark-mode .modal-kicker-create {
            color: #86efac;
            background: rgba(34, 197, 94, 0.16);
            border-color: rgba(34, 197, 94, 0.35);
        }

        body.dark-mode .criar-quadro-modal-content--create .modal-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .criar-quadro-modal-content--create .criar-quadro-section,
        body.dark-mode .criar-quadro-modal-content--create .modal-footer {
            border-color: rgba(71, 85, 105, 0.45);
        }

        body.dark-mode .modal-field-help {
            color: #64748b;
        }

        body.dark-mode .icon-option {
            border-color: rgba(71, 85, 105, 0.4);
            background: rgba(30, 41, 59, 0.4);
        }

        body.dark-mode .icon-option:hover {
            border-color: rgba(108, 99, 255, 0.4);
            background: rgba(108, 99, 255, 0.1);
        }

        body.dark-mode .icon-option.selected {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.15);
        }

        body.dark-mode .icon-option svg {
            color: #94a3b8;
        }

        body.dark-mode .icon-option.selected svg {
            color: #6C63FF;
        }

        /* Toast em dark mode */
        body.dark-mode .toast-notification {
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - igual dashboard */
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

        .menu-item .menu-text {
            margin-left: 0;
            opacity: 0;
            width: 0;
            overflow: hidden;
            flex: 0;
            transition: opacity 0.2s ease, margin-left 0.2s ease, width 0.2s ease;
        }

        .sidebar:hover .menu-item,
        .sidebar.sidebar-expanded .menu-item,
        .sidebar.mobile-open .menu-item {
            justify-content: flex-start;
            padding: 10px 12px;
        }

        .sidebar:hover .menu-item .menu-text,
        .sidebar.sidebar-expanded .menu-item .menu-text,
        .sidebar.mobile-open .menu-item .menu-text {
            margin-left: 16px;
            opacity: 1;
            width: auto;
            flex: 1;
            min-width: 0;
            flex-shrink: 0;
            overflow: visible;
        }

        .menu-item:hover {
            background: rgba(108, 99, 255, 0.14);
            color: #fff;
        }

        .menu-item.active {
            background: rgba(108, 99, 255, 0.18);
            color: #fff;
        }

        .menu-item-admin { font-weight: 700 !important; }

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

        .menu-badge-novidade {
            display: none;
            margin-left: auto;
            font-size: 0.6rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 999px;
            background: #6C63FF;
            color: #fff;
            border: none;
            flex-shrink: 0;
        }

        .sidebar:hover .menu-badge-novidade,
        .sidebar.sidebar-expanded .menu-badge-novidade,
        .sidebar.mobile-open .menu-badge-novidade {
            display: inline-block;
        }

        .menu-badge-admin {
            margin-left: auto;
            font-size: 0.6rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 999px;
            background: #6C63FF;
            color: #fff;
            display: none;
        }

        .sidebar:hover .menu-badge-admin,
        .sidebar.sidebar-expanded .menu-badge-admin,
        .sidebar.mobile-open .menu-badge-admin { display: inline-block; }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 0;
            flex-shrink: 0;
        }

        .version-text {
            color: rgba(148, 163, 184, 0.9);
            font-size: 0.7rem;
            text-align: center;
            padding: 8px 12px;
            opacity: 0;
            transition: opacity 0.2s ease;
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
            .sidebar-header { padding: 12px 16px; }
            .sidebar-menu { padding: 8px 0; }
            .menu-item { padding: 8px 0; }
            .menu-icon { width: 26px; }
            .menu-icon svg { width: 18px; height: 18px; }
            .menu-icon .material-symbols-rounded { font-size: 18px; }
            .version-text { padding: 6px 12px; font-size: 0.6rem; }
            .sidebar-footer { padding: 8px 0; }
        }
        @media (max-height: 700px) {
            .sidebar-header { padding: 8px 16px; }
            .sidebar-menu { padding: 6px 0; }
            .menu-item { padding: 6px 0; }
            .menu-icon { width: 22px; }
            .menu-icon svg { width: 16px; height: 16px; }
            .menu-icon .material-symbols-rounded { font-size: 16px; }
            .menu-text { font-size: 0.85rem; }
            .version-text { padding: 4px 12px; font-size: 0.55rem; }
            .sidebar-footer { padding: 6px 0; }
            .theme-switch { width: 38px; height: 20px; }
        }
        @media (max-height: 600px) {
            .sidebar-header { padding: 6px 12px; }
            .sidebar-menu { padding: 4px 0; }
            .menu-item { padding: 6px 0; }
            .menu-icon { width: 20px; }
            .menu-icon svg { width: 14px; height: 14px; }
            .menu-icon .material-symbols-rounded { font-size: 14px; }
            .menu-text { font-size: 0.8rem; margin-left: 4px; }
            .version-text { padding: 2px 12px; font-size: 0.5rem; }
            .sidebar-footer { padding: 4px 0; }
            .theme-switch { width: 34px; height: 18px; }
        }

        /* Dark Mode Toggle Switch - igual dashboard */
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

        /* Main content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-x: auto;
            margin-left: 72px;
        }

        .header {
            margin-bottom: 32px;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .header-content h1 {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            margin-bottom: 8px;
        }

        .header-content p {
            color: #6b7280;
            font-size: 1rem;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-criar-quadro {
            padding: 14px 28px;
            background: #6C63FF;
            border: none;
            border-radius: 24px;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            white-space: nowrap;
            box-shadow: 0 12px 30px rgba(108, 99, 255, 0.35);
        }

        .btn-criar-quadro:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 40px rgba(108, 99, 255, 0.45);
        }

        /* Métricas globais CRM (estilo gemini) */
        .crm-metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            margin-bottom: 28px;
        }

        .crm-metric-card {
            background: #ffffff;
            border-radius: 32px;
            padding: 24px 28px;
            box-shadow: var(--shadow-soft);
            border: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .crm-metric-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .crm-metric-icon.money { background: rgba(108, 99, 255, 0.1); color: #6C63FF; }
        .crm-metric-icon.deals { background: #e0edff; color: #2563eb; }
        .crm-metric-icon.boards { background: #e5e7eb; color: #4b5563; }

        .crm-metric-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #9ca3af;
            margin-bottom: 4px;
        }

        .crm-metric-value {
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -0.04em;
            color: #0f172a;
        }

        /* Busca e ordenação */
        .crm-controls {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .crm-search {
            position: relative;
            max-width: 360px;
            width: 100%;
        }

        .crm-search-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .crm-search-input {
            width: 100%;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            padding: 12px 16px 12px 40px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: inherit;
            color: #111827;
            outline: none;
            box-shadow: 0 4px 12px rgba(148, 163, 184, 0.18);
        }

        .crm-search-input::placeholder {
            color: #9ca3af;
            font-weight: 600;
        }

        .crm-search-input:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 1px rgba(108, 99, 255, 0.25), 0 8px 20px rgba(108, 99, 255, 0.15);
        }

        .crm-order {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .crm-order-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #9ca3af;
        }

        .crm-order-select {
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            padding: 8px 20px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: inherit;
            color: #374151;
            background: #ffffff;
            cursor: pointer;
            outline: none;
            box-shadow: 0 4px 12px rgba(148, 163, 184, 0.18);
        }

        .crm-order-select:focus {
            border-color: #6C63FF;
        }

        @media (max-width: 900px) {
            .crm-metrics-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Loading state */
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(108, 99, 255, 0.2);
            border-top: 4px solid #6C63FF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
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

        .loading-text {
            color: #888;
            font-size: 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Skeleton loading - layout dos cards com animação piscando */
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
            border-radius: 16px;
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
            margin-bottom: 8px;
        }

        .skeleton-card .skeleton-line.desc {
            width: 90%;
            height: 12px;
        }

        .skeleton-card .skeleton-line.valor {
            width: 50%;
            height: 28px;
            margin: 8px 0 4px 0;
        }

        .skeleton-card .skeleton-line.label {
            width: 40%;
            height: 12px;
            margin-bottom: 12px;
        }

        .skeleton-card .skeleton-line.stats {
            width: 35%;
            height: 14px;
        }

        .skeleton-card .skeleton-footer {
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            gap: 6px;
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

        /* Quadros Grid */
        .quadros-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        /* Card do Quadro CRM - Estilo próprio */
        .quadro-card {
            background: #ffffff;
            border-radius: 32px;
            padding: 28px 28px 24px;
            transition: all 0.25s ease;
            position: relative;
            overflow: visible;
            border: 1px solid #f1f5f9;
            box-shadow: var(--shadow-soft);
            display: flex;
            flex-direction: column;
            gap: 18px;
            cursor: pointer;
        }

        .quadro-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.18);
            border-color: #e5e7eb;
        }

        .quadro-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            position: relative;
        }

        .quadro-card-header-main {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .quadro-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 18px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.06);
        }

        .quadro-card-icon svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
        }

        .quadro-card-content {
            flex: 1;
            min-width: 0;
        }

        .quadro-card-nome {
            font-size: 1.05rem;
            font-weight: 800;
            margin-bottom: 2px;
            color: #0f172a;
        }

        .quadro-card-descricao {
            font-size: 0.75rem;
            color: #9ca3af;
            line-height: 1.3;
        }

        .quadro-card-valor-label-pill {
            font-size: 0.625rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: #9ca3af;
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 8px 0 4px;
        }

        .quadro-card-valor-label-pill-dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: var(--brand-500, #6C63FF);
        }

        .quadro-card-valor {
            font-size: 2rem;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.04em;
            margin: 0 0 4px 0;
        }

        .quadro-card-valor-label {
            display: none;
        }

        .quadro-card-stats {
            margin-top: 8px;
            margin-bottom: 16px;
        }

        .quadro-card-stats-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.625rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .quadro-card-stats-badge {
            background: #e5e7eb;
            color: #111827;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 0.625rem;
            font-weight: 700;
        }

        .quadro-card-progress {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
        }

        .quadro-card-progress-bar {
            height: 100%;
            background: #4f46e5;
            border-radius: 999px;
            width: 40%;
        }

        .quadro-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        .quadro-card-footer-info {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #9ca3af;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .quadro-card-footer-info svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        .quadro-card-footer-btn {
            font-size: 0.7rem;
            font-weight: 800;
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.12);
            padding: 6px 12px;
            border-radius: 999px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .quadro-card-footer-btn svg {
            width: 12px;
            height: 12px;
        }

        .quadro-card-footer-btn:hover {
            background: #6C63FF;
            color: #ffffff;
        }

        .quadro-card-menu-btn {
            position: absolute;
            top: 0;
            right: 0;
            background: transparent;
            border: none;
            color: #888;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s;
            opacity: 0;
        }

        .quadro-card:hover .quadro-card-menu-btn {
            opacity: 1;
        }

        .quadro-card-menu-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ccc;
        }

        .quadro-card-edit-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #888;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .quadro-card:hover .quadro-card-edit-btn {
            opacity: 1;
        }

        .quadro-card-edit-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            color: #ccc;
            transform: scale(1.1);
        }

        .quadro-card-edit-btn svg {
            width: 16px;
            height: 16px;
        }

        .quadro-card-delete-btn {
            position: absolute;
            top: 12px;
            right: 50px;
            width: 32px;
            height: 32px;
            background: transparent;
            border: 1px solid rgba(255, 68, 68, 0.3);
            border-radius: 6px;
            color: #ff4444;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .quadro-card:hover .quadro-card-delete-btn {
            opacity: 1;
        }

        .quadro-card-delete-btn:hover {
            background: rgba(255, 68, 68, 0.2);
            border-color: #ff4444;
            color: #ff4444;
            transform: scale(1.1);
        }

        .quadro-card-delete-btn svg {
            width: 16px;
            height: 16px;
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

        /* Modal de Criar Quadro */
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

        .criar-quadro-modal h3 {
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

        .criar-quadro-section {
            margin-bottom: 30px;
            margin-top: 40px;
        }

        .criar-quadro-section h4 {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: left;
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
        }

        .form-group-modal input[type="text"],
        .form-group-modal textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
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
            min-height: 100px;
        }

        .form-group-modal input[type="text"]:focus,
        .form-group-modal textarea:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }

        .form-group-modal input[type="text"]::placeholder,
        .form-group-modal textarea::placeholder {
            color: #888;
        }

        .form-group-modal input[type="color"] {
            width: 100%;
            height: 60px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            cursor: pointer;
            background: none;
            padding: 4px;
            overflow: hidden;
        }

        .form-group-modal input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
            border-radius: 10px;
        }

        .form-group-modal input[type="color"]::-webkit-color-swatch {
            border: none;
            border-radius: 10px;
        }

        .modal-footer {
            display: flex;
            flex-direction: row;
            gap: 15px;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            flex-shrink: 0;
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

        .btn-modal-create {
            background: #6C63FF;
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

        .btn-modal-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }

        .btn-modal-create:disabled {
            background: #444;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* UX refinada: modal de criar quadro */
        .criar-quadro-modal-content--create {
            max-width: 560px;
            border-radius: 24px;
            padding: 28px 28px 24px;
            text-align: left;
            box-shadow: 0 28px 60px rgba(2, 6, 23, 0.45);
        }

        .modal-header-create {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 12px;
            padding-right: 42px;
        }

        .modal-kicker-create {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #16a34a;
            background: rgba(108, 99, 255, 0.14);
            border: 1px solid rgba(108, 99, 255, 0.3);
            border-radius: 999px;
            padding: 4px 10px;
        }

        .criar-quadro-modal-content--create h3 {
            margin-bottom: 0;
            font-size: 1.65rem;
            line-height: 1.15;
        }

        .criar-quadro-modal-content--create .modal-subtitle {
            margin-bottom: 0;
            font-size: 0.95rem;
            color: #64748b;
        }

        .criar-quadro-modal-content--create .criar-quadro-section {
            margin-top: 18px;
            margin-bottom: 18px;
            padding-top: 18px;
            border-top: 1px solid rgba(148, 163, 184, 0.2);
        }

        .criar-quadro-modal-content--create .form-group-modal {
            margin-bottom: 16px;
        }

        .modal-field-help {
            margin-top: 6px;
            font-size: 0.76rem;
            color: #94a3b8;
            line-height: 1.35;
        }

        .criar-quadro-modal-content--create .form-group-modal input[type="text"],
        .criar-quadro-modal-content--create .form-group-modal textarea {
            border-radius: 12px;
            padding: 12px 13px;
            font-size: 0.92rem;
        }

        .criar-quadro-modal-content--create .form-group-modal textarea {
            min-height: 92px;
        }

        .criar-quadro-modal-content--create .icon-selector {
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 10px;
            margin-top: 8px;
        }

        .criar-quadro-modal-content--create .icon-option {
            width: 100%;
            height: 54px;
            border-radius: 12px;
        }

        .criar-quadro-modal-content--create .modal-footer {
            justify-content: flex-end;
            margin-top: 12px;
            padding-top: 14px;
            border-top: 1px solid rgba(148, 163, 184, 0.2);
        }

        .criar-quadro-modal-content--create .btn-modal-cancel,
        .criar-quadro-modal-content--create .btn-modal-create {
            min-height: 42px;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 0.86rem;
            font-weight: 700;
        }

        /* Seletor de Ícones */
        .icon-selector {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-top: 10px;
        }

        .icon-option {
            width: 60px;
            height: 60px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .icon-option:hover {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.1);
            transform: scale(1.05);
        }

        .icon-option.selected {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.2);
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.3);
        }

        .icon-option svg {
            width: 28px;
            height: 28px;
            stroke: currentColor;
            color: #ccc;
        }

        .icon-option.selected svg {
            color: #6C63FF;
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

            .btn-criar-quadro {
                width: 100%;
            }

            .quadros-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .mobile-close-btn {
                display: flex;
            }

            .mobile-close-btn:hover {
                background: rgba(108, 99, 255, 0.2);
            }
.icon-selector {
                grid-template-columns: repeat(3, 1fr);
            }

            .icon-option {
                width: 50px;
                height: 50px;
            }

            .icon-option svg {
                width: 24px;
                height: 24px;
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
        body.menu-oculta-chat [data-menu-id="chat"] { display: none !important; }
        body.menu-oculta-agentes-ia [data-menu-id="agentes-ia"] { display: none !important; }
        body.menu-oculta-crm [data-menu-id="crm"] { display: none !important; }
        body.menu-oculta-conexoes [data-menu-id="conexoes"] { display: none !important; }
        body.menu-oculta-disparos [data-menu-id="disparos"] { display: none !important; }
        body.menu-oculta-contatos [data-menu-id="contatos"] { display: none !important; }
        body.menu-oculta-listas [data-menu-id="listas"] { display: none !important; }
        body.menu-oculta-ajuda [data-menu-id="ajuda"] { display: none !important; }
        body.menu-oculta-configuracoes [data-menu-id="configuracoes"] { display: none !important; }

        body.light-mode .menu-badge-admin {
            background: #6C63FF;
            color: #fff;
        }
        body.light-mode .version-text {
            color: #999;
        }

        body.light-mode .menu-badge-novidade {
            background: #6C63FF;
            color: #fff;
        }

        body.light-mode .sidebar-header {
            border-bottom: none;
        }

        body.light-mode .sidebar-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .sidebar-nav-divider {
            background: rgba(0, 0, 0, 0.12);
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

        body.light-mode .quadro-card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        body.light-mode .quadro-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.15);
        }

        /* Card de Criar Quadro */
        .quadro-card-criar {
            background: #ffffff;
            border-radius: 32px;
            padding: 32px 24px;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
            border: 2px dashed #e5e7eb;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            min-height: 200px;
        }

        .quadro-card-criar:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.12);
            border-color: #cbd5f5;
            background: #f9fafb;
        }

        .quadro-card-criar-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            border: 1px dashed #d1d5db;
            transition: all 0.3s ease;
        }

        .quadro-card-criar:hover .quadro-card-criar-icon {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.12);
            background: #ecfdf5;
            border-color: #bbf7d0;
        }

        .quadro-card-criar-icon svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            color: #9ca3af;
            transition: color 0.3s ease;
        }

        .quadro-card-criar:hover .quadro-card-criar-icon svg {
            color: #6C63FF;
        }

        .quadro-card-criar-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: #4b5563;
            transition: color 0.3s ease;
        }

        .quadro-card-criar:hover .quadro-card-criar-title {
            color: #6C63FF;
        }

        .quadro-card-criar-desc {
            font-size: 0.8rem;
            color: #9ca3af;
            line-height: 1.5;
            max-width: 200px;
        }

        /* Card criar desabilitado - limite atingido */
        .quadro-card-criar.limite-atingido {
            cursor: not-allowed;
            opacity: 0.6;
            border-color: rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.02);
        }

        .quadro-card-criar.limite-atingido:hover {
            transform: none;
            box-shadow: none;
            border-color: rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.02);
        }

        .quadro-card-criar.limite-atingido .quadro-card-criar-icon,
        .quadro-card-criar.limite-atingido:hover .quadro-card-criar-icon {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .quadro-card-criar.limite-atingido .quadro-card-criar-icon svg,
        .quadro-card-criar.limite-atingido:hover .quadro-card-criar-icon svg {
            color: rgba(255, 255, 255, 0.4);
        }

        .quadro-card-criar.limite-atingido .quadro-card-criar-title,
        .quadro-card-criar.limite-atingido:hover .quadro-card-criar-title {
            color: rgba(255, 255, 255, 0.5);
        }

        .quadro-card-criar.limite-atingido .quadro-card-criar-desc {
            color: rgba(255, 255, 255, 0.35);
        }

        body.light-mode .quadro-card-criar {
            background: rgba(255, 255, 255, 0.98);
            border: 2px dashed rgba(0, 0, 0, 0.2);
        }

        body.light-mode .quadro-card-criar:hover {
            border-color: rgba(108, 99, 255, 0.4);
            background: rgba(108, 99, 255, 0.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        body.light-mode .quadro-card-criar-icon {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.15);
        }

        body.light-mode .quadro-card-criar:hover .quadro-card-criar-icon {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.light-mode .quadro-card-criar-icon svg {
            color: rgba(0, 0, 0, 0.4);
        }

        body.light-mode .quadro-card-criar:hover .quadro-card-criar-icon svg {
            color: #6C63FF;
        }

        body.light-mode .quadro-card-criar-title {
            color: rgba(0, 0, 0, 0.6);
        }

        body.light-mode .quadro-card-criar:hover .quadro-card-criar-title {
            color: #6C63FF;
        }

        body.light-mode .quadro-card-criar-desc {
            color: rgba(0, 0, 0, 0.4);
        }

        body.light-mode .quadro-card-criar.limite-atingido {
            border-color: rgba(0, 0, 0, 0.2);
            background: rgba(0, 0, 0, 0.06);
            opacity: 0.85;
        }

        body.light-mode .quadro-card-criar.limite-atingido:hover {
            border-color: rgba(0, 0, 0, 0.2);
            background: rgba(0, 0, 0, 0.06);
        }

        body.light-mode .quadro-card-criar.limite-atingido .quadro-card-criar-icon,
        body.light-mode .quadro-card-criar.limite-atingido:hover .quadro-card-criar-icon {
            background: rgba(0, 0, 0, 0.08);
            border-color: rgba(0, 0, 0, 0.18);
        }

        body.light-mode .quadro-card-criar.limite-atingido .quadro-card-criar-icon svg,
        body.light-mode .quadro-card-criar.limite-atingido:hover .quadro-card-criar-icon svg {
            color: rgba(0, 0, 0, 0.45);
        }

        body.light-mode .quadro-card-criar.limite-atingido .quadro-card-criar-title,
        body.light-mode .quadro-card-criar.limite-atingido:hover .quadro-card-criar-title {
            color: rgba(0, 0, 0, 0.55);
        }

        body.light-mode .quadro-card-criar.limite-atingido .quadro-card-criar-desc {
            color: rgba(0, 0, 0, 0.4);
        }

        body.light-mode .quadro-card-nome {
            color: #222;
        }

        body.light-mode .quadro-card-descricao {
            color: #666;
        }

        body.light-mode .quadro-card-icon {
            background: rgba(0, 0, 0, 0.05);
        }

        body.light-mode .quadro-card-valor {
            color: #222;
        }

        body.light-mode .quadro-card-valor-label {
            color: #666;
        }

        body.light-mode .quadro-card-stats-count {
            color: #222;
        }

        body.light-mode .quadro-card-footer {
            border-top-color: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .quadro-card-footer-info {
            color: #666;
        }

        body.light-mode .empty-state {
            color: #666;
        }

        body.light-mode .empty-state h3 {
            color: #333;
        }

        body.light-mode .criar-quadro-modal-content {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .criar-quadro-modal h3,
        body.light-mode .criar-quadro-modal h4 {
            color: #222;
        }

        body.light-mode .criar-quadro-modal .modal-subtitle,
        body.light-mode .editar-quadro-modal .modal-subtitle {
            color: #555;
        }

        body.light-mode .form-group-modal label {
            color: #333;
        }

        body.light-mode .form-group-modal input[type="text"],
        body.light-mode .form-group-modal textarea {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            border-radius: 8px !important;
            color: #333 !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        body.light-mode .form-group-modal input[type="text"]:focus,
        body.light-mode .form-group-modal textarea:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
        }

        body.light-mode .form-group-modal input[type="color"] {
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            border-radius: 8px !important;
        }

        body.light-mode .form-group-modal input::placeholder,
        body.light-mode .form-group-modal textarea::placeholder {
            color: #999;
        }

        body.light-mode .modal-close-btn {
            color: #666;
        }

        body.light-mode .modal-close-btn:hover {
            background: rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .btn-modal-cancel {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        body.light-mode .btn-modal-cancel:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .icon-option {
            border: 2px solid rgba(0, 0, 0, 0.1);
        }

        body.light-mode .icon-option:hover {
            border-color: rgba(108, 99, 255, 0.3);
            background: rgba(108, 99, 255, 0.05);
        }

        body.light-mode .icon-option.selected {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.1);
        }

        body.light-mode .icon-grid {
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.1);
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
    <!-- Depois de dropdowns-global.css: ordenação CRM no dark -->
    <style>
        body.dark-mode .crm-order-select,
        body.dark-mode #crmOrderSelect {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: rgba(30, 41, 59, 0.88) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center !important;
            border: 1px solid rgba(71, 85, 105, 0.55) !important;
            border-radius: 999px !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            padding: 8px 36px 8px 16px !important;
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2) !important;
            cursor: pointer !important;
        }

        body.dark-mode .crm-order-select:hover {
            border-color: rgba(100, 116, 139, 0.7) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
        }

        body.dark-mode .crm-order-select:focus {
            outline: none !important;
            border-color: rgba(108, 99, 255, 0.55) !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
        }

        body.dark-mode .crm-order-select option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }
    </style>
</head>
<body>
    <!-- Tema antes da primeira pintura: evita flash claro (mesmo cookie que getCookie no final da página) -->
    
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
        <div class="sidebar" id="sidebar">
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
                <a href="#" class="menu-item" data-menu-id="dashboard">
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
                <a href="#" class="menu-item active" data-menu-id="crm">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">view_kanban</span>
                    </span>
                    <span class="menu-text">CRM</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="conexoes">
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
                        <input type="checkbox" id="darkModeToggle" checked>
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
                    <h1>CRM</h1>
                    <p>Gerencie os seus quadros, funis de vendas e acompanhe as receitas.</p>
                </div>
            </div>

            <!-- Métricas globais -->
                <div class="crm-metrics-grid" id="crmMetrics">
                <div class="crm-metric-card">
                    <div class="crm-metric-icon money">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                    <div>
                        <div class="crm-metric-label">Valor total em pipeline</div>
                        <div class="crm-metric-value" id="metricValorTotal">R$ 0,00</div>
                    </div>
                </div>
                <div class="crm-metric-card">
                    <div class="crm-metric-icon deals">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div>
                        <div class="crm-metric-label">Negócios ativos</div>
                        <div class="crm-metric-value" id="metricNegociosAtivos">0</div>
                    </div>
                </div>
                <div class="crm-metric-card">
                    <div class="crm-metric-icon boards">
                        <i class="fa-solid fa-table-columns"></i>
                    </div>
                    <div>
                        <div class="crm-metric-label">Quadros criados</div>
                        <div class="crm-metric-value" id="metricQuadrosCriados">0</div>
                    </div>
                </div>
            </div>

            <!-- Controles: buscar e ordenar -->
            <div class="crm-controls">
                <div class="crm-search">
                    <div class="crm-search-icon">
                        <i class="fa-solid fa-search"></i>
                    </div>
                    <input type="text" id="crmSearchInput" class="crm-search-input" placeholder="Buscar quadro...">
                </div>
                <div class="crm-order">
                    <span class="crm-order-label">Ordenar por:</span>
                    <select id="crmOrderSelect" class="crm-order-select">
                        <option value="recentes">Mais Recentes</option>
                        <option value="valor">Maior Valor</option>
                        <option value="nome">Ordem Alfabética</option>
                    </select>
                </div>
            </div>

            <!-- Loading State (skeleton cards) - visível desde o início -->
            <div class="loading-container skeleton-loading" id="loadingContainer">
                <div class="skeleton-card"><div class="skeleton-icon"></div><div class="skeleton-line title"></div><div class="skeleton-line desc"></div><div class="skeleton-line valor"></div><div class="skeleton-line label"></div><div class="skeleton-line stats"></div><div class="skeleton-footer"><div class="skeleton-line footer"></div></div></div>
                <div class="skeleton-card"><div class="skeleton-icon"></div><div class="skeleton-line title"></div><div class="skeleton-line desc"></div><div class="skeleton-line valor"></div><div class="skeleton-line label"></div><div class="skeleton-line stats"></div><div class="skeleton-footer"><div class="skeleton-line footer"></div></div></div>
                <div class="skeleton-card"><div class="skeleton-icon"></div><div class="skeleton-line title"></div><div class="skeleton-line desc"></div><div class="skeleton-line valor"></div><div class="skeleton-line label"></div><div class="skeleton-line stats"></div><div class="skeleton-footer"><div class="skeleton-line footer"></div></div></div>
            </div>

            <!-- Quadros Grid -->
            <div class="quadros-grid" id="quadrosGrid" style="display: none;"></div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <div class="empty-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="9" y1="3" x2="9" y2="21"></line>
                        <line x1="15" y1="3" x2="15" y2="21"></line>
                        <line x1="3" y1="9" x2="21" y2="9"></line>
                        <line x1="3" y1="15" x2="21" y2="15"></line>
                    </svg>
                </div>
                <h3>Nenhum quadro criado ainda</h3>
                <p>Você ainda não possui quadros do CRM.<br>Clique em "Criar Quadro" para começar.</p>
            </div>
        </div>
    </div>

    <!-- Modal de Criar Quadro -->
    <div class="criar-quadro-modal" id="criarQuadroModal">
        <div class="criar-quadro-modal-content criar-quadro-modal-content--create">
            <button class="modal-close-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="modal-header-create">
                <span class="modal-kicker-create">Novo CRM</span>
                <h3>Criar novo quadro</h3>
                <p class="modal-subtitle">Organize seu funil com nome claro, descrição objetiva e identidade visual.</p>
            </div>
            
            <div class="criar-quadro-section">
                <div class="form-group-modal">
                    <label for="nomeQuadroInput">Nome do Quadro *</label>
                    <input type="text" id="nomeQuadroInput" placeholder="Ex.: Vendas Inbound B2B" maxlength="80" required>
                    <p class="modal-field-help">Use um nome fácil de identificar para seu time.</p>
                </div>
                
                <div class="form-group-modal">
                    <label for="descricaoQuadroInput">Descrição</label>
                    <textarea id="descricaoQuadroInput" placeholder="Ex.: Pipeline de leads qualificados com etapas de proposta e fechamento." maxlength="280"></textarea>
                    <p class="modal-field-help">Opcional. Resuma o objetivo do quadro em uma frase curta.</p>
                </div>
                
                <div class="form-group-modal">
                    <label for="corQuadroInput">Cor do Quadro</label>
                    <input type="color" id="corQuadroInput" value="#6C63FF">
                </div>
                
                <div class="form-group-modal">
                    <label>Ícone do Quadro *</label>
                    <div class="icon-selector" id="iconSelector">
                        <!-- Ícones serão inseridos via JavaScript -->
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-modal-cancel">Cancelar</button>
                <button class="btn-modal-create" id="btnCriarQuadro">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17,21 17,13 7,13 7,21"></polyline>
                        <polyline points="7,3 7,8 15,8"></polyline>
                    </svg>
                    Criar quadro
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Editar Quadro -->
    <div class="criar-quadro-modal" id="editarQuadroModal">
        <div class="criar-quadro-modal-content">
            <button class="modal-close-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <h3>Editar Quadro</h3>
            <p class="modal-subtitle">Atualize os dados do quadro</p>
            
            <div class="criar-quadro-section">
                <div class="form-group-modal">
                    <label for="editarNomeQuadroInput">Nome do Quadro *</label>
                    <input type="text" id="editarNomeQuadroInput" placeholder="Digite o nome do quadro" required>
                </div>
                
                <div class="form-group-modal">
                    <label for="editarDescricaoQuadroInput">Descrição</label>
                    <textarea id="editarDescricaoQuadroInput" placeholder="Digite a descrição do quadro"></textarea>
                </div>
                
                <div class="form-group-modal">
                    <label for="editarCorQuadroInput">Cor do Quadro</label>
                    <input type="color" id="editarCorQuadroInput" value="#6C63FF">
                </div>
                
                <div class="form-group-modal">
                    <label>Ícone do Quadro *</label>
                    <div class="icon-selector" id="editarIconSelector">
                        <!-- Ícones serão inseridos via JavaScript -->
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-modal-cancel">Cancelar</button>
                <button class="btn-modal-create" id="btnSalvarQuadro">
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

    <!-- Modal Confirmar Exclusão Quadro -->
    <div class="criar-quadro-modal" id="modalExcluirQuadro">
        <div class="criar-quadro-modal-content" style="border: 2px solid #ff4444; background: rgba(255, 68, 68, 0.1);">
            <button class="modal-close-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <h3 style="color: #ff4444;">Tem certeza que deseja excluir esse quadro?</h3>
            <p style="color: #ccc; margin: 15px 0;">Ao clicar em confirmar esse quadro e todos os cards serão excluídos</p>
            <div class="modal-footer">
                <button class="btn-modal-cancel">Cancelar</button>
                <button class="btn-modal-create" id="btnConfirmarExcluirQuadro" style="background: #ff4444; border-color: #ff4444;">Confirmar</button>
            </div>
        </div>
    </div>

    
<!-- scripts removidos para manter somente HTML + CSS -->

<script src="/hublabel/public/assets/js/menu-global.js"></script>

</body>
</html>

