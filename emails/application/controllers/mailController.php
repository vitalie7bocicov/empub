<?php
use function MongoDB\BSON\toJSON;

require 'C:\xampp\htdocs\TehnologiiWeb\emails\application\core\Controller.php';
require 'C:\xampp\htdocs\TehnologiiWeb\emails\application\core\BD.php';
require 'C:\xampp\htdocs\TehnologiiWeb\emails\application\models\MailModel.php';
require 'C:\xampp\htdocs\TehnologiiWeb\emails\application\models\MailContentModel.php';
class Mail extends Controller {
    function index($email = '') {
        header('Content-type: application/json');
        $orderBy = $this->getOrderBy();
        if($email == '') {
            $email = $this->user->getName();
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            return;
        }

        $bd = new DB();
        $mails = MailModel::getMails($bd->getConnection(), $this->user->getId(), $orderBy);
        $response = array();
        $counter = 0;
        foreach($mails as $mailVar) {
            $mail = $mailVar -> toJson();
            $response[$counter] = $mail;
            $counter += 1;
        }

        echo json_encode($response);
    }

    function getPermission(){
        $headers = apache_request_headers();
        if($headers['permission']==="true")
            return 1;
        return 0;
    }

    function getOrderBy(){
        $headers = apache_request_headers();
        return $headers['orderby'];
    }

    function getFilteredMails($email = '' )
    {
        header('Content-type: application/json');
        $isPublic = $this->getPermission();
        $orderBy = $this->getOrderBy();
        if($email == '') {
            $email = $this->user->getName();
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            return;
        }
        $bd = new DB();
        $mails = MailModel::getMailsPermission($bd->getConnection(), $this->user->getId(), $isPublic, $orderBy);
        $response = array();
        $counter = 0;
        foreach($mails as $mailVar) {
            $mail = $mailVar -> toJson();
            $response[$counter] = $mail;
            $counter += 1;
        }
        echo json_encode($response);
    }

    function getMailContentByID($id = '') {
        header('Content-type: application/json');
        $bd = new DB();
        $mailContent = MailContentModel::getMail($bd->getConnection(), $id);
        $mailContent = $mailContent -> toJson();
        
        echo json_encode($mailContent);
    }

    function getMailByID($id = '') {
        $bd = new DB();
        $response = MailModel::getMail($bd->getConnection(),$this->user->getId(), $id);
        if($response)
        {
            http_response_code(200);
            return;
        }
        http_response_code(400);
        echo $response;
    }

    function deleteMailByID($id = '') {
        $bd = new DB();
        $response = MailModel::deleteMail($bd->getConnection(),$this->user->getId(), $id);
        if($response)
        {
            http_response_code(200);
            return;
        }
        http_response_code(400);
        echo $response;
    }
}