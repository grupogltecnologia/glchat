# PROMPT 05 — Agentes de IA e análise de dados

Recrie o módulo de IA sem depender do n8n.

## Fontes
- `03_json_por_modulo/ai_langchain_openai.json`
- `03_json_por_modulo/code_logic.json`
- tabelas `SAAS_AgentesIA`, `SAAS_Conhecimentos`, `SAAS_Historico_AgenteIA`

## Serviços necessários
- `AIService.php`
- `AgentService.php`
- `KnowledgeService.php`
- `DataAnalystService.php`

## Funcionalidades
1. Agente de atendimento via WhatsApp
2. Histórico por sessão/conversa
3. Base de conhecimento/RAG
4. Consumo de créditos/tokens
5. Agente analista para indicadores da empresa

## Agente analista
O dono da empresa poderá perguntar:
- vendas/atendimentos do dia
- leads parados
- contatos novos
- conversas aguardando
- disparos enviados/falhados
- desempenho por período

## Segurança
O agente nunca deve executar SQL livre vindo diretamente do usuário. Criar consultas pré-aprovadas ou uma camada de interpretação com validação.
