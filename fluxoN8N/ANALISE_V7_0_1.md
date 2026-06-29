# Analise do fluxo n8n V7.0.1

Fonte analisada: `C:\Users\Servidor\Downloads\[SAAS] HUBLABEL - V7.0.1.json`

Schema Supabase analisado: `C:\Users\Servidor\.codex\attachments\3b0f6a5a-8246-4318-9961-49641954350a\pasted-text.txt`

## Comparativo com V6

- Workflow V6: 377 nodes, 54 webhooks.
- Workflow V7.0.1: 457 nodes, 64 webhooks.
- Principais acrescimos: API Oficial/Meta, OAuth/token Meta, webhooks `eventsmeta`, templates Meta, perfil Meta, disparos por API oficial, termos de uso, politica de privacidade e exclusao de usuario.

## Novas estruturas de banco migradas para MySQL

- `config_api_oficial`
- `templates_meta`
- `modelos`
- `modelos_etapas`
- `modelos_agentes_ia`

## Colunas novas aplicadas

- `conexoes`: campos de API oficial, OAuth, WABA, phone number, status/qualidade/alertas/perfil Meta.
- `contatos`: `validado`.
- `disparos`: `apiOficial`.
- `etapas_quadros`: `tipoEtapa`.
- `mensagens`: `metaMessageId`, `metaStatus`.

## Endpoints PHP adicionados

- `GET /api/meta/config`
- `POST /api/meta/config`
- `POST /meta-token`
- `POST /meta-criar-template`
- `POST /meta-excluir-template`
- `POST /enviar-template`
- `POST /meta-perfil`
- `GET /eventsmeta`
- `POST /eventsmeta`

## Arquivos principais

- `database/migrate_v7_0_1_meta_api.sql`
- `app/Controllers/MetaController.php`
- `app/Models/MetaConfigModel.php`
- `app/Models/TemplateMetaModel.php`
- `app/Services/MetaApiService.php`
