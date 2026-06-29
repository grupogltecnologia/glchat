<?php
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Services/RealtimeTokenService.php';

loadEnv(__DIR__ . '/../.env');

$config = realtimeConfig();
$host = getenv('REALTIME_HOST') ?: ($config['host'] ?? '127.0.0.1');
$port = (int)(getenv('REALTIME_PORT') ?: ($config['port'] ?? 8090));
$server = stream_socket_server("tcp://{$host}:{$port}", $errno, $errstr);

if (!$server) {
    fwrite(STDERR, "Erro ao iniciar WebSocket: {$errstr} ({$errno})\n");
    exit(1);
}

stream_set_blocking($server, false);
echo "HUBLABEL Chat WebSocket em ws://{$host}:{$port}/chat\n";

$clients = [];
$lastMessageId = [];
$lastPoll = 0.0;

while (true) {
    $read = [$server];
    foreach ($clients as $client) {
        $read[] = $client['socket'];
    }

    $write = null;
    $except = null;
    @stream_select($read, $write, $except, 0, 200000);

    foreach ($read as $socket) {
        if ($socket === $server) {
            $conn = @stream_socket_accept($server, 0);
            if ($conn) {
                stream_set_blocking($conn, false);
                $clients[(int)$conn] = [
                    'socket' => $conn,
                    'handshake' => false,
                    'contaId' => null,
                    'conversaId' => null,
                ];
            }
            continue;
        }

        $id = (int)$socket;
        $data = @fread($socket, 8192);
        if ($data === '' || $data === false) {
            closeClient($clients, $id);
            continue;
        }

        if (!$clients[$id]['handshake']) {
            if (!handshake($socket, $data)) {
                closeClient($clients, $id);
                continue;
            }
            $clients[$id]['handshake'] = true;
            sendJson($socket, ['type' => 'connected']);
            continue;
        }

        $message = decodeFrame($data);
        if ($message === null) continue;

        $json = json_decode($message, true);
        if (!is_array($json)) continue;

        if (($json['type'] ?? '') === 'auth') {
            $payload = RealtimeTokenService::validar($json['token'] ?? '');
            if (!$payload) {
                sendJson($socket, ['type' => 'error', 'error' => 'Token invalido']);
                closeClient($clients, $id);
                continue;
            }
            $clients[$id]['contaId'] = $payload['contaId'];
            $lastMessageId[$payload['contaId']] ??= currentMaxMessageId($payload['contaId']);
            sendJson($socket, ['type' => 'auth_ok', 'contaId' => $payload['contaId']]);
        }

        if (($json['type'] ?? '') === 'subscribe') {
            $clients[$id]['conversaId'] = isset($json['conversaId']) ? (int)$json['conversaId'] : null;
        }
    }

    $now = microtime(true);
    if ($now - $lastPoll >= 1.0) {
        pollMessages($clients, $lastMessageId);
        $lastPoll = $now;
    }
}

function loadEnv(string $path): void {
    if (!is_file($path)) return;
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) continue;
        [$name, $value] = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}

function realtimeConfig(): array {
    try {
        $stmt = Database::pdo()->query("SELECT host, port FROM realtime_config WHERE id = 1");
        $config = $stmt->fetch();
        return $config ?: ['host' => '127.0.0.1', 'port' => 8090];
    } catch (Throwable $e) {
        return ['host' => '127.0.0.1', 'port' => 8090];
    }
}

function handshake($socket, string $headers): bool {
    if (!preg_match("/Sec-WebSocket-Key: (.*)\r\n/i", $headers, $matches)) {
        return false;
    }

    $key = trim($matches[1]);
    $accept = base64_encode(sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
    $response = "HTTP/1.1 101 Switching Protocols\r\n"
        . "Upgrade: websocket\r\n"
        . "Connection: Upgrade\r\n"
        . "Sec-WebSocket-Accept: {$accept}\r\n\r\n";

    fwrite($socket, $response);
    return true;
}

function decodeFrame(string $data): ?string {
    $length = ord($data[1]) & 127;
    if ($length === 126) {
        $masks = substr($data, 4, 4);
        $payload = substr($data, 8);
    } elseif ($length === 127) {
        $masks = substr($data, 10, 4);
        $payload = substr($data, 14);
    } else {
        $masks = substr($data, 2, 4);
        $payload = substr($data, 6);
    }

    $text = '';
    for ($i = 0, $n = strlen($payload); $i < $n; $i++) {
        $text .= $payload[$i] ^ $masks[$i % 4];
    }
    return $text;
}

function encodeFrame(string $payload): string {
    $length = strlen($payload);
    if ($length <= 125) {
        return chr(129) . chr($length) . $payload;
    }
    if ($length <= 65535) {
        return chr(129) . chr(126) . pack('n', $length) . $payload;
    }
    return chr(129) . chr(127) . pack('J', $length) . $payload;
}

function sendJson($socket, array $payload): void {
    @fwrite($socket, encodeFrame(json_encode($payload)));
}

function closeClient(array &$clients, int $id): void {
    if (isset($clients[$id])) {
        @fclose($clients[$id]['socket']);
        unset($clients[$id]);
    }
}

function currentMaxMessageId(string $contaId): int {
    $stmt = Database::pdo()->prepare("SELECT COALESCE(MAX(id), 0) AS id FROM mensagens WHERE contaId = ?");
    $stmt->execute([$contaId]);
    return (int)$stmt->fetch()['id'];
}

function pollMessages(array &$clients, array &$lastMessageId): void {
    $contas = [];
    foreach ($clients as $client) {
        if ($client['handshake'] && $client['contaId']) {
            $contas[$client['contaId']] = true;
        }
    }

    foreach (array_keys($contas) as $contaId) {
        $last = $lastMessageId[$contaId] ?? 0;
        $stmt = Database::pdo()->prepare("
            SELECT *, COALESCE(mensagem, conteudo) AS mensagem, COALESCE(conteudo, mensagem) AS conteudo
            FROM mensagens
            WHERE contaId = ? AND id > ?
            ORDER BY id ASC
            LIMIT 100
        ");
        $stmt->execute([$contaId, $last]);
        $messages = $stmt->fetchAll();

        foreach ($messages as $message) {
            $lastMessageId[$contaId] = max($lastMessageId[$contaId] ?? 0, (int)$message['id']);
            foreach ($clients as $client) {
                if ($client['contaId'] !== $contaId) continue;
                if ($client['conversaId'] && (int)$client['conversaId'] !== (int)$message['conversaId']) continue;
                sendJson($client['socket'], ['type' => 'message', 'data' => $message]);
            }
        }
    }
}
