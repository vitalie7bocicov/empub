<?php
use function MongoDB\BSON\toJSON;
require './application/core/Controller.php';
require './application/core/BD.php';
require './application/models/UserModel.php';

class Users extends Controller {

    function index() {
        header('Content-type: application/json');
        $query = $this->getQuery();
        $bd = new DB();
        $users = UserModel::getUsers($bd->getConnection(), $query);
        $response = array();
        $counter = 0;
        foreach($users as $userVar) {
            $user = $userVar -> toJson();
            $response[$counter] = $user;
            $counter += 1;
        }

        echo json_encode($response);
    }

    function getProperties($account = ''){
        header('Content-type: application/json');
        $bd = new DB();

        $settings = UserModel::getProperties($bd->getConnection(),$account); 
        $settings = $settings-> toJson();
        echo json_encode($settings);
    }

    function setFname($name = '', $email){
        header('Content-type: application/json');
        $bd = new DB();

        $settings = UserModel::setF($bd->getConnection(),$name, $email); 
        $settings = $settings-> toJson();
        echo json_encode($settings);
    }

    function setLname($name = '', $email){
        header('Content-type: application/json');
        $bd = new DB();

        $settings = UserModel::setL($bd->getConnection(),$name,$email); 
        $settings = $settings-> toJson();
        echo json_encode($settings);
    }


    function createUser($email,$fname,$lname){
        $bd = new DB();
        UserModel::create($bd->getConnection(),$email,$fname,$lname);
    }

  function deleteUser($id){
      $bd = new DB();
      UserModel::delete($bd->getConnection(),$id);
    }


    function getQuery(){
        $headers = apache_request_headers();
        return $headers['searchquery'];
    }
   
}
