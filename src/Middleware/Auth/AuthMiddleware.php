<?php

namespace App\Middleware\Auth;

use App\Utils\Session;

class AuthMiddleware {
    public function __construct(public $session = new Session) {
        
    }

    public function handle() {
        if(!$this->session->has('auth') ?? false) {
            return redirect('/login');
        }
    }
}