# HUBLABEL PHP/MySQL

Projeto gerado a partir do JSON do n8n, com os HTMLs extraídos para servir como base visual do frontend.

## Objetivo

Remover a dependência do n8n e reconstruir o sistema com:

- Frontend em PHP usando os HTMLs extraídos
- Backend próprio em PHP
- Banco de dados MySQL
- Integração futura com Evolution API, OpenAI e automações internas

## Estrutura principal

```text
public/                 Entrada do sistema
app/Core/Database.php   Conexão PDO MySQL
app/Views/pages/        Telas convertidas para PHP
storage/extracted_html/ HTMLs originais extraídos do n8n
database/schema_mysql.sql Schema convertido para MySQL
database/schema_reference.sql Schema original Supabase/PostgreSQL
PROMPT_WINDSURF.md      Prompt para continuar no Windsurf
```

## Instalação básica

1. Criar banco MySQL:

```sql
CREATE DATABASE hublabel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Importar:

```bash
mysql -u root -p hublabel < database/schema_mysql.sql
```

3. Copiar `.env.example` para `.env` e ajustar os dados do MySQL.

4. Rodar localmente:

```bash
php -S localhost:8000 -t public
```

## Observação

Alguns campos do Supabase como `jsonb`, `array`, `uuid` e `vector` foram adaptados para MySQL usando `JSON` e `CHAR(36)`.
