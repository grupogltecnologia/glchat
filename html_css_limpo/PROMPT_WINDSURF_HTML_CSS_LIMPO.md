# Prompt para Windsurf — Reconstrução das telas sem JavaScript do n8n

Estou reconstruindo um sistema originalmente feito em n8n, mas agora será um sistema independente em PHP + MySQL.

Nesta pasta existem telas extraídas do JSON do n8n em versão limpa, contendo apenas HTML + CSS. Todo JavaScript, chamadas fetch, listeners, funções e dependências do n8n foram removidas para evitar loop infinito no carregamento.

## Objetivo

Usar essas telas como base visual para recriar o frontend do sistema, mantendo o visual o mais fiel possível, mas implementando a lógica do zero.

## Regras obrigatórias

1. Não reaproveitar JavaScript antigo do n8n.
2. Não criar chamadas automáticas em loop ao carregar a página.
3. Não usar Supabase.
4. Usar PHP + MySQL.
5. Separar layout em componentes reutilizáveis:
   - `app/views/layout/header.php`
   - `app/views/layout/sidebar.php`
   - `app/views/layout/footer.php`
   - `app/views/pages/*.php`
6. Separar backend em:
   - `app/controllers`
   - `app/models`
   - `app/services`
   - `public/api`
7. Criar APIs PHP controladas, com autenticação e validação.
8. Todas as consultas devem respeitar multiempresa via `contaId`.
9. Criar JavaScript novo apenas quando necessário e de forma modular em `/public/assets/js`, sem loops infinitos.
10. Primeiro renderizar telas estáticas, depois conectar dados gradualmente.

## Primeira tarefa

Analise todos os arquivos HTML em `telas_html_css_limpo/` e faça:

- Identifique componentes repetidos: sidebar, header, cards, tabelas, modais e formulários.
- Extraia CSS comum para `/public/assets/css/app.css`.
- Transforme cada tela em uma view PHP.
- Crie um roteador simples em `public/index.php`.
- Mantenha o visual exatamente igual ao HTML original.

## Segunda tarefa

Depois de organizar o frontend, crie o backend PHP + MySQL com:

- conexão PDO
- login
- sessão
- controle de usuários
- contas/empresas
- contatos
- conexões WhatsApp
- agentes de IA
- conversas
- mensagens
- disparos
- CRM

## Importante

O HTML é apenas referência visual. A lógica deve ser reconstruída do zero para funcionar sem n8n.
