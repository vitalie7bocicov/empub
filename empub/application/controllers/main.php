<?php
class Main extends Controller
{
    public function index($userId='')
    {
        setcookie('userId', $userId);
        $this->view('main');
    }

}