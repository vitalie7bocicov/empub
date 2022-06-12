<?php

require '../application/core/Controller.php';
require '../application/core/BD.php';
require '../application/util/Mail.php';
require '../application/models/User.php';

include_once '../../libs/php-jwt/src/BeforeValidException.php';
include_once '../../libs/php-jwt/src/ExpiredException.php';
include_once '../../libs/php-jwt/src/SignatureInvalidException.php';
include_once '../../libs/php-jwt/src/JWT.php';

use \Firebase\JWT\JWT;


class Login extends Controller {

    private $key = "privatekey";
    
    public function generatePasswordandSendEmail() {
        $json = trim(file_get_contents('php://input'));

        $obj = json_decode($json);
        if($obj == null) {
            http_response_code(404);
            echo 'User is not set';
            return;
        }
        $email = $obj->email;
    
        $bd = new DB;
        if($email) {
            $paramsArray = array($email);
            $user = User::findByEmail($bd->getConnection(), $paramsArray);

            if($user == false) {
                http_response_code(400);
                echo 'User not found in data base';
                return;
            }
        }

        header('Content-type: application/json');

        $resposeObj = array('respose' => false);
        $generatePass = $this->randomPassword();

        require '../application/views/passwordEmail.php';

        $data = array('user' => $user->getEmail());
        $hash = hash('sha256', $generatePass);
        
        if(!$user->updatePassword($bd->getConnection(), $hash)) {
            http_response_code(400);
            echo json_encode($resposeObj);
            return;
        }

        $mail = new Mail;
        $mailSend = $mail->sendMail($user->getEmail(), $str);

        if(!$mailSend) {
            http_response_code(400);
            echo json_encode($resposeObj);
            return;
        }

        $resposeObj['respose'] = true;
        echo json_encode($resposeObj);
    }

    public function verifyPassword() {
        $json = trim(file_get_contents('php://input'));

        $obj = json_decode($json);
        $email = $obj->email;
        $password = $obj->password;
        
        $bd = new DB;


        $paramsArray = array($email);
        $user = User::findByEmail($bd->getConnection(), $paramsArray);
        header('Content-type: application/json');
        $resposeObj = array('respose' => false);

        if(!$user) {
            //http_response_code(400);
            $resposeObj['respose'] = 'Can not find user';
            echo json_encode($resposeObj);
            return;
        }
        
        $hash = hash('sha256', $password);
        if(!$user->passwordMatching($bd->getConnection(), $hash)) {
            //http_response_code(400);
            $resposeObj['respose'] = 'Passwords don\'t match';
            echo json_encode($resposeObj);
            return;
        }

        $resposeObj['respose'] = true;
        
        $iat = time();
        $exp = $iat + 60 * 60;
        $payload = array(
            'iat' => $iat,
            'exp' => $exp,
            'data' => array(
                'id' => $user->getUserId(),
                'name' => $user->getEmail()
            )
        );

        $jwt = JWT::encode($payload, $this->key, 'HS512');
        $resposeObj['respose'] = array('token' => $jwt);

        echo json_encode($resposeObj);
    }

    public function verifyEmail($email = '') {
        $db = new DB;
        header('Content-type: application/json');

        $resposeObj = array('respose' => false);
        $paramsArray = array($email);

        $user = User::findByEmail($db->getConnection(), $paramsArray);

        if($user) {
            $resposeObj['respose'] = array('user_id' => $user->getUserId(), 'email' => $user->getEmail());
        }

        setcookie('email', $user->getEmail(),  time() + 300, '/empub/public/login/password');
        echo json_encode($resposeObj);
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