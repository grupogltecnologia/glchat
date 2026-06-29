let currentConversaId = null;
let currentConversation = null;
let conversasCache = [];
let contatosCache = [];
let conexoesCache = [];
let chatSocket = null;
let chatPollingTimer = null;
let selectedNewConvContact = null;
let selectedMediaFile = null;
let currentConversationsStatusFilter = 'aberto';
const CHAT_APP_BASE = (window.GLCHAT_BASE || window.HUBLABEL_BASE || inferChatAppBase()).replace(/\/$/, '');

function inferChatAppBase() {
    const script = document.currentScript || Array.from(document.scripts).find(s => (s.src || '').includes('/assets/js/pages/chat.js'));
    if (script?.src) {
        try {
            const url = new URL(script.src);
            const marker = '/assets/js/pages/chat.js';
            const index = url.pathname.indexOf(marker);
            if (index >= 0) return url.pathname.slice(0, index);
        } catch (_) {}
    }

    const match = location.pathname.match(/^\/(?:hublabel|glchat)\/public/);
    return match ? match[0] : '';
}

function appUrl(path) {
    const normalized = String(path || '/').startsWith('/') ? String(path || '/') : `/${path}`;
    return `${CHAT_APP_BASE}${normalized}`;
}

document.addEventListener('DOMContentLoaded', async () => {
    configurarMenuLateral();
    bindThemeToggle();
    bindConversationFilters();
    bindNewConversationModal();
    bindMediaPreview();
    await Promise.all([loadConexoes(), loadContatos()]);
    await loadConversas();
    await setupRealtime();
});

function configurarMenuLateral() {
    const rotas = {
        dashboard: appUrl('/dashboard'),
        chat: appUrl('/chat'),
        'agentes-ia': appUrl('/agentes-ia'),
        crm: appUrl('/crm'),
        conexoes: appUrl('/conexoes'),
        disparos: appUrl('/disparos'),
        contatos: appUrl('/contatos'),
        ajuda: appUrl('/ajuda'),
        configuracoes: appUrl('/configuracoes'),
        admin: appUrl('/admin')
    };

    document.querySelectorAll('.menu-item[data-menu-id]').forEach(item => {
        const menuId = item.getAttribute('data-menu-id');
        if (!rotas[menuId]) return;
        item.addEventListener('click', e => {
            e.preventDefault();
            window.location.href = rotas[menuId];
        });
    });

    document.querySelector('.logout-item, [data-logout]')?.addEventListener('click', e => {
        e.preventDefault();
        if (confirm('Deseja realmente sair?')) window.location.href = appUrl('/logout');
    });
}

function bindThemeToggle() {
    const toggle = document.getElementById('darkModeToggle');
    if (!toggle || toggle.dataset.bound) return;
    toggle.dataset.bound = '1';
    const saved = localStorage.getItem('hublabel-theme') || 'dark';
    document.body.classList.toggle('light-mode', saved === 'light');
    toggle.checked = saved !== 'light';
    toggle.addEventListener('change', () => {
        const light = !toggle.checked;
        document.body.classList.toggle('light-mode', light);
        localStorage.setItem('hublabel-theme', light ? 'light' : 'dark');
    });
}

function bindConversationFilters() {
    const filterToggle = document.getElementById('conversationsFilterToggleBtn');
    const panel = document.getElementById('conversationsFiltersPanel');
    filterToggle?.addEventListener('click', () => {
        const open = !panel?.classList.contains('open');
        panel?.classList.toggle('open', open);
        filterToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    document.querySelectorAll('.chat-filter-accordion-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            const accordion = btn.closest('.chat-filter-accordion');
            const body = accordion?.querySelector('.chat-filter-accordion-body');
            const open = !accordion?.classList.contains('is-open');
            accordion?.classList.toggle('is-open', open);
            if (body) body.hidden = !open;
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    });

    document.querySelectorAll('.status-filter-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
            document.querySelectorAll('.status-filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentConversationsStatusFilter = btn.dataset.status || 'aberto';
            await loadConversas();
        });
    });

    document.getElementById('searchInput')?.addEventListener('input', applyConversationsSearchFilter);
    document.getElementById('chatFilterConexoesSearch')?.addEventListener('input', applyConnectionFilterSearch);
}

async function setupRealtime() {
    try {
        const json = await apiGet('/api/chat/realtime-config');
        if (!json.success || !json.data?.enabled || !window.WebSocket) {
            startPolling();
            return;
        }

        chatSocket = new WebSocket(json.data.url);
        chatSocket.addEventListener('open', () => {
            chatSocket.send(JSON.stringify({ type: 'auth', token: json.data.token }));
            if (currentConversaId) chatSocket.send(JSON.stringify({ type: 'subscribe', conversaId: currentConversaId }));
        });
        chatSocket.addEventListener('message', event => {
            try {
                const packet = JSON.parse(event.data);
                if (packet.type !== 'message') return;
                if (String(packet.data.conversaId) === String(currentConversaId)) appendMensagem(packet.data);
                loadConversas();
            } catch (error) {
                console.warn('Chat realtime: pacote invalido', error);
            }
        });
        chatSocket.addEventListener('close', startPolling);
        chatSocket.addEventListener('error', startPolling);
    } catch (error) {
        startPolling();
    }
}

