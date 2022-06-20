<?php

class StatisticContentModel {
    private $id;
    private $country;
    private $viewDate;
    private $mailId;


    public function  __construct($id, $country, $viewDate, $mailId) {
        $this->id = $id;
        $this->country = $country;
        $this->viewDate = $viewDate;
        $this->mailId = $mailId;
    }

    public function getId() {
        return $this->id;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getViewDate() {
        return $this->viewDate;
    }

    public function getMailId() {
        return $this->mailId;
    }

    public function toJson() {
        $result = array();
        $result['id'] = $this->id;
        $result['country'] = $this->country;
        $result['viewDate'] = $this->viewDate;
        $result['mailId'] = $this->mailId;

        return $result;
    }

    public static function setStatistic($dbConnection,$id,$country){


        $viewDate = date("Y-m-d");
        $sql = 'insert into statistics(country,mail_id,view_date) values(?,?,?)';
        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($country,$id,$viewDate);
        $stmt -> execute($paramsArray);
        $statistic = StatisticContentModel::getStatistic($dbConnection,$id);

        //---------------

        $sql2 = 'select * from countries where mail_id = ? and country = ?';

        $stmt2 = $dbConnection->prepare($sql2);
        $paramsArray2 = array($id, $country);

        if($stmt2 -> execute($paramsArray2)) {
            $row = $stmt2 -> fetch();
            $statisticContent = new StatisticContentModel($row['id'], $row['country'],$row['view_date'],$row['mail_id']);
        }



        //--------------
        if($statisticContent->getCountry() == NULL){
            $sql1 = 'insert into countries(country,mail_id) values(?,?)';
            $stmt1 = $dbConnection->prepare($sql1);
            $paramsArray1 = array($country,$id);
            $stmt1 -> execute($paramsArray1);
        }

        //---------------

        $sql3 = 'update mails set views = (select count(*) from statistics where mail_id= ?) where id = ?;';
        $stmt3 = $dbConnection->prepare($sql3);
        $paramsArray3 = array($id,$id);
        $stmt3 ->execute($paramsArray3);

        return $statistic;


    }
    public static function getStatisticByDate($dbConnection, $id, $type) {
    
        if($type == "day"){
            $sql = 'select * from statistics where mail_id = ? and view_date >= (?)';
            $stmt = $dbConnection->prepare($sql);
            $paramsArray = array($id,date("Y-m-d"));
        }
        else if($type == "week"){
            $sql = 'select * from statistics where mail_id = ? and DATEDIFF(?, view_date) <=7';
            $stmt = $dbConnection->prepare($sql);
            $paramsArray = array($id,date("Y-m-d"));
        }
          else if($type == "month"){
            $sql = 'select * from statistics where mail_id = ? and DATEDIFF(?, view_date) <=31';
            $stmt = $dbConnection->prepare($sql);
            $paramsArray = array($id,date("Y-m-d"));
          }

        $sql2 = 'select * from countries where mail_id = ?';

        $stmt2 = $dbConnection->prepare($sql2);
        $paramsArray1 = array($id);

        if($stmt -> execute($paramsArray) && $stmt2 ->execute($paramsArray1)) {
            $countryArray = array();
            $viewsArray = array();

            while($row2 = $stmt2 -> fetch()){
           
              
            $country = $row2['country'];
            $viewsArray[$row2['country']] = 0;
            array_push($countryArray,$country);
          }

            while($row = $stmt -> fetch()){

               
                $viewsArray[$row['country']]++;
                
            
            }

            $viewsArray2 = array(); 

            foreach($viewsArray as $view){
              array_push($viewsArray2,$view);
            }


         $statisticContent = new StatisticContentModel($row['id'], $countryArray, $viewsArray2, $row['mail_id']);


        return $statisticContent;
      }
  }

    public static function getStatistic($dbConnection, $id) {
        $sql = 'select * from statistics where mail_id = ?';

        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($id);

        $sql2 = 'select * from countries where mail_id = ?';

        $stmt2 = $dbConnection->prepare($sql2);

        if($stmt -> execute($paramsArray) && $stmt2 ->execute($paramsArray)) {
            $countryArray = array();
            $viewsArray = array();

            while($row2 = $stmt2 -> fetch()){
           
              
            $country = $row2['country'];
            array_push($countryArray,$country);
          }

            while($row = $stmt -> fetch()){

               
                $viewsArray[$row['country']]++;
                
            
            }

            $viewsArray2 = array(); 

            foreach($viewsArray as $view){
              array_push($viewsArray2,$view);
            }


         $statisticContent = new StatisticContentModel($row['id'], $countryArray, $viewsArray2, $row['mail_id']);


        return $statisticContent;
    }
   } 
}