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

    public function flash($key = 'success', $message = '') {
        $_SESSION['__flash'][$key] = $message;
    }

    public function hasFlash($key = '') {
        return isset($_SESSION['__flash'][$key]);
    }

    public function unFlash() {
        unset($_SESSION['__flash']);
    }

    public function getFlash($key = 'success') {
        $flash = $_SESSION['__flash'][$key] ?? null;
        unset($_SESSION['__flash'][$key]);
        return $flash;
    }

    public function getFlashAll() {
        $flash = $_SESSION['__flash'] ?? [];
        unset($_SESSION['__flash']);
        return $flash;
    }

    public function destroy() {
        session_destroy();
    }
}