function startPolling() {
    if (chatPollingTimer) return;
    chatPollingTimer = setInterval(async () => {
        await loadConversas();
        if (currentConversaId) await loadMensagens(currentConversaId, false);
    }, 5000);
}

async function loadConexoes() {
    try {
        const json = await apiGet('/api/conexoes');
        conexoesCache = Array.isArray(json.data) ? json.data : [];
        renderConexoesNewConversation();
        renderConexoesFilter();
    } catch (error) {
        console.warn('Chat: erro ao carregar conexoes', error);
    }
}

async function loadContatos() {
    try {
        const json = await apiGet('/api/contatos?limit=200');
        contatosCache = json.data?.contatos || json.data || [];
        renderNewConversationContacts('');
    } catch (error) {
        console.warn('Chat: erro ao carregar contatos', error);
    }
}

async function loadConversas() {
    const loading = document.getElementById('conversationsLoading');
    loading && (loading.style.display = 'block');
    try {
        const status = currentConversationsStatusFilter === 'agente-ia' ? '' : currentConversationsStatusFilter;
        const json = await apiGet('/api/conversas' + (status ? `?status=${encodeURIComponent(status)}` : ''));
        conversasCache = Array.isArray(json.data) ? json.data : [];
        if (currentConversationsStatusFilter === 'agente-ia') {
            conversasCache = conversasCache.filter(c => c.idAgente || c.nomeAgente);
        }
        renderConversas(conversasCache);
        updateStatusCounters();
    } catch (error) {
        console.warn('Chat: erro ao carregar conversas', error.message);
    } finally {
        loading && (loading.style.display = 'none');
    }
}

function renderConversas(conversas) {
    const container = document.getElementById('conversationsScroll');
    const loading = document.getElementById('conversationsLoading');
    if (!container) return;
    container.querySelectorAll('.conversation-item, .conversation-empty-state').forEach(el => el.remove());

    if (!conversas.length) {
        container.insertAdjacentHTML('beforeend', '<div class="conversation-empty-state" style="padding:28px;text-align:center;color:#94a3b8;">Nenhuma conversa encontrada</div>');
        applyConversationsSearchFilter();
        return;
    }

    const html = conversas.map(renderConversationItemHtml).join('');
    loading ? loading.insertAdjacentHTML('afterend', html) : (container.innerHTML = html);
    applyConversationsSearchFilter();
}

function renderConversationItemHtml(conv) {
    const displayName = getConversationName(conv);
    const conexaoLabel = conv.NomeConexao || conv.nomeConexao || conv.instanceName || 'Sem conexao';
    const previewText = getPreviewText(conv);
    const unread = Number(conv.naoLidas || conv.naoLida || 0);
    const fotoPerfil = conv.fotoPerfil || conv.FotoPerfil || '';
    const avatarContent = fotoPerfil
        ? `<img src="${escapeHtml(fotoPerfil)}" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`
        : getInitials(displayName);
    const active = String(conv.id) === String(currentConversaId) ? ' active' : '';
    const timeSource = conv.ultimaMensagem || conv.updated_at || conv.created_at || '';
    return `
        <div class="conversation-item${active}" data-conversation-id="${conv.id}" data-search-names="${escapeDataAttr(displayName.toLowerCase())}" data-search-digits="${digitsOnly(conv.telefone || conv.telefoneConversa || '')}" onclick="selectConversa('${conv.id}')">
            <div class="conversation-item-inner">
                <div class="conversation-avatar-wrap"><div class="conversation-avatar">${avatarContent}</div></div>
                <div class="conversation-info">
                    <div class="conversation-name-row">
                        <span class="conversation-name-block"><span class="conversation-name">${escapeHtml(displayName)}</span></span>
                        ${conv.nomeAgente ? `<span class="conversation-agente-ia-tag" title="${escapeDataAttr(conv.nomeAgente)}">${escapeHtml(conv.nomeAgente)}</span>` : ''}
                        <span class="conversation-conexao-tag">${escapeHtml(conexaoLabel)}</span>
                        <span class="conversation-time" data-time-source="${escapeDataAttr(timeSource)}">${formatRelativeTime(timeSource)}</span>
                    </div>
                    <div class="conversation-preview-row">
                        <span class="conversation-preview">${escapeHtml(previewText)}</span>
                        ${unread > 0 ? `<span class="conversation-unread">${unread}</span>` : ''}
                    </div>
                </div>
            </div>
        </div>
    `;
}

