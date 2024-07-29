<?php

use App\Utils\Route;

$route = Route::getInstance();
$route->get('/', \App\Controller\HomeController::class, 'index');
$route->get('/login', \App\Controller\HomeController::class, 'login')->middleware('guest');
$route->get('/dashboard', \App\Controller\HomeController::class, 'dashboard')->middleware('auth');

$route->get('/test-login', \App\Controller\HomeController::class, 'testLogin');
$route->get('/logout', \App\Controller\HomeController::class, 'logout');

$route->checkRoute();