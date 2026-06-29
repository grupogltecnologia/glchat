<?php

class App {
    public static function name(): string {
        return getenv('APP_NAME') ?: 'GLChat';
    }

    public static function basePath(): string {
        $base = getenv('APP_BASE_PATH');
        if ($base === false || trim($base) === '') {
            $base = '/hublabel/public';
        }

        $base = '/' . trim((string)$base, '/');
        return $base === '/' ? '' : $base;
    }

    public static function url(string $path = ''): string {
        $path = '/' . ltrim($path, '/');
        return self::basePath() . ($path === '/' ? '' : $path);
    }

    public static function asset(string $path): string {
        return self::url('assets/' . ltrim($path, '/'));
    }

    public static function redirect(string $path): void {
        header('Location: ' . self::url($path));
        exit;
    }

    public static function publicUrl(string $path = ''): string {
        $appUrl = rtrim((string)(getenv('APP_URL') ?: ''), '/');
        if ($appUrl === '') {
            return self::url($path);
        }
        return $appUrl . '/' . ltrim($path, '/');
    }
}