async function selectConversa(id) {
    currentConversaId = id;
    currentConversation = conversasCache.find(c => String(c.id) === String(id)) || currentConversation;
    renderChatShell(currentConversation || { id, nomeConversa: 'Conversa' });
    document.querySelectorAll('.conversation-item').forEach(item => {
        item.classList.toggle('active', String(item.dataset.conversationId) === String(id));
    });
    if (chatSocket?.readyState === WebSocket.OPEN) {
        chatSocket.send(JSON.stringify({ type: 'subscribe', conversaId: currentConversaId }));
    }
    await loadMensagens(id, true);
    await loadConversas();
}

function renderChatShell(conv) {
    const chatArea = document.getElementById('chatArea');
    if (!chatArea) return;
    const contactName = getConversationName(conv);
    const phone = conv.telefone || conv.telefoneConversa || '';
    const conexaoName = conv.NomeConexao || conv.nomeConexao || '';
    const fotoPerfil = conv.fotoPerfil || conv.FotoPerfil || '';
    const avatarContent = fotoPerfil ? '' : getInitials(contactName);

    chatArea.innerHTML = `
        <div class="chat-header-stack">
            <div class="chat-header" id="chatHeader">
                <button type="button" class="chat-header-back-mobile" onclick="showConversationsListOnMobile()" title="Voltar para conversas" aria-label="Voltar para conversas">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </button>
                <div class="chat-header-contact-hit">
                    <div class="chat-header-info">
                        <div class="chat-header-avatar" ${fotoPerfil ? `style="background-image:url('${escapeHtml(fotoPerfil)}');"` : ''}>${avatarContent}</div>
                        <div class="chat-header-name-wrap">
                            <div class="chat-header-name">${escapeHtml(contactName)}</div>
                            ${conexaoName ? `<span class="chat-header-conexao-tag">${escapeHtml(conexaoName)}</span>` : ''}
                        </div>
                    </div>
                </div>
                <div class="chat-header-center">
                    <div class="chat-header-atribuicao-pill">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
                        <span id="chatHeaderAtendentePillText">${escapeHtml(conv.atendente ? 'Atendente atribuido' : 'Sem atendente atribuido')}</span>
                    </div>
                </div>
                <div class="chat-header-right">
                    <div class="chat-header-status-actions">${getHeaderStatusButtonsHtml(conv.statusAtendimento)}</div>
                </div>
            </div>
            <div id="chatHeaderMetaMount"></div>
        </div>
        <div class="chat-search-bar" id="chatSearchBar">
            <input type="text" id="chatSearchInput" placeholder="Pesquisar nesta conversa..." autocomplete="off">
            <button type="button" class="chat-search-bar-close" onclick="closeConversationSearch()" title="Fechar pesquisa" aria-label="Fechar">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="chat-messages" id="chatMessages">
            <div class="messages-skeleton" id="messagesLoading" style="display:none;">
                <div class="skeleton-row received"><div class="skeleton-avatar"></div><div class="skeleton-bubble short"></div></div>
                <div class="skeleton-row sent"><div class="skeleton-avatar"></div><div class="skeleton-bubble medium"></div></div>
                <div class="skeleton-row received"><div class="skeleton-avatar"></div><div class="skeleton-bubble long"></div></div>
            </div>
        </div>
        <div class="reply-preview" id="replyPreview">
            <div class="reply-preview-content"><div class="reply-preview-label">Respondendo</div><div class="reply-preview-text" id="replyPreviewText"></div></div>
            <button class="reply-preview-close" onclick="cancelReply()" title="Cancelar resposta"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <div class="chat-input-area" id="chatInputArea">
            <button type="button" class="chat-add-media-btn" id="addMediaButton" title="Adicionar midia">+</button>
            <input type="file" id="mediaFileInput" accept="image/*,audio/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv" style="display:none;">
            <div class="chat-input-wrap" id="chatInputWrap">
                <div class="chat-input-outer">
                    <textarea class="chat-input" id="messageInput" rows="1" placeholder="Digite uma mensagem..." oninput="autoResizeMessageInput()" onkeydown="handleKeyPress(event)"></textarea>
                </div>
                <button type="button" class="chat-send-btn" id="sendButton" onclick="sendMessage()" title="Enviar mensagem">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </div>
        </div>
    `;

    document.getElementById('addMediaButton')?.addEventListener('click', () => document.getElementById('mediaFileInput')?.click());
    document.getElementById('mediaFileInput')?.addEventListener('change', handleMediaFileChange);
    document.getElementById('chatSearchInput')?.addEventListener('input', applyMessageSearch);
    if (window.innerWidth <= 768) {
        document.getElementById('conversationsList')?.classList.remove('show');
    }
}

async function loadMensagens(conversaId, showLoading = true) {
    const loading = document.getElementById('messagesLoading');
    if (showLoading && loading) loading.style.display = 'block';
    try {
        const data = await apiGet(`/api/mensagens?conversaId=${encodeURIComponent(conversaId)}`);
        if (data.success && Array.isArray(data.data)) renderMensagens(data.data);
    } catch (error) {
        console.warn('Chat: erro ao carregar mensagens', error.message);
    } finally {
        if (loading) loading.style.display = 'none';
    }
}

