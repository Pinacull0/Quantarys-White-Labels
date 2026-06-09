<?php

declare(strict_types=1);

namespace LowEcommerce;

final class JsonResponse
{
    /**
     * @param array<string, mixed> $meta
     */
    public static function success(mixed $data = [], array $meta = [], int $statusCode = 200): void
    {
        http_response_code($statusCode);
        self::send([
            'data' => $data,
            'meta' => $meta,
        ]);
    }

    /**
     * @param array<string, mixed> $details
     */
    public static function error(
        string $code,
        string $message,
        array $details = [],
        int $statusCode = 400
    ): void {
        http_response_code($statusCode);
        self::send([
            'error' => [
                'code' => $code,
                'message' => $message,
                'details' => $details,
            ],
        ]);
    }

    /**
     * @param array<string, mixed> $payload
     */
    private static function send(array $payload): void
    {
        echo json_encode($payload, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }
}
