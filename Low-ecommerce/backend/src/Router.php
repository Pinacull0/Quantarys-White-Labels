<?php

declare(strict_types=1);

namespace LowEcommerce;

use JsonException;
use RuntimeException;
use Throwable;

final class Router
{
    /** @var array<string, array<string, callable>> */
    private array $routes = [];

    /** @var callable[] */
    private array $middlewares = [];

    public function middleware(callable $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function patch(string $path, callable $handler): void
    {
        $this->routes['PATCH'][$path] = $handler;
    }

    public function delete(string $path, callable $handler): void
    {
        $this->routes['DELETE'][$path] = $handler;
    }

    public function dispatch(string $method, string $path): void
    {
        $handler = $this->routes[$method][$path] ?? null;

        if ($handler === null) {
            JsonResponse::error('ROUTE_NOT_FOUND', 'Route not found.', [
                'method' => $method,
                'path' => $path,
            ], 404);
            return;
        }

        try {
            $middlewareError = $this->runMiddlewares($method, $path);

            if ($middlewareError !== null) {
                JsonResponse::error(
                    (string) $middlewareError['code'],
                    (string) $middlewareError['message'],
                    is_array($middlewareError['details'] ?? null) ? $middlewareError['details'] : [],
                    (int) ($middlewareError['status'] ?? 400)
                );
                return;
            }

            $this->sendHandlerResult($handler($this->requestBody()));
        } catch (RuntimeException $exception) {
            JsonResponse::error('INVALID_JSON', $exception->getMessage(), [], 400);
        } catch (JsonException) {
            JsonResponse::error('RESPONSE_ENCODING_ERROR', 'Could not encode response.', [], 500);
        } catch (Throwable) {
            JsonResponse::error('INTERNAL_ERROR', 'Unexpected server error.', [], 500);
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function requestBody(): array
    {
        $rawBody = file_get_contents('php://input');

        if ($rawBody === false || trim($rawBody) === '') {
            return [];
        }

        $decodedBody = json_decode($rawBody, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Invalid JSON payload.');
        }

        if (!is_array($decodedBody)) {
            throw new RuntimeException('JSON payload must be an object.');
        }

        return $decodedBody;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function runMiddlewares(string $method, string $path): ?array
    {
        foreach ($this->middlewares as $middleware) {
            $result = $middleware($method, $path);

            if (is_array($result)) {
                return $result;
            }
        }

        return null;
    }

    private function sendHandlerResult(mixed $result): void
    {
        if (is_array($result) && (array_key_exists('data', $result) || array_key_exists('error', $result))) {
            echo json_encode($result, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
            return;
        }

        JsonResponse::success($result);
    }
}
