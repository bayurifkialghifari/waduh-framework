<?php

namespace App\Utils;

class Url {
    public $url;

    public function __construct() {
        if ( (! empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') ||
            (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') ) {
            $server_request_scheme = 'https';
        } else {
            $server_request_scheme = 'http';
        }
        
        $this->url = $server_request_scheme . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public function getBaseUrl() {
        return $this->url;
    }

    public function getDomain() {
        return $_SERVER['HTTP_HOST'];
    }

    public function getProtocol() {
        return $_SERVER['REQUEST_SCHEME'];
    }

    public function getPort() {
        return $_SERVER['SERVER_PORT'];
    }

    public function getUrl() {
        return $_SERVER['REQUEST_URI'];
    }

    public function getQuery() {
        return $_SERVER['QUERY_STRING'];
    }
}