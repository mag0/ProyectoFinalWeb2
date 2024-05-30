<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'ProyectoFinal/vendor/PHPMailer/src/Exception.php';
require 'ProyectoFinal/vendor/PHPMailer/src/PHPMailer.php';
require 'ProyectoFinal/vendor/PHPMailer/src/SMTP.php';

class Mailer {
    public function sendEmail($to, $subject, $body) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.example.com';     // Configura tu host SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = 'user@example.com';     // Configura tu usuario SMTP
            $mail->Password   = 'secret';               // Configura tu contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Destinatarios
            $mail->setFrom('from@example.com', 'Mailer'); // Configura tu dirección de envío y nombre
            $mail->addAddress($to);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            return 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            return "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        } catch (\Exception $e) {
            return "El mensaje no pudo ser enviado. Error inesperado: {$e->getMessage()}";
        }
    }
}
