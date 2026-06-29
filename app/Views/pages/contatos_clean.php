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
    <title>Contatos - IA Chatconversa</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="shortcut icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="apple-touch-icon" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <!-- Google Fonts: Plus Jakarta Sans -->
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
        /* ===== CSS RESET & ROOT VARIABLES (from dashboard.html) ===== */
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

        /* ===== BODY (from dashboard.html) ===== */
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

        /* ===== APP LAYOUT (from dashboard.html) ===== */
        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR (from dashboard.html) ===== */
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

        /* Sidebar: height media queries */
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

        /* ===== THEME TOGGLE SWITCH (from dashboard.html) ===== */
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

        /* ===== MOBILE MENU TOGGLE (from dashboard.html) ===== */
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

        /* ===== SIDEBAR OVERLAY (from dashboard.html) ===== */
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

        /* ===== MOBILE CLOSE BTN (from dashboard.html) ===== */
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
/* ===== MENU OCULTAR ===== */
        body.menu-oculta-chat [data-menu-id="chat"] { display: none !important; }
        body.menu-oculta-agentes-ia [data-menu-id="agentes-ia"] { display: none !important; }
        body.menu-oculta-crm [data-menu-id="crm"] { display: none !important; }
        body.menu-oculta-conexoes [data-menu-id="conexoes"] { display: none !important; }
        body.menu-oculta-disparos [data-menu-id="disparos"] { display: none !important; }
        body.menu-oculta-contatos [data-menu-id="contatos"] { display: none !important; }
        body.menu-oculta-listas [data-menu-id="listas"] { display: none !important; }
        body.menu-oculta-ajuda [data-menu-id="ajuda"] { display: none !important; }
        body.menu-oculta-configuracoes [data-menu-id="configuracoes"] { display: none !important; }

        /* ===== MAIN CONTENT WRAPPER ===== */
        .main-content-wrapper {
            flex: 1;
            padding: 32px 0;
            overflow-x: hidden;
            margin-left: 72px;
            width: calc(100vw - 72px);
            padding-top: 40px;
        }
        .container { width: 100%; max-width: 100vw; margin: 0; padding: 0 40px; overflow-x: hidden; }

        /* ===== HEADER ===== */
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px; }
        .header-info h1 { font-size: 2.25rem; font-weight: 800; letter-spacing: -0.025em; margin-bottom: 8px; color: #18181b; }
        .header-info p { color: #64748b; font-size: 1rem; font-weight: 500; }

        /* ===== BUTTONS ===== */
        .btn { padding: 10px 18px; background: #6C63FF; border: none; border-radius: 10px; color: white; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; font-size: 0.9rem; text-decoration: none; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(108, 99, 255, 0.3); }
        .btn-secondary { background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.1); }
        .btn-secondary:hover { background: rgba(255, 255, 255, 0.05); }
        body.light-mode .modal-overlay .btn-secondary {
            background: #f8fafc;
            border: 1px solid #d1d5db;
            color: #334155;
        }
        body.light-mode .modal-overlay .btn-secondary:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            color: #0f172a;
            box-shadow: none;
            transform: none;
        }
        body.light-mode .modal-overlay .btn-secondary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }
        .btn-import { padding: 10px 18px; background: transparent; border: 1px solid #d1d5db; border-radius: 10px; color: #374151; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; font-size: 0.9rem; }
        .btn-import:hover { border-color: #6C63FF; color: #6C63FF; }
        .btn-sync-groups { padding: 10px 18px; background: rgba(139, 92, 246, 0.08); border: 1px solid rgba(139, 92, 246, 0.35); border-radius: 10px; color: #7c3aed; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; font-size: 0.9rem; }
        .btn-sync-groups:hover { border-color: #7c3aed; background: rgba(139, 92, 246, 0.14); transform: translateY(-1px); }
        .btn-danger { background: #dc2626; }
        .btn-danger:hover { box-shadow: 0 6px 20px rgba(220, 38, 38, 0.35); transform: translateY(-2px); }
        .btn-danger:disabled { opacity: 0.65; cursor: not-allowed; transform: none; box-shadow: none; }
        .delete-contact-modal-text { margin: 0; color: #4b5563; font-size: 0.95rem; line-height: 1.5; }

        /* ===== KPI CARDS ===== */
        .kpi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 28px; }
        .kpi-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 24px; transition: all 0.3s ease; }
        .kpi-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.06); }
        .kpi-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .kpi-card-title { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; color: #6b7280; }
        .kpi-card-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .kpi-card-icon svg { width: 18px; height: 18px; }
        .kpi-icon-users { background: rgba(108, 99, 255, 0.1); color: #6C63FF; }
        .kpi-icon-trend { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .kpi-icon-tag { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .kpi-card-value { font-size: 2rem; font-weight: 800; color: #18181b; letter-spacing: -0.025em; }
        .kpi-value-blue { color: #3b82f6; }
        .kpi-badge-blue { display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; background: rgba(59,130,246,0.1); color: #3b82f6; }
        .kpi-card-sub { font-size: 0.8rem; color: #9ca3af; font-weight: 500; }

        /* ===== SEARCH BAR ===== */
        .search-bar-container { position: relative; margin-bottom: 24px; }
        .search-bar-container .search-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: #9ca3af; pointer-events: none; }
        .search-input { width: 100%; padding: 12px 16px 12px 46px; border: 1px solid #e5e7eb; border-radius: 12px; background: #fff; color: #18181b; font-size: 0.95rem; font-family: inherit; transition: border-color 0.2s; }
        .search-input:focus { outline: none; border-color: #6C63FF; box-shadow: 0 0 0 3px rgba(37,211,102,0.1); }
        .search-input::placeholder { color: #9ca3af; }

        /* ===== CONTENT WITH LATERAL ===== */
        .content-with-lateral { display: flex; gap: 24px; align-items: flex-start; }
        .filters-sidebar { width: 260px; flex-shrink: 0; display: flex; flex-direction: column; gap: 16px; }
        .contacts-main { flex: 1; min-width: 0; }

        /* ===== FILTER CARDS ===== */
        .filter-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 20px; }
        .filter-card-title { font-size: 0.7rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 14px; display: flex; align-items: center; justify-content: space-between; gap: 8px; }
        .filter-card-title svg { width: 16px; height: 16px; color: #9ca3af; }
        .etiqueta-add-btn { background: none; border: none; color: #6C63FF; cursor: pointer; padding: 2px; display: flex; align-items: center; justify-content: center; border-radius: 4px; }
        .etiqueta-add-btn:hover { background: rgba(37,211,102,0.2); }

        /* ===== FILTER DATE ===== */
        .filter-date-row { margin-bottom: 12px; }
        .filter-date-row:last-child { margin-bottom: 0; }
        .filter-date-label { display: block; font-size: 0.85rem; color: #6b7280; margin-bottom: 6px; }
        .filter-date-input { width: 100%; padding: 10px 12px 10px 36px; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff; color: #18181b; font-size: 0.9rem; font-family: inherit; }
        .filter-date-input:focus { outline: none; border-color: #6C63FF; }
        .filter-crm-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
            color: #18181b;
            font-size: 0.9rem;
            font-family: inherit;
            cursor: pointer;
        }
        .filter-crm-select:focus { outline: none; border-color: #6C63FF; }
        .crm-etapa-filter-wrap { margin-top: 12px; }
        .filter-date-wrap { position: relative; }
        .filter-date-wrap .calendar-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: #9ca3af; pointer-events: none; }

        /* ===== ETIQUETA LATERAL ===== */
        .etiquetas-lateral-list { display: flex; flex-direction: column; gap: 0; }
        .etiqueta-lateral-item { display: flex; align-items: center; gap: 12px; padding: 14px 10px; cursor: pointer; transition: all 0.2s; color: #333; border-bottom: 1px solid #f1f5f9; user-select: none; min-width: 0; }
        .etiqueta-lateral-item:last-child { border-bottom: none; }
        .etiqueta-lateral-item:hover { background: rgba(37,211,102,0.04); }
        .etiqueta-lateral-item.active { background: rgba(37,211,102,0.06); }
        .etiqueta-lateral-checkbox { width: 18px; height: 18px; border: 2px solid #d1d5db; border-radius: 4px; cursor: pointer; accent-color: #6C63FF; flex-shrink: 0; }
        .etiqueta-lateral-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
        .etiqueta-lateral-name {
            flex: 1;
            min-width: 0;
            font-size: 0.95rem;
            font-weight: 500;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Tooltip instantâneo (title nativo demora ~1s) */
        .etiqueta-lateral-name[data-tooltip] {
            position: relative;
        }

        .etiqueta-lateral-name[data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 0;
            top: calc(100% + 6px);
            z-index: 10060;
            padding: 8px 10px;
            background: #0f172a;
            color: #f8fafc;
            font-size: 0.8125rem;
            font-weight: 500;
            line-height: 1.35;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.18);
            max-width: min(260px, calc(100vw - 48px));
            width: max-content;
            white-space: normal;
            word-break: break-word;
            pointer-events: none;
            text-align: left;
        }

        body.dark-mode .etiqueta-lateral-name[data-tooltip]:hover::after {
            background: #1e293b;
            color: #f1f5f9;
            border: 1px solid rgba(148, 163, 184, 0.35);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        }
        .etiqueta-lateral-count { font-size: 0.8rem; min-width: 28px; height: 24px; display: inline-flex; align-items: center; justify-content: center; background: rgba(107,114,128,0.10); color: #6b7280; border-radius: 999px; padding: 0 8px; flex-shrink: 0; }
        .etiqueta-lateral-item.active .etiqueta-lateral-count { background: rgba(37,211,102,0.15); color: #6C63FF; }
        .etiquetas-empty-msg { padding: 12px; color: #9ca3af; font-size: 0.9rem; text-align: center; }
        .ver-mais-etiquetas { color: #6C63FF; cursor: pointer; font-size: 0.85rem; padding: 8px 12px; text-align: center; }
        .ver-mais-etiquetas:hover { text-decoration: underline; }
        .tipo-filter-tags { display: flex; flex-wrap: wrap; gap: 8px; }
        .tipo-filter-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            background: #fff;
            color: #475569;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            transition: all 0.2s ease;
        }
        .tipo-filter-tag:hover { border-color: #6C63FF; color: #6C63FF; }
        .tipo-filter-tag.active { background: rgba(108, 99, 255, 0.14); border-color: rgba(108, 99, 255, 0.4); color: #6C63FF; }

        /* ===== TOP BAR ===== */
        .top-bar { display: flex; flex-direction: column; gap: 12px; margin-bottom: 16px; }
        .top-bar .total-count { margin-bottom: 2px; }
        .total-count { font-weight: 600; font-size: 1rem; color: #18181b; }

        /* ===== CONTACTS TABLE ===== */
        .contacts-table-container { overflow-x: auto; margin-bottom: 0; border-radius: 16px; background: #fff; border: 1px solid #e5e7eb; }
        .contacts-table { width: 100%; border-collapse: collapse; min-width: 920px; background: #fff; }
        .contacts-table th.contacts-th-checkbox {
            width: 44px;
            padding: 14px 12px 14px 16px;
            text-align: center;
            vertical-align: middle;
            font-size: 0;
            text-transform: none;
            letter-spacing: normal;
        }
        .contacts-table td.contacts-td-checkbox { padding: 16px 12px 16px 16px; vertical-align: middle; text-align: center; width: 44px; }
        .contacts-table .contacts-row-checkbox {
            width: 18px;
            height: 18px;
            min-width: 18px;
            min-height: 18px;
            accent-color: #6C63FF;
            cursor: pointer;
            flex-shrink: 0;
        }
        .contacts-bulk-bar { display: none; align-items: center; gap: 10px; flex-wrap: wrap; margin-top: 8px; }
        .contacts-bulk-bar.is-visible { display: flex; }
        .contacts-bulk-summary { display: inline-flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .contacts-bulk-count { font-size: 0.9rem; font-weight: 600; color: #6C63FF; }
        body.dark-mode .contacts-bulk-count { color: #6C63FF; }
        .contacts-bulk-link-all {
            padding: 0;
            border: none;
            background: none;
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 600;
            color: #6C63FF;
            text-decoration: underline;
            text-underline-offset: 3px;
            cursor: pointer;
        }
        .contacts-bulk-link-all:hover:not(:disabled) { color: #6C63FF; }
        .contacts-bulk-link-all:disabled {
            opacity: 0.45;
            cursor: not-allowed;
            text-decoration: none;
            color: #64748b;
        }
        body.dark-mode .contacts-bulk-link-all { color: #6C63FF; }
        body.dark-mode .contacts-bulk-link-all:hover:not(:disabled) { color: #6C63FF; }
        body.dark-mode .contacts-bulk-link-all:disabled { color: #64748b; }
        .contacts-bulk-dropdown-wrap { position: relative; }
        .contacts-bulk-actions-btn {
            display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 10px;
            border: 1px solid #d1d5db; background: #fff; color: #0f172a; font-size: 0.875rem; font-weight: 600; cursor: pointer;
            font-family: inherit;
        }
        .contacts-bulk-actions-btn:hover { border-color: #6C63FF; color: #6C63FF; }
        body.dark-mode .contacts-bulk-actions-btn { background: rgba(15, 23, 42, 0.75); border-color: rgba(71, 85, 105, 0.6); color: #e2e8f0; }
        body.dark-mode .contacts-bulk-actions-btn:hover { border-color: #6C63FF; color: #6C63FF; }
        .contacts-bulk-menu {
            display: none; position: absolute; top: calc(100% + 6px); left: 0; min-width: 260px; max-height: min(70vh, 420px);
            overflow-y: auto; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 12px 32px rgba(0,0,0,0.12);
            z-index: 200; padding: 6px 0;
        }
        .contacts-bulk-menu.is-open { display: block; }
        .contacts-bulk-menu button {
            display: block; width: 100%; text-align: left; padding: 10px 16px; border: none; background: none; font-size: 0.875rem;
            color: #334155; cursor: pointer; font-family: inherit; font-weight: 500;
        }
        .contacts-bulk-menu button:hover { background: rgba(108, 99, 255, 0.08); color: #6C63FF; }
        body.dark-mode .contacts-bulk-menu { background: rgba(30, 41, 59, 0.98); border-color: rgba(71, 85, 105, 0.5); }
        body.dark-mode .contacts-bulk-menu button { color: #e2e8f0; }
        body.dark-mode .contacts-bulk-menu button:hover { background: rgba(108, 99, 255, 0.12); color: #6C63FF; }
        .contacts-table th { background: #f8fafc; padding: 14px 20px; text-align: left; font-weight: 600; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e7eb; white-space: nowrap; }
        .contacts-table td { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; vertical-align: top; background: #fff; }
        .contacts-table tr:hover { background: #f8fafc; }
        .contacts-table tr:last-child td { border-bottom: none; }

        /* ===== CONTACT CELL ===== */
        .contact-cell { display: flex; align-items: flex-start; gap: 12px; }
        .contact-table-row { cursor: pointer; }
        .contact-table-row:hover { background: rgba(108, 99, 255, 0.06); }
        body.dark-mode .contact-table-row:hover { background: rgba(108, 99, 255, 0.08); }
        .contact-avatar { width: 40px; height: 40px; min-width: 40px; border-radius: 50%; background: rgba(139, 92, 246, 0.12); color: #7c3aed; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .contact-avatar.grupo { background: rgba(139, 92, 246, 0.1); }
        .contact-avatar.contato:not(.has-photo) { background: rgba(108, 99, 255, 0.12); color: #6C63FF; }
        .contact-avatar.has-photo { padding: 0; background: #e5e7eb; }
        .contact-avatar.has-photo img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .avatar-fallback { display: none; width: 100%; height: 100%; align-items: center; justify-content: center; }
        .contact-cell-info { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
        .contact-name { font-weight: 600; color: #18181b; font-size: 0.95rem; }
        .contact-phone { color: #6b7280; font-size: 0.85rem; font-family: inherit; }

        /* ===== BADGES ===== */
        .tipo-badge { display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 0.75rem; font-weight: 500; }
        .tipo-badge.contato { background: rgba(108, 99, 255, 0.12); color: #6C63FF; }
        .tipo-badge.grupo { background: rgba(139, 92, 246, 0.12); color: #7c3aed; }
        .etiquetas-tags { display: flex; flex-wrap: wrap; gap: 6px; }
        .etiqueta-tag { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 500; }
        .contact-date { color: #6b7280; font-size: 0.85rem; }

        /* ===== ROW MENU ===== */
        .contact-row-menu { position: relative; display: flex; align-items: flex-start; justify-content: flex-end; }
        .row-menu-btn { background: none; border: none; color: #9ca3af; cursor: pointer; padding: 6px; border-radius: 4px; }
        .row-menu-dropdown { position: fixed; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,0.12); z-index: 9999; min-width: 120px; overflow: hidden; }
        .row-menu-dropdown button { display: block; width: 100%; padding: 10px 16px; background: none; border: none; color: #374151; cursor: pointer; text-align: left; font-size: 0.85rem; font-family: inherit; }
        .row-menu-dropdown button:hover { background: rgba(37,211,102,0.08); color: #6C63FF; }
        .contact-actions { display: flex; gap: 4px; align-items: center; }
        .action-btn { background: none; border: none; color: #9ca3af; cursor: pointer; padding: 6px; border-radius: 4px; transition: all 0.3s ease; font-size: 0.9rem; display: inline-flex; align-items: center; }
        .action-btn:hover { background: rgba(0, 0, 0, 0.05); color: #374151; }
        .action-btn.edit:hover { color: #6C63FF; }
        .action-btn.delete:hover { color: #ff4444; }

        /* ===== SKELETON ===== */
        .skeleton-row { cursor: default; pointer-events: none; }
        .skeleton-row:hover { background: transparent !important; }
        .skeleton-row td { vertical-align: middle; }
        .skeleton-row .skeleton-line { height: 16px; border-radius: 6px; background: linear-gradient(90deg, #e5e7eb 0%, #f3f4f6 35%, #e5e7eb 70%, #f0f0f0 100%); background-size: 200% 100%; animation: skeleton-shimmer 1.8s ease-in-out infinite; }
        .skeleton-row .skeleton-line-name { width: 70%; max-width: 160px; height: 18px; }
        .skeleton-row .skeleton-line-phone { width: 55%; max-width: 120px; height: 14px; animation-delay: 0.1s; }
        .skeleton-row .skeleton-line-date { width: 90px; height: 14px; animation-delay: 0.2s; }
        @keyframes skeleton-shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

        /* ===== PAGINATION ===== */
        #contactsPagination { display: flex !important; justify-content: center !important; align-items: center !important; gap: 8px !important; margin: 20px auto 0 auto !important; flex-wrap: wrap !important; width: 100% !important; clear: both !important; }
        #contactsPagination button { margin: 0 !important; flex-shrink: 0 !important; padding: 6px 12px !important; font-size: 0.85rem !important; }
        body.light-mode #contactsPagination .btn-secondary {
            background: #f8fafc;
            border: 1px solid #d1d5db;
            color: #334155;
            box-shadow: none;
        }
        body.light-mode #contactsPagination .btn-secondary:hover:not(:disabled) {
            background: #f1f5f9;
            border-color: #94a3b8;
            color: #0f172a;
            transform: none;
            box-shadow: none;
        }

        /* ===== SECTION ===== */
        .section { background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 40px; box-shadow: var(--shadow-softer); overflow: visible; }
        .section-header { display: flex; align-items: center; gap: 12px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #e5e7eb; flex-wrap: wrap; }
        .section-icon { font-size: 1.5rem; }
        .section-title { font-size: 1.4rem; font-weight: 600; color: #6C63FF; }
        .filters-row { display: flex; gap: 15px; flex-wrap: wrap; align-items: center; }
        .filters-row .search-input-wrapper { position: relative; flex: 1; min-width: 200px; }
        .filters-row .search-input { width: 100%; padding: 10px 12px 10px 40px; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff; color: #18181b; font-size: 0.9rem; }
        .filters-row .search-input:focus { outline: none; border-color: #6C63FF; }
        .filters-row .search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: #9ca3af; pointer-events: none; }
        .filters-row select { padding: 10px 16px; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; color: #18181b; font-size: 0.9rem; min-width: 140px; cursor: pointer; }
        .filters-row select:focus { outline: none; border-color: #6C63FF; }
        .contacts-empty-msg { text-align: center; padding: 40px; color: #9ca3af; }

        /* ===== MODALS ===== */
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 9999; display: none; align-items: center; justify-content: center; padding: 20px; }
        .modal-overlay.active { display: flex; }
        .modal-box { background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; width: 100%; max-width: 480px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-header { padding: 20px 24px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
        .modal-title { font-size: 1.25rem; font-weight: 600; color: #18181b; }
        .modal-close { background: none; border: none; color: #9ca3af; cursor: pointer; padding: 4px; font-size: 1.5rem; }
        .modal-close:hover { color: #374151; }
        .modal-body { padding: 24px; }
        .modal-footer { padding: 16px 24px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 10px; }

        /* ===== FORM ===== */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; margin-bottom: 6px; font-size: 0.9rem; color: #6b7280; }
        .form-label .required { color: #ff6b6b; }
        .form-input, .form-select { width: 100%; padding: 10px 14px; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff; color: #18181b; font-size: 0.95rem; font-family: inherit; }
        .form-input:focus, .form-select:focus { outline: none; border-color: #6C63FF; }
        .sync-groups-count { font-size: 0.85rem; color: #6C63FF; font-weight: 600; margin-bottom: 10px; }
        .sync-groups-list-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 8px; }
        .sync-groups-actions { display: flex; align-items: center; gap: 12px; }
        .btn-link-inline { background: none; border: none; color: #6C63FF; cursor: pointer; font-size: 0.8rem; font-weight: 600; padding: 0; }
        .btn-link-inline:hover { text-decoration: underline; }
        .sync-groups-list { border: 1px solid #e5e7eb; border-radius: 10px; max-height: 270px; overflow-y: auto; background: #fff; }
        .sync-group-item { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-bottom: 1px solid #f1f5f9; cursor: pointer; }
        .sync-group-item:last-child { border-bottom: none; }
        .sync-group-item:hover { background: rgba(108, 99, 255, 0.05); }
        .sync-group-item.duplicate { background: rgba(250, 204, 21, 0.08); }
        .sync-group-item.duplicate:hover { background: rgba(250, 204, 21, 0.14); }
        .sync-group-name { font-size: 0.9rem; font-weight: 600; color: #18181b; }
        .sync-group-main { flex: 1; min-width: 0; }
        .sync-group-badges { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 5px; }
        .sync-group-badge { display: inline-flex; align-items: center; padding: 2px 8px; border-radius: 999px; font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px; }
        .sync-group-badge.duplicate { background: rgba(250, 204, 21, 0.18); color: #b45309; }
        .sync-group-badge.owner { background: rgba(108, 99, 255, 0.18); color: #6C63FF; }
        .sync-group-badge.community { background: rgba(59, 130, 246, 0.18); color: #1d4ed8; }
        .sync-group-badge.announce { background: rgba(239, 68, 68, 0.16); color: #b91c1c; }
        .sync-groups-message { display: none; margin-top: 14px; padding: 10px 12px; border-radius: 8px; border: 1px solid transparent; font-size: 0.85rem; }
        .sync-groups-message.show { display: block; }
        .sync-groups-message.success { background: rgba(34, 197, 94, 0.1); border-color: rgba(34, 197, 94, 0.25); color: #15803d; }
        .sync-groups-message.error { background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.25); color: #b91c1c; }
        .sync-groups-message.info { background: rgba(245, 158, 11, 0.1); border-color: rgba(245, 158, 11, 0.25); color: #b45309; }
        .csv-import-header { margin-bottom: 14px; }
        .csv-import-title { font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
        .csv-import-subtitle { font-size: 0.86rem; color: #64748b; line-height: 1.35; }
        .csv-import-stats { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 14px; }
        .csv-import-stat-chip { border: 1px solid #dbeafe; background: #f8fafc; color: #334155; border-radius: 999px; padding: 4px 10px; font-size: 0.78rem; font-weight: 600; }
        .csv-import-stat-chip.ok { border-color: rgba(34,197,94,.35); color: #15803d; background: rgba(34,197,94,.08); }
        .csv-import-stat-chip.warn { border-color: rgba(245,158,11,.4); color: #b45309; background: rgba(245,158,11,.12); }
        .csv-import-section-title { display: flex; align-items: center; justify-content: space-between; font-size: 0.82rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .4px; margin-bottom: 8px; }
        .csv-import-preview { margin-bottom: 14px; overflow: auto; border: 1px solid rgba(148, 163, 184, 0.35); border-radius: 10px; background: #fff; }
        .csv-import-preview table { min-width: 650px; }
        .csv-import-mapping-grid { display: grid; grid-template-columns: 1fr; gap: 10px; padding-right: 2px; }
        .csv-import-map-row { display: grid; grid-template-columns: minmax(260px, 1fr) minmax(220px, 320px); gap: 12px; border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 12px; background: #fff; transition: border-color .15s ease, box-shadow .15s ease; }
        .csv-import-map-row:hover { border-color: #cbd5e1; }
        .csv-import-map-row.mapped { border-color: rgba(37,211,102,.45); box-shadow: 0 0 0 2px rgba(37,211,102,.12); }
        .csv-import-col-label { display: flex; flex-direction: column; gap: 4px; min-height: 40px; }
        .csv-import-col-name { font-weight: 700; color: #0f172a; font-size: .9rem; }
        .csv-import-col-sample { color: #64748b; font-size: .8rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; }
        .csv-import-col-control .form-select { width: 100%; }
        .csv-import-col-index { font-size: .72rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: .3px; }
        .csv-import-step { display: none; }
        .csv-import-step.active { display: block; }
        .csv-import-etiquetas-wrap { border: 1px solid #e5e7eb; border-radius: 10px; padding: 12px; background: #fff; }
        .csv-import-etiquetas-input-row { display: flex; gap: 8px; align-items: center; margin-bottom: 10px; }
        .csv-import-etiquetas-results { max-height: 180px; overflow: auto; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff; }
        .csv-import-etiquetas-result-item { padding: 8px 10px; border-bottom: 1px solid #f1f5f9; cursor: pointer; font-size: .85rem; }
        .csv-import-etiquetas-result-item:last-child { border-bottom: none; }
        .csv-import-etiquetas-result-item:hover { background: rgba(108, 99, 255, 0.08); }
        .csv-import-etiquetas-selected { display: flex; gap: 6px; flex-wrap: wrap; margin-top: 10px; min-height: 28px; }
        .csv-import-footer-warning { margin-right: auto; font-size: 0.82rem; font-weight: 600; color: #b91c1c; display: none; }
        .csv-import-footer-warning.show { display: inline-flex; align-items: center; }
        body.dark-mode .csv-import-preview { background: rgba(15, 23, 42, 0.45); border-color: rgba(71, 85, 105, 0.45); }
        body.dark-mode .csv-import-title { color: #e2e8f0; }
        body.dark-mode .csv-import-subtitle { color: #94a3b8; }
        body.dark-mode .csv-import-stat-chip { background: rgba(15,23,42,.55); border-color: rgba(71,85,105,.55); color: #cbd5e1; }
        body.dark-mode .csv-import-stat-chip.ok { color: #86efac; border-color: rgba(34,197,94,.35); background: rgba(34,197,94,.1); }
        body.dark-mode .csv-import-stat-chip.warn { color: #fcd34d; border-color: rgba(245,158,11,.4); background: rgba(245,158,11,.12); }
        body.dark-mode .csv-import-section-title { color: #94a3b8; }
        body.dark-mode .csv-import-map-row { background: rgba(15,23,42,.55); border-color: rgba(71,85,105,.45); }
        body.dark-mode .csv-import-map-row:hover { border-color: rgba(100,116,139,.8); }
        body.dark-mode .csv-import-map-row.mapped { border-color: rgba(37,211,102,.5); box-shadow: 0 0 0 2px rgba(37,211,102,.18); }
        body.dark-mode .csv-import-col-name { color: #e2e8f0; }
        body.dark-mode .csv-import-col-sample,
        body.dark-mode .csv-import-col-index { color: #94a3b8; }
        body.dark-mode .csv-import-etiquetas-wrap,
        body.dark-mode .csv-import-etiquetas-results { background: rgba(15,23,42,.55); border-color: rgba(71,85,105,.5); }
        body.dark-mode .csv-import-etiquetas-result-item { border-color: rgba(71,85,105,.35); color: #e2e8f0; }
        body.dark-mode .csv-import-etiquetas-result-item:hover { background: rgba(37,211,102,.12); }
        body.dark-mode .csv-import-footer-warning { color: #fca5a5; }
        .sync-groups-progress-wrap { margin: 10px 0 14px; display: none; }
        .sync-groups-progress-track { width: 100%; height: 8px; border-radius: 999px; background: rgba(148, 163, 184, 0.25); overflow: hidden; }
        .sync-groups-progress-bar { width: 0%; height: 100%; background: linear-gradient(90deg, #6C63FF, #6C63FF); transition: width 0.2s ease; }
        .sync-groups-progress-text { font-size: 0.78rem; color: #64748b; margin-top: 6px; text-align: right; }
        .color-picker-input { width: 44px; height: 38px; padding: 2px; border-radius: 8px; cursor: pointer; border: 1px solid #e5e7eb !important; outline: none !important; background: transparent; }
        .color-picker-input::-webkit-color-swatch-wrapper { padding: 2px; }
        .color-picker-input::-webkit-color-swatch { border: none; border-radius: 6px; }
        .color-picker-input::-moz-color-swatch { border: none; border-radius: 6px; }
        .phone-row { display: flex; gap: 10px; align-items: stretch; }
        .phone-row .form-select { flex: 0 0 90px; }
        .phone-row .ddd-input { flex: 0 0 70px; }
        .phone-row .phone-input { flex: 1; min-width: 0; }
        .phone-row-single { display: flex; gap: 10px; align-items: stretch; }
        .phone-row-single .phone-ddi {
            flex: 0 0 84px;
            padding-left: 8px;
            padding-right: 24px;
        }
        .phone-row-single .phone-full { flex: 1; min-width: 0; }

        /* ===== ETIQUETAS MULTISELECT ===== */
        .etiquetas-multiselect { position: relative; }
        .etiquetas-multiselect-trigger { min-height: 44px; padding: 8px 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff; cursor: pointer; display: flex; flex-wrap: wrap; gap: 6px; align-items: center; }
        .etiquetas-multiselect-trigger:hover { border-color: #d1d5db; }
        .etiquetas-multiselect-trigger.open { border-color: #6C63FF; outline: none; }
        .etiquetas-multiselect-placeholder { color: #9ca3af; font-size: 0.9rem; }
        .etiquetas-multiselect-dropdown { position: absolute; top: 100%; left: 0; right: 0; margin-top: 4px; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); z-index: 100; max-height: 200px; overflow-y: auto; padding: 8px; display: none; }
        .etiquetas-multiselect-dropdown.open { display: block; }
        .etiquetas-multiselect-option { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 0.78rem; font-weight: 500; cursor: pointer; margin: 3px; border: 2px solid transparent; transition: all 0.2s; }
        .etiquetas-multiselect-option:hover { opacity: 0.9; }
        .etiquetas-multiselect-option.selected { border-color: currentColor; box-shadow: 0 0 0 1px currentColor; }

        /* ===== LIGHT MODE STYLES (from dashboard.html) ===== */
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

        body.light-mode .version-text { color: #999; }
        body.light-mode .menu-badge-admin { background: #6C63FF; color: #fff; }
        body.light-mode .menu-badge-novidade { background: #6C63FF; color: #fff; }

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

        body.light-mode .theme-switch .slider { background-color: #ccc; }
        body.light-mode .theme-switch input:checked + .slider { background-color: #22c55e; }
        body.light-mode .theme-switch .slider:before { background-color: white; }

        body.light-mode .header-info h1 { color: #222; }
        body.light-mode .header-info p { color: #666; }

        body.light-mode .toast-notification { background: rgba(108, 99, 255, 0.15); border-color: rgba(108, 99, 255, 0.3); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); }
        body.light-mode .toast-notification.success { background: rgba(34, 197, 94, 0.15); border-color: rgba(34, 197, 94, 0.3); }
        body.light-mode .toast-notification.error { background: rgba(255, 68, 68, 0.15); border-color: rgba(255, 68, 68, 0.3); }
        body.light-mode .toast-notification.info { background: rgba(255, 193, 7, 0.15); border-color: rgba(255, 193, 7, 0.3); }

        /* ===== DARK MODE - CONTACTS CONTENT ===== */
        body.dark-mode .main-content-wrapper { background: transparent; }
        body.dark-mode .header-info h1 { color: #f8fafc; }
        body.dark-mode .header-info p { color: #94a3b8; }

        /* KPI cards dark mode */
        body.dark-mode .kpi-card { background: rgba(30, 41, 59, 0.6); border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .kpi-card-title { color: #94a3b8; }
        body.dark-mode .kpi-card-value { color: #f8fafc; }

        /* Filter cards dark mode */
        body.dark-mode .filter-card { background: rgba(30, 41, 59, 0.6); border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .filter-card-title { color: #94a3b8; }
        body.dark-mode .filter-date-label { color: #94a3b8; }
        body.dark-mode .filter-date-input { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.5); color: #e2e8f0; }
        /* .filter-crm-select dark: ver <style> após dropdowns-global.css (!important) */

        /* Table dark mode */
        body.dark-mode .contacts-table-container { background: rgba(30, 41, 59, 0.6); border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .contacts-table { background: transparent; }
        body.dark-mode .contacts-table th { background: rgba(15, 23, 42, 0.5); color: #94a3b8; border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .contacts-table th.contacts-th-checkbox { background: rgba(15, 23, 42, 0.5); color-scheme: dark; }
        body.dark-mode .contacts-table td.contacts-td-checkbox { color-scheme: dark; }
        body.dark-mode .contacts-table .contacts-row-checkbox {
            accent-color: #4ade80;
            color-scheme: dark;
        }
        body.dark-mode .contacts-table td { color: #e2e8f0; border-color: rgba(71, 85, 105, 0.3); background: transparent; }
        body.dark-mode .contacts-table tr:hover { background: rgba(108, 99, 255, 0.05); }
        body.dark-mode .contact-name { color: #f8fafc; }
        body.dark-mode .contact-phone { color: #94a3b8; }
        body.dark-mode .contact-date { color: #94a3b8; }
        body.dark-mode .total-count { color: #f8fafc; }

        /* Search dark mode */
        body.dark-mode .search-input { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.5); color: #e2e8f0; }

        /* Etiqueta lateral dark mode */
        body.dark-mode .etiqueta-lateral-item { color: #cbd5e1; border-bottom-color: rgba(71,85,105,0.3); }
        body.dark-mode .etiqueta-lateral-item:hover { background: rgba(37,211,102,0.08); }
        body.dark-mode .etiqueta-lateral-item.active { background: rgba(37,211,102,0.12); }
        body.dark-mode .etiqueta-lateral-name { color: #e2e8f0; }
        body.dark-mode .etiqueta-lateral-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid #64748b;
            border-radius: 5px;
            cursor: pointer;
            flex-shrink: 0;
            accent-color: #6C63FF;
            background-color: rgba(15, 23, 42, 0.85);
            color-scheme: dark;
        }
        body.dark-mode .etiqueta-lateral-checkbox:hover {
            border-color: #94a3b8;
            background-color: rgba(30, 41, 59, 0.9);
        }
        body.dark-mode .etiqueta-lateral-checkbox:focus-visible {
            outline: 2px solid rgba(108, 99, 255, 0.45);
            outline-offset: 2px;
        }
        body.dark-mode .etiqueta-lateral-count { background: rgba(156,163,175,0.2); color: #94a3b8; }
        body.dark-mode .etiqueta-lateral-item.active .etiqueta-lateral-count { background: rgba(37,211,102,0.2); color: #6C63FF; }
        body.dark-mode .etiquetas-empty-msg { color: #94a3b8; }
        body.dark-mode .tipo-filter-tag { background: rgba(15, 23, 42, 0.5); border-color: rgba(71, 85, 105, 0.6); color: #cbd5e1; }
        body.dark-mode .tipo-filter-tag:hover { border-color: #6C63FF; color: #6C63FF; }
        body.dark-mode .tipo-filter-tag.active { background: rgba(108, 99, 255, 0.2); border-color: rgba(108, 99, 255, 0.45); color: #6C63FF; }
        body.dark-mode .contacts-empty-msg { color: #94a3b8; }

        /* Modal dark mode */
        body.dark-mode .modal-box { background: #1e293b; border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .modal-title { color: #f8fafc; }
        body.dark-mode .modal-header { border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .modal-footer { border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .modal-close { color: #64748b; }
        body.dark-mode .modal-close:hover { color: #e2e8f0; }
        body.dark-mode .form-label { color: #94a3b8; }
        body.dark-mode .form-input, body.dark-mode .form-select { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.5); color: #e2e8f0; }
        /* selects .form-select / #chatConnectionSelect / syncGroups: ver <style> após dropdowns-global.css */
        body.dark-mode .color-picker-input { border-color: rgba(71, 85, 105, 0.5) !important; }
        body.dark-mode .etiquetas-multiselect-trigger { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.5); }
        body.dark-mode .etiquetas-multiselect-dropdown { background: #1e293b; border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .etiquetas-multiselect-placeholder { color: #64748b; }

        /* Buttons dark mode */
        body.dark-mode .btn-secondary { background: rgba(51, 65, 85, 0.5); border-color: rgba(71, 85, 105, 0.5); color: #e2e8f0; }
        body.dark-mode .btn-import { background: rgba(51, 65, 85, 0.5); border-color: rgba(71, 85, 105, 0.5); color: #e2e8f0; }
        body.dark-mode .btn-sync-groups { background: rgba(139, 92, 246, 0.18); border-color: rgba(167, 139, 250, 0.45); color: #c4b5fd; }
        body.dark-mode .sync-groups-list { background: rgba(15, 23, 42, 0.45); border-color: rgba(71, 85, 105, 0.5); }
        body.dark-mode .sync-group-item { border-bottom-color: rgba(71, 85, 105, 0.35); }
        body.dark-mode .sync-group-item:hover { background: rgba(108, 99, 255, 0.1); }
        body.dark-mode .sync-group-item.duplicate { background: rgba(245, 158, 11, 0.12); }
        body.dark-mode .sync-group-item.duplicate:hover { background: rgba(245, 158, 11, 0.2); }
        body.dark-mode .sync-group-name { color: #f8fafc; }
        body.dark-mode .sync-groups-count { color: #6C63FF; }
        body.dark-mode .sync-groups-progress-track { background: rgba(71, 85, 105, 0.55); }
        body.dark-mode .sync-groups-progress-text { color: #94a3b8; }
        body.dark-mode .delete-contact-modal-text { color: #cbd5e1; }
        .contact-detail-modal-box {
            width: min(560px, calc(100vw - 40px));
            max-width: 560px;
            min-height: min(520px, 82vh);
            max-height: 88vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .contact-detail-modal-box .modal-header { flex-shrink: 0; align-items: flex-start; gap: 12px; }
        .contact-detail-header-main { flex: 1; min-width: 0; }
        .contact-detail-header-sub { margin: 6px 0 0 0; font-size: 0.9rem; color: #6b7280; font-weight: 500; word-break: break-all; }
        .contact-detail-modal-scroll { flex: 1; min-height: min(360px, 50vh); overflow-y: auto; padding: 0 24px 8px; }
        .contact-detail-modal-box .modal-footer { flex-shrink: 0; }
        .contact-detail-hero { display: flex; align-items: center; gap: 16px; padding: 16px 0 20px; border-bottom: 1px solid #e5e7eb; margin-bottom: 20px; }
        .contact-detail-hero-avatar { width: 56px; height: 56px; min-width: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .contact-detail-hero-avatar.contato:not(.has-photo) { background: rgba(108, 99, 255, 0.12); color: #6C63FF; }
        .contact-detail-hero-avatar.grupo:not(.has-photo) { background: rgba(139, 92, 246, 0.12); color: #7c3aed; }
        .contact-detail-hero-avatar.has-photo { padding: 0; background: #e5e7eb; }
        .contact-detail-hero-photo { width: 100%; height: 100%; object-fit: cover; display: block; }
        .contact-detail-hero-text { min-width: 0; }
        .contact-detail-hero-text .tipo-pill { display: inline-block; margin-top: 6px; padding: 3px 10px; border-radius: 999px; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; }
        .contact-detail-hero-text .tipo-pill.contato { background: rgba(108, 99, 255, 0.12); color: #6C63FF; }
        .contact-detail-hero-text .tipo-pill.grupo { background: rgba(139, 92, 246, 0.12); color: #7c3aed; }
        .contact-detail-card { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px 18px; margin-bottom: 16px; }
        .contact-detail-card-title { font-size: 0.72rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 12px 0; }
        .contact-detail-card-hint { margin: 0 0 12px 0; font-size: 0.85rem; color: #6b7280; line-height: 1.45; }
        .contact-detail-rows { display: flex; flex-direction: column; gap: 12px; }
        .contact-detail-row { display: grid; grid-template-columns: 110px 1fr; gap: 10px 14px; align-items: start; font-size: 0.9rem; }
        .contact-detail-row .cdr-k { margin: 0; color: #9ca3af; font-weight: 500; font-size: 0.8rem; }
        .contact-detail-row .cdr-v { margin: 0; color: #18181b; word-break: break-word; }
        .contact-detail-row .cdr-v a { color: #6C63FF; font-weight: 500; }
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
            position: absolute; left: 0; right: 0; top: calc(100% + 10px); z-index: 10070; background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
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
        .contact-detail-etiqueta-picker .contact-detail-link-new { margin-top: 4px; }
        .contact-detail-etiqueta-empty { padding: 12px; text-align: center; color: #9ca3af; font-size: 0.88rem; line-height: 1.45; }
        .contact-detail-link-new { margin-top: 12px; background: none; border: none; padding: 8px 0; font-size: 0.88rem; font-weight: 600; color: #6C63FF; cursor: pointer; font-family: inherit; display: inline-flex; align-items: center; gap: 6px; }
        .contact-detail-link-new:hover { text-decoration: underline; }
        .contact-detail-crm-item { padding: 12px; border: 1px solid #e5e7eb; border-radius: 10px; margin-bottom: 10px; background: #fff; }
        .contact-detail-crm-item-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; margin-bottom: 4px; }
        .contact-detail-crm-item-head strong { display: block; flex: 1; min-width: 0; font-size: 0.9rem; color: #18181b; margin-bottom: 0; line-height: 1.35; }
        .contact-detail-crm-open-etapas {
            flex-shrink: 0; width: 36px; height: 36px; padding: 0; border: 1px solid #e5e7eb; border-radius: 10px;
            background: #f9fafb; color: #4b5563; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }
        .contact-detail-crm-open-etapas .material-symbols-rounded { font-size: 20px; line-height: 1; }
        .contact-detail-crm-open-etapas:hover { background: rgba(108, 99, 255, 0.1); border-color: rgba(108, 99, 255, 0.35); color: #6C63FF; }
        .contact-detail-crm-open-etapas:focus-visible { outline: 2px solid #6C63FF; outline-offset: 2px; }
        .contact-detail-crm-meta { font-size: 0.85rem; color: #6b7280; }
        .contact-detail-notas-grid { display: flex; flex-direction: column; gap: 14px; }
        .contact-detail-notas-empty { margin: 0; color: #9ca3af; font-size: 0.9rem; line-height: 1.45; }
        .contact-detail-crm-empty { margin: 0; color: #9ca3af; font-size: 0.9rem; line-height: 1.45; }
        .contact-detail-sticky-note {
            padding: 14px 16px 16px 16px;
            border-radius: 12px;
            background: #F9E6BC;
            border: 2px solid #CA8A03;
            box-shadow: 0 1px 2px rgba(202, 138, 3, 0.14);
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
            background: #CA8A03;
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
        .contact-detail-note-body--clamped {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            overflow: hidden;
        }
        .contact-detail-note-expand {
            margin-top: 8px;
            padding: 6px 10px;
            border: none;
            border-radius: 8px;
            background: rgba(202, 138, 3, 0.25);
            color: #7c2d12;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
        }
        .contact-detail-note-expand:hover { background: rgba(202, 138, 3, 0.4); }
        .contact-detail-nota-completa-pre {
            margin: 0;
            font-size: 0.92rem;
            line-height: 1.55;
            white-space: pre-wrap;
            word-break: break-word;
            color: #18181b;
            max-height: min(60vh, 28rem);
            overflow-y: auto;
        }
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
        .contact-detail-msk-row.is-received .contact-detail-msk-bubble { border-bottom-left-radius: 5px; }
        .contact-detail-msk-row.is-sent .contact-detail-msk-bubble { border-bottom-right-radius: 5px; }
        .contact-detail-msk-bubble--sm { width: min(120px, 55%); height: 36px; }
        .contact-detail-msk-bubble--md { width: min(200px, 72%); height: 44px; }
        .contact-detail-msk-bubble--lg { width: min(260px, 85%); height: 52px; }
        .btn-conversar { background: #6C63FF; }
        .btn-conversar:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
        body.dark-mode .contact-detail-header-sub { color: #94a3b8; }
        body.dark-mode .contact-detail-card { background: rgba(30, 41, 59, 0.45); border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .contact-detail-card-title { color: #94a3b8; }
        body.dark-mode .contact-detail-card-hint { color: #94a3b8; }
        body.dark-mode .contact-detail-row .cdr-k { color: #64748b; }
        body.dark-mode .contact-detail-row .cdr-v { color: #f1f5f9; }
        body.dark-mode .contact-detail-etiquetas-empty-hint { color: #94a3b8; }
        body.dark-mode .contact-detail-etiqueta-chip-remove { background: rgba(255, 255, 255, 0.12); color: #000; }
        body.dark-mode .contact-detail-etiqueta-chip-remove:hover { background: rgba(255, 255, 255, 0.2); color: #000; }
        body.dark-mode .contact-detail-etiqueta-add { border-color: rgba(108, 99, 255, 0.4); background: rgba(108, 99, 255, 0.12); color: #6C63FF; }
        body.dark-mode .contact-detail-etiqueta-picker { background: #1e293b; border-color: rgba(71, 85, 105, 0.5); box-shadow: 0 16px 48px rgba(0, 0, 0, 0.45); }
        body.dark-mode .contact-detail-etiqueta-picker-head { color: #94a3b8; }
        body.dark-mode .contact-detail-etiqueta-pick-row { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.45); color: #e2e8f0; }
        body.dark-mode .contact-detail-etiqueta-pick-row:hover { background: rgba(108, 99, 255, 0.1); border-color: rgba(108, 99, 255, 0.4); }
        body.dark-mode .contact-detail-etiqueta-pick-row.is-on { background: rgba(108, 99, 255, 0.15); border-color: rgba(108, 99, 255, 0.5); }
        .contact-detail-cp-bar { display: flex; flex-wrap: wrap; align-items: flex-start; gap: 10px; margin-top: 4px; }
        .contact-detail-cp-list { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 10px; }
        .contact-detail-scroll-max-5-cp {
            max-height: 22.5rem;
            overflow-y: auto;
            padding-right: 6px;
            -webkit-overflow-scrolling: touch;
        }
        .contact-detail-notas-scroll {
            display: flex;
            flex-direction: column;
            gap: 14px;
            max-height: 32rem;
            overflow-y: auto;
            padding-right: 6px;
            -webkit-overflow-scrolling: touch;
        }
        .contact-detail-crm-scroll {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 30rem;
            overflow-y: auto;
            padding-right: 6px;
            -webkit-overflow-scrolling: touch;
        }
        .contact-detail-crm-scroll .contact-detail-crm-item {
            margin-bottom: 0;
            align-self: flex-start;
            width: 100%;
        }
        .contact-detail-crm-toprow {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .contact-detail-crm-meta--grow { flex: 1; min-width: 0; margin: 0; }
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
        body.dark-mode .contact-detail-cp-row { background: rgba(15, 23, 42, 0.55); border-color: rgba(71, 85, 105, 0.45); }
        body.dark-mode .contact-detail-cp-row-k { color: #e2e8f0; }
        body.dark-mode .contact-detail-cp-row-v { color: #f1f5f9; }
        body.dark-mode .contact-detail-cp-edit { background: rgba(255,255,255,0.08); color: #94a3b8; }
        body.dark-mode .contact-detail-cp-remove { background: rgba(255,255,255,0.08); color: #94a3b8; }
        #modalCampoValorDynamicMount .form-input, #modalCampoValorDynamicMount .form-select { width: 100%; }
        body.dark-mode .contact-detail-etiqueta-empty { color: #94a3b8; }
        body.dark-mode .contact-detail-hero { border-bottom-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .contact-detail-crm-item { background: rgba(15, 23, 42, 0.4); border-color: rgba(71, 85, 105, 0.4); }
        body.dark-mode .contact-detail-crm-item-head strong { color: #f8fafc; }
        body.dark-mode .contact-detail-crm-open-etapas { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.5); color: #94a3b8; }
        body.dark-mode .contact-detail-crm-open-etapas:hover { background: rgba(108, 99, 255, 0.12); border-color: rgba(108, 99, 255, 0.4); color: #6C63FF; }
        body.dark-mode .contact-detail-crm-meta { color: #94a3b8; }
        body.dark-mode .contact-detail-notas-empty { color: #94a3b8; }
        body.dark-mode .contact-detail-crm-empty { color: #94a3b8; }
        body.dark-mode .contact-detail-sticky-note {
            background: rgba(249, 230, 188, 0.12);
            border-color: #CA8A03;
            box-shadow: none;
        }
        body.dark-mode .contact-detail-note-conexao { color: #fbbf24; }
        body.dark-mode .contact-detail-note-conexao-dot { background: #CA8A03; }
        body.dark-mode .contact-detail-note-body { color: #F9E6BC; }
        body.dark-mode .contact-detail-note-expand { background: rgba(251, 191, 36, 0.2); color: #F9E6BC; }
        body.dark-mode .contact-detail-note-expand:hover { background: rgba(251, 191, 36, 0.32); }
        body.dark-mode .contact-detail-nota-completa-pre { color: #f1f5f9; }
        body.dark-mode .contact-detail-msk-avatar,
        body.dark-mode .contact-detail-msk-bubble {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Row menu dark mode */
        body.dark-mode .row-menu-dropdown { background: #1e293b; border-color: rgba(71, 85, 105, 0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.4); }
        body.dark-mode .row-menu-dropdown button { color: #e2e8f0; }
        body.dark-mode .row-menu-dropdown button:hover { background: rgba(37,211,102,0.15); color: #6C63FF; }
        body.dark-mode .row-menu-btn { color: #64748b; }

        /* Section dark mode */
        body.dark-mode .section { background: rgba(30, 41, 59, 0.6); border-color: rgba(71, 85, 105, 0.4); box-shadow: none; }
        body.dark-mode .section-header { border-bottom-color: rgba(71, 85, 105, 0.4); }

        /* Skeleton dark mode */
        body.dark-mode .skeleton-row .skeleton-line { background: linear-gradient(90deg, #2a2a2a 0%, #3d3d3d 35%, #2a2a2a 70%, #353535 100%); background-size: 200% 100%; }

        /* Avatar dark mode */
        body.dark-mode .contact-avatar.grupo:not(.has-photo) { background: rgba(139, 92, 246, 0.2); color: #a78bfa; }
        body.dark-mode .contact-avatar.contato:not(.has-photo) { background: rgba(108, 99, 255, 0.2); color: #6C63FF; }
        body.dark-mode .contact-avatar.has-photo,
        body.dark-mode .contact-detail-hero-avatar.has-photo { background: rgba(30, 41, 59, 0.85); }
        body.dark-mode .contact-detail-hero-avatar.contato:not(.has-photo) { background: rgba(108, 99, 255, 0.2); color: #6C63FF; }
        body.dark-mode .contact-detail-hero-avatar.grupo:not(.has-photo) { background: rgba(139, 92, 246, 0.2); color: #a78bfa; }
        body.dark-mode .tipo-badge.contato { background: rgba(108, 99, 255, 0.2); color: #6C63FF; }
        body.dark-mode .tipo-badge.grupo { background: rgba(139, 92, 246, 0.2); color: #a78bfa; }

        /* Action btn dark mode */
        body.dark-mode .action-btn { color: #64748b; }
        body.dark-mode .action-btn:hover { background: rgba(255,255,255,0.08); color: #e2e8f0; }
        body.dark-mode .action-btn.edit:hover { color: #6C63FF; }
        body.dark-mode .action-btn.delete:hover { color: #ff4444; }

        /* Filters row dark mode */
        body.dark-mode .filters-row .search-input { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.5); color: #e2e8f0; }
        body.dark-mode .filters-row select { background: rgba(15, 23, 42, 0.6); border-color: rgba(71, 85, 105, 0.5); color: #e2e8f0; }

        /* ===== MOBILE RESPONSIVE (from dashboard.html) ===== */
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

            .sidebar.mobile-open .sidebar-logo-link {
                width: 100% !important;
                min-width: 180px !important;
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


            .mobile-close-btn {
                display: flex;
            }

            .mobile-close-btn:hover {
                background: rgba(108, 99, 255, 0.2);
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

            .main-content-wrapper { margin-left: 0 !important; width: 100vw; padding-top: 60px; padding: 8px; }
            .container { padding: 0 16px; }
            .header { flex-direction: column; align-items: flex-start; }
            .header-info h1 { font-size: 1.75rem; }
            .kpi-grid { grid-template-columns: 1fr; }
            .filters-row { flex-direction: column; align-items: stretch; }
            .content-with-lateral { flex-direction: column; }
            .filters-sidebar { width: 100%; flex-direction: row; flex-wrap: wrap; gap: 12px; }
            .filters-sidebar .filter-card { flex: 1; min-width: 200px; }
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
        body.dark-mode .etiquetas-multiselect-dropdown,
        body:not(.light-mode) .etiquetas-multiselect-dropdown,
        .etiquetas-multiselect-dropdown {
            background: #ffffff !important;
            color: #000000 !important;
            border-color: rgba(0, 0, 0, 0.15) !important;
        }
        body.dark-mode .etiquetas-multiselect-dropdown label,
        body:not(.light-mode) .etiquetas-multiselect-dropdown label,
        body.dark-mode .etiquetas-multiselect-dropdown span,
        body:not(.light-mode) .etiquetas-multiselect-dropdown span {
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
        .toast-container { position: fixed !important; top: max(20px, env(safe-area-inset-top, 0px)) !important; left: 50% !important; right: auto !important; transform: translateX(-50%) !important; z-index: 200100 !important; display: flex !important; flex-direction: column !important; align-items: stretch !important; gap: 8px !important; width: min(380px, calc(100vw - 28px)) !important; pointer-events: none !important; box-sizing: border-box !important; }
        .toast-notification { pointer-events: auto !important; margin: 0 !important; padding: 10px 14px 10px 0 !important; border-radius: 12px !important; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-size: 13px !important; line-height: 1.35 !important; letter-spacing: -0.01em !important; font-weight: 400 !important; display: flex !important; align-items: center !important; gap: 0 !important; opacity: 0 !important; transform: translateY(-8px) scale(0.98) !important; transition: opacity 0.22s ease, transform 0.22s ease !important; color: rgba(0,0,0,.88) !important; background: rgba(255,255,255,.76) !important; backdrop-filter: saturate(180%) blur(22px) !important; -webkit-backdrop-filter: saturate(180%) blur(22px) !important; border: 1px solid rgba(0,0,0,.09) !important; box-shadow: 0 4px 16px rgba(0,0,0,.1), 0 0 0 .5px rgba(0,0,0,.04) inset !important; max-width: none !important; }
        .toast-notification.show { opacity: 1 !important; transform: translateY(0) scale(1) !important; }
        .toast-notification::before { content: '' !important; align-self: stretch !important; width: 4px !important; min-height: 2.5em !important; margin: 6px 12px 6px 8px !important; border-radius: 3px !important; flex-shrink: 0 !important; background: rgba(0,122,255,.95) !important; }
        .toast-notification.info::before { background: rgba(0,122,255,.95) !important; }
        .toast-notification.success::before { background: rgba(52,199,89,.95) !important; }
        .toast-notification.error::before { background: rgba(255,59,48,.95) !important; }
        .toast-notification .toast-message { flex: 1 !important; min-width: 0 !important; word-break: break-word !important; padding-right: 4px !important; }
        body.dark-mode .toast-notification { color: rgba(255,255,255,.92) !important; background: rgba(44,44,46,.78) !important; border: 1px solid rgba(255,255,255,.12) !important; box-shadow: 0 8px 28px rgba(0,0,0,.45), 0 0 0 .5px rgba(255,255,255,.06) inset !important; }
        body.dark-mode .toast-notification.info::before { background: rgba(10,132,255,.95) !important; }
        body.dark-mode .toast-notification.success::before { background: rgba(48,209,88,.95) !important; }
        body.dark-mode .toast-notification.error::before { background: rgba(255,69,58,.95) !important; }
    </style>
    <link rel="stylesheet" href="dropdowns-global.css">
    <!-- Depois de dropdowns-global.css: .form-select e modal sincronizar grupos no dark -->
    <style>
        body.dark-mode .form-select,
        body.dark-mode select.form-select,
        body.dark-mode #syncGroupsConnectionSelect,
        body.dark-mode #syncGroupsModal select {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: rgba(15, 23, 42, 0.75) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 12px center !important;
            border: 1px solid rgba(71, 85, 105, 0.55) !important;
            border-radius: 8px !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            padding: 10px 36px 10px 14px !important;
            font-size: 0.95rem !important;
            font-family: inherit !important;
        }

        body.dark-mode .form-select:hover,
        body.dark-mode select.form-select:hover {
            border-color: rgba(100, 116, 139, 0.65) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
        }

        body.dark-mode .form-select:focus,
        body.dark-mode select.form-select:focus {
            outline: none !important;
            border-color: rgba(108, 99, 255, 0.55) !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.18) !important;
        }

        body.dark-mode .form-select option,
        body.dark-mode select.form-select option,
        body.dark-mode #syncGroupsModal select option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .phone-row .form-select,
        body.dark-mode .phone-row-single .phone-ddi {
            padding-left: 8px !important;
            padding-right: 28px !important;
            background-position: right 8px center !important;
        }

        /* DDI do modal novo contato (coluna estreita) */
        body.dark-mode #addContactDDI,
        body.dark-mode #addContactModal select.phone-ddi {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: rgba(15, 23, 42, 0.75) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 6px center !important;
            background-size: 10px 10px !important;
            border: 1px solid rgba(71, 85, 105, 0.55) !important;
            border-radius: 8px !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            padding: 10px 20px 10px 6px !important;
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            min-width: 0 !important;
        }

        body.dark-mode #addContactDDI:hover,
        body.dark-mode #addContactModal select.phone-ddi:hover {
            border-color: rgba(100, 116, 139, 0.65) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
        }

        body.dark-mode #addContactDDI:focus,
        body.dark-mode #addContactModal select.phone-ddi:focus {
            outline: none !important;
            border-color: rgba(108, 99, 255, 0.55) !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.18) !important;
        }

        body.dark-mode #addContactDDI option,
        body.dark-mode #addContactModal select.phone-ddi option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #chatConnectionSelect {
            background-color: rgba(15, 23, 42, 0.75) !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            border-color: rgba(71, 85, 105, 0.55) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 12px center !important;
            padding-right: 36px !important;
        }

        body.dark-mode #chatConnectionSelect option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }

        /* Filtro CRM (sidebar): dropdowns-global.css força select branco — mesma abordagem que .form-select */
        body.dark-mode .filter-crm-select,
        body.dark-mode #crmQuadroFilter,
        body.dark-mode #crmEtapaFilter {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: #0f172a !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 12px center !important;
            background-size: 16px 16px !important;
            border: 1px solid rgba(71, 85, 105, 0.75) !important;
            border-radius: 8px !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            padding: 10px 40px 10px 12px !important;
            font-size: 0.9rem !important;
            font-family: inherit !important;
            cursor: pointer !important;
        }
        body.dark-mode .filter-crm-select:hover,
        body.dark-mode #crmQuadroFilter:hover,
        body.dark-mode #crmEtapaFilter:hover {
            border-color: rgba(100, 116, 139, 0.7) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") !important;
        }
        body.dark-mode .filter-crm-select:focus,
        body.dark-mode #crmQuadroFilter:focus,
        body.dark-mode #crmEtapaFilter:focus {
            outline: none !important;
            border-color: rgba(108, 99, 255, 0.55) !important;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.22) !important;
        }
        body.dark-mode .filter-crm-select option,
        body.dark-mode #crmQuadroFilter option,
        body.dark-mode #crmEtapaFilter option {
            background-color: #ffffff !important;
            color: #0f172a !important;
            -webkit-text-fill-color: #0f172a !important;
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
        <!-- SIDEBAR (from dashboard.html, contatos active) -->
        <div class="sidebar" id="sidebar">
            <!-- Botao de fechar para mobile -->
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
                <a href="#" class="menu-item" data-menu-id="crm">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">view_kanban</span>
                    </span>
                    <span class="menu-text">CRM</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="conexoes">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">qr_code</span>
                    </span>
                    <span class="menu-text">Conexoes</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="disparos">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">send</span>
                    </span>
                    <span class="menu-text">Disparos</span>
                </a>
                <a href="#" class="menu-item active" data-menu-id="contatos">
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
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </span>
                    <span class="menu-text">Configuracoes</span>
                </a>
                <a href="#" id="menu-item-admin" class="menu-item menu-item-admin" style="display: none;">
                    <span class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </span>
                    <span class="menu-text">Administracao</span>
                    <span class="menu-badge-admin">Admin</span>
                </a>
            </nav>
            <div class="version-text" id="versaoAtualTexto">Versao atual: -</div>
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

        <!-- MAIN CONTENT -->
        <div class="main-content-wrapper">
            <div class="container">
                <!-- Header -->
                <div class="header">
                    <div class="header-info">
                        <h1>Base de Contatos</h1>
                        <p>Gerencie, filtre e organize todos os contatos da sua conta.</p>
                    </div>
                    <div style="display:flex;gap:12px;align-items:center;">
                        <button type="button" class="btn btn-import" id="syncGroupsContactsBtn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6"></path><path d="M1 20v-6h6"></path><path d="M3.5 9a9 9 0 0 1 14.13-3.36L23 10"></path><path d="M20.5 15a9 9 0 0 1-14.13 3.36L1 14"></path></svg>
                            Sincronizar Grupos
                        </button>
                        <button type="button" class="btn btn-import">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            Importar CSV
                        </button>
                        <input type="file" id="csvFileInput" accept=".csv" style="display:none">
                        <button type="button" class="btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Novo Contato
                        </button>
                    </div>
                </div>

                <!-- KPI Cards -->
                <div class="kpi-grid">
                    <div class="kpi-card">
                        <div class="kpi-card-header">
                            <span class="kpi-card-title">TOTAL DE CONTATOS (TIPO CONTATO)</span>
                            <div class="kpi-card-icon kpi-icon-users">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                        </div>
                        <div class="kpi-card-value" id="kpiTotal">0</div>
                        <span class="kpi-card-sub" id="kpiTotalHint" style="display:block;min-height:1.2em;margin-top:6px;"></span>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-card-header">
                            <span class="kpi-card-title">NOVOS (ULTIMOS 7 DIAS)</span>
                            <div class="kpi-card-icon kpi-icon-trend">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                            </div>
                        </div>
                        <div style="display:flex;align-items:baseline;gap:8px;">
                            <div class="kpi-card-value kpi-value-blue" id="kpiNew7d">0</div>
                            <span class="kpi-badge-blue" id="kpiBadge7d" style="display:none;">+0%</span>
                        </div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-card-header">
                            <span class="kpi-card-title">TOTAL DE GRUPOS</span>
                            <div class="kpi-card-icon kpi-icon-tag">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                            </div>
                        </div>
                        <div style="display:flex;align-items:baseline;gap:8px;">
                            <div class="kpi-card-value" id="kpiGroups">0</div>
                            <span class="kpi-card-sub">grupos na base</span>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="search-bar-container">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="searchFilter" class="search-input" placeholder="Buscar por nome, telefone ou e-mail...">
                </div>

                <!-- Modals -->
                <div class="modal-overlay" id="addContactModal">
                    <div class="modal-box">
                        <div class="modal-header">
                            <h2 class="modal-title" id="addContactModalTitle">Adicionar contato</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="addContactNome">Nome</label>
                                <input type="text" id="addContactNome" class="form-input" placeholder="Nome do contato">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="addContactPhone">Telefone <span class="required">*</span></label>
                                <div class="phone-row-single">
                                    <select id="addContactDDI" class="form-select phone-ddi">
                                        <option value="55" selected>+55</option>
                                        <option value="1">+1</option>
                                        <option value="54">+54</option>
                                        <option value="351">+351</option>
                                        <option value="34">+34</option>
                                        <option value="49">+49</option>
                                        <option value="33">+33</option>
                                        <option value="44">+44</option>
                                        <option value="39">+39</option>
                                        <option value="52">+52</option>
                                        <option value="56">+56</option>
                                        <option value="57">+57</option>
                                        <option value="598">+598</option>
                                        <option value="595">+595</option>
                                    </select>
                                    <input type="text" id="addContactPhone" class="form-input phone-full" placeholder="48 99999-9999" inputmode="numeric">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="addContactEmail">E-mail</label>
                                <input type="email" id="addContactEmail" class="form-input" placeholder="email@exemplo.com">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Etiquetas</label>
                                <div class="etiquetas-multiselect" id="etiquetasMultiselect">
                                    <div class="etiquetas-multiselect-trigger" id="etiquetasMultiselectTrigger">
                                        <span class="etiquetas-multiselect-placeholder" id="etiquetasMultiselectPlaceholder">Selecionar etiquetas</span>
                                        <div id="etiquetasMultiselectTags"></div>
                                    </div>
                                    <div class="etiquetas-multiselect-dropdown" id="etiquetasMultiselectDropdown"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn" id="addContactSaveBtn">Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="etiquetaModal" style="z-index:10080;">
                    <div class="modal-box" style="max-width:400px;">
                        <div class="modal-header">
                            <h2 class="modal-title" id="etiquetaModalTitle">Criar etiqueta</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="etiquetaNome">Nome <span class="required">*</span></label>
                                <input type="text" id="etiquetaNome" class="form-input" placeholder="Nome da etiqueta">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="etiquetaDescricao">Descricao</label>
                                <input type="text" id="etiquetaDescricao" class="form-input" placeholder="Descricao (opcional)">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="etiquetaCor">Cor</label>
                                <div style="display:flex;gap:10px;align-items:center;">
                                    <input type="color" id="etiquetaCorPicker" class="color-picker-input" value="#6C63FF">
                                    <input type="text" id="etiquetaCor" class="form-input" placeholder="#6C63FF" value="#6C63FF" style="flex:1;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn" id="etiquetaModalSaveBtn">Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="deleteContactModal" style="z-index:10050;">
                    <div class="modal-box" style="max-width:420px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Excluir contato</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="deleteContactModalMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="deleteContactCancelBtn">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="deleteContactConfirmBtn">Excluir</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkAddEtiquetaModal" style="z-index:10052;">
                    <div class="modal-box" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Adicionar etiqueta</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkAddEtiquetaSubtitle" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkAddEtiquetaSelect">Etiqueta</label>
                                <select id="bulkAddEtiquetaSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn" id="bulkAddEtiquetaConfirmBtn">Aplicar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkRemoveEtiquetaModal" style="z-index:10052;">
                    <div class="modal-box" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Remover etiqueta</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkRemoveEtiquetaSubtitle" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkRemoveEtiquetaSelect">Etiqueta a remover</label>
                                <select id="bulkRemoveEtiquetaSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn" id="bulkRemoveEtiquetaConfirmBtn">Remover</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkClearCampoModal" style="z-index:10052;">
                    <div class="modal-box" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Limpar campo personalizado</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkClearCampoSubtitle" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkClearCampoSelect">Campo</label>
                                <select id="bulkClearCampoSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="bulkClearCampoConfirmBtn">Limpar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkDeleteManyModal" style="z-index:10052;">
                    <div class="modal-box" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Excluir contatos</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkDeleteManyMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="bulkDeleteManyCancelBtn">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="bulkDeleteManyConfirmBtn">Excluir</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkRemoveCrmModal" style="z-index:10052;">
                    <div class="modal-box" style="max-width:480px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Remover do CRM</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkRemoveCrmMessage" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkRemoveCrmQuadroSelect">Quadro (CRM)</label>
                                <select id="bulkRemoveCrmQuadroSelect" class="form-select"></select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="bulkRemoveCrmEtapaSelect">Etapa</label>
                                <select id="bulkRemoveCrmEtapaSelect" class="form-select"></select>
                            </div>
                            <p class="delete-contact-modal-text" style="font-size:0.85rem;margin-top:8px;opacity:0.92;">Com um quadro e &quot;Todas as etapas&quot;, remove apenas daquele quadro. Com &quot;Todos os quadros&quot;, remove em todos os CRMs (a etapa permanece em &quot;Todas&quot;).</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="bulkRemoveCrmCancelBtn">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="bulkRemoveCrmConfirmBtn">Remover cards</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkLinkCrmModal" style="z-index:10052;">
                    <div class="modal-box" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Vincular em CRM</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkLinkCrmSubtitle" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkLinkCrmQuadroSelect">Quadro</label>
                                <select id="bulkLinkCrmQuadroSelect" class="form-select"></select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="bulkLinkCrmEtapaSelect">Etapa inicial</label>
                                <select id="bulkLinkCrmEtapaSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn" id="bulkLinkCrmConfirmBtn">Vincular</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="modalCampoPersonalizadoValor" style="z-index:10065;">
                    <div class="modal-box" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title" id="modalCampoPersonalizadoTitulo">Atribuir campo</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="modalCampoValorSelect">Campo</label>
                                <select id="modalCampoValorSelect" class="form-select"></select>
                            </div>
                            <div class="form-group" id="modalCampoValorDynamicWrap">
                                <label class="form-label" for="modalCampoValorInputText" id="modalCampoValorValueLabel">Valor</label>
                                <div id="modalCampoValorDynamicMount">
                                    <input type="text" id="modalCampoValorInputText" class="form-input" placeholder="Digite o valor">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn" id="modalCampoValorSalvarBtn">Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="modalNotaCompletaContatoOverlay" style="z-index:10067;">
                    <div class="modal-box" style="max-width:520px;">
                        <div class="modal-header">
                            <h2 class="modal-title" id="modalNotaCompletaContatoTitulo">Nota</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <pre class="contact-detail-nota-completa-pre" id="modalNotaCompletaContatoBody"></pre>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Fechar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="contactDetailModal" style="z-index:10060;">
                    <div class="modal-box contact-detail-modal-box">
                        <div class="modal-header">
                            <div class="contact-detail-header-main">
                                <h2 class="modal-title" id="contactDetailModalTitle">Contato</h2>
                                <p class="contact-detail-header-sub" id="contactDetailModalSubtitle"></p>
                            </div>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="contact-detail-modal-scroll" id="contactDetailModalBody"></div>
                        <div class="modal-footer" style="justify-content:space-between;flex-wrap:wrap;gap:10px;">
                            <button type="button" class="btn btn-secondary">Fechar</button>
                            <button type="button" class="btn btn-conversar" id="contactDetailConversarBtn">Conversar</button>
                        </div>
                    </div>
                </div>
                <div class="modal-overlay" id="chatConnectionModal" style="z-index:10070;">
                    <div class="modal-box" style="max-width:420px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Escolher conexao</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" style="margin-bottom:10px;">Com qual conexao de WhatsApp deseja conversar?</p>
                            <select id="chatConnectionSelect" class="form-select"></select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn btn-conversar" id="chatConnectionConfirmBtn">Conversar</button>
                        </div>
                    </div>
                </div>
                <div class="modal-overlay" id="syncGroupsModal" style="z-index:10090;">
                    <div class="modal-box" style="max-width:680px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Sincronizar grupos</h2>
                            <button type="button" class="modal-close" id="closeSyncGroupsModalBtn" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="syncGroupsConnectionSelect">Escolha uma conexao *</label>
                                <select id="syncGroupsConnectionSelect" class="form-select">
                                    <option value="">Selecione...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn" id="syncGroupsFetchBtn" disabled>Puxar grupos</button>
                            </div>
                            <div class="sync-groups-progress-wrap" id="syncGroupsProgressWrap">
                                <div class="sync-groups-progress-track">
                                    <div class="sync-groups-progress-bar" id="syncGroupsProgressBar"></div>
                                </div>
                                <div class="sync-groups-progress-text" id="syncGroupsProgressText">Puxando grupos... 0%</div>
                            </div>
                            <div id="syncGroupsResultsWrap" style="display:none;">
                                <div class="form-group">
                                    <input type="text" id="syncGroupsSearchInput" class="form-input" placeholder="Pesquisar grupos...">
                                </div>
                                <div class="sync-groups-list-header">
                                    <div class="sync-groups-count" id="syncGroupsCount">0 grupos encontrados</div>
                                    <div class="sync-groups-actions">
                                        <button type="button" class="btn-link-inline" id="syncGroupsSelectAllBtn">Selecionar todos</button>
                                        <button type="button" class="btn-link-inline" id="syncGroupsUnselectAllBtn">Desmarcar todos</button>
                                    </div>
                                </div>
                                <div class="sync-groups-list" id="syncGroupsList"></div>
                            </div>
                            <div class="sync-groups-message" id="syncGroupsMessage"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="syncGroupsCancelBtn">Cancelar</button>
                            <button type="button" class="btn" id="syncGroupsSaveBtn" style="display:none;">Salvar</button>
                        </div>
                    </div>
                </div>
                <div class="modal-overlay" id="csvImportModal" style="z-index:10100;">
                    <div class="modal-box" style="max-width:920px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Mapear colunas do CSV</h2>
                            <button type="button" class="modal-close" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div id="csvImportStep1" class="csv-import-step active">
                                <div class="csv-import-header">
                                    <div class="csv-import-title">Mapeamento inteligente de colunas</div>
                                    <div class="csv-import-subtitle">Defina como cada coluna do CSV deve ser salva no sistema. Para importar, e necessario mapear ao menos uma coluna como Telefone.</div>
                                </div>
                                <div class="csv-import-stats" id="csvImportStats">
                                    <span class="csv-import-stat-chip" id="csvImportStatsColumns">0 colunas no CSV</span>
                                    <span class="csv-import-stat-chip warn" id="csvImportStatsPhone">Telefone nao mapeado</span>
                                    <span class="csv-import-stat-chip" id="csvImportStatsMapped">0 colunas mapeadas</span>
                                </div>
                                <div class="csv-import-section-title"><span>Previa dos dados</span></div>
                                <div id="csvImportPreviewWrap" class="csv-import-preview"></div>
                                <div class="csv-import-section-title"><span>Mapeamento de campos</span></div>
                                <div id="csvImportMappingGrid" class="csv-import-mapping-grid"></div>
                            </div>
                            <div id="csvImportStep2" class="csv-import-step">
                                <div class="csv-import-header">
                                    <div class="csv-import-title">Adicionar etiqueta em contatos</div>
                                    <div class="csv-import-subtitle">Pesquise etiquetas existentes, selecione varias e use + para criar uma nova com o texto digitado.</div>
                                </div>
                                <div class="csv-import-etiquetas-wrap">
                                    <div class="csv-import-etiquetas-input-row">
                                        <input type="text" id="csvImportEtiquetaInput" class="form-input" placeholder="Digite para pesquisar etiquetas...">
                                        <button type="button" class="btn" id="csvImportCreateEtiquetaBtn" title="Criar etiqueta">+</button>
                                    </div>
                                    <div id="csvImportEtiquetasResults" class="csv-import-etiquetas-results"></div>
                                    <div id="csvImportEtiquetasSelected" class="csv-import-etiquetas-selected"></div>
                                </div>
                            </div>
                            <div class="sync-groups-message" id="csvImportMessage" style="margin-top:12px;"></div>
                        </div>
                        <div class="modal-footer">
                            <span id="csvImportFooterWarning" class="csv-import-footer-warning">Mapeie o Telefone para continuar</span>
                            <button type="button" class="btn btn-secondary">Cancelar</button>
                            <button type="button" class="btn btn-secondary" id="csvImportBackBtn" style="display:none;">Voltar</button>
                            <button type="button" class="btn" id="csvImportContinueBtn">Continuar</button>
                            <button type="button" class="btn" id="csvImportConfirmBtn" style="display:none;">Importar contatos</button>
                        </div>
                    </div>
                </div>

                <!-- Content with lateral filters -->
                <div class="content-with-lateral">
                    <aside class="filters-sidebar">
                        <div class="filter-card">
                            <div class="filter-card-title">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                Data de criacao
                            </div>
                            <div class="filter-date-row">
                                <label class="filter-date-label">A partir de:</label>
                                <div class="filter-date-wrap">
                                    <svg class="calendar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <input type="text" id="dateFrom" class="filter-date-input" placeholder="dd/mm/aaaa" maxlength="10">
                                </div>
                            </div>
                            <div class="filter-date-row">
                                <label class="filter-date-label">Ate:</label>
                                <div class="filter-date-wrap">
                                    <svg class="calendar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <input type="text" id="dateTo" class="filter-date-input" placeholder="dd/mm/aaaa" maxlength="10">
                                </div>
                            </div>
                        </div>
                        <div class="filter-card">
                            <div class="filter-card-title">
                                <span style="display:flex;align-items:center;gap:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>Etiquetas</span>
                                <button type="button" class="etiqueta-add-btn" title="Criar etiqueta"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
                            </div>
                            <div class="etiquetas-lateral-list" id="etiquetasLateralList"></div>
                        </div>
                        <div class="filter-card">
                            <div class="filter-card-title">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Tipo
                                </span>
                            </div>
                            <div class="tipo-filter-tags">
                                <span class="tipo-filter-tag active" id="tipoContatoFilterTag">Contato</span>
                                <span class="tipo-filter-tag active" id="tipoGrupoFilterTag">Grupo</span>
                            </div>
                        </div>
                        <div class="filter-card">
                            <div class="filter-card-title">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><rect x="3" y="3" width="7" height="7" rx="1"></rect><rect x="14" y="3" width="7" height="7" rx="1"></rect><rect x="3" y="14" width="7" height="7" rx="1"></rect><rect x="14" y="14" width="7" height="7" rx="1"></rect></svg>
                                    CRM
                                </span>
                            </div>
                            <label class="filter-date-label" for="crmQuadroFilter">Quadro</label>
                            <select id="crmQuadroFilter" class="filter-crm-select">
                                <option value="">Todos os quadros</option>
                            </select>
                            <div id="crmEtapaFilterWrap" class="crm-etapa-filter-wrap" style="display:none;">
                                <label class="filter-date-label" for="crmEtapaFilter">Etapa</label>
                                <select id="crmEtapaFilter" class="filter-crm-select">
                                    <option value="">Todas as etapas</option>
                                </select>
                            </div>
                        </div>
                    </aside>
                    <input type="hidden" id="etiquetaFilter" value="">
                    <div class="contacts-main">
                        <div class="top-bar">
                            <span class="total-count" id="totalCount">Mostrando 0 contatos</span>
                            <div id="contactsBulkBar" class="contacts-bulk-bar" aria-live="polite">
                                <div class="contacts-bulk-summary">
                                    <span id="contactsBulkCount" class="contacts-bulk-count"></span>
                                    <button type="button" class="contacts-bulk-link-all" id="contactsBulkSelectAllFilteredBtn" title="Selecionar todos os contatos que aparecem com os filtros atuais">Selecionar todos</button>
                                </div>
                                <div class="contacts-bulk-dropdown-wrap">
                                    <button type="button" class="contacts-bulk-actions-btn" id="contactsBulkActionsBtn">
                                        Ações em massa
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </button>
                                    <div id="contactsBulkMenu" class="contacts-bulk-menu" role="menu">
                                        <button type="button" role="menuitem">Adicionar etiqueta</button>
                                        <button type="button" role="menuitem">Remover etiqueta</button>
                                        <button type="button" role="menuitem">Limpar campo personalizado</button>
                                        <button type="button" role="menuitem">Adicionar campo personalizado</button>
                                        <button type="button" role="menuitem">Excluir contato</button>
                                        <button type="button" role="menuitem">Remover do CRM</button>
                                        <button type="button" role="menuitem">Vincular em CRM</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contacts-table-container">
                            <table class="contacts-table">
                                <thead>
                                    <tr>
                                        <th class="contacts-th-checkbox">
                                            <input type="checkbox" class="contacts-row-checkbox" id="contactsSelectAllPage" title="Marca todos desta página; desmarcar limpa toda a seleção" aria-label="Selecionar todos os contatos desta página ou limpar toda a seleção">
                                        </th>
                                        <th style="width: 26%;">Nome / Telefone</th>
                                        <th style="width: 12%;">Tipo</th>
                                        <th style="width: 30%;">Etiquetas</th>
                                        <th style="width: 14%;">Criado em</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody id="contactsTableBody"></tbody>
                            </table>
                        </div>
                        <div id="contactsPagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<!-- scripts removidos para manter somente HTML + CSS -->

<script src="/hublabel/public/assets/js/menu-global.js"></script>

</body>
</html>