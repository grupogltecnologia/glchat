/**
 * Painel de Administração - JavaScript
 * Sistema SaaS Multi-tenant
 */

function appUrl(path) {
    if (typeof window.glchatUrl === 'function') return window.glchatUrl(path);
    if (typeof window.hublabelUrl === 'function') return window.hublabelUrl(path);
    return path;
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Admin panel loaded');
    
    // Configurar menu lateral
    configurarMenuLateral();
    
    // Configurar abas
    configurarAbas();
    
    // Carregar aba inicial (Dashboard)
    carregarAbaDashboard();
});

// ==================== MENU LATERAL ====================
function configurarMenuLateral() {
    const rotas = {
        'dashboard': appUrl('/dashboard'),
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
    
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        const menuId = item.getAttribute('data-menu-id');
        if (menuId && rotas[menuId]) {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = rotas[menuId];
            });
        }
    });
    
    const logoutItem = document.querySelector('.logout-item');
    if (logoutItem) {
        logoutItem.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Deseja realmente sair?')) {
                window.location.href = appUrl('/logout');
            }
        });
    }
    
    console.log('✅ Menu lateral configurado');
}

// ==================== ABAS ====================
function configurarAbas() {
    const tabs = {
        'dashboard-tab': 'dashboard',
        'clientes-tab': 'clientes',
        'planos-tab': 'planos',
        'integracao-pagamento-tab': 'integracao-pagamento',
        'emails-tab': 'emails',
        'personalizacao-tab': 'personalizacao',
        'pv-tab': 'pagina-vendas'
    };
    
    Object.keys(tabs).forEach(tabId => {
        const tab = document.getElementById(tabId);
        if (!tab) return;
        
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            const contentId = tabs[tabId];
            
            // Remover active de todas as abas
            Object.keys(tabs).forEach(id => {
                const t = document.getElementById(id);
                if (t) t.classList.remove('active');
            });
            
            // Adicionar active na aba clicada
            this.classList.add('active');
            
            // Esconder todos os conteúdos
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
                content.style.display = 'none';
            });
            
            // Mostrar conteúdo da aba
            const content = document.getElementById(`${contentId}-content`);
            if (content) {
                content.classList.add('active');
                content.style.display = 'block';
            }
            
            // Carregar dados da aba
            carregarDadosAba(contentId);
        });
    });
    
    console.log('✅ Abas configuradas');
}

function carregarDadosAba(tabName) {
    console.log('📂 Carregando aba:', tabName);
    
    switch(tabName) {
        case 'dashboard':
            carregarAbaDashboard();
            break;
        case 'clientes':
            carregarAbaClientes();
            break;
        case 'planos':
            carregarAbaPlanos();
            break;
        case 'integracao-pagamento':
            carregarAbaWebhooks();
            break;
        case 'emails':
            carregarAbaEmails();
            break;
        case 'personalizacao':
            carregarAbaPersonalizacao();
            break;
        case 'pagina-vendas':
            carregarAbaPaginaVendas();
            break;
    }
}

// ==================== ABA DASHBOARD ====================
async function carregarAbaDashboard() {
    console.log('📊 Carregando dashboard admin...');
    try {
        const response = await fetch('/hublabel/public/api/admin/dashboard');
        const result = await response.json();
        
        console.log('📊 Resposta da API:', result);
        
        if (result.success) {
            const data = result.data;
            
            // Atualizar cards com IDs corretos do HTML
            const totalClientesEl = document.getElementById('total-clientes');
            if (totalClientesEl) {
                totalClientesEl.textContent = data.totalClientes || 0;
            }
            
            const clientesAtivosEl = document.getElementById('clientes-ativos');
            if (clientesAtivosEl) {
                clientesAtivosEl.textContent = data.clientesAtivos || 0;
            }
            
            const faturamentoEl = document.getElementById('faturamento-amount');
            if (faturamentoEl) {
                faturamentoEl.textContent = data.faturamentoMes || '0,00';
            }
            
            const ticketMedioEl = document.getElementById('media-cliente-amount');
            if (ticketMedioEl) {
                ticketMedioEl.textContent = data.ticketMedio || '0,00';
            }
            
            // Atualizar barra de clientes ativos
            if (data.totalClientes > 0) {
                const percentAtivos = (data.clientesAtivos / data.totalClientes) * 100;
                const barActive = document.getElementById('stat-clients-bar-active');
                const barRest = document.getElementById('stat-clients-bar-rest');
                if (barActive) barActive.style.width = percentAtivos + '%';
                if (barRest) barRest.style.width = (100 - percentAtivos) + '%';
            }
            
            console.log('✅ Dashboard atualizado:', data);
        } else {
            console.error('❌ Erro na API:', result.error);
        }
    } catch (error) {
        console.error('❌ Erro ao carregar dashboard:', error);
    }
}

// ==================== ABA CLIENTES ====================
let clientesData = [];
let clientesFiltrados = [];

async function carregarAbaClientes() {
    console.log('👥 Carregando clientes...');
    try {
        const response = await fetch('/hublabel/public/api/admin/clientes');
        const result = await response.json();
        
        if (result.success) {
            clientesData = result.data;
            clientesFiltrados = clientesData;
            renderizarTabelaClientes(clientesFiltrados);
            configurarEventosClientes();
            carregarPlanosNoFiltro();
        }
    } catch (error) {
        console.error('Erro ao carregar clientes:', error);
    }
}