function renderMensagens(mensagens) {
    const container = document.getElementById('chatMessages');
    const loading = document.getElementById('messagesLoading');
    if (!container) return;
    container.querySelectorAll('.message').forEach(el => el.remove());
    const html = mensagens.map(renderMessageHtml).join('');
    loading ? loading.insertAdjacentHTML('afterend', html) : (container.innerHTML = html);
    container.scrollTop = container.scrollHeight;
}

function appendMensagem(msg) {
    const container = document.getElementById('chatMessages');
    if (!container) return;
    if (container.querySelector(`[data-message-id="${CSS.escape(String(msg.id))}"]`)) return;
    container.insertAdjacentHTML('beforeend', renderMessageHtml(msg));
    container.scrollTop = container.scrollHeight;
}

function renderMessageHtml(msg) {
    const isSent = Number(msg.fromMe || 0) === 1 || msg.tipo === 'enviada';
    const isIA = isSent && Number(msg.IA || 0) === 1;
    const messageId = msg.id || '';
    const messageText = msg.mensagem || msg.conteudo || '';
    const tipoMensagem = normalizeTipoMensagem(msg.tipoMensagem, msg.arquivoUrl);
    const time = msg.created_at || msg.timestamp || '';
    const favorita = Number(msg.favorita || 0) === 1;
    const enviada = msg.enviada === undefined || msg.enviada === null ? true : Number(msg.enviada) === 1;
    const mediaHtml = renderMessageMedia(msg.arquivoUrl, tipoMensagem);
    const textHtml = messageText ? `<span class="message-text">${escapeHtml(messageText)}</span>` : '';
    const body = `${mediaHtml}${textHtml}` || '<span class="message-text"></span>';
    const favoriteHtml = favorita ? '<span class="message-favorite-star"><svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>' : '';
    const statusIcon = isSent && !enviada ? '<span class="message-status-icon clock"><svg viewBox="0 0 16 16" fill="currentColor"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm.5 4.5a.5.5 0 0 0-1 0v3.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1H8.5V4.5z"/></svg></span>' : '';
    const optionsBtn = `<button class="message-options-btn" onclick="showMessageOptions(event, '${escapeForInlineJsSingleQuoted(String(messageId))}', '${escapeForInlineJsSingleQuoted(messageText.substring(0, 50))}')" title="Opcoes"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v.01M12 12v.01M12 19v.01"/></svg></button>`;
    const sentLeading = isSent ? `<span class="message-leading-options">${optionsBtn}</span>` : '';
    const meta = isSent
        ? `<span class="message-trailing-meta">${favoriteHtml}<span class="message-time">${formatTime(time)}</span>${statusIcon}</span>`
        : `<span class="message-trailing-meta">${favoriteHtml}<span class="message-time">${formatTime(time)}</span>${optionsBtn}</span>`;
    const avatar = isSent ? `<div class="message-avatar">${isIA ? robotIcon() : 'EU'}</div>` : '<div class="message-avatar">C</div>';
    const classes = isSent ? `message sent${isIA ? ' ia' : ''}` : 'message received';

    return `
        <div class="${classes}" data-message-id="${escapeDataAttr(messageId)}" data-message-tipo="${escapeDataAttr(tipoMensagem)}" data-message-enviada="${enviada ? '1' : '0'}" style="position:relative;">
            ${avatar}
            <div class="message-content">
                <div class="message-content-inner">
                    ${sentLeading}
                    <span class="message-body-block">${body}</span>
                    ${meta}
                </div>
            </div>
            <div class="message-options-menu" id="messageOptions-${escapeDataAttr(messageId)}"></div>
        </div>
    `;
}

function renderMessageMedia(url, tipoMensagem) {
    if (!url) return '';
    const safeUrl = escapeHtml(url);
    if (tipoMensagem === 'imagemessage') {
        return `<div class="message-media message-media-image"><img src="${safeUrl}" alt="Imagem" loading="lazy"></div>`;
    }
    if (tipoMensagem === 'videomessage') {
        return `<div class="message-media message-media-video"><video src="${safeUrl}" controls preload="metadata"></video></div>`;
    }
    if (tipoMensagem === 'audiomessage') {
        return `<div class="message-media message-media-audio"><audio src="${safeUrl}" controls preload="metadata"></audio></div>`;
    }
    return `<div class="message-media message-media-document"><div class="document-icon-wrap generic">DOC</div><div class="document-info"><div class="document-type">Arquivo</div><div class="document-name">${escapeHtml(getFileNameFromUrl(url))}</div></div><a href="${safeUrl}" target="_blank" rel="noopener" class="document-download"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></a></div>`;
}

