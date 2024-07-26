<?php

namespace App\Utils;

class Controller {
    public function loadView($viewName, $data = []) {
        extract($data);

        require_once __DIR__ . '/../View/' . $viewName . '.php';
    }
}