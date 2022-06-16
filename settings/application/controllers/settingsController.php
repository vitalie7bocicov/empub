<?php
use function MongoDB\BSON\toJSON;
require 'C:\xampp\htdocs\TehnologiiWeb\settings\application\core\Controller.php';
require 'C:\xampp\htdocs\TehnologiiWeb\settings\application\core\BD.php';
require 'C:\xampp\htdocs\TehnologiiWeb\settings\application\models\SettingsModel.php';

class Settings extends Controller {

    function getProperties($account = ''){
        header('Content-type: application/json');
        $bd = new DB();

        $settings = SettingsModel::getProperties($bd->getConnection(),$account); 
        $settings = $settings-> toJson();
        echo json_encode($settings);
    }

    function setFname($name = '', $email){
        header('Content-type: application/json');
        $bd = new DB();

        $settings = SettingsModel::setF($bd->getConnection(),$name, $email); 
        $settings = $settings-> toJson();
        echo json_encode($settings);
    }

    function setLname($name = '', $email){
        header('Content-type: application/json');
        $bd = new DB();

        $settings = SettingsModel::setL($bd->getConnection(),$name,$email); 
        $settings = $settings-> toJson();
        echo json_encode($settings);
    }
   
}