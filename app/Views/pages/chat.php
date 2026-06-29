<?php
/**
 * Adaptado do n8n para PHP/MySQL
 * Supabase removido - usando backend PHP
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - IA Chatconversa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/hublabel/public/assets/images/favicon">
    <link rel="shortcut icon" type="image/png" href="/hublabel/public/assets/images/favicon">
    <link rel="apple-touch-icon" href="/hublabel/public/assets/images/favicon">
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
    <script>
        // Configuração do Supabase - disponibilizar globalmente (cliente criado no módulo principal)
        window.SUPABASE_URL = 'https://qlennkosykcblbhpbmqt.supabase.co';
        window.SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFsZW5ua29zeWtjYmxiaHBibXF0Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3Njc5NjY3MjQsImV4cCI6MjA4MzU0MjcyNH0.r_A91BCKivKMPqraRBvFn30ln-G1us1_Q7m6kDCeeN0';
    </script>
    <script src="/hublabel/public/assets/js/supabase-compat.js"></script>
</head>
<body>
    <!-- Tema antes da primeira pintura: cookie darkMode (mesma lógica que getCookie / initDarkMode) -->
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
                    <img class="sidebar-logo-img" src="/hublabel/public/assets/images/logo" alt="IA Chatconversa" onerror="this.src='/hublabel/public/assets/images/favicon'">
                </a>
            </div>
            <nav class="sidebar-menu">
                <a href="#" class="menu-item" onclick="navigateToPage('/hublabel/public/hublabel/public/dashboard')">
                    <span class="menu-icon">
                        <span class="material-symbols-rounded" aria-hidden="true">analytics</span>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="#" class="menu-item active" data-menu-id="chat" onclick="navigateToPage('/hublabel/public/hublabel/public/chat')">
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

        <!-- Chat Container -->
        <div class="chat-container">
            <!-- Conversations List (design gemini.html) -->
            <div class="conversations-list show" id="conversationsList">
                <div class="conversations-panel">
                    <div class="conversations-header">
                        <h2 class="conversations-title">Conversas</h2>
                        <div class="conversations-header-actions">
                            <button type="button" class="conversations-new-chat-btn" id="conversationsNewChatBtn" title="Nova conversa" aria-label="Nova conversa" onclick="window.openNewConversationModal()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><line x1="12" y1="8" x2="12" y2="14"/><line x1="9" y1="11" x2="15" y2="11"/></svg>
                            </button>
                            <button type="button" class="conversations-filter-btn" id="conversationsFilterToggleBtn" title="Filtros" aria-expanded="false" aria-controls="conversationsFiltersPanel" onclick="window.toggleConversationsFiltersPanel(event)">
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
                                <button type="button" class="chat-filter-accordion-toggle" id="chatFilterAccordionBtnConexao" aria-expanded="false" aria-controls="chatFilterAccordionBodyConexao" onclick="window.toggleChatFilterAccordion('conexao')">
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
                                <button type="button" class="chat-filter-accordion-toggle" id="chatFilterAccordionBtnEtiquetas" aria-expanded="false" aria-controls="chatFilterAccordionBodyEtiquetas" onclick="window.toggleChatFilterAccordion('etiquetas')">
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
                                <button type="button" class="chat-filter-accordion-toggle" id="chatFilterAccordionBtnCrm" aria-expanded="false" aria-controls="chatFilterAccordionBodyCrm" onclick="window.toggleChatFilterAccordion('crm')">
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
                        <button type="button" class="status-filter-btn active" data-status="aberto" onclick="window.setConversationsStatusFilter('aberto')"><span class="status-label">Aberto</span><span class="status-count" data-status="aberto">—</span></button>
                        <button type="button" class="status-filter-btn" data-status="aguardando" onclick="window.setConversationsStatusFilter('aguardando')"><span class="status-label">Aguardando</span><span class="status-count" data-status="aguardando">—</span></button>
                        <button type="button" class="status-filter-btn" data-status="fechado" onclick="window.setConversationsStatusFilter('fechado')"><span class="status-label">Fechado</span><span class="status-count" data-status="fechado">—</span></button>
                        <button type="button" class="status-filter-btn" data-status="agente-ia" onclick="window.setConversationsStatusFilter('agente-ia')"><span class="status-label">IA</span><span class="status-count" data-status="agente-ia">—</span></button>
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
                    <img src="/hublabel/public/assets/images/logo" alt="IA Chatconversa" class="chat-empty-logo">
                </div>
            </div>
        </div>
    </div>

    <!-- Popup vermelho de confirmação de exclusão de conversa -->
    <div class="delete-confirm-overlay" id="deleteConfirmOverlay" onclick="if(event.target===this) window.closeDeleteConfirmPopup()">
        <div class="delete-confirm-popup" onclick="event.stopPropagation()">
            <div class="delete-confirm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </div>
            <h3 class="delete-confirm-title">Excluir conversa?</h3>
            <p class="delete-confirm-text">Tem certeza que deseja excluir esta conversa? Todas as mensagens serão removidas e esta ação não pode ser desfeita.</p>
            <div class="delete-confirm-actions">
                <button type="button" class="delete-confirm-btn delete-confirm-cancel" onclick="window.closeDeleteConfirmPopup()">Cancelar</button>
                <button type="button" class="delete-confirm-btn delete-confirm-excluir" onclick="window.confirmDeleteConversation()">Excluir</button>
            </div>
        </div>
    </div>

    <!-- Modal campos personalizados (detalhes do contato no chat) -->
    <div class="chat-cf-modal-overlay" id="chatCampoValorModalOverlay" onclick="if(event.target===this) window.closeChatCampoValorModal()">
        <div class="chat-cf-modal-box" onclick="event.stopPropagation()">
            <div class="chat-cf-modal-head">
                <h3 class="chat-cf-modal-title" id="chatCampoValorModalTitle">Atribuir campo</h3>
                <button type="button" class="chat-cf-modal-close" onclick="window.closeChatCampoValorModal()" aria-label="Fechar">&times;</button>
            </div>
            <div class="chat-cf-modal-body">
                <label class="chat-cf-label" for="chatCampoValorSelect">Campo</label>
                <select id="chatCampoValorSelect" class="chat-cf-select" onchange="window.onChatCampoValorSelectChange()"></select>
                <div id="chatCampoValorDynamicWrap">
                    <label class="chat-cf-label" for="chatCampoValorInputText">Valor</label>
                    <div id="chatCampoValorDynamicMount">
                        <input type="text" id="chatCampoValorInputText" class="chat-cf-input" placeholder="Digite o valor">
                    </div>
                </div>
            </div>
            <div class="chat-cf-modal-foot">
                <button type="button" class="chat-cf-btn chat-cf-btn-secondary" onclick="window.closeChatCampoValorModal()">Cancelar</button>
                <button type="button" class="chat-cf-btn chat-cf-btn-primary" id="chatCampoValorSaveBtn" onclick="window.saveChatCampoValorModal()">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Modal editar CRM/etapa (detalhes do contato no chat) -->
    <div class="chat-cf-modal-overlay" id="contactDetailsCrmEditModalOverlay" onclick="if(event.target===this) window.closeContactDetailsCrmEditModal()">
        <div class="chat-cf-modal-box" onclick="event.stopPropagation()">
            <div class="chat-cf-modal-head">
                <h3 class="chat-cf-modal-title">Editar CRM e etapa</h3>
                <button type="button" class="chat-cf-modal-close" onclick="window.closeContactDetailsCrmEditModal()" aria-label="Fechar">&times;</button>
            </div>
            <div class="chat-cf-modal-body">
                <label class="chat-cf-label" for="contactDetailsCrmEditQuadroSelect">CRM</label>
                <select id="contactDetailsCrmEditQuadroSelect" class="chat-cf-select" onchange="window.onContactDetailsCrmEditQuadroChange()"></select>
                <label class="chat-cf-label" for="contactDetailsCrmEditEtapaSelect" style="margin-top:12px;">Etapa</label>
                <select id="contactDetailsCrmEditEtapaSelect" class="chat-cf-select"></select>
            </div>
            <div class="chat-cf-modal-foot">
                <button type="button" class="chat-cf-btn chat-cf-btn-secondary" onclick="window.closeContactDetailsCrmEditModal()">Cancelar</button>
                <button type="button" class="chat-cf-btn chat-cf-btn-primary" id="contactDetailsCrmEditSaveBtn" onclick="window.saveContactDetailsCrmEditModal()">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Preview de Mídia Overlay -->
    <div class="media-preview-overlay" id="mediaPreviewOverlay">
        <div class="media-preview-container">
            <div class="media-preview-header">
                <div class="media-preview-title" id="mediaPreviewTitle">Enviar arquivo</div>
                <button class="media-preview-close" onclick="closeMediaPreview()" title="Fechar">
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
                <button class="media-preview-btn media-preview-btn-cancel" onclick="closeMediaPreview()">Cancelar</button>
                <button class="media-preview-btn media-preview-btn-send" id="mediaPreviewSendBtn" onclick="confirmSendMedia()">Enviar</button>
            </div>
        </div>
    </div>

    <script type="module">
        // ============================================
        // CONFIGURAÇÃO SUPABASE COM USERID CUSTOMIZADO
        // ============================================
        // 
        // Este código usa contaId de uma tabela customizada (não do schema auth).
        // Para funcionar corretamente:
        //
        // 1. SEMPRE filtre por contaId nas queries:
        //    .eq('contaId', currentUserId)
        //
        // 2. SEMPRE filtre por contaId no Realtime:
        //    filter: `contaId=eq.${currentUserId}`
        //
        // 3. O Realtime funciona perfeitamente com filtros - apenas eventos
        //    que correspondem ao filtro serão recebidos.
        //
        // 4. RLS pode ser desabilitado ou usado como camada extra de segurança.
        //
        // ============================================

        // Importar Supabase via CDN ESM
        // Supabase removido - usando PHP/MySQL

        /**
         * Inicializa o cliente Supabase global (window.supabaseClient)
         * Esta função deve ser chamada uma vez no carregamento da página
         */
        // initSupabase removido

            console.log('🔧 Inicializando Supabase Client...');
            window.supabaseClient = createClient(window.SUPABASE_URL, window.SUPABASE_ANON_KEY, {
                auth: {
                    persistSession: true,
                    autoRefreshToken: true,
                    detectSessionInUrl: true,
                    storage: window.localStorage
                }
            });

            // Também definir window.supabase para compatibilidade
            window.supabase = window.supabaseClient;

            console.log('✅ Supabase Client inicializado');
            return window.supabaseClient;
        }

        // Inicializar Supabase imediatamente (cliente único)
        // Cliente Supabase removido

        let currentUserId = null;  // Armazena o ID da tabela SAAS_Usuarios (não o auth_user_id)
        let currentConversationId = null;
        let currentContactName = null;  // Nome ou telefone do contato atual
        let currentConversationFotoPerfil = null;  // Foto de perfil da conversa (avatar nas mensagens recebidas)
        let currentConversationStatus = 'aberto';  // Status de atendimento da conversa atual (aberto, aguardando, fechado)
        let currentConversationPhone = null;      // Telefone da conversa (para detalhes e salvar contato)
        let currentConversationContatoId = null;  // id em SAAS_Contatos (nome salvo na tabela de contatos)
        let chatCampoValorModalRowId = null;  // id da linha em SAAS_Valores_Campos_Personalizados ao editar no painel do chat
        let replyingToMessageId = null;  // ID da mensagem que está sendo respondida (null se não estiver respondendo)
        let replyingToPreviewAuthor = null;  // Nome do autor para o preview (ex.: "Você", nome do contato)
        let replyingToPreviewText = null;    // Texto do preview (ex.: "Áudio", "Imagem", ou texto da mensagem)
        let signatureActive = false;  // Assinatura: incluir nome nas mensagens de texto (estado em cookie)
        let conversationsSubscription = null;
        let messagesSubscription = null;
        let conversationsReloadTimer = null;
        /** Evita múltiplos listeners globais ao trocar de conversa (painel de emojis). */
        let chatEmojiPickerGlobalListenersBound = false;

        // Filtro e paginação de conversas (status + conexão + 20 por vez, carregar mais ao rolar para o final)
        const CONVERSATIONS_PAGE_SIZE = 20;
        let currentConversationsStatusFilter = 'aberto';
        /** Ids de conexão aplicados na lista (vazio = todas). Sincronizado em readChatFiltersFromDom ao aplicar filtros. */
        let currentConversationsConexaoIds = [];
        let currentConversationConexaoName = null;     // Nome da conexão da conversa atual (header e detalhes)
        let currentConversationAtendenteNome = null;   // Nome do atendente atribuído (painel de detalhes)
        let currentConversationAtendenteId = null;     // SAAS_Usuarios.id do atendente (UUID)
        let currentConversationConexaoPhone = null;     // Telefone da conexão da conversa atual (detalhes)
        let currentConversationNota = '';               // Nota/observações da conversa (painel de detalhes)
        let currentContactDetailsCrmCards = [];         // Cards de CRM do painel de detalhes
        let currentContactDetailsCrmEditCardId = null;  // Card selecionado no modal de edição de CRM
        let currentConversationSavedContactName = '';   // Nome salvo em SAAS_Contatos para avatar recebido
        let currentSignedUserName = '';                 // Nome do usuário logado para avatar enviado
        let currentSignedUserEmail = '';                // Email do usuário logado para fallback de avatar enviado
        let userConnectionsCache = [];                 // Lista { id, NomeConexao, Telefone } do usuário
        let conversationsPaginationState = {
            offset: 0,
            hasMore: true,
            isLoadingMore: false,
            scrollListenerAttached: false
        };
        let conversationsSearchReloadTimer = null;
        let userIdFromAuthCache = null;
        let userIdFromAuthCacheAt = 0;
        let userIdFromAuthPromise = null;
        let conversationCountsTimer = null;
        let conversationCountsRequestInFlight = false;
        let lastConversationCountsKey = null;
        const conversationDetailsCache = new Map();

        /** Cache das primeiras 20 conversas por aba (aberto/aguardando/fechado/agente-ia) para troca instantânea. */
        let conversationsCacheByStatus = {
            aberto: null,
            aguardando: null,
            fechado: null,
            'agente-ia': null
        };

        /** Filtros avançados (etiquetas + CRM) na lista de conversas */
        let chatFilterEtiquetaIds = [];
        let chatFilterEtiquetaMode = 'or';
        let chatFilterQuadroId = null;
        let chatFilterEtapaIds = [];
        let chatFiltersPanelOptionsLoaded = false;
        /** CRM: true = lista de etapas visível; false = barra resumo (como quadro) quando há etapas marcadas */
        let chatFilterCrmEtapasPickerExpanded = true;

        function hasConversationAdvancedFilters() {
            const hasEt = Array.isArray(chatFilterEtiquetaIds) && chatFilterEtiquetaIds.length > 0;
            const hasQ = chatFilterQuadroId != null && chatFilterQuadroId !== '' && !Number.isNaN(Number(chatFilterQuadroId));
            return hasEt || hasQ;
        }

        function hasConversationsSearchFilter() {
            const input = document.getElementById('searchInput');
            const raw = input && input.value ? String(input.value).trim() : '';
            return raw.length > 0;
        }

        function shouldSkipConversationCache() {
            return (currentConversationsConexaoIds && currentConversationsConexaoIds.length > 0) || hasConversationAdvancedFilters() || hasConversationsSearchFilter();
        }

        function cacheConversationListDetails(rows) {
            if (!Array.isArray(rows) || rows.length === 0) return;
            rows.forEach(row => {
                if (!row || row.id == null) return;
                conversationDetailsCache.set(String(row.id), row);
            });
        }

        /** Escapa % e _ para padrões ilike no PostgREST. */
        function escapeForPostgrestIlike(value) {
            return String(value).replace(/\\/g, '\\\\').replace(/%/g, '\\%').replace(/_/g, '\\_');
        }

        /**
         * Contatos da conta cujo nome ou telefone batem com o texto da busca (lista de conversas).
         * Retorna null se o campo de busca estiver vazio.
         */
        async function resolveContatoIdsFromConversationsSearch(contaId) {
            const input = document.getElementById('searchInput');
            const raw = (input && input.value) ? String(input.value).trim() : '';
            if (!raw) return null;
            const term = raw.toLowerCase();
            const termDigits = raw.replace(/\D/g, '');
            const orParts = [];
            const seen = new Set();
            const add = (p) => {
                if (!seen.has(p)) {
                    seen.add(p);
                    orParts.push(p);
                }
            };
            if (term.length > 0) {
                const e = escapeForPostgrestIlike(term);
                add(`nome.ilike.%${e}%`);
                add(`telefone.ilike.%${e}%`);
            }
            if (termDigits.length > 0) {
                const ed = escapeForPostgrestIlike(termDigits);
                add(`telefone.ilike.%${ed}%`);
            }
            if (orParts.length === 0) return null;
            const { data, error } = await supabase
                .from('SAAS_Contatos')
                .select('id')
                .eq('contaId', contaId)
                .or(orParts.join(','));
            if (error) {
                console.warn('Busca contatos (filtro na lista):', error);
                return null;
            }
            return [...new Set((data || []).map(r => r.id).filter(id => id != null))];
        }

        /**
         * Cláusula .or(...) em SAAS_Conversas_Agentes: contato bate na busca OU telefone da conversa bate.
         * Retorna null se não houver texto de busca.
         */
        async function buildConversationsSearchOrFilter(contaId) {
            const input = document.getElementById('searchInput');
            const raw = (input && input.value) ? String(input.value).trim() : '';
            if (!raw) return null;
            const term = raw.toLowerCase();
            const termDigits = raw.replace(/\D/g, '');
            const orParts = [];
            const seen = new Set();
            const add = (p) => {
                if (!seen.has(p)) {
                    seen.add(p);
                    orParts.push(p);
                }
            };
            const contactIds = await resolveContatoIdsFromConversationsSearch(contaId);
            if (contactIds && contactIds.length > 0) {
                add(`contatoId.in.(${contactIds.map(Number).filter(n => !Number.isNaN(n)).join(',')})`);
            }
            if (term.length > 0) {
                const e = escapeForPostgrestIlike(term);
                add(`telefone.ilike.%${e}%`);
            }
            if (termDigits.length > 0) {
                const ed = escapeForPostgrestIlike(termDigits);
                if (ed !== escapeForPostgrestIlike(term)) {
                    add(`telefone.ilike.%${ed}%`);
                }
            }
            if (orParts.length === 0) return null;
            return orParts.join(',');
        }

        /**
         * Filtro avançado (etiqueta/CRM) + texto de busca para lista/contagens de conversas.
         * @returns {Object} contatoIds/searchOr
         */
        async function resolveConversationListFilters() {
            const accountId = currentUserId;
            let contatoIds = null;
            if (hasConversationAdvancedFilters()) {
                contatoIds = await resolveFilteredContatoIdsForChat();
                if (!contatoIds || contatoIds.length === 0) {
                    return { contatoIds: [], searchOr: null };
                }
            }
            let searchOr = null;
            if (hasConversationsSearchFilter()) {
                try {
                    searchOr = await buildConversationsSearchOrFilter(accountId);
                } catch (e) {
                    console.warn('buildConversationsSearchOrFilter:', e);
                }
            }
            return { contatoIds, searchOr };
        }

        const CHAT_FILTER_ACCORDION_IDS = {
            conexao: ['chatFilterAccordionBtnConexao', 'chatFilterAccordionBodyConexao', 'chatFilterAccordionConexao'],
            etiquetas: ['chatFilterAccordionBtnEtiquetas', 'chatFilterAccordionBodyEtiquetas', 'chatFilterAccordionEtiquetas'],
            crm: ['chatFilterAccordionBtnCrm', 'chatFilterAccordionBodyCrm', 'chatFilterAccordionCrm']
        };

        function collapseChatFilterAccordionsExcept(which) {
            Object.keys(CHAT_FILTER_ACCORDION_IDS).forEach(key => {
                if (key === which) return;
                const row = CHAT_FILTER_ACCORDION_IDS[key];
                const btn = document.getElementById(row[0]);
                const body = document.getElementById(row[1]);
                const root = document.getElementById(row[2]);
                if (!btn || !body || !root) return;
                body.setAttribute('hidden', '');
                btn.setAttribute('aria-expanded', 'false');
                root.classList.remove('is-open');
            });
        }

        function toggleChatFilterAccordion(which) {
            const row = CHAT_FILTER_ACCORDION_IDS[which];
            if (!row) return;
            const btn = document.getElementById(row[0]);
            const body = document.getElementById(row[1]);
            const root = document.getElementById(row[2]);
            if (!btn || !body || !root) return;
            const willOpen = body.hasAttribute('hidden');
            if (willOpen) {
                collapseChatFilterAccordionsExcept(which);
                body.removeAttribute('hidden');
                btn.setAttribute('aria-expanded', 'true');
                root.classList.add('is-open');
            } else {
                body.setAttribute('hidden', '');
                btn.setAttribute('aria-expanded', 'false');
                root.classList.remove('is-open');
            }
        }

        function openChatFilterAccordion(which) {
            const row = CHAT_FILTER_ACCORDION_IDS[which];
            if (!row) return;
            const btn = document.getElementById(row[0]);
            const body = document.getElementById(row[1]);
            const root = document.getElementById(row[2]);
            if (!btn || !body || !root) return;
            body.removeAttribute('hidden');
            btn.setAttribute('aria-expanded', 'true');
            root.classList.add('is-open');
        }

        function collapseAllChatFilterAccordions() {
            Object.keys(CHAT_FILTER_ACCORDION_IDS).forEach(which => {
                const row = CHAT_FILTER_ACCORDION_IDS[which];
                const btn = document.getElementById(row[0]);
                const body = document.getElementById(row[1]);
                const root = document.getElementById(row[2]);
                if (!btn || !body || !root) return;
                body.setAttribute('hidden', '');
                btn.setAttribute('aria-expanded', 'false');
                root.classList.remove('is-open');
            });
        }

        function refreshChatFilterSectionSummaries() {
            const sumCx = document.getElementById('chatFilterSummaryConexao');
            const rootCx = document.getElementById('chatFilterAccordionConexao');
            if (sumCx) {
                const n = document.querySelectorAll('.chat-filter-conexao-cb:checked').length;
                sumCx.textContent = n ? (n === 1 ? '1 conexão' : n + ' conexões') : '';
                rootCx?.classList.toggle('chat-filter-accordion--has-value', n > 0);
            }
            const sumEt = document.getElementById('chatFilterSummaryEtiquetas');
            const rootEt = document.getElementById('chatFilterAccordionEtiquetas');
            if (sumEt) {
                const n = document.querySelectorAll('.chat-filter-etiqueta-cb:checked').length;
                sumEt.textContent = n ? (n === 1 ? '1 selecionada' : n + ' selecionadas') : '';
                rootEt?.classList.toggle('chat-filter-accordion--has-value', n > 0);
            }
            const sumCrm = document.getElementById('chatFilterSummaryCrm');
            const rootCrm = document.getElementById('chatFilterAccordionCrm');
            if (sumCrm) {
                const qr = document.querySelector('input[name="chatFilterQuadroRadio"]:checked');
                const hasQ = !!(qr && qr.value);
                let qname = '';
                if (hasQ) {
                    const lab = qr.closest('label.chat-filter-quadro-label');
                    const nm = lab && lab.querySelector('.chat-filter-quadro-name');
                    qname = nm ? String(nm.textContent || '').trim() : '';
                }
                const ne = document.querySelectorAll('.chat-filter-etapa-cb:checked').length;
                const parts = [];
                if (qname) parts.push(qname);
                if (ne) parts.push(ne === 1 ? '1 etapa' : ne + ' etapas');
                sumCrm.textContent = parts.join(' · ');
                rootCrm?.classList.toggle('chat-filter-accordion--has-value', hasQ || ne > 0);
            }
        }

        function openChatFilterAccordionsWithActiveSelections() {
            if (document.querySelectorAll('.chat-filter-conexao-cb:checked').length > 0) openChatFilterAccordion('conexao');
            if (document.querySelectorAll('.chat-filter-etiqueta-cb:checked').length > 0) openChatFilterAccordion('etiquetas');
            const qr = document.querySelector('input[name="chatFilterQuadroRadio"]:checked');
            const hasQ = qr && qr.value;
            const ne = document.querySelectorAll('.chat-filter-etapa-cb:checked').length;
            if (hasQ || ne > 0) openChatFilterAccordion('crm');
        }

        function updateConversationsFilterToggleActive() {
            const btn = document.getElementById('conversationsFilterToggleBtn');
            if (!btn) return;
            const active = hasConversationAdvancedFilters()
                || (currentConversationsConexaoIds && currentConversationsConexaoIds.length > 0)
                || hasConversationsSearchFilter();
            btn.classList.toggle('conversations-filter-btn--has-active-filters', active);
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            if (active && !expanded) {
                btn.title = 'Filtros ativos — clique para ver ou ajustar';
                btn.setAttribute('aria-label', 'Filtros ativos — abrir painel de filtros');
            } else {
                btn.title = 'Filtros';
                btn.setAttribute('aria-label', 'Filtros');
            }
            refreshChatFilterSectionSummaries();
        }

        async function resolveFilteredContatoIdsForChat() {
            const accountId = currentUserId;
            if (!accountId) return null;
            let setE = null;
            let setC = null;

            if (chatFilterEtiquetaIds.length > 0) {
                const { data, error } = await supabase
                    .from('SAAS_Contatos_Etiquetas')
                    .select('contatoId, etiquetaId')
                    .eq('contaId', accountId)
                    .in('etiquetaId', chatFilterEtiquetaIds.map(Number));
                if (error) throw error;
                const rows = data || [];
                if (chatFilterEtiquetaMode === 'and') {
                    const need = new Set(chatFilterEtiquetaIds.map(Number));
                    const map = new Map();
                    rows.forEach(r => {
                        const cid = Number(r.contatoId);
                        if (!cid) return;
                        if (!map.has(cid)) map.set(cid, new Set());
                        map.get(cid).add(Number(r.etiquetaId));
                    });
                    setE = new Set();
                    map.forEach((tags, cid) => {
                        if ([...need].every(t => tags.has(t))) setE.add(cid);
                    });
                } else {
                    setE = new Set(rows.map(r => Number(r.contatoId)).filter(Boolean));
                }
            }

            const qid = chatFilterQuadroId != null && chatFilterQuadroId !== '' ? Number(chatFilterQuadroId) : null;
            if (qid && !Number.isNaN(qid)) {
                let qry = supabase
                    .from('SAAS_Cards_Quadros')
                    .select('contatoId')
                    .eq('quadroId', qid)
                    .not('contatoId', 'is', null);
                if (Array.isArray(chatFilterEtapaIds) && chatFilterEtapaIds.length > 0) {
                    qry = qry.in('etapaQuadroId', chatFilterEtapaIds.map(Number));
                }
                const { data: cards, error: errC } = await qry;
                if (errC) throw errC;
                setC = new Set((cards || []).map(r => Number(r.contatoId)).filter(Boolean));
            }

            if (setE === null && setC === null) return null;
            if (setE !== null && setC !== null) {
                return [...setE].filter(id => setC.has(id));
            }
            if (setE !== null) return [...setE];
            return [...setC];
        }

        function readChatFiltersFromDom() {
            const modeEl = document.querySelector('input[name="chatEtiquetaMode"]:checked');
            chatFilterEtiquetaMode = modeEl && modeEl.value === 'and' ? 'and' : 'or';
            chatFilterEtiquetaIds = [...document.querySelectorAll('.chat-filter-etiqueta-cb:checked')]
                .map(cb => parseInt(cb.value, 10))
                .filter(n => !Number.isNaN(n));
            currentConversationsConexaoIds = [...document.querySelectorAll('.chat-filter-conexao-cb:checked')]
                .map(cb => parseInt(cb.value, 10))
                .filter(n => !Number.isNaN(n));
            const qr = document.querySelector('input[name="chatFilterQuadroRadio"]:checked');
            const qv = qr && qr.value ? parseInt(qr.value, 10) : null;
            chatFilterQuadroId = qv && !Number.isNaN(qv) ? qv : null;
            chatFilterEtapaIds = [...document.querySelectorAll('.chat-filter-etapa-cb:checked')]
                .map(cb => parseInt(cb.value, 10))
                .filter(n => !Number.isNaN(n));
        }

        function getSelectedChatFilterQuadroId() {
            const r = document.querySelector('input[name="chatFilterQuadroRadio"]:checked');
            if (!r || !r.value) return null;
            const n = parseInt(r.value, 10);
            return Number.isNaN(n) ? null : n;
        }

        function syncChatFilterCrmUi() {
            const qid = getSelectedChatFilterQuadroId();
            const pickerWrap = document.getElementById('chatFilterQuadroPickerWrap');
            const quadroChosenBar = document.getElementById('chatFilterCrmQuadroChosenBar');
            const quadroChosenLabel = document.getElementById('chatFilterCrmQuadroChosenLabel');
            const etapasSection = document.getElementById('chatFilterEtapasSection');
            const etapasPickerWrap = document.getElementById('chatFilterEtapasPickerWrap');
            const etapasChosenBar = document.getElementById('chatFilterCrmEtapasChosenBar');
            const etapasChosenLabel = document.getElementById('chatFilterCrmEtapasChosenLabel');
            if (!pickerWrap || !quadroChosenBar || !quadroChosenLabel) return;

            if (!qid) {
                quadroChosenLabel.textContent = '';
                quadroChosenBar.setAttribute('hidden', '');
                pickerWrap.removeAttribute('hidden');
                etapasSection?.setAttribute('hidden', '');
                etapasChosenBar?.setAttribute('hidden', '');
                etapasPickerWrap?.removeAttribute('hidden');
                return;
            }

            const qr = document.querySelector(`input[name="chatFilterQuadroRadio"][value="${qid}"]`);
            const lab = qr && qr.closest('label.chat-filter-quadro-label');
            const nm = lab && lab.querySelector('.chat-filter-quadro-name');
            quadroChosenLabel.textContent = nm ? String(nm.textContent || '').trim() : ('Quadro ' + qid);
            pickerWrap.setAttribute('hidden', '');
            quadroChosenBar.removeAttribute('hidden');

            if (!etapasSection || !etapasPickerWrap || !etapasChosenBar || !etapasChosenLabel) return;
            etapasSection.removeAttribute('hidden');

            const checked = document.querySelectorAll('#chatFilterEtapasList .chat-filter-etapa-cb:checked');
            const n = checked.length;
            if (n === 0) {
                chatFilterCrmEtapasPickerExpanded = true;
                etapasChosenBar.setAttribute('hidden', '');
                etapasPickerWrap.removeAttribute('hidden');
                return;
            }
            const showEtapasSummary = !chatFilterCrmEtapasPickerExpanded;
            if (showEtapasSummary) {
                const names = [...checked].map(cb => {
                    const el = cb.closest('label.chat-filter-etapa-label')?.querySelector('.chat-filter-etapa-name');
                    return el ? String(el.textContent || '').trim() : '';
                }).filter(Boolean);
                let summary = '';
                if (names.length <= 2) summary = names.join(', ');
                else summary = names.slice(0, 2).join(', ') + ' +' + (names.length - 2);
                etapasChosenLabel.textContent = summary || (n === 1 ? '1 etapa' : n + ' etapas');
                etapasChosenBar.removeAttribute('hidden');
                etapasPickerWrap.setAttribute('hidden', '');
            } else {
                etapasChosenBar.setAttribute('hidden', '');
                etapasPickerWrap.removeAttribute('hidden');
            }
        }

        function syncChatFilterCrmQuadroPickerUi() {
            syncChatFilterCrmUi();
        }

        function applyConexaoIdsToConversationQuery(q) {
            const ids = currentConversationsConexaoIds;
            if (!ids || ids.length === 0) return q;
            if (ids.length === 1) return q.eq('idConexao', ids[0]);
            return q.in('idConexao', ids);
        }

        function applyChatFilterConexoesSearchFilter() {
            const input = document.getElementById('chatFilterConexoesSearch');
            const wrap = document.getElementById('conexaoFilterList');
            if (!input || !wrap) return;
            const raw = (input.value || '').trim();
            const q = raw.normalize('NFD').replace(/\p{M}/gu, '').toLowerCase();
            wrap.querySelectorAll('label.chat-filter-conexao-label').forEach(label => {
                const t = (label.textContent || '').normalize('NFD').replace(/\p{M}/gu, '').toLowerCase();
                label.style.display = !q || t.includes(q) ? 'flex' : 'none';
            });
        }

        function setChatFilterConexoesSearchUiVisible(show) {
            const searchWrap = document.getElementById('chatFilterConexoesSearchWrap');
            const searchInput = document.getElementById('chatFilterConexoesSearch');
            if (!searchWrap || !searchInput) return;
            if (show) {
                searchWrap.removeAttribute('hidden');
            } else {
                searchWrap.setAttribute('hidden', '');
                searchInput.value = '';
            }
        }

        function applyChatFilterEtiquetasSearchFilter() {
            const input = document.getElementById('chatFilterEtiquetasSearch');
            const wrap = document.getElementById('chatFilterEtiquetasList');
            if (!input || !wrap) return;
            const raw = (input.value || '').trim();
            const q = raw.normalize('NFD').replace(/\p{M}/gu, '').toLowerCase();
            wrap.querySelectorAll('label.chat-filter-etiqueta-label').forEach(label => {
                const t = (label.textContent || '').normalize('NFD').replace(/\p{M}/gu, '').toLowerCase();
                label.style.display = !q || t.includes(q) ? 'flex' : 'none';
            });
        }

        function setChatFilterEtiquetasSearchUiVisible(show) {
            const searchWrap = document.getElementById('chatFilterEtiquetasSearchWrap');
            const searchInput = document.getElementById('chatFilterEtiquetasSearch');
            if (!searchWrap || !searchInput) return;
            if (show) {
                searchWrap.removeAttribute('hidden');
            } else {
                searchWrap.setAttribute('hidden', '');
                searchInput.value = '';
            }
        }

        async function loadChatFilterEtiquetasUi() {
            const wrap = document.getElementById('chatFilterEtiquetasList');
            if (!wrap || !currentUserId) return;
            const { data, error } = await supabase
                .from('SAAS_Etiquetas')
                .select('id, nome')
                .eq('contaId', currentUserId)
                .order('nome');
            if (error) {
                wrap.innerHTML = '<span class="chat-filter-hint">Erro ao carregar etiquetas</span>';
                setChatFilterEtiquetasSearchUiVisible(false);
                refreshChatFilterSectionSummaries();
                return;
            }
            if (!data || data.length === 0) {
                wrap.innerHTML = '<span class="chat-filter-hint">Nenhuma etiqueta</span>';
                setChatFilterEtiquetasSearchUiVisible(false);
                refreshChatFilterSectionSummaries();
                return;
            }
            wrap.innerHTML = data.map(e => {
                const checked = chatFilterEtiquetaIds.includes(Number(e.id)) ? ' checked' : '';
                return `<label class="chat-filter-etiqueta-label"><input type="checkbox" class="chat-filter-etiqueta-cb" value="${e.id}"${checked}>${escapeHtml(e.nome || '—')}</label>`;
            }).join('');
            setChatFilterEtiquetasSearchUiVisible(data.length > 10);
            applyChatFilterEtiquetasSearchFilter();
            refreshChatFilterSectionSummaries();
        }

        async function loadChatFilterQuadrosUi() {
            const listEl = document.getElementById('chatFilterQuadroPickerList');
            if (!listEl || !currentUserId) return;
            const domQ = getSelectedChatFilterQuadroId();
            const preserve = domQ != null ? String(domQ) : (chatFilterQuadroId != null ? String(chatFilterQuadroId) : '');
            const { data, error } = await supabase
                .from('SAAS_Quadros')
                .select('id, nome')
                .eq('contaId', currentUserId)
                .order('nome');
            if (error) {
                listEl.innerHTML = '<span class="chat-filter-hint">Erro ao carregar quadros</span>';
                syncChatFilterCrmQuadroPickerUi();
                refreshChatFilterSectionSummaries();
                return;
            }
            if (!data || data.length === 0) {
                listEl.innerHTML = '<span class="chat-filter-hint">Nenhum quadro</span>';
                syncChatFilterCrmQuadroPickerUi();
                refreshChatFilterSectionSummaries();
                return;
            }
            listEl.innerHTML = data.map(q => {
                const checked = preserve && String(q.id) === preserve ? ' checked' : '';
                const nome = escapeHtml(q.nome || ('Quadro ' + q.id));
                return `<label class="chat-filter-quadro-label"><input type="radio" name="chatFilterQuadroRadio" class="chat-filter-quadro-radio" value="${q.id}"${checked}><span class="chat-filter-quadro-name">${nome}</span></label>`;
            }).join('');
            syncChatFilterCrmQuadroPickerUi();
            await loadChatFilterEtapasUiForSelectedQuadro();
            refreshChatFilterSectionSummaries();
        }

        async function loadChatFilterEtapasUiForSelectedQuadro() {
            const wrap = document.getElementById('chatFilterEtapasList');
            if (!wrap) return;
            const qid = getSelectedChatFilterQuadroId();
            if (!qid || Number.isNaN(qid)) {
                wrap.innerHTML = '<span class="chat-filter-hint">Selecione um quadro</span>';
                syncChatFilterCrmUi();
                refreshChatFilterSectionSummaries();
                return;
            }
            const { data, error } = await supabase
                .from('SAAS_Etapas_Quadros')
                .select('id, nome, ordem')
                .eq('quadroId', qid)
                .order('ordem');
            if (error) {
                wrap.innerHTML = '<span class="chat-filter-hint">Erro ao carregar etapas</span>';
                syncChatFilterCrmUi();
                refreshChatFilterSectionSummaries();
                return;
            }
            if (!data || data.length === 0) {
                wrap.innerHTML = '<span class="chat-filter-hint">Nenhuma etapa neste quadro</span>';
                syncChatFilterCrmUi();
                refreshChatFilterSectionSummaries();
                return;
            }
            wrap.innerHTML = data.map(e => {
                const checked = chatFilterEtapaIds.includes(Number(e.id)) ? ' checked' : '';
                const nome = escapeHtml(e.nome || ('Etapa ' + e.id));
                return `<label class="chat-filter-etapa-label"><input type="checkbox" class="chat-filter-etapa-cb" value="${e.id}"${checked}><span class="chat-filter-etapa-name">${nome}</span></label>`;
            }).join('');
            const nc = wrap.querySelectorAll('.chat-filter-etapa-cb:checked').length;
            chatFilterCrmEtapasPickerExpanded = nc === 0;
            syncChatFilterCrmUi();
            refreshChatFilterSectionSummaries();
        }

        async function ensureChatFilterOptionsLoaded() {
            if (!currentUserId || chatFiltersPanelOptionsLoaded) return;
            try {
                await Promise.all([loadChatFilterEtiquetasUi(), loadChatFilterQuadrosUi(), loadUserConnections()]);
                chatFiltersPanelOptionsLoaded = true;
            } catch (e) {
                console.warn('ensureChatFilterOptionsLoaded:', e);
            }
        }

        function toggleConversationsFiltersPanel(ev) {
            if (ev && typeof ev.preventDefault === 'function') ev.preventDefault();
            const panel = document.getElementById('conversationsFiltersPanel');
            const btn = document.getElementById('conversationsFilterToggleBtn');
            if (!panel || !btn) return;
            const open = !panel.classList.contains('open');
            panel.classList.toggle('open', open);
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (open && currentUserId) {
                ensureChatFilterOptionsLoaded();
                refreshChatFilterSectionSummaries();
            }
            updateConversationsFilterToggleActive();
        }

        function applyChatConversationFilters() {
            readChatFiltersFromDom();
            conversationsPaginationState.offset = 0;
            conversationsPaginationState.hasMore = true;
            loadConversations(currentConversationsStatusFilter, false);
            updateConversationsFilterToggleActive();
            openChatFilterAccordionsWithActiveSelections();
        }

        async function clearChatConversationFilters() {
            chatFilterEtiquetaIds = [];
            chatFilterEtiquetaMode = 'or';
            chatFilterQuadroId = null;
            chatFilterEtapaIds = [];
            chatFilterCrmEtapasPickerExpanded = true;
            currentConversationsConexaoIds = [];
            const orRadio = document.querySelector('input[name="chatEtiquetaMode"][value="or"]');
            if (orRadio) orRadio.checked = true;
            document.querySelectorAll('.chat-filter-etiqueta-cb').forEach(cb => { cb.checked = false; });
            document.querySelectorAll('.chat-filter-conexao-cb').forEach(cb => { cb.checked = false; });
            document.querySelectorAll('input[name="chatFilterQuadroRadio"]').forEach(r => { r.checked = false; });
            const etapasWrap = document.getElementById('chatFilterEtapasList');
            if (etapasWrap) etapasWrap.innerHTML = '<span class="chat-filter-hint">Selecione um quadro</span>';
            syncChatFilterCrmQuadroPickerUi();
            if (chatFiltersPanelOptionsLoaded && currentUserId) {
                try {
                    await Promise.all([loadChatFilterEtiquetasUi(), loadUserConnections(), loadChatFilterQuadrosUi()]);
                } catch (e) { /* ignore */ }
            }
            collapseAllChatFilterAccordions();
            conversationsPaginationState.offset = 0;
            conversationsPaginationState.hasMore = true;
            loadConversations(currentConversationsStatusFilter, false);
            updateConversationsFilterToggleActive();
        }

        window.toggleConversationsFiltersPanel = toggleConversationsFiltersPanel;
        window.toggleChatFilterAccordion = toggleChatFilterAccordion;
        window.applyChatConversationFilters = applyChatConversationFilters;
        window.clearChatConversationFilters = clearChatConversationFilters;

        // Paginação de mensagens (estilo WhatsApp: 20 por vez, carregar mais ao rolar para cima)
        const MESSAGES_PAGE_SIZE = 20;
        let messagesPaginationState = {
            oldestLoadedCreatedAt: null,
            hasMoreMessages: true,
            isLoadingMore: false,
            scrollListenerAttached: false
        };

        // Estado do gravador de áudio
        let audioRecorderState = {
            mediaRecorder: null,
            stream: null,
            chunks: [],
            startTime: null,
            timerInterval: null,
            pausedDuration: 0,
            pausedAt: null,
            analyser: null,
            animationFrameId: null
        };

        // Estado do preview de mídia
        let mediaPreviewState = {
            file: null,
            mediaType: null
        };

        /**
         * Busca o ID da tabela SAAS_Usuarios baseado no auth_user_id do Supabase Auth
         * @returns {Promise<string|null>} O ID da tabela SAAS_Usuarios ou null se não encontrado
         */
        // Flag global para indicar que o status está bloqueado (evita toasts)
        let statusBloqueado = false;

        async function getUserIdFromAuth() {
            try {
                const now = Date.now();
                if (userIdFromAuthCache && (now - userIdFromAuthCacheAt) < 120000) {
                    return userIdFromAuthCache;
                }
                if (userIdFromAuthPromise) {
                    return await userIdFromAuthPromise;
                }
                userIdFromAuthPromise = (async () => {
                // Obter auth_user_id do Supabase Auth
                const { data: { user }, error: authError } = await supabase.auth.getUser();
                if (authError || !user || !user.id) {
                    console.warn('⚠️ Erro ao obter usuário do Supabase Auth:', authError);
                    return null;
                }

                const authUserId = user.id;  // Este é o auth_user_id

                // Buscar na tabela SAAS_Usuarios o registro onde auth_user_id = user.id (id e status)
                const { data: usuarioData, error: usuarioError } = await supabase
                    .from('SAAS_Usuarios')
                    .select('contaId, SAAS_Contas(status)')
                    .eq('auth_user_id', authUserId)
                    .single();

                if (usuarioError || !usuarioData || !usuarioData.contaId) {
                    console.error('❌ Erro ao buscar usuário na tabela SAAS_Usuarios:', usuarioError);
                    return null;
                }

                const status = usuarioData?.SAAS_Contas?.status;
                if (status === false) {
                    console.warn('⚠️ Usuário com status inativo. Redirecionando para acesso-bloqueado.');
                    // Redirecionar imediatamente (não aguardar)
                    logoutAndRedirectAcessoBloqueado();
                    // Lançar erro especial que será ignorado nos catch blocks
                    throw new Error('STATUS_BLOQUEADO');
                }

                    userIdFromAuthCache = usuarioData.contaId;
                    userIdFromAuthCacheAt = Date.now();
                    return usuarioData.contaId;
                })();
                const resolved = await userIdFromAuthPromise;
                userIdFromAuthPromise = null;
                return resolved;
            } catch (error) {
                userIdFromAuthPromise = null;
                // Se for erro de status bloqueado, re-lançar
                if (error.message === 'STATUS_BLOQUEADO') {
                    throw error;
                }
                console.error('❌ Erro ao buscar contaId da tabela SAAS_Usuarios:', error);
            return null;
            }
        }

        /**
         * Retorna a função do usuário logado (admin | membro).
         * @returns {Promise<string|null>} 'admin', 'membro' ou null
         */
        async function getCurrentUserFuncao() {
            try {
                const { data: { user } } = await supabase.auth.getUser();
                if (!user?.id) return null;
                const { data } = await supabase
                    .from('SAAS_Usuarios')
                    .select('funcao')
                    .eq('auth_user_id', user.id)
                    .single();
                return data?.funcao ?? null;
            } catch (e) {
                return null;
            }
        }

        /**
         * Retorna o id da linha SAAS_Usuarios (para vincular atendente na conversa).
         * @returns {Promise<string|null>} SAAS_Usuarios.id ou null
         */
        async function getUsuarioIdFromAuth() {
            try {
                const { data: { user } } = await supabase.auth.getUser();
                if (!user?.id) return null;
                const { data } = await supabase
                    .from('SAAS_Usuarios')
                    .select('id')
                    .eq('auth_user_id', user.id)
                    .single();
                return data?.id ?? null;
            } catch (e) {
                return null;
            }
        }

        /**
         * Vincula o atendente (usuário logado) à conversa na coluna atendente.
         * Chamado ao abrir atendimento e ao responder mensagem.
         * @param {string|number} conversaId - ID da conversa
         */
        async function vincularAtendenteConversa(conversaId) {
            return;
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
        
        // Configurar auth listeners IMEDIATAMENTE após inicializar Supabase
        // Isso garante que INITIAL_SESSION seja capturado
        let _initAlreadyLoadedConversations = false;

        function setupAuthListeners() {
            supabase.auth.onAuthStateChange((event, session) => {
                console.log('Auth state changed:', event);

                if (event === 'INITIAL_SESSION') {
                    if (session && session.user) {
                        verificarMostrarMenuAdmin();
                        getUserIdFromAuth().then(contaId => {
                            if (contaId) {
                                currentUserId = contaId;
                            }
                        }).catch(error => {
                            if (error.message !== 'STATUS_BLOQUEADO') {
                                console.error('Erro ao obter contaId:', error);
                            }
                        });
                    }
                }

                if (event === 'TOKEN_REFRESHED') {
                    // Apenas atualizar contaId, sem recarregar conversas (evita loops)
                    if (session && session.user) {
                        getUserIdFromAuth().then(contaId => {
                            if (contaId) currentUserId = contaId;
                        });
                    }
                }

                if (event === 'SIGNED_IN') {
                    if (session && session.user) verificarMostrarMenuAdmin();
                    if (session && session.user) {
                        getUserIdFromAuth().then(contaId => {
                            if (contaId) {
                                currentUserId = contaId;
                                // Só carregar conversas no SIGNED_IN se init() ainda não fez
                                if (!_initAlreadyLoadedConversations && document.readyState !== 'loading') {
                                    _initAlreadyLoadedConversations = true;
                                    loadConversations();
                                }
                            }
                        });
                    }
                }

                if (event === 'SIGNED_OUT') {
                    console.log('Usuário deslogado');
                    currentUserId = null;
                    userIdFromAuthCache = null;
                    userIdFromAuthCacheAt = 0;
                    userIdFromAuthPromise = null;
                    conversationDetailsCache.clear();
                    _initAlreadyLoadedConversations = false;
                    if (conversationsSubscription) {
                        conversationsSubscription.unsubscribe();
                        conversationsSubscription = null;
                    }
                    if (messagesSubscription) {
                        messagesSubscription.unsubscribe();
                        messagesSubscription = null;
                    }
                }
            });
        }

        // Chamar setupAuthListeners IMEDIATAMENTE
        setupAuthListeners();

        // Função mantida para compatibilidade (já inicializado acima)

        // Função removida - não usar mais getSecureUserId()
        // Usar apenas auth.uid() do Supabase Auth

        // Variáveis globais
        // currentUserId será definido pelo Supabase Auth (auth.uid())
        // currentConversationId já declarado acima

        /**
         * Seleciona uma conversa e exibe a área de chat
         * @param {string} conversationId - ID da conversa
         * @param {string} contactName - Nome do contato
         */
        async function selectConversation(conversationId, contactNameFromList) {
            let contactName = contactNameFromList || 'Sem nome';
            console.log(`📱 Selecionando conversa: ${conversationId} - ${contactName}`);
            
            currentConversationId = conversationId;
            currentContactName = contactName;

            // No mobile: esconder lista de conversas e mostrar área do chat
            const conversationsListEl = document.getElementById('conversationsList');
            if (conversationsListEl && window.innerWidth <= 768) {
                conversationsListEl.classList.remove('show');
            }

            // Capturar email para avatar enviado sem bloquear a abertura da conversa
            supabase.auth.getUser().then(({ data }) => {
                const user = data && data.user ? data.user : null;
                currentSignedUserEmail = user && user.email ? String(user.email).trim() : '';
            }).catch(() => {});

            // Marcar conversa como lida sem bloquear o carregamento do chat
            if (conversationId) {
                const conversaIdNum = parseInt(conversationId);
                if (!isNaN(conversaIdNum)) {
                    supabase
                        .from('SAAS_Conversas_Agentes')
                        .update({ lida: true })
                        .eq('id', conversaIdNum)
                        .then(({ error: updateError }) => {
                            if (updateError) {
                                console.error('❌ Erro ao marcar conversa como lida:', updateError);
                            } else {
                                const selectedConvItem = document.querySelector(`[data-conversation-id="${conversationId}"]`);
                                const unreadBadge = selectedConvItem && selectedConvItem.querySelector('.conversation-unread');
                                if (unreadBadge) unreadBadge.remove();
                            }
                        })
                        .catch((error) => {
                            console.error('❌ Erro ao atualizar status de leitura:', error);
                        });
                }
            }

            // Atualizar UI - destacar conversa selecionada
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.remove('active');
            });
            const selectedItem = document.querySelector(`[data-conversation-id="${conversationId}"]`);
            if (selectedItem) {
                selectedItem.classList.add('active');
            }

            // Ocultar mensagem vazia
            const chatEmpty = document.getElementById('chatEmpty');
            if (chatEmpty) {
                chatEmpty.style.display = 'none';
            }

            // Criar estrutura de chat se não existir
            const chatArea = document.getElementById('chatArea');
            if (!chatArea) {
                console.error('Elemento chatArea não encontrado');
                return;
            }

            // Buscar telefone, foto, nome, status e conexão da conversa
            currentConversationPhone = null;
            currentConversationFotoPerfil = null;
            currentConversationStatus = 'aberto';
            currentConversationConexaoName = null;
            currentConversationConexaoPhone = null;
            currentConversationNota = '';
            currentConversationAtendenteNome = null;
            currentConversationAtendenteId = null;
            currentConversationContatoId = null;
            let nomeSalvoEmContato = '';
            try {
                const conversaIdNum = parseInt(conversationId);
                if (!isNaN(conversaIdNum)) {
                    let r = conversationDetailsCache.get(String(conversationId)) || null;
                    if (!r) {
                        const resp = await supabase
                            .from('SAAS_Conversas_Agentes')
                            .select('id, telefone, fotoPerfil, statusAtendimento, idConexao, nota, contatoId, atendente, contato:SAAS_Contatos!contatoId(nome), atendente_usuario:SAAS_Usuarios!atendente(nome), SAAS_Conexões!idConexao(NomeConexao, Telefone)')
                            .eq('id', conversaIdNum)
                            .single();
                        r = resp.data || null;
                    }
                    if (r) {
                        if (r.telefone) currentConversationPhone = r.telefone.replace(/'/g, "\\'");
                        if (r.fotoPerfil) currentConversationFotoPerfil = r.fotoPerfil;
                        if (r.statusAtendimento) currentConversationStatus = normalizeStatusAtendimento(r.statusAtendimento);
                        currentConversationNota = normalizeConversationNotaFromApi(r.nota);
                        currentConversationContatoId = r.contatoId != null ? r.contatoId : null;
                        let nomeContato = (r.contato && r.contato.nome != null) ? String(r.contato.nome).trim() : '';
                        if (!nomeContato && r.contatoId) {
                            const { data: ct } = await supabase
                                .from('SAAS_Contatos')
                                .select('nome')
                                .eq('id', r.contatoId)
                                .maybeSingle();
                            if (ct && ct.nome != null) nomeContato = String(ct.nome).trim();
                        }
                        nomeSalvoEmContato = nomeContato;
                        if (nomeContato) contactName = nomeContato;
                        else if (r.telefone) contactName = cleanPhoneNumber(r.telefone);
                        currentContactName = contactName;
                        const cxData = r.SAAS_Conexões || null;
                        if (cxData) {
                            currentConversationConexaoName = (cxData.NomeConexao || cxData.Telefone || '').trim() || null;
                            currentConversationConexaoPhone = (cxData.Telefone || '').trim() || null;
                        }
                        if (r.atendente != null && r.atendente !== '') {
                            currentConversationAtendenteId = String(r.atendente);
                        }
                        if (r.atendente_usuario?.nome) currentConversationAtendenteNome = String(r.atendente_usuario.nome).trim() || null;
                    }
                }
            } catch (error) {
                console.warn('⚠️ Erro ao buscar dados da conversa:', error);
            }

            // Avatar do header com foto de perfil ou iniciais
            const headerAvatarContent = currentConversationFotoPerfil
                ? `<img src="${escapeHtml(currentConversationFotoPerfil)}" alt="${escapeHtml(contactName)}" style="display: none;">`
                : getInitials(contactName);
            const displayPhone = (currentConversationPhone || '').replace(/\\'/g, "'");
            const phoneWithoutSuffix = (displayPhone || '').replace(/@s\.whatsapp\.net/gi, '').trim();
            const contactDetailsPhoneDisplay = phoneWithoutSuffix || '—';
            const hasRealName = !!(nomeSalvoEmContato && nomeSalvoEmContato.trim());
            currentConversationSavedContactName = hasRealName ? String(nomeSalvoEmContato).trim() : '';
            const contactDetailsNomeDisplay = hasRealName ? nomeSalvoEmContato : contactDetailsPhoneDisplay;
            const [currentUserFuncao, currentUserName, mySaasUsuarioId] = await Promise.all([
                getCurrentUserFuncao(),
                getCurrentUserName(),
                getUsuarioIdFromAuth()
            ]);
            const showDeleteButton = currentUserFuncao === 'admin';
            currentSignedUserName = (currentUserName || '').trim();
            const atendIdStr = currentConversationAtendenteId ? String(currentConversationAtendenteId) : '';
            const myIdStr = mySaasUsuarioId ? String(mySaasUsuarioId) : '';
            const pillIsMe = !!(atendIdStr && myIdStr && atendIdStr === myIdStr);
            let atribuicaoPillInner;
            if (pillIsMe) {
                const nm = (currentConversationAtendenteNome || currentUserName || 'Você').trim();
                atribuicaoPillInner = 'Você (' + escapeHtml(nm) + ')';
            } else if (currentConversationAtendenteNome) {
                atribuicaoPillInner = escapeHtml(currentConversationAtendenteNome);
            } else {
                atribuicaoPillInner = escapeHtml('Sem atendente atribuído');
            }
            const hasNotaForHeader = conversationNotaTemConteudoVisivel(currentConversationNota);

            chatArea.innerHTML = `
                <div class="chat-header-stack">
                <div class="chat-header" id="chatHeader" onclick="window.openChatHeaderContactDetails(event)">
                    <button type="button" class="chat-header-back-mobile" onclick="window.showConversationsListOnMobile()" title="Voltar para conversas" aria-label="Voltar para conversas">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    </button>
                    <div class="chat-header-contact-hit">
                    <div class="chat-header-info">
                        <div class="chat-header-avatar" ${currentConversationFotoPerfil ? `style="background-image: url('${escapeHtml(currentConversationFotoPerfil)}');"` : ''}>
                            ${headerAvatarContent}
                            <button class="chat-header-avatar-add-btn" onclick="openSaveContactModal('${currentConversationPhone || ''}')" title="Salvar contato" ${hasRealName ? 'hidden' : ''}>
                                +
                            </button>
                        </div>
                        <div class="chat-header-name-wrap">
                            <div class="chat-header-name">${contactName}</div>
                            <button type="button" class="chat-header-nota-btn" id="chatHeaderNotaBtn" onclick="window.toggleContactDetailsDropdown(event)" aria-label="Esta conversa tem observações. Abrir dados do contato." ${hasNotaForHeader ? '' : 'hidden'}>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/><line x1="8" y1="7" x2="16" y2="7"/><line x1="8" y1="11" x2="16" y2="11"/><line x1="8" y1="15" x2="13" y2="15"/></svg>
                            </button>
                            ${currentConversationConexaoName ? `<span class="chat-header-conexao-tag">${escapeHtml(currentConversationConexaoName)}</span>` : ''}
                        </div>
                    </div>
                    </div>
                    <div class="chat-header-center">
                        <div class="chat-header-atribuicao-pill">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
                            <span id="chatHeaderAtendentePillText">${atribuicaoPillInner}</span>
                        </div>
                    </div>
                    <div class="chat-header-right">
                        <div class="chat-header-status-actions">${getHeaderStatusButtonsHtml()}</div>
                        <div class="chat-header-menu-wrap">
                            <button type="button" class="chat-header-menu-btn" onclick="window.toggleContactDetailsDropdown(event)" title="Dados do contato" aria-label="Dados do contato">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="12" cy="19" r="1.5"/></svg>
                        </button>
                    </div>
                    </div>
                </div>
                <div id="chatHeaderMetaMount"></div>
                </div>
                <div class="chat-search-bar" id="chatSearchBar">
                    <input type="text" id="chatSearchInput" placeholder="Pesquisar nesta conversa..." autocomplete="off">
                    <button type="button" class="chat-search-bar-close" onclick="window.closeConversationSearch()" title="Fechar pesquisa" aria-label="Fechar">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <div class="messages-skeleton" id="messagesLoading" style="display: none;">
                        <div class="skeleton-row received">
                            <div class="skeleton-avatar"></div>
                            <div class="skeleton-bubble short"></div>
                    </div>
                        <div class="skeleton-row sent">
                            <div class="skeleton-avatar"></div>
                            <div class="skeleton-bubble medium"></div>
                        </div>
                        <div class="skeleton-row received">
                            <div class="skeleton-avatar"></div>
                            <div class="skeleton-bubble long"></div>
                        </div>
                        <div class="skeleton-row sent">
                            <div class="skeleton-avatar"></div>
                            <div class="skeleton-bubble short"></div>
                        </div>
                        <div class="skeleton-row received">
                            <div class="skeleton-avatar"></div>
                            <div class="skeleton-bubble medium"></div>
                        </div>
                        <div class="skeleton-row sent">
                            <div class="skeleton-avatar"></div>
                            <div class="skeleton-bubble long"></div>
                        </div>
                    </div>
                </div>
                <div class="reply-preview" id="replyPreview">
                    <div class="reply-preview-content">
                        <div class="reply-preview-label">Respondendo</div>
                        <div class="reply-preview-text" id="replyPreviewText"></div>
                    </div>
                    <button class="reply-preview-close" onclick="cancelReply()" title="Cancelar resposta">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="chat-input-area" id="chatInputArea">
                    <button type="button" class="chat-add-media-btn" id="addMediaButton" title="Adicionar mídia">+</button>
                    <button type="button" class="chat-quick-replies-btn" id="quickRepliesButton" title="Respostas rápidas">/</button>
                    <div class="chat-emoji-picker-wrap">
                        <button type="button" class="chat-emoji-btn" id="emojiPickerButton" title="Emojis" aria-label="Emojis" aria-expanded="false" aria-controls="emojiPickerPanel" aria-haspopup="dialog">
                            <span class="chat-emoji-btn-icon" aria-hidden="true">😊</span>
                        </button>
                        <div class="emoji-picker-panel" id="emojiPickerPanel" role="dialog" aria-label="Emojis">
                            <div class="emoji-picker-tabs" id="emojiPickerTabs" role="tablist"></div>
                            <div class="emoji-picker-grid" id="emojiPickerGrid"></div>
                        </div>
                    </div>
                    <button type="button" class="chat-signature-btn" id="signatureButton" title="Assinatura: incluir nome nas mensagens de texto" aria-label="Assinatura">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </button>
                    <div class="quick-replies-menu" id="quickRepliesMenu">
                        <div class="quick-replies-list" id="quickRepliesList"></div>
                    </div>
                    <div class="media-options-menu" id="mediaOptionsMenu">
                        <div class="media-option-item" data-media-type="image">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            <span>Enviar Imagem</span>
                        </div>
                        <div class="media-option-item" data-media-type="video">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                            <span>Enviar Vídeo</span>
                        </div>
                        <div class="media-option-item" data-media-type="document">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                            <span>Enviar Documento</span>
                        </div>
                        <div class="media-option-item" data-media-type="audio">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                            <span>Enviar Áudio</span>
                        </div>
                    </div>
                    <input type="file" id="mediaFileInput" accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt" style="display: none;">
                    <div class="chat-input-wrap" id="chatInputWrap">
                        <div class="chat-input-outer">
                            <textarea class="chat-input" id="messageInput" rows="1" placeholder="Digite uma mensagem… / para atalhos" oninput="window.autoResizeMessageInput()" onkeydown="handleKeyPress(event)"></textarea>
                        </div>
                        <button type="button" class="chat-mic-btn" id="micButton" title="Gravar áudio" aria-label="Gravar áudio">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                        </button>
                        <button type="button" class="chat-send-btn" id="sendButton" onclick="sendMessage()" title="Enviar mensagem">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                    </div>
                    <div class="chat-audio-recorder" id="chatAudioRecorder" style="display: none;">
                        <div class="audio-recorder-waves" id="audioRecorderWaves">
                            <span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span><span class="wave-bar"></span>
                        </div>
                        <span class="audio-recorder-timer" id="audioRecorderTimer">0:00</span>
                        <div class="audio-recorder-actions">
                            <button type="button" class="audio-recorder-btn audio-recorder-cancel" id="audioRecorderCancel" title="Cancelar" aria-label="Cancelar">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                            </button>
                            <button type="button" class="audio-recorder-btn audio-recorder-pause" id="audioRecorderPause" title="Pausar" aria-label="Pausar">
                                <span class="icon-pause"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg></span>
                                <span class="icon-play" style="display:none"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg></span>
                            </button>
                            <button type="button" class="audio-recorder-btn audio-recorder-send" id="audioRecorderSend" title="Enviar áudio" aria-label="Enviar áudio">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="contact-details-overlay" id="contactDetailsOverlay" onclick="window.closeContactDetailsPanel(event)">
                    <div class="contact-details-panel" onclick="event.stopPropagation()">
                        <div class="contact-details-panel-header">
                            <button type="button" class="contact-details-panel-close" onclick="window.closeContactDetailsPanel()" aria-label="Fechar">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                            <h2 class="contact-details-panel-title">Dados do contato</h2>
                        </div>
                        <div class="contact-details-panel-body">
                            <div class="contact-details-avatar-wrap">
                                <div class="contact-details-avatar" ${currentConversationFotoPerfil ? `style="background-image: url('${escapeHtml(currentConversationFotoPerfil)}');"` : ''}>${currentConversationFotoPerfil ? '' : getInitials(contactName)}</div>
                                <div class="contact-details-phone">${escapeHtml(contactName)}</div>
                                ${hasRealName ? `<div class="contact-details-name">${escapeHtml(contactDetailsPhoneDisplay)}</div>` : ''}
                            </div>
                            <div class="contact-details-actions">
                                <button type="button" class="contact-details-action-btn" onclick="window.closeContactDetailsPanel(); window.openConversationSearch();" title="Pesquisar nesta conversa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                    Pesquisar
                                </button>
                                <button type="button" class="contact-details-action-btn" onclick="window.closeContactDetailsPanel(); if(window.openSaveContactModal) window.openSaveContactModal('${(currentConversationPhone || '').replace(/'/g, "\\'")}');" title="${hasRealName ? 'Editar contato' : 'Adicionar contato'}">
                                    ${hasRealName
                                        ? '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>'
                                        : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>'
                                    }
                                    ${hasRealName ? 'Editar' : 'Adicionar'}
                                </button>
                            </div>
                            <div class="contact-details-section contact-details-section--after-actions">
                                <h3 class="contact-details-section-heading">Conexão e atendimento</h3>
                                <div class="contact-details-conexao-wrap">
                                    <div class="contact-details-conexao-label">Conexão</div>
                                    <div class="contact-details-conexao-tag">${escapeHtml(currentConversationConexaoName || '—')}</div>
                                    <div class="contact-details-conexao-phone"><span>Telefone</span> ${escapeHtml(currentConversationConexaoPhone || '—')}</div>
                                </div>
                                <div class="contact-details-conexao-wrap contact-details-atendente-wrap" style="margin-top:12px;">
                                    <div class="contact-details-conexao-label-row">
                                        <div class="contact-details-conexao-label">Atendente</div>
                                        <button type="button" class="contact-details-atendente-edit-btn" id="contactDetailsTransferToggleBtn" aria-label="Editar atendente" title="Editar atendente" aria-expanded="false" onclick="window.toggleContactDetailsTransferEditor(event)" hidden>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                                        </button>
                                    </div>
                                    <div class="contact-details-conexao-tag" id="contactDetailsAtendenteNomeDisplay">${escapeHtml(currentConversationAtendenteNome || '—')}</div>
                                    <div id="contactDetailsTransferMount"></div>
                                </div>
                            </div>
                            <div class="contact-details-section" id="contactDetailsEtiquetasSection">
                                <h3 class="contact-details-section-heading">Etiquetas</h3>
                                <div class="contact-detail-etiquetas-wrap">
                                    <div class="contact-detail-etiquetas-bar">
                                        <div id="contactDetailsEtiquetasChipsMount" class="contact-detail-etiquetas-chips"></div>
                                        <button type="button" class="contact-detail-etiqueta-add" id="contactDetailsEtiquetasPickerToggle" onclick="window.toggleContactDetailsEtiquetasPicker(event)" aria-expanded="false" aria-controls="contactDetailsEtiquetasPickerPanel" hidden>+</button>
                                    </div>
                                    <div id="contactDetailsEtiquetasPickerPanel" class="contact-detail-etiqueta-picker" role="region" aria-label="Etiquetas disponíveis" hidden>
                                        <p class="contact-detail-etiqueta-picker-head">Todas as etiquetas</p>
                                        <input type="search" id="contactDetailsEtiquetasSearch" class="chat-filter-tag-search-input contact-details-etiquetas-search" placeholder="Buscar etiqueta..." autocomplete="off" aria-label="Buscar etiqueta">
                                        <div id="contactDetailsEtiquetasMount" class="contact-detail-etiqueta-picker-list"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-details-section">
                                <h3 class="contact-details-section-heading">CRM</h3>
                                <p class="contact-details-section-hint">Quadro e etapa de cada card. Toque para abrir o card no CRM.</p>
                                <div id="contactDetailsCrmMount" class="contact-details-dynamic-mount">Carregando…</div>
                            </div>
                            <div class="contact-details-section" id="contactDetailsCustomFieldsSection">
                                <h3 class="contact-details-section-heading">Campos personalizados</h3>
                                <p class="contact-details-section-hint">Valores preenchidos para este contato ou grupo na agenda.</p>
                                <div class="contact-details-cf-bar">
                                    <div class="contact-details-cf-listwrap">
                                        <div id="contactDetailsCustomFieldsMount" class="contact-details-dynamic-mount">Carregando…</div>
                                    </div>
                                    <button type="button" class="contact-details-cf-icon-btn" id="contactDetailsCustomFieldsAddBtn" onclick="window.openChatCampoValorModal()" title="Adicionar valor" aria-label="Adicionar campo" hidden>+</button>
                                </div>
                            </div>
                            <div class="contact-details-section" id="contactDetailsFavoritesSection">
                                <h3 class="contact-details-section-heading">Mensagens favoritas</h3>
                                <p class="contact-details-section-hint">Toque para ir à mensagem no chat.</p>
                                <div id="contactDetailsFavoritesMount" class="contact-details-dynamic-mount">Carregando…</div>
                            </div>
                            <div class="contact-details-section">
                                <h3 class="contact-details-section-heading">Nota da conversa</h3>
                                <div class="contact-details-nota-pad" role="region" aria-label="Bloco de notas">
                                    <div class="contact-details-nota-wrap">
                                        <textarea id="contactDetailsNotaInput" class="contact-details-nota-input" rows="4" placeholder="Adicione observações sobre esta conversa...">${escapeHtml(currentConversationNota || '')}</textarea>
                                        <button type="button" id="contactDetailsNotaSaveBtn" class="contact-details-nota-save" onclick="window.saveContactNota()" title="Salvar nota" hidden>Salvar</button>
                                    </div>
                                </div>
                            </div>
                            ${showDeleteButton ? `<div class="contact-details-delete-wrap">
                                <button type="button" class="contact-details-delete-btn" onclick="window.deleteConversation()" title="Excluir esta conversa e todas as mensagens">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                    Excluir conversa
                                </button>
                            </div>` : ''}
                        </div>
                    </div>
                </div>
            `;

            // Carregar mensagens imediatamente após montar a estrutura base.
            loadMessages(conversationId);
            updateChatHeaderNotaIndicator();
            void updateChatHeaderAtendentePill();
            void populateContactDetailsSidePanelExtras();
            setupContactDetailsNotaSaveVisibility();

            // Carregar metadados pesados do cabeçalho (etiquetas/CRM) em segundo plano
            // para não atrasar a troca imediata entre conversas.
            void (async () => {
                try {
                    let contaIdHdr = currentUserId;
                    if (!contaIdHdr) {
                        contaIdHdr = await getUserIdFromAuth();
                        if (contaIdHdr) currentUserId = contaIdHdr;
                    }
                    const cHdr = currentConversationContatoId;
                    if (!contaIdHdr || !cHdr) return;
                    const [bundleHdr, crmHdr] = await Promise.all([
                        fetchChatContactEtiquetasBundle(cHdr, contaIdHdr),
                        fetchCrmCardsForChatContactDetails(cHdr)
                    ]);
                    if (String(currentConversationId) !== String(conversationId)) return;
                    const mount = document.getElementById('chatHeaderMetaMount');
                    if (!mount) return;
                    mount.innerHTML = buildChatHeaderMetaOuterHtml(bundleHdr, crmHdr);
                } catch (hdrErr) {
                    if (hdrErr && hdrErr.message === 'STATUS_BLOQUEADO') return;
                    console.warn('Cabeçalho (etiquetas/CRM):', hdrErr);
                }
            })();

            // Anexar listeners do gravador de áudio, menu de mídia e respostas rápidas (elementos criados no chat)
            setupAudioRecorderListeners();
            setupMediaMenuListeners();
            setupQuickRepliesListeners();
            setupEmojiPickerListeners();
            setupSignatureButton();

            // Listener da pesquisa na conversa
            const searchInput = document.getElementById('chatSearchInput');
            if (searchInput) searchInput.addEventListener('input', runConversationSearch);
            autoResizeMessageInput();
        }

        /**
         * Texto enviado por mim, editável no menu (janela 15 min).
         * messageEvolutionId / enviada podem ainda não estar no DOM; submitEditMessageUpdate sincroniza pelo Supabase.
         */
        function isMessageDomEligibleForEdit(messageEl) {
            if (!messageEl || !messageEl.classList.contains('sent')) return false;
            if (messageEl.getAttribute('data-message-apagada') === '1') return false;
            const mid = messageEl.getAttribute('data-message-id');
            if (!mid || String(mid).indexOf('temp-') === 0) return false;
            const tipo = (messageEl.getAttribute('data-message-tipo') || '').toLowerCase();
            const allowedTipo = ['', 'conversation', 'extendedtextmessage'];
            if (allowedTipo.indexOf(tipo) === -1) return false;
            const created = messageEl.getAttribute('data-message-created-at');
            if (!created) return false;
            const ts = new Date(created).getTime();
            if (Number.isNaN(ts)) return false;
            if (Date.now() - ts > 15 * 60 * 1000) return false;
            return true;
        }

        function readMessageEvolutionIdFromRow(row) {
            if (!row) return '';
            const v = row.messageEvolutionId;
            if (v == null) return '';
            return String(v).trim();
        }

        async function syncOutgoingMessageMetaFromSupabaseForEdit(messageIdStr) {
            const idNum = parseInt(messageIdStr, 10);
            const client = typeof window !== 'undefined' && window.supabase ? window.supabase : supabase;
            if (Number.isNaN(idNum) || !client) return { evolutionId: null, enviadaOk: false };
            const { data: row, error } = await client
                .from('SAAS_Mensagens')
                .select('messageEvolutionId, enviada')
                .eq('id', idNum)
                .maybeSingle();
            if (error || !row) return { evolutionId: null, enviadaOk: false };
            const evoRaw = readMessageEvolutionIdFromRow(row);
            const evo = evoRaw;
            const enviadaOk = row.enviada === true || row.enviada === 'true' || row.enviada === 1;
            const esc = String(messageIdStr).replace(/\\/g, '\\\\').replace(/"/g, '\\"');
            document.querySelectorAll('[data-message-id="' + esc + '"]').forEach(function (blk) {
                if (evo) blk.setAttribute('data-message-evolution-id', evo);
                blk.setAttribute('data-message-enviada', enviadaOk ? '1' : '0');
            });
            return { evolutionId: evo || null, enviadaOk };
        }

        async function verifyMessageEditableInSupabase(messageIdNum) {
            const client = typeof window !== 'undefined' && window.supabase ? window.supabase : supabase;
            if (!client || Number.isNaN(messageIdNum)) return { ok: false, reason: 'Dados inválidos.' };
            const { data: row, error } = await client
                .from('SAAS_Mensagens')
                .select('fromMe, apagada, tipoMensagem, created_at, messageEvolutionId, enviada')
                .eq('id', messageIdNum)
                .maybeSingle();
            if (error || !row) return { ok: false, reason: 'Mensagem não encontrada.' };
            if (!(row.fromMe === true || row.fromMe === 'true' || row.fromMe === 1)) {
                return { ok: false, reason: 'Só é possível editar mensagens enviadas por você.' };
            }
            if (row.apagada === true || row.apagada === 'true' || row.apagada === 1) {
                return { ok: false, reason: 'Mensagem apagada não pode ser editada.' };
            }
            const tipo = String(row.tipoMensagem ?? '').toLowerCase();
            const allowedTipo = ['', 'conversation', 'extendedtextmessage'];
            if (allowedTipo.indexOf(tipo) === -1) {
                return { ok: false, reason: 'Este tipo de mensagem não pode ser editado.' };
            }
            const created = row.created_at != null ? row.created_at : row.createdAt;
            const ts = new Date(created).getTime();
            if (Number.isNaN(ts)) return { ok: false, reason: 'Data da mensagem inválida.' };
            if (Date.now() - ts > 15 * 60 * 1000) {
                return { ok: false, reason: 'Prazo de 15 minutos para edição expirou.' };
            }
            return { ok: true, row };
        }

        function getEditableMessageTextFromDomByMessageId(messageId) {
            if (messageId == null || messageId === '') return '';
            const sel = '[data-message-id="' + String(messageId).replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '"]';
            const blocks = document.querySelectorAll(sel);
            const parts = [];
            blocks.forEach(function (blk) {
                blk.querySelectorAll('.message-content-inner .message-text').forEach(function (span) {
                    const t = (span.textContent || '').trim();
                    if (t) parts.push(span.textContent || '');
                });
            });
            if (parts.length) return parts.join('\n');
            return '';
        }

        function setEditMessageModalSaving(saving) {
            const modal = document.getElementById('editMessageModal');
            const saveBtn = document.getElementById('editMessageSaveBtn');
            const cancelBtn = document.getElementById('editMessageCancelBtn');
            const input = document.getElementById('editMessageTextInput');
            const closeBtn = modal ? modal.querySelector('.modal-header .modal-close') : null;
            if (!modal || !saveBtn) return;
            modal.classList.toggle('edit-message-modal--saving', !!saving);
            saveBtn.disabled = !!saving;
            if (cancelBtn) cancelBtn.disabled = !!saving;
            if (closeBtn) closeBtn.disabled = !!saving;
            if (input) input.readOnly = !!saving;
            if (saving) {
                if (!saveBtn.dataset.editSaveHtml) saveBtn.dataset.editSaveHtml = saveBtn.innerHTML;
                saveBtn.classList.add('btn-delete-loading');
                saveBtn.innerHTML = '<span class="delete-btn-spinner" aria-hidden="true"></span><span>Salvando…</span>';
            } else {
                saveBtn.classList.remove('btn-delete-loading');
                const prev = saveBtn.dataset.editSaveHtml;
                if (prev) saveBtn.innerHTML = prev;
                else saveBtn.textContent = 'Salvar';
            }
        }

        async function openEditMessageModal(messageId) {
            const modal = document.getElementById('editMessageModal');
            const input = document.getElementById('editMessageTextInput');
            const hid = document.getElementById('editMessageHiddenId');
            const hidEvo = document.getElementById('editMessageEvolutionIdHidden');
            if (!modal || !input || !hid) return;
            setEditMessageModalSaving(false);
            hid.value = String(messageId);
            if (hidEvo) hidEvo.value = '';
            input.value = getEditableMessageTextFromDomByMessageId(messageId);
            modal.classList.add('active');
            document.querySelectorAll('.message-options-menu.show').forEach(function (m) { m.classList.remove('show'); });
            setTimeout(function () { input.focus(); input.select(); }, 50);

            const idNum = parseInt(String(messageId), 10);
            const client = typeof window !== 'undefined' && window.supabase ? window.supabase : supabase;
            if (Number.isNaN(idNum) || !client) return;
            try {
                const { data: row, error } = await client
                    .from('SAAS_Mensagens')
                    .select('mensagem, messageEvolutionId, enviada, tipoMensagem, created_at')
                    .eq('id', idNum)
                    .maybeSingle();
                if (error) {
                    console.warn('Carregar mensagem para edição:', error);
                    return;
                }
                if (!row) return;
                if (row.mensagem != null && String(row.mensagem).trim() !== '') {
                    input.value = String(row.mensagem);
                }
                const evo = readMessageEvolutionIdFromRow(row);
                if (hidEvo) hidEvo.value = evo;
                await syncOutgoingMessageMetaFromSupabaseForEdit(String(messageId));
            } catch (e) {
                console.warn('openEditMessageModal:', e);
            }
        }

        /** @param {boolean} [force] true após salvar com sucesso */
        function closeEditMessageModal(force) {
            const modal = document.getElementById('editMessageModal');
            if (!modal) return;
            if (!force && modal.classList.contains('edit-message-modal--saving')) return;
            modal.classList.remove('active');
            setEditMessageModalSaving(false);
            const hidEvo = document.getElementById('editMessageEvolutionIdHidden');
            if (hidEvo) hidEvo.value = '';
        }

        async function submitEditMessageUpdate() {
            const hid = document.getElementById('editMessageHiddenId');
            const input = document.getElementById('editMessageTextInput');
            if (!hid || !input) return;
            const messageId = hid.value;
            const newText = input.value;
            if (!messageId || !currentConversationId) {
                if (typeof showToast === 'function') showToast('Não foi possível editar a mensagem.', 'error');
                return;
            }
            const idNumPre = parseInt(messageId, 10);
            if (Number.isNaN(idNumPre) || String(messageId).indexOf('temp-') === 0) {
                if (typeof showToast === 'function') showToast('Não foi possível editar a mensagem.', 'error');
                return;
            }
            const messageEl = document.querySelector('[data-message-id="' + String(messageId).replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '"]');
            const domOk = messageEl && isMessageDomEligibleForEdit(messageEl);
            let dbVerifyRow = null;
            if (!domOk) {
                const v = await verifyMessageEditableInSupabase(idNumPre);
                if (!v.ok) {
                    if (typeof showToast === 'function') showToast(v.reason || 'Não foi possível editar a mensagem.', 'error');
                    return;
                }
                dbVerifyRow = v.row || null;
            }
            /* Evolution updateMessage só precisa do messageEvolutionId. A coluna enviada no Supabase pode ficar false
             * (relógio na UI) mesmo depois do WhatsApp aceitar — não bloquear edição por isso. */
            const hidEvoEl = document.getElementById('editMessageEvolutionIdHidden');
            let messageEvolutionId = (hidEvoEl && hidEvoEl.value && String(hidEvoEl.value).trim())
                ? String(hidEvoEl.value).trim()
                : null;
            if (!messageEvolutionId) {
                messageEvolutionId = messageEl ? messageEl.getAttribute('data-message-evolution-id') : null;
            }
            if (dbVerifyRow) {
                const evoDb = readMessageEvolutionIdFromRow(dbVerifyRow);
                if (evoDb) messageEvolutionId = evoDb;
            }
            messageEvolutionId = (messageEvolutionId != null && String(messageEvolutionId).trim() !== '')
                ? String(messageEvolutionId).trim() : '';
            if (!messageEvolutionId) {
                const synced = await syncOutgoingMessageMetaFromSupabaseForEdit(messageId);
                messageEvolutionId = synced.evolutionId ? String(synced.evolutionId).trim() : '';
            }
            if (!messageEvolutionId) {
                if (typeof showToast === 'function') {
                    showToast('Ainda não há ID da mensagem no WhatsApp para editar. Aguarde alguns segundos e tente de novo.', 'info');
                }
                return;
            }
            const client = typeof window !== 'undefined' && window.supabase ? window.supabase : supabase;
            if (!client) {
                if (typeof showToast === 'function') showToast('Cliente indisponível. Recarregue a página.', 'error');
                return;
            }
            setEditMessageModalSaving(true);
            try {
                const conversaIdNum = parseInt(currentConversationId, 10);
                if (Number.isNaN(conversaIdNum)) throw new Error('conversa');
                const { data: conversaData, error: conversaError } = await client
                    .from('SAAS_Conversas_Agentes')
                    .select('idConexao, telefone')
                    .eq('id', conversaIdNum)
                    .single();
                if (conversaError || !conversaData || !conversaData.idConexao) throw new Error('conversa');
                const { data: conexaoData, error: conexaoError } = await client
                    .from('SAAS_Conexões')
                    .select('instanceName, Apikey')
                    .eq('id', conversaData.idConexao)
                    .single();
                if (conexaoError || !conexaoData) throw new Error('conexao');
                const instanceName = conexaoData.instanceName || '';
                const apikey = conexaoData.Apikey || '';
                if (!instanceName || !apikey) throw new Error('credenciais');
                const telefoneRaw = conversaData.telefone || currentConversationPhone || '';
                const remoteJid = normalizeTelefoneToWhatsappJid(telefoneRaw);
                if (!remoteJid) throw new Error('telefone');
                const url = 'https://evo.chatconversa.app.br/hublabel/public/chat/updateMessage/' + encodeURIComponent(instanceName);
                const body = {
                    number: remoteJid,
                    key: {
                        remoteJid: remoteJid,
                        fromMe: true,
                        id: messageEvolutionId
                    },
                    text: newText
                };
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'apikey': apikey
                    },
                    body: JSON.stringify(body)
                });
                let evolutionJson = null;
                try {
                    evolutionJson = await res.json();
                } catch (e) { /* corpo vazio ou não-JSON */ }
                const evErr = evolutionJson && (evolutionJson.success === false || evolutionJson.status === 'error' || (evolutionJson.error != null && evolutionJson.error !== ''));
                var evMsg = '';
                if (evolutionJson) {
                    var m0 = evolutionJson.message;
                    var m1 = evolutionJson.msg;
                    var m2 = evolutionJson.error;
                    evMsg = (typeof m0 === 'string' ? m0 : '') || (typeof m1 === 'string' ? m1 : '') || (typeof m2 === 'string' ? m2 : '');
                }
                if (!res.ok || evErr) {
                    const detail = evMsg || res.statusText || '';
                    console.warn('Evolution updateMessage:', res.status, detail, evolutionJson);
                    if (typeof showToast === 'function') {
                        showToast(detail ? ('Não foi possível editar: ' + detail.slice(0, 120)) : 'Não foi possível editar a mensagem.', 'error');
                    }
                    return;
                }
                const idNum = parseInt(messageId, 10);
                if (Number.isNaN(idNum)) throw new Error('id');
                const { error: upErr } = await client
                    .from('SAAS_Mensagens')
                    .update({ mensagem: newText })
                    .eq('id', idNum);
                if (upErr) {
                    console.error('Supabase update mensagem após Evolution:', upErr);
                    if (typeof showToast === 'function') showToast('Não foi possível salvar a edição no banco.', 'error');
                    return;
                }
                document.querySelectorAll('[data-message-id="' + String(messageId).replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '"]').forEach(function (blk) {
                    blk.querySelectorAll('.message-content-inner .message-text').forEach(function (span) {
                        span.textContent = newText;
                    });
                });
                closeEditMessageModal(true);
            } catch (err) {
                console.error('editar mensagem:', err);
                if (typeof showToast === 'function') showToast('Não foi possível editar a mensagem.', 'error');
            } finally {
                setEditMessageModalSaving(false);
            }
        }

        /**
         * Módulo inline executa antes do HTML que vem após o fim deste bloco script; o modal fica depois no ficheiro.
         * Delegação em document evita anexar listener a um botão que ainda não existe no DOM.
         */
        function bindEditMessageModalControls() {
            if (typeof document === 'undefined' || !document.documentElement) return;
            if (document.documentElement.dataset.editMessageSaveDelegate === '1') return;
            document.documentElement.dataset.editMessageSaveDelegate = '1';
            document.addEventListener('click', function editMessageSaveDelegated(ev) {
                const t = ev.target;
                if (!t || typeof t.closest !== 'function') return;
                const btn = t.closest('#editMessageSaveBtn');
                if (!btn) return;
                if (btn.disabled) return;
                ev.preventDefault();
                ev.stopPropagation();
                void submitEditMessageUpdate();
            }, true);
        }

        window.closeEditMessageModal = closeEditMessageModal;
        window.openEditMessageModal = openEditMessageModal;
        window.submitEditMessageUpdate = submitEditMessageUpdate;

        const MESSAGE_APAGADA_TOMB_SVG = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>';

        /**
         * Troca o bloco da mensagem na UI para o estado “apagada”: mantém o conteúdo visível (cinza) com ícone de lixo ao lado.
         */
        function applyDeletedAppearanceToMessageElement(blk) {
            if (!blk) return;
            blk.classList.add('message-apagada');
            blk.setAttribute('data-message-apagada', '1');
            blk.setAttribute('data-message-favorita', '0');
            const content = blk.querySelector('.message-content');
            if (!content) return;
            const inner = content.querySelector('.message-content-inner');
            if (!inner) return;
            const bodyBlk = inner.querySelector('.message-body-block');
            var preservedInner;
            if (bodyBlk) {
                preservedInner = bodyBlk.innerHTML.replace(/^\s+|\s+$/g, '');
            } else {
                const clone = inner.cloneNode(true);
                clone.querySelectorAll('.message-options-btn').forEach(function (el) { el.remove(); });
                clone.querySelectorAll('.message-time').forEach(function (el) { el.remove(); });
                clone.querySelectorAll('.message-status-icon').forEach(function (el) { el.remove(); });
                clone.querySelectorAll('.message-favorite-star').forEach(function (el) { el.remove(); });
                preservedInner = clone.innerHTML.replace(/^\s+|\s+$/g, '');
            }
            var preservedBlock;
            if (!preservedInner) {
                preservedBlock = '<span class="message-text message-apagada-text">Esta mensagem foi apagada</span>';
            } else {
                preservedBlock = '<span class="message-apagada-preserved">' + preservedInner + '</span>';
            }
            const tombRow = '<span class="message-apagada-row message-apagada-row--with-content"><span class="message-apagada-icon" title="Mensagem apagada">' + MESSAGE_APAGADA_TOMB_SVG + '</span>' + preservedBlock + '</span>';
            const timeEl = inner.querySelector('.message-time');
            const statusHtml = Array.from(inner.querySelectorAll('.message-status-icon')).map(function (s) { return s.outerHTML; }).join('');
            var timeHtml;
            if (timeEl) {
                timeHtml = timeEl.outerHTML;
            } else {
                var cisoDel = blk.getAttribute('data-message-created-at');
                var tlDel = cisoDel ? formatMessageTime(cisoDel) : '';
                timeHtml = '<span class="message-time">' + escapeHtml(tlDel) + '</span>';
            }
            const bodyBlock = '<span class="message-body-block">' + tombRow + '</span>';
            const metaHtml = '<span class="message-trailing-meta">' + timeHtml + statusHtml + '</span>';
            inner.innerHTML = bodyBlock + metaHtml;
        }

        /**
         * Excluir para todos: fromMe, enviada, não apagada, com evolution id, até 48 h.
         */
        function isMessageDomEligibleForDelete(messageEl) {
            if (!messageEl || !messageEl.classList.contains('sent')) return false;
            if (messageEl.getAttribute('data-message-apagada') === '1') return false;
            const mid = messageEl.getAttribute('data-message-id');
            if (!mid || String(mid).indexOf('temp-') === 0) return false;
            const evo = messageEl.getAttribute('data-message-evolution-id');
            if (!evo || !String(evo).trim()) return false;
            if (messageEl.getAttribute('data-message-enviada') !== '1') return false;
            const created = messageEl.getAttribute('data-message-created-at');
            if (!created) return false;
            const ts = new Date(created).getTime();
            if (Number.isNaN(ts)) return false;
            if (Date.now() - ts > 48 * 60 * 60 * 1000) return false;
            return true;
        }

        function resetDeleteMessageModalButtons() {
            const btn = document.getElementById('deleteMessageConfirmBtn');
            const cancelBtn = document.getElementById('deleteMessageCancelBtn');
            if (btn) {
                btn.disabled = false;
                btn.classList.remove('btn-delete-loading');
                btn.innerHTML = 'Excluir';
            }
            if (cancelBtn) cancelBtn.disabled = false;
        }

        function openDeleteMessageConfirm(messageId) {
            const modal = document.getElementById('deleteMessageModal');
            const hid = document.getElementById('deleteMessageHiddenId');
            if (!modal || !hid) return;
            resetDeleteMessageModalButtons();
            hid.value = String(messageId);
            modal.classList.add('active');
            document.querySelectorAll('.message-options-menu.show').forEach(function (m) { m.classList.remove('show'); });
        }

        function closeDeleteMessageConfirm() {
            const modal = document.getElementById('deleteMessageModal');
            if (modal) modal.classList.remove('active');
            resetDeleteMessageModalButtons();
        }

        async function submitDeleteMessageForEveryone() {
            const hid = document.getElementById('deleteMessageHiddenId');
            const btn = document.getElementById('deleteMessageConfirmBtn');
            const cancelBtn = document.getElementById('deleteMessageCancelBtn');
            if (!hid) return;
            const messageId = hid.value;
            if (!messageId || !currentConversationId) {
                if (typeof showToast === 'function') showToast('Não foi possível excluir essa mensagem.', 'error');
                return;
            }
            const messageEl = document.querySelector('[data-message-id="' + String(messageId).replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '"]');
            if (!messageEl || !isMessageDomEligibleForDelete(messageEl)) {
                if (typeof showToast === 'function') showToast('Não foi possível excluir essa mensagem.', 'error');
                closeDeleteMessageConfirm();
                return;
            }
            const messageEvolutionId = messageEl.getAttribute('data-message-evolution-id');
            if (!messageEvolutionId) {
                if (typeof showToast === 'function') showToast('Não foi possível excluir essa mensagem.', 'error');
                return;
            }
            if (btn) {
                btn.disabled = true;
                btn.classList.add('btn-delete-loading');
                btn.innerHTML = '<span class="delete-btn-spinner" aria-hidden="true"></span><span>Excluindo…</span>';
            }
            if (cancelBtn) cancelBtn.disabled = true;
            try {
                const conversaIdNum = parseInt(currentConversationId, 10);
                if (Number.isNaN(conversaIdNum)) throw new Error('conversa');
                const { data: conversaData, error: conversaError } = await supabase
                    .from('SAAS_Conversas_Agentes')
                    .select('idConexao, telefone')
                    .eq('id', conversaIdNum)
                    .single();
                if (conversaError || !conversaData || !conversaData.idConexao) throw new Error('conversa');
                const { data: conexaoData, error: conexaoError } = await supabase
                    .from('SAAS_Conexões')
                    .select('instanceName, Apikey')
                    .eq('id', conversaData.idConexao)
                    .single();
                if (conexaoError || !conexaoData) throw new Error('conexao');
                const instanceName = conexaoData.instanceName || '';
                const apikey = conexaoData.Apikey || '';
                if (!instanceName || !apikey) throw new Error('credenciais');
                const telefoneRaw = conversaData.telefone || currentConversationPhone || '';
                const remoteJid = normalizeTelefoneToWhatsappJid(telefoneRaw);
                if (!remoteJid) throw new Error('telefone');
                const url = 'https://evo.chatconversa.app.br/hublabel/public/chat/deleteMessageForEveryone/' + encodeURIComponent(instanceName);
                const body = {
                    id: messageEvolutionId,
                    remoteJid: remoteJid,
                    fromMe: true,
                    paticipant: 'paticipant'
                };
                const res = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'apikey': apikey
                    },
                    body: JSON.stringify(body)
                });
                if (!res.ok) {
                    console.warn('Evolution deleteMessageForEveryone:', res.status);
                    if (typeof showToast === 'function') showToast('Não foi possível excluir essa mensagem.', 'error');
                    resetDeleteMessageModalButtons();
                    return;
                }
                const idNum = parseInt(messageId, 10);
                if (Number.isNaN(idNum)) throw new Error('id');
                const { error: upErr } = await supabase
                    .from('SAAS_Mensagens')
                    .update({ apagada: true })
                    .eq('id', idNum);
                if (upErr) {
                    console.error('Supabase apagada após Evolution:', upErr);
                    if (typeof showToast === 'function') showToast('Não foi possível excluir essa mensagem.', 'error');
                    resetDeleteMessageModalButtons();
                    return;
                }
                document.querySelectorAll('[data-message-id="' + String(messageId).replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '"]').forEach(function (blk) {
                    applyDeletedAppearanceToMessageElement(blk);
                });
                closeDeleteMessageConfirm();
            } catch (err) {
                console.error('excluir mensagem:', err);
                if (typeof showToast === 'function') showToast('Não foi possível excluir essa mensagem.', 'error');
                resetDeleteMessageModalButtons();
            }
        }

        window.closeDeleteMessageConfirm = closeDeleteMessageConfirm;
        window.submitDeleteMessageForEveryone = submitDeleteMessageForEveryone;

        const MESSAGE_FAVORITE_STAR_HTML = '<span class="message-favorite-star" title="Favorita" aria-label="Favorita"><svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" aria-hidden="true"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>';

        function isMessageFavoriteTruthy(val) {
            return val === true || val === 'true' || val === 1 || val === '1';
        }

        function isMessageDomEligibleForFavorite(messageEl) {
            if (!messageEl) return false;
            if (messageEl.getAttribute('data-message-apagada') === '1') return false;
            const mid = messageEl.getAttribute('data-message-id');
            if (!mid || String(mid).indexOf('temp-') === 0) return false;
            if (Number.isNaN(parseInt(mid, 10))) return false;
            return true;
        }

        function escapeMessageIdCssSelector(messageIdStr) {
            return String(messageIdStr).replace(/\\/g, '\\\\').replace(/"/g, '\\"');
        }

        function setMessageFavoriteDom(messageIdStr, favoritaBool) {
            const esc = escapeMessageIdCssSelector(messageIdStr);
            document.querySelectorAll('[data-message-id="' + esc + '"]').forEach(function (blk) {
                blk.setAttribute('data-message-favorita', favoritaBool ? '1' : '0');
                blk.querySelectorAll('.message-content-inner').forEach(function (inner) {
                    inner.querySelectorAll('.message-favorite-star').forEach(function (s) { s.remove(); });
                    if (favoritaBool) {
                        const timeEl = inner.querySelector('.message-time');
                        if (timeEl) {
                            const wrap = document.createElement('div');
                            wrap.innerHTML = MESSAGE_FAVORITE_STAR_HTML;
                            const star = wrap.firstElementChild;
                            if (star) {
                                const timeParent = timeEl.parentNode;
                                if (timeParent) timeParent.insertBefore(star, timeEl);
                                else inner.appendChild(star);
                            }
                        }
                    }
                });
            });
        }

        async function toggleMessageFavoriteInSupabase(messageIdStr, nextFavorite) {
            if (!supabase) return;
            const idNum = parseInt(messageIdStr, 10);
            if (Number.isNaN(idNum)) {
                if (typeof showToast === 'function') showToast('ID da mensagem inválido.', 'error');
                return;
            }
            try {
                const { error } = await supabase
                    .from('SAAS_Mensagens')
                    .update({ favorita: !!nextFavorite })
                    .eq('id', idNum);
                if (error) {
                    console.error('Supabase favorita:', error);
                    if (typeof showToast === 'function') showToast('Não foi possível atualizar o favorito.', 'error');
                    return;
                }
                setMessageFavoriteDom(String(idNum), !!nextFavorite);
                void refreshContactDetailsFavoritesList();
            } catch (err) {
                console.error('favorita:', err);
                if (typeof showToast === 'function') showToast('Não foi possível atualizar o favorito.', 'error');
            }
        }

        async function refreshContactDetailsFavoritesList() {
            const mount = document.getElementById('contactDetailsFavoritesMount');
            if (!mount) return;
            const convId = currentConversationId;
            if (!convId) {
                mount.innerHTML = '<p class="contact-details-muted">Abra uma conversa para ver favoritas.</p>';
                return;
            }
            const conversaIdNum = parseInt(convId, 10);
            if (Number.isNaN(conversaIdNum)) {
                mount.innerHTML = '<p class="contact-details-muted">Conversa inválida.</p>';
                return;
            }
            mount.innerHTML = '<p class="contact-details-muted">Carregando…</p>';
            try {
                if (!supabase) throw new Error('Cliente Supabase indisponível');
                const selCols = 'id, mensagem, created_at, fromMe, tipoMensagem, apagada, favorita';
                let data;
                const q1 = await supabase
                    .from('SAAS_Mensagens')
                    .select(selCols)
                    .eq('conversaId', conversaIdNum)
                    .eq('favorita', true)
                    .order('created_at', { ascending: false })
                    .limit(100);
                if (q1.error) {
                    console.warn('Mensagens favoritas (filtro favorita no servidor):', q1.error.message || q1.error);
                    const q2 = await supabase
                        .from('SAAS_Mensagens')
                        .select(selCols)
                        .eq('conversaId', conversaIdNum)
                        .order('created_at', { ascending: false })
                        .limit(400);
                    if (q2.error) throw q2.error;
                    data = (q2.data || []).filter(function (r) { return isMessageFavoriteTruthy(r.favorita); }).slice(0, 100);
                } else {
                    data = q1.data;
                }
                const rows = (data || []).filter(function (r) {
                    const ap = r.apagada === true || r.apagada === 'true' || r.apagada === 1;
                    return !ap;
                });
                if (rows.length === 0) {
                    mount.innerHTML = '<p class="contact-details-muted">Nenhuma mensagem favorita nesta conversa.</p>';
                    return;
                }
                const typeLabels = { texto: 'Texto', imagemessage: 'Imagem', videomessage: 'Vídeo', audiomessage: 'Áudio', documentmessage: 'Documento', stickermessage: 'Sticker' };
                const starInline = '<span class="contact-details-favorite-star" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>';
                mount.innerHTML = '<div class="contact-details-favorites-list">' + rows.map(function (r) {
                    const id = r.id;
                    const raw = (r.mensagem || '').replace(/\s+/g, ' ').trim();
                    const prev = raw.length > 120 ? raw.slice(0, 117) + '…' : raw;
                    const tipo = String(r.tipoMensagem || r.tipo_mensagem || '').toLowerCase();
                    const tipoDisp = typeLabels[tipo] || (tipo ? tipo.replace(/message$/i, '') : 'Mensagem');
                    const prevEsc = escapeHtml(prev || ('(' + tipoDisp + ')'));
                    return '<button type="button" class="contact-details-favorite-row" data-fav-scroll-id="' + String(id) + '">' +
                        '<span class="contact-details-favorite-row-inner">' + starInline +
                        '<span class="contact-details-favorite-row-preview">' + prevEsc + '</span></span></button>';
                }).join('') + '</div>';
                mount.querySelectorAll('.contact-details-favorite-row[data-fav-scroll-id]').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        const mid = btn.getAttribute('data-fav-scroll-id');
                        if (mid) scrollToFavoriteMessageInChat(mid);
                    });
                });
            } catch (e) {
                console.warn('Mensagens favoritas:', e && (e.message || e));
                mount.innerHTML = '<p class="contact-details-muted">Não foi possível carregar favoritas.</p>';
            }
        }

        async function scrollToFavoriteMessageInChat(messageIdStr) {
            closeContactDetailsPanel();
            const esc = escapeMessageIdCssSelector(String(messageIdStr));
            const messagesEl = document.getElementById('chatMessages');
            if (!messagesEl) return;
            const selector = '[data-message-id="' + esc + '"]';
            let el = messagesEl.querySelector(selector);
            if (!el) {
                const targetConversationId = currentConversationId;
                let attempts = 0;
                const maxAttempts = 200;
                const loadingId = 'chatFavoriteHistoryLoading';
                const chatAreaEl = document.getElementById('chatArea');
                let loadingEl = chatAreaEl ? chatAreaEl.querySelector('#' + loadingId) : null;
                if (!loadingEl) {
                    loadingEl = document.createElement('div');
                    loadingEl.id = loadingId;
                    loadingEl.className = 'chat-favorite-loading-overlay';
                    loadingEl.innerHTML = '<div class="loading-spinner"></div><span>Carregando mensagens antigas...</span>';
                    if (chatAreaEl) chatAreaEl.appendChild(loadingEl);
                }
                try {
                    while (!el && messagesPaginationState.hasMoreMessages && attempts < maxAttempts) {
                        if (!targetConversationId || currentConversationId !== targetConversationId) return;
                        await loadMoreMessages();
                        attempts += 1;
                        el = messagesEl.querySelector(selector);
                    }
                    if (!el) {
                        if (typeof showToast === 'function') showToast('Não foi possível localizar esta mensagem favorita no histórico carregável.', 'info');
                        return;
                    }
                } finally {
                    const loadingNow = chatAreaEl ? chatAreaEl.querySelector('#' + loadingId) : null;
                    if (loadingNow) loadingNow.remove();
                }
            }
            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            el.classList.remove('message-scroll-highlight');
            void el.offsetWidth;
            el.classList.add('message-scroll-highlight');
            setTimeout(function () { el.classList.remove('message-scroll-highlight'); }, 1800);
        }

        window.scrollToFavoriteMessageInChat = scrollToFavoriteMessageInChat;

        /**
         * Mostra o menu de opções de uma mensagem
         * @param {Event} event - Evento do clique
         * @param {string|number} messageId - ID da mensagem
         * @param {string} messageText - Texto da mensagem
         */
        function showMessageOptions(event, messageId, messageText) {
            event.stopPropagation();
            event.preventDefault();
            
            console.log('🔘 showMessageOptions chamado:', { messageId, messageText: messageText?.substring(0, 30) });
            
            // Fechar outros menus abertos
            document.querySelectorAll('.message-options-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
            
            const menuId = `messageOptions-${messageId}`;
            console.log('🔍 Procurando menu com ID:', menuId);
            
            let menu = document.getElementById(menuId);
            
            // Se não encontrar, tentar encontrar pelo elemento pai da mensagem
            if (!menu) {
                const button = event.target.closest('.message-options-btn');
                if (button) {
                    const message = button.closest('.message');
                    if (message) {
                        menu = message.querySelector('.message-options-menu');
                        console.log('🔍 Menu encontrado pelo elemento pai:', menu);
                    }
                }
            }
            
            if (!menu) {
                console.error('❌ Menu de opções não encontrado:', menuId);
                console.log('📋 Todos os menus disponíveis:', Array.from(document.querySelectorAll('.message-options-menu')).map(m => m.id));
                return;
            }
            
            console.log('✅ Menu encontrado:', menu);
            
            // Usar data-* + listener para "Responder" (evita quebra do onclick com aspas/barra no texto)
            const safeId = String(messageId ?? '');
            const safeText = String(messageText ?? '');
            
            const messageRoot = (event.target && event.target.closest) ? event.target.closest('.message') : null;
            const showEdit = messageRoot && isMessageDomEligibleForEdit(messageRoot);
            const showDelete = messageRoot && isMessageDomEligibleForDelete(messageRoot);
            const showFavorite = messageRoot && isMessageDomEligibleForFavorite(messageRoot);
            const isAlreadyFavorite = messageRoot && messageRoot.getAttribute('data-message-favorita') === '1';

            menu.innerHTML = `
                <div class="message-options-item" data-reply-id="${escapeHtml(safeId)}" data-reply-text="${escapeHtml(safeText)}" data-action="reply">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 10 4 15 9 20"></polyline>
                        <path d="M20 4v7a4 4 0 0 1-4 4H4"></path>
                    </svg>
                    <span>Responder</span>
                </div>
                ${showFavorite ? `
                <div class="message-options-item" data-action="favorite" data-favorite-message-id="${escapeHtml(safeId)}" data-favorite-next="${isAlreadyFavorite ? '0' : '1'}">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <span>${isAlreadyFavorite ? 'Remover dos favoritos' : 'Favoritar'}</span>
                </div>` : ''}
                ${showEdit ? `
                <div class="message-options-item" data-action="edit" data-edit-message-id="${escapeHtml(safeId)}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    <span>Editar</span>
                </div>` : ''}
                ${showDelete ? `
                <div class="message-options-item message-options-item--delete" data-action="delete" data-delete-message-id="${escapeHtml(safeId)}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        <line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>
                    </svg>
                    <span>Excluir</span>
                </div>` : ''}
            `;
            
            menu.querySelector('[data-action="reply"]')?.addEventListener('click', (e) => {
                e.stopPropagation();
                const id = e.currentTarget.getAttribute('data-reply-id') || null;
                const text = e.currentTarget.getAttribute('data-reply-text') || '';
                replyToMessage(id, text);
            });
            menu.querySelector('[data-action="edit"]')?.addEventListener('click', (e) => {
                e.stopPropagation();
                const id = e.currentTarget.getAttribute('data-edit-message-id');
                if (id) void openEditMessageModal(id);
                menu.classList.remove('show');
            });
            menu.querySelector('[data-action="delete"]')?.addEventListener('click', (e) => {
                e.stopPropagation();
                const id = e.currentTarget.getAttribute('data-delete-message-id');
                if (id) openDeleteMessageConfirm(id);
                menu.classList.remove('show');
            });
            menu.querySelector('[data-action="favorite"]')?.addEventListener('click', (e) => {
                e.stopPropagation();
                const id = e.currentTarget.getAttribute('data-favorite-message-id');
                const next = e.currentTarget.getAttribute('data-favorite-next') === '1';
                menu.classList.remove('show');
                if (id) void toggleMessageFavoriteInSupabase(id, next);
            });
            
            // Posicionar o menu próximo ao botão
            const button = event.target.closest('.message-options-btn');
            if (button) {
                const message = button.closest('.message');
                const isReceived = message && message.classList.contains('received');
                
                // Verificar se é uma das 2 últimas mensagens
                const messagesContainer = message.closest('#chatMessages');
                const allMessages = messagesContainer ? Array.from(messagesContainer.querySelectorAll('.message')) : [];
                const messageIndex = allMessages.indexOf(message);
                const isLastTwo = messageIndex >= allMessages.length - 2;
                
                // Obter posição do botão em relação ao elemento .message
                const messageRect = message.getBoundingClientRect();
                const buttonRect = button.getBoundingClientRect();
                
                // Calcular posição relativa ao elemento .message
                const relativeLeft = buttonRect.left - messageRect.left;
                const relativeRight = messageRect.right - buttonRect.right;
                
                // Se for uma das 2 últimas mensagens, abrir para cima
                if (isLastTwo) {
                    const relativeBottom = messageRect.bottom - buttonRect.top;
                    menu.style.bottom = `${relativeBottom + 5}px`;
                    menu.style.top = 'auto';
                } else {
                    const relativeTop = buttonRect.bottom - messageRect.top + 5;
                    menu.style.top = `${relativeTop}px`;
                    menu.style.bottom = 'auto';
                }
                
                // Mensagem recebida: menu à direita do botão; enviada (fromMe): menu à esquerda do botão
                if (isReceived) {
                    menu.style.right = `${relativeRight}px`;
                    menu.style.left = 'auto';
                } else {
                    // fromMe: abrir menu à esquerda (right = distância da borda direita da mensagem até a esquerda do botão)
                    const buttonWidth = buttonRect.width || 24;
                    menu.style.right = `${relativeRight + buttonWidth}px`;
                    menu.style.left = 'auto';
                }
                
                console.log('📍 Menu posicionado:', { top: menu.style.top, bottom: menu.style.bottom, left: menu.style.left, right: menu.style.right, isReceived, isLastTwo, messageIndex, totalMessages: allMessages.length });
            }
            
            // Mostrar menu
            menu.classList.add('show');
            console.log('✅ Menu mostrado, classes:', menu.className);
            
            // Fechar ao clicar fora
            setTimeout(() => {
                const closeMenu = (e) => {
                    const btnRef = button || event.target.closest('.message-options-btn');
                    if (!menu.contains(e.target) && (!btnRef || !btnRef.contains(e.target))) {
                        menu.classList.remove('show');
                        document.removeEventListener('click', closeMenu);
                    }
                };
                document.addEventListener('click', closeMenu);
            }, 10);
        }

        /**
         * Busca uma mensagem pelo messageEvolutionId
         * @param {string} messageEvolutionId - messageEvolutionId da mensagem
         * @returns {Promise<Object|null>} Dados da mensagem ou null se não encontrada
         */
        async function getMessageByEvolutionId(messageEvolutionId) {
            if (!messageEvolutionId) return null;
            
            try {
                const { data, error } = await supabase
                    .from('SAAS_Mensagens')
                    .select('id, mensagem, fromMe, tipoMensagem, arquivoUrl')
                    .eq('messageEvolutionId', messageEvolutionId)
                    .single();
                
                if (error || !data) {
                    console.warn('⚠️ Mensagem respondida não encontrada:', messageEvolutionId);
                    return null;
                }
                
                return data;
            } catch (error) {
                console.error('❌ Erro ao buscar mensagem respondida:', error);
                return null;
            }
        }

        // AudioContext para notificação (precisa ser "desbloqueado" com um clique do usuário)
        let notificationAudioContext = null;

        /**
         * Desbloqueia o áudio para notificações (obrigatório: navegadores só permitem som após um gesto do usuário).
         * Chamado no primeiro clique/toque na página.
         */
        function unlockNotificationAudio() {
            if (notificationAudioContext) return;
            try {
                const Ctx = window.AudioContext || window.webkitAudioContext;
                if (!Ctx) return;
                notificationAudioContext = new Ctx();
                if (notificationAudioContext.state === 'suspended') {
                    notificationAudioContext.resume();
                }
                console.log('🔔 Áudio de notificação liberado (clique na página)');
            } catch (e) {
                console.warn('⚠️ Não foi possível liberar áudio:', e);
            }
        }

        /**
         * Toca um som de notificação de nova mensagem (Web Audio API).
         * Só funciona após o usuário ter clicado em qualquer lugar da página pelo menos uma vez.
         */
        function playNotificationSound() {
            try {
                const ctx = notificationAudioContext;
                if (!ctx) {
                    console.warn('🔇 Som de notificação: clique em qualquer lugar da página do chat para liberar o áudio.');
                    return;
                }
                if (ctx.state === 'suspended') {
                    ctx.resume();
                }
                const oscillator = ctx.createOscillator();
                const gainNode = ctx.createGain();
                oscillator.connect(gainNode);
                gainNode.connect(ctx.destination);
                oscillator.frequency.setValueAtTime(880, ctx.currentTime);
                oscillator.frequency.setValueAtTime(1100, ctx.currentTime + 0.1);
                oscillator.frequency.setValueAtTime(880, ctx.currentTime + 0.2);
                oscillator.type = 'sine';
                gainNode.gain.setValueAtTime(0.15, ctx.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.3);
                oscillator.start(ctx.currentTime);
                oscillator.stop(ctx.currentTime + 0.3);
            } catch (e) {
                console.warn('⚠️ Não foi possível tocar som de notificação:', e);
            }
        }

        /**
         * Abre imagem em tela cheia (overlay).
         * @param {HTMLElement} btn - Botão que disparou (dentro de .message-media-image ou de .message-media-wrapper)
         */
        function openImageFullscreen(btn) {
            if (!btn || !btn.closest) return;
            const container = btn.closest('.message-media-image') || btn.closest('.message-media-wrapper');
            if (!container) return;
            const img = container.querySelector('.message-media-image img') || container.querySelector('img');
            if (!img || !img.src) return;
            let overlay = document.getElementById('mediaFullscreenOverlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.id = 'mediaFullscreenOverlay';
                overlay.className = 'media-fullscreen-overlay';
                overlay.style.display = 'none';
                overlay.innerHTML = '<img alt="Imagem em tela cheia"><button type="button" class="media-fullscreen-close" aria-label="Fechar"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>';
                overlay.querySelector('.media-fullscreen-close').addEventListener('click', function() {
                    overlay.style.display = 'none';
                });
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) overlay.style.display = 'none';
                });
                document.body.appendChild(overlay);
            }
            overlay.querySelector('img').src = img.src;
            overlay.style.display = 'flex';
        }

        /**
         * Abre vídeo em tela cheia (Fullscreen API; Safari usa webkitEnterFullscreen no video).
         * @param {HTMLElement} btn - Botão que disparou (dentro de .video-player-widget ou de .message-media-wrapper)
         */
        function openVideoFullscreen(btn) {
            if (!btn || !btn.closest) return;
            const widget = btn.closest('.message-media-video') || btn.closest('.video-player-widget') || btn.closest('.message-media-wrapper');
            if (!widget) return;
            const video = widget.querySelector('video');
            // Safari/iOS: fullscreen no elemento <video>
            if (video && typeof video.webkitEnterFullscreen === 'function') {
                video.webkitEnterFullscreen();
                return;
            }
            if (video && typeof video.requestFullscreen === 'function') {
                video.requestFullscreen();
                return;
            }
            // Fallback: fullscreen no container
            const fn = widget.requestFullscreen || widget.webkitRequestFullscreen || widget.mozRequestFullScreen || widget.msRequestFullscreen;
            if (fn) fn.call(widget);
        }

        // Expor no window para onclick no HTML (script é type="module")
        window.openImageFullscreen = openImageFullscreen;
        window.openVideoFullscreen = openVideoFullscreen;

        /** Formata segundos no estilo m:ss para o player de áudio */
        function formatAudioTime(seconds) {
            if (!Number.isFinite(seconds) || seconds < 0) return '0:00';
            const m = Math.floor(seconds / 60);
            const s = Math.floor(seconds % 60);
            return m + ':' + (s < 10 ? '0' : '') + s;
        }

        /**
         * Inicializa a exibição da duração do áudio (0:00 / X:XX) assim que o metadata carregar, antes de clicar em play.
         * @param {Element} [container] - Container onde buscar os widgets (ex.: messagesEl). Se omitido, usa document.
         */
        function initAudioWidgetDurations(container) {
            const root = container || document;
            root.querySelectorAll('.audio-player-widget audio').forEach(function(audio) {
                if (audio.dataset.durationInit) return;
                audio.dataset.durationInit = '1';
                function updateDurationDisplay() {
                    const w = audio.closest('.audio-player-widget');
                    const te = w && w.querySelector('.audio-player-time');
                    if (te && Number.isFinite(audio.duration)) te.textContent = '0:00 / ' + formatAudioTime(audio.duration);
                }
                audio.addEventListener('loadedmetadata', updateDurationDisplay);
                audio.addEventListener('loadeddata', updateDurationDisplay);
                if (audio.readyState >= 1 && Number.isFinite(audio.duration)) {
                    updateDurationDisplay();
                } else if (audio.src) {
                    audio.load();
                }
            });
        }

        /**
         * Configura event delegation para os players de áudio customizados (play/pause, progresso, tempo).
         */
        function setupAudioPlayers() {
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.audio-player-btn');
                if (!btn) return;
                const widget = btn.closest('.audio-player-widget');
                if (!widget) return;
                const audio = widget.querySelector('audio');
                if (!audio) return;
                e.preventDefault();
                e.stopPropagation();
                if (audio.paused) {
                    document.querySelectorAll('.audio-player-widget').forEach(function(w) {
                        if (w !== widget) {
                            const a = w.querySelector('audio');
                            if (a) { a.pause(); a.currentTime = 0; }
                            w.classList.remove('is-playing');
                        }
                    });
                    audio.play();
                    widget.classList.add('is-playing');
                    if (!widget._audioUiBound) {
                        widget._audioUiBound = true;
                        var updateUi = function() {
                            const fill = widget.querySelector('.audio-player-progress-fill');
                            const range = widget.querySelector('.audio-player-progress');
                            const timeEl = widget.querySelector('.audio-player-time');
                            const d = audio.duration;
                            const t = audio.currentTime;
                            const pct = (d > 0 && Number.isFinite(d)) ? (t / d) * 100 : 0;
                            if (fill) fill.style.width = pct + '%';
                            if (range) range.value = pct;
                            if (timeEl) timeEl.textContent = formatAudioTime(t) + ' / ' + (Number.isFinite(d) ? formatAudioTime(d) : '0:00');
                        };
                        audio.addEventListener('timeupdate', updateUi);
                        audio.addEventListener('loadedmetadata', updateUi);
                        audio.addEventListener('ended', function() {
                            widget.classList.remove('is-playing');
                            var f = widget.querySelector('.audio-player-progress-fill');
                            var r = widget.querySelector('.audio-player-progress');
                            var te = widget.querySelector('.audio-player-time');
                            if (f) f.style.width = '0%';
                            if (r) r.value = 0;
                            if (te) te.textContent = '0:00 / ' + (Number.isFinite(audio.duration) ? formatAudioTime(audio.duration) : '0:00');
                        });
                    }
                } else {
                    audio.pause();
                    widget.classList.remove('is-playing');
                }
            });
            document.addEventListener('input', function(e) {
                const range = e.target.closest('.audio-player-progress');
                if (!range) return;
                const widget = range.closest('.audio-player-widget');
                if (!widget) return;
                const audio = widget.querySelector('audio');
                if (!audio || !Number.isFinite(audio.duration)) return;
                const pct = parseFloat(range.value) || 0;
                audio.currentTime = (pct / 100) * audio.duration;
                const fill = widget.querySelector('.audio-player-progress-fill');
                if (fill) fill.style.width = pct + '%';
            });
        }

        /**
         * Configura event delegation para os players de vídeo customizados (play/pause, progresso).
         */
        function setupVideoPlayers() {
            document.addEventListener('click', function(e) {
                if (e.target.closest('.video-player-progress')) return;
                const widget = e.target.closest('.video-player-widget');
                if (!widget) return;
                const video = widget.querySelector('video');
                if (!video) return;
                e.preventDefault();
                e.stopPropagation();
                if (video.paused) {
                    document.querySelectorAll('.video-player-widget').forEach(function(w) {
                        if (w !== widget) {
                            const v = w.querySelector('video');
                            if (v) v.pause();
                            w.classList.remove('is-playing');
                        }
                    });
                    video.play();
                    widget.classList.add('is-playing');
                    if (!widget._videoUiBound) {
                        widget._videoUiBound = true;
                        var updateUi = function() {
                            const fill = widget.querySelector('.video-player-progress-fill');
                            const range = widget.querySelector('.video-player-progress');
                            const d = video.duration;
                            const t = video.currentTime;
                            const pct = (d > 0 && Number.isFinite(d)) ? (t / d) * 100 : 0;
                            if (fill) fill.style.width = pct + '%';
                            if (range) range.value = pct;
                        };
                        video.addEventListener('timeupdate', updateUi);
                        video.addEventListener('loadedmetadata', updateUi);
                        video.addEventListener('ended', function() {
                            widget.classList.remove('is-playing');
                            var f = widget.querySelector('.video-player-progress-fill');
                            var r = widget.querySelector('.video-player-progress');
                            if (f) f.style.width = '0%';
                            if (r) r.value = 0;
                        });
                    }
                } else {
                    video.pause();
                    widget.classList.remove('is-playing');
                }
            });
            document.addEventListener('input', function(e) {
                const range = e.target.closest('.video-player-progress');
                if (!range) return;
                const widget = range.closest('.video-player-widget');
                if (!widget) return;
                const video = widget.querySelector('video');
                if (!video || !Number.isFinite(video.duration)) return;
                const pct = parseFloat(range.value) || 0;
                video.currentTime = (pct / 100) * video.duration;
                const fill = widget.querySelector('.video-player-progress-fill');
                if (fill) fill.style.width = pct + '%';
            });
        }

        /**
         * Gera o HTML do preview da mensagem respondida
         * @param {Object} repliedMessage - Dados da mensagem respondida
         * @returns {string} HTML do preview
         */
        function generateReplyPreview(repliedMessage) {
            if (!repliedMessage) return '';
            
            // Se for mensagem enviada por mim, mostrar "Você", senão mostrar nome ou telefone do contato
            let authorName = 'Você';
            if (!repliedMessage.fromMe) {
                // Tentar obter do header do chat ou usar variável global
                const chatHeaderName = document.querySelector('.chat-header-name');
                if (chatHeaderName) {
                    authorName = chatHeaderName.textContent.trim();
                } else if (currentContactName) {
                    authorName = currentContactName;
                } else {
                    authorName = 'Contato';
                }
            }
            
            const messageText = repliedMessage.mensagem || '';
            const tipoMensagem = (repliedMessage.tipoMensagem || '').toLowerCase();
            
            // Mapa do tipo da mensagem para o texto do preview (audiomessage → Áudio, etc.)
            const tipoMap = {
                'audiomessage': '🎵 Áudio',
                'imagemessage': '📷 Imagem',
                'videomessage': '🎥 Vídeo',
                'documentmessage': messageText.trim() || '📄 Documento',
                'stickermessage': '🎭 Sticker',
                'image': '📷 Imagem',
                'video': '🎥 Vídeo',
                'audio': '🎵 Áudio',
                'document': '📄 Documento',
                'sticker': '🎭 Sticker'
            };
            
            let displayText = messageText;
            // Se for mídia, mostrar tipo (Áudio, Imagem, etc.); documento usa nome se tiver
            if (tipoMensagem && tipoMensagem !== 'conversation') {
                const label = tipoMap[tipoMensagem];
                if (label !== undefined) {
                    displayText = typeof label === 'string' ? label : (messageText.trim() || '📄 Documento');
                }
            }
            if (!displayText) displayText = 'Mensagem';
            
            // Limitar tamanho do texto
            const previewText = displayText.length > 50 ? displayText.substring(0, 50) + '...' : displayText;
            
            // data-reply-to-message-id permite ao clicar rolar até a mensagem e dar glow
            const targetId = (repliedMessage.id != null && repliedMessage.id !== '') ? String(repliedMessage.id) : '';
                    return `
                <div class="message-reply-preview" ${targetId ? `data-reply-to-message-id="${escapeHtml(targetId)}"` : ''} role="button" tabindex="0" title="Ir para a mensagem">
                    <div class="message-reply-preview-author">${escapeHtml(authorName)}</div>
                    <div class="message-reply-preview-text">${escapeHtml(previewText)}</div>
                        </div>
                    `;
        }

        /**
         * Gera o HTML do conteúdo da mensagem (texto ou mídia conforme tipoMensagem e arquivoUrl)
         * @param {Object} msg - Dados da mensagem (mensagem, tipoMensagem, arquivoUrl)
         * @param {Object} [opts] - Opções: { messageId, isSent } para incluir botões dentro da mídia (imagem/vídeo)
         * @returns {string|{html: string, hasMediaActions: boolean}} HTML do conteúdo ou objeto com html e hasMediaActions
         */
        function generateMessageContent(msg, opts) {
            const messageText = msg.mensagem || '';
            const tipoMensagem = (msg.tipoMensagem || '').toLowerCase();
            const arquivoUrl = (msg.arquivoUrl || '').trim();
            const messageId = opts && (opts.messageId !== undefined && opts.messageId !== null) ? opts.messageId : null;
            const isSent = opts && opts.isSent === true;
            const optsText = (messageText || '').substring(0, 50);

            const mediaTypes = ['audiomessage', 'imagemessage', 'videomessage', 'documentmessage', 'stickermessage'];
            const hasMedia = arquivoUrl && mediaTypes.includes(tipoMensagem);

            if (hasMedia) {
                let mediaHtml = '';
                const safeUrl = escapeHtml(arquivoUrl);
                const optionsBtnHtml = (messageId !== null) ? `<button class="message-options-btn" onclick="showMessageOptions(event, ${typeof messageId === 'string' ? "'" + escapeForInlineJsSingleQuoted(messageId) + "'" : messageId}, '${escapeForInlineJsSingleQuoted(optsText)}')" title="Opções"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></button>` : '';
                const fullscreenImgBtn = '<button type="button" class="media-fullscreen-btn" aria-label="Abrir em tela cheia" onclick="event.stopPropagation(); openImageFullscreen(this)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg></button>';
                const fullscreenVideoBtn = '<button type="button" class="media-fullscreen-btn" aria-label="Abrir em tela cheia" onclick="event.stopPropagation(); openVideoFullscreen(this)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg></button>';
                switch (tipoMensagem) {
                    case 'imagemessage': {
                        const innerMedia = `<div class="message-media message-media-image"><img src="${safeUrl}" alt="Imagem" loading="lazy" onerror="this.style.display='none'"></div>`;
                        if (messageId !== null) {
                            mediaHtml = `<div class="message-media-wrapper">${innerMedia}<div class="message-media-actions">${optionsBtnHtml}${fullscreenImgBtn}</div></div>`;
                            return { html: mediaHtml, hasMediaActions: true, caption: messageText || undefined };
                        }
                        mediaHtml = `<div class="message-media message-media-image"><img src="${safeUrl}" alt="Imagem" loading="lazy" onerror="this.style.display='none'">${fullscreenImgBtn}</div>`;
                        break;
                    }
                    case 'stickermessage':
                        mediaHtml = `<div class="message-media message-media-sticker"><img src="${safeUrl}" alt="Sticker" loading="lazy" onerror="this.style.display='none'"></div>`;
                        break;
                    case 'videomessage': {
                        const videoInner = `
<div class="message-media message-media-video video-player-widget">
  <video preload="metadata" src="${safeUrl}"></video>
  <div class="video-player-overlay">
    <button type="button" class="video-player-btn" aria-label="Reproduzir">
      <span class="icon-play"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
      <span class="icon-pause"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></span>
    </button>
  </div>
  <div class="video-player-progress-wrap">
    <div class="video-player-progress-fill"></div>
    <input type="range" class="video-player-progress" min="0" max="100" value="0" aria-label="Posição do vídeo"/>
  </div>
</div>`;
                        if (messageId !== null) {
                            mediaHtml = `<div class="message-media-wrapper">${videoInner}<div class="message-media-actions">${optionsBtnHtml}${fullscreenVideoBtn}</div></div>`;
                            return { html: mediaHtml, hasMediaActions: true, caption: messageText || undefined };
                        }
                        mediaHtml = `
<div class="message-media message-media-video video-player-widget">
  <video preload="metadata" src="${safeUrl}"></video>
  <div class="video-player-overlay">
    <button type="button" class="video-player-btn" aria-label="Reproduzir">
      <span class="icon-play"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
      <span class="icon-pause"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></span>
    </button>
  </div>
  <div class="video-player-progress-wrap">
    <div class="video-player-progress-fill"></div>
    <input type="range" class="video-player-progress" min="0" max="100" value="0" aria-label="Posição do vídeo"/>
  </div>
  ${fullscreenVideoBtn}
</div>`;
                        break;
                    }
                    case 'audiomessage': {
                        const audioId = 'audio-' + Date.now() + '-' + Math.random().toString(36).slice(2, 8);
                        mediaHtml = `
<div class="message-media message-media-audio audio-player-widget" data-audio-id="${audioId}">
  <audio preload="metadata" src="${safeUrl}"></audio>
  <button type="button" class="audio-player-btn" aria-label="Reproduzir">
    <span class="icon-play"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
    <span class="icon-pause"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></span>
  </button>
  <div class="audio-player-waveform">
    <span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span><span class="bar" style="height:8px"></span><span class="bar" style="height:20px"></span><span class="bar" style="height:12px"></span><span class="bar" style="height:18px"></span><span class="bar" style="height:6px"></span><span class="bar" style="height:14px"></span><span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span>
  </div>
  <div class="audio-player-main">
    <div class="audio-player-progress-wrap">
      <div class="audio-player-progress-fill"></div>
      <input type="range" class="audio-player-progress" min="0" max="100" value="0" aria-label="Posição do áudio"/>
    </div>
    <span class="audio-player-time">0:00 / 0:00</span>
  </div>
</div>`;
                        break;
                    }
                    case 'documentmessage': {
                        // Nome do documento: extraído da URL (mensagem = legenda, não nome do arquivo)
                        let docName = '';
                        if (arquivoUrl) {
                            try {
                                const pathPart = arquivoUrl.split('?')[0];
                                const segments = pathPart.split('/').filter(Boolean);
                                docName = segments.length ? decodeURIComponent(segments[segments.length - 1]) : '';
                            } catch (e) { /* ignora */ }
                        }
                        const caption = docName || 'Documento';
                        const ext = (arquivoUrl.split('?')[0].split('.').pop() || '').toLowerCase();
                        const typeMap = {
                            pdf: { label: 'PDF', iconClass: 'pdf' },
                            doc: { label: 'Word', iconClass: 'word' },
                            docx: { label: 'Word', iconClass: 'word' },
                            xls: { label: 'Excel', iconClass: 'excel' },
                            xlsx: { label: 'Excel', iconClass: 'excel' },
                            ppt: { label: 'PowerPoint', iconClass: 'ppt' },
                            pptx: { label: 'PowerPoint', iconClass: 'ppt' },
                            jpg: { label: 'Imagem', iconClass: 'image' },
                            jpeg: { label: 'Imagem', iconClass: 'image' },
                            png: { label: 'Imagem', iconClass: 'image' },
                            gif: { label: 'Imagem', iconClass: 'image' },
                            txt: { label: 'Texto', iconClass: 'generic' }
                        };
                        const docType = typeMap[ext] || { label: ext ? ext.toUpperCase() : 'Arquivo', iconClass: 'generic' };
                        const nameSafe = escapeHtml(caption.length > 35 ? caption.substring(0, 35) + '…' : caption);
                        mediaHtml = `
<div class="message-media message-media-document">
  <div class="document-icon-wrap ${docType.iconClass}" title="${escapeHtml(docType.label)}">${docType.iconClass === 'pdf' ? 'PDF' : docType.iconClass === 'word' ? 'W' : docType.iconClass === 'excel' ? 'X' : docType.iconClass === 'ppt' ? 'P' : docType.iconClass === 'image' ? '🖼' : '📄'}</div>
  <div class="document-info">
    <div class="document-type">${escapeHtml(docType.label)}</div>
    <div class="document-name" title="${escapeHtml(caption)}">${nameSafe}</div>
  </div>
  <a href="${safeUrl}" download class="document-download" aria-label="Baixar" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></a>
</div>`;
                        break;
                    }
                    default:
                        mediaHtml = '';
                }
                // Imagem/vídeo/documento + texto: legenda vai em bloco separado (retornamos caption para renderMessageHtml criar dois blocos)
                if (messageText && ['imagemessage', 'videomessage', 'documentmessage'].includes(tipoMensagem)) {
                    return { html: mediaHtml, hasMediaActions: false, caption: messageText };
                }
                if (messageText) {
                    mediaHtml += `<span class="message-text">${escapeHtml(messageText)}</span>`;
                }
                return mediaHtml;
            }
            return messageText ? `<span class="message-text">${escapeHtml(messageText)}</span>` : '';
        }

        /**
         * Responde a uma mensagem
         * @param {string|number} messageId - ID da mensagem sendo respondida
         * @param {string} messageText - Texto da mensagem sendo respondida
         */
        function replyToMessage(messageId, messageText) {
            // Buscar o messageEvolutionId do elemento da mensagem
            let messageEvolutionId = null;
            let displayText = (messageText || '').trim();
            if (messageId) {
                const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
                if (messageElement) {
                    messageEvolutionId = messageElement.getAttribute('data-message-evolution-id');
                    // Se for mídia e não tiver texto, mostrar tipo no "Respondendo"
                    if (!displayText) {
                        if (messageElement.querySelector('.message-media-image')) {
                            displayText = '📷 Imagem';
                        } else if (messageElement.querySelector('.message-media-video')) {
                            displayText = '🎥 Vídeo';
                        } else if (messageElement.querySelector('.message-media-document')) {
                            const docNameEl = messageElement.querySelector('.document-name');
                            displayText = docNameEl ? docNameEl.textContent.trim() : '📄 Documento';
                        } else if (messageElement.querySelector('.message-media-audio')) {
                            displayText = '🎵 Áudio';
                        } else if (messageElement.querySelector('.message-media-sticker')) {
                            displayText = '🎭 Sticker';
                        }
                    }
                }
            }
            if (!displayText) displayText = 'Mensagem';
            // Autor do preview: "Você" se a mensagem respondida é enviada por mim, senão nome do contato
            let authorName = 'Contato';
            const messageElement = messageId ? document.querySelector(`[data-message-id="${messageId}"]`) : null;
            if (messageElement) {
                if (messageElement.classList.contains('sent')) {
                    authorName = 'Você';
                } else {
                    const chatHeaderName = document.querySelector('.chat-header-name');
                    if (chatHeaderName) authorName = chatHeaderName.textContent.trim();
                    else if (currentContactName) authorName = currentContactName;
                }
            }
            const previewText = displayText.length > 50 ? displayText.substring(0, 50) + '...' : displayText;
            // Armazenar para mostrar na mensagem otimista ao enviar
            replyingToMessageId = messageEvolutionId;
            replyingToPreviewAuthor = authorName;
            replyingToPreviewText = previewText;
            
            // Mostrar preview de resposta
            const replyPreview = document.getElementById('replyPreview');
            const replyPreviewText = document.getElementById('replyPreviewText');
            
            if (replyPreview && replyPreviewText) {
                replyPreviewText.textContent = previewText;
                replyPreview.classList.add('show');
            }
            
            // Focar no input
            const input = document.getElementById('messageInput');
            if (input) {
                input.focus();
            }
            
            // Fechar menu
            document.querySelectorAll('.message-options-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
        }

        /**
         * Cancela a resposta a uma mensagem
         */
        function cancelReply() {
            replyingToMessageId = null;
            replyingToPreviewAuthor = null;
            replyingToPreviewText = null;
            
            // Ocultar preview de resposta
            const replyPreview = document.getElementById('replyPreview');
            if (replyPreview) {
                replyPreview.classList.remove('show');
            }
        }

        /** Retorna o nome do usuário logado (SAAS_Usuarios.nome ou fallback para user_metadata/email) */
        async function getCurrentUserName() {
            try {
                const { data: { user } } = await supabase.auth.getUser();
                if (!user) return 'Usuário';
                const { data: u } = await supabase
                    .from('SAAS_Usuarios')
                    .select('nome')
                    .eq('auth_user_id', user.id)
                    .single();
                const n = (u?.nome || user.user_metadata?.full_name || user.user_metadata?.name || user.email || 'Usuário').trim();
                return n || 'Usuário';
            } catch (e) {
                return 'Usuário';
            }
        }

        /** Alterna a assinatura (incluir nome nas mensagens de texto) e salva no cookie */
        function toggleSignature() {
            signatureActive = !signatureActive;
            const btn = document.getElementById('signatureButton');
            if (btn) btn.classList.toggle('active', signatureActive);
            if (typeof setCookie === 'function') setCookie('chat_signature_active', signatureActive ? '1' : '0', 365);
        }

        /** Inicializa o botão de assinatura: restaura estado do cookie e anexa o listener */
        function setupSignatureButton() {
            const saved = typeof getCookie === 'function' ? getCookie('chat_signature_active') : null;
            signatureActive = saved === '1';
            const btn = document.getElementById('signatureButton');
            if (!btn) return;
            btn.classList.toggle('active', signatureActive);
            btn.onclick = toggleSignature;
        }

        /**
         * Envia uma mensagem na conversa atual
         * Integração com Supabase - Tabela SAAS_Mensagens
         */
        async function sendMessage() {
            const input = document.getElementById('messageInput');
            let messageText = input?.value.trim();

            if (!messageText) {
                console.warn('⚠️ Mensagem vazia');
                return;
            }

            if (!currentConversationId) {
                console.warn('⚠️ Nenhuma conversa selecionada');
                return;
            }

            // Assinatura: incluir nome do usuário no formato *Nome* + enter + mensagem
            if (signatureActive) {
                const userName = await getCurrentUserName();
                messageText = `*${userName}*\n\n${messageText}`;
            }

            // Obter contaId da tabela SAAS_Usuarios (não o auth_user_id)
            let userIdFromTable;
            try {
                userIdFromTable = await getUserIdFromAuth();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return; // Já foi redirecionado
                }
                throw error;
            }
            if (!userIdFromTable) {
                console.warn('⚠️ UserId não encontrado na tabela SAAS_Usuarios');
                showToast('Erro: usuário não identificado. Faça login novamente.', 'error');
                return;
            }
            
            currentUserId = userIdFromTable;

            console.log(`📤 Enviando mensagem: "${messageText}" para conversa ${currentConversationId}`);

            const messagesEl = document.getElementById('chatMessages');
            if (!messagesEl) {
                console.error('❌ Elemento chatMessages não encontrado');
                return;
            }

            // Buscar informações da conversa para obter conexaoId
            try {
                const conversaIdNum = parseInt(currentConversationId);
                if (isNaN(conversaIdNum)) {
                    console.error('❌ ID de conversa inválido:', currentConversationId);
                    showToast('Erro: ID de conversa inválido.', 'error');
                    return;
                }

                // Guard: Verificar sessão antes de SELECT
                const { data: { session } } = await supabase.auth.getSession();
                if (!session || !session.access_token) {
                    console.error('❌ Sem sessão/JWT - faça login novamente');
                    showToast('Sem sessão/JWT - faça login novamente', 'error');
                    return;
                }
                
                // RLS deve filtrar automaticamente por auth.uid()
                const { data: conversaData, error: conversaError } = await supabase
                    .from('SAAS_Conversas_Agentes')
                    .select('idConexao, telefone')
                    .eq('id', conversaIdNum)
                    .single();

                if (conversaError || !conversaData) {
                    console.error('❌ Erro ao buscar conversa:', conversaError);
                    showToast('Erro ao enviar mensagem. Conversa não encontrada.', 'error');
                    return;
                }

                const conexaoId = conversaData.idConexao;
                const telefone = conversaData.telefone;
                if (!conexaoId) {
                    console.error('❌ Conexão não encontrada na conversa');
                    showToast('Erro: conversa sem conexão associada.', 'error');
                    return;
                }

                // Buscar dados da conexão (instanceName e Apikey)
                const { data: conexaoData, error: conexaoDataError } = await supabase
                    .from('SAAS_Conexões')
                    .select('instanceName, Apikey')
                    .eq('id', conexaoId)
                    .single();

                if (conexaoDataError || !conexaoData) {
                    console.error('❌ Erro ao buscar dados da conexão:', conexaoDataError);
                    showToast('Erro: não foi possível obter dados da conexão.', 'error');
                    return;
                }

                const instanceName = conexaoData.instanceName;
                const apikey = conexaoData.Apikey;

                // Adicionar mensagem à UI imediatamente (otimista)
                // Usaremos um ID temporário que será substituído pelo ID real do banco
                const now = new Date().toISOString();
                const tempMessageId = `temp-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message sent';
                messageDiv.setAttribute('data-message-id', tempMessageId);  // ID temporário
                messageDiv.style.position = 'relative';
                messageDiv.setAttribute('data-message-created-at', now);
                messageDiv.setAttribute('data-message-tipo', 'conversation');
                messageDiv.setAttribute('data-message-enviada', '0');
                messageDiv.setAttribute('data-message-apagada', '0');
                // Ícone de relógio (enviada: false inicialmente) – estrutura igual à das mensagens carregadas
                const clockIcon = '<svg viewBox="0 0 16 16" fill="currentColor" style="width: 16px; height: 16px;"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm.5 4.5a.5.5 0 0 0-1 0v3.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1H8.5V4.5z"/></svg>';
                const optimisticReplyPreview = (replyingToMessageId && replyingToPreviewAuthor != null && replyingToPreviewText != null)
                    ? `<div class="message-reply-preview" data-reply-to-evolution-id="${escapeHtml(String(replyingToMessageId))}" role="button" tabindex="0" title="Ir para a mensagem"><div class="message-reply-preview-author">${escapeHtml(replyingToPreviewAuthor)}</div><div class="message-reply-preview-text">${escapeHtml(replyingToPreviewText)}</div></div>`
                    : '';
            messageDiv.innerHTML = `
                <div class="message-avatar">${getSentMessageAvatarHtml({})}</div>
                <div class="message-content">
                        ${optimisticReplyPreview}
                        <div class="message-content-inner">
                            <span class="message-leading-options">
                            <button class="message-options-btn" onclick="showMessageOptions(event, '${tempMessageId}', '${escapeForInlineJsSingleQuoted(messageText.substring(0, 50))}')" title="Opções">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
                                </svg>
                            </button>
                            </span>
                            <span class="message-body-block"><span class="message-text">${escapeHtml(messageText)}</span></span>
                            <span class="message-trailing-meta">
                            <span class="message-time">${formatMessageTime(now)}</span>
                            <span class="message-status-icon clock">${clockIcon}</span>
                            </span>
                </div>
                    </div>
                    <div class="message-options-menu" id="messageOptions-${tempMessageId}"></div>
            `;
            messagesEl.appendChild(messageDiv);

            // Limpar input
            if (input) {
                input.value = '';
            }

                messagesEl.scrollTop = messagesEl.scrollHeight;

                // Guard: Verificar sessão antes de INSERT
                // Reutilizar a sessão já verificada anteriormente (linha 1797)
                if (!session || !session.access_token) {
                    console.error('❌ Sem sessão/JWT - faça login novamente');
                    messageDiv.remove();
                    showToast('Sem sessão/JWT - faça login novamente', 'error');
                    return;
                }
                
                // 1. Primeiro: Criar mensagem na tabela SAAS_Mensagens
                const { data: newMessage, error: insertError } = await supabase
                    .from('SAAS_Mensagens')
                    .insert({
                        contaId: currentUserId,
                        conexaoId: conexaoId,
                        conversaId: conversaIdNum,
                        mensagem: messageText,
                        tipoMensagem: 'conversation',  // 'conversation' para texto
                        fromMe: true,
                        enviada: false,  // false conforme solicitado
                        apagada: false,
                        messageEvolutionId: null,  // null conforme solicitado
                        mensagemRespondida: replyingToMessageId || null,  // null normalmente, ou id da mensagem se estiver respondendo
                        arquivoUrl: null,  // null para mensagens de texto
                        created_at: now
                    })
                    .select()
                    .single();

                if (insertError) {
                    console.error('❌ Erro ao criar mensagem no banco:', insertError);
                    // Remover mensagem otimista da UI
                    messageDiv.remove();
                    showToast('Erro ao criar mensagem. Tente novamente.', 'error');
                    return;
                }

                console.log('✅ Mensagem criada no banco:', newMessage.id);

                // Atualizar a mensagem otimista com o ID real do banco
                // Isso evita que o Realtime adicione a mensagem novamente
                if (messageDiv) {
                    const realMessageId = newMessage.id.toString();
                    messageDiv.setAttribute('data-message-id', realMessageId);
                    const crAt = getMensagemCreatedAt(newMessage) || now;
                    messageDiv.setAttribute('data-message-created-at', crAt);
                    messageDiv.setAttribute('data-message-tipo', 'conversation');
                    const envReal = newMessage.enviada === true || newMessage.enviada === 'true' || newMessage.enviada === 1;
                    messageDiv.setAttribute('data-message-enviada', envReal ? '1' : '0');
                    if (newMessage.messageEvolutionId) {
                        messageDiv.setAttribute('data-message-evolution-id', String(newMessage.messageEvolutionId));
                    }
                    messageDiv.setAttribute('data-message-apagada', '0');
                    // Atualizar o ID do menu de opções também
                    const oldMenuId = messageDiv.querySelector('.message-options-menu');
                    if (oldMenuId) {
                        oldMenuId.id = `messageOptions-${realMessageId}`;
                    }
                    // Atualizar o onclick do botão de opções
                    const optionsBtn = messageDiv.querySelector('.message-options-btn');
                    if (optionsBtn) {
                        optionsBtn.setAttribute('onclick', `showMessageOptions(event, ${realMessageId}, '${escapeForInlineJsSingleQuoted(messageText.substring(0, 50))}')`);
                    }
                    console.log('✅ Mensagem otimista atualizada com ID real:', newMessage.id);
                }

                // 2. Depois: Fazer requisição POST para o webhook (sem aguardar resposta)
                // Salvar mensagemRespondida antes de limpar
                const mensagemRespondidaValue = replyingToMessageId;
                
                // Limpar resposta imediatamente após criar a mensagem no banco
                if (replyingToMessageId) {
                    replyingToMessageId = null;
                    replyingToPreviewAuthor = null;
                    replyingToPreviewText = null;
                    // Remover indicador visual de resposta na UI
                    const replyPreview = document.getElementById('replyPreview');
                    if (replyPreview) {
                        replyPreview.classList.remove('show');
                    }
                    console.log('✅ Preview de resposta removido imediatamente após envio');
                }
                
                const webhookBody = {
                    idConexao: conexaoId,
                    mensagem: messageText,
                    tipoMensagem: 'conversation',
                    instanceName: instanceName,
                    Apikey: apikey,
                    telefone: telefone,
                    idMensagem: newMessage.id  // ID da mensagem criada no banco
                };
                
                // Adicionar mensagemRespondida se estava respondendo uma mensagem
                if (mensagemRespondidaValue) {
                    webhookBody.mensagemRespondida = mensagemRespondidaValue;
                }
                
                // Enviar webhook de forma assíncrona (não aguardar resposta)
                fetch('/hublabel/public/enviar-mensagem', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(webhookBody)
                }).then(response => {
                    if (!response.ok) {
                        console.warn('⚠️ Webhook retornou erro:', response.status);
                    } else {
                        console.log('✅ Mensagem enviada via webhook (resposta recebida)');
                    }
                }).catch(webhookError => {
                    console.error('❌ Erro na requisição do webhook:', webhookError);
                    console.warn('⚠️ Mensagem criada no banco mas erro ao chamar webhook');
                });

                // Atualizar última mensagem e pausado/status conforme agente (pausarAtendimento)
                const updateConv = { ultimaMensagem: now };
                const { data: agenteData } = await supabase
                    .from('SAAS_AgentesIA')
                    .select('id, pausarAtendimento')
                    .eq('conexaoId', conexaoId)
                    .limit(1)
                    .maybeSingle();

                if (!agenteData) {
                    // Agente nulo: pausado = true, status = Aberto
                    updateConv.pausado = true;
                    updateConv.statusAtendimento = 'Aberto';
                } else if (agenteData.pausarAtendimento === true) {
                    // Agente existe e pausarAtendimento true: pausado = true, status = Aberto
                    updateConv.pausado = true;
                    updateConv.statusAtendimento = 'Aberto';
                } else {
                    // Agente existe e pausarAtendimento não é true: só pausado = false (mantém statusAtendimento)
                    updateConv.pausado = false;
                }

                if (!session || !session.access_token) {
                    console.error('❌ Sem sessão/JWT - faça login novamente');
                    showToast('Sem sessão/JWT - faça login novamente', 'error');
                    return;
                }

                await supabase
                    .from('SAAS_Conversas_Agentes')
                    .update(updateConv)
                    .eq('id', conversaIdNum);

                // Atualizar preview na lista de conversas
            const convItem = document.querySelector(`[data-conversation-id="${currentConversationId}"]`);
            if (convItem) {
                const preview = convItem.querySelector('.conversation-preview');
                const time = convItem.querySelector('.conversation-time');
                    if (preview) preview.textContent = getConversationPreviewText(messageText, 'conversation');
                if (time) time.textContent = 'Agora';
            }

                console.log('✅ Mensagem enviada com sucesso!');

            } catch (error) {
                console.error('❌ Erro ao enviar mensagem:', error);
                showToast('Erro ao enviar mensagem. Tente novamente.', 'error');
            }
        }

        /**
         * Manipula a tecla Enter para enviar mensagem
         * Shift+Enter permite quebrar linha
         * @param {KeyboardEvent} event - Evento do teclado
         */
        function handleKeyPress(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        }

        function autoResizeMessageInput() {
            const input = document.getElementById('messageInput');
            if (!input) return;
            const styles = window.getComputedStyle(input);
            const lineHeight = parseFloat(styles.lineHeight) || 20;
            const paddingTop = parseFloat(styles.paddingTop) || 0;
            const paddingBottom = parseFloat(styles.paddingBottom) || 0;
            const maxHeight = (lineHeight * 4) + paddingTop + paddingBottom;
            input.style.height = 'auto';
            const desired = input.scrollHeight;
            if (desired > maxHeight) {
                input.style.height = maxHeight + 'px';
                input.style.overflowY = 'auto';
            } else {
                input.style.height = desired + 'px';
                input.style.overflowY = 'hidden';
            }
        }
        window.autoResizeMessageInput = autoResizeMessageInput;

        /**
         * Insere texto na posição do cursor do textarea (emojis, atalhos, etc.).
         */
        function insertTextAtCursor(textarea, text) {
            if (!textarea || text == null || text === '') return;
            const start = textarea.selectionStart ?? textarea.value.length;
            const end = textarea.selectionEnd ?? textarea.value.length;
            const before = textarea.value.substring(0, start);
            const after = textarea.value.substring(end);
            textarea.value = before + text + after;
            const pos = start + text.length;
            textarea.selectionStart = textarea.selectionEnd = pos;
            textarea.focus();
            if (typeof autoResizeMessageInput === 'function') autoResizeMessageInput();
        }

        function closeEmojiPickerPanel() {
            const panel = document.getElementById('emojiPickerPanel');
            const btn = document.getElementById('emojiPickerButton');
            if (panel) panel.classList.remove('show');
            if (btn) {
                btn.classList.remove('active');
                btn.setAttribute('aria-expanded', 'false');
            }
        }

        /**
         * Anexa listeners aos botões do gravador de áudio (chamado após selectConversation)
         */
        function setupAudioRecorderListeners() {
            const micBtn = document.getElementById('micButton');
            const pauseBtn = document.getElementById('audioRecorderPause');
            const cancelBtn = document.getElementById('audioRecorderCancel');
            const sendBtn = document.getElementById('audioRecorderSend');
            if (micBtn) micBtn.addEventListener('click', startAudioRecording);
            if (pauseBtn) pauseBtn.addEventListener('click', toggleAudioRecorderPause);
            if (cancelBtn) cancelBtn.addEventListener('click', cancelAudioRecording);
            if (sendBtn) sendBtn.addEventListener('click', sendAudioRecording);
        }

        /**
         * Anexa listeners ao botão de adicionar mídia e opções
         */
        function setupMediaMenuListeners() {
            const addMediaBtn = document.getElementById('addMediaButton');
            const mediaMenu = document.getElementById('mediaOptionsMenu');
            const mediaOptions = document.querySelectorAll('.media-option-item');
            const fileInput = document.getElementById('mediaFileInput');

            if (!addMediaBtn || !mediaMenu || !fileInput) return;

            // Toggle menu ao clicar no botão +
            addMediaBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                closeEmojiPickerPanel();
                const quickRepliesMenu = document.getElementById('quickRepliesMenu');
                if (quickRepliesMenu) quickRepliesMenu.classList.remove('show');
                mediaMenu.classList.toggle('show');
            });

            // Fechar menu ao clicar fora
            document.addEventListener('click', (e) => {
                if (!mediaMenu.contains(e.target) && !addMediaBtn.contains(e.target)) {
                    mediaMenu.classList.remove('show');
                }
            });

            // Ao clicar em uma opção de mídia
            mediaOptions.forEach(option => {
                option.addEventListener('click', () => {
                    const mediaType = option.getAttribute('data-media-type');
                    fileInput.setAttribute('data-media-type', mediaType);
                    fileInput.multiple = mediaType === 'audio' ? false : true;
                    
                    // Definir accept baseado no tipo
                    if (mediaType === 'image') {
                        fileInput.accept = 'image/*';
                    } else if (mediaType === 'video') {
                        fileInput.accept = 'video/*';
                    } else if (mediaType === 'document') {
                        fileInput.accept = '*/*';
                    } else if (mediaType === 'audio') {
                        fileInput.accept = 'audio/*';
                    }
                    
                    fileInput.click();
                    mediaMenu.classList.remove('show');
                });
            });

            // Ao selecionar arquivo (se for áudio, usar preview de áudio mesmo que tenha escolhido documento)
            fileInput.addEventListener('change', async (e) => {
                const selectedFiles = Array.from(e.target.files || []);
                if (!selectedFiles.length) return;

                let mediaType = fileInput.getAttribute('data-media-type');
                if (selectedFiles[0].type && selectedFiles[0].type.startsWith('audio/')) mediaType = 'audio';

                // Para imagem/vídeo/documento: permite envio em lote (até 5), 1 requisição por arquivo.
                if (mediaType !== 'audio' && selectedFiles.length > 1) {
                    const limited = selectedFiles.slice(0, 5);
                    if (selectedFiles.length > 5) {
                        if (typeof showToast === 'function') showToast('Limite de 5 mídias por envio. Enviando as 5 primeiras.', 'info');
                        else showToast('Limite de 5 mídias por envio. Enviando as 5 primeiras.', 'info');
                    }
                    await sendMultipleMediaFiles(limited, mediaType);
                } else {
                    const file = selectedFiles[0];
                    showMediaPreview(file, mediaType);
                }
                
                // Limpar input
                fileInput.value = '';
            });
        }

        /** Cache das respostas rápidas (carregado só ao abrir o menu) */
        let respostasRapidasCache = null;

        /**
         * Carrega respostas rápidas do Supabase (SAAS_Resposta_Rapidas) para o usuário atual.
         * Só consulta quando chamado (ao abrir menu por botão / ou ao digitar /).
         */
        async function loadRespostasRapidasFromSupabase() {
            const contaId = await getUserIdFromAuth();
            if (!contaId) return [];
            const { data, error } = await supabase
                .from('SAAS_Resposta_Rapidas')
                .select('id, nome, atalho, texto, arquivo, tipoMedia')
                .eq('contaId', contaId);
            if (error) {
                console.warn('Erro ao carregar respostas rápidas:', error);
                return [];
            }
            return data || [];
        }

        /**
         * Abre o menu de respostas rápidas, carregando do Supabase na primeira vez.
         * @param {string} filter - Texto para filtrar (atalho/nome); vazio = mostrar todas.
         * @param {boolean} fromInput - Se abriu digitando "/" no input (para ao selecionar substituir "/" + filter).
         */
        async function openQuickRepliesMenu(filter, fromInput) {
            const menu = document.getElementById('quickRepliesMenu');
            const listEl = document.getElementById('quickRepliesList');
            const mediaMenu = document.getElementById('mediaOptionsMenu');
            if (!menu || !listEl) return;
            if (mediaMenu) mediaMenu.classList.remove('show');

            if (respostasRapidasCache === null) {
                respostasRapidasCache = await loadRespostasRapidasFromSupabase();
            }

            const f = (typeof filter === 'string' ? filter : '').trim().toLowerCase();
            const filtered = f
                ? respostasRapidasCache.filter(r => {
                    const at = (r.atalho || '').toLowerCase();
                    const no = (r.nome || '').toLowerCase();
                    return at.includes(f) || no.includes(f);
                })
                : respostasRapidasCache;

            listEl.innerHTML = '';
            if (filtered.length === 0) {
                listEl.innerHTML = '<div class="quick-replies-empty">Nenhuma resposta rápida encontrada.</div>';
            } else {
                filtered.forEach(r => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'quick-reply-item';
                    btn.textContent = (r.atalho || '') + ' - ' + (r.nome || 'Sem nome');
                    btn.dataset.texto = r.texto || '';
                    btn.dataset.fromInput = fromInput ? '1' : '0';
                    btn.dataset.arquivo = r.arquivo || '';
                    btn.dataset.tipoMedia = r.tipoMedia || '';
                    listEl.appendChild(btn);
                });
            }
            menu.classList.add('show');
        }

        /**
         * Coloca só o texto no input (usado quando não tem mídia ou quando o carregamento da mídia falha).
         */
        function setQuickReplyTextInInput(texto, fromInput) {
            const messageInput = document.getElementById('messageInput');
            if (!messageInput) return;
            const isFromInput = fromInput === true || fromInput === '1';
            if (isFromInput) {
                const val = messageInput.value;
                const slashIdx = val.indexOf('/');
                if (slashIdx !== -1) {
                    let endIdx = slashIdx + 1;
                    while (endIdx < val.length && val[endIdx] !== ' ') endIdx++;
                    messageInput.value = val.substring(0, slashIdx) + texto + val.substring(endIdx);
                } else {
                    messageInput.value = texto;
                }
            } else {
                messageInput.value = texto;
            }
            autoResizeMessageInput();
            messageInput.focus();
        }

        /**
         * Aplica a seleção de uma resposta rápida: se tiver mídia, abre o preview com legenda;
         * senão coloca só o texto no input.
         */
        async function applyQuickReplySelection(texto, fromInput, arquivo, tipoMedia) {
            closeQuickRepliesMenu();
            texto = (texto != null) ? String(texto) : '';
            arquivo = (arquivo != null) ? String(arquivo).trim() : '';
            tipoMedia = (tipoMedia != null) ? String(tipoMedia).trim().toLowerCase() : '';
            if (tipoMedia === 'imagem') tipoMedia = 'image';
            if (tipoMedia === 'documento') tipoMedia = 'document';
            if (!arquivo || !tipoMedia) {
                setQuickReplyTextInInput(texto, fromInput);
                return;
            }
            try {
                let file;
                if (arquivo.startsWith('data:')) {
                    const res = await fetch(arquivo);
                    const blob = await res.blob();
                    const ext = tipoMedia === 'image' ? 'jpg' : tipoMedia === 'video' ? 'mp4' : 'pdf';
                    file = new File([blob], 'resposta-rapida.' + ext, { type: blob.type || 'application/octet-stream' });
                } else {
                    const res = await fetch(arquivo);
                    if (!res.ok) throw new Error('Falha ao carregar mídia');
                    const blob = await res.blob();
                    const name = (arquivo.split('/').pop() || 'arquivo').split('?')[0] || 'resposta-rapida';
                    file = new File([blob], name, { type: blob.type || 'application/octet-stream' });
                }
                const overlay = document.getElementById('mediaPreviewOverlay');
                const captionEl = document.getElementById('mediaPreviewCaption');
                if (!overlay) {
                    setQuickReplyTextInInput(texto, fromInput);
                    return;
                }
                showMediaPreview(file, tipoMedia);
                if (captionEl) captionEl.value = texto;
            } catch (err) {
                console.warn('Erro ao carregar mídia da resposta rápida:', err);
                setQuickReplyTextInInput(texto, fromInput);
            }
        }

        /**
         * Fecha o menu de respostas rápidas.
         */
        function closeQuickRepliesMenu() {
            const menu = document.getElementById('quickRepliesMenu');
            if (menu) menu.classList.remove('show');
        }

        /**
         * Anexa listeners ao botão / e ao input para respostas rápidas.
         */
        function setupQuickRepliesListeners() {
            const quickRepliesBtn = document.getElementById('quickRepliesButton');
            const quickRepliesMenu = document.getElementById('quickRepliesMenu');
            const quickRepliesList = document.getElementById('quickRepliesList');
            const messageInput = document.getElementById('messageInput');

            if (!quickRepliesBtn || !quickRepliesMenu || !quickRepliesList) return;

            // Abrir ao clicar no botão /
            quickRepliesBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                closeEmojiPickerPanel();
                const mediaMenu = document.getElementById('mediaOptionsMenu');
                if (mediaMenu) mediaMenu.classList.remove('show');
                openQuickRepliesMenu('', false);
            });

            // Fechar ao clicar fora
            document.addEventListener('click', (e) => {
                if (!quickRepliesMenu.contains(e.target) && !quickRepliesBtn.contains(e.target)) {
                    closeQuickRepliesMenu();
                }
            });

            // Fechar com Escape; Tab coloca o texto do primeiro item no input (como se tivesse clicado)
            document.addEventListener('keydown', (e) => {
                if (!quickRepliesMenu.classList.contains('show')) return;
                if (e.key === 'Escape') {
                    closeQuickRepliesMenu();
                    return;
                }
                if (e.key === 'Tab') {
                    const first = quickRepliesList.querySelector('.quick-reply-item');
                    if (first) {
                        e.preventDefault();
                        applyQuickReplySelection(
                            first.dataset.texto || '',
                            first.dataset.fromInput === '1',
                            first.dataset.arquivo || '',
                            first.dataset.tipoMedia || ''
                        ).catch(function (err) { console.warn('Resposta rápida (Tab):', err); });
                    }
                }
            });

            // Input: ao digitar, se começar com / abrir e filtrar
            if (messageInput) {
                messageInput.addEventListener('input', () => {
                    const val = messageInput.value;
                    const slashIdx = val.indexOf('/');
                    if (slashIdx === -1) {
                        closeQuickRepliesMenu();
                        return;
                    }
                    const afterSlash = val.substring(slashIdx + 1);
                    const filter = afterSlash.includes(' ') ? afterSlash.substring(0, afterSlash.indexOf(' ')) : afterSlash;
                    openQuickRepliesMenu(filter, true);
                });
            }

            // Clique em um item: aplicar texto e, se tiver mídia, abrir preview com legenda
            quickRepliesList.addEventListener('click', (e) => {
                const btn = e.target.closest('.quick-reply-item');
                if (!btn) return;
                applyQuickReplySelection(
                    btn.dataset.texto || '',
                    btn.dataset.fromInput === '1',
                    btn.dataset.arquivo || '',
                    btn.dataset.tipoMedia || ''
                ).catch(function (err) { console.warn('Resposta rápida (clique):', err); });
            });
        }

        /** Categorias do seletor de emojis (rótulo = ícone da aba). */
        const CHAT_EMOJI_CATEGORIES = [
            {
                label: '😀',
                title: 'Rostos',
                emojis: ['😀', '😃', '😄', '😁', '😆', '😅', '🤣', '😂', '🙂', '🙃', '😉', '😊', '😇', '🥰', '😍', '🤩', '😘', '😗', '☺️', '😚', '😋', '😛', '😜', '🤪', '😝', '🤑', '🤗', '🤭', '🤫', '🤔', '🤐', '🤨', '😐', '😑', '😶', '😏', '😒', '🙄', '😬', '🤥', '😌', '😔', '😪', '🤤', '😴', '😷', '🤒', '🤕', '🤢', '🤮', '🤧', '🥵', '🥶', '🥴', '😵', '🤯', '🤠', '🥳', '😎', '🤓', '🧐', '😕', '☹️', '😮', '😯', '😲', '😳', '🥺', '😦', '😧', '😨', '😰', '😥', '😢', '😭', '😱', '😖', '😣', '😞', '😓', '😩', '😫', '🥱', '😤', '😡', '😠', '🤬']
            },
            {
                label: '❤️',
                title: 'Corações',
                emojis: ['❤️', '🧡', '💛', '💚', '💙', '💜', '🖤', '🤍', '🤎', '💔', '❣️', '💕', '💞', '💓', '💗', '💖', '💘', '💝', '💟', '♥️', '💋', '💌', '👄', '🫶', '💑', '💏']
            },
            {
                label: '👍',
                title: 'Gestos',
                emojis: ['👍', '👎', '👌', '✌️', '🤞', '🤟', '🤘', '🤙', '👈', '👉', '👆', '🖕', '👇', '☝️', '✋', '🤚', '🖐️', '🖖', '👋', '🤝', '🙏', '✍️', '💅', '👏', '🙌', '👐', '🤲', '💪', '🫰', '🤌', '🤏', '🫳', '🫴', '👂', '🦻', '👃', '👀', '👁️', '👅', '🦷', '🧠']
            },
            {
                label: '🐶',
                title: 'Animais e natureza',
                emojis: ['🐶', '🐱', '🐭', '🐹', '🐰', '🦊', '🐻', '🐼', '🐨', '🐯', '🦁', '🐮', '🐷', '🐸', '🐵', '🙈', '🙉', '🙊', '🐒', '🐔', '🐧', '🐦', '🐤', '🦆', '🦅', '🦉', '🐺', '🐗', '🐴', '🦄', '🐝', '🐛', '🦋', '🐌', '🐞', '🐜', '🦟', '🕷️', '🦂', '🐢', '🐍', '🦎', '🐙', '🦑', '🦐', '🦞', '🦀', '🐡', '🐠', '🐟', '🐬', '🐳', '🐋', '🦈', '🌲', '🌳', '🌴', '🌵', '🌷', '🌺', '🌸', '🌼', '🌻', '🌞', '🌝', '🌙', '⭐', '🌟', '✨', '💫', '☄️', '🌈', '☀️', '🌤️', '⛅', '🌧️', '⛈️', '🌩️', '❄️', '☃️', '⛄', '💧', '🔥']
            },
            {
                label: '🍕',
                title: 'Comida',
                emojis: ['🍏', '🍎', '🍐', '🍊', '🍋', '🍌', '🍉', '🍇', '🍓', '🫐', '🍈', '🍒', '🍑', '🥭', '🍍', '🥥', '🥝', '🍅', '🍆', '🥑', '🥦', '🥬', '🥒', '🌶️', '🫑', '🌽', '🥕', '🫒', '🧄', '🧅', '🥔', '🍠', '🥐', '🥯', '🍞', '🥖', '🥨', '🧀', '🥚', '🍳', '🧈', '🥞', '🧇', '🥓', '🥩', '🍗', '🍖', '🦴', '🌭', '🍔', '🍟', '🍕', '🫓', '🥪', '🥙', '🧆', '🌮', '🌯', '🫔', '🥗', '🥘', '🫕', '🥫', '🍝', '🍜', '🍲', '🍛', '🍣', '🍱', '🥟', '🦪', '🍤', '🍙', '🍚', '🍘', '🍥', '🥠', '🥮', '🍢', '🍡', '🍧', '🍨', '🍦', '🥧', '🧁', '🍰', '🎂', '🍮', '🍭', '🍬', '🍫', '🍿', '🍩', '🍪', '🌰', '🥜', '🫘', '🍯', '☕', '🫖', '🍵', '🧃', '🥤', '🧋', '🍶', '🍺', '🍻', '🥂', '🍷', '🥃', '🍸', '🍹', '🧉', '🍾']
            },
            {
                label: '⚽',
                title: 'Atividades e objetos',
                emojis: ['⚽', '🏀', '🏈', '⚾', '🥎', '🎾', '🏐', '🏉', '🥏', '🎱', '🪀', '🏓', '🏸', '🏒', '🏑', '🥍', '🏏', '🪃', '🥅', '⛳', '🪁', '🏹', '🎣', '🤿', '🥊', '🥋', '🎽', '🛹', '🛼', '🛷', '⛸️', '🥌', '🎿', '⛷️', '🏂', '🪂', '🏋️', '🤸', '⛹️', '🤺', '🤾', '🏌️', '🏇', '🧘', '🏄', '🏊', '🤽', '🚴', '🏆', '🥇', '🥈', '🥉', '🏅', '🎖️', '🏵️', '🎗️', '🎫', '🎟️', '🎪', '🤹', '🎭', '🩰', '🎨', '🎬', '🎤', '🎧', '🎼', '🎹', '🥁', '🪘', '🎷', '🎺', '🎸', '🪕', '🎻', '🎲', '♟️', '🎯', '🎳', '🎮', '🎰', '🧩', '📱', '📲', '💻', '⌨️', '🖥️', '🖨️', '🖱️', '💾', '💿', '📀', '📷', '📹', '🎥', '📞', '☎️', '📟', '📠', '📺', '📻', '🎙️', '⏰', '⌚', '🔋', '🔌', '💡', '🔦', '🕯️', '🧯', '🛢️', '💸', '💵', '💴', '💶', '💷', '💰', '💳', '🧾', '✉️', '📧', '📨', '📩', '📤', '📥', '📦', '📫', '📪', '📬', '📭', '📮', '📝', '📁', '📂', '🗂️', '📅', '📆', '🗓️', '📇', '📈', '📉', '📊']
            },
            {
                label: '✅',
                title: 'Símbolos',
                emojis: ['✅', '☑️', '✔️', '❌', '❎', '⭕', '✖️', '➕', '➖', '➗', '♾️', '‼️', '⁉️', '❓', '❔', '❕', '❗', '〰️', '💯', '🔴', '🟠', '🟡', '🟢', '🔵', '🟣', '⚫', '⚪', '🟤', '🔶', '🔷', '🔸', '🔹', '🔺', '🔻', '💠', '🔘', '🔳', '🔲', '▪️', '▫️', '◾', '◽', '◼️', '◻️', '🟥', '🟧', '🟨', '🟩', '🟦', '🟪', '⬛', '⬜', '🟫', '🔈', '🔇', '🔉', '🔊', '🔔', '🔕', '📣', '📢', '💬', '💭', '🗯️', '♻️', '✳️', '❇️', '🔱', '📛', '🔰', '⛔', '🚫', '🚷', '🚯', '🚳', '🚱', '📵', '🔞', '☢️', '☣️', '⚠️', '🚸', '⬆️', '⬇️', '➡️', '⬅️', '↗️', '↘️', '↙️', '↖️', '↕️', '↔️', '↩️', '↪️', '⤴️', '⤵️', '🔃', '🔄', '🔙', '🔚', '🔛', '🔜', '🔝', '🛐', '⚛️', '🕉️', '✡️', '☸️', '☯️', '✝️', '☦️', '☪️', '☮️', '🕎', '🔯', '♈', '♉', '♊', '♋', '♌', '♍', '♎', '♏', '♐', '♑', '♒', '♓', '🆔', '⚡', '〽️', '✴️', '©️', '®️', '™️']
            }
        ];

        /**
         * Painel de emojis no input do chat (abas + grade).
         */
        function setupEmojiPickerListeners() {
            const btn = document.getElementById('emojiPickerButton');
            const panel = document.getElementById('emojiPickerPanel');
            const tabsEl = document.getElementById('emojiPickerTabs');
            const gridEl = document.getElementById('emojiPickerGrid');
            const messageInput = document.getElementById('messageInput');
            if (!btn || !panel || !tabsEl || !gridEl) return;

            function renderEmojiCategory(index) {
                const cat = CHAT_EMOJI_CATEGORIES[index];
                if (!cat) return;
                gridEl.innerHTML = '';
                const frag = document.createDocumentFragment();
                cat.emojis.forEach(function (emo) {
                    const cell = document.createElement('button');
                    cell.type = 'button';
                    cell.className = 'emoji-picker-cell';
                    cell.setAttribute('aria-label', 'Inserir emoji');
                    cell.textContent = emo;
                    frag.appendChild(cell);
                });
                gridEl.appendChild(frag);
            }

            tabsEl.innerHTML = '';
            CHAT_EMOJI_CATEGORIES.forEach(function (cat, idx) {
                const tab = document.createElement('button');
                tab.type = 'button';
                tab.className = 'emoji-picker-tab' + (idx === 0 ? ' active' : '');
                tab.textContent = cat.label;
                tab.title = cat.title;
                tab.setAttribute('role', 'tab');
                tab.setAttribute('aria-selected', idx === 0 ? 'true' : 'false');
                tab.dataset.categoryIndex = String(idx);
                tabsEl.appendChild(tab);
            });
            renderEmojiCategory(0);

            tabsEl.addEventListener('click', function (e) {
                const t = e.target.closest('.emoji-picker-tab');
                if (!t || !tabsEl.contains(t)) return;
                const i = parseInt(t.dataset.categoryIndex, 10);
                if (Number.isNaN(i)) return;
                tabsEl.querySelectorAll('.emoji-picker-tab').forEach(function (x) {
                    x.classList.remove('active');
                    x.setAttribute('aria-selected', 'false');
                });
                t.classList.add('active');
                t.setAttribute('aria-selected', 'true');
                renderEmojiCategory(i);
            });

            gridEl.addEventListener('click', function (e) {
                const cell = e.target.closest('.emoji-picker-cell');
                if (!cell || !gridEl.contains(cell)) return;
                e.stopPropagation();
                const emo = cell.textContent;
                if (messageInput) insertTextAtCursor(messageInput, emo);
            });

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                const quickRepliesMenu = document.getElementById('quickRepliesMenu');
                if (quickRepliesMenu) quickRepliesMenu.classList.remove('show');
                const mediaMenu = document.getElementById('mediaOptionsMenu');
                if (mediaMenu) mediaMenu.classList.remove('show');
                const open = !panel.classList.contains('show');
                if (open) {
                    panel.classList.add('show');
                    btn.classList.add('active');
                    btn.setAttribute('aria-expanded', 'true');
                } else {
                    closeEmojiPickerPanel();
                }
            });

            if (!chatEmojiPickerGlobalListenersBound) {
                chatEmojiPickerGlobalListenersBound = true;
                document.addEventListener('click', function (e) {
                    const p = document.getElementById('emojiPickerPanel');
                    const wrap = document.querySelector('.chat-emoji-picker-wrap');
                    const b = document.getElementById('emojiPickerButton');
                    if (!p || !p.classList.contains('show')) return;
                    if (wrap && wrap.contains(e.target)) return;
                    p.classList.remove('show');
                    if (b) {
                        b.classList.remove('active');
                        b.setAttribute('aria-expanded', 'false');
                    }
                });
                document.addEventListener('keydown', function (e) {
                    if (e.key !== 'Escape') return;
                    const p = document.getElementById('emojiPickerPanel');
                    if (p && p.classList.contains('show')) closeEmojiPickerPanel();
                });
            }
        }

        /**
         * Mostra preview do arquivo antes de enviar
         */
        function showMediaPreview(file, mediaType) {
            mediaPreviewState.file = file;
            mediaPreviewState.mediaType = mediaType;

            const overlay = document.getElementById('mediaPreviewOverlay');
            const title = document.getElementById('mediaPreviewTitle');
            const content = document.getElementById('mediaPreviewContent');

            // Definir título
            const titles = {
                'image': 'Enviar Imagem',
                'video': 'Enviar Vídeo',
                'document': 'Enviar Documento',
                'audio': 'Enviar Áudio'
            };
            title.textContent = titles[mediaType] || 'Enviar Arquivo';

            // Criar preview baseado no tipo
            if (mediaType === 'image') {
                const url = URL.createObjectURL(file);
                content.innerHTML = `<img src="${url}" alt="Preview">`;
            } else if (mediaType === 'video') {
                const url = URL.createObjectURL(file);
                content.innerHTML = `<video src="${url}" controls></video>`;
            } else if (mediaType === 'audio') {
                const url = URL.createObjectURL(file);
                const audioId = 'preview-audio-' + Date.now();
                content.innerHTML = `
<div class="message-media message-media-audio audio-player-widget" data-audio-id="${audioId}">
  <audio preload="metadata" src="${url}"></audio>
  <button type="button" class="audio-player-btn" aria-label="Reproduzir">
    <span class="icon-play"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
    <span class="icon-pause"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></span>
  </button>
  <div class="audio-player-waveform">
    <span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span><span class="bar" style="height:8px"></span><span class="bar" style="height:20px"></span><span class="bar" style="height:12px"></span><span class="bar" style="height:18px"></span><span class="bar" style="height:6px"></span><span class="bar" style="height:14px"></span><span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span>
  </div>
  <div class="audio-player-main">
    <div class="audio-player-progress-wrap">
      <div class="audio-player-progress-fill"></div>
      <input type="range" class="audio-player-progress" min="0" max="100" value="0" aria-label="Posição do áudio"/>
    </div>
    <span class="audio-player-time">0:00 / 0:00</span>
  </div>
</div>`;
                initAudioWidgetDurations(content);
            } else if (mediaType === 'document') {
                const sizeKB = (file.size / 1024).toFixed(2);
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const sizeText = file.size > 1024 * 1024 ? `${sizeMB} MB` : `${sizeKB} KB`;
                content.innerHTML = `
                    <div class="media-preview-document">
                        <div class="media-preview-document-icon">📄</div>
                        <div class="media-preview-document-name">${file.name}</div>
                        <div class="media-preview-document-size">${sizeText}</div>
                    </div>
                `;
            }

            overlay.classList.add('show');
            
            // Limpar e focar legenda
            const captionEl = document.getElementById('mediaPreviewCaption');
            if (captionEl) {
                captionEl.value = '';
                captionEl.placeholder = 'Digite uma legenda para a mensagem...';
            }
        }

        /**
         * Fecha o preview de mídia
         */
        function closeMediaPreview() {
            const overlay = document.getElementById('mediaPreviewOverlay');
            const content = document.getElementById('mediaPreviewContent');
            const captionEl = document.getElementById('mediaPreviewCaption');
            
            // Revogar URLs de blob para liberar memória
            const img = content.querySelector('img');
            const video = content.querySelector('video');
            const audio = content.querySelector('audio');
            if (img && img.src.startsWith('blob:')) URL.revokeObjectURL(img.src);
            if (video && video.src.startsWith('blob:')) URL.revokeObjectURL(video.src);
            if (audio && audio.src.startsWith('blob:')) URL.revokeObjectURL(audio.src);
            
            overlay.classList.remove('show');
            content.innerHTML = '';
            if (captionEl) captionEl.value = '';
            mediaPreviewState.file = null;
            mediaPreviewState.mediaType = null;
        }

        /**
         * Confirma e envia o arquivo de mídia
         */
        async function confirmSendMedia() {
            if (!mediaPreviewState.file || !mediaPreviewState.mediaType) return;
            
            const file = mediaPreviewState.file;
            const mediaType = mediaPreviewState.mediaType;
            const captionEl = document.getElementById('mediaPreviewCaption');
            const caption = captionEl ? (captionEl.value || '').trim() : '';
            
            closeMediaPreview();
            await sendMediaFile(file, mediaType, caption);
            const messageInput = document.getElementById('messageInput');
            if (messageInput) {
                messageInput.value = '';
                autoResizeMessageInput();
            }
        }

        // Tornar funções globais para onclick
        window.closeMediaPreview = closeMediaPreview;
        window.confirmSendMedia = confirmSendMedia;

        async function sendMultipleMediaFiles(files, mediaType) {
            if (!Array.isArray(files) || files.length === 0) return;
            for (const file of files) {
                await sendMediaFile(file, mediaType, '');
            }
        }

        /**
         * Envia arquivo de mídia (imagem, vídeo, documento)
         * @param {File} file - Arquivo selecionado
         * @param {string} mediaType - 'image' | 'video' | 'document' | 'audio'
         * @param {string} caption - Legenda opcional (salva na coluna mensagem e enviada como caption)
         */
        async function sendMediaFile(file, mediaType, caption) {
            caption = (caption || '').trim();
            if (!currentConversationId) {
                showToast('Nenhuma conversa selecionada.', 'info');
                return;
            }

            if (!currentUserId) {
                try {
                    const userIdFromTable = await getUserIdFromAuth();
                    if (!userIdFromTable) {
                        showToast('Erro: usuário não identificado.', 'error');
                        return;
                    }
                    currentUserId = userIdFromTable;
                } catch (e) {
                    if (e.message === 'STATUS_BLOQUEADO') return;
                    showToast('Erro ao identificar usuário.', 'error');
                    return;
                }
            }

            const conversaIdNum = parseInt(currentConversationId);
            if (isNaN(conversaIdNum)) {
                showToast('ID de conversa inválido.', 'error');
                return;
            }

            try {
                // Verificar sessão antes de tudo
                const { data: { session } } = await supabase.auth.getSession();
                if (!session || !session.access_token) {
                    showToast('Sessão expirada. Faça login novamente.', 'error');
                    return;
                }

                // Buscar dados da conversa
                const { data: conversaData, error: conversaError } = await supabase
                    .from('SAAS_Conversas_Agentes')
                    .select('idConexao, telefone')
                    .eq('id', conversaIdNum)
                    .single();

                if (conversaError || !conversaData) {
                    console.error('Erro ao buscar conversa:', conversaError);
                    showToast('Erro ao buscar dados da conversa.', 'error');
                    return;
                }

                const idConexao = conversaData.idConexao;
                const telefone = conversaData.telefone || '';

                // Buscar instanceName e Apikey
                const { data: conexaoData, error: conexaoError } = await supabase
                    .from('SAAS_Conexões')
                    .select('instanceName, Apikey')
                    .eq('id', idConexao)
                    .single();

                if (conexaoError || !conexaoData) {
                    console.error('Erro ao buscar conexão:', conexaoError);
                    showToast('Erro ao buscar dados da conexão.', 'error');
                    return;
                }

                const instanceName = conexaoData.instanceName || '';
                const apikey = conexaoData.Apikey || '';

                // Áudio com texto: criar duas mensagens (primeiro texto, depois áudio)
                if (mediaType === 'audio' && caption) {
                    const now = new Date().toISOString();
                    const messagesEl = document.getElementById('chatMessages');
                    const clockIcon = '<svg viewBox="0 0 16 16" fill="currentColor" style="width: 16px; height: 16px;"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm.5 4.5a.5.5 0 0 0-1 0v3.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1H8.5V4.5z"/></svg>';

                    // 1) Mensagem de texto
                    const { data: newTextMessage, error: insertTextError } = await supabase
                        .from('SAAS_Mensagens')
                        .insert({
                            contaId: currentUserId,
                            conexaoId: idConexao,
                            conversaId: conversaIdNum,
                            mensagem: caption,
                            fromMe: true,
                            enviada: false,
                            tipoMensagem: 'conversation',
                            arquivoUrl: null,
                            apagada: false,
                            messageEvolutionId: null,
                            mensagemRespondida: null,
                            created_at: now
                        })
                        .select()
                        .single();
                    if (insertTextError || !newTextMessage) {
                        console.error('Erro ao criar mensagem de texto:', insertTextError);
                        showToast('Erro ao criar mensagem de texto.', 'error');
                        return;
                    }
                    const idMensagemTexto = newTextMessage.id;
                    const tempTextId = 'temp-' + idMensagemTexto;
                    if (messagesEl) {
                        const textDiv = document.createElement('div');
                        textDiv.className = 'message sent';
                        textDiv.setAttribute('data-message-id', tempTextId);
                        textDiv.setAttribute('data-real-message-id', idMensagemTexto);
                        textDiv.style.position = 'relative';
                        textDiv.innerHTML = `
                        <div class="message-avatar">${getSentMessageAvatarHtml({})}</div>
                        <div class="message-content">
                            <div class="message-content-inner">
                                <span class="message-leading-options">
                                <button class="message-options-btn" onclick="showMessageOptions(event, '${tempTextId}', '${escapeForInlineJsSingleQuoted(caption.substring(0, 50))}')" title="Opções"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></button>
                                </span>
                                <span class="message-body-block"><span class="message-text">${escapeHtml(caption)}</span></span>
                                <span class="message-trailing-meta">
                                <span class="message-time">${formatMessageTime(now)}</span>
                                <span class="message-status-icon clock">${clockIcon}</span>
                                </span>
                            </div>
                        </div>
                        <div class="message-options-menu" id="messageOptions-${tempTextId}"></div>`;
                        messagesEl.appendChild(textDiv);
                    }
                    fetch('/hublabel/public/enviar-mensagem', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            idConexao: idConexao,
                            mensagem: caption,
                            tipoMensagem: 'conversation',
                            instanceName: instanceName,
                            Apikey: apikey,
                            telefone: telefone,
                            idMensagem: idMensagemTexto
                        })
                    }).then(r => { if (!r.ok) console.warn('Webhook enviar-mensagem texto:', r.status); }).catch(err => console.error('Webhook enviar-mensagem:', err));

                    // 2) Mensagem de áudio (sem caption)
                    const { data: newAudioMessage, error: insertAudioError } = await supabase
                        .from('SAAS_Mensagens')
                        .insert({
                            contaId: currentUserId,
                            conexaoId: idConexao,
                            conversaId: conversaIdNum,
                            mensagem: '',
                            fromMe: true,
                            enviada: false,
                            tipoMensagem: 'audiomessage',
                            arquivoUrl: null,
                            apagada: false,
                            messageEvolutionId: null,
                            mensagemRespondida: null,
                            created_at: now
                        })
                        .select()
                        .single();
                    if (insertAudioError || !newAudioMessage) {
                        console.error('Erro ao criar mensagem de áudio:', insertAudioError);
                        showToast('Erro ao criar mensagem de áudio.', 'error');
                        return;
                    }
                    const idMensagemAudio = newAudioMessage.id;
                    const blobUrl = URL.createObjectURL(file);
                    const tempAudioId = 'temp-' + idMensagemAudio;
                    const audioId = 'audio-' + Date.now() + '-' + Math.random().toString(36).slice(2, 8);
                    const audioHtml = `
<div class="message-media message-media-audio audio-player-widget" data-audio-id="${audioId}">
  <audio preload="metadata" src="${blobUrl}"></audio>
  <button type="button" class="audio-player-btn" aria-label="Reproduzir">
    <span class="icon-play"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
    <span class="icon-pause"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></span>
  </button>
  <div class="audio-player-waveform">
    <span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span><span class="bar" style="height:8px"></span><span class="bar" style="height:20px"></span><span class="bar" style="height:12px"></span><span class="bar" style="height:18px"></span><span class="bar" style="height:6px"></span><span class="bar" style="height:14px"></span><span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span>
  </div>
  <div class="audio-player-main">
    <div class="audio-player-progress-wrap">
      <div class="audio-player-progress-fill"></div>
      <input type="range" class="audio-player-progress" min="0" max="100" value="0" aria-label="Posição do áudio"/>
    </div>
    <span class="audio-player-time">0:00 / 0:00</span>
  </div>
</div>`;
                    if (messagesEl) {
                        const oneBlockHtml = (inner, optsBtn, menuSuffix) => `
                        <div class="message-avatar">${getSentMessageAvatarHtml({})}</div>
                        <div class="message-content">
                            <div class="message-content-inner">
                                ${optsBtn ? `<span class="message-leading-options">${optsBtn}</span>` : ''}
                                <span class="message-body-block">${inner}</span>
                                <span class="message-trailing-meta">
                                <span class="message-time">${formatMessageTime(now)}</span>
                                <span class="message-status-icon clock">${clockIcon}</span>
                                </span>
                            </div>
                        </div>
                        <div class="message-options-menu" id="messageOptions-${tempAudioId}${menuSuffix || ''}"></div>`;
                        const audioDiv = document.createElement('div');
                        audioDiv.className = 'message sent';
                        audioDiv.setAttribute('data-message-id', tempAudioId);
                        audioDiv.setAttribute('data-real-message-id', idMensagemAudio);
                        audioDiv.style.position = 'relative';
                        audioDiv.innerHTML = oneBlockHtml(audioHtml, `<button class="message-options-btn" onclick="showMessageOptions(event, '${tempAudioId}', '')" title="Opções"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></button>`, '');
                        messagesEl.appendChild(audioDiv);
                        initAudioWidgetDurations(audioDiv);
                        messagesEl.scrollTop = messagesEl.scrollHeight;
                    }
                    const sendDate = new Date();
                    const dataEnvio = sendDate.toISOString().split('T')[0];
                    const horaEnvio = sendDate.toTimeString().split(' ')[0];
                    const ext = file.name.split('.').pop();
                    const fileName = `audio-${sendDate.getFullYear()}-${String(sendDate.getMonth()+1).padStart(2,'0')}-${String(sendDate.getDate()).padStart(2,'0')}-${String(sendDate.getHours()).padStart(2,'0')}-${String(sendDate.getMinutes()).padStart(2,'0')}-${String(sendDate.getSeconds()).padStart(2,'0')}.${ext}`;
                    const form = new FormData();
                    form.append('data', file, fileName);
                    form.append('userId', String(currentUserId));
                    form.append('conversaId', String(conversaIdNum));
                    form.append('idMensagem', String(idMensagemAudio));
                    form.append('idMensagem2', String(idMensagemTexto));
                    form.append('dataEnvio', dataEnvio);
                    form.append('hora', horaEnvio);
                    form.append('type', 'audioMessage');
                    form.append('instanceName', instanceName);
                    form.append('Apikey', apikey);
                    form.append('telefone', telefone);
                    const response = await fetch('/hublabel/public/enviar-audio', { method: 'POST', body: form });
                    if (!response.ok) {
                        console.error('Erro ao enviar áudio:', response.statusText);
                        showToast('Erro ao enviar áudio.', 'error');
                    } else {
                        console.log('✅ Texto e áudio enviados com sucesso');
                    }
                    return;
                }

                // Mapear tipo de mídia para tipo de mensagem
                const typeMap = {
                    'image': 'imageMessage',
                    'video': 'videoMessage',
                    'document': 'documentMessage',
                    'audio': 'audioMessage'
                };
                const messageType = typeMap[mediaType] || 'documentMessage';

                // Inserir mensagem no banco para obter ID
                const tipoMsg = mediaType === 'image' ? 'imagemessage' : mediaType === 'video' ? 'videomessage' : mediaType === 'audio' ? 'audiomessage' : 'documentmessage';
                const now = new Date().toISOString();
                // Salvar legenda na coluna mensagem quando preenchida
                const mensagemTexto = caption;
                console.log('📝 Inserindo mensagem:', { contaId: currentUserId, conexaoId: idConexao, conversaId: conversaIdNum, tipoMensagem: tipoMsg, mensagem: mensagemTexto || '(vazio)' });
                
                const { data: newMessage, error: insertError } = await supabase
                    .from('SAAS_Mensagens')
                    .insert({
                        contaId: currentUserId,
                        conexaoId: idConexao,
                        conversaId: conversaIdNum,
                        mensagem: mensagemTexto,
                        fromMe: true,
                        enviada: false,
                        tipoMensagem: tipoMsg,
                        arquivoUrl: null,
                        apagada: false,
                        messageEvolutionId: null,
                        mensagemRespondida: null,
                        created_at: now
                    })
                    .select()
                    .single();

                if (insertError) {
                    console.error('❌ Erro ao inserir mensagem:', insertError);
                    console.error('Detalhes:', JSON.stringify(insertError, null, 2));
                    showToast('Erro ao criar mensagem: ' + (insertError.message || insertError.code || 'Erro desconhecido'), 'error');
                    return;
                }
                
                if (!newMessage) {
                    console.error('❌ Mensagem não foi criada (retorno vazio)');
                    showToast('Erro ao criar mensagem: retorno vazio do banco.', 'error');
                    return;
                }

                const idMensagem = newMessage.id;

                // Criar preview otimista da mensagem com blob local
                const messagesEl = document.getElementById('chatMessages');
                if (messagesEl) {
                    const blobUrl = URL.createObjectURL(file);
                    const tempMessageId = 'temp-' + idMensagem;
                    const clockIcon = '<svg viewBox="0 0 16 16" fill="currentColor" style="width: 16px; height: 16px;"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm.5 4.5a.5.5 0 0 0-1 0v3.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1H8.5V4.5z"/></svg>';
                    const contentResult = (mediaType === 'image' || mediaType === 'video')
                        ? generateMessageContent({ mensagem: caption || '', tipoMensagem: tipoMsg, arquivoUrl: blobUrl }, { messageId: tempMessageId, isSent: true })
                        : mediaType === 'document'
                            ? generateMessageContent({ mensagem: caption || '', tipoMensagem: 'documentmessage', arquivoUrl: blobUrl }, { messageId: tempMessageId, isSent: true })
                            : mediaType === 'audio'
                                ? generateMessageContent({ mensagem: caption || '', tipoMensagem: 'audiomessage', arquivoUrl: blobUrl }, { messageId: tempMessageId, isSent: true })
                                : null;
                    let mediaHtml = '';
                    let hasMediaActions = false;
                    const hasCaptionOptimistic = contentResult && typeof contentResult === 'object' && contentResult.caption;
                    if (contentResult && typeof contentResult === 'object' && contentResult.html !== undefined) {
                        mediaHtml = contentResult.html;
                        hasMediaActions = contentResult.hasMediaActions === true;
                    } else {
                        if (mediaType === 'image') {
                            mediaHtml = `<div class="message-media message-media-image"><img src="${blobUrl}" alt="Imagem" loading="lazy" data-blob-url="${blobUrl}"><button type="button" class="media-fullscreen-btn" aria-label="Abrir em tela cheia" onclick="event.stopPropagation(); openImageFullscreen(this)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg></button></div>`;
                        } else if (mediaType === 'video') {
                            mediaHtml = `
<div class="message-media message-media-video video-player-widget">
  <video preload="metadata" src="${blobUrl}" data-blob-url="${blobUrl}"></video>
  <div class="video-player-overlay">
    <button type="button" class="video-player-btn" aria-label="Reproduzir">
      <span class="icon-play"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
      <span class="icon-pause"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></span>
    </button>
  </div>
  <div class="video-player-progress-wrap">
    <div class="video-player-progress-fill"></div>
    <input type="range" class="video-player-progress" min="0" max="100" value="0" aria-label="Posição do vídeo"/>
  </div>
  <button type="button" class="media-fullscreen-btn" aria-label="Abrir em tela cheia" onclick="event.stopPropagation(); openVideoFullscreen(this)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg></button>
</div>`;
                        } else if (mediaType === 'document') {
                            const ext = file.name.split('.').pop().toLowerCase();
                            const typeMap = {
                                pdf: { label: 'PDF', iconClass: 'pdf' },
                                doc: { label: 'Word', iconClass: 'word' },
                                docx: { label: 'Word', iconClass: 'word' },
                                xls: { label: 'Excel', iconClass: 'excel' },
                                xlsx: { label: 'Excel', iconClass: 'excel' }
                            };
                            const docType = typeMap[ext] || { label: ext ? ext.toUpperCase() : 'Arquivo', iconClass: 'generic' };
                            const nameSafe = escapeHtml(file.name.length > 35 ? file.name.substring(0, 35) + '…' : file.name);
                            mediaHtml = `<div class="message-media message-media-document"><div class="document-icon-wrap ${docType.iconClass}" title="${escapeHtml(docType.label)}">${docType.iconClass === 'pdf' ? 'PDF' : docType.iconClass === 'word' ? 'W' : docType.iconClass === 'excel' ? 'X' : '📄'}</div><div class="document-info"><div class="document-type">${escapeHtml(docType.label)}</div><div class="document-name" title="${escapeHtml(file.name)}">${nameSafe}</div></div><a href="${blobUrl}" download="${file.name}" class="document-download" aria-label="Baixar" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></a></div>`;
                        } else if (mediaType === 'audio') {
                            const audioId = 'audio-' + Date.now() + '-' + Math.random().toString(36).slice(2, 8);
                            mediaHtml = `
<div class="message-media message-media-audio audio-player-widget" data-audio-id="${audioId}">
  <audio preload="metadata" src="${blobUrl}"></audio>
  <button type="button" class="audio-player-btn" aria-label="Reproduzir">
    <span class="icon-play"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
    <span class="icon-pause"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></span>
  </button>
  <div class="audio-player-waveform">
    <span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span><span class="bar" style="height:8px"></span><span class="bar" style="height:20px"></span><span class="bar" style="height:12px"></span><span class="bar" style="height:18px"></span><span class="bar" style="height:6px"></span><span class="bar" style="height:14px"></span><span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span>
  </div>
  <div class="audio-player-main">
    <div class="audio-player-progress-wrap">
      <div class="audio-player-progress-fill"></div>
      <input type="range" class="audio-player-progress" min="0" max="100" value="0" aria-label="Posição do áudio"/>
    </div>
    <span class="audio-player-time">0:00 / 0:00</span>
  </div>
</div>`;
                        }
                        if (caption && !hasCaptionOptimistic) mediaHtml += `<span class="message-text">${escapeHtml(caption)}</span>`;
                    }

                    const optsBtnMedia = hasMediaActions ? '' : `<button class="message-options-btn" onclick="showMessageOptions(event, '${tempMessageId}', '')" title="Opções"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></button>`;
                    const optsBtnText = caption ? `<button class="message-options-btn" onclick="showMessageOptions(event, '${tempMessageId}', '${escapeForInlineJsSingleQuoted((caption || '').substring(0, 50))}')" title="Opções"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></button>` : '';
                    const oneBlockHtml = (inner, optsBtn, menuSuffix) => `
                        <div class="message-avatar">${getSentMessageAvatarHtml({})}</div>
                        <div class="message-content">
                            <div class="message-content-inner">
                                ${optsBtn ? `<span class="message-leading-options">${optsBtn}</span>` : ''}
                                <span class="message-body-block">${inner}</span>
                                <span class="message-trailing-meta">
                                <span class="message-time">${formatMessageTime(now)}</span>
                                <span class="message-status-icon clock">${clockIcon}</span>
                                </span>
                            </div>
                        </div>
                        <div class="message-options-menu" id="messageOptions-${tempMessageId}${menuSuffix || ''}"></div>`;
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message sent';
                    messageDiv.setAttribute('data-message-id', tempMessageId);
                    messageDiv.setAttribute('data-real-message-id', idMensagem);
                    messageDiv.style.position = 'relative';
                    messageDiv.innerHTML = oneBlockHtml(mediaHtml, optsBtnMedia, '');
                    messagesEl.appendChild(messageDiv);
                    if (mediaType === 'audio') initAudioWidgetDurations(messageDiv);
                    if (hasCaptionOptimistic && caption) {
                        const textDiv = document.createElement('div');
                        textDiv.className = 'message sent';
                        textDiv.setAttribute('data-message-id', tempMessageId);
                        textDiv.setAttribute('data-real-message-id', idMensagem);
                        textDiv.style.position = 'relative';
                        textDiv.innerHTML = oneBlockHtml(`<span class="message-text">${escapeHtml(caption)}</span>`, optsBtnText, '-caption');
                        messagesEl.appendChild(textDiv);
                    }
                    messagesEl.scrollTop = messagesEl.scrollHeight;
                }

                // Preparar FormData
                const sendDate = new Date();
                const dataEnvio = sendDate.toISOString().split('T')[0];
                const horaEnvio = sendDate.toTimeString().split(' ')[0];

                // Para documentos, preservar o nome original do arquivo enviado
                const ext = file.name.split('.').pop();
                const fileName = `${mediaType}-${sendDate.getFullYear()}-${String(sendDate.getMonth()+1).padStart(2,'0')}-${String(sendDate.getDate()).padStart(2,'0')}-${String(sendDate.getHours()).padStart(2,'0')}-${String(sendDate.getMinutes()).padStart(2,'0')}-${String(sendDate.getSeconds()).padStart(2,'0')}.${ext}`;
                const uploadFileName = (mediaType === 'document' && file && file.name)
                    ? file.name
                    : fileName;

                const form = new FormData();
                form.append('data', file, uploadFileName);
                form.append('userId', String(currentUserId));
                form.append('conversaId', String(conversaIdNum));
                form.append('idMensagem', String(idMensagem));
                form.append('dataEnvio', dataEnvio);
                form.append('hora', horaEnvio);
                form.append('type', messageType);
                form.append('instanceName', instanceName);
                form.append('Apikey', apikey);
                form.append('telefone', telefone);
                if (caption) form.append('caption', caption);

                // Enviar para webhook
                const webhookUrl = '/hublabel/public/enviar-audio';
                const response = await fetch(webhookUrl, {
                    method: 'POST',
                    body: form
                });

                if (!response.ok) {
                    console.error('Erro ao enviar mídia:', response.statusText);
                    showToast('Erro ao enviar arquivo.', 'error');
                    return;
                }

                console.log('✅ Mídia enviada com sucesso:', uploadFileName);

            } catch (error) {
                console.error('Erro ao enviar mídia:', error);
                showToast('Erro ao enviar arquivo: ' + error.message, 'error');
            }
        }

        /**
         * Atualiza as barras de onda com o nível do microfone (AnalyserNode)
         */
        function updateAudioRecorderWaves() {
            const bars = document.querySelectorAll('#audioRecorderWaves .wave-bar');
            if (!bars.length || !audioRecorderState.analyser) return;
            const data = new Uint8Array(audioRecorderState.analyser.frequencyBinCount);
            audioRecorderState.analyser.getByteFrequencyData(data);
            const step = Math.floor(data.length / bars.length);
            bars.forEach((bar, i) => {
                const v = data[i * step] || 0;
                const h = 8 + (v / 255) * 16;
                bar.style.height = h + 'px';
                bar.style.animation = 'none';
            });
            audioRecorderState.animationFrameId = requestAnimationFrame(updateAudioRecorderWaves);
        }

        /**
         * Inicia a gravação de áudio e exibe o gravador no lugar do input
         */
        async function startAudioRecording() {
            if (!currentConversationId) {
                showToast('Selecione uma conversa primeiro.', 'info');
                return;
            }
            const wrap = document.getElementById('chatInputWrap');
            const recorderEl = document.getElementById('chatAudioRecorder');
            const timerEl = document.getElementById('audioRecorderTimer');
            const pauseBtn = document.getElementById('audioRecorderPause');
            if (!wrap || !recorderEl || !timerEl) return;

            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                audioRecorderState.stream = stream;
                audioRecorderState.chunks = [];
                audioRecorderState.pausedDuration = 0;
                audioRecorderState.pausedAt = null;
                audioRecorderState.startTime = Date.now();

                const mimeType = MediaRecorder.isTypeSupported('audio/webm;codecs=opus') ? 'audio/webm;codecs=opus' : 'audio/webm';
                const mediaRecorder = new MediaRecorder(stream, { mimeType });
                audioRecorderState.mediaRecorder = mediaRecorder;
                mediaRecorder.ondataavailable = (e) => {
                    if (e.data.size > 0) audioRecorderState.chunks.push(e.data);
                };

                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const source = audioContext.createMediaStreamSource(stream);
                const analyser = audioContext.createAnalyser();
                analyser.fftSize = 256;
                source.connect(analyser);
                audioRecorderState.analyser = analyser;
                updateAudioRecorderWaves();

                mediaRecorder.start(100);

                wrap.style.display = 'none';
                recorderEl.style.display = 'flex';
                timerEl.textContent = '0:00';
                if (pauseBtn) {
                    const iconPause = pauseBtn.querySelector('.icon-pause');
                    const iconPlay = pauseBtn.querySelector('.icon-play');
                    if (iconPause) iconPause.style.display = '';
                    if (iconPlay) iconPlay.style.display = 'none';
                }

                const tick = () => {
                    if (!audioRecorderState.pausedAt) {
                        const elapsed = (Date.now() - audioRecorderState.startTime - audioRecorderState.pausedDuration) / 1000;
                        const m = Math.floor(elapsed / 60);
                        const s = Math.floor(elapsed % 60);
                        timerEl.textContent = `${m}:${s.toString().padStart(2, '0')}`;
                    }
                };
                tick();
                audioRecorderState.timerInterval = setInterval(tick, 200);
            } catch (err) {
                console.error('Erro ao acessar microfone:', err);
                showToast('Não foi possível acessar o microfone. Verifique as permissões.', 'error');
            }
        }

        /**
         * Pausa ou retoma a gravação de áudio
         */
        function toggleAudioRecorderPause() {
            const mr = audioRecorderState.mediaRecorder;
            const pauseBtn = document.getElementById('audioRecorderPause');
            if (!mr || mr.state === 'inactive') return;
            if (mr.state === 'recording') {
                mr.pause();
                audioRecorderState.pausedAt = Date.now();
                if (pauseBtn) {
                    const iconPause = pauseBtn.querySelector('.icon-pause');
                    const iconPlay = pauseBtn.querySelector('.icon-play');
                    if (iconPause) iconPause.style.display = 'none';
                    if (iconPlay) iconPlay.style.display = '';
                }
                if (audioRecorderState.timerInterval) {
                    clearInterval(audioRecorderState.timerInterval);
                    audioRecorderState.timerInterval = null;
                }
                if (audioRecorderState.animationFrameId) {
                    cancelAnimationFrame(audioRecorderState.animationFrameId);
                    audioRecorderState.animationFrameId = null;
                }
                document.querySelectorAll('#audioRecorderWaves .wave-bar').forEach(bar => {
                    bar.style.height = '8px';
                    bar.style.animation = '';
                });
            } else {
                mr.resume();
                audioRecorderState.pausedDuration += (Date.now() - audioRecorderState.pausedAt);
                audioRecorderState.pausedAt = null;
                if (pauseBtn) {
                    const iconPause = pauseBtn.querySelector('.icon-pause');
                    const iconPlay = pauseBtn.querySelector('.icon-play');
                    if (iconPause) iconPause.style.display = '';
                    if (iconPlay) iconPlay.style.display = 'none';
                }
                const timerEl = document.getElementById('audioRecorderTimer');
                const tick = () => {
                    const elapsed = (Date.now() - audioRecorderState.startTime - audioRecorderState.pausedDuration) / 1000;
                    const m = Math.floor(elapsed / 60);
                    const s = Math.floor(elapsed % 60);
                    if (timerEl) timerEl.textContent = `${m}:${s.toString().padStart(2, '0')}`;
                };
                tick();
                audioRecorderState.timerInterval = setInterval(tick, 200);
                updateAudioRecorderWaves();
            }
        }

        /**
         * Cancela a gravação e volta ao input de texto
         */
        function cancelAudioRecording() {
            const mr = audioRecorderState.mediaRecorder;
            const stream = audioRecorderState.stream;
            if (mr && mr.state !== 'inactive') mr.stop();
            if (stream) stream.getTracks().forEach(t => t.stop());
            if (audioRecorderState.timerInterval) clearInterval(audioRecorderState.timerInterval);
            if (audioRecorderState.animationFrameId) cancelAnimationFrame(audioRecorderState.animationFrameId);
            audioRecorderState.mediaRecorder = null;
            audioRecorderState.stream = null;
            audioRecorderState.chunks = [];
            audioRecorderState.analyser = null;

            const wrap = document.getElementById('chatInputWrap');
            const recorderEl = document.getElementById('chatAudioRecorder');
            if (wrap) wrap.style.display = 'flex';
            if (recorderEl) recorderEl.style.display = 'none';
        }

        /**
         * Envia o áudio gravado: cria mensagem no banco, POST para webhook enviar-audio, adiciona à UI
         */
        async function sendAudioRecording() {
            const mr = audioRecorderState.mediaRecorder;
            const stream = audioRecorderState.stream;
            if (!mr || !stream) {
                cancelAudioRecording();
                return;
            }
            const wrap = document.getElementById('chatInputWrap');
            const recorderEl = document.getElementById('chatAudioRecorder');
            if (wrap) wrap.style.display = 'flex';
            if (recorderEl) recorderEl.style.display = 'none';
            stream.getTracks().forEach(t => t.stop());
            if (audioRecorderState.timerInterval) clearInterval(audioRecorderState.timerInterval);
            if (audioRecorderState.animationFrameId) cancelAnimationFrame(audioRecorderState.animationFrameId);
            audioRecorderState.stream = null;
            audioRecorderState.analyser = null;

            mr.onstop = () => {
                const chunks = audioRecorderState.chunks;
                audioRecorderState.mediaRecorder = null;
                audioRecorderState.chunks = [];
                if (!chunks.length) {
                    console.warn('Nenhum dado de áudio gravado.');
                    return;
                }
                const blob = new Blob(chunks, { type: 'audio/webm' });
                doSendAudioToServer(blob);
            };
            if (mr.state === 'recording' || mr.state === 'paused') mr.stop();
        }

        /**
         * Cria mensagem de áudio no banco, POST para webhook enviar-audio e atualiza a UI
         */
        async function doSendAudioToServer(blob) {
            if (!currentConversationId) {
                console.warn('Nenhuma conversa selecionada');
                return;
            }

            let userIdFromTable = currentUserId;
            if (!userIdFromTable) {
                try {
                    userIdFromTable = await getUserIdFromAuth();
                } catch (e) {
                    if (e.message === 'STATUS_BLOQUEADO') return;
                    throw e;
                }
                if (!userIdFromTable) {
                    showToast('Erro: usuário não identificado.', 'error');
                    return;
                }
                currentUserId = userIdFromTable;
            }

            const conversaIdNum = parseInt(currentConversationId);
            if (isNaN(conversaIdNum)) {
                showToast('ID de conversa inválido.', 'error');
                return;
            }

            const messagesEl = document.getElementById('chatMessages');
            if (!messagesEl) return;

            const now = new Date().toISOString();
            const tempMessageId = 'temp-' + Date.now() + '-' + Math.random().toString(36).slice(2, 9);
            const clockIcon = '<svg viewBox="0 0 16 16" fill="currentColor" style="width: 16px; height: 16px;"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm.5 4.5a.5.5 0 0 0-1 0v3.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1H8.5V4.5z"/></svg>';
            const audioId = 'audio-' + Date.now() + '-' + Math.random().toString(36).slice(2, 8);
            const blobUrl = URL.createObjectURL(blob);
            const optimisticReplyPreview = (replyingToMessageId && replyingToPreviewAuthor != null && replyingToPreviewText != null)
                ? `<div class="message-reply-preview" data-reply-to-evolution-id="${escapeHtml(String(replyingToMessageId))}" role="button" tabindex="0" title="Ir para a mensagem"><div class="message-reply-preview-author">${escapeHtml(replyingToPreviewAuthor)}</div><div class="message-reply-preview-text">${escapeHtml(replyingToPreviewText)}</div></div>`
                : '';
            const audioWidgetHtml = `
<div class="message-media message-media-audio audio-player-widget" data-audio-id="${audioId}">
  <audio preload="metadata" src="${blobUrl}" data-blob-url="${blobUrl}"></audio>
  <button type="button" class="audio-player-btn" aria-label="Reproduzir">
    <span class="icon-play"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
    <span class="icon-pause"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg></span>
  </button>
  <div class="audio-player-waveform">
    <span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span><span class="bar" style="height:8px"></span><span class="bar" style="height:20px"></span><span class="bar" style="height:12px"></span><span class="bar" style="height:18px"></span><span class="bar" style="height:6px"></span><span class="bar" style="height:14px"></span><span class="bar" style="height:10px"></span><span class="bar" style="height:16px"></span>
  </div>
  <div class="audio-player-main">
    <div class="audio-player-progress-wrap">
      <div class="audio-player-progress-fill"></div>
      <input type="range" class="audio-player-progress" min="0" max="100" value="0" aria-label="Posição do áudio"/>
    </div>
    <span class="audio-player-time">0:00 / 0:00</span>
  </div>
</div>`;
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message sent';
            messageDiv.setAttribute('data-message-id', tempMessageId);
            messageDiv.style.position = 'relative';
            messageDiv.innerHTML = `
                <div class="message-avatar">${getSentMessageAvatarHtml({})}</div>
                <div class="message-content">
                    ${optimisticReplyPreview}
                    <div class="message-content-inner">
                        <span class="message-leading-options">
                        <button class="message-options-btn" onclick="showMessageOptions(event, '${tempMessageId}', '')" title="Opções">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg>
                        </button>
                        </span>
                        <span class="message-body-block">${audioWidgetHtml}</span>
                        <span class="message-trailing-meta">
                        <span class="message-time">${formatMessageTime(now)}</span>
                        <span class="message-status-icon clock">${clockIcon}</span>
                        </span>
                    </div>
                </div>
                <div class="message-options-menu" id="messageOptions-${tempMessageId}"></div>
            `;
            messagesEl.appendChild(messageDiv);
            initAudioWidgetDurations(messageDiv);
            messagesEl.scrollTop = messagesEl.scrollHeight;

            const { data: { session } } = await supabase.auth.getSession();
            if (!session?.access_token) {
                messageDiv.remove();
                showToast('Sessão expirada. Faça login novamente.', 'error');
                return;
            }

            const { data: conversaData, error: conversaError } = await supabase
                .from('SAAS_Conversas_Agentes')
                .select('idConexao, telefone')
                .eq('id', conversaIdNum)
                .single();
            if (conversaError || !conversaData?.idConexao) {
                messageDiv.remove();
                showToast('Conversa não encontrada.', 'error');
                return;
            }
            const telefone = conversaData.telefone || '';

            const { data: conexaoData, error: conexaoDataError } = await supabase
                .from('SAAS_Conexões')
                .select('instanceName, Apikey')
                .eq('id', conversaData.idConexao)
                .single();
            if (conexaoDataError || !conexaoData) {
                messageDiv.remove();
                showToast('Erro ao obter dados da conexão.', 'error');
                return;
            }
            const instanceName = conexaoData.instanceName || '';
            const apikey = conexaoData.Apikey || '';

            const { data: newMessage, error: insertError } = await supabase
                .from('SAAS_Mensagens')
                .insert({
                    contaId: currentUserId,
                    conexaoId: conversaData.idConexao,
                    conversaId: conversaIdNum,
                    mensagem: '',
                    tipoMensagem: 'audiomessage',
                    fromMe: true,
                    enviada: false,
                    apagada: false,
                    messageEvolutionId: null,
                    mensagemRespondida: replyingToMessageId || null,
                    arquivoUrl: null,
                    created_at: now
                })
                .select()
                .single();

            if (insertError) {
                messageDiv.remove();
                showToast('Erro ao criar mensagem. Tente novamente.', 'error');
                return;
            }

            const idMensagem = newMessage.id;
            messageDiv.setAttribute('data-message-id', String(idMensagem));
            const menuEl = messageDiv.querySelector('.message-options-menu');
            if (menuEl) menuEl.id = 'messageOptions-' + idMensagem;
            const optBtn = messageDiv.querySelector('.message-options-btn');
            if (optBtn) optBtn.setAttribute('onclick', `showMessageOptions(event, ${idMensagem}, '')`);

            const dateObj = new Date(now);
            const dataEnvio = `${dateObj.getFullYear()}-${String(dateObj.getMonth() + 1).padStart(2, '0')}-${String(dateObj.getDate()).padStart(2, '0')}`;
            const horaEnvio = `${String(dateObj.getHours()).padStart(2, '0')}:${String(dateObj.getMinutes()).padStart(2, '0')}:${String(dateObj.getSeconds()).padStart(2, '0')}`;

            const audioFileName = `audio-${dataEnvio}-${horaEnvio.replace(/:/g, '-')}.webm`;
            const form = new FormData();
            form.append('data', blob, audioFileName);
            form.append('userId', String(currentUserId));
            form.append('conversaId', String(conversaIdNum));
            form.append('idMensagem', String(idMensagem));
            form.append('dataEnvio', dataEnvio);
            form.append('hora', horaEnvio);
            form.append('type', 'audioMessage');
            form.append('instanceName', instanceName);
            form.append('Apikey', apikey);
            form.append('telefone', telefone);

            fetch('/hublabel/public/enviar-audio', {
                method: 'POST',
                body: form
            }).then(res => {
                if (!res.ok) console.warn('Webhook enviar-audio retornou:', res.status);
                else console.log('Áudio enviado via webhook.');
            }).catch(err => console.error('Erro webhook enviar-audio:', err));

            await supabase
                .from('SAAS_Conversas_Agentes')
                .update({ ultimaMensagem: now })
                .eq('id', conversaIdNum);

            const convItem = document.querySelector(`[data-conversation-id="${currentConversationId}"]`);
            if (convItem) {
                const preview = convItem.querySelector('.conversation-preview');
                const time = convItem.querySelector('.conversation-time');
                if (preview) preview.textContent = getConversationPreviewText('', 'audiomessage');
                if (time) time.textContent = 'Agora';
            }

            if (replyingToMessageId) {
                replyingToMessageId = null;
                replyingToPreviewAuthor = null;
                replyingToPreviewText = null;
                const replyPreview = document.getElementById('replyPreview');
                if (replyPreview) replyPreview.classList.remove('show');
            }

            const messageInput = document.getElementById('messageInput');
            if (messageInput) {
                messageInput.value = '';
                autoResizeMessageInput();
            }
        }

        // ============================================
        // FUNÇÕES AUXILIARES
        // ============================================

        /**
         * Obtém as iniciais de um nome para exibir no avatar
         * @param {string} name - Nome completo
         * @returns {string} Iniciais (ex: "João Silva" -> "JS")
         */
        // Limpar telefone removendo @s.whatsapp.net
        function cleanPhoneNumber(phone) {
            if (!phone) return '';
            return phone.replace('@s.whatsapp.net', '').trim();
        }

        function getInitials(name) {
            if (!name) return '?';
            const parts = name.trim().split(' ');
            if (parts.length >= 2) {
                return (parts[0][0] + parts[1][0]).toUpperCase();
            }
            return name[0].toUpperCase();
        }

        /** Ícone de robô para mensagens enviadas pela IA (coluna IA = true) */
        const MESSAGE_AVATAR_ROBOT_ICON = '<span class="message-avatar-robot" title="IA"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="8.5" cy="15.5" r="1.5"/><circle cx="15.5" cy="15.5" r="1.5"/><path d="M8 11V8a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v3"/><path d="M12 6V4"/><path d="M9 4h6"/></svg></span>';

        /**
         * Retorna HTML do avatar para mensagem enviada: robô se IA, senão iniciais "Você"
         * @param {Object} msg - Dados da mensagem (pode ter IA ou ia)
         */
        function getSentMessageAvatarHtml(msg) {
            const isIA = msg && (msg.IA === true || msg.IA === 'true' || msg.IA === 1 || msg.ia === true || msg.ia === 1);
            if (isIA) return MESSAGE_AVATAR_ROBOT_ICON;
            const name = (currentSignedUserName || '').trim();
            if (name && name.toLowerCase() !== 'usuário') return getInitials(name);
            const email = (currentSignedUserEmail || '').trim();
            if (email) return email.charAt(0).toUpperCase();
            return 'V';
        }

        /**
         * Retorna true se a mensagem foi enviada pela IA (coluna IA = true, só em fromMe true)
         */
        function isMessageFromIA(msg) {
            return msg && (msg.IA === true || msg.IA === 'true' || msg.IA === 1 || msg.ia === true || msg.ia === 1);
        }

        /**
         * Retorna o HTML do avatar para mensagens recebidas (foto da conversa ou iniciais).
         */
        function getReceivedMessageAvatarHtml() {
            if (currentConversationFotoPerfil) {
                const safeUrl = escapeHtml(currentConversationFotoPerfil);
                return `<div class="message-avatar" style="background-image: url('${safeUrl}');"><img src="${safeUrl}" alt="" style="display:none"></div>`;
            }
            const savedName = (currentConversationSavedContactName || '').trim();
            if (savedName) return `<div class="message-avatar">${getInitials(savedName)}</div>`;
            return `<div class="message-avatar">C</div>`;
        }

        /**
         * Escapa HTML para prevenir XSS
         * @param {string} text - Texto a ser escapado
         * @returns {string} Texto escapado
         */
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        /**
         * Escapa string para uso seguro em onclick inline com aspas simples.
         * Evita quebrar o JS quando a mensagem possui Enter/quebras de linha.
         */
        function escapeForInlineJsSingleQuoted(text) {
            return String(text ?? '')
                .replace(/\\/g, '\\\\')
                .replace(/'/g, "\\'")
                .replace(/\r/g, '\\r')
                .replace(/\n/g, '\\n');
        }

        /** Normaliza valor da coluna statusAtendimento (aberto, aguardando, fechado) ou filtro de aba agente-ia */
        function normalizeStatusAtendimento(s) {
            if (!s || typeof s !== 'string') return 'aberto';
            const v = s.trim().toLowerCase();
            if (v === 'aguardando' || v === 'fechado') return v;
            if (v === 'agente-ia' || v === 'agente ia' || v === 'agenteia') return 'agente-ia';
            return 'aberto';
        }

        /** Label do status para exibição */
        function getStatusAtendimentoLabel(s) {
            const v = normalizeStatusAtendimento(s);
            if (v === 'agente-ia') return 'IA';
            return v === 'aberto' ? 'Aberto' : v === 'aguardando' ? 'Aguardando' : 'Fechado';
        }

        /** Valor a persistir no Supabase (Aberto, Fechado, Aguardando) */
        function getStatusAtendimentoValueForDb(normalizedStatus) {
            if (normalizedStatus === 'aberto') return 'Aberto';
            if (normalizedStatus === 'aguardando') return 'Aguardando';
            return 'Fechado';
        }

        /** Retorna HTML dos botões de status no header (só mostra opções diferentes do status atual) */
        function getHeaderStatusButtonsHtml() {
            const s = currentConversationStatus;
            let html = '';
            if (s !== 'aberto') {
                html += `<button type="button" class="chat-header-status-btn" onclick="event.stopPropagation(); window.updateConversationStatusFromHeader('aberto')">Abrir</button>`;
            }
            if (s !== 'fechado') {
                if (html) html += '<span class="chat-header-status-sep">·</span>';
                html += `<button type="button" class="chat-header-status-btn" onclick="event.stopPropagation(); window.updateConversationStatusFromHeader('fechado')">Fechar</button>`;
            }
            if (s !== 'aguardando') {
                if (html) html += '<span class="chat-header-status-sep">·</span>';
                html += `<button type="button" class="chat-header-status-btn" onclick="event.stopPropagation(); window.updateConversationStatusFromHeader('aguardando')">Colocar em espera</button>`;
            }
            return html || '<span class="chat-header-status-current">' + getStatusAtendimentoLabel(s) + '</span>';
        }

        /** Atualiza status da conversa a partir do header e atualiza os botões */
        async function updateConversationStatusFromHeader(status) {
            if (!currentConversationId) return;
            const v = normalizeStatusAtendimento(status);
            await updateConversationStatus(currentConversationId, v);
            currentConversationStatus = v;
            const container = document.querySelector('.chat-header-status-actions');
            if (container) container.innerHTML = getHeaderStatusButtonsHtml();
            fetchConversationCountsByStatus(); // atualiza contagem nos filtros (Aberto, Aguardando, Fechado)
        }

        /**
         * Normaliza nota vinda do banco: vazio, só espaços, "null", "{}" etc. → sem conteúdo visível.
         */
        function normalizeConversationNotaFromApi(raw) {
            if (raw == null) return '';
            if (typeof raw === 'object') {
                if (Array.isArray(raw)) return raw.length === 0 ? '' : JSON.stringify(raw);
                try {
                    const keys = Object.keys(raw);
                    return keys.length === 0 ? '' : JSON.stringify(raw);
                } catch {
                    return '';
                }
            }
            const s = String(raw);
            const t = s.trim();
            if (!t) return '';
            const tl = t.toLowerCase();
            if (tl === 'null' || tl === 'undefined') return '';
            if (t === '{}' || t === '[]') return '';
            return s;
        }

        function conversationNotaTemConteudoVisivel(val) {
            return normalizeConversationNotaFromApi(val).length > 0;
        }

        /** Mostra ou esconde o ícone de observações no cabeçalho conforme `currentConversationNota`. */
        function updateChatHeaderNotaIndicator() {
            const btn = document.getElementById('chatHeaderNotaBtn');
            if (!btn) return;
            const has = conversationNotaTemConteudoVisivel(currentConversationNota);
            btn.hidden = !has;
            if (has) {
                const t = normalizeConversationNotaFromApi(currentConversationNota).trim();
                const prev = t.length > 100 ? t.slice(0, 100) + '…' : t;
                btn.title = 'Observações: ' + prev;
            } else {
                btn.removeAttribute('title');
            }
        }

        function formatChatCustomFieldValorExibicao(tipo, valor) {
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

        async function fetchChatContactCustomFieldsHtml(contatoId, contaId) {
            if (!contatoId || !contaId) return '<p class="contact-details-muted">Salve o contato ou grupo na agenda para ver campos personalizados.</p>';
            try {
                const { data: vals, error: e1 } = await supabase
                    .from('SAAS_Valores_Campos_Personalizados')
                    .select('id, idCampo, valor')
                    .eq('idContato', contatoId)
                    .eq('contaId', contaId);
                if (e1) throw e1;
                const rows = vals || [];
                if (rows.length === 0) {
                    return '<p class="contact-details-muted">Nenhum campo com valor. Use + para adicionar.</p>';
                }
                const ids = [...new Set(rows.map(r => r.idCampo).filter(Boolean))];
                const { data: campos, error: e2 } = await supabase
                    .from('SAAS_Campos_Personalizados')
                    .select('id, nome, tipo')
                    .eq('contaId', contaId)
                    .in('id', ids);
                if (e2) throw e2;
                const cmap = {};
                (campos || []).forEach(cp => { cmap[cp.id] = cp; });
                const sorted = rows.slice().sort((a, b) => {
                    const na = (cmap[a.idCampo]?.nome || '').localeCompare(cmap[b.idCampo]?.nome || '', 'pt-BR');
                    return na;
                });
                return '<div class="contact-details-cf-list">' + sorted.map(r => {
                    const cp = cmap[r.idCampo];
                    const nome = cp ? cp.nome : ('Campo #' + r.idCampo);
                    const tipo = cp ? cp.tipo : 'texto';
                    const disp = formatChatCustomFieldValorExibicao(tipo, r.valor);
                    const vid = Number(r.id);
                    const idCampoNum = Number(r.idCampo);
                    const rawVal = r.valor == null ? '' : String(r.valor);
                    const encRaw = encodeURIComponent(rawVal);
                    const encTipo = encodeURIComponent(String(tipo || 'texto'));
                    return '<div class="contact-details-cf-row">' +
                        '<div class="contact-details-cf-row-main">' +
                        '<span class="contact-details-cf-name">' + escapeHtml(nome) + '</span>' +
                        '<span class="contact-details-cf-val">' + escapeHtml(disp) + '</span></div>' +
                        '<div class="contact-details-cf-row-actions">' +
                        '<button type="button" class="contact-details-cf-row-btn" title="Editar" aria-label="Editar valor" ' +
                        'data-cf-vid="' + vid + '" data-cf-campo="' + idCampoNum + '" data-cf-tipo="' + escapeHtml(encTipo) + '" data-cf-raw="' + escapeHtml(encRaw) + '" ' +
                        'onclick="window.chatCfEditValorFromBtn(this)"><span aria-hidden="true">\u270E</span></button>' +
                        '<button type="button" class="contact-details-cf-row-btn danger" title="Remover" aria-label="Remover valor" ' +
                        'onclick="window.removerChatCampoPersonalizadoValor(' + vid + ')">&times;</button>' +
                        '</div></div>';
                }).join('') + '</div>';
            } catch (e) {
                console.warn('Campos personalizados (chat):', e);
                return '<p class="contact-details-muted">Não foi possível carregar os campos.</p>';
            }
        }

        function mountChatCampoValorInputByTipo(tipo) {
            const wrap = document.getElementById('chatCampoValorDynamicMount');
            if (!wrap) return;
            const t = String(tipo || 'texto');
            if (t === 'boolean') {
                wrap.innerHTML = '<select id="chatCampoValorBoolean" class="chat-cf-select" style="margin-bottom:0"><option value="true">Sim</option><option value="false">Não</option></select>';
                return;
            }
            if (t === 'numero') {
                wrap.innerHTML = '<input type="number" id="chatCampoValorInputNum" class="chat-cf-input" step="any" placeholder="0" style="margin-bottom:0">';
                return;
            }
            if (t === 'data') {
                wrap.innerHTML = '<input type="date" id="chatCampoValorInputDate" class="chat-cf-input" style="margin-bottom:0">';
                return;
            }
            wrap.innerHTML = '<input type="text" id="chatCampoValorInputText" class="chat-cf-input" placeholder="Digite o valor" style="margin-bottom:0">';
        }

        window.onChatCampoValorSelectChange = function onChatCampoValorSelectChange() {
            const sel = document.getElementById('chatCampoValorSelect');
            if (!sel || sel.disabled) return;
            if (!sel.value || sel.value === '') {
                const wrap = document.getElementById('chatCampoValorDynamicMount');
                if (wrap) {
                    wrap.innerHTML = '<input type="text" id="chatCampoValorInputText" class="chat-cf-input" placeholder="Selecione um campo acima" style="margin-bottom:0" disabled>';
                }
                return;
            }
            const opt = sel.options[sel.selectedIndex];
            const tipo = opt ? (opt.getAttribute('data-tipo') || 'texto') : 'texto';
            mountChatCampoValorInputByTipo(tipo);
        };

        window.closeChatCampoValorModal = function closeChatCampoValorModal() {
            chatCampoValorModalRowId = null;
            const sel = document.getElementById('chatCampoValorSelect');
            if (sel) sel.disabled = false;
            document.getElementById('chatCampoValorModalOverlay')?.classList.remove('show');
        };

        window.openChatCampoValorModal = async function openChatCampoValorModal() {
            chatCampoValorModalRowId = null;
            const modal = document.getElementById('chatCampoValorModalOverlay');
            const sel = document.getElementById('chatCampoValorSelect');
            const titleEl = document.getElementById('chatCampoValorModalTitle');
            if (!modal || !sel || !currentConversationContatoId || !currentUserId) {
                showToast('Salve o contato ou grupo na agenda antes de atribuir campos.', 'info');
                return;
            }
            sel.disabled = false;
            if (titleEl) titleEl.textContent = 'Adicionar valor';
            try {
                const { data: campos, error } = await supabase
                    .from('SAAS_Campos_Personalizados')
                    .select('id, nome, tipo')
                    .eq('contaId', currentUserId)
                    .order('nome', { ascending: true });
                if (error) throw error;
                const list = campos || [];
                if (list.length === 0) {
                    showToast('Cadastre campos em Configurações primeiro.', 'info');
                    return;
                }
                sel.innerHTML = '<option value="" selected>Selecione um campo</option>' + list.map(c =>
                    '<option value="' + escapeHtml(String(c.id)) + '" data-tipo="' + escapeHtml(String(c.tipo || 'texto')) + '">' + escapeHtml(c.nome || ('Campo ' + c.id)) + '</option>'
                ).join('');
                onChatCampoValorSelectChange();
                modal.classList.add('show');
            } catch (e) {
                console.warn(e);
                showToast('Não foi possível carregar os campos.', 'error');
            }
        };

        window.chatCfEditValorFromBtn = function chatCfEditValorFromBtn(btn) {
            if (!btn || !currentConversationContatoId || !currentUserId) return;
            chatCampoValorModalRowId = Number(btn.getAttribute('data-cf-vid'));
            const idCampo = Number(btn.getAttribute('data-cf-campo'));
            let tipo = 'texto';
            let rawVal = '';
            try {
                tipo = decodeURIComponent(btn.getAttribute('data-cf-tipo') || 'texto');
            } catch (e) { tipo = 'texto'; }
            try {
                rawVal = decodeURIComponent(btn.getAttribute('data-cf-raw') || '');
            } catch (e) { rawVal = ''; }
            const modal = document.getElementById('chatCampoValorModalOverlay');
            const sel = document.getElementById('chatCampoValorSelect');
            const titleEl = document.getElementById('chatCampoValorModalTitle');
            if (!modal || !sel || !Number.isFinite(chatCampoValorModalRowId) || !Number.isFinite(idCampo)) return;
            sel.disabled = true;
            if (titleEl) titleEl.textContent = 'Editar valor';
            void (async () => {
                try {
                    const { data: campos, error } = await supabase
                        .from('SAAS_Campos_Personalizados')
                        .select('id, nome, tipo')
                        .eq('contaId', currentUserId)
                        .order('nome', { ascending: true });
                    if (error) throw error;
                    const list = campos || [];
                    sel.innerHTML = list.map(c =>
                        '<option value="' + escapeHtml(String(c.id)) + '" data-tipo="' + escapeHtml(String(c.tipo || 'texto')) + '">' + escapeHtml(c.nome || ('Campo ' + c.id)) + '</option>'
                    ).join('');
                    sel.value = String(idCampo);
                    mountChatCampoValorInputByTipo(tipo);
                    const t = String(tipo || 'texto');
                    const v = rawVal == null ? '' : String(rawVal);
                    if (t === 'boolean') {
                        const b = document.getElementById('chatCampoValorBoolean');
                        if (b) b.value = (v === 'true' || v === '1' || v.toLowerCase() === 'sim') ? 'true' : 'false';
                    } else if (t === 'numero') {
                        const n = document.getElementById('chatCampoValorInputNum');
                        if (n) n.value = v;
                    } else if (t === 'data') {
                        const d = document.getElementById('chatCampoValorInputDate');
                        if (d) d.value = v.length >= 10 ? v.slice(0, 10) : v;
                    } else {
                        const tx = document.getElementById('chatCampoValorInputText');
                        if (tx) tx.value = v;
                    }
                    modal.classList.add('show');
                } catch (e) {
                    console.warn(e);
                    showToast('Não foi possível abrir a edição.', 'error');
                    sel.disabled = false;
                    chatCampoValorModalRowId = null;
                }
            })();
        };

        window.saveChatCampoValorModal = async function saveChatCampoValorModal() {
            const sel = document.getElementById('chatCampoValorSelect');
            if (!sel || !currentConversationContatoId || !currentUserId) return;
            const idCampo = parseInt(sel.value, 10);
            if (!Number.isFinite(idCampo)) { showToast('Selecione um campo.', 'error'); return; }
            const isEdit = chatCampoValorModalRowId != null;
            const opt = sel.options[sel.selectedIndex];
            const tipo = opt ? (opt.getAttribute('data-tipo') || 'texto') : 'texto';
            let valorStr = '';
            if (tipo === 'boolean') {
                const b = document.getElementById('chatCampoValorBoolean');
                valorStr = b ? String(b.value) : 'false';
            } else if (tipo === 'numero') {
                const n = document.getElementById('chatCampoValorInputNum');
                if (!n || n.value === '' || n.value == null) { showToast('Informe um número.', 'error'); return; }
                valorStr = String(n.value);
            } else if (tipo === 'data') {
                const d = document.getElementById('chatCampoValorInputDate');
                if (!d || !d.value) { showToast('Informe a data.', 'error'); return; }
                valorStr = d.value;
            } else {
                const t = document.getElementById('chatCampoValorInputText');
                valorStr = (t && t.value != null) ? String(t.value).trim() : '';
                if (valorStr === '') { showToast('Informe o valor.', 'error'); return; }
            }
            const btn = document.getElementById('chatCampoValorSaveBtn');
            if (btn) btn.disabled = true;
            try {
                if (isEdit) {
                    const { error } = await supabase
                        .from('SAAS_Valores_Campos_Personalizados')
                        .update({ valor: valorStr })
                        .eq('id', chatCampoValorModalRowId)
                        .eq('contaId', currentUserId);
                    if (error) throw error;
                } else {
                    const { error } = await supabase.from('SAAS_Valores_Campos_Personalizados').upsert(
                        { idCampo, idContato: currentConversationContatoId, contaId: currentUserId, valor: valorStr },
                        { onConflict: 'idCampo,idContato' }
                    );
                    if (error) throw error;
                }
                showToast('Valor salvo.', 'success');
                window.closeChatCampoValorModal();
                await populateContactDetailsSidePanelExtras();
            } catch (e) {
                console.warn(e);
                showToast('Não foi possível salvar.', 'error');
            } finally {
                if (btn) btn.disabled = false;
            }
        };

        window.removerChatCampoPersonalizadoValor = async function removerChatCampoPersonalizadoValor(valorId) {
            if (!valorId || !currentUserId) return;
            if (!confirm('Remover este valor do campo?')) return;
            try {
                const { error } = await supabase.from('SAAS_Valores_Campos_Personalizados').delete().eq('id', valorId).eq('contaId', currentUserId);
                if (error) throw error;
                showToast('Valor removido.', 'success');
                await populateContactDetailsSidePanelExtras();
            } catch (e) {
                console.warn(e);
                showToast('Não foi possível remover.', 'error');
            }
        };

        async function fetchCrmCardsForChatContactDetails(contatoId) {
            const { data: cards, error } = await supabase
                .from('SAAS_Cards_Quadros')
                .select('id, nome, valor, observacoes, quadroId, etapaQuadroId')
                .eq('contatoId', contatoId);
            if (error || !cards || cards.length === 0) return [];
            const qIds = [...new Set(cards.map(c => c.quadroId).filter(Boolean))];
            const eIds = [...new Set(cards.map(c => c.etapaQuadroId).filter(Boolean))];
            const qMap = {};
            const eMap = {};
            if (qIds.length) {
                const { data: qs } = await supabase.from('SAAS_Quadros').select('id, nome').in('id', qIds);
                (qs || []).forEach(q => { qMap[q.id] = q.nome || ('Quadro ' + q.id); });
            }
            if (eIds.length) {
                const { data: es } = await supabase.from('SAAS_Etapas_Quadros').select('id, nome').in('id', eIds);
                (es || []).forEach(e => { eMap[e.id] = e.nome || ('Etapa ' + e.id); });
            }
            return cards.map(c => ({
                ...c,
                quadroNome: c.quadroId != null ? (qMap[c.quadroId] || '-') : '-',
                etapaNome: c.etapaQuadroId != null ? (eMap[c.etapaQuadroId] || '-') : '-'
            }));
        }

        async function fetchChatContactEtiquetasBundle(contatoId, contaId) {
            const { data: allE, error: e1 } = await supabase
                .from('SAAS_Etiquetas')
                .select('id, nome, cor')
                .eq('contaId', contaId)
                .order('nome');
            if (e1) throw e1;
            const { data: links, error: e2 } = await supabase
                .from('SAAS_Contatos_Etiquetas')
                .select('etiquetaId')
                .eq('contatoId', contatoId)
                .eq('contaId', contaId);
            if (e2) throw e2;
            const linkedIds = new Set((links || []).map(r => String(r.etiquetaId)));
            return { all: allE || [], linkedIds };
        }

        function buildChatContactDetailsEtiquetasChipsHtml(allEtiquetas, linkedIds) {
            const linked = (allEtiquetas || []).filter(e => linkedIds.has(String(e.id)));
            if (!linked.length) {
                return '<span class="contact-detail-etiquetas-empty-hint">Nenhuma etiqueta vinculada.</span>';
            }
            return linked.map(e => {
                const eidNum = Number(e.id);
                if (!Number.isFinite(eidNum)) return '';
                const corRaw = (e.cor && String(e.cor).trim()) || '#6b7280';
                const safeCor = /^#[0-9a-fA-F]{6}$/i.test(corRaw) ? corRaw : '#6b7280';
                const bg = safeCor + '28';
                return '<span class="contact-detail-etiqueta-chip etiqueta-tag" style="background:' + bg + ';color:' + escapeHtml(safeCor) + ';border-color:' + escapeHtml(safeCor) + '33">' +
                    '<span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:180px">' + escapeHtml(e.nome || 'Sem nome') + '</span>' +
                    '<button type="button" class="contact-detail-etiqueta-chip-remove" aria-label="Remover etiqueta" onclick="event.stopPropagation();window.chatContactDetailEtiquetaRemove(' + eidNum + ')">\u00d7</button>' +
                    '</span>';
            }).filter(Boolean).join('');
        }

        function etiquetaNomeNormalizadoParaBusca(str) {
            return (str || '')
                .normalize('NFD')
                .replace(/\p{M}/gu, '')
                .toLowerCase();
        }

        function buildChatContactDetailsEtiquetasPickerListHtml(allEtiquetas, linkedIds) {
            if (!allEtiquetas.length) {
                return '<div class="contact-detail-etiqueta-empty">Nenhuma etiqueta na conta. Crie na página de contatos.</div>';
            }
            const rows = allEtiquetas.map(e => {
                const eidNum = Number(e.id);
                if (!Number.isFinite(eidNum)) return '';
                const id = String(e.id);
                const on = linkedIds.has(id);
                const corRaw = (e.cor && String(e.cor).trim()) || '#6b7280';
                const safeCor = /^#[0-9a-fA-F]{6}$/i.test(corRaw) ? corRaw : '#6b7280';
                const searchKey = etiquetaNomeNormalizadoParaBusca(e.nome || '');
                return '<button type="button" class="contact-detail-etiqueta-pick-row' + (on ? ' is-on' : '') + '" data-eid="' + eidNum + '" data-search="' + escapeHtml(searchKey) + '" data-on="' + (on ? '1' : '0') + '" onclick="window.chatContactDetailEtiquetaToggle(' + eidNum + ')">' +
                    '<span class="contact-detail-etiqueta-pick-dot" style="background:' + escapeHtml(safeCor) + '"></span>' +
                    '<span class="contact-detail-etiqueta-pick-label">' + escapeHtml(e.nome || 'Sem nome') + '</span>' +
                    '<span class="contact-detail-etiqueta-pick-check">' + (on ? '&#10003;' : '') + '</span>' +
                    '</button>';
            }).filter(Boolean).join('');
            return rows || '<div class="contact-detail-etiqueta-empty">Nenhuma etiqueta listável.</div>';
        }

        function applyContactDetailsEtiquetasSearchFilter() {
            const input = document.getElementById('contactDetailsEtiquetasSearch');
            const list = document.getElementById('contactDetailsEtiquetasMount');
            if (!input || !list) return;
            const term = etiquetaNomeNormalizadoParaBusca((input.value || '').trim());
            list.querySelectorAll('.contact-detail-etiqueta-pick-row').forEach(row => {
                const name = row.getAttribute('data-search') || '';
                row.style.display = !term || name.includes(term) ? '' : 'none';
            });
        }

        async function refreshContactDetailsEtiquetasOnly() {
            const chipsEl = document.getElementById('contactDetailsEtiquetasChipsMount');
            const listEl = document.getElementById('contactDetailsEtiquetasMount');
            const cid = currentConversationContatoId;
            const contaId = currentUserId;
            if (!chipsEl || !listEl || !cid || !contaId) return;
            try {
                const bundle = await fetchChatContactEtiquetasBundle(cid, contaId);
                chipsEl.innerHTML = buildChatContactDetailsEtiquetasChipsHtml(bundle.all, bundle.linkedIds);
                listEl.innerHTML = buildChatContactDetailsEtiquetasPickerListHtml(bundle.all, bundle.linkedIds);
                const s = document.getElementById('contactDetailsEtiquetasSearch');
                if (s) s.oninput = applyContactDetailsEtiquetasSearchFilter;
                applyContactDetailsEtiquetasSearchFilter();
            } catch (e) {
                console.warn('Atualizar etiquetas no painel:', e);
            }
            void refreshChatHeaderMetaIfPresent();
        }

        function resetContactDetailsEtiquetasPicker() {
            const panel = document.getElementById('contactDetailsEtiquetasPickerPanel');
            const btn = document.getElementById('contactDetailsEtiquetasPickerToggle');
            const s = document.getElementById('contactDetailsEtiquetasSearch');
            if (panel) panel.setAttribute('hidden', '');
            if (btn) {
                btn.setAttribute('aria-expanded', 'false');
            }
            if (s) s.value = '';
        }

        function toggleContactDetailsEtiquetasPicker(ev) {
            if (ev) ev.stopPropagation();
            const panel = document.getElementById('contactDetailsEtiquetasPickerPanel');
            const btn = document.getElementById('contactDetailsEtiquetasPickerToggle');
            if (!panel || !btn || btn.hidden) return;
            const opening = panel.hasAttribute('hidden');
            if (opening) {
                panel.removeAttribute('hidden');
                btn.setAttribute('aria-expanded', 'true');
                const s = document.getElementById('contactDetailsEtiquetasSearch');
                if (s) {
                    s.value = '';
                    applyContactDetailsEtiquetasSearchFilter();
                    s.focus();
                }
            } else {
                panel.setAttribute('hidden', '');
                btn.setAttribute('aria-expanded', 'false');
            }
        }

        function buildChatContactDetailsCrmHtml(cards) {
            if (!cards.length) {
                return '<p class="contact-details-muted">Este contato não está em nenhum card do CRM.</p>';
            }
            return '<div class="contact-details-crm-list">' + cards.map(card => {
                const qid = Number(card.quadroId);
                const cid = Number(card.id);
                if (!Number.isFinite(qid) || !Number.isFinite(cid)) return '';
                const title = escapeHtml(card.nome || ('Card #' + cid));
                const meta = escapeHtml(card.quadroNome) + ' · ' + escapeHtml(card.etapaNome);
                return '<button type="button" class="contact-details-crm-row" onclick="window.openCrmCardFromContactDetails(' + qid + ',' + cid + ')">' +
                    '<span class="contact-details-crm-row-wrap">' +
                    '<span class="contact-details-crm-row-main">' +
                    '<span class="contact-details-crm-row-title">' + title + '</span>' +
                    '<span class="contact-details-crm-row-meta">' + meta + '</span></span>' +
                    '<span class="contact-details-crm-row-edit-btn" role="button" tabindex="0" title="Editar CRM/etapa" aria-label="Editar CRM ou etapa" onclick="event.stopPropagation();window.openContactDetailsCrmEditModal(' + cid + ')" onkeydown="if(event.key===\'Enter\'||event.key===\' \'){event.preventDefault();event.stopPropagation();window.openContactDetailsCrmEditModal(' + cid + ')}">' +
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>' +
                    '</span></span></button>';
            }).filter(Boolean).join('') + '</div>';
        }

        async function populateContactDetailsSidePanelExtras() {
            const chipsEl = document.getElementById('contactDetailsEtiquetasChipsMount');
            const listEl = document.getElementById('contactDetailsEtiquetasMount');
            const crmEl = document.getElementById('contactDetailsCrmMount');
            const cfEl = document.getElementById('contactDetailsCustomFieldsMount');
            const cfAddBtn = document.getElementById('contactDetailsCustomFieldsAddBtn');
            const etiquetasToggle = document.getElementById('contactDetailsEtiquetasPickerToggle');
            const etiquetasPanel = document.getElementById('contactDetailsEtiquetasPickerPanel');
            const etiquetasSearch = document.getElementById('contactDetailsEtiquetasSearch');
            try {
                if (!chipsEl || !listEl || !crmEl) return;
                const cid = currentConversationContatoId;
                const contaId = currentUserId;

                function hideEtiquetasPickerChrome() {
                    if (etiquetasToggle) {
                        etiquetasToggle.hidden = true;
                        etiquetasToggle.setAttribute('aria-expanded', 'false');
                    }
                    if (etiquetasPanel) etiquetasPanel.setAttribute('hidden', '');
                    if (etiquetasSearch) etiquetasSearch.value = '';
                }

                if (!contaId) {
                    chipsEl.innerHTML = '<p class="contact-details-muted">Sessão indisponível.</p>';
                    listEl.innerHTML = '';
                    crmEl.innerHTML = '<p class="contact-details-muted">Sessão indisponível.</p>';
                    if (cfEl) cfEl.innerHTML = '<p class="contact-details-muted">Sessão indisponível.</p>';
                    if (cfAddBtn) cfAddBtn.hidden = true;
                    currentContactDetailsCrmCards = [];
                    hideEtiquetasPickerChrome();
                    return;
                }
                if (!cid) {
                    chipsEl.innerHTML = '<p class="contact-details-muted">Salve o contato na agenda (Adicionar/Editar) para gerenciar etiquetas.</p>';
                    listEl.innerHTML = '';
                    crmEl.innerHTML = '<p class="contact-details-muted">Salve o contato na agenda para ver vínculos no CRM.</p>';
                    if (cfEl) cfEl.innerHTML = '<p class="contact-details-muted">Salve o contato ou grupo na agenda para ver campos personalizados.</p>';
                    if (cfAddBtn) cfAddBtn.hidden = true;
                    currentContactDetailsCrmCards = [];
                    hideEtiquetasPickerChrome();
                    return;
                }
                chipsEl.textContent = 'Carregando…';
                listEl.innerHTML = '';
                crmEl.textContent = 'Carregando…';
                if (cfEl) cfEl.textContent = 'Carregando…';
                if (etiquetasToggle) etiquetasToggle.hidden = true;
                try {
                    const [bundle, crmCards, cfHtml] = await Promise.all([
                        fetchChatContactEtiquetasBundle(cid, contaId),
                        fetchCrmCardsForChatContactDetails(cid),
                        fetchChatContactCustomFieldsHtml(cid, contaId)
                    ]);
                    chipsEl.innerHTML = buildChatContactDetailsEtiquetasChipsHtml(bundle.all, bundle.linkedIds);
                    listEl.innerHTML = buildChatContactDetailsEtiquetasPickerListHtml(bundle.all, bundle.linkedIds);
                    crmEl.innerHTML = buildChatContactDetailsCrmHtml(crmCards);
                    currentContactDetailsCrmCards = Array.isArray(crmCards) ? crmCards.slice() : [];
                    if (cfEl) cfEl.innerHTML = cfHtml;
                    if (cfAddBtn) cfAddBtn.hidden = false;
                    resetContactDetailsEtiquetasPicker();
                    if (etiquetasToggle) {
                        etiquetasToggle.hidden = bundle.all.length === 0;
                    }
                    if (etiquetasSearch) {
                        etiquetasSearch.oninput = applyContactDetailsEtiquetasSearchFilter;
                    }
                    applyContactDetailsEtiquetasSearchFilter();
                } catch (err) {
                    console.warn('Detalhes do contato (etiquetas/CRM):', err);
                    chipsEl.innerHTML = '<p class="contact-details-muted">Não foi possível carregar etiquetas.</p>';
                    listEl.innerHTML = '';
                    crmEl.innerHTML = '<p class="contact-details-muted">Não foi possível carregar o CRM.</p>';
                    if (cfEl) cfEl.innerHTML = '<p class="contact-details-muted">Não foi possível carregar campos personalizados.</p>';
                    if (cfAddBtn) cfAddBtn.hidden = true;
                    currentContactDetailsCrmCards = [];
                    hideEtiquetasPickerChrome();
                }
            } finally {
                await refreshContactDetailsFavoritesList();
                void populateContactDetailsAtendimentoTransfer();
            }
        }

        /**
         * Painel lateral: transferir/atribuir atendimento (admin ou próprio atendente atual).
         */
        async function populateContactDetailsAtendimentoTransfer() {
            const mount = document.getElementById('contactDetailsTransferMount');
            const toggleBtn = document.getElementById('contactDetailsTransferToggleBtn');
            if (!mount) return;
            mount.innerHTML = '';
            if (toggleBtn) {
                toggleBtn.hidden = true;
                toggleBtn.setAttribute('aria-expanded', 'false');
            }
            if (!currentConversationId || !currentUserId) return;
            let funcao;
            let mySaasId;
            try {
                [funcao, mySaasId] = await Promise.all([
                    getCurrentUserFuncao(),
                    getUsuarioIdFromAuth()
                ]);
            } catch (e) {
                mount.innerHTML = '<p class="contact-details-muted">Não foi possível verificar permissões.</p>';
                return;
            }
            const isAdmin = funcao === 'admin';
            const atendId = currentConversationAtendenteId ? String(currentConversationAtendenteId) : '';
            const myIdStr = mySaasId ? String(mySaasId) : '';
            const imAttendant = !!(atendId && myIdStr && atendId === myIdStr);
            if (!isAdmin && !imAttendant) return;

            let members;
            try {
                const { data, error } = await supabase
                    .from('SAAS_Usuarios')
                    .select('id, nome, Email')
                    .eq('contaId', currentUserId)
                    .order('nome', { ascending: true });
                if (error) throw error;
                members = data || [];
            } catch (e) {
                console.warn('Membros da conta (transferência):', e);
                mount.innerHTML = '<p class="contact-details-muted">Não foi possível carregar membros da conta.</p>';
                return;
            }
            if (!members.length) {
                mount.innerHTML = '';
                return;
            }
            const memberOpts = members.map(m => {
                const id = String(m.id);
                const label = String((m.nome && m.nome.trim()) || (m.Email && m.Email.trim()) || 'Membro').trim();
                return '<option value="' + escapeHtml(id) + '">' + escapeHtml(label) + '</option>';
            }).join('');
            const optAdminClear = isAdmin
                ? '<option value="">— Remover atribuição —</option>'
                : '';
            const options = memberOpts + optAdminClear;
            if (toggleBtn) toggleBtn.hidden = false;
            mount.innerHTML =
                '<div class="contact-details-transfer-wrap inline" id="contactDetailsTransferPanel" hidden>' +
                '<div class="contact-details-transfer-row">' +
                '<select id="contactDetailsTransferSelect" class="contact-details-transfer-select">' + options + '</select>' +
                '<button type="button" class="contact-details-nota-save contact-details-transfer-apply" onclick="window.executeTransferAtendimento()">Transferir</button>' +
                '</div></div>';
            const sel = document.getElementById('contactDetailsTransferSelect');
            if (sel && atendId) {
                const hasOpt = [...sel.options].some(o => o.value === atendId);
                if (hasOpt) sel.value = atendId;
            }
        }

        function toggleContactDetailsTransferEditor(ev) {
            if (ev) ev.stopPropagation();
            const panel = document.getElementById('contactDetailsTransferPanel');
            const btn = document.getElementById('contactDetailsTransferToggleBtn');
            const tag = document.getElementById('contactDetailsAtendenteNomeDisplay');
            if (!panel || !btn) return;
            const opening = panel.hasAttribute('hidden');
            if (opening) {
                panel.removeAttribute('hidden');
                btn.setAttribute('aria-expanded', 'true');
                if (tag) tag.style.display = 'none';
                const sel = document.getElementById('contactDetailsTransferSelect');
                if (sel) sel.focus();
            } else {
                panel.setAttribute('hidden', '');
                btn.setAttribute('aria-expanded', 'false');
                if (tag) tag.style.display = '';
            }
        }
        window.toggleContactDetailsTransferEditor = toggleContactDetailsTransferEditor;

        async function updateChatHeaderAtendentePill() {
            const span = document.getElementById('chatHeaderAtendentePillText');
            if (!span) return;
            let mySaasId;
            try {
                mySaasId = await getUsuarioIdFromAuth();
            } catch (e) {
                return;
            }
            const currentUserName = await getCurrentUserName();
            const atendIdStr = currentConversationAtendenteId ? String(currentConversationAtendenteId) : '';
            const myIdStr = mySaasId ? String(mySaasId) : '';
            const pillIsMe = !!(atendIdStr && myIdStr && atendIdStr === myIdStr);
            if (pillIsMe) {
                const nm = (currentConversationAtendenteNome || currentUserName || 'Você').trim();
                span.textContent = 'Você (' + nm + ')';
            } else if (currentConversationAtendenteNome) {
                span.textContent = currentConversationAtendenteNome;
            } else {
                span.textContent = 'Sem atendente atribuído';
            }
        }

        async function executeTransferAtendimento() {
            const sel = document.getElementById('contactDetailsTransferSelect');
            if (!sel || !currentConversationId) return;
            const conversaIdNum = parseInt(currentConversationId, 10);
            if (isNaN(conversaIdNum)) return;
            const rawVal = sel.value;
            const newId = rawVal === '' ? null : rawVal;
            if (newId !== null && String(newId) === String(currentConversationAtendenteId || '')) {
                const panel = document.getElementById('contactDetailsTransferPanel');
                const btn = document.getElementById('contactDetailsTransferToggleBtn');
                const nameEl = document.getElementById('contactDetailsAtendenteNomeDisplay');
                if (panel) panel.setAttribute('hidden', '');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                if (nameEl) nameEl.style.display = '';
                if (typeof showToast === 'function') showToast('Esse atendente já está atribuído.', 'info');
                else showToast('Esse atendente já está atribuído.', 'info');
                return;
            }
            try {
                // Atualização direta na tabela para garantir persistência do atendente na conversa.
                const { error: updErr } = await supabase
                    .from('SAAS_Conversas_Agentes')
                    .update({ atendente: newId == null ? null : String(newId) })
                    .eq('id', conversaIdNum)
                    .eq('contaId', currentUserId);
                if (updErr) throw updErr;

                // Mantém RPC como sincronização complementar (logs/regras), sem bloquear o fluxo.
                try {
                    await supabase.rpc('f_transferir_atendimento_conversa', {
                        p_conversa_id: conversaIdNum,
                        p_novo_atendente: newId
                    });
                } catch (_) {}

                if (newId == null) {
                    currentConversationAtendenteId = null;
                    currentConversationAtendenteNome = null;
                } else {
                    currentConversationAtendenteId = String(newId);
                    const opt = sel.options[sel.selectedIndex];
                    currentConversationAtendenteNome = opt ? String(opt.textContent || '').trim() : null;
                }
                const nameEl = document.getElementById('contactDetailsAtendenteNomeDisplay');
                if (nameEl) nameEl.textContent = currentConversationAtendenteNome || '—';
                const panel = document.getElementById('contactDetailsTransferPanel');
                const btn = document.getElementById('contactDetailsTransferToggleBtn');
                if (nameEl) nameEl.style.display = '';
                if (panel) panel.setAttribute('hidden', '');
                if (btn) btn.setAttribute('aria-expanded', 'false');
                await updateChatHeaderAtendentePill();
                if (typeof showToast === 'function') showToast(newId == null ? 'Atribuição removida.' : 'Atendente transferido com sucesso.', 'success');
                void loadConversations(currentConversationsStatusFilter, false);
            } catch (e) {
                console.warn('Transferir atendimento:', e);
                const fallback = (e && e.message) || 'Erro ao transferir. Se persistir, aplique a função f_transferir_atendimento_conversa no banco (script unificado).';
                if (typeof showToast === 'function') showToast(fallback, 'error');
                else showToast(fallback, 'error');
            }
        }
        window.executeTransferAtendimento = executeTransferAtendimento;

        async function chatContactDetailEtiquetaToggle(etiquetaIdVal) {
            const cid = currentConversationContatoId;
            const contaId = currentUserId;
            if (!cid || !contaId) return;
            const eid = parseInt(String(etiquetaIdVal), 10);
            if (Number.isNaN(eid)) return;
            let shouldAdd = true;
            try {
                const row = document.querySelector('#contactDetailsEtiquetasMount .contact-detail-etiqueta-pick-row[data-eid="' + eid + '"]');
                if (row) shouldAdd = row.getAttribute('data-on') !== '1';
            } catch (_) {}
            try {
                if (shouldAdd) {
                    const { error } = await supabase.from('SAAS_Contatos_Etiquetas').insert({
                        contatoId: cid,
                        etiquetaId: eid,
                        contaId
                    });
                    if (error) throw error;
                    showToast('Etiqueta adicionada.', 'success');
                } else {
                    const { error } = await supabase.from('SAAS_Contatos_Etiquetas').delete()
                        .eq('contatoId', cid).eq('etiquetaId', eid).eq('contaId', contaId);
                    if (error) throw error;
                    showToast('Etiqueta removida.', 'success');
                }
                await refreshContactDetailsEtiquetasOnly();
                if (typeof loadChatFilterEtiquetasUi === 'function') void loadChatFilterEtiquetasUi();
            } catch (err) {
                console.warn('Etiqueta (toggle):', err);
                showToast('Erro ao atualizar etiquetas.', 'error');
            }
        }
        window.chatContactDetailEtiquetaToggle = chatContactDetailEtiquetaToggle;

        async function chatContactDetailEtiquetaChange(ev, etiquetaIdVal) {
            const cid = currentConversationContatoId;
            const contaId = currentUserId;
            if (!cid || !contaId) return;
            const eid = parseInt(String(etiquetaIdVal), 10);
            if (Number.isNaN(eid)) return;
            const cb = ev.target;
            if (!cb || cb.type !== 'checkbox') return;
            const wantAdd = cb.checked;
            cb.disabled = true;
            try {
                if (wantAdd) {
                    const { error } = await supabase.from('SAAS_Contatos_Etiquetas').insert({
                        contatoId: cid,
                        etiquetaId: eid,
                        contaId
                    });
                    if (error) throw error;
                    showToast('Etiqueta adicionada.', 'success');
                } else {
                    const { error } = await supabase.from('SAAS_Contatos_Etiquetas').delete()
                        .eq('contatoId', cid).eq('etiquetaId', eid).eq('contaId', contaId);
                    if (error) throw error;
                    showToast('Etiqueta removida.', 'success');
                }
                await refreshContactDetailsEtiquetasOnly();
                if (typeof loadChatFilterEtiquetasUi === 'function') {
                    void loadChatFilterEtiquetasUi();
                }
            } catch (err) {
                cb.checked = !wantAdd;
                console.warn('Etiqueta (change):', err);
                showToast('Erro ao atualizar etiquetas.', 'error');
            } finally {
                if (cb.isConnected) cb.disabled = false;
            }
        }

        async function chatContactDetailEtiquetaRemove(eid) {
            const cid = currentConversationContatoId;
            const contaId = currentUserId;
            if (!cid || !contaId) return;
            const eidNum = parseInt(String(eid), 10);
            if (Number.isNaN(eidNum)) return;
            try {
                const { error } = await supabase.from('SAAS_Contatos_Etiquetas').delete()
                    .eq('contatoId', cid).eq('etiquetaId', eidNum).eq('contaId', contaId);
                if (error) throw error;
                showToast('Etiqueta removida.', 'success');
                await refreshContactDetailsEtiquetasOnly();
                if (typeof loadChatFilterEtiquetasUi === 'function') void loadChatFilterEtiquetasUi();
            } catch (err) {
                console.warn('Etiqueta (remove):', err);
                showToast('Erro ao remover etiqueta.', 'error');
            }
        }

        function openCrmCardFromContactDetails(quadroId, cardId) {
            if (quadroId == null || cardId == null) return;
            const q = Number(quadroId);
            const c = Number(cardId);
            if (!Number.isFinite(q) || !Number.isFinite(c)) return;
            const url = '/hublabel/public/hublabel/public/crm-etapas?quadroId=' + encodeURIComponent(String(q)) + '&cardId=' + encodeURIComponent(String(c));
            navigateToPage(url);
        }

        async function loadContactDetailsCrmEditEtapas(quadroId, selectedEtapaId) {
            const etapaSelect = document.getElementById('contactDetailsCrmEditEtapaSelect');
            if (!etapaSelect) return;
            const qid = Number(quadroId);
            if (!Number.isFinite(qid)) {
                etapaSelect.innerHTML = '<option value="">Selecione um CRM</option>';
                return;
            }
            etapaSelect.innerHTML = '<option value="">Carregando etapas…</option>';
            const { data, error } = await supabase
                .from('SAAS_Etapas_Quadros')
                .select('id, nome, ordem')
                .eq('quadroId', qid)
                .order('ordem');
            if (error || !data || data.length === 0) {
                etapaSelect.innerHTML = '<option value="">Nenhuma etapa</option>';
                return;
            }
            const selected = selectedEtapaId == null ? '' : String(selectedEtapaId);
            etapaSelect.innerHTML = data.map(etapa => {
                const idStr = String(etapa.id);
                const isSelected = idStr === selected ? ' selected' : '';
                return '<option value="' + escapeHtml(idStr) + '"' + isSelected + '>' + escapeHtml(etapa.nome || ('Etapa ' + idStr)) + '</option>';
            }).join('');
            if (!etapaSelect.value) etapaSelect.value = String(data[0].id);
        }

        async function openContactDetailsCrmEditModal(cardId) {
            const overlay = document.getElementById('contactDetailsCrmEditModalOverlay');
            const quadroSelect = document.getElementById('contactDetailsCrmEditQuadroSelect');
            const etapaSelect = document.getElementById('contactDetailsCrmEditEtapaSelect');
            const saveBtn = document.getElementById('contactDetailsCrmEditSaveBtn');
            if (!overlay || !quadroSelect || !etapaSelect || !saveBtn) return;
            const cidNum = Number(cardId);
            if (!Number.isFinite(cidNum)) return;
            const card = (currentContactDetailsCrmCards || []).find(c => Number(c.id) === cidNum);
            if (!card) {
                showToast('Card de CRM não encontrado.', 'error');
                return;
            }
            if (!currentUserId) {
                showToast('Sessão indisponível.', 'error');
                return;
            }
            currentContactDetailsCrmEditCardId = cidNum;
            saveBtn.disabled = false;
            overlay.classList.add('show');
            quadroSelect.innerHTML = '<option value="">Carregando CRM…</option>';
            etapaSelect.innerHTML = '<option value="">Carregando etapas…</option>';
            const { data: quadros, error } = await supabase
                .from('SAAS_Quadros')
                .select('id, nome')
                .eq('contaId', currentUserId)
                .order('nome');
            if (error || !quadros || quadros.length === 0) {
                quadroSelect.innerHTML = '<option value="">Nenhum CRM</option>';
                etapaSelect.innerHTML = '<option value="">Nenhuma etapa</option>';
                showToast('Não foi possível carregar CRM.', 'error');
                return;
            }
            const selectedQuadro = card.quadroId == null ? '' : String(card.quadroId);
            quadroSelect.innerHTML = quadros.map(q => {
                const idStr = String(q.id);
                const isSelected = idStr === selectedQuadro ? ' selected' : '';
                return '<option value="' + escapeHtml(idStr) + '"' + isSelected + '>' + escapeHtml(q.nome || ('CRM ' + idStr)) + '</option>';
            }).join('');
            if (!quadroSelect.value) quadroSelect.value = String(quadros[0].id);
            await loadContactDetailsCrmEditEtapas(quadroSelect.value, card.etapaQuadroId);
        }

        function closeContactDetailsCrmEditModal() {
            const overlay = document.getElementById('contactDetailsCrmEditModalOverlay');
            const saveBtn = document.getElementById('contactDetailsCrmEditSaveBtn');
            if (overlay) overlay.classList.remove('show');
            if (saveBtn) saveBtn.disabled = false;
            currentContactDetailsCrmEditCardId = null;
        }

        async function onContactDetailsCrmEditQuadroChange() {
            const quadroSelect = document.getElementById('contactDetailsCrmEditQuadroSelect');
            if (!quadroSelect) return;
            await loadContactDetailsCrmEditEtapas(quadroSelect.value, null);
        }

        async function saveContactDetailsCrmEditModal() {
            const cardId = Number(currentContactDetailsCrmEditCardId);
            const quadroSelect = document.getElementById('contactDetailsCrmEditQuadroSelect');
            const etapaSelect = document.getElementById('contactDetailsCrmEditEtapaSelect');
            const saveBtn = document.getElementById('contactDetailsCrmEditSaveBtn');
            if (!Number.isFinite(cardId) || !quadroSelect || !etapaSelect || !saveBtn) return;
            const quadroId = Number(quadroSelect.value);
            const etapaId = Number(etapaSelect.value);
            if (!Number.isFinite(quadroId) || !Number.isFinite(etapaId)) {
                showToast('Selecione CRM e etapa.', 'error');
                return;
            }
            saveBtn.disabled = true;
            try {
                const { error } = await supabase
                    .from('SAAS_Cards_Quadros')
                    .update({ quadroId, etapaQuadroId: etapaId })
                    .eq('id', cardId);
                if (error) throw error;
                showToast('CRM atualizado com sucesso.', 'success');
                closeContactDetailsCrmEditModal();
                await populateContactDetailsSidePanelExtras();
                void refreshChatHeaderMetaIfPresent();
                if (typeof loadConversations === 'function') {
                    void loadConversations(currentConversationsStatusFilter, false);
                }
            } catch (err) {
                console.warn('Salvar CRM no painel de detalhes:', err);
                showToast('Não foi possível atualizar CRM/etapa.', 'error');
                saveBtn.disabled = false;
            }
        }

        /** Abre o painel lateral de dados do contato (3 pontos). focusSection: 'etiquetas' rola até a secção de etiquetas. */
        async function toggleContactDetailsDropdown(event, focusSection) {
            if (event) event.stopPropagation();
            const overlay = document.getElementById('contactDetailsOverlay');
            if (!overlay) return;
            overlay.classList.add('open');
            await populateContactDetailsSidePanelExtras();
            if (focusSection === 'etiquetas') {
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        const section = document.getElementById('contactDetailsEtiquetasSection');
                        const scrollEl = document.querySelector('.contact-details-panel-body');
                        if (section && scrollEl) {
                            const top = section.offsetTop - scrollEl.offsetTop;
                            scrollEl.scrollTo({ top: Math.max(0, top - 8), behavior: 'smooth' });
                        } else if (section) {
                            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    });
                });
            }
        }

        function conversationNotaDraftMatchesSaved(draftVal, savedVal) {
            return String(draftVal || '').trim() === String(savedVal || '').trim();
        }

        function updateContactDetailsNotaSaveButtonVisibility() {
            const input = document.getElementById('contactDetailsNotaInput');
            const btn = document.getElementById('contactDetailsNotaSaveBtn');
            if (!input || !btn) return;
            btn.hidden = conversationNotaDraftMatchesSaved(input.value, currentConversationNota);
        }

        function setupContactDetailsNotaSaveVisibility() {
            const input = document.getElementById('contactDetailsNotaInput');
            if (!input) return;
            updateContactDetailsNotaSaveButtonVisibility();
            input.removeEventListener('input', updateContactDetailsNotaSaveButtonVisibility);
            input.addEventListener('input', updateContactDetailsNotaSaveButtonVisibility);
            input.removeEventListener('blur', updateContactDetailsNotaSaveButtonVisibility);
            input.addEventListener('blur', updateContactDetailsNotaSaveButtonVisibility);
        }
        /** Salva a nota/observações da conversa no Supabase */
        async function saveContactNota() {
            const input = document.getElementById('contactDetailsNotaInput');
            if (!input || !currentConversationId) return;
            const conversaIdNum = parseInt(currentConversationId);
            if (isNaN(conversaIdNum)) return;
            const nota = (input.value || '').trim();
            try {
                const { error } = await supabase
                    .from('SAAS_Conversas_Agentes')
                    .update({ nota: nota || null })
                    .eq('id', conversaIdNum);
                if (error) {
                    console.error('❌ Erro ao salvar nota:', error);
                    showToast('Erro ao salvar nota. Tente novamente.', 'error');
                    return;
                }
                currentConversationNota = nota;
                updateChatHeaderNotaIndicator();
                const btn = document.getElementById('contactDetailsNotaSaveBtn');
                if (btn) {
                    const orig = btn.textContent;
                    btn.hidden = false;
                    btn.textContent = 'Salvo!';
                    btn.disabled = true;
                    setTimeout(() => {
                        btn.textContent = orig;
                        btn.disabled = false;
                        updateContactDetailsNotaSaveButtonVisibility();
                    }, 1500);
                }
            } catch (e) {
                console.error('❌ Erro ao salvar nota:', e);
                showToast('Erro ao salvar nota. Tente novamente.', 'error');
            }
        }
        window.saveContactNota = saveContactNota;

        /** Abre o popup vermelho de confirmação de exclusão */
        function deleteConversation() {
            if (!currentConversationId) return;
            const conversaIdNum = parseInt(currentConversationId);
            if (isNaN(conversaIdNum)) return;
            const overlay = document.getElementById('deleteConfirmOverlay');
            if (overlay) overlay.classList.add('show');
        }
        window.deleteConversation = deleteConversation;

        /** Fecha o popup de confirmação de exclusão */
        function closeDeleteConfirmPopup() {
            const overlay = document.getElementById('deleteConfirmOverlay');
            if (overlay) overlay.classList.remove('show');
        }
        window.closeDeleteConfirmPopup = closeDeleteConfirmPopup;

        /** Executa a exclusão após confirmação no popup */
        async function confirmDeleteConversation() {
            if (!currentConversationId) return;
            const conversaIdNum = parseInt(currentConversationId);
            if (isNaN(conversaIdNum)) return;
            closeDeleteConfirmPopup();
            try {
                // Buscar dados necessários para limpar histórico do agente IA por session_id (telefone-idAgente)
                let sessionIdToDelete = null;
                try {
                    const { data: convForSession, error: convForSessionErr } = await supabase
                        .from('SAAS_Conversas_Agentes')
                        .select('telefone, idAgente')
                        .eq('id', conversaIdNum)
                        .single();
                    if (!convForSessionErr && convForSession) {
                        const telefoneSession = String(convForSession.telefone || '').trim();
                        const idAgenteSession = convForSession.idAgente != null ? String(convForSession.idAgente).trim() : '';
                        if (telefoneSession && idAgenteSession) {
                            sessionIdToDelete = `${telefoneSession}-${idAgenteSession}`;
                        }
                    }
                } catch (_) {}

                if (sessionIdToDelete) {
                    const { error: historicoDeleteError } = await supabase
                        .from('saas_historico_agenteia')
                        .delete()
                        .eq('session_id', sessionIdToDelete);
                    if (historicoDeleteError) {
                        console.error('❌ Erro ao excluir histórico do agente IA:', historicoDeleteError);
                    }
                }

                const { error } = await supabase
                    .from('SAAS_Conversas_Agentes')
                    .delete()
                    .eq('id', conversaIdNum);
                if (error) {
                    console.error('❌ Erro ao excluir conversa:', error);
                    showToast(error.message || 'Erro ao excluir conversa. Verifique se você tem permissão (apenas administradores podem excluir).', 'error');
                    return;
                }
                closeContactDetailsPanel();
                currentConversationId = null;
                currentContactName = null;
                currentConversationContatoId = null;
                currentConversationAtendenteId = null;
                currentConversationAtendenteNome = null;
                const chatArea = document.getElementById('chatArea');
                if (chatArea) {
                    chatArea.innerHTML = '<div class="chat-empty" id="chatEmpty"><img src="/hublabel/public/assets/images/logo" alt="IA Chatconversa" class="chat-empty-logo"></div>';
                }
                if (window.innerWidth <= 768) showConversationsListOnMobile();
                loadConversations(currentConversationsStatusFilter, false);
            } catch (e) {
                console.error('❌ Erro ao excluir conversa:', e);
                showToast('Erro ao excluir conversa. Tente novamente.', 'error');
            }
        }
        window.confirmDeleteConversation = confirmDeleteConversation;

        /** Fecha o painel lateral de dados do contato (X ou clique no overlay/backdrop) */
        function closeContactDetailsPanel(event) {
            const overlay = document.getElementById('contactDetailsOverlay');
            if (!overlay) return;
            if (event && event.target !== overlay) return; // só fecha se clicou no overlay (backdrop) ou se chamado sem event (botão X)
            overlay.classList.remove('open');
            resetContactDetailsEtiquetasPicker();
        }

        /** Abre a barra de pesquisa na conversa atual (fecha o painel de detalhes e foca o input) */
        function openConversationSearch() {
            const overlay = document.getElementById('contactDetailsOverlay');
            if (overlay) overlay.classList.remove('open');
            const bar = document.getElementById('chatSearchBar');
            const input = document.getElementById('chatSearchInput');
            if (bar) bar.classList.add('open');
            if (input) {
                input.value = '';
                input.focus();
                runConversationSearch();
            }
        }

        /** Fecha a barra de pesquisa e mostra todas as mensagens */
        function closeConversationSearch() {
            const bar = document.getElementById('chatSearchBar');
            const input = document.getElementById('chatSearchInput');
            if (bar) bar.classList.remove('open');
            if (input) input.value = '';
            const messagesEl = document.getElementById('chatMessages');
            if (messagesEl) {
                messagesEl.querySelectorAll('.message.search-hidden, .message.search-highlight').forEach(el => {
                    el.classList.remove('search-hidden', 'search-highlight');
                });
            }
        }

        /** Remove acentos para comparação (café -> cafe, ação -> acao) */
        function normalizeForSearch(str) {
            return (str || '')
                .normalize('NFD')
                .replace(/\p{M}/gu, '')
                .toLowerCase();
        }

        /** Filtra mensagens da conversa pelo texto digitado na pesquisa (ignora acentos) */
        function runConversationSearch() {
            const input = document.getElementById('chatSearchInput');
            const messagesEl = document.getElementById('chatMessages');
            if (!input || !messagesEl) return;
            const termRaw = (input.value || '').trim();
            const term = normalizeForSearch(termRaw);
            const messages = messagesEl.querySelectorAll('.message');
            let firstMatch = null;
            messages.forEach(msg => {
                const contentEl = msg.querySelector('.message-content-inner');
                const text = contentEl ? contentEl.textContent || '' : '';
                const textNorm = normalizeForSearch(text);
                const matches = term === '' || textNorm.includes(term);
                msg.classList.toggle('search-hidden', !matches);
                msg.classList.toggle('search-highlight', term !== '' && matches);
                if (matches && !firstMatch) firstMatch = msg;
            });
            if (firstMatch) firstMatch.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Expor no window para onclick no header (Abrir, Fechar, Colocar em espera e menu 3 pontos)
        window.updateConversationStatusFromHeader = updateConversationStatusFromHeader;
        window.updateChatHeaderNotaIndicator = updateChatHeaderNotaIndicator;
        window.toggleContactDetailsDropdown = toggleContactDetailsDropdown;
        window.closeContactDetailsPanel = closeContactDetailsPanel;
        window.chatContactDetailEtiquetaChange = chatContactDetailEtiquetaChange;
        window.chatContactDetailEtiquetaRemove = chatContactDetailEtiquetaRemove;
        window.toggleContactDetailsEtiquetasPicker = toggleContactDetailsEtiquetasPicker;
        window.openCrmCardFromContactDetails = openCrmCardFromContactDetails;
        window.openContactDetailsCrmEditModal = openContactDetailsCrmEditModal;
        window.closeContactDetailsCrmEditModal = closeContactDetailsCrmEditModal;
        window.onContactDetailsCrmEditQuadroChange = onContactDetailsCrmEditQuadroChange;
        window.saveContactDetailsCrmEditModal = saveContactDetailsCrmEditModal;
        window.openConversationSearch = openConversationSearch;
        window.closeConversationSearch = closeConversationSearch;

        /** No mobile: volta para a lista de conversas (esconde área do chat) */
        function showConversationsListOnMobile() {
            const list = document.getElementById('conversationsList');
            if (list && window.innerWidth <= 768) list.classList.add('show');
        }
        window.showConversationsListOnMobile = showConversationsListOnMobile;

        /**
         * Atualiza o status de atendimento da conversa (SAAS_Conversas_Agentes).
         * Ao mudar para Aberto: statusAtendimento = Aberto e pausado = true.
         * Ao mudar para Fechado ou Aguardando: statusAtendimento e pausado = false.
         * @param {string|number} conversationId - ID da conversa
         * @param {string} status - 'aberto' | 'aguardando' | 'fechado'
         */
        async function updateConversationStatus(conversationId, status) {
            const id = parseInt(conversationId);
            if (isNaN(id)) return;
            const v = normalizeStatusAtendimento(status);
            const valueForDb = getStatusAtendimentoValueForDb(v); // Aberto | Fechado | Aguardando
            const pausadoValue = v === 'aberto'; // true quando Aberto, false caso contrário
            const updatePayload = {
                statusAtendimento: valueForDb,
                pausado: !!pausadoValue
            };
            const { data, error } = await supabase
                .from('SAAS_Conversas_Agentes')
                .update(updatePayload)
                .eq('id', id)
                .select('id, statusAtendimento, pausado')
                .maybeSingle();
            if (error) {
                console.error('Erro ao atualizar status:', error);
            } else if (data) {
                console.log('Status atualizado:', data);
            }
        }


        /**
         * Formata a data/hora para exibição na lista de conversas
         * @param {string} dateString - Data em formato ISO
         * @returns {string} Data formatada (ex: "Agora", "5m", "2h", "Ontem")
         */
        function formatTime(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            const now = new Date();
            const diff = now - date;
            const minutes = Math.floor(diff / 60000);
            const hours = Math.floor(diff / 3600000);
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));

            if (minutes < 1) {
                return 'Agora';
            } else if (minutes < 60) {
                return `${minutes}m`;
            } else if (hours < 24) {
                return `${hours}h`;
            } else if (days === 1) {
                return 'Ontem';
            } else if (days < 7) {
                return date.toLocaleDateString('pt-BR', { weekday: 'short' });
            } else {
                return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
            }
        }

        const CONVERSATION_TIME_REFRESH_MS = 30000;
        let conversationTimeRefreshInterval = null;

        function refreshConversationTimeBadges() {
            document.querySelectorAll('#conversationsScroll .conversation-time[data-time-source]').forEach(el => {
                const source = el.getAttribute('data-time-source');
                if (!source) return;
                el.textContent = formatTime(source);
            });
        }

        function ensureConversationTimeAutoRefresh() {
            if (conversationTimeRefreshInterval) return;
            conversationTimeRefreshInterval = setInterval(refreshConversationTimeBadges, CONVERSATION_TIME_REFRESH_MS);
        }

        /**
         * Retorna o texto do preview da conversa: texto da mensagem ou label para mídia (Áudio, Imagem, etc.)
         * @param {string} texto - Texto da última mensagem
         * @param {string} tipoMensagem - Tipo (audiomessage, imagemessage, documentmessage, etc.)
         * @returns {string} Texto para exibir no preview (máx. 50 caracteres para texto)
         */
        function getConversationPreviewText(texto, tipoMensagem) {
            const t = (texto || '').trim();
            if (t) return t.length > 50 ? t.substring(0, 50) + '...' : t;
            const tipo = (tipoMensagem || '').toLowerCase();
            const labels = {
                'audiomessage': '🎵 Áudio',
                'imagemessage': '📷 Imagem',
                'videomessage': '🎥 Vídeo',
                'documentmessage': '📄 Documento',
                'stickermessage': '🎭 Sticker',
                'image': '📷 Imagem',
                'video': '🎥 Vídeo',
                'audio': '🎵 Áudio',
                'document': '📄 Documento',
                'sticker': '🎭 Sticker'
            };
            return labels[tipo] || 'Nova conversa';
        }

        /**
         * Coluna de data em SAAS_Mensagens: created_at (PostgREST; eventual serialização camelCase).
         */
        function getMensagemCreatedAt(obj) {
            if (!obj || typeof obj !== 'object') return null;
            const a = obj.created_at;
            if (a != null && String(a).trim() !== '') return a;
            const c = obj.createdAt;
            if (c != null && String(c).trim() !== '') return c;
            return null;
        }

        /**
         * Formata a hora para exibição nas mensagens
         * @param {string} dateString - Data em formato ISO
         * @returns {string} Hora formatada (ex: "14:30")
         */
        function formatMessageTime(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
        }

        // Navegação
        function navigateToPage(url) {
            window.location.href = url;
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

        // Logout
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
            document.cookie = 'userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            
            // Limpar sessionStorage e localStorage
            sessionStorage.clear();
            localStorage.clear();
            
            // Redirecionar para página de login
            window.location.href = '/hublabel/public/hublabel/public/hublabel/public/hublabel/public/login';
        }

        document.getElementById('chatFilterCrmChangeQuadroBtn')?.addEventListener('click', function() {
            chatFilterEtapaIds = [];
            chatFilterCrmEtapasPickerExpanded = true;
            document.querySelectorAll('input[name="chatFilterQuadroRadio"]').forEach(r => { r.checked = false; });
            const etapasWrap = document.getElementById('chatFilterEtapasList');
            if (etapasWrap) etapasWrap.innerHTML = '<span class="chat-filter-hint">Selecione um quadro</span>';
            syncChatFilterCrmUi();
            refreshChatFilterSectionSummaries();
            applyChatConversationFilters();
        });

        document.getElementById('chatFilterCrmChangeEtapasBtn')?.addEventListener('click', function() {
            chatFilterCrmEtapasPickerExpanded = true;
            syncChatFilterCrmUi();
            refreshChatFilterSectionSummaries();
        });

        document.getElementById('conversationsFiltersPanel')?.addEventListener('change', function(ev) {
            const t = ev.target;
            if (t && t.name === 'chatFilterQuadroRadio') {
                chatFilterEtapaIds = [];
                chatFilterCrmEtapasPickerExpanded = true;
                syncChatFilterCrmUi();
                void (async () => {
                    await loadChatFilterEtapasUiForSelectedQuadro();
                    refreshChatFilterSectionSummaries();
                    applyChatConversationFilters();
                })();
                return;
            }
            if (t && t.classList.contains('chat-filter-etapa-cb')) {
                const n = document.querySelectorAll('.chat-filter-etapa-cb:checked').length;
                chatFilterCrmEtapasPickerExpanded = n === 0;
                syncChatFilterCrmUi();
                refreshChatFilterSectionSummaries();
                applyChatConversationFilters();
                return;
            }
            if (t && (t.classList.contains('chat-filter-etiqueta-cb') || t.classList.contains('chat-filter-conexao-cb'))) {
                refreshChatFilterSectionSummaries();
                applyChatConversationFilters();
                return;
            }
            if (t && t.name === 'chatEtiquetaMode') {
                refreshChatFilterSectionSummaries();
                applyChatConversationFilters();
            }
        });

        document.getElementById('conversationsFiltersPanel')?.addEventListener('input', function(ev) {
            if (ev.target && ev.target.id === 'chatFilterEtiquetasSearch') {
                applyChatFilterEtiquetasSearchFilter();
            }
            if (ev.target && ev.target.id === 'chatFilterConexoesSearch') {
                applyChatFilterConexoesSearchFilter();
            }
        });

        // Buscar conversas: filtro imediato na lista visível + recarrega do servidor (contagens nas abas e página alinhadas à busca)
        document.getElementById('searchInput')?.addEventListener('input', function() {
            applyConversationsSearchFilter();
            updateConversationsFilterToggleActive();
            if (conversationsSearchReloadTimer) clearTimeout(conversationsSearchReloadTimer);
            conversationsSearchReloadTimer = setTimeout(function() {
                conversationsSearchReloadTimer = null;
                if (!currentUserId) return;
                conversationsPaginationState.offset = 0;
                conversationsPaginationState.hasMore = true;
                loadConversations(currentConversationsStatusFilter, false);
            }, 350);
        });

        document.getElementById('newConvContactSearch')?.addEventListener('input', function() {
            renderNewConvContactsList(this.value);
        });

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

        // Mobile Menu Functions
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('mobile-open')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }

        function openMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Expor funções no escopo global para onclick do menu (o mais cedo possível)
        window.navigateToPage = navigateToPage;
        window.logout = logout;
        window.toggleMobileMenu = toggleMobileMenu;
        window.closeMobileMenu = closeMobileMenu;
        window.openMobileMenu = openMobileMenu;

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

        // Dark Mode
        function initDarkMode() {
            const darkMode = getCookie('darkMode');
            const isDarkMode = darkMode === 'true';
            applyTheme(isDarkMode);
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

        // ============================================
        // FUNÇÕES PARA USAR COM SUPABASE REAL
        // ============================================
        // ============================================
        // FUNÇÕES PARA INTEGRAÇÃO COM SUPABASE REAL
        // ============================================

        function getConexaoDisplayName(conv) {
            const cx = conv.SAAS_Conexões;
            if (cx && (cx.NomeConexao || cx.Telefone)) return (cx.NomeConexao || cx.Telefone || '').trim() || '—';
            const id = conv.idConexao;
            if (id && userConnectionsCache.length) {
                const c = userConnectionsCache.find(x => x.id === id);
                if (c) return (c.NomeConexao || c.Telefone || '').trim() || '—';
            }
            return '—';
        }

        /** Nome do agente IA vinculado à conexão (embed Supabase). */
        function getAgenteIaNomeFromConv(conv) {
            const cx = conv.SAAS_Conexões;
            if (!cx) return '';
            const ag = cx.SAAS_AgentesIA;
            const row = Array.isArray(ag) ? ag[0] : ag;
            if (!row || row.nome == null) return '';
            const n = String(row.nome).trim();
            return n || '';
        }

        /**
         * Aba IA: conversas em aguardamento com pausado false/null, conexão com idAgente
         * e agente vinculado com ativo === true. Demais "aguardando" ficam na aba Aguardando.
         */
        function isConversaIaTabLista(conv) {
            const st = (conv.statusAtendimento || '').trim().toLowerCase();
            if (st !== 'aguardando') return false;
            if (conv.pausado === true) return false;
            const cx = conv.SAAS_Conexões;
            const idAg = cx && cx.idAgente != null && cx.idAgente !== '' ? cx.idAgente : null;
            if (idAg == null) return false;
            const ag = cx.SAAS_AgentesIA;
            const row = Array.isArray(ag) ? ag[0] : ag;
            return !!(row && row.ativo === true);
        }

        /**
         * Ordena conversas pela data real da última mensagem (mais recente primeiro).
         * Usa ultimaMensagemMap quando existir, senão conv.ultimaMensagem ou conv.created_at.
         */
        function sortConversationsByLastMessage(data, ultimaMensagemMap) {
            if (!data || data.length === 0) return data;
            const map = ultimaMensagemMap || {};
            return data.slice().sort((a, b) => {
                const idA = parseInt(a.id);
                const idB = parseInt(b.id);
                const timeA = new Date(map[idA]?.data || a.ultimaMensagem || a.created_at || 0).getTime();
                const timeB = new Date(map[idB]?.data || b.ultimaMensagem || b.created_at || 0).getTime();
                return timeB - timeA;
            });
        }

        /** Nome na lista: SAAS_Contatos.nome; se vazio, telefone formatado. */
        function getConversationDisplayName(conv) {
            const raw = conv.contato && conv.contato.nome != null ? String(conv.contato.nome).trim() : '';
            if (raw) return raw;
            if (conv.telefone) {
                const t = cleanPhoneNumber(conv.telefone);
                if (t && String(t).trim()) return t;
            }
            return 'Sem nome';
        }

        function escapeDataAttr(s) {
            return String(s ?? '')
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/</g, '&lt;');
        }

        const CHAT_HEADER_META_EXPANDED_LS = 'saas_chat_header_meta_expanded';

        function isChatHeaderMetaExpandedPreferred() {
            const v = localStorage.getItem(CHAT_HEADER_META_EXPANDED_LS);
            if (v === null) return false;
            return v === '1';
        }

        async function fetchContatoIdsWithEtiquetasForList(contaId, conversations) {
            if (!contaId || !conversations || !conversations.length) return new Set();
            const ids = [...new Set(conversations.map(c => c.contatoId).filter(id => id != null).map(Number).filter(n => !Number.isNaN(n)))];
            if (!ids.length) return new Set();
            const { data, error } = await supabase
                .from('SAAS_Contatos_Etiquetas')
                .select('contatoId')
                .eq('contaId', contaId)
                .in('contatoId', ids);
            if (error || !data) return new Set();
            return new Set(data.map(r => String(r.contatoId)));
        }

        async function fetchContatoEtiquetasPreviewMapForList(contaId, conversations) {
            const res = { idsSet: new Set(), byContatoId: new Map() };
            if (!contaId || !conversations || !conversations.length) return res;
            const contatoIds = [...new Set(conversations.map(c => c.contatoId).filter(id => id != null).map(Number).filter(n => !Number.isNaN(n)))];
            if (!contatoIds.length) return res;
            const { data: links, error: linksErr } = await supabase
                .from('SAAS_Contatos_Etiquetas')
                .select('contatoId, etiquetaId')
                .eq('contaId', contaId)
                .in('contatoId', contatoIds);
            if (linksErr || !links || !links.length) return res;
            const etiquetaIds = [...new Set(links.map(r => Number(r.etiquetaId)).filter(n => !Number.isNaN(n)))];
            const etiquetaById = new Map();
            if (etiquetaIds.length) {
                const { data: etqs } = await supabase
                    .from('SAAS_Etiquetas')
                    .select('id, nome, cor')
                    .eq('contaId', contaId)
                    .in('id', etiquetaIds);
                (etqs || []).forEach(e => {
                    etiquetaById.set(String(e.id), {
                        nome: String(e.nome || 'Sem nome'),
                        cor: /^#[0-9a-fA-F]{6}$/i.test(String(e.cor || '').trim()) ? String(e.cor).trim() : '#6b7280'
                    });
                });
            }
            links.forEach(link => {
                const cid = String(link.contatoId);
                const etq = etiquetaById.get(String(link.etiquetaId));
                if (!etq) return;
                res.idsSet.add(cid);
                if (!res.byContatoId.has(cid)) res.byContatoId.set(cid, []);
                res.byContatoId.get(cid).push(etq);
            });
            return res;
        }

        async function fetchContatoCrmPreviewMapForList(contaId, conversations) {
            const res = { idsSet: new Set(), byContatoId: new Map() };
            if (!contaId || !conversations || !conversations.length) return res;
            const contatoIds = [...new Set(conversations.map(c => c.contatoId).filter(id => id != null).map(Number).filter(n => !Number.isNaN(n)))];
            if (!contatoIds.length) return res;
            const { data: cards, error } = await supabase
                .from('SAAS_Cards_Quadros')
                .select('id, contatoId, quadroId, etapaQuadroId')
                .in('contatoId', contatoIds);
            if (error || !cards || !cards.length) return res;
            const qIds = [...new Set(cards.map(c => Number(c.quadroId)).filter(n => !Number.isNaN(n)))];
            const eIds = [...new Set(cards.map(c => Number(c.etapaQuadroId)).filter(n => !Number.isNaN(n)))];
            const qMap = new Map();
            const eMap = new Map();
            if (qIds.length) {
                const { data: qs } = await supabase.from('SAAS_Quadros').select('id, nome').in('id', qIds);
                (qs || []).forEach(q => qMap.set(String(q.id), String(q.nome || ('Quadro ' + q.id))));
            }
            if (eIds.length) {
                const { data: es } = await supabase.from('SAAS_Etapas_Quadros').select('id, nome').in('id', eIds);
                (es || []).forEach(e => eMap.set(String(e.id), String(e.nome || ('Etapa ' + e.id))));
            }
            cards.forEach(card => {
                const cid = String(card.contatoId);
                const qn = qMap.get(String(card.quadroId)) || 'Quadro';
                const en = eMap.get(String(card.etapaQuadroId)) || 'Etapa';
                res.idsSet.add(cid);
                if (!res.byContatoId.has(cid)) res.byContatoId.set(cid, []);
                res.byContatoId.get(cid).push({ quadroNome: qn, etapaNome: en });
            });
            return res;
        }

        function buildChatHeaderMetaOuterHtml(bundle, crmCards) {
            const linkedIds = bundle.linkedIds;
            const linked = (bundle.all || []).filter(e => linkedIds.has(String(e.id)));
            const crm = crmCards || [];
            if (!linked.length && !crm.length) return '';
            const expanded = isChatHeaderMetaExpandedPreferred();
            const maxTagsCollapsed = 5;
            const maxCrmCollapsed = 2;
            const hasTagsOverflow = linked.length > maxTagsCollapsed;
            const hasCrmOverflow = crm.length > maxCrmCollapsed;
            const hasOverflow = hasTagsOverflow || hasCrmOverflow;
            const visibleTags = expanded ? linked : linked.slice(0, maxTagsCollapsed);
            const visibleCrm = expanded ? crm : crm.slice(0, maxCrmCollapsed);

            const chips = visibleTags.map(e => {
                const eidNum = Number(e.id);
                if (!Number.isFinite(eidNum)) return '';
                const corRaw = (e.cor && String(e.cor).trim()) || '#6b7280';
                const safeCor = /^#[0-9a-fA-F]{6}$/i.test(corRaw) ? corRaw : '#6b7280';
                return '<span class="chat-header-mini-chip" style="--tag-color:' + escapeHtml(safeCor) + ';"><span class="chat-header-mini-chip-dot"></span>' + escapeHtml(e.nome || 'Sem nome') + '</span>';
            }).filter(Boolean).join('');
            const crmBtns = visibleCrm.map(card => {
                const qid = Number(card.quadroId);
                const cid = Number(card.id);
                if (!Number.isFinite(qid) || !Number.isFinite(cid)) return '';
                const label = escapeHtml(card.quadroNome || 'Quadro') + ' - ' + escapeHtml(card.etapaNome || 'Etapa');
                return '<button type="button" class="chat-header-crm-pill" onclick="event.stopPropagation();window.openCrmCardFromContactDetails(' + qid + ',' + cid + ')">' + label + '</button>';
            }).filter(Boolean).join('');
            const tagsMoreCount = Math.max(0, linked.length - visibleTags.length);
            const crmMoreCount = Math.max(0, crm.length - visibleCrm.length);
            const tagsMoreHtml = tagsMoreCount > 0 ? '<span class="chat-header-meta-more-pill">+' + tagsMoreCount + '</span>' : '';
            const crmMoreHtml = crmMoreCount > 0 ? '<span class="chat-header-meta-more-pill">+' + crmMoreCount + '</span>' : '';
            const toggleBtnHtml = hasOverflow
                ? '<button type="button" class="chat-header-meta-toggle-btn' + (expanded ? ' is-open' : '') + '" id="chatHeaderMetaToggleBtn" onclick="event.stopPropagation();window.toggleChatHeaderMetaExpanded(event)" aria-expanded="' + (expanded ? 'true' : 'false') + '" aria-label="' + (expanded ? 'Recolher etiquetas e CRM' : 'Expandir etiquetas e CRM') + '" title="' + (expanded ? 'Recolher' : 'Expandir') + '"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></button>'
                : '';
            return '<div class="chat-header-meta-outer" id="chatHeaderMetaOuter" onclick="window.openChatHeaderContactDetails(event)">' +
                '<div class="chat-header-meta-toolbar">' +
                toggleBtnHtml +
                '</div>' +
                '<div class="chat-header-meta-body" id="chatHeaderMetaBody">' +
                (linked.length ? '<div class="chat-header-meta-section"><span class="chat-header-meta-section-label">Etiquetas:</span><div class="chat-header-meta-section-content chat-header-meta-chips">' + chips + tagsMoreHtml + '</div></div>' : '') +
                (crm.length ? '<div class="chat-header-meta-section"><span class="chat-header-meta-section-label">CRM:</span><div class="chat-header-meta-section-content chat-header-meta-crm">' + crmBtns + crmMoreHtml + '</div></div>' : '') +
                '</div></div>';
        }

        async function refreshChatHeaderMetaIfPresent() {
            const stack = document.querySelector('#chatArea .chat-header-stack');
            const outer = document.getElementById('chatHeaderMetaOuter');
            if (!stack) return;
            const cid = currentConversationContatoId;
            const contaId = currentUserId;
            if (!cid || !contaId) {
                if (outer) outer.remove();
                return;
            }
            try {
                const [bundle, crmCards] = await Promise.all([
                    fetchChatContactEtiquetasBundle(cid, contaId),
                    fetchCrmCardsForChatContactDetails(cid)
                ]);
                const html = buildChatHeaderMetaOuterHtml(bundle, crmCards);
                if (html) {
                    if (outer) {
                        outer.outerHTML = html;
                    } else {
                        stack.insertAdjacentHTML('beforeend', html);
                    }
                } else if (outer) {
                    outer.remove();
                }
            } catch (e) {
                console.warn('Atualizar meta do cabeçalho:', e);
            }
        }

        function toggleChatHeaderMetaExpanded(ev) {
            if (ev) ev.stopPropagation();
            const body = document.getElementById('chatHeaderMetaBody');
            const btn = document.getElementById('chatHeaderMetaToggleBtn');
            if (!body || !btn) return;
            const opening = btn.getAttribute('aria-expanded') !== 'true';
            if (opening) {
                btn.classList.add('is-open');
                btn.setAttribute('aria-expanded', 'true');
                btn.setAttribute('aria-label', 'Recolher etiquetas e CRM');
                btn.setAttribute('title', 'Recolher');
                localStorage.setItem(CHAT_HEADER_META_EXPANDED_LS, '1');
            } else {
                btn.classList.remove('is-open');
                btn.setAttribute('aria-expanded', 'false');
                btn.setAttribute('aria-label', 'Expandir etiquetas e CRM');
                btn.setAttribute('title', 'Expandir');
                localStorage.setItem(CHAT_HEADER_META_EXPANDED_LS, '0');
            }
            void refreshChatHeaderMetaIfPresent();
        }

        async function openChatHeaderContactDetails(ev) {
            if (ev) {
                const t = ev.target;
                if (t.closest && t.closest('.chat-header-avatar-add-btn')) return;
                if (t.closest && t.closest('button')) return;
            }
            await toggleContactDetailsDropdown(ev || null, null);
        }

        async function openConversationContactDetailsFromList(ev) {
            if (!ev) return;
            ev.stopPropagation();
            ev.preventDefault();
            const icon = ev.currentTarget;
            const item = icon && icon.closest ? icon.closest('.conversation-item') : null;
            if (!item) return;
            const convId = item.getAttribute('data-conversation-id');
            if (!convId) return;
            let displayName = 'Sem nome';
            const enc = item.getAttribute('data-conv-display');
            if (enc) {
                try {
                    displayName = decodeURIComponent(enc);
                } catch (e) {
                    displayName = enc;
                }
            }
            if (String(convId) !== String(currentConversationId || '')) {
                await selectConversation(String(convId), displayName);
            }
            await toggleContactDetailsDropdown(null, 'etiquetas');
        }

        function getConversationTagsTooltipEl() {
            let el = document.getElementById('conversationTagsHoverTooltip');
            if (el) return el;
            el = document.createElement('div');
            el.id = 'conversationTagsHoverTooltip';
            el.className = 'conversation-tags-hover-tooltip';
            document.body.appendChild(el);
            return el;
        }

        function moveConversationTagsPreview(ev) {
            const el = document.getElementById('conversationTagsHoverTooltip');
            if (!el || !ev) return;
            const x = Math.min(window.innerWidth - el.offsetWidth - 10, ev.clientX + 12);
            const y = Math.min(window.innerHeight - el.offsetHeight - 10, ev.clientY + 12);
            el.style.left = Math.max(10, x) + 'px';
            el.style.top = Math.max(10, y) + 'px';
        }

        function showConversationTagsPreview(ev) {
            const btn = ev && ev.currentTarget;
            if (!btn) return;
            const raw = btn.getAttribute('data-tags-preview') || '';
            if (!raw) return;
            let arr = [];
            try {
                arr = JSON.parse(decodeURIComponent(raw));
            } catch (_) {
                arr = [];
            }
            if (!Array.isArray(arr) || !arr.length) return;
            const html = arr.slice(0, 8).map(t => {
                const nome = escapeHtml(String((t && t.nome) || 'Etiqueta'));
                const cor = /^#[0-9a-fA-F]{6}$/i.test(String((t && t.cor) || '').trim()) ? String(t.cor).trim() : '#6b7280';
                return '<span class="conversation-tags-hover-chip"><span class="conversation-tags-hover-chip-dot" style="background:' + escapeHtml(cor) + '"></span>' + nome + '</span>';
            }).join('');
            const tooltip = getConversationTagsTooltipEl();
            tooltip.innerHTML = html;
            tooltip.classList.add('show');
            moveConversationTagsPreview(ev);
        }

        function hideConversationTagsPreview() {
            const el = document.getElementById('conversationTagsHoverTooltip');
            if (!el) return;
            el.classList.remove('show');
            el.innerHTML = '';
        }

        function getConversationCrmTooltipEl() {
            let el = document.getElementById('conversationCrmHoverTooltip');
            if (el) return el;
            el = document.createElement('div');
            el.id = 'conversationCrmHoverTooltip';
            el.className = 'conversation-crm-hover-tooltip';
            document.body.appendChild(el);
            return el;
        }

        function moveConversationCrmPreview(ev) {
            const el = document.getElementById('conversationCrmHoverTooltip');
            if (!el || !ev) return;
            const x = Math.min(window.innerWidth - el.offsetWidth - 10, ev.clientX + 12);
            const y = Math.min(window.innerHeight - el.offsetHeight - 10, ev.clientY + 12);
            el.style.left = Math.max(10, x) + 'px';
            el.style.top = Math.max(10, y) + 'px';
        }

        function showConversationCrmPreview(ev) {
            const btn = ev && ev.currentTarget;
            if (!btn) return;
            const raw = btn.getAttribute('data-crm-preview') || '';
            if (!raw) return;
            let arr = [];
            try {
                arr = JSON.parse(decodeURIComponent(raw));
            } catch (_) {
                arr = [];
            }
            if (!Array.isArray(arr) || !arr.length) return;
            const html = arr.slice(0, 8).map(c => {
                const q = escapeHtml(String((c && c.quadroNome) || 'CRM'));
                const e = escapeHtml(String((c && c.etapaNome) || 'Etapa'));
                return '<span class="conversation-crm-hover-item">' + q + ' - ' + e + '</span>';
            }).join('');
            const tooltip = getConversationCrmTooltipEl();
            tooltip.innerHTML = html;
            tooltip.classList.add('show');
            moveConversationCrmPreview(ev);
        }

        function hideConversationCrmPreview() {
            const el = document.getElementById('conversationCrmHoverTooltip');
            if (!el) return;
            el.classList.remove('show');
            el.innerHTML = '';
        }

        /** Texto em minúsculas para busca por nome (nome exibido, nome no contato, telefone bruto/formatado). */
        function getConversationSearchNamesLower(conv, displayName) {
            const parts = new Set();
            if (displayName && String(displayName).trim()) parts.add(String(displayName).trim().toLowerCase());
            const cn = conv.contato && conv.contato.nome != null ? String(conv.contato.nome).trim() : '';
            if (cn) parts.add(cn.toLowerCase());
            if (conv.telefone) {
                parts.add(String(conv.telefone).toLowerCase());
                const cleaned = cleanPhoneNumber(conv.telefone);
                if (cleaned && String(cleaned).trim()) parts.add(String(cleaned).trim().toLowerCase());
            }
            return Array.from(parts).filter(Boolean).join(' ');
        }

        function getConversationTelefoneDigits(conv) {
            return (conv.telefone || '').replace(/\D/g, '');
        }

        /**
         * Aplica o texto do campo "Buscar conversas" à lista atual (nome ou telefone).
         * Deve ser chamada após trocar aba (status) ou re-renderizar a lista.
         */
        function applyConversationsSearchFilter() {
            const input = document.getElementById('searchInput');
            const raw = (input && input.value) ? input.value.trim() : '';
            const term = raw.toLowerCase();
            const termDigits = raw.replace(/\D/g, '');
            const items = document.querySelectorAll('#conversationsScroll .conversation-item');
            if (!items.length) return;
            items.forEach(item => {
                if (!term && !termDigits) {
                    item.style.removeProperty('display');
                    return;
                }
                const namesHaystack = (item.getAttribute('data-search-names') || '').toLowerCase();
                const phoneDigits = item.getAttribute('data-search-digits') || '';
                const nameHit = term.length > 0 && namesHaystack.includes(term);
                const phoneHit = termDigits.length > 0 && phoneDigits.includes(termDigits);
                item.style.display = nameHit || phoneHit ? 'flex' : 'none';
            });
        }
        window.applyConversationsSearchFilter = applyConversationsSearchFilter;

        /** Renderiza HTML de um item de conversa (design gemini) */
        function renderConversationItemHtml(conv, ultimaMensagemMap, contatoIdsWithEtiquetas, etiquetasPreviewMap, contatoIdsWithCrm, crmPreviewMap, options) {
            const showAgenteIaTag = options && options.showAgenteIaTag === true;
            const tagSet = contatoIdsWithEtiquetas instanceof Set ? contatoIdsWithEtiquetas : null;
            const previewMap = etiquetasPreviewMap instanceof Map ? etiquetasPreviewMap : null;
            const crmSet = contatoIdsWithCrm instanceof Set ? contatoIdsWithCrm : null;
            const crmMap = crmPreviewMap instanceof Map ? crmPreviewMap : null;
            const convId = parseInt(conv.id);
            const displayName = getConversationDisplayName(conv);
            const conexaoLabel = getConexaoDisplayName(conv);
            const ultimaMsg = ultimaMensagemMap[convId];
            const lastMessageTime = ultimaMsg?.data || conv.ultimaMensagem || conv.created_at;
            const previewText = getConversationPreviewText(ultimaMsg?.texto || '', ultimaMsg?.tipoMensagem);
            const unreadCount = conv.lida === false ? 1 : 0;
            const fotoPerfil = conv.fotoPerfil || null;
            const avatarContent = fotoPerfil
                ? `<img src="${escapeHtml(fotoPerfil)}" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`
                : getInitials(displayName);
            const avatarHtml = `<div class="conversation-avatar-wrap"><div class="conversation-avatar">${avatarContent}</div></div>`;
            const timeStr = formatTime(lastMessageTime);
            const unreadHtml = unreadCount > 0 ? `<span class="conversation-unread">${unreadCount}</span>` : '';
            const atendNomeRaw = (conv.atendente_usuario && conv.atendente_usuario.nome != null)
                ? String(conv.atendente_usuario.nome).trim()
                : '';
            const atendTooltipNome = atendNomeRaw || 'Atendente atribuído';
            const atendenteIconHtml = conv.atendente
                ? `<span class="conversation-atendente-icon" data-atendente-nome="${escapeDataAttr(atendTooltipNome)}" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>`
                : '';
            const contatoIdStr = conv.contatoId != null ? String(conv.contatoId) : '';
            const showTagIcon = !!(tagSet && contatoIdStr && tagSet.has(contatoIdStr));
            const previewTags = (previewMap && contatoIdStr && previewMap.get(contatoIdStr)) || [];
            const previewEnc = previewTags.length ? escapeDataAttr(encodeURIComponent(JSON.stringify(previewTags))) : '';
            const showCrmIcon = !!(crmSet && contatoIdStr && crmSet.has(contatoIdStr));
            const previewCrm = (crmMap && contatoIdStr && crmMap.get(contatoIdStr)) || [];
            const crmPreviewEnc = previewCrm.length ? escapeDataAttr(encodeURIComponent(JSON.stringify(previewCrm))) : '';
            const tagsIconHtml = showTagIcon
                ? `<button type="button" class="conversation-tags-icon" data-tags-preview="${previewEnc}" title="Etiquetas" aria-label="Ver etiquetas do contato" onmouseenter="window.showConversationTagsPreview(event)" onmousemove="window.moveConversationTagsPreview(event)" onmouseleave="window.hideConversationTagsPreview()" onclick="window.openConversationContactDetailsFromList(event)"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg></button>`
                : '';
            const crmIconHtml = showCrmIcon
                ? `<button type="button" class="conversation-crm-icon" data-crm-preview="${crmPreviewEnc}" title="CRM vinculado" aria-label="Ver CRM do contato" onmouseenter="window.showConversationCrmPreview(event)" onmousemove="window.moveConversationCrmPreview(event)" onmouseleave="window.hideConversationCrmPreview()" onclick="window.openConversationContactDetailsFromList(event)"><span class="material-symbols-rounded" aria-hidden="true">view_kanban</span></button>`
                : '';
            const timeSrc = escapeDataAttr(lastMessageTime || '');
            const agenteIaNome = showAgenteIaTag ? getAgenteIaNomeFromConv(conv) : '';
            const agenteIaTagHtml = agenteIaNome
                ? `<span class="conversation-agente-ia-tag" title="${escapeDataAttr(agenteIaNome)}">${escapeHtml(agenteIaNome)}</span>`
                : (showAgenteIaTag ? `<span class="conversation-agente-ia-tag" title="Agente IA">IA</span>` : '');
            const nameRow = `<div class="conversation-name-row"><span class="conversation-name-block"><span class="conversation-name">${escapeHtml(displayName)}</span>${atendenteIconHtml}${tagsIconHtml}${crmIconHtml}</span>${agenteIaTagHtml}<span class="conversation-conexao-tag">${escapeHtml(conexaoLabel)}</span><span class="conversation-time" data-time-source="${timeSrc}">${timeStr}</span></div>`;
            const previewRow = `<div class="conversation-preview-row"><span class="conversation-preview">${escapeHtml(previewText)}</span>${unreadHtml}</div>`;
            const infoHtml = `<div class="conversation-info">${nameRow}${previewRow}</div>`;
            const innerHtml = `${avatarHtml}${infoHtml}`;
            const searchNames = escapeDataAttr(getConversationSearchNamesLower(conv, displayName));
            const searchDigits = escapeDataAttr(getConversationTelefoneDigits(conv));
            const convDisplayEnc = encodeURIComponent(displayName);
            return `<div class="conversation-item" data-conversation-id="${conv.id}" data-conv-display="${escapeDataAttr(convDisplayEnc)}" data-search-names="${searchNames}" data-search-digits="${searchDigits}" onclick="selectConversation('${conv.id}', '${displayName.replace(/'/g, "\\'")}')"><div class="conversation-item-inner">${innerHtml}</div></div>`;
        }

        /** Carrega mais 20 conversas ao rolar para o final da lista */
        function loadMoreConversations() {
            loadConversations(currentConversationsStatusFilter, true);
        }

        /** Anexa listener de scroll para carregar mais conversas ao rolar para o final */
        function attachConversationsScrollListener() {
            const scrollEl = document.getElementById('conversationsScroll');
            if (!scrollEl || conversationsPaginationState.scrollListenerAttached) return;
            conversationsPaginationState.scrollListenerAttached = true;
            let throttle = null;
            scrollEl.addEventListener('scroll', function() {
                if (throttle) return;
                throttle = setTimeout(() => { throttle = null; }, 150);
                if (scrollEl.scrollHeight - scrollEl.scrollTop - scrollEl.clientHeight < 80) loadMoreConversations();
            });
        }

        /** Carrega conexões do usuário e preenche o multiselect de filtro (checkboxes). */
        async function loadUserConnections() {
            if (!currentUserId) return;
            try {
                const { data, error } = await supabase
                    .from('SAAS_Conexões')
                    .select('id, NomeConexao, Telefone')
                    .eq('contaId', currentUserId)
                    .order('NomeConexao', { ascending: true });
                if (error) {
                    console.warn('Erro ao carregar conexões:', error);
                    return;
                }
                userConnectionsCache = data || [];
                const wrap = document.getElementById('conexaoFilterList');
                if (!wrap) return;
                const selectedSet = new Set((currentConversationsConexaoIds || []).map(Number));
                if (!userConnectionsCache.length) {
                    wrap.innerHTML = '<span class="chat-filter-hint">Nenhuma conexão</span>';
                    setChatFilterConexoesSearchUiVisible(false);
                    refreshChatFilterSectionSummaries();
                    return;
                }
                wrap.innerHTML = userConnectionsCache.map(c => {
                    const name = (c.NomeConexao || c.instanceName || 'Conexão ' + c.id) || ('Conexão ' + c.id);
                    const checked = selectedSet.has(Number(c.id)) ? ' checked' : '';
                    return `<label class="chat-filter-conexao-label"><input type="checkbox" class="chat-filter-conexao-cb" value="${c.id}"${checked}>${escapeHtml(name)}</label>`;
                }).join('');
                setChatFilterConexoesSearchUiVisible(userConnectionsCache.length > 8);
                applyChatFilterConexoesSearchFilter();
                refreshChatFilterSectionSummaries();
            } catch (e) {
                console.warn('Erro ao carregar conexões:', e);
            }
        }

        /**
         * Renderiza a lista de conversas a partir do cache do status (troca instantânea ao clicar na aba).
         * Só usa cache quando não há filtro de conexão nem filtros avançados (etiquetas/CRM).
         * @param {string} filter - 'aberto' | 'aguardando' | 'fechado'
         * @returns {boolean} true se exibiu do cache; false se não havia cache ou filtros ativos invalidam o cache
         */
        async function renderConversationsFromCache(filter) {
            if (shouldSkipConversationCache()) return false;
            const cache = conversationsCacheByStatus[filter];
            if (cache == null) return false;
            const scrollEl = document.getElementById('conversationsScroll');
            const loadingEl = document.getElementById('conversationsLoading');
            if (!scrollEl) return false;
            if (loadingEl) loadingEl.style.display = 'none';
            conversationsPaginationState.offset = cache.offset;
            conversationsPaginationState.hasMore = cache.hasMore;
            if (cache.data.length === 0) {
                const msg = filter === 'aberto' ? 'Nenhuma conversa aberta' : filter === 'aguardando' ? 'Nenhuma conversa aguardando' : filter === 'agente-ia' ? 'Nenhuma conversa nesta fila de IA' : 'Nenhuma conversa fechada';
                scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #888;">' + msg + '</div>';
            } else {
                const sorted = sortConversationsByLastMessage(cache.data, cache.ultimaMensagemMap || {});
                const [tagPreview, crmPreview] = currentUserId
                    ? await Promise.all([
                        fetchContatoEtiquetasPreviewMapForList(currentUserId, sorted),
                        fetchContatoCrmPreviewMapForList(currentUserId, sorted)
                    ])
                    : [{ idsSet: new Set(), byContatoId: new Map() }, { idsSet: new Set(), byContatoId: new Map() }];
                const listOpts = filter === 'agente-ia' ? { showAgenteIaTag: true } : undefined;
                const html = sorted.map(conv => renderConversationItemHtml(conv, cache.ultimaMensagemMap || {}, tagPreview.idsSet, tagPreview.byContatoId, crmPreview.idsSet, crmPreview.byContatoId, listOpts)).join('');
                scrollEl.innerHTML = html;
                refreshConversationTimeBadges();
                ensureConversationTimeAutoRefresh();
            }
            applyConversationsSearchFilter();
            return true;
        }

        /** Troca o filtro de status e recarrega a lista (chamado pelos 3 botões). Mostra cache na hora e busca em background para atualizar. */
        function setConversationsStatusFilter(status) {
            const s = normalizeStatusAtendimento(status);
            currentConversationsStatusFilter = s;
            document.querySelectorAll('.conversations-status-filters .status-filter-btn').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-status') === s);
            });
            const scrollEl = document.getElementById('conversationsScroll');
            const loadingEl = document.getElementById('conversationsLoading');
            void (async () => {
                const hadCache = await renderConversationsFromCache(s);
                if (!hadCache && scrollEl && loadingEl) {
                    loadingEl.style.display = 'flex';
                }
                loadConversations(s, false);
            })();
        }

        /** Chave sessionStorage: abrir conversa após carregar o chat (mesmo fluxo que clicar na lista). */
        const CHAT_PENDING_SELECT_CONVERSA_KEY = 'saas_chat_pending_select_conversa_id';

        /**
         * Mesmo fluxo de quando o usuário clica em um item da lista: filtro de status, loadConversations, selectConversation.
         * @param {number} conversaIdNum
         */
        async function openConversaSameAsListSelection(conversaIdNum) {
            if (!currentUserId || conversaIdNum == null || isNaN(conversaIdNum)) return;
            const { data: conv, error } = await supabase
                .from('SAAS_Conversas_Agentes')
                .select('id, statusAtendimento, contaId, pausado, SAAS_Conexões!idConexao(idAgente, SAAS_AgentesIA!idAgente(pausarAtendimento, ativo))')
                .eq('id', conversaIdNum)
                .maybeSingle();
            if (error || !conv) {
                console.warn('openConversaSameAsListSelection: conversa nao encontrada', error);
                return;
            }
            if (String(conv.contaId) !== String(currentUserId)) {
                console.warn('openConversaSameAsListSelection: conversa nao pertence a esta conta');
                return;
            }
            const stNorm = normalizeStatusAtendimento(conv.statusAtendimento);
            const s = (stNorm === 'aguardando' && isConversaIaTabLista(conv)) ? 'agente-ia' : stNorm;
            currentConversationsStatusFilter = s;
            document.querySelectorAll('.conversations-status-filters .status-filter-btn').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-status') === s);
            });
            await loadConversations(s, false);
            await selectConversation(String(conversaIdNum), 'Contato');
        }

        /**
         * CRM / outras páginas: define sessionStorage e abre o chat sem query string; aqui aplica a seleção como na lista.
         */
        async function applyPendingConversaFromSessionStorage() {
            const raw = sessionStorage.getItem(CHAT_PENDING_SELECT_CONVERSA_KEY);
            if (raw == null || raw === '') return;
            const conversaIdNum = parseInt(raw, 10);
            try {
                if (!isNaN(conversaIdNum) && currentUserId) {
                    await openConversaSameAsListSelection(conversaIdNum);
                }
            } catch (e) {
                console.warn('Pending conversa (sessionStorage):', e);
            } finally {
                sessionStorage.removeItem(CHAT_PENDING_SELECT_CONVERSA_KEY);
            }
        }

        /**
         * Abre conversa a partir da URL (?conversa= ou ?conversaId=), ex.: vindo da pagina de contatos.
         */
        async function applyDeepLinkedConversation() {
            const params = new URLSearchParams(window.location.search || '');
            const raw = params.get('conversa') || params.get('conversaId');
            if (!raw) return;
            const conversaIdNum = parseInt(raw, 10);
            if (isNaN(conversaIdNum)) return;
            if (!currentUserId) return;

            try {
                await openConversaSameAsListSelection(conversaIdNum);
                const url = new URL(window.location.href);
                url.searchParams.delete('conversa');
                url.searchParams.delete('conversaId');
                const clean = url.pathname + (url.search || '') + (url.hash || '');
                window.history.replaceState({}, '', clean);
            } catch (e) {
                console.warn('Deep link conversa:', e);
            }
        }

        function getConversationSearchRawTerm() {
            const input = document.getElementById('searchInput');
            const raw = (input && input.value) ? String(input.value).trim() : '';
            return raw || null;
        }

        function setConversationStatusCounts(counts) {
            const safe = counts || {};
            const setCount = (status, n) => {
                const el = document.querySelector(`.status-count[data-status="${status}"]`);
                if (el) el.textContent = typeof n === 'number' ? String(n) : '—';
            };
            setCount('aberto', Number(safe.aberto || 0));
            setCount('aguardando', Number(safe.aguardando || 0));
            setCount('fechado', Number(safe.fechado || 0));
            setCount('agente-ia', Number(safe.agente_ia || safe.agenteIa || 0));
        }

        async function fetchChatOverviewRpc(params) {
            const { data, error } = await supabase.rpc('get_chat_overview', params);
            if (error) throw error;
            if (!data || typeof data !== 'object') return null;
            return data;
        }

        /**
         * Busca contagem por aba (Aberto, Aguardando, Fechado, IA).
         * IA = aguardando + pausado false/null + (conexão sem agente OU agente com pausarAtendimento).
         * Aguardando exclui essas conversas (ficam só na aba IA).
         */
        async function fetchConversationCountsByStatus() {
            if (!currentUserId) return;
            const contaId = currentUserId;
            let contatoIds = null;
            let searchOr = null;
            try {
                const f = await resolveConversationListFilters();
                if (f.contatoIds !== null && f.contatoIds.length === 0) {
                    document.querySelectorAll('.status-count[data-status]').forEach(el => { el.textContent = '0'; });
                    return;
                }
                contatoIds = f.contatoIds;
                searchOr = f.searchOr;
            } catch (e) {
                console.warn('Erro ao resolver contatos para contagem:', e);
                return;
            }
            const searchRaw = getConversationSearchRawTerm();
            try {
                const rpcData = await fetchChatOverviewRpc({
                    p_conta_id: contaId,
                    p_status: currentConversationsStatusFilter || 'aberto',
                    p_limit: 1,
                    p_offset: 0,
                    p_conexao_ids: (currentConversationsConexaoIds && currentConversationsConexaoIds.length > 0) ? currentConversationsConexaoIds : null,
                    p_contato_ids: (contatoIds && contatoIds.length > 0) ? contatoIds : null,
                    p_search: searchRaw
                });
                if (rpcData && rpcData.counts) {
                    setConversationStatusCounts(rpcData.counts);
                    return;
                }
            } catch (rpcErr) {
                // Fallback automático para o fluxo legado abaixo.
                console.warn('RPC get_chat_overview (counts) indisponível, usando fallback:', rpcErr);
            }
            const base = () => {
                let q = supabase
                    .from('SAAS_Conversas_Agentes')
                    .select('*', { count: 'exact', head: true })
                    .eq('contaId', contaId);
                q = applyConexaoIdsToConversationQuery(q);
                if (contatoIds && contatoIds.length > 0) {
                    q = q.in('contatoId', contatoIds);
                }
                if (searchOr) {
                    q = q.or(searchOr);
                }
                return q;
            };
            const applyIaCountFilters = (q) => {
                q = q
                    .eq('contaId', contaId)
                    .ilike('statusAtendimento', 'aguardando')
                    .or('pausado.is.null,pausado.eq.false');
                q = applyConexaoIdsToConversationQuery(q);
                if (contatoIds && contatoIds.length > 0) {
                    q = q.in('contatoId', contatoIds);
                }
                if (searchOr) {
                    q = q.or(searchOr);
                }
                return q;
            };
            const iaCountComAgenteAtivo = () => {
                let q = supabase
                    .from('SAAS_Conversas_Agentes')
                    .select('id, SAAS_Conexões!inner(idAgente, SAAS_AgentesIA!idAgente(ativo))', { count: 'exact', head: true });
                q = applyIaCountFilters(q);
                q = q.not('SAAS_Conexões.idAgente', 'is', null).eq('SAAS_AgentesIA.ativo', true);
                return q;
            };
            try {
                const [
                    abertoRes,
                    aguardandoRes,
                    fechadoRes,
                    iaAtivoRes
                ] = await Promise.all([
                    base().ilike('statusAtendimento', 'aberto'),
                    base().ilike('statusAtendimento', 'aguardando'),
                    base().ilike('statusAtendimento', 'fechado'),
                    iaCountComAgenteAtivo()
                ]);
                const setCount = (status, n) => {
                    const el = document.querySelector(`.status-count[data-status="${status}"]`);
                    if (el) el.textContent = typeof n === 'number' ? n : '—';
                };
                const agRaw = aguardandoRes.count ?? 0;
                const iaTotal = iaAtivoRes.count ?? 0;
                setCount('aberto', abertoRes.count ?? 0);
                setCount('aguardando', Math.max(0, agRaw - iaTotal));
                setCount('fechado', fechadoRes.count ?? 0);
                setCount('agente-ia', iaTotal);
            } catch (e) {
                console.warn('Erro ao buscar contagem por status:', e);
            }
        }

        function scheduleFetchConversationCountsByStatus(delayMs) {
            if (conversationCountsTimer) clearTimeout(conversationCountsTimer);
            conversationCountsTimer = setTimeout(async () => {
                if (conversationCountsRequestInFlight) return;
                const countKey = JSON.stringify({
                    user: currentUserId || null,
                    status: currentConversationsStatusFilter || null,
                    conexoes: Array.isArray(currentConversationsConexaoIds) ? currentConversationsConexaoIds.slice().sort((a, b) => a - b) : [],
                    etiquetas: Array.isArray(chatFilterEtiquetaIds) ? chatFilterEtiquetaIds.slice().sort((a, b) => a - b) : [],
                    etiquetaMode: chatFilterEtiquetaMode || 'or',
                    quadro: chatFilterQuadroId ?? null,
                    etapas: Array.isArray(chatFilterEtapaIds) ? chatFilterEtapaIds.slice().sort((a, b) => a - b) : [],
                    search: hasConversationsSearchFilter() ? ((document.getElementById('searchInput')?.value || '').trim().toLowerCase()) : ''
                });
                if (countKey === lastConversationCountsKey) return;
                conversationCountsRequestInFlight = true;
                try {
                    await fetchConversationCountsByStatus();
                    lastConversationCountsKey = countKey;
                } finally {
                    conversationCountsRequestInFlight = false;
                }
            }, Math.max(0, Number(delayMs) || 0));
        }

        /**
         * Carrega conversas do Supabase (filtro por status + paginação 20 por vez).
         * Atualiza o cache por status para troca instantânea entre abas. Com onlyCache só preenche cache, sem alterar a UI.
         * @param {string} [statusFilter] - 'aberto' | 'aguardando' | 'fechado' | 'agente-ia' (default: currentConversationsStatusFilter)
         * @param {boolean} [append] - true = carregar mais e anexar; false = substituir (default)
         * @param {Object} [options] - onlyCache: true = só buscar e guardar no cache (não atualiza lista na tela)
         */
        async function loadConversations(statusFilter, append, options) {
            const filter = statusFilter != null ? normalizeStatusAtendimento(statusFilter) : currentConversationsStatusFilter;
            const doAppend = append === true;
            const onlyCache = options && options.onlyCache === true;

            // Obter contaId da tabela SAAS_Usuarios (não o auth_user_id)
            let userIdFromTable;
            try {
                userIdFromTable = await getUserIdFromAuth();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return; // Já foi redirecionado
                }
                throw error;
            }
            if (!userIdFromTable) {
                console.error('❌ UserId não encontrado na tabela SAAS_Usuarios');
                if (!onlyCache) {
                    const scrollEl = document.getElementById('conversationsScroll');
                    const loadingEl = document.getElementById('conversationsLoading');
                    if (loadingEl) loadingEl.style.display = 'none';
                    if (scrollEl) scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #888;">Faça login para ver suas conversas</div>';
                }
                return;
            }
            
            currentUserId = userIdFromTable;

            let shouldRefreshCountsFallback = !doAppend && !onlyCache;

            const loadingEl = document.getElementById('conversationsLoading');
            const scrollEl = document.getElementById('conversationsScroll');

            if (!scrollEl && !onlyCache) {
                console.error('❌ Elemento conversationsScroll não encontrado');
                return;
            }

            if (onlyCache && shouldSkipConversationCache()) {
                return;
            }

            if (onlyCache) {
                // Prefetch: só preencher cache, offset 0
            } else if (doAppend) {
                if (conversationsPaginationState.isLoadingMore || !conversationsPaginationState.hasMore) return;
                conversationsPaginationState.isLoadingMore = true;
            } else {
                if (loadingEl) loadingEl.style.display = 'flex';
                conversationsPaginationState.offset = 0;
                conversationsPaginationState.hasMore = true;
            }

            try {
                const { data: { session } } = await supabase.auth.getSession();
                if (!session || !session.access_token) {
                    if (!onlyCache && filter === currentConversationsStatusFilter) {
                        if (loadingEl) loadingEl.style.display = 'none';
                        if (scrollEl) scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #ff6b6b;">❌ Sem sessão/JWT - faça login novamente</div>';
                    }
                    return;
                }

                let filteredContatoIds = null;
                let searchOr = null;
                try {
                    const listFilters = await resolveConversationListFilters();
                    filteredContatoIds = listFilters.contatoIds;
                    searchOr = listFilters.searchOr;
                } catch (filtErr) {
                    console.error('❌ Erro ao aplicar filtros (etiquetas/CRM/busca):', filtErr);
                    if (!onlyCache && filter === currentConversationsStatusFilter) {
                        if (loadingEl) loadingEl.style.display = 'none';
                        if (scrollEl) scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #ff6b6b;">Erro ao aplicar filtros. Tente novamente.</div>';
                    }
                    if (!onlyCache) conversationsPaginationState.isLoadingMore = false;
                    return;
                }
                if (filteredContatoIds !== null && filteredContatoIds.length === 0) {
                    if (!onlyCache) {
                        if (loadingEl) loadingEl.style.display = 'none';
                        conversationsPaginationState.isLoadingMore = false;
                        conversationsPaginationState.hasMore = false;
                        conversationsPaginationState.offset = 0;
                        if (filter === currentConversationsStatusFilter && scrollEl) {
                            const adv = hasConversationAdvancedFilters();
                            const srch = hasConversationsSearchFilter();
                            let emptyMsg = 'Nenhuma conversa com os filtros selecionados';
                            if (!adv && srch) emptyMsg = 'Nenhuma conversa encontrada na busca';
                            else if (adv && srch) emptyMsg = 'Nenhuma conversa com os filtros e a busca atuais';
                            scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #888;">' + emptyMsg + '</div>';
                        }
                        applyConversationsSearchFilter();
                    }
                    return;
                }

                // Só carregar conexões quando o cache está vazio (ex.: primeira carga). Não em onlyCache.
                if (!doAppend && !onlyCache && userConnectionsCache.length === 0) {
                    await loadUserConnections();
                }

                let rawData;
                let error = null;
                let paginationOffsetAfterLoad;
                let paginationHasMoreAfterLoad;
                const searchRaw = getConversationSearchRawTerm();
                try {
                    const rpcData = await fetchChatOverviewRpc({
                        p_conta_id: currentUserId,
                        p_status: filter,
                        p_limit: CONVERSATIONS_PAGE_SIZE,
                        p_offset: onlyCache ? 0 : (doAppend ? conversationsPaginationState.offset : 0),
                        p_conexao_ids: (currentConversationsConexaoIds && currentConversationsConexaoIds.length > 0) ? currentConversationsConexaoIds : null,
                        p_contato_ids: (filteredContatoIds && filteredContatoIds.length > 0) ? filteredContatoIds : null,
                        p_search: searchRaw
                    });
                    if (rpcData && Array.isArray(rpcData.conversations)) {
                        rawData = rpcData.conversations;
                        error = null;
                        paginationOffsetAfterLoad = Number(rpcData.next_offset || 0);
                        paginationHasMoreAfterLoad = rpcData.has_more === true;
                        if (!doAppend && !onlyCache && rpcData.counts) {
                            setConversationStatusCounts(rpcData.counts);
                            shouldRefreshCountsFallback = false;
                        }
                    }
                } catch (rpcErr) {
                    console.warn('RPC get_chat_overview (lista) indisponível, usando fallback:', rpcErr);
                }

                // Fallback: se a RPC não trouxe contagens, atualiza em paralelo sem bloquear lista.
                if (shouldRefreshCountsFallback) {
                    scheduleFetchConversationCountsByStatus(0);
                }

                const CONV_LIST_SELECT = '*, atendente_usuario:SAAS_Usuarios!atendente(nome), contato:SAAS_Contatos!contatoId(nome), SAAS_Conexões!idConexao(idAgente, NomeConexao, Telefone, SAAS_AgentesIA!idAgente(nome, pausarAtendimento, ativo))';

                function applyConversationListQueryFilters(q) {
                    q = applyConexaoIdsToConversationQuery(q);
                    q = q.eq('contaId', currentUserId);
                    if (filteredContatoIds && filteredContatoIds.length > 0) {
                        q = q.in('contatoId', filteredContatoIds);
                    }
                    if (searchOr) {
                        q = q.or(searchOr);
                    }
                    return q;
                }

                const RAW_CHUNK = 50;

                if (rawData == null && filter === 'aguardando') {
                    let rawCursor = onlyCache ? 0 : (doAppend ? conversationsPaginationState.offset : 0);
                    const collected = [];
                    let lastChunkLen = 0;
                    while (collected.length < CONVERSATIONS_PAGE_SIZE) {
                        let qLoop = supabase.from('SAAS_Conversas_Agentes').select(CONV_LIST_SELECT);
                        qLoop = qLoop.ilike('statusAtendimento', 'aguardando');
                        qLoop = applyConversationListQueryFilters(qLoop);
                        qLoop = qLoop
                            .order('ultimaMensagem', { ascending: false, nullsFirst: false })
                            .order('id', { ascending: false })
                            .range(rawCursor, rawCursor + RAW_CHUNK - 1);
                        const chunkRes = await qLoop;
                        error = chunkRes.error;
                        if (error) break;
                        const chunk = chunkRes.data || [];
                        lastChunkLen = chunk.length;
                        if (chunk.length === 0) break;
                        for (let i = 0; i < chunk.length; i++) {
                            const row = chunk[i];
                            if (isConversaIaTabLista(row)) continue;
                            collected.push(row);
                            if (collected.length >= CONVERSATIONS_PAGE_SIZE) break;
                        }
                        rawCursor += chunk.length;
                        if (chunk.length < RAW_CHUNK) break;
                    }
                    rawData = collected;
                    paginationOffsetAfterLoad = rawCursor;
                    paginationHasMoreAfterLoad = lastChunkLen === RAW_CHUNK;
                } else if (rawData == null && filter === 'agente-ia') {
                    let rawCursorIa = onlyCache ? 0 : (doAppend ? conversationsPaginationState.offset : 0);
                    const collectedIa = [];
                    let lastChunkLenIa = 0;
                    while (collectedIa.length < CONVERSATIONS_PAGE_SIZE) {
                        let qIaLoop = supabase.from('SAAS_Conversas_Agentes').select(CONV_LIST_SELECT);
                        qIaLoop = qIaLoop.ilike('statusAtendimento', 'aguardando');
                        qIaLoop = qIaLoop.or('pausado.is.null,pausado.eq.false');
                        qIaLoop = applyConversationListQueryFilters(qIaLoop);
                        qIaLoop = qIaLoop
                            .order('ultimaMensagem', { ascending: false, nullsFirst: false })
                            .order('id', { ascending: false })
                            .range(rawCursorIa, rawCursorIa + RAW_CHUNK - 1);
                        const chunkResIa = await qIaLoop;
                        error = chunkResIa.error;
                        if (error) break;
                        const chunkIa = chunkResIa.data || [];
                        lastChunkLenIa = chunkIa.length;
                        if (chunkIa.length === 0) break;
                        for (let ii = 0; ii < chunkIa.length; ii++) {
                            const rowIa = chunkIa[ii];
                            if (!isConversaIaTabLista(rowIa)) continue;
                            collectedIa.push(rowIa);
                            if (collectedIa.length >= CONVERSATIONS_PAGE_SIZE) break;
                        }
                        rawCursorIa += chunkIa.length;
                        if (chunkIa.length < RAW_CHUNK) break;
                    }
                    rawData = collectedIa;
                    paginationOffsetAfterLoad = rawCursorIa;
                    paginationHasMoreAfterLoad = lastChunkLenIa === RAW_CHUNK;
                } else if (rawData == null) {
                    let query = supabase.from('SAAS_Conversas_Agentes').select(CONV_LIST_SELECT);
                    if (filter === 'aberto') {
                        query = query.ilike('statusAtendimento', 'aberto');
                    } else {
                        query = query.ilike('statusAtendimento', filter);
                    }
                    query = applyConversationListQueryFilters(query);
                    query = query
                        .order('ultimaMensagem', { ascending: false, nullsFirst: false })
                        .order('id', { ascending: false });
                    const from = onlyCache ? 0 : (doAppend ? conversationsPaginationState.offset : 0);
                    const to = from + CONVERSATIONS_PAGE_SIZE - 1;
                    const res = await query.range(from, to);
                    error = res.error;
                    rawData = res.data || [];
                    paginationOffsetAfterLoad = (onlyCache ? 0 : conversationsPaginationState.offset) + rawData.length;
                    paginationHasMoreAfterLoad = rawData.length === CONVERSATIONS_PAGE_SIZE;
                }

                if (error) {
                    console.error('❌ Erro ao carregar conversas:', error);
                    if (!onlyCache) {
                        conversationsPaginationState.isLoadingMore = false;
                        if (loadingEl) loadingEl.style.display = 'none';
                        if (scrollEl && !doAppend && filter === currentConversationsStatusFilter) {
                            scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #ff6b6b;">Erro ao carregar conversas</div>';
                        }
                    }
                    return;
                }
                if (!onlyCache) conversationsPaginationState.isLoadingMore = false;

                const data = rawData || [];
                cacheConversationListDetails(data);
                if (!onlyCache) {
                    conversationsPaginationState.hasMore = paginationHasMoreAfterLoad;
                    conversationsPaginationState.offset = paginationOffsetAfterLoad;
                }

                if (data.length === 0 && !doAppend) {
                    if (!shouldSkipConversationCache()) {
                        conversationsCacheByStatus[filter] = { data: [], ultimaMensagemMap: {}, offset: 0, hasMore: false };
                    }
                    if (onlyCache) return;
                    // Só atualizar a lista se ainda estamos nesse status (evita busca antiga sobrescrever após troca de aba)
                    if (filter !== currentConversationsStatusFilter) return;
                    if (loadingEl) loadingEl.style.display = 'none';
                    let msg = filter === 'aberto' ? 'Nenhuma conversa aberta' : filter === 'aguardando' ? 'Nenhuma conversa aguardando' : filter === 'agente-ia' ? 'Nenhuma conversa nesta fila de IA' : 'Nenhuma conversa fechada';
                    const adv = hasConversationAdvancedFilters();
                    const srch = hasConversationsSearchFilter();
                    if (adv && srch) msg = 'Nenhuma conversa com os filtros e a busca atuais';
                    else if (adv) msg = 'Nenhuma conversa com os filtros selecionados';
                    else if (srch) msg = 'Nenhuma conversa encontrada na busca';
                    scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #888;">' + msg + '</div>';
                    applyConversationsSearchFilter();
                    return;
                }

                const conversaIds = data.map(c => parseInt(c.id)).filter(id => !isNaN(id));
                let ultimaMensagemMap = {};
                if (conversaIds.length > 0) {
                    const { data: msgs, error: err } = await supabase
                        .from('SAAS_Mensagens')
                        .select('conversaId, mensagem, tipoMensagem, created_at')
                        .in('conversaId', conversaIds)
                        .eq('apagada', false)
                        .order('created_at', { ascending: false });
                    if (msgs && !err) {
                        msgs.forEach(msg => {
                            const cid = parseInt(msg.conversaId);
                            if (!ultimaMensagemMap[cid]) {
                                ultimaMensagemMap[cid] = {
                                    texto: msg.mensagem || '',
                                    tipoMensagem: msg.tipoMensagem ?? msg.tipo_mensagem ?? null,
                                    data: getMensagemCreatedAt(msg)
                                };
                            }
                        });
                    }
                }

                // Ordenar pela data real da última mensagem (evita ordem bagunçada quando ultimaMensagem da conversa está desatualizada)
                const sortedData = sortConversationsByLastMessage(data, ultimaMensagemMap);

                // Atualizar cache por status (só sem filtros que invalidam o cache compartilhado)
                if (!shouldSkipConversationCache()) {
                    const cacheHasMore = paginationHasMoreAfterLoad;
                    const cacheOffset = paginationOffsetAfterLoad;
                    if (doAppend && conversationsCacheByStatus[filter]) {
                        const prev = conversationsCacheByStatus[filter];
                        const mergedData = (prev.data || []).concat(data);
                        const mergedMap = Object.assign({}, prev.ultimaMensagemMap || {}, ultimaMensagemMap);
                        const sortedMerged = sortConversationsByLastMessage(mergedData, mergedMap);
                        conversationsCacheByStatus[filter] = { data: sortedMerged, ultimaMensagemMap: mergedMap, offset: cacheOffset, hasMore: cacheHasMore };
                    } else {
                        conversationsCacheByStatus[filter] = { data: sortedData.slice(), ultimaMensagemMap: Object.assign({}, ultimaMensagemMap), offset: cacheOffset, hasMore: cacheHasMore };
                    }
                }

                if (onlyCache) {
                    return;
                }

                // Só atualizar a lista se ainda estamos nesse status (evita busca antiga sobrescrever após troca de aba)
                if (filter !== currentConversationsStatusFilter) {
                    if (loadingEl) loadingEl.style.display = 'none';
                    return;
                }

                if (loadingEl) loadingEl.style.display = 'none';
                const [tagPreview, crmPreview] = currentUserId
                    ? await Promise.all([
                        fetchContatoEtiquetasPreviewMapForList(currentUserId, sortedData),
                        fetchContatoCrmPreviewMapForList(currentUserId, sortedData)
                    ])
                    : [{ idsSet: new Set(), byContatoId: new Map() }, { idsSet: new Set(), byContatoId: new Map() }];
                const listRenderOpts = filter === 'agente-ia' ? { showAgenteIaTag: true } : undefined;
                const html = sortedData.map(conv => renderConversationItemHtml(conv, ultimaMensagemMap, tagPreview.idsSet, tagPreview.byContatoId, crmPreview.idsSet, crmPreview.byContatoId, listRenderOpts)).join('');
                if (doAppend) {
                    scrollEl.insertAdjacentHTML('beforeend', html);
                    console.log('✅ Mais ' + data.length + ' conversas (status: ' + filter + ')');
                } else {
                    scrollEl.innerHTML = html;
                    console.log('✅ ' + data.length + ' conversas (status: ' + filter + ')');
                }
                refreshConversationTimeBadges();
                ensureConversationTimeAutoRefresh();
                applyConversationsSearchFilter();

                // Restaurar destaque da conversa atualmente aberta após rebuild da lista
                if (!doAppend && currentConversationId) {
                    var activeItem = scrollEl.querySelector('[data-conversation-id="' + currentConversationId + '"]');
                    if (activeItem) activeItem.classList.add('active');
                }

                // Subscrever ao Realtime de conversas apenas uma vez (não re-subscrever a cada reload)
                if (!doAppend && !conversationsSubscription) subscribeToConversations();
                attachConversationsScrollListener();
            } catch (error) {
                console.error('❌ Erro ao carregar conversas:', error);
                if (!onlyCache) {
                    conversationsPaginationState.isLoadingMore = false;
                    if (loadingEl) loadingEl.style.display = 'none';
                    if (scrollEl && !doAppend && filter === currentConversationsStatusFilter) {
                        scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #ff6b6b;">Erro: ' + error.message + '</div>';
                    }
                }
            }
        }

        // setupAuthListeners já foi definido e chamado acima (após initSupabase)

        // Inscrever em atualizações de conversas (Realtime)
        function subscribeToConversations() {
            // Desinscrever subscription anterior se existir
            if (conversationsSubscription) {
                console.log('🔄 Desinscrevendo de conversas anteriores...');
                conversationsSubscription.unsubscribe();
                conversationsSubscription = null;
            }

            console.log('🔔 Ativando Realtime para conversas (RLS filtra automaticamente por auth.uid())');

            const scheduleConversationsReload = () => {
                if (conversationsReloadTimer) clearTimeout(conversationsReloadTimer);
                conversationsReloadTimer = setTimeout(() => {
                    loadConversations(currentConversationsStatusFilter, false);
                }, 200);
            };

            // RLS filtra automaticamente no Realtime
            conversationsSubscription = supabase
                .channel('conversations-changes')
                // Caminho preferido (Supabase): Broadcast com payload controlado por trigger no banco.
                // Mantemos postgres_changes abaixo como fallback/retrocompatibilidade.
                .on('broadcast', { event: '*' }, (broadcastEvent) => {
                    const payload = broadcastEvent?.payload || {};
                    const table = payload.table || payload.source_table || payload.entity || null;
                    const eventType = String(payload.eventType || payload.type || broadcastEvent?.event || '').toUpperCase();
                    const newRow = payload.new || payload.record || payload.new_record || null;
                    const oldRow = payload.old || payload.old_record || null;

                    // Broadcast da tabela de conversas
                    if (table === 'SAAS_Conversas_Agentes') {
                        const contaIdPayload = String(newRow?.contaId ?? oldRow?.contaId ?? '');
                        if (contaIdPayload && String(currentUserId) && contaIdPayload !== String(currentUserId)) return;

                        if (newRow && eventType === 'UPDATE') {
                            const updatedConvId = String(newRow.id);
                            if (updatedConvId !== String(currentConversationId)) {
                                const ultimaMensagemMudou = oldRow && (oldRow.ultimaMensagem !== newRow.ultimaMensagem);
                                const ficouNaoLida = newRow.lida === false;
                                if (ultimaMensagemMudou || ficouNaoLida) {
                                    playNotificationSound();
                                }
                            }
                        }

                        if (eventType === 'UPDATE' && newRow && oldRow && String(newRow.id) === String(currentConversationId)) {
                            const lidaMudou = oldRow.lida !== newRow.lida;
                            const ultimaMensagemMudou = oldRow.ultimaMensagem !== newRow.ultimaMensagem;
                            if (ultimaMensagemMudou) fetchNewMessagesForCurrentConversation();
                            if (lidaMudou) {
                                const item = document.querySelector(`[data-conversation-id="${newRow.id}"]`);
                                if (item) {
                                    const unreadBadge = item.querySelector('.conversation-unread');
                                    if (unreadBadge) unreadBadge.remove();
                                }
                            }
                            if (!ultimaMensagemMudou) return;
                        }

                        scheduleConversationsReload();
                        return;
                    }

                    // Broadcast da tabela de mensagens (fallback para manter sidebar atualizada)
                    if (table === 'SAAS_Mensagens' && eventType === 'INSERT') {
                        const contaIdPayload = String(newRow?.contaId ?? '');
                        if (contaIdPayload && String(currentUserId) && contaIdPayload !== String(currentUserId)) return;
                        const convId = String(newRow?.conversaId ?? newRow?.conversaid ?? '');
                        if (convId && convId !== String(currentConversationId)) {
                            scheduleConversationsReload();
                        }
                    }
                })
                .on('postgres_changes', {
                    event: '*',  // INSERT, UPDATE, DELETE
                    schema: 'public',
                    table: 'SAAS_Conversas_Agentes'
                }, (payload) => {
                    const newRow = payload.new;
                    const oldRow = payload.old;
                    
                    // Tocar som pelo Realtime da lista (sempre ativo): quando o preview da última mensagem
                    // for atualizado em outra conversa (não a aberta) = nova mensagem chegou
                    if (newRow && payload.eventType === 'UPDATE') {
                        const updatedConvId = String(newRow.id);
                        if (updatedConvId !== currentConversationId) {
                            const ultimaMensagemMudou = oldRow && (oldRow.ultimaMensagem !== newRow.ultimaMensagem);
                            const ficouNaoLida = newRow.lida === false;
                            if (ultimaMensagemMudou || ficouNaoLida) {
                                playNotificationSound();
                            }
                        }
                    }
                    
                    // UPDATE na conversa atualmente aberta
                    if (payload.eventType === 'UPDATE' && newRow && oldRow && String(newRow.id) === String(currentConversationId)) {
                        const lidaMudou = oldRow.lida !== newRow.lida;
                        const ultimaMensagemMudou = oldRow.ultimaMensagem !== newRow.ultimaMensagem;

                        // Se ultimaMensagem mudou, uma nova mensagem chegou — buscar e exibir
                        // (fallback: o Realtime de mensagens pode não entregar INSERTs quando
                        //  a RLS usa subqueries complexas com SECURITY DEFINER)
                        if (ultimaMensagemMudou) {
                            fetchNewMessagesForCurrentConversation();
                        }

                        // Atualizar badge de não lida se necessário
                        if (lidaMudou) {
                            const item = document.querySelector(`[data-conversation-id="${newRow.id}"]`);
                            if (item) {
                                const unreadBadge = item.querySelector('.conversation-unread');
                                if (unreadBadge) unreadBadge.remove();
                            }
                        }

                        // Se apenas lida mudou (nosso próprio clique), não recarregar a lista
                        if (!ultimaMensagemMudou) {
                            return;
                        }
                    }

                    // Recarregar lista de conversas (INSERT, DELETE ou UPDATE em outra conversa/campo)
                    scheduleConversationsReload();
                })
                // Fallback robusto: se nova mensagem chegar e a tabela de conversa não disparar
                // Realtime para este cliente, ainda assim atualiza a sidebar de conversas.
                .on('postgres_changes', {
                    event: 'INSERT',
                    schema: 'public',
                    table: 'SAAS_Mensagens',
                    filter: `contaId=eq.${currentUserId}`
                }, (payload) => {
                    const msg = payload.new || {};
                    const convId = String(msg.conversaId ?? msg.conversaid ?? '');
                    // A conversa aberta já atualiza pelo Realtime de mensagens; foco aqui é sidebar.
                    if (convId && convId !== String(currentConversationId)) {
                        scheduleConversationsReload();
                    }
                })
                .subscribe((status) => {
                    if (status === 'SUBSCRIBED') {
                        console.log('✅ Realtime de conversas ATIVADO com sucesso!');
                    } else if (status === 'CHANNEL_ERROR') {
                        console.error('❌ Erro ao ativar Realtime de conversas');
                    } else if (status === 'TIMED_OUT') {
                        console.warn('⚠️ Timeout ao ativar Realtime de conversas');
                    } else {
                        console.log('📡 Status do Realtime de conversas:', status);
                    }
                });
        }

        /**
         * Renderiza uma mensagem em HTML (usado em loadMessages e loadMoreMessages)
         * @param {Object} msg - Dados da mensagem
         * @param {Object} repliedMessagesMap - Mapa de mensagens respondidas (messageEvolutionId -> msg)
         * @returns {string} HTML da mensagem
         */
        function renderMessageHtml(msg, repliedMessagesMap) {
            const isSent = msg.fromMe === true || msg.fromMe === 'true' || msg.fromMe === 1;
            const isIA = isSent && isMessageFromIA(msg);
            const messageText = msg.mensagem || '';
            const messageTime = getMensagemCreatedAt(msg);
            const messageId = msg.id?.toString() || '';
            const messageEvolutionId = msg.messageEvolutionId || null;
            const enviada = msg.enviada === true || msg.enviada === 'true' || msg.enviada === 1;
            const apagada = msg.apagada === true || msg.apagada === 'true' || msg.apagada === 1;
            const favoritaRaw = isMessageFavoriteTruthy(msg.favorita);
            const favoritaShow = favoritaRaw && !apagada;
            const favoriteStarHtml = favoritaShow ? MESSAGE_FAVORITE_STAR_HTML : '';
            const repliedMessage = msg.mensagemRespondida ? (repliedMessagesMap || {})[msg.mensagemRespondida] : null;
            const replyPreview = repliedMessage ? generateReplyPreview(repliedMessage) : '';
            const createdIso = getMensagemCreatedAt(msg) || '';
            const tipoRaw = String(msg.tipoMensagem ?? msg.tipo_mensagem ?? '');
            const documentClass = tipoRaw.toLowerCase() === 'documentmessage' ? ' message-document-clean' : '';
            const msgMetaPartsEarly = [];
            if (messageId) msgMetaPartsEarly.push(`data-message-id="${messageId}"`);
            if (messageEvolutionId) msgMetaPartsEarly.push(`data-message-evolution-id="${escapeDataAttr(String(messageEvolutionId))}"`);
            msgMetaPartsEarly.push(`data-message-created-at="${escapeDataAttr(createdIso)}"`);
            msgMetaPartsEarly.push(`data-message-tipo="${escapeDataAttr(tipoRaw)}"`);
            msgMetaPartsEarly.push(`data-message-enviada="${enviada ? '1' : '0'}"`);
            msgMetaPartsEarly.push(`data-message-apagada="${apagada ? '1' : '0'}"`);
            msgMetaPartsEarly.push(`data-message-favorita="${favoritaRaw ? '1' : '0'}"`);
            const msgMetaAttrsEarly = msgMetaPartsEarly.join(' ');

            if (apagada) {
                let preservedInner;
                const txt = (messageText || '').trim();
                if (txt) {
                    preservedInner = '<span class="message-apagada-preserved"><span class="message-text">' + escapeHtml(txt) + '</span></span>';
                } else {
                    const crDead = generateMessageContent(msg, { messageId, isSent });
                    const innerPart = typeof crDead === 'object' && crDead.html !== undefined ? crDead.html : (typeof crDead === 'string' ? crDead : '');
                    if (innerPart && String(innerPart).trim()) {
                        preservedInner = '<span class="message-apagada-preserved">' + innerPart + '</span>';
                    } else {
                        preservedInner = '<span class="message-text message-apagada-text">Esta mensagem foi apagada</span>';
                    }
                }
                const tombRow = '<span class="message-apagada-row message-apagada-row--with-content"><span class="message-apagada-icon" title="Mensagem apagada">' + MESSAGE_APAGADA_TOMB_SVG + '</span>' + preservedInner + '</span>';
                const statusIconDead = (isSent && !enviada) ? '<span class="message-status-icon clock"><svg viewBox="0 0 16 16" fill="currentColor" style="width: 16px; height: 16px;"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm.5 4.5a.5.5 0 0 0-1 0v3.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1H8.5V4.5z"/></svg></span>' : '';
                const menuIdT = messageId ? 'messageOptions-' + messageId : '';
                const bodyDead = '<span class="message-body-block">' + tombRow + '</span>';
                const sentMetaDead = `<span class="message-trailing-meta"><span class="message-time">${formatMessageTime(messageTime)}</span>${statusIconDead}</span>`;
                const recvMetaDead = `<span class="message-trailing-meta"><span class="message-time">${formatMessageTime(messageTime)}</span></span>`;
                const innerDead = bodyDead + (isSent ? sentMetaDead : recvMetaDead);
                const sentClassDead = isSent ? ('message sent message-apagada' + documentClass + (isIA ? ' ia' : '')) : ('message received message-apagada' + documentClass);
                if (isSent) {
                    return '<div class="' + sentClassDead + '" ' + msgMetaAttrsEarly + ' style="position: relative;"><div class="message-avatar">' + getSentMessageAvatarHtml(msg) + '</div><div class="message-content">' + replyPreview + '<div class="message-content-inner">' + innerDead + '</div></div><div class="message-options-menu" id="' + menuIdT + '"></div></div>';
                }
                return '<div class="' + sentClassDead + '" ' + msgMetaAttrsEarly + ' style="position: relative;">' + getReceivedMessageAvatarHtml() + '<div class="message-content">' + replyPreview + '<div class="message-content-inner">' + innerDead + '</div></div><div class="message-options-menu" id="' + menuIdT + '"></div></div>';
            }

            const contentResult = generateMessageContent(msg, { messageId, isSent });
            const hasCaption = typeof contentResult === 'object' && contentResult.caption;
            const messageContentHtml = typeof contentResult === 'object' && contentResult.html !== undefined ? contentResult.html : (typeof contentResult === 'object' ? '' : contentResult);
            const hasMediaActions = typeof contentResult === 'object' && contentResult.hasMediaActions === true;
            // Só relógio quando enviada false; quando enviada true não mostra ícone
            const statusIcon = (isSent && !enviada) ? '<svg viewBox="0 0 16 16" fill="currentColor" style="width: 16px; height: 16px;"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm.5 4.5a.5.5 0 0 0-1 0v3.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1H8.5V4.5z"/></svg>' : '';
            const optsBtnMedia = hasMediaActions ? '' : `<button class="message-options-btn" onclick="showMessageOptions(event, ${messageId || 'null'}, '${escapeForInlineJsSingleQuoted(messageText.substring(0, 50))}')" title="Opções"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></button>`;
            const caption = hasCaption ? contentResult.caption : '';
            const optsBtnText = `<button class="message-options-btn" onclick="showMessageOptions(event, ${messageId || 'null'}, '${escapeForInlineJsSingleQuoted((caption || '').substring(0, 50))}')" title="Opções"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path></svg></button>`;
            const textBlockHtml = caption ? `<span class="message-text">${escapeHtml(caption)}</span>` : '';
            const sentClass = isSent ? ('message sent' + documentClass + (isIA ? ' ia' : '')) : '';
            const msgMetaAttrs = msgMetaAttrsEarly;

            function buildOneMessage(contentInner, replyPrev, optsBtn, optionsMenuSuffix) {
                const menuId = messageId ? `messageOptions-${messageId}${optionsMenuSuffix || ''}` : '';
                const sentLeading = optsBtn ? `<span class="message-leading-options">${optsBtn}</span>` : '';
                const sentMeta = `<span class="message-trailing-meta">${favoriteStarHtml}<span class="message-time">${formatMessageTime(messageTime)}</span>${statusIcon ? `<span class="message-status-icon clock">${statusIcon}</span>` : ''}</span>`;
                const recvMeta = `<span class="message-trailing-meta">${favoriteStarHtml}<span class="message-time">${formatMessageTime(messageTime)}</span>${optsBtn}</span>`;
                if (isSent) {
                    return `<div class="${sentClass}" ${msgMetaAttrs} style="position: relative;"><div class="message-avatar">${getSentMessageAvatarHtml(msg)}</div><div class="message-content">${replyPrev}<div class="message-content-inner">${sentLeading}<span class="message-body-block">${contentInner}</span>${sentMeta}</div></div><div class="message-options-menu" id="${menuId}"></div></div>`;
                }
                return `<div class="message received${documentClass}" ${msgMetaAttrs} style="position: relative;">${getReceivedMessageAvatarHtml()}<div class="message-content">${replyPrev}<div class="message-content-inner"><span class="message-body-block">${contentInner}</span>${recvMeta}</div></div><div class="message-options-menu" id="${menuId}"></div></div>`;
            }

            if (hasCaption) {
                const blockMedia = buildOneMessage(messageContentHtml, replyPreview, optsBtnMedia, '');
                const blockText = buildOneMessage(textBlockHtml, '', optsBtnText, '-caption');
                return blockMedia + blockText;
            }

            const optsBtn = optsBtnMedia;
            const sentLeadingSingle = optsBtn ? `<span class="message-leading-options">${optsBtn}</span>` : '';
            const sentMetaSingle = `<span class="message-trailing-meta">${favoriteStarHtml}<span class="message-time">${formatMessageTime(messageTime)}</span>${statusIcon ? `<span class="message-status-icon clock">${statusIcon}</span>` : ''}</span>`;
            const recvMetaSingle = `<span class="message-trailing-meta">${favoriteStarHtml}<span class="message-time">${formatMessageTime(messageTime)}</span>${optsBtn}</span>`;
            if (isSent) {
                return `<div class="${sentClass}" ${msgMetaAttrs} style="position: relative;"><div class="message-avatar">${getSentMessageAvatarHtml(msg)}</div><div class="message-content">${replyPreview}<div class="message-content-inner">${sentLeadingSingle}<span class="message-body-block">${messageContentHtml}</span>${sentMetaSingle}</div></div><div class="message-options-menu" id="messageOptions-${messageId}"></div></div>`;
            }
            return `<div class="message received${documentClass}" ${msgMetaAttrs} style="position: relative;">${getReceivedMessageAvatarHtml()}<div class="message-content">${replyPreview}<div class="message-content-inner"><span class="message-body-block">${messageContentHtml}</span>${recvMetaSingle}</div></div><div class="message-options-menu" id="messageOptions-${messageId}"></div></div>`;
        }

        /**
         * Carrega mais 20 mensagens antigas ao rolar para cima (estilo WhatsApp)
         */
        async function loadMoreMessages() {
            const conversationId = currentConversationId;
            const messagesEl = document.getElementById('chatMessages');
            if (!conversationId || !messagesEl || messagesPaginationState.isLoadingMore || !messagesPaginationState.hasMoreMessages) return;
            const oldestAt = messagesPaginationState.oldestLoadedCreatedAt;
            if (!oldestAt) return;

            messagesPaginationState.isLoadingMore = true;
            const conversaIdNum = parseInt(conversationId);
            const firstMsg = messagesEl.querySelector('.message');

            try {
                const { data: rawData, error } = await supabase
                    .from('SAAS_Mensagens')
                    .select('*')
                    .eq('conversaId', conversaIdNum)
                    .lt('created_at', oldestAt)
                    .order('created_at', { ascending: false })
                    .limit(MESSAGES_PAGE_SIZE);

                if (error) throw error;
                if (!rawData || rawData.length === 0) {
                    messagesPaginationState.hasMoreMessages = false;
                    return;
                }

                const data = [...rawData].reverse();
                messagesPaginationState.hasMoreMessages = rawData.length >= MESSAGES_PAGE_SIZE;
                messagesPaginationState.oldestLoadedCreatedAt = getMensagemCreatedAt(data[0]);

                const repliedMessageIds = [...new Set(data.filter(m => m.mensagemRespondida).map(m => m.mensagemRespondida))];
                let repliedMessagesMap = {};
                if (repliedMessageIds.length > 0) {
                    const { data: repliedMessages } = await supabase
                        .from('SAAS_Mensagens')
                        .select('id, mensagem, fromMe, tipoMensagem, arquivoUrl, messageEvolutionId')
                        .in('messageEvolutionId', repliedMessageIds);
                    if (repliedMessages) repliedMessages.forEach(m => { repliedMessagesMap[m.messageEvolutionId] = m; });
                }

                const oldScrollHeight = messagesEl.scrollHeight;
                const oldScrollTop = messagesEl.scrollTop;
                const html = data.map(msg => renderMessageHtml(msg, repliedMessagesMap)).join('');
                if (firstMsg) firstMsg.insertAdjacentHTML('beforebegin', html);
                const newScrollHeight = messagesEl.scrollHeight;
                messagesEl.scrollTop = oldScrollTop + (newScrollHeight - oldScrollHeight);
                initAudioWidgetDurations(messagesEl);
                console.log(`✅ Mais ${data.length} mensagens antigas carregadas`);
            } catch (err) {
                console.error('❌ Erro ao carregar mais mensagens:', err);
                messagesPaginationState.hasMoreMessages = false;
            } finally {
                messagesPaginationState.isLoadingMore = false;
            }
        }

        /**
         * Anexa o listener de scroll para carregar mais mensagens ao rolar para cima
         */
        function attachMessagesScrollListener() {
            const messagesEl = document.getElementById('chatMessages');
            if (!messagesEl || messagesPaginationState.scrollListenerAttached) return;
            messagesPaginationState.scrollListenerAttached = true;
            let scrollThrottle = null;
            messagesEl.addEventListener('scroll', function() {
                if (scrollThrottle) return;
                scrollThrottle = setTimeout(() => { scrollThrottle = null; }, 150);
                if (messagesEl.scrollTop < 80) loadMoreMessages();
            });
        }

        // Carregar mensagens do Supabase
        async function loadMessages(conversationId) {
            const messagesEl = document.getElementById('chatMessages');
            const loadingEl = document.getElementById('messagesLoading');

            if (!messagesEl) {
                console.error('❌ Elemento chatMessages não encontrado');
                return;
            }

            // Mostrar loading
            if (loadingEl) {
                loadingEl.style.display = 'flex';
            }

            // Obter contaId da tabela SAAS_Usuarios (requerido para INSERT em SAAS_Mensagens - RLS is_owner)
            let userIdFromAuth = currentUserId;
            if (!userIdFromAuth) {
                try {
                    userIdFromAuth = await getUserIdFromAuth();
                    if (userIdFromAuth) currentUserId = userIdFromAuth;
                } catch (e) {
                    if (e.message === 'STATUS_BLOQUEADO') return;
                }
            }
            if (!userIdFromAuth) {
                console.error('❌ UserId não encontrado na tabela SAAS_Usuarios');
                if (loadingEl) loadingEl.style.display = 'none';
                messagesEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #888;">Erro: usuário não identificado</div>';
                return;
            }

            try {
                console.log(`💬 Carregando mensagens da conversa: ${conversationId}`);

                // Tabela: SAAS_Mensagens
                // Filtrar por conversaId e contaId
                // conversaId é bigint, então converter para número
                const conversaIdNum = parseInt(conversationId);
                if (isNaN(conversaIdNum)) {
                    console.error('❌ ID de conversa inválido:', conversationId);
                    if (loadingEl) loadingEl.style.display = 'none';
                    messagesEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #ff6b6b;">Erro: ID de conversa inválido</div>';
                    return;
                }

                // Guard: Verificar sessão antes de SELECT
                const { data: { session } } = await supabase.auth.getSession();
                if (!session || !session.access_token) {
                    console.error('❌ Sem sessão/JWT - faça login novamente');
                    if (loadingEl) loadingEl.style.display = 'none';
                    if (messagesEl) {
                        messagesEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #ff6b6b;">❌ Sem sessão/JWT - faça login novamente</div>';
                    }
                    return;
                }
                
                // Reset estado de paginação ao trocar de conversa
                messagesPaginationState.oldestLoadedCreatedAt = null;
                messagesPaginationState.hasMoreMessages = true;
                messagesPaginationState.isLoadingMore = false;
                messagesPaginationState.scrollListenerAttached = false;

                // RLS filtra automaticamente por auth.uid()
                // Carregar apenas as 20 mais recentes (estilo WhatsApp)
                const { data: rawData, error } = await supabase
                    .from('SAAS_Mensagens')
                    .select('*')
                    .eq('conversaId', conversaIdNum)
                    .order('created_at', { ascending: false })
                    .limit(MESSAGES_PAGE_SIZE);

                if (error) {
                    console.error('❌ Erro ao carregar mensagens:', error);
                    if (loadingEl) loadingEl.style.display = 'none';
                    messagesEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #ff6b6b;">Erro ao carregar mensagens</div>';
                    return;
                }

                if (loadingEl) loadingEl.style.display = 'none';

                if (!rawData || rawData.length === 0) {
                    messagesEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #888;">Nenhuma mensagem ainda. Comece a conversar!</div>';
                    subscribeToMessages(conversationId);
                    return;
                }

                // Inverter para exibir: mais antigas em cima, mais recentes embaixo (estilo WhatsApp)
                const data = [...rawData].reverse();

                // Atualizar estado de paginação
                const oldestMsg = data[0];
                messagesPaginationState.oldestLoadedCreatedAt = getMensagemCreatedAt(oldestMsg);
                messagesPaginationState.hasMoreMessages = rawData.length >= MESSAGES_PAGE_SIZE;

                console.log(`✅ ${data.length} mensagens carregadas (mais recentes)`);

                // Buscar mensagens respondidas necessárias
                const repliedMessageIds = [...new Set(data.filter(msg => msg.mensagemRespondida).map(msg => msg.mensagemRespondida))];
                const repliedMessagesMap = {};
                
                // Buscar todas as mensagens respondidas de uma vez
                if (repliedMessageIds.length > 0) {
                    const { data: repliedMessages } = await supabase
                        .from('SAAS_Mensagens')
                        .select('id, mensagem, fromMe, tipoMensagem, arquivoUrl, messageEvolutionId')
                        .in('messageEvolutionId', repliedMessageIds);
                    
                    if (repliedMessages) {
                        repliedMessages.forEach(repliedMsg => {
                            repliedMessagesMap[repliedMsg.messageEvolutionId] = repliedMsg;
                        });
                    }
                }

                // Renderizar mensagens (estilo WhatsApp: antigas em cima, recentes embaixo)
                messagesEl.innerHTML = data.map(msg => renderMessageHtml(msg, repliedMessagesMap)).join('');

                initAudioWidgetDurations(messagesEl);

                // Scroll para o final (mais recente): imediato + após layout + após mídia carregar (evita abrir no meio)
                function scrollToBottom() {
                    if (messagesEl) messagesEl.scrollTop = messagesEl.scrollHeight;
                }
                scrollToBottom();
                requestAnimationFrame(() => {
                    scrollToBottom();
                    requestAnimationFrame(scrollToBottom);
                });
                setTimeout(scrollToBottom, 150);
                setTimeout(scrollToBottom, 400);
                const messageInput = document.getElementById('messageInput');
                if (messageInput) messageInput.focus();

                // Listener para carregar mais mensagens ao rolar para cima
                attachMessagesScrollListener();

                // Inscrever em novas mensagens (Realtime)
                subscribeToMessages(conversationId);

            } catch (error) {
                console.error('❌ Erro ao carregar mensagens:', error);
                if (loadingEl) loadingEl.style.display = 'none';
                if (messagesEl) {
                    messagesEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #ff6b6b;">Erro ao carregar mensagens: ' + error.message + '</div>';
                }
            }
        }

        // Inscrever em novas mensagens (Realtime)
        function subscribeToMessages(conversationId) {
            if (!conversationId) {
                console.warn('⚠️ Não é possível inscrever em mensagens: conversationId não encontrado');
                return;
            }
            
            // Desinscrever subscription anterior se existir
            if (messagesSubscription) {
                console.log('🔄 Desinscrevendo de mensagens anteriores...');
                messagesSubscription.unsubscribe();
                messagesSubscription = null;
            }

            const conversaIdNum = parseInt(conversationId);
            if (isNaN(conversaIdNum)) {
                console.error('❌ ID de conversa inválido para Realtime:', conversationId);
                return;
            }

            console.log('🔔 Ativando Realtime para mensagens (conversaId:', conversaIdNum, ')');

            // RLS filtra automaticamente por auth.uid().
            // Mantemos a filtragem principal por conversaId no callback para evitar
            // perdas de evento quando há variação de nome/tipo da coluna no payload.
            messagesSubscription = supabase
                .channel(`messages-${conversationId}`)
                // Caminho preferido (Supabase): Broadcast.
                // Aqui usamos Broadcast para disparar sincronização da conversa aberta.
                .on('broadcast', { event: '*' }, (broadcastEvent) => {
                    const payload = broadcastEvent?.payload || {};
                    const table = payload.table || payload.source_table || payload.entity || null;
                    if (table !== 'SAAS_Mensagens') return;

                    const eventType = String(payload.eventType || payload.type || broadcastEvent?.event || '').toUpperCase();
                    if (eventType !== 'INSERT' && eventType !== 'UPDATE') return;

                    const row = payload.new || payload.record || payload.new_record || null;
                    const payloadConversaIdRaw = row?.conversaId ?? row?.conversaid ?? null;
                    const payloadConversaId = parseInt(payloadConversaIdRaw);
                    if (isNaN(payloadConversaId) || payloadConversaId !== conversaIdNum) return;

                    // Broadcast aciona sincronização; postgres_changes mantém atualização fina da UI.
                    fetchNewMessagesForCurrentConversation();
                })
                .on('postgres_changes', {
                    event: 'INSERT',  // Novas mensagens
                    schema: 'public',
                    table: 'SAAS_Mensagens'
                }, (payload) => {
                    console.log('REALTIME INSERT MENSAGEM', payload);
                    console.log('📨 Nova mensagem recebida via Realtime:', payload);
                    const newMessage = payload.new;
                    
                    // RLS já garante que apenas mensagens do usuário autenticado são recebidas
                    
                    // Verificar se não está apagada
                    if (newMessage.apagada === true) {
                        console.log('⚠️ Mensagem ignorada - está apagada');
                        return;
                    }
                    
                    // Verificar se a mensagem é da conversa atual
                    const payloadConversaIdRaw = newMessage.conversaId ?? newMessage.conversaid ?? null;
                    const payloadConversaId = parseInt(payloadConversaIdRaw);
                    if (isNaN(payloadConversaId) || payloadConversaId !== conversaIdNum) {
                        console.log('⚠️ Mensagem ignorada - não é da conversa atual');
                        return;
                    }
                    
                    // RLS já garantiu que a mensagem pertence ao usuário autenticado
                    
                    // Verificar fromMe: true = enviada por mim (direita), false = recebida (esquerda)
                    const isSent = newMessage.fromMe === true || newMessage.fromMe === 'true' || newMessage.fromMe === 1;
                    const messageText = newMessage.mensagem || '';
                    const messageTime = getMensagemCreatedAt(newMessage);
                    const messageId = newMessage.id?.toString();
                    const messageEvolutionId = newMessage.messageEvolutionId || null;
                    const enviada = newMessage.enviada === true || newMessage.enviada === 'true' || newMessage.enviada === 1;
                    const favoritaNew = isMessageFavoriteTruthy(newMessage.favorita);
                    
                    console.log('📨 Nova mensagem Realtime:', { id: messageId, fromMe: newMessage.fromMe, isSent, enviada, mensagem: messageText.substring(0, 30) });
                    
                    // Verificar se a mensagem já existe na UI (evita duplicação)
                    const messagesEl = document.getElementById('chatMessages');
                    if (!messagesEl) {
                        console.warn('⚠️ Elemento chatMessages não encontrado para adicionar mensagem');
                        return;
                    }
                    
                    // Verificar se já existe uma mensagem com este ID (ou ID temporário correspondente)
                    if (messageId) {
                        const existingByRealId = messagesEl.querySelectorAll(`[data-real-message-id="${messageId}"]`);
                        const existingByMsgId = messagesEl.querySelector(`[data-message-id="${messageId}"]`);
                        const existingMessage = existingByMsgId || (existingByRealId.length ? existingByRealId[0] : null);
                        if (existingMessage) {
                            console.log('⚠️ Mensagem já existe na UI (otimista ou real), atualizando se necessário:', messageId);
                            // Atualizar todos os blocos otimistas (ex.: mídia + legenda = 2 divs)
                            existingByRealId.forEach(function (el) {
                                el.setAttribute('data-message-id', messageId);
                                el.removeAttribute('data-real-message-id');
                            });
                            if (existingByRealId.length) console.log('✅ Mensagem otimista atualizada com ID real:', messageId);
                            // Atualizar status da mensagem existente se enviada mudou (em todos os blocos)
                            if (isSent && enviada) {
                                const toUpdate = existingByMsgId ? [existingByMsgId] : Array.from(existingByRealId);
                                toUpdate.forEach(function (msgEl) {
                                    const statusIcon = msgEl.querySelector('.message-status-icon');
                                    if (statusIcon) statusIcon.remove();
                                });
                            }
                            messagesEl.querySelectorAll(`[data-message-id="${messageId}"]`).forEach(function (msgEl) {
                                if (messageEvolutionId) msgEl.setAttribute('data-message-evolution-id', String(messageEvolutionId));
                                msgEl.setAttribute('data-message-enviada', enviada ? '1' : '0');
                                const tiso = getMensagemCreatedAt(newMessage) || '';
                                if (tiso) msgEl.setAttribute('data-message-created-at', tiso);
                                msgEl.setAttribute('data-message-tipo', String(newMessage.tipoMensagem ?? newMessage.tipo_mensagem ?? ''));
                                const apIns = newMessage.apagada === true || newMessage.apagada === 'true' || newMessage.apagada === 1;
                                msgEl.setAttribute('data-message-apagada', apIns ? '1' : '0');
                                msgEl.setAttribute('data-message-favorita', favoritaNew ? '1' : '0');
                            });
                            setMessageFavoriteDom(messageId, favoritaNew && !(newMessage.apagada === true || newMessage.apagada === 'true' || newMessage.apagada === 1));
                            void refreshContactDetailsFavoritesList();
                            return;  // Mensagem já existe, não adicionar novamente
                        }
                    }
                    
                    // Buscar mensagem respondida se houver
                    (async () => {
                        let repliedMessage = null;
                        if (newMessage.mensagemRespondida) {
                            repliedMessage = await getMessageByEvolutionId(newMessage.mensagemRespondida);
                        }
                        
                        const replyPreview = repliedMessage ? generateReplyPreview(repliedMessage) : '';
                        
                        const isIA = isSent && isMessageFromIA(newMessage);
                    const messageDiv = document.createElement('div');
                        messageDiv.className = `message ${isSent ? 'sent' : 'received'}${isIA ? ' ia' : ''}`;
                        messageDiv.style.position = 'relative';
                        if (messageId) {
                            messageDiv.setAttribute('data-message-id', messageId);  // Marcar com ID real
                        }
                        if (messageEvolutionId) {
                            messageDiv.setAttribute('data-message-evolution-id', messageEvolutionId);  // Marcar com messageEvolutionId
                        }
                        const createdIsoIns = getMensagemCreatedAt(newMessage) || '';
                        if (createdIsoIns) messageDiv.setAttribute('data-message-created-at', createdIsoIns);
                        messageDiv.setAttribute('data-message-tipo', String(newMessage.tipoMensagem ?? newMessage.tipo_mensagem ?? ''));
                        messageDiv.setAttribute('data-message-enviada', enviada ? '1' : '0');
                        const apNew = newMessage.apagada === true || newMessage.apagada === 'true' || newMessage.apagada === 1;
                        messageDiv.setAttribute('data-message-apagada', apNew ? '1' : '0');
                        messageDiv.setAttribute('data-message-favorita', favoritaNew ? '1' : '0');
                        const favStarIns = (!apNew && favoritaNew) ? MESSAGE_FAVORITE_STAR_HTML : '';
                        
                        // Ícone de status: só relógio quando enviada false; quando enviada true não mostra ícone
                        const statusIcon = (isSent && !enviada) ? '<svg viewBox="0 0 16 16" fill="currentColor" style="width: 16px; height: 16px;"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm.5 4.5a.5.5 0 0 0-1 0v3.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1H8.5V4.5z"/></svg>' : '';
                        
                        // Conteúdo da mensagem (texto ou mídia conforme tipoMensagem e arquivoUrl)
                        const contentResult = generateMessageContent({
                            mensagem: messageText,
                            tipoMensagem: newMessage.tipoMensagem,
                            arquivoUrl: newMessage.arquivoUrl
                        }, { messageId, isSent });
                        const messageContentHtml = typeof contentResult === 'object' && contentResult.hasMediaActions ? contentResult.html : (typeof contentResult === 'object' ? contentResult.html : contentResult);
                        const hasMediaActions = typeof contentResult === 'object' && contentResult.hasMediaActions === true;

                        if (isSent) {
                            // Mensagem enviada (fromMe: true) - à direita; avatar = robô se IA, senão "Você"
                    messageDiv.innerHTML = `
                                <div class="message-avatar">${getSentMessageAvatarHtml(newMessage)}</div>
                        <div class="message-content">
                                    ${replyPreview}
                                    <div class="message-content-inner">
                                        ${hasMediaActions ? '' : `<span class="message-leading-options"><button class="message-options-btn" onclick="showMessageOptions(event, ${messageId || 'null'}, '${escapeForInlineJsSingleQuoted(messageText.substring(0, 50))}')" title="Opções">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
                                            </svg>
                                        </button></span>`}
                                        <span class="message-body-block">${messageContentHtml}</span>
                                        <span class="message-trailing-meta">
                                        ${favStarIns}
                                        <span class="message-time">
                                            ${formatMessageTime(messageTime)}
                                        </span>
                                        ${statusIcon ? `<span class="message-status-icon clock">${statusIcon}</span>` : ''}
                                        </span>
                        </div>
                                </div>
                                <div class="message-options-menu" id="messageOptions-${messageId || ''}"></div>
                            `;
                        } else {
                            // Mensagem recebida (fromMe: false) - à esquerda (avatar = foto da conversa ou iniciais)
                            messageDiv.innerHTML = `
                                ${getReceivedMessageAvatarHtml()}
                                <div class="message-content">
                                    ${replyPreview}
                                    <div class="message-content-inner">
                                        <span class="message-body-block">${messageContentHtml}</span>
                                        <span class="message-trailing-meta">
                                        ${favStarIns}
                                        <span class="message-time">
                                            ${formatMessageTime(messageTime)}
                                        </span>
                                        ${hasMediaActions ? '' : `<button class="message-options-btn" onclick="showMessageOptions(event, ${messageId || 'null'}, '${escapeForInlineJsSingleQuoted(messageText.substring(0, 50))}')" title="Opções">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"></path>
                                            </svg>
                                        </button>`}
                                        </span>
                                    </div>
                                </div>
                                <div class="message-options-menu" id="messageOptions-${messageId || ''}"></div>
                            `;
                        }
                        
                    messagesEl.appendChild(messageDiv);
                        initAudioWidgetDurations(messageDiv);
                    messagesEl.scrollTop = messagesEl.scrollHeight;

                        // Atualizar preview na lista de conversas (tipo pode vir como tipoMensagem ou tipo_mensagem do DB)
                        const convItem = document.querySelector(`[data-conversation-id="${conversationId}"]`);
                        if (convItem) {
                            const preview = convItem.querySelector('.conversation-preview');
                            const time = convItem.querySelector('.conversation-time');
                            const tipoMsg = newMessage.tipoMensagem ?? newMessage.tipo_mensagem;
                            if (preview) preview.textContent = getConversationPreviewText(messageText, tipoMsg);
                            if (time) time.textContent = 'Agora';
                        }
                        
                        console.log('✅ Mensagem adicionada à UI via Realtime');
                    })();
                })
                .on('postgres_changes', {
                    event: 'UPDATE',  // Atualizações de mensagens (ex: enviada mudou para true)
                    schema: 'public',
                    table: 'SAAS_Mensagens'
                }, (payload) => {
                    console.log('📝 Mensagem atualizada via Realtime:', payload);
                    const updatedMessage = payload.new;
                    const messageId = updatedMessage.id?.toString();
                    const payloadConversaIdRaw = updatedMessage.conversaId ?? updatedMessage.conversaid ?? null;
                    const payloadConversaId = parseInt(payloadConversaIdRaw);
                    if (isNaN(payloadConversaId) || payloadConversaId !== conversaIdNum) {
                        return;
                    }
                    
                    if (!messageId) return;
                    
                    // Atualizar status da mensagem na UI se enviada mudou para true
                    const messagesEl = document.getElementById('chatMessages');
                    if (messagesEl) {
                        const existingBlocks = messagesEl.querySelectorAll(`[data-message-id="${messageId}"]`);
                        const existingMessage = existingBlocks.length ? existingBlocks[0] : null;
                        if (existingMessage) {
                            const apagadaNow = updatedMessage.apagada === true || updatedMessage.apagada === 'true' || updatedMessage.apagada === 1;
                            if (apagadaNow) {
                                existingBlocks.forEach(function (blk) {
                                    applyDeletedAppearanceToMessageElement(blk);
                                });
                                void refreshContactDetailsFavoritesList();
                                return;
                            }
                            const enviada = updatedMessage.enviada === true || updatedMessage.enviada === 'true' || updatedMessage.enviada === 1;
                            if (enviada) {
                                existingBlocks.forEach(function (blk) {
                                    const icon = blk.querySelector('.message-status-icon');
                                    if (icon) icon.remove();
                                });
                                console.log('✅ Status da mensagem atualizado para enviada (ícone removido):', messageId);
                            }
                            
                            // Se arquivoUrl foi atualizado, trocar blob: para URL definitiva (áudio, imagem, vídeo)
                            const arquivoUrl = updatedMessage.arquivoUrl;
                            if (arquivoUrl) {
                                // Áudio
                                const audioEl = existingMessage.querySelector('audio[data-blob-url]');
                                if (audioEl) {
                                    const oldBlobUrl = audioEl.getAttribute('data-blob-url');
                                    if (oldBlobUrl && oldBlobUrl.startsWith('blob:')) {
                                        URL.revokeObjectURL(oldBlobUrl);
                                    }
                                    audioEl.src = arquivoUrl;
                                    audioEl.removeAttribute('data-blob-url');
                                    audioEl.load();
                                    console.log('✅ Audio src atualizado para URL definitiva:', messageId);
                                }
                                
                                // Imagem
                                const imgEl = existingMessage.querySelector('img[data-blob-url]');
                                if (imgEl) {
                                    const oldBlobUrl = imgEl.getAttribute('data-blob-url');
                                    if (oldBlobUrl && oldBlobUrl.startsWith('blob:')) {
                                        URL.revokeObjectURL(oldBlobUrl);
                                    }
                                    imgEl.src = arquivoUrl;
                                    imgEl.removeAttribute('data-blob-url');
                                    console.log('✅ Imagem src atualizada para URL definitiva:', messageId);
                                }
                                
                                // Vídeo
                                const videoEl = existingMessage.querySelector('video[data-blob-url]');
                                if (videoEl) {
                                    const oldBlobUrl = videoEl.getAttribute('data-blob-url');
                                    if (oldBlobUrl && oldBlobUrl.startsWith('blob:')) {
                                        URL.revokeObjectURL(oldBlobUrl);
                                    }
                                    videoEl.src = arquivoUrl;
                                    videoEl.removeAttribute('data-blob-url');
                                    videoEl.load();
                                    console.log('✅ Vídeo src atualizado para URL definitiva:', messageId);
                                }
                            }

                            const newMensagem = updatedMessage.mensagem;
                            if (newMensagem !== undefined && newMensagem !== null) {
                                existingBlocks.forEach(function (blk) {
                                    blk.querySelectorAll('.message-content-inner .message-text').forEach(function (span) {
                                        span.textContent = newMensagem;
                                    });
                                });
                            }
                            const evoUp = updatedMessage.messageEvolutionId || updatedMessage.messageevolutionid;
                            existingBlocks.forEach(function (blk) {
                                blk.setAttribute('data-message-enviada', enviada ? '1' : '0');
                                if (evoUp) blk.setAttribute('data-message-evolution-id', String(evoUp));
                                const ciso = getMensagemCreatedAt(updatedMessage);
                                if (ciso) blk.setAttribute('data-message-created-at', ciso);
                                const tipoUp = updatedMessage.tipoMensagem ?? updatedMessage.tipo_mensagem;
                                if (tipoUp !== undefined && tipoUp !== null) {
                                    blk.setAttribute('data-message-tipo', String(tipoUp));
                                }
                                const apUp = updatedMessage.apagada === true || updatedMessage.apagada === 'true' || updatedMessage.apagada === 1;
                                blk.setAttribute('data-message-apagada', apUp ? '1' : '0');
                            });
                            const favUp = isMessageFavoriteTruthy(updatedMessage.favorita);
                            const apUpBlock = updatedMessage.apagada === true || updatedMessage.apagada === 'true' || updatedMessage.apagada === 1;
                            setMessageFavoriteDom(messageId, favUp && !apUpBlock);
                        }
                    }
                    void refreshContactDetailsFavoritesList();
                })
                .subscribe((status) => {
                    if (status === 'SUBSCRIBED') {
                        console.log('✅ Realtime de mensagens ATIVADO com sucesso!');
                    } else if (status === 'CHANNEL_ERROR') {
                        console.error('❌ Erro ao ativar Realtime de mensagens');
                    } else if (status === 'TIMED_OUT') {
                        console.warn('⚠️ Timeout ao ativar Realtime de mensagens');
                    } else {
                        console.log('📡 Status do Realtime de mensagens:', status);
                    }
                });
        }

        // ============================================
        // FALLBACK: buscar novas mensagens via SELECT quando o Realtime de conversas
        // indica que ultimaMensagem mudou (cobre casos em que o Realtime de mensagens
        // não entrega o INSERT — ex.: RLS complexa com SECURITY DEFINER)
        // ============================================
        let _fetchNewMsgsTimer = null;
        function fetchNewMessagesForCurrentConversation() {
            if (_fetchNewMsgsTimer) clearTimeout(_fetchNewMsgsTimer);
            _fetchNewMsgsTimer = setTimeout(_doFetchNewMessages, 350);
        }

        async function _doFetchNewMessages() {
            if (!currentConversationId) return;
            const conversaIdNum = parseInt(currentConversationId);
            if (isNaN(conversaIdNum)) return;
            const messagesEl = document.getElementById('chatMessages');
            if (!messagesEl) return;

            try {
                // Encontrar o maior ID real de mensagem exibida na UI
                let maxId = 0;
                messagesEl.querySelectorAll('[data-message-id]').forEach(function (el) {
                    const id = parseInt(el.getAttribute('data-message-id'));
                    if (!isNaN(id) && id > maxId) maxId = id;
                });

                // Se não há mensagens na UI (pode ser sync em andamento), não buscar
                if (maxId === 0) return;

                // Buscar mensagens com ID > maxId
                const { data: newMessages, error } = await supabase
                    .from('SAAS_Mensagens')
                    .select('*')
                    .eq('conversaId', conversaIdNum)
                    .eq('apagada', false)
                    .gt('id', maxId)
                    .order('id', { ascending: true })
                    .limit(50);

                if (error || !newMessages || newMessages.length === 0) return;

                // Verificar se ainda estamos na mesma conversa
                if (String(currentConversationId) !== String(conversaIdNum)) return;

                // Buscar mensagens respondidas se necessário
                const repliedIds = [];
                newMessages.forEach(function (m) {
                    if (m.mensagemRespondida && repliedIds.indexOf(m.mensagemRespondida) === -1) {
                        repliedIds.push(m.mensagemRespondida);
                    }
                });
                var repliedMap = {};
                if (repliedIds.length > 0) {
                    var resp = await supabase
                        .from('SAAS_Mensagens')
                        .select('id, mensagem, fromMe, tipoMensagem, arquivoUrl, messageEvolutionId')
                        .in('messageEvolutionId', repliedIds);
                    if (resp.data) resp.data.forEach(function (r) { repliedMap[r.messageEvolutionId] = r; });
                }

                // Renderizar e adicionar novas mensagens
                var added = 0;
                newMessages.forEach(function (msg) {
                    var msgId = msg.id ? msg.id.toString() : null;
                    // Pular se já existe na UI (evita duplicação com Realtime de mensagens)
                    if (msgId && messagesEl.querySelector('[data-message-id="' + msgId + '"]')) return;

                    var html = renderMessageHtml(msg, repliedMap);
                    messagesEl.insertAdjacentHTML('beforeend', html);
                    added++;
                });

                if (added > 0) {
                    initAudioWidgetDurations(messagesEl);
                    messagesEl.scrollTop = messagesEl.scrollHeight;
                    console.log('✅ ' + added + ' nova(s) mensagem(ns) adicionada(s) via fallback Realtime');

                    // Atualizar preview na lista de conversas
                    var lastMsg = newMessages[newMessages.length - 1];
                    var convItem = document.querySelector('[data-conversation-id="' + currentConversationId + '"]');
                    if (convItem && lastMsg) {
                        var preview = convItem.querySelector('.conversation-preview');
                        var time = convItem.querySelector('.conversation-time');
                        var tipoMsg = lastMsg.tipoMensagem || lastMsg.tipo_mensagem;
                        if (preview) preview.textContent = getConversationPreviewText(lastMsg.mensagem || '', tipoMsg);
                        if (time) time.textContent = 'Agora';
                    }
                }
            } catch (err) {
                console.error('❌ Erro ao buscar novas mensagens (fallback):', err);
            }
        }

        // ============================================
        // INICIALIZAÇÃO
        // ============================================

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

        /**
         * Inicializa a aplicação
         * Carrega conversas e configura o tema
         */
        async function init() {
            console.log('🚀 Inicializando chat...');
            console.log('📋 Estado do DOM:', document.readyState);

            // Inicializar Supabase primeiro
            initSupabase();
            carregarVersao();
            
            // setupAuthListeners já foi chamado imediatamente após initSupabase()
            // Aguardar um pouco para garantir que INITIAL_SESSION seja processado
            await new Promise(resolve => setTimeout(resolve, 100));
            
            // Verificar sessão
            try {
                const { data: { session } } = await supabase.auth.getSession();
                if (!session || !session.access_token) {
                    console.warn('⚠️ Nenhuma sessão encontrada');
                }
            } catch (error) {
                console.warn('⚠️ Erro ao obter sessão:', error);
            }
            
            // Obter contaId do Supabase Auth (não dos cookies)
            let userIdFromTable;
            try {
                userIdFromTable = await getUserIdFromAuth();
            } catch (error) {
                if (error.message === 'STATUS_BLOQUEADO') {
                    return; // Já foi redirecionado
                }
                throw error;
            }
            if (userIdFromTable) {
                currentUserId = userIdFromTable;
            }
            
            // Inicializar dark mode primeiro
            initDarkMode();
            initMenuOcultar();
            
            // Liberar áudio de notificação no primeiro clique/toque (exigido pelo navegador)
            document.addEventListener('click', unlockNotificationAudio, { once: true });
            document.addEventListener('touchstart', unlockNotificationAudio, { once: true });
            
            // Players customizados (áudio e vídeo, estilo WhatsApp)
            setupAudioPlayers();
            setupVideoPlayers();
            
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
            
            // Carregar conversas do Supabase
            // Se currentUserId já foi definido pelo INITIAL_SESSION, carregar conversas
            // Caso contrário, tentar obter da tabela SAAS_Usuarios novamente
            if (!currentUserId) {
                let userIdFromTable;
                try {
                    userIdFromTable = await getUserIdFromAuth();
                } catch (error) {
                    if (error.message === 'STATUS_BLOQUEADO') {
                        return; // Já foi redirecionado
                    }
                    throw error;
                }
                if (userIdFromTable) {
                    currentUserId = userIdFromTable;
                }
            }
            
            if (currentUserId) {
                _initAlreadyLoadedConversations = true;
                await loadConversations(); // Carrega aberto, mostra na tela e preenche cache
                updateConversationsFilterToggleActive();
                // Prefetch das outras abas em background para troca instantânea ao clicar (só sem filtros que invalidam cache)
                if (!shouldSkipConversationCache()) {
                    loadConversations('aguardando', false, { onlyCache: true });
                    loadConversations('fechado', false, { onlyCache: true });
                    loadConversations('agente-ia', false, { onlyCache: true });
                }
                await applyPendingConversaFromSessionStorage();
                await applyDeepLinkedConversation();
            } else {
                console.warn('⚠️ UserId não encontrado na tabela SAAS_Usuarios');
                const scrollEl = document.getElementById('conversationsScroll');
                const loadingEl = document.getElementById('conversationsLoading');
                if (loadingEl) loadingEl.style.display = 'none';
                if (scrollEl) {
                    scrollEl.innerHTML = '<div style="padding: 20px; text-align: center; color: #888;">Faça login para ver suas conversas</div>';
                }
            }

            /* Mobile: mostrar lista de conversas ao carregar (viewport ≤768px) */
            const conversationsListEl = document.getElementById('conversationsList');
            if (conversationsListEl && window.innerWidth <= 768) {
                conversationsListEl.classList.add('show');
            }

            console.log('✅ Chat inicializado com sucesso!');
            console.log('📡 Realtime será ativado automaticamente ao carregar conversas');
        }

        /**
         * Abre o modal de salvar contato
         * @param {string} phone - Telefone do contato (já preenchido)
         */
        async function openSaveContactModal(phone) {
            const modal = document.getElementById('saveContactModal');
            const phoneInput = document.getElementById('contactPhone');
            const nameInput = document.getElementById('contactName');
            
            if (!modal || !phoneInput || !nameInput) {
                console.error('❌ Elementos do modal não encontrados');
                return;
            }
            
            // Limpar telefone removendo @s.whatsapp.net se existir
            const cleanPhone = phone ? phone.replace('@s.whatsapp.net', '') : '';
            phoneInput.value = cleanPhone;
            
            // Nome atual em SAAS_Contatos (via conversa.contatoId)
            let nomeAtual = '';
            if (currentConversationId) {
                try {
                    const conversaIdNum = parseInt(currentConversationId);
                    if (!isNaN(conversaIdNum)) {
                        const { data: conversaData } = await supabase
                            .from('SAAS_Conversas_Agentes')
                            .select('contatoId, contato:SAAS_Contatos!contatoId(nome)')
                            .eq('id', conversaIdNum)
                            .single();
                        const n = conversaData?.contato?.nome != null ? String(conversaData.contato.nome).trim() : '';
                        if (n) nomeAtual = n;
                        else if (conversaData?.contatoId) {
                            const { data: ct } = await supabase
                                .from('SAAS_Contatos')
                                .select('nome')
                                .eq('id', conversaData.contatoId)
                                .maybeSingle();
                            if (ct?.nome != null) nomeAtual = String(ct.nome).trim();
                        }
                    }
                } catch (error) {
                    console.warn('⚠️ Erro ao buscar nome do contato:', error);
                }
            }
            
            nameInput.value = nomeAtual; // Preencher com nome atual ou vazio
            nameInput.focus();
            modal.classList.add('active');
        }

        /**
         * Fecha o modal de salvar contato
         */
        function closeSaveContactModal() {
            const modal = document.getElementById('saveContactModal');
            if (modal) {
                modal.classList.remove('active');
            }
        }

        /**
         * Salva o nome em SAAS_Contatos.nome (vincula contato à conversa se ainda não houver contatoId).
         * @param {Event} event - Evento do formulário
         */
        async function saveContact(event) {
            event.preventDefault();
            
            const nameInput = document.getElementById('contactName');
            
            if (!nameInput) {
                console.error('❌ Campo do formulário não encontrado');
                return;
            }
            
            const nome = nameInput.value.trim();
            
            if (!nome) {
                showToast('Por favor, preencha o nome do contato.', 'error');
                return;
            }
            
            if (!currentConversationId) {
                showToast('Erro: nenhuma conversa selecionada.', 'error');
                return;
            }
            
            const { data: { session } } = await supabase.auth.getSession();
            if (!session || !session.access_token) {
                console.error('❌ Sem sessão/JWT - faça login novamente');
                showToast('Sem sessão/JWT - faça login novamente', 'error');
                return;
            }
            
            try {
                const conversaIdNum = parseInt(currentConversationId);
                if (isNaN(conversaIdNum)) {
                    showToast('Erro: ID da conversa inválido.', 'error');
                    return;
                }

                const { data: convRow, error: convErr } = await supabase
                    .from('SAAS_Conversas_Agentes')
                    .select('contatoId, telefone, contaId')
                    .eq('id', conversaIdNum)
                    .single();

                if (convErr || !convRow) {
                    console.error('❌ Erro ao carregar conversa:', convErr);
                    showToast('Erro ao carregar conversa. Tente novamente.', 'error');
                    return;
                }

                let contatoId = convRow.contatoId;

                if (!contatoId && convRow.telefone && convRow.contaId) {
                    const { data: existing } = await supabase
                        .from('SAAS_Contatos')
                        .select('id')
                        .eq('contaId', convRow.contaId)
                        .eq('telefone', convRow.telefone)
                        .maybeSingle();
                    if (existing?.id) {
                        contatoId = existing.id;
                        const { error: linkErr } = await supabase
                            .from('SAAS_Conversas_Agentes')
                            .update({ contatoId })
                            .eq('id', conversaIdNum);
                        if (linkErr) {
                            console.error('❌ Erro ao vincular contato:', linkErr);
                            showToast('Erro ao vincular contato à conversa.', 'error');
                            return;
                        }
                    }
                }

                if (!contatoId) {
                    if (!convRow.telefone || !convRow.contaId) {
                        showToast('Conversa sem telefone ou conta; não é possível criar o contato.', 'error');
                        return;
                    }
                    const { data: inserted, error: insErr } = await supabase
                        .from('SAAS_Contatos')
                        .insert({
                            nome,
                            telefone: convRow.telefone,
                            tipo: 'contato',
                            contaId: convRow.contaId,
                            variaveis: {}
                        })
                        .select('id')
                        .single();
                    if (insErr) {
                        if (insErr.code === '23505') {
                            const { data: dup } = await supabase
                                .from('SAAS_Contatos')
                                .select('id')
                                .eq('contaId', convRow.contaId)
                                .eq('telefone', convRow.telefone)
                                .maybeSingle();
                            if (!dup?.id) {
                                console.error('❌ Insert contato:', insErr);
                                showToast('Erro ao salvar contato. Tente novamente.', 'error');
                                return;
                            }
                            contatoId = dup.id;
                            const { error: linkDupErr } = await supabase
                                .from('SAAS_Conversas_Agentes')
                                .update({ contatoId })
                                .eq('id', conversaIdNum);
                            if (linkDupErr) {
                                console.error('❌ Erro ao vincular contato existente:', linkDupErr);
                                showToast('Erro ao vincular contato à conversa.', 'error');
                                return;
                            }
                        } else {
                            console.error('❌ Insert contato:', insErr);
                            showToast('Erro ao salvar contato. Tente novamente.', 'error');
                            return;
                        }
                    } else if (inserted?.id) {
                        contatoId = inserted.id;
                        const { error: linkErr } = await supabase
                            .from('SAAS_Conversas_Agentes')
                            .update({ contatoId })
                            .eq('id', conversaIdNum);
                        if (linkErr) {
                            console.error('❌ Erro ao vincular novo contato:', linkErr);
                            showToast('Contato criado, mas falhou ao vincular à conversa.', 'error');
                            return;
                        }
                    } else {
                        showToast('Erro ao criar contato.', 'error');
                        return;
                    }
                }

                if (!contatoId) {
                    showToast('Não foi possível identificar o contato.', 'error');
                    return;
                }

                const { error: upErr } = await supabase
                    .from('SAAS_Contatos')
                    .update({ nome })
                    .eq('id', contatoId)
                    .eq('contaId', convRow.contaId);

                if (upErr) {
                    console.error('❌ Erro ao salvar nome do contato:', upErr);
                    showToast('Erro ao salvar nome do contato. Tente novamente.', 'error');
                    return;
                }

                currentConversationContatoId = contatoId;
                void populateContactDetailsSidePanelExtras();

                const chatHeaderName = document.querySelector('.chat-header-name');
                if (chatHeaderName) chatHeaderName.textContent = nome;
                currentContactName = nome;

                const conversationItem = document.querySelector(`[data-conversation-id="${currentConversationId}"]`);
                if (conversationItem) {
                    const conversationName = conversationItem.querySelector('.conversation-name');
                    if (conversationName) conversationName.textContent = nome;
                }

                await loadConversations();

                closeSaveContactModal();
                showToast('Nome do contato salvo com sucesso!', 'success');
            } catch (error) {
                console.error('❌ Erro ao salvar nome do contato:', error);
                showToast('Erro ao salvar nome do contato. Tente novamente.', 'error');
            }
        }

        /** Cache de contatos para o modal "Nova conversa" */
        let newConvContactsCache = [];
        let newConvSelectedContact = null;
        let newConvMode = 'existing';

        function normalizeTelefoneToWhatsappJid(raw) {
            const t = String(raw || '').trim();
            if (!t) return '';
            if (t.toLowerCase().includes('@')) {
                return t.replace(/\s/g, '');
            }
            const digits = t.replace(/\D/g, '');
            if (!digits) return '';
            return digits + '@s.whatsapp.net';
        }

        function fillNewConvConexaoSelect() {
            const sel = document.getElementById('newConvConexaoSelect');
            if (!sel) return;
            const opts = (userConnectionsCache || []).map(c => {
                const name = (c.NomeConexao || c.instanceName || 'Conexão ' + c.id) || ('Conexão ' + c.id);
                return `<option value="${c.id}">${escapeHtml(name)}</option>`;
            }).join('');
            sel.innerHTML = '<option value="">Selecione a conexão</option>' + opts;
            let def = currentConversationsConexaoIds.length === 1 ? currentConversationsConexaoIds[0] : null;
            if (def != null && [...sel.options].some(o => o.value === String(def))) {
                sel.value = String(def);
            } else if (userConnectionsCache && userConnectionsCache.length === 1) {
                sel.value = String(userConnectionsCache[0].id);
            }
        }

        function setNewConversationMode(mode) {
            newConvMode = mode === 'new' ? 'new' : 'existing';
            document.querySelectorAll('.new-conv-tab').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-mode') === newConvMode);
            });
            const pEx = document.getElementById('newConvPanelExisting');
            const pNw = document.getElementById('newConvPanelNew');
            if (pEx) pEx.hidden = newConvMode !== 'existing';
            if (pNw) pNw.hidden = newConvMode !== 'new';
        }

        function renderNewConvContactsList(filterText) {
            const wrap = document.getElementById('newConvContactsList');
            if (!wrap) return;
            const q = (filterText || '').toLowerCase().trim().normalize('NFD').replace(/\p{M}/gu, '');
            const rows = newConvContactsCache.filter(c => {
                const tel = c.telefone != null ? String(c.telefone).trim() : '';
                if (!tel) return false;
                if (!q) return true;
                const n = (c.nome || '').toLowerCase().normalize('NFD').replace(/\p{M}/gu, '');
                const t = tel.toLowerCase();
                return n.includes(q) || t.includes(q);
            }).slice(0, 250);
            if (!rows.length) {
                wrap.innerHTML = '<div class="new-conv-contacts-empty">Nenhum contato com telefone. Ajuste a busca ou use &quot;Novo número&quot;.</div>';
                return;
            }
            wrap.innerHTML = rows.map(c => {
                const nome = escapeHtml((c.nome && String(c.nome).trim()) || 'Sem nome');
                const telDisp = escapeHtml(cleanPhoneNumber(c.telefone));
                return `<button type="button" class="new-conv-contact-row" data-contact-id="${c.id}"><span class="new-conv-contact-name">${nome}</span><span class="new-conv-contact-phone">${telDisp}</span></button>`;
            }).join('');
            wrap.querySelectorAll('.new-conv-contact-row').forEach(btn => {
                btn.addEventListener('click', () => {
                    wrap.querySelectorAll('.new-conv-contact-row').forEach(b => b.classList.remove('selected'));
                    btn.classList.add('selected');
                    const id = parseInt(btn.getAttribute('data-contact-id'), 10);
                    const c = newConvContactsCache.find(x => Number(x.id) === id);
                    if (!c) return;
                    newConvSelectedContact = {
                        id: c.id,
                        telefone: c.telefone,
                        nome: (c.nome && String(c.nome).trim()) || cleanPhoneNumber(c.telefone) || 'Contato'
                    };
                    const hint = document.getElementById('newConvSelectedHint');
                    if (hint) hint.textContent = 'Selecionado: ' + newConvSelectedContact.nome;
                });
            });
        }

        async function openNewConversationModal() {
            const modal = document.getElementById('newConversationModal');
            if (!modal) return;
            newConvSelectedContact = null;
            const hint = document.getElementById('newConvSelectedHint');
            if (hint) hint.textContent = '';
            const search = document.getElementById('newConvContactSearch');
            if (search) search.value = '';
            const nn = document.getElementById('newConvNewNome');
            const nt = document.getElementById('newConvNewTelefone');
            if (nn) nn.value = '';
            if (nt) nt.value = '';
            setNewConversationMode('existing');

            try {
                const contaId = await getUserIdFromAuth();
                if (!contaId) {
                    showToast('Faça login para iniciar uma conversa.', 'error');
                    return;
                }
                currentUserId = contaId;
                if (!userConnectionsCache || userConnectionsCache.length === 0) {
                    await loadUserConnections();
                }
                fillNewConvConexaoSelect();
                if (!userConnectionsCache || userConnectionsCache.length === 0) {
                    showToast('Cadastre uma conexão WhatsApp para iniciar conversas.', 'error');
                    return;
                }

                const { data, error } = await supabase
                    .from('SAAS_Contatos')
                    .select('id, nome, telefone')
                    .eq('contaId', contaId)
                    .eq('tipo', 'contato')
                    .order('nome', { ascending: true, nullsFirst: false })
                    .limit(1000);
                if (error) {
                    console.warn('Contatos para nova conversa:', error);
                    newConvContactsCache = [];
                    renderNewConvContactsList('');
                } else {
                    newConvContactsCache = data || [];
                    renderNewConvContactsList('');
                }
            } catch (e) {
                if (e && e.message === 'STATUS_BLOQUEADO') return;
                console.error('openNewConversationModal:', e);
                showToast('Não foi possível abrir o assistente.', 'error');
                return;
            }

            modal.classList.add('active');
        }

        function closeNewConversationModal() {
            const modal = document.getElementById('newConversationModal');
            if (modal) modal.classList.remove('active');
        }

        async function findConversaIdForTelefoneConexao(contaId, idConexao, telefoneJid) {
            const { data, error } = await supabase
                .from('SAAS_Conversas_Agentes')
                .select('id')
                .eq('contaId', contaId)
                .eq('idConexao', idConexao)
                .eq('telefone', telefoneJid)
                .maybeSingle();
            if (error || !data) return null;
            return data.id;
        }

        async function openOrCreateConversationAndSelect(contaId, idConexao, telefoneJid, contatoId, displayName) {
            const exId = await findConversaIdForTelefoneConexao(contaId, idConexao, telefoneJid);
            if (exId) {
                closeNewConversationModal();
                document.querySelectorAll('.conversations-status-filters .status-filter-btn').forEach(btn => {
                    btn.classList.toggle('active', btn.getAttribute('data-status') === 'aberto');
                });
                currentConversationsStatusFilter = 'aberto';
                conversationsPaginationState.offset = 0;
                conversationsPaginationState.hasMore = true;
                await loadConversations('aberto', false);
                await selectConversation(String(exId), displayName);
                fetchConversationCountsByStatus();
                return;
            }

            const insertPayload = {
                telefone: telefoneJid,
                idConexao: Number(idConexao),
                contaId,
                contatoId: contatoId != null ? Number(contatoId) : null,
                statusAtendimento: 'aberto',
                pausado: true,
                lida: true
            };

            const { data: ins, error: insErr } = await supabase
                .from('SAAS_Conversas_Agentes')
                .insert(insertPayload)
                .select('id')
                .single();

            if (insErr) {
                console.error('insert conversa:', insErr);
                showToast(insErr.message || 'Erro ao criar conversa.', 'error');
                return;
            }

            closeNewConversationModal();
            document.querySelectorAll('.conversations-status-filters .status-filter-btn').forEach(btn => {
                btn.classList.toggle('active', btn.getAttribute('data-status') === 'aberto');
            });
            currentConversationsStatusFilter = 'aberto';
            conversationsPaginationState.offset = 0;
            conversationsPaginationState.hasMore = true;
            await loadConversations('aberto', false);
            await selectConversation(String(ins.id), displayName);
            fetchConversationCountsByStatus();
            showToast('Nova conversa criada.', 'success');
        }

        async function submitNewConversationExisting() {
            const sel = document.getElementById('newConvConexaoSelect');
            const idConexao = sel && sel.value ? parseInt(sel.value, 10) : NaN;
            if (!idConexao || Number.isNaN(idConexao)) {
                showToast('Selecione a conexão WhatsApp.', 'error');
                return;
            }
            if (!newConvSelectedContact || !newConvSelectedContact.telefone) {
                showToast('Escolha um contato na lista.', 'error');
                return;
            }
            const { data: { session } } = await supabase.auth.getSession();
            if (!session) {
                showToast('Sessão expirada. Faça login novamente.', 'error');
                return;
            }
            let contaId = currentUserId;
            if (!contaId) {
                contaId = await getUserIdFromAuth();
                if (!contaId) return;
                currentUserId = contaId;
            }
            const jid = normalizeTelefoneToWhatsappJid(newConvSelectedContact.telefone);
            if (!jid) {
                showToast('Telefone do contato inválido.', 'error');
                return;
            }
            await openOrCreateConversationAndSelect(contaId, idConexao, jid, newConvSelectedContact.id, newConvSelectedContact.nome);
        }

        async function submitNewConversationNew() {
            const sel = document.getElementById('newConvConexaoSelect');
            const idConexao = sel && sel.value ? parseInt(sel.value, 10) : NaN;
            if (!idConexao || Number.isNaN(idConexao)) {
                showToast('Selecione a conexão WhatsApp.', 'error');
                return;
            }
            const nomeInput = document.getElementById('newConvNewNome');
            const ddiSel = document.getElementById('newConvNewDDI');
            const phoneInput = document.getElementById('newConvNewTelefone');
            const nome = (nomeInput && nomeInput.value) ? nomeInput.value.trim() : '';
            if (!nome) {
                showToast('Informe o nome do contato.', 'error');
                return;
            }
            const ddi = (ddiSel && ddiSel.value) ? String(ddiSel.value).replace(/\D/g, '') : '55';
            const phoneLocal = (phoneInput && phoneInput.value) ? phoneInput.value.replace(/\D/g, '') : '';
            if (!phoneLocal || phoneLocal.length < 8) {
                showToast('Informe o telefone com DDD (apenas números).', 'error');
                return;
            }
            const fullDigits = ddi + phoneLocal;
            const jid = fullDigits + '@s.whatsapp.net';

            const { data: { session } } = await supabase.auth.getSession();
            if (!session) {
                showToast('Sessão expirada. Faça login novamente.', 'error');
                return;
            }
            let contaId = currentUserId;
            if (!contaId) {
                contaId = await getUserIdFromAuth();
                if (!contaId) return;
                currentUserId = contaId;
            }

            let contatoId = null;
            const { data: existC } = await supabase
                .from('SAAS_Contatos')
                .select('id')
                .eq('contaId', contaId)
                .eq('telefone', jid)
                .maybeSingle();
            if (existC && existC.id) {
                contatoId = existC.id;
                if (nome) {
                    await supabase.from('SAAS_Contatos').update({ nome }).eq('id', contatoId).eq('contaId', contaId);
                }
            } else {
                const { data: insC, error: errC } = await supabase
                    .from('SAAS_Contatos')
                    .insert({
                        nome: nome || null,
                        telefone: jid,
                        tipo: 'contato',
                        contaId,
                        variaveis: {}
                    })
                    .select('id')
                    .single();
                if (errC) {
                    if (errC.code === '23505') {
                        const { data: dup } = await supabase
                            .from('SAAS_Contatos')
                            .select('id')
                            .eq('contaId', contaId)
                            .eq('telefone', jid)
                            .maybeSingle();
                        contatoId = dup && dup.id ? dup.id : null;
                    } else {
                        console.error('insert contato:', errC);
                        showToast(errC.message || 'Erro ao criar contato.', 'error');
                        return;
                    }
                } else if (insC && insC.id) {
                    contatoId = insC.id;
                }
            }

            const displayName = nome || cleanPhoneNumber(jid) || 'Novo contato';
            await openOrCreateConversationAndSelect(contaId, idConexao, jid, contatoId, displayName);
        }

        window.openNewConversationModal = openNewConversationModal;
        window.closeNewConversationModal = closeNewConversationModal;
        window.setNewConversationMode = setNewConversationMode;
        window.submitNewConversationExisting = submitNewConversationExisting;
        window.submitNewConversationNew = submitNewConversationNew;

        window.selectConversation = selectConversation;
        window.toggleChatHeaderMetaExpanded = toggleChatHeaderMetaExpanded;
        window.openChatHeaderContactDetails = openChatHeaderContactDetails;
        window.openConversationContactDetailsFromList = openConversationContactDetailsFromList;
        window.showConversationTagsPreview = showConversationTagsPreview;
        window.moveConversationTagsPreview = moveConversationTagsPreview;
        window.hideConversationTagsPreview = hideConversationTagsPreview;
        window.showConversationCrmPreview = showConversationCrmPreview;
        window.moveConversationCrmPreview = moveConversationCrmPreview;
        window.hideConversationCrmPreview = hideConversationCrmPreview;
        window.setConversationsStatusFilter = setConversationsStatusFilter;
        window.sendMessage = sendMessage;
        window.handleKeyPress = handleKeyPress;
        window.showMessageOptions = showMessageOptions;
        window.replyToMessage = replyToMessage;
        window.cancelReply = cancelReply;

        // Clique no preview da mensagem respondida: rolar até a mensagem e dar glow
        document.addEventListener('click', (e) => {
            const preview = e.target.closest('.message-reply-preview');
            if (!preview) return;
            const messageId = preview.getAttribute('data-reply-to-message-id');
            const evolutionId = preview.getAttribute('data-reply-to-evolution-id');
            let target = null;
            if (messageId) {
                try {
                    target = document.querySelector(`[data-message-id="${CSS.escape(messageId)}"]`);
                } catch (_) {
                    target = document.querySelector(`[data-message-id="${messageId}"]`);
                }
            }
            if (!target && evolutionId) {
                try {
                    target = document.querySelector(`[data-message-evolution-id="${CSS.escape(evolutionId)}"]`);
                } catch (_) {
                    target = document.querySelector(`[data-message-evolution-id="${evolutionId}"]`);
                }
            }
            if (!target) return;
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
            target.classList.remove('glow');
            target.offsetHeight;
            target.classList.add('glow');
            clearTimeout(target._glowTimeout);
            target._glowTimeout = setTimeout(() => target.classList.remove('glow'), 2000);
        });
        /**
         * Mostra uma notificação toast
         * @param {string} message - Mensagem a ser exibida
         * @param {string} type - Tipo da notificação ('success', 'error', 'info')
         */
        function showToast(message, type = 'info') {
            if (typeof statusBloqueado !== 'undefined' && statusBloqueado) {
                return;
            }
            const toastContainer = document.getElementById('toastContainer');
            if (!toastContainer) {
                console.warn('⚠️ Toast container não encontrado');
                return;
            }
            
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
            
            // Trigger animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, 5000);
        }

        window.openSaveContactModal = openSaveContactModal;
        window.closeSaveContactModal = closeSaveContactModal;
        window.saveContact = saveContact;
        window.showToast = showToast;

        bindEditMessageModalControls();

        // Executar quando DOM estiver pronto
        // setupAuthListeners já foi chamado acima (após initSupabase)
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            // DOM já está pronto, executar imediatamente
            init();
        }
    </script>

    <!-- Nova conversa: contato existente ou novo número -->
    <div class="modal-overlay save-contact-modal-overlay" id="newConversationModal" onclick="if(event.target === this) closeNewConversationModal()">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Nova conversa</h2>
                <button type="button" class="modal-close" onclick="closeNewConversationModal()" aria-label="Fechar" title="Fechar">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="newConvConexaoSelect">Conexão WhatsApp</label>
                    <select id="newConvConexaoSelect" class="form-select" required></select>
                </div>
                <div class="new-conv-mode-tabs" role="tablist">
                    <button type="button" class="new-conv-tab active" data-mode="existing" onclick="window.setNewConversationMode('existing')">Contato salvo</button>
                    <button type="button" class="new-conv-tab" data-mode="new" onclick="window.setNewConversationMode('new')">Novo número</button>
                </div>
                <div id="newConvPanelExisting">
                    <div class="form-group">
                        <label class="form-label" for="newConvContactSearch">Buscar contato</label>
                        <input type="text" id="newConvContactSearch" class="form-input" placeholder="Nome ou telefone..." autocomplete="off">
                    </div>
                    <div id="newConvContactsList" class="new-conv-contacts-list" role="listbox" aria-label="Lista de contatos"></div>
                    <p class="new-conv-selected-hint" id="newConvSelectedHint"></p>
                    <div class="modal-footer new-conv-modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeNewConversationModal()">Cancelar</button>
                        <button type="button" class="btn" onclick="window.submitNewConversationExisting()">Abrir conversa</button>
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
                        <button type="button" class="btn btn-secondary" onclick="closeNewConversationModal()">Cancelar</button>
                        <button type="button" class="btn" onclick="window.submitNewConversationNew()">Criar e abrir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal confirmar exclusão da mensagem -->
    <div class="modal-overlay save-contact-modal-overlay" id="deleteMessageModal" onclick="if(event.target === this) closeDeleteMessageConfirm()">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Excluir mensagem</h2>
                <button type="button" class="modal-close" onclick="closeDeleteMessageConfirm()" aria-label="Fechar" title="Fechar">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteMessageHiddenId" value="">
                <p style="margin:0;color:inherit;opacity:0.9;line-height:1.45;">Excluir para todos? A mensagem será removida no WhatsApp para você e para o contato.</p>
                <div class="modal-footer delete-message-modal-footer">
                    <button type="button" class="btn btn-secondary" id="deleteMessageCancelBtn" onclick="closeDeleteMessageConfirm()">Cancelar</button>
                    <button type="button" class="btn" id="deleteMessageConfirmBtn" onclick="submitDeleteMessageForEveryone()" style="background:#c62828;">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar mensagem (texto) -->
    <div class="modal-overlay save-contact-modal-overlay" id="editMessageModal" onclick="if(event.target === this) closeEditMessageModal()">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Editar mensagem</h2>
                <button type="button" class="modal-close" onclick="closeEditMessageModal()" aria-label="Fechar" title="Fechar">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editMessageHiddenId" value="">
                <input type="hidden" id="editMessageEvolutionIdHidden" value="">
                <div class="form-group">
                    <label class="form-label" for="editMessageTextInput">Texto</label>
                    <textarea id="editMessageTextInput" class="form-input" rows="5" placeholder="Digite o novo texto" style="min-height:120px;resize:vertical;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="editMessageCancelBtn" onclick="closeEditMessageModal()">Cancelar</button>
                    <button type="button" class="btn" id="editMessageSaveBtn">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Salvar Contato (layout alinhado a contatos.html — addContactModal) -->
    <div class="modal-overlay save-contact-modal-overlay" id="saveContactModal" onclick="if(event.target === this) closeSaveContactModal()">
        <div class="modal-box" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title" id="saveContactModalTitle">Salvar contato</h2>
                <button type="button" class="modal-close" onclick="closeSaveContactModal()" aria-label="Fechar" title="Fechar">&times;</button>
            </div>
            <form id="saveContactForm" class="modal-body" onsubmit="saveContact(event)">
                <div class="form-group">
                    <label class="form-label" for="contactName">Nome</label>
                    <input type="text" id="contactName" name="contactName" class="form-input" placeholder="Nome do contato" required autocomplete="name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="contactPhone">Telefone</label>
                    <input type="text" id="contactPhone" name="contactPhone" class="form-input" placeholder="Telefone" readonly autocomplete="tel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeSaveContactModal()">Cancelar</button>
                    <button type="submit" class="btn">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toasts por cima dos modais (z-index no CSS) -->
    <div class="toast-container" id="toastContainer"></div>
</body>
</html>