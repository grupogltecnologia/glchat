document.addEventListener('DOMContentLoaded', async () => {
    await loadPageData();
    setupMinioConfigPanel();
});

async function loadPageData() {
    try {
        console.log('Carregando configuracoes...');
    } catch (error) {
        console.error('Erro ao carregar dados:', error);
    }
}

async function setupMinioConfigPanel() {
    const main = document.querySelector('.main-content') || document.body;
    if (!main || document.getElementById('minioConfigPanel')) return;

    const panel = document.createElement('section');
    panel.id = 'minioConfigPanel';
    panel.style.cssText = 'max-width:980px;margin:24px auto;padding:24px;background:#fff;border:1px solid #e2e8f0;border-radius:18px;box-shadow:0 8px 30px rgba(15,23,42,.06);color:#0f172a;font-family:Plus Jakarta Sans,system-ui,sans-serif;';
    panel.innerHTML = `
        <div style="display:flex;justify-content:space-between;gap:16px;align-items:flex-start;margin-bottom:18px;">
            <div>
                <h2 style="font-size:20px;font-weight:800;margin:0 0 6px;">Storage MinIO</h2>
                <p style="font-size:13px;color:#64748b;margin:0;">Arquivos do chat, agentes e disparos podem continuar usando MinIO/S3 como no fluxo n8n.</p>
            </div>
            <label style="display:flex;gap:8px;align-items:center;font-size:13px;font-weight:700;color:#475569;">
                <input type="checkbox" id="minioAtivo"> Ativo
            </label>
        </div>
        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;">
            ${inputHtml('minioEndpoint', 'Endpoint', 'http://127.0.0.1:9000')}
            ${inputHtml('minioPublicUrl', 'URL publica', 'http://127.0.0.1:9000/hublabel')}
            ${inputHtml('minioBucket', 'Bucket', 'hublabel')}
            ${inputHtml('minioRegion', 'Regiao', 'us-east-1')}
            ${inputHtml('minioAccessKey', 'Access key', 'minioadmin')}
            ${inputHtml('minioSecretKey', 'Secret key', 'Deixe em branco para manter a atual', 'password')}
        </div>
        <label style="display:flex;gap:8px;align-items:center;margin-top:14px;font-size:13px;color:#475569;">
            <input type="checkbox" id="minioPathStyle" checked> Usar path-style URL
        </label>
        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:20px;">
            <button type="button" id="btnTestarMinio" style="padding:10px 16px;border-radius:12px;border:1px solid #cbd5e1;background:#fff;color:#334155;font-weight:800;cursor:pointer;">Testar</button>
            <button type="button" id="btnSalvarMinio" style="padding:10px 16px;border-radius:12px;border:0;background:#6C63FF;color:#fff;font-weight:800;cursor:pointer;">Salvar MinIO</button>
        </div>
        <div id="minioConfigStatus" style="margin-top:12px;font-size:13px;color:#64748b;"></div>
    `;

    main.prepend(panel);

    await carregarMinioConfig();
    document.getElementById('btnSalvarMinio')?.addEventListener('click', salvarMinioConfig);
    document.getElementById('btnTestarMinio')?.addEventListener('click', testarMinioConfig);
}

function inputHtml(id, label, placeholder, type = 'text') {
    return `
        <label style="display:flex;flex-direction:column;gap:7px;font-size:13px;font-weight:800;color:#334155;">
            ${label}
            <input id="${id}" type="${type}" placeholder="${placeholder}" style="width:100%;padding:11px 12px;border:1px solid #cbd5e1;border-radius:12px;font-size:14px;color:#0f172a;">
        </label>
    `;
}

async function carregarMinioConfig() {
    try {
        const res = await fetch('/hublabel/public/api/admin/storage/config');
        const json = await res.json();
        if (!json.success || !json.data) return;
        const c = json.data;
        document.getElementById('minioAtivo').checked = c.provider === 'minio' && Number(c.ativo) === 1;
        document.getElementById('minioEndpoint').value = c.endpoint || '';
        document.getElementById('minioPublicUrl').value = c.public_url || '';
        document.getElementById('minioBucket').value = c.bucket || '';
        document.getElementById('minioRegion').value = c.region || 'us-east-1';
        document.getElementById('minioAccessKey').value = c.access_key || '';
        document.getElementById('minioPathStyle').checked = Number(c.use_path_style) !== 0;
        setMinioStatus(c.secret_key_configurado ? 'Secret key ja configurada.' : 'Secret key ainda nao configurada.');
    } catch (error) {
        setMinioStatus('Configuracao MinIO disponivel apenas para super admin.');
    }
}

async function salvarMinioConfig() {
    const payload = {
        provider: document.getElementById('minioAtivo').checked ? 'minio' : 'local',
        ativo: document.getElementById('minioAtivo').checked ? 1 : 0,
        endpoint: document.getElementById('minioEndpoint').value.trim(),
        public_url: document.getElementById('minioPublicUrl').value.trim(),
        bucket: document.getElementById('minioBucket').value.trim(),
        region: document.getElementById('minioRegion').value.trim() || 'us-east-1',
        access_key: document.getElementById('minioAccessKey').value.trim(),
        secret_key: document.getElementById('minioSecretKey').value,
        use_path_style: document.getElementById('minioPathStyle').checked ? 1 : 0,
    };

    setMinioStatus('Salvando...');
    const res = await fetch('/hublabel/public/api/admin/storage/config', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
    });
    const json = await res.json();
    setMinioStatus(json.success ? 'Configuracao salva.' : (json.error || 'Erro ao salvar.'));
}

async function testarMinioConfig() {
    setMinioStatus('Testando upload...');
    const res = await fetch('/hublabel/public/api/admin/storage/testar', { method: 'POST' });
    const json = await res.json();
    setMinioStatus(json.success ? 'Teste concluido com sucesso.' : (json.error || 'Falha no teste.'));
}

function setMinioStatus(message) {
    const el = document.getElementById('minioConfigStatus');
    if (el) el.textContent = message;
}
