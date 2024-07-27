<?php

namespace App\Utils;

use eftec\bladeone\BladeOne;

class Controller {
    protected function loadView($viewName, $data = []) {
        $blade = new BladeOne(VIEW_PATH, VIEW_CACHE_PATH, BladeOne::MODE_DEBUG);

        echo $blade->run($viewName, $data);
    }
}