<?php
class Main extends Controller
{
    public function index($userId='')
    {
        if(isset($_COOKIE['userId'])) {
            unset($_COOKIE['userId']);
        }
        if($userId !== '') {
            setcookie('userId', $userId);
        }
        $this->view('main');
    }

}