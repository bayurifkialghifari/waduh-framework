<?php

namespace App\Utils;

class Auth {    
    public function __construct(public $session = new Session, public $model = new Model) { 

    }

    public function check() {
        return $this->session->get('auth') ?? false;
    }

    public function user() {
        return $this->session->get('auth');
    }

    public function login($username, $password) {
        require_once __DIR__ . '/../Config/auth.php';

        $usernameField = $config['auth']['username_field'];
        $passwordField = $config['auth']['password_field'];
        $table = $config['auth']['table'];

        $auth = $this->model->select('*')->from($table)->where($usernameField, $username)->get()->fetch_assoc();

        // If Not found
        if(!$auth) return false;

        // Check password
        if(!password_verify($password, $auth[$passwordField])) return false;
            
        return true;
    }
}