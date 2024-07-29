<?php

namespace App\Utils;

use App\Middleware\Middleware;

class Route {
    private static $route;
    public $listRoutes = [];

    private function __construct(public $url = new Url) {}

    public static function getInstance() {
        if (self::$route == null) {
            self::$route = new Route;
        }
        return self::$route;
    }

    // Check route and open controller and method
    public function checkRoute() {
        $isFound = false;

        foreach($this->listRoutes as $route) {
            $type = $_SERVER['REQUEST_METHOD'];
            
            if($route['route'] == $this->url->getUrl() && $type == $route['type']) {
                $controller = '\\' . $route['controller'];
                $method = $route['method'];

                // Check middleware
                if(isset($route['middleware'])) {
                    Middleware::resolve($route['middleware']);    
                }

                // Call controller
                $controller = new $controller;
                $controller->$method();

                $isFound = true;
                break;
            }
        }

        if(!$isFound) {
            $this->notFound();
        }
    }

    public function get($route, $controller, $method) {
        $this->listRoutes[] = [
            'route' => $route,
            'controller' => $controller,
            'method' => $method,
            'type' => 'GET',
        ];

        return $this;
    }

    public function post($route, $controller, $method) {
        $this->listRoutes[] = [
            'route' => $route,
            'controller' => $controller,
            'method' => $method,
            'type' => 'POST',
        ];

        return $this;
    }

    public function put($route, $controller, $method) {
        $this->listRoutes[] = [
            'route' => $route,
            'controller' => $controller,
            'method' => $method,
            'type' => 'PUT',
        ];

        return $this;
    }

    public function delete($route, $controller, $method) {
        $this->listRoutes[] = [
            'route' => $route,
            'controller' => $controller,
            'method' => $method,
            'type' => 'DELETE',
        ];

        return $this;
    }

    public function middleware($key) {
        $this->listRoutes[array_key_last($this->listRoutes)]['middleware'] = $key;

        return $this;
    } 

    public function notFound() {
        http_response_code(404);
        echo 'Not found';
    }
}