function configurarEventosClientes() {
    // Botão criar cliente
    const btnCriar = document.getElementById('criar-cliente-btn');
    if (btnCriar) {
        btnCriar.onclick = () => abrirModalCriarCliente();
    }
    
    // Busca
    const searchInput = document.getElementById('search-clientes');
    if (searchInput) {
        searchInput.oninput = (e) => filtrarClientes();
    }
    
    // Filtros
    const filterStatus = document.getElementById('filter-status');
    if (filterStatus) {
        filterStatus.onchange = () => filtrarClientes();
    }
    
    const filterPlano = document.getElementById('filter-plano');
    if (filterPlano) {
        filterPlano.onchange = () => filtrarClientes();
    }
}

function filtrarClientes() {
    const search = document.getElementById('search-clientes')?.value.toLowerCase() || '';
    const status = document.getElementById('filter-status')?.value || '';
    const plano = document.getElementById('filter-plano')?.value || '';
    
    clientesFiltrados = clientesData.filter(cliente => {
        const matchSearch = !search || 
            cliente.nome.toLowerCase().includes(search) ||
            (cliente.email && cliente.email.toLowerCase().includes(search));
        
        const matchStatus = !status || cliente.status === status;
        const matchPlano = !plano || cliente.plano === plano;
        
        return matchSearch && matchStatus && matchPlano;
    });
    
    renderizarTabelaClientes(clientesFiltrados);
}

async function carregarPlanosNoFiltro() {
    try {
        const response = await fetch('/hublabel/public/api/admin/planos');
        const result = await response.json();
        
        if (result.success) {
            const select = document.getElementById('filter-plano');
            if (select) {
                result.data.forEach(plano => {
                    const option = document.createElement('option');
                    option.value = plano.id;
                    option.textContent = plano.nome;
                    select.appendChild(option);
                });
            }
        }
    } catch (error) {
        console.error('Erro ao carregar planos:', error);
    }
}

