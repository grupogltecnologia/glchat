<?php

class RealtimeTokenService {
    public static function gerar(string $contaId, string $usuarioId, int $ttl = 86400): string {
        $payload = [
            'contaId' => $contaId,
            'usuarioId' => $usuarioId,
            'exp' => time() + $ttl,
        ];
        $body = self::base64UrlEncode(json_encode($payload));
        $sig = hash_hmac('sha256', $body, self::secret(), true);
        return $body . '.' . self::base64UrlEncode($sig);
    }

    public static function validar(string $token): ?array {
        $parts = explode('.', $token, 2);
        if (count($parts) !== 2) return null;

        [$body, $sig] = $parts;
        $expected = self::base64UrlEncode(hash_hmac('sha256', $body, self::secret(), true));
        if (!hash_equals($expected, $sig)) return null;

        $payload = json_decode(self::base64UrlDecode($body), true);
        if (!is_array($payload) || ($payload['exp'] ?? 0) < time()) return null;

        return $payload;
    }

    private static function secret(): string {
        return getenv('JWT_SECRET') ?: 'hublabel-local-realtime-secret';
    }

    private static function base64UrlEncode(string $data): string {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode(string $data): string {
        return base64_decode(strtr($data, '-_', '+/')) ?: '';
    }
}
