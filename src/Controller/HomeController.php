<?php

namespace App\Controller;

use App\Utils\Auth;
use App\Utils\Controller;

class HomeController extends Controller {
    public function index() {
        $name = 'Keren';
        
        $this->loadView('home', compact('name'));
    }

    public function dashboard() {
        var_dump('Hello World');
        exit;
    }

    public function login() {
        var_dump('Login');
        exit;
    }

    public function testLogin() {
        $auth = new Auth;

        if($auth->login('admin@admin.com', 'password')) {
            return redirect('/dashboard');
        } else {
            var_dump('Salah');
            exit;
        }
    }

    public function logout() {
        $auth = new Auth;
        $auth->logout();

        return redirect('/login');
    }

    public function testInput() {
        $this->loadView('test-input');
    }

    public function testInputPost() {
        $valid = $this->validator->validate($this->request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!$valid) redirectBack();
    }
}