function renderizarTabelaClientes(clientes) {
    const tbody = document.getElementById('clientes-table-body');
    if (!tbody) return;
    
    if (clientes.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:2rem;">Nenhum cliente encontrado</td></tr>';
        return;
    }
    
    tbody.innerHTML = clientes.map(cliente => `
        <tr>
            <td class="clientes-th-check">
                <input type="checkbox" class="clientes-checkbox" data-id="${cliente.id}">
            </td>
            <td>
                <div class="clientes-cell-user">
                    <div class="clientes-user-avatar">${cliente.nome.charAt(0).toUpperCase()}</div>
                    <div>
                        <div class="clientes-user-name">${cliente.nome}</div>
                        <div class="clientes-user-email">${cliente.email || 'Sem email'}</div>
                    </div>
                </div>
            </td>
            <td>
                <span class="clientes-plan-badge clientes-plan-badge--${cliente.plano || 'free'}">
                    ${cliente.plano_nome || cliente.plano || 'Free'}
                </span>
            </td>
            <td>
                <span class="clientes-status-label clientes-status-label--${cliente.status === 'ativo' ? 'active' : 'blocked'}">
                    ${cliente.status === 'ativo' ? 'Ativo' : 'Bloqueado'}
                </span>
            </td>
            <td>
                <div class="clientes-period-line">
                    <i class="fa-solid fa-calendar"></i>
                    ${formatarData(cliente.created_at)}
                </div>
                ${cliente.data_fim ? `
                <div class="clientes-period-line clientes-period-line--muted">
                    Expira: ${formatarData(cliente.data_fim)}
                </div>
                ` : ''}
            </td>
            <td class="clientes-th-actions">
                <div class="clientes-actions-menu">
                    <button class="actions-trigger" onclick="abrirMenuCliente('${cliente.id}', '${cliente.nome}', '${cliente.status}')">
                        <i class="fa-solid fa-ellipsis-v"></i>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
    
    // Atualizar info de paginação
    const pageInfo = document.getElementById('clientes-page-info');
    if (pageInfo) {
        pageInfo.textContent = `Mostrando ${clientes.length} cliente(s)`;
    }
}

function formatarData(dataStr) {
    if (!dataStr) return '-';
    const data = new Date(dataStr);
    return data.toLocaleDateString('pt-BR');
}

function abrirMenuCliente(clienteId, clienteNome, status) {
    // Fechar qualquer menu aberto
    fecharMenusAbertos();
    
    // Criar menu dropdown
    const menu = document.createElement('div');
    menu.className = 'dropdown-menu-acoes';
    menu.id = 'menu-acoes-' + clienteId;
    
    menu.innerHTML = `
        <div class="dropdown-menu-header">AÇÕES</div>
        <button class="dropdown-menu-item" data-action="editar">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Editar Cliente</span>
        </button>
        <button class="dropdown-menu-item" data-action="mudar-plano">
            <i class="fa-solid fa-layer-group"></i>
            <span>Mudar Plano</span>
        </button>
        <button class="dropdown-menu-item dropdown-menu-item--danger" data-action="excluir">
            <i class="fa-solid fa-trash"></i>
            <span>Excluir Cliente</span>
        </button>
        <button class="dropdown-menu-item" data-action="resetar-creditos">
            <i class="fa-solid fa-rotate"></i>
            <span>Resetar Créditos</span>
        </button>
        <button class="dropdown-menu-item" data-action="redefinir-senha">
            <i class="fa-solid fa-key"></i>
            <span>Redefinir Senha</span>
        </button>
        <button class="dropdown-menu-item" data-action="ver-usuarios">
            <i class="fa-solid fa-users"></i>
            <span>Ver usuários</span>
        </button>
        <button class="dropdown-menu-item dropdown-menu-item--danger" data-action="bloquear">
            <i class="fa-solid fa-ban"></i>
            <span>${status === 'ativo' ? 'Bloquear conta' : 'Desbloquear conta'}</span>
        </button>
    `;
    
    // Adicionar ao body
    document.body.appendChild(menu);
    
    // Posicionar próximo ao botão
    const button = event.target.closest('.actions-trigger');
    const rect = button.getBoundingClientRect();
    menu.style.position = 'fixed';
    menu.style.top = (rect.bottom + 5) + 'px';
    menu.style.left = (rect.left - 200) + 'px';
    menu.style.zIndex = '9999';
    
    // Adicionar eventos
    menu.querySelectorAll('.dropdown-menu-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.stopPropagation();
            const action = item.getAttribute('data-action');
            
            switch(action) {
                case 'editar':
                    editarCliente(clienteId);
                    break;
                case 'mudar-plano':
                    mudarPlanoCliente(clienteId);
                    break;
                case 'excluir':
                    excluirCliente(clienteId);
                    break;
                case 'resetar-creditos':
                    resetarCreditos(clienteId);
                    break;
                case 'redefinir-senha':
                    redefinirSenhaCliente(clienteId);
                    break;
                case 'ver-usuarios':
                    verUsuariosCliente(clienteId);
                    break;
                case 'bloquear':
                    toggleStatusCliente(clienteId, status);
                    break;
            }
            
            fecharMenusAbertos();
        });
    });
    
    // Fechar ao clicar fora
    setTimeout(() => {
        document.addEventListener('click', fecharMenusAbertos, { once: true });
    }, 100);
}

function fecharMenusAbertos() {
    document.querySelectorAll('.dropdown-menu-acoes').forEach(menu => menu.remove());
}

// Funções movidas para o final do arquivo com modais

async function abrirModalCriarCliente() {
    console.log('🔄 Carregando planos...');
    
    // Carregar planos - igual ao editar
    const planosDefault = [
        { id: 1, nome: 'Free' },
        { id: 2, nome: 'Básico' },
        { id: 3, nome: 'Pro' },
        { id: 4, nome: 'Enterprise' }
    ];
    
    let planos = planosDefault;
    
    try {
        const response = await fetch('/hublabel/public/api/admin/planos');
        const result = await response.json();
        
        if (result.success && result.data && result.data.length > 0) {
            planos = result.data;
            console.log('✅ Planos carregados da API');
        }
    } catch (error) {
        console.warn('⚠️ Usando planos padrão');
    }
    
    // Gerar HTML dos planos
    let planosOptions = '';
    planos.forEach(plano => {
        planosOptions += `<option value="${plano.id}">${plano.nome}</option>`;
    });
    
    console.log('📋 Planos HTML gerado:', planosOptions.substring(0, 100));
    
    // Criar HTML do select de planos separadamente
    const selectPlanosHtml = `<select class="form-select" id="novo-plano">
        <option value="">Selecione um plano</option>
        ${planosOptions}
    </select>`;
    
    console.log('📋 Select HTML completo:', selectPlanosHtml.substring(0, 150));
    
    const modalContent = `
            <div class="form-group">
                <label class="form-label form-label-required">Nome completo</label>
                <div class="form-input-icon">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="form-input" id="novo-nome" placeholder="Ex: João Silva">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label form-label-required">E-mail de login</label>
                    <div class="form-input-icon">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" class="form-input" id="novo-email" placeholder="joao@email.com">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label form-label-required">Senha</label>
                    <div class="form-input-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" class="form-input" id="novo-senha" placeholder="••••••••">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Telefone</label>
                <div class="form-input-icon">
                    <i class="fa-solid fa-phone"></i>
                    <input type="tel" class="form-input" id="novo-telefone" placeholder="5511912345678">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label form-label-required">Plano de assinatura</label>
                    ` + selectPlanosHtml + `
                </div>
                
                <div class="form-group">
                    <label class="form-label form-label-required">Data de expiração</label>
                    <input type="date" class="form-input" id="novo-data-expiracao" placeholder="dd/mm/aaaa">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Status da conta</label>
                <div class="status-select">
                    <select class="form-select" id="novo-status">
                        <option value="ativo" selected>● Ativo</option>
                        <option value="bloqueado">● Bloqueado</option>
                    </select>
                </div>
            </div>
        `;
    
    criarModal({
        title: 'Novo Cliente',
        subtitle: 'ADICIONAR ACESSO À PLATAFORMA',
        content: modalContent,
        buttons: [
            { text: 'Cancelar', class: 'btn-secondary', action: 'close' },
            { 
                text: '✓ Guardar Cliente', 
                class: 'btn-primary', 
                action: async () => {
                    const selectPlano = document.getElementById('novo-plano');
                    console.log('🔍 Select no momento do clique:', selectPlano);
                    console.log('🔍 Opções disponíveis:', selectPlano?.options.length);
                    console.log('🔍 selectedIndex:', selectPlano?.selectedIndex);
                    console.log('🔍 Opção selecionada:', selectPlano?.options[selectPlano?.selectedIndex]);
                    console.log('🔍 Valor do select.value:', selectPlano?.value);
                    
                    const nome = document.getElementById('novo-nome').value;
                    const email = document.getElementById('novo-email').value;
                    const senha = document.getElementById('novo-senha').value;
                    const telefone = document.getElementById('novo-telefone').value;
                    
                    // Pegar valor do plano de forma mais robusta
                    let plano = '';
                    if (selectPlano) {
                        plano = selectPlano.value;
                        if (!plano && selectPlano.selectedIndex >= 0) {
                            plano = selectPlano.options[selectPlano.selectedIndex].value;
                        }
                    }
                    
                    const dataExpiracao = document.getElementById('novo-data-expiracao').value;
                    const status = document.getElementById('novo-status').value;
                    
                    console.log('📋 Valores capturados:', { nome, email, senha, telefone, plano, dataExpiracao, status });
                    console.log('🔍 Plano final:', plano, '(tipo:', typeof plano, ')');
                    
                    if (!nome || !nome.trim()) {
                        showToast('Nome é obrigatório', 'error');
                        return false;
                    }
                    if (!email || !email.trim()) {
                        showToast('Email é obrigatório', 'error');
                        return false;
                    }
                    if (!senha || !senha.trim()) {
                        showToast('Senha é obrigatória', 'error');
                        return false;
                    }
                    // TEMPORÁRIO: Validação do plano removida para teste
                    console.log('ℹ️ Plano selecionado:', plano || 'NENHUM');
                    if (!dataExpiracao || !dataExpiracao.trim()) {
                        showToast('Data de expiração é obrigatória', 'error');
                        return false;
                    }
                    
                    await criarCliente({ 
                        nome, 
                        email, 
                        senha, 
                        telefone, 
                        plano, 
                        data_fim: dataExpiracao, 
                        status 
                    });
                    return true; // Permite fechar o modal
                }
            }
        ]
    });
    
    // Verificar IMEDIATAMENTE se o select tem as opções
    setTimeout(() => {
        const select = document.getElementById('novo-plano');
        console.log('🔍 VERIFICAÇÃO APÓS CRIAR MODAL:');
        console.log('  Select existe?', !!select);
        console.log('  Opções no select:', select?.options.length);
        console.log('  innerHTML:', select?.innerHTML.substring(0, 200));
        
        // Se não tiver as opções, forçar adicionar
        if (select && select.options.length < 5) {
            console.warn('⚠️ Select sem opções! Forçando adição...');
            select.innerHTML = selectPlanosHtml.replace('<select class="form-select" id="novo-plano">', '').replace('</select>', '');
            console.log('✅ Opções adicionadas! Total:', select.options.length);
            
            // Forçar o select a reconhecer as opções
            select.selectedIndex = 0; // Selecionar primeira opção (vazia)
            
            // Adicionar evento para debug
            select.addEventListener('change', function() {
                console.log('🔄 Plano alterado para:', this.value);
            });
        }
    }, 100);
}

async function criarCliente(dados) {
    try {
        console.log('📤 Enviando dados para criar cliente:', dados);
        
        const response = await fetch('/hublabel/public/api/admin/clientes/criar', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        });
        
        const result = await response.json();
        console.log('📥 Resposta da API:', result);
        
        if (result.success) {
            showToast('Cliente criado com sucesso!', 'success');
            carregarAbaClientes();
        } else {
            showToast(result.error || 'Erro ao criar cliente', 'error');
        }
    } catch (error) {
        console.error('❌ Erro ao criar cliente:', error);
        showToast('Erro ao criar cliente', 'error');
    }
}

async function editarCliente(clienteId) {
    console.log('🔍 Editando cliente ID:', clienteId, 'Tipo:', typeof clienteId);
    console.log('📋 Clientes disponíveis:', clientesData.map(c => ({ id: c.id, tipo: typeof c.id })));
    
    // Converter para número para garantir comparação correta
    const cliente = clientesData.find(c => c.id == clienteId);
    
    if (!cliente) {
        console.error('❌ Cliente não encontrado!', clienteId);
        showToast('Cliente não encontrado', 'error');
        return;
    }
    
    console.log('✅ Cliente encontrado:', cliente);
    
    // Carregar planos primeiro
    let planosHtml = '<option value="">Selecione um plano</option>';
    const planosDefault = [
        { id: 1, nome: 'Free' },
        { id: 2, nome: 'Básico' },
        { id: 3, nome: 'Pro' },
        { id: 4, nome: 'Enterprise' }
    ];
    
    try {
        const response = await fetch('/hublabel/public/api/admin/planos');
        const result = await response.json();
        
        let planos = planosDefault;
        if (result.success && result.data && result.data.length > 0) {
            planos = result.data;
        }
        
        planosHtml = '<option value="">Selecione um plano</option>';
        planos.forEach(plano => {
            const selected = cliente.plano == plano.id ? 'selected' : '';
            planosHtml += `<option value="${plano.id}" ${selected}>${plano.nome}</option>`;
        });
    } catch (error) {
        console.error('Erro ao carregar planos:', error);
        // Usar planos padrão
        planosHtml = '<option value="">Selecione um plano</option>';
        planosDefault.forEach(plano => {
            const selected = cliente.plano == plano.id ? 'selected' : '';
            planosHtml += `<option value="${plano.id}" ${selected}>${plano.nome}</option>`;
        });
    }
    
    const modal = criarModal({
        title: 'Editar cliente',
        subtitle: 'ATUALIZAR DADOS DA CONTA (E-MAIL E SENHA FIXOS)',
        content: `
            <div class="form-group">
                <label class="form-label form-label-required">Nome completo</label>
                <div class="form-input-icon">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="form-input" id="edit-nome" value="${cliente.nome}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">E-mail de login</label>
                    <div class="form-input-icon">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" class="form-input" value="${cliente.email || ''}" disabled>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Senha</label>
                    <div class="form-hint">
                        <i class="fa-solid fa-lock"></i>
                        Não é possível alterar a senha aqui. Use redefinição por e-mail se necessário.
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Telefone</label>
                <div class="form-input-icon">
                    <i class="fa-solid fa-phone"></i>
                    <input type="tel" class="form-input" id="edit-telefone" value="${cliente.telefone || ''}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Plano de assinatura</label>
                    <select class="form-select" id="edit-plano">
                        ${planosHtml}
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Data de expiração</label>
                    <input type="date" class="form-input" id="edit-data-expiracao" value="${cliente.dataValidade || cliente.data_fim || ''}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Status da conta</label>
                <select class="form-select" id="edit-status">
                    <option value="1" ${(cliente.status == 1 || cliente.status === 'ativo') ? 'selected' : ''}>Ativo</option>
                    <option value="0" ${(cliente.status == 0 || cliente.status === 'bloqueado') ? 'selected' : ''}>Bloqueado</option>
                </select>
            </div>
        `,
        buttons: [
            { text: 'Cancelar', class: 'btn-secondary', action: 'close' },
            { 
                text: '✓ Guardar alterações', 
                class: 'btn-primary', 
                action: async () => {
                    const nome = document.getElementById('edit-nome').value;
                    const telefone = document.getElementById('edit-telefone').value;
                    const plano = document.getElementById('edit-plano').value;
                    const dataExpiracao = document.getElementById('edit-data-expiracao').value;
                    const status = document.getElementById('edit-status').value;
                    
                    await atualizarCliente(clienteId, { nome, telefone, plano, data_fim: dataExpiracao, status });
                    return true; // Permite fechar o modal
                }
            }
        ]
    });
}

// Função movida para o final do arquivo com modal

async function atualizarCliente(clienteId, dados) {
    try {
        const payload = { id: clienteId, ...dados };
        console.log('📤 Enviando para atualizar:', payload);
        
        const response = await fetch('/hublabel/public/api/admin/clientes/atualizar', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showToast('Cliente atualizado com sucesso!', 'success');
            carregarAbaClientes();
        } else {
            showToast(result.error || 'Erro ao atualizar cliente', 'error');
        }
    } catch (error) {
        console.error('Erro ao atualizar cliente:', error);
        showToast('Erro ao atualizar cliente', 'error');
    }
}

async function deletarCliente(clienteId, clienteNome) {
    if (!confirm(`Tem certeza que deseja deletar o cliente "${clienteNome}"?\n\nEsta ação não pode ser desfeita!`)) {
        return;
    }
    
    // TODO: Implementar endpoint de deletar
    showToast('Funcionalidade de deletar em desenvolvimento', 'info');
}

// ==================== ABA PLANOS ====================
let planosData = [];

async function carregarAbaPlanos() {
    try {
        const response = await fetch('/hublabel/public/api/admin/planos');
        const result = await response.json();
        
        if (result.success) {
            planosData = result.data;
            renderizarTabelaPlanos(result.data);
        }
    } catch (error) {
        console.error('Erro ao carregar planos:', error);
    }
}

function renderizarTabelaPlanos(planos) {
    const tbody = document.getElementById('planos-table-body');
    if (!tbody) return;
    
    if (planos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align: center; padding: 3rem; color: #94a3b8;">Nenhum plano cadastrado</td></tr>';
        return;
    }
    
    tbody.innerHTML = planos.map(plano => `
        <tr>
            <td>
                <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                    <strong style="font-size: 1rem; color: #1e293b;">${plano.nome}</strong>
                    <span style="font-size: 0.875rem; color: #64748b;">R$ ${parseFloat(plano.preco || 0).toFixed(2)}/${plano.periodo || 'mensal'}</span>
                    ${plano.plano_cadastro ? '<span style="font-size: 0.75rem; color: #6C63FF; font-weight: 600;">✓ Plano de Cadastro</span>' : ''}
                </div>
            </td>
            <td>
                <div style="display: flex; flex-direction: column; gap: 0.25rem; font-size: 0.875rem;">
                    <span>👥 ${plano.max_usuarios || '∞'} usuários</span>
                    <span>📱 ${plano.max_conexoes || '∞'} conexões</span>
                    <span>👤 ${plano.max_contatos || '∞'} contatos</span>
                </div>
            </td>
            <td>
                <div style="display: flex; flex-direction: column; gap: 0.25rem; font-size: 0.875rem;">
                    <span>📤 ${plano.max_disparos_mes || '∞'} disparos/mês</span>
                    <span style="color: ${plano.ativo ? '#10b981' : '#94a3b8'};">
                        ${plano.ativo ? '✓ Ativo' : '✗ Inativo'}
                    </span>
                </div>
            </td>
            <td class="text-center">
                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                    <button class="btn-icon btn-icon-primary" onclick="editarPlano(${plano.id})" title="Editar plano">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button class="btn-icon btn-icon-danger" onclick="excluirPlano(${plano.id}, '${plano.nome.replace(/'/g, "\\'")}' )" title="Excluir plano">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    ${!plano.plano_cadastro ? `
                        <button class="btn-icon" style="background: #6C63FF; color: white;" onclick="definirPlanoCadastro(${plano.id})" title="Definir como plano de cadastro">
                            <i class="fa-solid fa-star"></i>
                        </button>
                    ` : ''}
                </div>
            </td>
        </tr>
    `).join('');
}

