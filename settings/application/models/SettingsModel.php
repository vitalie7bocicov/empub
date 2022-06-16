<?php

class SettingsModel {
    private $id;
    private $email;
    private $fname;
    private $lname;


    public function  __construct($id, $email, $fname, $lname) {
        $this->id = $id;
        $this->email = $email;
        $this->fname = $fname;
        $this->lname = $lname;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFname() {
        return $this->fname;
    }

    public function getLname() {
        return $this->lname;
    }

    public function toJson() {
        $result = array();
        $result['id'] = $this->id;
        $result['email'] = $this->email;
        $result['fname'] = $this->fname;
        $result['lname'] = $this->lname;

        return $result;
    }

    public static function setF($dbConnection, $name, $email){
        $sql = 'update users set first_name = ? where email = ?';

        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($name,$email);
    
            if($stmt -> execute($paramsArray)) {
                $row = $stmt -> fetch();
                $settings = new SettingsModel($row['id'], $email, $row['first_name'], $row['last_name']);
            }
            
            return $settings;
    }

    public static function setL($dbConnection, $name, $email){
        $sql = 'update users set last_name = ? where email = ?';

        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($name,$email);
    
            if($stmt -> execute($paramsArray)) {
                $row = $stmt -> fetch();
                $settings = new SettingsModel($row['id'], $email, $row['first_name'], $row['last_name']);
            }
            
            return $settings;
    }

    public static function getProperties($dbConnection, $email){
       
            $sql = 'select * from users where email = ?';
    
            $stmt = $dbConnection->prepare($sql);
            $paramsArray = array($email);
    
            if($stmt -> execute($paramsArray)) {
                $row = $stmt -> fetch();
                $settings = new SettingsModel($row['id'], $email, $row['first_name'], $row['last_name']);
            }
            
            return $settings;
        

    }
}