async function sendMessage() {
    if (!currentConversaId) return;
    const input = document.getElementById('messageInput');
    const mensagem = input?.value.trim() || '';
    if (!mensagem) return;

    const btn = document.getElementById('sendButton');
    btn && (btn.disabled = true);
    try {
        const json = await apiPost('/api/mensagens/enviar', {
            conversaId: currentConversaId,
            mensagem,
            tipoMensagem: 'text'
        });
        if (!json.success) throw new Error(json.error || 'Erro ao enviar mensagem');
        input.value = '';
        autoResizeMessageInput();
        await loadMensagens(currentConversaId, false);
        await loadConversas();
    } catch (error) {
        showToast(error.message || 'Erro ao enviar mensagem', 'error');
    } finally {
        btn && (btn.disabled = false);
    }
}

function handleKeyPress(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessage();
    }
}

async function handleMediaFileChange(event) {
    selectedMediaFile = event.target.files?.[0] || null;
    if (!selectedMediaFile) return;
    const overlay = document.getElementById('mediaPreviewOverlay');
    const content = document.getElementById('mediaPreviewContent');
    const title = document.getElementById('mediaPreviewTitle');
    const caption = document.getElementById('mediaPreviewCaption');
    if (!overlay || !content) {
        await sendSelectedMedia('');
        return;
    }
    title && (title.textContent = selectedMediaFile.name);
    caption && (caption.value = '');
    content.innerHTML = buildMediaPreview(selectedMediaFile);
    overlay.classList.add('show');
}

function bindMediaPreview() {
    document.querySelector('#mediaPreviewOverlay .media-preview-close')?.addEventListener('click', closeMediaPreview);
    document.querySelector('#mediaPreviewOverlay .media-preview-btn-cancel')?.addEventListener('click', closeMediaPreview);
    document.getElementById('mediaPreviewSendBtn')?.addEventListener('click', async () => {
        await sendSelectedMedia(document.getElementById('mediaPreviewCaption')?.value.trim() || '');
    });
}

async function sendSelectedMedia(caption) {
    if (!selectedMediaFile || !currentConversaId) return;
    const btn = document.getElementById('mediaPreviewSendBtn');
    btn && (btn.disabled = true);
    try {
        const form = new FormData();
        form.append('file', selectedMediaFile);
        form.append('tipo', inferTipoArquivo(selectedMediaFile));
        const upload = await fetch(appUrl('/uploadmedia'), { method: 'POST', body: form }).then(r => r.json());
        if (!upload.success) throw new Error(upload.error || 'Erro no upload');
        const json = await apiPost('/api/mensagens/enviar', {
            conversaId: currentConversaId,
            mensagem: caption,
            tipoMensagem: normalizeTipoMensagem(inferTipoArquivo(selectedMediaFile)),
            arquivoUrl: upload.url || upload.link
        });
        if (!json.success) throw new Error(json.error || 'Erro ao enviar arquivo');
        closeMediaPreview();
        await loadMensagens(currentConversaId, false);
        await loadConversas();
    } catch (error) {
        showToast(error.message || 'Erro ao enviar arquivo', 'error');
    } finally {
        btn && (btn.disabled = false);
    }
}

function closeMediaPreview() {
    document.getElementById('mediaPreviewOverlay')?.classList.remove('show');
    const input = document.getElementById('mediaFileInput');
    if (input) input.value = '';
    selectedMediaFile = null;
}

function bindNewConversationModal() {
    const modal = document.getElementById('newConversationModal');
    const openBtn = document.getElementById('conversationsNewChatBtn');
    const closeBtns = modal?.querySelectorAll('.modal-close, .btn-secondary') || [];
    openBtn?.addEventListener('click', openNewConversationModal);
    closeBtns.forEach(btn => btn.addEventListener('click', closeNewConversationModal));
    modal?.addEventListener('click', event => {
        if (event.target === modal) closeNewConversationModal();
    });
    document.querySelectorAll('.new-conv-tab').forEach(tab => {
        tab.addEventListener('click', () => switchNewConversationMode(tab.dataset.mode || 'existing'));
    });
    document.getElementById('newConvContactSearch')?.addEventListener('input', event => renderNewConversationContacts(event.target.value));
    const buttons = modal?.querySelectorAll('.new-conv-modal-footer .btn:not(.btn-secondary)') || [];
    buttons[0]?.addEventListener('click', openExistingContactConversation);
    buttons[1]?.addEventListener('click', createNewNumberConversation);
}

function openNewConversationModal() {
    selectedNewConvContact = null;
    renderConexoesNewConversation();
    renderNewConversationContacts('');
    document.getElementById('newConversationModal')?.classList.add('active');
}

function closeNewConversationModal() {
    document.getElementById('newConversationModal')?.classList.remove('active');
}