async function editarPlano(planoId) {
    const plano = planosData.find(p => p.id == planoId);
    if (!plano) {
        showToast('Plano não encontrado', 'error');
        return;
    }
    
    const modal = criarModal({
        title: 'Editar Plano',
        subtitle: 'Atualizar informações do plano',
        content: `
            <div class="form-group">
                <label class="form-label form-label-required">Nome do Plano</label>
                <input type="text" class="form-input" id="edit-plano-nome" value="${plano.nome}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Descrição</label>
                <textarea class="form-input" id="edit-plano-descricao" rows="3">${plano.descricao || ''}</textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label form-label-required">Preço (R$)</label>
                    <input type="number" step="0.01" class="form-input" id="edit-plano-preco" value="${plano.preco}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Período</label>
                    <select class="form-select" id="edit-plano-periodo">
                        <option value="mensal" ${plano.periodo === 'mensal' ? 'selected' : ''}>Mensal</option>
                        <option value="anual" ${plano.periodo === 'anual' ? 'selected' : ''}>Anual</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Máx. Usuários</label>
                    <input type="number" class="form-input" id="edit-plano-max-usuarios" value="${plano.max_usuarios || ''}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Máx. Conexões</label>
                    <input type="number" class="form-input" id="edit-plano-max-conexoes" value="${plano.max_conexoes || ''}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Máx. Contatos</label>
                    <input type="number" class="form-input" id="edit-plano-max-contatos" value="${plano.max_contatos || ''}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Máx. Disparos/Mês</label>
                    <input type="number" class="form-input" id="edit-plano-max-disparos" value="${plano.max_disparos_mes || ''}">
                </div>
            </div>
        `,
        buttons: [
            { text: 'Cancelar', class: 'btn-secondary', action: 'close' },
            {
                text: '✓ Salvar Alterações',
                class: 'btn-primary',
                action: async () => {
                    const nome = document.getElementById('edit-plano-nome').value;
                    const descricao = document.getElementById('edit-plano-descricao').value;
                    const preco = document.getElementById('edit-plano-preco').value;
                    const periodo = document.getElementById('edit-plano-periodo').value;
                    const max_usuarios = document.getElementById('edit-plano-max-usuarios').value;
                    const max_conexoes = document.getElementById('edit-plano-max-conexoes').value;
                    const max_contatos = document.getElementById('edit-plano-max-contatos').value;
                    const max_disparos_mes = document.getElementById('edit-plano-max-disparos').value;
                    
                    if (!nome || !preco) {
                        showToast('Nome e preço são obrigatórios', 'error');
                        return;
                    }
                    
                    try {
                        const response = await fetch('/hublabel/public/api/admin/planos/atualizar', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                id: planoId,
                                nome,
                                descricao,
                                preco,
                                periodo,
                                max_usuarios,
                                max_conexoes,
                                max_contatos,
                                max_disparos_mes
                            })
                        });
                        
                        const result = await response.json();
                        
                        if (result.success) {
                            showToast('Plano atualizado com sucesso!', 'success');
                            carregarAbaPlanos();
                            return 'close';
                        } else {
                            showToast(result.error || 'Erro ao atualizar plano', 'error');
                        }
                    } catch (error) {
                        console.error('Erro:', error);
                        showToast('Erro ao atualizar plano', 'error');
                    }
                }
            }
        ]
    });
}

