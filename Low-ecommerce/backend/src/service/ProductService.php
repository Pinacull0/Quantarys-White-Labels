<?php

declare(strict_types=1);

namespace LowEcommerce\Service;

final class ProductService
{
    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    public function create(array $payload): array
    {
        return [
            'id' => bin2hex(random_bytes(16)),
            ...$payload,
        ];
    }
}
