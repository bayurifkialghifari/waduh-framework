<?php

namespace App\Utils;

class DB {
    private static $db;

    public static function getInstance() {
        if (self::$db == null) {
            self::$db = new mysqli('localhost', 'root', '', 'tubesccdp');
        }
        return self::$db;
    }
}