async function excluirPlano(planoId, planoNome) {
    const modal = criarModal({
        title: '⚠️ Confirmar Exclusão',
        subtitle: 'Esta ação não pode ser desfeita',
        content: `
            <div class="confirmation-message">
                Tem certeza que deseja excluir o plano <strong>"${planoNome}"</strong>?
            </div>
            <div class="confirmation-warning">
                ⚠️ O plano só pode ser excluído se não houver clientes vinculados a ele.
            </div>
        `,
        buttons: [
            { text: 'Cancelar', class: 'btn-secondary', action: 'close' },
            {
                text: '🗑️ Sim, excluir plano',
                class: 'btn-danger',
                action: async () => {
                    try {
                        const response = await fetch('/hublabel/public/api/admin/planos/excluir', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ id: planoId })
                        });
                        
                        const result = await response.json();
                        
                        if (result.success) {
                            showToast('Plano excluído com sucesso!', 'success');
                            carregarAbaPlanos();
                            return 'close';
                        } else {
                            showToast(result.error || 'Erro ao excluir plano', 'error');
                        }
                    } catch (error) {
                        console.error('Erro:', error);
                        showToast('Erro ao excluir plano', 'error');
                    }
                }
            }
        ],
        size: 'small'
    });
}

async function definirPlanoCadastro(planoId) {
    try {
        const response = await fetch('/hublabel/public/api/admin/planos/cadastro', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ planoId, ativo: true })
        });
        
        const result = await response.json();
        
        if (result.success) {
            showToast('Plano de cadastro definido com sucesso!', 'success');
            carregarAbaPlanos();
        } else {
            showToast(result.error || 'Erro ao definir plano de cadastro', 'error');
        }
    } catch (error) {
        console.error('Erro:', error);
        showToast('Erro ao definir plano de cadastro', 'error');
    }
}

