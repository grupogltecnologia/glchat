/**
 * GLChat - JavaScript Principal
 * Substitui o código do n8n/Supabase por chamadas PHP/MySQL
 */

console.log('GLChat carregado');

// ==================== CONFIGURAÇÃO ====================
const APP_BASE = (window.GLCHAT_BASE || window.HUBLABEL_BASE || inferAppBase()).replace(/\/$/, '');
const API_BASE = `${APP_BASE}/api`;

function inferAppBase() {
    const script = document.currentScript || Array.from(document.scripts).find(s => (s.src || '').includes('/assets/js/app.js'));
    if (script?.src) {
        try {
            const url = new URL(script.src);
            const marker = '/assets/js/app.js';
            const index = url.pathname.indexOf(marker);
            if (index >= 0) return url.pathname.slice(0, index);
        } catch (_) {}
    }

    const match = location.pathname.match(/^\/(?:hublabel|glchat)\/public/);
    return match ? match[0] : '';
}

function appUrl(path) {
    const normalized = String(path || '/').startsWith('/') ? String(path || '/') : `/${path}`;
    return `${APP_BASE}${normalized}`;
}

// ==================== HELPER DE API ====================
async function apiRequest(endpoint, options = {}) {
    const url = endpoint.startsWith('http') ? endpoint : `${API_BASE}${endpoint}`;
    
    const defaultOptions = {
        headers: { 'Content-Type': 'application/json' },
        credentials: 'same-origin',
    };
    
    try {
        const response = await fetch(url, { ...defaultOptions, ...options });
        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.error || 'Erro na requisição');
        }
        
        return { data: data.data, error: null };
    } catch (error) {
        console.error('Erro na API:', error);
        return { data: null, error: error.message };
    }
}

// ==================== COMPATIBILIDADE SUPABASE ====================
window.supabase = {
    auth: {
        signInWithPassword: async ({ email, password }) => {
            const { data, error } = await apiRequest('/login', {
                method: 'POST',
                body: JSON.stringify({ email, password })
            });
            
            if (error) return { data: null, error: { message: error } };
            
            return {
                data: { session: { access_token: 'php-session' }, user: data.usuario },
                error: null
            };
        },
        
        signOut: async () => {
            window.location.href = appUrl('/logout');
            return { error: null };
        },
        
        getSession: async () => {
            return { data: { session: { access_token: 'php-session' } }, error: null };
        },
        
        getUser: async () => {
            const { data, error } = await apiRequest('/dashboard/resumo');
            if (error) return { data: null, error: { message: error } };
            return { data: { user: data.usuario }, error: null };
        }
    },
    
    from: (table) => ({
        select: (columns = '*') => ({
            eq: (column, value) => ({
                single: async () => {
                    const endpoints = {
                        'SAAS_Usuarios': '/usuarios',
                        'SAAS_Contatos': '/contatos',
                        'SAAS_Conexões': '/conexoes',
                        'SAAS_Conversas_Agentes': '/conversas',
                        'SAAS_Mensagens': '/mensagens',
                        'SAAS_Disparos': '/disparos',
                        'SAAS_AgentesIA': '/agentes',
                        'SAAS_Quadros': '/crm/quadros',
                    };
                    
                    const endpoint = endpoints[table] || `/${table.toLowerCase()}`;
                    const { data, error } = await apiRequest(`${endpoint}?${column}=${value}`);
                    return { data: data?.[0] || data, error };
                }
            })
        }),
        
        insert: (values) => ({
            select: () => ({
                single: async () => {
                    const endpoint = `/api/${table.toLowerCase()}`;
                    return await apiRequest(endpoint, {
                        method: 'POST',
                        body: JSON.stringify(values)
                    });
                }
            })
        }),
        
        update: (values) => ({
            eq: (column, value) => ({
                select: () => ({
                    single: async () => {
                        const endpoint = `/api/${table.toLowerCase()}/${value}`;
                        return await apiRequest(endpoint, {
                            method: 'PUT',
                            body: JSON.stringify(values)
                        });
                    }
                })
            })
        })
    })
};

// ==================== FUNÇÕES GLOBAIS ====================

// Desabilitar verificação automática de login (causa loops)
window.checkExistingLogin = async function() {
    console.log('⏭️  Verificação automática de login desabilitada');
    return false;
};

// Toast notifications
function showToast(message, type = 'success') {
    const container = document.querySelector('.toast-container') || createToastContainer();
    
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type} show`;
    toast.innerHTML = `<span class="toast-message">${message}</span>`;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function createToastContainer() {
    const container = document.createElement('div');
    container.className = 'toast-container';
    document.body.appendChild(container);
    return container;
}

// Função de inicialização (compatibilidade)
function initSupabase() {
    console.log('✅ API PHP inicializada (Supabase substituído)');
    return window.supabase;
}

// ==================== INICIALIZAÇÃO ====================
document.addEventListener('DOMContentLoaded', () => {
    console.log('✅ DOM carregado');
    
    // Corrigir links internos
    document.querySelectorAll('a[href^="/"]').forEach(link => {
        const href = link.getAttribute('href');
        if (!href.startsWith(`${APP_BASE}/`)) {
            const newHref = appUrl(href);
            link.setAttribute('href', newHref);
        }
    });
});

console.log('GLChat JavaScript carregado com sucesso');
