<?php



class App {
    protected $controller = 'login';
    protected $method = 'index';

    protected $params = [];

    function __construct() {
        $url = $this->parseUrl();

        if(file_exists('../application/controllers/'. $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once('../application/controllers/'. $this->controller . '.php');


        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $this->parseParams();
        $newObj = new $this->controller;
        call_user_func_array([$newObj, $this->method], $this->params);
    }

    public function parseParams(){
        if(!empty($url)){
            return array_values($url);
        }
        if(isset($_POST['email'])){
            return [$_POST['email']];
        }
        return [];
    }

    public function parseUrl() {

        if(isset($_GET['url']))
        {
            return $url =  explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
        }
    }
} 