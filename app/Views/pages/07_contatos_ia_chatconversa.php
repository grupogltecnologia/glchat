<?php
// Tela extraída do n8n. Próximo passo: separar CSS/JS e substituir chamadas por APIs PHP.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
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
    <script type="module">
        import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2.95.0/+esm';
        const SUPABASE_URL = 'https://qlennkosykcblbhpbmqt.supabase.co';
        const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFsZW5ua29zeWtjYmxiaHBibXF0Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3Njc5NjY3MjQsImV4cCI6MjA4MzU0MjcyNH0.r_A91BCKivKMPqraRBvFn30ln-G1us1_Q7m6kDCeeN0';
        window.supabase = createClient(SUPABASE_URL, SUPABASE_ANON_KEY, { auth: { persistSession: true, autoRefreshToken: true, detectSessionInUrl: false } });
    </script>
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
        <!-- SIDEBAR (from dashboard.html, contatos active) -->
        <div class="sidebar" id="sidebar">
            <!-- Botao de fechar para mobile -->
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
                <a href="#" class="menu-item" data-menu-id="dashboard" onclick="navigateToPage('/hublabel/public/hublabel/public/dashboard'); return false;">
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
                <a href="#" class="menu-item" data-menu-id="agentes-ia" onclick="navigateToPage('/hublabel/public/hublabel/public/agentes-ia'); return false;">
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
                <a href="#" class="menu-item" data-menu-id="conexoes" onclick="navigateToPage('/hublabel/public/hublabel/public/conexoes'); return false;">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">qr_code</span>
                    </span>
                    <span class="menu-text">Conexoes</span>
                </a>
                <a href="#" class="menu-item" data-menu-id="disparos" onclick="navigateToPage('/hublabel/public/hublabel/public/disparos'); return false;">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">send</span>
                    </span>
                    <span class="menu-text">Disparos</span>
                </a>
                <a href="#" class="menu-item active" data-menu-id="contatos" onclick="navigateToPage('/hublabel/public/hublabel/public/contatos'); return false;">
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
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </span>
                    <span class="menu-text">Configuracoes</span>
                </a>
                <a href="#" id="menu-item-admin" class="menu-item menu-item-admin" style="display: none;" onclick="if(typeof navigateToPage==='function'){navigateToPage('/hublabel/public/hublabel/public/adminpannel');return false;}">
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
                        <button type="button" class="btn btn-import" onclick="document.getElementById('csvFileInput').click()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            Importar CSV
                        </button>
                        <input type="file" id="csvFileInput" accept=".csv" style="display:none" onchange="handleCsvImport(this)">
                        <button type="button" class="btn" onclick="openAddContactModal()">
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
                    <div class="modal-box" onclick="event.stopPropagation()">
                        <div class="modal-header">
                            <h2 class="modal-title" id="addContactModalTitle">Adicionar contato</h2>
                            <button type="button" class="modal-close" onclick="closeAddContactModal()" aria-label="Fechar">&times;</button>
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
                            <button type="button" class="btn btn-secondary" onclick="closeAddContactModal()">Cancelar</button>
                            <button type="button" class="btn" id="addContactSaveBtn" onclick="saveContact()">Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="etiquetaModal" style="z-index:10080;">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:400px;">
                        <div class="modal-header">
                            <h2 class="modal-title" id="etiquetaModalTitle">Criar etiqueta</h2>
                            <button type="button" class="modal-close" onclick="closeEtiquetaModal()" aria-label="Fechar">&times;</button>
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
                            <button type="button" class="btn btn-secondary" onclick="closeEtiquetaModal()">Cancelar</button>
                            <button type="button" class="btn" id="etiquetaModalSaveBtn" onclick="saveEtiqueta()">Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="deleteContactModal" style="z-index:10050;">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:420px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Excluir contato</h2>
                            <button type="button" class="modal-close" onclick="closeDeleteContactModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="deleteContactModalMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="deleteContactCancelBtn" onclick="closeDeleteContactModal()">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="deleteContactConfirmBtn" onclick="executeDeleteContact()">Excluir</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkAddEtiquetaModal" style="z-index:10052;" onclick="if (event.target === this) closeBulkAddEtiquetaModal();">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Adicionar etiqueta</h2>
                            <button type="button" class="modal-close" onclick="closeBulkAddEtiquetaModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkAddEtiquetaSubtitle" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkAddEtiquetaSelect">Etiqueta</label>
                                <select id="bulkAddEtiquetaSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeBulkAddEtiquetaModal()">Cancelar</button>
                            <button type="button" class="btn" id="bulkAddEtiquetaConfirmBtn" onclick="executeBulkAddEtiqueta()">Aplicar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkRemoveEtiquetaModal" style="z-index:10052;" onclick="if (event.target === this) closeBulkRemoveEtiquetaModal();">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Remover etiqueta</h2>
                            <button type="button" class="modal-close" onclick="closeBulkRemoveEtiquetaModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkRemoveEtiquetaSubtitle" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkRemoveEtiquetaSelect">Etiqueta a remover</label>
                                <select id="bulkRemoveEtiquetaSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeBulkRemoveEtiquetaModal()">Cancelar</button>
                            <button type="button" class="btn" id="bulkRemoveEtiquetaConfirmBtn" onclick="executeBulkRemoveEtiqueta()">Remover</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkClearCampoModal" style="z-index:10052;" onclick="if (event.target === this) closeBulkClearCampoModal();">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Limpar campo personalizado</h2>
                            <button type="button" class="modal-close" onclick="closeBulkClearCampoModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkClearCampoSubtitle" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkClearCampoSelect">Campo</label>
                                <select id="bulkClearCampoSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeBulkClearCampoModal()">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="bulkClearCampoConfirmBtn" onclick="executeBulkClearCampo()">Limpar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkDeleteManyModal" style="z-index:10052;" onclick="if (event.target === this) closeBulkDeleteManyModal();">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Excluir contatos</h2>
                            <button type="button" class="modal-close" onclick="closeBulkDeleteManyModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkDeleteManyMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="bulkDeleteManyCancelBtn" onclick="closeBulkDeleteManyModal()">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="bulkDeleteManyConfirmBtn" onclick="executeBulkDeleteContacts()">Excluir</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkRemoveCrmModal" style="z-index:10052;" onclick="if (event.target === this) closeBulkRemoveCrmModal();">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:480px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Remover do CRM</h2>
                            <button type="button" class="modal-close" onclick="closeBulkRemoveCrmModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkRemoveCrmMessage" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkRemoveCrmQuadroSelect">Quadro (CRM)</label>
                                <select id="bulkRemoveCrmQuadroSelect" class="form-select" onchange="onBulkRemoveCrmQuadroChange()"></select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="bulkRemoveCrmEtapaSelect">Etapa</label>
                                <select id="bulkRemoveCrmEtapaSelect" class="form-select"></select>
                            </div>
                            <p class="delete-contact-modal-text" style="font-size:0.85rem;margin-top:8px;opacity:0.92;">Com um quadro e &quot;Todas as etapas&quot;, remove apenas daquele quadro. Com &quot;Todos os quadros&quot;, remove em todos os CRMs (a etapa permanece em &quot;Todas&quot;).</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="bulkRemoveCrmCancelBtn" onclick="closeBulkRemoveCrmModal()">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="bulkRemoveCrmConfirmBtn" onclick="executeBulkRemoveFromCrm()">Remover cards</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="bulkLinkCrmModal" style="z-index:10052;" onclick="if (event.target === this) closeBulkLinkCrmModal();">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Vincular em CRM</h2>
                            <button type="button" class="modal-close" onclick="closeBulkLinkCrmModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" id="bulkLinkCrmSubtitle" style="margin-bottom:12px;"></p>
                            <div class="form-group">
                                <label class="form-label" for="bulkLinkCrmQuadroSelect">Quadro</label>
                                <select id="bulkLinkCrmQuadroSelect" class="form-select" onchange="onBulkLinkCrmQuadroChange()"></select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="bulkLinkCrmEtapaSelect">Etapa inicial</label>
                                <select id="bulkLinkCrmEtapaSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeBulkLinkCrmModal()">Cancelar</button>
                            <button type="button" class="btn" id="bulkLinkCrmConfirmBtn" onclick="executeBulkLinkCrm()">Vincular</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="modalCampoPersonalizadoValor" style="z-index:10065;">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:440px;">
                        <div class="modal-header">
                            <h2 class="modal-title" id="modalCampoPersonalizadoTitulo">Atribuir campo</h2>
                            <button type="button" class="modal-close" onclick="closeModalCampoPersonalizadoValor()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="modalCampoValorSelect">Campo</label>
                                <select id="modalCampoValorSelect" class="form-select" onchange="onModalCampoValorSelectChange()"></select>
                            </div>
                            <div class="form-group" id="modalCampoValorDynamicWrap">
                                <label class="form-label" for="modalCampoValorInputText" id="modalCampoValorValueLabel">Valor</label>
                                <div id="modalCampoValorDynamicMount">
                                    <input type="text" id="modalCampoValorInputText" class="form-input" placeholder="Digite o valor">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeModalCampoPersonalizadoValor()">Cancelar</button>
                            <button type="button" class="btn" id="modalCampoValorSalvarBtn" onclick="salvarModalCampoPersonalizadoValor()">Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="modalNotaCompletaContatoOverlay" style="z-index:10067;" onclick="if (event.target === this) closeContactDetailNotaCompleta()">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:520px;">
                        <div class="modal-header">
                            <h2 class="modal-title" id="modalNotaCompletaContatoTitulo">Nota</h2>
                            <button type="button" class="modal-close" onclick="closeContactDetailNotaCompleta()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <pre class="contact-detail-nota-completa-pre" id="modalNotaCompletaContatoBody"></pre>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeContactDetailNotaCompleta()">Fechar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-overlay" id="contactDetailModal" style="z-index:10060;">
                    <div class="modal-box contact-detail-modal-box" onclick="event.stopPropagation()">
                        <div class="modal-header">
                            <div class="contact-detail-header-main">
                                <h2 class="modal-title" id="contactDetailModalTitle">Contato</h2>
                                <p class="contact-detail-header-sub" id="contactDetailModalSubtitle"></p>
                            </div>
                            <button type="button" class="modal-close" onclick="closeContactDetailModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="contact-detail-modal-scroll" id="contactDetailModalBody"></div>
                        <div class="modal-footer" style="justify-content:space-between;flex-wrap:wrap;gap:10px;">
                            <button type="button" class="btn btn-secondary" onclick="closeContactDetailModal()">Fechar</button>
                            <button type="button" class="btn btn-conversar" id="contactDetailConversarBtn" onclick="goToChatWithContact()">Conversar</button>
                        </div>
                    </div>
                </div>
                <div class="modal-overlay" id="chatConnectionModal" style="z-index:10070;">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:420px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Escolher conexao</h2>
                            <button type="button" class="modal-close" onclick="closeChatConnectionModal()" aria-label="Fechar">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-contact-modal-text" style="margin-bottom:10px;">Com qual conexao de WhatsApp deseja conversar?</p>
                            <select id="chatConnectionSelect" class="form-select"></select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeChatConnectionModal()">Cancelar</button>
                            <button type="button" class="btn btn-conversar" id="chatConnectionConfirmBtn" onclick="confirmChatConnection()">Conversar</button>
                        </div>
                    </div>
                </div>
                <div class="modal-overlay" id="syncGroupsModal" style="z-index:10090;">
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:680px;">
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
                    <div class="modal-box" onclick="event.stopPropagation()" style="max-width:920px;">
                        <div class="modal-header">
                            <h2 class="modal-title">Mapear colunas do CSV</h2>
                            <button type="button" class="modal-close" onclick="closeCsvImportModal()" aria-label="Fechar">&times;</button>
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
                            <button type="button" class="btn btn-secondary" onclick="closeCsvImportModal()">Cancelar</button>
                            <button type="button" class="btn btn-secondary" id="csvImportBackBtn" onclick="goCsvImportToStep1()" style="display:none;">Voltar</button>
                            <button type="button" class="btn" id="csvImportContinueBtn" onclick="goCsvImportToStep2()">Continuar</button>
                            <button type="button" class="btn" id="csvImportConfirmBtn" onclick="importCsvContactsWithEtiquetas()" style="display:none;">Importar contatos</button>
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
                                    <input type="text" id="dateFrom" class="filter-date-input" placeholder="dd/mm/aaaa" maxlength="10" oninput="formatDateInput(this)" onchange="applyFilters()">
                                </div>
                            </div>
                            <div class="filter-date-row">
                                <label class="filter-date-label">Ate:</label>
                                <div class="filter-date-wrap">
                                    <svg class="calendar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <input type="text" id="dateTo" class="filter-date-input" placeholder="dd/mm/aaaa" maxlength="10" oninput="formatDateInput(this)" onchange="applyFilters()">
                                </div>
                            </div>
                        </div>
                        <div class="filter-card">
                            <div class="filter-card-title">
                                <span style="display:flex;align-items:center;gap:8px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>Etiquetas</span>
                                <button type="button" class="etiqueta-add-btn" onclick="openCreateEtiquetaModal()" title="Criar etiqueta"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>
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
                                <span class="tipo-filter-tag active" id="tipoContatoFilterTag" onclick="toggleTipoFilter('contato')">Contato</span>
                                <span class="tipo-filter-tag active" id="tipoGrupoFilterTag" onclick="toggleTipoFilter('grupo')">Grupo</span>
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
                            <select id="crmQuadroFilter" class="filter-crm-select" onchange="onCrmQuadroFilterChange()">
                                <option value="">Todos os quadros</option>
                            </select>
                            <div id="crmEtapaFilterWrap" class="crm-etapa-filter-wrap" style="display:none;">
                                <label class="filter-date-label" for="crmEtapaFilter">Etapa</label>
                                <select id="crmEtapaFilter" class="filter-crm-select" onchange="applyFilters()">
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
                                    <button type="button" class="contacts-bulk-link-all" id="contactsBulkSelectAllFilteredBtn" title="Selecionar todos os contatos que aparecem com os filtros atuais" onclick="contactsSelectAllFiltered(event)">Selecionar todos</button>
                                </div>
                                <div class="contacts-bulk-dropdown-wrap">
                                    <button type="button" class="contacts-bulk-actions-btn" id="contactsBulkActionsBtn" onclick="event.stopPropagation(); toggleContactsBulkMenu(event);">
                                        Ações em massa
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </button>
                                    <div id="contactsBulkMenu" class="contacts-bulk-menu" role="menu">
                                        <button type="button" role="menuitem" onclick="contactsBulkMenuAction('addEtiqueta')">Adicionar etiqueta</button>
                                        <button type="button" role="menuitem" onclick="contactsBulkMenuAction('removeEtiqueta')">Remover etiqueta</button>
                                        <button type="button" role="menuitem" onclick="contactsBulkMenuAction('clearCampo')">Limpar campo personalizado</button>
                                        <button type="button" role="menuitem" onclick="contactsBulkMenuAction('addCampo')">Adicionar campo personalizado</button>
                                        <button type="button" role="menuitem" onclick="contactsBulkMenuAction('deleteContacts')">Excluir contato</button>
                                        <button type="button" role="menuitem" onclick="contactsBulkMenuAction('removeCrm')">Remover do CRM</button>
                                        <button type="button" role="menuitem" onclick="contactsBulkMenuAction('linkCrm')">Vincular em CRM</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contacts-table-container">
                            <table class="contacts-table">
                                <thead>
                                    <tr>
                                        <th class="contacts-th-checkbox">
                                            <input type="checkbox" class="contacts-row-checkbox" id="contactsSelectAllPage" title="Marca todos desta página; desmarcar limpa toda a seleção" aria-label="Selecionar todos os contatos desta página ou limpar toda a seleção" onclick="event.stopPropagation();" onchange="onContactsSelectAllPageChange(event)">
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

    <script>
        const CHAT_PAGE_URL = '/hublabel/public/hublabel/public/chat';

        let allContacts = [];
        let allEtiquetas = {};
        let filteredContacts = [];
        /** contatoId (number) -> lista de { q: quadroId, e: etapaQuadroId } por card em SAAS_Cards_Quadros */
        let contactCrmCardsByContact = new Map();
        let currentPage = 1;
        const contactsPerPage = 20;
        let totalContactsCount = 0;
        let totalContatosOnlyCount = 0;
        let totalGroupsOnlyCount = 0;
        let currentContaIdForContacts = null;
        let contactsLastLoadedPage = 0;
        let contactsFullyLoaded = false;
        let etiquetaTotalCounts = {};
        let filteredTotalCount = 0;
        let filteredServerMode = false;
        let filteredContatosOnlyCount = 0;
        let filteredGroupsOnlyCount = 0;
        let etiquetasVisibleCount = 10;
        const ETIQUETAS_PER_PAGE = 10;
        let etiquetaEditId = null;
        let editContactId = null;
        let deleteContactPendingId = null;
        let contactDetailId = null;
        let modalCampoValorRowId = null;
        const bulkSelectedContactIds = new Set();

        /** IDs de contato no Set sempre como number (evita falha has() com string vs number do Supabase). */
        function normBulkContactId(id) {
            if (id == null || id === '') return null;
            const n = typeof id === 'bigint' ? Number(id) : Number(id);
            if (!Number.isFinite(n) || n <= 0) return null;
            return n;
        }

        let bulkCampoTargetIds = null;
        let bulkDeleteLockedIds = [];
        let bulkRemoveCrmLockedIds = [];
        let bulkLinkCrmLockedIds = [];
        let pendingChatContext = null;
        let syncGroupsConnections = [];
        let syncGroupsSelectedConnection = null;
        let syncGroupsAll = [];
        let syncGroupsFiltered = [];
        let syncGroupsProgressTimer = null;
        let csvImportRawRows = [];
        let csvImportHeaders = [];
        let csvImportMapping = {};
        let csvImportCustomFields = [];
        let csvImportSelectedEtiquetaIds = [];

        function isBooleanLikeValue(value) {
            const v = String(value || '').trim().toLowerCase();
            if (!v) return true;
            return ['true', 'false', '1', '0', 'sim', 'nao', 'não', 'yes', 'no', 'y', 'n'].includes(v);
        }

        function isNumberLikeValue(value) {
            const v = String(value || '').trim();
            if (!v) return true;
            const normalized = v.replace(/\s+/g, '').replace(/\./g, '').replace(',', '.');
            if (!/^[-+]?\d+(\.\d+)?$/.test(normalized)) return false;
            return Number.isFinite(Number(normalized));
        }

        function isDateLikeValue(value) {
            const v = String(value || '').trim();
            if (!v) return true;
            const iso = /^(\d{4})-(\d{2})-(\d{2})$/;
            const br = /^(\d{2})\/(\d{2})\/(\d{4})$/;
            let y; let m; let d;
            if (iso.test(v)) {
                const parts = v.match(iso);
                y = Number(parts[1]); m = Number(parts[2]); d = Number(parts[3]);
            } else if (br.test(v)) {
                const parts = v.match(br);
                d = Number(parts[1]); m = Number(parts[2]); y = Number(parts[3]);
            } else {
                return false;
            }
            const dt = new Date(y, m - 1, d);
            return dt.getFullYear() === y && dt.getMonth() === (m - 1) && dt.getDate() === d;
        }

        function isSampleCompatibleWithFieldType(sampleValue, fieldType) {
            const type = String(fieldType || 'texto').toLowerCase();
            if (!String(sampleValue || '').trim()) return true;
            if (type === 'texto') return true;
            if (type === 'numero') return isNumberLikeValue(sampleValue);
            if (type === 'data') return isDateLikeValue(sampleValue);
            if (type === 'boolean') return isBooleanLikeValue(sampleValue);
            return true;
        }

        function updateCsvImportStats() {
            const totalCols = csvImportHeaders.length;
            const mappedCount = Object.keys(csvImportMapping).length;
            const hasPhone = Object.values(csvImportMapping).some(m => m.type === 'telefone');
            const colsEl = document.getElementById('csvImportStatsColumns');
            const mappedEl = document.getElementById('csvImportStatsMapped');
            const phoneEl = document.getElementById('csvImportStatsPhone');
            if (colsEl) colsEl.textContent = totalCols + ' colunas no CSV';
            if (mappedEl) mappedEl.textContent = mappedCount + ' colunas mapeadas';
            if (phoneEl) {
                phoneEl.textContent = hasPhone ? 'Telefone mapeado' : 'Telefone nao mapeado';
                phoneEl.className = 'csv-import-stat-chip ' + (hasPhone ? 'ok' : 'warn');
            }
        }

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function setCookie(name, value, days) {
            const d = new Date();
            d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${value};expires=${d.toUTCString()};path=/`;
        }

        async function obterUserIdComStatus() {
            let contaId = null;
            if (window.supabase) {
                try {
                    const { data: { user }, error: userError } = await window.supabase.auth.getUser();
                    if (!userError && user && user.id) {
                        const { data: usuarioData, error: usuarioError } = await window.supabase
                            .from('SAAS_Usuarios')
                            .select('contaId, SAAS_Contas(status)')
                            .eq('auth_user_id', user.id)
                            .single();
                        if (!usuarioError && usuarioData && usuarioData.contaId) {
                            if (usuarioData?.SAAS_Contas?.status === false) {
                                logoutAndRedirectAcessoBloqueado();
                                throw new Error('STATUS_BLOQUEADO');
                            }
                            contaId = usuarioData.contaId;
                            setCookie('userId', contaId, 7);
                        }
                    }
                } catch (e) {
                    if (e.message === 'STATUS_BLOQUEADO') throw e;
                    console.error('Erro obterUserIdComStatus:', e);
                }
            }
            if (!contaId) {
                const c = getCookie('userId');
                if (c && /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i.test(c)) contaId = c;
            }
            return contaId;
        }

        function logoutAndRedirectAcessoBloqueado() {
            document.cookie = 'userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            if (typeof clearMenuOcultarCache === 'function') clearMenuOcultarCache();
            sessionStorage.clear(); localStorage.clear();
            window.location.replace('/hublabel/public/acesso-bloqueado');
            if (window.supabase) window.supabase.auth.signOut().catch(() => {});
        }

        function navigateToPage(url) { window.location.href = url; }

        /** Abre crm-etapas no quadro do card e dispara o deep link ?cardId= (modal do card). */
        function openContactDetailCardInCrmEtapas(quadroId, cardId) {
            const q = quadroId != null && String(quadroId).trim() !== '' ? String(quadroId).trim() : '';
            const c = cardId != null && String(cardId).trim() !== '' ? String(cardId).trim() : '';
            if (!q || !c) return;
            const url = '/hublabel/public/hublabel/public/crm-etapas?quadroId=' + encodeURIComponent(q) + '&cardId=' + encodeURIComponent(c);
            navigateToPage(url);
        }

        function openAddContactModal() {
            editContactId = null;
            selectedEtiquetaIds = [];
            document.getElementById('addContactModalTitle').textContent = 'Adicionar contato';
            document.getElementById('addContactNome').value = '';
            document.getElementById('addContactDDI').value = '55';
            document.getElementById('addContactPhone').value = '';
            document.getElementById('addContactEmail').value = '';
            populateEtiquetasDropdown();
            document.getElementById('addContactModal').classList.add('active');
        }

        function parsePhoneParts(tel) {
            if (!tel || typeof tel !== 'string') return { ddi: '55', ddd: '', phone: '' };
            const dig = tel.replace(/\D/g, '');
            const ddis = ['598','595','351','52','56','57','54','49','39','44','34','33','1','55'];
            let ddi = '55', rest = dig;
            for (const d of ddis) {
                if (dig.startsWith(d)) { ddi = d; rest = dig.slice(d.length); break; }
            }
            if (ddi === '55' && rest.length >= 11) return { ddi: '55', ddd: rest.slice(0,2), phone: rest.slice(2) };
            if (rest.length >= 9) return { ddi, ddd: rest.slice(0,2), phone: rest.slice(2) };
            return { ddi, ddd: '', phone: rest };
        }

        function buildTelefoneVariantes(telefone) {
            const base = (telefone || '').replace(/\D/g, '');
            if (!base) return [];
            const variantes = new Set([base]);
            if (base.startsWith('55')) {
                if (base.length === 12) {
                    variantes.add(base.slice(0, 4) + '9' + base.slice(4));
                } else if (base.length === 13 && base[4] === '9') {
                    variantes.add(base.slice(0, 4) + base.slice(5));
                }
            }
            return Array.from(variantes);
        }

        function normalizeTelefoneForCompare(telefone) {
            const raw = String(telefone || '').replace(/@s\.whatsapp\.net$/i, '').trim();
            return raw.replace(/\D/g, '');
        }

        async function findExistingContactByPhone(contaId, telefone, ignoreContactId = null) {
            const targetVariantes = new Set(buildTelefoneVariantes(normalizeTelefoneForCompare(telefone)));
            if (!contaId || targetVariantes.size === 0) return null;
            let query = window.supabase
                .from('SAAS_Contatos')
                .select('id, telefone')
                .eq('contaId', contaId)
                .order('id', { ascending: false })
                .limit(5000);
            if (ignoreContactId != null) {
                query = query.neq('id', ignoreContactId);
            }
            const { data, error } = await query;
            if (error) {
                console.warn('Falha ao verificar telefone duplicado:', error);
                return null;
            }
            for (const row of (data || [])) {
                const existingBase = normalizeTelefoneForCompare(row.telefone);
                if (!existingBase) continue;
                const existingVariantes = buildTelefoneVariantes(existingBase);
                if (existingVariantes.some(v => targetVariantes.has(v))) {
                    return { id: row.id };
                }
            }
            return null;
        }

        function openEditContactModal(id) {
            closeRowMenu();
            const c = allContacts.find(x => x.id === id);
            if (!c) return;
            editContactId = id;
            document.getElementById('addContactModalTitle').textContent = 'Editar contato';
            document.getElementById('addContactNome').value = c.nome || '';
            const telefone = c.tipo === 'grupo' ? (c.variaveis?.whatsappId || '') : (c.telefone || '');
            const parts = parsePhoneParts(telefone);
            document.getElementById('addContactDDI').value = parts.ddi;
            let ph = (parts.ddd + parts.phone).replace(/\D/g, '');
            if (ph.length > 2) ph = ph.slice(0,2) + ' ' + ph.slice(2);
            if (ph.length > 8) ph = ph.slice(0,8) + '-' + ph.slice(8,12);
            document.getElementById('addContactPhone').value = ph;
            document.getElementById('addContactEmail').value = c.email || '';
            selectedEtiquetaIds = (c.etiquetaIds || []).map(eid => String(eid));
            populateEtiquetasDropdown();
            document.getElementById('addContactModal').classList.add('active');
        }

        function closeAddContactModal() {
            document.getElementById('addContactModal').classList.remove('active');
            editContactId = null;
        }

        document.getElementById('addContactModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeAddContactModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key !== 'Escape') return;
            if (document.getElementById('chatConnectionModal')?.classList.contains('active')) closeChatConnectionModal();
            else if (document.getElementById('contactDetailModal')?.classList.contains('active')) closeContactDetailModal();
            else if (document.getElementById('deleteContactModal')?.classList.contains('active')) closeDeleteContactModal();
            else if (document.getElementById('addContactModal')?.classList.contains('active')) closeAddContactModal();
            else if (document.getElementById('etiquetaModal')?.classList.contains('active')) closeEtiquetaModal();
        });

        let selectedEtiquetaIds = [];

        function populateEtiquetasDropdown() {
            const dropdown = document.getElementById('etiquetasMultiselectDropdown');
            const tagsContainer = document.getElementById('etiquetasMultiselectTags');
            const placeholder = document.getElementById('etiquetasMultiselectPlaceholder');
            const entries = Object.entries(allEtiquetas);
            dropdown.innerHTML = entries.map(([id, obj]) => {
                const nome = typeof obj === 'object' ? obj.nome : obj;
                const cor = typeof obj === 'object' && obj.cor ? obj.cor : '#6b7280';
                const isHex = /^#[0-9a-fA-F]{6}$/.test(cor);
                const bg = isHex ? cor + '25' : 'rgba(107,114,128,0.2)';
                const selected = selectedEtiquetaIds.includes(String(id));
                return `<span class="etiquetas-multiselect-option ${selected ? 'selected' : ''}" data-id="${id}" style="background:${bg};color:${cor};border-color:${cor}" onclick="toggleEtiquetaSelection('${id}')">${escapeHtml(nome)}</span>`;
            }).join('');
            renderEtiquetasSelectedTags();
        }

        function renderEtiquetasSelectedTags() {
            const tagsContainer = document.getElementById('etiquetasMultiselectTags');
            const placeholder = document.getElementById('etiquetasMultiselectPlaceholder');
            placeholder.style.display = selectedEtiquetaIds.length ? 'none' : 'inline';
            tagsContainer.innerHTML = selectedEtiquetaIds.map(id => {
                const obj = allEtiquetas[id];
                const nome = obj && (typeof obj === 'object' ? obj.nome : obj) || '?';
                const cor = obj && typeof obj === 'object' && obj.cor ? obj.cor : '#6b7280';
                const isHex = /^#[0-9a-fA-F]{6}$/.test(cor);
                const bg = isHex ? cor + '25' : 'rgba(107,114,128,0.2)';
                return `<span class="etiqueta-tag" style="background:${bg};color:${cor}">${escapeHtml(nome)}</span>`;
            }).join('');
        }

        function toggleEtiquetaSelection(id) {
            const idx = selectedEtiquetaIds.indexOf(String(id));
            if (idx >= 0) selectedEtiquetaIds.splice(idx, 1);
            else selectedEtiquetaIds.push(String(id));
            populateEtiquetasDropdown();
        }

        function openEtiquetasDropdown() {
            document.getElementById('etiquetasMultiselectTrigger').classList.add('open');
            document.getElementById('etiquetasMultiselectDropdown').classList.add('open');
        }
        function closeEtiquetasDropdown() {
            document.getElementById('etiquetasMultiselectTrigger').classList.remove('open');
            document.getElementById('etiquetasMultiselectDropdown').classList.remove('open');
        }
        document.getElementById('etiquetasMultiselectTrigger')?.addEventListener('click', function(e) {
            e.stopPropagation();
            const dd = document.getElementById('etiquetasMultiselectDropdown');
            if (dd.classList.contains('open')) closeEtiquetasDropdown();
            else openEtiquetasDropdown();
        });
        document.addEventListener('click', function() { closeEtiquetasDropdown(); });
        document.getElementById('etiquetasMultiselect')?.addEventListener('click', function(e) { e.stopPropagation(); });

        function formatPhoneFullInput(el) {
            let v = el.value.replace(/\D/g, '').slice(0, 11);
            if (v.length > 2) v = v.slice(0,2) + ' ' + v.slice(2);
            if (v.length > 8) v = v.slice(0,8) + '-' + v.slice(8,12);
            el.value = v;
        }

        document.getElementById('addContactPhone')?.addEventListener('input', function() {
            formatPhoneFullInput(this);
        });

        async function saveContact() {
            const nome = (document.getElementById('addContactNome').value || '').trim();
            const ddi = document.getElementById('addContactDDI').value || '55';
            const phoneRaw = (document.getElementById('addContactPhone').value || '').replace(/\D/g, '');
            const ddd = phoneRaw.slice(0, 2);
            const phoneNum = phoneRaw.slice(2);
            const email = (document.getElementById('addContactEmail').value || '').trim();
            const etiquetaIds = selectedEtiquetaIds.slice();

            if (phoneRaw.length < 11) {
                showToast('Informe o telefone completo: DDD + 9 digitos (ex: 48 99999-9999)', 'error');
                return;
            }
            let telefone = ddi + phoneRaw;
            if (ddi === '55' && phoneNum.length === 8 && !phoneNum.startsWith('9')) telefone = ddi + ddd + '9' + phoneNum;
            if (telefone.length < 9) {
                showToast('Telefone invalido. Use formato: 9 99999-9999', 'error');
                return;
            }

            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; throw e; }
            if (!contaId) { showToast('Sessao expirada. Faca login novamente.', 'error'); return; }

            if (editContactId) {
                const contatoExistente = await findExistingContactByPhone(contaId, telefone, editContactId);
                if (contatoExistente?.id) {
                    closeAddContactModal();
                    await loadContacts();
                    await openContactDetailModal(contatoExistente.id);
                    showToast('Ja existe esse contato para esta conta.', 'info');
                    return;
                }
                const orig = allContacts.find(x => x.id === editContactId);
                let payload;
                if (orig?.tipo === 'grupo') {
                    const variaveis = orig?.variaveis && typeof orig.variaveis === 'object' ? { ...orig.variaveis } : {};
                    variaveis.whatsappId = telefone;
                    payload = { nome: nome || null, email: email || null, variaveis };
                } else {
                    payload = { nome: nome || null, telefone, email: email || null };
                }
                const { error } = await window.supabase.from('SAAS_Contatos').update(payload).eq('id', editContactId).eq('contaId', contaId);
                if (error) {
                    if (error.code === '23505') showToast('Ja existe outro contato com este telefone.', 'error');
                    else showToast('Erro ao atualizar: ' + (error.message || 'Erro desconhecido'), 'error');
                    return;
                }
                await window.supabase.from('SAAS_Contatos_Etiquetas').delete().eq('contatoId', editContactId).eq('contaId', contaId);
                if (etiquetaIds.length > 0) {
                    const rows = etiquetaIds.map(eid => ({ contatoId: editContactId, etiquetaId: parseInt(eid, 10), contaId }));
                    await window.supabase.from('SAAS_Contatos_Etiquetas').insert(rows);
                }
                showToast('Contato atualizado com sucesso!', 'success');
            } else {
                const contatoExistente = await findExistingContactByPhone(contaId, telefone);
                if (contatoExistente?.id) {
                    closeAddContactModal();
                    await loadContacts();
                    await openContactDetailModal(contatoExistente.id);
                    showToast('Ja existe esse contato para esta conta.', 'info');
                    return;
                }
                const payload = { nome: nome || null, telefone, tipo: 'contato', email: email || null, contaId, variaveis: {}, lid: null };
                const { data: inserted, error } = await window.supabase.from('SAAS_Contatos').insert(payload).select('id').single();
                if (error) {
                    if (error.code === '23505') showToast('Ja existe um contato com este telefone.', 'error');
                    else showToast('Erro ao salvar: ' + (error.message || 'Erro desconhecido'), 'error');
                    return;
                }
                if (etiquetaIds.length > 0 && inserted?.id) {
                    const rows = etiquetaIds.map(eid => ({ contatoId: inserted.id, etiquetaId: parseInt(eid, 10), contaId }));
                    await window.supabase.from('SAAS_Contatos_Etiquetas').insert(rows);
                }
                showToast('Contato adicionado com sucesso!', 'success');
            }
            closeAddContactModal();
            await loadContacts();
        }

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
            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        async function loadEtiquetas(contaId) {
            const { data } = await window.supabase.from('SAAS_Etiquetas').select('id, nome, descricao, cor').eq('contaId', contaId);
            allEtiquetas = {};
            if (data && data.length) data.forEach(e => { allEtiquetas[e.id] = { nome: e.nome || 'Sem nome', descricao: e.descricao || '', cor: e.cor || '#6b7280' }; });
            etiquetasVisibleCount = ETIQUETAS_PER_PAGE;
            renderEtiquetasLateral();
        }

        function openCreateEtiquetaModal() {
            etiquetaEditId = null;
            document.getElementById('etiquetaModalTitle').textContent = 'Criar etiqueta';
            document.getElementById('etiquetaModalSaveBtn').textContent = 'Salvar';
            document.getElementById('etiquetaNome').value = '';
            document.getElementById('etiquetaDescricao').value = '';
            document.getElementById('etiquetaCor').value = '#6C63FF';
            document.getElementById('etiquetaCorPicker').value = '#6C63FF';
            document.getElementById('etiquetaModal').classList.add('active');
        }

        function openEditEtiquetaModal(id) {
            etiquetaEditId = id;
            const obj = allEtiquetas[id];
            if (!obj) return;
            document.getElementById('etiquetaModalTitle').textContent = 'Editar etiqueta';
            document.getElementById('etiquetaModalSaveBtn').textContent = 'Salvar';
            document.getElementById('etiquetaNome').value = obj.nome || '';
            document.getElementById('etiquetaDescricao').value = obj.descricao || '';
            const cor = obj.cor || '#6C63FF';
            document.getElementById('etiquetaCor').value = /^#[0-9a-fA-F]{6}$/.test(cor) ? cor : '#6C63FF';
            document.getElementById('etiquetaCorPicker').value = /^#[0-9a-fA-F]{6}$/.test(cor) ? cor : '#6C63FF';
            document.getElementById('etiquetaModal').classList.add('active');
        }

        function closeEtiquetaModal() {
            document.getElementById('etiquetaModal').classList.remove('active');
            etiquetaEditId = null;
        }

        document.getElementById('etiquetaModal')?.addEventListener('click', function(e) { if (e.target === this) closeEtiquetaModal(); });
        document.getElementById('deleteContactModal')?.addEventListener('click', function(e) { if (e.target === this) closeDeleteContactModal(); });
        document.getElementById('contactDetailModal')?.addEventListener('click', function(e) { if (e.target === this) closeContactDetailModal(); });
        document.getElementById('chatConnectionModal')?.addEventListener('click', function(e) { if (e.target === this) closeChatConnectionModal(); });
        document.querySelector('#contactDetailModal .contact-detail-modal-box')?.addEventListener('click', function(e) {
            if (!e.target.closest('.contact-detail-etiquetas-wrap')) closeContactDetailEtiquetaPicker();
        });
        document.getElementById('etiquetaCorPicker')?.addEventListener('input', function() { document.getElementById('etiquetaCor').value = this.value; });
        document.getElementById('etiquetaCor')?.addEventListener('input', function() {
            const v = this.value.trim();
            if (/^#[0-9a-fA-F]{6}$/.test(v)) document.getElementById('etiquetaCorPicker').value = v;
        });
        async function saveEtiqueta() {
            const nome = (document.getElementById('etiquetaNome').value || '').trim();
            if (!nome) { showToast('Informe o nome da etiqueta.', 'error'); return; }
            const descricao = (document.getElementById('etiquetaDescricao').value || '').trim();
            let cor = (document.getElementById('etiquetaCor').value || '').trim();
            if (!/^#[0-9a-fA-F]{6}$/.test(cor)) cor = '#6C63FF';
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; throw e; }
            if (!contaId) { showToast('Sessao expirada. Faca login novamente.', 'error'); return; }
            const payload = { nome, descricao: descricao || null, cor, contaId };
            const detailOpen = document.getElementById('contactDetailModal')?.classList.contains('active');
            const reopenDetailId = detailOpen ? contactDetailId : null;
            if (etiquetaEditId) {
                const { error } = await window.supabase.from('SAAS_Etiquetas').update(payload).eq('id', etiquetaEditId).eq('contaId', contaId);
                if (error) { showToast('Erro ao atualizar: ' + error.message, 'error'); return; }
                showToast('Etiqueta atualizada!', 'success');
            } else {
                const { error } = await window.supabase.from('SAAS_Etiquetas').insert(payload);
                if (error) { showToast('Erro ao criar: ' + error.message, 'error'); return; }
                showToast('Etiqueta criada!', 'success');
            }
            closeEtiquetaModal();
            await loadEtiquetas(contaId);
            await loadContacts();
            if (reopenDetailId != null) await openContactDetailModal(reopenDetailId);
        }

        function formatDateInput(el) {
            let v = el.value.replace(/\D/g, '');
            if (v.length >= 2) v = v.slice(0, 2) + '/' + v.slice(2);
            if (v.length >= 5) v = v.slice(0, 5) + '/' + v.slice(5, 9);
            el.value = v;
            const digitsOnly = el.value.replace(/\D/g, '');
            if (digitsOnly.length === 0 || el.value.length === 10) applyFilters();
        }

        function parseDateStr(str) {
            if (!str || str.length < 10) return null;
            const m = str.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
            if (!m) return null;
            const d = new Date(parseInt(m[3],10), parseInt(m[2],10)-1, parseInt(m[1],10));
            return isNaN(d.getTime()) ? null : d;
        }

        let selectedEtiquetasFilter = [];
        let selectedTiposFilter = ['contato', 'grupo'];

        function hasActiveContactFilters() {
            const search = (document.getElementById('searchFilter')?.value || '').trim();
            const dateFromVal = (document.getElementById('dateFrom')?.value || '').trim();
            const dateToVal = (document.getElementById('dateTo')?.value || '').trim();
            const etiquetaVal = (document.getElementById('etiquetaFilter')?.value || '').trim();
            const crmRaw = (document.getElementById('crmQuadroFilter')?.value || '').trim();
            const crmQid = crmRaw === '' ? NaN : parseInt(crmRaw, 10);
            const df = parseDateStr(dateFromVal);
            const dt = parseDateStr(dateToVal);
            const tipoAtivo = selectedTiposFilter.length !== 2;
            return !!(search || df || dt || selectedEtiquetasFilter.length > 0 || etiquetaVal || tipoAtivo || Number.isFinite(crmQid));
        }

        function renderEtiquetasLateral() {
            const el = document.getElementById('etiquetasLateralList');
            if (Object.keys(allEtiquetas).length === 0) {
                if (el) el.innerHTML = '<div class="etiquetas-empty-msg">Voce ainda nao tem etiquetas.</div>';
                return;
            }
            const entries = Object.entries(allEtiquetas);
            const visibleEntries = entries.slice(0, etiquetasVisibleCount);
            const hasMore = entries.length > etiquetasVisibleCount;
            let html = '';
            visibleEntries.forEach(([id, obj]) => {
                const nome = typeof obj === 'object' ? obj.nome : obj;
                const cor = (typeof obj === 'object' && obj.cor) ? obj.cor : '';
                const qty = etiquetaTotalCounts[String(id)] || 0;
                const isChecked = selectedEtiquetasFilter.includes(String(id));
                const dotHtml = cor ? '<span class="etiqueta-lateral-dot" style="background:' + cor + ';"></span>' : '';
                html += '<label class="etiqueta-lateral-item' + (isChecked ? ' active' : '') + '">';
                html += '<input type="checkbox" class="etiqueta-lateral-checkbox" ' + (isChecked ? 'checked' : '') + ' onchange="toggleEtiquetaFilter(\'' + id + '\')">';
                html += dotHtml;
                html += '<span class="etiqueta-lateral-name" data-tooltip="' + escapeHtmlAttr(nome) + '">' + escapeHtml(nome) + '</span>';
                html += '<span class="etiqueta-lateral-count">' + qty + '</span>';
                html += '</label>';
            });
            if (hasMore) html += '<div class="ver-mais-etiquetas" onclick="verMaisEtiquetas()">Ver mais</div>';
            if (el) el.innerHTML = html;
        }

        function verMaisEtiquetas() {
            etiquetasVisibleCount += ETIQUETAS_PER_PAGE;
            renderEtiquetasLateral();
        }

        function toggleEtiquetaFilter(etiquetaId) {
            const idx = selectedEtiquetasFilter.indexOf(String(etiquetaId));
            if (idx >= 0) {
                selectedEtiquetasFilter.splice(idx, 1);
            } else {
                selectedEtiquetasFilter.push(String(etiquetaId));
            }
            applyFilters();
            renderEtiquetasLateral();
        }

        function filterByEtiqueta(etiquetaId) {
            toggleEtiquetaFilter(etiquetaId);
        }

        function toggleTipoFilter(tipo) {
            const t = String(tipo || '').toLowerCase();
            if (t !== 'contato' && t !== 'grupo') return;
            const idx = selectedTiposFilter.indexOf(t);
            if (idx >= 0) {
                if (selectedTiposFilter.length === 1) {
                    return;
                }
                selectedTiposFilter.splice(idx, 1);
            } else {
                selectedTiposFilter.push(t);
            }

            syncTipoFilterTagsUI();
            applyFilters();
        }

        function contactMatchesCrmFilter(c, crmQid, crmEid) {
            const cid = normBulkContactId(c.id);
            if (!Number.isFinite(crmQid)) return true;
            const rows = cid != null ? (contactCrmCardsByContact.get(cid) || []) : [];
            if (!Number.isFinite(crmEid)) return rows.some(r => r.q === crmQid);
            return rows.some(r => r.q === crmQid && r.e === crmEid);
        }

        async function refreshContactCrmQuadroMap(contaId, contatoIds) {
            contactCrmCardsByContact = new Map();
            if (!window.supabase || !contaId || !contatoIds.length) return;
            const { data: quadros, error: qe } = await window.supabase.from('SAAS_Quadros').select('id').eq('contaId', contaId);
            if (qe || !quadros || !quadros.length) return;
            const qids = quadros.map(q => q.id).filter(id => id != null);
            if (!qids.length) return;
            const CHUNK = 400;
            for (let i = 0; i < contatoIds.length; i += CHUNK) {
                const slice = contatoIds.slice(i, i + CHUNK);
                const { data: cards, error } = await window.supabase.from('SAAS_Cards_Quadros').select('contatoId, quadroId, etapaQuadroId').in('quadroId', qids).in('contatoId', slice);
                if (error) { console.warn(error); continue; }
                (cards || []).forEach(row => {
                    const cid = normBulkContactId(row.contatoId);
                    const qid = Number(row.quadroId);
                    const eid = row.etapaQuadroId != null ? Number(row.etapaQuadroId) : NaN;
                    if (cid == null || !Number.isFinite(qid)) return;
                    if (!contactCrmCardsByContact.has(cid)) contactCrmCardsByContact.set(cid, []);
                    contactCrmCardsByContact.get(cid).push({ q: qid, e: Number.isFinite(eid) ? eid : NaN });
                });
            }
        }

        function onCrmQuadroFilterChange() {
            void syncCrmEtapaFilterForSelection();
            applyFilters();
        }

        async function syncCrmEtapaFilterForSelection(restoreEtapaVal) {
            const wrap = document.getElementById('crmEtapaFilterWrap');
            const qSel = document.getElementById('crmQuadroFilter');
            const eSel = document.getElementById('crmEtapaFilter');
            if (!wrap || !qSel || !eSel) return;
            const qVal = (qSel.value || '').trim();
            const qid = qVal === '' ? null : parseInt(qVal, 10);
            if (qid == null || !Number.isFinite(qid)) {
                wrap.style.display = 'none';
                eSel.innerHTML = '<option value="">Todas as etapas</option>';
                eSel.value = '';
                return;
            }
            wrap.style.display = 'block';
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { return; }
            if (!contaId || !window.supabase) return;
            const { data: etapas, error } = await window.supabase.from('SAAS_Etapas_Quadros').select('id, nome, ordem').eq('quadroId', qid).order('ordem', { ascending: true });
            let html = '<option value="">Todas as etapas</option>';
            if (!error && etapas && etapas.length) {
                html += etapas.map(e => '<option value="' + escapeHtml(String(e.id)) + '">' + escapeHtml(e.nome || ('Etapa ' + e.id)) + '</option>').join('');
            }
            eSel.innerHTML = html;
            const rev = restoreEtapaVal != null ? String(restoreEtapaVal).trim() : '';
            if (rev && [...eSel.options].some(o => o.value === rev)) eSel.value = rev;
            else eSel.value = '';
        }

        function populateCrmFilterSelect(quadros, restoreValue) {
            const sel = document.getElementById('crmQuadroFilter');
            if (!sel) return;
            let html = '<option value="">Todos os quadros</option>';
            (quadros || []).forEach(q => {
                html += '<option value="' + escapeHtml(String(q.id)) + '">' + escapeHtml(q.nome || ('Quadro ' + q.id)) + '</option>';
            });
            sel.innerHTML = html;
            const rv = (restoreValue || '').trim();
            if (rv && [...sel.options].some(o => o.value === rv)) sel.value = rv;
        }

        function syncTipoFilterTagsUI() {
            const contatoTag = document.getElementById('tipoContatoFilterTag');
            const grupoTag = document.getElementById('tipoGrupoFilterTag');
            if (contatoTag) contatoTag.classList.toggle('active', selectedTiposFilter.includes('contato'));
            if (grupoTag) grupoTag.classList.toggle('active', selectedTiposFilter.includes('grupo'));
        }

        async function fetchContatosPageByConta(contaId, page) {
            const from = Math.max(0, (page - 1) * contactsPerPage);
            const to = from + contactsPerPage - 1;
            return await window.supabase
                .from('SAAS_Contatos')
                .select('id, nome, telefone, email, created_at, variaveis, tipo, lid, fotoPerfil')
                .eq('contaId', contaId)
                .order('created_at', { ascending: false, nullsFirst: false })
                .order('id', { ascending: false })
                .range(from, to);
        }

        async function enrichContactsFromRows(contaId, contatosData) {
            const contatoIds = (contatosData || []).map(c => c.id);
            let mapaEtiquetasPorContato = {};
            if (contatoIds.length > 0) {
                const { data: ceData } = await window.supabase
                    .from('SAAS_Contatos_Etiquetas')
                    .select('contatoId, etiquetaId')
                    .eq('contaId', contaId)
                    .in('contatoId', contatoIds);
                const etiquetaIds = [...new Set((ceData || []).map(ce => ce.etiquetaId))];
                const infoEtiquetas = {};
                if (etiquetaIds.length > 0) {
                    const { data: etData } = await window.supabase.from('SAAS_Etiquetas').select('id, nome, cor').in('id', etiquetaIds);
                    (etData || []).forEach(e => { infoEtiquetas[e.id] = { nome: e.nome || 'Sem nome', cor: e.cor || '#6b7280' }; });
                }
                (ceData || []).forEach(ce => {
                    if (!mapaEtiquetasPorContato[ce.contatoId]) mapaEtiquetasPorContato[ce.contatoId] = { ids: [], nomes: [], cores: [] };
                    mapaEtiquetasPorContato[ce.contatoId].ids.push(ce.etiquetaId);
                    const info = infoEtiquetas[ce.etiquetaId] || { nome: '-', cor: '#6b7280' };
                    mapaEtiquetasPorContato[ce.contatoId].nomes.push(info.nome);
                    mapaEtiquetasPorContato[ce.contatoId].cores.push(info.cor);
                });
            }
            const mapped = (contatosData || []).map(c => {
                const meta = mapaEtiquetasPorContato[c.id] || { ids: [], nomes: [], cores: [] };
                return {
                    id: c.id,
                    nome: c.nome || '',
                    telefone: c.telefone || '',
                    email: c.email || '',
                    created_at: c.created_at,
                    variaveis: c.variaveis || {},
                    tipo: c.tipo || 'contato',
                    lid: c.lid,
                    fotoPerfil: c.fotoPerfil || '',
                    etiquetaIds: meta.ids,
                    etiqueta: meta.nomes.length ? meta.nomes.join(', ') : '-',
                    etiquetaNomes: meta.nomes,
                    etiquetaCores: meta.cores || []
                };
            });
            return { mapped, contatoIds };
        }

        async function ensureContactsLoadedUntilPage(targetPage) {
            if (!currentContaIdForContacts || !window.supabase) return;
            if (targetPage <= contactsLastLoadedPage) return;
            for (let page = contactsLastLoadedPage + 1; page <= targetPage; page++) {
                const { data: pageRows, error: pageErr } = await fetchContatosPageByConta(currentContaIdForContacts, page);
                if (pageErr) throw pageErr;
                if (!pageRows || pageRows.length === 0) break;
                const { mapped, contatoIds } = await enrichContactsFromRows(currentContaIdForContacts, pageRows);
                allContacts.push(...mapped);
                allContacts.sort((a, b) => {
                    const ta = a.created_at ? new Date(a.created_at).getTime() : 0;
                    const tb = b.created_at ? new Date(b.created_at).getTime() : 0;
                    if (tb !== ta) return tb - ta;
                    return (Number(b.id) || 0) - (Number(a.id) || 0);
                });
                await refreshContactCrmQuadroMap(currentContaIdForContacts, allContacts.map(c => c.id));
                contactsLastLoadedPage = page;
                if (pageRows.length < contactsPerPage) {
                    contactsFullyLoaded = true;
                    break;
                }
                if (allContacts.length >= totalContactsCount) {
                    contactsFullyLoaded = true;
                    break;
                }
            }
        }

        async function refreshGlobalCounts(contaId) {
            if (!contaId || !window.supabase) return;
            totalContactsCount = 0;
            totalContatosOnlyCount = 0;
            totalGroupsOnlyCount = 0;
            etiquetaTotalCounts = {};
            const [{ count: totalCount, error: totalErr }, { count: onlyContatosCount, error: onlyErr }, { count: onlyGroupsCount, error: onlyGroupsErr }] = await Promise.all([
                window.supabase.from('SAAS_Contatos').select('id', { count: 'exact', head: true }).eq('contaId', contaId),
                window.supabase.from('SAAS_Contatos').select('id', { count: 'exact', head: true }).eq('contaId', contaId).eq('tipo', 'contato'),
                window.supabase.from('SAAS_Contatos').select('id', { count: 'exact', head: true }).eq('contaId', contaId).eq('tipo', 'grupo')
            ]);
            if (!totalErr) totalContactsCount = Number(totalCount || 0);
            if (!onlyErr) totalContatosOnlyCount = Number(onlyContatosCount || 0);
            if (!onlyGroupsErr) totalGroupsOnlyCount = Number(onlyGroupsCount || 0);
            const CHUNK = 1000;
            let from = 0;
            while (true) {
                const { data, error } = await window.supabase
                    .from('SAAS_Contatos_Etiquetas')
                    .select('etiquetaId')
                    .eq('contaId', contaId)
                    .range(from, from + CHUNK - 1);
                if (error) break;
                const rows = Array.isArray(data) ? data : [];
                rows.forEach(r => {
                    const id = String(r.etiquetaId || '');
                    if (!id) return;
                    etiquetaTotalCounts[id] = (etiquetaTotalCounts[id] || 0) + 1;
                });
                if (rows.length < CHUNK) break;
                from += CHUNK;
            }
        }

        async function goToContactsPage(page) {
            const p = Math.max(1, Number(page) || 1);
            currentPage = p;
            if (hasActiveContactFilters()) {
                await loadFilteredContactsPage();
            } else {
                await ensureContactsLoadedUntilPage(p);
                filteredContacts = allContacts.slice();
                filteredServerMode = false;
                filteredTotalCount = filteredContacts.length;
            }
            renderTable();
        }

        function getCurrentContactsFilterState() {
            const searchRaw = (document.getElementById('searchFilter')?.value || '').trim();
            const dateFromVal = (document.getElementById('dateFrom')?.value || '').trim();
            const dateToVal = (document.getElementById('dateTo')?.value || '').trim();
            const etiquetaVal = (document.getElementById('etiquetaFilter')?.value || '').trim();
            const crmRaw = (document.getElementById('crmQuadroFilter')?.value || '').trim();
            const crmQid = crmRaw === '' ? null : parseInt(crmRaw, 10);
            const crmERaw = (document.getElementById('crmEtapaFilter')?.value || '').trim();
            const crmEidFilter = crmERaw === '' ? null : parseInt(crmERaw, 10);
            return {
                searchRaw,
                dateFrom: parseDateStr(dateFromVal),
                dateTo: parseDateStr(dateToVal),
                etiquetaVal,
                crmQid,
                crmEidFilter,
                selectedEtiquetas: selectedEtiquetasFilter.slice(),
                selectedTipos: selectedTiposFilter.slice()
            };
        }

        async function getFilteredOrderedContactIds(contaId, f) {
            if (!contaId || !window.supabase) return [];
            let qry = window.supabase
                .from('SAAS_Contatos')
                .select('id, created_at, tipo')
                .eq('contaId', contaId)
                .order('created_at', { ascending: false, nullsFirst: false })
                .order('id', { ascending: false });

            if (f.selectedTipos.length === 1) {
                qry = qry.eq('tipo', f.selectedTipos[0]);
            } else if (f.selectedTipos.length > 1 && f.selectedTipos.length < 2) {
                qry = qry.in('tipo', f.selectedTipos);
            }
            if (f.searchRaw) {
                const s = f.searchRaw.replace(/[%]/g, '').trim();
                if (s) qry = qry.or('nome.ilike.%' + s + '%,email.ilike.%' + s + '%,telefone.ilike.%' + s + '%');
            }
            if (f.dateFrom) {
                const fromIso = new Date(f.dateFrom.getFullYear(), f.dateFrom.getMonth(), f.dateFrom.getDate(), 0, 0, 0, 0).toISOString();
                qry = qry.gte('created_at', fromIso);
            }
            if (f.dateTo) {
                const toIso = new Date(f.dateTo.getFullYear(), f.dateTo.getMonth(), f.dateTo.getDate(), 23, 59, 59, 999).toISOString();
                qry = qry.lte('created_at', toIso);
            }

            const { data: baseRows, error: baseErr } = await qry;
            if (baseErr || !baseRows) return { orderedIds: [], contatosCount: 0, gruposCount: 0 };
            const tipoById = new Map();
            (baseRows || []).forEach(r => {
                const idNum = normBulkContactId(r.id);
                if (idNum == null) return;
                tipoById.set(idNum, String(r.tipo || 'contato').toLowerCase());
            });
            let orderedIds = baseRows.map(r => normBulkContactId(r.id)).filter(k => k != null);

            const etiquetaIds = f.selectedEtiquetas.length ? f.selectedEtiquetas.map(x => Number(x)).filter(Number.isFinite) : (f.etiquetaVal ? [Number(f.etiquetaVal)].filter(Number.isFinite) : []);
            if (etiquetaIds.length) {
                const { data: relRows, error: relErr } = await window.supabase
                    .from('SAAS_Contatos_Etiquetas')
                    .select('contatoId')
                    .eq('contaId', contaId)
                    .in('etiquetaId', etiquetaIds);
                if (relErr) return { orderedIds: [], contatosCount: 0, gruposCount: 0 };
                const setIds = new Set((relRows || []).map(r => normBulkContactId(r.contatoId)).filter(k => k != null));
                orderedIds = orderedIds.filter(id => setIds.has(id));
            }

            if (Number.isFinite(f.crmQid)) {
                let crmQry = window.supabase
                    .from('SAAS_Cards_Quadros')
                    .select('contatoId')
                    .eq('quadroId', Number(f.crmQid));
                if (Number.isFinite(f.crmEidFilter)) crmQry = crmQry.eq('etapaQuadroId', Number(f.crmEidFilter));
                const { data: crmRows, error: crmErr } = await crmQry;
                if (crmErr) return { orderedIds: [], contatosCount: 0, gruposCount: 0 };
                const crmSet = new Set((crmRows || []).map(r => normBulkContactId(r.contatoId)).filter(k => k != null));
                orderedIds = orderedIds.filter(id => crmSet.has(id));
            }
            let contatosCount = 0;
            let gruposCount = 0;
            orderedIds.forEach(id => {
                const t = tipoById.get(id);
                if (t === 'grupo') gruposCount += 1;
                else contatosCount += 1;
            });
            return { orderedIds, contatosCount, gruposCount };
        }

        async function loadFilteredContactsPage() {
            const contaId = currentContaIdForContacts;
            if (!contaId || !window.supabase) {
                filteredContacts = [];
                filteredServerMode = true;
                filteredTotalCount = 0;
                filteredContatosOnlyCount = 0;
                filteredGroupsOnlyCount = 0;
                return;
            }
            const f = getCurrentContactsFilterState();
            const filteredInfo = await getFilteredOrderedContactIds(contaId, f);
            const orderedIds = filteredInfo.orderedIds || [];
            filteredTotalCount = orderedIds.length;
            filteredContatosOnlyCount = Number(filteredInfo.contatosCount || 0);
            filteredGroupsOnlyCount = Number(filteredInfo.gruposCount || 0);
            filteredServerMode = true;
            const start = Math.max(0, (currentPage - 1) * contactsPerPage);
            const pageIds = orderedIds.slice(start, start + contactsPerPage);
            if (!pageIds.length) {
                filteredContacts = [];
                return;
            }
            const { data: contatosData, error } = await window.supabase
                .from('SAAS_Contatos')
                .select('id, nome, telefone, email, created_at, variaveis, tipo, lid, fotoPerfil')
                .eq('contaId', contaId)
                .in('id', pageIds);
            if (error || !contatosData) {
                filteredContacts = [];
                return;
            }
            const { mapped, contatoIds } = await enrichContactsFromRows(contaId, contatosData);
            const byId = new Map(mapped.map(c => [normBulkContactId(c.id), c]));
            filteredContacts = pageIds.map(id => byId.get(id)).filter(Boolean);
            await refreshContactCrmQuadroMap(contaId, contatoIds);
        }

        async function loadContacts() {
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; throw e; }
            if (!contaId) { window.location.href = '/hublabel/public/hublabel/public/hublabel/public/hublabel/public/login'; return; }

            await loadEtiquetas(contaId);

            const tbody = document.getElementById('contactsTableBody');
            bulkSelectedContactIds.clear();
            updateContactsBulkBarUI();
            tbody.innerHTML = Array(5).fill(0).map(() => `<tr class="skeleton-row"><td><div class="skeleton-line" style="width:18px;height:18px;border-radius:4px;"></div></td><td><div class="skeleton-line skeleton-line-name"></div><div class="skeleton-line skeleton-line-phone" style="margin-top:6px;"></div></td><td><div class="skeleton-line skeleton-line-date" style="width:60px;"></div></td><td><div class="skeleton-line skeleton-line-phone"></div></td><td><div class="skeleton-line skeleton-line-date"></div></td><td></td></tr>`).join('');
            currentContaIdForContacts = contaId;
            contactsLastLoadedPage = 0;
            contactsFullyLoaded = false;
            await refreshGlobalCounts(contaId);
            const { data: contatosData, error } = await fetchContatosPageByConta(contaId, 1);

            if (error) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:30px;color:#ff4444;">Erro ao carregar: ' + error.message + '</td></tr>';
                allContacts = [];
                contactCrmCardsByContact = new Map();
                populateCrmFilterSelect([], '');
                void syncCrmEtapaFilterForSelection('');
            } else {
                const { mapped, contatoIds } = await enrichContactsFromRows(contaId, contatosData || []);
                allContacts = mapped;
                contactsLastLoadedPage = 1;
                contactsFullyLoaded = allContacts.length >= totalContactsCount;
                const prevCrm = (document.getElementById('crmQuadroFilter')?.value || '').trim();
                const prevEtapa = (document.getElementById('crmEtapaFilter')?.value || '').trim();
                const { data: quadrosCrm } = await window.supabase.from('SAAS_Quadros').select('id, nome').eq('contaId', contaId).order('nome', { ascending: true });
                await refreshContactCrmQuadroMap(contaId, contatoIds);
                populateCrmFilterSelect(quadrosCrm || [], prevCrm);
                await syncCrmEtapaFilterForSelection(prevEtapa);
            }
            await applyFilters();
        }

        async function applyFilters() {
            const activeFilters = hasActiveContactFilters();
            if (activeFilters) {
                currentPage = 1;
                await loadFilteredContactsPage();
                pruneBulkSelectionToFiltered();
                renderTable();
                renderEtiquetasLateral();
                updateKPIs();
                return;
            }
            const searchRaw = (document.getElementById('searchFilter')?.value || '').trim();
            const search = searchRaw.toLowerCase();
            const dateFromVal = (document.getElementById('dateFrom')?.value || '').trim();
            const dateToVal = (document.getElementById('dateTo')?.value || '').trim();
            const etiquetaVal = (document.getElementById('etiquetaFilter')?.value || '').trim();
            const crmRaw = (document.getElementById('crmQuadroFilter')?.value || '').trim();
            const crmQid = crmRaw === '' ? null : parseInt(crmRaw, 10);
            const crmERaw = (document.getElementById('crmEtapaFilter')?.value || '').trim();
            const crmEidFilter = crmERaw === '' ? null : parseInt(crmERaw, 10);

            const dateFrom = parseDateStr(dateFromVal);
            const dateTo = parseDateStr(dateToVal);
            const searchDigits = search.replace(/\D/g, '');

            filteredContacts = allContacts.filter(c => {
                const telefoneOuWhatsapp = c.tipo === 'grupo' ? (c.variaveis?.whatsappId || '') : (c.telefone || '');
                const nomeLc = (c.nome || '').toLowerCase();
                const emailLc = (c.email || '').toLowerCase();
                const phoneDigits = telefoneOuWhatsapp.replace(/\D/g, '');
                const matchNome = search && nomeLc.includes(search);
                const matchEmail = search && emailLc.includes(search);
                const matchPhone = searchDigits.length > 0 && phoneDigits.includes(searchDigits);
                const matchSearch = !search || matchNome || matchEmail || matchPhone;
                const currentTipo = String(c.tipo || 'contato').toLowerCase();
                const matchTipo = selectedTiposFilter.includes(currentTipo);
                if (Number.isFinite(crmQid)) {
                    const eid = Number.isFinite(crmEidFilter) ? crmEidFilter : null;
                    if (!contactMatchesCrmFilter(c, crmQid, eid)) return false;
                }
                let matchEtiqueta = true;
                if (selectedEtiquetasFilter.length > 0) {
                    matchEtiqueta = c.etiquetaIds && c.etiquetaIds.some(eid => selectedEtiquetasFilter.includes(String(eid)));
                } else if (etiquetaVal) {
                    matchEtiqueta = c.etiquetaIds && c.etiquetaIds.some(eid => String(eid) === String(etiquetaVal));
                }
                if (!matchSearch || !matchEtiqueta || !matchTipo) return false;
                if (!dateFrom && !dateTo) return true;
                const d = c.created_at ? new Date(c.created_at) : null;
                if (!d || isNaN(d.getTime())) return false;
                const dDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
                if (dateFrom) {
                    const fromDate = new Date(dateFrom.getFullYear(), dateFrom.getMonth(), dateFrom.getDate());
                    if (dDate < fromDate) return false;
                }
                if (dateTo) {
                    const toDate = new Date(dateTo.getFullYear(), dateTo.getMonth(), dateTo.getDate());
                    if (dDate > toDate) return false;
                }
                return true;
            });
            pruneBulkSelectionToFiltered();
            currentPage = 1;
            filteredServerMode = false;
            filteredTotalCount = filteredContacts.length;
            renderTable();
            renderEtiquetasLateral();
            updateKPIs();
        }

        function formatDate(s) {
            if (!s) return '-';
            const d = new Date(s);
            return d.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
        }

        function getDisplayPhone(c) {
            if (c.tipo === 'grupo') return c.variaveis?.whatsappId || '';
            const t = c.telefone || '';
            if (!t) return '';
            return t.replace(/@s\.whatsapp\.net$/i, '');
        }

        function buildContactTableAvatarHtml(c) {
            const isGrupo = c.tipo === 'grupo';
            const tipoClass = isGrupo ? 'grupo' : 'contato';
            const iconSvg = isGrupo
                ? '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>'
                : '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>';
            const fp = (c.fotoPerfil || '').trim();
            if (fp) {
                return '<div class="contact-avatar has-photo ' + tipoClass + '"><img src="' + escapeHtml(fp) + '" alt="" loading="lazy" decoding="async" onerror="this.onerror=null;this.style.display=\'none\';var p=this.parentElement;if(p){p.classList.remove(\'has-photo\');var f=p.querySelector(\'.avatar-fallback\');if(f)f.style.display=\'flex\';}"><div class="avatar-fallback"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' + iconSvg + '</svg></div></div>';
            }
            return '<div class="contact-avatar ' + tipoClass + '"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' + iconSvg + '</svg></div>';
        }

        function buildContactDetailHeroAvatarHtml(c) {
            const isGrupo = c.tipo === 'grupo';
            const heroTipoClass = isGrupo ? 'grupo' : 'contato';
            const iconSvgInner = isGrupo
                ? '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>'
                : '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>';
            const fp = (c.fotoPerfil || '').trim();
            if (fp) {
                return '<div class="contact-detail-hero-avatar has-photo ' + heroTipoClass + '"><img src="' + escapeHtml(fp) + '" alt="" class="contact-detail-hero-photo" onerror="this.onerror=null;this.style.display=\'none\';var p=this.parentElement;if(p){p.classList.remove(\'has-photo\');var f=p.querySelector(\'.avatar-fallback\');if(f)f.style.display=\'flex\';}"><div class="avatar-fallback"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' + iconSvgInner + '</svg></div></div>';
            }
            return '<div class="contact-detail-hero-avatar ' + heroTipoClass + '"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' + iconSvgInner + '</svg></div>';
        }

        function onContactRowClick(ev, id) {
            if (ev.target.closest && ev.target.closest('.contact-row-menu')) return;
            if (ev.target.closest && (ev.target.closest('.contacts-td-checkbox') || ev.target.closest('.contacts-row-checkbox'))) return;
            openContactDetailModal(id);
        }

        function closeContactDetailEtiquetaPicker() {
            const p = document.getElementById('contactDetailEtiquetaPicker');
            const b = document.getElementById('contactDetailEtiquetaAddBtn');
            if (p) { p.hidden = true; p.classList.remove('open'); }
            if (b) b.setAttribute('aria-expanded', 'false');
        }

        function closeContactDetailModal() {
            closeContactDetailEtiquetaPicker();
            closeContactDetailNotaCompleta();
            document.getElementById('contactDetailModal')?.classList.remove('active');
            contactDetailId = null;
        }

        function closeChatConnectionModal() {
            document.getElementById('chatConnectionModal')?.classList.remove('active');
            pendingChatContext = null;
        }

        function formatConexaoLabelForChat(cx) {
            if (!cx) return 'Conexao sem identificacao';
            const nome = (cx.NomeConexao || cx.instanceName || '').trim();
            const tel = (cx.Telefone || '').trim();
            if (nome && tel) return nome + ' (' + tel + ')';
            if (nome) return nome;
            if (tel) return tel;
            return 'Conexao #' + String(cx.id || '-');
        }

        async function fetchAvailableConnections(contaId) {
            const { data, error } = await window.supabase
                .from('SAAS_Conexões')
                .select('id, NomeConexao, instanceName, Telefone')
                .eq('contaId', contaId)
                .order('NomeConexao', { ascending: true, nullsFirst: false })
                .order('id', { ascending: true });
            if (error) throw error;
            return data || [];
        }

        function openChatConnectionModal(contactCtx, conexoes) {
            const sel = document.getElementById('chatConnectionSelect');
            if (!sel) return;
            sel.innerHTML = (conexoes || []).map(cx =>
                `<option value="${escapeHtml(String(cx.id))}">${escapeHtml(formatConexaoLabelForChat(cx))}</option>`
            ).join('');
            pendingChatContext = contactCtx;
            document.getElementById('chatConnectionModal')?.classList.add('active');
        }

        async function resolveOrCreateConversationForConnection(ctx, idConexao) {
            const digits = ctx.telefoneRaw.replace(/\D/g, '');
            const noSuffix = ctx.telefoneRaw.replace(/@s\.whatsapp\.net$/i, '').trim();
            const telefoneVariants = [...new Set([ctx.telefoneRaw, noSuffix, digits && digits + '@s.whatsapp.net'].filter(Boolean))];

            let conversaId = null;
            const { data: byContato } = await window.supabase
                .from('SAAS_Conversas_Agentes')
                .select('id, ultimaMensagem')
                .eq('contaId', ctx.contaId)
                .eq('contatoId', ctx.contatoId)
                .eq('idConexao', idConexao)
                .order('ultimaMensagem', { ascending: false, nullsFirst: false })
                .limit(1);
            if (byContato && byContato[0]?.id) conversaId = byContato[0].id;

            if (!conversaId && telefoneVariants.length) {
                const { data: byTel } = await window.supabase
                    .from('SAAS_Conversas_Agentes')
                    .select('id, ultimaMensagem')
                    .eq('contaId', ctx.contaId)
                    .eq('idConexao', idConexao)
                    .in('telefone', telefoneVariants)
                    .order('ultimaMensagem', { ascending: false, nullsFirst: false })
                    .limit(1);
                if (byTel && byTel[0]?.id) conversaId = byTel[0].id;
            }

            if (!conversaId) {
                const telefoneInsert = ctx.telefoneRaw.includes('@') ? ctx.telefoneRaw : (noSuffix || ctx.telefoneRaw);
                const insertPayload = {
                    contaId: ctx.contaId,
                    idConexao,
                    telefone: telefoneInsert,
                    contatoId: ctx.contatoId,
                    nomeConversa: ctx.nomeConversa,
                    statusAtendimento: 'aberto',
                    lida: true,
                    pausado: false
                };
                const { data: inserted, error: insErr } = await window.supabase
                    .from('SAAS_Conversas_Agentes')
                    .insert(insertPayload)
                    .select('id')
                    .single();
                if (insErr) {
                    if (insErr.code === '23505') {
                        const { data: again } = await window.supabase
                            .from('SAAS_Conversas_Agentes')
                            .select('id')
                            .eq('contaId', ctx.contaId)
                            .eq('contatoId', ctx.contatoId)
                            .eq('idConexao', idConexao)
                            .maybeSingle();
                        if (again?.id) conversaId = again.id;
                    }
                    if (!conversaId) throw new Error(insErr.message || 'erro');
                } else if (inserted?.id) {
                    conversaId = inserted.id;
                }
            }
            return conversaId;
        }

        async function confirmChatConnection() {
            const ctx = pendingChatContext;
            if (!ctx) return;
            const sel = document.getElementById('chatConnectionSelect');
            const idConexao = Number(sel?.value || 0);
            if (!idConexao) {
                showToast('Selecione uma conexao para continuar.', 'error');
                return;
            }

            const btn = document.getElementById('chatConnectionConfirmBtn');
            if (btn) { btn.disabled = true; btn.textContent = 'Abrindo...'; }
            try {
                const conversaId = await resolveOrCreateConversationForConnection(ctx, idConexao);
                if (!conversaId) {
                    showToast('Nao foi possivel abrir o chat.', 'error');
                    return;
                }
                closeChatConnectionModal();
                window.location.href = CHAT_PAGE_URL + '?conversa=' + encodeURIComponent(String(conversaId));
            } catch (e) {
                showToast('Nao foi possivel abrir a conversa: ' + (e?.message || 'erro'), 'error');
            } finally {
                if (btn) { btn.disabled = false; btn.textContent = 'Conversar'; }
            }
        }

        function rebuildEtiquetaMetaForContact(c) {
            const ids = c.etiquetaIds || [];
            const nomes = [];
            const cores = [];
            ids.forEach(eid => {
                const obj = allEtiquetas[String(eid)] || allEtiquetas[eid];
                const nome = obj && typeof obj === 'object' ? (obj.nome || '-') : (obj || '-');
                const cor = obj && typeof obj === 'object' && obj.cor ? obj.cor : '#6b7280';
                nomes.push(nome);
                cores.push(cor);
            });
            c.etiquetaNomes = nomes;
            c.etiquetaCores = cores;
            c.etiqueta = nomes.length ? nomes.join(', ') : '-';
        }

        function applyEtiquetaToContactMemory(cid, eid, add) {
            const c = allContacts.find(x => x.id === cid);
            if (!c) return;
            const sid = String(eid);
            const set = new Set((c.etiquetaIds || []).map(x => String(x)));
            if (add) set.add(sid); else set.delete(sid);
            c.etiquetaIds = [...set].map(x => parseInt(x, 10)).filter(n => !isNaN(n));
            rebuildEtiquetaMetaForContact(c);
        }

        async function contactDetailSetEtiqueta(etiquetaIdStr, add) {
            const cid = contactDetailId;
            const eid = parseInt(etiquetaIdStr, 10);
            if (cid == null || isNaN(eid)) throw new Error('Dados invalidos.');
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) {
                if (e.message === 'STATUS_BLOQUEADO') throw new Error('Conta bloqueada.');
                throw e;
            }
            if (!contaId) throw new Error('Sessao expirada.');
            if (add) {
                const { error } = await window.supabase.from('SAAS_Contatos_Etiquetas').insert({
                    contatoId: cid, etiquetaId: eid, contaId
                });
                if (error) throw new Error(error.message || 'Erro ao vincular etiqueta.');
            } else {
                const { error } = await window.supabase.from('SAAS_Contatos_Etiquetas').delete()
                    .eq('contatoId', cid).eq('etiquetaId', eid).eq('contaId', contaId);
                if (error) throw new Error(error.message || 'Erro ao remover etiqueta.');
            }
        }

        function buildContactDetailEtiquetaChipsHtml(c) {
            const ids = c.etiquetaIds || [];
            if (!ids.length) {
                return '<span class="contact-detail-etiquetas-empty-hint">Nenhuma etiqueta vinculada.</span>';
            }
            return ids.map(eid => {
                const obj = allEtiquetas[String(eid)] || allEtiquetas[eid];
                const nome = obj && typeof obj === 'object' ? (obj.nome || 'Sem nome') : '-';
                const cor = obj && typeof obj === 'object' && obj.cor ? String(obj.cor).trim() : '#6b7280';
                const safeCor = /^#[0-9a-fA-F]{6}$/i.test(cor) ? cor : '#6b7280';
                const isHex = /^#[0-9a-fA-F]{6}$/.test(safeCor);
                const bg = isHex ? safeCor + '28' : 'rgba(107,114,128,0.2)';
                const eidStr = String(eid);
                return '<span class="contact-detail-etiqueta-chip etiqueta-tag" style="background:' + bg + ';color:' + safeCor + ';border-color:' + safeCor + '33">' +
                    '<span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px">' + escapeHtml(nome) + '</span>' +
                    '<button type="button" class="contact-detail-etiqueta-chip-remove" aria-label="Remover etiqueta" onclick="event.stopPropagation();contactDetailRemoveEtiquetaChip(\'' + eidStr + '\')">&times;</button>' +
                    '</span>';
            }).join('');
        }

        function buildContactDetailEtiquetaPickerRowsHTML(c) {
            const entries = Object.keys(allEtiquetas || {}).map(id => {
                const obj = allEtiquetas[id];
                if (!obj) return null;
                const nome = typeof obj === 'object' ? (obj.nome || 'Sem nome') : String(obj);
                const cor = typeof obj === 'object' && obj.cor ? obj.cor : '#6b7280';
                return { id: String(id), nome, cor };
            }).filter(Boolean).sort((a, b) => a.nome.localeCompare(b.nome, 'pt-BR'));
            if (entries.length === 0) {
                return '<div class="contact-detail-etiqueta-empty">Nenhuma etiqueta na conta. Crie uma nova abaixo ou na barra lateral.</div>';
            }
            const idsSet = new Set((c.etiquetaIds || []).map(x => String(x)));
            return entries.map(({ id, nome, cor }) => {
                const on = idsSet.has(String(id));
                const safeCor = /^#[0-9a-fA-F]{6}$/i.test(String(cor).trim()) ? String(cor).trim() : '#6b7280';
                return '<button type="button" class="contact-detail-etiqueta-pick-row' + (on ? ' is-on' : '') + '" onclick="contactDetailPickerSelectEtiqueta(\'' + id + '\')">' +
                    '<span class="contact-detail-etiqueta-pick-dot" style="background:' + escapeHtml(safeCor) + '"></span>' +
                    '<span class="contact-detail-etiqueta-pick-label">' + escapeHtml(nome) + '</span>' +
                    '<span class="contact-detail-etiqueta-pick-check">' + (on ? '&#10003;' : '') + '</span>' +
                    '</button>';
            }).join('');
        }

        function buildContactDetailEtiquetasWrapHTML(c) {
            return '<div class="contact-detail-etiquetas-wrap">' +
                '<div class="contact-detail-etiquetas-bar">' +
                '<div id="contactDetailEtiquetasChips" class="contact-detail-etiquetas-chips">' + buildContactDetailEtiquetaChipsHtml(c) + '</div>' +
                '<button type="button" class="contact-detail-etiqueta-add" id="contactDetailEtiquetaAddBtn" aria-label="Adicionar etiquetas" aria-expanded="false" onclick="event.stopPropagation();contactDetailToggleEtiquetaPicker()">+</button>' +
                '</div>' +
                '<div id="contactDetailEtiquetaPicker" class="contact-detail-etiqueta-picker" hidden>' +
                '<p class="contact-detail-etiqueta-picker-head">Todas as etiquetas</p>' +
                '<div id="contactDetailEtiquetaPickerList" class="contact-detail-etiqueta-picker-list"></div>' +
                '<button type="button" class="contact-detail-link-new" onclick="openCreateEtiquetaModalFromContactDetail()"><span aria-hidden="true">+</span> Criar nova etiqueta</button>' +
                '</div></div>';
        }

        function contactDetailSyncEtiquetasDom() {
            const cid = contactDetailId;
            if (cid == null) return;
            const c = allContacts.find(x => x.id === cid);
            if (!c) return;
            const chips = document.getElementById('contactDetailEtiquetasChips');
            if (chips) chips.innerHTML = buildContactDetailEtiquetaChipsHtml(c);
            const picker = document.getElementById('contactDetailEtiquetaPicker');
            if (picker && !picker.hidden) {
                const list = document.getElementById('contactDetailEtiquetaPickerList');
                if (list) list.innerHTML = buildContactDetailEtiquetaPickerRowsHTML(c);
            }
        }

        function contactDetailToggleEtiquetaPicker() {
            const p = document.getElementById('contactDetailEtiquetaPicker');
            const b = document.getElementById('contactDetailEtiquetaAddBtn');
            if (!p) return;
            const willOpen = p.hidden;
            p.hidden = !willOpen;
            if (b) b.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
            if (willOpen) {
                const cid = contactDetailId;
                const c = cid != null ? allContacts.find(x => x.id === cid) : null;
                const list = document.getElementById('contactDetailEtiquetaPickerList');
                if (list && c) list.innerHTML = buildContactDetailEtiquetaPickerRowsHTML(c);
            }
        }

        async function contactDetailPickerSelectEtiqueta(etiquetaIdStr) {
            const cid = contactDetailId;
            if (cid == null) return;
            const c = allContacts.find(x => x.id === cid);
            if (!c) return;
            const had = (c.etiquetaIds || []).some(x => String(x) === String(etiquetaIdStr));
            const wantAdd = !had;
            try {
                await contactDetailSetEtiqueta(etiquetaIdStr, wantAdd);
                applyEtiquetaToContactMemory(cid, parseInt(etiquetaIdStr, 10), wantAdd);
                applyFilters();
                contactDetailSyncEtiquetasDom();
                showToast(wantAdd ? 'Etiqueta adicionada.' : 'Etiqueta removida.', 'success');
            } catch (err) {
                showToast((err && err.message) || 'Erro ao atualizar etiquetas.', 'error');
            }
        }

        async function contactDetailRemoveEtiquetaChip(etiquetaIdStr) {
            const cid = contactDetailId;
            if (cid == null) return;
            const c = allContacts.find(x => x.id === cid);
            if (!c) return;
            const had = (c.etiquetaIds || []).some(x => String(x) === String(etiquetaIdStr));
            if (!had) return;
            try {
                await contactDetailSetEtiqueta(etiquetaIdStr, false);
                applyEtiquetaToContactMemory(cid, parseInt(etiquetaIdStr, 10), false);
                applyFilters();
                contactDetailSyncEtiquetasDom();
                showToast('Etiqueta removida.', 'success');
            } catch (err) {
                showToast((err && err.message) || 'Erro ao remover etiqueta.', 'error');
            }
        }

        function openCreateEtiquetaModalFromContactDetail() {
            closeContactDetailEtiquetaPicker();
            openCreateEtiquetaModal();
        }

        async function fetchCrmCardsForContact(contatoId) {
            const { data: cards, error } = await window.supabase
                .from('SAAS_Cards_Quadros')
                .select('id, nome, valor, observacoes, quadroId, etapaQuadroId')
                .eq('contatoId', contatoId);
            if (error || !cards || cards.length === 0) return [];
            const qIds = [...new Set(cards.map(c => c.quadroId).filter(Boolean))];
            const eIds = [...new Set(cards.map(c => c.etapaQuadroId).filter(Boolean))];
            const qMap = {};
            const eMap = {};
            if (qIds.length) {
                const { data: qs } = await window.supabase.from('SAAS_Quadros').select('id, nome').in('id', qIds);
                (qs || []).forEach(q => { qMap[q.id] = q.nome || ('Quadro ' + q.id); });
            }
            if (eIds.length) {
                const { data: es } = await window.supabase.from('SAAS_Etapas_Quadros').select('id, nome').in('id', eIds);
                (es || []).forEach(e => { eMap[e.id] = e.nome || ('Etapa ' + e.id); });
            }
            return cards.map(c => ({
                ...c,
                quadroNome: c.quadroId != null ? (qMap[c.quadroId] || '-') : '-',
                etapaNome: c.etapaQuadroId != null ? (eMap[c.etapaQuadroId] || '-') : '-'
            }));
        }

        function formatConexaoLabelForNota(cx, idConexao) {
            if (cx) {
                const n = (cx.NomeConexao || cx.instanceName || cx.Telefone || '').trim();
                if (n) return n;
            }
            if (idConexao != null && idConexao !== '') return 'Conexao #' + idConexao;
            return 'Conexao nao identificada';
        }

        async function fetchConversationNotasForContact(contatoId, contaId) {
            const { data: rows, error } = await window.supabase
                .from('SAAS_Conversas_Agentes')
                .select('id, nota, idConexao, ultimaMensagem')
                .eq('contaId', contaId)
                .eq('contatoId', contatoId)
                .not('nota', 'is', null);
            if (error) throw error;
            const withNota = (rows || []).filter(r => r.nota != null && String(r.nota).trim() !== '');
            const ids = [...new Set(withNota.map(r => r.idConexao).filter(id => id != null))];
            const cxMap = {};
            if (ids.length > 0) {
                const { data: cxs } = await window.supabase
                    .from('SAAS_Conexões')
                    .select('id, NomeConexao, instanceName, Telefone')
                    .eq('contaId', contaId)
                    .in('id', ids);
                (cxs || []).forEach(cx => { cxMap[cx.id] = cx; });
            }
            const list = withNota.map(r => ({
                conversaId: r.id,
                nota: String(r.nota).trim(),
                idConexao: r.idConexao,
                ultimaMensagem: r.ultimaMensagem,
                conexaoLabel: formatConexaoLabelForNota(cxMap[r.idConexao], r.idConexao)
            }));
            list.sort((a, b) => {
                const ta = a.ultimaMensagem ? new Date(a.ultimaMensagem).getTime() : 0;
                const tb = b.ultimaMensagem ? new Date(b.ultimaMensagem).getTime() : 0;
                if (tb !== ta) return tb - ta;
                return (Number(b.conversaId) || 0) - (Number(a.conversaId) || 0);
            });
            return list;
        }

        function escapeHtmlAttr(s) {
            return String(s ?? '')
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/</g, '&lt;');
        }

        function notaContatoPrecisaExpandir(texto) {
            const t = String(texto || '');
            if (!t.trim()) return false;
            if (t.split(/\r?\n/).length > 3) return true;
            return t.length > 200;
        }

        function openContactDetailNotaCompletaFromBtn(btn) {
            if (!btn) return;
            const enc = btn.getAttribute('data-nota-enc');
            const encTitle = btn.getAttribute('data-nota-title');
            try {
                const text = decodeURIComponent(enc || '');
                const title = encTitle ? decodeURIComponent(encTitle) : 'Nota';
                openContactDetailNotaCompleta(title, text);
            } catch (e) {
                showToast('Nao foi possivel abrir a nota.', 'error');
            }
        }

        function openContactDetailNotaCompleta(titulo, texto) {
            const ov = document.getElementById('modalNotaCompletaContatoOverlay');
            const tEl = document.getElementById('modalNotaCompletaContatoTitulo');
            const bEl = document.getElementById('modalNotaCompletaContatoBody');
            if (!ov || !tEl || !bEl) return;
            tEl.textContent = titulo || 'Nota';
            bEl.textContent = texto || '';
            ov.classList.add('active');
        }

        function closeContactDetailNotaCompleta() {
            document.getElementById('modalNotaCompletaContatoOverlay')?.classList.remove('active');
        }

        function buildContactDetailNotasHtml(notasList) {
            if (!notasList || notasList.length === 0) {
                return '<p class="contact-detail-notas-empty">Nenhuma nota registrada nas conversas vinculadas a este contato.</p>';
            }
            return '<div class="contact-detail-notas-scroll">' + notasList.map(n => {
                const precisa = notaContatoPrecisaExpandir(n.nota);
                const bodyClass = 'contact-detail-note-body' + (precisa ? ' contact-detail-note-body--clamped' : '');
                const enc = escapeHtmlAttr(encodeURIComponent(n.nota || ''));
                const encTit = escapeHtmlAttr(encodeURIComponent(n.conexaoLabel || 'Nota'));
                const expandBtn = precisa
                    ? '<button type="button" class="contact-detail-note-expand" data-nota-enc="' + enc + '" data-nota-title="' + encTit + '" onclick="openContactDetailNotaCompletaFromBtn(this)">Expandir</button>'
                    : '';
                return '<article class="contact-detail-sticky-note">' +
                    '<div class="contact-detail-note-conexao"><span class="contact-detail-note-conexao-dot" aria-hidden="true"></span>' +
                    '<span>' + escapeHtml(n.conexaoLabel) + '</span></div>' +
                    '<p class="' + bodyClass + '">' + escapeHtml(n.nota) + '</p>' +
                    expandBtn +
                    '</article>';
            }).join('') + '</div>';
        }

        function buildContactDetailFloatingSkeletonHtml() {
            function row(side, bubbleMod) {
                return '<div class="contact-detail-msk-row ' + side + '">' +
                    '<div class="contact-detail-msk-avatar"></div>' +
                    '<div class="contact-detail-msk-bubble ' + bubbleMod + '"></div></div>';
            }
            return '<div class="contact-detail-msk" role="status" aria-live="polite" aria-busy="true">' +
                row('is-received', 'contact-detail-msk-bubble--md') +
                row('is-sent', 'contact-detail-msk-bubble--sm') +
                row('is-received', 'contact-detail-msk-bubble--lg') +
                row('is-sent', 'contact-detail-msk-bubble--md') +
                '</div>';
        }

        function buildContactDetailCampoSkeletonHtml() {
            return '<div class="contact-detail-cp-row" role="status" aria-live="polite" aria-busy="true">' +
                '<div style="min-width:0;flex:1;display:flex;flex-direction:column;gap:8px">' +
                '<div class="contact-detail-msk-bubble contact-detail-msk-bubble--sm" style="width:110px;height:12px;border-radius:8px"></div>' +
                '<div class="contact-detail-msk-bubble contact-detail-msk-bubble--md" style="width:min(220px,80%);height:18px;border-radius:8px"></div>' +
                '</div>' +
                '<div class="contact-detail-msk-avatar" style="width:30px;height:30px;border-radius:8px"></div>' +
                '</div>';
        }

        function buildContactDetailCrmHtml(crmItems) {
            if (!crmItems || crmItems.length === 0) {
                return '<p class="contact-detail-crm-empty">Nenhum card de CRM vinculado a este contato.</p>';
            }
            const inner = crmItems.map(card => {
                const valStr = card.valor != null && card.valor !== '' ? 'Valor: ' + card.valor : '';
                const obs = card.observacoes ? escapeHtml(card.observacoes) : '';
                const qid = card.quadroId;
                const cidCard = card.id;
                const podeAbrirQuadro = qid != null && String(qid).trim() !== '' && cidCard != null && String(cidCard).trim() !== '';
                const btnOlho = podeAbrirQuadro
                    ? '<button type="button" class="contact-detail-crm-open-etapas" title="Ver no quadro CRM" aria-label="Abrir este card no CRM Etapas" onclick="openContactDetailCardInCrmEtapas(' + JSON.stringify(String(qid)) + ',' + JSON.stringify(String(cidCard)) + ')"><span class="material-symbols-rounded" aria-hidden="true">visibility</span></button>'
                    : '';
                const linhaQuadro = 'Quadro: ' + escapeHtml(card.quadroNome) + ' · Etapa: ' + escapeHtml(card.etapaNome);
                const primeiraLinha = btnOlho
                    ? '<div class="contact-detail-crm-toprow">' +
                        '<div class="contact-detail-crm-meta contact-detail-crm-meta--grow">' + linhaQuadro + '</div>' +
                        btnOlho +
                        '</div>'
                    : '<div class="contact-detail-crm-meta">' + linhaQuadro + '</div>';
                return '<div class="contact-detail-crm-item">' +
                    primeiraLinha +
                    (valStr ? '<div class="contact-detail-crm-meta" style="margin-top:4px;">' + escapeHtml(valStr) + '</div>' : '') +
                    (obs ? '<div class="contact-detail-crm-meta" style="margin-top:6px;">' + obs + '</div>' : '') +
                    '</div>';
            }).join('');
            return '<div class="contact-detail-crm-scroll">' + inner + '</div>';
        }

        async function openContactDetailModal(id) {
            closeRowMenu();
            const c = allContacts.find(x => x.id === id);
            if (!c) return;
            contactDetailId = id;
            const isGrupo = c.tipo === 'grupo';
            const phoneFull = isGrupo ? (c.variaveis?.whatsappId || '') : (c.telefone || '');
            const phoneShow = isGrupo ? phoneFull : getDisplayPhone(c);
            const titleEl = document.getElementById('contactDetailModalTitle');
            const subEl = document.getElementById('contactDetailModalSubtitle');
            const bodyEl = document.getElementById('contactDetailModalBody');
            const btnConv = document.getElementById('contactDetailConversarBtn');
            if (titleEl) titleEl.textContent = c.nome || 'Detalhes do contato';
            if (subEl) {
                const bits = [];
                if (phoneShow) bits.push(phoneShow);
                bits.push(isGrupo ? 'Grupo WhatsApp' : 'Contato');
                subEl.textContent = bits.join(' · ');
            }
            if (btnConv) {
                btnConv.disabled = isGrupo;
                btnConv.title = isGrupo ? 'Chat disponivel apenas para contatos individuais (nao grupos).' : '';
            }

            const heroTipoClass = isGrupo ? 'grupo' : 'contato';
            const lidStr = c.lid != null && c.lid !== '' && c.lid !== false ? String(c.lid) : '';
            const asyncSkel = buildContactDetailFloatingSkeletonHtml();
            const asyncSkelCampos = buildContactDetailCampoSkeletonHtml();

            if (bodyEl) {
                bodyEl.innerHTML =
                    '<div class="contact-detail-hero">' +
                    buildContactDetailHeroAvatarHtml(c) +
                    '<div class="contact-detail-hero-text">' +
                    '<span class="tipo-pill ' + heroTipoClass + '">' + escapeHtml(isGrupo ? 'Grupo' : 'Contato') + '</span>' +
                    '</div></div>' +
                    '<div class="contact-detail-card">' +
                    '<h3 class="contact-detail-card-title">Dados</h3>' +
                    '<div class="contact-detail-rows">' +
                    '<div class="contact-detail-row"><span class="cdr-k">Telefone / ID</span><span class="cdr-v">' + escapeHtml(phoneShow || '-') + '</span></div>' +
                    '<div class="contact-detail-row"><span class="cdr-k">E-mail</span><span class="cdr-v">' + escapeHtml(c.email || '-') + '</span></div>' +
                    '<div class="contact-detail-row"><span class="cdr-k">Criado em</span><span class="cdr-v">' + escapeHtml(formatDate(c.created_at)) + '</span></div>' +
                    (lidStr ? '<div class="contact-detail-row"><span class="cdr-k">LID</span><span class="cdr-v">' + escapeHtml(lidStr) + '</span></div>' : '') +
                    '</div></div>' +
                    '<div class="contact-detail-card">' +
                    '<h3 class="contact-detail-card-title">Etiquetas</h3>' +
                    '<p class="contact-detail-card-hint">Etiquetas vinculadas ao contato. Toque em + para incluir ou remover.</p>' +
                    buildContactDetailEtiquetasWrapHTML(c) +
                    '</div>' +
                    '<div class="contact-detail-card">' +
                    '<h3 class="contact-detail-card-title">Campos personalizados</h3>' +
                    '<p class="contact-detail-card-hint">Valores definidos para este contato. Use + para atribuir ou alterar.</p>' +
                    '<div class="contact-detail-cp-bar">' +
                    '<div class="contact-detail-cp-list contact-detail-scroll-max-5-cp" id="contactDetailCamposPersonalizadosMount">' + asyncSkelCampos + '</div>' +
                    '<button type="button" class="contact-detail-cp-add" title="Atribuir valor" aria-label="Adicionar campo" onclick="openModalCampoPersonalizadoValor()">+</button>' +
                    '</div></div>' +
                    '<div class="contact-detail-card">' +
                    '<h3 class="contact-detail-card-title">Notas das conversas</h3>' +
                    '<p class="contact-detail-card-hint">Notas salvas no chat, por conexao WhatsApp.</p>' +
                    '<div id="contactDetailNotasMount">' + asyncSkel + '</div></div>' +
                    '<div class="contact-detail-card">' +
                    '<h3 class="contact-detail-card-title">CRM</h3>' +
                    '<div id="contactDetailCrmMount">' + asyncSkel + '</div></div>';
            }
            document.getElementById('contactDetailModal')?.classList.add('active');

            const openedForId = id;
            let crmItems = [];
            let notasList = [];
            try {
                let contaId = null;
                try {
                    contaId = await obterUserIdComStatus();
                } catch (e) {
                    if (e.message !== 'STATUS_BLOQUEADO') throw e;
                }
                const pCrm = fetchCrmCardsForContact(openedForId);
                const pNotas = contaId ? fetchConversationNotasForContact(openedForId, contaId) : Promise.resolve([]);
                [crmItems, notasList] = await Promise.all([pCrm, pNotas]);
            } catch (e) {
                if (e.message !== 'STATUS_BLOQUEADO') {
                    console.warn('Detalhe contato (CRM/notas):', e);
                }
                crmItems = [];
                notasList = [];
            }

            if (contactDetailId !== openedForId) return;
            const crmEl = document.getElementById('contactDetailCrmMount');
            const notasEl = document.getElementById('contactDetailNotasMount');
            if (crmEl) crmEl.innerHTML = buildContactDetailCrmHtml(crmItems);
            if (notasEl) notasEl.innerHTML = buildContactDetailNotasHtml(notasList);
            void refreshContactDetailCamposPersonalizados(openedForId);
        }

        function formatValorCampoExibicao(tipo, valor) {
            if (valor == null || String(valor).trim() === '') return '—';
            const t = String(tipo || 'texto');
            if (t === 'boolean') {
                const s = String(valor).toLowerCase();
                if (s === 'true' || s === '1' || s === 'sim') return 'Sim';
                if (s === 'false' || s === '0' || s === 'nao' || s === 'não') return 'Não';
                return String(valor);
            }
            if (t === 'data') {
                const d = String(valor).slice(0, 10);
                if (/^\d{4}-\d{2}-\d{2}$/.test(d)) {
                    const [y, mo, da] = d.split('-');
                    return da + '/' + mo + '/' + y;
                }
                return String(valor);
            }
            return String(valor);
        }

        async function refreshContactDetailCamposPersonalizados(contatoId) {
            const mount = document.getElementById('contactDetailCamposPersonalizadosMount');
            if (!mount || contatoId == null) return;
            try {
                let contaId = null;
                try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message !== 'STATUS_BLOQUEADO') throw e; }
                if (!contaId || !window.supabase) {
                    mount.innerHTML = '<p class="contact-detail-etiquetas-empty-hint">Sessao indisponivel.</p>';
                    return;
                }
                let rows = [];
                const qEmb = await window.supabase
                    .from('SAAS_Valores_Campos_Personalizados')
                    .select('id, idCampo, valor, SAAS_Campos_Personalizados(nome, tipo)')
                    .eq('idContato', contatoId)
                    .eq('contaId', contaId);
                if (!qEmb.error && qEmb.data) {
                    rows = (qEmb.data || []).map(row => {
                        const rel = row.SAAS_Campos_Personalizados;
                        const cp = rel && !Array.isArray(rel) ? rel : (Array.isArray(rel) && rel[0] ? rel[0] : null);
                        return {
                            id: row.id,
                            idCampo: row.idCampo,
                            valor: row.valor,
                            _nome: cp ? cp.nome : null,
                            _tipo: cp ? cp.tipo : null
                        };
                    });
                } else {
                    const { data: vals, error: e1 } = await window.supabase
                        .from('SAAS_Valores_Campos_Personalizados')
                        .select('id, idCampo, valor')
                        .eq('idContato', contatoId)
                        .eq('contaId', contaId);
                    if (e1) throw e1;
                    const base = vals || [];
                    if (base.length === 0) {
                        mount.innerHTML = '<p class="contact-detail-etiquetas-empty-hint">Nenhum valor preenchido.</p>';
                        return;
                    }
                    const ids = [...new Set(base.map(r => r.idCampo).filter(Boolean))];
                    const { data: campos, error: e2 } = await window.supabase
                        .from('SAAS_Campos_Personalizados')
                        .select('id, nome, tipo')
                        .eq('contaId', contaId)
                        .in('id', ids);
                    if (e2) throw e2;
                    const cmap = {};
                    (campos || []).forEach(cp => { cmap[cp.id] = cp; });
                    rows = base.map(r => ({
                        id: r.id,
                        idCampo: r.idCampo,
                        valor: r.valor,
                        _nome: cmap[r.idCampo] ? cmap[r.idCampo].nome : null,
                        _tipo: cmap[r.idCampo] ? cmap[r.idCampo].tipo : null
                    }));
                }
                if (rows.length === 0) {
                    mount.innerHTML = '<p class="contact-detail-etiquetas-empty-hint">Nenhum valor preenchido.</p>';
                    return;
                }
                const sorted = rows.slice().sort((a, b) => {
                    const na = (a._nome || '').localeCompare(b._nome || '', 'pt-BR');
                    return na;
                });
                mount.innerHTML = sorted.map(r => {
                    const nome = r._nome != null ? r._nome : ('Campo #' + r.idCampo);
                    const tipo = r._tipo != null ? r._tipo : 'texto';
                    const vid = Number(r.id);
                    const idCampoNum = Number(r.idCampo);
                    const disp = formatValorCampoExibicao(tipo, r.valor);
                    const rawVal = r.valor == null ? '' : String(r.valor);
                    const encTipo = encodeURIComponent(String(tipo));
                    const encRaw = encodeURIComponent(rawVal);
                    return '<div class="contact-detail-cp-row">' +
                        '<div><p class="contact-detail-cp-row-k">' + escapeHtml(nome) + '</p>' +
                        '<p class="contact-detail-cp-row-v">' + escapeHtml(disp) + '</p></div>' +
                        '<div class="contact-detail-cp-actions">' +
                        '<button type="button" class="contact-detail-cp-edit" aria-label="Editar valor" data-cp-vid="' + vid + '" data-cp-campo="' + idCampoNum + '" data-cp-tipo="' + escapeHtml(encTipo) + '" data-cp-raw="' + escapeHtml(encRaw) + '" onclick="editarModalCampoPersonalizadoValorFromBtn(this)"><span class="material-symbols-rounded" style="font-size:18px;line-height:1" aria-hidden="true">edit</span></button>' +
                        '<button type="button" class="contact-detail-cp-remove" aria-label="Remover valor" onclick="removerValorCampoPersonalizado(' + vid + ')">&times;</button>' +
                        '</div></div>';
                }).join('');
            } catch (err) {
                if (err && err.message !== 'STATUS_BLOQUEADO') console.warn('Campos personalizados:', err);
                mount.innerHTML = '<p class="contact-detail-etiquetas-empty-hint">Nao foi possivel carregar.</p>';
            }
        }

        async function removerValorCampoPersonalizado(valorId) {
            if (!valorId || !window.supabase) return;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; showToast('Sessao invalida.', 'error'); return; }
            if (!contaId) return;
            try {
                const { error } = await window.supabase.from('SAAS_Valores_Campos_Personalizados').delete().eq('id', valorId).eq('contaId', contaId);
                if (error) throw error;
                showToast('Valor removido.', 'success');
                if (contactDetailId != null) await refreshContactDetailCamposPersonalizados(contactDetailId);
            } catch (e) {
                showToast('Nao foi possivel remover.', 'error');
            }
        }

        function mountModalCampoValorInputByTipo(tipo) {
            const wrap = document.getElementById('modalCampoValorDynamicMount');
            const lbl = document.getElementById('modalCampoValorValueLabel');
            if (!wrap) return;
            const t = String(tipo || 'texto');
            if (lbl) lbl.textContent = t === 'boolean' ? 'Valor' : 'Valor';
            if (t === 'boolean') {
                wrap.innerHTML = '<select id="modalCampoValorBoolean" class="form-select"><option value="true">Sim</option><option value="false">Não</option></select>';
                return;
            }
            if (t === 'numero') {
                wrap.innerHTML = '<input type="number" id="modalCampoValorInputNum" class="form-input" step="any" placeholder="0">';
                return;
            }
            if (t === 'data') {
                wrap.innerHTML = '<input type="date" id="modalCampoValorInputDate" class="form-input">';
                return;
            }
            wrap.innerHTML = '<input type="text" id="modalCampoValorInputText" class="form-input" placeholder="Digite o valor">';
        }

        function onModalCampoValorSelectChange() {
            const sel = document.getElementById('modalCampoValorSelect');
            if (!sel) return;
            if (!sel.value || sel.value === '') {
                const wrap = document.getElementById('modalCampoValorDynamicMount');
                const lbl = document.getElementById('modalCampoValorValueLabel');
                if (lbl) lbl.textContent = 'Valor';
                if (wrap) {
                    wrap.innerHTML = '<input type="text" id="modalCampoValorInputText" class="form-input" placeholder="Selecione um campo acima" disabled>';
                }
                return;
            }
            const opt = sel.options[sel.selectedIndex];
            const tipo = opt ? (opt.getAttribute('data-tipo') || 'texto') : 'texto';
            mountModalCampoValorInputByTipo(tipo);
        }

        async function openModalCampoPersonalizadoValor() {
            modalCampoValorRowId = null;
            bulkCampoTargetIds = null;
            const titulo = document.getElementById('modalCampoPersonalizadoTitulo');
            if (titulo) titulo.textContent = 'Atribuir campo';
            const modal = document.getElementById('modalCampoPersonalizadoValor');
            const sel = document.getElementById('modalCampoValorSelect');
            if (!modal || !sel || contactDetailId == null) return;
            sel.disabled = false;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; showToast('Sessao invalida.', 'error'); return; }
            if (!contaId || !window.supabase) { showToast('Sessao invalida.', 'error'); return; }
            try {
                const { data: campos, error } = await window.supabase
                    .from('SAAS_Campos_Personalizados')
                    .select('id, nome, tipo')
                    .eq('contaId', contaId)
                    .order('nome', { ascending: true });
                if (error) throw error;
                const list = campos || [];
                if (list.length === 0) {
                    showToast('Cadastre campos em Configuracoes primeiro.', 'info');
                    return;
                }
                sel.innerHTML = '<option value="" selected>Selecione um campo</option>' + list.map(c =>
                    '<option value="' + escapeHtml(String(c.id)) + '" data-tipo="' + escapeHtml(String(c.tipo || 'texto')) + '">' + escapeHtml(c.nome || ('Campo ' + c.id)) + '</option>'
                ).join('');
                onModalCampoValorSelectChange();
                modal.classList.add('active');
            } catch (e) {
                showToast('Nao foi possivel carregar os campos.', 'error');
            }
        }

        function closeModalCampoPersonalizadoValor() {
            modalCampoValorRowId = null;
            bulkCampoTargetIds = null;
            const sel = document.getElementById('modalCampoValorSelect');
            if (sel) sel.disabled = false;
            const titulo = document.getElementById('modalCampoPersonalizadoTitulo');
            if (titulo) titulo.textContent = 'Atribuir campo';
            document.getElementById('modalCampoPersonalizadoValor')?.classList.remove('active');
        }

        async function openBulkModalCampoAdd(contatoIds) {
            if (!contatoIds || !contatoIds.length) return;
            bulkCampoTargetIds = contatoIds.map(Number).filter(n => Number.isFinite(n) && n > 0);
            if (!bulkCampoTargetIds.length) return;
            modalCampoValorRowId = null;
            const titulo = document.getElementById('modalCampoPersonalizadoTitulo');
            if (titulo) titulo.textContent = 'Adicionar campo (em massa)';
            const modal = document.getElementById('modalCampoPersonalizadoValor');
            const sel = document.getElementById('modalCampoValorSelect');
            if (!modal || !sel) return;
            sel.disabled = false;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; showToast('Sessao invalida.', 'error'); return; }
            if (!contaId || !window.supabase) { showToast('Sessao invalida.', 'error'); return; }
            try {
                const { data: campos, error } = await window.supabase
                    .from('SAAS_Campos_Personalizados')
                    .select('id, nome, tipo')
                    .eq('contaId', contaId)
                    .order('nome', { ascending: true });
                if (error) throw error;
                const list = campos || [];
                if (list.length === 0) {
                    bulkCampoTargetIds = null;
                    if (titulo) titulo.textContent = 'Atribuir campo';
                    showToast('Cadastre campos em Configuracoes primeiro.', 'info');
                    return;
                }
                sel.innerHTML = '<option value="" selected>Selecione um campo</option>' + list.map(c =>
                    '<option value="' + escapeHtml(String(c.id)) + '" data-tipo="' + escapeHtml(String(c.tipo || 'texto')) + '">' + escapeHtml(c.nome || ('Campo ' + c.id)) + '</option>'
                ).join('');
                onModalCampoValorSelectChange();
                modal.classList.add('active');
            } catch (e) {
                bulkCampoTargetIds = null;
                if (titulo) titulo.textContent = 'Atribuir campo';
                showToast('Nao foi possivel carregar os campos.', 'error');
            }
        }

        function editarModalCampoPersonalizadoValorFromBtn(btn) {
            if (!btn) return;
            const vid = Number(btn.getAttribute('data-cp-vid'));
            const idCampo = Number(btn.getAttribute('data-cp-campo'));
            let tipo = 'texto';
            let rawVal = '';
            try { tipo = decodeURIComponent(btn.getAttribute('data-cp-tipo') || 'texto'); } catch (e) { tipo = 'texto'; }
            try { rawVal = decodeURIComponent(btn.getAttribute('data-cp-raw') || ''); } catch (e) { rawVal = ''; }
            if (!Number.isFinite(vid) || !Number.isFinite(idCampo)) return;
            editarModalCampoPersonalizadoValor(vid, idCampo, tipo, rawVal);
        }

        function editarModalCampoPersonalizadoValor(vid, idCampo, tipo, valorRaw) {
            modalCampoValorRowId = vid;
            bulkCampoTargetIds = null;
            const tituloEd = document.getElementById('modalCampoPersonalizadoTitulo');
            if (tituloEd) tituloEd.textContent = 'Atribuir campo';
            const sel = document.getElementById('modalCampoValorSelect');
            const modal = document.getElementById('modalCampoPersonalizadoValor');
            if (!sel || !modal || contactDetailId == null) return;
            sel.disabled = true;
            void (async () => {
                let contaId;
                try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; showToast('Sessao invalida.', 'error'); return; }
                if (!contaId || !window.supabase) return;
                try {
                    const { data: campos, error } = await window.supabase
                        .from('SAAS_Campos_Personalizados')
                        .select('id, nome, tipo')
                        .eq('contaId', contaId)
                        .order('nome', { ascending: true });
                    if (error) throw error;
                    const list = campos || [];
                    sel.innerHTML = list.map(c =>
                        '<option value="' + escapeHtml(String(c.id)) + '" data-tipo="' + escapeHtml(String(c.tipo || 'texto')) + '">' + escapeHtml(c.nome || ('Campo ' + c.id)) + '</option>'
                    ).join('');
                    sel.value = String(idCampo);
                    if (sel.value !== String(idCampo)) {
                        showToast('Campo nao encontrado.', 'error');
                        sel.disabled = false;
                        modalCampoValorRowId = null;
                        return;
                    }
                    onModalCampoValorSelectChange();
                    const t = String(tipo || 'texto');
                    const v = valorRaw == null ? '' : String(valorRaw);
                    if (t === 'boolean') {
                        const b = document.getElementById('modalCampoValorBoolean');
                        if (b) b.value = (v === 'true' || v === '1' || v.toLowerCase() === 'sim') ? 'true' : 'false';
                    } else if (t === 'numero') {
                        const n = document.getElementById('modalCampoValorInputNum');
                        if (n) n.value = v;
                    } else if (t === 'data') {
                        const d = document.getElementById('modalCampoValorInputDate');
                        if (d) d.value = v.length >= 10 ? v.slice(0, 10) : v;
                    } else {
                        const tx = document.getElementById('modalCampoValorInputText');
                        if (tx) tx.value = v;
                    }
                    modal.classList.add('active');
                } catch (e) {
                    showToast('Nao foi possivel abrir edicao.', 'error');
                    sel.disabled = false;
                    modalCampoValorRowId = null;
                }
            })();
        }

        async function salvarModalCampoPersonalizadoValor() {
            const sel = document.getElementById('modalCampoValorSelect');
            if (!sel || !window.supabase) return;
            const bulkIds = Array.isArray(bulkCampoTargetIds) && bulkCampoTargetIds.length ? bulkCampoTargetIds.slice() : null;
            if (!bulkIds && contactDetailId == null) return;
            const idCampo = parseInt(sel.value, 10);
            if (!Number.isFinite(idCampo)) { showToast('Selecione um campo.', 'error'); return; }
            const isEdit = modalCampoValorRowId != null;
            if (bulkIds && isEdit) {
                showToast('Edicao em massa nao suportada.', 'error');
                return;
            }
            const opt = sel.options[sel.selectedIndex];
            const tipo = opt ? (opt.getAttribute('data-tipo') || 'texto') : 'texto';
            let valorStr = '';
            if (tipo === 'boolean') {
                const b = document.getElementById('modalCampoValorBoolean');
                valorStr = b ? String(b.value) : 'false';
            } else if (tipo === 'numero') {
                const n = document.getElementById('modalCampoValorInputNum');
                if (!n || n.value === '' || n.value == null) { showToast('Informe um numero.', 'error'); return; }
                valorStr = String(n.value);
            } else if (tipo === 'data') {
                const d = document.getElementById('modalCampoValorInputDate');
                if (!d || !d.value) { showToast('Informe a data.', 'error'); return; }
                valorStr = d.value;
            } else {
                const t = document.getElementById('modalCampoValorInputText');
                valorStr = (t && t.value != null) ? String(t.value).trim() : '';
                if (valorStr === '') { showToast('Informe o valor.', 'error'); return; }
            }
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; showToast('Sessao invalida.', 'error'); return; }
            if (!contaId) return;
            const btn = document.getElementById('modalCampoValorSalvarBtn');
            if (btn) btn.disabled = true;
            try {
                if (bulkIds && bulkIds.length) {
                    const rows = bulkIds.map(idContato => ({ idCampo, idContato, contaId, valor: valorStr }));
                    const CHUNK = 80;
                    for (let i = 0; i < rows.length; i += CHUNK) {
                        const batch = rows.slice(i, i + CHUNK);
                        const { error } = await window.supabase.from('SAAS_Valores_Campos_Personalizados').upsert(batch, { onConflict: 'idCampo,idContato' });
                        if (error) throw error;
                    }
                    showToast('Campo aplicado a ' + bulkIds.length + ' contato(s).', 'success');
                    closeModalCampoPersonalizadoValor();
                    contactsBulkClearSelection();
                    await loadContacts();
                } else if (isEdit) {
                    const { error } = await window.supabase
                        .from('SAAS_Valores_Campos_Personalizados')
                        .update({ valor: valorStr })
                        .eq('id', modalCampoValorRowId)
                        .eq('contaId', contaId);
                    if (error) throw error;
                    showToast('Valor salvo.', 'success');
                    closeModalCampoPersonalizadoValor();
                    await refreshContactDetailCamposPersonalizados(contactDetailId);
                } else {
                    const { error } = await window.supabase.from('SAAS_Valores_Campos_Personalizados').upsert(
                        { idCampo, idContato: contactDetailId, contaId, valor: valorStr },
                        { onConflict: 'idCampo,idContato' }
                    );
                    if (error) throw error;
                    showToast('Valor salvo.', 'success');
                    closeModalCampoPersonalizadoValor();
                    await refreshContactDetailCamposPersonalizados(contactDetailId);
                }
            } catch (e) {
                console.warn(e);
                showToast('Nao foi possivel salvar.', 'error');
            } finally {
                if (btn) btn.disabled = false;
            }
        }

        async function goToChatWithContact() {
            const id = contactDetailId;
            if (id == null) return;
            const c = allContacts.find(x => x.id === id);
            if (!c || c.tipo === 'grupo') {
                showToast('Conversar esta disponivel apenas para contatos individuais.', 'error');
                return;
            }
            const telefoneRaw = (c.telefone || '').trim();
            if (!telefoneRaw) {
                showToast('Contato sem telefone. Edite o contato antes de abrir o chat.', 'error');
                return;
            }

            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; throw e; }
            if (!contaId) { showToast('Sessao expirada. Faca login novamente.', 'error'); return; }

            const btn = document.getElementById('contactDetailConversarBtn');
            if (btn) { btn.disabled = true; btn.textContent = 'Abrindo...'; }
            try {
                const conexoes = await fetchAvailableConnections(contaId);
                if (!conexoes.length) {
                    showToast('Cadastre pelo menos uma conexao WhatsApp para iniciar conversas.', 'error');
                    return;
                }
                const ctx = {
                    contaId,
                    contatoId: id,
                    telefoneRaw,
                    nomeConversa: (c.nome || '').trim() || null
                };
                if (conexoes.length === 1) {
                    const conversaId = await resolveOrCreateConversationForConnection(ctx, Number(conexoes[0].id));
                    if (!conversaId) {
                        showToast('Nao foi possivel abrir o chat.', 'error');
                        return;
                    }
                    window.location.href = CHAT_PAGE_URL + '?conversa=' + encodeURIComponent(String(conversaId));
                    return;
                }
                openChatConnectionModal(ctx, conexoes);
            } catch (e) {
                showToast('Erro ao carregar conexoes: ' + (e?.message || 'erro'), 'error');
            } finally {
                if (btn) { btn.disabled = false; btn.textContent = 'Conversar'; }
            }
        }

        function pruneBulkSelectionToFiltered() {
            if (!hasActiveContactFilters()) return;
            if (filteredServerMode) return;
            const allowed = new Set(filteredContacts.map(c => normBulkContactId(c.id)).filter(k => k != null));
            [...bulkSelectedContactIds].forEach(id => {
                if (!allowed.has(id)) bulkSelectedContactIds.delete(id);
            });
        }

        function getBulkSelectedIdsResolved() {
            if (!hasActiveContactFilters()) {
                return [...bulkSelectedContactIds].map(Number).filter(id => Number.isFinite(id) && id > 0);
            }
            if (filteredServerMode) {
                return [...bulkSelectedContactIds].map(Number).filter(id => Number.isFinite(id) && id > 0);
            }
            const allowed = new Set(filteredContacts.map(c => normBulkContactId(c.id)).filter(k => k != null));
            return [...bulkSelectedContactIds].map(Number).filter(id => Number.isFinite(id) && id > 0 && allowed.has(id));
        }

        /** Alinha os checkboxes das linhas com `bulkSelectedContactIds` (ex.: após “selecionar desta página” sem re-render). */
        function syncContactsRowCheckboxesFromBulk() {
            const tbody = document.getElementById('contactsTableBody');
            if (!tbody) return;
            tbody.querySelectorAll('input.contacts-row-checkbox').forEach(inp => {
                const k = normBulkContactId(inp.getAttribute('data-bulk-cid'));
                inp.checked = k != null && bulkSelectedContactIds.has(k);
            });
        }

        function updateContactsBulkBarUI() {
            const bar = document.getElementById('contactsBulkBar');
            const countEl = document.getElementById('contactsBulkCount');
            const n = bulkSelectedContactIds.size;
            if (bar) bar.classList.toggle('is-visible', n > 0);
            if (countEl) countEl.textContent = n === 1 ? '1 contato selecionado' : (n + ' contatos selecionados');
            const start = (currentPage - 1) * contactsPerPage;
            const pageContacts = filteredContacts.slice(start, start + contactsPerPage);
            const pageIds = pageContacts.map(c => normBulkContactId(c.id)).filter(k => k != null);
            const selAll = document.getElementById('contactsSelectAllPage');
            if (selAll && pageIds.length) {
                const nSel = pageIds.filter(id => bulkSelectedContactIds.has(id)).length;
                selAll.checked = nSel === pageIds.length;
                selAll.indeterminate = nSel > 0 && nSel < pageIds.length;
            } else if (selAll) {
                selAll.checked = false;
                selAll.indeterminate = false;
            }
            const nf = hasActiveContactFilters() ? (filteredServerMode ? filteredTotalCount : filteredContacts.length) : totalContactsCount;
            const linkAll = document.getElementById('contactsBulkSelectAllFilteredBtn');
            if (linkAll) {
                const allFilteredSelected = nf > 0 && n >= nf;
                linkAll.hidden = allFilteredSelected;
                linkAll.disabled = nf === 0;
            }
            syncContactsRowCheckboxesFromBulk();
        }

        async function contactsSelectAllFiltered(ev) {
            if (ev) ev.stopPropagation();
            closeContactsBulkMenu();
            const nf = hasActiveContactFilters() ? (filteredServerMode ? filteredTotalCount : filteredContacts.length) : totalContactsCount;
            if (!nf) return;
            bulkSelectedContactIds.clear();
            if (hasActiveContactFilters() && currentContaIdForContacts && window.supabase) {
                const f = getCurrentContactsFilterState();
                const filteredInfo = await getFilteredOrderedContactIds(currentContaIdForContacts, f);
                const orderedIds = Array.isArray(filteredInfo?.orderedIds) ? filteredInfo.orderedIds : [];
                orderedIds.forEach(id => {
                    const k = normBulkContactId(id);
                    if (k != null) bulkSelectedContactIds.add(k);
                });
            } else if (currentContaIdForContacts && window.supabase) {
                // Sem filtros: selecionar todos os contatos da conta, mesmo os ainda não carregados na UI.
                const CHUNK = 1000;
                let from = 0;
                while (true) {
                    const { data, error } = await window.supabase
                        .from('SAAS_Contatos')
                        .select('id')
                        .eq('contaId', currentContaIdForContacts)
                        .order('id', { ascending: true })
                        .range(from, from + CHUNK - 1);
                    if (error) {
                        showToast('Nao foi possivel selecionar todos os contatos.', 'error');
                        break;
                    }
                    const rows = Array.isArray(data) ? data : [];
                    rows.forEach(r => {
                        const k = normBulkContactId(r.id);
                        if (k != null) bulkSelectedContactIds.add(k);
                    });
                    if (rows.length < CHUNK) break;
                    from += CHUNK;
                }
            }
            renderTable();
        }

        function onContactsSelectAllPageChange(ev) {
            ev.stopPropagation();
            const checked = ev.target.checked;
            const start = (currentPage - 1) * contactsPerPage;
            const pageContacts = filteredContacts.slice(start, start + contactsPerPage);
            if (!checked) {
                bulkSelectedContactIds.clear();
            } else {
                pageContacts.forEach(c => {
                    const id = normBulkContactId(c.id);
                    if (id == null) return;
                    bulkSelectedContactIds.add(id);
                });
            }
            updateContactsBulkBarUI();
            closeContactsBulkMenu();
        }

        function onBulkRowCheckboxChange(ev, id) {
            ev.stopPropagation();
            const nid = normBulkContactId(id);
            if (nid == null) return;
            if (ev.target.checked) bulkSelectedContactIds.add(nid);
            else bulkSelectedContactIds.delete(nid);
            updateContactsBulkBarUI();
        }

        function contactsBulkClearSelection() {
            bulkSelectedContactIds.clear();
            closeContactsBulkMenu();
            updateContactsBulkBarUI();
            renderTable();
        }

        function toggleContactsBulkMenu(ev) {
            ev.stopPropagation();
            document.getElementById('contactsBulkMenu')?.classList.toggle('is-open');
        }

        function closeContactsBulkMenu() {
            document.getElementById('contactsBulkMenu')?.classList.remove('is-open');
        }

        function contactsBulkMenuAction(kind) {
            closeContactsBulkMenu();
            const ids = getBulkSelectedIdsResolved();
            if (!ids.length) {
                showToast('Selecione ao menos um contato.', 'error');
                return;
            }
            if (kind === 'addEtiqueta') openBulkAddEtiquetaModal(ids);
            else if (kind === 'removeEtiqueta') openBulkRemoveEtiquetaModal(ids);
            else if (kind === 'clearCampo') void openBulkClearCampoModal(ids);
            else if (kind === 'addCampo') void openBulkModalCampoAdd(ids);
            else if (kind === 'deleteContacts') openBulkDeleteManyModal(ids);
            else if (kind === 'removeCrm') void openBulkRemoveCrmModal(ids);
            else if (kind === 'linkCrm') void openBulkLinkCrmModal(ids);
        }

        function buildEtiquetasSelectOptionsHtml() {
            const entries = Object.entries(allEtiquetas || {});
            if (!entries.length) return '';
            return entries.map(([id, obj]) => {
                const nome = typeof obj === 'object' ? (obj.nome || ('Etiqueta ' + id)) : String(obj);
                return '<option value="' + escapeHtml(String(id)) + '">' + escapeHtml(nome) + '</option>';
            }).join('');
        }

        function openBulkAddEtiquetaModal(ids) {
            const htmlOpts = buildEtiquetasSelectOptionsHtml();
            if (!htmlOpts) {
                showToast('Nao ha etiquetas cadastradas.', 'info');
                return;
            }
            const sub = document.getElementById('bulkAddEtiquetaSubtitle');
            if (sub) sub.textContent = 'Aplicar aos ' + ids.length + ' contato(s) selecionado(s).';
            const sel = document.getElementById('bulkAddEtiquetaSelect');
            if (sel) sel.innerHTML = htmlOpts;
            document.getElementById('bulkAddEtiquetaModal')?.classList.add('active');
        }

        function closeBulkAddEtiquetaModal() {
            document.getElementById('bulkAddEtiquetaModal')?.classList.remove('active');
        }

        async function executeBulkAddEtiqueta() {
            const sel = document.getElementById('bulkAddEtiquetaSelect');
            const btn = document.getElementById('bulkAddEtiquetaConfirmBtn');
            const eid = sel ? parseInt(sel.value, 10) : NaN;
            if (!Number.isFinite(eid)) { showToast('Selecione uma etiqueta.', 'error'); return; }
            const ids = getBulkSelectedIdsResolved();
            if (!ids.length) return;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; return; }
            if (!contaId || !window.supabase) return;
            if (btn) btn.disabled = true;
            try {
                const CHUNK_IN = 200;
                let applied = 0;
                for (let i = 0; i < ids.length; i += CHUNK_IN) {
                    const slice = ids.slice(i, i + CHUNK_IN);
                    const { data: have, error: e1 } = await window.supabase.from('SAAS_Contatos_Etiquetas').select('contatoId').eq('etiquetaId', eid).eq('contaId', contaId).in('contatoId', slice);
                    if (e1) throw e1;
                    const has = new Set((have || []).map(r => Number(r.contatoId)));
                    const rows = slice.filter(cid => !has.has(cid)).map(contatoId => ({ contatoId, etiquetaId: eid, contaId }));
                    if (rows.length) {
                        const { error } = await window.supabase.from('SAAS_Contatos_Etiquetas').insert(rows);
                        if (error) throw error;
                        applied += rows.length;
                    }
                }
                if (applied) showToast('Etiqueta aplicada a ' + applied + ' contato(s).', 'success');
                else showToast('Todos os selecionados ja tinham esta etiqueta.', 'info');
                closeBulkAddEtiquetaModal();
                contactsBulkClearSelection();
                await loadContacts();
            } catch (e) {
                showToast((e && e.message) || 'Erro ao adicionar etiqueta.', 'error');
            } finally {
                if (btn) btn.disabled = false;
            }
        }

        function openBulkRemoveEtiquetaModal(ids) {
            const htmlOpts = buildEtiquetasSelectOptionsHtml();
            if (!htmlOpts) {
                showToast('Nao ha etiquetas cadastradas.', 'info');
                return;
            }
            const sub = document.getElementById('bulkRemoveEtiquetaSubtitle');
            if (sub) sub.textContent = 'Remover vinculo nos ' + ids.length + ' contato(s) selecionado(s).';
            const sel = document.getElementById('bulkRemoveEtiquetaSelect');
            if (sel) sel.innerHTML = htmlOpts;
            document.getElementById('bulkRemoveEtiquetaModal')?.classList.add('active');
        }

        function closeBulkRemoveEtiquetaModal() {
            document.getElementById('bulkRemoveEtiquetaModal')?.classList.remove('active');
        }

        async function executeBulkRemoveEtiqueta() {
            const sel = document.getElementById('bulkRemoveEtiquetaSelect');
            const btn = document.getElementById('bulkRemoveEtiquetaConfirmBtn');
            const eid = sel ? parseInt(sel.value, 10) : NaN;
            if (!Number.isFinite(eid)) { showToast('Selecione uma etiqueta.', 'error'); return; }
            const ids = getBulkSelectedIdsResolved();
            if (!ids.length) return;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; return; }
            if (!contaId || !window.supabase) return;
            if (btn) btn.disabled = true;
            try {
                const CHUNK = 200;
                for (let i = 0; i < ids.length; i += CHUNK) {
                    const slice = ids.slice(i, i + CHUNK);
                    const { error } = await window.supabase.from('SAAS_Contatos_Etiquetas').delete().eq('etiquetaId', eid).eq('contaId', contaId).in('contatoId', slice);
                    if (error) throw error;
                }
                showToast('Etiqueta removida dos contatos selecionados (onde existia).', 'success');
                closeBulkRemoveEtiquetaModal();
                contactsBulkClearSelection();
                await loadContacts();
            } catch (e) {
                showToast((e && e.message) || 'Erro ao remover etiqueta.', 'error');
            } finally {
                if (btn) btn.disabled = false;
            }
        }

        async function openBulkClearCampoModal(ids) {
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; return; }
            if (!contaId || !window.supabase) return;
            const { data: campos, error } = await window.supabase.from('SAAS_Campos_Personalizados').select('id, nome').eq('contaId', contaId).order('nome');
            if (error || !campos || !campos.length) {
                showToast('Nao ha campos personalizados cadastrados.', 'info');
                return;
            }
            const sub = document.getElementById('bulkClearCampoSubtitle');
            if (sub) sub.textContent = 'Remover valores salvos deste campo nos ' + ids.length + ' contato(s) selecionado(s).';
            const sel = document.getElementById('bulkClearCampoSelect');
            if (sel) sel.innerHTML = campos.map(c => '<option value="' + escapeHtml(String(c.id)) + '">' + escapeHtml(c.nome || ('Campo ' + c.id)) + '</option>').join('');
            document.getElementById('bulkClearCampoModal')?.classList.add('active');
        }

        function closeBulkClearCampoModal() {
            document.getElementById('bulkClearCampoModal')?.classList.remove('active');
        }

        async function executeBulkClearCampo() {
            const sel = document.getElementById('bulkClearCampoSelect');
            const btn = document.getElementById('bulkClearCampoConfirmBtn');
            const idCampo = sel ? parseInt(sel.value, 10) : NaN;
            if (!Number.isFinite(idCampo)) { showToast('Selecione um campo.', 'error'); return; }
            const ids = getBulkSelectedIdsResolved();
            if (!ids.length) return;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; return; }
            if (!contaId || !window.supabase) return;
            if (btn) btn.disabled = true;
            try {
                const CHUNK = 200;
                for (let i = 0; i < ids.length; i += CHUNK) {
                    const slice = ids.slice(i, i + CHUNK);
                    const { error } = await window.supabase.from('SAAS_Valores_Campos_Personalizados').delete().eq('idCampo', idCampo).eq('contaId', contaId).in('idContato', slice);
                    if (error) throw error;
                }
                showToast('Valores do campo removidos dos contatos selecionados.', 'success');
                closeBulkClearCampoModal();
                contactsBulkClearSelection();
                await loadContacts();
            } catch (e) {
                showToast((e && e.message) || 'Erro ao limpar campo.', 'error');
            } finally {
                if (btn) btn.disabled = false;
            }
        }

        function openBulkDeleteManyModal(ids) {
            bulkDeleteLockedIds = ids.slice();
            const msg = document.getElementById('bulkDeleteManyMessage');
            if (msg) msg.textContent = 'Excluir permanentemente ' + ids.length + ' contato(s)? Esta acao nao pode ser desfeita.';
            document.getElementById('bulkDeleteManyModal')?.classList.add('active');
        }

        function closeBulkDeleteManyModal() {
            bulkDeleteLockedIds = [];
            document.getElementById('bulkDeleteManyModal')?.classList.remove('active');
        }

        async function executeBulkDeleteContacts() {
            const ids = bulkDeleteLockedIds.slice();
            if (!ids.length) return;
            const btn = document.getElementById('bulkDeleteManyConfirmBtn');
            const cancelBtn = document.getElementById('bulkDeleteManyCancelBtn');
            if (btn) { btn.disabled = true; btn.textContent = 'Excluindo...'; }
            if (cancelBtn) cancelBtn.disabled = true;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) {
                if (btn) { btn.disabled = false; btn.textContent = 'Excluir'; }
                if (cancelBtn) cancelBtn.disabled = false;
                if (e.message === 'STATUS_BLOQUEADO') return;
                return;
            }
            if (!contaId || !window.supabase) {
                if (btn) { btn.disabled = false; btn.textContent = 'Excluir'; }
                if (cancelBtn) cancelBtn.disabled = false;
                return;
            }
            try {
                // Validacao previa de permissao: evita tentativa lenta quando nao pode excluir
                const { data: authRes } = await window.supabase.auth.getUser();
                const authUserId = authRes && authRes.user ? authRes.user.id : null;
                if (!authUserId) {
                    showToast('Sessao invalida. Faca login novamente.', 'error');
                    return;
                }
                const { data: roleRow, error: roleErr } = await window.supabase
                    .from('SAAS_Usuarios')
                    .select('funcao, super_admin')
                    .eq('auth_user_id', authUserId)
                    .eq('contaId', contaId)
                    .limit(1)
                    .maybeSingle();
                if (roleErr) throw roleErr;
                const canDelete = !!(roleRow && (roleRow.super_admin === true || roleRow.funcao === 'admin'));
                if (!canDelete) {
                    showToast('Voce nao tem permissao para excluir contatos em massa.', 'error');
                    return;
                }

                // Opcional: tenta RPC de lote unico (se existir no banco)
                let usedRpc = false;
                let rpcDeletedCount = null;
                try {
                    const { data: rpcData, error: rpcErr } = await window.supabase.rpc('bulk_delete_contatos', {
                        p_ids: ids,
                        p_conta_id: contaId
                    });
                    if (!rpcErr) {
                        usedRpc = true;
                        if (rpcData && typeof rpcData.deleted_count === 'number') rpcDeletedCount = rpcData.deleted_count;
                    } else {
                        const m = String(rpcErr.message || '').toLowerCase();
                        if (!(m.includes('function') && m.includes('bulk_delete_contatos'))) throw rpcErr;
                    }
                } catch (rpcEx) {
                    const m = String((rpcEx && rpcEx.message) || '').toLowerCase();
                    if (!(m.includes('function') && m.includes('bulk_delete_contatos'))) throw rpcEx;
                }

                // Fallback performatico: somente lotes grandes, sem loop item a item
                if (!usedRpc) {
                    const CHUNK = 1000;
                    for (let i = 0; i < ids.length; i += CHUNK) {
                        const slice = ids.slice(i, i + CHUNK);
                        const { error: batchErr } = await window.supabase
                            .from('SAAS_Contatos')
                            .delete()
                            .in('id', slice)
                            .eq('contaId', contaId);
                        if (batchErr) throw batchErr;
                    }
                }

                const deletedCount = Number.isFinite(rpcDeletedCount) ? rpcDeletedCount : ids.length;
                showToast(deletedCount + ' contato(s) excluido(s).', 'success');

                closeBulkDeleteManyModal();
                if (contactDetailId != null && ids.includes(Number(contactDetailId))) closeContactDetailModal();
                if (editContactId != null && ids.includes(Number(editContactId))) closeAddContactModal();
                contactsBulkClearSelection();
                await loadContacts();
                // Garante recálculo imediato dos contadores após exclusão em massa
                applyFilters();
                updateKPIs();
                renderEtiquetasLateral();
            } catch (e) {
                showToast((e && e.message) || 'Erro ao excluir contatos.', 'error');
            } finally {
                if (btn) { btn.disabled = false; btn.textContent = 'Excluir'; }
                if (cancelBtn) cancelBtn.disabled = false;
            }
        }

        async function openBulkRemoveCrmModal(ids) {
            bulkRemoveCrmLockedIds = ids.slice();
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; return; }
            if (!contaId || !window.supabase) return;
            const { data: quadros, error } = await window.supabase.from('SAAS_Quadros').select('id, nome').eq('contaId', contaId).order('nome', { ascending: true });
            if (error || !quadros || !quadros.length) {
                showToast('Nenhum quadro CRM encontrado.', 'info');
                bulkRemoveCrmLockedIds = [];
                return;
            }
            const msg = document.getElementById('bulkRemoveCrmMessage');
            if (msg) msg.textContent = 'Escolha onde remover os cards dos ' + ids.length + ' contato(s) selecionado(s).';
            const qSel = document.getElementById('bulkRemoveCrmQuadroSelect');
            const eSel = document.getElementById('bulkRemoveCrmEtapaSelect');
            if (qSel) {
                qSel.innerHTML = '<option value="">Todos os quadros (CRM)</option>' +
                    quadros.map(q => '<option value="' + escapeHtml(String(q.id)) + '">' + escapeHtml(q.nome || ('Quadro ' + q.id)) + '</option>').join('');
            }
            if (eSel) eSel.innerHTML = '<option value="">Todas as etapas</option>';
            document.getElementById('bulkRemoveCrmModal')?.classList.add('active');
            await onBulkRemoveCrmQuadroChange();
        }

        function closeBulkRemoveCrmModal() {
            bulkRemoveCrmLockedIds = [];
            document.getElementById('bulkRemoveCrmModal')?.classList.remove('active');
        }

        async function onBulkRemoveCrmQuadroChange() {
            const qSel = document.getElementById('bulkRemoveCrmQuadroSelect');
            const eSel = document.getElementById('bulkRemoveCrmEtapaSelect');
            if (!qSel || !eSel) return;
            const qVal = (qSel.value || '').trim();
            const qid = qVal === '' ? null : parseInt(qVal, 10);
            if (qid == null || !Number.isFinite(qid)) {
                eSel.innerHTML = '<option value="">Todas as etapas</option>';
                eSel.disabled = true;
                return;
            }
            eSel.disabled = false;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { return; }
            if (!contaId || !window.supabase) return;
            const { data: etapas, error } = await window.supabase.from('SAAS_Etapas_Quadros').select('id, nome, ordem').eq('quadroId', qid).order('ordem', { ascending: true });
            if (error || !etapas || !etapas.length) {
                eSel.innerHTML = '<option value="">Todas as etapas</option>';
                return;
            }
            eSel.innerHTML = '<option value="">Todas as etapas</option>' +
                etapas.map(e => '<option value="' + escapeHtml(String(e.id)) + '">' + escapeHtml(e.nome || ('Etapa ' + e.id)) + '</option>').join('');
        }

        async function executeBulkRemoveFromCrm() {
            const ids = bulkRemoveCrmLockedIds.slice();
            if (!ids.length) return;
            const qRaw = document.getElementById('bulkRemoveCrmQuadroSelect')?.value ?? '';
            const eRaw = document.getElementById('bulkRemoveCrmEtapaSelect')?.value ?? '';
            const qid = qRaw === '' ? null : parseInt(qRaw, 10);
            const etapaId = eRaw === '' ? null : parseInt(eRaw, 10);
            if (qRaw !== '' && !Number.isFinite(qid)) {
                showToast('Selecione um quadro valido.', 'error');
                return;
            }
            if (qid == null && Number.isFinite(etapaId)) {
                showToast('Para escolher uma etapa, selecione um quadro.', 'error');
                return;
            }
            if (qid != null && eRaw !== '' && !Number.isFinite(etapaId)) {
                showToast('Selecione uma etapa valida.', 'error');
                return;
            }
            const btn = document.getElementById('bulkRemoveCrmConfirmBtn');
            const cancelBtn = document.getElementById('bulkRemoveCrmCancelBtn');
            if (btn) { btn.disabled = true; btn.textContent = 'Removendo...'; }
            if (cancelBtn) cancelBtn.disabled = true;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) {
                if (btn) { btn.disabled = false; btn.textContent = 'Remover cards'; }
                if (cancelBtn) cancelBtn.disabled = false;
                if (e.message === 'STATUS_BLOQUEADO') return;
                return;
            }
            if (!contaId || !window.supabase) {
                if (btn) { btn.disabled = false; btn.textContent = 'Remover cards'; }
                if (cancelBtn) cancelBtn.disabled = false;
                return;
            }
            try {
                const CHUNK = 150;
                for (let i = 0; i < ids.length; i += CHUNK) {
                    const slice = ids.slice(i, i + CHUNK);
                    let delQ = window.supabase.from('SAAS_Cards_Quadros').delete().in('contatoId', slice);
                    if (Number.isFinite(qid)) delQ = delQ.eq('quadroId', qid);
                    if (Number.isFinite(etapaId)) delQ = delQ.eq('etapaQuadroId', etapaId);
                    const { error } = await delQ;
                    if (error) throw error;
                }
                let scope = 'Remocao concluida.';
                if (Number.isFinite(qid) && Number.isFinite(etapaId)) scope = 'Cards removidos do quadro e etapa escolhidos.';
                else if (Number.isFinite(qid)) scope = 'Cards removidos do quadro (todas as etapas).';
                else scope = 'Cards removidos de todos os quadros.';
                showToast(scope, 'success');
                closeBulkRemoveCrmModal();
                contactsBulkClearSelection();
                await loadContacts();
            } catch (e) {
                showToast((e && e.message) || 'Erro ao remover do CRM (verifique permissao de administrador).', 'error');
            } finally {
                if (btn) { btn.disabled = false; btn.textContent = 'Remover cards'; }
                if (cancelBtn) cancelBtn.disabled = false;
            }
        }

        async function openBulkLinkCrmModal(ids) {
            bulkLinkCrmLockedIds = ids.slice();
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; return; }
            if (!contaId || !window.supabase) return;
            const { data: quadros, error } = await window.supabase.from('SAAS_Quadros').select('id, nome').eq('contaId', contaId).order('nome', { ascending: true });
            if (error || !quadros || !quadros.length) {
                showToast('Nenhum quadro CRM encontrado.', 'info');
                bulkLinkCrmLockedIds = [];
                return;
            }
            const sub = document.getElementById('bulkLinkCrmSubtitle');
            if (sub) sub.textContent = 'Criar um card na etapa escolhida para cada um dos ' + ids.length + ' contato(s) que ainda nao tiver card neste quadro.';
            const qSel = document.getElementById('bulkLinkCrmQuadroSelect');
            const eSel = document.getElementById('bulkLinkCrmEtapaSelect');
            if (qSel) {
                qSel.innerHTML = quadros.map(q => '<option value="' + escapeHtml(String(q.id)) + '">' + escapeHtml(q.nome || ('Quadro ' + q.id)) + '</option>').join('');
            }
            if (eSel) eSel.innerHTML = '';
            document.getElementById('bulkLinkCrmModal')?.classList.add('active');
            await onBulkLinkCrmQuadroChange();
        }

        function closeBulkLinkCrmModal() {
            bulkLinkCrmLockedIds = [];
            document.getElementById('bulkLinkCrmModal')?.classList.remove('active');
        }

        async function onBulkLinkCrmQuadroChange() {
            const qSel = document.getElementById('bulkLinkCrmQuadroSelect');
            const eSel = document.getElementById('bulkLinkCrmEtapaSelect');
            if (!qSel || !eSel) return;
            const qid = parseInt(qSel.value, 10);
            if (!Number.isFinite(qid)) {
                eSel.innerHTML = '';
                return;
            }
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { return; }
            if (!contaId || !window.supabase) return;
            const { data: etapas, error } = await window.supabase.from('SAAS_Etapas_Quadros').select('id, nome, ordem').eq('quadroId', qid).order('ordem', { ascending: true });
            if (error || !etapas || !etapas.length) {
                eSel.innerHTML = '<option value="">Sem etapas neste quadro</option>';
                return;
            }
            eSel.innerHTML = etapas.map(e => '<option value="' + escapeHtml(String(e.id)) + '">' + escapeHtml(e.nome || ('Etapa ' + e.id)) + '</option>').join('');
        }

        async function executeBulkLinkCrm() {
            const qid = parseInt(document.getElementById('bulkLinkCrmQuadroSelect')?.value, 10);
            const etapaId = parseInt(document.getElementById('bulkLinkCrmEtapaSelect')?.value, 10);
            const btn = document.getElementById('bulkLinkCrmConfirmBtn');
            if (!Number.isFinite(qid) || !Number.isFinite(etapaId)) {
                showToast('Selecione quadro e etapa.', 'error');
                return;
            }
            const ids = bulkLinkCrmLockedIds.slice();
            if (!ids.length) return;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; return; }
            if (!contaId || !window.supabase) return;
            if (btn) btn.disabled = true;
            try {
                const { data: maxRows } = await window.supabase.from('SAAS_Cards_Quadros').select('ordem').eq('etapaQuadroId', etapaId).order('ordem', { ascending: false, nullsFirst: false }).limit(1);
                let baseOrdem = 0;
                if (maxRows && maxRows.length && maxRows[0].ordem != null) baseOrdem = Number(maxRows[0].ordem);
                const { data: existentes } = await window.supabase.from('SAAS_Cards_Quadros').select('contatoId').eq('quadroId', qid).in('contatoId', ids);
                const jaTem = new Set((existentes || []).map(r => Number(r.contatoId)));
                const criar = ids.filter(cid => !jaTem.has(cid));
                if (!criar.length) {
                    showToast('Todos os selecionados ja possuem card neste quadro.', 'info');
                    closeBulkLinkCrmModal();
                    contactsBulkClearSelection();
                    return;
                }
                const rows = criar.map((cid, idx) => {
                    const c = allContacts.find(x => Number(x.id) === cid);
                    const tel = c ? (getDisplayPhone(c) || '').replace(/\D/g, '') : '';
                    const nom = c ? ((c.nome || '').trim() || tel || ('Contato ' + cid)) : ('Contato ' + cid);
                    return {
                        quadroId: qid,
                        etapaQuadroId: etapaId,
                        contatoId: cid,
                        nome: nom,
                        contato: tel || null,
                        valor: 0,
                        observacoes: null,
                        tarefas: [],
                        ordem: baseOrdem + idx + 1
                    };
                });
                const CHUNK = 40;
                for (let i = 0; i < rows.length; i += CHUNK) {
                    const batch = rows.slice(i, i + CHUNK);
                    const { error } = await window.supabase.from('SAAS_Cards_Quadros').insert(batch);
                    if (error) throw error;
                }
                showToast(rows.length + ' card(s) criado(s) no CRM.', 'success');
                closeBulkLinkCrmModal();
                contactsBulkClearSelection();
                await loadContacts();
            } catch (e) {
                showToast((e && e.message) || 'Erro ao vincular no CRM.', 'error');
            } finally {
                if (btn) btn.disabled = false;
            }
        }

        function renderTable() {
            const tbody = document.getElementById('contactsTableBody');
            const hasFilters = hasActiveContactFilters();
            const start = (currentPage - 1) * contactsPerPage;
            const pageContacts = (hasFilters && filteredServerMode) ? filteredContacts : filteredContacts.slice(start, start + contactsPerPage);
            const totalEl = document.getElementById('totalCount');
            if (totalEl) {
                const shownCount = pageContacts.length;
                const filteredUniverse = hasFilters ? (filteredServerMode ? filteredTotalCount : filteredContacts.length) : totalContactsCount;
                let t = 'Mostrando ' + shownCount + ' contato' + (shownCount !== 1 ? 's' : '');
                if (hasFilters) {
                    if (filteredUniverse !== shownCount) t += ' (filtrado de ' + filteredUniverse.toLocaleString('pt-BR') + ')';
                    else t += ' (filtro ativo)';
                } else {
                    t += ' (total: ' + filteredUniverse.toLocaleString('pt-BR') + ')';
                }
                totalEl.textContent = t;
            }

            if (pageContacts.length === 0) {
                const msg = (!hasFilters && totalContactsCount === 0) ? 'Voce ainda nao tem contatos.' : 'Nenhum contato encontrado.';
                tbody.innerHTML = '<tr><td colspan="6" class="contacts-empty-msg">' + msg + '</td></tr>';
            } else {
                tbody.innerHTML = pageContacts.map((c, idx) => {
                    const isLastThree = pageContacts.length > 10 && idx >= pageContacts.length - 3;
                    const isGrupo = c.tipo === 'grupo';
                    const phoneDisplay = getDisplayPhone(c);
                    const tipoClass = isGrupo ? 'grupo' : 'contato';
                    const nomes = c.etiquetaNomes || [];
                    const cores = c.etiquetaCores || [];
                    const rowCid = normBulkContactId(c.id);
                    const checkedBulk = rowCid != null && bulkSelectedContactIds.has(rowCid);
                    const etiquetaTags = nomes.length ? nomes.map((n, i) => {
                        const cor = (cores[i] || '#6b7280').trim();
                        const isHex = /^#[0-9a-fA-F]{6}$/.test(cor);
                        const bg = isHex ? cor + '25' : 'rgba(107,114,128,0.2)';
                        return `<span class="etiqueta-tag" style="background:${bg};color:${cor}">${escapeHtml(n)}</span>`;
                    }).join('') : '';
                    return `
                    <tr class="contact-table-row" onclick="onContactRowClick(event, ${c.id})">
                        <td class="contacts-td-checkbox" onclick="event.stopPropagation();">
                            <input type="checkbox" class="contacts-row-checkbox" data-bulk-cid="${rowCid != null ? rowCid : ''}" ${checkedBulk ? 'checked' : ''} aria-label="Selecionar contato" onclick="event.stopPropagation();" onchange="onBulkRowCheckboxChange(event, ${c.id})">
                        </td>
                        <td>
                            <div class="contact-cell">
                                ${buildContactTableAvatarHtml(c)}
                                <div class="contact-cell-info">
                                    <span class="contact-name">${escapeHtml(c.nome || '-')}</span>
                                    ${phoneDisplay ? `<span class="contact-phone">${escapeHtml(phoneDisplay)}</span>` : ''}
                                </div>
                            </div>
                        </td>
                        <td><span class="tipo-badge ${tipoClass}">${isGrupo ? 'Grupo' : 'Contato'}</span></td>
                        <td><div class="etiquetas-tags">${etiquetaTags || '-'}</div></td>
                        <td><span class="contact-date">${formatDate(c.created_at)}</span></td>
                        <td>
                            <div class="contact-row-menu">
                                <button class="action-btn row-menu-btn" title="Opcoes" onclick="toggleRowMenu(event, ${c.id}, ${isLastThree})">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="1.5"></circle><circle cx="12" cy="12" r="1.5"></circle><circle cx="12" cy="19" r="1.5"></circle></svg>
                                </button>
                                <div class="row-menu-dropdown" id="rowMenu-${c.id}" style="display:none;">
                                    <button onclick="handleEdit(${c.id});closeRowMenu();">Editar</button>
                                    <button onclick="handleDelete(${c.id});closeRowMenu();">Excluir</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
                }).join('');
            }
            renderPagination();
            updateContactsBulkBarUI();
        }

        function escapeHtml(t) {
            const div = document.createElement('div');
            div.textContent = t;
            return div.innerHTML;
        }

        function toggleRowMenu(ev, id, openUpward) {
            ev.stopPropagation();
            const open = document.querySelector('.row-menu-dropdown[style*="display: block"]');
            if (open && open.id !== 'rowMenu-'+id) open.style.display = 'none';
            const dd = document.getElementById('rowMenu-'+id);
            if (!dd) return;
            const btn = ev.currentTarget;
            if (dd.style.display === 'block') {
                dd.style.display = 'none';
                return;
            }
            const rect = btn.getBoundingClientRect();
            const gap = 4;
            dd.style.position = 'fixed';
            dd.style.left = (rect.right - 120) + 'px';
            dd.style.top = openUpward ? (rect.top - dd.offsetHeight - gap) + 'px' : (rect.bottom + gap) + 'px';
            dd.style.right = 'auto';
            dd.style.bottom = 'auto';
            dd.style.display = 'block';
            const w = dd.offsetWidth || 120;
            dd.style.left = Math.max(8, Math.min(rect.right - w, window.innerWidth - w - 8)) + 'px';
        }
        function closeRowMenu() {
            document.querySelectorAll('.row-menu-dropdown').forEach(el => el.style.display = 'none');
        }
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.contact-row-menu')) closeRowMenu();
            if (!e.target.closest('.contacts-bulk-dropdown-wrap')) closeContactsBulkMenu();
        });
        function handleEdit(id) { openEditContactModal(id); }

        function openDeleteContactModal(id) {
            const c = allContacts.find(x => x.id === id);
            const label = c ? (c.nome || 'Contato').trim() || 'este contato' : 'este contato';
            deleteContactPendingId = id;
            const msgEl = document.getElementById('deleteContactModalMessage');
            if (msgEl) {
                msgEl.textContent = 'Deseja excluir o contato "' + label + '"? Esta acao nao pode ser desfeita.';
            }
            const confirmBtn = document.getElementById('deleteContactConfirmBtn');
            const cancelBtn = document.getElementById('deleteContactCancelBtn');
            if (confirmBtn) { confirmBtn.disabled = false; confirmBtn.textContent = 'Excluir'; }
            if (cancelBtn) cancelBtn.disabled = false;
            document.getElementById('deleteContactModal')?.classList.add('active');
        }

        function closeDeleteContactModal() {
            document.getElementById('deleteContactModal')?.classList.remove('active');
            deleteContactPendingId = null;
            const confirmBtn = document.getElementById('deleteContactConfirmBtn');
            const cancelBtn = document.getElementById('deleteContactCancelBtn');
            if (confirmBtn) { confirmBtn.disabled = false; confirmBtn.textContent = 'Excluir'; }
            if (cancelBtn) cancelBtn.disabled = false;
        }

        function handleDelete(id) {
            openDeleteContactModal(id);
        }

        async function executeDeleteContact() {
            const id = deleteContactPendingId;
            if (id == null) return;

            const confirmBtn = document.getElementById('deleteContactConfirmBtn');
            const cancelBtn = document.getElementById('deleteContactCancelBtn');
            if (confirmBtn) { confirmBtn.disabled = true; confirmBtn.textContent = 'Excluindo...'; }
            if (cancelBtn) cancelBtn.disabled = true;

            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) {
                if (confirmBtn) { confirmBtn.disabled = false; confirmBtn.textContent = 'Excluir'; }
                if (cancelBtn) cancelBtn.disabled = false;
                if (e.message === 'STATUS_BLOQUEADO') return;
                throw e;
            }
            if (!contaId) {
                showToast('Sessao expirada. Faca login novamente.', 'error');
                if (confirmBtn) { confirmBtn.disabled = false; confirmBtn.textContent = 'Excluir'; }
                if (cancelBtn) cancelBtn.disabled = false;
                return;
            }

            const { error: errEt } = await window.supabase
                .from('SAAS_Contatos_Etiquetas')
                .delete()
                .eq('contatoId', id)
                .eq('contaId', contaId);
            if (errEt) {
                showToast('Erro ao remover vinculos: ' + (errEt.message || 'sem permissao ou rede'), 'error');
                if (confirmBtn) { confirmBtn.disabled = false; confirmBtn.textContent = 'Excluir'; }
                if (cancelBtn) cancelBtn.disabled = false;
                return;
            }

            const { error } = await window.supabase
                .from('SAAS_Contatos')
                .delete()
                .eq('id', id)
                .eq('contaId', contaId);
            if (error) {
                const msg = error.message || '';
                if (msg.includes('disparos') || msg.includes('Nao e possivel') || msg.includes('Não é possível')) {
                    showToast(msg, 'error');
                } else {
                    showToast('Erro ao excluir: ' + (msg || 'Erro desconhecido'), 'error');
                }
                if (confirmBtn) { confirmBtn.disabled = false; confirmBtn.textContent = 'Excluir'; }
                if (cancelBtn) cancelBtn.disabled = false;
                return;
            }

            closeDeleteContactModal();
            if (editContactId === id) closeAddContactModal();
            showToast('Contato excluido.', 'success');
            await loadContacts();
        }

        function renderPagination() {
            const baseCount = hasActiveContactFilters() ? (filteredServerMode ? filteredTotalCount : filteredContacts.length) : totalContactsCount;
            const totalPages = Math.ceil(baseCount / contactsPerPage);
            const cont = document.getElementById('contactsPagination');
            cont.innerHTML = '';
            if (totalPages <= 1) return;
            cont.style.display = 'flex';
            const maxVisible = 10;
            let start = Math.max(1, currentPage - Math.floor(maxVisible / 2));
            let end = Math.min(totalPages, start + maxVisible - 1);
            if (end - start + 1 < maxVisible) start = Math.max(1, end - maxVisible + 1);

            if (start > 1) {
                const b = document.createElement('button');
                b.textContent = 'Primeira';
                b.className = 'btn btn-secondary';
                b.onclick = () => { void goToContactsPage(1); };
                cont.appendChild(b);
            }
            if (currentPage > 1) {
                const b = document.createElement('button');
                b.textContent = 'Anterior';
                b.className = 'btn btn-secondary';
                b.onclick = () => { void goToContactsPage(currentPage - 1); };
                cont.appendChild(b);
            }
            for (let i = start; i <= end; i++) {
                const b = document.createElement('button');
                b.textContent = i;
                b.className = 'btn btn-secondary';
                b.style.background = i === currentPage ? '#6C63FF' : '';
                b.style.color = i === currentPage ? 'white' : '';
                b.disabled = i === currentPage;
                b.onclick = () => { void goToContactsPage(i); };
                cont.appendChild(b);
            }
            if (currentPage < totalPages) {
                const b = document.createElement('button');
                b.textContent = 'Proxima';
                b.className = 'btn btn-secondary';
                b.onclick = () => { void goToContactsPage(currentPage + 1); };
                cont.appendChild(b);
            }
            if (end < totalPages) {
                const b = document.createElement('button');
                b.textContent = 'Ultima';
                b.className = 'btn btn-secondary';
                b.onclick = () => { void goToContactsPage(totalPages); };
                cont.appendChild(b);
            }
        }

        function updateKPIs() {
            const filtered = hasActiveContactFilters();
            const pool = filtered ? filteredContacts : allContacts;
            const totalAllContatos = totalContatosOnlyCount;
            const nPoolContatos = filtered
                ? (filteredServerMode ? filteredContatosOnlyCount : pool.filter(c => (c.tipo || 'contato') === 'contato').length)
                : totalContatosOnlyCount;

            document.getElementById('kpiTotal').textContent = nPoolContatos.toLocaleString('pt-BR');
            const hintEl = document.getElementById('kpiTotalHint');
            if (hintEl) {
                if (filtered && totalAllContatos !== nPoolContatos) {
                    hintEl.textContent = 'de ' + totalAllContatos.toLocaleString('pt-BR') + ' contatos no total';
                } else if (filtered) {
                    hintEl.textContent = 'filtro ativo (todos os resultados visiveis)';
                } else {
                    hintEl.textContent = '';
                }
            }

            const now = new Date();
            const week = new Date(now.getTime() - 7*24*60*60*1000);
            const newCount = pool.filter(c => c.created_at && new Date(c.created_at) >= week).length;
            document.getElementById('kpiNew7d').textContent = newCount;

            const prevWeek = new Date(now.getTime() - 14*24*60*60*1000);
            const prevCount = pool.filter(c => c.created_at && new Date(c.created_at) >= prevWeek && new Date(c.created_at) < week).length;
            const badge = document.getElementById('kpiBadge7d');
            if (prevCount > 0) {
                const pct = Math.round(((newCount - prevCount) / prevCount) * 100);
                badge.textContent = (pct >= 0 ? '+' : '') + pct + '%';
                badge.style.display = 'inline-flex';
            } else if (newCount > 0) {
                badge.textContent = '+100%';
                badge.style.display = 'inline-flex';
            } else {
                badge.style.display = 'none';
            }

            const groupsCount = filtered
                ? (filteredServerMode ? filteredGroupsOnlyCount : pool.filter(c => (c.tipo || 'contato') === 'grupo').length)
                : totalGroupsOnlyCount;
            document.getElementById('kpiGroups').textContent = groupsCount.toLocaleString('pt-BR');
        }

        function handleCsvImport(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(ev) {
                try {
                    const text = String(ev.target?.result || '');
                    const rows = parseCsvText(text);
                    if (!rows.length || rows.length < 2) {
                        showToast('CSV vazio ou sem linhas suficientes para importar.', 'error');
                        return;
                    }
                    csvImportHeaders = rows[0].map(v => String(v || '').trim());
                    csvImportRawRows = rows.slice(1).filter(r => r.some(cell => String(cell || '').trim() !== ''));
                    if (!csvImportHeaders.length || !csvImportRawRows.length) {
                        showToast('Nao foi possivel ler colunas ou dados do CSV.', 'error');
                        return;
                    }
                    openCsvImportModal();
                } catch (err) {
                    showToast('Erro ao ler CSV: ' + ((err && err.message) || 'arquivo invalido'), 'error');
                } finally {
                    input.value = '';
                }
            };
            reader.onerror = function() {
                showToast('Falha ao ler o arquivo CSV.', 'error');
                input.value = '';
            };
            reader.readAsText(file);
        }

        function parseCsvText(text) {
            const clean = String(text || '').replace(/^\uFEFF/, '');
            const lines = clean.split(/\r?\n/).filter(line => line.trim() !== '');
            if (!lines.length) return [];
            const sep = detectCsvSeparator(lines[0]);
            return lines.map(line => parseCsvLine(line, sep));
        }

        function detectCsvSeparator(headerLine) {
            const cands = [',', ';', '\t', '|'];
            let best = ',';
            let maxParts = 0;
            cands.forEach(sep => {
                const parts = parseCsvLine(headerLine, sep).length;
                if (parts > maxParts) {
                    maxParts = parts;
                    best = sep;
                }
            });
            return best;
        }

        function parseCsvLine(line, separator) {
            const out = [];
            let value = '';
            let quoted = false;
            for (let i = 0; i < line.length; i++) {
                const ch = line[i];
                if (ch === '"') {
                    if (quoted && line[i + 1] === '"') {
                        value += '"';
                        i++;
                    } else {
                        quoted = !quoted;
                    }
                } else if (ch === separator && !quoted) {
                    out.push(value.trim());
                    value = '';
                } else {
                    value += ch;
                }
            }
            out.push(value.trim());
            return out.map(v => v.replace(/^"|"$/g, ''));
        }

        async function loadCsvImportCustomFields() {
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) {
                if (e.message === 'STATUS_BLOQUEADO') return [];
                throw e;
            }
            if (!contaId || !window.supabase) return [];
            const { data, error } = await window.supabase
                .from('SAAS_Campos_Personalizados')
                .select('id, nome, tipo')
                .eq('contaId', contaId)
                .order('nome');
            if (error || !Array.isArray(data)) return [];
            return data
                .map(item => ({
                    id: item.id,
                    nome: String(item.nome || '').trim(),
                    tipo: String(item.tipo || 'texto').trim().toLowerCase()
                }))
                .filter(item => item.nome);
        }

        async function openCsvImportModal() {
            csvImportMapping = {};
            csvImportSelectedEtiquetaIds = [];
            const wrap = document.getElementById('csvImportPreviewWrap');
            const grid = document.getElementById('csvImportMappingGrid');
            const msg = document.getElementById('csvImportMessage');
            if (msg) { msg.className = 'sync-groups-message'; msg.textContent = ''; }
            if (!wrap || !grid) return;
            csvImportCustomFields = await loadCsvImportCustomFields();
            document.getElementById('csvImportStep1')?.classList.add('active');
            document.getElementById('csvImportStep2')?.classList.remove('active');
            const continueBtn = document.getElementById('csvImportContinueBtn');
            const importBtn = document.getElementById('csvImportConfirmBtn');
            const backBtn = document.getElementById('csvImportBackBtn');
            if (continueBtn) continueBtn.style.display = 'inline-flex';
            if (importBtn) importBtn.style.display = 'none';
            if (backBtn) backBtn.style.display = 'none';

            const exampleRow = csvImportRawRows[0] || [];
            let table = '<table class="contacts-table" style="min-width:650px;"><thead><tr>';
            csvImportHeaders.forEach(h => { table += '<th>' + escapeHtml(h || '-') + '</th>'; });
            table += '</tr></thead><tbody><tr>';
            csvImportHeaders.forEach((_, idx) => {
                table += '<td>' + escapeHtml(String(exampleRow[idx] || '-')) + '</td>';
            });
            table += '</tr></tbody></table>';
            wrap.innerHTML = table;

            grid.innerHTML = '';
            csvImportHeaders.forEach((header, idx) => {
                const row = document.createElement('div');
                row.className = 'csv-import-map-row';
                row.dataset.columnIndex = String(idx);
                const label = document.createElement('div');
                label.className = 'csv-import-col-label';
                const sample = String(exampleRow[idx] || '').trim() || '-';
                label.innerHTML =
                    '<span class="csv-import-col-index">Coluna ' + (idx + 1) + '</span>' +
                    '<span class="csv-import-col-name">' + escapeHtml(header || ('Coluna ' + (idx + 1))) + '</span>' +
                    '<span class="csv-import-col-sample">Exemplo: ' + escapeHtml(sample) + '</span>';

                const control = document.createElement('div');
                control.className = 'csv-import-col-control';
                const select = document.createElement('select');
                select.className = 'form-select';
                select.dataset.columnIndex = String(idx);
                select.innerHTML = '<option value="">Ignorar</option>' +
                    '<option value="nome">Nome</option>' +
                    '<option value="email">Email</option>' +
                    '<option value="telefone">Telefone (obrigatorio)</option>' +
                    '<option value="__sep__" disabled>----</option>';
                if (csvImportCustomFields.length) {
                    const sampleValue = String(exampleRow[idx] || '').trim();
                    csvImportCustomFields.forEach(field => {
                        const opt = document.createElement('option');
                        opt.value = 'custom:' + field.nome;
                        const compatible = isSampleCompatibleWithFieldType(sampleValue, field.tipo);
                        opt.textContent = field.nome + (field.tipo ? (' (' + field.tipo + ')') : '');
                        if (!compatible) {
                            opt.disabled = true;
                            opt.textContent += ' - incompatível com exemplo';
                        }
                        select.appendChild(opt);
                    });
                }
                select.onchange = () => onCsvMappingChange(select);
                control.appendChild(select);
                row.appendChild(label);
                row.appendChild(control);
                grid.appendChild(row);
            });

            document.getElementById('csvImportModal')?.classList.add('active');
            updateCsvImportStats();
            updateCsvImportConfirmState();
        }

        function closeCsvImportModal() {
            document.getElementById('csvImportModal')?.classList.remove('active');
            csvImportMapping = {};
            csvImportHeaders = [];
            csvImportRawRows = [];
            csvImportSelectedEtiquetaIds = [];
        }

        function onCsvMappingChange(select) {
            const idx = Number(select.dataset.columnIndex);
            const type = select.value;
            if (!Number.isFinite(idx)) return;

            if (type.startsWith('custom:')) {
                const key = type.slice('custom:'.length).trim();
                csvImportMapping[idx] = { type: 'custom', key };
            } else if (type) {
                csvImportMapping[idx] = { type, key: type };
            } else {
                delete csvImportMapping[idx];
            }
            const row = select.closest('.csv-import-map-row');
            if (row) row.classList.toggle('mapped', !!type);
            updateCsvImportStats();
            updateCsvImportConfirmState();
        }

        function updateCsvImportConfirmState() {
            const btn = document.getElementById('csvImportContinueBtn');
            const warn = document.getElementById('csvImportFooterWarning');
            if (!btn) return;
            const hasPhone = Object.values(csvImportMapping).some(m => m.type === 'telefone');
            const customOk = Object.values(csvImportMapping).every(m => m.type !== 'custom' || (m.key || '').trim() !== '');
            btn.disabled = !(hasPhone && customOk);
            if (warn) {
                const step1Active = document.getElementById('csvImportStep1')?.classList.contains('active');
                warn.classList.toggle('show', !!step1Active && !hasPhone);
            }
        }

        function renderCsvImportSelectedEtiquetas() {
            const el = document.getElementById('csvImportEtiquetasSelected');
            if (!el) return;
            if (!csvImportSelectedEtiquetaIds.length) {
                el.innerHTML = '<span style="color:#64748b;font-size:.82rem;">Nenhuma etiqueta selecionada (opcional)</span>';
                return;
            }
            el.innerHTML = csvImportSelectedEtiquetaIds.map(id => {
                const obj = allEtiquetas[id];
                const nome = obj && (typeof obj === 'object' ? obj.nome : obj) || 'Etiqueta';
                const cor = obj && typeof obj === 'object' && obj.cor ? obj.cor : '#6b7280';
                const bg = /^#[0-9a-fA-F]{6}$/.test(cor) ? (cor + '25') : 'rgba(107,114,128,0.2)';
                return '<span class="etiqueta-tag" style="background:' + bg + ';color:' + cor + ';">' + escapeHtml(nome) + '</span>';
            }).join('');
        }

        function renderCsvImportEtiquetaResults(filterText) {
            const list = document.getElementById('csvImportEtiquetasResults');
            if (!list) return;
            const term = String(filterText || '').trim().toLowerCase();
            const entries = Object.entries(allEtiquetas || {}).filter(([_, obj]) => {
                const nome = (typeof obj === 'object' ? obj.nome : obj) || '';
                return !term || String(nome).toLowerCase().includes(term);
            });
            if (!entries.length) {
                list.innerHTML = '<div class="csv-import-etiquetas-result-item" style="cursor:default;color:#64748b;">Nenhuma etiqueta encontrada</div>';
                return;
            }
            list.innerHTML = entries.map(([id, obj]) => {
                const nome = (typeof obj === 'object' ? obj.nome : obj) || 'Etiqueta';
                const selected = csvImportSelectedEtiquetaIds.includes(String(id));
                return '<div class="csv-import-etiquetas-result-item" data-etiqueta-id="' + escapeHtml(String(id)) + '" style="' + (selected ? 'background:rgba(37,211,102,.12);' : '') + '">' + (selected ? '✓ ' : '') + escapeHtml(nome) + '</div>';
            }).join('');
        }

        async function ensureCsvImportEtiquetasLoaded() {
            if (allEtiquetas && Object.keys(allEtiquetas).length) return;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { return; }
            if (!contaId || !window.supabase) return;
            await loadEtiquetas(contaId);
        }

        async function createCsvImportEtiquetaFromInput() {
            const input = document.getElementById('csvImportEtiquetaInput');
            const nome = String(input?.value || '').trim();
            if (!nome) return;
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; throw e; }
            if (!contaId || !window.supabase) return;
            const existente = Object.entries(allEtiquetas || {}).find(([_, obj]) => String((typeof obj === 'object' ? obj.nome : obj) || '').toLowerCase() === nome.toLowerCase());
            if (existente) {
                const id = String(existente[0]);
                if (!csvImportSelectedEtiquetaIds.includes(id)) csvImportSelectedEtiquetaIds.push(id);
                renderCsvImportSelectedEtiquetas();
                renderCsvImportEtiquetaResults(input.value);
                return;
            }
            const { data, error } = await window.supabase
                .from('SAAS_Etiquetas')
                .insert({ nome, descricao: null, cor: '#6C63FF', contaId })
                .select('id, nome, cor')
                .single();
            if (error) {
                showCsvImportMessage('Erro ao criar etiqueta: ' + (error.message || 'erro'), 'error');
                return;
            }
            allEtiquetas[data.id] = { nome: data.nome, cor: data.cor || '#6C63FF', descricao: '' };
            const newId = String(data.id);
            if (!csvImportSelectedEtiquetaIds.includes(newId)) csvImportSelectedEtiquetaIds.push(newId);
            renderCsvImportSelectedEtiquetas();
            renderCsvImportEtiquetaResults(input.value);
        }

        async function goCsvImportToStep2() {
            const hasPhone = Object.values(csvImportMapping).some(m => m.type === 'telefone');
            if (!hasPhone) {
                showCsvImportMessage('Mapeie uma coluna para Telefone para continuar.', 'error');
                showToast('Telefone e obrigatorio para importar contatos.', 'error');
                return;
            }
            const customInvalid = Object.values(csvImportMapping).some(m => m.type === 'custom' && !(m.key || '').trim());
            if (customInvalid) {
                showCsvImportMessage('Preencha o nome de todos os campos personalizados.', 'error');
                return;
            }
            await ensureCsvImportEtiquetasLoaded();
            document.getElementById('csvImportStep1')?.classList.remove('active');
            document.getElementById('csvImportStep2')?.classList.add('active');
            const continueBtn = document.getElementById('csvImportContinueBtn');
            const importBtn = document.getElementById('csvImportConfirmBtn');
            const backBtn = document.getElementById('csvImportBackBtn');
            const warn = document.getElementById('csvImportFooterWarning');
            if (continueBtn) continueBtn.style.display = 'none';
            if (importBtn) importBtn.style.display = 'inline-flex';
            if (backBtn) backBtn.style.display = 'inline-flex';
            if (warn) warn.classList.remove('show');
            const input = document.getElementById('csvImportEtiquetaInput');
            const createBtn = document.getElementById('csvImportCreateEtiquetaBtn');
            if (input && !input.dataset.boundCsvImportEtiqueta) {
                input.dataset.boundCsvImportEtiqueta = '1';
                input.addEventListener('input', () => renderCsvImportEtiquetaResults(input.value));
            }
            if (createBtn && !createBtn.dataset.boundCsvImportEtiquetaCreate) {
                createBtn.dataset.boundCsvImportEtiquetaCreate = '1';
                createBtn.addEventListener('click', createCsvImportEtiquetaFromInput);
            }
            const results = document.getElementById('csvImportEtiquetasResults');
            if (results && !results.dataset.boundCsvImportEtiquetaSelect) {
                results.dataset.boundCsvImportEtiquetaSelect = '1';
                results.addEventListener('click', (ev) => {
                    const item = ev.target.closest('[data-etiqueta-id]');
                    if (!item) return;
                    const id = String(item.getAttribute('data-etiqueta-id'));
                    const idx = csvImportSelectedEtiquetaIds.indexOf(id);
                    if (idx >= 0) csvImportSelectedEtiquetaIds.splice(idx, 1);
                    else csvImportSelectedEtiquetaIds.push(id);
                    renderCsvImportSelectedEtiquetas();
                    renderCsvImportEtiquetaResults(input?.value || '');
                });
            }
            renderCsvImportSelectedEtiquetas();
            renderCsvImportEtiquetaResults('');
        }

        function goCsvImportToStep1() {
            document.getElementById('csvImportStep2')?.classList.remove('active');
            document.getElementById('csvImportStep1')?.classList.add('active');
            const continueBtn = document.getElementById('csvImportContinueBtn');
            const importBtn = document.getElementById('csvImportConfirmBtn');
            const backBtn = document.getElementById('csvImportBackBtn');
            const warn = document.getElementById('csvImportFooterWarning');
            if (continueBtn) continueBtn.style.display = 'inline-flex';
            if (importBtn) importBtn.style.display = 'none';
            if (backBtn) backBtn.style.display = 'none';
            if (warn) warn.classList.remove('show');
            updateCsvImportConfirmState();
        }

        async function importCsvContactsWithEtiquetas() {
            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; throw e; }
            if (!contaId) {
                showCsvImportMessage('Sessao expirada. Faca login novamente.', 'error');
                return;
            }

            const btn = document.getElementById('csvImportConfirmBtn');
            if (btn) { btn.disabled = true; btn.textContent = 'Importando...'; }
            try {
                const etiquetaIds = csvImportSelectedEtiquetaIds
                    .map(id => parseInt(id, 10))
                    .filter(id => Number.isFinite(id));
                const existingVariantSet = new Set();
                const existingContactByVariant = new Map();
                allContacts
                    .filter(c => (c.tipo || 'contato') === 'contato')
                    .forEach(c => {
                        const base = normalizeTelefoneForCompare(c.telefone || '');
                        buildTelefoneVariantes(base).forEach(v => {
                            existingVariantSet.add(v);
                            if (!existingContactByVariant.has(v)) existingContactByVariant.set(v, c);
                        });
                    });

                const importedVariantSet = new Set();
                const currentPhones = new Set(
                    allContacts
                        .filter(c => (c.tipo || 'contato') === 'contato')
                        .map(c => normalizeTelefoneForCompare(c.telefone || ''))
                        .filter(Boolean)
                );
                const rowsToInsert = [];
                const contactIdsToTag = new Set();
                const updateByContactId = new Map();
                let ignoredInvalid = 0;
                let ignoredDuplicate = 0;

                csvImportRawRows.forEach(row => {
                    const payload = { nome: null, telefone: null, email: null, variaveis: {} };
                    Object.keys(csvImportMapping).forEach(colIdx => {
                        const mapping = csvImportMapping[colIdx];
                        const val = String(row[Number(colIdx)] || '').trim();
                        if (!mapping || !val) return;
                        if (mapping.type === 'nome') payload.nome = val;
                        else if (mapping.type === 'email') payload.email = val;
                        else if (mapping.type === 'telefone') payload.telefone = val;
                        else if (mapping.type === 'custom') payload.variaveis[mapping.key] = val;
                    });

                    let phone = normalizeTelefoneForCompare(payload.telefone);
                    if (!phone || phone.length < 10) {
                        ignoredInvalid += 1;
                        return;
                    }
                    if (phone.length === 10) phone = '55' + phone;
                    if (phone.length === 12 && phone.startsWith('55')) phone = phone.slice(0, 4) + '9' + phone.slice(4);
                    if (phone.length < 12) {
                        ignoredInvalid += 1;
                        return;
                    }
                    const variants = buildTelefoneVariantes(phone);
                    const isDuplicate = variants.some(v => existingVariantSet.has(v) || importedVariantSet.has(v)) || currentPhones.has(phone);
                    if (isDuplicate) {
                        const existingContact = variants.map(v => existingContactByVariant.get(v)).find(Boolean);
                        if (existingContact) {
                            const updatePayload = {};
                            const existingNome = String(existingContact.nome || '').trim();
                            const existingEmail = String(existingContact.email || '').trim();
                            if (!existingNome && payload.nome) updatePayload.nome = payload.nome;
                            if (!existingEmail && payload.email) updatePayload.email = payload.email;

                            const existingVars = existingContact.variaveis && typeof existingContact.variaveis === 'object'
                                ? { ...existingContact.variaveis }
                                : {};
                            let varsChanged = false;
                            Object.entries(payload.variaveis || {}).forEach(([key, val]) => {
                                const incoming = String(val || '').trim();
                                if (!incoming) return;
                                const current = existingVars[key];
                                if (current == null || String(current).trim() === '') {
                                    existingVars[key] = incoming;
                                    varsChanged = true;
                                }
                            });
                            if (varsChanged) updatePayload.variaveis = existingVars;

                            if (Object.keys(updatePayload).length) {
                                const prev = updateByContactId.get(existingContact.id) || {};
                                const merged = { ...prev, ...updatePayload };
                                if (prev.variaveis || updatePayload.variaveis) {
                                    merged.variaveis = {
                                        ...(prev.variaveis && typeof prev.variaveis === 'object' ? prev.variaveis : {}),
                                        ...(updatePayload.variaveis && typeof updatePayload.variaveis === 'object' ? updatePayload.variaveis : {})
                                    };
                                }
                                updateByContactId.set(existingContact.id, merged);
                                if (merged.nome) existingContact.nome = merged.nome;
                                if (merged.email) existingContact.email = merged.email;
                                if (merged.variaveis) existingContact.variaveis = merged.variaveis;
                            }

                            if (etiquetaIds.length) contactIdsToTag.add(existingContact.id);
                        } else {
                            ignoredDuplicate += 1;
                        }
                        return;
                    }
                    variants.forEach(v => importedVariantSet.add(v));
                    rowsToInsert.push({
                        nome: payload.nome || null,
                        telefone: phone,
                        tipo: 'contato',
                        email: payload.email || null,
                        contaId,
                        variaveis: payload.variaveis || {},
                        lid: null
                    });
                });

                const CHUNK = 200;

                if (updateByContactId.size) {
                    const updates = Array.from(updateByContactId.entries());
                    for (let i = 0; i < updates.length; i++) {
                        const [contactId, payload] = updates[i];
                        const { error } = await window.supabase
                            .from('SAAS_Contatos')
                            .update(payload)
                            .eq('id', contactId)
                            .eq('contaId', contaId);
                        if (error) throw error;
                    }
                }

                if (!rowsToInsert.length && !updateByContactId.size && !contactIdsToTag.size) {
                    showCsvImportMessage('Nenhum contato novo valido para importar.', 'error');
                    return;
                }

                // Validacao final no banco para evitar erro de duplicidade no INSERT.
                // Isso cobre casos em que allContacts nao contem todos os contatos existentes.
                if (rowsToInsert.length) {
                    const candidatePhones = new Set();
                    rowsToInsert.forEach(item => {
                        buildTelefoneVariantes(item.telefone).forEach(v => {
                            if (v) candidatePhones.add(v);
                        });
                    });

                    const existingRowsByPhone = [];
                    const candidateList = Array.from(candidatePhones);
                    for (let i = 0; i < candidateList.length; i += CHUNK) {
                        const batchPhones = candidateList.slice(i, i + CHUNK);
                        const { data, error } = await window.supabase
                            .from('SAAS_Contatos')
                            .select('id, telefone')
                            .eq('contaId', contaId)
                            .in('telefone', batchPhones);
                        if (error) throw error;
                        if (Array.isArray(data) && data.length) existingRowsByPhone.push(...data);
                    }

                    if (existingRowsByPhone.length) {
                        const dbVariantSet = new Set();
                        const dbContactByVariant = new Map();
                        existingRowsByPhone.forEach(c => {
                            const base = normalizeTelefoneForCompare(c.telefone || '');
                            buildTelefoneVariantes(base).forEach(v => {
                                dbVariantSet.add(v);
                                if (!dbContactByVariant.has(v)) dbContactByVariant.set(v, c);
                            });
                        });

                        const filteredRows = [];
                        rowsToInsert.forEach(item => {
                            const variants = buildTelefoneVariantes(item.telefone);
                            const duplicatedInDb = variants.some(v => dbVariantSet.has(v));
                            if (duplicatedInDb) {
                                ignoredDuplicate += 1;
                                const existingContact = variants.map(v => dbContactByVariant.get(v)).find(Boolean);
                                if (existingContact && etiquetaIds.length) contactIdsToTag.add(existingContact.id);
                                return;
                            }
                            filteredRows.push(item);
                        });
                        rowsToInsert.length = 0;
                        rowsToInsert.push(...filteredRows);
                    }
                }

                const insertedContacts = [];
                for (let i = 0; i < rowsToInsert.length; i += CHUNK) {
                    const chunk = rowsToInsert.slice(i, i + CHUNK);
                    const { data, error } = await window.supabase.from('SAAS_Contatos').insert(chunk).select('id');
                    if (error) throw error;
                    if (Array.isArray(data)) insertedContacts.push(...data);
                }

                if (etiquetaIds.length) {
                    insertedContacts.forEach(c => contactIdsToTag.add(c.id));
                    const idsToLink = Array.from(contactIdsToTag).filter(id => Number.isFinite(Number(id)));
                    if (idsToLink.length) {
                        const { data: existingLinks, error: linksErr } = await window.supabase
                            .from('SAAS_Contatos_Etiquetas')
                            .select('contatoId, etiquetaId')
                            .eq('contaId', contaId)
                            .in('contatoId', idsToLink)
                            .in('etiquetaId', etiquetaIds);
                        if (linksErr) throw linksErr;
                        const linkSet = new Set((existingLinks || []).map(l => `${l.contatoId}:${l.etiquetaId}`));
                        const vinculos = [];
                        idsToLink.forEach(cid => {
                            etiquetaIds.forEach(eid => {
                                const key = `${cid}:${eid}`;
                                if (!linkSet.has(key)) vinculos.push({ contatoId: cid, etiquetaId: eid, contaId });
                            });
                        });
                        for (let i = 0; i < vinculos.length; i += CHUNK) {
                            const batch = vinculos.slice(i, i + CHUNK);
                            const { error } = await window.supabase.from('SAAS_Contatos_Etiquetas').insert(batch);
                            if (error) throw error;
                        }
                    }
                }

                closeCsvImportModal();
                await loadContacts();
                showToast(
                    rowsToInsert.length + ' contato(s) importado(s) com sucesso.' +
                    (updateByContactId.size ? (' ' + updateByContactId.size + ' contato(s) existente(s) atualizado(s).') : '') +
                    (etiquetaIds.length ? (' Etiquetas aplicadas em ' + contactIdsToTag.size + ' contato(s).') : '') +
                    (ignoredDuplicate ? (' ' + ignoredDuplicate + ' duplicado(s) ignorado(s).') : '') +
                    (ignoredInvalid ? (' ' + ignoredInvalid + ' invalido(s) ignorado(s).') : ''),
                    'success'
                );
            } catch (e) {
                showCsvImportMessage('Erro na importacao: ' + ((e && e.message) || 'erro desconhecido'), 'error');
            } finally {
                if (btn) { btn.disabled = false; btn.textContent = 'Importar contatos'; }
            }
        }

        function showCsvImportMessage(message, type) {
            const el = document.getElementById('csvImportMessage');
            if (!el) {
                showToast(message, type === 'error' ? 'error' : 'info');
                return;
            }
            el.textContent = message || '';
            el.className = message ? ('sync-groups-message show ' + (type || 'info')) : 'sync-groups-message';
        }

        function showSyncGroupsMessage(message, type = 'info') {
            const el = document.getElementById('syncGroupsMessage');
            if (!el) return;
            if (!message) {
                el.className = 'sync-groups-message';
                el.textContent = '';
                return;
            }
            el.textContent = message;
            el.className = 'sync-groups-message show ' + type;
        }

        function resetSyncGroupsData() {
            syncGroupsAll = [];
            syncGroupsFiltered = [];
            const list = document.getElementById('syncGroupsList');
            const count = document.getElementById('syncGroupsCount');
            const resultsWrap = document.getElementById('syncGroupsResultsWrap');
            const saveBtn = document.getElementById('syncGroupsSaveBtn');
            const searchInput = document.getElementById('syncGroupsSearchInput');
            if (list) list.innerHTML = '';
            if (count) count.textContent = '0 grupos encontrados';
            if (resultsWrap) resultsWrap.style.display = 'none';
            if (saveBtn) saveBtn.style.display = 'none';
            if (searchInput) searchInput.value = '';
        }

        function closeSyncGroupsModal() {
            document.getElementById('syncGroupsModal')?.classList.remove('active');
            showSyncGroupsMessage('');
            resetSyncGroupsData();
            const sel = document.getElementById('syncGroupsConnectionSelect');
            const fetchBtn = document.getElementById('syncGroupsFetchBtn');
            if (sel) sel.value = '';
            if (fetchBtn) fetchBtn.disabled = true;
            syncGroupsSelectedConnection = null;
            stopSyncGroupsProgress();
        }

        function openSyncGroupsModal() {
            document.getElementById('syncGroupsModal')?.classList.add('active');
            showSyncGroupsMessage('Carregando conexoes...', 'info');
            resetSyncGroupsData();
            loadSyncGroupsConnections();
        }

        function normalizeSyncPhone(phone) {
            if (!phone) return '';
            return String(phone).replace('@s.whatsapp.net', '').replace(/[^0-9]/g, '');
        }

        function compareSyncPhones(phone1, phone2) {
            if (!phone1 || !phone2) return false;
            if (phone1 === phone2) return true;
            if (phone1.length === 11 && phone2.length === 10) return (phone1.slice(0, 2) + phone1.slice(3)) === phone2;
            if (phone2.length === 11 && phone1.length === 10) return (phone2.slice(0, 2) + phone2.slice(3)) === phone1;
            return false;
        }

        function getInstancePhoneFromConnection(conn) {
            const fromFields = [
                conn?.instanceName,
                conn?.instance_name,
                conn?.Telefone,
                conn?.telefone,
                conn?.phone
            ];
            for (const field of fromFields) {
                const n = normalizeSyncPhone(field);
                if (n.length >= 10) return n;
            }
            const nome = String(conn?.NomeConexao || '');
            const match = nome.match(/(\d{10,15})/);
            if (match) return match[1];
            return '';
        }

        async function loadSyncGroupsConnections() {
            const select = document.getElementById('syncGroupsConnectionSelect');
            const fetchBtn = document.getElementById('syncGroupsFetchBtn');
            if (!select || !fetchBtn) return;

            select.innerHTML = '<option value="">Selecione...</option>';
            fetchBtn.disabled = true;
            syncGroupsSelectedConnection = null;
            syncGroupsConnections = [];

            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; throw e; }
            if (!contaId) {
                showSyncGroupsMessage('Sessao expirada. Faca login novamente.', 'error');
                return;
            }

            const { data, error } = await window.supabase
                .from('SAAS_Conexões')
                .select('id, instanceName, NomeConexao, Telefone, Apikey')
                .eq('contaId', contaId);
            if (error) {
                showSyncGroupsMessage('Erro ao carregar conexoes: ' + (error.message || 'erro'), 'error');
                return;
            }

            syncGroupsConnections = (data || []).filter(c => c && (c.instanceName || c.NomeConexao)).map(c => ({
                id: c.id,
                instanceName: c.instanceName,
                instance_name: c.instanceName,
                NomeConexao: c.NomeConexao,
                Telefone: c.Telefone,
                apikey: c.Apikey
            }));

            if (!syncGroupsConnections.length) {
                select.innerHTML = '<option value="">Nenhuma conexao encontrada</option>';
                showSyncGroupsMessage('Nenhuma conexao encontrada.', 'info');
                return;
            }

            select.innerHTML += syncGroupsConnections.map(conn => {
                const nome = conn.NomeConexao || conn.instanceName;
                return `<option value="${escapeHtml(String(conn.instanceName || ''))}" data-connected="checking">🔄 ${escapeHtml(nome)} (verificando...)</option>`;
            }).join('');
            showSyncGroupsMessage('Verificando status das conexoes...', 'info');

            let checked = 0;
            syncGroupsConnections.forEach(async (conn, idx) => {
                let isConnected = false;
                try {
                    const resp = await fetch(`https://evo.chatconversa.app.br/instance/connectionState/${conn.instanceName}`, {
                        method: 'GET',
                        headers: { apikey: conn.apikey || '' }
                    });
                    if (resp.ok) {
                        const statusData = await resp.json();
                        isConnected = statusData?.instance?.state === 'open';
                    }
                } catch (e) {}
                conn.isConnected = isConnected;
                const option = select.options[idx + 1];
                if (option) {
                    option.setAttribute('data-connected', isConnected ? '1' : '0');
                    option.textContent = (isConnected ? '✅ ' : '❌ ') + (conn.NomeConexao || conn.instanceName) + (isConnected ? ' (Conectada)' : ' (Desconectada)');
                }
                checked += 1;
                if (checked === syncGroupsConnections.length) {
                    const on = syncGroupsConnections.filter(c => c.isConnected).length;
                    if (on === 0) showSyncGroupsMessage('Nenhuma conexao esta conectada no WhatsApp.', 'error');
                    else if (on === syncGroupsConnections.length) showSyncGroupsMessage(`✅ Todas as ${on} conexoes estao conectadas.`, 'success');
                    else showSyncGroupsMessage('');
                }
            });
        }

        function setSyncGroupsFetchLoading(loading) {
            const btn = document.getElementById('syncGroupsFetchBtn');
            if (!btn) return;
            btn.disabled = loading || !syncGroupsSelectedConnection;
            btn.textContent = loading ? 'Puxando...' : 'Puxar grupos';
        }

        function setSyncGroupsSaveLoading(loading) {
            const btn = document.getElementById('syncGroupsSaveBtn');
            if (!btn) return;
            btn.disabled = loading;
            btn.textContent = loading ? 'Salvando...' : 'Salvar';
        }

        function startSyncGroupsProgress() {
            const wrap = document.getElementById('syncGroupsProgressWrap');
            const bar = document.getElementById('syncGroupsProgressBar');
            const txt = document.getElementById('syncGroupsProgressText');
            if (!wrap || !bar || !txt) return;
            if (syncGroupsProgressTimer) {
                clearInterval(syncGroupsProgressTimer);
                syncGroupsProgressTimer = null;
            }
            wrap.style.display = 'block';
            let pct = 0;
            bar.style.width = '0%';
            txt.textContent = 'Puxando grupos... 0%';
            syncGroupsProgressTimer = setInterval(() => {
                pct = Math.min(92, pct + (100 / 60));
                bar.style.width = pct + '%';
                txt.textContent = `Puxando grupos... ${Math.floor(pct)}%`;
            }, 1000);
        }

        function stopSyncGroupsProgress(completed = true) {
            const wrap = document.getElementById('syncGroupsProgressWrap');
            const bar = document.getElementById('syncGroupsProgressBar');
            const txt = document.getElementById('syncGroupsProgressText');
            if (syncGroupsProgressTimer) {
                clearInterval(syncGroupsProgressTimer);
                syncGroupsProgressTimer = null;
            }
            if (completed) {
                if (bar) bar.style.width = '100%';
                if (txt) txt.textContent = 'Puxando grupos... 100%';
            } else {
                if (bar) bar.style.width = '0%';
                if (txt) txt.textContent = 'Puxando grupos... 0%';
            }
            setTimeout(() => { if (wrap) wrap.style.display = 'none'; }, 500);
        }

        function updateSyncGroupsCountAndSave() {
            const count = document.getElementById('syncGroupsCount');
            const saveBtn = document.getElementById('syncGroupsSaveBtn');
            const total = syncGroupsAll.length;
            const selected = syncGroupsAll.filter(g => g.selected).length;
            const novos = syncGroupsAll.filter(g => g.selected && !g.isDuplicate).length;
            const duplicados = syncGroupsAll.filter(g => g.selected && g.isDuplicate).length;
            if (count) {
                let txt = `${selected} de ${total} grupos selecionados`;
                if (duplicados > 0) txt += ` (${novos} novos, ${duplicados} ja existem)`;
                count.textContent = txt;
            }
            if (saveBtn) saveBtn.style.display = novos > 0 ? 'inline-flex' : 'none';
        }

        function renderSyncGroupsList() {
            const list = document.getElementById('syncGroupsList');
            if (!list) return;
            if (!syncGroupsFiltered.length) {
                list.innerHTML = '<div style="padding:22px;text-align:center;color:#64748b;">Nenhum grupo encontrado.</div>';
                updateSyncGroupsCountAndSave();
                return;
            }
            list.innerHTML = syncGroupsFiltered.map(group => {
                const badges = [];
                if (group.isDuplicate) badges.push('<span class="sync-group-badge duplicate">Ja existe</span>');
                if (group.isOwner) badges.push('<span class="sync-group-badge owner">Dono</span>');
                if (group.isCommunity) badges.push('<span class="sync-group-badge community">Comunidade</span>');
                if (group.announce) badges.push('<span class="sync-group-badge announce">Bloqueado</span>');
                return `
                    <div class="sync-group-item ${group.isDuplicate ? 'duplicate' : ''}" data-id="${escapeHtml(String(group.id))}">
                        <input type="checkbox" class="sync-group-checkbox" data-id="${escapeHtml(String(group.id))}" ${group.selected ? 'checked' : ''}>
                        <div class="sync-group-main">
                            <div class="sync-group-name">${escapeHtml(group.name || 'Sem nome')}</div>
                            ${badges.length ? `<div class="sync-group-badges">${badges.join('')}</div>` : ''}
                        </div>
                    </div>
                `;
            }).join('');
            updateSyncGroupsCountAndSave();
        }

        function filterSyncGroupsBySearch() {
            const term = String(document.getElementById('syncGroupsSearchInput')?.value || '').trim().toLowerCase();
            syncGroupsFiltered = !term ? [...syncGroupsAll] : syncGroupsAll.filter(g => String(g.name || '').toLowerCase().includes(term));
            renderSyncGroupsList();
        }

        async function fetchWhatsappGroupsForSync() {
            if (!syncGroupsSelectedConnection) return;
            setSyncGroupsFetchLoading(true);
            showSyncGroupsMessage('');
            resetSyncGroupsData();
            startSyncGroupsProgress();
            try {
                let response = null;
                let lastError = null;
                const maxAttempts = 3;
                const requestBody = JSON.stringify({
                    instanceName: syncGroupsSelectedConnection.instanceName || syncGroupsSelectedConnection.instance_name
                });
                for (let attempt = 1; attempt <= maxAttempts; attempt++) {
                    try {
                        response = await fetch('/hublabel/public/listar-grupos', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: requestBody
                        });
                        if (!response.ok) throw new Error('Erro ao puxar grupos.');
                        lastError = null;
                        break;
                    } catch (err) {
                        lastError = err;
                        if (attempt < maxAttempts) {
                            await new Promise(resolve => setTimeout(resolve, 600));
                        }
                    }
                }
                if (lastError || !response) throw (lastError || new Error('Falha ao puxar grupos.'));
                if (!response.ok) throw new Error('Erro ao puxar grupos.');
                const data = await response.json();
                let groupsData = [];
                if (Array.isArray(data) && data.length > 0 && data[0].data && Array.isArray(data[0].data)) groupsData = data[0].data;
                else if (data && data.data && Array.isArray(data.data)) groupsData = data.data;
                else if (Array.isArray(data)) groupsData = data;

                const existingGroupIds = new Set(
                    allContacts
                        .filter(c => c.tipo === 'grupo')
                        .map(c => String(c.variaveis?.whatsappId || '').trim())
                        .filter(Boolean)
                );
                const connPhone = getInstancePhoneFromConnection(syncGroupsSelectedConnection);

                syncGroupsAll = groupsData.map(g => {
                    const groupId = String(g.id || g.WhatsAppId || g.WhatsappId || '').trim();
                    const ownerPhone = normalizeSyncPhone(g.owner);
                    return {
                        id: groupId,
                        name: g.subject || g.name || '',
                        selected: groupId ? !existingGroupIds.has(groupId) : false,
                        whatsappId: groupId,
                        isDuplicate: groupId ? existingGroupIds.has(groupId) : false,
                        owner: g.owner || null,
                        announce: g.announce === true,
                        isCommunity: g.isCommunity === true,
                        isOwner: connPhone && ownerPhone ? compareSyncPhones(connPhone, ownerPhone) : false
                    };
                }).filter(g => g.whatsappId);

                syncGroupsFiltered = [...syncGroupsAll];
                document.getElementById('syncGroupsResultsWrap').style.display = 'block';
                renderSyncGroupsList();
                stopSyncGroupsProgress(true);
                showSyncGroupsMessage(`✅ ${syncGroupsAll.length} grupos carregados!`, 'success');
            } catch (e) {
                stopSyncGroupsProgress(false);
                showSyncGroupsMessage(e?.message || 'Falha ao puxar grupos.', 'error');
            } finally {
                setSyncGroupsFetchLoading(false);
            }
        }

        async function saveSyncedGroupsAsContacts() {
            const selected = syncGroupsAll.filter(g => g.selected);
            if (!selected.length) {
                showSyncGroupsMessage('Selecione pelo menos um grupo para salvar.', 'info');
                return;
            }
            const newGroups = selected.filter(g => !g.isDuplicate);
            if (!newGroups.length) {
                showSyncGroupsMessage(`Todos os ${selected.length} grupos selecionados ja existem na base de contatos.`, 'info');
                return;
            }

            let contaId;
            try { contaId = await obterUserIdComStatus(); } catch (e) { if (e.message === 'STATUS_BLOQUEADO') return; throw e; }
            if (!contaId) {
                showSyncGroupsMessage('Sessao expirada. Faca login novamente.', 'error');
                return;
            }

            const idConexao = syncGroupsSelectedConnection?.id || null;
            const rows = newGroups.map(g => ({
                nome: g.name || null,
                telefone: null,
                tipo: 'grupo',
                email: null,
                contaId,
                variaveis: {
                    whatsappId: g.whatsappId,
                    idConexao: idConexao
                },
                lid: null
            }));

            setSyncGroupsSaveLoading(true);
            try {
                const { error } = await window.supabase
                    .from('SAAS_Contatos')
                    .insert(rows);
                if (error) throw new Error(error.message || 'Erro ao salvar grupos.');

                const ignored = selected.length - newGroups.length;
                showToast(
                    ignored > 0
                        ? `${newGroups.length} grupo(s) salvo(s) com sucesso. ${ignored} ja existia(m) e foi(ram) ignorado(s).`
                        : `${newGroups.length} grupo(s) salvo(s) com sucesso!`,
                    'success'
                );
                closeSyncGroupsModal();
                await loadContacts();
            } catch (e) {
                showSyncGroupsMessage(e?.message || 'Erro ao salvar grupos.', 'error');
            } finally {
                setSyncGroupsSaveLoading(false);
            }
        }

        async function logout() {
            if (window.supabase) await window.supabase.auth.signOut().catch(() => {});
            document.cookie = 'userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            if (typeof clearMenuOcultarCache === 'function') clearMenuOcultarCache();
            sessionStorage.clear(); localStorage.clear();
            window.location.href = '/hublabel/public/hublabel/public/hublabel/public/hublabel/public/login';
        }

        function initDarkMode() {
            const dm = getCookie('darkMode');
            const isDark = dm === 'true';
            document.body.classList.toggle('light-mode', !isDark);
            document.body.classList.toggle('dark-mode', isDark);
            const t = document.getElementById('darkModeToggle');
            if (t) {
                t.checked = isDark;
                t.onchange = () => {
                    const v = t.checked;
                    document.body.classList.toggle('light-mode', !v);
                    document.body.classList.toggle('dark-mode', v);
                    document.getElementById('themeToggleText').textContent = v ? 'Modo Escuro' : 'Modo Claro';
                    setCookie('darkMode', v ? 'true' : 'false', 365);
                };
            }
            const txt = document.getElementById('themeToggleText');
            if (txt) txt.textContent = isDark ? 'Modo Escuro' : 'Modo Claro';
        }

        async function carregarVersao() {
            const el = document.getElementById('versaoAtualTexto');
            if (!el || !window.supabase) return;
            try {
                const { data } = await window.supabase.from('SAAS_Versao').select('versaoAtual').order('ultimaAtualizacao', { ascending: false }).limit(1);
                if (data && data[0]?.versaoAtual) el.textContent = 'Versao atual: ' + data[0].versaoAtual;
            } catch (e) {}
        }

        async function checkAdmin() {
            const el = document.getElementById('menu-item-admin');
            if (!el) return;
            try {
                const { data: { user } } = await window.supabase.auth.getUser();
                if (!user) { el.style.display = 'none'; return; }
                const { data } = await window.supabase.from('SAAS_Usuarios').select('super_admin').eq('auth_user_id', user.id).single();
                el.style.display = (data && data.super_admin) ? 'flex' : 'none';
            } catch (e) { el.style.display = 'none'; }
        }

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

        (function() {
            var sidebarCollapseTimer = null;
            var SIDEBAR_EDGE = 72;
            var SIDEBAR_EXPANDED_WIDTH = 250;
            var COLLAPSE_DELAY_MS = 120;
            document.addEventListener('mousemove', function(e) {
                if (window.matchMedia('(max-width: 768px)').matches) return;
                var sidebar = document.getElementById('sidebar');
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
                } catch (e) { /* cache invalido */ }
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

        document.addEventListener('DOMContentLoaded', async () => {
            initDarkMode();
            initMenuOcultar();
            carregarVersao();
            checkAdmin();
            const syncBtn = document.getElementById('syncGroupsContactsBtn');
            const syncModal = document.getElementById('syncGroupsModal');
            const syncClose = document.getElementById('closeSyncGroupsModalBtn');
            const syncCancel = document.getElementById('syncGroupsCancelBtn');
            const syncConnSelect = document.getElementById('syncGroupsConnectionSelect');
            const syncFetch = document.getElementById('syncGroupsFetchBtn');
            const syncSearch = document.getElementById('syncGroupsSearchInput');
            const syncSave = document.getElementById('syncGroupsSaveBtn');
            const syncList = document.getElementById('syncGroupsList');
            document.getElementById('syncGroupsSelectAllBtn')?.addEventListener('click', () => {
                syncGroupsAll.forEach(g => { g.selected = true; });
                filterSyncGroupsBySearch();
            });
            document.getElementById('syncGroupsUnselectAllBtn')?.addEventListener('click', () => {
                syncGroupsAll.forEach(g => { g.selected = false; });
                filterSyncGroupsBySearch();
            });
            syncBtn?.addEventListener('click', openSyncGroupsModal);
            syncClose?.addEventListener('click', closeSyncGroupsModal);
            syncCancel?.addEventListener('click', closeSyncGroupsModal);
            syncModal?.addEventListener('click', (e) => { if (e.target === syncModal) closeSyncGroupsModal(); });
            syncConnSelect?.addEventListener('change', () => {
                const val = syncConnSelect.value;
                const selectedOption = syncConnSelect.options[syncConnSelect.selectedIndex];
                const connected = selectedOption?.getAttribute('data-connected') === '1';
                syncGroupsSelectedConnection = syncGroupsConnections.find(c => (c.instanceName || c.instance_name) === val) || null;
                syncFetch.disabled = !(syncGroupsSelectedConnection && connected);
                if (syncGroupsSelectedConnection && !connected) {
                    showSyncGroupsMessage('Conexao desconectada. Conecte o WhatsApp antes de sincronizar.', 'error');
                } else if (syncGroupsSelectedConnection) {
                    showSyncGroupsMessage('', 'info');
                }
                resetSyncGroupsData();
            });
            syncFetch?.addEventListener('click', fetchWhatsappGroupsForSync);
            syncSearch?.addEventListener('input', filterSyncGroupsBySearch);
            syncSave?.addEventListener('click', saveSyncedGroupsAsContacts);
            syncList?.addEventListener('click', (ev) => {
                const row = ev.target.closest('.sync-group-item');
                if (!row) return;
                const id = row.getAttribute('data-id');
                if (!id) return;
                const targetGroup = syncGroupsAll.find(g => String(g.id) === String(id));
                if (!targetGroup) return;
                if (ev.target.classList.contains('sync-group-checkbox')) {
                    targetGroup.selected = ev.target.checked;
                } else {
                    targetGroup.selected = !targetGroup.selected;
                }
                filterSyncGroupsBySearch();
            });
            await loadContacts();
            document.getElementById('searchFilter').addEventListener('input', applyFilters);
            document.getElementById('searchFilter').addEventListener('keyup', applyFilters);
            document.getElementById('dateFrom')?.addEventListener('blur', applyFilters);
            document.getElementById('dateTo')?.addEventListener('blur', applyFilters);
        });
    </script>
</body>
</html>