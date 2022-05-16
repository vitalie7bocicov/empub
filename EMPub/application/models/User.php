<?php

class User {
    private $user_id;
    private $email;

    function __construct($user_id, $email) {
        $this->user_id = $user_id;
        $this->email = $email;
    }

    public static function findByEmail($dbConnection, $params = []) {
        $sql = 'select user_is, email from users where email = ?';
        $prepareStatemnt =  $dbConnection->prepare($sql);

        if($prepareStatemnt->execute($params)) {
            if($row = $prepareStatemnt -> fetch()) {
                $user = new User($row['user_is'], $row['email']);
                return $user;
            }
        
        }

        return false;
    }

    public function updatePassword($dbConnection, $password) {
        $sql = 'update users set password = ? where email = ?';

        $prepareStatemnt = $dbConnection->prepare($sql);

        $array = array($password, $this->email);
        if($prepareStatemnt->execute($array)) {
            return true;
        }

        return false;
    }

    public function passwordMatching($dbConnection, $password) {
        $sql = 'select password from users where user_is = ?';

        $prepareStatemnt = $dbConnection->prepare($sql);
        $array = array($this->user_id);
        if($prepareStatemnt->execute($array)) {
            if($row = $prepareStatemnt -> fetch()) {
                $actualPassword = $row['password'];

                if(strcmp($actualPassword, $password) == 0) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getUserId() {
        return  $this->user_id;
    }

    public function getEmail() {
        return  $this->email;
    }
}