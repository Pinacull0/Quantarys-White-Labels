<?php

declare(strict_types=1);

namespace LowEcommerce;

final class Router
{
    /** @var array<string, array<string, callable>> */
    private array $routes = [];

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
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
            return;
        }

        echo json_encode($handler($this->requestBody()), JSON_THROW_ON_ERROR);
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

        if (!is_array($decodedBody)) {
            return [];
        }

        return $decodedBody;
    }
}
