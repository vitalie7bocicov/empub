<?php

class MailModel {
    private $id;
    private $sender;
    private $senderEmail;
    private $subject;
    private $publicationDate;
    private $expirationDate;
    private $isPublic;
    function __construct($id, $sender, $senderEmail, $subject, $isPublic, $publicationDate, $expirationDate) {
        $this->id = $id;
        $this->sender = $sender;
        $this->senderEmail = $senderEmail;
        $this->subject = $subject;
        $this->isPublic = $isPublic;
        $this->publicationDate = $publicationDate;
        $this->expirationDate = $expirationDate;
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

    public function toJson() {
        $result = array();
        $result['id'] = $this->id;
        $result['sender'] = $this->sender;
        $result['senderEmail'] = $this->senderEmail;
        $result['isPublic'] = $this->isPublic;
        $result['subject'] = $this->subject;
        $result['publicationDate'] = $this->publicationDate;
        $result['expirationDate'] = $this->expirationDate;

        return $result;
    }

    public static function getMails($dbConnection, $id, $orderBy) {
        $sql = 'select * from mails where user_id = ? order by ' . $orderBy;

        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($id);
        $result = array();
        $counter = 0;

        if($stmt -> execute($paramsArray)) {
            while($row = $stmt -> fetch()) {
                $mail = new MailModel($row['id'], $row['senderName'], $row['senderEmailAddress'], $row['subject'], $row['public'], $row['publication_date'], $row['expiration_date']);
                $result[$counter] = $mail;
                $counter += 1;
            }
        }

        return $result;
    }

    public static function getMailsPermission($dbConnection, $user_id, $isPublic, $orderBy) {
        $sql = 'select * from mails where user_id = ? and public = ? order by ' . $orderBy;

        $stmt = $dbConnection->prepare($sql);
        $paramsArray = array($user_id,$isPublic);
        $result = array();
        $counter = 0;

        if($stmt -> execute($paramsArray)) {
            while($row = $stmt -> fetch()) {
                $mail = new MailModel($row['id'], $row['senderName'], $row['senderEmailAddress'], $row['subject'], $row['public'], $row['publication_date'], $row['expiration_date']);
                $result[$counter] = $mail;
                $counter += 1;
            }
        }

        return $result;
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

}