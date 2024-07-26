<?php

namespace App\Utils;

use App\Utils\Url;

class Route {
    private static $route;
    public $listRoutes = [];

    private function __construct(public $url = new Url) {

    }

    public static function getInstance() {
        if (self::$route == null) {
            self::$route = new Route;
        }
        return self::$route;
    }

    // Cehck route and open controller and method
    public function checkRoute() {
        $isFound = false;

        foreach($this->listRoutes as $route) {
            $type = $_SERVER['REQUEST_METHOD'];
            
            if($route[0] == $_SERVER['REQUEST_URI'] && $type == $route[3]) {
                $controller = '\\' . $route[1];
                $method = $route[2];
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

    public function addRoute($route, $controller, $method, $type = 'GET') {
        $type = strtoupper($type);
        $this->listRoutes[] = [
            $route, 
            $controller, 
            $method,
            $type,
        ];
    }

    public function notFound() {
        http_response_code(404);
        echo 'Not found';
    }
}