<?php 

require '../application/includes/Exception.php';
require '../application/includes/PHPMailer.php';
require '../application/includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {

    public function sendMail($to, $message) {
        $mail = new PHPMailer();
        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
        $mail-> isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = 'true';
        $mail->SMTPSecure = 'tls';
        $mail->Port = '587';
        $mail->Username = 'empub.send@gmail.com';
        $mail->Password = 'ozuyrflqalpjixtk';
        $mail->Subject = 'Temporary Password for EMPub Application';
        $mail->setFrom('empub.send@gmail.com', 'Empub Publication');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Body = $message;
        

        if($mail->send()) {
            return true;
        }
        else {
            return false;
        }
    }
}