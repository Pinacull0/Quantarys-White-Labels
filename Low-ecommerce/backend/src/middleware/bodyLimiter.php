<?php

declare(strict_types=1);

namespace LowEcommerce\Middleware;

function bodyLimiter(int $maxBytes): callable
{
    return static function (string $_method, string $_path) use ($maxBytes): ?array {
        $contentLength = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);

        if ($contentLength > $maxBytes) {
            return [
                'code' => 'BODY_TOO_LARGE',
                'message' => 'Body da requisicao excede o limite permitido.',
                'details' => [
                    'max_bytes' => $maxBytes,
                    'received_bytes' => $contentLength,
                ],
                'status' => 413,
            ];
        }

        return null;
    };
}
