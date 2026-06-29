# HUBLABEL - Documentação dos Services

## 📦 Services Implementados

### 1. EvolutionService - Integração WhatsApp

Gerencia toda comunicação com a Evolution API para WhatsApp.

#### Métodos Principais

```php
$evolution = new EvolutionService();

// Gerenciar Instâncias
$evolution->criarInstancia('minha-instancia');
$evolution->conectarInstancia('minha-instancia');
$evolution->obterQRCode('minha-instancia');
$evolution->verificarStatus('minha-instancia');
$evolution->desconectarInstancia('minha-instancia');
$evolution->deletarInstancia('minha-instancia');

// Enviar Mensagens
$evolution->enviarTexto('minha-instancia', '5511999999999', 'Olá!');
$evolution->enviarImagem('minha-instancia', '5511999999999', 'https://...', 'Legenda');
$evolution->enviarAudio('minha-instancia', '5511999999999', 'https://...');
$evolution->enviarVideo('minha-instancia', '5511999999999', 'https://...', 'Legenda');
$evolution->enviarDocumento('minha-instancia', '5511999999999', 'https://...', 'arquivo.pdf');

// Grupos
$evolution->listarGrupos('minha-instancia');
$evolution->obterParticipantesGrupo('minha-instancia', 'grupo-id');

// Contatos
$evolution->sincronizarContatos('minha-instancia');
$evolution->obterInfoContato('minha-instancia', '5511999999999');
$evolution->obterFotoPerfil('minha-instancia', '5511999999999');

// Webhooks
$evolution->configurarWebhook('minha-instancia', 'https://seu-site.com/webhook');
```

#### Configuração

Adicione no `.env`:
```env
EVOLUTION_API_URL=https://sua-evolution.com
EVOLUTION_API_KEY=sua-api-key
```

---

### 2. AIService - Integração OpenAI

Gerencia interações com a API da OpenAI para IA conversacional e análise.

#### Métodos Principais

```php
$ai = new AIService();

// Chat Simples
$response = $ai->responderMensagem(
    'Qual o clima hoje?',
    $historico = [],
    $instrucoes = 'Você é um assistente prestativo'
);

// Chat com Histórico
$response = $ai->gerarResposta('Olá!', [
    'instrucoes' => 'Você é um atendente de vendas',
    'historico' => [
        ['role' => 'user', 'content' => 'Oi'],
        ['role' => 'assistant', 'content' => 'Olá! Como posso ajudar?']
    ],
    'modelo' => 'gpt-4',
    'criatividade' => 0.7,
    'maxTokens' => 1000
]);

// Análise de Dados
$response = $ai->analisarDados(
    'Quantas vendas tivemos hoje?',
    ['vendas' => 150, 'total' => 'R$ 45.000'],
    'Você é um analista de vendas'
);

// Extrair Informações
$response = $ai->extrairInformacoes(
    'Meu nome é João, email joao@email.com, telefone 11999999999',
    ['nome', 'email', 'telefone']
);

// Resumir Texto
$response = $ai->resumirTexto($textoLongo, $maxPalavras = 100);

// Classificar Texto
$response = $ai->classificarTexto(
    'Produto com defeito',
    ['Vendas', 'Suporte', 'Financeiro']
);

// Embeddings
$response = $ai->gerarEmbedding('Texto para gerar embedding');

// Utilidades
$tokens = $ai->calcularTokens('Texto qualquer');
$valido = $ai->validarApiKey();
$modelos = $ai->listarModelos();
```

#### Configuração

Adicione no `.env`:
```env
OPENAI_API_KEY=sk-...
```

---

### 3. QueueService - Sistema de Filas

Gerencia filas de jobs assíncronos para processar tarefas em background.

#### Métodos Principais

```php
$queue = new QueueService();

// Adicionar Job
$jobId = $queue->push('enviar_email', [
    'para' => 'usuario@email.com',
    'assunto' => 'Bem-vindo',
    'corpo' => 'Olá!'
], 'default', $delay = 0);

// Processar Job
$job = $queue->pop('default');
if ($job) {
    // Processar...
    $queue->delete($job['id']); // Sucesso
    // ou
    $queue->fail($job['id'], 'Erro ao processar'); // Falha
    // ou
    $queue->release($job['id'], $delay = 60); // Reagendar
}

// Gerenciar Filas
$tamanho = $queue->size('default');
$queue->clear('default');

// Limpeza
$queue->limparJobsAntigos($dias = 7);
$queue->limparJobsFalhados($dias = 30);

// Jobs Falhados
$falhados = $queue->listarJobsFalhados($limit = 50);
$queue->reprocessarJobFalhado($failedJobId);
```

#### Worker CLI

```bash
# Iniciar worker
php bin/queue-worker.php default 3

# Parâmetros:
# - default: nome da fila
# - 3: segundos de sleep entre verificações
```

#### Jobs Disponíveis

- `enviar_mensagem` - Enviar mensagem WhatsApp
- `processar_disparo` - Processar campanha de disparo
- `enviar_email` - Enviar email
- `processar_agente_ia` - Processar resposta de IA

---

### 4. FileStorageService - Upload de Arquivos

Gerencia upload e armazenamento de arquivos (imagens, áudios, vídeos, documentos).

