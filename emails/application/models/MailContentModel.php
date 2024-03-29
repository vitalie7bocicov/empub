<?php

class MailContentModel {
    private $id;
    private $plainText;
    private $htmlText;
    private $mailId;


    public function  __construct($id, $plainText, $htmlText, $mailId) {
        $this->id = $id;
        $this->plainText = $plainText;
        $this->htmlText = $htmlText;
        $this->mailId = $mailId;
    }

    public function getId() {
        return $this->id;
    }

    public function getPlainText() {
        return $this->plainText;
    }

    public function getHtml() {
        return $this->htmlText;
    }

    public function getMailId() {
        return $this->mailId;
    }

    public function toJson() {
        $result = array();
        $result['id'] = $this->id;
        $result['plainText'] = $this->plainText;
        $result['htmlText'] = $this->htmlText;
        $result['mailId'] = $this->mailId;

        return $result;
    }
    public static function getMail($dbConnection, $id) {
        $sql = 'select * from mail_contents where mail_id = ?';

        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($id);

        if($stmt -> execute($paramsArray)) {
            $row = $stmt -> fetch();
            $mailContent = new MailContentModel($row['id'], $row['plainText'], $row['htmlText'], $row['mail_id']);
        }
        return $mailContent;
    }

    public static function getMailWithPassword($dbConnection, $id, $password) {
        $sql1 = 'select public, PASSWORD from mails where id = ?';
        $mailStmt = $dbConnection->prepare($sql1);
        $paramsArray = array($id);
        

        if($mailStmt -> execute($paramsArray)) {
            $row = $mailStmt -> fetch();

            if($row['public'] === 0) {

    
                if($password === null)
                    return null;

                $hash = hash('sha256', $password);

                if($hash !== $row['PASSWORD']) {
                    return null;
                }
            }
        }
        else {
            return null;
        }
        
        $sql = 'select * from mail_contents where mail_id = ?';

        $stmt = $dbConnection->prepare($sql);

        if($stmt -> execute($paramsArray)) {
            $row = $stmt -> fetch();
            $mailContent = new MailContentModel($row['id'], $row['plainText'], $row['htmlText'], $row['mail_id']);
        }
        return $mailContent;
    }
}