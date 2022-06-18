<?php

class UserModel {
    private $id;
    private $email;
    private $first_name;
    private $last_name;
    private $nr_publications;

    public function  __construct($id, $email, $first_name, $last_name, $nr_publications) {
        $this->id = $id;
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->nr_publications = $nr_publications;
    }



    public function toJson() {
        $result = array();
        $result['id'] = $this->id;
        $result['email'] = $this->email;
        $result['first_name'] = $this->first_name;
        $result['last_name'] = $this->last_name;
        $result['nr_publications'] = $this->nr_publications;
        return $result;
    }

    public static function getUsers($dbConnection,  $query='') {
    
        $sql = 'select users.id,email,first_name,last_name,count(mails.id) nr_publications from users left join mails on users.id=mails.user_id group by users.id;';
        $stmt = $dbConnection->prepare($sql);
        $result = array();
        $counter = 0;

        if($stmt -> execute()) {
            while($row = $stmt -> fetch()) {
                $user = new UserModel($row['id'], $row['email'], $row['first_name'], $row['last_name'], $row['nr_publications']);

                if($query!=='' && !UserModel::searchUser($user,$query)){
                    continue;
                }

                $result[$counter] = $user;
                $counter += 1;
            }
        }

        return $result;
    }

    public static function searchUser($user, $query){
        $email = mb_strtolower($user->email);
        $query = mb_strtolower($query);
        if (str_contains($email, $query))
            return true;
        $first_name = mb_strtolower($user->first_name);
        if(str_contains($first_name, $query))
            return true;
        $last_name = mb_strtolower($user->last_name);
        if(str_contains($last_name, $query))
            return true;
        return false;
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

   public static function delete($dbConnection, $id){
        $sql = 'delete from users where id = ?';
        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($id);
        $stmt -> execute($paramsArray);
    }
}