#### Métodos Principais

```php
$storage = new FileStorageService();

// Upload de Arquivo
$result = $storage->upload($_FILES['arquivo'], 'image', $contaId);
// Retorna: ['success' => true, 'filename' => '...', 'url' => '...', 'path' => '...']

// Upload Base64
$result = $storage->uploadBase64($base64Data, 'image', $contaId);

// Upload de URL
$result = $storage->uploadUrl('https://exemplo.com/imagem.jpg', 'image', $contaId);

// Deletar
$storage->deletar($caminho);

// Utilidades
$tamanho = $storage->obterTamanhoTotal($contaId);
$removidos = $storage->limparArquivosAntigos($dias = 90);
```

#### Tipos Suportados

- **image**: jpg, jpeg, png, gif, webp, svg
- **audio**: mp3, ogg, wav, opus
- **video**: mp4, avi, mov, webm
- **document**: pdf, doc, docx, xls, xlsx, txt, csv

#### Estrutura de Pastas

```
storage/uploads/
├── image/
│   └── abc12345/  (primeiros 8 chars do contaId)
├── audio/
├── video/
└── document/
```

---

### 5. EmailService - Envio de Emails

Gerencia envio de emails via SMTP.

#### Métodos Principais

```php
$email = new EmailService();

// Enviar Email Simples
$email->enviarComSMTP(
    'usuario@email.com',
    'Assunto',
    'Corpo do email',
    $isHtml = true
);

// Templates Prontos
$email->enviarBoasVindas('usuario@email.com', 'João', 'senha123');
$email->enviarRecuperacaoSenha('usuario@email.com', 'token-abc');
$email->enviarNotificacao('usuario@email.com', 'Título', 'Mensagem');

// Testar Conexão
$result = $email->testarConexao();
```

#### Configuração

Adicione no `.env`:
```env
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=seu-email@gmail.com
SMTP_PASS=sua-senha-app
SMTP_FROM_EMAIL=seu-email@gmail.com
SMTP_FROM_NAME=HUBLABEL
```

**Gmail**: Use senha de app (https://myaccount.google.com/apppasswords)

---

## 🔄 Fluxo de Integração

### Exemplo: Enviar Mensagem WhatsApp

```php
// 1. Criar conexão
$conexao = new ConexaoModel();
$conexaoId = $conexao->criar([
    'contaId' => $contaId,
    'instanceName' => 'minha-empresa',
    'nomeConexao' => 'WhatsApp Principal'
]);

// 2. Conectar via Evolution API
$evolution = new EvolutionService();
$qrcode = $evolution->obterQRCode('minha-empresa');

// 3. Enviar mensagem
$evolution->enviarTexto('minha-empresa', '5511999999999', 'Olá!');

// 4. Ou via fila (assíncrono)
$queue = new QueueService();
$queue->push('enviar_mensagem', [
    'instanceName' => 'minha-empresa',
    'numero' => '5511999999999',
    'mensagem' => 'Olá!',
    'tipo' => 'text'
]);
```

### Exemplo: Agente de IA

```php
// 1. Criar agente
$agente = new AgenteModel();
$agenteId = $agente->criar([
    'contaId' => $contaId,
    'nome' => 'Atendente Virtual',
    'instrucoes' => 'Você é um atendente de vendas prestativo',
    'modelo' => 'gpt-4',
    'criatividade' => 0.7
]);

// 2. Processar mensagem do cliente
$ai = new AIService();
$response = $ai->gerarResposta($mensagemCliente, [
    'instrucoes' => $agente['instrucoes'],
    'historico' => $historicoConversa,
    'modelo' => $agente['modelo'],
    'criatividade' => $agente['criatividade']
]);

// 3. Enviar resposta
$evolution->enviarTexto($instanceName, $numeroCliente, $response['resposta']);
```

### Exemplo: Disparo em Massa

```php
// 1. Criar disparo
$disparo = new DisparoModel();
$disparoId = $disparo->criar([
    'contaId' => $contaId,
    'nomeDisparo' => 'Campanha Black Friday',
    'mensagens' => [['texto' => 'Promoção especial!', 'tipo' => 'text']],
    'idConexoes' => [$conexaoId],
    'idListas' => [$listaId],
    'intervaloMin' => 5,
    'intervaloMax' => 10
]);

// 2. Processar via fila
$queue = new QueueService();
$queue->push('processar_disparo', [
    'disparoId' => $disparoId,
    'contaId' => $contaId
]);

// 3. Worker processa e envia mensagens
// php bin/queue-worker.php
```

---

## 🛠️ Troubleshooting

### Evolution API não conecta
- Verifique se a URL está correta
- Confirme que a API Key é válida
- Teste: `curl -H "apikey: SUA_KEY" https://sua-evolution.com/instance/fetchInstances`

### OpenAI retorna erro
- Verifique se a API Key é válida
- Confirme que tem créditos disponíveis
- Teste: `$ai->validarApiKey()`

### Emails não são enviados
- Verifique credenciais SMTP
- Use senha de app (não a senha normal)
- Teste: `$email->testarConexao()`

### Worker não processa jobs
- Verifique se o worker está rodando
- Confirme que a tabela `jobs` foi criada
- Verifique logs: `tail -f storage/logs/worker.log`
