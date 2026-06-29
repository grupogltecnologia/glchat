<?php
require_once __DIR__ . '/../../Core/Auth.php';
Auth::iniciar();

$usuarioNome = Auth::obterNome() ?? 'Usuário';
$usuarioEmail = Auth::obterEmail() ?? '';
$funcao = Auth::obterFuncao() ?? 'admin';
$isSuperAdmin = Auth::isSuperAdmin();

$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <span class="logo-icon">🏷️</span>
            <span class="logo-text">HUBLABEL</span>
        </div>
        <button class="sidebar-toggle" id="sidebarToggle">
            <span class="material-symbols-rounded">menu</span>
        </button>
    </div>
    
    <nav class="sidebar-nav">
        <a href="/dashboard" class="nav-item <?= $currentPath === '/dashboard' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">dashboard</span>
            <span class="nav-text">Dashboard</span>
        </a>
        
        <a href="/chat" class="nav-item <?= $currentPath === '/chat' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">chat</span>
            <span class="nav-text">Chat</span>
            <span class="badge" id="chatBadge">0</span>
        </a>
        
        <a href="/contatos" class="nav-item <?= $currentPath === '/contatos' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">contacts</span>
            <span class="nav-text">Contatos</span>
        </a>
        
        <a href="/conexoes" class="nav-item <?= $currentPath === '/conexoes' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">phonelink</span>
            <span class="nav-text">Conexões</span>
        </a>
        
        <a href="/disparos" class="nav-item <?= $currentPath === '/disparos' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">send</span>
            <span class="nav-text">Disparos</span>
        </a>
        
        <a href="/agentes-ia" class="nav-item <?= $currentPath === '/agentes-ia' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">smart_toy</span>
            <span class="nav-text">Agentes IA</span>
        </a>
        
        <a href="/crm" class="nav-item <?= $currentPath === '/crm' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">view_kanban</span>
            <span class="nav-text">CRM</span>
        </a>
        
        <div class="nav-divider"></div>
        
        <a href="/configuracoes" class="nav-item <?= $currentPath === '/configuracoes' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">settings</span>
            <span class="nav-text">Configurações</span>
        </a>
        
        <?php if ($isSuperAdmin): ?>
        <a href="/adminpannel" class="nav-item <?= $currentPath === '/adminpannel' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">admin_panel_settings</span>
            <span class="nav-text">Administração</span>
        </a>
        <?php endif; ?>
        
        <a href="/ajuda" class="nav-item <?= $currentPath === '/ajuda' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">help</span>
            <span class="nav-text">Ajuda</span>
        </a>
    </nav>
    
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <?= strtoupper(substr($usuarioNome, 0, 2)) ?>
            </div>
            <div class="user-details">
                <div class="user-name"><?= htmlspecialchars($usuarioNome) ?></div>
                <div class="user-role"><?= ucfirst($funcao) ?></div>
            </div>
            <a href="/logout" class="logout-btn" title="Sair">
                <span class="material-symbols-rounded">logout</span>
            </a>
        </div>
    </div>
</aside>

<style>
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    width: 260px;
    background: white;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    transition: transform 0.3s ease;
}

.sidebar-header {
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
    font-size: 18px;
    color: #6C63FF;
}

.logo-icon {
    font-size: 24px;
}

.sidebar-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
    border-radius: 8px;
}

.sidebar-toggle:hover {
    background: #f3f4f6;
}

.sidebar-nav {
    flex: 1;
    padding: 20px 10px;
    overflow-y: auto;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    margin-bottom: 4px;
    border-radius: 10px;
    color: #64748b;
    text-decoration: none;
    transition: all 0.2s;
    position: relative;
}

.nav-item:hover {
    background: #f8fafc;
    color: #1e293b;
}

.nav-item.active {
    background: linear-gradient(135deg, #6C63FF 0%, #5a52d5 100%);
    color: white;
}

.nav-item .material-symbols-rounded {
    font-size: 22px;
}

.nav-text {
    font-weight: 500;
    font-size: 14px;
}

.badge {
    margin-left: auto;
    background: #ef4444;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    min-width: 20px;
    text-align: center;
}

.nav-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 12px 0;
}

.sidebar-footer {
    padding: 16px;
    border-top: 1px solid #e5e7eb;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6C63FF 0%, #5a52d5 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.user-details {
    flex: 1;
}

.user-name {
    font-weight: 600;
    font-size: 14px;
    color: #1e293b;
}

.user-role {
    font-size: 12px;
    color: #64748b;
}

.logout-btn {
    padding: 8px;
    border-radius: 8px;
    color: #64748b;
    transition: all 0.2s;
}

.logout-btn:hover {
    background: #fef2f2;
    color: #ef4444;
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }
    
    .sidebar.active {
        transform: translateX(0);
    }
    
    .sidebar-toggle {
        display: block;
    }
}
</style>
