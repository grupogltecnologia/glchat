# HUBLABEL - Guia de Instalação e Uso

## 📋 Pré-requisitos

- PHP 8.0 ou superior
- MySQL 8.0 ou superior
- Composer (opcional, para futuras dependências)
- Servidor web (Apache/Nginx) ou PHP built-in server

## 🚀 Instalação

### 1. Configurar Banco de Dados

```bash
# Criar banco de dados
mysql -u root -p -e "CREATE DATABASE hublabel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Importar schema
mysql -u root -p hublabel < database/schema_mysql.sql
```

### 2. Configurar Variáveis de Ambiente

Copie o arquivo `.env.example` para `.env` e configure:

```bash
cp .env.example .env
```

Edite o `.env` com suas credenciais:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=hublabel
DB_USER=root
DB_PASS=sua_senha

OPENAI_API_KEY=sk-...
EVOLUTION_API_URL=https://sua-evolution.com
EVOLUTION_API_KEY=sua-api-key
```

### 3. Iniciar Servidor

#### Opção 1: PHP Built-in Server (Desenvolvimento)
```bash
cd public
php -S localhost:8000
```

#### Opção 2: XAMPP/WAMP
- Coloque o projeto em `htdocs/hublabel`
- Acesse `http://localhost/hublabel/public`

#### Opção 3: Apache Virtual Host
```apache
<VirtualHost *:80>
    ServerName hublabel.local
    DocumentRoot "C:/xampp/htdocs/hublabel/public"
    
    <Directory "C:/xampp/htdocs/hublabel/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 4. Criar Primeiro Usuário

Acesse: `http://localhost:8000/cadastrar`

Ou via SQL:

```sql
-- Gerar UUID para conta
SET @contaId = UUID();

-- Criar conta
INSERT INTO SAAS_Contas (id, email, status, plano, dataValidade, tokens)
VALUES (@contaId, 'admin@hublabel.com', 1, 1, DATE_ADD(NOW(), INTERVAL 365 DAY), 1000);

-- Criar usuário admin
INSERT INTO SAAS_Usuarios (id, contaId, nome, Email, senha_hash, funcao, super_admin)
VALUES (
    UUID(),
    @contaId,
    'Administrador',
    'admin@hublabel.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- senha: password
    'admin',
    1
);
```

Senha padrão: `password`

## 📁 Estrutura do Projeto

```
hublabel/
├── app/
│   ├── Controllers/      # Controladores (lógica de negócio)
│   ├── Models/           # Models (acesso ao banco)
│   ├── Core/             # Classes core (Router, Auth, Database)
│   └── Views/            # Views (HTML/PHP)
├── database/
│   └── schema_mysql.sql  # Schema do banco
├── public/
│   ├── index.php         # Entry point + rotas
│   └── assets/           # CSS, JS, imagens
├── storage/              # HTMLs extraídos do n8n
└── .env                  # Configurações
```

## 🔑 Rotas Principais

### Páginas
- `GET /login` - Tela de login
- `GET /dashboard` - Dashboard principal
- `GET /conexoes` - Gerenciar conexões WhatsApp
- `GET /contatos` - Gerenciar contatos
- `GET /chat` - Chat/conversas
- `GET /disparos` - Campanhas de disparo
- `GET /agentes-ia` - Agentes de IA
- `GET /crm` - CRM/Funil de vendas
- `GET /configuracoes` - Configurações
- `GET /adminpannel` - Painel administrativo

### APIs (JSON)

#### Autenticação
- `POST /login` - Fazer login
- `POST /cadastrar` - Criar conta
- `GET /logout` - Sair

#### Dashboard
- `GET /api/dashboard/resumo` - Resumo de indicadores
- `GET /api/dashboard/graficos` - Dados para gráficos

#### Conexões
- `GET /api/conexoes` - Listar conexões
- `POST /api/conexoes/criar` - Criar conexão
- `POST /api/conexoes/qrcode` - Gerar QR Code

#### Contatos
- `GET /api/contatos` - Listar contatos
- `POST /api/contatos` - Criar contato
- `POST /api/contatos/importar` - Importar lista

#### Chat
- `GET /api/conversas` - Listar conversas
- `GET /api/mensagens?conversaId=ID` - Mensagens da conversa
- `POST /api/mensagens/enviar` - Enviar mensagem

#### Disparos
- `GET /api/disparos` - Listar disparos
- `POST /api/disparos/criar` - Criar campanha
- `POST /api/disparos/iniciar` - Iniciar disparo

#### Agentes IA
- `GET /api/agentes` - Listar agentes
- `POST /api/agentes/criar` - Criar agente
- `POST /api/agentes/testar` - Testar agente

#### CRM
- `GET /api/crm/quadros` - Listar quadros
- `POST /api/crm/quadros/criar` - Criar quadro
- `GET /api/crm/etapas?quadroId=ID` - Listar etapas

## 🔐 Autenticação

O sistema usa sessões PHP. Após login, as seguintes variáveis ficam disponíveis:

```php
$_SESSION['usuario_id']   // ID do usuário
$_SESSION['contaId']      // ID da conta (multiempresa)
$_SESSION['nome']         // Nome do usuário
$_SESSION['email']        // Email
$_SESSION['funcao']       // admin/atendente
$_SESSION['super_admin']  // 0 ou 1
$_SESSION['logado']       // true
```

## 🏢 Multiempresa

Todas as tabelas possuem `contaId` para isolamento de dados. Sempre filtrar por:

```php
$contaId = Auth::obterContaId();
```

## 📝 Próximos Passos

### Integrações Pendentes

1. **Evolution API** - Implementar em `app/Services/EvolutionService.php`
   - Criar instância
   - Conectar QR Code
   - Enviar/receber mensagens

2. **OpenAI API** - Implementar em `app/Services/AIService.php`
   - Chat completion
   - Embeddings
   - Análise de dados

3. **Sistema de Filas** - Criar worker para processar:
   - Disparos em massa
   - Mensagens agendadas
   - Sincronizações

4. **Upload de Arquivos** - Implementar em `app/Services/FileStorageService.php`
   - Mídia para WhatsApp
   - Importação de contatos

### Componentes Visuais

- Extrair sidebar, header, footer dos HTMLs
- Criar componentes reutilizáveis
- Adaptar JavaScript inline para arquivos separados

## 🐛 Debug

Ativar modo debug no `.env`:

```env
APP_DEBUG=true
```

Logs de erro do PHP:
```bash
tail -f /var/log/apache2/error.log
```

## 📞 Suporte

Para dúvidas sobre o sistema original n8n, consulte:
- `fluxoN8N/README.md`
- `fluxoN8N/02_mapa_json/MAPA_TECNICO.md`
- `fluxoN8N/04_prompts_windsurf/`
