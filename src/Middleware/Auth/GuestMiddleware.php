<?php

namespace App\Middleware\Auth;

use App\Utils\Session;

class GuestMiddleware {
    public function __construct(public $session = new Session) {
        
    }

    public function handle() {
        if($this->session->has('auth')) {
            return redirect('/dashboard');
        }
    }
}