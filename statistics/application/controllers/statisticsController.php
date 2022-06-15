<?php
use function MongoDB\BSON\toJSON;
require 'C:\xampp\htdocs\TehnologiiWeb\statistics\application\core\Controller.php';
require 'C:\xampp\htdocs\TehnologiiWeb\statistics\application\core\BD.php';
require 'C:\xampp\htdocs\TehnologiiWeb\statistics\application\models\StatisticContentModel.php';

class Statistics extends Controller {

    function updateStatisticsForMail($id = ''){
        header('Content-type: application/json');
        $bd = new DB();
        $statisticContent = StatisticContentModel::setStatistic($bd->getConnection(), $id, $this->user->get_country('79.115.80.123'));
        $statisticContent = $statisticContent-> toJson();
        echo json_encode($statisticContent);
    }

    function getMailStatisticsByMailID($id = '') {
        header('Content-type: application/json');
        $bd = new DB();
        $statisticContent = StatisticContentModel::getStatistic($bd->getConnection(), $id);
        $statisticContent = $statisticContent -> toJson();
        
        echo json_encode($statisticContent);
    }
   
}