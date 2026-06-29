<?php
/**
 * Etapas do Quadro - HTML/CSS limpo do n8n
 * JavaScript será adicionado separadamente
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Versão limpa: HTML + CSS apenas. JavaScript removido. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapas do Quadro - IA Chatconversa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/hublabel/public/hublabel/public/assets/images/favicon">
    <link rel="shortcut icon" type="image/png" href="/hublabel/public/hublabel/public/assets/images/favicon">
    <link rel="apple-touch-icon" href="/hublabel/public/hublabel/public/assets/images/favicon">
    <!-- Font Awesome (igual crm.html) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Plus Jakarta Sans (igual crm.html) -->
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

        button, input, select, textarea {
            font-family: inherit;
        }

        :root {
            --brand-50: rgba(108, 99, 255, 0.1);
            --brand-500: #6C63FF;
            --surface: #fbfcfd;
            --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.03);
            --shadow-softer: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        body {
            background: #f8fafc;
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

        /* ====== DARK MODE - Kanban ====== */
        body.dark-mode .main-content {
            background: transparent;
        }

        body.dark-mode .board-header {
            background: #1A202C;
            border-bottom: 1px solid rgba(71, 85, 105, 0.3);
        }

        body.dark-mode .header-back-btn {
            background: rgba(51, 65, 85, 0.65);
            color: #cbd5e1;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.28);
            border: 1px solid rgba(71, 85, 105, 0.5);
        }

        body.dark-mode .header-back-btn:hover {
            background: rgba(71, 85, 105, 0.75);
            color: #f8fafc;
            border-color: rgba(100, 116, 139, 0.55);
        }

        body.dark-mode .header-back-btn i {
            color: inherit;
        }

        body.dark-mode .header-content h1,
        body.dark-mode .header h1 {
            color: #f1f5f9;
        }

        body.dark-mode .header-content p,
        body.dark-mode .header p {
            color: #64748b;
        }

        body.dark-mode .header-pipeline-value {
            color: #f1f5f9;
        }

        body.dark-mode .header-pipeline-label {
            color: #64748b;
        }

        body.dark-mode .header-search input {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
            color: #f1f5f9;
        }

        body.dark-mode .header-search input::placeholder {
            color: #64748b;
        }

        body.dark-mode .etapa-column {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .etapa-header {
            background: rgba(30, 41, 59, 0.4);
            border-bottom-color: rgba(71, 85, 105, 0.3);
        }

        body.dark-mode .etapa-nome {
            color: #f1f5f9;
        }

        body.dark-mode .etapa-count {
            background: rgba(255, 255, 255, 0.08);
            color: #94a3b8;
        }

        body.dark-mode .etapa-action-btn:hover {
            background: rgba(51, 65, 85, 0.5);
        }

        body.dark-mode .etapa-nome.editing {
            background: rgba(255, 255, 255, 0.06);
            color: #f1f5f9;
        }

        body.dark-mode .etapa-empty-state i {
            color: #475569;
        }

        body.dark-mode .etapa-empty-state span {
            color: #64748b;
        }

        /* Cards dark mode */
        body.dark-mode .card-item {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(71, 85, 105, 0.5);
            border-left: 4px solid #f59e0b;
        }

        body.dark-mode .card-item:hover {
            background: rgba(30, 41, 59, 0.95);
            border-color: rgba(108, 99, 255, 0.3);
            border-left-color: #6C63FF;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        }

        body.dark-mode .card-contato {
            color: #f1f5f9;
        }

        body.dark-mode .card-contato div[style] {
            background: rgba(51, 65, 85, 0.8) !important;
            border-color: rgba(71, 85, 105, 0.6) !important;
            color: #cbd5e1 !important;
        }

        body.dark-mode .card-valor {
            color: #5ee99a;
        }

        body.dark-mode .card-observacoes {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(71, 85, 105, 0.3);
            color: #94a3b8;
        }

        body.dark-mode .card-observacoes::before {
            color: #475569;
        }

        body.dark-mode .card-tarefas {
            border-top-color: rgba(71, 85, 105, 0.3);
        }

        body.dark-mode .card-tarefas-badge {
            background: rgba(217, 119, 6, 0.12);
            color: #fbbf24;
            border-color: rgba(217, 119, 6, 0.25);
        }

        body.dark-mode .card-data {
            color: #64748b;
        }

        body.dark-mode .card-delete-icon {
            color: #64748b;
        }

        body.dark-mode .card-delete-icon:hover {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }

        body.dark-mode .card-whatsapp-icon {
            background: rgba(108, 99, 255, 0.12);
            color: #6C63FF;
        }

        body.dark-mode .card-whatsapp-icon:hover {
            background: #6C63FF;
            color: #fff;
        }

        /* Botão adicionar card dark mode */
        body.dark-mode .btn-adicionar-card {
            border-color: rgba(71, 85, 105, 0.4);
            color: #94a3b8;
        }

        body.dark-mode .btn-adicionar-card:hover {
            background: rgba(30, 41, 59, 0.5);
            border-color: #6C63FF;
            color: #6C63FF;
        }

        /* Skeleton dark mode */
        body.dark-mode .skeleton-etapa-column {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        /* Modal dark mode */
        body.dark-mode .modal {
            background: rgba(0, 0, 0, 0.7);
        }

        body.dark-mode .modal-content {
            background: #1e293b;
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .modal-header-section {
            border-bottom-color: rgba(71, 85, 105, 0.3);
        }

        body.dark-mode .modal h3 {
            color: #f1f5f9;
        }

        body.dark-mode .modal-subtitle {
            color: #64748b;
        }

        body.dark-mode .modal-close-btn {
            background: rgba(51, 65, 85, 0.5);
            color: #94a3b8;
        }

        body.dark-mode .modal-close-btn:hover {
            background: rgba(51, 65, 85, 0.8);
            color: #f1f5f9;
        }

        body.dark-mode .modal-section-divider {
            border-top-color: rgba(71, 85, 105, 0.3);
        }

        body.dark-mode .form-group-modal label {
            color: #e2e8f0;
        }

        body.dark-mode .form-group-modal input[type="text"],
        body.dark-mode .form-group-modal input[type="number"],
        body.dark-mode .form-group-modal textarea,
        body.dark-mode .form-group-modal select {
            background: rgba(15, 23, 42, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
            color: #f1f5f9;
        }

        body.dark-mode .form-group-modal input:focus,
        body.dark-mode .form-group-modal textarea:focus,
        body.dark-mode .form-group-modal select:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.15);
            background: rgba(15, 23, 42, 0.8);
        }

        body.dark-mode .form-group-modal input::placeholder,
        body.dark-mode .form-group-modal textarea::placeholder {
            color: #475569;
        }

        body.dark-mode .form-group-modal .input-icon {
            color: #475569;
        }

        body.dark-mode .modal-body-section {
            background: transparent;
        }

        body.dark-mode .modal-footer {
            background: #1e293b;
            border-top-color: rgba(71, 85, 105, 0.3);
        }

        body.dark-mode .btn-modal-cancel {
            color: #94a3b8;
        }

        body.dark-mode .btn-modal-cancel:hover {
            background: rgba(51, 65, 85, 0.5);
            color: #f1f5f9;
        }

        body.dark-mode .btn-modal-create:disabled {
            background: rgba(51, 65, 85, 0.5);
            color: #475569;
        }

        body.dark-mode .tarefa-item {
            background: rgba(217, 119, 6, 0.08);
            border-color: rgba(217, 119, 6, 0.2);
        }

        body.dark-mode .tarefa-item input[type="text"],
        body.dark-mode .tarefa-item input[type="date"] {
            color: #f1f5f9;
        }

        body.dark-mode .btn-add-tarefa {
            background: rgba(108, 99, 255, 0.1);
            color: #5ee99a;
        }

        body.dark-mode .btn-add-tarefa:hover {
            background: rgba(108, 99, 255, 0.18);
        }

        /* Toast dark mode */
        body.dark-mode .toast-notification {
            background: rgba(30, 41, 59, 0.95);
            border-color: rgba(71, 85, 105, 0.4);
        }

        /* Empty state dark mode */
        body.dark-mode .empty-state h3 {
            color: #64748b;
        }

        body.dark-mode .empty-state p {
            color: #475569;
        }

        /* ====== DARK MODE - Sidebar (padrão #1A202C, sem override) ====== */

        body.dark-mode .sidebar-nav-divider {
            background: rgba(71, 85, 105, 0.3);
        }

        /* ====== DARK MODE - Textos mais legíveis ====== */
        body.dark-mode .btn-adicionar-card {
            color: #94a3b8;
        }

        body.dark-mode .card-data {
            color: #94a3b8;
        }

        body.dark-mode .header-pipeline-value {
            color: #f1f5f9 !important;
        }

        body.dark-mode .header-pipeline-label {
            color: #94a3b8 !important;
        }

        body.dark-mode .etapa-count {
            background: rgba(51, 65, 85, 0.8);
            color: #94a3b8;
        }

        body.dark-mode .header-breadcrumb,
        body.dark-mode .header-breadcrumb .highlight {
            color: #94a3b8;
        }

        body.dark-mode .header-search i {
            color: #64748b;
        }

        body.dark-mode .btn-nova-etapa,
        body.dark-mode .header-actions button {
            background: #6C63FF;
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - igual crm.html */
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
            border-radius: 12px;
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
            border-top: 1px solid #e5e5e5;
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

        /* Ícones do menu: mesmas escalas que chat.html em telas baixas */
        @media (max-height: 800px) {
            .menu-icon { width: 26px; }
            .menu-icon svg { width: 18px; height: 18px; }
            .menu-icon .material-symbols-rounded { font-size: 18px; }
        }
        @media (max-height: 700px) {
            .menu-icon { width: 22px; }
            .menu-icon svg { width: 16px; height: 16px; }
            .menu-icon .material-symbols-rounded { font-size: 16px; }
        }
        @media (max-height: 600px) {
            .menu-icon { width: 20px; }
            .menu-icon svg { width: 14px; height: 14px; }
            .menu-icon .material-symbols-rounded { font-size: 14px; }
        }

        /* Dark Mode Toggle Switch - igual crm.html */
        .theme-toggle-item { cursor: default; }
        .theme-toggle-item:hover { background: transparent !important; color: inherit !important; }
        .theme-switch {
            display: none;
            position: relative;
            width: 44px;
            height: 24px;
            margin-left: auto;
        }
        .sidebar:hover .theme-switch,
        .sidebar.sidebar-expanded .theme-switch,
        .sidebar.mobile-open .theme-switch { display: inline-block; }
        .theme-switch input { opacity: 0; width: 0; height: 0; }
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
        .theme-switch input:checked + .slider { background-color: #22c55e; }
        .theme-switch input:checked + .slider:before { transform: translateX(20px); }

        /* Main content */
        .main-content {
            flex: 1;
            padding: 20px 30px 30px;
            overflow-x: auto;
            margin-left: 72px;
        }

        /* Barra de cabeçalho do board (igual gemini) */
        .board-header {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
            padding: 10px 32px;
            margin: -18px -30px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .header {
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            width: 100%;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-back-btn {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            border: none;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #9ca3af;
            box-shadow: 0 4px 12px rgba(148, 163, 184, 0.18);
            transition: all 0.2s ease;
        }

        .header-back-btn:hover {
            background: #e5e7eb;
            color: #111827;
            transform: translateY(-1px);
        }

        .header-content h1 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            margin-bottom: 4px;
        }

        .header-content p {
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .header-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: #9ca3af;
        }

        .header-breadcrumb span.highlight {
            color: var(--brand-500);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-pipeline {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-right: 16px;
        }

        .header-pipeline-label {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: #9ca3af;
        }

        .header-pipeline-value {
            font-size: 1.125rem;
            font-weight: 900;
            color: #0f172a;
        }

        .header-search {
            display: none;
        }

        @media (min-width: 1024px) {
            .header-search {
                display: block;
                position: relative;
            }
        }

        .header-search input {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 10px 12px 10px 40px;
            font-size: 0.875rem;
            font-weight: 700;
            color: #111827;
            outline: none;
            width: 260px;
        }

        .header-search input::placeholder {
            color: #9ca3af;
            font-weight: 600;
        }

        .header-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.8rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-criar-etapa {
            padding: 10px 20px;
            background: #6C63FF;
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            white-space: nowrap;
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.3);
        }

        .btn-criar-etapa:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(108, 99, 255, 0.45);
        }

        /* Kanban Board */
        .kanban-board {
            display: flex;
            gap: 24px;
            overflow-x: auto;
            padding: 24px 24px 24px 0;
            min-height: calc(100vh - 200px);
        }

        .kanban-board::-webkit-scrollbar {
            display: none;
        }
        .kanban-board {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Etapa (Column) - Design Gemini */
        .etapa-column {
            min-width: 320px;
            max-width: 320px;
            background: rgba(241, 245, 249, 0.5);
            border-radius: 24px;
            padding: 0;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .etapa-column.dragging {
            opacity: 0.5;
            transform: rotate(2deg);
        }

        .etapa-column.drag-over {
            border-color: #6C63FF;
            box-shadow: 0 0 20px rgba(108, 99, 255, 0.3);
        }

        .etapa-column.creating {
            opacity: 0.7;
            pointer-events: none;
        }

        .etapa-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 0;
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
            background: rgba(255, 255, 255, 0.5);
            border-radius: 24px 24px 0 0;
            gap: 10px;
        }

        .etapa-loading {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6C63FF;
            font-size: 0.9rem;
        }

        .etapa-loading-spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(108, 99, 255, 0.2);
            border-top: 2px solid #6C63FF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .etapa-nome {
            font-size: 1rem;
            font-weight: 800;
            color: #0f172a;
            flex: 1;
            cursor: pointer;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .etapa-actions {
            display: none;
            gap: 8px;
            align-items: center;
            margin-left: 0;
            transition: opacity 0.2s;
        }

        .etapa-header:hover .etapa-actions {
            display: flex;
        }

        .etapa-header:hover .etapa-count {
            display: none;
        }

        .etapa-action-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .etapa-action-btn:hover {
            background: #f1f5f9;
        }

        .etapa-action-btn.edit svg {
            width: 16px;
            height: 16px;
            stroke: #6C63FF;
        }

        .etapa-action-btn.delete svg {
            width: 16px;
            height: 16px;
            stroke: #ff4444;
        }

        .etapa-action-btn.tag svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: #64748b;
            stroke: currentColor;
            fill: none;
        }

        .etapa-action-btn.tag:hover svg {
            color: #475569;
        }

        body.dark-mode .etapa-action-btn.tag svg {
            color: #94a3b8;
        }

        body.dark-mode .etapa-action-btn.tag:hover svg {
            color: #cbd5e1;
        }

        .crm-etapas-etiqueta-modal-desc {
            margin: 0;
            margin-top: 8px;
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.45;
            font-weight: 500;
            text-transform: none;
            letter-spacing: normal;
        }

        body.dark-mode .crm-etapas-etiqueta-modal-desc {
            color: #94a3b8;
        }

        #crmEtapasEtiquetaEtapaBtn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-width: 200px;
        }

        #crmEtapasEtiquetaEtapaBtn .crm-etapas-etiqueta-btn-spinner {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            flex-shrink: 0;
        }

        .etapa-nome.editing {
            background: #ffffff;
            border: 1px solid #6C63FF;
            border-radius: 8px;
            padding: 8px 12px;
            outline: none;
            color: #0f172a;
            font-size: 1rem;
            font-weight: 800;
            cursor: text;
        }

        .etapa-nome[contenteditable="true"] {
            outline: none;
        }


        .etapa-count {
            background: #e2e8f0;
            color: #475569;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 0.65rem;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
            margin-left: 0;
            margin-right: 0;
        }

        .etapa-cards {
            flex: 1;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 12px;
            overflow-y: auto;
        }

        .etapa-cards.drag-over {
            background: rgba(108, 99, 255, 0.1);
            border-radius: 8px;
            min-height: 150px;
        }

        .btn-adicionar-card {
            margin: 4px 12px 12px;
            padding: 10px;
            background: transparent;
            border: 1.5px dashed #d1d5db;
            border-radius: 16px;
            color: #9ca3af;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-adicionar-card:hover {
            background: #ffffff;
            border-color: #6C63FF;
            color: #6C63FF;
        }

        /* Card - Design Gemini */
        .card-item {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #f59e0b;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            position: relative;
        }

        .card-whatsapp-icon {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 28px;
            height: 28px;
            cursor: pointer;
            z-index: 10;
            opacity: 0;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: rgba(108, 99, 255, 0.1);
            color: #6C63FF;
        }

        .card-item:hover .card-whatsapp-icon {
            opacity: 1;
        }

        .card-whatsapp-icon:hover {
            opacity: 1;
            transform: scale(1.05);
            background: #6C63FF;
            color: #fff;
        }
        
        .card-whatsapp-icon:hover svg {
            fill: #ffffff;
        }

        body.light-mode .card-whatsapp-icon {
            opacity: 0;
        }

        body.light-mode .card-item:hover .card-whatsapp-icon {
            opacity: 1;
        }

        .card-delete-icon {
            position: absolute;
            top: 12px;
            right: 44px;
            width: 24px;
            height: 24px;
            cursor: pointer;
            z-index: 10;
            opacity: 0;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            border-radius: 8px;
        }

        .card-item:hover .card-delete-icon {
            opacity: 1;
        }

        .card-delete-icon:hover {
            opacity: 1;
            color: #ef4444;
            background: #fef2f2;
        }

        body.light-mode .card-delete-icon {
            opacity: 0;
        }

        body.light-mode .card-item:hover .card-delete-icon {
            opacity: 1;
        }

        .card-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            border-color: #a7f3d0;
            border-left-color: #6C63FF;
        }

        .card-item.dragging {
            opacity: 0.5;
            transform: rotate(2deg);
        }

        .card-contato {
            font-size: 0.875rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-valor {
            font-size: 1.125rem;
            color: #6C63FF;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .card-observacoes {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
            font-style: italic;
            margin-bottom: 8px;
            padding: 8px 10px 8px 16px;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            position: relative;
        }

        .card-observacoes::before {
            content: '\201C';
            position: absolute;
            top: 4px;
            left: 6px;
            font-size: 0.75rem;
            color: #cbd5e1;
            font-style: normal;
        }

        .card-tarefas {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
        }

        .card-tarefas-badge {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.625rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .card-data {
            font-size: 0.625rem;
            color: #94a3b8;
            font-weight: 500;
            margin-top: 0;
        }

        /* Empty state dentro da coluna */
        .etapa-empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            gap: 8px;
            opacity: 0.5;
        }

        .etapa-empty-state i {
            font-size: 1.8rem;
            color: #cbd5e1;
        }

        .etapa-empty-state span {
            font-size: 0.75rem;
            font-weight: 700;
            color: #94a3b8;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #888;
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

        /* Loading */
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

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            color: #888;
            font-size: 1rem;
        }

        /* Skeleton loading - 3 colunas de etapas com animação piscando */
        .loading-container.skeleton-loading {
            display: flex !important;
            flex-direction: row;
            gap: 20px;
            padding: 0;
            min-height: auto;
            align-items: stretch;
            justify-content: flex-start;
            overflow-x: auto;
        }

        .skeleton-etapa-column {
            min-width: 320px;
            max-width: 320px;
            background: rgba(241, 245, 249, 0.5);
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 24px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .skeleton-etapa-column .skeleton-header {
            height: 24px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }

        .skeleton-etapa-column .skeleton-card {
            height: 80px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.06);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }

        @keyframes skeleton-pulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }

        .skeleton-etapa-column:nth-child(1) .skeleton-header,
        .skeleton-etapa-column:nth-child(1) .skeleton-card { animation-delay: 0s; }
        .skeleton-etapa-column:nth-child(2) .skeleton-header,
        .skeleton-etapa-column:nth-child(2) .skeleton-card { animation-delay: 0.15s; }
        .skeleton-etapa-column:nth-child(3) .skeleton-header,
        .skeleton-etapa-column:nth-child(3) .skeleton-card { animation-delay: 0.3s; }

        body.light-mode .skeleton-etapa-column {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .skeleton-etapa-column .skeleton-header,
        body.light-mode .skeleton-etapa-column .skeleton-card {
            background: rgba(0, 0, 0, 0.08);
        }

        /* Modals */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 0;
            max-width: 560px;
            width: 92%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .modal-content::-webkit-scrollbar { width: 6px; }
        .modal-content::-webkit-scrollbar-track { background: transparent; }
        .modal-content::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .modal-header-section {
            padding: 32px 32px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .modal-body-section {
            padding: 24px 32px;
        }

        .modal-section-title {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-section-title.green { color: #6C63FF; }
        .modal-section-title.blue { color: #3b82f6; }
        .modal-section-title.orange { color: #f59e0b; }

        .modal-section-divider {
            border: none;
            border-top: 1px solid #f1f5f9;
            margin: 0;
        }

        .modal-close-btn {
            position: absolute;
            top: 28px;
            right: 28px;
            background: #f8fafc;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 0;
            border-radius: 50%;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .modal-close-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .modal h3 {
            color: #0f172a;
            margin-bottom: 4px;
            font-size: 1.6rem;
            font-weight: 800;
        }

        .modal h3 + p, .modal-subtitle {
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .form-group-modal {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group-modal label {
            display: block;
            color: #0f172a;
            font-size: 0.875rem;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .form-group-modal label .required {
            color: #ef4444;
            margin-left: 2px;
        }

        .form-group-modal .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-group-modal .input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 0.9rem;
            pointer-events: none;
        }

        .form-group-modal input[type="text"],
        .form-group-modal input[type="number"],
        .form-group-modal textarea,
        .form-group-modal select {
            width: 100%;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
            color: #0f172a;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .form-group-modal .has-icon {
            padding-left: 42px !important;
        }

        .form-group-modal textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group-modal select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        .form-group-modal input[type="text"]:focus,
        .form-group-modal input[type="number"]:focus,
        .form-group-modal textarea:focus,
        .form-group-modal select:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
            background: #ffffff;
        }

        .form-group-modal input[type="text"]::placeholder,
        .form-group-modal input[type="number"]::placeholder,
        .form-group-modal textarea::placeholder {
            color: #94a3b8;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .contact-search {
            position: relative;
        }

        .contact-search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-top: 5px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }

        .contact-search-results.show {
            display: block;
        }

        .contact-result-item {
            padding: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .contact-result-item:hover {
            background: rgba(108, 99, 255, 0.1);
        }

        .contact-result-item:last-child {
            border-bottom: none;
        }

        .contact-result-name {
            font-weight: 600;
            color: white;
            margin-bottom: 4px;
        }

        .contact-result-phone {
            font-size: 0.85rem;
            color: #888;
        }

        .tarefas-section {
            margin-top: 20px;
        }

        .tarefa-item {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
            padding: 12px 14px;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 12px;
        }

        .tarefa-item input[type="text"],
        .tarefa-item input[type="date"] {
            flex: 1;
            background: transparent;
            border: none;
            border-radius: 6px;
            padding: 4px 0;
            color: #0f172a;
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
        }
        
        .tarefa-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            accent-color: #22c55e;
            cursor: pointer;
        }

        .btn-remove-tarefa {
            background: none;
            border: none;
            color: #d97706;
            padding: 4px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            width: 24px;
            height: 24px;
            font-size: 0.85rem;
        }

        .btn-remove-tarefa:hover {
            color: #ef4444;
        }

        .btn-remove-tarefa svg {
            width: 14px;
            height: 14px;
        }

        .btn-add-tarefa {
            background: rgba(108, 99, 255, 0.08);
            border: none;
            color: #6C63FF;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 700;
            margin-top: 12px;
            font-family: inherit;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-add-tarefa:hover {
            background: rgba(108, 99, 255, 0.15);
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding: 20px 32px 28px;
            border-top: 1px solid #f1f5f9;
            background: #ffffff;
            border-radius: 0 0 24px 24px;
            position: sticky;
            bottom: 0;
        }

        .btn-modal-cancel {
            background: transparent;
            border: none;
            color: #64748b;
            padding: 12px 24px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 700;
            font-family: inherit;
            font-size: 0.9rem;
        }

        .btn-modal-cancel:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .btn-modal-create {
            background: #6C63FF;
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 700;
            font-family: inherit;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-modal-create:hover {
            background: #6C63FF;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.3);
        }

        .btn-modal-create:disabled {
            background: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Toast */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10001;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-notification {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 15px 20px;
            color: white;
            backdrop-filter: blur(10px);
            min-width: 300px;
            max-width: 400px;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .toast-notification.show {
            transform: translateX(0);
        }

        .toast-notification.success {
            background: rgba(34, 197, 94, 0.1);
            border-color: rgba(34, 197, 94, 0.3);
            color: #22c55e;
        }

        .toast-notification.error {
            border-color: #ff6b6b;
            background: rgba(255, 107, 107, 0.2);
        }

        .toast-notification.info {
            border-color: #0076FE;
            background: rgba(0, 118, 254, 0.2);
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

        /* Mobile */
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

            .sidebar.mobile-open .sidebar-logo {
                opacity: 1 !important;
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

            .main-content {
                padding: 20px;
                margin-left: 0;
            }

            .kanban-board {
                flex-direction: row;
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 16px;
            }

            .etapa-column {
                min-width: 300px;
                max-width: 300px;
                flex: 0 0 300px;
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

        body.light-mode .header h1,
        body.light-mode .header-content h1 {
            color: #222;
        }

        body.light-mode .header p,
        body.light-mode .header-content p {
            color: #666;
        }

        body.light-mode .etapa-column {
            background: rgba(241, 245, 249, 0.5);
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        body.light-mode .card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .card:hover {
            border-color: rgba(108, 99, 255, 0.3);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.15);
        }

        body.light-mode .card-title {
            color: #222;
        }

        body.light-mode .card-description {
            color: #666;
        }

        body.light-mode .modal-content {
            background: #ffffff;
            border-color: #e2e8f0;
        }

        body.light-mode .modal-title {
            color: #6C63FF;
        }

        body.light-mode .modal h3 {
            color: #222;
        }

        body.light-mode .form-group label {
            color: #333;
        }

        body.light-mode .form-group input,
        body.light-mode .form-group textarea,
        body.light-mode .form-group select {
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

        body.light-mode .form-group input::placeholder,
        body.light-mode .form-group textarea::placeholder {
            color: #999;
        }

        body.light-mode .form-group input:focus,
        body.light-mode .form-group textarea:focus,
        body.light-mode .form-group select:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
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

        body.light-mode .btn-secondary {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        body.light-mode .btn-secondary:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        /* Etapa Column - Light Mode */
        body.light-mode .etapa-column {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
        }

        body.light-mode .etapa-column.drag-over {
            box-shadow: 0 0 20px rgba(108, 99, 255, 0.2) !important;
        }

        body.light-mode .etapa-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .etapa-nome {
            color: #222 !important;
        }

        body.light-mode .etapa-nome.editing {
            background: rgba(255, 255, 255, 0.9) !important;
            border: 1px solid #6C63FF !important;
            color: #222 !important;
        }

        body.light-mode .etapa-count {
            background: rgba(108, 99, 255, 0.15) !important;
            color: #6C63FF !important;
        }

        body.light-mode .etapa-action-btn {
            background: transparent !important;
        }

        body.light-mode .etapa-action-btn:hover {
            background: rgba(0, 0, 0, 0.05) !important;
        }

        body.light-mode .etapa-loading {
            color: #6C63FF !important;
        }

        /* Card Item - Light Mode */
        body.light-mode .card-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #f59e0b;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        body.light-mode .card-item:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            border-color: #a7f3d0;
            border-left-color: #6C63FF;
        }

        body.light-mode .card-contato {
            color: #0f172a;
        }

        body.light-mode .card-valor {
            color: #6C63FF;
        }

        body.light-mode .card-observacoes {
            color: #64748b;
        }

        body.light-mode .card-data {
            color: #94a3b8;
        }

        body.light-mode .card-tarefas {
            border-top: 1px solid #f1f5f9;
        }

        body.light-mode .card-tarefas-badge {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        /* Button Adicionar Card - Light Mode */
        body.light-mode .btn-adicionar-card {
            background: transparent;
            border: 1.5px dashed #d1d5db;
            color: #9ca3af;
        }

        body.light-mode .btn-adicionar-card:hover {
            background: #ffffff;
            border-color: #6C63FF;
            color: #6C63FF;
        }

        /* Empty State - Light Mode */
        body.light-mode .empty-state {
            color: #999 !important;
        }

        body.light-mode .empty-state h3 {
            color: #666 !important;
        }

        body.light-mode .empty-state p {
            color: #999 !important;
        }

        /* Loading - Light Mode */
        body.light-mode .loading-text {
            color: #999 !important;
        }

        /* Modal - Light Mode */
        /* Light mode modal - já é branco por padrão, apenas ajustar overlay */
        body.light-mode .modal {
            background: rgba(15, 23, 42, 0.5);
        }

        /* Contact Search Results - Light Mode */
        body.light-mode .contact-search-results {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .contact-result-item {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        body.light-mode .contact-result-item:hover {
            background: rgba(108, 99, 255, 0.08) !important;
        }

        body.light-mode .contact-result-name {
            color: #222 !important;
        }

        body.light-mode .contact-result-phone {
            color: #999 !important;
        }

        /* Tarefas Section - Light Mode */
        body.light-mode .tarefa-item {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .tarefa-item input[type="text"],
        body.light-mode .tarefa-item input[type="date"] {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.15) !important;
            color: #333 !important;
        }

        body.light-mode .tarefa-item input[type="text"]:focus,
        body.light-mode .tarefa-item input[type="date"]:focus {
            border-color: #6C63FF !important;
        }

        body.light-mode .btn-remove-tarefa {
            color: #ff6b6b !important;
        }

        body.light-mode .btn-remove-tarefa:hover {
            background: rgba(255, 107, 107, 0.15) !important;
        }

        body.light-mode .btn-add-tarefa {
            background: rgba(108, 99, 255, 0.1) !important;
            border: 1px solid rgba(108, 99, 255, 0.3) !important;
            color: #6C63FF !important;
        }

        body.light-mode .btn-add-tarefa:hover {
            background: rgba(108, 99, 255, 0.15) !important;
        }

        /* Modal Buttons - Light Mode */
        body.light-mode .btn-modal-cancel {
            background: rgba(0, 0, 0, 0.05) !important;
            border: 1px solid rgba(0, 0, 0, 0.15) !important;
            color: #333 !important;
        }

        body.light-mode .btn-modal-cancel:hover {
            background: rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .btn-modal-create:disabled {
            background: #ccc !important;
            cursor: not-allowed !important;
        }

        /* Scrollbar - Light Mode */
        body.light-mode .kanban-board::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05) !important;
        }

        body.light-mode .kanban-board::-webkit-scrollbar-thumb {
            background: rgba(108, 99, 255, 0.2) !important;
        }

        body.light-mode .kanban-board::-webkit-scrollbar-thumb:hover {
            background: rgba(108, 99, 255, 0.3) !important;
        }

        /* Sidebar Header - Light Mode (sem linha) */
        body.light-mode .sidebar-header {
            border-bottom: none !important;
        }

        /* Divider entre Contatos e Ajuda no Light Mode */
        body.light-mode .sidebar-nav-divider {
            background: rgba(0, 0, 0, 0.12);
        }

        /* Main Content - Light Mode */
        body.light-mode .main-content {
            color: #333 !important;
        }

        /* Etapa Cards Container - Light Mode */
        body.light-mode .etapa-cards.drag-over {
            background: rgba(108, 99, 255, 0.08) !important;
        }

        /* Modal Detalhes Card - Light Mode */
        body.light-mode #modalDetalhesCard .modal-content {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            color: #333 !important;
        }

        /* Estilos para elementos dinâmicos do modal de detalhes - Light Mode */
        body.light-mode #cardDetalhesContent .form-group-modal {
            margin-bottom: 20px;
        }

        body.light-mode #cardDetalhesContent .form-group-modal label {
            color: #333 !important;
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Inputs e textarea no modal de detalhes - Light Mode */
        body.light-mode #cardDetalhesContent input[type="text"],
        body.light-mode #cardDetalhesContent textarea {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            color: #333 !important;
        }

        body.light-mode #cardDetalhesContent input[type="text"]:focus,
        body.light-mode #cardDetalhesContent textarea:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
        }

        body.light-mode #cardDetalhesContent input[type="text"]::placeholder,
        body.light-mode #cardDetalhesContent textarea::placeholder {
            color: #999 !important;
        }

        /* Inputs e textarea no modal de detalhes - Dark Mode */
        #cardDetalhesContent input[type="text"]:focus,
        #cardDetalhesContent textarea:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
        }

        /* Divs de conteúdo no modal de detalhes - sobrescrevendo estilos inline */
        body.light-mode #cardDetalhesContent div[style*="background: rgba(255,255,255,0.05)"],
        body.light-mode #cardDetalhesContent div[style*="background:rgba(255,255,255,0.05)"] {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            color: #222 !important;
        }

        /* Sobrescrever cores de texto inline */
        body.light-mode #cardDetalhesContent div[style*="color: white"],
        body.light-mode #cardDetalhesContent div[style*="color:white"],
        body.light-mode #cardDetalhesContent span[style*="color: white"],
        body.light-mode #cardDetalhesContent span[style*="color:white"] {
            color: #222 !important;
        }

        body.light-mode #cardDetalhesContent div[style*="color: #6C63FF"],
        body.light-mode #cardDetalhesContent div[style*="color:#6C63FF"] {
            color: #6C63FF !important;
        }

        body.light-mode #cardDetalhesContent div[style*="color: #aaa"],
        body.light-mode #cardDetalhesContent div[style*="color:#aaa"],
        body.light-mode #cardDetalhesContent div[style*="color: #888"],
        body.light-mode #cardDetalhesContent div[style*="color:#888"] {
            color: #666 !important;
        }

        /* Tarefas no modal de detalhes - Light Mode */
        body.light-mode #cardDetalhesContent div[style*="padding: 12px"][style*="background: rgba(255,255,255,0.05)"] {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            color: #333 !important;
        }

        body.light-mode #cardDetalhesContent span[style*="color: white"][style*="text-decoration"] {
            color: #666 !important;
        }

        body.light-mode #cardDetalhesContent span[style*="opacity: 0.6"] {
            color: #999 !important;
        }

        /* Checkbox customizado nas tarefas - Light Mode */
        body.light-mode #cardDetalhesContent input[type="checkbox"][style*="border: 2px solid"] {
            border-color: #ccc !important;
        }

        body.light-mode #cardDetalhesContent input[type="checkbox"]:checked[style*="background"] {
            border-color: #6C63FF !important;
            background: #6C63FF !important;
        }

        /* Botão de data nas tarefas - Light Mode */
        body.light-mode #cardDetalhesContent button[style*="color: #888"] {
            color: #666 !important;
        }

        body.light-mode #cardDetalhesContent button[onmouseover*="#6C63FF"]:hover {
            color: #6C63FF !important;
        }

        /* Input de data nas tarefas - Light Mode */
        body.light-mode #cardDetalhesContent input[type="date"] {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.15) !important;
            border-radius: 6px !important;
            color: #333 !important;
        }

        body.light-mode #cardDetalhesContent input[type="date"]:focus {
            border-color: #6C63FF !important;
            outline: none !important;
        }

        /* Span de data nas tarefas - Light Mode */
        body.light-mode #cardDetalhesContent span[style*="color: #888"][style*="font-size: 0.85rem"] {
            color: #666 !important;
        }

        /* Disparos no modal de detalhes - Light Mode */
        body.light-mode #cardDetalhesContent div[style*="padding: 10px"][style*="background: rgba(255,255,255,0.05)"] {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode #cardDetalhesContent div[style*="color: white"][style*="font-size"] {
            color: #222 !important;
        }

        body.light-mode #cardDetalhesContent div[style*="color: #888"][style*="font-size: 0.85rem"] {
            color: #666 !important;
        }

        /* Data de criação - Light Mode */
        body.light-mode #cardDetalhesContent div[style*="color: #888"][style*="padding: 10px"] {
            color: #666 !important;
        }

        /* Texto com pre-wrap (observações) - Light Mode */
        body.light-mode #cardDetalhesContent div[style*="white-space: pre-wrap"] {
            color: #333 !important;
        }

        /* Modal detalhes do card — UX alinhada ao restante do CRM */
        #modalDetalhesCard .modal-content.modal-detalhes-shell {
            padding: 0;
            max-width: 520px;
        }

        #modalDetalhesCard .modal-detalhes-header {
            padding: 28px 56px 20px 32px;
            border-bottom: 1px solid #f1f5f9;
        }

        body.dark-mode #modalDetalhesCard .modal-detalhes-header {
            border-bottom-color: rgba(71, 85, 105, 0.35);
        }

        #modalDetalhesCard .modal-detalhes-body {
            padding: 24px 32px 12px;
        }

        #modalDetalhesCard .modal-detalhes-body > .modal-section-title:first-child {
            margin-top: 0;
        }

        #modalDetalhesCard .modal-footer {
            margin-top: 0;
        }

        #modalDetalhesCard .detalhes-contato-hint {
            font-size: 0.75rem;
            color: #64748b;
            margin: 0 0 10px;
            line-height: 1.45;
        }

        body.dark-mode #modalDetalhesCard .detalhes-contato-hint {
            color: #94a3b8;
        }

        .detalhes-contato-resumo {
            margin-top: 14px;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        body.dark-mode .detalhes-contato-resumo {
            border-color: rgba(71, 85, 105, 0.45);
            background: rgba(15, 23, 42, 0.4);
        }

        .detalhes-contato-resumo--legacy {
            border-color: rgba(245, 158, 11, 0.35);
            background: rgba(254, 243, 199, 0.35);
        }

        body.dark-mode .detalhes-contato-resumo--legacy {
            border-color: rgba(251, 191, 36, 0.35);
            background: rgba(120, 53, 15, 0.2);
        }

        .detalhes-contato-resumo-titulo {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #64748b;
            margin: 0 0 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        body.dark-mode .detalhes-contato-resumo-titulo {
            color: #94a3b8;
        }

        .detalhes-contato-resumo-dl {
            margin: 0;
            display: grid;
            gap: 10px;
        }

        .detalhes-contato-resumo-dl > div {
            display: grid;
            grid-template-columns: 88px 1fr;
            gap: 10px;
            align-items: baseline;
        }

        @media (max-width: 420px) {
            .detalhes-contato-resumo-dl > div {
                grid-template-columns: 1fr;
            }
        }

        .detalhes-contato-resumo-dl dt {
            margin: 0;
            font-weight: 700;
            color: #64748b;
            font-size: 0.75rem;
        }

        body.dark-mode .detalhes-contato-resumo-dl dt {
            color: #94a3b8;
        }

        .detalhes-contato-resumo-dl dd {
            margin: 0;
            color: #0f172a;
            font-size: 0.875rem;
            word-break: break-word;
        }

        body.dark-mode .detalhes-contato-resumo-dl dd {
            color: #f1f5f9;
        }

        .detalhes-contato-resumo-placeholder {
            margin: 0;
            font-size: 0.85rem;
            color: #64748b;
            line-height: 1.5;
        }

        body.dark-mode .detalhes-contato-resumo-placeholder {
            color: #94a3b8;
        }

        .detalhes-contato-resumo-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .detalhes-contato-resumo-header .detalhes-contato-resumo-titulo {
            margin: 0;
            flex: 1;
        }

        .detalhes-contato-edit-btn {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s ease, color 0.15s ease, border-color 0.15s ease;
        }

        .detalhes-contato-edit-btn:hover {
            background: rgba(108, 99, 255, 0.12);
            border-color: rgba(108, 99, 255, 0.45);
            color: #6C63FF;
        }

        body.dark-mode .detalhes-contato-edit-btn {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.5);
            color: #94a3b8;
        }

        body.dark-mode .detalhes-contato-edit-btn:hover {
            background: rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.4);
            color: #6C63FF;
        }

        .contatos-lista-scroll {
            max-height: 260px;
            overflow-y: auto;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            margin-top: 4px;
        }

        body.dark-mode .contatos-lista-scroll {
            border-color: rgba(71, 85, 105, 0.45);
            background: rgba(15, 23, 42, 0.45);
        }

        .contatos-lista-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .contatos-lista-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }

        body.dark-mode .contatos-lista-scroll::-webkit-scrollbar-thumb {
            background: rgba(71, 85, 105, 0.55);
        }

        .contato-item-row {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            width: 100%;
            text-align: left;
            padding: 12px 14px;
            border: none;
            border-bottom: 1px solid #e2e8f0;
            background: transparent;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
            -webkit-tap-highlight-color: rgba(108, 99, 255, 0.2);
        }

        body.dark-mode .contato-item-row {
            border-bottom-color: rgba(71, 85, 105, 0.35);
        }

        .contato-item-row:last-child {
            border-bottom: none;
        }

        .contato-item-row:hover {
            background: rgba(108, 99, 255, 0.08);
        }

        body.dark-mode .contato-item-row:hover {
            background: rgba(108, 99, 255, 0.1);
        }

        .contato-item-row:focus {
            outline: none;
        }

        .contato-item-row:focus-visible {
            outline: 2px solid #6C63FF;
            outline-offset: -2px;
            z-index: 1;
            position: relative;
        }

        .contato-item-row.selected {
            background: rgba(108, 99, 255, 0.2);
            box-shadow: inset 4px 0 0 0 #6C63FF;
            border: 1px solid rgba(108, 99, 255, 0.45);
            border-bottom: 1px solid rgba(108, 99, 255, 0.35);
            margin: 0 -1px;
            padding-left: 13px;
        }

        body.dark-mode .contato-item-row.selected {
            background: rgba(108, 99, 255, 0.18);
            border-color: rgba(108, 99, 255, 0.5);
        }

        body.light-mode .contato-item-row.selected {
            background: rgba(220, 252, 231, 0.95);
            border-color: #6C63FF;
        }

        .contato-item-row-text {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
            min-width: 0;
            flex: 1;
        }

        .contato-item-row .contato-item-check {
            flex-shrink: 0;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            background: #6C63FF;
            color: #fff;
            font-size: 12px;
        }

        .contato-item-row.selected .contato-item-check {
            display: flex;
        }

        .contato-item-row .contato-item-nome {
            font-size: 0.9rem;
            font-weight: 700;
            color: #0f172a;
        }

        body.dark-mode .contato-item-row .contato-item-nome {
            color: #f1f5f9;
        }

        .contato-item-row .contato-item-tel {
            font-size: 0.8rem;
            color: #64748b;
            font-variant-numeric: tabular-nums;
        }

        body.dark-mode .contato-item-row .contato-item-tel {
            color: #94a3b8;
        }

        .contato-item-row.contato-item--legacy .contato-item-nome {
            color: #d97706;
        }

        body.dark-mode .contato-item-row.contato-item--legacy .contato-item-nome {
            color: #fbbf24;
        }

        .contatos-lista-empty,
        .contatos-lista-loading {
            padding: 22px 16px;
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
            line-height: 1.5;
        }

        body.dark-mode .contatos-lista-empty,
        body.dark-mode .contatos-lista-loading {
            color: #94a3b8;
        }

        #cardDetalhesContent .detalhes-tarefa-row {
            padding: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        body.dark-mode #cardDetalhesContent .detalhes-tarefa-row {
            background: rgba(15, 23, 42, 0.45);
            border-color: rgba(71, 85, 105, 0.4);
        }

        #cardDetalhesContent .detalhes-info-box {
            color: #64748b;
            padding: 10px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.9rem;
        }

        body.dark-mode #cardDetalhesContent .detalhes-info-box {
            color: #94a3b8;
            background: rgba(15, 23, 42, 0.45);
            border-color: rgba(71, 85, 105, 0.4);
        }

        #cardDetalhesContent .detalhes-disparo-card {
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        body.dark-mode #cardDetalhesContent .detalhes-disparo-card {
            background: rgba(15, 23, 42, 0.45);
            border-color: rgba(71, 85, 105, 0.4);
        }

        #cardDetalhesContent .detalhes-disparo-card .detalhes-disparo-titulo {
            color: #0f172a;
            font-weight: 600;
        }

        body.dark-mode #cardDetalhesContent .detalhes-disparo-card .detalhes-disparo-titulo {
            color: #f1f5f9;
        }

        body.dark-mode #cardDetalhesContent #detalhesCardValorInput {
            color: #6C63FF !important;
        }

        #cardDetalhesContent .detalhes-tarefa-row .tarefa-descricao-text {
            color: #0f172a;
        }

        body.dark-mode #cardDetalhesContent .detalhes-tarefa-row .tarefa-descricao-text {
            color: #f1f5f9;
        }

        body.dark-mode #cardDetalhesContent #camposNovaTarefa {
            background: rgba(15, 23, 42, 0.55) !important;
            border-color: rgba(71, 85, 105, 0.45) !important;
        }

        body.dark-mode #cardDetalhesContent .detalhes-tarefa-row input[type="date"],
        body.dark-mode #cardDetalhesContent #camposNovaTarefa input[type="text"],
        body.dark-mode #cardDetalhesContent #camposNovaTarefa input[type="date"] {
            background: rgba(15, 23, 42, 0.5) !important;
            border: 1px solid rgba(71, 85, 105, 0.4) !important;
            border-radius: 8px !important;
            padding: 8px 10px !important;
            color: #f1f5f9 !important;
        }

        #cardDetalhesContent .detalhes-tarefa-row input[type="date"] {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 6px 10px;
            color: #0f172a;
        }

        /* Detalhe do contato (popup alinhado a contatos.html) */
        .detalhes-contato-acoes-btns {
            display: flex;
            flex-shrink: 0;
            gap: 6px;
            align-items: flex-start;
        }

        #crmEtapasContactDetailOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 12000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        #crmEtapasContactDetailOverlay.active {
            display: flex;
        }

        #crmEtapasNotaCompletaOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 12010;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        #crmEtapasNotaCompletaOverlay.active { display: flex; }
        #crmEtapasNotaCompletaOverlay .ce-cd-modal-box {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            width: min(520px, calc(100vw - 40px));
            max-width: 520px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        #crmEtapasCampoValorOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 12015;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        #crmEtapasCampoValorOverlay.show { display: flex; }

        #crmEtapasContactDetailOverlay .ce-cd-modal-box {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            width: min(560px, calc(100vw - 40px));
            max-width: 560px;
            min-height: min(520px, 82vh);
            max-height: 88vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        #crmEtapasContactDetailOverlay .ce-cd-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            flex-shrink: 0;
        }

        #crmEtapasContactDetailOverlay .ce-cd-header-main {
            flex: 1;
            min-width: 0;
        }

        #crmEtapasContactDetailOverlay .ce-cd-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #18181b;
            margin: 0;
        }

        #crmEtapasContactDetailOverlay .ce-cd-header-sub {
            margin: 6px 0 0 0;
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
            word-break: break-all;
        }

        #crmEtapasContactDetailOverlay .ce-cd-modal-close {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 4px;
            font-size: 1.5rem;
            line-height: 1;
            flex-shrink: 0;
        }

        #crmEtapasContactDetailOverlay .ce-cd-modal-close:hover {
            color: #374151;
        }

        #crmEtapasContactDetailOverlay .contact-detail-modal-scroll {
            flex: 1;
            min-height: min(360px, 50vh);
            overflow-y: auto;
            padding: 0 24px 8px;
        }

        #crmEtapasContactDetailOverlay .ce-cd-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            flex-shrink: 0;
        }

        .contact-detail-hero {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0 20px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }

        .contact-detail-hero-avatar {
            width: 56px;
            height: 56px;
            min-width: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-detail-hero-avatar.has-photo {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .contact-detail-hero-avatar.contato {
            background: rgba(108, 99, 255, 0.12);
            color: #6C63FF;
        }

        .contact-detail-hero-avatar.grupo {
            background: rgba(139, 92, 246, 0.12);
            color: #7c3aed;
        }

        .contact-detail-hero-text .tipo-pill {
            display: inline-block;
            margin-top: 6px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .contact-detail-hero-text .tipo-pill.contato {
            background: rgba(108, 99, 255, 0.12);
            color: #6C63FF;
        }

        .contact-detail-hero-text .tipo-pill.grupo {
            background: rgba(139, 92, 246, 0.12);
            color: #7c3aed;
        }

        .contact-detail-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 16px;
        }

        .contact-detail-card-title {
            font-size: 0.72rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin: 0 0 12px 0;
        }

        .contact-detail-card-hint {
            margin: 0 0 12px 0;
            font-size: 0.85rem;
            color: #6b7280;
            line-height: 1.45;
        }

        .contact-detail-rows {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .contact-detail-row {
            display: grid;
            grid-template-columns: 110px 1fr;
            gap: 10px 14px;
            align-items: start;
            font-size: 0.9rem;
        }

        .contact-detail-row .cdr-k {
            margin: 0;
            color: #9ca3af;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .contact-detail-row .cdr-v {
            margin: 0;
            color: #18181b;
            word-break: break-word;
        }

        .contact-detail-row .cdr-v a {
            color: #6C63FF;
            font-weight: 500;
        }

        .contact-detail-etiquetas-wrap { position: relative; margin-top: 4px; }
        .contact-detail-etiquetas-bar { display: flex; flex-wrap: wrap; align-items: flex-start; gap: 10px; }
        .contact-detail-etiquetas-chips { display: flex; flex-wrap: wrap; gap: 8px; flex: 1; min-width: 0; align-items: center; }
        .contact-detail-etiquetas-empty-hint { font-size: 0.88rem; color: #9ca3af; line-height: 1.4; }
        .contact-detail-etiqueta-chip { display: inline-flex; align-items: center; gap: 4px; max-width: 100%; padding: 5px 6px 5px 12px; border-radius: 999px; font-size: 0.78rem; font-weight: 600; border: 1px solid transparent; }
        .contact-detail-etiqueta-chip-remove {
            display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px; margin: 0 2px 0 0;
            border: none; border-radius: 50%; background: rgba(0, 0, 0, 0.08); color: #000; cursor: pointer; font-size: 1rem; line-height: 1; padding: 0; opacity: 0.75;
        }
        .contact-detail-etiqueta-chip-remove:hover { opacity: 1; background: rgba(0, 0, 0, 0.14); color: #000; }
        .contact-detail-etiqueta-add {
            flex-shrink: 0; width: 40px; height: 40px; border-radius: 50%; border: 2px dashed rgba(108, 99, 255, 0.45);
            background: rgba(108, 99, 255, 0.08); color: #6C63FF; font-size: 1.35rem; font-weight: 300; line-height: 1; cursor: pointer;
            display: inline-flex; align-items: center; justify-content: center; transition: background 0.15s, border-color 0.15s, transform 0.15s;
        }
        .contact-detail-etiqueta-add:hover { background: rgba(108, 99, 255, 0.16); border-color: #6C63FF; transform: scale(1.04); }
        .contact-detail-etiqueta-add[aria-expanded="true"] { border-style: solid; background: rgba(108, 99, 255, 0.2); color: #6C63FF; }
        .contact-detail-etiqueta-picker {
            position: absolute; left: 0; right: 0; top: calc(100% + 10px); z-index: 12010; background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
            box-shadow: 0 16px 48px rgba(15, 23, 42, 0.14); padding: 14px; max-height: 300px; display: flex; flex-direction: column; gap: 10px;
        }
        .contact-detail-etiqueta-picker[hidden] { display: none !important; }
        .contact-detail-etiqueta-picker-head { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #6b7280; margin: 0; }
        .contact-detail-etiqueta-picker-list { overflow-y: auto; flex: 1; min-height: 0; display: flex; flex-direction: column; gap: 6px; max-height: 220px; }
        .contact-detail-etiqueta-pick-row {
            display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; padding: 11px 12px; border: 1px solid #e5e7eb; border-radius: 10px;
            background: #fafafa; cursor: pointer; font-family: inherit; font-size: 0.9rem; font-weight: 500; color: #374151; transition: background 0.15s, border-color 0.15s;
        }
        .contact-detail-etiqueta-pick-row:hover { background: rgba(108, 99, 255, 0.07); border-color: rgba(108, 99, 255, 0.35); }
        .contact-detail-etiqueta-pick-row.is-on { background: rgba(108, 99, 255, 0.11); border-color: rgba(108, 99, 255, 0.45); }
        .contact-detail-etiqueta-pick-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
        .contact-detail-etiqueta-pick-label { flex: 1; min-width: 0; }
        .contact-detail-etiqueta-pick-check { width: 22px; flex-shrink: 0; text-align: center; font-weight: 700; color: #6C63FF; font-size: 0.95rem; }
        .contact-detail-link-new {
            margin-top: 8px; background: none; border: none; padding: 8px 0; font-size: 0.88rem; font-weight: 600; color: #6C63FF;
            cursor: pointer; font-family: inherit; display: inline-flex; align-items: center; gap: 6px;
        }
        .contact-detail-link-new:hover { text-decoration: underline; }
        .contact-detail-etiqueta-picker .contact-detail-link-new { margin-top: 4px; }
        .contact-detail-etiqueta-empty { padding: 12px; text-align: center; color: #9ca3af; font-size: 0.88rem; line-height: 1.45; }

        .contact-detail-cp-bar { display: flex; flex-wrap: wrap; align-items: flex-start; gap: 10px; margin-top: 4px; }
        .contact-detail-cp-list { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 10px; }
        .contact-detail-cp-row { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; padding: 10px 12px; border-radius: 10px; background: #fff; border: 1px solid #e5e7eb; font-size: 0.88rem; }
        .contact-detail-cp-row-k { font-weight: 600; color: #374151; margin: 0 0 4px 0; }
        .contact-detail-cp-row-v { margin: 0; color: #18181b; word-break: break-word; }
        .contact-detail-cp-actions { display: flex; flex-shrink: 0; align-items: flex-start; gap: 6px; }
        .contact-detail-cp-edit { flex-shrink: 0; border: none; background: rgba(0,0,0,0.06); width: 28px; height: 28px; border-radius: 8px; cursor: pointer; color: #64748b; font-size: 0.85rem; line-height: 1; }
        .contact-detail-cp-edit:hover { background: rgba(108, 99, 255, 0.15); color: #6C63FF; }
        .contact-detail-cp-remove { flex-shrink: 0; border: none; background: rgba(0,0,0,0.06); width: 28px; height: 28px; border-radius: 8px; cursor: pointer; color: #64748b; font-size: 1.1rem; line-height: 1; }
        .contact-detail-cp-remove:hover { background: rgba(239,68,68,0.15); color: #b91c1c; }
        .contact-detail-cp-add { flex-shrink: 0; width: 40px; height: 40px; border-radius: 50%; border: 2px dashed rgba(108, 99, 255, 0.45); background: rgba(108, 99, 255, 0.08); color: #6C63FF; font-size: 1.35rem; font-weight: 300; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; }
        .contact-detail-cp-add:hover { background: rgba(108, 99, 255, 0.16); border-color: #6C63FF; }
        .contact-detail-scroll-max-5-cp { max-height: 22.5rem; overflow-y: auto; padding-right: 6px; -webkit-overflow-scrolling: touch; }

        .contact-detail-crm-item {
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 10px;
            background: #fff;
        }
        .contact-detail-crm-toprow { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
        .contact-detail-crm-meta--grow { flex: 1; min-width: 0; margin: 0; }
        .contact-detail-crm-open-etapas {
            flex-shrink: 0; width: 36px; height: 36px; padding: 0; border: 1px solid #e5e7eb; border-radius: 10px;
            background: #f9fafb; color: #4b5563; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }
        .contact-detail-crm-open-etapas .material-symbols-rounded { font-size: 20px; line-height: 1; }
        .contact-detail-crm-open-etapas:hover { background: rgba(108, 99, 255, 0.1); border-color: rgba(108, 99, 255, 0.35); color: #6C63FF; }

        .contact-detail-crm-meta {
            font-size: 0.85rem;
            color: #6b7280;
        }
        .contact-detail-crm-scroll { display: flex; flex-direction: column; gap: 10px; max-height: 30rem; overflow-y: auto; padding-right: 6px; -webkit-overflow-scrolling: touch; }
        .contact-detail-crm-scroll .contact-detail-crm-item { margin-bottom: 0; align-self: flex-start; width: 100%; }

        .contact-detail-notas-grid {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .contact-detail-notas-scroll { display: flex; flex-direction: column; gap: 14px; max-height: 32rem; overflow-y: auto; padding-right: 6px; -webkit-overflow-scrolling: touch; }

        .contact-detail-notas-empty {
            margin: 0;
            color: #9ca3af;
            font-size: 0.9rem;
            line-height: 1.45;
        }

        .contact-detail-crm-empty {
            margin: 0;
            color: #9ca3af;
            font-size: 0.9rem;
            line-height: 1.45;
        }

        .contact-detail-sticky-note {
            padding: 14px 16px 16px 16px;
            border-radius: 12px;
            background: #ffedd5;
            border: 2px solid #ea580c;
            box-shadow: 0 1px 2px rgba(234, 88, 12, 0.12);
        }

        .contact-detail-note-conexao {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9a3412;
            margin: 0 0 10px 0;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .contact-detail-note-conexao-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ea580c;
            flex-shrink: 0;
        }

        .contact-detail-note-body {
            margin: 0;
            font-size: 0.92rem;
            line-height: 1.55;
            color: #431407;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .contact-detail-note-body--clamped { display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3; overflow: hidden; }
        .contact-detail-note-expand { margin-top: 8px; padding: 6px 10px; border: none; border-radius: 8px; background: rgba(234, 88, 12, 0.2); color: #7c2d12; font-size: 0.78rem; font-weight: 700; cursor: pointer; font-family: inherit; }
        .contact-detail-note-expand:hover { background: rgba(234, 88, 12, 0.32); }
        .contact-detail-nota-completa-pre { margin: 0; font-size: 0.92rem; line-height: 1.55; white-space: pre-wrap; word-break: break-word; color: #18181b; max-height: min(60vh, 28rem); overflow-y: auto; }

        @keyframes contact-detail-msk-pulse {
            0%, 100% { opacity: 0.38; }
            50% { opacity: 0.92; }
        }

        .contact-detail-msk {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 8px 4px 12px;
            align-items: stretch;
            min-height: 132px;
        }

        .contact-detail-msk-row {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            max-width: 88%;
        }

        .contact-detail-msk-row.is-sent {
            align-self: flex-end;
            flex-direction: row-reverse;
            max-width: 82%;
        }

        .contact-detail-msk-avatar {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.09);
            animation: contact-detail-msk-pulse 1.2s ease-in-out infinite;
        }

        .contact-detail-msk-bubble {
            border-radius: 12px;
            background: rgba(15, 23, 42, 0.09);
            animation: contact-detail-msk-pulse 1.2s ease-in-out infinite;
        }

        .contact-detail-msk-row.is-received .contact-detail-msk-bubble {
            border-bottom-left-radius: 5px;
        }

        .contact-detail-msk-row.is-sent .contact-detail-msk-bubble {
            border-bottom-right-radius: 5px;
        }

        .contact-detail-msk-bubble--sm {
            width: min(120px, 55%);
            height: 36px;
        }

        .contact-detail-msk-bubble--md {
            width: min(200px, 72%);
            height: 44px;
        }

        .contact-detail-msk-bubble--lg {
            width: min(260px, 85%);
            height: 52px;
        }

        #crmEtapasContactDetailConversarBtn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        #crmEtapasConversaConexaoModal .crm-etapas-conexao-modal-content {
            max-width: 440px;
        }

        #crmEtapasConversaConexaoModal .modal-body-section {
            padding-top: 4px;
        }

        #crmEtapasConversaConexaoModal .modal-subtitle {
            margin-bottom: 2px;
        }

        body.dark-mode #crmEtapasConversaConexaoModal .form-group-modal select {
            background: #0f172a;
            color: #f8fafc;
            border-color: #475569;
        }

        body.dark-mode #crmEtapasConversaConexaoModal .form-group-modal select:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        body.dark-mode #crmEtapasConversaConexaoModal .form-group-modal select option {
            background: #0f172a;
            color: #f8fafc;
        }

        body.dark-mode #crmEtapasContactDetailOverlay .ce-cd-modal-box {
            background: #1e293b;
            border-color: rgba(71, 85, 105, 0.4);
        }
        body.dark-mode #crmEtapasNotaCompletaOverlay .ce-cd-modal-box {
            background: #1e293b;
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode #crmEtapasContactDetailOverlay .ce-cd-modal-title {
            color: #f8fafc;
        }

        body.dark-mode #crmEtapasContactDetailOverlay .ce-cd-header-sub {
            color: #94a3b8;
        }

        body.dark-mode #crmEtapasContactDetailOverlay .ce-cd-modal-header,
        body.dark-mode #crmEtapasContactDetailOverlay .ce-cd-modal-footer {
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode #crmEtapasContactDetailOverlay .ce-cd-modal-close {
            color: #64748b;
        }

        body.dark-mode #crmEtapasContactDetailOverlay .ce-cd-modal-close:hover {
            color: #e2e8f0;
        }

        body.dark-mode .contact-detail-header-sub,
        body.dark-mode .contact-detail-card-title {
            color: #94a3b8;
        }

        body.dark-mode .contact-detail-card-hint {
            color: #94a3b8;
        }

        body.dark-mode .contact-detail-card {
            background: rgba(30, 41, 59, 0.45);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .contact-detail-row .cdr-k {
            color: #64748b;
        }

        body.dark-mode .contact-detail-row .cdr-v {
            color: #f1f5f9;
        }

        body.dark-mode .contact-detail-etiquetas-empty-hint { color: #94a3b8; }
        body.dark-mode .contact-detail-etiqueta-chip-remove { background: rgba(255, 255, 255, 0.12); color: #000; }
        body.dark-mode .contact-detail-etiqueta-chip-remove:hover { background: rgba(255, 255, 255, 0.2); color: #000; }
        body.dark-mode .contact-detail-etiqueta-add { border-color: rgba(108, 99, 255, 0.4); background: rgba(108, 99, 255, 0.12); color: #6C63FF; }
        body.dark-mode .contact-detail-etiqueta-picker { background: #1e293b; border-color: rgba(71, 85, 105, 0.5); box-shadow: 0 16px 48px rgba(0, 0, 0, 0.45); }
        body.dark-mode .contact-detail-etiqueta-picker-head { color: #94a3b8; }
        body.dark-mode .contact-detail-etiqueta-pick-row { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.45); color: #e2e8f0; }
        body.dark-mode .contact-detail-etiqueta-pick-row:hover { background: rgba(108, 99, 255, 0.1); border-color: rgba(108, 99, 255, 0.4); }
        body.dark-mode .contact-detail-etiqueta-pick-row.is-on { background: rgba(108, 99, 255, 0.15); border-color: rgba(108, 99, 255, 0.5); }
        body.dark-mode .contact-detail-etiqueta-empty { color: #94a3b8; }
        body.dark-mode .contact-detail-cp-row { background: rgba(15, 23, 42, 0.55); border-color: rgba(71, 85, 105, 0.45); }
        body.dark-mode .contact-detail-cp-row-k { color: #e2e8f0; }
        body.dark-mode .contact-detail-cp-row-v { color: #f1f5f9; }
        body.dark-mode .contact-detail-cp-edit { background: rgba(255,255,255,0.08); color: #94a3b8; }
        body.dark-mode .contact-detail-cp-remove { background: rgba(255,255,255,0.08); color: #94a3b8; }
        body.dark-mode .contact-detail-cp-add { border-color: rgba(108, 99, 255, 0.4); background: rgba(108, 99, 255, 0.12); color: #6C63FF; }

        body.dark-mode .contact-detail-hero {
            border-bottom-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .contact-detail-crm-item {
            background: rgba(15, 23, 42, 0.4);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .contact-detail-crm-meta {
            color: #94a3b8;
        }

        body.dark-mode .contact-detail-notas-empty,
        body.dark-mode .contact-detail-crm-empty {
            color: #94a3b8;
        }

        body.dark-mode .contact-detail-sticky-note {
            background: rgba(249, 230, 188, 0.12);
            border-color: #ca8a03;
            box-shadow: none;
        }

        body.dark-mode .contact-detail-note-conexao {
            color: #fbbf24;
        }

        body.dark-mode .contact-detail-note-conexao-dot {
            background: #ca8a03;
        }

        body.dark-mode .contact-detail-note-body {
            color: #f9e6bc;
        }
        body.dark-mode .contact-detail-note-expand { background: rgba(251, 146, 60, 0.2); color: #fed7aa; }
        body.dark-mode .contact-detail-note-expand:hover { background: rgba(251, 146, 60, 0.32); }
        body.dark-mode .contact-detail-nota-completa-pre { color: #f1f5f9; }

        body.dark-mode .contact-detail-msk-avatar,
        body.dark-mode .contact-detail-msk-bubble {
            background: rgba(255, 255, 255, 0.1);
        }

        /* === Dropdowns: fundo branco e texto preto (light e dark) === */
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
        body.dark-mode .contact-detail-etiqueta-picker,
        body:not(.light-mode) .contact-detail-etiqueta-picker {
            background: #ffffff !important;
            border-color: rgba(0, 0, 0, 0.15) !important;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12) !important;
        }
        body.dark-mode .contact-detail-etiqueta-picker-head,
        body:not(.light-mode) .contact-detail-etiqueta-picker-head {
            color: #000000 !important;
        }
    </style>
    
<!-- scripts removidos para manter somente HTML + CSS -->

    <style>
        .toast-container {
            position: fixed !important;
            top: max(20px, env(safe-area-inset-top, 0px)) !important;
            left: 50% !important;
            right: auto !important;
            transform: translateX(-50%) !important;
            z-index: 200100 !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 8px !important;
            width: min(380px, calc(100vw - 28px)) !important;
            pointer-events: none !important;
            box-sizing: border-box !important;
        }
        .toast-notification {
            pointer-events: auto !important;
            margin: 0 !important;
            padding: 10px 14px 10px 0 !important;
            border-radius: 12px !important;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Helvetica, Arial, sans-serif !important;
            font-size: 13px !important;
            line-height: 1.35 !important;
            letter-spacing: -0.01em !important;
            font-weight: 400 !important;
            display: flex !important;
            align-items: center !important;
            gap: 0 !important;
            opacity: 0 !important;
            transform: translateY(-8px) scale(0.98) !important;
            transition: opacity 0.22s ease, transform 0.22s ease !important;
            color: rgba(0, 0, 0, 0.88) !important;
            background: rgba(255, 255, 255, 0.76) !important;
            backdrop-filter: saturate(180%) blur(22px) !important;
            -webkit-backdrop-filter: saturate(180%) blur(22px) !important;
            border: 1px solid rgba(0, 0, 0, 0.09) !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1), 0 0 0 0.5px rgba(0, 0, 0, 0.04) inset !important;
            max-width: none !important;
        }
        .toast-notification.show {
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
        }
        .toast-notification::before {
            content: '' !important;
            align-self: stretch !important;
            width: 4px !important;
            min-height: 2.5em !important;
            margin: 6px 12px 6px 8px !important;
            border-radius: 3px !important;
            flex-shrink: 0 !important;
            background: rgba(0, 122, 255, 0.95) !important;
        }
        .toast-notification.info::before { background: rgba(0, 122, 255, 0.95) !important; }
        .toast-notification.success::before { background: rgba(52, 199, 89, 0.95) !important; }
        .toast-notification.error::before { background: rgba(255, 59, 48, 0.95) !important; }
        .toast-notification .toast-message {
            flex: 1 !important;
            min-width: 0 !important;
            word-break: break-word !important;
            padding-right: 4px !important;
        }
        body.dark-mode .toast-notification {
            color: rgba(255, 255, 255, 0.92) !important;
            background: rgba(44, 44, 46, 0.78) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.45), 0 0 0 0.5px rgba(255, 255, 255, 0.06) inset !important;
        }
        body.dark-mode .toast-notification.info::before { background: rgba(10, 132, 255, 0.95) !important; }
        body.dark-mode .toast-notification.success::before { background: rgba(48, 209, 88, 0.95) !important; }
        body.dark-mode .toast-notification.error::before { background: rgba(255, 69, 58, 0.95) !important; }
    </style>
    <link rel="stylesheet" href="dropdowns-global.css">
</head>
<body>
    <!-- Tema antes da primeira pintura: evita flash claro (cookie darkMode, mesma lógica que getCookie) -->
    
<!-- scripts removidos para manter somente HTML + CSS -->

    <div class="toast-container" id="toastContainer"></div>

    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app-layout">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- Botão de fechar mobile -->
            <button class="mobile-close-btn" id="mobileCloseBtn" aria-label="Fechar menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="sidebar-header">
                <a href="#" class="sidebar-logo-link">
                    <img class="sidebar-logo-img" src="/hublabel/public/assets/images/logo" alt="IA Chatconversa">
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
            <div class="board-header">
            <div class="header">
                <div class="header-left">
                    <button class="header-back-btn">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <div>
                        <div class="header-breadcrumb">
                            <span>CRM</span>
                            <span>/</span>
                            <span class="highlight" id="quadroBreadcrumbTipo">PIPELINE</span>
                        </div>
                        <div class="header-content">
                            <h1 id="quadroNome">Etapas do Quadro</h1>
                            <p>Gerencie as etapas e cards do seu quadro CRM</p>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-pipeline">
                        <p class="header-pipeline-label">Pipeline</p>
                        <p class="header-pipeline-value" id="pipelineValorTopo">R$ 0,00</p>
                    </div>
                    <div class="header-search">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" id="buscarLeadInput" placeholder="Buscar lead...">
                    </div>
                    <div class="header-actions">
                        <button class="btn-criar-etapa">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"></path>
                            </svg>
                            Nova Etapa
                        </button>
                    </div>
                </div>
            </div>
            </div>

            <!-- Loading State (skeleton 3 colunas - animação piscando) -->
            <div class="loading-container skeleton-loading" id="loadingContainer">
                <div class="skeleton-etapa-column">
                    <div class="skeleton-header" style="width: 70%;"></div>
                    <div class="skeleton-card"></div>
                    <div class="skeleton-card"></div>
                    <div class="skeleton-card"></div>
                </div>
                <div class="skeleton-etapa-column">
                    <div class="skeleton-header" style="width: 60%;"></div>
                    <div class="skeleton-card"></div>
                    <div class="skeleton-card"></div>
                </div>
                <div class="skeleton-etapa-column">
                    <div class="skeleton-header" style="width: 75%;"></div>
                    <div class="skeleton-card"></div>
                    <div class="skeleton-card"></div>
                    <div class="skeleton-card"></div>
                </div>
            </div>

            <!-- Kanban Board -->
            <div class="kanban-board" id="kanbanBoard" style="display: none;"></div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <h3>Nenhuma etapa criada ainda</h3>
                <p>Clique em "Nova Etapa" para criar sua primeira etapa.</p>
            </div>
        </div>
    </div>

    <!-- Modal Criar Card -->
    <div class="modal" id="modalCriarCard">
        <div class="modal-content">
            <button class="modal-close-btn">
                <i class="fa-solid fa-xmark" style="font-size:16px"></i>
            </button>

            <!-- Header -->
            <div class="modal-header-section">
                <h3>Novo Card</h3>
                <p class="modal-subtitle">ADICIONAR AO FUNIL</p>
            </div>

            <!-- Seção: Dados do Contato -->
            <div class="modal-body-section">
                <div class="modal-section-title green">
                    <i class="fa-solid fa-address-card"></i> CONTATO
                </div>

                <div class="form-group-modal">
                    <label>Contato <span class="required">*</span></label>
                    <p class="detalhes-contato-hint">Busque e selecione um contato da base. Toque no lápis para trocar depois de escolher.</p>
                    <div id="criarContatosPickerBlock">
                        <div class="input-wrapper">
                            <i class="fa-solid fa-magnifying-glass input-icon"></i>
                            <input type="text" id="criarContatosBusca" class="has-icon" placeholder="Buscar por nome ou telefone..." autocomplete="off" />
                        </div>
                        <input type="hidden" id="criarContatoId" value="" />
                        <input type="hidden" id="criarContatoTelefone" value="" />
                        <div id="criarContatosLista" class="contatos-lista-scroll" role="listbox" aria-label="Lista de contatos para novo card"></div>
                    </div>
                    <div id="criarContatoResumo" class="detalhes-contato-resumo detalhes-contato-resumo--empty">
                        <div class="detalhes-contato-resumo-header">
                            <p class="detalhes-contato-resumo-titulo"><i class="fa-solid fa-id-card"></i> Contato selecionado</p>
                            <button type="button" id="criarContatoTrocarBtn" class="detalhes-contato-edit-btn" title="Trocar contato" aria-label="Trocar contato" style="display: none;">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </div>
                        <div id="criarContatoResumoInner" class="detalhes-contato-resumo-inner">
                            <p class="detalhes-contato-resumo-placeholder">Selecione um contato na lista acima.</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="modal-section-divider">

            <!-- Seção: Detalhes do Negócio -->
            <div class="modal-body-section">
                <div class="modal-section-title blue">
                    <i class="fa-solid fa-briefcase"></i> DETALHES DO NEGÓCIO
                </div>

                <div class="form-row">
                    <div class="form-group-modal">
                        <label>Valor</label>
                        <input type="text" id="cardValorInput" placeholder="R$ 0,00">
                    </div>
                    <div class="form-group-modal">
                        <label>Etapa (Coluna)</label>
                        <select id="cardEtapaSelect"></select>
                    </div>
                </div>
            </div>

            <hr class="modal-section-divider">

            <!-- Seção: Anotações e Tarefas -->
            <div class="modal-body-section">
                <div class="modal-section-title orange">
                    <i class="fa-solid fa-list-check"></i> ANOTAÇÕES E TAREFAS
                </div>

                <div class="form-group-modal">
                    <label>Observações</label>
                    <textarea id="cardObservacoesInput" placeholder="Detalhes importantes sobre este lead..."></textarea>
                </div>

                <div class="tarefas-section">
                    <label style="display:block;color:#0f172a;font-size:0.875rem;margin-bottom:10px;font-weight:700;">Tarefas</label>
                    <div id="tarefasContainer"></div>
                    <button type="button" class="btn-add-tarefa">
                        <i class="fa-solid fa-plus" style="font-size:11px"></i>
                        Adicionar Tarefa
                    </button>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-modal-cancel">Cancelar</button>
                <button class="btn-modal-create">
                    <i class="fa-solid fa-check"></i> Criar Card
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes Card -->
    <div class="modal" id="modalDetalhesCard">
        <div class="modal-content modal-detalhes-shell">
            <button type="button" class="modal-close-btn" aria-label="Fechar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="modal-detalhes-header">
                <p class="modal-subtitle">Detalhes do negócio</p>
                <h3 id="cardDetalhesTitulo">Card</h3>
            </div>
            <div id="cardDetalhesContent" class="modal-detalhes-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel">Fechar</button>
                <button type="button" class="btn-modal-create">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Card -->
    <div class="modal" id="modalEditarCard">
        <div class="modal-content">
            <button class="modal-close-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <h3>Editar Card</h3>
            
            <div class="form-group-modal">
                <label>Contato <span class="required">*</span></label>
                <p class="detalhes-contato-hint">Busque e selecione um contato. Com um contato já escolhido, use o lápis para trocar.</p>
                <div id="editarContatosPickerBlock">
                    <div class="input-wrapper">
                        <i class="fa-solid fa-magnifying-glass input-icon"></i>
                        <input type="text" id="editarContatosBusca" class="has-icon" placeholder="Buscar por nome ou telefone..." autocomplete="off" />
                    </div>
                    <input type="hidden" id="editarContatoId" value="" />
                    <input type="hidden" id="editarContatoTelefone" value="" />
                    <div id="editarContatosLista" class="contatos-lista-scroll" role="listbox" aria-label="Lista de contatos ao editar card"></div>
                </div>
                <div id="editarContatoResumo" class="detalhes-contato-resumo detalhes-contato-resumo--empty">
                    <div class="detalhes-contato-resumo-header">
                        <p class="detalhes-contato-resumo-titulo"><i class="fa-solid fa-id-card"></i> Contato selecionado</p>
                        <button type="button" id="editarContatoTrocarBtn" class="detalhes-contato-edit-btn" title="Trocar contato" aria-label="Trocar contato" style="display: none;">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                    </div>
                    <div id="editarContatoResumoInner" class="detalhes-contato-resumo-inner">
                        <p class="detalhes-contato-resumo-placeholder">Selecione um contato na lista para ver nome, telefone e e-mail.</p>
                    </div>
                </div>
            </div>

            <div class="form-group-modal">
                <label>Valor</label>
                <input type="text" id="editarCardValorInput" placeholder="R$ 0,00">
            </div>

            <div class="form-group-modal">
                <label>Observações</label>
                <textarea id="editarCardObservacoesInput" placeholder="Digite as observações"></textarea>
            </div>

            <div class="modal-footer">
                <button class="btn-modal-cancel">Cancelar</button>
                <button class="btn-modal-create">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Popup detalhes do contato (mesmo conteúdo base que contatos.html) -->
    <div id="crmEtapasContactDetailOverlay">
        <div class="ce-cd-modal-box">
            <div class="ce-cd-modal-header">
                <div class="ce-cd-header-main">
                    <h2 class="ce-cd-modal-title" id="crmEtapasContactDetailTitle">Contato</h2>
                    <p class="ce-cd-header-sub" id="crmEtapasContactDetailSubtitle"></p>
                </div>
                <button type="button" class="ce-cd-modal-close" aria-label="Fechar">&times;</button>
            </div>
            <div class="contact-detail-modal-scroll" id="crmEtapasContactDetailBody"></div>
            <div class="ce-cd-modal-footer">
                <button type="button" class="btn-modal-cancel">Fechar</button>
                <button type="button" class="btn-modal-create" id="crmEtapasContactDetailConversarBtn">Conversar</button>
            </div>
        </div>
    </div>

    <div id="crmEtapasNotaCompletaOverlay">
        <div class="ce-cd-modal-box" style="max-width:520px;max-height:86vh;">
            <div class="ce-cd-modal-header">
                <div class="ce-cd-header-main">
                    <h2 class="ce-cd-modal-title" id="crmEtapasNotaCompletaTitle">Nota</h2>
                </div>
                <button type="button" class="ce-cd-modal-close" aria-label="Fechar">&times;</button>
            </div>
            <div class="contact-detail-modal-scroll" style="padding-top:16px;">
                <pre class="contact-detail-nota-completa-pre" id="crmEtapasNotaCompletaBody"></pre>
            </div>
            <div class="ce-cd-modal-footer">
                <button type="button" class="btn-modal-cancel">Fechar</button>
            </div>
        </div>
    </div>

    <div id="crmEtapasCampoValorOverlay">
        <div class="modal-content crm-etapas-conexao-modal-content">
            <button type="button" class="modal-close-btn" aria-label="Fechar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="modal-header-section">
                <p class="modal-subtitle">CAMPOS PERSONALIZADOS</p>
                <h3 id="crmEtapasCampoValorModalTitle">Atribuir campo</h3>
            </div>
            <div class="modal-body-section">
                <div class="form-group-modal">
                    <label for="crmEtapasCampoValorSelect">Campo</label>
                    <select id="crmEtapasCampoValorSelect"></select>
                </div>
                <div class="form-group-modal">
                    <label for="crmEtapasCampoValorInputText" id="crmEtapasCampoValorLabel">Valor</label>
                    <div id="crmEtapasCampoValorDynamicMount">
                        <input type="text" id="crmEtapasCampoValorInputText" placeholder="Digite o valor">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel">Cancelar</button>
                <button type="button" class="btn-modal-create" id="crmEtapasCampoValorSaveBtn">Salvar</button>
            </div>
        </div>
    </div>

    <div class="modal" id="crmEtapasConversaConexaoModal">
        <div class="modal-content crm-etapas-conexao-modal-content">
            <button type="button" class="modal-close-btn" aria-label="Fechar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="modal-header-section">
                <p class="modal-subtitle">MÚLTIPLAS CONEXÕES</p>
                <h3>Com qual conexão deseja conversar?</h3>
            </div>
            <div class="modal-body-section">
                <div class="form-group-modal">
                    <label for="crmEtapasConversaConexaoSelect">Conexão</label>
                    <select id="crmEtapasConversaConexaoSelect"></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel">Cancelar</button>
                <button type="button" class="btn-modal-create">Ir para conversa</button>
            </div>
        </div>
    </div>

    <div class="modal" id="crmEtapasEtiquetaEtapaModal">
        <div class="modal-content crm-etapas-conexao-modal-content">
            <button type="button" class="modal-close-btn" aria-label="Fechar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="modal-header-section">
                <p class="modal-subtitle">ETIQUETAS</p>
                <h3>Adicionar etiqueta</h3>
                <p class="crm-etapas-etiqueta-modal-desc">Adicionar etiquetas a todos contatos dessa etapa.</p>
            </div>
            <div class="modal-body-section">
                <div class="form-group-modal">
                    <label for="crmEtapasEtiquetaEtapaNomeInput">Nome da etiqueta</label>
                    <input type="text" id="crmEtapasEtiquetaEtapaNomeInput" placeholder="Nome da etiqueta" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" id="crmEtapasEtiquetaEtapaCancelBtn">Cancelar</button>
                <button type="button" class="btn-modal-create" id="crmEtapasEtiquetaEtapaBtn">
                    <span id="crmEtapasEtiquetaEtapaBtnText">Adicionar etiqueta</span>
                    <span id="crmEtapasEtiquetaEtapaBtnSpinner" class="crm-etapas-etiqueta-btn-spinner" style="display: none;" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Exclusão Etapa -->
    <div class="modal" id="modalExcluirEtapa">
        <div class="modal-content" style="border: 2px solid #ff4444; background: rgba(255, 68, 68, 0.1);">
            <button class="modal-close-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <h3 style="color: #ff4444;">Tem certeza que deseja excluir essa etapa?</h3>
            <p style="color: #ccc; margin: 15px 0;">Ao clicar em confirmar essa etapa e todos os cards serão excluídos</p>
            <div class="modal-footer">
                <button class="btn-modal-cancel">Cancelar</button>
                <button class="btn-modal-create" style="background: #ff4444; border-color: #ff4444;">Confirmar</button>
            </div>
        </div>
    </div>

    
<!-- scripts removidos para manter somente HTML + CSS -->


<!-- JavaScript de inicialização -->
<script src="/hublabel/public/assets/js/pages/etapas_quadro.js"></script>
</body>
</html>

