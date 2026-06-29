# PROMPT 03 — Converter banco para MySQL e criar camada de dados

Use o `schema_mysql.sql` do projeto como base. O banco original veio de estrutura Supabase/Postgres, mas o sistema final será MySQL.

## Tarefa
1. Revisar tipos incompatíveis:
   - `uuid` → `CHAR(36)`
   - `jsonb` → `JSON`
   - `timestamp with time zone` → `DATETIME`
   - `ARRAY` → `JSON`
   - `vector` → usar tabela separada ou campo JSON/TEXT temporariamente
2. Criar migrations SQL organizadas por módulo.
3. Criar repositories PHP para cada tabela principal.
4. Garantir índices em:
   - `contaId`
   - `telefone`
   - `conversaId`
   - `conexaoId`
   - `idAgente`
   - `created_at`
5. Criar seed inicial para plano, conta admin e usuário admin.

## Importante
Preservar nomes das tabelas inicialmente para facilitar migração, mas criar camada Repository para futuramente renomear com segurança.
