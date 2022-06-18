<?php

require './application/models/User.php';
include_once '../libs/php-jwt/src/JWT.php';
include_once '../libs/php-jwt/src/Key.php';
include_once '../libs/php-jwt/src/ExpiredException.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use \Firebase\JWT\ExpiredException;

class App {
    protected $controller;
    protected $method = 'index';

    private $key = "privatekey";

    protected $params = [];

    function __construct() {
        $url = $this->parseUrl();

        $user = $this->parseJWT();
        if(!$user) {
            http_response_code(403);
            return;
        }

        if(file_exists('./application/controllers/'. $url[0] . 'Controller.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once('./application/controllers/'. $this->controller . 'Controller.php');

        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        
        $this->params = $url ? array_values($url) : [];
        
        $newObj = new $this->controller;
        $newObj->setUser($user);
        call_user_func_array([$newObj, $this->method], $this->params);
    }

    public function parseUrl() {
        $var =  explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
        return $var;
    }

    public function parseJWT() {
        $headers = apache_request_headers();
        $token = str_replace('Bearer', '', $headers['authorization']);
        trim($token);

        if(!$token) {
            http_response_code(403);
            return;
        }

        try {
            $token1 = JWT::decode(trim($token, ' '), new Key($this->key, 'HS512'));

            $user = new User($token1->data->id, $token1->data->name);
            return $user;
        }
        catch(ExpiredException $e1) { 
            http_response_code('403');
            return false;
        }
        catch(UnexpectedValueException $e) {
            http_response_code(403);
            return false;
        }
    }
} 