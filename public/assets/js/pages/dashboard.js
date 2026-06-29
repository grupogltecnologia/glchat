/**
 * Dashboard - JavaScript reescrito para PHP/MySQL
 * Baseado na lógica original do n8n
 */

function appUrl(path) {
    if (typeof window.glchatUrl === 'function') return window.glchatUrl(path);
    if (typeof window.hublabelUrl === 'function') return window.hublabelUrl(path);
    return path;
}

document.addEventListener('DOMContentLoaded', async () => {
    console.log('✅ Dashboard page loaded');
    
    // Configurar menu lateral
    configurarMenuLateral();
    
    // Carregar dados do resumo
    await loadDashboardData();
    
    // Atualizar a cada 30 segundos
    setInterval(loadDashboardData, 30000);
});

function configurarMenuLateral() {
    // Mapeamento de rotas
    const rotas = {
        'chat': appUrl('/chat'),
        'agentes-ia': appUrl('/agentes'),
        'crm': appUrl('/crm'),
        'conexoes': appUrl('/conexoes'),
        'disparos': appUrl('/disparos'),
        'contatos': appUrl('/contatos'),
        'ajuda': appUrl('/ajuda'),
        'configuracoes': appUrl('/configuracoes'),
        'admin': appUrl('/admin')
    };
    
    // Configurar navegação dos itens do menu
    const menuItems = document.querySelectorAll('.menu-item[data-menu-id]');
    menuItems.forEach(item => {
        const menuId = item.getAttribute('data-menu-id');
        if (rotas[menuId]) {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('📍 Navegando para:', rotas[menuId]);
                window.location.href = rotas[menuId];
            });
        }
    });
    
    // Logout
    const logoutItem = document.querySelector('.logout-item');
    if (logoutItem) {
        logoutItem.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Deseja realmente sair?')) {
                window.location.href = appUrl('/logout');
            }
        });
    }
    
    // Toggle do menu em mobile
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
    
    console.log('✅ Menu lateral configurado');
}

async function loadDashboardData() {
    try {
        const response = await fetch(appUrl('/api/dashboard/resumo'));
        const data = await response.json();
        
        if (data.success) {
            updateDashboard(data.data);
        } else {
            console.log('Dashboard: Dados não disponíveis ainda');
        }
    } catch (error) {
        console.log('Dashboard: Aguardando dados...', error.message);
    }
}

function updateDashboard(data) {
    // Atualizar contadores
    updateCounter('totalContatos', data.totalContatos || data.contatos?.total || 0);
    updateCounter('totalConversas', data.totalConversas || data.conversas?.total || 0);
    updateCounter('totalConexoes', data.totalConexoes || data.conexoes?.total || 0);
    updateCounter('totalDisparos', data.totalDisparos || data.disparos?.total || 0);
    
    // Atualizar informações do usuário
    if (data.usuario) {
        const userNameEl = document.querySelector('[data-user-name]');
        if (userNameEl) {
            userNameEl.textContent = data.usuario.nome || 'Usuário';
        }
    }
}

function updateCounter(id, value) {
    const element = document.getElementById(id);
    if (element) {
        // Animação de contagem
        const currentValue = parseInt(element.textContent) || 0;
        animateValue(element, currentValue, value, 500);
    }
}

function animateValue(element, start, end, duration) {
    const range = end - start;
    const increment = range / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
            current = end;
            clearInterval(timer);
        }
        element.textContent = Math.round(current);
    }, 16);
}
