<?php

namespace App\Controller;

use App\Utils\Auth;
use App\Utils\Controller;

class HomeController extends Controller {
    public function index() {
        $name = 'Keren';
        
        $this->loadView('home', compact('name'));
    }
}