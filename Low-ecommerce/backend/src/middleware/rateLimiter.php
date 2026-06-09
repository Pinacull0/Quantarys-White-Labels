<?php

declare(strict_types=1);

namespace LowEcommerce\Middleware;

function rateLimiter(int $maxAttempts, int $waitSeconds): callable
{
    return static function (string $method, string $path): ?array {
        $clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $key = hash('sha256', "{$clientIp}:{$method}:{$path}");
        $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "low_ecommerce_rate_{$key}.json";
        $now = time();
        $state = [
            'attempts' => 0,
            'expires_at' => $now + $waitSeconds,
        ];

        if (is_file($filePath)) {
            $storedState = json_decode((string) file_get_contents($filePath), true);

            if (is_array($storedState)) {
                $state = [
                    'attempts' => (int) ($storedState['attempts'] ?? 0),
                    'expires_at' => (int) ($storedState['expires_at'] ?? 0),
                ];
            }
        }

        if ($state['expires_at'] <= $now) {
            $state = [
                'attempts' => 0,
                'expires_at' => $now + $waitSeconds,
            ];
        }

        $state['attempts']++;
        file_put_contents($filePath, json_encode($state, JSON_THROW_ON_ERROR));

        if ($state['attempts'] > $maxAttempts) {
            return [
                'code' => 'RATE_LIMIT_EXCEEDED',
                'message' => 'Muitas tentativas. Aguarde antes de tentar novamente.',
                'details' => [
                    'retry_after' => max(0, $state['expires_at'] - $now),
                ],
                'status' => 429,
            ];
        }

        return null;
    };
}
