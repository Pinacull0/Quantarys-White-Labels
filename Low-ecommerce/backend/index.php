<?php

declare(strict_types=1);

require_once __DIR__ . '/src/JsonResponse.php';
require_once __DIR__ . '/src/Router.php';
require_once __DIR__ . '/src/middleware/bodyLimiter.php';
require_once __DIR__ . '/src/middleware/rateLimiter.php';
require_once __DIR__ . '/src/utils/Sanitization.php';
require_once __DIR__ . '/src/service/ProductService.php';
require_once __DIR__ . '/src/controller/ProductController.php';
require_once __DIR__ . '/src/routes/ProductRoutes.php';

use LowEcommerce\Router;
use LowEcommerce\Routes\ProductRoutes;
use function LowEcommerce\Middleware\bodyLimiter;
use function LowEcommerce\Middleware\rateLimiter;

header('Content-Type: application/json; charset=utf-8');
header('Vary: Origin');

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if ($origin !== '') {
    header("Access-Control-Allow-Origin: {$origin}");
    header('Access-Control-Allow-Credentials: true');
} else {
    header('Access-Control-Allow-Origin: *');
}

header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$router = new Router();
$router->middleware(bodyLimiter(1048576));
$router->middleware(rateLimiter(60, 60));

$router->get('/health', fn (array $_body = []) => ['status' => 'ok', 'service' => 'low-ecommerce']);
$router->get('/api/v1/health', fn (array $_body = []) => ['status' => 'ok', 'service' => 'low-ecommerce']);
$router->get('/products', fn (array $_body = []) => [
    ['id' => 1, 'name' => 'Camiseta Essential', 'price' => 7990],
    ['id' => 2, 'name' => 'Tenis Urban', 'price' => 24990],
    ['id' => 3, 'name' => 'Mochila Daily', 'price' => 15990],
]);

ProductRoutes::register($router);

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');
