<?php

Class Controller {

    public static function view($view, $data = []) {
        require_once '../application/views/'. $view . '.php';
    }
}