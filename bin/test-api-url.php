#!/usr/bin/env php
<?php
/**
 * Testar acesso direto à API
 */

$url = 'http://localhost/hublabel/public/api/admin/dashboard';

echo "🧪 Testando acesso à API...\n";
echo "URL: $url\n\n";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id());

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Status HTTP: $httpCode\n\n";

list($headers, $body) = explode("\r\n\r\n", $response, 2);

echo "Headers:\n$headers\n\n";
echo "Body:\n$body\n";
