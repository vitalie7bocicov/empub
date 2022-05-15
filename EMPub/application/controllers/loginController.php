<?php

require '../application/core/Controller.php';
require '../application/core/BD.php';
require '../application/util/Mail.php';

class Login extends Controller {
    
    public function index() {
        $this->view('loginview');
    }

    public function work() {
        if(!isset($_POST['email'])) {
            echo 'here you go';
        }
    
        $bd = new DB;
        $email = $_POST['email'];

        $paramsArray = array($email);

        $result = $bd->queryFind('select * from users where email = ?', $paramsArray);

        if(!$result) {

        } else {
            $user = $result['email'];
            $generatePass = $this->randomPassword();

            require '../application/views/passwordEmail.php';

            $mail = new Mail;

            $mailSend = $mail->sendMail($user, $str);
            if(!$mailSend) {

            }

            $hash = hash('sha256', $generatePass);
            $bd->updatePassword($user, $hash);
            setcookie('user', $user, time() + 180, './password');
            header('Location: ./password');
        }
    }

    public function password() {
        
        if(isset($_COOKIE['user'])) {
            $user = $_COOKIE['user'];
        }
        
        $data = array('user' => $user);
        $this->view('passwordView', $data);
    }

    public function verifyPassword() {

        if(!isset($_POST['email'])) {
            
        }

        if(!isset($_POST['password'])) {
            
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $bd = new DB;

        $sql = 'select * from users where email = ?';
        $data = array($email);
        $data = $bd->queryFind($sql, $data);
        
        $hash = hash('sha256', $password);

        if(strcmp($data['password'], $hash) == 0) {
            header('Location: /home');
        }
    }

    public static function randomPassword() {
        $charaters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = '';
        $length = strlen($charaters) - 1;
        
        for ($i = 0; $i < 20; $i++) {
            $password .= $charaters[random_int(0, $length)];
        }

        return $password; 
    }
}