async function alterarPlanoCadastro(planoId, ativo) {
    try {
        const response = await fetch('/hublabel/public/api/admin/planos/cadastro', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ planoId, ativo })
        });
        
        const result = await response.json();
        
        if (result.success) {
            showToast('Plano de cadastro atualizado!', 'success');
            carregarAbaPlanos(); // Recarregar para atualizar checkboxes
        } else {
            showToast(result.error || 'Erro ao atualizar', 'error');
            carregarAbaPlanos();
        }
    } catch (error) {
        console.error('Erro:', error);
        showToast('Erro ao atualizar plano de cadastro', 'error');
        carregarAbaPlanos();
    }
}

// ==================== ABA WEBHOOKS ====================
async function carregarAbaWebhooks() {
    try {
        const response = await fetch('/hublabel/public/api/admin/webhooks');
        const result = await response.json();
        
        if (result.success) {
            renderizarWebhooks(result.data);
        }
    } catch (error) {
        console.error('Erro ao carregar webhooks:', error);
    }
}

function renderizarWebhooks(webhooks) {
    const container = document.querySelector('#integracao-pagamento-content .webhooks-list');
    if (!container) return;
    
    if (webhooks.length === 0) {
        container.innerHTML = '<p class="text-center text-muted">Nenhuma integração cadastrada</p>';
        return;
    }
    
    container.innerHTML = webhooks.map(webhook => `
        <div class="webhook-item">
            <div class="webhook-info">
                <h4>${webhook.nome}</h4>
                <p class="text-muted">${webhook.url}</p>
            </div>
            <div class="webhook-status">
                <span class="badge ${webhook.ativo ? 'badge-success' : 'badge-secondary'}">
                    ${webhook.ativo ? 'Ativo' : 'Inativo'}
                </span>
            </div>
        </div>
    `).join('');
}

