# Relatório de extração HTML + CSS limpo

Arquivo origem: [SAAS] HUBLABEL - V6.0.0(1).json
Total de telas extraídas: 19

## O que foi removido

- Todas as tags `<script>`
- Atributos inline `onclick`, `onload`, `onsubmit`, etc.
- URLs `javascript:` em `href`, `src` e `action`
- Atributos comuns de frameworks/eventos como `@click`, `v-on:*`, `x-on:*`, `hx-*`

## Objetivo

Manter somente o visual das telas para o Windsurf recriar a lógica do zero em PHP + MySQL, sem dependência do n8n.

## Telas

- `01_html1.html` — node: HTML1 | scripts removidos: 4 | eventos removidos: 40
- `02_html2.html` — node: HTML2 | scripts removidos: 3 | eventos removidos: 1
- `03_html4.html` — node: HTML4 | scripts removidos: 3 | eventos removidos: 41
- `04_html5.html` — node: HTML5 | scripts removidos: 4 | eventos removidos: 36
- `05_html6.html` — node: HTML6 | scripts removidos: 3 | eventos removidos: 35
- `06_html7.html` — node: HTML7 | scripts removidos: 4 | eventos removidos: 15
- `07_html9.html` — node: HTML9 | scripts removidos: 3 | eventos removidos: 108
- `08_html11.html` — node: HTML11 | scripts removidos: 8 | eventos removidos: 27
- `09_html12.html` — node: HTML12 | scripts removidos: 6 | eventos removidos: 87
- `10_html13.html` — node: HTML13 | scripts removidos: 2 | eventos removidos: 33
- `11_html14.html` — node: HTML14 | scripts removidos: 3 | eventos removidos: 1
- `12_html.html` — node: HTML | scripts removidos: 3 | eventos removidos: 27
- `13_html3.html` — node: HTML3 | scripts removidos: 4 | eventos removidos: 78
- `14_html15.html` — node: HTML15 | scripts removidos: 3 | eventos removidos: 57
- `15_html16.html` — node: HTML16 | scripts removidos: 3 | eventos removidos: 68
- `16_html17.html` — node: HTML17 | scripts removidos: 3 | eventos removidos: 1
- `17_html18.html` — node: HTML18 | scripts removidos: 0 | eventos removidos: 0
- `18_html19.html` — node: HTML19 | scripts removidos: 2 | eventos removidos: 0
- `19_html20.html` — node: HTML20 | scripts removidos: 3 | eventos removidos: 16