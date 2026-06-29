# PROMPT MASTER — Reconstrução HUBLABEL sem n8n

Você é um desenvolvedor sênior responsável por reconstruir um SaaS chamado HUBLABEL.

## Contexto
Existe um workflow do n8n usado como protótipo/sistema atual. Ele contém telas HTML, webhooks, integrações, regras e automações. A meta é migrar tudo para um sistema independente.

## Stack obrigatória
- PHP 8+
- MySQL 8+
- PDO
- HTML/CSS/JS puros inicialmente
- Sem n8n em produção
- Sem Supabase
- Integrações via serviços PHP

## Fontes de referência no projeto
- `01_html_extraido/`: telas originais extraídas do n8n. Preserve o visual.
- `02_mapa_json/MAPA_TECNICO.md`: mapa das telas, rotas e nodes.
- `02_mapa_json/webhooks_rotas.json`: webhooks/rotas detectadas.
- `03_json_por_modulo/`: partes do JSON separadas por função.

## Objetivo
Criar um sistema SaaS multiempresa em PHP + MySQL com:
1. autenticação
2. dashboard
3. contatos
4. conexões WhatsApp/Evolution API
5. conversas/atendimento
6. disparos
7. CRM/funil
8. agentes de IA
9. configurações
10. administração
11. análise de dados para indicadores

## Regras críticas
- Não colar HTML gigante em uma única página final.
- Quebrar em layout, componentes e páginas.
- Criar backend limpo: controllers, services, repositories e models.
- Converter chamadas n8n/webhooks para rotas PHP.
- Converter consultas Supabase/Postgres para MySQL.
- Usar `contaId` para isolamento multiempresa.
- Não expor API keys no frontend.
- Criar logs e tratamento de erros.

## Primeira tarefa
Analise os arquivos do pacote e gere um plano técnico por módulo antes de escrever código.