// ==================== ABA E-MAILS ====================
function carregarAbaEmails() {
    console.log('📧 Aba E-mails');
}

// ==================== ABA PERSONALIZAÇÃO ====================
async function carregarAbaPersonalizacao() {
    try {
        const response = await fetch('/hublabel/public/api/admin/configuracoes');
        const result = await response.json();
        
        if (result.success) {
            preencherFormPersonalizacao(result.data);
        }
    } catch (error) {
        console.error('Erro ao carregar configurações:', error);
    }
}

function preencherFormPersonalizacao(config) {
    const form = document.querySelector('#personalizacao-content form');
    if (!form) return;
    
    if (config.nome_sistema) {
        const input = form.querySelector('[name="nome_sistema"]');
        if (input) input.value = config.nome_sistema;
    }
    
    if (config.cor_primaria) {
        const input = form.querySelector('[name="cor_primaria"]');
        if (input) input.value = config.cor_primaria;
    }
}

// ==================== ABA PÁGINA DE VENDAS ====================
function carregarAbaPaginaVendas() {
    console.log('🛒 Aba Página de Vendas');
}

// ==================== SISTEMA DE MODAIS ====================
function criarModal({ title, subtitle, content, buttons, size = 'medium' }) {
    // Criar overlay
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    
    // Criar container
    const container = document.createElement('div');
    container.className = 'modal-container';
    if (size === 'small') container.style.maxWidth = '400px';
    if (size === 'large') container.style.maxWidth = '800px';
    
    // Header
    const header = document.createElement('div');
    header.className = 'modal-header';
    header.innerHTML = `
        <div>
            <h2 class="modal-title">${title}</h2>
            ${subtitle ? `<div class="modal-subtitle">${subtitle}</div>` : ''}
        </div>
        <button class="modal-close" onclick="fecharModal()">×</button>
    `;
    
    // Body
    const body = document.createElement('div');
    body.className = 'modal-body';
    body.innerHTML = content;
    
    // Footer
    const footer = document.createElement('div');
    footer.className = 'modal-footer';
    
    buttons.forEach(btn => {
        const button = document.createElement('button');
        button.className = `btn ${btn.class}`;
        button.textContent = btn.text;
        button.onclick = async () => {
            if (btn.action === 'close') {
                fecharModal();
            } else if (typeof btn.action === 'function') {
                const result = await btn.action();
                // Só fecha o modal se a ação retornar true ou undefined
                if (result !== false) {
                    fecharModal();
                }
            }
        };
        footer.appendChild(button);
    });
    
    // Montar modal
    container.appendChild(header);
    container.appendChild(body);
    container.appendChild(footer);
    overlay.appendChild(container);
    document.body.appendChild(overlay);
    
    // Fechar ao clicar fora
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) fecharModal();
    });
    
    return overlay;
}

function fecharModal() {
    const overlay = document.querySelector('.modal-overlay');
    if (overlay) {
        overlay.style.opacity = '0';
        setTimeout(() => overlay.remove(), 200);
    }
}

// Atualizar outras funções para usar modais
function mudarPlanoCliente(clienteId) {
    criarModal({
        title: 'Mudar plano',
        subtitle: 'ATUALIZAR ASSINATURA DO CLIENTE',
        size: 'small',
        content: `
            <div class="form-group">
                <label class="form-label form-label-required">Novo plano</label>
                <select class="form-select" id="novo-plano">
                    <option value="">Selecione um plano</option>
                </select>
            </div>
        `,
        buttons: [
            { text: 'Cancelar', class: 'btn-secondary', action: 'close' },
            { text: '✓ Aplicar plano', class: 'btn-primary', action: () => {
                showToast('Funcionalidade em desenvolvimento', 'info');
            }}
        ]
    });
    
    // Carregar planos no select
    fetch('/hublabel/public/api/admin/planos')
        .then(r => r.json())
        .then(result => {
            if (result.success) {
                const select = document.getElementById('novo-plano');
                result.data.forEach(plano => {
                    const option = document.createElement('option');
                    option.value = plano.id;
                    option.textContent = plano.nome;
                    select.appendChild(option);
                });
            }
        });
}

