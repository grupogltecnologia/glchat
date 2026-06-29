/**
 * Menu Lateral - Script global para todas as páginas
 */

(function() {
    'use strict';

    const APP_BASE = (window.GLCHAT_BASE || window.HUBLABEL_BASE || inferAppBase()).replace(/\/$/, '');
    const LEGACY_BASE_RE = /(?:\/(?:hublabel|glchat)\/public)+/g;

    function inferAppBase() {
        const script = document.currentScript || Array.from(document.scripts).find(s => (s.src || '').includes('/assets/js/menu-global.js'));
        if (script?.src) {
            try {
                const url = new URL(script.src);
                const marker = '/assets/js/menu-global.js';
                const index = url.pathname.indexOf(marker);
                if (index >= 0) return url.pathname.slice(0, index);
            } catch (_) {}
        }

        const match = location.pathname.match(/^\/(?:hublabel|glchat)\/public/);
        return match ? match[0] : '';
    }

    function normalizeAppUrl(url) {
        if (!url) return APP_BASE + '/dashboard';

        let target = String(url).trim();
        if (/^https?:\/\//i.test(target)) {
            const parsed = new URL(target);
            target = parsed.pathname + parsed.search + parsed.hash;
        }

        target = target.replace(LEGACY_BASE_RE, APP_BASE);

        if (!target.startsWith('/')) {
            target = '/' + target;
        }

        if (APP_BASE && !target.startsWith(APP_BASE + '/') && target !== APP_BASE) {
            target = APP_BASE + target;
        }

        return target.replace(LEGACY_BASE_RE, APP_BASE);
    }

    window.hublabelUrl = normalizeAppUrl;
    window.navigateToPage = function(url) {
        window.location.href = normalizeAppUrl(url);
        return false;
    };

    if (APP_BASE && location.pathname.includes(APP_BASE + APP_BASE)) {
        const clean = normalizeAppUrl(location.pathname + location.search + location.hash);
        window.history.replaceState({}, '', clean);
    }

    document.addEventListener('click', function(e) {
        const item = e.target.closest('.menu-item[data-menu-id], #menu-item-admin, .logout-item');
        if (!item) return;

        const routes = {
            'dashboard': '/dashboard',
            'chat': '/chat',
            'agentes-ia': '/agentes',
            'crm': '/crm',
            'conexoes': '/conexoes',
            'disparos': '/disparos',
            'contatos': '/contatos',
            'ajuda': '/ajuda',
            'configuracoes': '/configuracoes',
            'admin': '/admin'
        };

        const menuId = item.getAttribute('data-menu-id');
        let target = null;
        if (item.classList.contains('logout-item')) {
            target = '/logout';
        } else if (item.id === 'menu-item-admin') {
            target = '/admin';
        } else if (menuId && routes[menuId]) {
            target = routes[menuId];
        } else if (item.textContent && item.textContent.includes('Dashboard')) {
            target = '/dashboard';
        }

        if (target) {
            e.preventDefault();
            e.stopImmediatePropagation();
            window.location.href = normalizeAppUrl(target);
        }
    }, true);
    
    // Aguardar DOM carregar
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMenu);
    } else {
        initMenu();
    }
    
    function initMenu() {
        console.log('🔧 Inicializando menu lateral global');
        
        // Verificar se é super admin e mostrar menu de administração
        verificarSuperAdmin();
        
        // Mapeamento de rotas
        const rotas = {
            'dashboard': normalizeAppUrl('/dashboard'),
            'chat': normalizeAppUrl('/chat'),
            'agentes-ia': normalizeAppUrl('/agentes'),
            'crm': normalizeAppUrl('/crm'),
            'conexoes': normalizeAppUrl('/conexoes'),
            'disparos': normalizeAppUrl('/disparos'),
            'contatos': normalizeAppUrl('/contatos'),
            'ajuda': normalizeAppUrl('/ajuda'),
            'configuracoes': normalizeAppUrl('/configuracoes'),
            'admin': normalizeAppUrl('/admin')
        };
        
        // Configurar navegação
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            const menuId = item.getAttribute('data-menu-id');
            const href = item.getAttribute('href');
            
            // Se tem data-menu-id
            if (menuId && rotas[menuId]) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('📍 Navegando para:', rotas[menuId]);
                    window.location.href = normalizeAppUrl(rotas[menuId]);
                });
            }
            // Se é o item ativo (dashboard sem data-menu-id)
            else if (item.classList.contains('active') && item.textContent.includes('Dashboard')) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = normalizeAppUrl(rotas['dashboard']);
                });
            }
        });
        
        // Logout
        const logoutItem = document.querySelector('.logout-item');
        if (logoutItem) {
            logoutItem.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Deseja realmente sair?')) {
                    window.location.href = normalizeAppUrl('/logout');
                }
            });
        }
        
        // Menu mobile
        const menuToggle = document.querySelector('#mobileMenuToggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        const closeBtn = document.querySelector('#mobileCloseBtn');
        
        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.add('mobile-open');
                if (overlay) overlay.classList.add('active');
            });
        }
        
        if (closeBtn && sidebar) {
            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('mobile-open');
                if (overlay) overlay.classList.remove('active');
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            });
        }
        
        // Forçar expansão do menu ao passar o mouse (fallback se CSS não funcionar)
        if (sidebar) {
            sidebar.addEventListener('mouseenter', function() {
                this.classList.add('sidebar-expanded');
            });
            
            sidebar.addEventListener('mouseleave', function() {
                this.classList.remove('sidebar-expanded');
            });
        }
        
        console.log('✅ Menu lateral global configurado');
    }
    
    async function verificarSuperAdmin() {
        try {
            const response = await fetch(normalizeAppUrl('/api/auth/check-superadmin'));
            const result = await response.json();
            
            if (result.success && result.isSuperAdmin) {
                // Mostrar item de administração
                const adminMenuItem = document.getElementById('menu-item-admin');
                if (adminMenuItem) {
                    adminMenuItem.style.display = 'flex';
                    
                    // Adicionar evento de clique
                    adminMenuItem.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.location.href = normalizeAppUrl('/admin');
                    });
                    
                    console.log('✅ Menu de Administração habilitado (Super Admin)');
                }
            } else {
                console.log('ℹ️ Usuário não é super admin - menu oculto');
            }
        } catch (error) {
            console.log('⚠️ Erro ao verificar super admin:', error);
        }
    }
})();
