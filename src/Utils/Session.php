<?php

namespace App\Utils;

class Session {
    private static $instance;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function has($key) {
        return isset($_SESSION[$key]);
    }

    public function unset($key) {
        unset($_SESSION[$key]);
    }

    public function destroy() {
        session_destroy();
    }
}