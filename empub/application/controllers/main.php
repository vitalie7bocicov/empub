<?php
class Main extends Controller
{
    public function index($userId='')
    {
        //echo $_COOKIE['userId'];
        if(isset($_COOKIE['userId'])) {
            unset($_COOKIE['userId']);
        }

        if($userId !== '') {
            setcookie('userId', $userId, time() + 5);
        }

        //echo $_COOKIE['userId'];

        $this->view('main');
    }

}