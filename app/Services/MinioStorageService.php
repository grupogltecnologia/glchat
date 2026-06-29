<?php

class MinioStorageService {
    private array $config;

    public function __construct(array $config) {
        $this->config = $config;
    }

    public function uploadFile(string $sourcePath, string $objectKey, string $contentType): array {
        if (empty($this->config['endpoint']) || empty($this->config['bucket'])
            || empty($this->config['access_key']) || empty($this->config['secret_key'])) {
            return ['success' => false, 'error' => 'Configuração MinIO incompleta'];
        }

        $body = file_get_contents($sourcePath);
        if ($body === false) {
            return ['success' => false, 'error' => 'Não foi possível ler o arquivo temporário'];
        }

        $bucket = $this->config['bucket'];
        $endpoint = rtrim($this->config['endpoint'], '/');
        $encodedKey = implode('/', array_map('rawurlencode', explode('/', $objectKey)));
        $url = !empty($this->config['use_path_style'])
            ? $endpoint . '/' . rawurlencode($bucket) . '/' . $encodedKey
            : preg_replace('#^https?://#', '$0' . $bucket . '.', $endpoint) . '/' . $encodedKey;

        $headers = $this->assinaturaHeaders('PUT', $url, $body, $contentType);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 60,
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $status < 200 || $status >= 300) {
            return [
                'success' => false,
                'error' => $error ?: 'Erro ao enviar arquivo para MinIO',
                'status' => $status,
                'response' => $response,
            ];
        }

        return [
            'success' => true,
            'url' => $this->publicUrl($objectKey),
            'object_key' => $objectKey,
            'provider' => 'minio',
        ];
    }

    public function testar(): array {
        $tmp = tempnam(sys_get_temp_dir(), 'hublabel-minio-');
        file_put_contents($tmp, 'hublabel-minio-test-' . date('c'));
        $result = $this->uploadFile($tmp, 'healthcheck/' . basename($tmp) . '.txt', 'text/plain');
        @unlink($tmp);
        return $result;
    }

    private function assinaturaHeaders(string $method, string $url, string $body, string $contentType): array {
        $region = $this->config['region'] ?: 'us-east-1';
        $service = 's3';
        $accessKey = $this->config['access_key'];
        $secretKey = $this->config['secret_key'];
        $parsed = parse_url($url);
        $host = $parsed['host'] . (isset($parsed['port']) ? ':' . $parsed['port'] : '');
        $path = $parsed['path'] ?? '/';
        $amzDate = gmdate('Ymd\THis\Z');
        $date = gmdate('Ymd');
        $payloadHash = hash('sha256', $body);

        $canonicalHeaders = "content-type:$contentType\nhost:$host\nx-amz-content-sha256:$payloadHash\nx-amz-date:$amzDate\n";
        $signedHeaders = 'content-type;host;x-amz-content-sha256;x-amz-date';
        $canonicalRequest = implode("\n", [
            $method,
            $path,
            '',
            $canonicalHeaders,
            $signedHeaders,
            $payloadHash,
        ]);

        $credentialScope = "$date/$region/$service/aws4_request";
        $stringToSign = implode("\n", [
            'AWS4-HMAC-SHA256',
            $amzDate,
            $credentialScope,
            hash('sha256', $canonicalRequest),
        ]);

        $signingKey = $this->signatureKey($secretKey, $date, $region, $service);
        $signature = hash_hmac('sha256', $stringToSign, $signingKey);

        return [
            'Content-Type: ' . $contentType,
            'Host: ' . $host,
            'X-Amz-Date: ' . $amzDate,
            'X-Amz-Content-Sha256: ' . $payloadHash,
            'Authorization: AWS4-HMAC-SHA256 Credential=' . $accessKey . '/' . $credentialScope . ', SignedHeaders=' . $signedHeaders . ', Signature=' . $signature,
        ];
    }

    private function signatureKey(string $key, string $date, string $region, string $service): string {
        $kDate = hash_hmac('sha256', $date, 'AWS4' . $key, true);
        $kRegion = hash_hmac('sha256', $region, $kDate, true);
        $kService = hash_hmac('sha256', $service, $kRegion, true);
        return hash_hmac('sha256', 'aws4_request', $kService, true);
    }

    private function publicUrl(string $objectKey): string {
        $base = $this->config['public_url'] ?: rtrim($this->config['endpoint'], '/') . '/' . $this->config['bucket'];
        return rtrim($base, '/') . '/' . str_replace('%2F', '/', rawurlencode($objectKey));
    }
}
