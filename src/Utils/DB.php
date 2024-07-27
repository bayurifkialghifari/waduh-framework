<?php

namespace App\Utils;

use mysqli;

class DB extends mysqli {
    private static $db;

    public function __construct($host, $user, $pass, $db, $port) {
        parent::__construct($host, $user, $pass, $db, $port);
    }

    public static function getInstance() {
        if (self::$db == null) {
            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $user = $_ENV['DB_USERNAME'] ?? 'root';
            $pass = $_ENV['DB_PASSWORD'] ?? '';
            $db = $_ENV['DB_NAME'] ?? '';
            $port = $_ENV['DB_PORT'] ?? '3306';

            self::$db = new DB($host, $user, $pass, $db, $port);
        }
        return self::$db;
    }
}