# HUBLABEL — JSON do n8n estruturado para Windsurf

Objetivo: usar o workflow do n8n como **documentação e referência visual/lógica**, mas reconstruir o sistema em **PHP + MySQL**, sem dependência do n8n e sem Supabase.

## Resumo do JSON
- Nome do workflow: `[SAAS] HUBLABEL - V6.0.0`
- Total de nodes: 377
- HTMLs/telas extraídas: 21
- Webhooks/rotas detectadas: 54

## Como usar no Windsurf
1. Suba este pacote no projeto.
2. Comece pelo arquivo `04_prompts_windsurf/00_PROMPT_MASTER.md`.
3. Depois rode os prompts em ordem: análise, frontend, backend, banco, integrações, IA e testes.
4. Use os HTMLs da pasta `01_html_extraido/` apenas como base visual. Não manter tudo monolítico.
5. Use os arquivos em `03_json_por_modulo/` para entender regras e fluxos sem sobrecarregar o Windsurf com o JSON inteiro.

## Regras do projeto
- Não usar n8n em produção.
- Não usar Supabase.
- Banco oficial: MySQL.
- Backend: PHP com PDO.
- Preservar ao máximo o visual dos HTMLs extraídos.
- Recriar a lógica dos webhooks como controllers/services PHP.
