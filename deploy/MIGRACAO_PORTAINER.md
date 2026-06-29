# Migração GLChat para Portainer

## 1. Preparar DNS e proxy

Crie apontamentos DNS para a VPS:

- `glchat.seudominio.com` para o app
- `minio.seudominio.com` para a API pública do MinIO
- `minio-console.seudominio.com` para o painel do MinIO
- `ws.seudominio.com` para o WebSocket do chat

No proxy do EasyPanel/Portainer, direcione:

- `glchat.seudominio.com` -> serviço `app`, porta `80`
- `minio.seudominio.com` -> serviço `minio`, porta `9000`
- `minio-console.seudominio.com` -> serviço `minio`, porta `9001`
- `ws.seudominio.com` -> serviço `websocket`, porta `8090`, com suporte a WebSocket

## 2. Ajustar o stack

Antes de subir, configure as variáveis da stack no Portainer:

- `APP_URL`: domínio público do app, exemplo `https://glchat.seudominio.com`
- `DB_PASS`: senha do usuário MySQL `glchat`
- `MYSQL_ROOT_PASSWORD`: senha root do MySQL
- `JWT_SECRET`: chave grande e aleatória para sessões/realtime
- `MINIO_ROOT_PASSWORD`: senha do usuário MinIO `glchat_minio`
- `MINIO_CONSOLE_URL`: domínio público do console MinIO, exemplo `https://minio-console.seudominio.com`
- `PROXY_NETWORK`: nome da rede externa do proxy, padrão `proxy`

Se a rede externa do proxy não se chamar `proxy`, altere `PROXY_NETWORK`.

## 3. Subir no Portainer

No Portainer:

1. Clique em `Get Started` para selecionar o ambiente local.
2. Vá em `Stacks`.
3. Crie uma stack chamada `glchat`.
4. Use a opção de repositório Git ou envie os arquivos do projeto para a VPS.
5. Use o arquivo `docker-compose.portainer.yml`.
6. Faça o deploy.

## 4. Migrar o banco local

No XAMPP/phpMyAdmin, exporte o banco atual `hublabel` em SQL.

Depois importe na VPS:

```bash
docker exec -i glchat-mysql mysql -uglchat -ptroque_esta_senha glchat < backup-hublabel.sql
```

Se for uma instalação limpa, importe primeiro o schema mais completo em `database/schema_mysql.sql` e depois rode as migrations novas que ainda faltarem.

## 5. Configurar MinIO no admin

No painel admin do GLChat, aba MinIO:

- Endpoint interno: `http://minio:9000`
- URL pública: `https://minio.seudominio.com/glchat`
- Bucket: `glchat`
- Região: `us-east-1`
- Access key: `glchat_minio`
- Secret key: a senha definida no stack
- Path-style URL: ativo

## 6. Configurar WebSocket no banco

Na tabela `realtime_config`, deixe:

- `enabled`: `1`
- `host`: `0.0.0.0`
- `port`: `8090`
- `path`: `/chat`
- `public_url`: `wss://ws.seudominio.com/chat`

Sem `public_url`, o navegador tenta usar a porta direta `:8090`, o que costuma falhar atrás do proxy.
