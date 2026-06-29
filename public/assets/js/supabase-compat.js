/**
 * GLChat - helper de compatibilidade para chamadas antigas do Supabase.
 * As partes ja migradas chamam o backend PHP/MySQL; tabelas antigas ainda sem
 * endpoint retornam vazio para nao quebrar a interface enquanto sao migradas.
 */

var APP_BASE = (window.GLCHAT_BASE || window.HUBLABEL_BASE || inferAppBase()).replace(/\/$/, '');
var API_BASE = window.GLCHAT_API_BASE || window.HUBLABEL_API_BASE || `${APP_BASE}/api`;

function inferAppBase() {
    const script = document.currentScript || Array.from(document.scripts).find(s => (s.src || '').includes('/assets/js/supabase-compat.js'));
    if (script?.src) {
        try {
            const url = new URL(script.src);
            const marker = '/assets/js/supabase-compat.js';
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

var TABLE_ENDPOINTS = {
    'SAAS_Usuarios': '/usuarios',
    'SAAS_Contatos': '/contatos',
    'SAAS_Conexoes': '/conexoes',
    'SAAS_Conexões': '/conexoes',
    'SAAS_ConexÃµes': '/conexoes',
    'SAAS_Conversas_Agentes': '/conversas',
    'SAAS_Mensagens': '/mensagens',
    'SAAS_Disparos': '/disparos',
    'SAAS_AgentesIA': '/agentes',
    'SAAS_Quadros': '/crm/quadros',
    'SAAS_Config_Emails': null,
    'SAAS_IntegracaoPagamento': null,
    'SAAS_Versao': null,
};

async function apiRequest(endpoint, options = {}) {
    const url = endpoint.startsWith('http') ? endpoint : `${API_BASE}${endpoint}`;
    const defaultOptions = {
        headers: { 'Content-Type': 'application/json' },
        credentials: 'same-origin',
    };

    try {
        const response = await fetch(url, { ...defaultOptions, ...options });
        const text = await response.text();
        let data = null;
        try {
            data = text ? JSON.parse(text) : null;
        } catch (_) {
            throw new Error(text.replace(/<[^>]*>/g, ' ').trim() || `Resposta invalida (${response.status})`);
        }

        if (!response.ok || !data?.success) {
            throw new Error(data?.error || `Erro ${response.status}`);
        }

        return { data: data.data, error: null };
    } catch (error) {
        console.warn('Compat API:', error.message || error);
        return { data: null, error: error.message || String(error) };
    }
}

function emptyQueryResult(table, single = false) {
    return { data: single || table === 'SAAS_Config_Emails' ? null : [], error: null };
}

function createQueryBuilder(table) {
    const state = { filters: {}, limitValue: null, singleValue: false };

    const run = async () => {
        const endpoint = TABLE_ENDPOINTS[table];
        if (endpoint === null) return emptyQueryResult(table, state.singleValue);

        const resolvedEndpoint = endpoint || `/${String(table).toLowerCase()}`;
        const query = new URLSearchParams();
        Object.entries(state.filters).forEach(([key, value]) => query.set(key, value));
        const suffix = query.toString() ? `?${query.toString()}` : '';
        const { data, error } = await apiRequest(`${resolvedEndpoint}${suffix}`);
        if (error) return { data: state.singleValue ? null : [], error };

        let rows = Array.isArray(data) ? data : (data ? [data] : []);
        if (state.limitValue !== null) rows = rows.slice(0, state.limitValue);
        return { data: state.singleValue ? (rows[0] || null) : rows, error: null };
    };

    const builder = {
        eq(column, value) {
            state.filters[column] = value;
            return builder;
        },
        order() {
            return builder;
        },
        limit(value) {
            state.limitValue = Number(value) || null;
            return builder;
        },
        single() {
            state.singleValue = true;
            return run();
        },
        then(resolve, reject) {
            return run().then(resolve, reject);
        }
    };

    return builder;
}

window.supabase = {
    auth: {
        signInWithPassword: async ({ email, password }) => {
            const { data, error } = await apiRequest('/login', {
                method: 'POST',
                body: JSON.stringify({ email, password })
            });

            if (error) return { data: null, error: { message: error } };

            return {
                data: {
                    session: { access_token: 'php-session' },
                    user: data?.usuario || null
                },
                error: null
            };
        },

        signOut: async () => {
            window.location.href = appUrl('/logout');
            return { error: null };
        },

        getSession: async () => ({
            data: { session: { access_token: 'php-session' } },
            error: null
        }),

        getUser: async () => {
            const { data, error } = await apiRequest('/dashboard/resumo');
            if (error) return { data: null, error: { message: error } };
            return { data: { user: data?.usuario || null }, error: null };
        },

        resetPasswordForEmail: async () => ({ data: null, error: null })
    },

    from: (table) => ({
        select: () => createQueryBuilder(table),
        insert: (values) => ({
            select: () => ({
                single: async () => {
                    const endpoint = TABLE_ENDPOINTS[table];
                    if (!endpoint) return emptyQueryResult(table, true);
                    return apiRequest(endpoint, { method: 'POST', body: JSON.stringify(values) });
                }
            })
        }),
        update: (values) => ({
            eq: () => ({
                select: () => ({
                    single: async () => emptyQueryResult(table, true)
                }),
                then: async (resolve) => resolve(emptyQueryResult(table))
            })
        }),
        upsert: async () => emptyQueryResult(table),
        delete: () => ({
            eq: () => ({
                then: async (resolve) => resolve(emptyQueryResult(table))
            })
        })
    })
};

function initSupabase() {
    console.log('API PHP inicializada (Supabase compat)');
    return window.supabase;
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type} show`;
    toast.innerHTML = `<span>${message}</span>`;

    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    container.appendChild(toast);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

console.log('GLChat API Helper carregado - Supabase substituido por PHP/MySQL');
