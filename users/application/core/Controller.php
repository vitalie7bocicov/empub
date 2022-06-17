<?php

class Controller {
    protected $user;

    public function __construct() {
    }

    public function setUser($user) {
        $this->user = $user;
    }
}