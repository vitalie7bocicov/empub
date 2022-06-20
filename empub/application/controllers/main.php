<?php
class Main extends Controller
{
    public function index($userId='')
    {
        if(isset($_COOKIE['userId'])) {

            $_COOKIE['userId'] = '';
            setcookie('userId','',time()-6600);

        }

        if($userId !== '') {
            setcookie('userId', $userId);
        }
        echo $userId;
        $this->view('main');
    }

}