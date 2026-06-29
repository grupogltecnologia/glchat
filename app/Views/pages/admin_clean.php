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
    <title>Administração - IA Chatconversa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="shortcut icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="apple-touch-icon" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
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
            --dm-surface: rgba(30, 41, 59, 0.6);
            --dm-surface-solid: #1e293b;
            --dm-border: rgba(71, 85, 105, 0.4);
            --dm-border-strong: rgba(71, 85, 105, 0.55);
            --dm-text: #e2e8f0;
            --dm-text-muted: #94a3b8;
            --dm-heading: #f8fafc;
        }

        body {
            background: #f4f4f5;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #18181b;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            transition: background 0.3s ease, color 0.3s ease;
            -webkit-font-smoothing: antialiased;
        }

        button,
        input,
        textarea,
        select {
            font-family: inherit;
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

        /* Sidebar: itens menores em telas com pouca altura (igual agente-ia) */
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

        .logout-item {
            color: #ff6b6b !important;
        }

        .logout-item:hover {
            background: rgba(255, 107, 107, 0.1) !important;
            color: #ff6b6b !important;
        }

        /* Dark Mode Toggle Switch (igual agente-ia) */
        .theme-toggle-item {
            cursor: default;
        }

        .theme-toggle-item:hover {
            background: transparent !important;
            color: inherit !important;
        }

        .theme-switch {
            position: relative;
            display: none;
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

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 5px;
            left: 20px;
            z-index: 10001;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(108, 99, 255, 0.3);
            border-radius: 8px;
            padding: 8px;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
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

        /* Main content — área admin estilo gemini.html (surface clara) */
        .main-content {
            flex: 1;
            padding: 0;
            overflow-x: auto;
            margin-left: 72px;
            position: relative;
            background: #f4f4f5;
            min-height: 100vh;
        }

        .admin-main-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Sticky header + abas (gemini: px-8 md:px-12 pt-10 border-b bg-white) */
        .admin-sticky-head {
            position: sticky;
            top: 0;
            z-index: 30;
            flex-shrink: 0;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            padding: 40px 32px 0;
        }

        @media (min-width: 768px) {
            .admin-sticky-head {
                padding: 40px 48px 0;
            }
        }

        .admin-page-body {
            padding: 32px 32px 48px;
        }

        @media (min-width: 768px) {
            .admin-page-body {
                padding: 48px 48px 48px;
            }
        }

        .header {
            margin-bottom: 0;
            display: block;
        }

        /* text-3xl font-extrabold tracking-tight text-slate-900 mb-2 */
        .header-info h1 {
            font-size: 1.875rem;
            line-height: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }

        /* text-slate-500 font-medium text-sm */
        .header-info p {
            color: #64748b;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            margin-bottom: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Abas: flex gap-8 mt-8, text-sm font-bold pb-3 border-b-2 */
        .nav-tabs {
            margin: 0;
            margin-top: 2rem;
            padding: 0;
            border: none;
            background: transparent;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .nav-tabs::-webkit-scrollbar {
            display: none;
        }

        .nav-tabs-container {
            display: flex;
            gap: 2rem;
            min-width: max-content;
            padding-bottom: 0;
        }

        .nav-tab {
            padding: 0 2px 0.75rem;
            text-align: center;
            color: #94a3b8;
            cursor: pointer;
            transition: color 0.2s ease, border-color 0.2s ease;
            border: none;
            border-bottom: 2px solid transparent;
            background: none;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .nav-tab i {
            font-size: 1rem;
            line-height: 1;
        }
        .emails-tab-warning-icon {
            color: #f59e0b;
            font-size: 0.9rem !important;
            line-height: 1;
        }

        .nav-tab:hover {
            color: #0f172a;
        }

        /* Ativo: text-brand-600 border-brand-500 (Tailwind theme: 600 #6C63FF, 500 #6C63FF) */
        .nav-tab.active {
            color: #6C63FF;
            border-bottom-color: #6C63FF;
        }

        /* Content Sections */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Banner onboarding — bg-slate-900 rounded-3xl p-6 shadow-soft */
        .admin-info-block {
            background: #0f172a;
            border-radius: 1.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
        }

        @media (min-width: 640px) {
            .admin-info-block {
                flex-direction: row;
            }
        }

        .admin-info-block-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-info-play {
            width: 3rem;
            height: 3rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5ee99a;
            flex-shrink: 0;
            backdrop-filter: blur(6px);
        }

        .admin-info-play i {
            margin-left: 3px;
        }

        /* text-white font-extrabold text-lg */
        .admin-info-title {
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 800;
            color: #ffffff;
        }

        /* text-slate-400 text-xs font-medium mt-0.5 */
        .admin-info-sub {
            font-size: 0.75rem;
            line-height: 1rem;
            font-weight: 500;
            color: #94a3b8;
            margin-top: 0.125rem;
        }

        /* bg-white font-bold px-6 py-2.5 rounded-xl text-sm */
        .admin-info-block .admin-info-link {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 0.75rem;
            padding: 0.625rem 1.5rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            background: #ffffff;
            text-decoration: none;
            white-space: nowrap;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: background 0.2s ease;
        }

        .admin-info-block .admin-info-link:hover {
            background: #f1f5f9;
        }

        /* Bento KPI — grid gap-6, rounded-[2rem] p-6 shadow-soft border-slate-100 */
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1280px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 2rem;
            padding: 1.5rem;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
        }

        .stat-card.stat-card--accent {
            border-left: 4px solid #6C63FF;
        }

        .stat-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-card-icon {
            width: 2rem;
            height: 2rem;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .stat-card-icon.brand { background: #ecfdf5; color: #6C63FF; }
        .stat-card-icon.blue { background: #eff6ff; color: #2563eb; }
        .stat-card-icon.indigo { background: #eef2ff; color: #4f46e5; }

        /* text-xs font-extrabold text-slate-400 uppercase tracking-widest */
        .stat-card-title {
            font-size: 0.75rem;
            line-height: 1rem;
            color: #94a3b8;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0;
        }

        .stat-kpi-money-row {
            display: flex;
            align-items: baseline;
            gap: 0.25rem;
            margin-top: auto;
        }

        /* Mesma cor do valor (.stat-kpi-amount) */
        .stat-kpi-currency {
            font-size: 1.875rem;
            line-height: 2.25rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.05em;
        }

        /* text-4xl font-black text-slate-900 tracking-tighter leading-none */
        .stat-kpi-amount {
            font-size: 2.25rem;
            line-height: 1;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.05em;
        }

        .stat-kpi-amount.stat-kpi-amount--brand {
            color: #6C63FF;
        }

        /* text-5xl font-black */
        .stat-kpi-amount-xl {
            font-size: 3rem;
            line-height: 1;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.05em;
        }

        .stat-kpi-trend-row {
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            line-height: 1rem;
            font-weight: 700;
        }

        .stat-kpi-trend-badge {
            background: #ecfdf5;
            color: #6C63FF;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
        }

        .stat-kpi-trend-muted {
            color: #94a3b8;
            font-weight: 700;
        }

        /* text-[10px] font-bold text-slate-400 uppercase */
        .stat-kpi-foot {
            font-size: 10px;
            line-height: 1rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            margin-top: 1rem;
        }

        .stat-card.stat-card--clients-total {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-clients-bar {
            width: 100%;
            background: #f1f5f9;
            height: 0.375rem;
            border-radius: 999px;
            margin-top: 1rem;
            overflow: hidden;
            display: flex;
        }

        .stat-clients-bar-seg {
            height: 100%;
            transition: width 0.3s ease;
        }

        .stat-clients-bar-seg--active {
            background: #6C63FF;
        }

        .stat-clients-bar-seg--rest {
            background: #cbd5e1;
        }

        /* Gráficos — grid lg:grid-cols-2 gap-6 rounded-[2rem] p-8 */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 1024px) {
            .charts-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .chart-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 2rem;
            padding: 2rem;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
        }

        .chart-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
        }

        .chart-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        /* text-lg font-extrabold text-slate-900 */
        .chart-title {
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 800;
            margin: 0;
            color: #0f172a;
            letter-spacing: -0.025em;
        }

        .chart-filter-pill {
            background: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            line-height: 1rem;
            font-weight: 700;
            cursor: default;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .chart-filter-pill i {
            font-size: 8px;
        }

        .chart-legend-inline {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-legend-swatch {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 0.125rem;
            background: #6C63FF;
        }

        .chart-legend-text {
            font-size: 0.75rem;
            line-height: 1rem;
            font-weight: 700;
            color: #64748b;
        }

        .chart-visual-area {
            flex: 1;
            width: 100%;
            min-height: 250px;
            position: relative;
            display: flex;
            align-items: flex-end;
        }

        .chart-grid-y {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            pointer-events: none;
            padding-bottom: 1.5rem;
        }

        .chart-grid-line {
            border-bottom: 1px dashed #e2e8f0;
            width: 100%;
            height: 0;
            position: relative;
        }

        .chart-grid-line--solid {
            border-bottom-style: solid;
        }

        .chart-grid-label {
            position: absolute;
            left: -1.5rem;
            top: -0.5rem;
            font-size: 10px;
            line-height: 1rem;
            font-weight: 700;
            color: #94a3b8;
        }

        .chart-svg-acquisition {
            width: 100%;
            height: 100%;
            min-height: 250px;
            color: #6C63FF;
            z-index: 10;
            padding: 0 0 1.5rem 1rem;
            overflow: visible;
        }

        .chart-bars-row {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            padding: 0 1rem 1.5rem;
            position: relative;
            z-index: 10;
        }

        .chart-bar {
            width: 3rem;
            border-radius: 0.75rem 0.75rem 0 0;
            position: relative;
            transition: background-color 0.2s ease, height 0.35s ease;
            min-height: 4px;
        }

        .chart-bar--40 {
            background: rgba(108, 99, 255, 0.4);
        }

        .chart-bar--70 {
            background: rgba(108, 99, 255, 0.7);
        }

        .chart-bar--100 {
            background: #6C63FF;
            box-shadow: 0 0 15px rgba(108, 99, 255, 0.3);
        }

        .chart-bar--50 {
            background: rgba(108, 99, 255, 0.5);
        }

        .chart-bar:hover {
            background: #6C63FF !important;
        }

        .chart-bar-tooltip {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-bottom: 0.5rem;
            background: #0f172a;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s ease;
            pointer-events: none;
        }

        .chart-bar:hover .chart-bar-tooltip {
            opacity: 1;
        }

        /* Tables */
        .table-container {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 30px;
            overflow: hidden;
            margin-bottom: 20px;
            width: 100%;
            max-width: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
        }

        .table-header {
            padding: 25px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #0f172a;
        }

        .table-filters {
            padding: 20px 25px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            padding: 15px 25px;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            border-bottom: 1px solid #e2e8f0;
        }

        .table td {
            padding: 20px 25px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        .table tr:hover {
            background: #f8fafc;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .btn-openai {
            background: #6C63FF;
            color: #ffffff;
            border: 1px solid #6C63FF;
            border-radius: 14px;
            padding: 10px 16px;
        }

        .btn-openai:hover {
            background: #1fb954;
            transform: none;
            box-shadow: none;
        }

        .btn-openai-test {
            background: #ffffff;
            color: #334155;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 10px 16px;
        }

        .btn-openai-test:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        .btn-primary {
            background: #6C63FF;
            color: white;
            border-radius: 14px;
            box-shadow: 0 10px 20px rgba(108, 99, 255, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 26px rgba(108, 99, 255, 0.3);
        }

        .plan-name {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .plan-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            border: 1px solid #e2e8f0;
            flex-shrink: 0;
        }

        .plan-icon.free { background: #f1f5f9; color: #64748b; }
        .plan-icon.basic { background: #eff6ff; color: #2563eb; }
        .plan-icon.gold { background: #fef3c7; color: #b45309; }
        .plan-icon.default { background: #ecfdf5; color: #6C63FF; }

        .plan-title {
            font-size: 1.05rem;
            color: #0f172a;
            font-weight: 800;
            line-height: 1.1;
        }

        .plan-price {
            margin-top: 4px;
            color: #6C63FF;
            font-size: 0.95rem;
            font-weight: 800;
        }

        .plan-meta-col {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .plan-meta-item {
            font-size: 0.9rem;
            color: #475569;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .plan-meta-item .meta-icon {
            width: 16px;
            text-align: center;
            color: #94a3b8;
            flex-shrink: 0;
        }

        .plan-meta-item.unlimited {
            color: #b45309;
            font-weight: 800;
        }

        .plan-meta-item.unlimited .meta-icon {
            color: #d97706;
        }

        .plan-action-btn {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #94a3b8;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .plan-action-btn:hover {
            color: #0f172a;
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        /* Form Elements */
        .form-input, .form-select {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            padding-right: 40px;
        }

        .form-select option {
            background: #1a1a1a !important;
            color: #ffffff !important;
            padding: 10px !important;
        }

        /* Garantir contraste em todos os navegadores */
        select.form-select {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #ffffff !important;
        }

        select.form-select option {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }

        select.form-select:focus {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #ffffff !important;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #6C63FF;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }

        .form-input::placeholder {
            color: #666;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .btn-primary {
            background: #6C63FF;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #ccc;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        }

        .btn-small {
            padding: 8px 12px;
            font-size: 0.8rem;
        }

        .btn-openai {
            background: linear-gradient(135deg, #10a37f 0%, #0d8a6b 100%);
            color: white;
            border: 1px solid #10a37f;
        }

        /* Garante o mesmo verde do botão OpenAI padrão */
        #configurar-openai-btn.btn-openai,
        #configurar-openai-btn.btn-openai.btn-small {
            background: linear-gradient(135deg, #10a37f 0%, #0d8a6b 100%) !important;
            color: #ffffff !important;
            border: 1px solid #10a37f !important;
        }
        #configurar-openai-btn.btn-openai:hover,
        #configurar-openai-btn.btn-openai.btn-small:hover {
            background: linear-gradient(135deg, #0d8a6b 0%, #0a6b52 100%) !important;
            box-shadow: 0 8px 25px rgba(16, 163, 127, 0.3) !important;
            transform: translateY(-2px);
        }

        .btn-openai:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 163, 127, 0.3);
            background: linear-gradient(135deg, #0d8a6b 0%, #0a6b52 100%);
        }

        .btn-openai-test {
            background: rgba(16, 163, 127, 0.1);
            color: #10a37f;
            border: 1px solid rgba(16, 163, 127, 0.3);
        }

        .btn-openai-test:hover {
            background: rgba(16, 163, 127, 0.2);
            border-color: #10a37f;
            color: #0d8a6b;
        }

        /* Status badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.active {
            background: rgba(108, 99, 255, 0.1);
            color: #6C63FF;
            border: 1px solid rgba(108, 99, 255, 0.3);
        }

        .status-badge.blocked {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .status-badge.plan {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        /* Action buttons */
        .action-btn {
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 2px;
        }

        .action-btn.edit {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .action-btn.edit:hover {
            background: rgba(59, 130, 246, 0.2);
        }

        .action-btn.change {
            background: rgba(108, 99, 255, 0.1);
            color: #6C63FF;
        }

        .action-btn.change:hover {
            background: rgba(108, 99, 255, 0.2);
        }

        .action-btn.toggle {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .action-btn.toggle:hover {
            background: rgba(245, 158, 11, 0.2);
        }

        .action-btn.delete {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .action-btn.delete:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: rgba(26, 26, 26, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(20px);
            padding: 30px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            margin-bottom: 25px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #ccc;
            margin-bottom: 10px;
        }

        .modal-body {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            color: #888;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-label.required::after {
            content: ' *';
            color: #ef4444;
        }
        
        .info-text {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
        }

        /* Modais E-mail / SMTP / PAT — layout gemini.html (claro, rounded-2xl) */
        .email-gm-modal-root {
            position: fixed;
            inset: 0;
            z-index: 12000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px 24px;
        }
        .email-gm-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        .email-gm-modal-dialog {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 32rem;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: #fff;
            border-radius: 2rem;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.08);
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .email-gm-modal-dialog--wide { max-width: 42rem; }
        .email-gm-modal-header {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 24px 32px;
            border-bottom: 1px solid #f1f5f9;
            background: #fff;
        }
        .email-gm-modal-header-main {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }
        .email-gm-modal-header-ico {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f1f5f9;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
            flex-shrink: 0;
        }
        .email-gm-modal-header-ico--emerald {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: #ecfdf5;
            color: #6C63FF;
            font-size: 1.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        .email-gm-modal-body--padonly > .email-gm-modal-header-ico--emerald { margin-bottom: 24px; }
        .email-gm-modal-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 800;
            line-height: 1.25;
            color: #0f172a;
        }
        .email-gm-modal-kicker {
            margin: 4px 0 0;
            font-size: 0.75rem;
            font-weight: 700;
            line-height: 1.2;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .email-gm-modal-close {
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 999px;
            background: #f8fafc;
            color: #94a3b8;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
            line-height: 1;
            transition: background 0.2s, color 0.2s;
            flex-shrink: 0;
        }
        .email-gm-modal-close:hover {
            background: #f1f5f9;
            color: #334155;
        }
        .email-gm-modal-body {
            padding: 32px;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }
        .email-gm-modal-body--surface { background: #fbfcfd; }
        .email-gm-modal-body--padonly { padding: 32px; }
        .email-gm-modal-section-title {
            margin: 0 0 16px;
            font-size: 10px;
            font-weight: 800;
            line-height: 1.2;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6C63FF;
        }
        .email-gm-modal-section-title--blue { color: #3b82f6; }
        .email-gm-modal-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 0;
            border: none;
        }
        .email-gm-modal-stack { display: flex; flex-direction: column; gap: 32px; }
        .email-gm-modal-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .email-gm-modal-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .email-gm-modal-grid-3 .email-gm-field-span2 { grid-column: span 2; }
        .email-gm-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            color: #334155;
            margin-bottom: 8px;
        }
        .email-gm-input {
            width: 100%;
            box-sizing: border-box;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 0.875rem;
            font-weight: 600;
            line-height: 1.25;
            color: #0f172a;
            font-family: inherit;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: border-color 0.2s, background 0.2s;
        }
        .email-gm-input:focus {
            outline: none;
            border-color: #6C63FF;
        }
        .email-gm-input--mono { font-family: ui-monospace, SFMono-Regular, Menlo, monospace; }
        .email-gm-modal-intro {
            margin: 0 0 24px;
            font-size: 0.875rem;
            font-weight: 500;
            line-height: 1.625;
            color: #64748b;
        }
        .email-gm-modal-intro a {
            color: #6C63FF;
            font-weight: 700;
            text-decoration: none;
        }
        .email-gm-modal-intro a:hover { text-decoration: underline; }
        .email-gm-label-pat {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            line-height: 1.2;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 8px;
        }
        .email-gm-input-pat {
            width: 100%;
            box-sizing: border-box;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            color: #0f172a;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: border-color 0.2s, background 0.2s;
        }
        .email-gm-input-pat:focus {
            outline: none;
            background: #fff;
            border-color: #6C63FF;
        }
        .email-gm-pat-hint {
            margin: 8px 0 0;
            font-size: 10px;
            font-weight: 700;
            line-height: 1.4;
            color: #94a3b8;
        }
        .email-gm-pat-hint i { color: #6C63FF; margin-right: 4px; }
        .email-gm-modal-footer {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            padding: 20px 32px;
            border-top: 1px solid #f1f5f9;
            background: #fff;
        }
        .email-gm-modal-footer--end {
            justify-content: center;
            background: #f8fafc;
        }
        .email-gm-btn-test {
            border: none;
            background: none;
            padding: 0;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            color: #64748b;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }
        .email-gm-btn-test:hover { color: #0f172a; }
        .email-gm-footer-actions { display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; width: 100%; }
        .email-gm-btn-cancel {
            padding: 10px 24px;
            border-radius: 12px;
            border: 1px solid transparent;
            background: transparent;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            color: #64748b;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .email-gm-btn-cancel:hover {
            background: #f8fafc;
            border-color: #e2e8f0;
        }
        .email-gm-btn-primary {
            padding: 10px 32px;
            border-radius: 12px;
            border: none;
            background: #6C63FF;
            color: #fff;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.3);
            transition: background 0.2s, transform 0.2s;
        }
        .email-gm-btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
        }
        .email-gm-btn-primary:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }
        .email-gm-btn-dark {
            padding: 10px 32px;
            border-radius: 12px;
            border: none;
            background: #6C63FF;
            color: #fff;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: background 0.2s, transform 0.2s;
        }
        .email-gm-btn-dark:hover {
            background: #1fb954;
            transform: translateY(-1px);
        }
        .email-gm-btn-dark:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }
        @media (max-width: 640px) {
            .email-gm-modal-grid-2,
            .email-gm-modal-grid-3 { grid-template-columns: 1fr; }
            .email-gm-modal-grid-3 .email-gm-field-span2 { grid-column: span 1; }
            .email-gm-modal-header,
            .email-gm-modal-body,
            .email-gm-modal-footer { padding-left: 20px; padding-right: 20px; }
        }

        /* Modal Novo Cliente — layout claro (referência gemini / formulário com ícones) */
        .modal-shell-nc.modal-nc-overlay {
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(10px);
            padding: 24px;
            align-items: center;
            justify-content: center;
        }

        .modal-shell-nc .modal-content.modal-nc {
            background: #ffffff;
            color: #1a1c1e;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            max-width: 560px;
            width: 100%;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.2);
            position: relative;
            backdrop-filter: none;
        }

        .modal-shell-nc .modal-nc-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 36px;
            height: 36px;
            border-radius: 999px;
            border: none;
            background: #f3f4f6;
            color: #6b7280;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            line-height: 1;
            transition: background 0.2s, color 0.2s;
            z-index: 2;
        }

        .modal-shell-nc .modal-nc-close:hover {
            background: #e5e7eb;
            color: #374151;
        }

        .modal-shell-nc .modal-nc-header {
            padding: 28px 56px 0 28px;
        }

        .modal-shell-nc .modal-nc-title {
            font-size: 1.375rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #0f172a;
            margin: 0;
            line-height: 1.25;
        }

        .modal-shell-nc .modal-nc-kicker {
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            color: #9ca3af;
            margin: 10px 0 0;
            text-transform: uppercase;
        }

        .modal-shell-nc .modal-nc-divider {
            height: 1px;
            background: #e5e7eb;
            margin-top: 24px;
        }

        .modal-shell-nc .modal-nc-body {
            padding: 24px 28px;
            margin: 0;
        }

        .modal-shell-nc .modal-nc-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 16px;
        }

        .modal-shell-nc .modal-nc-field--full {
            grid-column: 1 / -1;
        }

        .modal-shell-nc .modal-nc-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .modal-shell-nc .modal-nc-label .modal-nc-req {
            color: #ef4444;
            font-weight: 700;
        }

        .modal-shell-nc .modal-nc-input-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 0 14px;
            min-height: 48px;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .modal-shell-nc .modal-nc-input-wrap:focus-within {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.12);
        }

        .modal-shell-nc .modal-nc-input-wrap > .modal-nc-ico {
            color: #9ca3af;
            font-size: 0.95rem;
            flex-shrink: 0;
            width: 1.1rem;
            text-align: center;
        }

        .modal-shell-nc .modal-nc-input,
        .modal-shell-nc .modal-nc-select {
            flex: 1;
            min-width: 0;
            width: 100%;
            border: none;
            background: transparent;
            padding: 12px 0;
            font-size: 0.9375rem;
            color: #0f172a;
            outline: none;
            font-family: inherit;
        }

        .modal-shell-nc .modal-nc-select {
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            padding-right: 4px;
        }

        .modal-shell-nc .modal-nc-input::placeholder {
            color: #9ca3af;
        }

        .modal-shell-nc .modal-nc-chevron {
            color: #9ca3af;
            font-size: 0.65rem;
            flex-shrink: 0;
            pointer-events: none;
        }

        .modal-shell-nc .modal-nc-status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #6C63FF;
            flex-shrink: 0;
        }

        .modal-shell-nc .modal-nc-status-wrap .modal-nc-select {
            padding-left: 4px;
        }

        .modal-shell-nc input[type="date"].modal-nc-input {
            min-height: 44px;
        }

        .modal-shell-nc .modal-nc-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding: 8px 28px 28px;
        }

        .modal-shell-nc .modal-nc-btn-ghost {
            background: transparent;
            border: none;
            color: #6b7280;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            padding: 12px 16px;
            font-family: inherit;
        }

        .modal-shell-nc .modal-nc-btn-ghost:hover {
            color: #374151;
        }

        .modal-shell-nc .modal-nc-btn-primary {
            background: #6C63FF;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 22px;
            font-weight: 700;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 10px 24px rgba(108, 99, 255, 0.28);
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .modal-shell-nc .modal-nc-btn-primary:hover:not(:disabled) {
            background: #6C63FF;
            transform: translateY(-1px);
        }

        .modal-shell-nc .modal-nc-btn-primary:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none;
        }

        .modal-shell-nc .modal-nc-btn-openai {
            background: linear-gradient(135deg, #10a37f 0%, #0d8a6b 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 22px;
            font-weight: 700;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 10px 24px rgba(16, 163, 127, 0.28);
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .modal-shell-nc .modal-nc-btn-openai:hover:not(:disabled) {
            filter: brightness(1.06);
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(16, 163, 127, 0.35);
        }

        .modal-shell-nc .modal-nc-btn-openai:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none;
        }

        @media (max-width: 540px) {
            .modal-shell-nc .modal-nc-grid {
                grid-template-columns: 1fr;
            }

            .modal-shell-nc .modal-nc-header {
                padding-right: 48px;
            }
        }

        .modal-shell-nc .modal-nc-input-wrap--readonly {
            background: #f3f4f6;
            border-color: #e5e7eb;
        }

        .modal-shell-nc .modal-nc-input-wrap--readonly:focus-within {
            border-color: #e5e7eb;
            box-shadow: none;
        }

        .modal-shell-nc .modal-nc-input-wrap--readonly .modal-nc-input {
            color: #64748b;
            cursor: default;
        }

        .modal-shell-nc .modal-nc-senha-lock {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px dashed #e5e7eb;
            border-radius: 12px;
            padding: 0 14px;
            min-height: 48px;
            background: #fafafa;
            color: #64748b;
            font-size: 0.8125rem;
            font-weight: 600;
            line-height: 1.35;
        }

        .modal-shell-nc .modal-nc-senha-lock i {
            color: #94a3b8;
            flex-shrink: 0;
            font-size: 1rem;
        }

        .modal-shell-nc .modal-nc-title-with-ico {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .modal-shell-nc .modal-nc-title-with-ico .modal-nc-openai-logo {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            display: block;
        }

        .modal-shell-nc .modal-nc-title-with-ico .modal-nc-title {
            margin: 0;
            flex: 1;
            min-width: 0;
        }

        .modal-shell-nc .modal-nc-body .info-text {
            margin-top: 10px;
            line-height: 1.45;
        }

        .modal-shell-nc--wide .modal-content.modal-nc {
            max-width: 960px;
            max-height: min(92vh, 900px);
            display: flex;
            flex-direction: column;
        }

        .modal-shell-nc--wide .modal-nc-body--integ-pag {
            padding: 0;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }

        .modal-integ-pag-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            min-height: 320px;
            max-height: none;
        }

        .modal-integ-pag-col {
            padding: 20px 24px;
            overflow-y: auto;
            border-right: 1px solid #e5e7eb;
        }

        .modal-integ-pag-col:last-child {
            border-right: none;
        }

        .integ-pag-kicker {
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 10px;
        }

        .integ-pag-payload {
            min-height: 140px;
            max-height: 240px;
            overflow: auto;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            font-size: 0.75rem;
            font-family: ui-monospace, monospace;
        }

        .integ-pag-payload.aguardando-dados {
            color: #64748b;
            font-style: italic;
        }

        .integ-pag-payload .payload-draggable {
            cursor: grab;
            background: rgba(108, 99, 255, 0.12);
            border-radius: 4px;
            padding: 0 2px;
        }

        .modal-integ-pag-col .modal-nc-input.drag-over {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.2);
        }

        .integ-pag-teste-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .integ-pag-teste-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .integ-pag-teste-dot.vermelho { background: #ef4444; }
        .integ-pag-teste-dot.verde { background: #22c55e; }

        .integ-pag-btn-teste,
        .integ-pag-btn-atualizar {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            font-size: 0.75rem;
            font-weight: 700;
            color: #475569;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s;
        }

        .integ-pag-btn-teste:hover,
        .integ-pag-btn-atualizar:hover {
            background: #f1f5f9;
        }

        .integ-pag-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 8px;
        }

        .integ-pag-chip {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 8px;
            background: rgba(108, 99, 255, 0.12);
            color: #6C63FF;
            cursor: grab;
        }

        .modal-integ-pag-col textarea.modal-nc-input {
            min-height: 88px;
            resize: vertical;
        }

        .modal-integ-pag-col textarea.modal-nc-input.drag-over {
            border-color: #6C63FF !important;
        }

        .integ-pag-map-input.tagged-value {
            background: rgba(108, 99, 255, 0.14);
            border-radius: 999px;
            color: #6C63FF;
            font-weight: 700;
            padding-left: 0.9rem;
            padding-right: 0.9rem;
        }

        .integ-pag-field-path {
            margin-top: 0.35rem;
            font-size: 0.72rem;
            color: #64748b;
            line-height: 1.25;
            min-height: 1em;
        }

        @media (max-width: 900px) {
            .modal-integ-pag-grid {
                grid-template-columns: 1fr;
                max-height: none;
            }
            .modal-integ-pag-col {
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
            }
            .modal-integ-pag-col:last-child {
                border-bottom: none;
            }
        }

        .integ-pag-url-row {
            display: flex;
            gap: 10px;
            align-items: stretch;
            margin-bottom: 12px;
        }

        .integ-pag-url-row .modal-nc-input-wrap {
            flex: 1;
            margin: 0;
        }

        /* Modal planos (criar / editar) — layout em secções e cartões */
        .modal-plano-np.modal-np-overlay {
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(10px);
            padding: 20px;
            align-items: center;
            justify-content: center;
        }

        .modal-plano-np .modal-content.modal-np {
            background: #ffffff;
            color: #0f172a;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            max-width: 720px;
            width: 100%;
            max-height: min(92vh, 900px);
            padding: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.22);
            position: relative;
            backdrop-filter: none;
        }

        .modal-plano-np .modal-np-close {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 36px;
            height: 36px;
            border-radius: 999px;
            border: none;
            background: #f3f4f6;
            color: #6b7280;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            z-index: 2;
            transition: background 0.2s, color 0.2s;
        }

        .modal-plano-np .modal-np-close:hover {
            background: #e5e7eb;
            color: #374151;
        }

        .modal-plano-np .modal-np-header {
            padding: 26px 52px 0 26px;
            flex-shrink: 0;
        }

        .modal-plano-np .modal-np-title {
            font-size: 1.375rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #0f172a;
            margin: 0;
            line-height: 1.25;
        }

        .modal-plano-np .modal-np-kicker {
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: #9ca3af;
            margin: 10px 0 0;
            text-transform: uppercase;
        }

        .modal-plano-np .modal-np-divider {
            height: 1px;
            background: #e5e7eb;
            margin-top: 22px;
            flex-shrink: 0;
        }

        .modal-plano-np .modal-np-divider--section {
            margin: 0 0 20px;
        }

        .modal-plano-np .creditos-info-block {
            background: rgba(59, 130, 246, 0.06);
            border-color: rgba(59, 130, 246, 0.2);
        }

        .modal-plano-np .creditos-info-texto {
            color: #475569;
        }

        .modal-plano-np .resultado-mensagens,
        .modal-plano-np .resultado-mensagens-destaque {
            color: #6C63FF;
        }

        .modal-plano-np .resultado-mensagens-destaque {
            background: rgba(108, 99, 255, 0.12);
            border-color: rgba(108, 99, 255, 0.35);
        }

        .modal-plano-np .modal-np-body {
            padding: 22px 26px 8px;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }

        .modal-plano-np .modal-np-section {
            margin-bottom: 22px;
        }

        .modal-plano-np .modal-np-section:last-of-type {
            margin-bottom: 12px;
        }

        .modal-plano-np .modal-np-section-head {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .modal-plano-np .modal-np-section-head i {
            font-size: 0.85rem;
        }

        .modal-plano-np .modal-np-section-head--green {
            color: #6C63FF;
        }

        .modal-plano-np .modal-np-section-head--blue {
            color: #2563eb;
        }

        .modal-plano-np .modal-np-section-head--purple {
            color: #7c3aed;
        }

        .modal-plano-np .modal-np-grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .modal-plano-np .modal-np-lbl {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .modal-plano-np .modal-np-req {
            color: #ef4444;
            font-weight: 700;
        }

        .modal-plano-np .modal-np-field {
            display: flex;
            align-items: center;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #f9fafb;
            min-height: 48px;
            padding: 0 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .modal-plano-np .modal-np-field:focus-within {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.12);
            background: #fff;
        }

        .modal-plano-np .modal-np-field--prefix {
            padding-left: 0;
            gap: 0;
        }

        .modal-plano-np .modal-np-prefix {
            padding: 0 12px 0 14px;
            font-size: 0.9375rem;
            font-weight: 700;
            color: #6b7280;
            border-right: 1px solid #e5e7eb;
            align-self: stretch;
            display: flex;
            align-items: center;
        }

        .modal-plano-np .modal-np-input {
            flex: 1;
            min-width: 0;
            border: none;
            background: transparent;
            padding: 12px 14px;
            font-size: 0.9375rem;
            color: #0f172a;
            outline: none;
            font-family: inherit;
            text-align: center;
        }

        .modal-plano-np .modal-np-field:not(.modal-np-field--prefix) .modal-np-input {
            text-align: left;
        }

        .modal-plano-np .modal-np-field--prefix .modal-np-input {
            text-align: left;
            padding-left: 12px;
        }

        .modal-plano-np .modal-np-input::placeholder {
            color: #9ca3af;
        }

        .modal-plano-np .modal-np-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .modal-plano-np .modal-np-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px 12px 12px;
            background: #fff;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .modal-plano-np .modal-np-card-head {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #4b5563;
        }

        .modal-plano-np .modal-np-card-head i {
            font-size: 1rem;
            color: #6b7280;
        }

        .modal-plano-np .modal-np-card-head .modal-np-ico-amber {
            color: #d97706;
        }

        .modal-plano-np .modal-np-card .modal-np-field {
            min-height: 44px;
            padding: 0 10px;
        }

        .modal-plano-np .modal-np-card .modal-np-input {
            padding: 10px 8px;
        }

        .modal-plano-np .modal-np-card-foot {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px 14px;
            padding-top: 4px;
            border-top: 1px solid #f3f4f6;
            margin-top: auto;
        }

        .modal-plano-np .modal-np-mini {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #6b7280;
            cursor: pointer;
        }

        .modal-plano-np .modal-np-mini input {
            width: 14px;
            height: 14px;
            accent-color: #22c55e;
            cursor: pointer;
        }

        .modal-plano-np .modal-np-creditos-extra {
            margin-top: 16px;
            padding: 14px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
        }

        .modal-plano-np .modal-np-ajuda-row {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid #e5e7eb;
        }

        .modal-plano-np .modal-np-ajuda-row .modal-np-mini {
            font-size: 0.8125rem;
            text-transform: none;
            letter-spacing: 0;
            font-weight: 600;
            color: #4b5563;
        }

        .modal-plano-np #toggle-calcular-mensagens-criar,
        .modal-plano-np #toggle-calcular-mensagens-editar {
            background: #fff;
            border: 1px solid #e5e7eb;
            color: #374151;
        }

        .modal-plano-np #toggle-calcular-mensagens-criar:hover,
        .modal-plano-np #toggle-calcular-mensagens-editar:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .modal-plano-np #calcular-mensagens-content-criar,
        .modal-plano-np #calcular-mensagens-content-editar {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .modal-plano-np #calcular-mensagens-content-criar .form-label,
        .modal-plano-np #calcular-mensagens-content-editar .form-label {
            color: #374151;
        }

        .modal-plano-np #modelo-ia-criar,
        .modal-plano-np #modelo-ia-editar {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #fff;
            color: #0f172a;
            font-size: 0.875rem;
        }

        .modal-plano-np .modal-np-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding: 16px 26px 24px;
            flex-shrink: 0;
        }

        .modal-plano-np .modal-np-btn-ghost {
            background: transparent;
            border: none;
            color: #6b7280;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            padding: 12px 16px;
            font-family: inherit;
        }

        .modal-plano-np .modal-np-btn-ghost:hover {
            color: #374151;
        }

        .modal-plano-np .modal-np-btn-danger {
            border: 1px solid #fecaca;
            color: #dc2626;
            background: #fff5f5;
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 700;
            font-size: 0.8125rem;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }

        .modal-plano-np .modal-np-btn-danger:hover:not(:disabled) {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #b91c1c;
        }

        .modal-plano-np .modal-np-btn-danger:disabled {
            opacity: 0.55;
            cursor: not-allowed;
        }

        .modal-plano-np .modal-np-btn-primary {
            background: #6C63FF;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 22px;
            font-weight: 700;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 10px 24px rgba(108, 99, 255, 0.28);
            transition: background 0.2s, transform 0.15s;
        }

        .modal-plano-np .modal-np-btn-primary:hover:not(:disabled) {
            background: #6C63FF;
            transform: translateY(-1px);
        }

        .modal-plano-np .modal-np-btn-primary:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none;
        }

        @media (max-width: 680px) {
            .modal-plano-np .modal-np-grid2,
            .modal-plano-np .modal-np-cards {
                grid-template-columns: 1fr;
            }

            .modal-plano-np .modal-np-header {
                padding-right: 48px;
            }
        }

        /* Tag de custo de créditos */
        .custo-creditos-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(255, 193, 7, 0.15);
            border: 1px solid rgba(255, 193, 7, 0.4);
            color: #ffc107;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.1);
        }

        .btn-toggle-calcular-mensagens {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 8px;
            color: #e5e7eb;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-toggle-calcular-mensagens:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }
        .btn-toggle-calcular-mensagens[aria-expanded="true"] .btn-toggle-icon {
            transform: rotate(180deg);
        }
        .btn-toggle-icon {
            flex-shrink: 0;
            margin-left: 8px;
            transition: transform 0.2s;
        }
        .calcular-mensagens-content {
            margin-top: 10px;
            padding: 12px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .calcular-mensagens-content[hidden] {
            display: none;
        }
        .resultado-mensagens {
            font-size: 14px;
            font-weight: 600;
            color: #6C63FF;
            margin-top: 8px;
        }

        .resultado-mensagens-destaque {
            font-size: 1.25rem;
            font-weight: 700;
            padding: 12px 16px;
            background: rgba(108, 99, 255, 0.15);
            border: 1px solid rgba(108, 99, 255, 0.4);
            border-radius: 10px;
            color: #6C63FF;
            margin-top: 12px;
            text-align: center;
            letter-spacing: 0.02em;
        }

        .creditos-info-block {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
            background: rgba(59, 130, 246, 0.12);
            border: 1px solid rgba(59, 130, 246, 0.35);
            border-radius: 10px;
        }

        .creditos-info-icon {
            font-size: 16px;
            line-height: 1.2;
            flex-shrink: 0;
        }

        .creditos-info-texto {
            margin: 0;
            font-size: 13px;
            color: #93c5fd;
            line-height: 1.4;
        }

        /* Toast Notification System */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 11000;
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
            font-size: 14px;
            line-height: 1.4;
        }

        /* Actions Menu */
        .actions-menu {
            position: relative;
            display: inline-block;
            z-index: 10;
        }

        .actions-trigger {
            background: none;
            border: none;
            color: #888;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .actions-trigger:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .actions-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            background: rgba(26, 26, 26, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            backdrop-filter: blur(10px);
            min-width: 150px;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin-top: 5px;
        }

        .actions-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Dropdown abrindo para cima (últimos 2 itens) */
        .actions-dropdown.dropdown-up {
            top: auto;
            bottom: 100%;
            margin-top: 0;
            margin-bottom: 5px;
            transform: translateY(10px);
        }

        .actions-dropdown.dropdown-up.show {
            transform: translateY(0);
        }

        .actions-item {
            display: block;
            width: 100%;
            padding: 12px 16px;
            color: #ccc;
            text-decoration: none;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .actions-item:last-child {
            border-bottom: none;
            border-radius: 0 0 8px 8px;
        }

        .actions-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .actions-item.text-red-600 {
            color: #ef4444;
        }

        .actions-item.text-red-600:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* Loading Animation */
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: #9ca3af;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #374151;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 16px;
        }

        .loading-text {
            font-size: 16px;
            font-weight: 500;
            color: #9ca3af;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Add Plan Tag */
        .add-plan-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            color: #ffc107;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.1);
        }

        .add-plan-tag:hover {
            background: rgba(255, 193, 7, 0.2);
            border-color: rgba(255, 193, 7, 0.5);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
        }

        .add-plan-tag svg {
            flex-shrink: 0;
        }

        .modal-footer {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
            }

            /* Sidebar - Esconder à esquerda, abrir com overlay */
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

            .sidebar.mobile-open .menu-badge-admin {
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


            /* Main content - Ajustar margem */
            .main-content {
                padding: 15px;
                margin-left: 0;
                width: 100%;
            }

            .mobile-close-btn {
                display: flex;
            }

            /* Header */
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                margin-bottom: 20px;
            }

            .header-info h1 {
                font-size: 1.5rem;
            }

            .header-info p {
                font-size: 0.9rem;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-end;
            }

            /* Navigation Tabs */
            .nav-tabs {
                margin-bottom: 20px;
            }

            .nav-tabs-container {
                flex-direction: column;
            }

            .nav-tab {
                padding: 15px;
                font-size: 0.9rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-tab:last-child {
                border-bottom: none;
            }

            /* Stats Grid */
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .stat-card {
                padding: 20px;
            }

            .stat-card-value {
                font-size: 1.5rem;
            }

            /* Charts Grid */
            .charts-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .chart-card {
                padding: 15px;
            }

            .chart-wrapper {
                height: 250px;
            }

            .chart-card canvas {
                max-height: 250px !important;
                height: 250px !important;
            }

            /* Tables */
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table {
                font-size: 0.85rem;
                min-width: 600px;
            }

            .table th, .table td {
                padding: 10px 8px;
                white-space: nowrap;
            }

            .table-filters {
                flex-direction: column;
                gap: 10px;
            }

            .table-filters input,
            .table-filters select {
                width: 100%;
            }

            /* Modals */
            .modal-content {
                width: 95%;
                max-width: 95%;
                padding: 20px;
                margin: 10px;
            }

            .modal-title {
                font-size: 1.2rem;
            }

            .modal-body {
                font-size: 0.9rem;
            }

            .modal-footer {
                flex-direction: column;
                gap: 10px;
            }

            .modal-footer .btn {
                width: 100%;
            }

            /* Forms */
            .form-group {
                margin-bottom: 15px;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .form-input,
            .form-select {
                font-size: 0.9rem;
                padding: 10px;
            }

            /* Buttons */
            .btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            /* Pagination */
            .pagination {
                flex-wrap: wrap;
                gap: 5px;
            }

            .pagination button {
                padding: 8px 12px;
                font-size: 0.85rem;
            }

            /* Actions Menu */
            .actions-dropdown {
                min-width: 120px;
                right: 0;
            }

            /* Cards de estatísticas */
            .stat-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            /* Gráficos responsivos */
            .chart-title {
                font-size: 1rem;
            }
        }

        /* Mobile muito pequeno */
        @media (max-width: 480px) {
            .main-content {
                padding: 10px;
            }

            .header-info h1 {
                font-size: 1.3rem;
            }

            .header-info p {
                font-size: 0.85rem;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-card-value {
                font-size: 1.3rem;
            }

            .chart-wrapper {
                height: 200px;
            }

            .chart-card canvas {
                max-height: 200px !important;
                height: 200px !important;
            }

            .modal-content {
                width: 100%;
                max-width: 100%;
                padding: 15px;
                border-radius: 12px;
            }

            .table {
                font-size: 0.75rem;
            }

            .table th, .table td {
                padding: 8px 5px;
            }

            .nav-tab {
                padding: 12px;
                font-size: 0.85rem;
            }
        }

        /* Dark mode — área principal (tokens iguais ao dashboard.html) */
        body.dark-mode .main-content {
            background: transparent;
        }

        body.dark-mode .admin-sticky-head {
            background: rgba(30, 41, 59, 0.78);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom-color: var(--dm-border);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.2);
        }

        body.dark-mode .header-info h1 {
            color: var(--dm-heading);
        }

        body.dark-mode .header-info p {
            color: var(--dm-text-muted);
        }

        body.dark-mode .nav-tab {
            color: #64748b;
        }

        body.dark-mode .nav-tab:hover {
            color: #e2e8f0;
        }

        body.dark-mode .nav-tab.active {
            color: #5ee99a;
            border-bottom-color: #6C63FF;
        }

        body.dark-mode .stat-card,
        body.dark-mode .chart-card,
        body.dark-mode .table-container {
            background: var(--dm-surface);
            border: 1px solid var(--dm-border);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        body.dark-mode .stat-card:hover,
        body.dark-mode .chart-card:hover {
            border-color: var(--dm-border-strong);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        }

        body.dark-mode .stat-card-title {
            color: var(--dm-text-muted);
        }

        body.dark-mode .stat-kpi-currency,
        body.dark-mode .stat-kpi-amount,
        body.dark-mode .stat-kpi-amount-xl {
            color: var(--dm-heading);
        }

        body.dark-mode .stat-kpi-amount.stat-kpi-amount--brand {
            color: #5ee99a;
        }

        body.dark-mode .stat-kpi-trend-muted,
        body.dark-mode .stat-kpi-foot {
            color: var(--dm-text-muted);
        }

        body.dark-mode .stat-clients-bar {
            background: #334155;
        }

        body.dark-mode .stat-clients-bar-seg--rest {
            background: #475569;
        }

        body.dark-mode .chart-title {
            color: var(--dm-heading);
        }

        body.dark-mode .chart-filter-pill {
            background: #334155;
            color: #cbd5e1;
            border-color: rgba(255, 255, 255, 0.1);
        }

        body.dark-mode .chart-legend-text {
            color: #94a3b8;
        }

        body.dark-mode .chart-grid-line {
            border-bottom-color: rgba(255, 255, 255, 0.12);
        }

        body.dark-mode .chart-grid-label {
            color: #64748b;
        }

        body.dark-mode .table-title {
            color: var(--dm-heading);
        }

        body.dark-mode .table-header,
        body.dark-mode .table-filters {
            border-bottom-color: rgba(255, 255, 255, 0.08);
        }

        body.dark-mode .table th {
            color: #94a3b8;
            border-bottom-color: rgba(255, 255, 255, 0.08);
        }

        body.dark-mode .table td {
            color: #e2e8f0;
            border-bottom-color: rgba(255, 255, 255, 0.06);
        }

        body.dark-mode .table tr:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        body.dark-mode .btn-openai-test {
            background: #334155;
            color: #e2e8f0;
            border-color: rgba(255, 255, 255, 0.12);
        }

        body.dark-mode .btn-openai-test:hover {
            background: #475569;
            color: #fff;
        }

        body.dark-mode .plan-action-btn {
            background: #334155;
            border-color: rgba(255, 255, 255, 0.12);
            color: #cbd5e1;
        }

        body.dark-mode .plan-action-btn:hover {
            color: #f8fafc;
            background: #475569;
            border-color: rgba(255, 255, 255, 0.2);
        }

        body.dark-mode #clientes-content .clientes-page-title,
        body.dark-mode #planos-content .planos-page-title,
        body.dark-mode #integracao-pagamento-content .planos-page-title {
            color: #f1f5f9;
        }

        body.dark-mode #clientes-content .clientes-toolbar,
        body.dark-mode #clientes-content .clientes-table-card,
        body.dark-mode #planos-content .planos-toolbar,
        body.dark-mode #planos-content .planos-table-card,
        body.dark-mode #integracao-pagamento-content .planos-toolbar,
        body.dark-mode #integracao-pagamento-content .planos-table-card {
            background: var(--dm-surface);
            border-color: var(--dm-border);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        body.dark-mode #clientes-content .clientes-search-input,
        body.dark-mode #planos-content .planos-search-input,
        body.dark-mode #integracao-pagamento-content .planos-search-input {
            background: #334155;
            border-color: rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
        }

        body.dark-mode #clientes-content .clientes-search-input::placeholder,
        body.dark-mode #planos-content .planos-search-input::placeholder,
        body.dark-mode #integracao-pagamento-content .planos-search-input::placeholder {
            color: #94a3b8;
        }

        body.dark-mode #clientes-content .clientes-search-input:focus,
        body.dark-mode #planos-content .planos-search-input:focus,
        body.dark-mode #integracao-pagamento-content .planos-search-input:focus {
            background: #1e293b;
            border-color: #6C63FF;
        }

        body.dark-mode #clientes-content .clientes-filter-select,
        body.dark-mode #planos-content .planos-filter-select {
            background: #334155;
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }

        body.dark-mode #clientes-content .clientes-bulk-btn,
        body.dark-mode #clientes-content .clientes-export-btn {
            background: #334155;
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }

        body.dark-mode #clientes-content .clientes-bulk-btn:hover:not(:disabled),
        body.dark-mode #clientes-content .clientes-export-btn:hover {
            background: #475569;
            color: #f8fafc;
        }

        body.dark-mode #clientes-content .clientes-table thead tr,
        body.dark-mode #planos-content .planos-table thead tr {
            background: rgba(15, 23, 42, 0.55);
            border-bottom-color: rgba(255, 255, 255, 0.08);
        }

        body.dark-mode #clientes-content .clientes-table th,
        body.dark-mode #planos-content .planos-table th {
            color: #cbd5e1;
        }

        body.dark-mode #clientes-content .clientes-table tbody tr,
        body.dark-mode #planos-content .planos-table tbody tr {
            border-bottom-color: rgba(255, 255, 255, 0.06);
        }

        body.dark-mode #clientes-content .clientes-table tbody tr:hover,
        body.dark-mode #planos-content .planos-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        body.dark-mode #clientes-content .clientes-table td,
        body.dark-mode #planos-content .planos-table td {
            color: #f1f5f9;
        }

        body.dark-mode #clientes-content .clientes-user-name {
            color: #f8fafc;
        }

        body.dark-mode #clientes-content .clientes-user-email {
            color: #cbd5e1;
        }

        body.dark-mode #clientes-content .clientes-cell-user--muted {
            opacity: 1;
        }

        body.dark-mode #clientes-content .clientes-cell-user--muted .clientes-user-name {
            color: #e2e8f0;
        }

        body.dark-mode #clientes-content .clientes-cell-user--muted .clientes-user-email {
            color: #94a3b8;
        }

        body.dark-mode #clientes-content .clientes-status-label {
            color: #e2e8f0;
        }

        body.dark-mode #clientes-content .clientes-period-line--muted {
            color: #cbd5e1;
        }

        body.dark-mode #clientes-content .clientes-period-line--strong {
            color: #f8fafc;
        }

        body.dark-mode #clientes-content .clientes-period-line i {
            color: #94a3b8;
        }

        body.dark-mode #clientes-content .clientes-plan-badge--free {
            background: rgba(51, 65, 85, 0.85);
            color: #e2e8f0;
            border-color: rgba(148, 163, 184, 0.35);
        }

        body.dark-mode #clientes-content .clientes-user-email--strike {
            text-decoration-color: #64748b;
        }

        body.dark-mode #planos-content .plan-meta-item {
            color: #e2e8f0;
        }

        body.dark-mode #planos-content .plan-meta-item .meta-icon {
            color: #94a3b8;
        }

        body.dark-mode #planos-content .plan-meta-item.unlimited {
            color: #fcd34d;
        }

        body.dark-mode #planos-content .plan-meta-item.unlimited .meta-icon {
            color: #fbbf24;
        }

        body.dark-mode #planos-content .plan-price-suffix {
            color: #cbd5e1;
        }

        body.dark-mode #clientes-content .clientes-select-chevron,
        body.dark-mode #planos-content .planos-select-chevron {
            color: #94a3b8;
        }

        body.dark-mode #clientes-content .clientes-table-footer,
        body.dark-mode #planos-content .planos-table-footer {
            border-top-color: rgba(255, 255, 255, 0.08);
            background: rgba(15, 23, 42, 0.45);
        }

        body.dark-mode #clientes-content .clientes-page-info,
        body.dark-mode #planos-content .planos-page-info {
            color: #cbd5e1;
        }

        body.dark-mode #clientes-content .clientes-page-info-num,
        body.dark-mode #planos-content .planos-page-info-num {
            color: #f1f5f9;
        }

        body.dark-mode #clientes-content .clientes-page-btn,
        body.dark-mode #planos-content .planos-page-btn {
            background: #334155;
            border-color: rgba(255, 255, 255, 0.12);
            color: #cbd5e1;
        }

        body.dark-mode #clientes-content .clientes-page-btn:hover:not(:disabled),
        body.dark-mode #planos-content .planos-page-btn:hover:not(:disabled) {
            background: #475569;
        }

        body.dark-mode #clientes-content .clientes-page-btn--active,
        body.dark-mode #planos-content .planos-page-btn--active {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.18);
            color: #5ee99a;
        }

        body.dark-mode #clientes-content .clientes-actions-menu .actions-trigger:hover {
            color: #e2e8f0;
            background: #334155;
            box-shadow: none;
        }

        body.dark-mode #clientes-content .clientes-actions-menu .actions-dropdown {
            background: #1e293b;
            border-color: rgba(255, 255, 255, 0.12);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.55);
        }

        body.dark-mode #clientes-content .clientes-actions-menu .actions-item {
            color: #e2e8f0;
            border-bottom-color: rgba(255, 255, 255, 0.08);
        }

        body.dark-mode #clientes-content .clientes-actions-menu .actions-item:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #5ee99a;
        }

        body.dark-mode #planos-content .plan-title {
            color: #f8fafc;
        }

        body.dark-mode #planos-content .plan-price {
            color: #5ee99a;
        }

        body.dark-mode #pv-content .pv-page-title {
            color: var(--dm-heading);
        }

        body.dark-mode #pv-content .pv-title-badge {
            background: rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.35);
            color: #6C63FF;
        }

        body.dark-mode #pv-content .pv-main-card {
            background: var(--dm-surface);
            border-color: var(--dm-border);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        body.dark-mode #pv-content .pv-status-empty {
            color: #94a3b8;
        }

        body.dark-mode #pv-content .pv-status-ok {
            color: #5ee99a;
        }

        body.dark-mode #pv-content .pv-link-tag {
            background: rgba(108, 99, 255, 0.12);
            border-color: rgba(108, 99, 255, 0.35);
            color: #a7f3d0;
        }

        body.dark-mode #pv-content .pv-link-copy-btn {
            background: rgba(51, 65, 85, 0.45);
            border-color: rgba(71, 85, 105, 0.5);
            color: #cbd5e1;
        }

        body.dark-mode #pv-content .pv-link-copy-btn:hover {
            background: rgba(71, 85, 105, 0.55);
            color: #f8fafc;
            border-color: rgba(148, 163, 184, 0.4);
        }

        body.dark-mode #pv-content .pv-preview-wrapper {
            border-color: rgba(71, 85, 105, 0.45);
        }

        body.dark-mode #pv-content .pv-preview-frame {
            background: #0f172a;
        }

        body.dark-mode #pv-content .pv-edit-block {
            border-top-color: rgba(71, 85, 105, 0.35);
        }

        body.dark-mode #pv-content .pv-section-head {
            color: #5ee99a;
        }

        body.dark-mode #pv-content .pv-edit-label {
            color: var(--dm-heading);
        }

        body.dark-mode #pv-content .pv-edit-helper,
        body.dark-mode #pv-content .pv-edit-secondary {
            color: var(--dm-text-muted);
        }

        body.dark-mode #pv-content .pv-editando-aviso {
            background: rgba(234, 179, 8, 0.12);
            border-color: rgba(251, 191, 36, 0.35);
            color: #fbbf24;
        }

        body.dark-mode #pv-content .pv-nova-wrapper {
            border-color: rgba(108, 99, 255, 0.35);
            background: linear-gradient(180deg, rgba(108, 99, 255, 0.1) 0%, rgba(30, 41, 59, 0.4) 100%);
        }

        body.dark-mode #pv-content .pv-nova-titulo {
            color: var(--dm-heading);
        }

        body.dark-mode #pv-content .pv-nova-titulo-verde {
            color: #5ee99a;
        }

        body.dark-mode #pv-content .pv-nova-preview-wrapper {
            border-color: rgba(108, 99, 255, 0.35);
        }

        body.dark-mode #pv-content .pv-nova-preview-frame {
            background: #0f172a;
        }

        body.dark-mode .emails-section-title {
            color: #5ee99a;
        }

        /* Dark mode — modais legacy, formulários, tabelas globais e dropdowns (dashboard.html) */
        body.dark-mode .modal {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        body.dark-mode .modal-content {
            background: rgba(30, 41, 59, 0.94);
            border: 1px solid var(--dm-border-strong);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.45);
            color: var(--dm-text);
        }

        body.dark-mode .modal-title {
            color: var(--dm-heading);
        }

        /* Popups — modal-shell-nc (cliente / mudar plano / ver usuários) e modal-plano-np */
        body.dark-mode .modal-shell-nc.modal-nc-overlay,
        body.dark-mode .modal-plano-np.modal-np-overlay {
            background: rgba(2, 6, 23, 0.72);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        body.dark-mode .modal-shell-nc .modal-content.modal-nc {
            background: rgba(30, 41, 59, 0.98);
            color: var(--dm-text);
            border-color: var(--dm-border-strong);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .modal-integ-pag-col {
            border-right-color: var(--dm-border-strong);
            border-bottom-color: var(--dm-border-strong);
        }

        body.dark-mode .integ-pag-payload {
            background: rgba(15, 23, 42, 0.6);
            border-color: var(--dm-border-strong);
            color: var(--dm-text-muted);
        }

        body.dark-mode .integ-pag-map-input.tagged-value {
            background: rgba(108, 99, 255, 0.2);
            color: #6C63FF;
        }

        body.dark-mode .integ-pag-field-path {
            color: var(--dm-text-muted);
        }

        body.dark-mode .integ-pag-kicker {
            color: #94a3b8;
        }

        body.dark-mode .integ-pag-btn-teste,
        body.dark-mode .integ-pag-btn-atualizar {
            background: rgba(51, 65, 85, 0.45);
            border-color: var(--dm-border-strong);
            color: var(--dm-text);
        }

        body.dark-mode .integ-pag-chip {
            background: rgba(108, 99, 255, 0.15);
            color: #6C63FF;
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-list-empty {
            color: var(--dm-text-muted);
            background: transparent;
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-intro {
            color: var(--dm-text-muted);
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-intro strong {
            color: #cbd5e1;
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-table thead tr {
            background: rgba(15, 23, 42, 0.4);
            border-bottom-color: var(--dm-border-strong);
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-table tbody tr {
            border-bottom-color: rgba(255, 255, 255, 0.06);
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-table td {
            color: var(--dm-text);
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-link-text {
            color: var(--dm-text-muted);
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-copy-btn {
            background: rgba(51, 65, 85, 0.45);
            border-color: var(--dm-border-strong);
            color: var(--dm-text);
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-item-badge--teste {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
        }

        body.dark-mode #integracao-pagamento-content .integ-pag-item-badge--ativo {
            background: rgba(108, 99, 255, 0.18);
            color: #6C63FF;
        }
        body.dark-mode #integracao-pagamento-content .emails-tutorial-tag {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(100, 116, 139, 0.55);
            color: #cbd5e1;
        }
        body.dark-mode #integracao-pagamento-content .emails-tutorial-tag:hover {
            background: rgba(51, 65, 85, 0.9);
            border-color: rgba(148, 163, 184, 0.7);
            color: #f8fafc;
        }

        body.dark-mode .modal-shell-nc .modal-nc-close,
        body.dark-mode .modal-plano-np .modal-np-close {
            background: rgba(51, 65, 85, 0.65);
            color: #cbd5e1;
        }

        body.dark-mode .modal-shell-nc .modal-nc-close:hover,
        body.dark-mode .modal-plano-np .modal-np-close:hover {
            background: rgba(71, 85, 105, 0.8);
            color: #f8fafc;
        }

        body.dark-mode .modal-shell-nc .modal-nc-title {
            color: var(--dm-heading);
        }

        body.dark-mode .modal-shell-nc .modal-nc-kicker {
            color: #94a3b8;
        }

        body.dark-mode .modal-shell-nc .modal-nc-divider {
            background: rgba(71, 85, 105, 0.45);
        }

        body.dark-mode .modal-shell-nc .modal-nc-label {
            color: #cbd5e1;
        }

        body.dark-mode .modal-shell-nc .modal-nc-input-wrap {
            background: rgba(15, 23, 42, 0.65);
            border-color: rgba(71, 85, 105, 0.55);
        }

        body.dark-mode .modal-shell-nc .modal-nc-input-wrap:focus-within {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        body.dark-mode .modal-shell-nc .modal-nc-input-wrap > .modal-nc-ico,
        body.dark-mode .modal-shell-nc .modal-nc-chevron {
            color: #94a3b8;
        }

        body.dark-mode .modal-shell-nc .modal-nc-input,
        body.dark-mode .modal-shell-nc .modal-nc-select {
            color: var(--dm-heading);
        }

        body.dark-mode .modal-shell-nc .modal-nc-input::placeholder {
            color: #64748b;
        }

        body.dark-mode .modal-shell-nc .modal-nc-select option {
            background: var(--dm-surface-solid);
            color: var(--dm-text);
        }

        body.dark-mode .modal-shell-nc .modal-nc-btn-ghost {
            color: #cbd5e1;
        }

        body.dark-mode .modal-shell-nc .modal-nc-btn-ghost:hover {
            color: #f1f5f9;
        }

        body.dark-mode .modal-shell-nc .modal-nc-btn-openai {
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.06);
        }

        body.dark-mode .modal-shell-nc .modal-nc-input-wrap--readonly {
            background: rgba(15, 23, 42, 0.88);
            border-color: rgba(71, 85, 105, 0.45);
        }

        body.dark-mode .modal-shell-nc .modal-nc-input-wrap--readonly:focus-within {
            border-color: rgba(71, 85, 105, 0.45);
            box-shadow: none;
        }

        body.dark-mode .modal-shell-nc .modal-nc-input-wrap--readonly .modal-nc-input {
            color: #cbd5e1;
        }

        body.dark-mode .modal-shell-nc .modal-nc-senha-lock {
            background: rgba(15, 23, 42, 0.55);
            border-color: rgba(71, 85, 105, 0.5);
            color: #94a3b8;
        }

        body.dark-mode .modal-shell-nc .modal-nc-senha-lock i {
            color: #64748b;
        }

        body.dark-mode .modal-plano-np .modal-content.modal-np {
            background: rgba(30, 41, 59, 0.98);
            color: var(--dm-text);
            border-color: var(--dm-border-strong);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .modal-plano-np .modal-np-title {
            color: var(--dm-heading);
        }

        body.dark-mode .modal-plano-np .modal-np-kicker {
            color: #94a3b8;
        }

        body.dark-mode .modal-plano-np .modal-np-divider {
            background: rgba(71, 85, 105, 0.45);
        }

        body.dark-mode .modal-plano-np .modal-np-section-head--green {
            color: #5ee99a;
        }

        body.dark-mode .modal-plano-np .modal-np-section-head--blue {
            color: #60a5fa;
        }

        body.dark-mode .modal-plano-np .modal-np-section-head--purple {
            color: #a78bfa;
        }

        body.dark-mode .modal-plano-np .modal-np-lbl {
            color: #cbd5e1;
        }

        body.dark-mode .modal-plano-np .modal-np-field {
            background: rgba(15, 23, 42, 0.65);
            border-color: rgba(71, 85, 105, 0.55);
        }

        body.dark-mode .modal-plano-np .modal-np-field:focus-within {
            background: rgba(15, 23, 42, 0.88);
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        body.dark-mode .modal-plano-np .modal-np-prefix {
            color: #94a3b8;
            border-right-color: rgba(71, 85, 105, 0.55);
        }

        body.dark-mode .modal-plano-np .modal-np-input {
            color: var(--dm-heading);
        }

        body.dark-mode .modal-plano-np .modal-np-input::placeholder {
            color: #64748b;
        }

        body.dark-mode .modal-plano-np .modal-np-card {
            background: rgba(15, 23, 42, 0.55);
            border-color: rgba(71, 85, 105, 0.5);
        }

        body.dark-mode .modal-plano-np .modal-np-card-head {
            color: #cbd5e1;
        }

        body.dark-mode .modal-plano-np .modal-np-card-head i {
            color: #94a3b8;
        }

        body.dark-mode .modal-plano-np .modal-np-card-head .modal-np-ico-amber {
            color: #fbbf24;
        }

        body.dark-mode .modal-plano-np .modal-np-card-foot {
            border-top-color: rgba(71, 85, 105, 0.45);
        }

        body.dark-mode .modal-plano-np .modal-np-mini {
            color: #94a3b8;
        }

        body.dark-mode .modal-plano-np .modal-np-creditos-extra {
            background: rgba(15, 23, 42, 0.55);
            border-color: rgba(71, 85, 105, 0.5);
        }

        body.dark-mode .modal-plano-np .modal-np-ajuda-row {
            border-top-color: rgba(71, 85, 105, 0.45);
        }

        body.dark-mode .modal-plano-np .modal-np-ajuda-row .modal-np-mini {
            color: #cbd5e1;
        }

        body.dark-mode .modal-plano-np #toggle-calcular-mensagens-criar,
        body.dark-mode .modal-plano-np #toggle-calcular-mensagens-editar {
            background: rgba(15, 23, 42, 0.65);
            border-color: rgba(71, 85, 105, 0.55);
            color: #e2e8f0;
        }

        body.dark-mode .modal-plano-np #toggle-calcular-mensagens-criar:hover,
        body.dark-mode .modal-plano-np #toggle-calcular-mensagens-editar:hover {
            background: rgba(51, 65, 85, 0.55);
            border-color: rgba(71, 85, 105, 0.65);
        }

        body.dark-mode .modal-plano-np #calcular-mensagens-content-criar,
        body.dark-mode .modal-plano-np #calcular-mensagens-content-editar {
            background: rgba(15, 23, 42, 0.65);
            border-color: rgba(71, 85, 105, 0.55);
        }

        body.dark-mode .modal-plano-np #calcular-mensagens-content-criar .form-label,
        body.dark-mode .modal-plano-np #calcular-mensagens-content-editar .form-label {
            color: #cbd5e1;
        }

        body.dark-mode .modal-plano-np #modelo-ia-criar,
        body.dark-mode .modal-plano-np #modelo-ia-editar {
            background: rgba(15, 23, 42, 0.75);
            border-color: rgba(71, 85, 105, 0.55);
            color: var(--dm-heading);
        }

        body.dark-mode .modal-plano-np .modal-np-btn-ghost {
            color: #cbd5e1;
        }

        body.dark-mode .modal-plano-np .modal-np-btn-ghost:hover {
            color: #f8fafc;
        }

        body.dark-mode .modal-plano-np .modal-np-btn-danger {
            background: rgba(127, 29, 29, 0.2);
            border-color: rgba(248, 113, 113, 0.45);
            color: #fca5a5;
        }

        body.dark-mode .modal-plano-np .modal-np-btn-danger:hover:not(:disabled) {
            background: rgba(153, 27, 27, 0.32);
            border-color: rgba(252, 165, 165, 0.6);
            color: #fecaca;
        }

        body.dark-mode .modal-plano-np .creditos-info-block {
            background: rgba(59, 130, 246, 0.12);
            border-color: rgba(96, 165, 250, 0.35);
        }

        body.dark-mode .modal-plano-np .creditos-info-texto {
            color: #93c5fd;
        }

        body.dark-mode .modal-plano-np .resultado-mensagens,
        body.dark-mode .modal-plano-np .resultado-mensagens-destaque {
            color: #6C63FF;
        }

        body.dark-mode .modal-plano-np .resultado-mensagens-destaque {
            background: rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.4);
        }

        /* Ver usuários — tabela dentro do modal */
        body.dark-mode #ver-usuarios-list {
            border-color: rgba(71, 85, 105, 0.55);
            background: rgba(15, 23, 42, 0.5);
        }

        body.dark-mode #ver-usuarios-list .table {
            background: transparent;
        }

        body.dark-mode #ver-usuarios-list .table th,
        body.dark-mode #ver-usuarios-list .table td {
            border-bottom-color: rgba(71, 85, 105, 0.4);
            color: #e2e8f0;
        }

        body.dark-mode #ver-usuarios-list .table th {
            color: #cbd5e1;
            background: rgba(15, 23, 42, 0.75);
        }

        body.dark-mode #ver-usuarios-list .ver-usuarios-btn-desv {
            background: rgba(127, 29, 29, 0.35);
            border-color: rgba(248, 113, 113, 0.45);
            color: #fca5a5;
        }

        body.dark-mode #ver-usuarios-list .ver-usuarios-btn-desv:hover:not(:disabled) {
            background: rgba(127, 29, 29, 0.5);
            border-color: #f87171;
            color: #fecaca;
        }

        body.dark-mode #ver-usuarios-list .loading-text {
            color: #94a3b8;
        }

        body.dark-mode .modal-video-shell .video-placeholder {
            color: #94a3b8;
            border-color: rgba(71, 85, 105, 0.55);
            background: rgba(15, 23, 42, 0.45);
        }

        body.dark-mode .form-label {
            color: var(--dm-text-muted);
        }

        body.dark-mode .info-text {
            color: #94a3b8;
        }

        body.dark-mode .form-input,
        body.dark-mode .form-select {
            background: rgba(15, 23, 42, 0.55) !important;
            border: 1px solid rgba(71, 85, 105, 0.45) !important;
            color: var(--dm-heading) !important;
        }

        body.dark-mode .form-input::placeholder {
            color: #64748b;
        }

        body.dark-mode .form-input:focus,
        body.dark-mode .form-select:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.22) !important;
        }

        body.dark-mode select.form-select option,
        body.dark-mode .form-select option {
            background: var(--dm-surface-solid);
            color: var(--dm-text);
        }

        body.dark-mode .btn-secondary {
            background: rgba(51, 65, 85, 0.55);
            border: 1px solid rgba(71, 85, 105, 0.5);
            color: var(--dm-text);
        }

        body.dark-mode .btn-secondary:hover {
            background: rgba(71, 85, 105, 0.55);
            color: var(--dm-heading);
        }

        body.dark-mode .table-container {
            background: var(--dm-surface) !important;
            border: 1px solid var(--dm-border) !important;
        }

        body.dark-mode .table-header,
        body.dark-mode .table-filters {
            border-bottom-color: rgba(71, 85, 105, 0.35) !important;
        }

        body.dark-mode .table {
            color: var(--dm-text);
        }

        body.dark-mode .table th {
            background: rgba(15, 23, 42, 0.88) !important;
            color: var(--dm-text-muted) !important;
            border-bottom-color: rgba(71, 85, 105, 0.35) !important;
        }

        body.dark-mode .table td {
            background: transparent !important;
            color: var(--dm-text) !important;
            border-bottom-color: rgba(71, 85, 105, 0.28) !important;
        }

        body.dark-mode .table tbody tr:hover,
        body.dark-mode .table tbody tr:hover td {
            background: rgba(255, 255, 255, 0.04) !important;
        }

        body.dark-mode .actions-trigger {
            color: var(--dm-text-muted);
        }

        body.dark-mode .actions-trigger:hover {
            color: var(--dm-heading);
            background: rgba(51, 65, 85, 0.45);
        }

        body.dark-mode .actions-dropdown {
            background: rgba(30, 41, 59, 0.98);
            border: 1px solid var(--dm-border);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
        }

        body.dark-mode .actions-item {
            color: var(--dm-text);
            border-bottom-color: rgba(71, 85, 105, 0.28);
        }

        body.dark-mode .actions-item:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #5ee99a;
        }

        body.dark-mode .actions-item.text-red-600 {
            color: #f87171;
        }

        body.dark-mode .actions-item.text-red-600:hover {
            background: rgba(239, 68, 68, 0.12);
            color: #fca5a5;
        }

        body.dark-mode .emails-section {
            border-top-color: rgba(71, 85, 105, 0.35);
        }

        body.dark-mode .emails-coming-soon-text {
            color: var(--dm-text-muted);
        }

        body.dark-mode .emails-coming-soon-icon {
            color: #5ee99a;
        }

        body.dark-mode #clientes-content .clientes-status-pill {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-color: rgba(248, 113, 113, 0.45);
        }

        body.dark-mode #clientes-content .clientes-status-pill-dot {
            background: #f87171;
        }

        body.dark-mode #clientes-content .clientes-checkbox {
            background: #0f172a;
            border-color: rgba(148, 163, 184, 0.55);
            box-shadow: inset 0 0 0 1px rgba(15, 23, 42, 0.35);
        }

        body.dark-mode #clientes-content .clientes-checkbox:checked {
            border-color: #6C63FF;
            background: #6C63FF;
        }

        body.dark-mode #planos-content .planos-filter-select {
            background: #1e293b !important;
            border-color: rgba(148, 163, 184, 0.35) !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #planos-content .planos-filter-select:hover {
            background: #334155 !important;
            border-color: rgba(148, 163, 184, 0.5) !important;
        }

        body.dark-mode #planos-content .planos-filter-select:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
        }

        body.dark-mode #planos-content .planos-filter-select option {
            background: #0f172a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #modal-integracao-pagamento .modal-nc-input-wrap {
            background: rgba(15, 23, 42, 0.82);
            border-color: rgba(100, 116, 139, 0.55);
        }

        body.dark-mode #modal-integracao-pagamento .modal-nc-input-wrap:focus-within {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.18);
        }

        body.dark-mode #modal-integracao-pagamento .modal-nc-select,
        body.dark-mode #modal-integracao-pagamento .modal-nc-input {
            color: #e2e8f0;
        }

        body.dark-mode #modal-integracao-pagamento .modal-nc-select option {
            background: #0f172a;
            color: #e2e8f0;
        }

        body.dark-mode #emails-content .emails-tab-main {
            color: #e2e8f0;
        }

        body.dark-mode #emails-content .emails-top-header h3 {
            color: #f8fafc;
        }

        body.dark-mode #emails-content .emails-top-header p {
            color: #94a3b8;
        }

        body.dark-mode #emails-content .emails-tutorial-tag {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(100, 116, 139, 0.55);
            color: #cbd5e1;
        }

        body.dark-mode #emails-content .emails-tutorial-tag:hover {
            background: rgba(51, 65, 85, 0.9);
            border-color: rgba(148, 163, 184, 0.7);
            color: #f8fafc;
        }

        body.dark-mode #emails-content .emails-status-card {
            background: rgba(15, 23, 42, 0.7);
            border-color: rgba(71, 85, 105, 0.55);
            box-shadow: 0 12px 30px rgba(2, 6, 23, 0.35);
        }

        body.dark-mode #emails-content .emails-status-icon {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(100, 116, 139, 0.45);
            color: #cbd5e1;
        }

        body.dark-mode #emails-content .emails-status-kicker {
            color: #94a3b8;
        }

        body.dark-mode #emails-content .emails-status-title {
            color: #f1f5f9;
        }

        body.dark-mode #emails-content .emails-status-pill {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.16);
            border-color: rgba(74, 222, 128, 0.4);
        }

        body.dark-mode #emails-content .emails-status-pill.is-muted {
            color: #fcd34d;
            background: rgba(245, 158, 11, 0.16);
            border-color: rgba(251, 191, 36, 0.4);
        }

        body.dark-mode #emails-content .emails-status-btn {
            background: rgba(30, 41, 59, 0.75);
            border-color: rgba(100, 116, 139, 0.55);
            color: #cbd5e1;
        }

        body.dark-mode #emails-content .emails-status-btn:hover {
            background: rgba(108, 99, 255, 0.14);
            border-color: rgba(74, 222, 128, 0.4);
            color: #6C63FF;
        }

        body.dark-mode #emails-content .emails-templates-nav,
        body.dark-mode #emails-content .emails-editor-shell {
            background: rgba(15, 23, 42, 0.72);
            border-color: rgba(71, 85, 105, 0.6);
            box-shadow: 0 16px 36px rgba(2, 6, 23, 0.38);
        }

        body.dark-mode #emails-content .emails-templates-kicker {
            color: #94a3b8;
        }

        body.dark-mode #emails-content .emails-template-item {
            color: #cbd5e1;
        }

        body.dark-mode #emails-content .emails-template-item:hover {
            border-color: rgba(100, 116, 139, 0.55);
            background: rgba(51, 65, 85, 0.5);
            color: #f1f5f9;
        }

        body.dark-mode #emails-content .emails-template-item.active {
            background: rgba(108, 99, 255, 0.18);
            border-color: rgba(74, 222, 128, 0.45);
            color: #6C63FF;
        }

        body.dark-mode #emails-content .emails-template-item-ico {
            color: #94a3b8;
        }

        body.dark-mode #emails-content .emails-template-item.active .emails-template-item-ico {
            color: #6C63FF;
        }

        body.dark-mode #emails-content .emails-editor-head {
            background: rgba(15, 23, 42, 0.82);
            border-bottom-color: rgba(71, 85, 105, 0.6);
        }

        body.dark-mode #emails-content .emails-editor-head h4 {
            color: #f8fafc;
        }

        body.dark-mode #emails-content .emails-editor-head p {
            color: #94a3b8;
        }

        body.dark-mode #emails-content .emails-view-switch {
            background: rgba(15, 23, 42, 0.72);
            border-color: rgba(100, 116, 139, 0.45);
        }

        body.dark-mode #emails-content .emails-view-btn {
            background: transparent;
            color: #94a3b8;
        }

        body.dark-mode #emails-content .emails-view-btn:hover {
            color: #e2e8f0;
        }

        body.dark-mode #emails-content .emails-view-btn.active {
            background: rgba(51, 65, 85, 0.85);
            color: #f8fafc;
        }

        body.dark-mode #emails-content .emails-editor-body {
            background: transparent;
        }

        body.dark-mode #emails-content .emails-form-label {
            color: #cbd5e1;
        }

        body.dark-mode #emails-content .emails-input,
        body.dark-mode #emails-content .emails-textarea {
            background: rgba(15, 23, 42, 0.82);
            border-color: rgba(100, 116, 139, 0.5);
            color: #e2e8f0;
        }

        body.dark-mode #emails-content .emails-input::placeholder,
        body.dark-mode #emails-content .emails-textarea::placeholder {
            color: #64748b;
        }

        body.dark-mode #emails-content .emails-input:focus,
        body.dark-mode #emails-content .emails-textarea:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.18);
        }

        body.dark-mode #emails-content .emails-var-chip {
            color: #cbd5e1;
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(100, 116, 139, 0.55);
        }

        body.dark-mode #emails-content .emails-actions-row {
            border-top-color: rgba(71, 85, 105, 0.6);
            background: rgba(15, 23, 42, 0.75);
        }

        body.dark-mode #emails-content .emails-action-text {
            color: #6C63FF;
        }

        body.dark-mode #emails-content .emails-action-text:hover {
            color: #6C63FF;
        }

        body.dark-mode #emails-content .emails-test-dest-email {
            background: rgba(15, 23, 42, 0.82);
            border-color: rgba(100, 116, 139, 0.5);
            color: #e2e8f0;
        }

        body.dark-mode #emails-content .emails-test-dest-email::placeholder {
            color: #64748b;
        }

        body.dark-mode .toast-notification {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.42);
        }

        body.dark-mode .custo-creditos-tag {
            background: rgba(234, 179, 8, 0.12);
            border-color: rgba(234, 179, 8, 0.35);
            color: #fbbf24;
        }

        body.dark-mode .creditos-info-block {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.28);
        }

        body.dark-mode .creditos-info-texto {
            color: #93c5fd !important;
        }

        body.dark-mode .btn-toggle-calcular-mensagens {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(71, 85, 105, 0.45);
            color: var(--dm-text);
        }

        body.dark-mode .btn-toggle-calcular-mensagens:hover {
            background: rgba(51, 65, 85, 0.55);
            border-color: rgba(108, 99, 255, 0.35);
            color: #6C63FF;
        }

        body.dark-mode .calcular-mensagens-content {
            background: rgba(15, 23, 42, 0.5);
            border-color: rgba(71, 85, 105, 0.35);
        }

        body.dark-mode .resultado-mensagens,
        body.dark-mode .resultado-mensagens-destaque {
            color: #6C63FF;
        }

        body.dark-mode .resultado-mensagens-destaque {
            background: rgba(108, 99, 255, 0.12);
            border-color: rgba(108, 99, 255, 0.35);
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

        body.light-mode .menu-badge-admin {
            background: #6C63FF;
            color: #fff;
        }
        body.light-mode .menu-badge-novidade {
            background: #6C63FF;
            color: #fff;
        }

        body.light-mode .version-text {
            color: #999;
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

        body.light-mode .header h1,
        body.light-mode .header-info h1 {
            color: #0f172a;
        }

        body.light-mode .header p,
        body.light-mode .header-info p {
            color: #64748b;
        }

        body.light-mode .main-content {
            background: #f4f4f5;
        }

        body.light-mode .stat-card,
        body.light-mode .chart-card,
        body.light-mode .table-container {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
        }

        body.light-mode .stat-card:hover,
        body.light-mode .chart-card:hover {
            border-color: #e2e8f0;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.06);
        }

        body.light-mode .stat-card-title,
        body.light-mode .chart-title,
        body.light-mode .table-title {
            color: inherit;
        }

        body.light-mode .stat-card-icon {
            opacity: 1;
        }

        body.light-mode .nav-tabs {
            background: transparent;
            border: none;
        }

        body.light-mode .nav-tab {
            color: #94a3b8;
        }

        body.light-mode .nav-tab:hover {
            background: transparent;
            color: #0f172a;
        }

        body.light-mode .nav-tab.active {
            background: transparent;
            color: #6C63FF;
            border-bottom-color: #6C63FF;
        }

        body.light-mode .form-input,
        body.light-mode .form-select {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            border-radius: 8px !important;
            color: #1a1a1a !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
        }

        body.light-mode .form-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%231a1a1a' d='M6 9L1 4h10z'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 12px center !important;
            background-size: 12px !important;
            padding-right: 40px !important;
        }

        body.light-mode .form-select option {
            background: #ffffff !important;
            color: #1a1a1a !important;
            padding: 10px !important;
        }

        /* Garantir contraste em light mode para todos os navegadores */
        body.light-mode select.form-select {
            background-color: #ffffff !important;
            color: #1a1a1a !important;
        }

        body.light-mode select.form-select option {
            background-color: #ffffff !important;
            color: #1a1a1a !important;
        }

        body.light-mode select.form-select:focus {
            background-color: #ffffff !important;
            color: #1a1a1a !important;
        }

        body.light-mode .form-input::placeholder {
            color: #999;
        }

        body.light-mode .form-input:focus,
        body.light-mode .form-select:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
            background: #ffffff !important;
            color: #1a1a1a !important;
        }

        /* Lista de clientes — layout alinhado ao gemini.html */
        #clientes-content .clientes-page-wrap {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Toolbar + tabela colados (sem gap entre os dois blocos) */
        #clientes-content .clientes-list-stack {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        #clientes-content .clientes-page-head {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        @media (min-width: 640px) {
            #clientes-content .clientes-page-head {
                flex-direction: row;
                align-items: center;
            }
        }

        #clientes-content .clientes-page-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.02em;
        }

        #clientes-content .clientes-btn-create,
        #planos-content .planos-btn-create,
        #integracao-pagamento-content .planos-btn-create {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #6C63FF;
            color: #fff;
            font-weight: 700;
            font-size: 0.875rem;
            line-height: 1.25rem;
            padding: 0.625rem 1.25rem;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
            transition: background 0.2s ease, transform 0.2s ease;
        }

        #clientes-content .clientes-btn-create:hover,
        #planos-content .planos-btn-create:hover,
        #integracao-pagamento-content .planos-btn-create:hover {
            background: #6C63FF;
            transform: translateY(-1px);
        }

        #clientes-content .clientes-toolbar {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem 1.5rem 0 0;
            padding: 1rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 10;
        }

        #clientes-content .clientes-toolbar-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        #clientes-content .clientes-search-wrap {
            position: relative;
            flex: 1;
            min-width: 250px;
            max-width: 28rem;
        }

        #clientes-content .clientes-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.875rem;
            pointer-events: none;
        }

        #clientes-content .clientes-search-input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #0f172a;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border-radius: 0.75rem;
            outline: none;
            transition: background 0.2s, border-color 0.2s, box-shadow 0.2s;
        }

        #clientes-content .clientes-search-input::placeholder {
            color: #94a3b8;
        }

        #clientes-content .clientes-search-input:focus {
            background: #fff;
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.15);
        }

        #clientes-content .clientes-bulk-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            padding: 0 0.25rem;
        }

        #clientes-content .clientes-bulk-bar[hidden] {
            display: none !important;
        }

        #clientes-content .clientes-bulk-badge {
            font-size: 0.75rem;
            font-weight: 800;
            color: #6C63FF;
            background: #ecfdf5;
            padding: 0.375rem 0.75rem;
            border-radius: 0.5rem;
        }

        #clientes-content .clientes-bulk-btn {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.5rem 0.75rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        #clientes-content .clientes-bulk-btn:hover:not(:disabled) {
            background: #f1f5f9;
            color: #0f172a;
        }

        #clientes-content .clientes-bulk-btn:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        #clientes-content .clientes-bulk-btn--danger {
            background: #fff;
            border-color: #fecaca;
            color: #ef4444;
        }

        #clientes-content .clientes-bulk-btn--danger:hover:not(:disabled) {
            background: #fef2f2;
        }

        #clientes-content .clientes-filters-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        #clientes-content .clientes-select-wrap {
            position: relative;
        }

        #clientes-content .clientes-filter-select {
            appearance: none;
            background: #fff;
            border: 1px solid #e2e8f0;
            color: #334155;
            font-weight: 700;
            font-size: 0.75rem;
            border-radius: 0.75rem;
            padding: 0.625rem 2rem 0.625rem 1rem;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: border-color 0.2s, background 0.2s;
        }

        #clientes-content .clientes-filter-select:hover {
            background: #f8fafc;
        }

        #clientes-content .clientes-filter-select:focus {
            outline: none;
            border-color: #6C63FF;
        }

        #clientes-content .clientes-select-chevron {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 10px;
            color: #94a3b8;
            pointer-events: none;
        }

        #clientes-content .clientes-export-btn {
            width: 2.5rem;
            height: 2.5rem;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: color 0.2s, background 0.2s;
        }

        #clientes-content .clientes-export-btn:hover {
            color: #0f172a;
            background: #f8fafc;
        }

        #clientes-content .clientes-table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-top: none;
            border-radius: 0 0 1.5rem 1.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            min-height: 480px;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 0;
            overflow: visible;
        }

        #clientes-content .clientes-table-scroll {
            overflow: visible;
            flex: 1;
            min-height: 0;
            padding-bottom: 0.5rem;
        }

        #clientes-content .clientes-table-x-scroll {
            overflow-x: auto;
            overflow-y: visible;
        }

        #clientes-content .clientes-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            text-align: left;
            white-space: nowrap;
        }

        #clientes-content .clientes-table thead tr {
            background: rgba(248, 250, 252, 0.8);
            border-bottom: 1px solid #e2e8f0;
        }

        #clientes-content .clientes-table th {
            padding: 1rem 1.5rem;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #94a3b8;
        }

        #clientes-content .clientes-th-check {
            width: 3rem;
        }

        #clientes-content .clientes-th-actions {
            text-align: center;
        }

        #clientes-content .clientes-checkbox {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 1px solid #cbd5e1;
            cursor: pointer;
            accent-color: #22c55e;
        }

        #clientes-content .clientes-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s ease;
            position: relative;
            z-index: 1;
        }

        #clientes-content .clientes-table tbody tr.clientes-row-actions-open {
            z-index: 200;
        }

        #clientes-content .clientes-table tbody tr:hover {
            background: rgba(248, 250, 252, 0.8);
        }

        #clientes-content .clientes-table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        #clientes-content .clientes-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
            flex-shrink: 0;
            border: 1px solid;
        }

        #clientes-content .clientes-avatar--blue {
            background: #dbeafe;
            color: #2563eb;
            border-color: #bfdbfe;
        }

        #clientes-content .clientes-avatar--slate {
            background: #e2e8f0;
            color: #64748b;
            border-color: #cbd5e1;
        }

        #clientes-content .clientes-cell-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        #clientes-content .clientes-cell-user--muted {
            opacity: 0.6;
        }

        #clientes-content .clientes-user-name {
            font-weight: 800;
            font-size: 0.875rem;
            color: #0f172a;
        }

        #clientes-content .clientes-user-email {
            font-size: 11px;
            font-weight: 500;
            color: #64748b;
            margin-top: 0.125rem;
        }

        #clientes-content .clientes-user-email--strike {
            text-decoration: line-through;
            text-decoration-color: #94a3b8;
        }

        #clientes-content .clientes-plan-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.625rem;
            border-radius: 0.375rem;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.02em;
            border: 1px solid;
        }

        #clientes-content .clientes-plan-badge--free {
            background: #f1f5f9;
            color: #475569;
            border-color: #e2e8f0;
        }

        #clientes-content .clientes-plan-badge--gold {
            background: #fef3c7;
            color: #b45309;
            border-color: #fde68a;
        }

        #clientes-content .clientes-plan-badge--gold i {
            font-size: 8px;
        }

        #clientes-content .clientes-add-plan {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #6C63FF;
            background: #ecfdf5;
            border: 1px dashed #6C63FF;
            padding: 0.35rem 0.6rem;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        #clientes-content .clientes-add-plan:hover {
            background: #d1fae5;
        }

        #clientes-content .clientes-status-live {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        #clientes-content .clientes-status-dot {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 999px;
            background: #6C63FF;
        }

        #clientes-content .clientes-status-label {
            font-size: 0.875rem;
            font-weight: 700;
            color: #334155;
        }

        #clientes-content .clientes-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.625rem;
            border-radius: 0.375rem;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            font-size: 0.75rem;
            font-weight: 700;
        }

        #clientes-content .clientes-status-pill-dot {
            width: 0.375rem;
            height: 0.375rem;
            border-radius: 999px;
            background: #ef4444;
        }

        #clientes-content .clientes-period {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }

        #clientes-content .clientes-period-line {
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        #clientes-content .clientes-period-line--muted {
            font-weight: 500;
            color: #64748b;
        }

        #clientes-content .clientes-period-line--strong {
            font-weight: 700;
            color: #334155;
        }

        #clientes-content .clientes-period-line i {
            width: 1rem;
            text-align: center;
            color: #94a3b8;
        }

        #clientes-content .clientes-actions-menu {
            position: relative;
            display: inline-flex;
            justify-content: center;
            width: 100%;
            z-index: 2;
        }

        #clientes-content .clientes-actions-menu .actions-trigger {
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            color: #94a3b8;
            font-size: 1rem;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #clientes-content .clientes-actions-menu .actions-trigger:hover {
            color: #0f172a;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        #clientes-content .clientes-actions-menu .actions-dropdown {
            right: auto;
            left: 50%;
            transform: translateX(-50%) translateY(-10px);
            margin-top: 0.5rem;
            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 0.75rem;
            min-width: 13rem;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.12);
            z-index: 500;
            transition: none !important;
        }

        #clientes-content .clientes-actions-menu .actions-dropdown.show {
            transform: translateX(-50%) translateY(0);
        }

        #clientes-content .clientes-actions-menu .actions-dropdown.dropdown-up {
            top: auto;
            bottom: 100%;
            margin-top: 0;
            margin-bottom: 0.5rem;
            transform: translateX(-50%) translateY(10px);
        }

        #clientes-content .clientes-actions-menu .actions-dropdown.dropdown-up.show {
            transform: translateX(-50%) translateY(0);
        }

        /* Menu fixo na viewport: não é cortado por overflow-x da tabela */
        #clientes-content .clientes-actions-menu .actions-dropdown.clientes-dropdown-fixed {
            position: fixed !important;
            transform: none !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            right: auto !important;
        }

        #clientes-content .clientes-actions-menu .actions-dropdown.clientes-dropdown-fixed.dropdown-up {
            top: auto;
        }

        #clientes-content .clientes-actions-menu .actions-item {
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        /* Um único traço antes do separador: sem borda no item + linha do .clientes-dropdown-sep */
        #clientes-content .clientes-actions-menu .actions-item:has(+ .clientes-dropdown-sep) {
            border-bottom: none;
        }

        #clientes-content .clientes-actions-menu .actions-item:last-child {
            border-bottom: none;
        }

        #clientes-content .clientes-actions-menu .actions-item:hover {
            background: #f8fafc;
            color: #6C63FF;
        }

        #clientes-content .clientes-actions-menu .actions-item--danger {
            color: #dc2626;
            font-weight: 700;
        }

        #clientes-content .clientes-actions-menu .actions-item--danger:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        #clientes-content .clientes-actions-menu .actions-item--success {
            color: #6C63FF;
            font-weight: 700;
        }

        #clientes-content .clientes-actions-menu .actions-item--success:hover {
            background: #f0fdf4;
            color: #6C63FF;
        }

        #clientes-content .clientes-dropdown-sep {
            height: 1px;
            background: #f1f5f9;
            margin: 0.25rem 0.5rem;
        }

        #clientes-content .clientes-table-footer {
            margin-top: auto;
            padding: 1.25rem;
            border-top: 1px solid #e2e8f0;
            background: rgba(248, 250, 252, 0.5);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        #clientes-content .clientes-page-info {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
        }

        #clientes-content .clientes-page-info-num {
            color: #0f172a;
        }

        #clientes-content .clientes-pagination {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            flex-wrap: wrap;
        }

        #clientes-content .clientes-page-btn {
            width: 2rem;
            height: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }

        #clientes-content .clientes-page-btn:hover:not(:disabled) {
            background: #f8fafc;
        }

        #clientes-content .clientes-page-btn:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        #clientes-content .clientes-page-btn--active {
            border-color: #6C63FF;
            background: #ecfdf5;
            color: #6C63FF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        body.light-mode #clientes-content .clientes-page-title,
        body.light-mode #clientes-content .clientes-user-name {
            color: #0f172a;
        }

        /* Planos — mesmo padrão da lista de clientes (cabeçalho, barra, tabela, rodapé) */
        #planos-content .planos-page-wrap,
        #integracao-pagamento-content .planos-page-wrap {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        #planos-content .planos-list-stack,
        #integracao-pagamento-content .planos-list-stack {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        #planos-content .planos-page-head,
        #integracao-pagamento-content .planos-page-head {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        @media (min-width: 640px) {
            #planos-content .planos-page-head,
            #integracao-pagamento-content .planos-page-head {
                flex-direction: row;
                align-items: center;
            }
        }

        #planos-content .planos-page-title,
        #integracao-pagamento-content .planos-page-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.02em;
        }

        #planos-content .planos-page-head-actions,
        #integracao-pagamento-content .planos-page-head-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            gap: 0.625rem;
        }

        #planos-content .planos-head-api-btns {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.625rem;
        }

        #planos-content .planos-search-wrap {
            position: relative;
            flex: 1;
            min-width: 250px;
            max-width: 28rem;
        }

        #planos-content .planos-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.875rem;
            pointer-events: none;
        }

        #planos-content .planos-search-input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #0f172a;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border-radius: 0.75rem;
            outline: none;
            transition: background 0.2s, border-color 0.2s, box-shadow 0.2s;
        }

        #planos-content .planos-search-input::placeholder {
            color: #94a3b8;
        }

        #planos-content .planos-search-input:focus {
            background: #fff;
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.15);
        }

        /* Integração de pagamento — busca (mesmo padrão da tabela de planos) */
        #integracao-pagamento-content .planos-search-wrap {
            position: relative;
            flex: 1;
            min-width: 250px;
            max-width: 28rem;
        }

        #integracao-pagamento-content .planos-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.875rem;
            pointer-events: none;
        }

        #integracao-pagamento-content .planos-search-input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #0f172a;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border-radius: 0.75rem;
            outline: none;
            transition: background 0.2s, border-color 0.2s, box-shadow 0.2s;
        }

        #integracao-pagamento-content .planos-search-input::placeholder {
            color: #94a3b8;
        }

        #integracao-pagamento-content .planos-search-input:focus {
            background: #fff;
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.15);
        }

        #planos-content .planos-filters-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        #planos-content .planos-select-wrap {
            position: relative;
        }

        #planos-content .planos-filter-select {
            appearance: none;
            background: #fff;
            border: 1px solid #e2e8f0;
            color: #334155;
            font-weight: 700;
            font-size: 0.75rem;
            border-radius: 0.75rem;
            padding: 0.625rem 2rem 0.625rem 1rem;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: border-color 0.2s, background 0.2s;
        }

        #planos-content .planos-filter-select:hover {
            background: #f8fafc;
        }

        #planos-content .planos-filter-select:focus {
            outline: none;
            border-color: #6C63FF;
        }

        #planos-content .planos-select-chevron {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 10px;
            color: #94a3b8;
            pointer-events: none;
        }

        #planos-content .planos-toolbar,
        #integracao-pagamento-content .planos-toolbar {
            display: block;
            margin-left: 0;
            flex: none;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem 1.5rem 0 0;
            padding: 1rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 10;
        }

        #planos-content .planos-toolbar-inner,
        #integracao-pagamento-content .planos-toolbar-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        #integracao-pagamento-content .integ-pag-toolbar-inner {
            justify-content: flex-start;
        }

        #planos-content .planos-table-card,
        #integracao-pagamento-content .planos-table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-top: none;
            border-radius: 0 0 1.5rem 1.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            min-height: 480px;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 0;
            overflow: visible;
        }

        #integracao-pagamento-content .integ-pag-table-card {
            min-height: 320px;
        }

        #planos-content .planos-table-scroll,
        #integracao-pagamento-content .planos-table-scroll {
            overflow: visible;
            flex: 1;
            min-height: 0;
            padding-bottom: 0.5rem;
        }

        #integracao-pagamento-content .integ-pag-intro {
            margin: 0;
            font-size: 0.875rem;
            line-height: 1.55;
            font-weight: 500;
            color: #64748b;
            max-width: 56rem;
        }

        #integracao-pagamento-content .integ-pag-intro strong {
            color: #475569;
            font-weight: 700;
        }

        #integracao-pagamento-content .integ-pag-list-inner {
            padding: 0;
        }

        #integracao-pagamento-content .integ-pag-list-empty {
            text-align: center;
            font-size: 0.875rem;
            font-weight: 600;
            color: #94a3b8;
            padding: 3rem 1.5rem;
            margin: 0;
            border: none;
            background: transparent;
        }

        #integracao-pagamento-content .integ-pag-list {
            display: block;
        }

        #integracao-pagamento-content .integ-pag-table-x-scroll {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            overflow-y: visible;
        }

        #integracao-pagamento-content .integ-pag-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            text-align: left;
        }

        #integracao-pagamento-content .integ-pag-table th:nth-child(1),
        #integracao-pagamento-content .integ-pag-table td:nth-child(1) {
            width: 34%;
            min-width: 220px;
        }

        #integracao-pagamento-content .integ-pag-table th:nth-child(2),
        #integracao-pagamento-content .integ-pag-table td:nth-child(2) {
            width: 46%;
            min-width: 420px;
        }

        #integracao-pagamento-content .integ-pag-table th:nth-child(3),
        #integracao-pagamento-content .integ-pag-table td:nth-child(3) {
            width: 20%;
            min-width: 160px;
        }

        #integracao-pagamento-content .integ-pag-table thead tr {
            background: rgba(248, 250, 252, 0.8);
            border-bottom: 1px solid #e2e8f0;
        }

        #integracao-pagamento-content .integ-pag-table th {
            padding: 1rem 1.5rem;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #94a3b8;
        }

        #integracao-pagamento-content .integ-pag-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s ease;
            cursor: pointer;
        }

        #integracao-pagamento-content .integ-pag-table tbody tr:hover {
            background: rgba(248, 250, 252, 0.8);
        }

        #integracao-pagamento-content .integ-pag-table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.875rem;
            font-weight: 600;
        }

        #integracao-pagamento-content .integ-pag-name-cell {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #integracao-pagamento-content .integ-pag-link-wrap {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 0;
        }

        #integracao-pagamento-content .integ-pag-link-text {
            max-width: 340px;
            min-width: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: 0.78rem;
            color: #64748b;
        }

        #integracao-pagamento-content .integ-pag-copy-btn {
            width: 1.95rem;
            height: 1.95rem;
            border-radius: 0.55rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }

        #integracao-pagamento-content .integ-pag-copy-btn:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        #integracao-pagamento-content .integ-pag-item-badge {
            display: inline-block;
            font-size: 0.625rem;
            font-weight: 800;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            margin-left: 0.5rem;
            vertical-align: middle;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        #integracao-pagamento-content .integ-pag-item-badge--teste {
            background: rgba(245, 158, 11, 0.15);
            color: #b45309;
        }

        #integracao-pagamento-content .integ-pag-item-badge--ativo {
            background: rgba(108, 99, 255, 0.12);
            color: #6C63FF;
        }

        #planos-content .planos-table-x-scroll {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            overflow-y: visible;
        }

        #planos-content .planos-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            text-align: left;
        }

        #planos-content .planos-table thead tr {
            background: rgba(248, 250, 252, 0.8);
            border-bottom: 1px solid #e2e8f0;
        }

        #planos-content .planos-table th {
            padding: 1rem 1.5rem;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #94a3b8;
        }

        #planos-content .planos-th-actions {
            text-align: center;
        }

        #planos-content .planos-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s ease;
        }

        #planos-content .planos-table tbody tr:hover {
            background: rgba(248, 250, 252, 0.8);
        }

        #planos-content .planos-table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.875rem;
            font-weight: 600;
        }

        #planos-content .planos-table td:last-child {
            text-align: center;
        }

        #planos-content .planos-table-footer {
            margin-top: auto;
            padding: 1.25rem;
            border-top: 1px solid #e2e8f0;
            background: rgba(248, 250, 252, 0.5);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        #planos-content .planos-page-info {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
        }

        #planos-content .planos-page-info-num {
            color: #0f172a;
        }

        #planos-content .planos-pagination {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            flex-wrap: wrap;
        }

        #planos-content .planos-page-btn {
            width: 2rem;
            height: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }

        #planos-content .planos-page-btn:hover:not(:disabled) {
            background: #f8fafc;
        }

        #planos-content .planos-page-btn:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        #planos-content .planos-page-btn--active {
            border-color: #6C63FF;
            background: #ecfdf5;
            color: #6C63FF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        #planos-content .plan-title {
            font-size: 0.875rem;
        }

        #planos-content .plan-price {
            font-size: 0.75rem;
            font-weight: 800;
            margin-top: 0.25rem;
        }

        #planos-content .plan-price-suffix {
            color: #94a3b8;
            font-size: 0.6875rem;
            font-weight: 600;
        }

        #planos-content .plan-meta-item {
            font-size: 0.75rem;
            font-weight: 600;
        }

        #planos-content .plan-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 1rem;
            font-size: 1rem;
        }

        body.light-mode #planos-content .planos-page-title,
        body.light-mode #integracao-pagamento-content .planos-page-title {
            color: #0f172a;
        }

        /* Página de vendas — layout alinhado a Clientes / Planos */
        #pv-content .pv-page-wrap {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 0 1.5rem;
        }

        #pv-content .pv-page-head {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        @media (min-width: 640px) {
            #pv-content .pv-page-head {
                flex-direction: row;
                align-items: center;
            }
        }

        #pv-content .pv-page-title-row {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            flex-wrap: wrap;
        }

        #pv-content .pv-page-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.02em;
        }

        #pv-content .pv-title-badge {
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            background: rgba(108, 99, 255, 0.12);
            color: #6C63FF;
            border: 1px solid rgba(108, 99, 255, 0.35);
        }

        #pv-content .pv-btn-create,
        #pv-content .pv-btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #6C63FF;
            color: #fff;
            font-weight: 700;
            font-size: 0.875rem;
            line-height: 1.25rem;
            padding: 0.625rem 1.25rem;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(108, 99, 255, 0.2);
            transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            font-family: inherit;
        }

        #pv-content .pv-btn-create:hover,
        #pv-content .pv-btn-action:hover {
            background: #6C63FF;
            transform: translateY(-1px);
            box-shadow: 0 10px 28px rgba(108, 99, 255, 0.28);
        }

        #pv-content .pv-btn-create:disabled,
        #pv-content .pv-btn-action:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none;
        }

        #pv-content .pv-main-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        #pv-content .pv-main-card-inner {
            padding: 1.5rem;
        }

        #pv-content .pv-status {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        #pv-content .pv-status-empty {
            color: #64748b;
        }

        #pv-content .pv-status-ok {
            color: #6C63FF;
        }

        #pv-content .pv-link-inline {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        #pv-content .pv-link-tag {
            padding: 0.35rem 0.75rem;
            border-radius: 0.5rem;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #065f46;
            max-width: min(100%, 520px);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        #pv-content .pv-link-copy-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            border-radius: 0.625rem;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }

        #pv-content .pv-link-copy-btn:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        #pv-content .pv-preview-wrapper {
            margin-top: 0.25rem;
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        #pv-content .pv-preview-frame {
            width: 100%;
            min-height: 560px;
            border: none;
            background: #f8fafc;
            display: block;
        }

        #pv-content .pv-edit-block {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f5f9;
        }

        #pv-content .pv-section-head {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #6C63FF;
            margin-bottom: 0.75rem;
        }

        #pv-content .pv-section-head i {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        #pv-content .pv-edit-label {
            display: block;
            font-size: 0.9375rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.375rem;
        }

        #pv-content .pv-edit-helper {
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.75rem;
            line-height: 1.5;
        }

        #pv-content .pv-edit-textarea {
            min-height: 100px;
            resize: vertical;
            width: 100%;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0 !important;
            padding: 0.875rem 1rem !important;
            font-size: 0.9375rem !important;
        }

        #pv-content .pv-edit-actions {
            margin-top: 0.875rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        #pv-content .pv-edit-secondary {
            font-size: 0.8125rem;
            color: #64748b;
            line-height: 1.4;
        }

        #pv-content .pv-editando-aviso {
            margin-top: 1rem;
            padding: 0.875rem 1rem;
            background: rgba(234, 179, 8, 0.1);
            border: 1px solid rgba(234, 179, 8, 0.35);
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #b45309;
            display: none;
        }

        #pv-content .pv-editando-aviso.ativo {
            display: block;
        }

        #pv-content .pv-nova-wrapper {
            margin-top: 1.5rem;
            padding: 1.25rem;
            border-radius: 1rem;
            border: 1px solid rgba(108, 99, 255, 0.35);
            background: linear-gradient(180deg, rgba(108, 99, 255, 0.06) 0%, rgba(255, 255, 255, 0.85) 100%);
        }

        #pv-content .pv-nova-titulo {
            font-size: 1rem;
            font-weight: 800;
            margin: 0 0 0.75rem;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        #pv-content .pv-nova-titulo-verde {
            color: #6C63FF;
        }

        #pv-content .pv-nova-preview-wrapper {
            border-radius: 0.875rem;
            overflow: hidden;
            border: 1px solid #a7f3d0;
        }

        #pv-content .pv-nova-preview-frame {
            width: 100%;
            min-height: 520px;
            border: none;
            background: #f8fafc;
            display: block;
        }

        #pv-content .pv-nova-actions {
            margin-top: 1rem;
            display: flex;
            justify-content: flex-end;
        }

        /* E-mails tab: code para variáveis */
        .info-text code {
            background: rgba(108, 99, 255, 0.15);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.85em;
        }

        /* E-mails tab — tipografia e pesos alinhados ao gemini.html (Tailwind) */
        .emails-tab-layout { width: 100%; max-width: 100%; }
        .emails-tab-main { display: flex; flex-direction: column; gap: 24px; width: 100%; }
        /* gemini: text-xl font-extrabold text-slate-900 */
        .emails-top-header { margin-bottom: 24px; }
        .emails-top-header-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .emails-top-header-title-row .emails-tutorial-tag {
            flex-shrink: 0;
            align-self: center;
        }
        .emails-top-header h3 {
            margin: 0;
            font-size: 1.25rem;
            line-height: 1.3;
            font-weight: 800;
            color: #0f172a;
            flex: 1;
            min-width: 0;
        }
        /* gemini: text-sm font-medium text-slate-500 mt-1 */
        .emails-top-header p {
            margin: 4px 0 0;
            font-size: 0.875rem;
            line-height: 1.5;
            font-weight: 500;
            color: #64748b;
        }
        /* gemini: grid gap-6 mb-10 */
        .emails-status-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }
        /* gemini: rounded-3xl p-6 border shadow-sm */
        .emails-status-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            padding: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .emails-status-card-main {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
        }
        /* gemini: w-12 h-12 ... text-xl */
        .emails-status-icon {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 1.25rem;
            line-height: 1;
            flex-shrink: 0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        /* gemini: text-[10px] font-bold uppercase tracking-widest */
        .emails-status-kicker {
            display: block;
            font-size: 10px;
            line-height: 1.2;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 700;
            margin-bottom: 2px;
        }
        /* gemini: text-sm font-bold text-slate-900 */
        .emails-status-title {
            margin: 0;
            color: #0f172a;
            font-size: 0.875rem;
            line-height: 1.25;
            font-weight: 700;
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }
        /* gemini: badge text-[10px] */
        .emails-status-pill {
            display: inline-block;
            font-size: 10px;
            line-height: 1.2;
            font-weight: 700;
            color: #059669;
            background: #ecfdf5;
            border: 1px solid #d1fae5;
            border-radius: 0.25rem;
            padding: 2px 8px;
        }
        .emails-status-pill.is-muted {
            color: #92400e;
            background: #fef3c7;
            border-color: #fcd34d;
        }
        /* gemini: text-sm font-bold */
        .emails-status-btn {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            border-radius: 0.75rem;
            padding: 8px 16px;
            cursor: pointer;
            transition: color 0.2s, background 0.2s, border-color 0.2s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        .emails-status-btn:hover {
            border-color: #bbf7d0;
            color: #059669;
            background: #ecfdf5;
        }
        .emails-tutorial-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            width: fit-content;
            padding: 10px 16px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            color: #334155;
            font-weight: 700;
            font-size: 0.875rem;
            line-height: 1.25;
            cursor: pointer;
            transition: .2s ease;
        }
        .emails-tutorial-tag svg { flex-shrink: 0; }
        .emails-tutorial-tag:hover { border-color: #94a3b8; color: #0f172a; }
        /* gemini: flex gap-8, lg:w-72 */
        .emails-designer {
            display: grid;
            grid-template-columns: 18rem minmax(0, 1fr);
            gap: 32px;
            align-items: start;
        }
        /* gemini: rounded-[2rem] p-6 shadow-soft */
        .emails-templates-nav {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 2rem;
            padding: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
            position: sticky;
            top: 100px;
        }
        /* gemini: text-[10px] font-extrabold uppercase tracking-widest mb-4 pl-2 */
        .emails-templates-kicker {
            margin: 0 0 16px 0;
            padding-left: 8px;
            font-size: 10px;
            line-height: 1.2;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 800;
        }
        /* gemini: px-4 py-3 rounded-xl gap-3 */
        .emails-template-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid transparent;
            background: transparent;
            padding: 12px 16px;
            border-radius: 0.75rem;
            color: #475569;
            font-size: 0.875rem;
            cursor: pointer;
            margin-bottom: 8px;
            text-align: left;
            transition: .2s ease;
        }
        .emails-template-item:hover {
            border-color: #e2e8f0;
            background: #f8fafc;
            color: #0f172a;
        }
        .emails-template-item.active {
            background: #ecfdf5;
            border-color: #bbf7d0;
            color: #047857;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        .emails-template-item-ico {
            width: 24px;
            color: #94a3b8;
            text-align: center;
            flex-shrink: 0;
        }
        .emails-template-item.active .emails-template-item-ico { color: #6C63FF; }
        /* gemini: text-sm font-bold */
        .emails-template-item-title {
            display: block;
            font-weight: 700;
            font-size: 0.875rem;
            line-height: 1.25;
        }
        /* gemini: text-[10px] font-medium opacity-70 */
        .emails-template-item-desc {
            display: block;
            font-size: 10px;
            line-height: 1.25;
            font-weight: 500;
            opacity: 0.7;
            margin-top: 2px;
        }
        /* gemini: rounded-[2rem] shadow-soft */
        .emails-editor-shell {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        /* gemini: p-6 md:p-8 border-slate-100 bg-slate-50/50 */
        .emails-editor-head {
            padding: 24px 32px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            background: rgba(248, 250, 252, 0.5);
        }
        /* gemini: text-lg font-extrabold text-slate-900 */
        .emails-editor-head h4 {
            margin: 0;
            color: #0f172a;
            font-size: 1.125rem;
            line-height: 1.3;
            font-weight: 800;
        }
        /* gemini: text-xs font-medium text-slate-500 mt-1 */
        .emails-editor-head p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 0.75rem;
            line-height: 1.5;
            font-weight: 500;
            max-width: 560px;
        }
        /* gemini: p-1 rounded-lg border shadow-sm */
        .emails-view-switch {
            display: inline-flex;
            gap: 0;
            padding: 4px;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        /* gemini: text-xs; ativo font-bold + bg-slate-100 */
        .emails-view-btn {
            border: 0;
            padding: 6px 16px;
            background: #fff;
            color: #64748b;
            font-size: 0.75rem;
            line-height: 1.25;
            font-weight: 500;
            cursor: pointer;
            border-radius: 0.375rem;
            transition: .2s ease;
        }
        .emails-view-btn:hover { color: #334155; }
        .emails-view-btn.active {
            background: #f1f5f9;
            color: #0f172a;
            font-weight: 700;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        /* gemini: p-6 md:p-8 space-y-8 */
        .emails-editor-body {
            padding: 24px 32px;
            display: grid;
            gap: 32px;
        }
        /* Labels / inputs do editor (gemini: text-sm font-bold label; input text-sm font-semibold) */
        #emails-content .emails-form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            color: #334155;
            margin-bottom: 8px;
        }
        #emails-content .emails-form-label--upper {
            font-size: 0.75rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 8px;
        }
        #emails-content .emails-form-label--preview { margin-bottom: 8px; }
        #emails-content .emails-editor-body .form-group .form-input:not(.emails-html-field),
        #emails-content .emails-editor-body .form-input:not(.emails-html-field) {
            font-size: 0.875rem;
            font-weight: 600;
            line-height: 1.25;
            color: #0f172a;
            padding: 14px 16px;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        #emails-content .emails-editor-body .form-group .info-text {
            font-size: 0.75rem;
            font-weight: 500;
            line-height: 1.625;
            color: #64748b;
            margin-top: 8px;
        }
        .emails-var-list {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        /* gemini: text-xs font-mono font-bold */
        .emails-var-chip {
            display: inline-block;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: 0.75rem;
            line-height: 1.25;
            font-weight: 700;
            color: #475569;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 4px 10px;
        }
        .emails-preview-wrap { margin-bottom: 0; }
        .emails-preview-frame {
            width: 100%;
            min-height: 360px;
            border: 1px solid #1e293b;
            border-radius: 1rem;
            background: #0f172a;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.06);
        }
        /* gemini: botão secundário ~ text-sm font-bold */
        .emails-html-toggle {
            margin-top: 0;
            margin-bottom: 0;
            padding: 10px 16px;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
        }
        .emails-html-wrap { display: none; margin-top: 12px; }
        .emails-html-wrap.visible { display: block; }
        /* gemini: textarea text-sm font-mono text-brand-400 */
        .emails-html-field {
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: 0.875rem;
            line-height: 1.5;
            font-weight: 400;
            resize: vertical;
            min-height: 240px;
            background: #0f172a;
            color: #6C63FF;
            border: 1px solid #1e293b;
            border-radius: 0.75rem;
            padding: 16px;
        }
        .emails-html-wrap .emails-form-label { margin-bottom: 8px; }
        /* gemini: p-6 md:px-8 py-5 border-t border-slate-100 */
        .emails-actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            border-top: 1px solid #f1f5f9;
            padding: 20px 32px;
            background: #fff;
        }
        /* gemini: text-sm font-bold text-brand-600 */
        .emails-action-text {
            border: 0;
            background: transparent;
            color: #059669;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .emails-action-text:hover { color: #047857; }
        .emails-send-test-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .emails-test-dest-email {
            min-width: 220px;
            max-width: 320px;
            padding: 10px 14px;
            font-size: 0.875rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            background: #f8fafc;
            color: #0f172a;
        }
        .emails-test-dest-email::placeholder { color: #94a3b8; }
        .emails-test-dest-email:focus {
            outline: none;
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.15);
        }
        /* gemini: font-bold text-sm px-8 py-3 rounded-xl */
        .emails-save-btn {
            border-radius: 0.75rem;
            padding: 12px 32px;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1.25;
            border: 0;
            background: #6C63FF;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(108, 99, 255, 0.3);
            transition: background 0.2s, transform 0.2s;
        }
        .emails-save-btn:hover { background: #059669; }
        .emails-unsaved-badge {
            display: inline-flex;
            align-items: center;
            margin-left: 8px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 800;
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            white-space: nowrap;
        }
        .emails-unsaved-alert {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            margin: 0 0 14px 0;
            border-radius: 10px;
            border: 1px solid #fde68a;
            background: #fffbeb;
            color: #92400e;
            font-size: 0.86rem;
            font-weight: 700;
        }
        .emails-hidden { display: none !important; }
        @media (max-width: 1100px) {
            .emails-designer { grid-template-columns: 1fr; }
            .emails-templates-nav { position: static; }
            .emails-editor-head { padding: 24px; }
            .emails-editor-body { padding: 24px; }
            .emails-actions-row { padding: 20px 24px; }
        }
        @media (max-width: 900px) {
            .emails-status-grid { grid-template-columns: 1fr; }
        }
        /* Modais de vídeo — mesmo shell que criar cliente / OpenAI */
        .modal-video-shell.modal-shell-nc .modal-content.modal-nc {
            max-width: 920px;
            width: min(95vw, 920px);
        }

        .modal-video-shell .modal-nc-body--video {
            padding: 20px 28px 28px;
        }

        .modal-video-shell .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            background: #000;
            border-radius: 14px;
            border: 1px solid rgba(15, 23, 42, 0.12);
        }

        .modal-video-shell .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .modal-video-shell .video-placeholder {
            padding: 48px 28px;
            text-align: center;
            color: #64748b;
            font-size: 0.9375rem;
            font-weight: 500;
            line-height: 1.55;
            border-radius: 14px;
            border: 1px dashed #e5e7eb;
            background: #f9fafb;
        }

        .emails-coming-soon {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 360px;
            padding: 48px 24px;
        }
        .emails-coming-soon-inner { text-align: center; max-width: 420px; }
        .emails-coming-soon-icon { color: #6C63FF; margin-bottom: 20px; opacity: 0.9; }
        .emails-coming-soon-icon svg { width: 64px; height: 64px; }
        .emails-coming-soon-title { font-size: 1.5rem; margin: 0 0 12px 0; color: inherit; }
        .emails-coming-soon-text { margin: 0; color: #888; line-height: 1.5; }
        body.light-mode .emails-coming-soon-text { color: #666; }
        body.light-mode .emails-coming-soon-icon { color: #6C63FF; }

        /* Personalização tab */
        .personalizacao-wrap {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            padding-bottom: 1rem;
        }

        .personalizacao-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .personalizacao-title {
            margin: 0 0 0.35rem;
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
        }

        .personalizacao-subtitle {
            margin: 0;
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .personalizacao-save-btn {
            border: 0;
            border-radius: 0.75rem;
            background: #6C63FF;
            color: #fff;
            font-weight: 700;
            font-size: 0.875rem;
            padding: 0.7rem 1.2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            white-space: nowrap;
        }

        .personalizacao-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            .personalizacao-grid {
                grid-template-columns: minmax(320px, 420px) 1fr;
            }
        }

        .personalizacao-column {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .personalizacao-card {
            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 2rem;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.03);
        }

        .personalizacao-card-kicker {
            margin: 0 0 1rem;
            font-size: 0.625rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #6C63FF;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .personalizacao-card-kicker.is-blue { color: #3b82f6; }
        .personalizacao-card-kicker.is-indigo { color: #6366f1; }

        .personalizacao-field {
            margin-bottom: 0.9rem;
        }

        .personalizacao-field:last-child {
            margin-bottom: 0;
        }

        .personalizacao-label {
            display: block;
            margin-bottom: 0.45rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: #334155;
        }

        .personalizacao-required {
            color: #ef4444;
        }

        .personalizacao-color-row {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .personalizacao-color-picker {
            width: 46px;
            height: 46px;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            flex-shrink: 0;
        }

        .personalizacao-color-picker input[type="color"] {
            width: 56px;
            height: 56px;
            margin: -6px;
            border: 0;
            padding: 0;
            background: transparent;
            cursor: pointer;
        }

        .personalizacao-upload-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.9rem;
            padding-top: 0.25rem;
        }

        .personalizacao-upload-label {
            display: block;
            text-align: center;
            margin-bottom: 0.4rem;
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
        }

        .personalizacao-upload-box {
            border: 2px dashed #e2e8f0;
            border-radius: 0.9rem;
            min-height: 108px;
            padding: 0.9rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            background: #fff;
            color: #64748b;
        }

        .personalizacao-logo-preview {
            width: 42px;
            height: 42px;
            border-radius: 0.7rem;
            object-fit: contain;
            background: #fff;
            border: 1px solid #e2e8f0;
        }

        .personalizacao-favicon-preview {
            width: 34px;
            height: 34px;
            border-radius: 0.5rem;
            object-fit: contain;
            background: #fff;
            border: 1px solid #e2e8f0;
        }

        .personalizacao-help {
            margin: 0.45rem 0 0;
            font-size: 0.7rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .personalizacao-link-discreto {
            display: inline-block;
            margin-top: 0.5rem;
            font-size: 0.7rem;
            color: #64748b;
            text-decoration: none;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .personalizacao-link-discreto:hover {
            color: #6C63FF;
            text-decoration: underline;
        }

        .personalizacao-upload-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .personalizacao-upload-btn {
            border: 1px solid #d1d5db;
            background: #ffffff;
            color: #334155;
            border-radius: 10px;
            padding: 7px 12px;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .personalizacao-upload-btn:hover {
            border-color: #6C63FF;
            color: #16a34a;
            background: rgba(108, 99, 255, 0.08);
        }

        .personalizacao-upload-filename {
            font-size: 0.75rem;
            color: #64748b;
        }

        .personalizacao-videos-list {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .personalizacao-video-item {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 1rem;
            padding: 0.9rem;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        @media (min-width: 768px) {
            .personalizacao-video-item {
                flex-direction: row;
                align-items: center;
            }
        }

        .personalizacao-video-meta {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        @media (min-width: 768px) {
            .personalizacao-video-meta {
                width: 36%;
                flex-shrink: 0;
            }
        }

        .personalizacao-video-icon {
            width: 32px;
            height: 32px;
            border-radius: 0.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .personalizacao-video-icon.is-indigo { background: #e0e7ff; color: #4f46e5; }
        .personalizacao-video-icon.is-green { background: #dcfce7; color: #6C63FF; }
        .personalizacao-video-icon.is-blue { background: #dbeafe; color: #1d4ed8; }
        .personalizacao-video-icon.is-teal { background: #ccfbf1; color: #0f766e; }
        .personalizacao-video-icon.is-orange { background: #ffedd5; color: #c2410c; }
        .personalizacao-video-icon.is-slate { background: #334155; color: #f1f5f9; }
        .personalizacao-video-icon.is-fuchsia { background: #fae8ff; color: #a21caf; }

        .personalizacao-video-text {
            min-width: 0;
            flex: 1;
        }

        .personalizacao-video-category {
            display: block;
            font-size: 0.625rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            margin-bottom: 0.2rem;
        }

        .personalizacao-video-title {
            margin: 0;
            font-size: 0.8rem;
            color: #1e293b;
            font-weight: 700;
        }

        .personalizacao-video-input-wrap {
            position: relative;
            flex: 1;
        }

        .personalizacao-video-input-wrap .form-input {
            padding-right: 2.3rem;
            font-size: 0.76rem;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        }

        .personalizacao-video-reset {
            position: absolute;
            right: 0.7rem;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #94a3b8;
            cursor: pointer;
            font-size: 0.8rem;
        }

        body.dark-mode .personalizacao-title { color: #f8fafc; }
        body.dark-mode .personalizacao-subtitle { color: #94a3b8; }
        body.dark-mode .personalizacao-save-btn { background: #6C63FF; color: #052e16; }
        body.dark-mode .personalizacao-card { background: #1f2937; border-color: #334155; box-shadow: none; }
        body.dark-mode .personalizacao-label,
        body.dark-mode .personalizacao-upload-label,
        body.dark-mode .personalizacao-video-title { color: #e2e8f0; }
        body.dark-mode .personalizacao-video-category { color: #94a3b8; }
        body.dark-mode .personalizacao-upload-box { background: #111827; border-color: #334155; color: #94a3b8; }
        body.dark-mode .personalizacao-logo-preview,
        body.dark-mode .personalizacao-favicon-preview { background: #0b1220; border-color: #334155; }
        body.dark-mode .personalizacao-video-item { background: #111827; border-color: #334155; }
        body.dark-mode .personalizacao-help { color: #94a3b8; }
        body.dark-mode .personalizacao-video-reset { color: #cbd5e1; }
        body.dark-mode .personalizacao-link-discreto { color: #94a3b8; }
        body.dark-mode .personalizacao-link-discreto:hover { color: #5ee99a; }
        body.dark-mode .personalizacao-upload-btn {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }
        body.dark-mode .personalizacao-upload-btn:hover {
            border-color: #6C63FF;
            color: #86efac;
            background: rgba(108, 99, 255, 0.14);
        }
        body.dark-mode .personalizacao-upload-filename { color: #94a3b8; }
        body.light-mode .emails-tutorial-tag { background: #f8fafc; border-color: #cbd5e1; color: #334155; }
        body.light-mode .admin-info-block {
            background: #0f172a;
            border: none;
            color: #cbd5e1;
        }
        body.light-mode .admin-info-block .admin-info-link { color: #0f172a; }
        body.light-mode .admin-info-block .admin-info-link:hover { color: #0f172a; }

        /* Tabelas no Light Mode */
        body.light-mode .table-container {
            background: #ffffff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 30px !important;
            overflow: hidden !important;
        }

        body.light-mode .table-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .table-filters {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        body.light-mode .table {
            color: #333;
        }

        body.light-mode .table th {
            background: #f8fafc !important;
            color: #94a3b8 !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        body.light-mode .table td {
            border-bottom: 1px solid #f1f5f9 !important;
            color: #334155 !important;
            background: #ffffff !important;
        }

        body.light-mode .table tbody tr:hover {
            background: #f8fafc !important;
        }

        body.light-mode .table tbody tr:hover td {
            background: #f8fafc !important;
        }

        body.light-mode .table tbody tr:last-child td {
            border-bottom: none !important;
        }

        body.light-mode .modal-content {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: #333;
        }

        body.light-mode .modal-title {
            color: #666;
        }

        body.light-mode .form-label {
            color: #333;
        }

        body.light-mode .btn-secondary {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        body.light-mode .btn-secondary:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .btn-openai {
            background: #6C63FF;
            color: #ffffff;
            border: 1px solid #6C63FF;
        }

        body.light-mode .btn-openai:hover {
            background: #1fb954;
            box-shadow: none;
        }

        body.light-mode .btn-openai-test {
            background: #ffffff;
            color: #334155;
            border: 1px solid #e2e8f0;
        }

        body.light-mode .btn-openai-test:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        /* Modal de Aviso OpenAI - alinhado ao design atual dos modais */
        #aviso-openai-modal.modal-shell-nc .modal-content.modal-nc {
            max-width: 560px;
        }
        #aviso-openai-modal .openai-alert-kicker {
            color: #dc2626;
        }
        #aviso-openai-modal .openai-alert-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        #aviso-openai-modal .openai-alert-title-wrap .openai-logo {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            color: #10a37f;
        }
        #aviso-openai-modal .openai-alert-surface {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-radius: 14px;
            border: 1px solid rgba(220, 38, 38, 0.2);
            background: #fff5f5;
            padding: 16px;
        }
        #aviso-openai-modal .openai-alert-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            color: #dc2626;
            margin-top: 2px;
        }
        #aviso-openai-modal .openai-alert-message {
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.6;
            color: #7f1d1d;
        }

        body.dark-mode #aviso-openai-modal .openai-alert-kicker {
            color: #fca5a5;
        }
        body.dark-mode #aviso-openai-modal .openai-alert-surface {
            background: rgba(127, 29, 29, 0.2);
            border-color: rgba(248, 113, 113, 0.3);
        }
        body.dark-mode #aviso-openai-modal .openai-alert-icon {
            color: #f87171;
        }
        body.dark-mode #aviso-openai-modal .openai-alert-message {
            color: #fecaca;
        }

        body.light-mode .custo-creditos-tag {
            background: rgba(255, 193, 7, 0.2);
            border-color: rgba(255, 193, 7, 0.5);
            color: #f59e0b;
        }

        body.light-mode .creditos-info-block {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.3);
        }

        body.light-mode .creditos-info-texto {
            color: #1d4ed8 !important;
        }

        body.light-mode .btn-toggle-calcular-mensagens {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 0, 0, 0.15);
            color: #374151;
        }

        body.light-mode .btn-toggle-calcular-mensagens:hover {
            background: rgba(108, 99, 255, 0.08);
            border-color: rgba(108, 99, 255, 0.25);
            color: #6C63FF;
        }

        body.light-mode .calcular-mensagens-content {
            background: rgba(255, 255, 255, 0.7);
            border-color: rgba(0, 0, 0, 0.12);
        }

        body.light-mode .resultado-mensagens,
        body.light-mode .resultado-mensagens-destaque {
            color: #6C63FF;
        }

        body.light-mode .resultado-mensagens-destaque {
            background: rgba(108, 99, 255, 0.12);
            border-color: rgba(108, 99, 255, 0.35);
        }

        /* Botões de Ações no Light Mode */
        body.light-mode .actions-trigger {
            color: #666;
        }

        body.light-mode .actions-trigger:hover {
            color: #333;
            background: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .actions-dropdown {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        body.light-mode .actions-item {
            color: #666;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        body.light-mode .actions-item:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #333;
        }

        body.light-mode .actions-item.text-red-600 {
            color: #ef4444;
        }

        body.light-mode .actions-item.text-red-600:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        /* Tela de login admin */
        /* Ver usuários — lista dentro do modal shell claro */
        #ver-usuarios-list {
            min-height: 120px;
            max-height: min(60vh, 420px);
            overflow: auto;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
        }
        #ver-usuarios-list .table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            background: #fff;
        }
        #ver-usuarios-list .table th,
        #ver-usuarios-list .table td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #0f172a;
        }
        #ver-usuarios-list .table th {
            font-size: 0.6875rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            background: #f8fafc;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        #ver-usuarios-list .table td { font-size: 0.875rem; }
        #ver-usuarios-list .table th:nth-child(1),
        #ver-usuarios-list .table td:nth-child(1) { width: 20%; min-width: 72px; }
        #ver-usuarios-list .table th:nth-child(2),
        #ver-usuarios-list .table td:nth-child(2) { width: 36%; min-width: 120px; }
        #ver-usuarios-list .table th:nth-child(3),
        #ver-usuarios-list .table td:nth-child(3) { width: 18%; min-width: 64px; }
        #ver-usuarios-list .table th:nth-child(4),
        #ver-usuarios-list .table td:nth-child(4) { width: 26%; min-width: 108px; text-align: right; }
        #ver-usuarios-list .table td:nth-child(4) { vertical-align: middle; }
        #ver-usuarios-list .ver-usuarios-btn-desv {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 8px;
            border: 1px solid #fecaca;
            background: #fff;
            color: #b91c1c;
            cursor: pointer;
            font-family: inherit;
            white-space: nowrap;
        }
        #ver-usuarios-list .ver-usuarios-btn-desv:hover:not(:disabled) {
            background: #fef2f2;
            border-color: #f87171;
        }
        #ver-usuarios-list .ver-usuarios-btn-desv:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        #ver-usuarios-list .loading-text {
            padding: 20px 16px;
            text-align: center;
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
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
    <link rel="stylesheet" href="/hublabel/public/assets/css/admin-dropdown.css">
    <link rel="stylesheet" href="/hublabel/public/assets/css/admin-modals.css">
    <!-- Depois de dropdowns-global + select[class]: filtros clientes no dark -->
    <style>
        body.dark-mode #clientes-content select.clientes-filter-select,
        body.dark-mode #clientes-content select#filter-status,
        body.dark-mode #clientes-content select#filter-plano {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: #334155 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
        }

        body.dark-mode #clientes-content select.clientes-filter-select:hover,
        body.dark-mode #clientes-content select#filter-status:hover,
        body.dark-mode #clientes-content select#filter-plano:hover {
            background-color: #475569 !important;
            color: #f8fafc !important;
            -webkit-text-fill-color: #f8fafc !important;
        }

        body.dark-mode #clientes-content select.clientes-filter-select:focus,
        body.dark-mode #clientes-content select#filter-status:focus,
        body.dark-mode #clientes-content select#filter-plano:focus {
            outline: none !important;
            border-color: #6C63FF !important;
        }

        body.dark-mode #clientes-content select.clientes-filter-select option,
        body.dark-mode #clientes-content select#filter-status option,
        body.dark-mode #clientes-content select#filter-plano option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }

        /* Modal novo cliente: selects herdam fundo do .modal-nc-input-wrap (evita branco do select[class]) */
        body.dark-mode #criar-cliente-modal select#criar-plano,
        body.dark-mode #criar-cliente-modal select#criar-status {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: transparent !important;
            background-image: none !important;
            border: none !important;
            box-shadow: none !important;
            color: var(--dm-heading) !important;
            -webkit-text-fill-color: var(--dm-heading) !important;
        }

        body.dark-mode #criar-cliente-modal select#criar-plano option,
        body.dark-mode #criar-cliente-modal select#criar-status option {
            background-color: var(--dm-surface-solid) !important;
            color: var(--dm-text) !important;
        }

        /* Modais da aba Clientes sempre acima de qualquer camada da página */
        #criar-cliente-modal,
        #editar-cliente-modal,
        #mudar-plano-modal,
        #ver-usuarios-modal {
            z-index: 13050 !important;
        }

        /* Clientes: se o popup não couber na tela, rolar conteúdo interno */
        #criar-cliente-modal .modal-content.modal-nc,
        #editar-cliente-modal .modal-content.modal-nc {
            max-height: calc(100vh - 32px);
            display: flex;
            flex-direction: column;
        }

        #criar-cliente-modal .modal-nc-body,
        #editar-cliente-modal .modal-nc-body {
            overflow-y: auto;
        }

        /* Modal integração pagamento: select de plano no dark segue o input-wrap */
        body.dark-mode #modal-integracao-pagamento select#modalIntegPagPlano {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-color: transparent !important;
            background-image: none !important;
            border: none !important;
            box-shadow: none !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
        }

        body.dark-mode #modal-integracao-pagamento select#modalIntegPagPlano option {
            background-color: #0f172a !important;
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

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app-layout">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
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
                    <span class="menu-icon"><span class="material-symbols-rounded" aria-hidden="true">analytics</span></span>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon"><span class="material-symbols-rounded" aria-hidden="true">chat</span></span>
                    <span class="menu-text">Chat</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon"><span class="material-symbols-rounded" aria-hidden="true">network_intel_node</span></span>
                    <span class="menu-text">Agentes IA</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon"><span class="material-symbols-rounded" aria-hidden="true">view_kanban</span></span>
                    <span class="menu-text">CRM</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon"><span class="material-symbols-rounded" aria-hidden="true">qr_code</span></span>
                    <span class="menu-text">Conexões</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon"><span class="material-symbols-rounded" aria-hidden="true">send</span></span>
                    <span class="menu-text">Disparos</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon"><span class="material-symbols-rounded" aria-hidden="true">contacts</span></span>
                    <span class="menu-text">Contatos</span>
                </a>
                <div class="sidebar-nav-divider"></div>
                <a href="#" class="menu-item">
                    <span class="menu-icon"><span class="material-symbols-rounded" aria-hidden="true">help</span></span>
                    <span class="menu-text">Ajuda</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1 1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>
                    <span class="menu-text">Configurações</span>
                </a>
                <a href="#" class="menu-item menu-item-admin active">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">admin_panel_settings</span>
                    </span>
                    <span class="menu-text">Administração</span>
                    <span class="menu-badge-admin">Admin</span>
                </a>
            </nav>
            <div class="version-text" id="versaoAtualTexto">Versão atual: -</div>
            <div class="sidebar-footer">
                <div class="menu-item theme-toggle-item">
                    <span class="menu-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg></span>
                    <span class="menu-text" id="themeToggleText">Modo Escuro</span>
                    <label class="theme-switch"><input type="checkbox" id="darkModeToggle"><span class="slider"></span></label>
                </div>
                <a href="#" class="menu-item logout-item" id="admin-logout-btn">
                    <span class="menu-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16,17 21,12 16,7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg></span>
                    <span class="menu-text">Sair</span>
                </a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <div class="admin-main-content">
                <div class="admin-sticky-head">
                    <div class="header">
                        <div class="header-info">
                            <h1>Administração</h1>
                            <p>Controle financeiro, gestão de clientes e configurações do sistema SaaS.</p>
                        </div>
                    </div>
                    <nav class="nav-tabs" aria-label="Seções do painel">
                        <div class="nav-tabs-container">
                            <button type="button" id="dashboard-tab" class="nav-tab active">
                                <i class="fa-solid fa-chart-pie" aria-hidden="true"></i>
                                Dashboard
                            </button>
                            <button type="button" id="clientes-tab" class="nav-tab">
                                <i class="fa-solid fa-users" aria-hidden="true"></i>
                                Clientes
                            </button>
                            <button type="button" id="planos-tab" class="nav-tab">
                                <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                                Planos de Assinatura
                            </button>
                            <button type="button" id="integracao-pagamento-tab" class="nav-tab">
                                <i class="fa-solid fa-credit-card" aria-hidden="true"></i>
                                Integração de pagamento
                            </button>
                            <button type="button" id="emails-tab" class="nav-tab">
                                <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                                E-mails
                                <i id="emails-tab-warning-icon" class="fa-solid fa-triangle-exclamation emails-tab-warning-icon emails-hidden" aria-hidden="true"></i>
                            </button>
                            <button type="button" id="personalizacao-tab" class="nav-tab">
                                <i class="fa-solid fa-palette" aria-hidden="true"></i>
                                Personalização
                            </button>
                            <button type="button" id="pv-tab" class="nav-tab">
                                <i class="fa-solid fa-laptop-code" aria-hidden="true"></i>
                                Página de Vendas
                            </button>
                        </div>
                    </nav>
                </div>

                <div class="admin-page-body">

            <!-- Dashboard Tab -->
            <div id="dashboard-content" class="tab-content active">
                <div class="admin-info-block">
                    <div class="admin-info-block-inner">
                        <div class="admin-info-play" aria-hidden="true"><i class="fa-solid fa-play"></i></div>
                        <div>
                            <div class="admin-info-title">Guia Rápido do Painel Admin</div>
                            <p class="admin-info-sub">Assista a este vídeo de 3 minutos para dominar a gestão do seu SaaS.</p>
                        </div>
                    </div>
                    <a href="#" class="admin-info-link" id="admin-painel-video-link" role="button">Assistir Agora</a>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-title">Faturamento Mês</span>
                            <div class="stat-card-icon brand"><i class="fa-solid fa-dollar-sign"></i></div>
                        </div>
                        <div class="stat-kpi-money-row">
                            <span class="stat-kpi-currency">R$</span>
                            <span class="stat-kpi-amount" id="faturamento-amount">0,00</span>
                        </div>
                        <div class="stat-kpi-trend-row">
                            <span class="stat-kpi-trend-badge"><i class="fa-solid fa-arrow-trend-up"></i> +12%</span>
                            <span class="stat-kpi-trend-muted">vs mês passado</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-title">Ticket Médio / Cliente</span>
                            <div class="stat-card-icon blue"><i class="fa-solid fa-receipt"></i></div>
                        </div>
                        <div class="stat-kpi-money-row">
                            <span class="stat-kpi-currency">R$</span>
                            <span class="stat-kpi-amount" id="media-cliente-amount">0,00</span>
                        </div>
                        <p class="stat-kpi-foot">Receita Recorrente</p>
                    </div>

                    <div class="stat-card stat-card--clients-total">
                        <div class="stat-card-header">
                            <span class="stat-card-title">Total de Clientes</span>
                            <div class="stat-card-icon indigo"><i class="fa-solid fa-users"></i></div>
                        </div>
                        <div class="stat-kpi-money-row">
                            <span class="stat-kpi-amount-xl" id="total-clientes">0</span>
                        </div>
                        <div class="stat-clients-bar" title="Proporção de clientes ativos">
                            <div class="stat-clients-bar-seg stat-clients-bar-seg--active" id="stat-clients-bar-active" style="width: 0%;"></div>
                            <div class="stat-clients-bar-seg stat-clients-bar-seg--rest" id="stat-clients-bar-rest" style="width: 100%;"></div>
                        </div>
                    </div>

                    <div class="stat-card stat-card--accent">
                        <div class="stat-card-header">
                            <span class="stat-card-title">Clientes Ativos</span>
                            <div class="stat-card-icon brand"><i class="fa-solid fa-user-check"></i></div>
                        </div>
                        <div class="stat-kpi-money-row">
                            <span class="stat-kpi-amount-xl stat-kpi-amount--brand" id="clientes-ativos">0</span>
                        </div>
                        <p class="stat-kpi-foot" style="margin-top: 0.5rem;">Pagantes neste ciclo</p>
                    </div>
                </div>

                <div class="charts-grid">
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h3 class="chart-title">Aquisição de Clientes</h3>
                            <span class="chart-filter-pill">Este Ano <i class="fa-solid fa-chevron-down"></i></span>
                        </div>
                        <div class="chart-visual-area">
                            <div class="chart-grid-y" aria-hidden="true">
                                <div class="chart-grid-line"><span class="chart-grid-label" id="chart-acq-y-top">0</span></div>
                                <div class="chart-grid-line"><span class="chart-grid-label" id="chart-acq-y-mid">0</span></div>
                                <div class="chart-grid-line chart-grid-line--solid"><span class="chart-grid-label" id="chart-acq-y-bot">0</span></div>
                            </div>
                            <svg id="chart-acquisition-svg" class="chart-svg-acquisition" viewBox="0 0 1000 250" preserveAspectRatio="none" aria-hidden="true">
                                <path id="chart-acq-area" fill="currentColor" fill-opacity="0.1" d=""></path>
                                <path id="chart-acq-line" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" d=""></path>
                                <g id="chart-acq-dots"></g>
                            </svg>
                        </div>
                    </div>
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h3 class="chart-title">Faturamento por Mês</h3>
                            <div class="chart-legend-inline">
                                <span class="chart-legend-swatch"></span>
                                <span class="chart-legend-text">Receita (R$)</span>
                            </div>
                        </div>
                        <div class="chart-visual-area">
                            <div class="chart-grid-y" aria-hidden="true">
                                <div class="chart-grid-line"><span class="chart-grid-label chart-grid-label--wide" id="chart-bar-y-top">0</span></div>
                                <div class="chart-grid-line"><span class="chart-grid-label chart-grid-label--wide" id="chart-bar-y-mid">0</span></div>
                                <div class="chart-grid-line chart-grid-line--solid"><span class="chart-grid-label chart-grid-label--wide" id="chart-bar-y-bot">0</span></div>
                            </div>
                            <div class="chart-bars-row" id="chart-bars-container"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clientes Tab — layout alinhado ao gemini.html -->
            <div id="clientes-content" class="tab-content">
                <div class="clientes-page-wrap">
                    <div class="clientes-page-head">
                        <h2 class="clientes-page-title">Lista de Clientes</h2>
                        <button type="button" id="criar-cliente-btn" class="clientes-btn-create">
                            <i class="fa-solid fa-plus" aria-hidden="true"></i> Criar Cliente
                        </button>
                    </div>

                    <div class="clientes-list-stack">
                    <div class="clientes-toolbar">
                        <div class="clientes-toolbar-inner">
                            <div class="clientes-search-wrap">
                                <i class="fa-solid fa-search clientes-search-icon" aria-hidden="true"></i>
                                <input type="text" id="search-clientes" class="clientes-search-input" placeholder="Procurar clientes por email ou nome..." autocomplete="off">
                            </div>
                            <div id="clientes-bulk-bar" class="clientes-bulk-bar" hidden>
                                <span id="clientes-bulk-count" class="clientes-bulk-badge">0 selecionados</span>
                                <button type="button" class="clientes-bulk-btn" id="clientes-bulk-plano" disabled title="Selecione um único cliente">Alterar Plano</button>
                                <button type="button" class="clientes-bulk-btn clientes-bulk-btn--danger" id="clientes-bulk-block" disabled title="Em breve"><i class="fa-solid fa-ban" aria-hidden="true"></i> Bloquear</button>
                            </div>
                            <div id="clientes-filters-row" class="clientes-filters-row">
                                <div class="clientes-select-wrap">
                                    <select id="filter-status" class="clientes-filter-select" aria-label="Filtrar por estado">
                                        <option value="">Todos os estados</option>
                                        <option value="true">Ativos</option>
                                        <option value="false">Bloqueados</option>
                                        <option value="expirado">Expirados</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down clientes-select-chevron" aria-hidden="true"></i>
                                </div>
                                <div class="clientes-select-wrap">
                                    <select id="filter-plano" class="clientes-filter-select" aria-label="Filtrar por plano">
                                        <option value="">Todos os planos</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down clientes-select-chevron" aria-hidden="true"></i>
                                </div>
                                <button type="button" id="clientes-export-csv" class="clientes-export-btn" title="Exportar CSV" aria-label="Exportar CSV">
                                    <i class="fa-solid fa-download" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="clientes-table-card">
                        <div class="clientes-table-scroll">
                            <div class="clientes-table-x-scroll">
                            <table class="clientes-table">
                                <thead>
                                    <tr>
                                        <th class="clientes-th-check">
                                            <input type="checkbox" id="clientes-select-all" class="clientes-checkbox" aria-label="Selecionar todos nesta página">
                                        </th>
                                        <th>Cliente</th>
                                        <th>Plano</th>
                                        <th>Estado</th>
                                        <th>Período (Criação / Expiração)</th>
                                        <th class="clientes-th-actions">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="clientes-table-body"></tbody>
                            </table>
                            </div>
                        </div>
                        <div class="clientes-table-footer">
                            <span id="clientes-page-info" class="clientes-page-info"></span>
                            <div id="clientesPagination" class="clientes-pagination"></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Planos Tab — layout alinhado à lista de clientes -->
            <div id="planos-content" class="tab-content">
                <div class="planos-page-wrap">
                    <div class="planos-page-head">
                        <h2 class="planos-page-title">Planos de Assinatura</h2>
                        <div class="planos-page-head-actions">
                            <div class="planos-head-api-btns">
                                <button type="button" id="configurar-openai-btn" class="btn btn-openai btn-small">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142-.0852 4.783-2.7582a.7712.7712 0 0 0 .7806 0l5.8428 3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.4997-2.6067-1.4997Z"/>
                                    </svg>
                                    Configurar OpenAI
                                </button>
                                <button type="button" id="testar-openai-btn" class="btn btn-openai-test btn-small">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <polygon points="5,3 19,12 5,21 5,3"></polygon>
                                    </svg>
                                    Testar API
                                </button>
                            </div>
                            <button type="button" id="criar-plano-btn" class="planos-btn-create">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i> Criar Plano
                            </button>
                        </div>
                    </div>

                    <div class="planos-list-stack">
                        <div class="planos-toolbar">
                            <div class="planos-toolbar-inner">
                                <div class="planos-search-wrap">
                                    <i class="fa-solid fa-search planos-search-icon" aria-hidden="true"></i>
                                    <input type="text" id="search-planos" class="planos-search-input" placeholder="Procurar planos por nome..." autocomplete="off">
                                </div>
                                <div class="planos-filters-row">
                                    <div class="planos-select-wrap">
                                        <select id="filter-planos-preco" class="planos-filter-select" aria-label="Filtrar por preço">
                                            <option value="">Todos os preços</option>
                                            <option value="gratis">Gratuitos</option>
                                            <option value="pago">Pagos</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down planos-select-chevron" aria-hidden="true"></i>
                                    </div>
                                    <div class="planos-select-wrap">
                                        <select id="filter-planos-contas" class="planos-filter-select" aria-label="Filtrar por clientes vinculados">
                                            <option value="">Todos</option>
                                            <option value="com">Com clientes</option>
                                            <option value="sem">Sem clientes</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down planos-select-chevron" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="planos-table-card">
                            <div class="planos-table-scroll">
                                <div class="planos-table-x-scroll">
                                    <table class="planos-table">
                                        <thead>
                                            <tr>
                                                <th>Plano & Preço</th>
                                                <th>Limites Base</th>
                                                <th>Recursos Avançados</th>
                                                <th class="planos-th-actions">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="planos-table-body"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="planos-table-footer">
                                <span id="planos-page-info" class="planos-page-info"></span>
                                <div id="planosPagination" class="planos-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Página de Vendas Tab -->
            <div id="pv-content" class="tab-content">
                <div class="pv-page-wrap">
                    <div class="pv-page-head">
                        <div class="pv-page-title-row">
                            <h2 class="pv-page-title">Página de vendas</h2>
                            <span class="pv-title-badge">Beta</span>
                        </div>
                        <button type="button" id="criar-pv-btn" class="pv-btn-create">
                            <i class="fa-solid fa-plus" aria-hidden="true"></i>
                            Criar página de vendas
                        </button>
                    </div>
                    <div class="pv-main-card">
                        <div class="pv-main-card-inner">
                            <div id="pv-status" class="pv-status pv-status-empty">
                                <span id="pv-status-text">Nenhuma página de vendas criada ainda.</span>
                                <span id="pv-link-inline" class="pv-link-inline" style="display: none;">
                                    <span id="pv-link-text" class="pv-link-tag">
                                        https://app.chatconversa.app.br/pv
                                    </span>
                                    <button type="button" id="pv-link-copy-btn" class="pv-link-copy-btn" title="Copiar link">
                                        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                            <rect x="9" y="9" width="11" height="11" rx="2" ry="2" fill="none" stroke="currentColor" stroke-width="1.6"></rect>
                                            <rect x="4" y="4" width="11" height="11" rx="2" ry="2" fill="none" stroke="currentColor" stroke-width="1.6"></rect>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            <div id="pv-preview-wrapper" class="pv-preview-wrapper" style="display: none;">
                                <iframe id="pv-preview-iframe" class="pv-preview-frame" title="Preview página de vendas"></iframe>
                            </div>
                            <div class="pv-edit-block">
                                <div class="pv-section-head">
                                    <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
                                    Personalização com IA
                                </div>
                                <label for="pv-edit-instrucoes" class="pv-edit-label">Instruções para a IA</label>
                                <p class="pv-edit-helper">Descreva o que deseja alterar (cores, textos, seções, provas sociais, CTAs, etc.). A IA proporá uma nova versão com base nisso.</p>
                                <textarea id="pv-edit-instrucoes" class="form-input pv-edit-textarea" rows="4" placeholder="Ex.: Título mais direto para clínicas de estética; incluir depoimentos e FAQ."></textarea>
                                <div class="pv-edit-actions">
                                    <button type="button" id="pv-personalizar-btn" class="pv-btn-action">
                                        <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                        Personalizar
                                    </button>
                                    <span class="pv-edit-secondary">Será gerada uma pré-visualização antes de publicar.</span>
                                </div>
                                <div id="pv-editando-aviso" class="pv-editando-aviso">
                                    A página está sendo editada; pode demorar alguns minutos. Não feche nem saia desta página.
                                </div>
                            </div>
                            <div id="pv-nova-wrapper" class="pv-nova-wrapper" style="display: none;">
                                <h3 class="pv-nova-titulo"><span class="pv-nova-titulo-verde">Pré-visualização — nova versão</span></h3>
                                <div class="pv-nova-preview-wrapper">
                                    <iframe id="pv-nova-iframe" class="pv-nova-preview-frame" title="Preview nova página de vendas (IA)"></iframe>
                                </div>
                                <div class="pv-nova-actions">
                                    <button type="button" id="pv-publicar-btn" class="pv-btn-action">
                                        <i class="fa-solid fa-cloud-arrow-up" aria-hidden="true"></i>
                                        Publicar edições
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personalização -->
            <div id="personalizacao-content" class="tab-content">
                <div class="personalizacao-wrap">
                    <div class="personalizacao-head">
                        <div>
                            <h2 class="personalizacao-title">Personalização do Sistema</h2>
                            <p class="personalizacao-subtitle">Configure a identidade visual e os recursos de ajuda do seu SaaS (White-label).</p>
                        </div>
                        <button type="button" class="personalizacao-save-btn">
                            <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i>
                            Salvar Configurações
                        </button>
                    </div>

                    <div class="personalizacao-grid">
                        <div class="personalizacao-column">
                            <section class="personalizacao-card">
                                <h3 class="personalizacao-card-kicker">
                                    <i class="fa-solid fa-paintbrush" aria-hidden="true"></i>
                                    Identidade Visual
                                </h3>

                                <div class="personalizacao-field">
                                    <label class="personalizacao-label" for="personalizacao-nome-sistema">Nome do Sistema <span class="personalizacao-required">*</span></label>
                                    <input id="personalizacao-nome-sistema" type="text" value="IA Chatconversa" class="form-input">
                                </div>

                                <div class="personalizacao-field">
                                    <label class="personalizacao-label" for="personalizacao-cor-principal">Cor Principal (Hex) <span class="personalizacao-required">*</span></label>
                                    <div class="personalizacao-color-row">
                                        <div class="personalizacao-color-picker">
                                            <input id="personalizacao-cor-principal-picker" type="color" value="#6C63FF">
                                        </div>
                                        <input id="personalizacao-cor-principal" type="text" value="#6C63FF" class="form-input" style="text-transform: uppercase;">
                                    </div>
                                </div>

                                <div class="personalizacao-upload-grid">
                                    <div>
                                        <span class="personalizacao-upload-label">Logotipo</span>
                                        <input id="personalizacao-logo-file" type="file" accept="image/*" hidden>
                                        <div class="personalizacao-upload-box" id="personalizacao-logo-box" style="cursor: pointer;" title="Clique para trocar o logotipo">
                                            <img class="personalizacao-logo-preview" src="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/logo" alt="Logotipo atual">
                                            <span class="personalizacao-help">Clique para trocar o logotipo</span>
                                        </div>
                                        <a class="personalizacao-link-discreto" id="personalizacao-logo-link" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/logo" target="_blank" rel="noopener noreferrer">Ver link do logotipo</a>
                                    </div>
                                    <div>
                                        <span class="personalizacao-upload-label">Favicon</span>
                                        <input id="personalizacao-favicon-file" type="file" accept="image/png,image/x-icon,image/vnd.microsoft.icon,image/svg+xml,image/*" hidden>
                                        <div class="personalizacao-upload-box" id="personalizacao-favicon-box" style="cursor: pointer;" title="Clique para trocar o favicon">
                                            <img class="personalizacao-favicon-preview" src="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon" alt="Favicon atual">
                                            <span class="personalizacao-help">Clique para trocar o favicon</span>
                                        </div>
                                        <a class="personalizacao-link-discreto" id="personalizacao-favicon-link" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon" target="_blank" rel="noopener noreferrer">Ver link do favicon</a>
                                    </div>
                                </div>
                            </section>

                            <section class="personalizacao-card">
                                <h3 class="personalizacao-card-kicker is-blue">
                                    <i class="fa-solid fa-headset" aria-hidden="true"></i>
                                    Atendimento ao Cliente
                                </h3>

                                <div class="personalizacao-field">
                                    <label class="personalizacao-label" for="personalizacao-whatsapp">Telefone de Suporte (WhatsApp)</label>
                                    <input id="personalizacao-whatsapp" type="text" value="5591982448542" class="form-input" inputmode="numeric">
                                    <p class="personalizacao-help">Este número será exibido no botão de ajuda do painel dos seus clientes.</p>
                                </div>
                            </section>
                        </div>

                        <section class="personalizacao-card">
                            <h3 class="personalizacao-card-kicker is-indigo">
                                <i class="fa-solid fa-play" aria-hidden="true"></i>
                                Central de Ajuda (Vídeos)
                            </h3>
                            <p class="personalizacao-subtitle" style="margin-bottom: 1rem;">Substitua os links dos vídeos tutoriais padrão exibidos para os seus clientes (mesma lista da Central de ajuda).</p>

                            <div class="personalizacao-videos-list">
                                <article class="personalizacao-video-item">
                                    <div class="personalizacao-video-meta">
                                        <span class="personalizacao-video-icon is-slate"><i class="fa-solid fa-compass" aria-hidden="true"></i></span>
                                        <div class="personalizacao-video-text">
                                            <span class="personalizacao-video-category">Configurações</span>
                                            <h4 class="personalizacao-video-title">Introdução ao sistema</h4>
                                        </div>
                                    </div>
                                    <div class="personalizacao-video-input-wrap">
                                        <input type="url" class="form-input" value="https://youtu.be/8yEN7NP7Kn8">
                                        <button type="button" class="personalizacao-video-reset" title="Restaurar vídeo padrão"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></button>
                                    </div>
                                </article>

                                <article class="personalizacao-video-item">
                                    <div class="personalizacao-video-meta">
                                        <span class="personalizacao-video-icon is-indigo"><i class="fa-solid fa-robot" aria-hidden="true"></i></span>
                                        <div class="personalizacao-video-text">
                                            <span class="personalizacao-video-category">Agentes de IA</span>
                                            <h4 class="personalizacao-video-title">Como usar os Agentes de IA</h4>
                                        </div>
                                    </div>
                                    <div class="personalizacao-video-input-wrap">
                                        <input type="url" class="form-input" value="https://youtu.be/yA7v9oSFj4o">
                                        <button type="button" class="personalizacao-video-reset" title="Restaurar vídeo padrão"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></button>
                                    </div>
                                </article>

                                <article class="personalizacao-video-item">
                                    <div class="personalizacao-video-meta">
                                        <span class="personalizacao-video-icon is-green"><i class="fa-solid fa-user" aria-hidden="true"></i></span>
                                        <div class="personalizacao-video-text">
                                            <span class="personalizacao-video-category">Disparos</span>
                                            <h4 class="personalizacao-video-title">Como realizar disparos individuais</h4>
                                        </div>
                                    </div>
                                    <div class="personalizacao-video-input-wrap">
                                        <input type="url" class="form-input" value="https://youtu.be/XByuyUiQtpY">
                                        <button type="button" class="personalizacao-video-reset" title="Restaurar vídeo padrão"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></button>
                                    </div>
                                </article>

                                <article class="personalizacao-video-item">
                                    <div class="personalizacao-video-meta">
                                        <span class="personalizacao-video-icon is-blue"><i class="fa-solid fa-chart-line" aria-hidden="true"></i></span>
                                        <div class="personalizacao-video-text">
                                            <span class="personalizacao-video-category">CRM</span>
                                            <h4 class="personalizacao-video-title">Como usar o CRM</h4>
                                        </div>
                                    </div>
                                    <div class="personalizacao-video-input-wrap">
                                        <input type="url" class="form-input" value="https://youtu.be/rllnPi0H0ds">
                                        <button type="button" class="personalizacao-video-reset" title="Restaurar vídeo padrão"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></button>
                                    </div>
                                </article>

                                <article class="personalizacao-video-item">
                                    <div class="personalizacao-video-meta">
                                        <span class="personalizacao-video-icon is-teal"><i class="fa-regular fa-comments" aria-hidden="true"></i></span>
                                        <div class="personalizacao-video-text">
                                            <span class="personalizacao-video-category">Chat</span>
                                            <h4 class="personalizacao-video-title">Como utilizar o Chat MultiAtendimento</h4>
                                        </div>
                                    </div>
                                    <div class="personalizacao-video-input-wrap">
                                        <input type="url" class="form-input" value="https://youtu.be/leMXpkRJqvc">
                                        <button type="button" class="personalizacao-video-reset" title="Restaurar vídeo padrão"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></button>
                                    </div>
                                </article>

                                <article class="personalizacao-video-item">
                                    <div class="personalizacao-video-meta">
                                        <span class="personalizacao-video-icon is-fuchsia"><i class="fa-solid fa-link" aria-hidden="true"></i></span>
                                        <div class="personalizacao-video-text">
                                            <span class="personalizacao-video-category">Agentes de IA</span>
                                            <h4 class="personalizacao-video-title">Como abrir atendimento e notificar humano nos Agentes de IA</h4>
                                        </div>
                                    </div>
                                    <div class="personalizacao-video-input-wrap">
                                        <input type="url" class="form-input" value="https://youtu.be/s4zHukF_4ck">
                                        <button type="button" class="personalizacao-video-reset" title="Restaurar vídeo padrão"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></button>
                                    </div>
                                </article>

                                <article class="personalizacao-video-item">
                                    <div class="personalizacao-video-meta">
                                        <span class="personalizacao-video-icon is-indigo"><i class="fa-solid fa-screwdriver-wrench" aria-hidden="true"></i></span>
                                        <div class="personalizacao-video-text">
                                            <span class="personalizacao-video-category">Agentes de IA</span>
                                            <h4 class="personalizacao-video-title">Como usar ferramenta de requisição HTTP nos Agentes de IA</h4>
                                        </div>
                                    </div>
                                    <div class="personalizacao-video-input-wrap">
                                        <input type="url" class="form-input" value="https://youtu.be/7Qq_KRjaj4w">
                                        <button type="button" class="personalizacao-video-reset" title="Restaurar vídeo padrão"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></button>
                                    </div>
                                </article>

                                <article class="personalizacao-video-item">
                                    <div class="personalizacao-video-meta">
                                        <span class="personalizacao-video-icon is-slate"><i class="fa-solid fa-network-wired" aria-hidden="true"></i></span>
                                        <div class="personalizacao-video-text">
                                            <span class="personalizacao-video-category">Configurações</span>
                                            <h4 class="personalizacao-video-title">Como utilizar Webhook</h4>
                                        </div>
                                    </div>
                                    <div class="personalizacao-video-input-wrap">
                                        <input type="url" class="form-input" value="https://youtu.be/2eJkeBjsApI">
                                        <button type="button" class="personalizacao-video-reset" title="Restaurar vídeo padrão"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></button>
                                    </div>
                                </article>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <!-- Integração de pagamento -->
            <div id="integracao-pagamento-content" class="tab-content">
                <div class="planos-page-wrap">
                    <div class="planos-page-head">
                        <h2 class="planos-page-title">Integração de pagamento</h2>
                        <div class="planos-page-head-actions">
                            <button type="button" id="btn-tutorial-integracao-pagamento" class="emails-tutorial-tag" title="Abrir vídeo tutorial">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polygon points="10,8 16,12 10,16 10,8"></polygon></svg>
                                <span>Ver tutorial</span>
                            </button>
                            <button type="button" id="btn-nova-integracao-pagamento" class="planos-btn-create">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                Nova integração
                            </button>
                        </div>
                    </div>
                    <div class="planos-list-stack">
                        <div class="planos-toolbar">
                            <div class="planos-toolbar-inner integ-pag-toolbar-inner">
                                <p class="integ-pag-intro" style="display:none;"></p>
                                <div class="planos-search-wrap">
                                    <i class="fa-solid fa-search planos-search-icon" aria-hidden="true"></i>
                                    <input type="text" id="search-integ-pag" class="planos-search-input" placeholder="Procurar integrações..." autocomplete="off">
                                </div>
                                <span class="info-text" style="margin-top:0; white-space:nowrap;">
                                    Obs: Todo usuário é criado com a senha: <strong>Padrao123456</strong>
                                </span>
                            </div>
                        </div>
                        <div class="planos-table-card integ-pag-table-card">
                            <div class="planos-table-scroll">
                                <div class="integ-pag-list-inner">
                                    <div id="integ-pag-list-empty" class="integ-pag-list-empty">Nenhuma integração cadastrada</div>
                                    <div id="integ-pag-list" class="integ-pag-list" hidden></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- E-mails Tab -->
            <div id="emails-content" class="tab-content">
                <div id="emails-coming-soon" class="emails-coming-soon" style="display: none;">
                    <div class="emails-coming-soon-inner">
                        <div class="emails-coming-soon-icon">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <h3 class="emails-coming-soon-title">Em breve</h3>
                        <p class="emails-coming-soon-text">A configuração de e-mails e SMTP estará disponível em breve. Você poderá personalizar os templates de confirmação e redefinição de senha.</p>
                    </div>
                </div>
                <div id="emails-tab-content" style="display: block;">
                    <div class="emails-tab-layout">
                        <div class="emails-tab-main">
                            <div class="emails-top-header">
                                <div class="emails-top-header-title-row">
                                    <h3>Personalizar E-mails</h3>
                                    <div class="emails-tutorial-tag" id="emails-tutorial-tag" role="button" tabindex="0" title="Abrir vídeo tutorial">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="10,8 16,12 10,16 10,8"></polygon></svg>
                                        <span>Ver tutorial de configuração</span>
                                    </div>
                                </div>
                                <p>Configure o servidor de envio e os templates transacionais do sistema.</p>
                            </div>

                            <div class="emails-status-grid">
                                <div class="emails-status-card">
                                    <div class="emails-status-card-main">
                                        <div class="emails-status-icon"><i class="fa-solid fa-server" aria-hidden="true"></i></div>
                                        <div>
                                            <span class="emails-status-kicker">Servidor SMTP</span>
                                            <p class="emails-status-title">
                                                <span id="emails-smtp-provider-label">Não configurado</span>
                                                <span id="emails-smtp-status-pill" class="emails-status-pill is-muted">Pendente</span>
                                            </p>
                                        </div>
                                    </div>
                                    <button type="button" id="configurar-smtp-btn" class="emails-status-btn">Configurar</button>
                                </div>

                                <div class="emails-status-card">
                                    <div class="emails-status-card-main">
                                        <div class="emails-status-icon"><i class="fa-solid fa-database" aria-hidden="true"></i></div>
                                        <div>
                                            <span class="emails-status-kicker">Supabase API Token</span>
                                            <p class="emails-status-title">
                                                <span>Personal Access Token</span>
                                                <span id="emails-pat-status-pill" class="emails-status-pill is-muted">Pendente</span>
                                            </p>
                                        </div>
                                    </div>
                                    <button type="button" id="emails-token-focus-btn" class="emails-status-btn">Alterar Token</button>
                                </div>
                            </div>

                            <div class="emails-designer">
                                <aside class="emails-templates-nav">
                                    <p class="emails-templates-kicker">Templates de autenticação</p>
                                    <button type="button" id="email-template-confirmation" class="emails-template-item active" data-email-template="confirmation">
                                        <span class="emails-template-item-ico"><i class="fa-solid fa-user-check" aria-hidden="true"></i></span>
                                        <span>
                                            <span class="emails-template-item-title">Usuário criado</span>
                                            <span class="emails-template-item-desc">Novo usuário registrado</span>
                                        </span>
                                        <span id="email-template-confirmation-unsaved" class="emails-unsaved-badge emails-hidden">Não salvo</span>
                                    </button>
                                    <button type="button" id="email-template-recovery" class="emails-template-item" data-email-template="recovery">
                                        <span class="emails-template-item-ico"><i class="fa-solid fa-key" aria-hidden="true"></i></span>
                                        <span>
                                            <span class="emails-template-item-title">Reset de Senha</span>
                                            <span class="emails-template-item-desc">Recuperação de acesso</span>
                                        </span>
                                        <span id="email-template-recovery-unsaved" class="emails-unsaved-badge emails-hidden">Não salvo</span>
                                    </button>
                                </aside>

                                <section class="emails-editor-shell">
                                    <div class="emails-editor-head">
                                        <div>
                                            <h4 id="emails-editor-title">E-mail de novo usuário</h4>
                                            <p>Modelo para boas-vindas após novo cadastro. Use <strong>[Nome]</strong> e <strong>[Email]</strong>.</p>
                                        </div>
                                        <div class="emails-view-switch">
                                            <button type="button" id="emails-view-preview" class="emails-view-btn active">Preview Visual</button>
                                            <button type="button" id="emails-view-html" class="emails-view-btn"><i class="fa-solid fa-code" aria-hidden="true"></i> HTML</button>
                                        </div>
                                    </div>

                                    <div class="emails-editor-body">
                                        <div id="emails-panel-confirmation">
                                            <div id="email-confirmation-unsaved-alert" class="emails-unsaved-alert emails-hidden">
                                                <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                                                Este template está no padrão e ainda não foi salvo. Clique em <strong>Salvar Template</strong>.
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label emails-form-label" for="email-confirmation-subject">Assunto do E-mail</label>
                                                <input type="text" id="email-confirmation-subject" class="form-input" placeholder="Bem-vindo ao IA Chatconversa" value="Bem-vindo ao IA Chatconversa">
                                            </div>
                                            <div>
                                                <label class="form-label emails-form-label emails-form-label--upper">Variáveis disponíveis</label>
                                                <div class="emails-var-list">
                                                    <span class="emails-var-chip">[Nome]</span>
                                                    <span class="emails-var-chip">[Email]</span>
                                                </div>
                                            </div>
                                            <div id="email-confirmation-preview-wrap" class="emails-preview-wrap">
                                                <label class="form-label emails-form-label emails-form-label--preview">Corpo do E-mail (Preview)</label>
                                                <iframe id="email-confirmation-preview" class="emails-preview-frame" title="Preview e-mail novo usuário"></iframe>
                                            </div>
                                            <div id="html-wrap-confirmation" class="emails-html-wrap">
                                                <label class="form-label emails-form-label" for="email-confirmation-content">Código Fonte (HTML)</label>
                                                <textarea id="email-confirmation-content" class="form-input emails-html-field" rows="12"></textarea>
                                            </div>
                                        </div>

                                        <div id="emails-panel-recovery" class="emails-hidden">
                                            <div id="email-recovery-unsaved-alert" class="emails-unsaved-alert emails-hidden">
                                                <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                                                Este template está no padrão e ainda não foi salvo. Clique em <strong>Salvar Template</strong>.
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label emails-form-label" for="email-recovery-subject">Assunto do E-mail</label>
                                                <input type="text" id="email-recovery-subject" class="form-input" placeholder="Redefina sua senha">
                                            </div>
                                            <div>
                                                <label class="form-label emails-form-label emails-form-label--upper">Variáveis disponíveis</label>
                                                <div class="emails-var-list">
                                                    <span class="emails-var-chip">[ .ConfirmationURL ]</span>
                                                    <span class="emails-var-chip">[ .Token ]</span>
                                                    <span class="emails-var-chip">[ .SiteURL ]</span>
                                                    <span class="emails-var-chip">[ .Email ]</span>
                                                </div>
                                            </div>
                                            <div id="email-recovery-preview-wrap" class="emails-preview-wrap">
                                                <label class="form-label emails-form-label emails-form-label--preview">Corpo do E-mail (Preview)</label>
                                                <iframe id="email-recovery-preview" class="emails-preview-frame" title="Preview e-mail reset senha"></iframe>
                                            </div>
                                            <div id="html-wrap-recovery" class="emails-html-wrap">
                                                <label class="form-label emails-form-label" for="email-recovery-content">Código Fonte (HTML)</label>
                                                <textarea id="email-recovery-content" class="form-input emails-html-field" rows="12"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="emails-actions-row">
                                        <div class="emails-send-test-group">
                                            <input type="email" id="emails-test-dest-email" class="emails-test-dest-email" placeholder="E-mail destino do teste" autocomplete="email" aria-label="E-mail para envio de teste">
                                            <button type="button" id="emails-send-test-btn" class="emails-action-text"><i class="fa-regular fa-paper-plane" aria-hidden="true"></i> Enviar Teste</button>
                                        </div>
                                        <div style="display:flex; gap:10px;">
                                            <button type="button" id="toggle-html-confirmation" class="btn btn-secondary emails-html-toggle">Editar HTML</button>
                                            <button type="button" id="toggle-html-recovery" class="btn btn-secondary emails-html-toggle emails-hidden">Editar HTML</button>
                                            <button type="button" id="salvar-confirmacao-email" class="emails-save-btn">Salvar Template</button>
                                            <button type="button" id="salvar-recovery-email" class="emails-save-btn emails-hidden">Salvar Template</button>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Integração de pagamento -->
    <div id="modal-integracao-pagamento" class="modal modal-nc-overlay modal-shell-nc modal-shell-nc--wide" role="dialog" aria-modal="true" aria-labelledby="modal-integ-pag-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" id="fechar-modal-integ-pag" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <h2 class="modal-nc-title" id="modal-integ-pag-title">Nova integração de pagamento</h2>
                <p class="modal-nc-kicker">Webhook e mapeamento</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body modal-nc-body--integ-pag">
                <div class="modal-nc-body" style="padding: 16px 24px 0;">
                    <label class="modal-nc-label" for="modalIntegPagNome">Nome da integração <span class="modal-nc-req" aria-hidden="true">*</span></label>
                    <div class="modal-nc-input-wrap">
                        <i class="fa-solid fa-tag modal-nc-ico" aria-hidden="true"></i>
                        <input type="text" id="modalIntegPagNome" class="modal-nc-input" placeholder="Ex.: Hotmart — Plano Pro">
                    </div>
                </div>
                <div class="modal-integ-pag-grid">
                    <div class="modal-integ-pag-col">
                        <div class="integ-pag-kicker">URL do webhook</div>
                        <div class="integ-pag-url-row">
                            <div class="modal-nc-input-wrap modal-nc-input-wrap--readonly">
                                <input type="text" id="modalIntegPagUrl" class="modal-nc-input" readonly placeholder="URL gerada ao abrir">
                            </div>
                            <button type="button" class="modal-nc-btn-ghost" id="btnIntegPagCopyUrl" title="Copiar URL">Copiar</button>
                        </div>
                        <div class="integ-pag-teste-row">
                            <span class="integ-pag-kicker" style="margin: 0;">Payload (teste)</span>
                            <button type="button" class="integ-pag-btn-teste" id="btnIntegPagAtivarTeste">
                                <span class="integ-pag-teste-dot vermelho" aria-hidden="true"></span>
                                <span class="btn-integ-pag-teste-text">Desativado</span>
                            </button>
                            <button type="button" class="integ-pag-btn-atualizar" id="btnIntegPagAtualizarPayload">
                                <i class="fa-solid fa-rotate" aria-hidden="true"></i>
                                Atualizar
                            </button>
                        </div>
                        <div class="integ-pag-payload" id="modalIntegPagPayload"></div>
                    </div>
                    <div class="modal-integ-pag-col">
                        <div class="integ-pag-kicker">Mapeamento (arraste do payload)</div>
                        <p class="info-text" style="margin: 0 0 12px;">Campos padrão: nome, e-mail, telefone e plano do comprador.</p>
                        <div id="modalIntegPagFieldList">
                        <div class="modal-nc-field--full" style="margin-bottom: 14px;">
                            <label class="modal-nc-label" for="modalIntegPagFieldNome">Nome <span class="modal-nc-req">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <input type="text" id="modalIntegPagFieldNome" class="modal-nc-input integ-pag-map-input" data-integ-field="nome" placeholder="Caminho no JSON (ex.: buyer.name)">
                            </div>
                            <div class="integ-pag-field-path" id="modalIntegPagFieldNomePath"></div>
                        </div>
                        <div class="modal-nc-field--full" style="margin-bottom: 14px;">
                            <label class="modal-nc-label" for="modalIntegPagFieldEmail">E-mail <span class="modal-nc-req">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <input type="text" id="modalIntegPagFieldEmail" class="modal-nc-input integ-pag-map-input" data-integ-field="email" placeholder="Caminho no JSON">
                            </div>
                            <div class="integ-pag-field-path" id="modalIntegPagFieldEmailPath"></div>
                        </div>
                        <div class="modal-nc-field--full" style="margin-bottom: 14px;">
                            <label class="modal-nc-label" for="modalIntegPagFieldTelefone">Telefone <span class="modal-nc-req">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <input type="text" id="modalIntegPagFieldTelefone" class="modal-nc-input integ-pag-map-input" data-integ-field="telefone" placeholder="Caminho no JSON">
                            </div>
                            <div class="integ-pag-field-path" id="modalIntegPagFieldTelefonePath"></div>
                        </div>
                        <div class="modal-nc-field--full" style="margin-bottom: 14px;">
                            <label class="modal-nc-label" for="modalIntegPagFieldPlano">Plano</label>
                            <div class="modal-nc-input-wrap">
                                <input type="text" id="modalIntegPagFieldPlano" class="modal-nc-input integ-pag-map-input" data-integ-field="plano" placeholder="Caminho no JSON">
                            </div>
                            <div class="integ-pag-field-path" id="modalIntegPagFieldPlanoPath"></div>
                        </div>
                        </div>
                        <div class="modal-nc-field--full" style="margin-bottom: 14px;">
                            <label class="modal-nc-label" for="modalIntegPagPlano">Plano reserva</label>
                            <div class="modal-nc-input-wrap">
                                <select id="modalIntegPagPlano" class="modal-nc-select">
                                    <option value="">Selecione o plano</option>
                                </select>
                                <i class="fa-solid fa-chevron-down modal-nc-chevron" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="modal-nc-field--full" style="margin-bottom: 14px;">
                            <label class="modal-nc-label" for="modalIntegPagDiasValidade">Dias de validade</label>
                            <div class="modal-nc-input-wrap">
                                <input type="number" id="modalIntegPagDiasValidade" class="modal-nc-input" min="1" step="1" placeholder="Ex.: 30">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-footer" style="justify-content: space-between;">
                <button type="button" class="modal-nc-btn-ghost" id="btnIntegPagExcluir" style="color: #ef4444; border-color: rgba(239,68,68,0.35); display: none; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-trash" aria-hidden="true"></i> Excluir
                </button>
                <div style="display: flex; gap: 12px; margin-left: auto;">
                    <button type="button" class="modal-nc-btn-ghost" id="btnIntegPagCancelar">Cancelar</button>
                    <button type="button" class="modal-nc-btn-primary" id="btnIntegPagSalvar">
                        <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i>
                        <span class="modal-nc-btn-label">Salvar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal confirmação produção (Integração de pagamento) -->
    <div id="modal-integ-pag-confirm-producao" class="modal modal-nc-overlay modal-shell-nc" role="dialog" aria-modal="true" aria-labelledby="modal-integ-pag-confirm-producao-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" id="fechar-modal-integ-pag-confirm-producao" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <h2 class="modal-nc-title" id="modal-integ-pag-confirm-producao-title">Ativar em produção?</h2>
                <p class="modal-nc-kicker">Modo teste</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body">
                <p class="info-text" style="margin: 0;">Se confirmar, o modo teste será desativado e a integração ficará em produção.</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-footer" style="justify-content: flex-end;">
                <button type="button" class="modal-nc-btn-ghost" id="btnIntegPagConfirmProducaoCancelar">Manter teste</button>
                <button type="button" class="modal-nc-btn-primary" id="btnIntegPagConfirmProducaoAtivar">
                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                    <span class="modal-nc-btn-label">Ativar produção</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Cliente -->
    <div id="editar-cliente-modal" class="modal modal-nc-overlay modal-shell-nc" role="dialog" aria-modal="true" aria-labelledby="editar-cliente-modal-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" id="fechar-editar-cliente-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <h2 class="modal-nc-title" id="editar-cliente-modal-title">Editar cliente</h2>
                <p class="modal-nc-kicker">Atualizar dados da conta (e-mail e senha fixos)</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body">
                <form id="editar-cliente-form" novalidate>
                    <input type="hidden" id="editar-cliente-id">
                    <div class="modal-nc-grid">
                        <div class="modal-nc-field--full">
                            <label class="modal-nc-label" for="editar-nome">Nome completo <span class="modal-nc-req" aria-hidden="true">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <i class="fa-regular fa-user modal-nc-ico" aria-hidden="true"></i>
                                <input type="text" id="editar-nome" class="modal-nc-input" placeholder="Ex: João Silva" autocomplete="name" required>
                            </div>
                        </div>
                        <div>
                            <label class="modal-nc-label" for="editar-email">E-mail de login</label>
                            <div class="modal-nc-input-wrap modal-nc-input-wrap--readonly" title="O e-mail de login não pode ser alterado">
                                <i class="fa-regular fa-envelope modal-nc-ico" aria-hidden="true"></i>
                                <input type="email" id="editar-email" class="modal-nc-input" readonly autocomplete="off" aria-readonly="true">
                            </div>
                        </div>
                        <div>
                            <span class="modal-nc-label">Senha</span>
                            <div class="modal-nc-senha-lock" role="note">
                                <i class="fa-solid fa-lock" aria-hidden="true"></i>
                                <span>Não é possível alterar a senha aqui. Use redefinição por e-mail se necessário.</span>
                            </div>
                        </div>
                        <div class="modal-nc-field--full">
                            <label class="modal-nc-label" for="editar-telefone">Telefone</label>
                            <div class="modal-nc-input-wrap">
                                <i class="fa-solid fa-phone modal-nc-ico" aria-hidden="true"></i>
                                <input type="tel" id="editar-telefone" class="modal-nc-input" placeholder="5511912345678" autocomplete="tel">
                            </div>
                        </div>
                        <div>
                            <label class="modal-nc-label" for="editar-vencimento">Data de expiração <span class="modal-nc-req" aria-hidden="true">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <input type="date" id="editar-vencimento" class="modal-nc-input" required>
                                <i class="fa-regular fa-calendar-days modal-nc-ico" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div>
                            <label class="modal-nc-label" for="editar-status">Status da conta</label>
                            <div class="modal-nc-input-wrap modal-nc-status-wrap">
                                <span class="modal-nc-status-dot" id="editar-status-dot" aria-hidden="true"></span>
                                <select id="editar-status" class="modal-nc-select" aria-label="Status da conta">
                                    <option value="true">Ativo</option>
                                    <option value="false">Bloqueado</option>
                                </select>
                                <i class="fa-solid fa-chevron-down modal-nc-chevron" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-footer">
                <button type="button" id="cancelar-editar-cliente" class="modal-nc-btn-ghost">Cancelar</button>
                <button type="button" id="salvar-editar-cliente" class="modal-nc-btn-primary">
                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                    <span class="modal-nc-btn-label">Guardar alterações</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Criar Cliente -->
    <div id="criar-cliente-modal" class="modal modal-nc-overlay modal-shell-nc" role="dialog" aria-modal="true" aria-labelledby="criar-cliente-modal-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" id="fechar-criar-cliente-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <h2 class="modal-nc-title" id="criar-cliente-modal-title">Novo Cliente</h2>
                <p class="modal-nc-kicker">Adicionar acesso à plataforma</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body">
                <form id="criar-cliente-form" novalidate>
                    <div class="modal-nc-grid">
                        <div class="modal-nc-field--full">
                            <label class="modal-nc-label" for="criar-nome">Nome completo <span class="modal-nc-req" aria-hidden="true">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <i class="fa-regular fa-user modal-nc-ico" aria-hidden="true"></i>
                                <input type="text" id="criar-nome" class="modal-nc-input" placeholder="Ex: João Silva" autocomplete="name" required>
                            </div>
                        </div>
                        <div>
                            <label class="modal-nc-label" for="criar-email">E-mail de login <span class="modal-nc-req" aria-hidden="true">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <i class="fa-regular fa-envelope modal-nc-ico" aria-hidden="true"></i>
                                <input type="email" id="criar-email" class="modal-nc-input" placeholder="joao@email.com" autocomplete="email" required>
                            </div>
                        </div>
                        <div>
                            <label class="modal-nc-label" for="criar-senha">Senha <span class="modal-nc-req" aria-hidden="true">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <i class="fa-solid fa-key modal-nc-ico" aria-hidden="true"></i>
                                <input type="password" id="criar-senha" class="modal-nc-input" placeholder="••••••••" autocomplete="new-password" required>
                            </div>
                        </div>
                        <div class="modal-nc-field--full">
                            <label class="modal-nc-label" for="criar-telefone">Telefone</label>
                            <div class="modal-nc-input-wrap">
                                <i class="fa-solid fa-phone modal-nc-ico" aria-hidden="true"></i>
                                <input type="tel" id="criar-telefone" class="modal-nc-input" placeholder="5511912345678" autocomplete="tel">
                            </div>
                        </div>
                        <div>
                            <label class="modal-nc-label" for="criar-plano">Plano de assinatura <span class="modal-nc-req" aria-hidden="true">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <select id="criar-plano" class="modal-nc-select" required aria-label="Plano de assinatura">
                                    <option value="">Selecione um plano</option>
                                </select>
                                <i class="fa-solid fa-chevron-down modal-nc-chevron" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div>
                            <label class="modal-nc-label" for="criar-vencimento">Data de expiração <span class="modal-nc-req" aria-hidden="true">*</span></label>
                            <div class="modal-nc-input-wrap">
                                <input type="date" id="criar-vencimento" class="modal-nc-input" required>
                                <i class="fa-regular fa-calendar-days modal-nc-ico" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="modal-nc-field--full">
                            <label class="modal-nc-label" for="criar-status">Status da conta</label>
                            <div class="modal-nc-input-wrap modal-nc-status-wrap">
                                <span class="modal-nc-status-dot" id="criar-status-dot" aria-hidden="true"></span>
                                <select id="criar-status" class="modal-nc-select" aria-label="Status da conta">
                                    <option value="true">Ativo</option>
                                    <option value="false">Bloqueado</option>
                                </select>
                                <i class="fa-solid fa-chevron-down modal-nc-chevron" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-footer">
                <button type="button" id="cancelar-criar-cliente" class="modal-nc-btn-ghost">Cancelar</button>
                <button type="button" id="salvar-criar-cliente" class="modal-nc-btn-primary">
                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                    <span class="modal-nc-btn-label">Guardar Cliente</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Mudar Plano -->
    <div id="mudar-plano-modal" class="modal modal-nc-overlay modal-shell-nc" role="dialog" aria-modal="true" aria-labelledby="mudar-plano-modal-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" id="fechar-mudar-plano-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <h2 class="modal-nc-title" id="mudar-plano-modal-title">Mudar plano</h2>
                <p class="modal-nc-kicker">Atualizar assinatura do cliente</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body">
                <form id="mudar-plano-form">
                    <input type="hidden" id="mudar-plano-cliente-id">
                    <div class="modal-nc-field--full">
                        <label class="modal-nc-label" for="novo-plano">Novo plano <span class="modal-nc-req" aria-hidden="true">*</span></label>
                        <div class="modal-nc-input-wrap">
                            <select id="novo-plano" class="modal-nc-select" required aria-label="Novo plano">
                                <option value="">Selecione um plano</option>
                            </select>
                            <i class="fa-solid fa-chevron-down modal-nc-chevron" aria-hidden="true"></i>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-footer">
                <button type="button" id="cancelar-mudar-plano" class="modal-nc-btn-ghost">Cancelar</button>
                <button type="button" id="salvar-mudar-plano" class="modal-nc-btn-primary">
                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                    <span class="modal-nc-btn-label">Aplicar plano</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Criar Plano -->
    <div id="criar-plano-modal" class="modal modal-np-overlay modal-plano-np" role="dialog" aria-modal="true" aria-labelledby="criar-plano-modal-title">
        <div class="modal-content modal-np">
            <button type="button" class="modal-np-close" id="fechar-criar-plano-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-np-header">
                <h2 class="modal-np-title" id="criar-plano-modal-title">Novo Plano</h2>
                <p class="modal-np-kicker">Definir limites e recursos do pacote</p>
            </div>
            <div class="modal-np-divider" aria-hidden="true"></div>
            <div class="modal-np-body">
                <form id="criar-plano-form">
                    <div class="modal-np-section">
                        <div class="modal-np-section-head modal-np-section-head--green">
                            <i class="fa-solid fa-tag" aria-hidden="true"></i>
                            Informações base
                        </div>
                        <div class="modal-np-grid2">
                            <div>
                                <label class="modal-np-lbl" for="criar-plano-nome">Nome do plano <span class="modal-np-req" aria-hidden="true">*</span></label>
                                <div class="modal-np-field">
                                    <input type="text" id="criar-plano-nome" class="modal-np-input" placeholder="Ex: Diamond" autocomplete="off">
                                </div>
                            </div>
                            <div>
                                <label class="modal-np-lbl" for="criar-plano-preco">Preço mensal <span class="modal-np-req" aria-hidden="true">*</span></label>
                                <div class="modal-np-field modal-np-field--prefix">
                                    <span class="modal-np-prefix">R$</span>
                                    <input type="number" id="criar-plano-preco" class="modal-np-input" step="0.01" placeholder="0,00" inputmode="decimal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-np-divider modal-np-divider--section" aria-hidden="true"></div>
                    <div class="modal-np-section">
                        <div class="modal-np-section-head modal-np-section-head--blue">
                            <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                            Limites do sistema
                        </div>
                        <div class="modal-np-cards">
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-mobile-screen" aria-hidden="true"></i>
                                    Conexões
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="criar-plano-conexoes" class="modal-np-input" value="1" placeholder="Ex: 5" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-conexoes-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-oculta-conexoes"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-address-book" aria-hidden="true"></i>
                                    Contatos máx.
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="criar-plano-contatos" class="modal-np-input" value="1000" placeholder="Ex: 1000" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-contatos-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-oculta-contatos"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                                    Disparos / mês
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="criar-plano-disparos" class="modal-np-input" value="5000" placeholder="Ex: 5000" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-disparos-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-oculta-disparos"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-users" aria-hidden="true"></i>
                                    Usuários
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="criar-plano-usuarios" class="modal-np-input" value="1" placeholder="Ex: 3" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-usuarios-ilimitado"> Ilimitado</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-np-divider modal-np-divider--section" aria-hidden="true"></div>
                    <div class="modal-np-section">
                        <div class="modal-np-section-head modal-np-section-head--purple">
                            <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
                            Recursos inteligentes
                        </div>
                        <div class="modal-np-cards">
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-table-columns" aria-hidden="true"></i>
                                    Quadros CRM
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="criar-plano-quadros-crm" class="modal-np-input" value="1" placeholder="Ex: 3" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-quadros-crm-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-oculta-crm"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-robot" aria-hidden="true"></i>
                                    Agentes IA
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="criar-plano-agentes" class="modal-np-input" value="1" placeholder="Ex: 2" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-agentes-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-oculta-agentes-ia"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-bolt modal-np-ico-amber" aria-hidden="true"></i>
                                    Créditos IA
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="criar-plano-creditos" class="modal-np-input" value="1000" placeholder="Ex: 1000" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="criar-plano-creditos-ilimitado"> Ilimitado</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-np-creditos-extra">
                            <div id="custo-creditos-criar" class="custo-creditos-tag"></div>
                            <div class="creditos-info-block" style="margin-top: 10px;">
                                <span class="creditos-info-icon" aria-hidden="true">ℹ️</span>
                                <p class="creditos-info-texto">No modelo intermediário gpt5 mini 1 mensagem custa em média 2 créditos.</p>
                            </div>
                            <div class="calcular-mensagens-wrap" style="margin-top: 12px;">
                                <button type="button" id="toggle-calcular-mensagens-criar" class="btn-toggle-calcular-mensagens" aria-expanded="false">
                                    <span class="btn-toggle-text">Calcular quantidade de mensagens</span>
                                    <svg class="btn-toggle-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                                <div id="calcular-mensagens-content-criar" class="calcular-mensagens-content" hidden>
                                    <div class="form-group" style="margin-bottom: 12px;">
                                        <label class="form-label" style="font-size: 13px;">Modelo de IA</label>
                                        <select id="modelo-ia-criar">
                                            <option value="0.20">gpt-5-nano</option>
                                            <option value="1.00" selected>gpt-5-mini</option>
                                            <option value="5.00">gpt-5</option>
                                            <option value="60.00">gpt-5-pro</option>
                                            <option value="0.31">gpt-4.1-nano</option>
                                            <option value="1.22">gpt-4.1-mini</option>
                                            <option value="6.12">gpt-4.1</option>
                                            <option value="0.46">gpt-4o-mini</option>
                                            <option value="7.65">gpt-4o</option>
                                        </select>
                                    </div>
                                    <div id="resultado-mensagens-criar" class="resultado-mensagens resultado-mensagens-destaque"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-np-ajuda-row">
                        <label class="modal-np-mini"><input type="checkbox" id="criar-plano-oculta-ajuda"> Ocultar ajuda</label>
                    </div>
                </form>
            </div>
            <div class="modal-np-footer">
                <button type="button" id="cancelar-criar-plano" class="modal-np-btn-ghost">Cancelar</button>
                <button type="button" id="salvar-criar-plano" class="modal-np-btn-primary">
                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                    <span class="modal-np-btn-label">Criar plano</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Plano -->
    <div id="editar-plano-modal" class="modal modal-np-overlay modal-plano-np" role="dialog" aria-modal="true" aria-labelledby="editar-plano-modal-title">
        <div class="modal-content modal-np">
            <button type="button" class="modal-np-close" id="fechar-editar-plano-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-np-header">
                <h2 class="modal-np-title" id="editar-plano-modal-title">Editar plano</h2>
                <p class="modal-np-kicker">Definir limites e recursos do pacote</p>
            </div>
            <div class="modal-np-divider" aria-hidden="true"></div>
            <div class="modal-np-body">
                <form id="editar-plano-form">
                    <input type="hidden" id="editar-plano-id">
                    <div class="modal-np-section">
                        <div class="modal-np-section-head modal-np-section-head--green">
                            <i class="fa-solid fa-tag" aria-hidden="true"></i>
                            Informações base
                        </div>
                        <div class="modal-np-grid2">
                            <div>
                                <label class="modal-np-lbl" for="editar-plano-nome">Nome do plano <span class="modal-np-req" aria-hidden="true">*</span></label>
                                <div class="modal-np-field">
                                    <input type="text" id="editar-plano-nome" class="modal-np-input" placeholder="Ex: Diamond" autocomplete="off">
                                </div>
                            </div>
                            <div>
                                <label class="modal-np-lbl" for="editar-plano-preco">Preço mensal <span class="modal-np-req" aria-hidden="true">*</span></label>
                                <div class="modal-np-field modal-np-field--prefix">
                                    <span class="modal-np-prefix">R$</span>
                                    <input type="number" id="editar-plano-preco" class="modal-np-input" step="0.01" placeholder="0,00" inputmode="decimal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-np-divider modal-np-divider--section" aria-hidden="true"></div>
                    <div class="modal-np-section">
                        <div class="modal-np-section-head modal-np-section-head--blue">
                            <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                            Limites do sistema
                        </div>
                        <div class="modal-np-cards">
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-mobile-screen" aria-hidden="true"></i>
                                    Conexões
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="editar-plano-conexoes" class="modal-np-input" placeholder="Ex: 5" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-conexoes-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-oculta-conexoes"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-address-book" aria-hidden="true"></i>
                                    Contatos máx.
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="editar-plano-contatos" class="modal-np-input" placeholder="Ex: 1000" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-contatos-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-oculta-contatos"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                                    Disparos / mês
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="editar-plano-disparos" class="modal-np-input" placeholder="Ex: 5000" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-disparos-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-oculta-disparos"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-users" aria-hidden="true"></i>
                                    Usuários
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="editar-plano-usuarios" class="modal-np-input" placeholder="Ex: 3" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-usuarios-ilimitado"> Ilimitado</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-np-divider modal-np-divider--section" aria-hidden="true"></div>
                    <div class="modal-np-section">
                        <div class="modal-np-section-head modal-np-section-head--purple">
                            <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
                            Recursos inteligentes
                        </div>
                        <div class="modal-np-cards">
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-table-columns" aria-hidden="true"></i>
                                    Quadros CRM
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="editar-plano-quadros-crm" class="modal-np-input" placeholder="Ex: 3" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-quadros-crm-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-oculta-crm"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-robot" aria-hidden="true"></i>
                                    Agentes IA
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="editar-plano-agentes" class="modal-np-input" placeholder="Ex: 2" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-agentes-ilimitado"> Ilimitado</label>
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-oculta-agentes-ia"> Ocultar</label>
                                </div>
                            </div>
                            <div class="modal-np-card">
                                <div class="modal-np-card-head">
                                    <i class="fa-solid fa-bolt modal-np-ico-amber" aria-hidden="true"></i>
                                    Créditos IA
                                </div>
                                <div class="modal-np-field">
                                    <input type="number" id="editar-plano-creditos" class="modal-np-input" placeholder="Ex: 1000" min="0">
                                </div>
                                <div class="modal-np-card-foot">
                                    <label class="modal-np-mini"><input type="checkbox" id="editar-plano-creditos-ilimitado"> Ilimitado</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-np-creditos-extra">
                            <div id="custo-creditos-editar" class="custo-creditos-tag"></div>
                            <div class="creditos-info-block" style="margin-top: 10px;">
                                <span class="creditos-info-icon" aria-hidden="true">ℹ️</span>
                                <p class="creditos-info-texto">No modelo intermediário gpt5 mini 1 mensagem custa em média 2 créditos.</p>
                            </div>
                            <div class="calcular-mensagens-wrap" style="margin-top: 12px;">
                                <button type="button" id="toggle-calcular-mensagens-editar" class="btn-toggle-calcular-mensagens" aria-expanded="false">
                                    <span class="btn-toggle-text">Calcular quantidade de mensagens</span>
                                    <svg class="btn-toggle-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                                <div id="calcular-mensagens-content-editar" class="calcular-mensagens-content" hidden>
                                    <div class="form-group" style="margin-bottom: 12px;">
                                        <label class="form-label" style="font-size: 13px;">Modelo de IA</label>
                                        <select id="modelo-ia-editar">
                                            <option value="0.20">gpt-5-nano</option>
                                            <option value="1.00" selected>gpt-5-mini</option>
                                            <option value="5.00">gpt-5</option>
                                            <option value="60.00">gpt-5-pro</option>
                                            <option value="0.31">gpt-4.1-nano</option>
                                            <option value="1.22">gpt-4.1-mini</option>
                                            <option value="6.12">gpt-4.1</option>
                                            <option value="0.46">gpt-4o-mini</option>
                                            <option value="7.65">gpt-4o</option>
                                        </select>
                                    </div>
                                    <div id="resultado-mensagens-editar" class="resultado-mensagens resultado-mensagens-destaque"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-np-ajuda-row">
                        <label class="modal-np-mini"><input type="checkbox" id="editar-plano-oculta-ajuda"> Ocultar ajuda</label>
                    </div>
                </form>
            </div>
            <div class="modal-np-footer">
                <button type="button" id="excluir-editar-plano" class="modal-np-btn-danger">
                    <i class="fa-solid fa-trash" aria-hidden="true"></i>
                    Excluir plano
                </button>
                <button type="button" id="cancelar-editar-plano" class="modal-np-btn-ghost">Cancelar</button>
                <button type="button" id="salvar-editar-plano" class="modal-np-btn-primary">
                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                    <span class="modal-np-btn-label">Guardar plano</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Exclusão -->
    <div id="confirmar-exclusao-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div style="display: flex; align-items: center;">
                    <i class="fas fa-exclamation-triangle" style="color: #ef4444; margin-right: 8px;"></i>
                    <h3 class="modal-title" id="confirmar-exclusao-titulo">Confirmar Exclusão</h3>
                </div>
            </div>
            <div class="modal-body">
                <p id="confirmar-exclusao-mensagem">
                    Tem certeza que deseja excluir este item? Esta ação não pode ser desfeita.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelar-exclusao" class="btn btn-secondary">Cancelar</button>
                <button type="button" id="confirmar-exclusao" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </div>

    <!-- Modal Configurar OpenAI -->
    <div id="configurar-openai-modal" class="modal modal-nc-overlay modal-shell-nc" role="dialog" aria-modal="true" aria-labelledby="configurar-openai-modal-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" id="fechar-configurar-openai-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <div class="modal-nc-title-with-ico">
                    <svg class="modal-nc-openai-logo" width="32" height="32" viewBox="0 0 24 24" fill="#10a37f" aria-hidden="true">
                        <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142-.0852 4.783-2.7582a.7712.7712 0 0 0 .7806 0l5.8428 3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.4997-2.6067-1.4997Z"/>
                    </svg>
                    <h2 class="modal-nc-title" id="configurar-openai-modal-title">Configurar OpenAI</h2>
                </div>
                <p class="modal-nc-kicker">Chave da API para funcionalidades de IA na plataforma</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body">
                <form id="configurar-openai-form">
                    <div class="modal-nc-field--full">
                        <label class="modal-nc-label" for="openai-apikey-input">Chave de API <span class="modal-nc-req" aria-hidden="true">*</span></label>
                        <div class="modal-nc-input-wrap">
                            <i class="fa-solid fa-key modal-nc-ico" aria-hidden="true"></i>
                            <input type="password" id="openai-apikey-input" class="modal-nc-input" placeholder="sk-..." required autocomplete="off">
                        </div>
                        <p class="info-text">Insira sua chave de API da OpenAI. Ela será armazenada de forma segura.</p>
                    </div>
                </form>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-footer">
                <button type="button" id="cancelar-configurar-openai" class="modal-nc-btn-ghost">Cancelar</button>
                <button type="button" id="salvar-configurar-openai" class="modal-nc-btn-openai">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142-.0852 4.783-2.7582a.7712.7712 0 0 0 .7806 0l5.8428 3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.4997-2.6067-1.4997Z"/>
                    </svg>
                    Salvar chave
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Aviso OpenAI -->
    <div id="aviso-openai-modal" class="modal modal-nc-overlay modal-shell-nc" role="dialog" aria-modal="true" aria-labelledby="aviso-openai-modal-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" id="fechar-aviso-openai-btn" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <div>
                    <h2 class="modal-nc-title openai-alert-title-wrap" id="aviso-openai-modal-title">
                        <svg class="openai-logo" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142-.0852 4.783-2.7582a.7712.7712 0 0 0 .7806 0l5.8428 3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.4997-2.6067-1.4997Z"/>
                        </svg>
                        Configurar OpenAI
                    </h2>
                    <p class="modal-nc-kicker openai-alert-kicker">Atenção: API key inválida ou não configurada</p>
                </div>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body">
                <div class="openai-alert-surface">
                    <svg class="openai-alert-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                    <p class="openai-alert-message">
                        Insira uma API key válida da OpenAI para que seus clientes possam usar os agentes de inteligência artificial.
                    </p>
                </div>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-footer modal-nc-footer--end">
                <button type="button" id="inserir-agora-btn" class="modal-nc-btn-openai">Inserir agora</button>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Plano ao Cliente -->
    <div id="adicionar-plano-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Adicionar Plano</h3>
            </div>
            <div class="modal-body">
                <form id="adicionar-plano-form">
                    <input type="hidden" id="adicionar-plano-user-id">
                    <div class="form-group">
                        <label class="form-label">Selecione o plano:</label>
                        <select id="adicionar-plano-select" class="form-select">
                            <option value="">Selecione um plano</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelar-adicionar-plano" class="btn btn-secondary">Cancelar</button>
                <button type="button" id="salvar-adicionar-plano" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Bloqueio -->
    <div id="confirmar-bloqueio-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div style="display: flex; align-items: center;">
                    <i class="fas fa-exclamation-triangle" style="color: #f59e0b; margin-right: 8px;"></i>
                    <h3 class="modal-title" id="confirmar-bloqueio-titulo">Confirmar Bloqueio</h3>
                </div>
            </div>
            <div class="modal-body">
                <p id="confirmar-bloqueio-mensagem">
                    Tem certeza que deseja bloquear este usuário? Ele perderá o acesso ao sistema.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelar-bloqueio" class="btn btn-secondary">Cancelar</button>
                <button type="button" id="confirmar-bloqueio" class="btn btn-danger">Bloquear</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Desbloqueio -->
    <div id="confirmar-desbloqueio-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div style="display: flex; align-items: center;">
                    <i class="fas fa-check-circle" style="color: #22c55e; margin-right: 8px;"></i>
                    <h3 class="modal-title" id="confirmar-desbloqueio-titulo">Confirmar Desbloqueio</h3>
                </div>
            </div>
            <div class="modal-body">
                <p id="confirmar-desbloqueio-mensagem">
                    Tem certeza que deseja desbloquear este usuário? Ele recuperará o acesso ao sistema.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelar-desbloqueio" class="btn btn-secondary">Cancelar</button>
                <button type="button" id="confirmar-desbloqueio" class="btn btn-success">Desbloquear</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Resetar Créditos -->
    <div id="confirmar-resetar-creditos-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div style="display: flex; align-items: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" style="margin-right: 8px;">
                        <path d="M1 4v6h6"></path>
                        <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                    </svg>
                    <h3 class="modal-title">Confirmar Resetar Créditos</h3>
                </div>
            </div>
            <div class="modal-body">
                <p id="confirmar-resetar-creditos-mensagem">
                    Tem certeza que deseja zerar os tokens do cliente? Esta ação não pode ser desfeita.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelar-resetar-creditos" class="btn btn-secondary">Cancelar</button>
                <button type="button" id="confirmar-resetar-creditos" class="btn btn-warning">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Exclusão de Plano -->
    <div id="confirmar-exclusao-plano-modal" class="modal">
        <div class="modal-content" style="border: 2px solid #dc2626; background: rgba(220, 38, 38, 0.95); backdrop-filter: blur(10px);">
            <div class="modal-header" style="background: rgba(220, 38, 38, 0.95); border-bottom: 2px solid #dc2626;">
                <div style="display: flex; align-items: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" style="margin-right: 8px;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <h3 class="modal-title" style="color: #ffffff; font-weight: 700;">Confirmar Exclusão</h3>
                </div>
            </div>
            <div class="modal-body" style="background: rgba(220, 38, 38, 0.1);">
                <p style="color: #ffffff; font-weight: 600; margin-bottom: 16px; font-size: 16px;">
                    ⚠️ Esta ação é irreversível! O plano será permanentemente excluído.
                </p>
                <p style="color: #ffffff; margin-bottom: 16px; font-size: 14px;">
                    Para confirmar a exclusão, digite o nome do plano:
                </p>
                <div class="form-group">
                    <label class="form-label" style="color: #ffffff; font-weight: 600;">Nome do plano:</label>
                    <input type="text" id="confirmar-nome-exclusao-plano" class="form-input" placeholder="Digite o nome do plano" required style="background: rgba(255, 255, 255, 0.9); color: #1a1a1a; border: 2px solid #ffffff;">
                </div>
                <div style="background: rgba(255, 255, 255, 0.2); border: 2px solid #ffffff; border-radius: 8px; padding: 12px; margin-top: 16px;">
                    <p style="color: #ffffff; font-size: 14px; margin: 0; font-weight: 600;">
                        <strong>Nome do plano:</strong> <span id="nome-plano-exclusao"></span>
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="background: rgba(220, 38, 38, 0.95); border-top: 2px solid #dc2626;">
                <button type="button" id="cancelar-exclusao-plano" class="btn btn-secondary" style="background: #6b7280; color: #ffffff; border: 2px solid #6b7280;">Cancelar</button>
                <button type="button" id="confirmar-exclusao-plano" class="btn btn-danger" disabled style="background: #dc2626; color: #ffffff; border: 2px solid #ffffff; font-weight: 700;">Excluir</button>
            </div>
        </div>
    </div>

    <!-- Modal Transferir Usuários antes de Excluir Plano -->
    <div id="transferir-plano-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div style="display: flex; align-items: center;">
                    <i class="fas fa-people-arrows" style="color: #2563eb; margin-right: 8px;"></i>
                    <h3 class="modal-title">Transferir usuários de plano</h3>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="transferir-plano-origem-id">
                <p id="transferir-plano-mensagem" style="margin-bottom: 14px;">
                    Este plano possui usuários. Selecione um plano de destino para transferir todos e concluir a exclusão.
                </p>
                <div class="form-group">
                    <label class="form-label" for="transferir-plano-destino">Plano de destino</label>
                    <select id="transferir-plano-destino" class="form-select">
                        <option value="">Selecione um plano</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelar-transferir-plano" class="btn btn-secondary">Cancelar</button>
                <button type="button" id="confirmar-transferir-plano" class="btn btn-primary">Transferir e excluir</button>
            </div>
        </div>
    </div>

    <!-- Modal Ver Usuários da Conta -->
    <div id="ver-usuarios-modal" class="modal modal-nc-overlay modal-shell-nc" role="dialog" aria-modal="true" aria-labelledby="ver-usuarios-modal-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" id="fechar-ver-usuarios-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <h2 class="modal-nc-title" id="ver-usuarios-modal-title">Usuários da conta</h2>
                <p class="modal-nc-kicker">Membros com acesso a esta conta</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body">
                <div id="ver-usuarios-list">
                    <p class="loading-text">Carregando...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Vídeo Tutorial Painel Administração -->
    <div id="admin-painel-video-modal" class="modal modal-nc-overlay modal-shell-nc modal-video-shell" role="dialog" aria-modal="true" aria-labelledby="admin-painel-video-modal-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" data-close="admin-painel-video-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <h2 class="modal-nc-title" id="admin-painel-video-modal-title">Tutorial: Painel de Administração</h2>
                <p class="modal-nc-kicker">Assista ao guia em vídeo</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body modal-nc-body--video">
                <div id="admin-painel-video-container" class="video-wrapper" style="display: none;">
                    <iframe id="admin-painel-video-iframe" title="Vídeo tutorial painel de administração" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div id="admin-painel-video-placeholder" class="video-placeholder">
                    O link do vídeo será adicionado em breve.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Vídeo Tutorial E-mails -->
    <div id="emails-tutorial-video-modal" class="modal modal-nc-overlay modal-shell-nc modal-video-shell" role="dialog" aria-modal="true" aria-labelledby="emails-tutorial-video-modal-title">
        <div class="modal-content modal-nc">
            <button type="button" class="modal-nc-close" data-close="emails-tutorial-video-modal" aria-label="Fechar">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-nc-header">
                <h2 class="modal-nc-title" id="emails-tutorial-video-modal-title">Tutorial: Configurar e-mails</h2>
                <p class="modal-nc-kicker">Guia em vídeo para a aba de e-mails</p>
            </div>
            <div class="modal-nc-divider" aria-hidden="true"></div>
            <div class="modal-nc-body modal-nc-body--video">
                <div id="emails-tutorial-video-container" class="video-wrapper" style="display: none;">
                    <iframe id="emails-tutorial-iframe" title="Vídeo tutorial configuração de e-mails" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div id="emails-tutorial-video-placeholder" class="video-placeholder">
                    O link do vídeo será adicionado em breve.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Configurar SMTP (layout gemini.html) -->
    <div id="configurar-smtp-modal" class="email-gm-modal-root" role="dialog" aria-modal="true" aria-labelledby="configurar-smtp-modal-title" style="display: none;">
        <div class="email-gm-modal-backdrop" data-close="configurar-smtp-modal" aria-hidden="true"></div>
        <div class="email-gm-modal-dialog email-gm-modal-dialog--wide">
            <div class="email-gm-modal-header">
                <div class="email-gm-modal-header-main">
                    <div class="email-gm-modal-header-ico" aria-hidden="true"><i class="fa-solid fa-server"></i></div>
                    <div>
                        <h2 class="email-gm-modal-title" id="configurar-smtp-modal-title">Configurar SMTP</h2>
                        <p class="email-gm-modal-kicker">Servidor de envio (SendGrid, Resend, etc.)</p>
                    </div>
                </div>
                <button type="button" class="email-gm-modal-close" data-close="configurar-smtp-modal" aria-label="Fechar"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="email-gm-modal-body email-gm-modal-body--surface">
                <div class="email-gm-modal-stack">
                    <div>
                        <h3 class="email-gm-modal-section-title"><i class="fa-regular fa-id-badge" aria-hidden="true"></i> Identificação do Remetente</h3>
                        <div class="email-gm-modal-grid-2">
                            <div>
                                <label class="email-gm-label" for="smtp-admin-email">E-mail Remetente (From)</label>
                                <input type="email" id="smtp-admin-email" class="email-gm-input" placeholder="no-reply@seudominio.com" autocomplete="off">
                            </div>
                            <div>
                                <label class="email-gm-label" for="smtp-sender-name">Nome do Remetente</label>
                                <input type="text" id="smtp-sender-name" class="email-gm-input" placeholder="Nome do App SaaS" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <hr class="email-gm-modal-divider" aria-hidden="true">
                    <div>
                        <h3 class="email-gm-modal-section-title email-gm-modal-section-title--blue"><i class="fa-solid fa-network-wired" aria-hidden="true"></i> Credenciais do Servidor</h3>
                        <div class="email-gm-modal-grid-3">
                            <div class="email-gm-field-span2">
                                <label class="email-gm-label" for="smtp-host">Servidor/Host SMTP</label>
                                <input type="text" id="smtp-host" class="email-gm-input email-gm-input--mono" placeholder="smtp.sendgrid.net" autocomplete="off">
                            </div>
                            <div>
                                <label class="email-gm-label" for="smtp-port">Porta</label>
                                <input type="number" id="smtp-port" class="email-gm-input email-gm-input--mono" placeholder="587" value="587" autocomplete="off">
                            </div>
                        </div>
                        <div class="email-gm-modal-grid-2">
                            <div>
                                <label class="email-gm-label" for="smtp-user">Usuário SMTP</label>
                                <input type="text" id="smtp-user" class="email-gm-input email-gm-input--mono" placeholder="apikey" autocomplete="off">
                            </div>
                            <div>
                                <label class="email-gm-label" for="smtp-pass">Senha SMTP / API Key</label>
                                <input type="password" id="smtp-pass" class="email-gm-input email-gm-input--mono" placeholder="••••••••••••••••" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="email-gm-modal-footer">
                <div class="email-gm-footer-actions">
                    <button type="button" id="cancelar-smtp" class="email-gm-btn-cancel" data-close="configurar-smtp-modal">Cancelar</button>
                    <button type="button" id="salvar-smtp" class="email-gm-btn-primary">Salvar SMTP</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Token Supabase PAT (layout gemini.html) -->
    <div id="modal-supabase-pat" class="email-gm-modal-root" role="dialog" aria-modal="true" aria-labelledby="modal-supabase-pat-title" style="display: none;">
        <div class="email-gm-modal-backdrop" data-close="modal-supabase-pat" aria-hidden="true"></div>
        <div class="email-gm-modal-dialog">
            <div class="email-gm-modal-body email-gm-modal-body--padonly">
                <div class="email-gm-modal-header-ico email-gm-modal-header-ico--emerald" aria-hidden="true"><i class="fa-solid fa-database"></i></div>
                <h2 class="email-gm-modal-title" id="modal-supabase-pat-title" style="margin-bottom: 8px;">Token de Acesso Supabase</h2>
                <p class="email-gm-modal-intro">
                    Para alterar os templates de e-mail dinamicamente, precisamos do seu <strong>Personal Access Token (PAT)</strong>.
                    <a href="https://supabase.com/dashboard/account/tokens" target="_blank" rel="noopener">Gerar token no Supabase <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:10px;"></i></a>
                </p>
                <div>
                    <label class="email-gm-label-pat" for="supabase-pat">Token PAT</label>
                    <input type="password" id="supabase-pat" class="email-gm-input-pat" placeholder="sbp_xxxxxxxxxxxxxxxxxxxxxxxx" autocomplete="off">
                    <p class="email-gm-pat-hint"><i class="fa-solid fa-lock" aria-hidden="true"></i> Armazenado de forma segura no banco.</p>
                </div>
            </div>
            <div class="email-gm-modal-footer email-gm-modal-footer--end">
                <div class="email-gm-footer-actions">
                    <button type="button" id="cancelar-supabase-pat" class="email-gm-btn-cancel" data-close="modal-supabase-pat">Cancelar</button>
                    <button type="button" id="salvar-supabase-pat" class="email-gm-btn-primary">Salvar Token</button>
                </div>
            </div>
        </div>
    </div>

    
<!-- scripts removidos para manter somente HTML + CSS -->

<script src="/hublabel/public/assets/js/menu-global.js"></script>
<script src="/hublabel/public/assets/js/pages/admin.js"></script>

</body>
</html>
