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
    <title>Chat - IA Chatconversa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="shortcut icon" type="image/png" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <link rel="apple-touch-icon" href="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/favicon">
    <!-- Google Fonts: Plus Jakarta Sans (igual ao dashboard) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Material Symbols Rounded (view_kanban etc.) — FILL 0, wght 400, GRAD 0, opsz 24 -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
    <style>
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
            color: white;
        }

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

        /* Sidebar: itens menores em telas com pouca altura (igual dashboard) */
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

        /* Chat Container */
        .chat-container {
            display: flex;
            width: 100%;
            height: 100vh;
            margin-left: 72px;
            background: transparent;
        }

        body.light-mode .chat-container {
            background: rgba(255, 255, 255, 0.98);
        }

        /* Conversations List - design gemini.html */
        .conversations-list {
            width: 360px;
            max-width: 400px;
            background: #fff;
            border-right: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        body.light-mode .conversations-list {
            background: #fff;
            border-right: 1px solid #e2e8f0;
        }

        body:not(.light-mode) .conversations-list {
            background: rgba(30, 41, 59, 0.6);
            border-right: 1px solid rgba(71, 85, 105, 0.4);
        }

        .conversations-panel {
            padding: 24px 24px 8px;
            flex-shrink: 0;
        }

        .conversations-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .conversations-header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .conversations-new-chat-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: #6C63FF;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.15s ease, box-shadow 0.15s ease, filter 0.15s ease;
            box-shadow: 0 2px 8px rgba(108, 99, 255, 0.35);
        }

        .conversations-new-chat-btn:hover {
            background: #6C63FF;
            filter: brightness(1.08);
            transform: scale(1.06);
            box-shadow: 0 4px 16px rgba(108, 99, 255, 0.5), 0 0 0 3px rgba(108, 99, 255, 0.18);
        }

        .conversations-new-chat-btn svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
        }

        .new-conv-mode-tabs {
            display: flex;
            gap: 6px;
            margin-bottom: 16px;
        }

        .new-conv-tab {
            flex: 1;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(0, 0, 0, 0.04);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            color: #475569;
            font-family: inherit;
        }

        body.dark-mode .new-conv-tab {
            border-color: rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
            color: #cbd5e1;
        }

        .new-conv-tab.active {
            background: rgba(108, 99, 255, 0.18);
            border-color: rgba(108, 99, 255, 0.45);
            color: #6C63FF;
        }

        body.dark-mode .new-conv-tab.active {
            color: #6C63FF;
        }

        .new-conv-contacts-list {
            max-height: min(240px, 40vh);
            overflow-y: auto;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #f8fafc;
            margin-top: 8px;
        }

        body.dark-mode .new-conv-contacts-list {
            border-color: rgba(71, 85, 105, 0.5);
            background: rgba(15, 23, 42, 0.5);
        }

        .new-conv-contact-row {
            width: 100%;
            text-align: left;
            padding: 12px 14px;
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            background: transparent;
            cursor: pointer;
            font-family: inherit;
            display: block;
        }

        body.dark-mode .new-conv-contact-row {
            border-bottom-color: rgba(255, 255, 255, 0.06);
        }

        .new-conv-contact-row:last-child {
            border-bottom: none;
        }

        .new-conv-contact-row:hover {
            background: rgba(108, 99, 255, 0.08);
        }

        .new-conv-contact-row.selected {
            background: rgba(108, 99, 255, 0.2);
        }

        .new-conv-contact-name {
            display: block;
            font-weight: 600;
            font-size: 0.92rem;
            color: #0f172a;
        }

        body.dark-mode .new-conv-contact-name {
            color: #f1f5f9;
        }

        .new-conv-contact-phone {
            display: block;
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 2px;
        }

        .new-conv-contacts-empty {
            padding: 20px;
            text-align: center;
            color: #94a3b8;
            font-size: 0.88rem;
        }

        .new-conv-selected-hint {
            font-size: 0.82rem;
            color: #64748b;
            margin-top: 10px;
            min-height: 1.2em;
        }

        body.dark-mode .new-conv-selected-hint {
            color: #94a3b8;
        }

        .save-contact-modal-overlay .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
            color: #18181b;
            font-size: 0.95rem;
            font-family: inherit;
            box-sizing: border-box;
        }

        body.dark-mode .save-contact-modal-overlay .form-select {
            background: #ffffff !important;
            border-color: rgba(0, 0, 0, 0.2) !important;
            color: #000000 !important;
        }

        .new-conv-phone-row {
            display: flex;
            gap: 10px;
            align-items: stretch;
        }

        .new-conv-phone-row .form-select.phone-ddi {
            flex: 0 0 88px;
        }

        .new-conv-phone-row .form-input.phone-full {
            flex: 1;
            min-width: 0;
        }

        .conversations-title {
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: #0f172a;
        }

        body:not(.light-mode) .conversations-title {
            color: #f8fafc;
        }

        .conversations-filter-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f8fafc;
            border: none;
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s;
        }

        .conversations-filter-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        body:not(.light-mode) .conversations-filter-btn {
            background: rgba(255, 255, 255, 0.08);
            color: #94a3b8;
        }

        body:not(.light-mode) .conversations-filter-btn:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #e2e8f0;
        }

        .conversations-filter-btn[aria-expanded="true"] {
            background: rgba(108, 99, 255, 0.22);
            color: #6C63FF;
        }
        body:not(.light-mode) .conversations-filter-btn[aria-expanded="true"] {
            background: rgba(108, 99, 255, 0.2);
            color: #6C63FF;
        }
        /* Indicador quando há filtros ativos e o painel está fechado */
        .conversations-filter-btn.conversations-filter-btn--has-active-filters[aria-expanded="false"]::after {
            content: '';
            position: absolute;
            top: 5px;
            right: 5px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #6C63FF;
            box-shadow: 0 0 0 2px #f8fafc;
            pointer-events: none;
        }
        body:not(.light-mode) .conversations-filter-btn.conversations-filter-btn--has-active-filters[aria-expanded="false"]::after {
            background: #6C63FF;
            box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.92);
        }

        .conversations-filters-panel {
            display: none;
            overflow: hidden;
            margin: 8px 0 14px;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: rgba(248, 250, 252, 0.98);
            box-shadow: 0 1px 4px rgba(15, 23, 42, 0.05);
        }
        body:not(.light-mode) .conversations-filters-panel {
            border-color: rgba(255, 255, 255, 0.12);
            background: rgba(15, 23, 42, 0.45);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
        }
        .conversations-filters-panel.open {
            display: block;
        }
        .conversations-filters-inner {
            padding: 10px 12px 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            max-height: min(46vh, 300px);
            overflow-y: auto;
        }
        .conversations-filters-inner .chat-filter-field-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #64748b;
            margin-bottom: 2px;
        }
        body:not(.light-mode) .conversations-filters-inner .chat-filter-field-label {
            color: rgba(255, 255, 255, 0.55);
        }
        .chat-filter-accordion {
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.07);
            background: rgba(255, 255, 255, 0.65);
            overflow: hidden;
        }
        body:not(.light-mode) .chat-filter-accordion {
            border-color: rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.04);
        }
        .chat-filter-accordion-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 6px 10px;
            margin: 0;
            border: none;
            background: transparent;
            cursor: pointer;
            font: inherit;
            text-align: left;
            color: #0f172a;
            transition: background 0.15s ease;
        }
        body:not(.light-mode) .chat-filter-accordion-toggle {
            color: #f1f5f9;
        }
        .chat-filter-accordion-toggle:hover {
            background: rgba(0, 0, 0, 0.04);
        }
        body:not(.light-mode) .chat-filter-accordion-toggle:hover {
            background: rgba(255, 255, 255, 0.06);
        }
        .chat-filter-accordion.is-open .chat-filter-accordion-toggle {
            background: rgba(108, 99, 255, 0.08);
        }
        body:not(.light-mode) .chat-filter-accordion.is-open .chat-filter-accordion-toggle {
            background: rgba(108, 99, 255, 0.12);
        }
        .chat-filter-accordion-label-wrap {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        .chat-filter-accordion-title {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            color: #64748b;
            line-height: 1.25;
        }
        body:not(.light-mode) .chat-filter-accordion-title {
            color: rgba(255, 255, 255, 0.55);
        }
        .chat-filter-accordion-summary {
            font-size: 0.65rem;
            font-weight: 500;
            color: #6C63FF;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
            margin-top: 1px;
        }
        body:not(.light-mode) .chat-filter-accordion-summary {
            color: #6C63FF;
        }
        .chat-filter-accordion-summary:empty {
            display: none;
        }
        .chat-filter-accordion-icon {
            flex-shrink: 0;
            width: 14px;
            height: 14px;
            color: #94a3b8;
            transition: transform 0.2s ease;
        }
        body:not(.light-mode) .chat-filter-accordion-icon {
            color: rgba(255, 255, 255, 0.45);
        }
        .chat-filter-accordion.is-open .chat-filter-accordion-icon {
            transform: rotate(180deg);
        }
        .chat-filter-accordion-body {
            padding: 0 8px 8px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .chat-filter-accordion-body[hidden] {
            display: none !important;
        }
        .chat-filter-crm-chosen-bar[hidden] {
            display: none !important;
        }
        #chatFilterEtapasSection[hidden] {
            display: none !important;
        }
        #chatFilterEtapasSection {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .chat-filter-crm-etapas-picker-wrap[hidden] {
            display: none !important;
        }
        .chat-filter-crm-chosen-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            flex-wrap: nowrap;
            padding: 5px 8px;
            border-radius: 7px;
            border: 1px solid rgba(108, 99, 255, 0.3);
            background: rgba(108, 99, 255, 0.06);
            font-size: 0.72rem;
            font-weight: 600;
            color: #166534;
        }
        body:not(.light-mode) .chat-filter-crm-chosen-bar {
            color: #6C63FF;
            border-color: rgba(74, 222, 128, 0.35);
            background: rgba(108, 99, 255, 0.12);
        }
        .chat-filter-crm-change-quadro-btn {
            flex-shrink: 0;
            width: 28px;
            height: 28px;
            padding: 0;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: #fff;
            cursor: pointer;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }
        .chat-filter-crm-change-quadro-btn svg {
            width: 14px;
            height: 14px;
        }
        .chat-filter-crm-change-quadro-btn:hover {
            background: #f1f5f9;
            color: #6C63FF;
            border-color: rgba(108, 99, 255, 0.35);
        }
        body:not(.light-mode) .chat-filter-crm-change-quadro-btn {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.18);
            color: #cbd5e1;
        }
        body:not(.light-mode) .chat-filter-crm-change-quadro-btn:hover {
            background: rgba(255, 255, 255, 0.14);
            color: #6C63FF;
            border-color: rgba(74, 222, 128, 0.35);
        }
        .chat-filter-quadro-name {
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .chat-filter-checkboxes label.chat-filter-quadro-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            cursor: pointer;
            color: #334155;
        }
        body:not(.light-mode) .chat-filter-checkboxes label.chat-filter-quadro-label {
            color: rgba(255, 255, 255, 0.9);
        }
        .chat-filter-checkboxes label.chat-filter-conexao-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            cursor: pointer;
            color: #334155;
        }
        body:not(.light-mode) .chat-filter-checkboxes label.chat-filter-conexao-label {
            color: rgba(255, 255, 255, 0.9);
        }
        .chat-filter-accordion--has-value .chat-filter-accordion-title {
            color: #6C63FF;
        }
        body:not(.light-mode) .chat-filter-accordion--has-value .chat-filter-accordion-title {
            color: #6C63FF;
        }
        .chat-filter-etiqueta-mode {
            display: flex;
            flex-wrap: wrap;
            gap: 4px 12px;
            font-size: 0.68rem;
            margin-bottom: 2px;
        }
        .chat-filter-etiqueta-mode label {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            color: #334155;
        }
        .chat-filter-etiqueta-mode input[type="radio"] {
            width: 12px;
            height: 12px;
            margin: 0;
            flex-shrink: 0;
        }
        body:not(.light-mode) .chat-filter-etiqueta-mode label {
            color: rgba(255, 255, 255, 0.85);
        }
        /* ~4 linhas visíveis; restante com scroll */
        .chat-filter-scroll-5 {
            max-height: calc(4 * (1.2em + 4px) + 10px);
            overflow-y: auto;
            overflow-x: hidden;
        }
        .chat-filter-checkboxes {
            display: flex;
            flex-direction: column;
            gap: 3px;
            padding: 5px 7px;
            border-radius: 7px;
            border: 1px solid rgba(0, 0, 0, 0.07);
            background: #fff;
        }
        body:not(.light-mode) .chat-filter-checkboxes {
            border-color: rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
        }
        .chat-filter-checkboxes label,
        .chat-filter-checkboxes .chat-filter-etiqueta-label,
        .chat-filter-checkboxes .chat-filter-etapa-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            line-height: 1.25;
            cursor: pointer;
            color: #334155;
        }
        .chat-filter-checkboxes input[type="checkbox"],
        .chat-filter-checkboxes input[type="radio"] {
            width: 13px;
            height: 13px;
            margin: 0;
            flex-shrink: 0;
        }
        body:not(.light-mode) .chat-filter-checkboxes label,
        body:not(.light-mode) .chat-filter-checkboxes .chat-filter-etiqueta-label,
        body:not(.light-mode) .chat-filter-checkboxes .chat-filter-etapa-label {
            color: rgba(255, 255, 255, 0.9);
        }
        .chat-filter-checkboxes .chat-filter-etapa-name {
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .chat-filter-etiquetas-search-wrap {
            margin-bottom: 4px;
        }
        .chat-filter-etiquetas-search-wrap[hidden] {
            display: none !important;
        }
        .chat-filter-tag-search-input {
            width: 100%;
            box-sizing: border-box;
            padding: 5px 8px;
            font-size: 0.72rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: #fff;
            color: #334155;
            outline: none;
        }
        .chat-filter-tag-search-input:focus {
            border-color: #6C63FF;
        }
        body:not(.light-mode) .chat-filter-tag-search-input {
            border-color: rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.08);
            color: #f1f5f9;
        }
        .chat-filter-hint {
            font-size: 0.68rem;
            color: #94a3b8;
            line-height: 1.35;
        }
        body:not(.light-mode) .chat-filter-hint {
            color: rgba(255, 255, 255, 0.45);
        }
        .conexao-filter-select--in-panel {
            width: 100%;
        }
        /* Lista com ~5 linhas + scroll nativo do <select> */
        select.conexao-filter-select.chat-filter-select-scroll-5 {
            width: 100%;
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            line-height: 1.35;
            padding: 6px 10px;
            border-radius: 10px;
            min-height: calc(5 * 1.35em + 14px);
        }

        .conversations-search-wrap {
            position: relative;
            margin-bottom: 16px;
        }

        .conversations-search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .conversations-search-input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #0f172a;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .conversations-search-input::placeholder {
            color: #94a3b8;
        }

        .conversations-search-input:focus {
            border-color: #6C63FF;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        body:not(.light-mode) .conversations-search-input {
            background: rgba(15, 23, 42, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
            color: #e2e8f0;
        }

        body:not(.light-mode) .conversations-search-input:focus {
            border-color: #6C63FF;
        }

        .conversations-conexao-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        .conexao-filter-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            white-space: nowrap;
        }
        body:not(.light-mode) .conexao-filter-label {
            color: #94a3b8;
        }

        /* Status filters - pill (gemini) */
        .conversations-status-filters {
            display: flex;
            background: #f8fafc;
            padding: 6px;
            border-radius: 1rem;
            margin-bottom: 8px;
        }
        body:not(.light-mode) .conversations-status-filters {
            background: rgba(15, 23, 42, 0.5);
        }
        .conversations-status-filters .status-filter-btn {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            padding: 8px 6px 10px;
            border: none;
            border-radius: 12px;
            background: transparent;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }
        .conversations-status-filters .status-filter-btn:hover {
            color: #0f172a;
            background: rgba(255,255,255,0.7);
        }
        .conversations-status-filters .status-filter-btn.active {
            background: #fff;
            color: #0f172a;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }
        .conversations-status-filters .status-filter-btn.active .status-count {
            font-weight: 800;
            border-bottom: 2px solid #0f172a;
        }
        body:not(.light-mode) .conversations-status-filters .status-filter-btn {
            color: #94a3b8;
        }
        body:not(.light-mode) .conversations-status-filters .status-filter-btn:hover {
            color: #e2e8f0;
            background: rgba(255,255,255,0.05);
        }
        body:not(.light-mode) .conversations-status-filters .status-filter-btn.active {
            background: rgba(51,65,85,0.6);
            color: #f8fafc;
        }
        body:not(.light-mode) .conversations-status-filters .status-filter-btn.active .status-count {
            border-bottom-color: #f8fafc;
        }
        .conversations-status-filters .status-label { display: block; }
        .conversation-agente-ia-tag {
            flex-shrink: 0;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 999px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.22), rgba(139, 92, 246, 0.18));
            color: #a5b4fc;
            border: 1px solid rgba(129, 140, 248, 0.35);
        }
        body.light-mode .conversation-agente-ia-tag {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.12), rgba(139, 92, 246, 0.1));
            color: #4f46e5;
            border-color: rgba(99, 102, 241, 0.25);
        }
        .conversations-status-filters .status-count {
            display: block;
            font-size: 0.625rem;
            font-weight: 600;
            margin-top: 2px;
        }

        .conexao-filter-select {
            min-width: 100px;
            padding: 6px 28px 6px 12px;
            background: #fff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px;
            color: #000000 !important;
            font-size: 0.75rem;
            font-weight: 700;
            outline: none;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 10px center !important;
        }
        .conexao-filter-select option { background: #fff !important; color: #000000 !important; }
        body:not(.light-mode) .conexao-filter-select {
            background-color: #ffffff !important;
            border-color: rgba(0, 0, 0, 0.2) !important;
            color: #000000 !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 10px center !important;
        }
        body:not(.light-mode) .conexao-filter-select option {
            background: #ffffff !important;
            color: #000000 !important;
        }

        /* Legacy search-input fallback (input usa .conversations-search-input) */
        .search-input {
            width: 100%;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            font-size: 0.9rem;
            outline: none;
        }

        body.light-mode .search-input {
            background: rgba(0, 0, 0, 0.05);
            color: #333;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .search-input::placeholder {
            color: #888;
        }

        body.light-mode .search-input::placeholder {
            color: #999;
        }

        .conversations-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 8px 0 80px;
        }

        /* Conversation items - design gemini */
        .conversation-item {
            padding: 4px 16px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .conversation-item > .conversation-item-inner {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px;
            border-radius: 1rem;
            transition: background 0.2s ease;
        }

        .conversation-item:hover .conversation-item-inner {
            background: #f8fafc;
        }

        body:not(.light-mode) .conversation-item:hover .conversation-item-inner {
            background: rgba(255, 255, 255, 0.05);
        }

        .conversation-item.active .conversation-item-inner {
            background: rgba(108, 99, 255, 0.1);
            border: 1px solid rgba(108, 99, 255, 0.2);
        }

        body:not(.light-mode) .conversation-item.active .conversation-item-inner {
            background: rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.25);
        }

        .conversation-avatar-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .conversation-item.active .conversation-avatar-wrap::before {
            content: '';
            position: absolute;
            left: -13px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 32px;
            background: #6C63FF;
            border-radius: 0 4px 4px 0;
        }

        .conversation-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #6C63FF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
            flex-shrink: 0;
            margin-right: 15px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        
        .conversation-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .conversation-info {
            flex: 1;
            min-width: 0;
        }

        .conversation-name-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            margin-bottom: 4px;
            min-width: 0;
        }

        .conversation-name-block {
            display: flex;
            align-items: center;
            gap: 4px;
            min-width: 0;
            flex: 1;
        }
        .conversation-name-block .conversation-name {
            flex: 1;
            min-width: 0;
        }

        .conversation-preview-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            min-width: 0;
        }
        .conversation-name {
            font-size: 0.875rem;
            font-weight: 700;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 0;
            flex: 1;
        }

        body:not(.light-mode) .conversation-name {
            color: #f8fafc;
        }
        .conversation-conexao-tag {
            flex-shrink: 0;
            font-size: 0.5625rem;
            font-weight: 500;
            color: #64748b;
            padding: 2px 6px;
            border-radius: 6px;
            background: #f1f5f9;
        }
        body:not(.light-mode) .conversation-conexao-tag {
            background: rgba(255, 255, 255, 0.1);
            color: #94a3b8;
        }

        body.light-mode .conversation-name {
            color: #333;
        }

        .conversation-preview {
            font-size: 0.75rem;
            font-weight: 500;
            color: #475569;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 0;
        }

        body:not(.light-mode) .conversation-preview {
            color: #94a3b8;
        }

        .conversation-item.active .conversation-name {
            color: #064e3b;
        }

        body:not(.light-mode) .conversation-item.active .conversation-name {
            color: #a7f3d0;
        }

        .conversation-item.active .conversation-preview {
            color: #6C63FF;
        }

        .conversation-time {
            font-size: 0.625rem;
            font-weight: 700;
            color: #64748b;
            flex-shrink: 0;
        }

        body:not(.light-mode) .conversation-time {
            color: #94a3b8;
        }

        .conversation-item.active .conversation-time {
            color: #6C63FF;
        }

        .conversation-unread {
            background: #6C63FF;
            color: white;
            border-radius: 50%;
            min-width: 20px;
            height: 20px;
            padding: 0 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.5625rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Ícone de atendente atribuído na lista de conversas — tooltip CSS imediato (sem atraso do title nativo) */
        .conversation-atendente-icon {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            color: rgba(255, 255, 255, 0.38);
            cursor: default;
            position: relative;
            border-radius: 8px;
            transition: color 0.15s, background 0.15s;
        }
        .conversation-atendente-icon:hover {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.12);
        }
        .conversation-atendente-icon svg {
            width: 14px;
            height: 14px;
        }
        body.light-mode .conversation-atendente-icon {
            color: rgba(0, 0, 0, 0.35);
        }
        body.light-mode .conversation-atendente-icon:hover {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.15);
        }
        .conversation-item.active .conversation-atendente-icon {
            color: rgba(255, 255, 255, 0.55);
        }
        body.light-mode .conversation-item.active .conversation-atendente-icon {
            color: rgba(0, 0, 0, 0.45);
        }
        .conversation-atendente-icon::after {
            content: attr(data-atendente-nome);
            position: absolute;
            left: 50%;
            bottom: 100%;
            transform: translateX(-50%);
            margin-bottom: 6px;
            padding: 5px 9px;
            font-size: 0.6875rem;
            font-weight: 600;
            line-height: 1.2;
            white-space: nowrap;
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            background: rgba(15, 23, 42, 0.96);
            color: #f8fafc;
            border-radius: 8px;
            pointer-events: none;
            opacity: 0;
            visibility: hidden;
            z-index: 80;
            transition: none;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
        }
        .conversation-atendente-icon:hover::after {
            opacity: 1;
            visibility: visible;
        }
        body.light-mode .conversation-atendente-icon::after {
            background: #0f172a;
            color: #fff;
        }

        /* Chat Area */
        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background: transparent;
            position: relative;
        }

        body.light-mode .chat-area {
            background: rgba(255, 255, 255, 0.98);
        }

        .chat-empty {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
            color: rgba(255, 255, 255, 0.5);
        }

        body.light-mode .chat-empty {
            color: rgba(0, 0, 0, 0.45);
        }

        .chat-empty-logo {
            max-width: 300px;
            max-height: 180px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .chat-header-stack {
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        body.light-mode .chat-header-stack {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        .chat-header {
            background: transparent;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-bottom: none;
            backdrop-filter: none;
        }
        body.light-mode .chat-header {
            background: transparent;
            border-bottom: none;
        }
        .chat-header-contact-hit {
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 0;
            cursor: pointer;
            border-radius: 12px;
            margin: -8px;
            padding: 8px;
            transition: background 0.15s ease;
            -webkit-tap-highlight-color: transparent;
        }
        .chat-header-contact-hit:hover {
            background: transparent;
        }
        body.light-mode .chat-header-contact-hit:hover {
            background: transparent;
        }
        .chat-header-meta-outer {
            padding: 10px 20px 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.02));
        }
        body.light-mode .chat-header-meta-outer {
            border-top-color: rgba(0, 0, 0, 0.08);
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.01), rgba(0, 0, 0, 0.02));
        }
        .chat-header-meta-toolbar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 8px;
        }
        .chat-header-meta-toggle-btn {
            flex-shrink: 0;
            width: 28px;
            height: 28px;
            border-radius: 9px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.85);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.15s ease, background 0.15s ease, color 0.15s ease;
        }
        .chat-header-meta-toggle-btn:hover {
            border-color: rgba(108, 99, 255, 0.45);
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.12);
        }
        .chat-header-meta-toggle-btn svg {
            width: 16px;
            height: 16px;
            transition: transform 0.15s ease;
        }
        .chat-header-meta-toggle-btn.is-open svg {
            transform: rotate(180deg);
        }
        body.light-mode .chat-header-meta-toggle-btn {
            border-color: rgba(0, 0, 0, 0.12);
            background: rgba(0, 0, 0, 0.04);
            color: #334155;
        }
        .chat-header-meta-body {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .chat-header-meta-section {
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }
        .chat-header-meta-section-label {
            flex-shrink: 0;
            min-width: 72px;
            font-size: 0.72rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.56);
            line-height: 1.9;
        }
        body.light-mode .chat-header-meta-section-label {
            color: rgba(0, 0, 0, 0.55);
        }
        .chat-header-meta-section-content {
            min-width: 0;
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .chat-header-mini-chip {
            --tag-color: #6b7280;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 9px 4px 7px;
            border-radius: 9999px;
            font-size: 0.69rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.95);
            border: 1px solid color-mix(in srgb, var(--tag-color) 65%, #ffffff 35%);
            background: color-mix(in srgb, var(--tag-color) 25%, transparent);
            max-width: 100%;
            white-space: nowrap;
        }
        body.light-mode .chat-header-mini-chip {
            color: #1f2937;
            border-color: color-mix(in srgb, var(--tag-color) 50%, #000000 12%);
            background: color-mix(in srgb, var(--tag-color) 16%, #ffffff 84%);
        }
        .chat-header-mini-chip-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
            background: var(--tag-color);
        }
        .chat-header-meta-more-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 0.68rem;
            font-weight: 700;
            border: 1px dashed rgba(255, 255, 255, 0.26);
            color: rgba(255, 255, 255, 0.72);
            background: rgba(255, 255, 255, 0.03);
        }
        body.light-mode .chat-header-meta-more-pill {
            border-color: rgba(0, 0, 0, 0.2);
            color: rgba(0, 0, 0, 0.58);
            background: rgba(0, 0, 0, 0.02);
        }
        .chat-header-meta-crm {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .chat-header-crm-pill {
            text-align: left;
            max-width: 100%;
            padding: 6px 10px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.73rem;
            font-weight: 600;
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s;
            white-space: nowrap;
        }
        .chat-header-crm-pill:hover {
            border-color: rgba(108, 99, 255, 0.45);
            background: rgba(108, 99, 255, 0.12);
        }
        body.light-mode .chat-header-crm-pill {
            border-color: rgba(0, 0, 0, 0.11);
            background: rgba(0, 0, 0, 0.03);
            color: #1e293b;
        }
        .conversation-tags-icon {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            margin-left: 4px;
            border: none;
            padding: 0;
            border-radius: 8px;
            background: transparent;
            color: rgba(255, 255, 255, 0.38);
            cursor: pointer;
            transition: color 0.15s, background 0.15s;
        }
        .conversation-tags-icon:hover {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.12);
        }
        body.light-mode .conversation-tags-icon {
            color: rgba(0, 0, 0, 0.35);
        }
        body.light-mode .conversation-tags-icon:hover {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.15);
        }
        .conversation-item.active .conversation-tags-icon {
            color: rgba(255, 255, 255, 0.55);
        }
        body.light-mode .conversation-item.active .conversation-tags-icon {
            color: rgba(0, 0, 0, 0.45);
        }
        .conversation-crm-icon {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            margin-left: 4px;
            border: none;
            padding: 0;
            border-radius: 8px;
            background: transparent;
            color: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: color 0.15s, background 0.15s;
        }
        .conversation-crm-icon:hover {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.12);
        }
        body.light-mode .conversation-crm-icon {
            color: rgba(0, 0, 0, 0.38);
        }
        body.light-mode .conversation-crm-icon:hover {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.15);
        }
        .conversation-item.active .conversation-crm-icon {
            color: rgba(255, 255, 255, 0.58);
        }
        body.light-mode .conversation-item.active .conversation-crm-icon {
            color: rgba(0, 0, 0, 0.48);
        }
        .conversation-crm-icon .material-symbols-rounded {
            font-family: 'Material Symbols Rounded', sans-serif;
            font-size: 18px;
            line-height: 1;
            font-weight: normal;
            font-style: normal;
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-feature-settings: 'liga';
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
        .conversation-tags-hover-tooltip {
            position: fixed;
            z-index: 100040;
            pointer-events: none;
            max-width: 240px;
            padding: 8px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(15, 23, 42, 0.95);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.32);
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            opacity: 0;
            transform: translateY(4px);
            transition: opacity 0.1s ease, transform 0.1s ease;
        }
        .conversation-tags-hover-tooltip.show {
            opacity: 1;
            transform: translateY(0);
        }
        .conversation-tags-hover-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 0.73rem;
            font-weight: 600;
            color: #fff;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.16);
            white-space: nowrap;
        }
        .conversation-tags-hover-chip-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        body.light-mode .conversation-tags-hover-tooltip {
            border-color: rgba(0, 0, 0, 0.12);
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.14);
        }
        body.light-mode .conversation-tags-hover-chip {
            color: #1f2937;
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.12);
        }
        .conversation-crm-hover-tooltip {
            position: fixed;
            z-index: 100040;
            pointer-events: none;
            max-width: 260px;
            padding: 8px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(15, 23, 42, 0.95);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.32);
            display: flex;
            flex-direction: column;
            gap: 6px;
            opacity: 0;
            transform: translateY(4px);
            transition: opacity 0.1s ease, transform 0.1s ease;
        }
        .conversation-crm-hover-tooltip.show {
            opacity: 1;
            transform: translateY(0);
        }
        .conversation-crm-hover-item {
            display: block;
            padding: 5px 8px;
            border-radius: 8px;
            font-size: 0.73rem;
            font-weight: 600;
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        body.light-mode .conversation-crm-hover-tooltip {
            border-color: rgba(0, 0, 0, 0.12);
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.14);
        }
        body.light-mode .conversation-crm-hover-item {
            color: #1f2937;
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.1);
        }

        .chat-header-atribuicao-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            flex-shrink: 0;
        }
        .chat-header-atribuicao-pill svg {
            flex-shrink: 0;
            opacity: 0.8;
        }
        body.light-mode .chat-header-atribuicao-pill {
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.12);
            color: #475569;
        }

        .chat-header-center {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 0;
        }

        .chat-header-back-mobile {
            display: none;
            align-items: center;
            justify-content: center;
            width: 44px;
            min-width: 44px;
            height: 44px;
            padding: 0;
            margin-right: 8px;
            border: none;
            border-radius: 50%;
            background: transparent;
            color: inherit;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }
        .chat-header-back-mobile:hover { background: rgba(255, 255, 255, 0.1); }
        .chat-header-back-mobile:active { background: rgba(255, 255, 255, 0.15); }
        body.light-mode .chat-header-back-mobile:hover { background: rgba(0, 0, 0, 0.06); }
        body.light-mode .chat-header-back-mobile:active { background: rgba(0, 0, 0, 0.1); }

        .chat-header-info {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .chat-header-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #6C63FF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            margin-right: 15px;
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: visible;
        }
        
        .chat-header-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .chat-header-avatar-add-btn {
            position: absolute;
            bottom: -4px;
            right: -4px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #6C63FF;
            border: 2px solid #1a1a1a;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: white;
            font-size: 14px;
            font-weight: bold;
            line-height: 1;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        body.light-mode .chat-header-avatar-add-btn {
            border-color: #fff;
        }

        .chat-header-avatar-add-btn:hover {
            background: #6C63FF;
            transform: scale(1.1);
        }

        .chat-header-name-wrap {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 6px;
            min-width: 0;
        }
        .chat-header-name {
            font-size: 1rem;
            font-weight: 500;
            color: white;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .chat-header-conexao-tag {
            flex-shrink: 0;
            font-size: 0.68rem;
            font-weight: 500;
            color: #fff;
            padding: 2px 8px;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.2);
        }
        body.light-mode .chat-header-conexao-tag {
            background: rgba(0, 0, 0, 0.12);
            color: rgba(0, 0, 0, 0.75);
        }

        body.light-mode .chat-header-name {
            color: #333;
        }

        .chat-header-nota-btn {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 8px;
            background: rgba(250, 204, 21, 0.18);
            color: #facc15;
            cursor: pointer;
            padding: 0;
            transition: background 0.2s, transform 0.15s;
        }

        /* Garantir ocultação: a classe acima usa display:flex e pode vencer o [hidden] padrão */
        .chat-header-nota-btn[hidden] {
            display: none !important;
        }

        .chat-header-nota-btn:hover {
            background: rgba(250, 204, 21, 0.3);
            transform: scale(1.05);
        }

        .chat-header-nota-btn:focus-visible {
            outline: 2px solid rgba(250, 204, 21, 0.6);
            outline-offset: 2px;
        }

        body.light-mode .chat-header-nota-btn {
            background: rgba(234, 179, 8, 0.2);
            color: #ca8a04;
        }

        body.light-mode .chat-header-nota-btn:hover {
            background: rgba(234, 179, 8, 0.32);
        }

        .chat-header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .chat-header-status-actions {
            display: flex;
            align-items: center;
            gap: 2px;
            font-size: 0.8rem;
        }

        .chat-header-status-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            transition: color 0.2s, background 0.2s;
        }

        .chat-header-status-btn:hover {
            color: rgba(255, 255, 255, 0.95);
            background: rgba(255, 255, 255, 0.08);
        }

        .chat-header-status-sep {
            color: rgba(255, 255, 255, 0.35);
            font-weight: 600;
            user-select: none;
        }

        .chat-header-status-current {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
        }

        body.light-mode .chat-header-status-btn {
            color: rgba(0, 0, 0, 0.6);
        }

        body.light-mode .chat-header-status-btn:hover {
            color: #111;
            background: rgba(0, 0, 0, 0.06);
        }

        body.light-mode .chat-header-status-sep {
            color: rgba(0, 0, 0, 0.3);
        }

        body.light-mode .chat-header-status-current {
            color: rgba(0, 0, 0, 0.45);
        }

        .chat-header-menu-wrap {
            position: relative;
        }

        .chat-header-menu-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s, background 0.2s;
        }

        .chat-header-menu-btn:hover {
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.08);
        }

        body.light-mode .chat-header-menu-btn {
            color: rgba(0, 0, 0, 0.5);
        }

        body.light-mode .chat-header-menu-btn:hover {
            color: #111;
            background: rgba(0, 0, 0, 0.06);
        }

        /* Painel lateral completo – Dados do contato */
        .contact-details-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }

        .contact-details-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .contact-details-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            max-width: 360px;
            height: 100%;
            background: #1f1f1f;
            box-shadow: -4px 0 24px rgba(0, 0, 0, 0.4);
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .contact-details-overlay.open .contact-details-panel {
            transform: translateX(0);
        }

        body.light-mode .contact-details-panel {
            background: #fff;
            box-shadow: -4px 0 24px rgba(0, 0, 0, 0.15);
        }

        .contact-details-panel-header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            flex-shrink: 0;
        }

        body.light-mode .contact-details-panel-header {
            border-bottom-color: rgba(0, 0, 0, 0.08);
        }

        .contact-details-panel-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        .contact-details-panel-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        body.light-mode .contact-details-panel-close {
            color: #333;
        }

        body.light-mode .contact-details-panel-close:hover {
            background: rgba(0, 0, 0, 0.06);
            color: #111;
        }

        .contact-details-panel-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
        }

        body.light-mode .contact-details-panel-title {
            color: #111;
        }

        .contact-details-panel-body {
            padding: 24px 20px;
            flex: 1;
        }

        .contact-details-avatar-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .contact-details-avatar {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: #6C63FF;
            background-size: cover;
            background-position: center;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            color: white;
        }

        .contact-details-phone {
            font-size: 1.25rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 4px;
        }

        body.light-mode .contact-details-phone {
            color: #111;
        }

        .contact-details-name {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.5);
        }

        body.light-mode .contact-details-name {
            color: #666;
        }

        .contact-details-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 16px;
            margin-bottom: 20px;
        }

        .contact-details-action-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 12px;
            border: none;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .contact-details-action-btn:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .contact-details-action-btn svg {
            color: #6C63FF;
        }

        body.light-mode .contact-details-action-btn {
            background: rgba(0, 0, 0, 0.06);
            color: #333;
        }

        body.light-mode .contact-details-action-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .contact-details-conexao-wrap {
            margin-top: 8px;
            padding: 14px 16px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-family: inherit;
        }
        body.light-mode .contact-details-conexao-wrap {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.08);
        }
        .contact-details-conexao-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.45);
            text-transform: uppercase;
            letter-spacing: 0.03em;
            margin-bottom: 8px;
        }
        .contact-details-conexao-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 8px;
        }
        .contact-details-conexao-label-row .contact-details-conexao-label {
            margin-bottom: 0;
        }
        .contact-details-atendente-wrap {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.16);
        }
        .contact-details-atendente-edit-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.82);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s, color 0.15s;
        }
        .contact-details-atendente-edit-btn:hover {
            border-color: rgba(108, 99, 255, 0.4);
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.12);
        }
        .contact-details-atendente-edit-btn svg {
            width: 14px;
            height: 14px;
        }
        body.light-mode .contact-details-conexao-label {
            color: rgba(0, 0, 0, 0.45);
        }
        body.light-mode .contact-details-atendente-edit-btn {
            border-color: rgba(0, 0, 0, 0.12);
            background: rgba(0, 0, 0, 0.04);
            color: #334155;
        }
        .contact-details-conexao-tag {
            display: inline-block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #fff;
            padding: 6px 12px;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.2);
            margin-bottom: 8px;
        }
        body.light-mode .contact-details-conexao-tag {
            background: rgba(0, 0, 0, 0.12);
            color: rgba(0, 0, 0, 0.8);
        }
        .contact-details-conexao-phone {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
        }
        body.light-mode .contact-details-conexao-phone {
            color: #555;
        }
        .contact-details-conexao-phone span {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.72rem;
        }
        body.light-mode .contact-details-conexao-phone span {
            color: #888;
        }

        .contact-details-section {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
        body.light-mode .contact-details-section {
            border-top-color: rgba(0, 0, 0, 0.08);
        }
        .contact-details-section--after-actions {
            margin-top: 12px;
            padding-top: 0;
            border-top: none;
        }
        .contact-details-section-heading {
            margin: 0 0 6px 0;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: rgba(255, 255, 255, 0.45);
        }
        body.light-mode .contact-details-section-heading {
            color: rgba(0, 0, 0, 0.45);
        }
        .contact-details-section-hint {
            margin: 0 0 12px 0;
            font-size: 0.78rem;
            line-height: 1.45;
            color: rgba(255, 255, 255, 0.38);
        }
        body.light-mode .contact-details-section-hint {
            color: rgba(0, 0, 0, 0.5);
        }
        .contact-details-muted {
            margin: 0;
            font-size: 0.85rem;
            line-height: 1.45;
            color: rgba(255, 255, 255, 0.4);
        }
        body.light-mode .contact-details-muted {
            color: rgba(0, 0, 0, 0.45);
        }
        .contact-details-dynamic-mount {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
        }
        body.light-mode .contact-details-dynamic-mount {
            color: rgba(0, 0, 0, 0.5);
        }
        .contact-details-etiquetas-chips-area {
            min-height: 0;
            margin-bottom: 10px;
        }
        .contact-details-etiquetas-empty {
            margin: 0;
            font-size: 0.82rem;
            line-height: 1.45;
            color: rgba(255, 255, 255, 0.42);
        }
        body.light-mode .contact-details-etiquetas-empty {
            color: rgba(0, 0, 0, 0.48);
        }
        .contact-details-etiquetas-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .contact-details-etiqueta-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            max-width: 100%;
            padding: 6px 8px 6px 10px;
            border-radius: 9999px;
            font-size: 0.78rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.92);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.14);
        }
        body.light-mode .contact-details-etiqueta-chip {
            color: #1a1a1a;
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.1);
        }
        .contact-details-etiqueta-chip-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .contact-details-etiqueta-chip-name {
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .contact-details-etiqueta-chip-remove {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            padding: 0;
            border: none;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.2);
            color: rgba(255, 255, 255, 0.85);
            font-size: 1rem;
            line-height: 1;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }
        .contact-details-etiqueta-chip-remove:hover {
            background: rgba(239, 68, 68, 0.45);
            color: #fff;
        }
        body.light-mode .contact-details-etiqueta-chip-remove {
            background: rgba(0, 0, 0, 0.08);
            color: #444;
        }
        body.light-mode .contact-details-etiqueta-chip-remove:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #b91c1c;
        }
        .contact-details-etiquetas-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.92);
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .contact-details-etiquetas-toggle:hover {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.35);
        }
        .contact-details-etiquetas-toggle--open {
            border-color: rgba(108, 99, 255, 0.45);
            background: rgba(108, 99, 255, 0.12);
        }
        body.light-mode .contact-details-etiquetas-toggle {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.1);
            color: #222;
        }
        body.light-mode .contact-details-etiquetas-toggle:hover {
            background: rgba(108, 99, 255, 0.08);
            border-color: rgba(108, 99, 255, 0.35);
        }
        body.light-mode .contact-details-etiquetas-toggle--open {
            background: rgba(108, 99, 255, 0.1);
        }
        .contact-details-etiquetas-toggle-chevron {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            transition: transform 0.2s ease;
            opacity: 0.75;
        }
        .contact-details-etiquetas-toggle--open .contact-details-etiquetas-toggle-chevron {
            transform: rotate(180deg);
        }
        .contact-details-etiquetas-picker-panel {
            margin-top: 10px;
            padding: 12px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        body.light-mode .contact-details-etiquetas-picker-panel {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.08);
        }
        .contact-details-etiquetas-search {
            width: 100%;
            margin-bottom: 10px;
        }
        .contact-details-etiqueta-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
            max-height: 200px;
            overflow-y: auto;
            padding-right: 4px;
        }
        .contact-details-etiqueta-list--picker {
            max-height: 220px;
        }
        .contact-details-etiqueta-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.88);
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        .contact-details-etiqueta-row:hover {
            background: rgba(255, 255, 255, 0.07);
        }
        body.light-mode .contact-details-etiqueta-row {
            color: #222;
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.06);
        }
        .contact-details-etiqueta-row input {
            width: 16px;
            height: 16px;
            accent-color: #6C63FF;
            flex-shrink: 0;
        }
        .contact-details-etiqueta-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .contact-details-etiqueta-name {
            flex: 1;
            min-width: 0;
        }
        .contact-details-crm-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .contact-details-crm-row {
            width: 100%;
            text-align: left;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.92);
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            font-family: inherit;
        }
        .contact-details-crm-row:hover {
            background: rgba(108, 99, 255, 0.12);
            border-color: rgba(108, 99, 255, 0.35);
        }
        .contact-details-crm-row-title {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .contact-details-crm-row-meta {
            display: block;
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.35;
        }
        .contact-details-crm-row-main {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
            flex: 1;
        }
        .contact-details-crm-row-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .contact-details-crm-row-edit-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            flex-shrink: 0;
            user-select: none;
        }
        .contact-details-crm-row-edit-btn:hover {
            background: rgba(108, 99, 255, 0.2);
            color: #6C63FF;
        }
        .contact-details-crm-row-edit-btn svg {
            width: 14px;
            height: 14px;
        }
        body.light-mode .contact-details-crm-row {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.1);
            color: #111;
        }
        body.light-mode .contact-details-crm-row:hover {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.4);
        }
        body.light-mode .contact-details-crm-row-meta {
            color: rgba(0, 0, 0, 0.55);
        }
        body.light-mode .contact-details-crm-row-edit-btn {
            background: rgba(0, 0, 0, 0.06);
            color: rgba(0, 0, 0, 0.55);
        }
        body.light-mode .contact-details-crm-row-edit-btn:hover {
            color: #6C63FF;
            background: rgba(108, 99, 255, 0.16);
        }

        .contact-details-cf-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .contact-details-cf-row {
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }
        .contact-details-cf-row-main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .contact-details-cf-name {
            font-size: 0.78rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.55);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .contact-details-cf-val {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.92);
            word-break: break-word;
        }
        body.light-mode .contact-details-cf-row {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.1);
        }
        body.light-mode .contact-details-cf-name { color: rgba(0, 0, 0, 0.5); }
               body.light-mode .contact-details-cf-val { color: #111; }

        .contact-details-cf-bar {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 4px;
        }
        .contact-details-cf-bar .contact-details-cf-listwrap {
            flex: 1;
            min-width: 0;
        }
        .contact-details-cf-actions {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            flex-shrink: 0;
        }
        .contact-details-cf-icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px dashed rgba(108, 99, 255, 0.55);
            background: rgba(108, 99, 255, 0.08);
            color: #6C63FF;
            font-size: 1.25rem;
            font-weight: 300;
            line-height: 1;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .contact-details-cf-icon-btn:hover {
            background: rgba(108, 99, 255, 0.16);
            border-color: #6C63FF;
        }
        .contact-details-cf-row-actions {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
            align-items: center;
        }
        .contact-details-cf-row-btn {
            border: none;
            background: rgba(255, 255, 255, 0.1);
            width: 30px;
            height: 30px;
            border-radius: 8px;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.65);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        .contact-details-cf-row-btn:hover { background: rgba(108, 99, 255, 0.2); color: #6C63FF; }
        .contact-details-cf-row-btn.danger:hover { background: rgba(239, 68, 68, 0.2); color: #f87171; }
        body.light-mode .contact-details-cf-row-btn { background: rgba(0, 0, 0, 0.06); color: #64748b; }
        body.light-mode .contact-details-cf-row-btn:hover { color: #6C63FF; }
        body.light-mode .contact-details-cf-row-btn.danger:hover { color: #b91c1c; }

        .chat-cf-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 120000;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .chat-cf-modal-overlay.show { display: flex; }
        .chat-cf-modal-box {
            background: #1e293b;
            border: 1px solid rgba(71, 85, 105, 0.5);
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45);
        }
        body.light-mode .chat-cf-modal-box {
            background: #fff;
            border-color: #e2e8f0;
        }
        .chat-cf-modal-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(71, 85, 105, 0.4);
        }
        body.light-mode .chat-cf-modal-head { border-color: #e2e8f0; }
        .chat-cf-modal-title { margin: 0; font-size: 1.05rem; font-weight: 700; color: #f8fafc; }
        body.light-mode .chat-cf-modal-title { color: #0f172a; }
        .chat-cf-modal-close {
            border: none;
            background: none;
            color: #94a3b8;
            font-size: 1.5rem;
            line-height: 1;
            cursor: pointer;
        }
        .chat-cf-modal-body { padding: 18px 20px; }
        .chat-cf-modal-foot { padding: 14px 20px 18px; display: flex; justify-content: flex-end; gap: 10px; }
        .chat-cf-label { display: block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #94a3b8; margin-bottom: 8px; }
        body.light-mode .chat-cf-label { color: #64748b; }
        .chat-cf-input, .chat-cf-select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(71, 85, 105, 0.5);
            background: rgba(15, 23, 42, 0.6);
            color: #e2e8f0;
            font-size: 0.9rem;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            margin-bottom: 14px;
        }
        #chatCampoValorSelect,
        #chatCampoValorBoolean {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif !important;
        }
        body.light-mode .chat-cf-input, body.light-mode .chat-cf-select {
            border-color: #e2e8f0;
            background: #f8fafc;
            color: #0f172a;
        }
        /* Selects do modal de campo personalizado: mesmo padrão branco/preto em qualquer tema */
        body:not(.light-mode) .chat-cf-select,
        body.dark-mode .chat-cf-select,
        body:not(.light-mode) #chatCampoValorSelect,
        body:not(.light-mode) #chatCampoValorBoolean {
            background: #ffffff !important;
            color: #000000 !important;
            border-color: rgba(0, 0, 0, 0.2) !important;
        }
        body:not(.light-mode) .chat-cf-select option,
        body.dark-mode .chat-cf-select option,
        body:not(.light-mode) #chatCampoValorSelect option,
        body:not(.light-mode) #chatCampoValorBoolean option {
            background: #ffffff !important;
            color: #000000 !important;
        }
        body:not(.light-mode) .chat-cf-select:disabled,
        body.dark-mode .chat-cf-select:disabled {
            background: #ffffff !important;
            color: #000000 !important;
            border-color: rgba(0, 0, 0, 0.2) !important;
            opacity: 0.85 !important;
        }
        .chat-cf-btn {
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.88rem;
            cursor: pointer;
            border: none;
        }
        .chat-cf-btn-secondary { background: rgba(255,255,255,0.08); color: #e2e8f0; }
        body.light-mode .chat-cf-btn-secondary { background: #f1f5f9; color: #334155; }
        .chat-cf-btn-primary { background: #6C63FF; color: #fff; }

        .contact-details-nota-wrap {
            margin-top: 0;
            background: linear-gradient(180deg, #fff9c4 0%, #fff59d 100%);
            border: 1px solid #f2df7a;
            border-radius: 12px;
            padding: 12px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }
        .contact-details-nota-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.45);
            text-transform: uppercase;
            letter-spacing: 0.03em;
            margin-bottom: 8px;
        }
        body.light-mode .contact-details-nota-label { color: rgba(0, 0, 0, 0.45); }
        .contact-details-nota-input {
            width: 100%;
            box-sizing: border-box;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid rgba(151, 127, 24, 0.25);
            background: rgba(255, 250, 205, 0.65);
            color: #3f3a2a;
            font-size: 0.9rem;
            line-height: 1.4;
            resize: vertical;
            min-height: 70px;
        }
        .contact-details-nota-input::placeholder { color: rgba(90, 75, 24, 0.55); }
        .contact-details-nota-input:focus {
            outline: none;
            border-color: rgba(188, 154, 27, 0.55);
        }
        body.light-mode .contact-details-nota-input {
            background: rgba(255, 250, 205, 0.75);
            border-color: rgba(151, 127, 24, 0.28);
            color: #3f3a2a;
        }
        body.light-mode .contact-details-nota-input::placeholder { color: rgba(90, 75, 24, 0.55); }
        body.light-mode .contact-details-nota-input:focus { border-color: rgba(188, 154, 27, 0.6); }
        .contact-details-nota-save {
            margin-top: 10px;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: #6C63FF;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
        }
        #contactDetailsNotaSaveBtn[hidden] {
            display: none !important;
        }
        .contact-details-nota-save:hover { background: #1fb55a; }
        .contact-details-nota-save:disabled { opacity: 0.7; cursor: not-allowed; }
        body.light-mode .contact-details-nota-save {
            background: #6C63FF;
            color: #fff;
        }
        body.light-mode .contact-details-nota-save:hover { background: #1fb55a; }

        .contact-details-delete-wrap {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        body.light-mode .contact-details-delete-wrap { border-top-color: rgba(0, 0, 0, 0.1); }
        .contact-details-delete-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 12px;
            border: none;
            background: #ef4444;
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .contact-details-delete-btn:hover {
            background: #dc2626;
        }
        .contact-details-delete-btn svg { width: 18px; height: 18px; }

        .contact-details-transfer-wrap {
            margin-top: 14px;
            font-family: inherit;
        }
        .contact-details-transfer-wrap.inline {
            margin-top: 10px;
            padding: 10px;
            border-radius: 10px;
            border-top: none;
            background: rgba(0, 0, 0, 0.14);
        }
        .contact-details-transfer-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-top: 0;
        }
        .contact-details-transfer-select {
            flex: 1;
            min-width: 140px;
            height: 40px;
            padding: 0 12px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            background: #ffffff;
            color: #000000;
            font-size: 0.875rem;
            font-family: inherit;
        }
        .contact-details-transfer-select:focus {
            outline: none;
            border-color: rgba(108, 99, 255, 0.5);
        }
        body.light-mode .contact-details-transfer-select {
            border-color: rgba(0, 0, 0, 0.2);
            background: #ffffff;
            color: #000000;
        }
        body.dark-mode #contactDetailsTransferSelect,
        body:not(.light-mode) #contactDetailsTransferSelect {
            background: #ffffff !important;
            color: #000000 !important;
            border-color: rgba(0, 0, 0, 0.2) !important;
        }
        body.dark-mode #contactDetailsTransferSelect option,
        body:not(.light-mode) #contactDetailsTransferSelect option {
            background: #ffffff !important;
            color: #000000 !important;
        }
        .contact-details-transfer-apply {
            height: 40px;
            margin-top: 0 !important;
            padding: 0 14px !important;
            border-radius: 10px !important;
            font-size: 0.86rem !important;
            font-weight: 600 !important;
            flex-shrink: 0;
            border: none !important;
            background: #6C63FF !important;
            color: #ffffff !important;
        }
        .contact-details-transfer-apply:hover {
            background: #1fb55a !important;
        }
        body.light-mode .contact-details-transfer-wrap.inline {
            background: rgba(0, 0, 0, 0.04);
        }
        .contact-detail-etiquetas-wrap { position: relative; margin-top: 4px; }
        .contact-detail-etiquetas-bar { display: flex; flex-wrap: wrap; align-items: flex-start; gap: 10px; font-family: inherit; }
        .contact-detail-etiquetas-chips { display: flex; flex-wrap: wrap; gap: 8px; flex: 1; min-width: 0; align-items: center; }
        .contact-detail-etiquetas-empty-hint { font-size: 0.88rem; color: rgba(255, 255, 255, 0.42); line-height: 1.4; }
        .contact-detail-etiqueta-chip { display: inline-flex; align-items: center; gap: 4px; max-width: 100%; padding: 5px 6px 5px 12px; border-radius: 999px; font-size: 0.78rem; font-weight: 600; border: 1px solid transparent; font-family: inherit; }
        .contact-detail-etiqueta-chip-remove { width: 20px; height: 20px; border: none; border-radius: 999px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.95rem; line-height: 1; background: rgba(0, 0, 0, 0.2); color: #000; opacity: 0.82; }
        .contact-detail-etiqueta-chip-remove:hover { opacity: 1; background: rgba(0, 0, 0, 0.14); color: #000; }
        .contact-detail-etiqueta-add { width: 34px; height: 34px; border-radius: 999px; border: 1px dashed rgba(108, 99, 255, 0.55); background: rgba(108, 99, 255, 0.1); color: #6C63FF; font-size: 1.1rem; font-weight: 700; line-height: 1; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; transition: transform 0.15s, background 0.15s, border-color 0.15s, color 0.15s; font-family: inherit; }
        .contact-detail-etiqueta-add:hover { background: rgba(108, 99, 255, 0.16); border-color: #6C63FF; transform: scale(1.04); }
        .contact-detail-etiqueta-add[aria-expanded="true"] { border-style: solid; border-color: #6C63FF; background: rgba(108, 99, 255, 0.2); color: #6C63FF; }
        .contact-detail-etiqueta-picker { margin-top: 10px; padding: 12px; border-radius: 12px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); font-family: inherit; }
        .contact-detail-etiqueta-picker[hidden] { display: none !important; }
        .contact-detail-etiqueta-picker-head { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: rgba(255,255,255,0.58); margin: 0 0 8px 0; }
        .contact-detail-etiqueta-picker-list { overflow-y: auto; flex: 1; min-height: 0; display: flex; flex-direction: column; gap: 6px; max-height: 220px; }
        .contact-detail-etiqueta-pick-row { display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; padding: 9px 10px; border-radius: 10px; cursor: pointer; font-size: 0.88rem; color: rgba(255,255,255,0.88); background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); font-family: inherit; }
        .contact-detail-etiqueta-pick-row:hover { background: rgba(108, 99, 255, 0.07); border-color: rgba(108, 99, 255, 0.35); }
        .contact-detail-etiqueta-pick-row.is-on { background: rgba(108, 99, 255, 0.11); border-color: rgba(108, 99, 255, 0.45); }
        .contact-detail-etiqueta-pick-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
        .contact-detail-etiqueta-pick-label { flex: 1; min-width: 0; }
        .contact-detail-etiqueta-pick-check { width: 22px; flex-shrink: 0; text-align: center; font-weight: 700; color: #6C63FF; font-size: 0.95rem; }
        .contact-detail-etiqueta-empty { padding: 12px; text-align: center; color: rgba(255,255,255,0.48); font-size: 0.88rem; line-height: 1.45; }
        body.light-mode .contact-detail-etiquetas-empty-hint { color: #9ca3af; }
        body.light-mode .contact-detail-etiqueta-picker { background: rgba(0, 0, 0, 0.03); border-color: rgba(0, 0, 0, 0.08); }
        body.light-mode .contact-detail-etiqueta-picker-head { color: #6b7280; }
        body.light-mode .contact-detail-etiqueta-pick-row { background: #fff; border-color: #e5e7eb; color: #1f2937; }
        body.light-mode .contact-detail-etiqueta-pick-row:hover { background: rgba(108, 99, 255, 0.07); border-color: rgba(108, 99, 255, 0.35); }
        body.light-mode .contact-detail-etiqueta-pick-row.is-on { background: rgba(108, 99, 255, 0.11); border-color: rgba(108, 99, 255, 0.45); }
        body.light-mode .contact-detail-etiqueta-empty { color: #9ca3af; }

        /* Popup vermelho de confirmação de exclusão */
        .delete-confirm-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 100020;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }
        .delete-confirm-overlay.show {
            display: flex;
        }
        body.light-mode .delete-confirm-overlay {
            background: rgba(0, 0, 0, 0.5);
        }
        .delete-confirm-popup {
            background: linear-gradient(145deg, #1a0a0a 0%, #2d1515 100%);
            border: 1px solid rgba(255, 107, 107, 0.4);
            border-radius: 16px;
            padding: 28px 32px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 0 40px rgba(255, 107, 107, 0.2), 0 20px 60px rgba(0, 0, 0, 0.5);
        }
        body.light-mode .delete-confirm-popup {
            background: linear-gradient(145deg, #fff8f8 0%, #ffe8e8 100%);
            border-color: rgba(255, 107, 107, 0.5);
            box-shadow: 0 0 40px rgba(255, 107, 107, 0.15), 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        .delete-confirm-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 107, 107, 0.2);
            border-radius: 50%;
            color: #ff6b6b;
        }
        .delete-confirm-icon svg {
            width: 28px;
            height: 28px;
        }
        body.light-mode .delete-confirm-icon {
            background: rgba(255, 107, 107, 0.25);
            color: #d64545;
        }
        .delete-confirm-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #ff6b6b;
            text-align: center;
            margin-bottom: 12px;
        }
        body.light-mode .delete-confirm-title {
            color: #d64545;
        }
        .delete-confirm-text {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.85);
            text-align: center;
            line-height: 1.5;
            margin-bottom: 24px;
        }
        body.light-mode .delete-confirm-text {
            color: rgba(0, 0, 0, 0.75);
        }
        .delete-confirm-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        .delete-confirm-btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }
        .delete-confirm-cancel {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .delete-confirm-cancel:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        body.light-mode .delete-confirm-cancel {
            background: rgba(0, 0, 0, 0.06);
            color: #333;
            border-color: rgba(0, 0, 0, 0.15);
        }
        .delete-confirm-excluir {
            background: #ff6b6b;
            color: white;
            border: 1px solid rgba(255, 107, 107, 0.8);
        }
        .delete-confirm-excluir:hover {
            background: #ff5252;
            transform: scale(1.02);
        }
        body.light-mode .delete-confirm-excluir {
            background: #e85555;
            border-color: #d64545;
        }
        body.light-mode .delete-confirm-excluir:hover {
            background: #d64545;
        }

        .contact-details-section {
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 14px 0;
        }

        body.light-mode .contact-details-section {
            border-bottom-color: rgba(0, 0, 0, 0.08);
        }

        .contact-details-section-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 10px;
        }

        body.light-mode .contact-details-section-title {
            color: #666;
        }

        .contact-details-media-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .contact-details-media-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.85);
        }

        body.light-mode .contact-details-media-label {
            color: #333;
        }

        .contact-details-media-count {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
        }

        body.light-mode .contact-details-media-count {
            color: #666;
        }

        .contact-details-option-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            cursor: pointer;
            transition: background 0.2s;
            margin: 0 -20px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .contact-details-option-row:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        body.light-mode .contact-details-option-row {
            color: #333;
        }

        body.light-mode .contact-details-option-row:hover {
            background: rgba(0, 0, 0, 0.04);
        }

        .contact-details-option-row .option-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contact-details-option-row .option-icon {
            color: rgba(255, 255, 255, 0.6);
        }

        body.light-mode .contact-details-option-row .option-icon {
            color: #666;
        }

        .contact-details-option-row .option-sublabel {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 2px;
        }

        body.light-mode .contact-details-option-row .option-sublabel {
            color: #666;
        }

        .contact-details-toggle {
            width: 44px;
            height: 24px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.2);
            position: relative;
            cursor: pointer;
            transition: background 0.2s;
        }

        .contact-details-toggle.on {
            background: #6C63FF;
        }

        .contact-details-toggle::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
            transition: transform 0.2s;
        }

        .contact-details-toggle.on::after {
            transform: translateX(20px);
        }

        .chat-header-actions {
            display: flex;
            gap: 15px;
        }

        .chat-header-btn {
            background: none;
            border: none;
            color: #888;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-header-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #6C63FF;
        }

        body.light-mode .chat-header-btn {
            color: #666;
        }

        body.light-mode .chat-header-btn:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #6C63FF;
        }

        .chat-search-bar {
            display: none;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .chat-search-bar.open {
            display: flex;
        }
        body.light-mode .chat-search-bar {
            background: rgba(0, 0, 0, 0.04);
            border-bottom-color: rgba(0, 0, 0, 0.1);
        }
        .chat-search-bar input {
            flex: 1;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
            font-size: 0.95rem;
            outline: none;
        }
        .chat-search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        body.light-mode .chat-search-bar input {
            border-color: rgba(0, 0, 0, 0.15);
            background: rgba(0, 0, 0, 0.04);
            color: #333;
        }
        body.light-mode .chat-search-bar input::placeholder {
            color: #888;
        }
        .chat-search-bar-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .chat-search-bar-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        body.light-mode .chat-search-bar-close {
            color: #666;
        }
        body.light-mode .chat-search-bar-close:hover {
            background: rgba(0, 0, 0, 0.06);
            color: #111;
        }
        .message.search-hidden {
            display: none !important;
        }
        .message.search-highlight .message-text,
        .message.search-highlight .message-content-inner {
            background: rgba(255, 193, 7, 0.25) !important;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 0;
            background: transparent;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3Cpattern id='grid' width='100' height='100' patternUnits='userSpaceOnUse'%3E%3Cpath d='M 100 0 L 0 0 0 100' fill='none' stroke='rgba(255,255,255,0.02)' stroke-width='1'/%3E%3C/pattern%3E%3C/defs%3E%3Crect width='100%25' height='100%25' fill='url(%23grid)'/%3E%3C/svg%3E");
        }

        body.light-mode .chat-messages {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3Cpattern id='grid' width='100' height='100' patternUnits='userSpaceOnUse'%3E%3Cpath d='M 100 0 L 0 0 0 100' fill='none' stroke='rgba(0,0,0,0.02)' stroke-width='1'/%3E%3C/pattern%3E%3C/defs%3E%3Crect width='100%25' height='100%25' fill='url(%23grid)'/%3E%3C/svg%3E");
        }

        .message {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            animation: fadeIn 0.3s ease;
            margin-bottom: 4px;
            width: 100%;
            box-sizing: border-box;
            position: relative;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mensagens recebidas (fromMe: false): à esquerda */
        .message.received {
            justify-content: flex-start;
            align-self: flex-start;
            margin-right: auto;
            margin-left: 0;
            margin-bottom: 4px;
            width: fit-content;
            max-width: 75%;
            transition: max-width 0.2s ease;
        }

        /* Mensagens enviadas (fromMe: true): à direita - alinhadas perfeitamente */
        .message.sent {
            flex-direction: row-reverse;
            justify-content: flex-start;
            align-self: flex-end;
            margin-left: auto;
            margin-right: 0;
            margin-bottom: 4px;
            width: fit-content;
            max-width: 75%;
            transition: max-width 0.2s ease;
        }
        /* Hover: ganha largura na horizontal para ⋮ na lateral, sem mudar padding vertical da bolha */
        .message.sent:hover,
        .message.received:hover {
            max-width: min(92%, calc(75% + 44px));
        }

        /* Mensagens enviadas pela IA (fromMe true + coluna IA true): cor diferente + ícone de robô à esquerda */
        .message.sent.ia .message-content {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 100%);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
        }
        body.light-mode .message.sent.ia .message-content {
            background: linear-gradient(135deg, #e8f4fc 0%, #d0e8f7 100%);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
        .message.sent.ia .message-avatar {
            background: linear-gradient(135deg, #4a90d9 0%, #357abd 100%);
            color: white;
        }
        .message.sent.ia .message-avatar .message-avatar-robot {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .message.sent.ia .message-avatar .message-avatar-robot svg {
            width: 18px;
            height: 18px;
        }
        /* Legenda em mensagem IA + mídia */
        .message.sent.ia .message-content-inner:has(.message-media-image):has(.message-text) .message-text,
        .message.sent.ia .message-content-inner:has(.message-media-video):has(.message-text) .message-text {
            background: rgba(30, 58, 95, 0.6);
            border-color: rgba(255, 255, 255, 0.1);
        }
        body.light-mode .message.sent.ia .message-content-inner:has(.message-media-image):has(.message-text) .message-text,
        body.light-mode .message.sent.ia .message-content-inner:has(.message-media-video):has(.message-text) .message-text {
            background: rgba(200, 230, 248, 0.9);
            border-color: rgba(0, 0, 0, 0.08);
        }

        .message-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #6C63FF;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
            flex-shrink: 0;
            margin-left: 0;
        }
        .message-avatar img {
            display: none;
        }
        
        /* Avatar nas mensagens enviadas: sem margem à direita */
        .message.sent .message-avatar {
            margin-right: 0;
        }

        .message-content {
            padding: 8px 12px 8px 14px;
            border-radius: 16px;
            word-wrap: break-word;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
            min-width: 0;
            max-width: 100%;
            box-sizing: border-box;
        }
        
        /* Container interno: stretch na altura para ⋮ ao centro da bolha; hora permanece em baixo na .message-trailing-meta */
        .message-content-inner {
            display: flex;
            flex-direction: row;
            align-items: stretch;
            gap: 6px;
            width: 100%;
            flex-wrap: nowrap;
            order: 1;
        }
        /* Mídia+legenda em coluna mantém exceção nos blocos :has(...) abaixo */
        .message-body-block {
            display: block;
            flex: 1 1 auto;
            min-width: 0;
            max-width: 100%;
            width: auto;
        }
        .message-trailing-meta {
            display: inline-flex;
            flex-direction: row;
            align-items: center;
            flex-wrap: nowrap;
            gap: 4px;
            flex-shrink: 0;
        }
        .message.received .message-trailing-meta {
            margin-left: auto;
            position: relative;
            padding-right: 2px;
        }
        .message.received:hover .message-trailing-meta {
            padding-right: 28px;
        }
        /* Primeiro filho em fluxo (estrela ou hora): empurra a faixa de hora para o fundo da bolha */
        .message.received .message-trailing-meta > :first-child {
            margin-top: auto;
        }
        .message.received .message-trailing-meta .message-options-btn {
            position: absolute;
            right: 0;
            top: 50%;
            bottom: auto;
            transform: translateY(-50%);
        }
        .message.sent .message-trailing-meta {
            margin-left: 0;
            align-self: stretch;
            align-items: flex-end;
        }
        .message.sent .message-trailing-meta > :first-child {
            margin-top: auto;
        }
        /* Enviadas (fromMe): ⋮ à esquerda do texto, faixa fixa — sem animar largura (evita mudar altura da bolha) */
        .message-leading-options {
            position: relative;
            flex: 0 0 26px;
            width: 26px;
            min-width: 26px;
            align-self: stretch;
            flex-shrink: 0;
            min-height: 0;
        }
        .message-leading-options .message-options-btn {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            width: 26px;
            min-width: 26px;
            max-width: 26px;
            height: 26px;
            padding: 0;
            margin: 0;
            overflow: visible;
            transition: opacity 0.2s ease;
        }
        .message.sent:hover .message-leading-options .message-options-btn {
            opacity: 1;
        }
        .message-leading-options .message-options-btn svg {
            width: 16px;
            height: 16px;
            transition: none;
            display: block;
        }
        
        /* Quando não há preview, o container interno pode ocupar toda a largura */
        .message-content:not(:has(.message-reply-preview)) .message-content-inner {
            width: 100%;
        }

        /* Conteúdo de mensagens enviadas: alinhado à direita */
        .message.sent .message-content {
            align-items: flex-end;
            text-align: right;
        }
        
        .message.sent .message-content-inner {
            justify-content: flex-end;
        }

        /* Conteúdo de mensagens recebidas: alinhado à esquerda */
        .message.received .message-content {
            align-items: flex-start;
            text-align: left;
        }
        
        .message.received .message-content-inner {
            justify-content: flex-start;
        }

        .message.received .message-content {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-bottom-left-radius: 4px;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
            margin-right: auto;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            padding: 6px 12px 6px 14px;
        }

        body.light-mode .message.received .message-content {
            background: #fff;
            border: 1px solid #e2e8f0;
        }

        .message.sent .message-content {
            background: #005c4b;
            /* Mesma espessura que recebidas (1px) para altura externa idêntica no escuro */
            border: 1px solid transparent;
            border-bottom-right-radius: 4px;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            border-bottom-left-radius: 16px;
            text-align: right;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            /* Mesmo padding vertical que .message.received (evita bolha enviada mais alta) */
            padding: 6px 12px 6px 14px;
        }

        body.light-mode .message.sent .message-content {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
        }

        /* Documento sem balão visual ao redor (sem borda/sombra/fundo) */
        .message.message-document-clean .message-content {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        .message-text {
            font-size: 0.9rem;
            line-height: 1.3;
            font-weight: 400;
            color: white;
            word-wrap: break-word;
            word-break: break-word;
            white-space: pre-wrap;
            flex: 1 1 auto;
            min-width: 0;
            order: 1;
        }
        
        /* Quando há preview, o texto fica dentro do container interno */
        .message-content:has(.message-reply-preview) .message-text {
            order: 0;
        }

        /* Texto de mensagens enviadas: alinhado à direita */
        .message.sent .message-text {
            text-align: left;
            color: white;
        }

        body.light-mode .message.sent .message-text {
            color: #065f46;
        }

        /* Texto de mensagens recebidas: alinhado à esquerda */
        .message.received .message-text {
            text-align: left;
        }

        body.light-mode .message-text {
            color: #333;
        }

        /* Mídia nas mensagens (imagem, vídeo, áudio, documento) */
        .message-media {
            margin-bottom: 4px;
            border-radius: 8px;
            overflow: hidden;
            max-width: 100%;
        }

        .message-media-image {
            position: relative;
            padding: 0;
            margin: 0;
            background: transparent;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            max-width: 280px;
        }
        .message-media-image img {
            max-width: 280px;
            max-height: 280px;
            width: auto;
            height: auto;
            display: block;
            border-radius: 8px;
        }

        .message-media-sticker {
            position: relative;
            padding: 0;
            margin: 0;
            background: transparent;
            border: none;
            border-radius: 8px;
        }
        .message-media-sticker img {
            width: 128px;
            height: 128px;
            object-fit: contain;
            display: block;
            border-radius: 8px;
        }
        /* Horário e 3 pontinhos sobrepostos na figurinha (sticker) */
        .message-content-inner:has(.message-media-sticker) {
            position: relative;
        }
        .message-content-inner:has(.message-media-sticker) .message-time {
            position: absolute;
            bottom: 6px;
            right: 6px;
            z-index: 3;
            font-size: 0.65rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.8);
            color: rgba(255, 255, 255, 0.95);
        }
        .message.received .message-content-inner:has(.message-media-sticker) .message-trailing-meta .message-options-btn {
            position: absolute;
            top: 50%;
            right: 6px;
            bottom: auto;
            transform: translateY(-50%);
            z-index: 3;
        }
        body.light-mode .message-content-inner:has(.message-media-sticker) .message-time {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            color: rgba(255, 255, 255, 0.95);
        }

        /* Player de vídeo customizado (estilo WhatsApp: minimalista, overlay play, barra fina) */
        .message-media-video {
            position: relative;
            padding: 0;
            margin: 0;
            background: transparent;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            max-width: 280px;
            cursor: pointer;
        }
        .message-media-video video {
            max-width: 280px;
            max-height: 240px;
            width: auto;
            height: auto;
            display: block;
            border-radius: 8px;
            background: transparent;
        }
        /* Horário e 3 pontinhos por cima do vídeo, nos cantos */
        .message-content-inner:has(.message-media-video) {
            position: relative;
        }
        .message-content-inner:has(.message-media-video):not(:has(.message-text)) .message-time {
            position: absolute;
            bottom: 12px;
            left: 8px;
            z-index: 3;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.8);
            color: rgba(255, 255, 255, 0.95);
        }
        .message.received .message-content-inner:has(.message-media-video) .message-trailing-meta .message-options-btn {
            position: absolute;
            top: 50%;
            right: 8px;
            bottom: auto;
            transform: translateY(-50%);
            z-index: 3;
        }
        body.light-mode .message-content-inner:has(.message-media-video):not(:has(.message-text)) .message-time {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            color: rgba(255, 255, 255, 0.95);
        }
        /* Vídeo + legenda na mesma bolha: coluna só dentro do corpo — outer permanece em linha (⋮ | corpo | hora) */
        .message-content-inner:has(.message-media-video):has(.message-text) {
            position: relative;
        }
        .message-content-inner:has(.message-media-video):has(.message-text) .message-body-block {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            min-width: 0;
        }
        .message.sent .message-content-inner:has(.message-media-video):has(.message-text) .message-body-block {
            align-items: flex-end;
        }
        .message.sent .message-content-inner:has(.message-media-video):has(.message-text) .message-media-wrapper {
            align-self: flex-end;
        }
        /* Bloco do vídeo: não estica; altura só do vídeo para os ícones ficarem em cima do vídeo */
        .message-content-inner:has(.message-media-video):has(.message-text) .message-media-wrapper {
            align-self: flex-start;
            flex-shrink: 0;
        }
        .message-content-inner:has(.message-media-video):has(.message-text) .message-media-video {
            order: 0;
            margin-bottom: 0;
        }
        .message-content-inner:has(.message-media-video):has(.message-text) .message-text {
            order: 1;
            padding: 6px 52px 6px 8px;
            margin-top: 0;
            font-size: 0.9rem;
            line-height: 1.3;
            font-weight: 400;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        body.light-mode .message-content-inner:has(.message-media-video):has(.message-text) .message-text {
            border-color: rgba(0, 0, 0, 0.12);
        }
        .message.sent .message-content-inner:has(.message-media-video):has(.message-text) .message-text {
            background: #005c4b;
        }
        body.light-mode .message.sent .message-content-inner:has(.message-media-video):has(.message-text) .message-text {
            background: #dcf8c6;
        }
        .message.received .message-content-inner:has(.message-media-video):has(.message-text) .message-text {
            background: rgba(255, 255, 255, 0.05);
        }
        body.light-mode .message.received .message-content-inner:has(.message-media-video):has(.message-text) .message-text {
            background: rgba(0, 0, 0, 0.05);
        }
        .message-content-inner:has(.message-media-video):has(.message-text) .message-time {
            position: absolute;
            right: 28px;
            bottom: 6px;
            margin: 0;
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.7);
        }
        .message-content-inner:has(.message-media-video):has(.message-text) .message-status-icon {
            position: absolute;
            right: 8px;
            bottom: 6px;
        }
        body.light-mode .message-content-inner:has(.message-media-video):has(.message-text) .message-time {
            color: rgba(0, 0, 0, 0.5);
        }
        /* Horário e 3 pontinhos por cima da imagem, nos cantos (igual ao vídeo) */
        .message-content-inner:has(.message-media-image) {
            position: relative;
        }
        .message-content-inner:has(.message-media-image):not(:has(.message-text)) .message-time {
            position: absolute;
            bottom: 12px;
            left: 8px;
            z-index: 3;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.8);
            color: rgba(255, 255, 255, 0.95);
        }
        .message.received .message-content-inner:has(.message-media-image) .message-trailing-meta .message-options-btn {
            position: absolute;
            top: 50%;
            right: 8px;
            bottom: auto;
            transform: translateY(-50%);
            z-index: 3;
        }
        body.light-mode .message-content-inner:has(.message-media-image):not(:has(.message-text)) .message-time {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            color: rgba(255, 255, 255, 0.95);
        }
        /* Imagem + legenda: coluna dentro do .message-body-block (280px só no corpo; ⋮ fica fora) */
        .message-content-inner:has(.message-media-image):has(.message-text) {
            position: relative;
        }
        .message-content-inner:has(.message-media-image):has(.message-text) .message-body-block {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            min-width: 0;
            max-width: 280px;
        }
        .message.sent .message-content-inner:has(.message-media-image):has(.message-text) .message-body-block {
            align-items: flex-end;
        }
        .message.sent .message-content-inner:has(.message-media-image):has(.message-text) .message-media-wrapper {
            align-self: flex-end;
        }
        /* Bloco da imagem: não estica; altura só da imagem para os ícones ficarem em cima da imagem */
        .message-content-inner:has(.message-media-image):has(.message-text) .message-media-wrapper {
            align-self: flex-start;
            flex-shrink: 0;
        }
        .message-content-inner:has(.message-media-image):has(.message-text) .message-media-image {
            order: 0;
            margin-bottom: 0;
        }
        .message-content-inner:has(.message-media-image):has(.message-text) .message-text {
            order: 1;
            padding: 6px 52px 6px 8px;
            margin-top: 0;
            margin-left: 0;
            margin-right: 0;
            font-size: 0.9rem;
            line-height: 1.3;
            font-weight: 400;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        body.light-mode .message-content-inner:has(.message-media-image):has(.message-text) .message-text {
            border-color: rgba(0, 0, 0, 0.12);
        }
        /* Legenda com background (primeiro background - mesma cor do balão) */
        .message.sent .message-content-inner:has(.message-media-image):has(.message-text) .message-text {
            background: #005c4b;
        }
        body.light-mode .message.sent .message-content-inner:has(.message-media-image):has(.message-text) .message-text {
            background: #dcf8c6;
        }
        .message.received .message-content-inner:has(.message-media-image):has(.message-text) .message-text {
            background: rgba(255, 255, 255, 0.05);
        }
        body.light-mode .message.received .message-content-inner:has(.message-media-image):has(.message-text) .message-text {
            background: rgba(0, 0, 0, 0.05);
        }
        .message-content-inner:has(.message-media-image):has(.message-text) .message-time {
            position: absolute;
            right: 28px;
            bottom: 6px;
            margin: 0;
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.7);
        }
        .message-content-inner:has(.message-media-image):has(.message-text) .message-status-icon {
            position: absolute;
            right: 8px;
            bottom: 6px;
        }
        body.light-mode .message-content-inner:has(.message-media-image):has(.message-text) .message-time {
            color: rgba(0, 0, 0, 0.5);
        }
        /* Legenda mídia + texto: hora/status na faixa .message-trailing-meta (fluxo normal, sem absolute) */
        .message-content-inner:has(.message-body-block):has(.message-media-image):has(.message-text) .message-time,
        .message-content-inner:has(.message-body-block):has(.message-media-image):has(.message-text) .message-status-icon,
        .message-content-inner:has(.message-body-block):has(.message-media-video):has(.message-text) .message-time,
        .message-content-inner:has(.message-body-block):has(.message-media-video):has(.message-text) .message-status-icon,
        .message-content-inner:has(.message-body-block):has(.message-media-document):has(.message-text) .message-time,
        .message-content-inner:has(.message-body-block):has(.message-media-document):has(.message-text) .message-status-icon {
            position: static;
            right: auto;
            bottom: auto;
            margin: 0;
        }
        .message-content-inner:has(.message-body-block):has(.message-media-image):has(.message-text) .message-text,
        .message-content-inner:has(.message-body-block):has(.message-media-video):has(.message-text) .message-text,
        .message-content-inner:has(.message-body-block):has(.message-media-document):has(.message-text) .message-text {
            padding-right: 10px;
        }
        /* Horário e 3 pontinhos dentro do bloquinho do documento */
        .message-content-inner:has(.message-media-document) {
            position: relative;
        }
        .message-content-inner:has(.message-media-document):not(:has(.message-text)) .message-time {
            position: absolute;
            bottom: 8px;
            right: 8px;
            z-index: 2;
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.7);
        }
        .message.received .message-content-inner:has(.message-media-document) .message-trailing-meta .message-options-btn {
            position: absolute;
            top: 50%;
            right: 8px;
            bottom: auto;
            transform: translateY(-50%);
            z-index: 2;
        }
        body.light-mode .message-content-inner:has(.message-media-document):not(:has(.message-text)) .message-time {
            color: rgba(0, 0, 0, 0.55);
        }
        /* Documento + legenda: coluna dentro do .message-body-block */
        .message-content-inner:has(.message-media-document):has(.message-text) {
            position: relative;
        }
        .message-content-inner:has(.message-media-document):has(.message-text) .message-body-block {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            justify-content: flex-start;
            min-width: 0;
        }
        .message-content-inner:has(.message-media-document):has(.message-text) .message-media-document {
            order: 0;
            margin-bottom: 0;
        }
        .message-content-inner:has(.message-media-document):has(.message-text) .message-text {
            order: 1;
            padding: 6px 52px 6px 10px;
            margin-top: 0;
            font-size: 0.9rem;
            line-height: 1.3;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        body.light-mode .message-content-inner:has(.message-media-document):has(.message-text) .message-text {
            border-color: rgba(0, 0, 0, 0.12);
        }
        .message.sent .message-content-inner:has(.message-media-document):has(.message-text) .message-text {
            background: #005c4b;
        }
        body.light-mode .message.sent .message-content-inner:has(.message-media-document):has(.message-text) .message-text {
            background: #dcf8c6;
        }
        .message.received .message-content-inner:has(.message-media-document):has(.message-text) .message-text {
            background: rgba(255, 255, 255, 0.05);
        }
        body.light-mode .message.received .message-content-inner:has(.message-media-document):has(.message-text) .message-text {
            background: rgba(0, 0, 0, 0.05);
        }
        .message-content-inner:has(.message-media-document):has(.message-text) .message-time {
            position: absolute;
            right: 28px;
            bottom: 8px;
            margin: 0;
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.7);
        }
        .message-content-inner:has(.message-media-document):has(.message-text) .message-status-icon {
            position: absolute;
            right: 8px;
            bottom: 6px;
        }
        body.light-mode .message-content-inner:has(.message-media-document):has(.message-text) .message-time {
            color: rgba(0, 0, 0, 0.5);
        }
        /* Documento enviado (fromMe): horário, 3 pontos e ícone de status bem encaixados dentro do balão */
        .message.sent .message-content-inner:has(.message-media-document) .message-time {
            bottom: 8px;
            right: 24px;
            margin: 0;
        }
        .message.sent .message-content-inner:has(.message-media-document) .message-status-icon {
            position: absolute;
            bottom: 8px;
            right: 6px;
            margin: 0;
            z-index: 2;
        }
        .message.sent .message-media-document {
            padding-right: 72px;
        }
        .video-player-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.35);
            border-radius: 8px;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }
        .video-player-overlay .video-player-btn {
            pointer-events: auto;
        }
        .video-player-widget.is-playing .video-player-overlay {
            opacity: 0;
            pointer-events: none;
        }
        .video-player-widget.is-playing:hover .video-player-overlay {
            opacity: 1;
            pointer-events: none;
        }
        .video-player-widget.is-playing:hover .video-player-overlay .video-player-btn {
            pointer-events: auto;
        }
        .video-player-btn .icon-pause {
            display: none;
        }
        .video-player-widget.is-playing .video-player-btn .icon-play {
            display: none;
        }
        .video-player-widget.is-playing .video-player-btn .icon-pause {
            display: block;
        }
        .video-player-btn {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: none;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: auto;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.4);
        }
        .video-player-btn:hover {
            background: rgba(0, 0, 0, 0.7);
            transform: scale(1.08);
        }
        .video-player-btn svg {
            width: 28px;
            height: 28px;
            margin-left: 4px;
        }
        .video-player-widget.is-playing .video-player-btn {
            width: 44px;
            height: 44px;
        }
        .video-player-widget.is-playing .video-player-btn svg {
            width: 22px;
            height: 22px;
            margin-left: 0;
        }
        .video-player-progress-wrap {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 3px;
            background: rgba(255, 255, 255, 0.25);
            cursor: pointer;
            pointer-events: auto;
        }
        .video-player-progress-fill {
            height: 100%;
            background: #6C63FF;
            width: 0%;
            border-radius: 0 0 0 0;
            transition: width 0.1s linear;
        }
        .video-player-progress-wrap input[type="range"] {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            -webkit-appearance: none;
            appearance: none;
        }
        /* Sem segundo background/borda/padding no balão quando for só mídia – imagem e vídeo colados, sem “moldura” */
        .message.received .message-content:has(.message-media-video),
        .message.received .message-content:has(.message-media-image),
        .message.received .message-content:has(.message-media-document),
        .message.received .message-content:has(.message-media-sticker) {
            background: transparent;
            border: none;
            padding: 0;
        }
        body.light-mode .message.received .message-content:has(.message-media-video),
        body.light-mode .message.received .message-content:has(.message-media-image),
        body.light-mode .message.received .message-content:has(.message-media-document),
        body.light-mode .message.received .message-content:has(.message-media-sticker) {
            background: transparent;
            border: none;
        }
        .message.sent .message-content:has(.message-media-video),
        .message.sent .message-content:has(.message-media-image),
        .message.sent .message-content:has(.message-media-document),
        .message.sent .message-content:has(.message-media-sticker) {
            background: transparent;
            border: none;
            padding: 0;
        }
        body.light-mode .message.sent .message-content:has(.message-media-video),
        body.light-mode .message.sent .message-content:has(.message-media-image),
        body.light-mode .message.sent .message-content:has(.message-media-document),
        body.light-mode .message.sent .message-content:has(.message-media-sticker) {
            background: transparent;
            border: none;
        }

        /* Mídia + legenda: sem background no content/inner (só na legenda), sem borda no bloco */
        .message.received .message-content:has(.message-media-image):has(.message-text),
        .message.received .message-content:has(.message-media-video):has(.message-text),
        .message.received .message-content:has(.message-media-document):has(.message-text) {
            background: transparent;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            padding: 0;
        }
        body.light-mode .message.received .message-content:has(.message-media-image):has(.message-text),
        body.light-mode .message.received .message-content:has(.message-media-video):has(.message-text),
        body.light-mode .message.received .message-content:has(.message-media-document):has(.message-text) {
            background: transparent;
            border: none;
        }
        .message.sent .message-content:has(.message-media-image):has(.message-text),
        .message.sent .message-content:has(.message-media-video):has(.message-text),
        .message.sent .message-content:has(.message-media-document):has(.message-text) {
            background: transparent;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            padding: 0;
            box-shadow: none;
        }
        /* Padding no inner; sem background (herda transparent do content) */
        .message-content-inner:has(.message-media-image):has(.message-text),
        .message-content-inner:has(.message-media-video):has(.message-text),
        .message-content-inner:has(.message-media-document):has(.message-text) {
            padding: 0 8px 6px 8px;
            background: transparent;
        }

        /* Wrapper da mídia (imagem/vídeo): botões ficam dentro da área da mídia; sem background */
        .message-media-wrapper {
            position: relative;
            display: inline-block;
            max-width: 100%;
            border-radius: 8px;
            overflow: hidden;
            background: transparent;
        }
        .message-media-wrapper .message-media {
            display: block;
            margin: 0;
        }
        /* Container dos botões: cobre só a área da imagem, desvinculado do horário */
        .message-media-actions {
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
        }
        .message-media-actions .message-options-btn,
        .message-media-actions .media-fullscreen-btn {
            pointer-events: auto;
            margin: 0;
        }
        /* Três pontos: direita, centrado na altura da mídia */
        .message-media-actions .message-options-btn {
            position: absolute;
            top: 50%;
            right: 8px;
            bottom: auto;
            transform: translateY(-50%);
        }
        /* Tela cheia: embaixo à direita, dentro da imagem */
        .message-media-actions .media-fullscreen-btn {
            position: absolute;
            bottom: 12px;
            right: 8px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, transform 0.15s;
        }
        .message-media-actions .media-fullscreen-btn:hover {
            background: rgba(0, 0, 0, 0.75);
            transform: scale(1.08);
        }
        .message-media-actions .media-fullscreen-btn svg {
            width: 18px;
            height: 18px;
        }
        /* Botão tela cheia em imagem e vídeo (quando fora do wrapper, fallback) */
        .media-fullscreen-btn {
            position: absolute;
            bottom: 12px;
            right: 8px;
            z-index: 3;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, transform 0.15s;
        }
        .media-fullscreen-btn:hover {
            background: rgba(0, 0, 0, 0.75);
            transform: scale(1.08);
        }
        .media-fullscreen-btn svg {
            width: 18px;
            height: 18px;
        }
        /* Overlay tela cheia para imagem — acima do input do chat para mostrar só a imagem */
        .media-fullscreen-overlay {
            position: fixed;
            inset: 0;
            z-index: 200000;
            background: rgba(0, 0, 0, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .media-fullscreen-overlay img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .media-fullscreen-overlay .media-fullscreen-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        .media-fullscreen-overlay .media-fullscreen-close:hover {
            background: rgba(255, 255, 255, 0.35);
        }
        .media-fullscreen-overlay .media-fullscreen-close svg {
            width: 24px;
            height: 24px;
        }

        /* Player de áudio customizado (estilo WhatsApp, minimalista) */
        .message-media-audio {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0;
            min-width: 200px;
            max-width: 280px;
            background: transparent;
            border: none;
        }
        body.light-mode .message-media-audio {
            background: transparent;
            border: none;
        }
        .message-media-audio audio {
            position: absolute;
            width: 0;
            height: 0;
            opacity: 0;
            pointer-events: none;
        }
        .audio-player-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: #6C63FF;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.15s;
        }
        .audio-player-btn:hover {
            background: #20ba5a;
            transform: scale(1.05);
        }
        body.light-mode .audio-player-btn {
            background: #6C63FF;
        }
        body.light-mode .audio-player-btn:hover {
            background: #0d6b60;
        }
        .audio-player-btn .icon-pause {
            display: none;
        }
        .audio-player-widget.is-playing .audio-player-btn .icon-play {
            display: none;
        }
        .audio-player-widget.is-playing .audio-player-btn .icon-pause {
            display: block;
        }
        .audio-player-waveform {
            display: flex;
            align-items: center;
            gap: 3px;
            height: 24px;
        }
        .audio-player-waveform .bar {
            width: 3px;
            min-height: 4px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.5);
            transition: height 0.15s ease;
        }
        body.light-mode .audio-player-waveform .bar {
            background: rgba(0, 0, 0, 0.35);
        }
        .audio-player-widget.is-playing .audio-player-waveform .bar {
            animation: audio-bar 0.5s ease-in-out infinite alternate;
        }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(1) { animation-delay: 0s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(2) { animation-delay: 0.05s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(3) { animation-delay: 0.1s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(4) { animation-delay: 0.15s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(5) { animation-delay: 0.2s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(6) { animation-delay: 0.25s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(7) { animation-delay: 0.3s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(8) { animation-delay: 0.35s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(9) { animation-delay: 0.4s; }
        .audio-player-widget.is-playing .audio-player-waveform .bar:nth-child(10) { animation-delay: 0.45s; }
        @keyframes audio-bar {
            0% { height: 6px; }
            100% { height: 20px; }
        }
        .audio-player-main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .audio-player-progress-wrap {
            position: relative;
            height: 4px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.15);
            cursor: pointer;
        }
        body.light-mode .audio-player-progress-wrap {
            background: rgba(0, 0, 0, 0.12);
        }
        .audio-player-progress-fill {
            height: 100%;
            border-radius: 2px;
            background: #6C63FF;
            width: 0%;
            transition: width 0.1s linear;
        }
        body.light-mode .audio-player-progress-fill {
            background: #6C63FF;
        }
        .audio-player-progress-wrap input[type="range"] {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            -webkit-appearance: none;
            appearance: none;
        }
        .audio-player-time {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.7);
        }
        body.light-mode .audio-player-time {
            color: rgba(0, 0, 0, 0.55);
        }

        /* Documento: card minimalista com tipo e botão baixar */
        .message-media-document {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px 10px 12px;
            padding-right: 56px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            max-width: 320px;
            min-width: 200px;
        }
        body.light-mode .message-media-document {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.08);
        }
        .document-icon-wrap {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.1rem;
        }
        .document-icon-wrap.pdf { background: #e74c3c; color: #fff; }
        .document-icon-wrap.word { background: #2b579a; color: #fff; }
        .document-icon-wrap.excel { background: #217346; color: #fff; }
        .document-icon-wrap.ppt { background: #d24726; color: #fff; }
        .document-icon-wrap.image { background: #8e44ad; color: #fff; }
        .document-icon-wrap.generic { background: rgba(255, 255, 255, 0.12); color: rgba(255, 255, 255, 0.9); }
        body.light-mode .document-icon-wrap.generic { background: rgba(0, 0, 0, 0.08); color: #333; }
        .document-info {
            flex: 1;
            min-width: 0;
        }
        .document-type {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 2px;
        }
        body.light-mode .document-type {
            color: rgba(0, 0, 0, 0.5);
        }
        .document-name {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.95);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        body.light-mode .document-name {
            color: #333;
        }
        .document-download {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(108, 99, 255, 0.25);
            color: #6C63FF;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.15s;
            text-decoration: none;
        }
        .document-download:hover {
            background: rgba(108, 99, 255, 0.4);
            transform: scale(1.05);
        }
        body.light-mode .document-download {
            background: rgba(108, 99, 255, 0.2);
            color: #6C63FF;
        }
        body.light-mode .document-download:hover {
            background: rgba(108, 99, 255, 0.35);
        }
        .document-download svg {
            width: 18px;
            height: 18px;
        }

        .message-time {
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.7);
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 2px;
            justify-content: flex-end;
            flex-shrink: 0;
            margin-left: auto;
            order: 2;
            vertical-align: bottom;
        }
        
        /* Texto nas mensagens enviadas: ordem após o botão */
        .message.sent .message-text {
            order: 1;
        }
        
        /* Texto nas mensagens recebidas: ordem após o botão */
        .message.received .message-text {
            order: 1;
        }

        body.light-mode .message-time {
            color: rgba(0, 0, 0, 0.6);
        }

        /* Hora de mensagens enviadas: alinhada à direita */
        .message.sent .message-time {
            text-align: right;
            justify-content: flex-end;
            color: rgba(255, 255, 255, 0.7);
        }

        body.light-mode .message.sent .message-time {
            color: rgba(5, 95, 70, 0.7);
        }

        /* Hora de mensagens recebidas: alinhada à esquerda */
        .message.received .message-time {
            text-align: left;
            justify-content: flex-start;
        }

        /* Ícone de status da mensagem (relógio ou check) */
        .message-status-icon {
            width: 14px;
            height: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-left: 1px;
            order: 3;
            vertical-align: bottom;
        }

        .message-status-icon svg {
            width: 100%;
            height: 100%;
        }

        /* Relógio (enviada: false) */
        .message-status-icon.clock {
            color: rgba(255, 255, 255, 0.7);
        }

        body.light-mode .message-status-icon.clock {
            color: rgba(0, 0, 0, 0.6);
        }

        /* Check (enviada: true) - dois checkmarks brancos como WhatsApp */
        .message-status-icon.check {
            color: rgba(255, 255, 255, 0.9);
        }

        body.light-mode .message-status-icon.check {
            color: #6C63FF;
        }

        /* Preview da mensagem respondida (estilo WhatsApp) */
        .message-reply-preview {
            border-left: 3px solid rgba(255, 255, 255, 0.5);
            padding: 6px 8px;
            margin-bottom: 2px;
            border-radius: 4px;
            background: rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: background 0.2s ease;
            display: flex;
            flex-direction: column;
            gap: 2px;
            width: 100%;
            order: 0;
        }

        .message.sent .message-reply-preview {
            border-left-color: rgba(255, 255, 255, 0.6);
            background: rgba(0, 0, 0, 0.15);
        }

        .message.received .message-reply-preview {
            border-left-color: #6C63FF;
            background: rgba(108, 99, 255, 0.1);
        }

        body.light-mode .message.sent .message-reply-preview {
            border-left-color: rgba(0, 0, 0, 0.3);
            background: rgba(0, 0, 0, 0.05);
        }

        body.light-mode .message.received .message-reply-preview {
            border-left-color: #6C63FF;
            background: rgba(108, 99, 255, 0.08);
        }

        .message-reply-preview:hover {
            background: rgba(0, 0, 0, 0.3);
        }

        body.light-mode .message-reply-preview:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .message-reply-preview-author {
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            opacity: 0.9;
        }

        .message.sent .message-reply-preview-author {
            color: rgba(255, 255, 255, 0.9);
        }

        .message.received .message-reply-preview-author {
            color: #6C63FF;
        }

        body.light-mode .message.sent .message-reply-preview-author {
            color: rgba(0, 0, 0, 0.7);
        }

        body.light-mode .message.received .message-reply-preview-author {
            color: #6C63FF;
        }

        .message-reply-preview-text {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
        }

        .message.sent .message-reply-preview-text {
            color: rgba(255, 255, 255, 0.8);
        }

        .message.received .message-reply-preview-text {
            color: rgba(255, 255, 255, 0.7);
        }

        body.light-mode .message-reply-preview-text {
            color: rgba(0, 0, 0, 0.6);
        }

        body.light-mode .message.sent .message-reply-preview-text {
            color: rgba(0, 0, 0, 0.6);
        }

        body.light-mode .message.received .message-reply-preview-text {
            color: rgba(0, 0, 0, 0.6);
        }

        /* Glow na mensagem ao clicar no preview da resposta */
        .message.glow {
            border-radius: 12px;
            animation: message-glow 2s ease-out;
        }
        @keyframes message-glow {
            0% {
                box-shadow: 0 0 0 0 rgba(108, 99, 255, 0.8), 0 0 20px 4px rgba(108, 99, 255, 0.3);
            }
            60% {
                box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.4), 0 0 16px 8px rgba(108, 99, 255, 0.15);
            }
            100% {
                box-shadow: none;
            }
        }
        body.light-mode .message.glow {
            border-radius: 12px;
            animation: message-glow-light 2s ease-out;
        }
        @keyframes message-glow-light {
            0% {
                box-shadow: 0 0 0 0 rgba(108, 99, 255, 0.7), 0 0 20px 4px rgba(108, 99, 255, 0.25);
            }
            60% {
                box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.35), 0 0 16px 8px rgba(108, 99, 255, 0.1);
            }
            100% {
                box-shadow: none;
            }
        }

        /* Botão de opções: faixa fixa na lateral (sem animar largura — evita “crescer” a altura da bolha) */
        .message-options-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            flex-shrink: 0;
        }
        .message-trailing-meta .message-options-btn {
            opacity: 0;
            width: 26px;
            min-width: 26px;
            max-width: 26px;
            height: 26px;
            padding: 0;
            margin: 0;
            overflow: visible;
            transition: opacity 0.2s ease;
        }
        .message.received:hover .message-trailing-meta .message-options-btn {
            opacity: 1;
        }
        .message-trailing-meta .message-options-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }
        .message-media-actions .message-options-btn {
            opacity: 0.88;
            width: 36px;
            min-width: 36px;
            max-width: 36px;
            height: 36px;
            padding: 0;
            margin: 0;
            overflow: visible;
            transition: opacity 0.2s ease;
        }
        .message:hover .message-media-actions .message-options-btn {
            opacity: 1;
        }
        .message-media-actions .message-options-btn svg {
            width: 18px;
            height: 18px;
        }

        .message-options-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.9);
        }

        body.light-mode .message-options-btn {
            color: rgba(0, 0, 0, 0.5);
        }

        body.light-mode .message-options-btn:hover {
            background: rgba(0, 0, 0, 0.08);
            color: rgba(0, 0, 0, 0.8);
        }

        body.light-mode .message-leading-options .message-options-btn {
            color: rgba(0, 0, 0, 0.45);
        }

        /* Menu de opções da mensagem */
        .message-options-menu {
            position: absolute;
            background: rgba(30, 30, 30, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 4px;
            min-width: 120px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 10000;
            display: none;
            pointer-events: auto;
        }

        body.light-mode .message-options-menu {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .message-options-menu.show {
            display: block !important;
        }

        .message-options-item {
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-size: 0.9rem;
            transition: background 0.2s ease;
        }

        .message-options-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        body.light-mode .message-options-item {
            color: #333;
        }

        body.light-mode .message-options-item:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        /* Mensagem apagada: mesmo layout flex que mensagens normais (body-block + trailing-meta) */
        .message.message-apagada .message-content {
            opacity: 0.92;
        }
        .message-apagada-row {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            max-width: 100%;
        }
        .message-apagada-row--with-content {
            align-items: center;
            width: 100%;
        }
        .message-apagada-preserved {
            flex: 1;
            min-width: 0;
            opacity: 0.48;
            filter: grayscale(0.9);
            color: rgba(255, 255, 255, 0.5) !important;
            line-height: 1.4;
            pointer-events: none;
        }
        .message-apagada-preserved .message-text {
            color: inherit !important;
            font-style: normal;
        }
        .message-apagada-preserved img,
        .message-apagada-preserved video {
            max-height: 120px;
            border-radius: 8px;
        }
        .message.sent.message-apagada .message-apagada-preserved {
            color: rgba(255, 255, 255, 0.48) !important;
        }
        body.light-mode .message-apagada-preserved {
            color: rgba(0, 0, 0, 0.45) !important;
            filter: grayscale(0.85);
        }
        body.light-mode .message.sent.message-apagada .message-apagada-preserved {
            color: rgba(0, 0, 0, 0.42) !important;
        }
        .message-apagada-icon {
            flex-shrink: 0;
            display: inline-flex;
            color: rgba(255, 255, 255, 0.35);
        }
        .message-apagada-icon svg {
            width: 15px;
            height: 15px;
        }
        .message-apagada-text {
            font-size: 0.82rem !important;
            font-style: italic;
            color: rgba(255, 255, 255, 0.38) !important;
            line-height: 1.35;
        }
        .message.sent.message-apagada .message-apagada-text {
            color: rgba(255, 255, 255, 0.36) !important;
        }
        body.light-mode .message-apagada-icon {
            color: rgba(0, 0, 0, 0.35);
        }
        body.light-mode .message-apagada-text {
            color: rgba(0, 0, 0, 0.42) !important;
        }
        body.light-mode .message.sent.message-apagada .message-apagada-text {
            color: rgba(0, 0, 0, 0.4) !important;
        }

        .message-favorite-star {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            color: #eab308;
            margin-right: 4px;
            vertical-align: middle;
            opacity: 0.95;
        }
        .message-favorite-star svg {
            display: block;
        }
        .message-scroll-highlight {
            animation: messageScrollHighlightPulse 1.6s ease-out 1;
        }
        @keyframes messageScrollHighlightPulse {
            0% { box-shadow: 0 0 0 0 rgba(234, 179, 8, 0.55); }
            100% { box-shadow: 0 0 0 12px rgba(234, 179, 8, 0); }
        }

        .contact-details-favorites-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 220px;
            overflow-y: auto;
        }
        .contact-details-favorite-row {
            display: block;
            width: 100%;
            text-align: left;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.04);
            cursor: pointer;
            color: rgba(255, 255, 255, 0.88);
            font-size: 0.85rem;
            line-height: 1.35;
            transition: background 0.15s;
        }
        .contact-details-favorite-row:hover {
            background: rgba(255, 255, 255, 0.08);
        }
        .contact-details-favorite-row-inner {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            width: 100%;
        }
        .contact-details-favorite-star {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            color: #eab308;
            margin-top: 1px;
        }
        .contact-details-favorite-star svg {
            width: 13px;
            height: 13px;
            display: block;
        }
        .contact-details-favorite-row-preview {
            flex: 1;
            min-width: 0;
            word-break: break-word;
        }
        body.light-mode .contact-details-favorite-row {
            border-color: rgba(0, 0, 0, 0.1);
            background: rgba(0, 0, 0, 0.04);
            color: #333;
        }
        body.light-mode .contact-details-favorite-row:hover {
            background: rgba(0, 0, 0, 0.07);
        }

        .message-options-item--delete {
            color: #ff8a8a;
        }
        .message-options-item--delete:hover {
            background: rgba(255, 80, 80, 0.12);
        }
        body.light-mode .message-options-item--delete {
            color: #c62828;
        }
        body.light-mode .message-options-item--delete:hover {
            background: rgba(198, 40, 40, 0.08);
        }

        .message-options-item svg {
            width: 16px;
            height: 16px;
        }

        /* Área de resposta (acima do input) */
        .reply-preview {
            background: rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            display: none;
            align-items: center;
            gap: 12px;
        }

        .reply-preview.show {
            display: flex;
        }

        body.light-mode .reply-preview {
            background: rgba(0, 0, 0, 0.02);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .reply-preview-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .reply-preview-label {
            font-size: 0.75rem;
            color: #888;
            font-weight: 500;
        }

        body.light-mode .reply-preview-label {
            color: #666;
        }

        .reply-preview-text {
            font-size: 0.85rem;
            color: white;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        body.light-mode .reply-preview-text {
            color: #333;
        }

        .reply-preview-close {
            background: none;
            border: none;
            color: #888;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .reply-preview-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ff6b6b;
        }

        body.light-mode .reply-preview-close {
            color: #666;
        }

        body.light-mode .reply-preview-close:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .reply-preview-close svg {
            width: 18px;
            height: 18px;
        }

        .chat-input-area {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            position: relative;
            /* Garante que menus do rodapé (respostas rápidas, mídia) fiquem acima das mensagens,
               horários e botões de tela cheia. */
            z-index: 100002;
        }

        body.light-mode .chat-input-area {
            background: rgba(255, 255, 255, 0.95);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Painel "Dados do contato" aberto: rodapé fica sob o overlay (como o resto da tela) */
        .chat-area:has(#contactDetailsOverlay.open) #chatInputArea {
            z-index: 1;
            pointer-events: none;
        }

        .chat-input {
            flex: 1;
            min-width: 0;
            padding: 10px 16px;
            background: transparent;
            border: none;
            border-radius: 0;
            color: white;
            font-size: 0.9rem;
            outline: none;
            resize: none;
            line-height: 1.35;
            min-height: 22px;
            max-height: calc(1.35em * 4 + 20px);
            overflow-y: hidden;
            white-space: pre-wrap;
            word-break: break-word;
        }

        body.light-mode .chat-input {
            color: #333;
        }

        .chat-input::placeholder {
            color: #888;
        }

        body.light-mode .chat-input::placeholder {
            color: #999;
        }

        .chat-send-btn {
            background: #6C63FF;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .chat-send-btn:hover {
            background: #20ba5a;
            transform: scale(1.05);
        }

        .chat-send-btn:disabled {
            background: #888;
            cursor: not-allowed;
            transform: none;
        }

        .chat-send-btn svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .chat-input-wrap {
            display: flex;
            align-items: flex-end;
            gap: 10px;
            flex: 1;
            min-width: 0;
        }

        .chat-input-outer {
            flex: 1;
            min-width: 0;
            display: flex;
            align-items: flex-end;
            gap: 0;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            overflow: hidden;
        }
        body.light-mode .chat-input-outer {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.1);
        }

        .chat-mic-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
            color: white;
        }
        .chat-mic-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.05);
        }
        .chat-mic-btn svg {
            width: 20px;
            height: 20px;
        }
        body.light-mode .chat-mic-btn {
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.1);
            color: #333;
        }
        body.light-mode .chat-mic-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        /* Botão de adicionar mídia (+) */
        .chat-add-media-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
            color: white;
            font-size: 24px;
            font-weight: 300;
            line-height: 1;
        }
        .chat-add-media-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.05);
        }
        body.light-mode .chat-add-media-btn {
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.1);
            color: #333;
        }
        body.light-mode .chat-add-media-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        /* Botão respostas rápidas (/) */
        .chat-quick-replies-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1;
        }
        .chat-quick-replies-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.05);
        }
        body.light-mode .chat-quick-replies-btn {
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.1);
            color: #333;
        }
        body.light-mode .chat-quick-replies-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        /* Teclado de emojis */
        .chat-emoji-picker-wrap {
            position: relative;
            flex-shrink: 0;
        }
        .chat-emoji-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
            padding: 0;
        }
        .chat-emoji-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.05);
        }
        .chat-emoji-btn.active {
            border-color: rgba(255, 193, 7, 0.65);
            background: rgba(255, 193, 7, 0.12);
        }
        body.light-mode .chat-emoji-btn {
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.1);
        }
        body.light-mode .chat-emoji-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }
        body.light-mode .chat-emoji-btn.active {
            border-color: rgba(218, 165, 32, 0.8);
            background: rgba(255, 193, 7, 0.15);
        }
        .chat-emoji-btn-icon {
            font-size: 1.35rem;
            line-height: 1;
        }
        .emoji-picker-panel {
            display: none;
            flex-direction: column;
            position: absolute;
            bottom: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
            width: min(300px, calc(100vw - 32px));
            max-height: min(280px, 42vh);
            background: #2a2a2a;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.45);
            z-index: 100003;
            overflow: hidden;
        }
        .emoji-picker-panel.show {
            display: flex;
        }
        body.light-mode .emoji-picker-panel {
            background: #fff;
            border-color: rgba(0, 0, 0, 0.12);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.12);
        }
        .emoji-picker-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            padding: 8px 8px 6px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            flex-shrink: 0;
        }
        body.light-mode .emoji-picker-tabs {
            border-bottom-color: rgba(0, 0, 0, 0.08);
        }
        .emoji-picker-tab {
            flex: 1;
            min-width: 36px;
            padding: 6px 4px;
            border: none;
            border-radius: 8px;
            background: transparent;
            cursor: pointer;
            font-size: 1.15rem;
            line-height: 1;
            opacity: 0.55;
            transition: background 0.15s, opacity 0.15s;
        }
        .emoji-picker-tab:hover {
            opacity: 0.9;
            background: rgba(255, 255, 255, 0.06);
        }
        .emoji-picker-tab.active {
            opacity: 1;
            background: rgba(255, 255, 255, 0.12);
        }
        body.light-mode .emoji-picker-tab:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        body.light-mode .emoji-picker-tab.active {
            background: rgba(0, 0, 0, 0.08);
        }
        .emoji-picker-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 2px;
            padding: 8px;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }
        .emoji-picker-cell {
            border: none;
            border-radius: 8px;
            background: transparent;
            font-size: 1.35rem;
            line-height: 1.2;
            padding: 4px 2px;
            cursor: pointer;
            transition: background 0.12s, transform 0.12s;
        }
        .emoji-picker-cell:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.12);
        }
        body.light-mode .emoji-picker-cell:hover {
            background: rgba(0, 0, 0, 0.06);
        }

        /* Botão assinatura (ícone lápis) — quando ativo: borda verde do sistema */
        .chat-signature-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
            color: white;
        }
        .chat-signature-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.05);
        }
        .chat-signature-btn.active {
            border: 2px solid #6C63FF;
            background: rgba(108, 99, 255, 0.15);
            box-shadow: 0 0 0 1px rgba(108, 99, 255, 0.3);
        }
        .chat-signature-btn.active:hover {
            background: rgba(108, 99, 255, 0.2);
        }
        body.light-mode .chat-signature-btn {
            background: rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.1);
            color: #333;
        }
        body.light-mode .chat-signature-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }
        body.light-mode .chat-signature-btn.active {
            border-color: #6C63FF;
            background: rgba(108, 99, 255, 0.12);
        }
        .chat-signature-btn svg {
            width: 20px;
            height: 20px;
        }

        /* Menu de respostas rápidas — sempre por cima do conteúdo do chat (horário, tela cheia, etc.) */
        .quick-replies-menu {
            position: absolute;
            bottom: 75px;
            left: 20px;
            background: #2a2a2a;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 8px 0;
            min-width: 220px;
            max-width: 320px;
            /* Máximo 7 itens visíveis; o restante com scroll (cada item ~38px) */
            max-height: 266px;
            overflow-y: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 100001;
        }
        .quick-replies-menu.show {
            display: block;
        }
        body.light-mode .quick-replies-menu {
            background: white;
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .quick-replies-list {
            display: flex;
            flex-direction: column;
        }
        .quick-reply-item {
            display: block;
            width: 100%;
            padding: 10px 14px;
            text-align: left;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.15s;
        }
        .quick-reply-item:hover {
            background: rgba(255, 255, 255, 0.08);
        }
        .quick-reply-item:not(:last-child) {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }
        body.light-mode .quick-reply-item {
            color: #333;
        }
        body.light-mode .quick-reply-item:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        body.light-mode .quick-reply-item:not(:last-child) {
            border-bottom-color: rgba(0, 0, 0, 0.06);
        }
        .quick-replies-empty {
            padding: 14px;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }
        body.light-mode .quick-replies-empty {
            color: #666;
        }

        /* Menu de opções de mídia */
        .media-options-menu {
            position: absolute;
            bottom: 75px;
            left: 20px;
            background: #2a2a2a;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 8px 0;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 1000;
        }
        .media-options-menu.show {
            display: block;
        }
        body.light-mode .media-options-menu {
            background: white;
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .media-option-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: background 0.2s ease;
            color: white;
        }
        .media-option-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        body.light-mode .media-option-item {
            color: #333;
        }
        body.light-mode .media-option-item:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        .media-option-item svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }
        .media-option-item span {
            font-size: 0.9rem;
        }

        /* Preview de mídia antes de enviar — acima do input do chat (como tela cheia) */
        .media-preview-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 200000;
            padding: 20px;
        }
        .media-preview-overlay.show {
            display: flex;
        }
        .media-preview-container {
            background: #2a2a2a;
            border-radius: 16px;
            padding: 20px;
            max-width: 600px;
            width: 100%;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        body.light-mode .media-preview-container {
            background: white;
        }
        .media-preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }
        body.light-mode .media-preview-header {
            color: #333;
        }
        .media-preview-title {
            font-size: 1.1rem;
            font-weight: 500;
        }
        .media-preview-close {
            background: none;
            border: none;
            color: #888;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .media-preview-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        body.light-mode .media-preview-close:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #333;
        }
        .media-preview-close svg {
            width: 24px;
            height: 24px;
        }
        .media-preview-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: auto;
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.3);
        }
        body.light-mode .media-preview-content {
            background: rgba(0, 0, 0, 0.05);
        }
        .media-preview-content img {
            max-width: 100%;
            max-height: 60vh;
            border-radius: 8px;
        }
        .media-preview-content video {
            max-width: 100%;
            max-height: 60vh;
            border-radius: 8px;
        }
        .media-preview-document {
            padding: 40px;
            text-align: center;
            color: white;
        }
        body.light-mode .media-preview-document {
            color: #333;
        }
        .media-preview-document-icon {
            font-size: 64px;
            margin-bottom: 16px;
        }
        .media-preview-document-name {
            font-size: 1rem;
            word-break: break-all;
        }
        .media-preview-document-size {
            font-size: 0.85rem;
            color: #888;
            margin-top: 8px;
        }
        .media-preview-caption-wrap {
            margin-top: 8px;
        }
        .media-preview-caption-wrap label {
            display: block;
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 6px;
        }
        body.light-mode .media-preview-caption-wrap label {
            color: #666;
        }
        .media-preview-caption-input {
            width: 100%;
            padding: 10px 12px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            color: white;
            font-size: 0.9rem;
            resize: none;
            min-height: 44px;
            max-height: 100px;
            outline: none;
        }
        .media-preview-caption-input::placeholder {
            color: #888;
        }
        body.light-mode .media-preview-caption-input {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.12);
            color: #333;
        }
        body.light-mode .media-preview-caption-input::placeholder {
            color: #999;
        }

        .media-preview-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }
        .media-preview-btn {
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .media-preview-btn-cancel {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .media-preview-btn-cancel:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        body.light-mode .media-preview-btn-cancel {
            background: rgba(0, 0, 0, 0.08);
            color: #333;
        }
        body.light-mode .media-preview-btn-cancel:hover {
            background: rgba(0, 0, 0, 0.12);
        }
        .media-preview-btn-send {
            background: #6C63FF;
            color: white;
        }
        .media-preview-btn-send:hover {
            background: #20ba5a;
        }

        .chat-audio-recorder {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 0;
            padding: 4px 0;
        }
        .audio-recorder-waves {
            display: flex;
            align-items: center;
            gap: 4px;
            height: 32px;
        }
        .audio-recorder-waves .wave-bar {
            width: 4px;
            min-height: 8px;
            max-height: 24px;
            border-radius: 2px;
            background: #6C63FF;
            animation: wave-pulse 0.6s ease-in-out infinite alternate;
        }
        .audio-recorder-waves .wave-bar:nth-child(1) { animation-delay: 0s; }
        .audio-recorder-waves .wave-bar:nth-child(2) { animation-delay: 0.05s; }
        .audio-recorder-waves .wave-bar:nth-child(3) { animation-delay: 0.1s; }
        .audio-recorder-waves .wave-bar:nth-child(4) { animation-delay: 0.15s; }
        .audio-recorder-waves .wave-bar:nth-child(5) { animation-delay: 0.2s; }
        .audio-recorder-waves .wave-bar:nth-child(6) { animation-delay: 0.25s; }
        .audio-recorder-waves .wave-bar:nth-child(7) { animation-delay: 0.3s; }
        .audio-recorder-waves .wave-bar:nth-child(8) { animation-delay: 0.35s; }
        .audio-recorder-waves .wave-bar:nth-child(9) { animation-delay: 0.4s; }
        .audio-recorder-waves .wave-bar:nth-child(10) { animation-delay: 0.45s; }
        .audio-recorder-waves .wave-bar:nth-child(11) { animation-delay: 0.5s; }
        .audio-recorder-waves .wave-bar:nth-child(12) { animation-delay: 0.55s; }
        @keyframes wave-pulse {
            from { height: 8px; }
            to { height: 24px; }
        }
        .audio-recorder-waves.recording .wave-bar {
            animation: none;
        }
        .audio-recorder-timer {
            font-variant-numeric: tabular-nums;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            min-width: 3em;
        }
        body.light-mode .audio-recorder-timer {
            color: #333;
        }
        .audio-recorder-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
        }
        .audio-recorder-btn {
            padding: 0;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .audio-recorder-btn svg {
            width: 20px;
            height: 20px;
        }
        .audio-recorder-pause {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }
        .audio-recorder-pause:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        .audio-recorder-cancel {
            background: rgba(255, 100, 100, 0.3);
            color: #ffcccc;
        }
        .audio-recorder-cancel:hover {
            background: rgba(255, 100, 100, 0.5);
        }
        .audio-recorder-send {
            background: #6C63FF;
            color: white;
        }
        .audio-recorder-send:hover {
            background: #20ba5a;
            transform: scale(1.02);
        }
        body.light-mode .audio-recorder-pause {
            background: rgba(0, 0, 0, 0.08);
            color: #333;
        }
        body.light-mode .audio-recorder-cancel {
            background: rgba(220, 80, 80, 0.2);
            color: #c44;
        }
        body.light-mode .audio-recorder-send {
            background: #6C63FF;
            color: white;
        }

        /* Loading */
        .loading {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #888;
            gap: 10px;
        }

        body.light-mode .loading {
            color: #666;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(108, 99, 255, 0.3);
            border-top: 2px solid #6C63FF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .chat-favorite-loading-overlay {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 30;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 12px;
            background: rgba(18, 22, 30, 0.92);
            color: #d8dde6;
            box-shadow: 0 6px 22px rgba(0, 0, 0, 0.35);
            pointer-events: none;
            font-size: 13px;
            font-weight: 600;
            backdrop-filter: blur(2px);
        }

        body.light-mode .chat-favorite-loading-overlay {
            background: rgba(255, 255, 255, 0.94);
            color: #1f2937;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.18);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Skeleton de mensagens (simulação de bloquinhos com shimmer) */
        .messages-skeleton {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 16px 12px;
            align-items: stretch;
        }
        .messages-skeleton .skeleton-row {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            max-width: 85%;
        }
        .messages-skeleton .skeleton-row.sent {
            align-self: flex-end;
            flex-direction: row-reverse;
        }
        .messages-skeleton .skeleton-avatar {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }
        .messages-skeleton .skeleton-bubble {
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }
        .messages-skeleton .skeleton-row.received .skeleton-bubble { border-bottom-left-radius: 4px; }
        .messages-skeleton .skeleton-row.sent .skeleton-bubble { border-bottom-right-radius: 4px; }
        .messages-skeleton .skeleton-bubble.short { width: 120px; height: 36px; }
        .messages-skeleton .skeleton-bubble.medium { width: 200px; height: 44px; }
        .messages-skeleton .skeleton-bubble.long { width: 260px; height: 52px; }
        @keyframes skeleton-pulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }
        body.light-mode .messages-skeleton .skeleton-avatar,
        body.light-mode .messages-skeleton .skeleton-bubble {
            background: rgba(0, 0, 0, 0.08);
        }

        /* Skeleton de conversas (simulação de bloquinhos com shimmer) */
        .conversations-skeleton {
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        .conversations-skeleton .skeleton-conv-row {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            gap: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        body.light-mode .conversations-skeleton .skeleton-conv-row {
            border-bottom-color: rgba(0, 0, 0, 0.05);
        }
        .conversations-skeleton .skeleton-conv-avatar {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }
        .conversations-skeleton .skeleton-conv-info {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .conversations-skeleton .skeleton-conv-name {
            height: 16px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
            width: 70%;
            max-width: 180px;
        }
        .conversations-skeleton .skeleton-conv-preview {
            height: 12px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
            width: 90%;
            max-width: 220px;
        }
        .conversations-skeleton .skeleton-conv-time {
            width: 36px;
            height: 12px;
            border-radius: 4px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.08);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }
        body.light-mode .conversations-skeleton .skeleton-conv-avatar,
        body.light-mode .conversations-skeleton .skeleton-conv-name,
        body.light-mode .conversations-skeleton .skeleton-conv-preview,
        body.light-mode .conversations-skeleton .skeleton-conv-time {
            background: rgba(0, 0, 0, 0.08);
        }

        /* Scrollbar */
        .conversations-scroll::-webkit-scrollbar,
        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        .conversations-scroll::-webkit-scrollbar-track,
        .chat-messages::-webkit-scrollbar-track {
            background: transparent;
        }

        .conversations-scroll::-webkit-scrollbar-thumb,
        .chat-messages::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .conversations-scroll::-webkit-scrollbar-thumb:hover,
        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Responsive */
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
                height: 100dvh;
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

            .sidebar.mobile-open .menu-text,
            .sidebar.mobile-open .sidebar-logo,
            .sidebar.mobile-open .version-text {
                opacity: 1 !important;
            }

            .sidebar:hover {
                width: 250px !important;
                left: -250px !important;
            }

            .chat-container {
                margin-left: 0;
                position: relative;
                min-height: 100dvh;
                min-height: 100vh;
                height: 100dvh;
                height: 100vh;
            }

            .conversations-list {
                width: 100%;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 1000;
                display: none;
                min-height: 100dvh;
                min-height: 100vh;
                height: 100%;
                padding-top: env(safe-area-inset-top, 0);
                padding-bottom: env(safe-area-inset-bottom, 0);
            }

            .conversations-list.show {
                display: flex !important;
            }

            .conversation-item {
                min-height: 44px;
                padding: 12px 16px;
            }

            .chat-area {
                width: 100%;
                padding-bottom: env(safe-area-inset-bottom, 0);
            }

            .chat-header {
                padding: 12px 16px;
                padding-left: max(16px, env(safe-area-inset-left));
            }

            .chat-header-center {
                display: none;
            }

            .chat-header-menu-btn {
                min-width: 44px;
                min-height: 44px;
                padding: 10px;
            }

            .chat-input-area {
                padding: 12px 16px;
                padding-bottom: max(12px, env(safe-area-inset-bottom));
            }

            .contact-details-panel {
                max-width: 100%;
            }

            .chat-header-back-mobile {
                display: flex !important;
            }

            .mobile-close-btn {
                display: flex;
            }
        }

        /* Modal salvar contato — mesmo padrão visual de contatos.html (addContactModal) */
        .modal-overlay.save-contact-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 100050;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-overlay.save-contact-modal-overlay.active {
            display: flex;
        }
        .save-contact-modal-overlay .modal-box {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            width: 100%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        .save-contact-modal-overlay .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .save-contact-modal-overlay .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #18181b;
            margin: 0;
        }
        .save-contact-modal-overlay .modal-close {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 4px;
            font-size: 1.5rem;
            line-height: 1;
        }
        .save-contact-modal-overlay .modal-close:hover {
            color: #374151;
        }
        .save-contact-modal-overlay .modal-body {
            padding: 24px;
        }
        .save-contact-modal-overlay .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }
        .save-contact-modal-overlay .form-group {
            margin-bottom: 18px;
        }
        .save-contact-modal-overlay .form-group:last-of-type {
            margin-bottom: 0;
        }
        .save-contact-modal-overlay .form-label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.9rem;
            color: #6b7280;
        }
        .save-contact-modal-overlay .form-label .required {
            color: #ff6b6b;
        }
        .save-contact-modal-overlay .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
            color: #18181b;
            font-size: 0.95rem;
            font-family: inherit;
            box-sizing: border-box;
        }
        .save-contact-modal-overlay .form-input:focus {
            outline: none;
            border-color: #6C63FF;
        }
        .save-contact-modal-overlay .form-input::placeholder {
            color: #9ca3af;
        }
        .save-contact-modal-overlay .form-input[readonly] {
            background: #f9fafb;
            color: #6b7280;
            cursor: not-allowed;
        }
        .save-contact-modal-overlay .btn {
            padding: 10px 18px;
            background: #6C63FF;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            font-family: inherit;
            transition: all 0.2s ease;
        }
        .save-contact-modal-overlay .btn:hover {
            filter: brightness(1.05);
        }
        .save-contact-modal-overlay .btn-secondary {
            background: rgba(0, 0, 0, 0.04);
            border: 1px solid #e5e7eb;
            color: #374151;
        }
        .save-contact-modal-overlay .btn-secondary:hover {
            background: rgba(0, 0, 0, 0.07);
        }

        body.dark-mode .save-contact-modal-overlay .modal-box {
            background: #1e293b;
            border-color: rgba(71, 85, 105, 0.4);
        }
        body.dark-mode .save-contact-modal-overlay .modal-title {
            color: #f8fafc;
        }
        body.dark-mode .save-contact-modal-overlay .modal-header,
        body.dark-mode .save-contact-modal-overlay .modal-footer {
            border-color: rgba(71, 85, 105, 0.4);
        }
        body.dark-mode .save-contact-modal-overlay .modal-close {
            color: #64748b;
        }
        body.dark-mode .save-contact-modal-overlay .modal-close:hover {
            color: #e2e8f0;
        }
        body.dark-mode .save-contact-modal-overlay .form-label {
            color: #94a3b8;
        }
        body.dark-mode .save-contact-modal-overlay .form-input {
            background: rgba(15, 23, 42, 0.6);
            border-color: rgba(71, 85, 105, 0.5);
            color: #e2e8f0;
        }
        body.dark-mode .save-contact-modal-overlay .form-input[readonly] {
            background: rgba(15, 23, 42, 0.4);
            color: #94a3b8;
        }
        body.dark-mode .save-contact-modal-overlay .btn-secondary {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.5);
            color: #e2e8f0;
        }
        body.dark-mode .save-contact-modal-overlay .btn-secondary:hover {
            background: rgba(51, 65, 85, 0.65);
        }

        .new-conv-modal-footer {
            margin-top: 16px;
            padding: 16px 0 0;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        body.dark-mode .new-conv-modal-footer {
            border-top-color: rgba(71, 85, 105, 0.4);
        }

        /* Modal excluir mensagem: espaço entre a linha divisória e os botões */
        .save-contact-modal-overlay .delete-message-modal-footer {
            margin-top: 8px;
            padding-top: 20px !important;
            padding-left: 0;
            padding-right: 0;
            padding-bottom: 0;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }
        body.dark-mode .save-contact-modal-overlay .delete-message-modal-footer {
            border-top-color: rgba(71, 85, 105, 0.4);
        }
        .save-contact-modal-overlay .btn-delete-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.92;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .save-contact-modal-overlay .btn-delete-loading .delete-btn-spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.85s linear infinite;
            display: inline-block;
            vertical-align: middle;
            margin-right: 8px;
            flex-shrink: 0;
        }
        .save-contact-modal-overlay.edit-message-modal--saving .modal-close:disabled,
        .save-contact-modal-overlay.edit-message-modal--saving #editMessageCancelBtn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Toasts no estilo banner do sistema (tipografia UI, vidro fosco, acento por tipo) — acima dos modais (100050) */
        .toast-container {
            position: fixed;
            top: max(20px, env(safe-area-inset-top, 0px));
            left: 50%;
            transform: translateX(-50%);
            z-index: 200100;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 8px;
            width: min(380px, calc(100vw - 28px));
            pointer-events: none;
            box-sizing: border-box;
        }
        .toast-notification {
            pointer-events: auto;
            margin: 0;
            padding: 10px 14px 10px 0;
            border-radius: 12px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.35;
            letter-spacing: -0.01em;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            display: flex;
            align-items: center;
            gap: 0;
            opacity: 0;
            transform: translateY(-8px) scale(0.98);
            transition: opacity 0.22s ease, transform 0.22s ease;
            color: rgba(0, 0, 0, 0.88);
            background: rgba(255, 255, 255, 0.76);
            backdrop-filter: saturate(180%) blur(22px);
            -webkit-backdrop-filter: saturate(180%) blur(22px);
            border: 1px solid rgba(0, 0, 0, 0.09);
            box-shadow:
                0 4px 16px rgba(0, 0, 0, 0.1),
                0 0 0 0.5px rgba(0, 0, 0, 0.04) inset;
        }
        .toast-notification.show {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .toast-notification::before {
            content: '';
            align-self: stretch;
            width: 4px;
            min-height: 2.5em;
            margin: 6px 12px 6px 8px;
            border-radius: 3px;
            flex-shrink: 0;
            background: rgba(0, 122, 255, 0.95);
        }
        .toast-notification.info::before {
            background: rgba(0, 122, 255, 0.95);
        }
        .toast-notification.success::before {
            background: rgba(52, 199, 89, 0.95);
        }
        .toast-notification.error::before {
            background: rgba(255, 59, 48, 0.95);
        }
        .toast-notification .toast-message {
            flex: 1;
            min-width: 0;
            word-break: break-word;
            padding-right: 4px;
        }
        body.dark-mode .toast-notification {
            color: rgba(255, 255, 255, 0.92);
            background: rgba(44, 44, 46, 0.78);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow:
                0 8px 28px rgba(0, 0, 0, 0.45),
                0 0 0 0.5px rgba(255, 255, 255, 0.06) inset;
        }
        body.dark-mode .toast-notification.info::before {
            background: rgba(10, 132, 255, 0.95);
        }
        body.dark-mode .toast-notification.success::before {
            background: rgba(48, 209, 88, 0.95);
        }
        body.dark-mode .toast-notification.error::before {
            background: rgba(255, 69, 58, 0.95);
        }

        /* Dropdowns nativos: reforço global branco/preto (qualquer tema) */
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

        /* Painéis tipo dropdown (etiquetas nos detalhes) */
        .contact-detail-etiqueta-picker,
        .contact-details-etiquetas-picker-panel {
            background: #ffffff !important;
            border-color: rgba(0, 0, 0, 0.15) !important;
        }
        .contact-detail-etiqueta-picker-head {
            color: #000000 !important;
        }
        body.light-mode .contact-detail-etiqueta-picker-head,
        body.dark-mode .contact-detail-etiqueta-picker-head,
        body:not(.light-mode) .contact-detail-etiqueta-picker-head {
            color: #000000 !important;
        }
        .contact-details-etiqueta-row {
            background: #f3f4f6 !important;
            color: #000000 !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
        }
        .contact-details-etiqueta-row:hover {
            background: #e5e7eb !important;
        }
    </style>
    
<!-- scripts removidos para manter somente HTML + CSS -->

</head>
<body>
    <!-- Tema antes da primeira pintura: cookie darkMode (mesma lógica que getCookie / initDarkMode) -->
    
<!-- scripts removidos para manter somente HTML + CSS -->

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
                <a href="#" class="menu-item">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">analytics</span>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="#" class="menu-item active" data-menu-id="chat">
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

        <!-- Chat Container -->
        <div class="chat-container">
            <!-- Conversations List (design gemini.html) -->
            <div class="conversations-list show" id="conversationsList">
                <div class="conversations-panel">
                    <div class="conversations-header">
                        <h2 class="conversations-title">Conversas</h2>
                        <div class="conversations-header-actions">
                            <button type="button" class="conversations-new-chat-btn" id="conversationsNewChatBtn" title="Nova conversa" aria-label="Nova conversa">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="12" y1="8" x2="12" y2="14"/><line x1="9" y1="11" x2="15" y2="11"/></svg>
                            </button>
                            <button type="button" class="conversations-filter-btn" id="conversationsFilterToggleBtn" title="Filtros" aria-expanded="false" aria-controls="conversationsFiltersPanel">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                            </button>
                        </div>
                    </div>
                    <div class="conversations-search-wrap">
                        <span class="conversations-search-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                        <input type="text" class="conversations-search-input" placeholder="Buscar conversas..." id="searchInput">
                    </div>
                    <div id="conversationsFiltersPanel" class="conversations-filters-panel" role="region" aria-label="Filtros de conversas">
                        <div class="conversations-filters-inner">
                            <div class="chat-filter-accordion" id="chatFilterAccordionConexao" data-chat-filter-section="conexao">
                                <button type="button" class="chat-filter-accordion-toggle" id="chatFilterAccordionBtnConexao" aria-expanded="false" aria-controls="chatFilterAccordionBodyConexao">
                                    <span class="chat-filter-accordion-label-wrap">
                                        <span class="chat-filter-accordion-title">Conexão</span>
                                        <span class="chat-filter-accordion-summary" id="chatFilterSummaryConexao"></span>
                                    </span>
                                    <svg class="chat-filter-accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                                <div class="chat-filter-accordion-body" id="chatFilterAccordionBodyConexao" hidden>
                                    <div id="chatFilterConexoesSearchWrap" class="chat-filter-etiquetas-search-wrap" hidden>
                                        <input type="text" id="chatFilterConexoesSearch" class="chat-filter-tag-search-input" placeholder="Buscar conexão por nome..." autocomplete="off" aria-label="Buscar conexão por nome">
                                    </div>
                                    <div id="conexaoFilterList" class="chat-filter-checkboxes chat-filter-scroll-5"><span class="chat-filter-hint">Carregando conexões…</span></div>
                                </div>
                            </div>
                            <div class="chat-filter-accordion" id="chatFilterAccordionEtiquetas" data-chat-filter-section="etiquetas">
                                <button type="button" class="chat-filter-accordion-toggle" id="chatFilterAccordionBtnEtiquetas" aria-expanded="false" aria-controls="chatFilterAccordionBodyEtiquetas">
                                    <span class="chat-filter-accordion-label-wrap">
                                        <span class="chat-filter-accordion-title">Etiquetas</span>
                                        <span class="chat-filter-accordion-summary" id="chatFilterSummaryEtiquetas"></span>
                                    </span>
                                    <svg class="chat-filter-accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                                <div class="chat-filter-accordion-body" id="chatFilterAccordionBodyEtiquetas" hidden>
                                    <div class="chat-filter-etiqueta-mode">
                                        <label><input type="radio" name="chatEtiquetaMode" value="or" checked> Qualquer (OU)</label>
                                        <label><input type="radio" name="chatEtiquetaMode" value="and"> Todas (E)</label>
                                    </div>
                                    <div id="chatFilterEtiquetasSearchWrap" class="chat-filter-etiquetas-search-wrap" hidden>
                                        <input type="text" id="chatFilterEtiquetasSearch" class="chat-filter-tag-search-input" placeholder="Buscar etiqueta por nome..." autocomplete="off" aria-label="Buscar etiqueta por nome">
                                    </div>
                                    <div id="chatFilterEtiquetasList" class="chat-filter-checkboxes chat-filter-scroll-5"><span class="chat-filter-hint">Abra esta seção para carregar etiquetas</span></div>
                                </div>
                            </div>
                            <div class="chat-filter-accordion" id="chatFilterAccordionCrm" data-chat-filter-section="crm">
                                <button type="button" class="chat-filter-accordion-toggle" id="chatFilterAccordionBtnCrm" aria-expanded="false" aria-controls="chatFilterAccordionBodyCrm">
                                    <span class="chat-filter-accordion-label-wrap">
                                        <span class="chat-filter-accordion-title">CRM</span>
                                        <span class="chat-filter-accordion-summary" id="chatFilterSummaryCrm"></span>
                                    </span>
                                    <svg class="chat-filter-accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                                <div class="chat-filter-accordion-body" id="chatFilterAccordionBodyCrm" hidden>
                                    <div id="chatFilterQuadroPickerWrap">
                                        <div class="chat-filter-field-label">Quadro</div>
                                        <div id="chatFilterQuadroPickerList" class="chat-filter-checkboxes chat-filter-scroll-5"><span class="chat-filter-hint">Carregando quadros…</span></div>
                                    </div>
                                    <div id="chatFilterCrmQuadroChosenBar" class="chat-filter-crm-chosen-bar" hidden>
                                        <span class="chat-filter-quadro-name" id="chatFilterCrmQuadroChosenLabel"></span>
                                        <button type="button" class="chat-filter-crm-change-quadro-btn" id="chatFilterCrmChangeQuadroBtn" title="Alterar quadro" aria-label="Alterar quadro">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                        </button>
                                    </div>
                                    <div id="chatFilterEtapasSection" hidden>
                                        <div id="chatFilterEtapasPickerWrap" class="chat-filter-crm-etapas-picker-wrap">
                                            <div class="chat-filter-field-label">Etapas</div>
                                            <div id="chatFilterEtapasList" class="chat-filter-checkboxes chat-filter-scroll-5"><span class="chat-filter-hint">Selecione um quadro</span></div>
                                        </div>
                                        <div id="chatFilterCrmEtapasChosenBar" class="chat-filter-crm-chosen-bar" hidden>
                                            <span class="chat-filter-quadro-name" id="chatFilterCrmEtapasChosenLabel"></span>
                                            <button type="button" class="chat-filter-crm-change-quadro-btn" id="chatFilterCrmChangeEtapasBtn" title="Alterar etapas" aria-label="Alterar etapas">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="conversations-status-filters">
                        <button type="button" class="status-filter-btn active" data-status="aberto"><span class="status-label">Aberto</span><span class="status-count" data-status="aberto">—</span></button>
                        <button type="button" class="status-filter-btn" data-status="aguardando"><span class="status-label">Aguardando</span><span class="status-count" data-status="aguardando">—</span></button>
                        <button type="button" class="status-filter-btn" data-status="fechado"><span class="status-label">Fechado</span><span class="status-count" data-status="fechado">—</span></button>
                        <button type="button" class="status-filter-btn" data-status="agente-ia"><span class="status-label">IA</span><span class="status-count" data-status="agente-ia">—</span></button>
                    </div>
                </div>
                <div class="conversations-scroll" id="conversationsScroll">
                    <div class="conversations-skeleton" id="conversationsLoading" style="display: none;">
                        <div class="skeleton-conv-row">
                            <div class="skeleton-conv-avatar"></div>
                            <div class="skeleton-conv-info">
                                <div class="skeleton-conv-name"></div>
                                <div class="skeleton-conv-preview"></div>
                    </div>
                            <div class="skeleton-conv-time"></div>
                        </div>
                        <div class="skeleton-conv-row">
                            <div class="skeleton-conv-avatar"></div>
                            <div class="skeleton-conv-info">
                                <div class="skeleton-conv-name"></div>
                                <div class="skeleton-conv-preview"></div>
                            </div>
                            <div class="skeleton-conv-time"></div>
                        </div>
                        <div class="skeleton-conv-row">
                            <div class="skeleton-conv-avatar"></div>
                            <div class="skeleton-conv-info">
                                <div class="skeleton-conv-name"></div>
                                <div class="skeleton-conv-preview"></div>
                            </div>
                            <div class="skeleton-conv-time"></div>
                        </div>
                        <div class="skeleton-conv-row">
                            <div class="skeleton-conv-avatar"></div>
                            <div class="skeleton-conv-info">
                                <div class="skeleton-conv-name"></div>
                                <div class="skeleton-conv-preview"></div>
                            </div>
                            <div class="skeleton-conv-time"></div>
                        </div>
                        <div class="skeleton-conv-row">
                            <div class="skeleton-conv-avatar"></div>
                            <div class="skeleton-conv-info">
                                <div class="skeleton-conv-name"></div>
                                <div class="skeleton-conv-preview"></div>
                            </div>
                            <div class="skeleton-conv-time"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Area -->
            <div class="chat-area" id="chatArea">
                <div class="chat-empty" id="chatEmpty">
                    <img src="https://qlennkosykcblbhpbmqt.supabase.co/storage/v1/object/public/arquivos/logo" alt="IA Chatconversa" class="chat-empty-logo">
                </div>
            </div>
        </div>
    </div>

    <!-- Popup vermelho de confirmação de exclusão de conversa -->
    <div class="delete-confirm-overlay" id="deleteConfirmOverlay">
        <div class="delete-confirm-popup">
            <div class="delete-confirm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </div>
            <h3 class="delete-confirm-title">Excluir conversa?</h3>
            <p class="delete-confirm-text">Tem certeza que deseja excluir esta conversa? Todas as mensagens serão removidas e esta ação não pode ser desfeita.</p>
            <div class="delete-confirm-actions">
                <button type="button" class="delete-confirm-btn delete-confirm-cancel">Cancelar</button>
                <button type="button" class="delete-confirm-btn delete-confirm-excluir">Excluir</button>
            </div>
        </div>
    </div>

    <!-- Modal campos personalizados (detalhes do contato no chat) -->
    <div class="chat-cf-modal-overlay" id="chatCampoValorModalOverlay">
        <div class="chat-cf-modal-box">
            <div class="chat-cf-modal-head">
                <h3 class="chat-cf-modal-title" id="chatCampoValorModalTitle">Atribuir campo</h3>
                <button type="button" class="chat-cf-modal-close" aria-label="Fechar">&times;</button>
            </div>
            <div class="chat-cf-modal-body">
                <label class="chat-cf-label" for="chatCampoValorSelect">Campo</label>
                <select id="chatCampoValorSelect" class="chat-cf-select"></select>
                <div id="chatCampoValorDynamicWrap">
                    <label class="chat-cf-label" for="chatCampoValorInputText">Valor</label>
                    <div id="chatCampoValorDynamicMount">
                        <input type="text" id="chatCampoValorInputText" class="chat-cf-input" placeholder="Digite o valor">
                    </div>
                </div>
            </div>
            <div class="chat-cf-modal-foot">
                <button type="button" class="chat-cf-btn chat-cf-btn-secondary">Cancelar</button>
                <button type="button" class="chat-cf-btn chat-cf-btn-primary" id="chatCampoValorSaveBtn">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Modal editar CRM/etapa (detalhes do contato no chat) -->
    <div class="chat-cf-modal-overlay" id="contactDetailsCrmEditModalOverlay">
        <div class="chat-cf-modal-box">
            <div class="chat-cf-modal-head">
                <h3 class="chat-cf-modal-title">Editar CRM e etapa</h3>
                <button type="button" class="chat-cf-modal-close" aria-label="Fechar">&times;</button>
            </div>
            <div class="chat-cf-modal-body">
                <label class="chat-cf-label" for="contactDetailsCrmEditQuadroSelect">CRM</label>
                <select id="contactDetailsCrmEditQuadroSelect" class="chat-cf-select"></select>
                <label class="chat-cf-label" for="contactDetailsCrmEditEtapaSelect" style="margin-top:12px;">Etapa</label>
                <select id="contactDetailsCrmEditEtapaSelect" class="chat-cf-select"></select>
            </div>
            <div class="chat-cf-modal-foot">
                <button type="button" class="chat-cf-btn chat-cf-btn-secondary">Cancelar</button>
                <button type="button" class="chat-cf-btn chat-cf-btn-primary" id="contactDetailsCrmEditSaveBtn">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Preview de Mídia Overlay -->
    <div class="media-preview-overlay" id="mediaPreviewOverlay">
        <div class="media-preview-container">
            <div class="media-preview-header">
                <div class="media-preview-title" id="mediaPreviewTitle">Enviar arquivo</div>
                <button class="media-preview-close" title="Fechar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                </div>
            <div class="media-preview-content" id="mediaPreviewContent">
                <!-- Conteúdo dinâmico: imagem, vídeo ou documento -->
            </div>
            <div class="media-preview-caption-wrap">
                <label for="mediaPreviewCaption">Legenda (opcional)</label>
                <textarea class="media-preview-caption-input" id="mediaPreviewCaption" placeholder="Digite uma legenda para a mensagem..." rows="2"></textarea>
            </div>
            <div class="media-preview-actions">
                <button class="media-preview-btn media-preview-btn-cancel">Cancelar</button>
                <button class="media-preview-btn media-preview-btn-send" id="mediaPreviewSendBtn">Enviar</button>
            </div>
        </div>
    </div>

    
<!-- scripts removidos para manter somente HTML + CSS -->


    <!-- Nova conversa: contato existente ou novo número -->
    <div class="modal-overlay save-contact-modal-overlay" id="newConversationModal">
        <div class="modal-box">
            <div class="modal-header">
                <h2 class="modal-title">Nova conversa</h2>
                <button type="button" class="modal-close" aria-label="Fechar" title="Fechar">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="newConvConexaoSelect">Conexão WhatsApp</label>
                    <select id="newConvConexaoSelect" class="form-select" required></select>
                </div>
                <div class="new-conv-mode-tabs" role="tablist">
                    <button type="button" class="new-conv-tab active" data-mode="existing">Contato salvo</button>
                    <button type="button" class="new-conv-tab" data-mode="new">Novo número</button>
                </div>
                <div id="newConvPanelExisting">
                    <div class="form-group">
                        <label class="form-label" for="newConvContactSearch">Buscar contato</label>
                        <input type="text" id="newConvContactSearch" class="form-input" placeholder="Nome ou telefone..." autocomplete="off">
                    </div>
                    <div id="newConvContactsList" class="new-conv-contacts-list" role="listbox" aria-label="Lista de contatos"></div>
                    <p class="new-conv-selected-hint" id="newConvSelectedHint"></p>
                    <div class="modal-footer new-conv-modal-footer">
                        <button type="button" class="btn btn-secondary">Cancelar</button>
                        <button type="button" class="btn">Abrir conversa</button>
                    </div>
                </div>
                <div id="newConvPanelNew" hidden>
                    <div class="form-group">
                        <label class="form-label" for="newConvNewNome">Nome <span class="required">*</span></label>
                        <input type="text" id="newConvNewNome" class="form-input" placeholder="Nome do contato" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="newConvNewTelefone">Telefone <span class="required">*</span></label>
                        <div class="new-conv-phone-row">
                            <select id="newConvNewDDI" class="form-select phone-ddi" aria-label="DDI">
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
                            <input type="text" id="newConvNewTelefone" class="form-input phone-full" placeholder="DDD + número (só dígitos)" inputmode="numeric" autocomplete="tel-national">
                        </div>
                    </div>
                    <div class="modal-footer new-conv-modal-footer">
                        <button type="button" class="btn btn-secondary">Cancelar</button>
                        <button type="button" class="btn">Criar e abrir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal confirmar exclusão da mensagem -->
    <div class="modal-overlay save-contact-modal-overlay" id="deleteMessageModal">
        <div class="modal-box">
            <div class="modal-header">
                <h2 class="modal-title">Excluir mensagem</h2>
                <button type="button" class="modal-close" aria-label="Fechar" title="Fechar">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteMessageHiddenId" value="">
                <p style="margin:0;color:inherit;opacity:0.9;line-height:1.45;">Excluir para todos? A mensagem será removida no WhatsApp para você e para o contato.</p>
                <div class="modal-footer delete-message-modal-footer">
                    <button type="button" class="btn btn-secondary" id="deleteMessageCancelBtn">Cancelar</button>
                    <button type="button" class="btn" id="deleteMessageConfirmBtn" style="background:#c62828;">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar mensagem (texto) -->
    <div class="modal-overlay save-contact-modal-overlay" id="editMessageModal">
        <div class="modal-box">
            <div class="modal-header">
                <h2 class="modal-title">Editar mensagem</h2>
                <button type="button" class="modal-close" aria-label="Fechar" title="Fechar">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editMessageHiddenId" value="">
                <input type="hidden" id="editMessageEvolutionIdHidden" value="">
                <div class="form-group">
                    <label class="form-label" for="editMessageTextInput">Texto</label>
                    <textarea id="editMessageTextInput" class="form-input" rows="5" placeholder="Digite o novo texto" style="min-height:120px;resize:vertical;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="editMessageCancelBtn">Cancelar</button>
                    <button type="button" class="btn" id="editMessageSaveBtn">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Salvar Contato (layout alinhado a contatos.html — addContactModal) -->
    <div class="modal-overlay save-contact-modal-overlay" id="saveContactModal">
        <div class="modal-box">
            <div class="modal-header">
                <h2 class="modal-title" id="saveContactModalTitle">Salvar contato</h2>
                <button type="button" class="modal-close" aria-label="Fechar" title="Fechar">&times;</button>
            </div>
            <form id="saveContactForm" class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="contactName">Nome</label>
                    <input type="text" id="contactName" name="contactName" class="form-input" placeholder="Nome do contato" required autocomplete="name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="contactPhone">Telefone</label>
                    <input type="text" id="contactPhone" name="contactPhone" class="form-input" placeholder="Telefone" readonly autocomplete="tel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toasts por cima dos modais (z-index no CSS) -->
    <div class="toast-container" id="toastContainer"></div>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'brand-500': '#6C63FF',
                },
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                }
            }
        }
    }
</script>

<!-- JavaScript do chat -->
<script src="/hublabel/public/assets/js/pages/chat.js"></script>

<script src="/hublabel/public/assets/js/menu-global.js"></script>

</body>
</html>