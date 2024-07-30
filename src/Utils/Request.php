<?php

namespace App\Utils;

class Request {
    private static $instance;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function all() {
        return array_merge($_GET, $_POST);
    }
    
    public function get($key = null) {
        if($key == null) return $_GET;
        return $_GET[$key] ?? null;
    }

    public function post($key = null) {
        if($key == null) return $_POST;
        return $_POST[$key] ?? null;
    }

    public function header($key = null) {
        $headers = $this->getRequestHeader();

        if($key == null) return $headers;

        return $headers[$key] ?? null;
    }

    public function getRequestHeader() {
        $headers = array();
        foreach($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $headers;
    }
}