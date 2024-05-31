<?php

require_once 'ProyectoFinal/vendor/PHPMailer/src/Exception.php';
require_once 'ProyectoFinal/vendor/PHPMailer/src/PHPMailer.php';
require_once 'ProyectoFinal/vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function sendEmail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'user@example.com';
            $mail->Password = 'secret';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "El mensaje no se pudo enviar. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

