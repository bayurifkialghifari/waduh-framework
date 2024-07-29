<?php

namespace App\Middleware;

class Middleware {
    public const LIST_MIDDLEWARE = [
        'auth' => \App\Middleware\Auth\AuthMiddleware::class,
        'guest' => \App\Middleware\Auth\GuestMiddleware::class,
    ];
    
    public static function resolve($key) {
        if(!$key) return;

        $middleware = static::LIST_MIDDLEWARE[$key];

        if(!$middleware) throw new \Exception("Middleware {$key} not found");

        (new $middleware)->handle();
    }
}