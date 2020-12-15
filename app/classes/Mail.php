<?php


namespace App\classes;


use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->setUp();
    }

    public function setUp(){
        $this->mail->SMTPDebug =2; // Mail Cre
        $this->mail->isSMTP();
        $this->mail->Host = getenv("SMTP_HOST");
        $this->mail->SMTPAuth = true;
        $this->mail->Username = getenv("EMAIL_USERNAME");
        $this->mail->Password = getenv("EMAIL_PASSWORD");
        $this->mail->Port = getenv("SMTP_PORT");

    }
}
