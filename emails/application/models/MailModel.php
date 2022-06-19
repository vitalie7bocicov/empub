<?php

use http\Exception\InvalidArgumentException;
class MailModel {
    private $id;
    private $sender;
    private $senderEmail;
    private $subject;
    private $publicationDate;
    private $expirationDate;
    private $isPublic;
    private $views;
    private $password;
    function __construct($id, $sender, $senderEmail, $subject, $isPublic, $publicationDate, $expirationDate, $views, $password) {
        $this->id = $id;
        $this->sender = $sender;
        $this->senderEmail = $senderEmail;
        $this->subject = $subject;
        $this->isPublic = $isPublic;
        $this->publicationDate = $publicationDate;
        $this->expirationDate = $expirationDate;
        $this->views = $views;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getSender() {
        return $this->sender;
    }

    public function getSenderEmail() {
        return $this->senderEmail;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getPublicationDate() {
        return $this->publicationDate;
    }

    public function getExpirationDate() {
        return $this->expirationDate;
    }

    public function getIsPublic() {
        return $this->IsPublic;
    }

    public function getViews() {
        return $this->views;
    }

    public function toJson() {
        $result = array();
        $result['id'] = $this->id;
        $result['sender'] = $this->sender;
        $result['senderEmail'] = $this->senderEmail;
        $result['isPublic'] = $this->isPublic;
        $result['subject'] = $this->subject;
        $result['publicationDate'] = $this->publicationDate;
        $result['expirationDate'] = $this->expirationDate;
        $result['views'] = $this->views;
        $result['password'] = $this->password;
        return $result;
    }

    public static function getFilter($filter){
        if($filter==="public")
            return 1;
        if($filter==="private")
            return 0;
        return  throw new \InvalidArgumentException("Filter by: ". $filter);
    }

    public static function getOrderBy($orderBy) {
        if($orderBy === "publication_date" || $orderBy==="views")
            return $orderBy ." desc";
        if($orderBy === "expiration_date")
            return $orderBy;
        throw new \InvalidArgumentException("Order by: " . $orderBy);
    }

    public static function getMails($dbConnection, $id, $filter, $orderBy, $query='') {
        try {
            $orderBy = MailModel::getOrderBy($orderBy);
        }
        catch(\InvalidArgumentException $e) {
            echo 'error caught';
        }
        
        if($filter==="all"){
            $sql = 'select * from mails where user_id = ? order by ' . $orderBy;
        }
        else{
            $filter = MailModel::getFilter($filter);
            $sql = 'select * from mails where user_id = ? and public='. $filter .' order by ' . $orderBy;
        }


        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($id);
        $result = array();
        $counter = 0;

        if($stmt -> execute($paramsArray)) {
            while($row = $stmt -> fetch()) {
                $mail = new MailModel($row['id'], $row['senderName'], $row['senderEmailAddress'], $row['subject'], $row['public'], $row['publication_date'], $row['expiration_date'], $row['views'], $row['PASSWORD'] );
                //if query is set and mail doesn't match the query - continue
                if($query!=='' && !MailModel::searchMail($mail,$query)){
                    continue;
                }
//                if mail is expired
                if(MailModel::checkExpirationDate($dbConnection, $id, $mail))
                    continue;
                $result[$counter] = $mail;
                $counter += 1;
            }
        }
        return $result;
    }

    public static function searchMail($mail, $query){
        $sender = mb_strtolower($mail->sender);
        $query = mb_strtolower($query);
        if (str_contains($sender, $query))
            return true;
        $subject = mb_strtolower($mail->subject);
        if(str_contains($subject, $query))
            return true;
        return false;
    }

    public static function checkExpirationDate($dbConnection, $id, $mail){
        date_default_timezone_set("Europe/Bucharest");
        $date = date('y-m-d H:i:s');

        $expDate = strtotime($mail->expirationDate);

        $expDate = date('y-m-d H:i:s',$expDate);

        if($date>$expDate){
            MailModel::deleteMail($dbConnection, $id, $mail->id);
            return true;
        }
        return false;
    }


    public static function getMail($dbConnection, $id) {
        $sql = 'select *  from mails where id=?';
        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($id);
       if($stmt -> execute($paramsArray)) {
            $row = $stmt -> fetch();
            $mail = new MailModel($row['id'], $row['senderName'], $row['senderEmailAddress'], $row['subject'], $row['public'], $row['publication_date'], $row['expiration_date'], $row['views'], $row['PASSWORD'] );
            return $mail;
       }
       return false;

    }

    public static function updateMail($dbConnection, $user_id, $id, $newExpirationDate, $isPublic, $password) {
        $sql = 'update mails set expiration_date=?, public=?, PASSWORD=? where user_id = ? and id=?';
        $stmt = $dbConnection->prepare($sql);
        if($password==="NULL")
            $password=NULL;
        else{
            $password = hash('sha256', $password);
        }
        $paramsArray = array($newExpirationDate, $isPublic, $password, $user_id, $id);

        if($stmt -> execute($paramsArray)) {
            return true;
        }
        return false;
    }

    public static function deleteMail($dbConnection, $user_id, $id) {
        $sql = 'delete from mails where user_id = ? and id=?';
        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($user_id, $id);

        if($stmt -> execute($paramsArray)) {
           return true;
        }
        return false;
    }

    public static function getLastMailId($dbConnection, $user_id) {
        $sql = 'select id from mails order by id desc LIMIT 1;';
        $stmt = $dbConnection->prepare($sql);
        if($stmt -> execute()) {
            $row = $stmt -> fetch();
            $id=$row['id'];
            return $id;
        }
        return false;

    }

}