function switchNewConversationMode(mode) {
    document.querySelectorAll('.new-conv-tab').forEach(tab => tab.classList.toggle('active', tab.dataset.mode === mode));
    const existing = document.getElementById('newConvPanelExisting');
    const novo = document.getElementById('newConvPanelNew');
    if (existing) existing.hidden = mode !== 'existing';
    if (novo) novo.hidden = mode !== 'new';
}

function renderConexoesNewConversation() {
    const select = document.getElementById('newConvConexaoSelect');
    if (!select) return;
    const connected = conexoesCache.filter(c => String(c.statusConexao || '').toLowerCase() === 'conectado');
    const list = connected.length ? connected : conexoesCache;
    select.innerHTML = list.map(c => `<option value="${c.id}">${escapeHtml(c.nomeConexao || c.NomeConexao || c.instanceName || 'Conexao ' + c.id)}</option>`).join('');
}

function renderConexoesFilter() {
    const wrap = document.getElementById('conexaoFilterList');
    if (!wrap) return;
    if (!conexoesCache.length) {
        wrap.innerHTML = '<span class="chat-filter-hint">Nenhuma conexão</span>';
        return;
    }
    wrap.innerHTML = conexoesCache.map(c => {
        const name = c.nomeConexao || c.NomeConexao || c.instanceName || `Conexao ${c.id}`;
        return `<label class="chat-filter-conexao-label"><input type="checkbox" class="chat-filter-conexao-cb" value="${c.id}">${escapeHtml(name)}</label>`;
    }).join('');
    wrap.querySelectorAll('input').forEach(cb => cb.addEventListener('change', loadConversas));
}

function renderNewConversationContacts(term) {
    const list = document.getElementById('newConvContactsList');
    if (!list) return;
    const needle = String(term || '').toLowerCase();
    const filtered = contatosCache.filter(c => {
        const haystack = `${c.nome || ''} ${c.telefone || ''}`.toLowerCase();
        return !needle || haystack.includes(needle) || digitsOnly(haystack).includes(digitsOnly(needle));
    }).slice(0, 50);

    if (!filtered.length) {
        list.innerHTML = '<div class="new-conv-contacts-empty">Nenhum contato encontrado</div>';
        return;
    }
    list.innerHTML = filtered.map(c => `
        <button type="button" class="new-conv-contact-row" data-id="${c.id}">
            <span class="conversation-avatar">${getInitials(c.nome || c.telefone || 'C')}</span>
            <span>
                <span class="new-conv-contact-name">${escapeHtml(c.nome || 'Sem nome')}</span>
                <span class="new-conv-contact-phone">${escapeHtml(c.telefone || '')}</span>
            </span>
        </button>
    `).join('');
    list.querySelectorAll('.new-conv-contact-row').forEach(item => {
        item.addEventListener('click', () => {
            selectedNewConvContact = contatosCache.find(c => String(c.id) === String(item.dataset.id));
            list.querySelectorAll('.new-conv-contact-row').forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');
            const hint = document.getElementById('newConvSelectedHint');
            if (hint) hint.textContent = selectedNewConvContact ? `Selecionado: ${selectedNewConvContact.nome || selectedNewConvContact.telefone}` : '';
        });
    });
}

async function openExistingContactConversation() {
    if (!selectedNewConvContact) {
        showToast('Selecione um contato.', 'error');
        return;
    }
    await createConversation({
        contatoId: selectedNewConvContact.id,
        nome: selectedNewConvContact.nome,
        telefone: selectedNewConvContact.telefone,
        conexaoId: document.getElementById('newConvConexaoSelect')?.value
    });
}

async function createNewNumberConversation() {
    const nome = document.getElementById('newConvNewNome')?.value.trim();
    const ddi = document.getElementById('newConvNewDDI')?.value || '55';
    const telefone = digitsOnly(ddi + (document.getElementById('newConvNewTelefone')?.value || ''));
    if (!nome || !telefone) {
        showToast('Informe nome e telefone.', 'error');
        return;
    }
    await createConversation({
        nome,
        telefone,
        conexaoId: document.getElementById('newConvConexaoSelect')?.value
    });
}

async function createConversation(payload) {
    try {
        const json = await apiPost('/api/conversas/criar', payload);
        if (!json.success) throw new Error(json.error || 'Erro ao criar conversa');
        closeNewConversationModal();
        await loadConversas();
        await selectConversa(json.data.id);
    } catch (error) {
        showToast(error.message || 'Erro ao criar conversa', 'error');
    }
}

async function updateConversationStatusFromHeader(status) {
    if (!currentConversaId) return;
    try {
        const json = await apiPost('/api/conversas/status', { conversaId: currentConversaId, status });
        if (!json.success) throw new Error(json.error || 'Erro ao atualizar status');
        if (currentConversation) currentConversation.statusAtendimento = status;
        document.querySelector('.chat-header-status-actions').innerHTML = getHeaderStatusButtonsHtml(status);
        await loadConversas();
    } catch (error) {
        showToast(error.message || 'Erro ao atualizar status', 'error');
    }
}

