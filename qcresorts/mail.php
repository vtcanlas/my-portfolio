<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function writeEmail($receiver,$emailsubject,$emailbody) {
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {

        //SERVER SETTINGS
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'qcresorts@gmail.com';
        $mail->Password = 'tmdzfnlaoqphoabe';

        //Recipients
        $mail->SetFrom('qcresorts@gmail.com');
        $mail->AddAddress($receiver);

        //Content
        $mail->Subject = $emailsubject;
        $mail->Body = $emailbody;
        
        $mail->Send();
        echo 'Message has been sent';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


?>