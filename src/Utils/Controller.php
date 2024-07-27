<?php

namespace App\Utils;

use eftec\bladeone\BladeOne;

class Controller {
    protected $session;
    protected $model;
    protected $request;
    protected $url;

    public function __construct() {
        $this->session = new Session;
        $this->model = new Model;
        $this->request = new Request();
        $this->url = new Url;
    }

    protected function loadView($viewName, $data = []) {
        $blade = new BladeOne(VIEW_PATH, VIEW_CACHE_PATH, BladeOne::MODE_DEBUG);

        echo $blade->run($viewName, $data);
    }
}