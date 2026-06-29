# PROMPT 04 — Integrações: Evolution API, e-mail, arquivos e filas

Recrie as integrações que antes estavam no n8n.

## Fontes
- `03_json_por_modulo/http_requests.json`
- `03_json_por_modulo/emails_files_s3.json`
- `03_json_por_modulo/redis_queues_wait.json`

## Serviços PHP necessários
- `EvolutionService.php`
- `EmailService.php`
- `FileStorageService.php`
- `QueueService.php`
- `WebhookService.php`

## Evolution API
Implementar:
- criar instância
- conectar QR Code
- verificar status
- desconectar
- enviar texto
- enviar mídia
- receber webhook de mensagens

## Filas
Como não teremos n8n, criar tabela MySQL de fila:
- `jobs`
- `job_attempts`
- status: pending/running/done/failed
- retry_count
- scheduled_at

Criar worker PHP CLI para processar disparos e mensagens agendadas.
