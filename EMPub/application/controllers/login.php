<?php


class Login extends Controller {
    
    public function index() {
       $this->view('login');
    }

    public function password($email = ''){
        $user = $this->model('User');
        $user->setEmail($email);
        $this->view('password', ['user' => $user->getEmail()]);
    }

}