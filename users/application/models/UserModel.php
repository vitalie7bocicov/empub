<?php

class UserModel {
    private $id;
    private $email;
    private $first_name;
    private $last_name;


    public function  __construct($id, $email, $first_name, $last_name) {
        $this->id = $id;
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function toJson() {
        $result = array();
        $result['id'] = $this->id;
        $result['email'] = $this->email;
        $result['first_name'] = $this->first_name;
        $result['last_name'] = $this->last_name;

        return $result;
    }

    public static function getUsers($dbConnection) {
    
        $sql = 'select * from users';
        $stmt = $dbConnection->prepare($sql);
        $result = array();
        $counter = 0;

        if($stmt -> execute()) {
            while($row = $stmt -> fetch()) {
                $mail = new UserModel($row['id'], $row['email'], $row['first_name'], $row['last_name']);
                $result[$counter] = $mail;
                $counter += 1;
            }
        }

        return $result;
    }

    public static function setF($dbConnection, $name, $email){
        $sql = 'update users set first_name = ? where email = ?';

        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($name,$email);
    
            if($stmt -> execute($paramsArray)) {
                $row = $stmt -> fetch();
                $settings = new UserModel($row['id'], $email, $row['first_name'], $row['last_name']);
            }
            
            return $settings;
    }

    public static function setL($dbConnection, $name, $email){
        $sql = 'update users set last_name = ? where email = ?';

        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($name,$email);
    
            if($stmt -> execute($paramsArray)) {
                $row = $stmt -> fetch();
                $settings = new UserModel($row['id'], $email, $row['first_name'], $row['last_name']);
            }
            
            return $settings;
    }


    public static function getProperties($dbConnection, $email){
       
            $sql = 'select * from users where email = ?';
    
            $stmt = $dbConnection->prepare($sql);
            $paramsArray = array($email);
    
            if($stmt -> execute($paramsArray)) {
                $row = $stmt -> fetch();
                $settings = new UserModel($row['id'], $email, $row['first_name'], $row['last_name']);
            }
            
            return $settings;
        
    }

    public static function create($dbConnection,$user){
        $sql = 'insert into users(email,first_name,last_name) values(?,?,?)';
        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($user->getEmail() , $user->getFirstName(), $user->getLastName());
        $stmt -> execute($paramsArray);
    }

    public static function delete($dbConnection, $email){
        $sql = 'delete from users where email = ?';
        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($email);
        $stmt -> execute($paramsArray);
    }
}