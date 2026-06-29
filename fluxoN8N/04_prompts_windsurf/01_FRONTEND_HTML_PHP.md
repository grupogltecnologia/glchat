# PROMPT 01 — Frontend PHP a partir dos HTMLs extraídos

Use os arquivos em `01_html_extraido/` para reconstruir o frontend em PHP.

## Tarefa
1. Identifique layout comum: sidebar, header, footer, scripts globais, tema claro/escuro.
2. Crie:
   - `app/Views/layouts/main.php`
   - `app/Views/partials/sidebar.php`
   - `app/Views/partials/header.php`
   - `app/Views/partials/footer.php`
   - `public/assets/css/app.css`
   - `public/assets/js/app.js`
3. Transforme cada HTML extraído em uma view PHP separada.
4. Preserve 100% do visual original sempre que possível.
5. Substitua URLs/webhooks do n8n por endpoints PHP internos `/api/...`.
6. Não implemente backend ainda, apenas prepare chamadas `fetch()` organizadas.

## Resultado esperado
Frontend navegável com rotas PHP e visual igual ao HTML original.
