# PROMPT 02 — Backend PHP + MySQL sem n8n

Recrie a lógica dos webhooks do n8n como backend PHP.

## Fontes
- `02_mapa_json/webhooks_rotas.json`
- `03_json_por_modulo/webhooks.json`
- `03_json_por_modulo/database_supabase_postgres.json`
- `03_json_por_modulo/code_logic.json`
- `03_json_por_modulo/http_requests.json`

## Arquitetura
Criar:
- `public/index.php` roteador principal
- `app/Core/Router.php`
- `app/Core/Database.php`
- `app/Controllers/*Controller.php`
- `app/Services/*Service.php`
- `app/Repositories/*Repository.php`
- `app/Middleware/AuthMiddleware.php`
- `app/Middleware/TenantMiddleware.php`

## Módulos iniciais
1. AuthController
2. DashboardController
3. ContatosController
4. ConexoesController
5. ConversasController
6. MensagensController
7. DisparosController
8. CRMController
9. AgentesIAController
10. ConfigController
11. AdminController

## Regras
- Todo acesso deve filtrar por `contaId`.
- Usar PDO prepared statements.
- Retornar JSON padronizado: `{ success, data, error }`.
- Não usar n8n.
- Não usar Supabase.
