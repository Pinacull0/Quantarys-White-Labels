<?php

declare(strict_types=1);

namespace LowEcommerce\Routes;

use LowEcommerce\Controller\ProductController;
use LowEcommerce\Router;

final class ProductRoutes
{
    public static function register(Router $router): void
    {
        $controller = new ProductController();

        $router->post('/api/v1/admin/products', fn (array $body): array => $controller->create($body));
    }
}