function getHeaderStatusButtonsHtml(status) {
    const s = status || 'aberto';
    if (s === 'aberto') {
        return '<button type="button" class="chat-header-status-btn" onclick="updateConversationStatusFromHeader(\'fechado\')">Fechar</button><span class="chat-header-status-sep">·</span><button type="button" class="chat-header-status-btn" onclick="updateConversationStatusFromHeader(\'aguardando\')">Colocar em espera</button>';
    }
    if (s === 'fechado') {
        return '<button type="button" class="chat-header-status-btn" onclick="updateConversationStatusFromHeader(\'aberto\')">Abrir</button>';
    }
    return '<button type="button" class="chat-header-status-btn" onclick="updateConversationStatusFromHeader(\'aberto\')">Abrir</button><span class="chat-header-status-sep">·</span><button type="button" class="chat-header-status-btn" onclick="updateConversationStatusFromHeader(\'fechado\')">Fechar</button>';
}

function showMessageOptions(event, messageId) {
    event?.stopPropagation();
    document.querySelectorAll('.message-options-menu.show').forEach(el => el.classList.remove('show'));
    const menu = document.getElementById(`messageOptions-${messageId}`);
    if (!menu) return;
    menu.innerHTML = `
        <div class="message-options-item" onclick="toggleFavoriteMessage('${escapeForInlineJsSingleQuoted(messageId)}')">Favoritar</div>
        <div class="message-options-item message-options-item--delete" onclick="deleteMessageLocal('${escapeForInlineJsSingleQuoted(messageId)}')">Excluir</div>
    `;
    menu.classList.add('show');
}

async function toggleFavoriteMessage(messageId) {
    document.getElementById(`messageOptions-${messageId}`)?.classList.remove('show');
    showToast('Favoritos serão sincronizados na próxima etapa do chat.', 'info');
}

async function deleteMessageLocal(messageId) {
    document.getElementById(`messageOptions-${messageId}`)?.classList.remove('show');
    showToast('Exclusão de mensagem será sincronizada na próxima etapa do chat.', 'info');
}

function updateStatusCounters() {
    const counts = { aberto: 0, aguardando: 0, fechado: 0, 'agente-ia': 0 };
    conversasCache.forEach(c => {
        const status = c.statusAtendimento || 'aberto';
        if (counts[status] !== undefined) counts[status]++;
        if (c.idAgente || c.nomeAgente) counts['agente-ia']++;
    });
    Object.entries(counts).forEach(([status, count]) => {
        document.querySelector(`.status-count[data-status="${status}"]`)?.replaceChildren(String(count));
    });
}

function applyConversationsSearchFilter() {
    const term = (document.getElementById('searchInput')?.value || '').toLowerCase().trim();
    const termDigits = digitsOnly(term);
    document.querySelectorAll('#conversationsScroll .conversation-item').forEach(item => {
        const names = item.dataset.searchNames || '';
        const digits = item.dataset.searchDigits || '';
        item.style.display = !term || names.includes(term) || (termDigits && digits.includes(termDigits)) ? 'flex' : 'none';
    });
}

function applyConnectionFilterSearch() {
    const term = (document.getElementById('chatFilterConexoesSearch')?.value || '').toLowerCase();
    document.querySelectorAll('#conexaoFilterList label').forEach(label => {
        label.style.display = label.textContent.toLowerCase().includes(term) ? '' : 'none';
    });
}

function applyMessageSearch() {
    const term = (document.getElementById('chatSearchInput')?.value || '').toLowerCase();
    document.querySelectorAll('#chatMessages .message').forEach(msg => {
        const text = msg.textContent.toLowerCase();
        msg.classList.toggle('search-hidden', !!term && !text.includes(term));
        msg.classList.toggle('search-highlight', !!term && text.includes(term));
    });
}

function openConversationSearch() {
    document.getElementById('chatSearchBar')?.classList.add('open');
    document.getElementById('chatSearchInput')?.focus();
}

function closeConversationSearch() {
    const input = document.getElementById('chatSearchInput');
    if (input) input.value = '';
    document.getElementById('chatSearchBar')?.classList.remove('open');
    applyMessageSearch();
}

function showConversationsListOnMobile() {
    document.getElementById('conversationsList')?.classList.add('show');
}

function cancelReply() {
    document.getElementById('replyPreview')?.classList.remove('show');
}

function autoResizeMessageInput() {
    const input = document.getElementById('messageInput');
    if (!input) return;
    input.style.height = 'auto';
    input.style.height = `${Math.min(input.scrollHeight, 110)}px`;
}

async function apiGet(path) {
    const res = await fetch(appUrl(path), { headers: { Accept: 'application/json' } });
    const json = await res.json();
    if (!res.ok || json.success === false) throw new Error(json.error || `Erro HTTP ${res.status}`);
    return json;
}

