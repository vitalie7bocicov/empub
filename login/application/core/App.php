<?php

class App {
    protected $controller;
    protected $method = 'index';

    protected $params = [];

    function __construct() {
        $url = $this->parseUrl();

        if(file_exists('../application/controllers/'. $url[0] . 'Controller.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once('../application/controllers/'. $this->controller . 'Controller.php');

        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        
        $newObj = new $this->controller;
        call_user_func_array([$newObj, $this->method], $this->params);
    }

    public function parseUrl() {
        $var =  explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
        return $var;
    }
} 