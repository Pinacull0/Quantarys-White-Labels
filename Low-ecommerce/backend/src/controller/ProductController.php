<?php

declare(strict_types=1);

namespace LowEcommerce\Controller;

use LowEcommerce\Service\ProductService;
use LowEcommerce\Utils\Sanitization;

final class ProductController
{
    public function __construct(
        private readonly ProductService $productService = new ProductService()
    ) {
    }

    /**
     * @param array<string, mixed> $requestBody
     * @return array<string, mixed>
     */
    public function create(array $requestBody): array
    {
        $payload = Sanitization::sanitizeCreateProductPayload($requestBody);
        $product = $this->productService->create($payload);

        return [
            'data' => $product,
            'meta' => [],
        ];
    }
}
