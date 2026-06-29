# PROMPT PARA WINDSURF — Reconstrução HUBLABEL sem n8n, usando PHP + MySQL

Você vai continuar o desenvolvimento de um SaaS chamado HUBLABEL.

## Contexto do projeto

O sistema original estava dentro de um workflow do n8n, com várias telas HTML embutidas em nós de HTML. Esses HTMLs já foram extraídos e organizados neste projeto.

A meta agora é reconstruir o sistema para NÃO depender mais do n8n.

## Stack definida

- Frontend: PHP renderizando HTML/CSS/JS extraídos
- Backend: PHP puro inicialmente, organizado em MVC simples
- Banco de dados: MySQL
- Conexão: PDO
- WhatsApp: Evolution API
- IA: OpenAI API
- Futuro: adicionar filas/jobs próprios para substituir automações do n8n

## O que já existe

- `storage/extracted_html/`: HTMLs originais extraídos do n8n
- `app/Views/pages/`: cópias PHP iniciais das telas extraídas
- `database/schema_reference.sql`: schema original Supabase/PostgreSQL
- `database/schema_mysql.sql`: schema convertido para MySQL
- `app/Core/Database.php`: conexão PDO MySQL
- `.env.example`: variáveis de ambiente MySQL/OpenAI/Evolution
- `manifest_telas.json`: lista das telas extraídas

## Regras importantes

1. Não usar Supabase.
2. Não usar n8n como backend.
3. Usar MySQL como banco principal.
4. Manter o visual o mais fiel possível ao HTML original.
5. Separar o sistema em componentes reaproveitáveis:
   - sidebar
   - header
   - footer
   - modais
   - cards
   - tabelas
6. Evitar mexer no CSS visual antes de entender a estrutura.
7. Migrar gradualmente scripts inline para arquivos em `public/assets/js`.
8. Criar endpoints PHP em `/api`.
9. Toda consulta deve filtrar por `contaId` para manter multiempresa.
10. Usar prepared statements com PDO.

## Banco de dados

Importar o arquivo:

```bash
mysql -u root -p hublabel < database/schema_mysql.sql
```

Observação:

- Campos `uuid` foram convertidos para `CHAR(36)`.
- Campos `jsonb`, `ARRAY` e `vector` foram convertidos para `JSON`.
- Campos booleanos foram convertidos para `TINYINT(1)`.
- IDs identity foram convertidos para `AUTO_INCREMENT`.

## Primeira missão

1. Revisar `database/schema_mysql.sql`.
2. Corrigir qualquer detalhe de compatibilidade com a versão MySQL usada.
3. Criar camada de Models:
   - ContaModel
   - UsuarioModel
   - AgenteModel
   - ConexaoModel
   - ContatoModel
   - ConversaModel
   - MensagemModel
   - DisparoModel
   - QuadroModel
4. Criar camada de Controllers:
   - AuthController
   - DashboardController
   - ConexoesController
   - ContatosController
   - AgentesController
   - ChatController
   - DisparosController
   - CrmController
   - AdminController
5. Criar rotas amigáveis no `public/index.php`.

## Rotas desejadas

- `/login`
- `/dashboard`
- `/conexoes`
- `/disparos`
- `/contatos`
- `/configuracoes`
- `/admin`
- `/crm`
- `/agentes`
- `/chat`
- `/ajuda`

## APIs iniciais

Criar endpoints PHP retornando JSON:

- `GET /api/dashboard/resumo`
- `GET /api/conexoes`
- `POST /api/conexoes/criar`
- `POST /api/conexoes/reiniciar`
- `POST /api/conexoes/desconectar`
- `GET /api/contatos`
- `POST /api/contatos`
- `GET /api/conversas`
- `GET /api/mensagens?conversaId=ID`
- `POST /api/mensagens/enviar`
- `GET /api/agentes`
- `POST /api/agentes`
- `GET /api/disparos`
- `POST /api/disparos`

## Autenticação

Implementar login próprio em PHP usando tabela `SAAS_Usuarios`.

Recomendações:

- Criar coluna `senha_hash` se ainda não existir.
- Usar `password_hash()` e `password_verify()`.
- Usar sessão PHP no início.
- Armazenar `usuario_id`, `contaId`, `funcao` e `super_admin` na sessão.

SQL sugerido:

```sql
ALTER TABLE `SAAS_Usuarios`
ADD COLUMN `senha_hash` VARCHAR(255) NULL AFTER `Email`;
```

## Multiempresa

Toda tabela com `contaId` precisa respeitar o cliente logado.

Exemplo:

```php
$stmt = $pdo->prepare("SELECT * FROM SAAS_Contatos WHERE contaId = :contaId");
$stmt->execute(['contaId' => $_SESSION['contaId']]);
```

## Substituição do n8n

Tudo que era webhook ou automação no n8n deve virar:

- Controller PHP
- API endpoint PHP
- Job/cron PHP
- Integração direta com Evolution API/OpenAI

## Próxima etapa visual

Começar pela tela de Login e Dashboard:

1. Separar CSS repetido.
2. Criar layout padrão.
3. Remover scripts que dependem de webhook n8n.
4. Fazer os dados virem de endpoints PHP.
5. Manter classes, espaçamentos e aparência original.

## Resultado esperado

Um SaaS PHP/MySQL, visualmente idêntico ao sistema original em HTML, mas com backend próprio e sem dependência do n8n ou Supabase.
