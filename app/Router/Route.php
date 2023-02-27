<?php

namespace App\Router;

class Route {
    public $method;
    public $uri;
    public $handler;
    public $middlewares;

    public function __construct($method, $uri, $handler, $middlewares)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }
}
