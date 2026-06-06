<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $action): self
    {
        $this->routes['GET'][$this->normalize($path)] = $action;
        return $this;
    }

    public function post(string $path, array $action): self
    {
        $this->routes['POST'][$this->normalize($path)] = $action;
        return $this;
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri    = $this->normalize(parse_url($uri, PHP_URL_PATH) ?: '/');
        $method = strtoupper($method);

        if (isset($this->routes[$method][$uri])) {
            [$controllerClass, $action] = $this->routes[$method][$uri];
            (new $controllerClass())->$action();
            return;
        }

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $route) {
                if (strpos($pattern, '{') === false) {
                    continue;
                }
                $regex = '#^' . preg_replace('/\{(\w+)\}/', '([^/]+)', $pattern) . '$#';
                if (preg_match($regex, $uri, $matches)) {
                    array_shift($matches);
                    [$controllerClass, $action] = $route;
                    (new $controllerClass())->$action(...$matches);
                    return;
                }
            }
        }

        http_response_code(404);
        if (file_exists(\APP_PATH . '/Views/pages/404.php')) {
            require \APP_PATH . '/Views/pages/404.php';
            return;
        }
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>404 — Not Found</title></head>';
        echo '<body style="font-family:sans-serif;text-align:center;padding:60px">';
        echo '<h1>404 — Page Not Found</h1><p><a href="' . \url('/') . '">Go back to Home</a></p></body></html>';
    }

    private function normalize(string $path): string
    {
        $path = '/' . trim($path, '/');
        return $path === '' ? '/' : $path;
    }
}
