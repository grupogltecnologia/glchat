<header class="page-header">
    <div class="header-left">
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            <span class="material-symbols-rounded">menu</span>
        </button>
        <h1 class="page-title"><?= $pageTitle ?? 'Dashboard' ?></h1>
    </div>
    
    <div class="header-right">
        <button class="theme-toggle" id="themeToggle" title="Alternar tema">
            <span class="material-symbols-rounded">dark_mode</span>
        </button>
        
        <div class="notifications-dropdown">
            <button class="notifications-btn" id="notificationsBtn">
                <span class="material-symbols-rounded">notifications</span>
                <span class="notification-badge" id="notificationBadge">0</span>
            </button>
            <div class="notifications-panel" id="notificationsPanel">
                <div class="notifications-header">
                    <h3>Notificações</h3>
                    <button class="mark-all-read">Marcar todas como lidas</button>
                </div>
                <div class="notifications-list" id="notificationsList">
                    <div class="empty-state">
                        <span class="material-symbols-rounded">notifications_off</span>
                        <p>Nenhuma notificação</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
.page-header {
    position: sticky;
    top: 0;
    background: white;
    border-bottom: 1px solid #e5e7eb;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 100;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.mobile-menu-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
    border-radius: 8px;
}

.mobile-menu-toggle:hover {
    background: #f3f4f6;
}

.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.theme-toggle,
.notifications-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 10px;
    border-radius: 10px;
    color: #64748b;
    transition: all 0.2s;
    position: relative;
}

.theme-toggle:hover,
.notifications-btn:hover {
    background: #f8fafc;
    color: #1e293b;
}

.notification-badge {
    position: absolute;
    top: 6px;
    right: 6px;
    background: #ef4444;
    color: white;
    font-size: 10px;
    font-weight: 600;
    padding: 2px 5px;
    border-radius: 10px;
    min-width: 16px;
    text-align: center;
}

.notifications-dropdown {
    position: relative;
}

.notifications-panel {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    width: 360px;
    max-height: 480px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.notifications-panel.active {
    display: flex;
}

.notifications-header {
    padding: 16px 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.notifications-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.mark-all-read {
    background: none;
    border: none;
    color: #6C63FF;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
}

.notifications-list {
    flex: 1;
    overflow-y: auto;
}

.empty-state {
    padding: 40px 20px;
    text-align: center;
    color: #94a3b8;
}

.empty-state .material-symbols-rounded {
    font-size: 48px;
    opacity: 0.5;
}

.empty-state p {
    margin-top: 8px;
    font-size: 14px;
}

@media (max-width: 768px) {
    .mobile-menu-toggle {
        display: block;
    }
    
    .page-title {
        font-size: 20px;
    }
    
    .notifications-panel {
        width: 320px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.getElementById('sidebar');
    const notificationsBtn = document.getElementById('notificationsBtn');
    const notificationsPanel = document.getElementById('notificationsPanel');
    const themeToggle = document.getElementById('themeToggle');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
    
    if (notificationsBtn) {
        notificationsBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationsPanel.classList.toggle('active');
        });
    }
    
    document.addEventListener('click', function(e) {
        if (!notificationsPanel.contains(e.target) && !notificationsBtn.contains(e.target)) {
            notificationsPanel.classList.remove('active');
        }
    });
    
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('.material-symbols-rounded');
            icon.textContent = document.body.classList.contains('dark-mode') ? 'light_mode' : 'dark_mode';
            localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
        });
        
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            themeToggle.querySelector('.material-symbols-rounded').textContent = 'light_mode';
        }
    }
});
</script>
