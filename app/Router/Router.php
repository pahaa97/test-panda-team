<?php

namespace App\Router;

class Router
{
    private static $routes = [];
    private static $middlewares = [];

    public static function addRoute($method, $uri, $handler)
    {
        return self::$routes[] = new Route($method, $uri, $handler, self::$middlewares);
    }

    public static function handle($uri, $method)
    {
        $uri = explode('?',$uri);
        foreach (self::$routes as $route) {
            $pattern = '#^' . preg_replace('/\/:\w+/', '/(\w+)', $route->uri) . '$#';

            if ($route->method !== $method) {
                continue;
            }

            if (preg_match($pattern, $uri[0], $matches)) {
                array_shift($matches);
                $route_params = $matches;

                if ($route->middlewares) {
                    static::dispatch($route->middlewares);
                }

                $handler = $route->handler;
                list($controller, $action) = explode('@', $handler);
                $controller = new $controller();
                $controller->$action(...$route_params);

                return;
            }
//            $pattern = '#^' . preg_replace('/:\w+/', '(\w+)', $route->uri) . '$#';
//            var_dump($pattern);
//            if (preg_match($pattern, $uri[0], $matches)) {
//                array_shift($matches);
//                $route_params = $matches;
//                var_dump($route_params);
//            }
//            if ($route->method === $method && $route->uri === $uri[0]) {
//                if ($route->middlewares) {
//                    static::dispatch($route->middlewares);
//                }
//                $handler = $route->handler;
//                list($controller, $action) = explode('@', $handler);
//                $controller = new $controller();
//                $controller->$action();
//                return;
//            }
        }

        // Если ни один маршрут не соответствует запросу, то возвращаем 404
        header('HTTP/1.0 404 Not Found');
        echo '404 Not Found';
    }

    public static function dispatch($middlewares) {
        foreach ($middlewares as $middleware) {
            if (is_string($middleware)) {
                $middlewareInstance = new $middleware();
                $middlewareInstance->handle();
            }
        }
    }

    public static function group(array $middleware, $callback)
    {
        self::$middlewares = $middleware;
        $callback();
        self::$middlewares = [];
    }
}
