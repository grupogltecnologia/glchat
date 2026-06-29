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
    <title>Dashboard - IA Chatconversa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/hublabel/public/assets/images/favicon">
    <link rel="shortcut icon" type="image/png" href="/hublabel/public/assets/images/favicon">
    <link rel="apple-touch-icon" href="/hublabel/public/assets/images/favicon">
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
            color-scheme: dark;
        }

        /* Dark Mode - página inteira */
        body.dark-mode .main-content {
            background: transparent;
        }

        body.dark-mode .header-info h1,
        body.dark-mode .header h1 {
            color: #f8fafc;
        }

        body.dark-mode .header-info p,
        body.dark-mode .header p {
            color: #94a3b8;
        }

        body.dark-mode .header-filters .filter-pills-row {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(71, 85, 105, 0.5);
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        body.dark-mode .header-filters .btn-date-range {
            color: #94a3b8;
        }

        body.dark-mode .header-filters .btn-date-range:hover {
            color: #f8fafc;
            background: rgba(51, 65, 85, 0.6);
        }

        body.dark-mode .header-filters .btn-date-range.active {
            background: #1e293b;
            color: white;
        }

        body.dark-mode .filter-date-sep {
            background: rgba(71, 85, 105, 0.5);
        }

        body.dark-mode .filter-date-range,
        body.dark-mode .filter-date-dash {
            color: #94a3b8;
        }

        body.dark-mode .header-filters .filter-select-inline {
            color: #e2e8f0;
            background-color: transparent;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            border-radius: 9999px;
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        body.dark-mode .header-filters .filter-select-inline:hover {
            color: #f8fafc;
            background-color: rgba(51, 65, 85, 0.55);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        }

        body.dark-mode .header-filters .filter-select-inline:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.35);
        }

        body.dark-mode .header-filters .filter-select-inline option {
            background: #1e293b;
            color: #e2e8f0;
        }

        body.dark-mode .hero-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        body.dark-mode .hero-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.25);
        }

        body.dark-mode .hero-card-title {
            color: #94a3b8;
        }

        body.dark-mode .hero-card-value {
            color: #f8fafc;
        }

        body.dark-mode .hero-card-value-empty {
            color: #64748b;
        }

        body.dark-mode .hero-card-trend.hero-trend-up,
        body.dark-mode .hero-card-trend.hero-trend-down {
            background: rgba(108, 99, 255, 0.15);
            color: #6C63FF;
        }

        body.dark-mode .hero-card-sub {
            color: #94a3b8;
            background: rgba(51, 65, 85, 0.5);
        }

        body.dark-mode .hero-card-unit {
            color: #94a3b8;
        }

        body.dark-mode .hero-mini-chart-svg.hero-mini-chart-empty svg {
            color: #475569;
        }

        body.dark-mode .stat-card,
        body.dark-mode .stat-card-compact {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .stat-card:hover,
        body.dark-mode .stat-card-compact:hover {
            border-color: rgba(108, 99, 255, 0.3);
        }

        body.dark-mode .stat-title,
        body.dark-mode .stat-label {
            color: #94a3b8 !important;
        }

        body.dark-mode .stat-value {
            -webkit-text-fill-color: #6C63FF !important;
            color: #6C63FF !important;
        }

        body.dark-mode .stat-change.positive {
            color: #6C63FF !important;
        }

        body.dark-mode .stat-change.negative {
            color: #f87171 !important;
        }

        body.dark-mode .stat-change.neutral {
            color: #94a3b8 !important;
        }

        body.dark-mode .chart-container {
            background: rgba(30, 41, 59, 0.6) !important;
            border-color: rgba(71, 85, 105, 0.4) !important;
        }

        body.dark-mode .chart-title {
            color: #f8fafc !important;
        }

        body.dark-mode .chart-subtitle {
            color: #94a3b8 !important;
        }

        body.dark-mode .dashboard-section-title {
            color: #f8fafc !important;
            border-bottom-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .filter-wrap-box {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .filter-wrap-box .filter-label {
            color: #cbd5e1;
        }

        body.dark-mode .filter-wrap-box .filter-select {
            background: rgba(15, 23, 42, 0.6) !important;
            border-color: rgba(71, 85, 105, 0.5) !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .funnel-step {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .funnel-step:hover {
            background: rgba(51, 65, 85, 0.6);
        }

        body.dark-mode .funnel-step-label {
            color: #94a3b8;
        }

        body.dark-mode .funnel-step-value {
            color: #f8fafc;
        }

        body.dark-mode .funnel-visual-bar .funnel-bar-text {
            color: #e2e8f0;
        }

        body.dark-mode .funnel-visual-footer .footer-item p:first-child {
            color: #e2e8f0;
        }

        body.dark-mode .funnel-timeline-title {
            color: #e2e8f0;
        }

        body.dark-mode .funnel-timeline-title.muted {
            color: #94a3b8;
        }

        body.dark-mode .funnel-timeline-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .funnel-timeline-value {
            color: #f8fafc;
            background: rgba(51, 65, 85, 0.75);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        body.dark-mode .funnel-timeline-value.muted {
            color: #94a3b8;
            background: rgba(30, 41, 59, 0.85);
        }

        body.dark-mode .funnel-timeline-dot {
            border-color: rgba(15, 23, 42, 0.95);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
        }

        body.dark-mode .funnel-timeline-dot.inactive {
            background: #475569;
        }

        body.dark-mode .status-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .status-card:hover {
            background: rgba(51, 65, 85, 0.6);
        }

        body.dark-mode .status-card-label {
            color: #94a3b8;
        }

        body.dark-mode .status-card-value {
            color: #f8fafc;
        }

        body.dark-mode .dashboard-status-divider::before,
        body.dark-mode .dashboard-status-divider::after {
            background: rgba(71, 85, 105, 0.5);
        }

        body.dark-mode .dashboard-status-divider span {
            color: #94a3b8;
        }

        body.dark-mode .filters-container,
        body.dark-mode .filter-group {
            background: transparent !important;
            border: none !important;
        }

        body.dark-mode .filter-label {
            color: #cbd5e1 !important;
        }

        body.dark-mode .filter-select,
        body.dark-mode .filter-input {
            background: rgba(15, 23, 42, 0.6) !important;
            border-color: rgba(71, 85, 105, 0.5) !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .filter-select option {
            background: #1e293b !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .btn-secondary {
            background: rgba(51, 65, 85, 0.5);
            border-color: rgba(71, 85, 105, 0.5);
            color: #e2e8f0;
        }

        body.dark-mode .btn-secondary:hover {
            background: rgba(71, 85, 105, 0.6);
        }

        body.dark-mode .skeleton-card {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(71, 85, 105, 0.3);
        }

        body.dark-mode .skeleton-card .skeleton-icon,
        body.dark-mode .skeleton-card .skeleton-line {
            background: rgba(255, 255, 255, 0.08);
        }

        body.dark-mode .chart-options-btn {
            color: #94a3b8;
        }

        body.dark-mode .chart-options-btn:hover {
            color: #e2e8f0;
        }

        body.dark-mode .filter-input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1) brightness(1.2);
        }

        body.dark-mode .filter-input[type="date"]::-moz-calendar-picker-indicator {
            filter: invert(1) brightness(1.2);
        }

        /* Dark mode - interior dos gráficos e cards (evolução, CRM, Equipe, Disparos) */
        body.dark-mode .evolucao-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .evolucao-card-title {
            color: #f8fafc;
        }

        body.dark-mode .evolucao-card-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .evolucao-legend-pill {
            background: rgba(51, 65, 85, 0.6);
            border-color: rgba(71, 85, 105, 0.5);
        }

        body.dark-mode .evolucao-legend-item {
            color: #cbd5e1;
        }

        body.dark-mode .evolucao-legend-sep {
            background: rgba(71, 85, 105, 0.6);
        }

        body.dark-mode .crm-card,
        body.dark-mode .equipe-card,
        body.dark-mode .disparos-card {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .crm-card-title,
        body.dark-mode .equipe-card-title,
        body.dark-mode .disparos-card-title {
            color: #f8fafc;
        }

        body.dark-mode .crm-card-subtitle,
        body.dark-mode .equipe-card-subtitle,
        body.dark-mode .disparos-card-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .crm-filter-pill {
            background: rgba(51, 65, 85, 0.6);
            border-color: rgba(108, 99, 255, 0.5);
        }

        body.dark-mode .crm-inner-box {
            background: rgba(15, 23, 42, 0.5);
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .crm-inner-title {
            color: #94a3b8;
        }

        body.dark-mode .crm-inner-footer {
            border-top-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .crm-footer-label {
            color: #94a3b8;
        }

        body.dark-mode .crm-footer-valor {
            color: #6C63FF;
        }

        body.dark-mode .disparos-stat-label {
            color: #94a3b8;
        }

        body.dark-mode .disparos-stat-value {
            color: #f8fafc;
        }

        body.dark-mode .disparos-stat-divider {
            background: rgba(71, 85, 105, 0.5);
        }

        body.dark-mode .equipe-table th {
            color: #94a3b8;
            border-color: rgba(71, 85, 105, 0.4);
        }

        body.dark-mode .equipe-table td {
            border-color: rgba(71, 85, 105, 0.3);
            color: #e2e8f0;
        }

        body.dark-mode .perf-nome {
            color: #f8fafc;
        }

        body.dark-mode .perf-nome-unassigned,
        body.dark-mode .perf-row-inactive .perf-nome,
        body.dark-mode .perf-row-inactive .perf-qtd {
            color: #94a3b8;
        }

        body.dark-mode .perf-bar-wrap {
            background: rgba(51, 65, 85, 0.6);
        }

        body.dark-mode .perf-avatar-inactive {
            background: rgba(71, 85, 105, 0.6);
            color: #94a3b8;
        }

        body.dark-mode .perf-avatar-unassigned {
            border-color: rgba(71, 85, 105, 0.5);
            color: #94a3b8;
        }

        body.dark-mode .disparos-badge-ativo {
            background: rgba(108, 99, 255, 0.15);
            color: #a7f3d0;
        }

        body.dark-mode .equipe-link-ver-todos {
            color: #6C63FF;
        }

        body.dark-mode .equipe-table tbody tr:hover td {
            background: rgba(51, 65, 85, 0.4);
        }

        body.dark-mode .evolucao-options-btn {
            color: #94a3b8;
        }

        body.dark-mode .evolucao-options-btn:hover {
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

        /* Main content - design gemini.html */
        .main-content {
            flex: 1;
            padding: 32px 48px;
            overflow-x: auto;
            margin-left: 72px;
            background: #f4f4f5;
            min-height: 100vh;
            max-width: 1400px;
        }

        .header {
            margin-bottom: 48px;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            gap: 24px;
        }

        @media (min-width: 1024px) {
            .header { flex-direction: row; align-items: flex-end; justify-content: space-between; }
        }

        .header-info h1 {
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            margin-bottom: 8px;
            color: #18181b;
        }

        .header-info p {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .header-filters {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
        }

        .header-filters .filter-pills-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0;
            background: white;
            padding: 6px 8px;
            border-radius: 9999px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid #e2e8f0;
        }

        .header-filters .date-range-buttons {
            display: flex;
            gap: 1px;
        }

        .header-filters .btn-date-range {
            padding: 8px 20px;
            border: none;
            background: transparent;
            color: #64748b;
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .header-filters .btn-date-range:hover {
            color: #0f172a;
            background: #f8fafc;
        }

        .header-filters .btn-date-range.active {
            background: #6C63FF;
            color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.15);
        }

        .filter-date-sep {
            width: 1px;
            height: 24px;
            background: #e2e8f0;
            margin: 0 12px;
        }

        .filter-date-range {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #64748b;
            padding: 0 8px;
        }

        .filter-date-dash {
            color: #cbd5e1;
            margin: 0 2px;
        }

        .filter-select-inline {
            background: transparent;
            border: none;
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            padding: 8px 28px 8px 12px;
            cursor: pointer;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }

        .filter-select-inline:hover {
            color: #334155;
        }
        .btn-refresh-header {
            width: 40px;
            height: 40px;
            padding: 0;
            background: #6C63FF;
            border: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .btn-refresh-header:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.35);
        }

        .btn-refresh {
            padding: 10px 18px;
            background: #6C63FF;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-refresh:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.35);
        }

        .btn-refresh:disabled {
            background: #444;
            cursor: not-allowed;
            transform: none;
        }

        /* Hero cards - design gemini.html (rounded-[2rem], shadow-soft) */
        .dashboard-hero-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (min-width: 1280px) {
            .dashboard-hero-cards { grid-template-columns: repeat(4, 1fr); }
        }

        .hero-card {
            background: white;
            border-radius: 2rem;
            padding: 32px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(248, 250, 252, 1);
            transition: box-shadow 0.3s, transform 0.2s;
        }

        .hero-card:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.06);
        }

        .hero-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .hero-card-title {
            font-size: 0.875rem;
            color: #94a3b8;
            font-weight: 600;
        }

        .hero-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-card-icon-chat {
            background: var(--brand-50);
            color: var(--brand-500);
        }

        .hero-card-icon-ia {
            background: #eef2ff;
            color: #6366f1;
        }
        .hero-card-icon-clock {
            background: #FFFBEB;
            color: #f59e0b;
        }
        .hero-card-icon-flag {
            background: #ECF2FE;
            color: #3b82f6;
        }

        .hero-card-body {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
        }

        .hero-card-left {
            flex: 1;
            min-width: 0;
        }

        .hero-card-value {
            font-size: 3rem;
            font-weight: 800;
            letter-spacing: -0.05em;
            color: #0f172a;
            line-height: 1;
        }

        .hero-card-value-empty {
            font-size: 2.5rem;
            color: #cbd5e1;
        }

        .hero-card-trend {
            font-size: 0.875rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 16px;
        }

        .hero-card-trend.hero-trend-up,
        .hero-card-trend.hero-trend-down {
            background: var(--brand-50);
            color: var(--brand-500);
            padding: 4px 10px;
            border-radius: 0.5rem;
            width: fit-content;
        }

        .hero-card-trend svg { flex-shrink: 0; }

        .hero-mini-chart-svg {
            width: 80px;
            height: 40px;
            flex-shrink: 0;
            opacity: 0.75;
        }

        .hero-mini-chart-svg:hover {
            opacity: 1;
        }

        .hero-sparkline {
            width: 100%;
            height: 100%;
        }

        .hero-sparkline-up {
            color: var(--brand-500);
        }

        .hero-sparkline-down {
            color: var(--brand-500);
        }

        .hero-mini-chart-svg.hero-mini-chart-empty svg {
            width: 100%;
            height: 100%;
            color: #cbd5e1;
        }

        .hero-mini-chart-svg.hero-mini-chart-none {
            width: 80px;
            visibility: hidden;
        }
        .hero-card-unit { font-size: 0.6em; font-weight: 500; color: #94a3b8; margin-left: 2px; }

        .hero-card-sub {
            font-size: 0.875rem;
            font-weight: 700;
            color: #94a3b8;
            background: #f8fafc;
            padding: 4px 10px;
            border-radius: 0.5rem;
            width: fit-content;
            margin-top: 16px;
        }

        /* Floating action bar - design das imagens (canto inferior direito) */
        @media (max-width: 768px) {
            .dashboard-hero-cards { grid-template-columns: 1fr; }
        }

        /* Filters */
        .filters-container {
            display: flex;
            margin-bottom: 32px;
        }

        .filter-pills-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 6px;
            border-radius: 9999px;
            box-shadow: var(--shadow-softer);
            border: 1px solid #f1f5f9;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        .filter-select, .filter-input {
            padding: 10px 15px;
            height: 42px;
            box-sizing: border-box;
            background: white;
            border: 1px solid rgba(0,0,0,0.15);
            border-radius: 10px;
            color: #333;
            font-size: 0.9rem;
            min-width: 120px;
            transition: all 0.3s ease;
        }

        .filter-select:focus, .filter-input:focus {
            outline: none;
            border-color: var(--brand-500);
            box-shadow: 0 0 0 3px var(--brand-50);
        }

        .filter-select option {
            background: white;
            color: #333;
        }

        /* Personalizar ícone de calendário para campos de data */
        .filter-input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1) brightness(1.5);
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .filter-input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        /* Para Firefox */
        .filter-input[type="date"]::-moz-calendar-picker-indicator {
            filter: invert(1) brightness(1.5);
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .filter-input[type="date"]::-moz-calendar-picker-indicator:hover {
            opacity: 1;
        }

        .date-range-buttons {
            display: flex;
            gap: 8px;
        }

        .filter-pills-row .date-range-buttons { display: flex; gap: 4px; }
        .filter-input-date { max-width: 140px; }
        .filter-select-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
        }
        .filter-select-wrap .filter-select-pill {
            padding-right: 32px;
            min-width: 160px;
        }
        .filter-select-wrap .filter-chevron {
            position: absolute;
            right: 12px;
            pointer-events: none;
            color: #718096;
        }
        .filter-select-wrap .filter-select-pill {
            background: white;
            border: 1px solid rgba(0,0,0,0.12);
            border-radius: 20px;
            padding: 0 36px 0 16px;
            height: 40px;
        }
        .btn-date-range {
            padding: 0 18px;
            height: 40px;
            box-sizing: border-box;
            background: white;
            border: 1px solid rgba(0,0,0,0.12);
            border-radius: 20px;
            color: #2D3748;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-date-range:hover {
            background: rgba(108, 99, 255, 0.1);
            color: #6C63FF;
        }

        .btn-date-range.active {
            background: #1A202C;
            color: white;
            border-color: #1A202C;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            padding: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #6C63FF;
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .stat-title {
            font-size: 0.9rem;
            color: #888;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            opacity: 0.7;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: #6C63FF;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-change {
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-change.positive {
            color: #6C63FF;
        }

        .stat-change.negative {
            color: #ff3b30;
        }

        .stat-change.neutral {
            color: #888;
        }

        /* Chart Container - design gemini (rounded-[2rem], shadow-soft) */
        .chart-container {
            background: white;
            border: 1px solid #f8fafc;
            border-radius: 2rem;
            box-shadow: var(--shadow-soft);
            padding: 32px 40px;
            margin-bottom: 32px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .chart-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
        }

        .chart-subtitle {
            font-size: 0.875rem;
            color: #94a3b8;
            margin-top: 4px;
            font-weight: 500;
        }
        .chart-header-evolucao { flex-wrap: wrap; gap: 12px; }
        .chart-legend-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: #2D3748;
        }
        .chart-legend-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 4px;
            vertical-align: middle;
        }
        .chart-legend-dot.legend-aberto { background: #3b82f6; }
        .chart-legend-dot.legend-aguardando { background: #f59e0b; }
        .chart-legend-dot.legend-fechadas { background: #64748b; }
        .chart-legend-divider { color: #e2e8f0; font-weight: 300; }

        /* Evolução de Conversas - design imagem */
        .evolucao-card-wrapper {
            margin-bottom: 0;
            display: flex;
            min-height: 0;
        }

        .evolucao-card {
            background: white;
            border-radius: 2rem;
            padding: 32px 40px;
            box-shadow: var(--shadow-soft);
            border: 1px solid #f8fafc;
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 0;
        }
        .evolucao-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 32px;
        }
        .evolucao-card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
        }
        .evolucao-card-subtitle {
            font-size: 0.875rem;
            color: #94a3b8;
            margin: 0;
            font-weight: 500;
        }
        .evolucao-legend-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8fafc;
            padding: 8px 16px;
            border-radius: 9999px;
            border: 1px solid #f1f5f9;
        }
        .evolucao-legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #475569;
        }
        .evolucao-legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        .evolucao-legend-dot.legend-aberto { background: #3b82f6; }
        .evolucao-legend-dot.legend-aguardando { background: #f59e0b; }
        .evolucao-legend-dot.legend-fechadas { background: #64748b; }
        .evolucao-legend-sep {
            width: 1px;
            height: 14px;
            background: #e2e8f0;
        }
        .evolucao-options-btn {
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0 4px;
            line-height: 1;
        }
        .evolucao-chart-wrap {
            position: relative;
            flex: 1;
            min-height: 380px;
        }

        .evolucao-chart-wrap canvas {
            width: 100% !important;
        }

        .chart-options-btn {
            background: none;
            border: none;
            color: #718096;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 4px 8px;
            line-height: 1;
        }

        #chartCanvas {
            width: 100%;
            max-height: 400px;
        }

        /* Loading state - blocos piscando cinza (skeleton) como nas outras páginas */
        .loading-container.skeleton-loading {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            min-height: auto;
            padding: 24px 0;
            align-items: stretch;
        }

        @media (max-width: 900px) {
            .loading-container.skeleton-loading {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .loading-container.skeleton-loading {
                grid-template-columns: 1fr;
            }
        }

        .skeleton-card {
            background: white;
            border-radius: 2rem;
            padding: 24px;
            border: 1px solid #f8fafc;
            box-shadow: var(--shadow-softer);
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .skeleton-card.skeleton-card-wide {
            grid-column: span 2;
        }

        .skeleton-card.skeleton-card-full {
            grid-column: 1 / -1;
        }

        @media (max-width: 900px) {
            .skeleton-card.skeleton-card-wide { grid-column: span 1; }
            .skeleton-card.skeleton-card-full { grid-column: 1 / -1; }
        }

        .skeleton-card .skeleton-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(0,0,0,0.06);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }

        .skeleton-card .skeleton-line {
            height: 12px;
            border-radius: 6px;
            background: rgba(0,0,0,0.06);
            animation: skeleton-pulse 1.2s ease-in-out infinite;
        }

        .skeleton-card .skeleton-line.title {
            width: 60%;
            height: 16px;
        }

        .skeleton-card .skeleton-line.subtitle {
            width: 45%;
            height: 11px;
        }

        .skeleton-card .skeleton-line.bar {
            width: 100%;
            height: 28px;
            border-radius: 10px;
        }

        @keyframes skeleton-pulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }

        .skeleton-card:nth-child(1) .skeleton-icon,
        .skeleton-card:nth-child(1) .skeleton-line { animation-delay: 0s; }
        .skeleton-card:nth-child(2) .skeleton-icon,
        .skeleton-card:nth-child(2) .skeleton-line { animation-delay: 0.08s; }
        .skeleton-card:nth-child(3) .skeleton-icon,
        .skeleton-card:nth-child(3) .skeleton-line { animation-delay: 0.16s; }
        .skeleton-card:nth-child(4) .skeleton-icon,
        .skeleton-card:nth-child(4) .skeleton-line { animation-delay: 0.24s; }
        .skeleton-card:nth-child(5) .skeleton-icon,
        .skeleton-card:nth-child(5) .skeleton-line { animation-delay: 0.32s; }
        .skeleton-card:nth-child(6) .skeleton-icon,
        .skeleton-card:nth-child(6) .skeleton-line { animation-delay: 0.4s; }
        .skeleton-card:nth-child(7) .skeleton-icon,
        .skeleton-card:nth-child(7) .skeleton-line { animation-delay: 0.48s; }

        body.light-mode .skeleton-card {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.08);
        }

        body.light-mode .skeleton-card .skeleton-icon,
        body.light-mode .skeleton-card .skeleton-line {
            background: rgba(0, 0, 0, 0.08);
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

        .stats-grid, .chart-container {
            animation: fadeIn 0.5s ease-out;
        }

        /* Dashboard sections (blocos) – estilo dash-estilo */
        .dashboard-section {
            margin-bottom: 40px;
        }

        .dashboard-section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .dashboard-section-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dashboard-section-icon.conversas { background: rgba(108, 99, 255, 0.15); color: #6C63FF; }
        .dashboard-section-icon.crm { background: rgba(108, 99, 255, 0.2); color: #6C63FF; }
        .dashboard-section-icon.disparos { background: rgba(108, 99, 255, 0.15); color: #6C63FF; }
        .dashboard-section-icon.performance { background: rgba(108, 99, 255, 0.2); color: #6C63FF; }

        .dashboard-section-icon svg {
            width: 22px;
            height: 22px;
        }

        .dashboard-section-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            padding: 0;
            border: none;
            text-transform: none;
            letter-spacing: 0;
        }

        .dashboard-section-title.standalone {
            font-size: 1rem;
            font-weight: 600;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 16px;
        }

        .dashboard-section-filters {
            display: flex;
            gap: 12px;
            align-items: flex-end;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .dashboard-section-filters .filter-group {
            margin-bottom: 0;
        }

        .stats-grid-compact {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card-compact {
            background: white;
            border: 1px solid #f8fafc;
            border-radius: 1rem;
            padding: 20px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-softer);
        }

        .stat-card-compact:hover {
            box-shadow: var(--shadow-soft);
        }

        .stat-card-compact .stat-title {
            font-size: 0.75rem;
            margin-bottom: 6px;
            color: #666;
        }

        .stat-card-compact .stat-value {
            font-size: 1.75rem;
            margin-bottom: 0;
            color: #222;
        }

        .stat-card-compact .stat-progress-wrap {
            margin-top: 10px;
            height: 6px;
            background: rgba(0,0,0,0.06);
            border-radius: 999px;
            overflow: hidden;
        }

        .stat-card-compact .stat-progress-fill {
            height: 100%;
            background: #6C63FF;
            border-radius: 999px;
            transition: width 0.4s ease;
        }

        .stat-card-compact .stat-progress-pct {
            font-size: 0.7rem;
            color: #666;
            text-align: right;
            margin-top: 4px;
        }

        .stat-trend {
            font-size: 0.75rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-trend.positive { color: #6C63FF; }
        .stat-trend.negative { color: #ff3b30; }

        /* Equipe - bloco branco (design igual CRM) */
        .equipe-card-wrapper {
            margin-bottom: 0;
        }

        .equipe-card {
            background: white;
            border-radius: 2rem;
            padding: 32px 40px;
            box-shadow: var(--shadow-soft);
            border: 1px solid #f8fafc;
        }

        .equipe-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .equipe-card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .equipe-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--brand-50);
            color: var(--brand-500);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .equipe-card-icon svg {
            width: 16px;
            height: 16px;
        }

        .equipe-card-subtitle {
            font-size: 0.875rem;
            color: #94a3b8;
            margin: 0;
            font-weight: 500;
        }

        .equipe-link-ver-todos {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--brand-500);
            text-decoration: none;
        }

        .equipe-link-ver-todos:hover { text-decoration: underline; }

        .equipe-table-wrap {
            overflow-x: auto;
        }

        .equipe-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .equipe-table th,
        .equipe-table td {
            padding: 16px 0;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .equipe-table th {
            font-size: 0.625rem;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding-bottom: 16px;
        }

        .equipe-table td {
            color: #334155;
        }

        .equipe-table tbody tr:last-child td {
            border-bottom: none;
        }

        .equipe-table tbody tr:hover td {
            background: #f8fafc;
        }

        .equipe-table th:nth-child(2),
        .equipe-table th:nth-child(3),
        .equipe-table td:nth-child(2),
        .equipe-table td:nth-child(3) {
            text-align: right;
        }

        .equipe-table td:nth-child(2) {
            text-align: center;
        }

        .equipe-table th:nth-child(2) {
            text-align: center;
        }

        /* Disparos em Massa - bloco branco (design igual CRM/Equipe) */
        .disparos-card-wrapper {
            margin-bottom: 0;
        }

        .disparos-card {
            background: white;
            border-radius: 2rem;
            padding: 32px 40px;
            box-shadow: var(--shadow-soft);
            border: 1px solid #f8fafc;
        }

        .disparos-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .disparos-card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .disparos-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--brand-50);
            color: var(--brand-500);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .disparos-card-icon svg {
            width: 16px;
            height: 16px;
        }

        .disparos-card-subtitle {
            font-size: 0.875rem;
            color: #94a3b8;
            margin: 0;
            font-weight: 500;
        }

        .disparos-badge-ativo {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: var(--brand-50);
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #334155;
        }

        .disparos-badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--brand-500);
        }

        .disparos-stats-row {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 24px;
            padding: 16px 0;
        }

        .disparos-stat-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .disparos-stat-label {
            font-size: 0.625rem;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .disparos-stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
        }

        .disparos-stat-divider {
            width: 1px;
            height: 40px;
            background: #e2e8f0;
        }

        .disparos-chart-wrap {
            position: relative;
            min-height: 200px;
        }

        .disparos-chart-wrap .chart-canvas-wrap {
            margin: 0;
        }

        .perf-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-size: 0.7rem;
            font-weight: 700;
            color: white;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .perf-avatar-active { background: var(--brand-500); }
        .perf-avatar-inactive { background: #f1f5f9; color: #64748b; }
        .perf-avatar-unassigned {
            background: transparent;
            border: 2px dashed #e2e8f0;
            color: #cbd5e1;
        }
        .perf-avatar-unassigned svg {
            width: 12px;
            height: 12px;
        }
        .perf-cell-atendente { display: flex; align-items: center; }
        .perf-cell-atendimentos { display: flex; align-items: center; justify-content: center; gap: 12px; }
        .perf-nome { font-weight: 700; color: #0f172a; }
        .perf-nome-unassigned { font-weight: 500; color: #94a3b8; font-style: italic; }
        .perf-row-inactive .perf-nome,
        .perf-row-inactive .perf-qtd { font-weight: 500; color: #94a3b8; }
        .perf-qtd { margin-right: 12px; }
        .perf-bar-wrap {
            display: inline-block;
            width: 64px;
            height: 6px;
            background: #f1f5f9;
            border-radius: 999px;
            overflow: hidden;
            vertical-align: middle;
        }
        .perf-bar-fill {
            height: 100%;
            background: var(--brand-500);
            border-radius: 999px;
            transition: width 0.4s ease;
        }
        .perf-row-inactive .perf-bar-fill {
            background: transparent;
        }
        .perf-tag {
            display: inline-block;
            padding: 4px 10px;
            background: #f8fafc;
            border-radius: 8px;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #475569;
        }
        .perf-dash { color: #94a3b8; }

        /* CRM - bloco branco + filtro pill + etapas em cinza (design da imagem) */
        .crm-card-wrapper {
            margin-bottom: 0;
        }

        .crm-card {
            background: white;
            border-radius: 2rem;
            padding: 32px 40px;
            box-shadow: var(--shadow-soft);
            border: 1px solid #f8fafc;
        }

        .crm-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .crm-card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .crm-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--brand-50);
            color: var(--brand-500);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .crm-card-icon svg {
            width: 16px;
            height: 16px;
        }

        .crm-filter-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            border: 1px solid var(--brand-500);
            border-radius: 12px;
            padding: 6px 12px 6px 14px;
        }

        .crm-filter-icon {
            color: var(--brand-500);
            flex-shrink: 0;
        }

        .crm-filter-select {
            background: transparent;
            border: none;
            font-size: 0.75rem;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            outline: none;
            appearance: none;
            padding-right: 20px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right center;
        }

        .crm-inner-box {
            background: #fbfcfd;
            border: 1px solid #f1f5f9;
            border-radius: 1.5rem;
            padding: 24px;
        }

        .crm-inner-title {
            font-size: 0.6875rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            text-align: center;
            margin: 0 0 24px 0;
        }

        .crm-inner-footer {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .crm-footer-label {
            font-size: 0.6875rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .crm-footer-valor {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--brand-500);
            background: var(--brand-50);
            padding: 6px 12px;
            border-radius: 12px;
        }

        /* Filtro em caixa – mesmo estilo para Quadro (CRM) e Conexões (topo) */
        .filter-wrap-box {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 8px;
            margin: 0;
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            min-height: 62px;
            box-sizing: border-box;
        }

        .filter-wrap-box .filter-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #aaa;
            margin: 0;
            white-space: nowrap;
        }

        .filter-wrap-box .filter-label-icon {
            flex-shrink: 0;
            opacity: 0.8;
        }

        .filter-wrap-box .filter-select {
            min-width: 140px;
            font-size: 0.85rem;
            padding: 6px 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
        }
        .crm-quadro-select-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
        }
        .crm-quadro-select {
            min-width: 140px;
            padding: 8px 36px 8px 14px;
            background: white;
            border: 1px solid rgba(0,0,0,0.12);
            border-radius: 10px;
            font-size: 0.9rem;
            color: #2D3748;
            -webkit-appearance: none;
            appearance: none;
        }
        .crm-quadro-select-wrap .filter-chevron {
            position: absolute;
            right: 12px;
            pointer-events: none;
            color: #718096;
        }
        .btn-date-range-custom {
            min-width: 120px;
        }

        /* Grid CRM + Disparos (1 col + 2 cols) – títulos no topo, gráficos alinhados pela base */
        .bento-grid-level1 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
            align-items: stretch;
            margin-bottom: 24px;
        }
        @media (min-width: 1024px) {
            .bento-grid-level1 { grid-template-columns: 2fr 1fr; }
        }
        .bento-grid-level1 .bento-chart-evolucao { grid-column: 1; }
        .bento-grid-level1 #sectionCRM { grid-column: 1; }
        @media (min-width: 1024px) {
            .bento-grid-level1 .bento-chart-evolucao { grid-column: 1; }
            .bento-grid-level1 #sectionCRM { grid-column: 2; }
        }
        .bento-grid-level2 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }
        @media (min-width: 1280px) {
            .bento-grid-level2 { grid-template-columns: 1fr 1fr; }
        }
        .dashboard-grid-crm-disparos {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 32px;
            align-items: stretch;
        }

        .dashboard-grid-crm-disparos > section {
            display: flex;
            flex-direction: column;
        }

        .dashboard-grid-crm-disparos > section .chart-container.compact {
            margin-top: auto;
        }

        @media (max-width: 1024px) {
            .dashboard-grid-crm-disparos {
                grid-template-columns: 1fr;
            }
        }

        .chart-container .funnel-title {
            text-align: center;
            margin-bottom: 8px;
        }

        .chart-container .funnel-visual {
            margin-top: 0;
        }

        /* CRM - timeline vertical com círculos (design das imagens) */
        .funnel-visual {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 0;
        }

        .funnel-timeline-step {
            display: flex;
            align-items: flex-start;
            gap: 0;
            padding: 12px 0;
            position: relative;
        }

        .funnel-timeline-step:not(:last-child) .funnel-timeline-line {
            display: block;
        }

        .funnel-timeline-left {
            flex-shrink: 0;
            width: 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .funnel-timeline-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            flex-shrink: 0;
            z-index: 2;
            border: 4px solid white;
            box-shadow: 0 1px 2px rgba(0,0,0,0.08);
        }

        .funnel-timeline-dot.active {
            background: var(--brand-500);
        }

        .funnel-timeline-dot.inactive {
            background: #e2e8f0;
        }

        .funnel-timeline-line {
            width: 2px;
            flex: 1;
            min-height: 20px;
            margin-top: 4px;
        }

        .funnel-timeline-step:last-child .funnel-timeline-line {
            display: none;
        }

        .funnel-timeline-content {
            flex: 1;
            padding-left: 16px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 4px;
        }

        .funnel-timeline-title {
            font-weight: 700;
            font-size: 0.875rem;
            color: #0f172a;
        }

        .funnel-timeline-title.muted {
            color: #64748b;
        }

        .funnel-timeline-subtitle {
            font-size: 0.625rem;
            color: #94a3b8;
            margin-top: 4px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .funnel-timeline-subtitle.drop {
            color: #f87171;
        }

        .funnel-timeline-value {
            font-weight: 800;
            font-size: 0.875rem;
            color: #334155;
            background: #f1f5f9;
            padding: 2px 10px;
            border-radius: 8px;
        }

        .funnel-timeline-value.muted {
            color: #94a3b8;
            font-weight: 600;
            background: #f8fafc;
        }

        .funnel-visual-bar { display: none; }
        .funnel-visual-connector { display: none; }

        .funnel-visual-footer {
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            justify-content: center;
            gap: 24px;
            text-align: center;
        }

        .funnel-visual-footer .footer-item p:first-child {
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            color: #718096;
        }

        .funnel-visual-footer .footer-item .footer-valor {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--brand-500);
            margin-top: 4px;
        }

        .funnel-visual-footer .footer-sep {
            width: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        /* Funil lateral CRM (legado, mantido para compat) */
        .funnel-container {
            display: flex;
            flex-direction: column;
            gap: 0;
            max-width: 360px;
        }

        .funnel-step {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-bottom: none;
            transition: background 0.2s ease;
        }

        .funnel-step:first-child {
            border-radius: 12px 12px 0 0;
        }

        .funnel-step:last-child {
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 0 0 12px 12px;
        }

        .funnel-step:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        .funnel-step-bar {
            flex: 1;
            height: 8px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 4px;
            overflow: hidden;
        }

        .funnel-step-fill {
            height: 100%;
            background: #6C63FF;
            border-radius: 4px;
            transition: width 0.4s ease;
        }

        .funnel-step-label {
            font-size: 0.9rem;
            color: #ccc;
            min-width: 120px;
        }

        .funnel-step-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #fff;
            min-width: 36px;
            text-align: right;
        }

        .funnel-step-pct {
            font-size: 0.8rem;
            color: #888;
            min-width: 42px;
            text-align: right;
        }

        .chart-container.compact {
            padding: 20px;
            margin-bottom: 24px;
        }

        .chart-container.compact .chart-canvas-wrap {
            position: relative;
            width: 100%;
            height: 220px;
            max-height: 220px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .chart-container.compact .chart-canvas-wrap canvas {
            display: block;
            width: 100%;
            height: 220px;
            max-height: 220px;
        }

        .chart-container.compact .chart-title {
            font-size: 1.1rem;
        }

        .chart-container.compact .chart-subtitle {
            font-size: 0.8rem;
        }

        /* Altura alinhada: bloco funil CRM = bloco gráfico Disparos (220px canvas + header + padding) */
        .dashboard-grid-crm-disparos .chart-container.compact {
            min-height: 320px;
        }

        #sectionCRM .chart-container.compact {
            min-height: 480px;
        }

        /* Status dos atendimentos (conversas por status) */
        .dashboard-status-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0 16px;
        }
        .dashboard-status-divider::before,
        .dashboard-status-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }
        .dashboard-status-divider span {
            font-size: 0.65rem;
            font-weight: 600;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }
        .status-cards-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .status-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            transition: border-color 0.2s ease, background 0.2s ease;
        }
        .status-card:hover {
            background: rgba(255, 255, 255, 0.04);
        }
        .status-card.status-aberto:hover { border-color: rgba(59, 130, 246, 0.4); }
        .status-card.status-aguardando:hover { border-color: rgba(251, 191, 36, 0.4); }
        .status-card.status-fechadas:hover { border-color: rgba(108, 99, 255, 0.4); }
        .status-card-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .status-dot.aberto {
            background: #3b82f6;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }
        .status-dot.aguardando {
            background: #fbbf24;
            box-shadow: 0 0 10px rgba(251, 191, 36, 0.5);
        }
        .status-dot.fechadas {
            background: #6C63FF;
            box-shadow: 0 0 10px rgba(108, 99, 255, 0.5);
        }
        .status-card-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #ccc;
        }
        .status-card-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
        }

        .chart-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 900px) {
            .chart-row {
                grid-template-columns: 1fr;
            }
            .stats-grid-compact {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .stats-grid-compact {
                grid-template-columns: 1fr;
            }
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

        /* Responsive */
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
                width: 100% !important;
                min-width: 180px !important;
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
                align-items: flex-start;
                gap: 20px;
            }

            .header-info h1 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .filters-container {
                flex-direction: column;
                align-items: stretch;
            }

            .date-range-buttons {
                justify-content: center;
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
            color: #222;
        }

        body.light-mode .header p,
        body.light-mode .header-info p {
            color: #666;
        }

        body.light-mode .stat-card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        body.light-mode .stat-card:hover {
            border-color: rgba(108, 99, 255, 0.3);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.15);
        }

        body.light-mode .stat-value {
            background: #6C63FF !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
        }

        body.light-mode .stat-label {
            color: #666 !important;
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

        /* Filtros no Light Mode */
        body.light-mode .filters-container {
            background: transparent !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        body.light-mode .filter-group {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        body.light-mode .filter-label {
            color: #333 !important;
        }

        body.light-mode .filter-select,
        body.light-mode .filter-input {
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

        body.light-mode .filter-select:focus,
        body.light-mode .filter-input:focus {
            border-color: #6C63FF !important;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2) !important;
            outline: none !important;
        }

        body.light-mode .filter-select option {
            background: #ffffff !important;
            color: #333 !important;
        }

        body.light-mode .filter-input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.5) brightness(1);
        }

        body.light-mode .filter-input[type="date"]::-moz-calendar-picker-indicator {
            filter: invert(0.5) brightness(1);
        }

        /* Botões de data no Light Mode */
        body.light-mode .header-filters .btn-date-range {
            background: transparent !important;
            border: none !important;
            color: #64748b !important;
        }

        body.light-mode .header-filters .btn-date-range:hover {
            background: #f8fafc !important;
            color: #0f172a !important;
        }

        body.light-mode .header-filters .btn-date-range.active {
            background: #0f172a !important;
            color: white !important;
        }

        /* Cards de estatísticas no Light Mode */
        body.light-mode .stat-card::before {
            background: #6C63FF;
        }

        body.light-mode .stat-title {
            color: #666 !important;
        }

        body.light-mode .stat-icon {
            opacity: 0.8;
        }

        body.light-mode .stat-value {
            background: #6C63FF;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        body.light-mode .stat-change.positive {
            color: #6C63FF !important;
        }

        body.light-mode .stat-change.negative {
            color: #ff3b30 !important;
        }

        body.light-mode .stat-change.neutral {
            color: #888 !important;
        }

        body.light-mode .dashboard-section-title {
            color: #222 !important;
            border-bottom-color: rgba(0, 0, 0, 0.1);
        }
        body.light-mode .dashboard-section-title.standalone {
            color: #555 !important;
        }
        body.light-mode .filter-wrap-box {
            background: rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0, 0, 0, 0.12);
        }

        body.light-mode .filter-wrap-box .filter-label {
            color: #555;
        }

        body.light-mode .filter-wrap-box .filter-select {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.15) !important;
            color: #333 !important;
        }

        body.light-mode .funnel-visual-bar .funnel-bar-text {
            color: #222;
        }
        body.light-mode .funnel-visual-footer .footer-item p:first-child {
            color: #222;
        }

        body.light-mode .stat-card-compact {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .stat-card-compact:hover {
            border-color: rgba(108, 99, 255, 0.4);
        }

        body.light-mode .funnel-step {
            background: rgba(255, 255, 255, 0.6);
            border-color: rgba(0, 0, 0, 0.1);
        }

        body.light-mode .funnel-step:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        body.light-mode .funnel-step-label {
            color: #444;
        }

        body.light-mode .funnel-step-value {
            color: #222;
        }

        body.light-mode .dashboard-status-divider::before,
        body.light-mode .dashboard-status-divider::after {
            background: rgba(0, 0, 0, 0.1);
        }
        body.light-mode .dashboard-status-divider span {
            color: #666;
        }
        body.light-mode .status-card {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 0, 0, 0.1);
        }
        body.light-mode .status-card:hover {
            background: #fff;
        }
        body.light-mode .status-card-label {
            color: #555;
        }
        body.light-mode .status-card-value {
            color: #222;
        }

        /* Gráficos no Light Mode */
        body.light-mode .chart-container {
            background: #ffffff !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
        }

        body.light-mode .chart-title {
            color: #222 !important;
        }

        body.light-mode .chart-subtitle {
            color: #666 !important;
        }

        /* Botão refresh no Light Mode */
        body.light-mode .btn-refresh {
            background: #6C63FF;
            color: white;
        }

        body.light-mode .btn-refresh:hover {
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }

        body.light-mode .btn-refresh:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        /* Mensagens no Light Mode */
        body.light-mode .error-message {
            background: rgba(255, 59, 48, 0.15) !important;
            border: 1px solid rgba(255, 59, 48, 0.3) !important;
            color: #ff3b30 !important;
        }

        body.light-mode .success-message {
            background: rgba(34, 197, 94, 0.15) !important;
            border: 1px solid rgba(34, 197, 94, 0.3) !important;
            color: #22c55e !important;
        }

        /* Loading no Light Mode */

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

        /* Exceção: select da pill CRM (e header) — regra global acima não pode forçar branco/preto no dark */
        body.dark-mode select.crm-filter-select {
            background-color: transparent !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right center !important;
            min-height: 1.375rem;
            line-height: 1.35;
        }

        body.dark-mode select.crm-filter-select:hover {
            color: #f8fafc !important;
            -webkit-text-fill-color: #f8fafc !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
        }

        body.dark-mode select.crm-filter-select:focus {
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.35) !important;
            border-radius: 6px !important;
        }

        body.dark-mode select.crm-filter-select option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .header-filters .filter-select-inline {
            background-color: transparent !important;
            color: #e2e8f0 !important;
            -webkit-text-fill-color: #e2e8f0 !important;
        }

        body.dark-mode .header-filters .filter-select-inline:hover {
            color: #f8fafc !important;
            -webkit-text-fill-color: #f8fafc !important;
        }

        body.dark-mode .header-filters .filter-select-inline option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }
    </style>
    <script type="module">
        // Importar Supabase via CDN ESM
        // Supabase removido - usando PHP/MySQL
        
        // Configuração do Supabase
        // Supabase URL removido
        // Supabase Key removido
        
        // Criar cliente Supabase e disponibilizar globalmente
        // window.supabase removido
        
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" defer></script>
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
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

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
                    <img class="sidebar-logo-img" src="/hublabel/public/assets/images/logo" alt="IA Chatconversa" onerror="this.src='/hublabel/public/assets/images/favicon'">
                </a>
            </div>
            <nav class="sidebar-menu">
                <a href="#" class="menu-item active" title="Dashboard">
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

        <!-- Main Content - layout gemini.html -->
        <div class="main-content">
            <!-- Header + Filtros na mesma linha (como gemini) -->
            <div class="header header-with-filters">
                <div class="header-info">
                    <h1>Visão Geral</h1>
                    <p>Acompanhe as suas métricas e performance em tempo real</p>
                </div>
                <div class="header-filters" id="filtersContainer">
                    <div class="filter-pills-row">
                        <div class="date-range-buttons">
                            <button class="btn-date-range active" data-days="7">7 dias</button>
                            <button class="btn-date-range" data-days="14">14 dias</button>
                            <button class="btn-date-range" data-days="30">30 dias</button>
                        </div>
                        <div class="filter-date-sep"></div>
                        <div class="filter-date-range">
                            <span id="dateRangeLabel">07/03</span>
                            <span class="filter-date-dash">-</span>
                            <span id="dateRangeLabelEnd">14/03</span>
                        </div>
                        <input type="date" id="dataInicial" style="display:none;">
                        <input type="date" id="dataFinal" style="display:none;">
                        <div class="filter-date-sep"></div>
                        <select class="filter-select-inline" id="filtroConexoes">
                            <option value="">Todas as conexões</option>
                        </select>
                    </div>
                    <button class="btn-refresh-header" id="btnAtualizar" title="Atualizar">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23,4 23,10 17,10"></polyline><polyline points="1,20 1,14 7,14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                    </button>
                </div>
            </div>

            <!-- 4 KPIs - design imagem: ícone subindo/descendo, mini gráfico -->
            <div class="dashboard-hero-cards" id="dashboardHeroCards" style="display: none;">
                <div class="hero-card">
                    <div class="hero-card-header">
                        <span class="hero-card-title">Total Conversas</span>
                        <span class="hero-card-icon hero-card-icon-chat"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></span>
                    </div>
                    <div class="hero-card-body">
                        <div class="hero-card-left">
                            <div class="hero-card-value" id="heroTotalConversas">0</div>
                            <div class="hero-card-trend hero-trend-up" id="heroTrendTotalConversas"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"></polyline></svg><span>+12%</span></div>
                        </div>
                        <div class="hero-mini-chart-svg"><svg viewBox="0 0 100 40" class="hero-sparkline hero-sparkline-up"><path d="M0,30 C20,30 30,10 50,15 C70,20 80,0 100,5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                    </div>
                </div>
                <div class="hero-card">
                    <div class="hero-card-header">
                        <span class="hero-card-title">Respondidas via IA</span>
                        <span class="hero-card-icon hero-card-icon-ia"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="8" width="18" height="12" rx="2"></rect><circle cx="9" cy="14" r="1"></circle><circle cx="15" cy="14" r="1"></circle><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path></svg></span>
                    </div>
                    <div class="hero-card-body">
                        <div class="hero-card-left">
                            <div class="hero-card-value" id="heroConversasIA">0</div>
                            <div class="hero-card-sub" id="heroPctIA">0% do total</div>
                        </div>
                        <div class="hero-mini-chart-svg hero-mini-chart-empty"><svg viewBox="0 0 100 40"><path d="M0,35 L100,35" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-dasharray="4 4"/></svg></div>
                    </div>
                </div>
                <div class="hero-card">
                    <div class="hero-card-header">
                        <span class="hero-card-title">T.M. Abertura</span>
                        <span class="hero-card-icon hero-card-icon-clock"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></span>
                    </div>
                    <div class="hero-card-body">
                        <div class="hero-card-left">
                            <div class="hero-card-value" id="heroTempoAbertura">0<span class="hero-card-unit">m</span></div>
                            <div class="hero-card-trend hero-trend-down" id="heroTrendAbertura"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg><span>-5s</span></div>
                        </div>
                        <div class="hero-mini-chart-svg"><svg viewBox="0 0 100 40" class="hero-sparkline hero-sparkline-down"><path d="M0,5 C20,5 30,25 50,20 C70,15 80,35 100,35" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                    </div>
                </div>
                <div class="hero-card">
                    <div class="hero-card-header">
                        <span class="hero-card-title">T.M. Conclusão</span>
                        <span class="hero-card-icon hero-card-icon-flag"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg></span>
                    </div>
                    <div class="hero-card-body">
                        <div class="hero-card-left">
                            <div class="hero-card-value hero-card-value-empty" id="heroTempoConclusao">—</div>
                            <div class="hero-card-sub">Sem dados</div>
                        </div>
                        <div class="hero-mini-chart-svg hero-mini-chart-none"></div>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="error-message" id="errorMessage" style="display: none;"></div>

            <!-- Success Message -->
            <div class="success-message" id="successMessage" style="display: none;"></div>

            <!-- Loading State - blocos piscando cinza (abaixo dos filtros) -->
            <div class="loading-container skeleton-loading" id="loadingContainer">
                <div class="skeleton-card">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-line title"></div>
                    <div class="skeleton-line subtitle"></div>
                </div>
                <div class="skeleton-card">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-line title"></div>
                    <div class="skeleton-line subtitle"></div>
                </div>
                <div class="skeleton-card">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-line title"></div>
                    <div class="skeleton-line subtitle"></div>
                </div>
                <div class="skeleton-card">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-line title"></div>
                    <div class="skeleton-line subtitle"></div>
                </div>
                <div class="skeleton-card skeleton-card-full">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-line title"></div>
                    <div class="skeleton-line bar"></div>
                    <div class="skeleton-line subtitle"></div>
                </div>
                <div class="skeleton-card skeleton-card-wide">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-line title"></div>
                    <div class="skeleton-line bar"></div>
                    <div class="skeleton-line bar"></div>
                    <div class="skeleton-line subtitle"></div>
                </div>
                <div class="skeleton-card skeleton-card-wide">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-line title"></div>
                    <div class="skeleton-line bar"></div>
                    <div class="skeleton-line subtitle"></div>
                </div>
            </div>

            <!-- Conteúdo da dashboard (layout bento gemini) -->
            <div id="dashboardContent" style="display: none;">
                <!-- Bento Grid Nível 1: Gráfico Evolução + CRM -->
                <div class="bento-grid-level1">
                    <!-- Gráfico Evolução (2 cols) - design imagem -->
                    <section class="bento-chart-evolucao evolucao-card-wrapper" id="sectionEvolucao">
                    <div class="evolucao-card">
                        <div class="evolucao-card-header">
                            <div>
                                <h3 class="evolucao-card-title">Evolução de Conversas</h3>
                                <p class="evolucao-card-subtitle">Volume de entrada nos últimos 7 dias</p>
                            </div>
                            <div class="evolucao-legend-pill">
                                <span class="evolucao-legend-item"><span class="evolucao-legend-dot legend-aberto"></span><span id="chartLegendAberto">1 Aberto</span></span>
                                <span class="evolucao-legend-sep"></span>
                                <span class="evolucao-legend-item"><span class="evolucao-legend-dot legend-aguardando"></span><span id="chartLegendAguardando">45 Aguardando</span></span>
                                <span class="evolucao-legend-sep"></span>
                                <span class="evolucao-legend-item"><span class="evolucao-legend-dot legend-fechadas"></span><span id="chartLegendFechadas">0 Fechadas</span></span>
                                <button type="button" class="evolucao-options-btn" title="Opções">⋮</button>
                            </div>
                        </div>
                        <div class="evolucao-chart-wrap">
                            <canvas id="chartConversasDia"></canvas>
                        </div>
                    </div>
                    </section>

                    <!-- CRM (1 col) - design imagem: bloco branco, filtro pill, etapas em cinza -->
                <section class="dashboard-section crm-card-wrapper" id="sectionCRM">
                    <div class="crm-card">
                        <div class="crm-card-header">
                            <h2 class="crm-card-title">
                                <span class="crm-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect></svg></span>
                                CRM
                            </h2>
                            <div class="crm-filter-pill">
                                <svg class="crm-filter-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                                <select class="crm-filter-select" id="filtroQuadroBloco" title="Quadro">
                                    <option value="">teste quadro</option>
                                    <option value="">Todos os quadros</option>
                                </select>
                            </div>
                        </div>
                        <div class="crm-inner-box">
                            <h3 class="crm-inner-title">TAXA DE CONVERSÃO</h3>
                            <div class="funnel-visual" id="funnelVisual">
                                <!-- Preenchido por JS -->
                            </div>
                            <div class="crm-inner-footer">
                                <span class="crm-footer-label">FECHAMENTO</span>
                                <span class="crm-footer-valor" id="crmValorFechado">R$ 0,00</span>
                            </div>
                        </div>
                    </div>
                </section>
                </div>
                <!-- Bento Grid Nível 2: Equipe + Disparos -->
                <div class="bento-grid-level2">
                <!-- Bloco Equipe - design imagem: bloco branco como CRM -->
                <section class="dashboard-section equipe-card-wrapper" id="sectionPerformanceAtendentes">
                    <div class="equipe-card">
                        <div class="equipe-card-header">
                            <div>
                                <h2 class="equipe-card-title">
                                    <span class="equipe-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></span>
                                    Equipe
                                </h2>
                                <p class="equipe-card-subtitle">Performance por Atendente</p>
                            </div>
                            <a href="#" class="equipe-link-ver-todos">Ver todos</a>
                        </div>
                        <div class="equipe-table-wrap">
                            <table class="equipe-table">
                                <thead>
                                    <tr>
                                        <th>ATENDENTE</th>
                                        <th>ATENDIMENTOS</th>
                                        <th>T.M. ABERTURA</th>
                                    </tr>
                                </thead>
                                <tbody id="performanceAtendentesBody">
                                    <!-- Preenchido por JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Bloco Disparos - design igual CRM/Equipe: bloco branco -->
                <section class="dashboard-section disparos-card-wrapper" id="sectionDisparos">
                    <div class="disparos-card">
                        <div class="disparos-card-header">
                            <div>
                                <h2 class="disparos-card-title">
                                    <span class="disparos-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg></span>
                                    Disparos em Massa
                                </h2>
                                <p class="disparos-card-subtitle">Volume enviado diariamente</p>
                            </div>
                            <span class="disparos-badge-ativo"><span class="disparos-badge-dot"></span> Ativo</span>
                        </div>
                        <div class="disparos-stats-row">
                            <div class="disparos-stat-item">
                                <span class="disparos-stat-label">TOTAL DISP.</span>
                                <span class="disparos-stat-value" id="totalDisparos">0</span>
                            </div>
                            <div class="disparos-stat-divider"></div>
                            <div class="disparos-stat-item">
                                <span class="disparos-stat-label">CONEXÕES ATIVAS</span>
                                <span class="disparos-stat-value" id="conexoesAtivas">0 / 0</span>
                            </div>
                        </div>
                        <div class="disparos-chart-wrap">
                            <div class="chart-canvas-wrap">
                                <canvas id="chartDisparosDia"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
                </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Variáveis globais
        let secureUserId = null;
        let dashboardData = {};
        let chartDisparos = null;
        let chartConversas = null;
        let currentPeriod = 7; // Padrão: 7 dias
        const USE_MOCK_DATA = false; // true = dados fictícios; false = puxar do Supabase (get_dashboard)

        // Função para ler cookies
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        // Função para salvar cookies
        function setCookie(name, value, days = 7) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Strict`;
        }

        // Função para obter contaId de forma segura via cookies (fallback/compatibilidade)
        function getSecureUserId() {
            const contaId = getCookie('userId');
            if (contaId && /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i.test(contaId)) {
                console.log('✅ UserId (UUID) obtido dos cookies:', contaId);
                return contaId;
            }
            return null;
        }

        // Flag para evitar múltiplos redirecionamentos
        let hasRedirected = false;

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

        // Autenticação obrigatória ao carregar a página
        async function checkAuth() {
            if (hasRedirected) {
                return;
            }
            
            // Verificar sessão do Supabase Auth imediatamente
            if (window.supabase) {
                try {
                    const { data: { session }, error } = await window.supabase.auth.getSession();
                    
                    if (error) {
                        console.error('Erro ao verificar sessão:', error);
                        return;
                    }
                    
                    if (!session || !session.access_token) {
                        hasRedirected = true;
                        window.location.replace('/hublabel/public/hublabel/public/login');
                        return;
                    }
                } catch (error) {
                    console.error('Erro ao verificar sessão:', error);
                    return;
                }
            } else {
                // Se o Supabase não estiver disponível, redirecionar
                hasRedirected = true;
                window.location.replace('/hublabel/public/hublabel/public/login');
                return;
            }
            
            // Também verificar contaId de cookies (compatibilidade)
            // Não verificar contaId de cookies aqui - será obtido quando necessário em carregarDashboard()
        }

        // Navegação simplificada (sem parâmetros de autenticação)
        function navigateToPage(url) {
            window.location.href = url;
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

        // Aplicar ocultação de itens do menu conforme plano da conta (com cache em cookie)
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

        // Verificar autenticação ao carregar a página - imediatamente
        document.addEventListener('DOMContentLoaded', async function() {
            await checkAuth();
            verificarMostrarMenuAdmin();
            initMenuOcultar();
        });

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

        function hideLoading() {
            document.getElementById('loadingContainer').style.display = 'none';
        }

        function showDashboard() {
            document.getElementById('filtersContainer').style.display = 'flex';
            const heroCards = document.getElementById('dashboardHeroCards');
            if (heroCards) heroCards.style.display = 'grid';
            const content = document.getElementById('dashboardContent');
            if (content) content.style.display = 'block';
        }

        // Dados fictícios para visualização da dashboard (estrutura completa)
        function getMockDashboardData(days) {
            const today = new Date();
            const conversasPorDia = [];
            const disparosPorDia = [];
            let totalConversas = 0;
            let totalDisparos = 0;

            for (let i = days - 1; i >= 0; i--) {
                const date = new Date(today);
                date.setDate(date.getDate() - i);
                const conv = Math.floor(Math.random() * 25) + 15;
                const disp = Math.floor(Math.random() * 120) + 80;
                totalConversas += conv;
                totalDisparos += disp;
                conversasPorDia.push({
                    data: date.toISOString().split('T')[0],
                    dataFormatada: date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' }),
                    total: conv
                });
                disparosPorDia.push({
                    data: date.toISOString().split('T')[0],
                    dataFormatada: date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' }),
                    disparos: disp
                });
            }

            const totalConexoes = 5;
            const conexoesAtivas = 4;

            return {
                conversas: {
                    total: totalConversas,
                    respondidasIA: Math.floor(totalConversas * 0.72),
                    tempoMedioAbrirMin: 4,
                    tempoMedioConclusaoHoras: 2.5,
                    emAberto: 156,
                    aguardando: 42,
                    fechadas: 1086,
                    conversasPorDia: conversasPorDia
                },
                crm: {
                    etapas: [
                        { nome: 'Contato Inicial', quantidade: 120, percentual: 100 },
                        { nome: 'Qualificação', quantidade: 78, percentual: 65 },
                        { nome: 'Apresentação', quantidade: 50, percentual: 42 },
                        { nome: 'Proposta', quantidade: 34, percentual: 28 },
                        { nome: 'Fechado', quantidade: 12, percentual: 10 }
                    ],
                    conversaoTotal: '10%',
                    valorFechado: 'R$ 45k'
                },
                disparos: {
                    totalDisparos: totalDisparos,
                    conexoesAtivas: conexoesAtivas,
                    totalConexoes: totalConexoes,
                    mediaDisparosPorConexao: totalConexoes > 0 ? Math.round(totalDisparos / totalConexoes) : 0,
                    disparosPorDia: disparosPorDia
                }
            };
        }

        // Gerar dados fictícios para demonstração (compatibilidade com API antiga)
        function generateDemoData(days) {
            const mock = getMockDashboardData(days);
            return {
                totalDisparos: mock.disparos.totalDisparos,
                conexoesAtivas: mock.disparos.conexoesAtivas,
                totalConexoes: mock.disparos.totalConexoes,
                mediaDisparosPorConexao: mock.disparos.mediaDisparosPorConexao,
                disparosPorDia: mock.disparos.disparosPorDia,
                estatisticas: {
                    changeDisparos: '12.5',
                    changeConexoesAtivas: '0',
                    changeTotalConexoes: '0',
                    changeMediaConexao: '8.2'
                },
                conversas: mock.conversas,
                crm: mock.crm
            };
        }

        // Verificar status de conexão de uma instância
        async function verificarStatusConexao(instanceName, apikey) {
            try {
                const response = await fetch(`https://evo.chatconversa.app.br/instance/connectionState/${instanceName}`, {
                    method: 'GET',
                    headers: {
                        'apikey': apikey
                    }
                });

                if (!response.ok) {
                    console.log(`Erro ao verificar status da instância ${instanceName}:`, response.status);
                    return false;
                }

                const data = await response.json();
                console.log(`Status da instância ${instanceName}:`, data);
                
                // Consideramos conectada se o estado é 'open' ou similar
                return data.state === 'open' || data.instance?.state === 'open';
            } catch (error) {
                console.error(`Erro ao verificar conexão ${instanceName}:`, error);
                return false;
            }
        }



        // Processar dados da API
        async function processarDadosAPI(apiData) {
            // Verificar e extrair dados de forma segura
            let dados = {};
            let disparos = [];
            let conexoes = [];
            
            try {
                // Caso 1: Resposta é array com objeto dentro: [{"disparos": [...], "conexoes": [...]}]
                if (Array.isArray(apiData) && apiData.length > 0 && apiData[0]) {
                    dados = apiData[0];
                }
                // Caso 2: Resposta é objeto direto: {"disparos": [...], "conexoes": [...]}
                else if (apiData && typeof apiData === 'object' && !Array.isArray(apiData)) {
                    dados = apiData;
                }
                // Caso 3: Resposta tem estrutura diferente
                else {
                    console.error('Estrutura de resposta não reconhecida:', apiData);
                    throw new Error('Formato de resposta da API não reconhecido');
                }
                
                // Extrair disparos e conexões de forma segura
                disparos = dados.disparos || [];
                conexoes = dados.conexoes || [];
                
                if (!Array.isArray(disparos)) {
                    console.warn('Disparos não é array, convertendo:', disparos);
                    disparos = [];
                }
                
                if (!Array.isArray(conexoes)) {
                    console.warn('Conexões não é array, convertendo:', conexoes);
                    conexoes = [];
                }
                
                // Filtrar conexões válidas (não vazias)
                const conexoesValidas = conexoes.filter(conexao => {
                    return conexao && 
                           typeof conexao === 'object' && 
                           Object.keys(conexao).length > 0 &&
                           conexao.Apikey && 
                           conexao.instanceName;
                });
                
                // Usar apenas conexões válidas
                conexoes = conexoesValidas;
                
                // Filtrar disparos válidos (não vazios)
                const disparosValidos = disparos.filter(disparo => {
                    return disparo && 
                           (typeof disparo === 'string' || 
                            (typeof disparo === 'object' && Object.keys(disparo).length > 0));
                });
                
                // Usar apenas disparos válidos
                disparos = disparosValidos;
                
            } catch (error) {
                console.error('Erro ao processar estrutura da API:', error);
                throw new Error('Erro ao processar dados da API: ' + error.message);
            }

            // Calcular datas do período atual
            let hoje = new Date();
            let dataInicial = new Date();
            dataInicial.setDate(hoje.getDate() - currentPeriod);
            

            
            // Ajustar período baseado nos dados reais
            if (disparos.length > 0) {
                const primeiroDisparo = new Date(disparos[0]);
                const ultimoDisparo = new Date(disparos[disparos.length - 1]);
                
                // Se os disparos são de 2025, usar o período real dos dados
                if (primeiroDisparo.getFullYear() === 2025 || ultimoDisparo.getFullYear() === 2025) {
                    // Usar o período real dos dados em vez de um período fixo
                    dataInicial = new Date(primeiroDisparo);
                    dataInicial.setDate(dataInicial.getDate() - currentPeriod); // Pegar X dias antes do primeiro disparo
                    hoje = new Date(ultimoDisparo);
                    hoje.setDate(hoje.getDate() + 1); // Incluir o dia do último disparo
                }
            }

            // Usar todos os disparos disponíveis (já estão no período correto)
            const disparosPeriodo = disparos.filter((disparo, index) => {
                if (!disparo) {
                    return false;
                }
                
                // Verificar se disparo é string (timestamp) ou objeto
                let dataDisparo;
                if (typeof disparo === 'string') {
                    // Se é string, é o timestamp direto
                    dataDisparo = new Date(disparo);
                } else if (disparo && disparo.created_at) {
                    // Se é objeto, pegar a propriedade created_at
                    dataDisparo = new Date(disparo.created_at);
                } else {
                    return false;
                }
                
                // Verificar se a data é válida
                if (isNaN(dataDisparo.getTime())) {
                    return false;
                }
                
                return true; // Usar todos os disparos válidos
            });



            // Verificar conexões ativas (com tratamento de erro)
            let conexoesAtivas = 0;
            
            // Se não há conexões, retornar 0
            if (!conexoes || conexoes.length === 0) {
                conexoesAtivas = 0;
            } else {
                const verificacoes = conexoes.map(async (conexao) => {
                    try {
                        if (conexao && conexao.Apikey && conexao.instanceName) {
                            const ativa = await verificarStatusConexao(conexao.instanceName, conexao.Apikey);
                            if (ativa) conexoesAtivas++;
                            return ativa;
                        }
                        return false;
                    } catch (error) {
                        console.warn(`Erro ao verificar conexão ${conexao?.instanceName}:`, error);
                        return false;
                    }
                });

                try {
                    // Aguardar todas as verificações com timeout
                    await Promise.race([
                        Promise.all(verificacoes),
                        new Promise((_, reject) => setTimeout(() => reject(new Error('Timeout')), 10000))
                    ]);
                } catch (error) {
                    console.warn('Erro ou timeout na verificação de conexões:', error);
                    // Em caso de erro, não considerar nenhuma conexão como ativa
                    conexoesAtivas = 0;
                }
            }

            // Calcular totais - cada disparo conta como 1 mensagem
            const totalDisparos = disparosPeriodo.length;

            const totalConexoes = conexoes.length;
            const mediaDisparosPorConexao = totalConexoes > 0 ? Math.round(totalDisparos / totalConexoes) : 0;

            // Agrupar disparos por dia
            let disparosPorDia = {};
            
            // Inicializar todos os dias do período com 0
            const dataAtual = new Date(dataInicial);
            
            while (dataAtual <= hoje) {
                const dataStr = dataAtual.toISOString().split('T')[0];
                disparosPorDia[dataStr] = 0;
                dataAtual.setDate(dataAtual.getDate() + 1);
            }

            // Contar disparos por dia
            disparosPeriodo.forEach((disparo, index) => {
                try {
                    let dataDisparo;
                    if (typeof disparo === 'string') {
                        // Se é string, é o timestamp direto
                        dataDisparo = new Date(disparo);
                    } else if (disparo && disparo.created_at) {
                        // Se é objeto, pegar a propriedade created_at
                        dataDisparo = new Date(disparo.created_at);
                    } else {
                        return;
                    }
                    
                    // Verificar se a data é válida
                    if (isNaN(dataDisparo.getTime())) {
                        return;
                    }
                    
                    const dataStr = dataDisparo.toISOString().split('T')[0];
                    
                    // Sempre contar o disparo, independente do período
                    if (disparosPorDia.hasOwnProperty(dataStr)) {
                        // Cada disparo conta como 1 mensagem
                        disparosPorDia[dataStr] += 1;
                    } else {
                        // Se a data não existe no objeto, criar
                        disparosPorDia[dataStr] = 1;
                    }
                } catch (error) {
                    // Silenciar erros de processamento
                }
            });

            // Converter para array ordenado
            const disparosPorDiaArray = Object.keys(disparosPorDia)
                .sort()
                .map(data => {
                    try {
                        return {
                            data: data,
                            dataFormatada: new Date(data + 'T00:00:00').toLocaleDateString('pt-BR'),
                            disparos: disparosPorDia[data]
                        };
                    } catch (error) {
                        console.warn('Erro ao formatar data:', data, error);
                        return {
                            data: data,
                            dataFormatada: data,
                            disparos: disparosPorDia[data]
                        };
                    }
                })
                .filter(item => item.disparos > 0); // Mostrar apenas dias com disparos
                


            // Calcular período anterior para comparação (usar período fixo para comparação)
            const dataInicialAnterior = new Date(dataInicial);
            dataInicialAnterior.setDate(dataInicialAnterior.getDate() - currentPeriod);
            const dataFinalAnterior = new Date(dataInicial);
            dataFinalAnterior.setDate(dataFinalAnterior.getDate() - 1);

            const disparosPeriodoAnterior = disparos.filter(disparo => {
                if (!disparo) return false;
                
                try {
                    let dataDisparo;
                    if (typeof disparo === 'string') {
                        // Se é string, é o timestamp direto
                        dataDisparo = new Date(disparo);
                    } else if (disparo && disparo.created_at) {
                        // Se é objeto, pegar a propriedade created_at
                        dataDisparo = new Date(disparo.created_at);
                    } else {
                        return false;
                    }
                    
                    // Verificar se a data é válida
                    if (isNaN(dataDisparo.getTime())) {
                        console.warn('Data inválida do disparo para período anterior:', disparo);
                        return false;
                    }
                    
                    return dataDisparo >= dataInicialAnterior && dataDisparo <= dataFinalAnterior;
                } catch (error) {
                    console.warn('Erro ao processar data para período anterior:', disparo);
                    return false;
                }
            });
            


            // Cada disparo conta como 1 mensagem
            const totalDisparosAnterior = disparosPeriodoAnterior.length;

            // Calcular mudanças percentuais
            const calcularMudancaPercentual = (atual, anterior) => {
                if (anterior === 0) return atual > 0 ? 100 : 0;
                return ((atual - anterior) / anterior * 100).toFixed(1);
            };

            const estatisticas = {
                changeDisparos: calcularMudancaPercentual(totalDisparos, totalDisparosAnterior),
                changeConexoesAtivas: '0.0', // Para conexões ativas, seria necessário histórico
                changeTotalConexoes: '0.0', // Para total de conexões, seria necessário histórico
                changeMediaConexao: calcularMudancaPercentual(mediaDisparosPorConexao, 
                    totalConexoes > 0 ? Math.round(totalDisparosAnterior / totalConexoes) : 0)
            };



            const resultado = {
                totalDisparos,
                conexoesAtivas,
                totalConexoes,
                mediaDisparosPorConexao,
                disparosPorDia: disparosPorDiaArray,
                estatisticas
            };


            return resultado;
        }

        // Carregar opções dos filtros (conexões e quadros) do Supabase
        async function carregarOpcoesFiltros(contaId) {
            if (!window.supabase || !contaId) return;
            var selConexoes = document.getElementById('filtroConexoes');
            var selQuadros = document.getElementById('filtroQuadroBloco');
            if (!selConexoes || !selQuadros) return;

            var valorConexaoAntes = selConexoes.value;
            var valorQuadroAntes = selQuadros.value;

            try {
                var conexRes = await window.supabase
                    .from('SAAS_Conexões')
                    .select('id, NomeConexao, instanceName')
                    .eq('contaId', contaId)
                    .order('id', { ascending: true });
                if (conexRes.error) throw conexRes.error;
                selConexoes.innerHTML = '<option value="">Todas</option>';
                (conexRes.data || []).forEach(function(c) {
                    var opt = document.createElement('option');
                    opt.value = c.id;
                    opt.textContent = c.NomeConexao || c.instanceName || ('Conexão ' + c.id);
                    selConexoes.appendChild(opt);
                });
                if (valorConexaoAntes && selConexoes.querySelector('option[value="' + valorConexaoAntes + '"]')) {
                    selConexoes.value = valorConexaoAntes;
                }

                var quadrosRes = await window.supabase
                    .from('SAAS_Quadros')
                    .select('id, nome')
                    .eq('contaId', contaId)
                    .order('id', { ascending: true });
                if (quadrosRes.error) throw quadrosRes.error;
                selQuadros.innerHTML = '';
                (quadrosRes.data || []).forEach(function(q) {
                    var opt = document.createElement('option');
                    opt.value = q.id;
                    opt.textContent = q.nome || ('Quadro ' + q.id);
                    selQuadros.appendChild(opt);
                });
                if (valorQuadroAntes && selQuadros.querySelector('option[value="' + valorQuadroAntes + '"]')) {
                    selQuadros.value = valorQuadroAntes;
                } else if (quadrosRes.data && quadrosRes.data.length > 0) {
                    selQuadros.value = quadrosRes.data[0].id;
                }
            } catch (e) {
                console.warn('Erro ao carregar opções dos filtros:', e);
            }
        }

        // Carregar dados do dashboard
        // Flag global para indicar que o status está bloqueado (evita toasts)
        let statusBloqueado = false;
        var dashboardUserId = null;

        async function recarregarApenasCRM() {
            if (!dashboardUserId || !window.supabase) return;
            var selQuadro = document.getElementById('filtroQuadroBloco');
            if (!selQuadro) return;
            var quadroVal = selQuadro.value;
            var p_quadro_id = (!quadroVal || quadroVal === '') ? null : parseInt(quadroVal, 10);
            try {
                var _r = await window.supabase.rpc('get_dashboard_crm', {
                    p_user_id: dashboardUserId,
                    p_quadro_id: p_quadro_id
                });
                if (_r.error) return;
                var crm = _r.data || {};
                if (dashboardData) dashboardData.crm = crm;
                if (crm.etapas && crm.etapas.length) renderFunnelVisual(crm.etapas);
                setEl('crmConversaoTotal', crm.conversaoTotal || '—');
                setEl('crmValorFechado', crm.valorFechado || '—');
            } catch (e) {
                console.warn('Erro ao atualizar CRM:', e);
            }
        }

        async function carregarDashboard() {
            
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
                            // Salvar nos cookies para compatibilidade (opcional)
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
                contaId = getSecureUserId();
            }
            
            if (!contaId) {
                hideLoading();
                showError('Sessão inválida. Faça login novamente.');
                // Redirecionar para login
                window.location.replace('/hublabel/public/hublabel/public/login');
                return;
            }

            try {
                if (USE_MOCK_DATA) {
                    dashboardData = getMockDashboardData(currentPeriod);
                    hideLoading();
                    showDashboard();
                    renderDashboard();
                    return;
                }

                const isClaudeEnvironment = window.location.hostname.includes('claude.ai') ||
                                          window.location.hostname.includes('anthropic') ||
                                          window.location.protocol === 'blob:';

                if (isClaudeEnvironment) {
                    dashboardData = getMockDashboardData(currentPeriod);
                    hideLoading();
                    showDashboard();
                    renderDashboard();
                    return;
                }

                // Dados reais: Supabase RPC get_dashboard
                if (!window.supabase) {
                    throw new Error('Supabase não disponível');
                }

                dashboardUserId = contaId;
                await carregarOpcoesFiltros(contaId);

                var elDataInicial = document.getElementById('dataInicial');
                var elDataFinal = document.getElementById('dataFinal');
                var di = elDataInicial && elDataInicial.value ? elDataInicial.value : null;
                var df = elDataFinal && elDataFinal.value ? elDataFinal.value : null;
                if (!di || !df) {
                    var hoje = new Date();
                    var start = new Date(hoje);
                    start.setDate(hoje.getDate() - currentPeriod);
                    di = start.toISOString().split('T')[0];
                    df = hoje.toISOString().split('T')[0];
                }
                var p_data_inicial = new Date(di + 'T00:00:00').toISOString();
                var p_data_final = new Date(df + 'T23:59:59.999').toISOString();
                var conexVal = document.getElementById('filtroConexoes') && document.getElementById('filtroConexoes').value;
                var p_conexao_ids = (!conexVal || conexVal === '') ? null : [parseInt(conexVal, 10)];
                var quadroVal = document.getElementById('filtroQuadroBloco') && document.getElementById('filtroQuadroBloco').value;
                var p_quadro_id = (!quadroVal || quadroVal === '') ? null : parseInt(quadroVal, 10);

                var _r = await window.supabase.rpc('get_dashboard', {
                    p_user_id: contaId,
                    p_data_inicial: p_data_inicial,
                    p_data_final: p_data_final,
                    p_conexao_ids: p_conexao_ids,
                    p_quadro_id: p_quadro_id
                });

                if (_r.error) {
                    throw new Error(_r.error.message || 'Erro ao carregar dashboard');
                }
                dashboardData = _r.data;
                hideLoading();
                showDashboard();
                renderDashboard();

            } catch (error) {
                console.error('ERRO ao carregar dashboard:', error);
                hideLoading();
                showError('Erro ao carregar dashboard: ' + error.message);
            }
        }

        // Renderizar dados no dashboard (estrutura nova: conversas, crm, disparos)
        function renderDashboard() {
            let d = dashboardData;
            // Normalizar formato antigo da API (só disparos no root) para estrutura nova
            if (d && !d.conversas && (d.totalDisparos != null || d.disparosPorDia)) {
                d = {
                    conversas: {},
                    crm: d.crm || { etapas: [] },
                    disparos: {
                        totalDisparos: d.totalDisparos ?? 0,
                        conexoesAtivas: d.conexoesAtivas ?? 0,
                        totalConexoes: d.totalConexoes ?? 0,
                        mediaDisparosPorConexao: d.mediaDisparosPorConexao ?? 0,
                        disparosPorDia: d.disparosPorDia || []
                    },
                    performanceAtendentes: d.performanceAtendentes || []
                };
            }
            const conv = d.conversas || {};
            const crm = d.crm || {};
            const disp = d.disparos || {};
            const performanceAtendentes = Array.isArray(d.performanceAtendentes) ? d.performanceAtendentes : [];

            // Bloco Conversas
            setEl('totalConversas', (conv.total ?? 0).toLocaleString('pt-BR'));
            setEl('conversasRespondidasIA', (conv.respondidasIA ?? 0).toLocaleString('pt-BR'));
            setEl('tempoMedioAbrir', conv.tempoMedioAbrirMin != null ? conv.tempoMedioAbrirMin + ' min' : '—');
            setEl('tempoMedioConclusao', conv.tempoMedioConclusaoHoras != null ? conv.tempoMedioConclusaoHoras + ' h' : '—');
            setEl('conversasEmAberto', (conv.emAberto ?? 0).toLocaleString('pt-BR'));
            setEl('conversasAguardando', (conv.aguardando ?? 0).toLocaleString('pt-BR'));
            setEl('conversasFechadas', (conv.fechadas ?? 0).toLocaleString('pt-BR'));
            var totalConv = conv.total || 0;
            var respIA = conv.respondidasIA || 0;
            var pctIA = totalConv > 0 ? Math.round((respIA / totalConv) * 100) : 0;
            var elProgress = document.getElementById('progressIA');
            if (elProgress) elProgress.style.width = pctIA + '%';
            setEl('pctIA', pctIA + '% do total');
            setEl('trendTotalConversas', '+12% vs período anterior');
            setEl('trendAbertura', '-5s vs média');
            // Hero cards (visual do print)
            setEl('heroTotalConversas', (conv.total ?? 0).toLocaleString('pt-BR'));
            setEl('heroConversasIA', (conv.respondidasIA ?? 0).toLocaleString('pt-BR'));
            setEl('heroPctIA', pctIA + '% do total');
            var elAbr = document.getElementById('heroTempoAbertura');
            if (elAbr) elAbr.innerHTML = (conv.tempoMedioAbrirMin != null ? conv.tempoMedioAbrirMin : 0) + '<span class="hero-card-unit">m</span>';
            var heroTc = document.getElementById('heroTempoConclusao');
            if (heroTc) {
                if (conv.tempoMedioConclusaoHoras != null) {
                    heroTc.textContent = '';
                    heroTc.innerHTML = conv.tempoMedioConclusaoHoras + '<span class="hero-card-unit">h</span>';
                    heroTc.classList.remove('hero-card-value-empty');
                } else {
                    heroTc.textContent = '—';
                    heroTc.classList.add('hero-card-value-empty');
                }
            }
            setEl('chartLegendAberto', (conv.emAberto ?? 0) + ' Aberto');
            setEl('chartLegendAguardando', (conv.aguardando ?? 0) + ' Aguardando');
            setEl('chartLegendFechadas', (conv.fechadas ?? 0) + ' Fechadas');

            // Bloco CRM (funil visual estilo dash-estilo)
            if (crm.etapas && crm.etapas.length) {
                renderFunnelVisual(crm.etapas);
            }
            setEl('crmConversaoTotal', crm.conversaoTotal || '—');
            setEl('crmValorFechado', crm.valorFechado || '—');

            // Bloco Disparos (formato "X / Y")
            setEl('totalDisparos', (disp.totalDisparos ?? 0).toLocaleString('pt-BR'));
            const ativas = disp.conexoesAtivas ?? 0;
            const totalConn = disp.totalConexoes ?? 0;
            setEl('conexoesAtivas', ativas + ' / ' + totalConn);

            // Tabela Performance por Atendente
            renderPerformanceAtendentes(performanceAtendentes);

            // Gráficos: rAF após layout + re-render do conversas após flex layout estabilizar
            const convData = conv.conversasPorDia || [];
            const dispData = disp.disparosPorDia || [];
            requestAnimationFrame(function() {
                renderChartConversas(convData);
                renderChartDisparos(dispData);
                setTimeout(function() { renderChartConversas(convData); }, 200);
            });
        }

        function renderPerformanceAtendentes(lista) {
            const tbody = document.getElementById('performanceAtendentesBody');
            if (!tbody) return;
            if (!lista || lista.length === 0) {
                tbody.innerHTML = '';
                return;
            }
            var maxQtd = Math.max.apply(null, lista.map(function(r) { return r.quantidadeAtendimentos || 0; })) || 1;
            var userIconSvg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>';
            tbody.innerHTML = lista.map(function(row, idx) {
                var rawNome = row.nome != null ? String(row.nome).trim() : '';
                var email = (row.email != null && String(row.email).trim() !== '') ? String(row.email).trim() : ((row.Email != null && String(row.Email).trim() !== '') ? String(row.Email).trim() : '');
                var semNome = !rawNome || rawNome === '—';
                var nome = semNome ? (email || 'Não atribuído') : rawNome;
                var isUnassigned = nome === 'Não atribuído';
                var iniciais = '—';
                if (!isUnassigned) {
                    if (nome.indexOf('@') !== -1) {
                        var loc = (nome.split('@')[0] || '').replace(/[^a-zA-Z0-9]/g, '');
                        iniciais = loc.length >= 2 ? (loc[0] + loc[1]).toUpperCase() : (loc[0] ? (loc[0] + loc[0]).toUpperCase() : '—');
                    } else {
                        iniciais = nome.split(' ').map(function(s) { return (s && s[0]) ? s[0].toUpperCase() : ''; }).slice(0,2).join('') || '—';
                    }
                }
                var qtd = row.quantidadeAtendimentos != null ? Number(row.quantidadeAtendimentos) : 0;
                var pct = maxQtd > 0 ? Math.round((qtd / maxQtd) * 100) : 0;
                var abertura = row.tempoMedioAberturaMin != null ? row.tempoMedioAberturaMin + ' min' : '—';
                var avatarCl = isUnassigned ? 'perf-avatar-unassigned' : (qtd > 0 ? 'perf-avatar-active' : 'perf-avatar-inactive');
                var avatarHtml = isUnassigned ? '<span class="perf-avatar ' + avatarCl + '">' + userIconSvg + '</span>' : '<span class="perf-avatar ' + avatarCl + '">' + escapeHtml(iniciais) + '</span>';
                var rowCl = qtd > 0 ? '' : ' perf-row-inactive';
                var nomeCl = isUnassigned ? ' perf-nome-unassigned' : '';
                var aberturaTag = abertura !== '—' ? '<span class="perf-tag">' + escapeHtml(abertura) + '</span>' : '<span class="perf-dash">—</span>';
                return '<tr class="' + rowCl + '"><td><div class="perf-cell-atendente">' + avatarHtml + '<span class="perf-nome' + nomeCl + '">' + escapeHtml(nome) + '</span></div></td><td><div class="perf-cell-atendimentos"><span class="perf-qtd">' + qtd.toLocaleString('pt-BR') + '</span><div class="perf-bar-wrap"><div class="perf-bar-fill" style="width:' + pct + '%;"></div></div></div></td><td>' + aberturaTag + '</td></tr>';
            }).join('');
        }

        function escapeHtml(s) {
            if (s == null) return '';
            var div = document.createElement('div');
            div.textContent = s;
            return div.innerHTML;
        }

        function setEl(id, text) {
            const el = document.getElementById(id);
            if (el) el.textContent = text;
        }

        function renderFunnelVisual(etapas) {
            const container = document.getElementById('funnelVisual');
            if (!container) return;
            var html = '';
            (etapas || []).forEach(function(e, i) {
                var qtd = e.quantidade ?? 0;
                var pct = e.percentual ?? 0;
                var label = e.nome || 'Etapa ' + (i + 1);
                var isDrop = (pct >= 100 && qtd === 0) || qtd === 0;
                var dotCl = isDrop ? 'inactive' : 'active';
                var subTxt = 'ETAPA ' + (i + 1);
                var subCl = '';
                var valTxt = isDrop ? '0 (0%)' : (qtd + (pct > 0 && pct < 100 ? ' (' + pct + '%)' : ''));
                var valCl = isDrop ? ' muted' : '';
                html += '<div class="funnel-timeline-step">';
                html += '<div class="funnel-timeline-left">';
                html += '<span class="funnel-timeline-dot ' + dotCl + '"></span>';
                html += '<div class="funnel-timeline-line" style="background:' + (isDrop ? '#e2e8f0' : '#6C63FF') + ';"></div>';
                html += '</div>';
                html += '<div class="funnel-timeline-content">';
                html += '<div><div class="funnel-timeline-title' + (isDrop ? ' muted' : '') + '">' + escapeHtml(label) + '</div><div class="funnel-timeline-subtitle' + subCl + '">' + subTxt + '</div></div>';
                html += '<span class="funnel-timeline-value' + valCl + '">' + escapeHtml(valTxt) + '</span>';
                html += '</div></div>';
            });
            container.innerHTML = html;
        }

        // Atualizar indicadores de mudança
        function updateChangeIndicator(elementId, change) {
            const element = document.getElementById(elementId);
            const changeValue = parseFloat(change);
            const span = element.querySelector('span');
            
            span.textContent = `${changeValue >= 0 ? '+' : ''}${changeValue}%`;
            
            // Remover classes existentes
            element.classList.remove('positive', 'negative', 'neutral');
            
            // Adicionar classe apropriada
            if (changeValue > 0) {
                element.classList.add('positive');
            } else if (changeValue < 0) {
                element.classList.add('negative');
            } else {
                element.classList.add('neutral');
            }
        }

        function getChartOptions(labelTooltip) {
            const isLightMode = document.body.classList.contains('light-mode');
            const gridColor = isLightMode ? 'rgba(0, 0, 0, 0.1)' : 'rgba(255, 255, 255, 0.1)';
            const borderGridColor = isLightMode ? 'rgba(0, 0, 0, 0.2)' : 'rgba(255, 255, 255, 0.2)';
            const ticksColor = isLightMode ? '#666' : '#888';
            const tooltipBg = isLightMode ? 'rgba(255, 255, 255, 0.95)' : 'rgba(0, 0, 0, 0.8)';
            const tooltipText = isLightMode ? '#333' : '#ffffff';
            const pointBorder = isLightMode ? '#ffffff' : '#ffffff';
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: tooltipBg,
                        titleColor: tooltipText,
                        bodyColor: tooltipText,
                        borderColor: '#6C63FF',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return (labelTooltip || '').replace('{y}', context.parsed.y.toLocaleString('pt-BR'));
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: gridColor, borderColor: borderGridColor },
                        ticks: { color: ticksColor, font: { size: 11 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor, borderColor: borderGridColor },
                        ticks: {
                            color: ticksColor,
                            font: { size: 11 },
                            callback: function(value) { return value.toLocaleString('pt-BR'); }
                        }
                    }
                },
                interaction: { intersect: false, mode: 'index' }
            };
        }

        function renderChartConversas(conversasPorDia) {
            const canvas = document.getElementById('chartConversasDia');
            if (!canvas) return;
            const wrap = canvas.closest('.evolucao-chart-wrap') || canvas.closest('.chart-canvas-wrap');
            if (wrap && wrap.offsetWidth === 0) return;
            try {
                if (chartConversas) {
                    chartConversas.destroy();
                    chartConversas = null;
                }
                var w = wrap ? wrap.clientWidth : canvas.parentElement.clientWidth || 400;
                var h = wrap ? Math.max(380, wrap.clientHeight) : 380;
                canvas.width = w;
                canvas.height = h;
                canvas.style.width = '100%';
                canvas.style.height = h + 'px';
                canvas.style.maxHeight = h + 'px';
                const labels = (conversasPorDia || []).map(i => i.dataFormatada || '');
                const data = (conversasPorDia || []).map(i => i.total != null ? i.total : (i.conversas ?? 0));
                var ctx = canvas.getContext('2d');
                var grad = ctx.createLinearGradient(0, 0, 0, h);
                grad.addColorStop(0, 'rgba(108, 99, 255, 0.25)');
                grad.addColorStop(1, 'rgba(108, 99, 255, 0)');
                var isLight = document.body.classList.contains('light-mode');
                var tooltipBg = isLight ? 'rgba(255,255,255,0.95)' : 'rgba(15, 23, 42, 0.95)';
                var tooltipColor = isLight ? '#333' : '#e2e8f0';
                var ticksColor = isLight ? '#94a3b8' : '#94a3b8';
                var gridColor = isLight ? 'rgba(148, 163, 184, 0.3)' : 'rgba(148, 163, 184, 0.2)';
                var pointBg = isLight ? '#ffffff' : '#1e293b';
                chartConversas = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Conversas',
                            data: data,
                            borderColor: '#6C63FF',
                            backgroundColor: grad,
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            pointBackgroundColor: pointBg,
                            pointBorderColor: '#6C63FF',
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: false,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: tooltipBg,
                                titleColor: tooltipColor,
                                bodyColor: tooltipColor,
                                borderColor: '#6C63FF',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: false,
                                callbacks: { label: function(c) { return c.parsed.y.toLocaleString('pt-BR') + ' conversas'; } }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { color: ticksColor, font: { size: 11, weight: 600 } }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: gridColor,
                                    borderDash: [4, 4]
                                },
                                ticks: {
                                    color: ticksColor,
                                    font: { size: 11 },
                                    callback: function(v) { return v.toLocaleString('pt-BR'); }
                                }
                            }
                        },
                        interaction: { intersect: false, mode: 'index' }
                    }
                });
            } catch (e) {
                console.warn('Erro ao renderizar gráfico de conversas:', e);
            }
        }

        function renderChartDisparos(disparosPorDia) {
            const canvas = document.getElementById('chartDisparosDia');
            if (!canvas) return;
            var wrap = canvas.closest('.chart-canvas-wrap');
            if (wrap && wrap.offsetWidth === 0) return;
            if (chartDisparos) {
                try { chartDisparos.destroy(); } catch (e) {}
                chartDisparos = null;
            }
            var w = wrap ? wrap.clientWidth : canvas.parentElement.clientWidth || 400;
            var h = 220;
            canvas.width = w;
            canvas.height = h;
            canvas.style.width = w + 'px';
            canvas.style.height = h + 'px';
            canvas.style.maxHeight = h + 'px';
            var labels = (disparosPorDia || []).map(function(i) { return i.dataFormatada || ''; });
            var data = (disparosPorDia || []).map(function(i) { return i.disparos != null ? i.disparos : 0; });
            chartDisparos = new Chart(canvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Disparos',
                        data: data,
                        backgroundColor: '#6C63FF',
                        borderRadius: 6,
                        hoverBackgroundColor: '#6C63FF'
                    }]
                },
                options: Object.assign({}, getChartOptions('{y} disparos'), { responsive: false, maintainAspectRatio: false })
            });
        }

        function updateDateRangeLabel() {
            var di = document.getElementById('dataInicial');
            var df = document.getElementById('dataFinal');
            var lbl1 = document.getElementById('dateRangeLabel');
            var lbl2 = document.getElementById('dateRangeLabelEnd');
            if (di && df && lbl1 && lbl2) {
                var d1 = di.value ? new Date(di.value) : null;
                var d2 = df.value ? new Date(df.value) : null;
                if (d1 && d2) {
                    var fmt = function(d) { return ('0' + d.getDate()).slice(-2) + '/' + ('0' + (d.getMonth() + 1)).slice(-2); };
                    lbl1.textContent = fmt(d1);
                    lbl2.textContent = fmt(d2);
                }
            }
        }

        // Configurar filtros de data
        function setupDateFilters() {
            var elDataInicial = document.getElementById('dataInicial');
            var elDataFinal = document.getElementById('dataFinal');
            var dateRangeButtons = document.querySelectorAll('.btn-date-range:not(.btn-date-range-custom)');
            var hoje = new Date();
            var dataInicial = new Date();
            dataInicial.setDate(hoje.getDate() - 7);
            elDataInicial.value = dataInicial.toISOString().split('T')[0];
            elDataFinal.value = hoje.toISOString().split('T')[0];
            updateDateRangeLabel();

            dateRangeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    dateRangeButtons.forEach(function(btn) { btn.classList.remove('active'); });
                    this.classList.add('active');
                    currentPeriod = parseInt(this.dataset.days, 10);
                    var h = new Date();
                    var di = new Date();
                    di.setDate(h.getDate() - currentPeriod);
                    elDataInicial.value = di.toISOString().split('T')[0];
                    elDataFinal.value = h.toISOString().split('T')[0];
                    updateDateRangeLabel();
                    recarregarDashboard();
                });
            });

            elDataInicial.addEventListener('change', function() {
                dateRangeButtons.forEach(function(btn) { btn.classList.remove('active'); });
                var di = new Date(this.value);
                var df = new Date(elDataFinal.value);
                currentPeriod = Math.ceil(Math.abs(df - di) / (1000 * 60 * 60 * 24));
                updateDateRangeLabel();
                recarregarDashboard();
            });

            elDataFinal.addEventListener('change', function() {
                dateRangeButtons.forEach(function(btn) { btn.classList.remove('active'); });
                var di = new Date(elDataInicial.value);
                var df = new Date(this.value);
                currentPeriod = Math.ceil(Math.abs(df - di) / (1000 * 60 * 60 * 24));
                updateDateRangeLabel();
                recarregarDashboard();
            });

            var elFiltroConexoes = document.getElementById('filtroConexoes');
            if (elFiltroConexoes) elFiltroConexoes.addEventListener('change', recarregarDashboard);
            var elFiltroQuadro = document.getElementById('filtroQuadroBloco');
            if (elFiltroQuadro) elFiltroQuadro.addEventListener('change', recarregarApenasCRM);
        }

        // Recarregar dashboard
        async function recarregarDashboard() {
            setEl('totalConversas', '...');
            setEl('conversasRespondidasIA', '...');
            setEl('tempoMedioAbrir', '...');
            setEl('tempoMedioConclusao', '...');
            setEl('conversasEmAberto', '...');
            setEl('conversasAguardando', '...');
            setEl('conversasFechadas', '...');
            setEl('totalDisparos', '...');
            setEl('conexoesAtivas', '...');
            setEl('totalConexoes', '...');
            setEl('mediaPorConexao', '...');
            await carregarDashboard();
        }

        // Atualizar dashboard
        async function atualizarDashboard() {
            const btnAtualizar = document.getElementById('btnAtualizar');
            btnAtualizar.disabled = true;
            btnAtualizar.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite;"><polyline points="23,4 23,10 17,10"></polyline><polyline points="1,20 1,14 7,14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg> Atualizando...';

            try {
                await carregarDashboard();
                showSuccess('Dashboard atualizado com sucesso!');
            } catch (error) {
                showError('Erro ao atualizar dashboard: ' + error.message);
            } finally {
                btnAtualizar.disabled = false;
                btnAtualizar.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23,4 23,10 17,10"></polyline><polyline points="1,20 1,14 7,14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg> Atualizar';
            }
        }

        // Event listeners para navegação
        function setupNavigation() {
            // Event listener para botão atualizar
            const btnAtualizar = document.getElementById('btnAtualizar');
            if (btnAtualizar) {
                btnAtualizar.addEventListener('click', atualizarDashboard);
            }
        }

        // Inicialização
        async function inicializarPagina() {
            checkAuth();
            carregarVersao();
            setupNavigation();
            setupDateFilters();
            
            // Carregar dashboard
            await carregarDashboard();
        }

        // Executar quando o DOM estiver pronto
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', inicializarPagina);
        } else {
            inicializarPagina();
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

        // ===== FUNÇÕES DE MENSAGENS DE FEEDBACK =====
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

        // ===== MOBILE MENU FUNCTIONS =====
        function toggleMobileMenu() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('mobile-open')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }

        function openMobileMenu() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Garantir que o menu seja visível
            sidebar.style.pointerEvents = 'auto';
        }

        function closeMobileMenu() {
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
        }

        // Sidebar: expandir só quando o mouse está na faixa de 70px (throttle para não travar)
        (function() {
            var sidebarCollapseTimer = null;
            var SIDEBAR_EDGE = 70;
            var SIDEBAR_EXPANDED_WIDTH = 250;
            var COLLAPSE_DELAY_MS = 120;
            var lastMove = 0;
            var THROTTLE_MS = 80;
            function onMouseMove(e) {
                if (window.matchMedia('(max-width: 768px)').matches) return;
                var sidebar = document.querySelector('.sidebar');
                if (!sidebar || sidebar.classList.contains('mobile-open')) return;
                var now = Date.now();
                if (now - lastMove < THROTTLE_MS) return;
                lastMove = now;
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
            }
            document.addEventListener('mousemove', onMouseMove, { passive: true });
        })();

        // ===== INICIALIZAÇÃO DO MENU MOBILE =====
        function initMobileMenu() {
            // Fechar menu ao redimensionar para desktop (debounce para evitar múltiplos reflows)
            var resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    if (window.innerWidth > 768) closeMobileMenu();
                }, 120);
            });
            
            // Um único listener no sidebar (delegação) para mobile - menos memória e mais fluido
            function handleMenuAction(originalOnclick) {
                if (!originalOnclick) return;
                closeMobileMenu();
                if (originalOnclick.includes('navigateToPage')) {
                    var urlMatch = originalOnclick.match(/navigateToPage\('([^']+)'\)/);
                    if (urlMatch && urlMatch[1]) window.location.href = urlMatch[1];
                } else if (originalOnclick.includes('window.open')) {
                    var openMatch = originalOnclick.match(/window\.open\('([^']+)'/);
                    if (openMatch && openMatch[1]) window.open(openMatch[1], '_blank');
                } else if (originalOnclick.includes('logout') && typeof logout === 'function') {
                    logout();
                }
            }
            var sidebarEl = document.querySelector('.sidebar');
            if (sidebarEl) {
                sidebarEl.addEventListener('touchend', function(e) {
                    if (window.innerWidth > 768) return;
                    var item = e.target.closest('.menu-item');
                    if (item) {
                        e.preventDefault();
                        e.stopPropagation();
                        handleMenuAction(item.getAttribute('onclick'));
                    }
                }, { passive: false });
                sidebarEl.addEventListener('click', function(e) {
                    if (window.innerWidth > 768) return;
                    var item = e.target.closest('.menu-item');
                    if (item) {
                        e.preventDefault();
                        e.stopPropagation();
                        handleMenuAction(item.getAttribute('onclick'));
                    }
                }, { capture: true });
            }
            
            // Fechar menu ao clicar no overlay
            const overlay = document.getElementById('sidebarOverlay');
            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const sidebar = document.querySelector('.sidebar');
                    if (sidebar) {
                        sidebar.classList.remove('mobile-open');
                        sidebar.style.pointerEvents = '';
                    }
                    overlay.classList.remove('active');
                    overlay.style.display = 'none';
                    overlay.style.pointerEvents = 'none';
                    document.body.style.overflow = '';
                });
            }
            
            // NÃO prevenir propagação no sidebar - isso estava bloqueando os cliques!
            // Removido o stopPropagation que estava impedindo a navegação
        }

        // Inicializar quando DOM estiver pronto
        document.addEventListener('DOMContentLoaded', function() {
            initMobileMenu();
            initDarkMode();
        });

        // ===== DARK MODE / LIGHT MODE =====
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
            
            // Re-renderizar gráficos quando o tema mudar
            if (dashboardData && Object.keys(dashboardData).length) {
                setTimeout(() => {
                    renderChartConversas((dashboardData.conversas || {}).conversasPorDia || []);
                    renderChartDisparos((dashboardData.disparos || {}).disparosPorDia || []);
                }, 100);
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