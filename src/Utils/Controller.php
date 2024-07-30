<?php

namespace App\Utils;

use eftec\bladeone\BladeOne;

class Controller {
    protected $session;
    protected $model;
    protected $request;
    protected $url;
    protected $validator;

    public function __construct() {
        $this->session = Session::getInstance();
        $this->model = new Model;
        $this->request = Request::getInstance();
        $this->url = Url::getInstance();
        $this->validator = new Validator;
    }

    protected function loadView($viewName, $data = []) {
        $blade = new BladeOne(VIEW_PATH, VIEW_CACHE_PATH, BladeOne::MODE_DEBUG);

        echo $blade->run($viewName, $data);
    }
}