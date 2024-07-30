<?php

namespace App\Utils;

class Url {
    private static $instance;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getDomain() {
        return $_SERVER['HTTP_HOST'];
    }

    public function getProtocol() {
        return $_SERVER['REQUEST_SCHEME'] ?? 'http';
    }

    public function getUrl() {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    public function getBaseUrl() {
        return $this->getProtocol() . '://' . $this->getDomain();
    }

    public function getQuery() {
        return $_SERVER['QUERY_STRING'];
    }
}