<?php

class Router
{
    private $routes = [];

    public function add($route, $controllerAction)
    {
        $this->routes[$route] = $controllerAction;
    }

    public function dispatch()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        foreach ($this->routes as $route => $controllerAction) {
            if (preg_match("#^" . preg_replace('/@(\w+)/', '(?P<$1>[\w\-]+)', $route) . "$#", $requestUri, $matches)) {
                list($controller, $action) = explode('@', $controllerAction);
                array_shift($matches); // Remove full match
                $controllerClass = "app\\controllers\\" . $controller;
                $controllerObject = new $controllerClass();
                call_user_func_array([$controllerObject, $action], $matches);
                return;
            }
        }
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found!!!!!";
    }
}