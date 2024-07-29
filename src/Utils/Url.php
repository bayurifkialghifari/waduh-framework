<?php

namespace App\Utils;

class Url {
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