# PROMPT 06 — Testes e validação visual

Valide que a migração do n8n para PHP + MySQL ficou fiel.

## Checklist
1. Todas as rotas HTML do n8n têm tela PHP correspondente.
2. Todas as chamadas para webhooks n8n foram trocadas por `/api/...`.
3. Todas as consultas Supabase/Postgres foram convertidas para MySQL.
4. Login e sessão funcionam.
5. Multiempresa por `contaId` funciona.
6. Visual das telas bate com os HTMLs originais.
7. Integração Evolution API está encapsulada em service.
8. Disparos não dependem de n8n; usam fila/worker PHP.
9. Agente IA responde e salva histórico.
10. Logs de erro foram criados.

## Resultado esperado
Sistema executando localmente com PHP + MySQL, sem qualquer dependência de n8n ou Supabase.
