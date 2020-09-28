<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

Class Email{

    private $mailer;
    public function __construct($host, $username, $password, $name){   
    
            $this->mailer = new PHPMailer;
            //Server settings
            $this->mailer->isSMTP();                                            // Send using SMTP
            $this->mailer->Host       = $host;                    // Set the SMTP server to send through
            $this->mailer->SMTPAuth   =  true;                                   // Enable SMTP authentication
            $this->mailer->Username   = $username;                     // SMTP username
            $this->mailer->Password   = $password;                               // SMTP password
            $this->mailer->SMTPSecure = 'ssl';        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->mailer->Port       =  465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $this->mailer->setFrom($username, $name);
            $this->mailer->CharSet = 'UTF-8';

    }

    public function setAddress($email, $name){
        $this->mailer->addAddress($email, $name);
    }

    public function formatEmail($info){
        $this->mailer->Subject = $info['subject'];
        $this->mailer->Body = $info['body'];
        $this->mailer->AltBody = strip_tags($info['body']);
    }

    public function sendEmail(){
        try{
            $this->mailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>