<?php

use App\Utils\Route;

$route = Route::getInstance();
$route->addRoute('/', \App\Controller\HomeController::class, 'index');

$route->checkRoute();