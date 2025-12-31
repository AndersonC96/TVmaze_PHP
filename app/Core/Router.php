<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Simple router logic
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                $this->callAction($route['controller']);
                return;
            }
        }

        // Handle root path /
        if ($uri === '/') {
           $this->callAction('HomeController@index');
           return;
        }

        // Fallback for query parameters or simple matching
        // (In a real app, use a regex router or FastRoute)
        
        echo "404 Not Found";
    }

    protected function callAction($controller)
    {
        list($controllerName, $action) = explode('@', $controller);
        $controllerName = "App\\Controllers\\{$controllerName}";
        
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                echo "Action {$action} not found in {$controllerName}";
            }
        } else {
            echo "Controller {$controllerName} not found";
        }
    }
}
