<?php
use function MongoDB\BSON\toJSON;
require './application/core/Controller.php';
require './application/core\BD.php';
require './application/models/StatisticContentModel.php';

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

    function getStatisticsForDay($id = ''){
        header('Content-type: application/json');
        $bd = new DB();

        $statisticContent = StatisticContentModel::getStatisticByDate($bd->getConnection(), $id, "day");
        $statisticContent = $statisticContent -> toJson();
        
        echo json_encode($statisticContent);
    }

    function getStatisticsForWeek($id = ''){
        header('Content-type: application/json');
        $bd = new DB();

        $statisticContent = StatisticContentModel::getStatisticByDate($bd->getConnection(), $id, "week");
        $statisticContent = $statisticContent -> toJson();
        
        echo json_encode($statisticContent);
    }

    function getStatisticsForMonth($id = ''){
        header('Content-type: application/json');
        $bd = new DB();

        $statisticContent = StatisticContentModel::getStatisticByDate($bd->getConnection(), $id, "month");
        $statisticContent = $statisticContent -> toJson();
        
        echo json_encode($statisticContent);
    }
   
}