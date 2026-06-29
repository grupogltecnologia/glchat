# 🚀 PLANO DE IMPLEMENTAÇÃO - HUBLABEL

## ✅ CONCLUÍDO ATÉ AGORA:

### 1. **Estrutura Base** ✅
- [x] Backend PHP 8+ com MVC
- [x] MySQL 8+ com PDO
- [x] Router funcional
- [x] Autenticação com sessões
- [x] 19 telas com HTML/CSS original do n8n
- [x] Menu lateral funcional
- [x] Navegação entre páginas

### 2. **Telas Implementadas** ✅
- [x] Login
- [x] Dashboard (visual)
- [x] Chat (visual)
- [x] Contatos (visual)
- [x] Conexões (visual)
- [x] Disparos (visual)
- [x] Agentes IA (visual)
- [x] CRM (visual)
- [x] Configurações (visual)
- [x] Administração (visual)

---

## 📋 PRÓXIMAS IMPLEMENTAÇÕES:

### **FASE 1: Dashboard com Dados Reais**
**Objetivo:** Exibir métricas reais do sistema

#### Backend:
```php
// DashboardController.php - método resumo()
public function resumo() {
    $userId = Auth::userId();
    $contaId = Auth::contaId();
    
    // Buscar dados do banco
    $conversas = $this->contarConversas($contaId);
    $contatos = $this->contarContatos($contaId);
    $conexoes = $this->contarConexoes($contaId);
    $disparos = $this->contarDisparos($contaId);
    
    return json_encode([
        'success' => true,
        'data' => [
            'conversas' => $conversas,
            'contatos' => $contatos,
            'conexoes' => $conexoes,
            'disparos' => $disparos
        ]
    ]);
}
```

#### Queries Necessárias:
- `SELECT COUNT(*) FROM conversas WHERE contaId = ?`
- `SELECT COUNT(*) FROM contatos WHERE contaId = ?`
- `SELECT COUNT(*) FROM conexoes WHERE contaId = ?`
- `SELECT COUNT(*) FROM disparos WHERE contaId = ?`

#### JavaScript:
- ✅ Já implementado em `dashboard.js`
- Atualiza contadores automaticamente
- Refresh a cada 30 segundos

---

### **FASE 2: Chat Funcional**
**Objetivo:** Listar conversas e enviar mensagens

#### Backend:
```php
// ChatController.php
public function listarConversas() {
    // SELECT * FROM conversas WHERE contaId = ? ORDER BY ultimaMensagem DESC
}

public function listarMensagens($conversaId) {
    // SELECT * FROM mensagens WHERE conversaId = ? ORDER BY timestamp ASC
}

public function enviarMensagem() {
    // INSERT INTO mensagens + Chamar Evolution API
}
```

#### JavaScript:
- Carregar lista de conversas
- Exibir mensagens da conversa selecionada
- Enviar mensagens via API
- Atualizar em tempo real (polling ou websocket)

#### Integrações:
- **Evolution API:** Enviar mensagens WhatsApp
- **Webhook:** Receber mensagens

---

### **FASE 3: Conexões WhatsApp**
**Objetivo:** Gerenciar instâncias WhatsApp via Evolution API

#### Backend:
```php
// ConexoesController.php
public function criar() {
    // POST para Evolution API: /instance/create
}

public function qrcode($instanceName) {
    // GET Evolution API: /instance/qrcode/$instanceName
}

public function status($instanceName) {
    // GET Evolution API: /instance/status/$instanceName
}
```

#### Evolution API Endpoints:
- `POST /instance/create` - Criar instância
- `GET /instance/qrcode/{instance}` - Obter QR Code
- `GET /instance/status/{instance}` - Status da conexão
- `DELETE /instance/delete/{instance}` - Deletar instância

#### JavaScript:
- Criar nova conexão
- Exibir QR Code em modal
- Atualizar status (conectado/desconectado)
- Deletar conexão

---

### **FASE 4: Contatos CRUD**
**Objetivo:** Gerenciar contatos com etiquetas

#### Backend:
```php
// ContatosController.php
public function listar() {
    // SELECT * FROM contatos WHERE contaId = ?
}

public function criar() {
    // INSERT INTO contatos
}

public function atualizar() {
    // UPDATE contatos SET ... WHERE id = ?
}

public function deletar() {
    // DELETE FROM contatos WHERE id = ?
}

public function importar() {
    // Importar CSV/Excel
}
```

#### Features:
- Listagem com paginação
- Busca por nome/telefone
- Filtro por etiquetas
- Importação em massa (CSV)
- Exportação
- Etiquetas coloridas

---

### **FASE 5: Disparos em Massa**
**Objetivo:** Criar e gerenciar campanhas de disparo

