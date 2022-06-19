<?php
class Main extends Controller
{
    public function index($userId='')
    {
        if($userId !== null)
            setcookie('userId', $userId);
        $this->view('main');
    }

}