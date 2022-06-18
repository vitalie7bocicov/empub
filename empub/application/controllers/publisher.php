<?php

class Publisher extends Controller
{
    public function index($userId = '')
    {
        setcookie('userId', $userId);
        $this->view('publisherPage');
    }

}