#### Backend:
```php
// DisparosController.php
public function criarDisparo() {
    // INSERT INTO disparos
    // Adicionar à fila de processamento
}

public function iniciar($disparoId) {
    // Processar fila e enviar mensagens
}

public function pausar($disparoId) {
    // Pausar disparo
}
```

#### Sistema de Filas:
- Tabela `fila_disparos`
- Processar em background (cron ou worker)
- Controle de velocidade (rate limiting)
- Retry em caso de erro

#### Features:
- Criar campanha
- Selecionar contatos/etiquetas
- Agendar envio
- Personalizar mensagem (variáveis)
- Anexar mídia
- Acompanhar progresso

---

### **FASE 6: Agentes de IA**
**Objetivo:** Criar agentes com OpenAI para atendimento automático

#### Backend:
```php
// AgentesController.php
public function criar() {
    // INSERT INTO agentes_ia
}

public function processar($mensagem, $agenteId) {
    // Chamar OpenAI API
    // Salvar contexto
    // Retornar resposta
}
```

#### OpenAI Integration:
```php
$client = new OpenAI\Client(getenv('OPENAI_API_KEY'));

$response = $client->chat()->create([
    'model' => 'gpt-4',
    'messages' => [
        ['role' => 'system', 'content' => $agente->instrucoes],
        ['role' => 'user', 'content' => $mensagem]
    ]
]);
```

#### Features:
- Criar agente com instruções
- Adicionar base de conhecimento
- Testar agente
- Ativar/desativar
- Logs de conversas

---

### **FASE 7: CRM/Funil**
**Objetivo:** Gerenciar leads em quadros Kanban

#### Backend:
```php
// CRMController.php
public function listarQuadros() {
    // SELECT * FROM crm_quadros WHERE contaId = ?
}

public function listarEtapas($quadroId) {
    // SELECT * FROM crm_etapas WHERE quadroId = ?
}

public function moverCard($cardId, $etapaId) {
    // UPDATE crm_cards SET etapaId = ? WHERE id = ?
}
```

#### Features:
- Criar quadros
- Criar etapas
- Adicionar cards (leads)
- Arrastar e soltar (drag & drop)
- Automações por etapa
- Relatórios de conversão

---

### **FASE 8: Configurações**
**Objetivo:** Gerenciar perfil e preferências

#### Features:
- Editar perfil
- Alterar senha
- Configurar notificações
- Preferências de sistema
- Tema (claro/escuro)

---

### **FASE 9: Administração**
**Objetivo:** Painel de super admin

#### Features:
- Listar usuários
- Criar/editar usuários
- Definir permissões
- Gerenciar contas
- Logs do sistema
- Estatísticas globais

---

### **FASE 10: Integrações**

#### Evolution API:
- Criar instâncias
- Enviar mensagens
- Receber webhooks
- Upload de mídia

#### OpenAI API:
- Chat completion
- Embeddings (base de conhecimento)
- Análise de sentimento
- Resumos automáticos

---

## 🎯 ORDEM DE IMPLEMENTAÇÃO RECOMENDADA:

1. **Dashboard com dados** (mais fácil, mostra progresso)
2. **Conexões WhatsApp** (base para tudo)
3. **Contatos** (necessário para chat e disparos)
4. **Chat** (funcionalidade core)
5. **Disparos** (monetização)
6. **Agentes IA** (diferencial)
7. **CRM** (gestão de vendas)
8. **Configurações** (UX)
9. **Administração** (gestão)

---

## 📊 ESTIMATIVA DE TEMPO:

- **Dashboard:** 2-3 horas
- **Conexões:** 4-6 horas
- **Contatos:** 3-4 horas
- **Chat:** 6-8 horas
- **Disparos:** 8-10 horas
- **Agentes IA:** 6-8 horas
- **CRM:** 8-10 horas
- **Configurações:** 2-3 horas
- **Administração:** 4-6 horas

**Total:** ~45-60 horas de desenvolvimento

---

## 🔧 TECNOLOGIAS NECESSÁRIAS:

### Backend:
- ✅ PHP 8+
- ✅ MySQL 8+
- ✅ PDO
- ⏳ Evolution API Client
- ⏳ OpenAI PHP Client

### Frontend:
- ✅ Tailwind CSS
- ✅ JavaScript ES6+
- ⏳ Chart.js (gráficos)
- ⏳ SortableJS (drag & drop)
- ⏳ Socket.io (tempo real - opcional)

### Infraestrutura:
- ✅ XAMPP (dev)
- ⏳ Cron jobs (disparos)
- ⏳ File storage (mídias)
- ⏳ Redis (cache - opcional)

---

## 📝 PRÓXIMO PASSO:

**Por onde você quer começar?**

1. **Dashboard com dados reais** (recomendado - rápido e visual)
2. **Conexões WhatsApp** (base para tudo)
3. **Chat funcional** (core do sistema)
4. **Outra funcionalidade específica**

**Me diga qual funcionalidade quer implementar primeiro!** 🚀