function resetarCreditos(clienteId) {
    const cliente = clientesData.find(c => c.id === clienteId);
    criarModal({
        title: 'Confirmar Resetar Créditos',
        size: 'small',
        content: `
            <div class="confirmation-icon confirmation-icon--warning">
                <i class="fa-solid fa-rotate"></i>
            </div>
            <div class="confirmation-text">
                Tem certeza que deseja zerar os tokens do cliente "${cliente?.nome || cliente?.email}"? Esta ação não pode ser desfeita.
            </div>
        `,
        buttons: [
            { text: 'Cancelar', class: 'btn-secondary', action: 'close' },
            { text: 'Confirmar', class: 'btn-warning', action: () => {
                showToast('Funcionalidade em desenvolvimento', 'info');
            }}
        ]
    });
}

function redefinirSenhaCliente(clienteId) {
    showToast('Funcionalidade em desenvolvimento', 'info');
}

function verUsuariosCliente(clienteId) {
    const cliente = clientesData.find(c => c.id === clienteId);
    criarModal({
        title: 'Usuários da conta',
        subtitle: 'MEMBROS COM ACESSO A ESTA CONTA',
        content: `
            <table class="modal-table">
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>E-MAIL</th>
                        <th>FUNÇÃO</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>${cliente?.nome || 'Admin'}</td>
                        <td>${cliente?.email || 'admin@example.com'}</td>
                        <td>admin</td>
                        <td><button class="btn-secondary" style="padding: 6px 12px; font-size: 12px; color: #ef4444;">Desvincular</button></td>
                    </tr>
                </tbody>
            </table>
        `,
        buttons: [
            { text: 'Fechar', class: 'btn-secondary', action: 'close' }
        ]
    });
}

function toggleStatusCliente(clienteId, statusAtual) {
    const novoStatus = statusAtual === 'ativo' ? 'bloqueado' : 'ativo';
    const cliente = clientesData.find(c => c.id === clienteId);
    
    criarModal({
        title: novoStatus === 'bloqueado' ? 'Confirmar Bloqueio' : 'Confirmar Desbloqueio',
        size: 'small',
        content: `
            <div class="confirmation-icon confirmation-icon--danger">
                <i class="fa-solid fa-${novoStatus === 'bloqueado' ? 'ban' : 'check'}"></i>
            </div>
            <div class="confirmation-text">
                Tem certeza que deseja ${novoStatus === 'bloqueado' ? 'bloquear' : 'desbloquear'} o usuário "${cliente?.nome || cliente?.email}"? ${novoStatus === 'bloqueado' ? 'Ele perderá o acesso ao sistema.' : ''}
            </div>
        `,
        buttons: [
            { text: 'Cancelar', class: 'btn-secondary', action: 'close' },
            { text: novoStatus === 'bloqueado' ? 'Bloquear' : 'Desbloquear', class: 'btn-danger', action: () => {
                atualizarCliente(clienteId, { status: novoStatus });
            }}
        ]
    });
}

async function excluirCliente(clienteId) {
    const cliente = clientesData.find(c => c.id === clienteId);
    if (!cliente) return;
    
    criarModal({
        title: 'Excluir Cliente',
        subtitle: 'ATENÇÃO: ESTA AÇÃO NÃO PODE SER DESFEITA',
        content: `
            <div class="confirmation-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="confirmation-text">
                Tem certeza que deseja excluir permanentemente o cliente <strong>"${cliente.nome}"</strong>?
            </div>
            <div class="confirmation-warning">
                ⚠️ Todos os dados, usuários, conversas e configurações deste cliente serão removidos permanentemente!
            </div>
        `,
        buttons: [
            { text: 'Cancelar', class: 'btn-secondary', action: 'close' },
            { 
                text: '🗑️ Excluir Permanentemente', 
                class: 'btn-danger', 
                action: async () => {
                    try {
                        const response = await fetch('/hublabel/public/api/admin/clientes/excluir', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ id: clienteId })
                        });
                        
                        const result = await response.json();
                        
                        if (result.success) {
                            showToast('Cliente excluído com sucesso!', 'success');
                            carregarAbaClientes();
                        } else {
                            showToast(result.error || 'Erro ao excluir cliente', 'error');
                        }
                    } catch (error) {
                        console.error('Erro ao excluir cliente:', error);
                        showToast('Erro ao excluir cliente', 'error');
                    }
                    return true;
                }
            }
        ]
    });
}

// ==================== SISTEMA DE TOAST ====================
function showToast(message, type = 'info') {
    const container = document.getElementById('toastContainer') || createToastContainer();
    
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'toast-message';
    messageDiv.textContent = message;
    
    toast.appendChild(messageDiv);
    container.appendChild(toast);
    
    // Mostrar toast
    setTimeout(() => toast.classList.add('show'), 10);
    
    // Remover após 3 segundos
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toastContainer';
    container.className = 'toast-container';
    document.body.appendChild(container);
    return container;
}

console.log('✅ Admin panel JavaScript loaded');