async function apiPost(path, payload) {
    const res = await fetch(appUrl(path), {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
        body: JSON.stringify(payload || {})
    });
    const json = await res.json();
    if (!res.ok || json.success === false) throw new Error(json.error || `Erro HTTP ${res.status}`);
    return json;
}

function normalizeTipoMensagem(tipo, url) {
    const raw = String(tipo || '').toLowerCase();
    if (['imagemessage', 'image', 'imagem'].includes(raw)) return 'imagemessage';
    if (['videomessage', 'video'].includes(raw)) return 'videomessage';
    if (['audiomessage', 'audio', 'ptt'].includes(raw)) return 'audiomessage';
    if (['documentmessage', 'document', 'arquivo'].includes(raw)) return 'documentmessage';
    if (url) return 'documentmessage';
    return 'conversation';
}

function inferTipoArquivo(file) {
    if (file.type.startsWith('image/')) return 'image';
    if (file.type.startsWith('audio/')) return 'audio';
    if (file.type.startsWith('video/')) return 'video';
    return 'document';
}

function buildMediaPreview(file) {
    const url = URL.createObjectURL(file);
    if (file.type.startsWith('image/')) return `<img src="${url}" alt="" style="max-width:100%;max-height:55vh;border-radius:12px;">`;
    if (file.type.startsWith('video/')) return `<video src="${url}" controls style="max-width:100%;max-height:55vh;border-radius:12px;"></video>`;
    if (file.type.startsWith('audio/')) return `<audio src="${url}" controls style="width:100%;"></audio>`;
    return `<div class="message-media-document"><div class="document-icon-wrap generic">DOC</div><div class="document-info"><div class="document-type">Arquivo</div><div class="document-name">${escapeHtml(file.name)}</div></div></div>`;
}

function getConversationName(conv) {
    return conv?.nomeConversa || conv?.nome || conv?.telefone || conv?.telefoneConversa || 'Sem nome';
}

function getPreviewText(conv) {
    return conv.ultimaMensagemTexto || conv.preview || conv.ultimaMensagemConteudo || conv.telefone || 'Clique para abrir a conversa';
}

function getInitials(value) {
    const text = String(value || '?').trim();
    const parts = text.split(/\s+/).filter(Boolean);
    if (parts.length >= 2) return (parts[0][0] + parts[1][0]).toUpperCase();
    return text.substring(0, 2).toUpperCase();
}

function digitsOnly(value) {
    return String(value || '').replace(/\D/g, '');
}

function getFileNameFromUrl(url) {
    try {
        const clean = String(url).split('?')[0];
        const part = clean.split('/').filter(Boolean).pop() || 'arquivo';
        return decodeURIComponent(part);
    } catch {
        return 'arquivo';
    }
}

function formatTime(timestamp) {
    if (!timestamp) return '';
    const date = new Date(String(timestamp).replace(' ', 'T'));
    if (Number.isNaN(date.getTime())) return '';
    return date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
}

function formatRelativeTime(timestamp) {
    if (!timestamp) return '';
    const date = new Date(String(timestamp).replace(' ', 'T'));
    if (Number.isNaN(date.getTime())) return '';
    const today = new Date();
    if (date.toDateString() === today.toDateString()) return formatTime(timestamp);
    return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
}

function escapeHtml(value) {
    return String(value ?? '').replace(/[&<>"']/g, char => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    }[char]));
}

function escapeDataAttr(value) {
    return escapeHtml(value).replace(/`/g, '&#096;');
}

function escapeForInlineJsSingleQuoted(value) {
    return String(value ?? '').replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(/\r?\n/g, ' ');
}

function robotIcon() {
    return '<span class="message-avatar-robot"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="8" cy="16" r="1"/><circle cx="16" cy="16" r="1"/><path d="M12 11V7"/><path d="M8 7h8"/></svg></span>';
}

function showToast(message, type = 'info') {
    const container = document.getElementById('toastContainer');
    if (!container) {
        alert(message);
        return;
    }
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    toast.innerHTML = `<span class="toast-message">${escapeHtml(message)}</span>`;
    container.appendChild(toast);
    requestAnimationFrame(() => toast.classList.add('show'));
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 250);
    }, 3500);
}

document.addEventListener('click', event => {
    if (!event.target.closest('.message-options-btn')) {
        document.querySelectorAll('.message-options-menu.show').forEach(el => el.classList.remove('show'));
    }
});

window.selectConversa = selectConversa;
window.selectConversation = selectConversa;
window.sendMessage = sendMessage;
window.handleKeyPress = handleKeyPress;
window.autoResizeMessageInput = autoResizeMessageInput;
window.updateConversationStatusFromHeader = updateConversationStatusFromHeader;
window.showMessageOptions = showMessageOptions;
window.cancelReply = cancelReply;
window.closeConversationSearch = closeConversationSearch;
window.openConversationSearch = openConversationSearch;
window.showConversationsListOnMobile = showConversationsListOnMobile;
