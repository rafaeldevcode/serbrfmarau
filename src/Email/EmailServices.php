<?php

namespace Src\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailServices
{
    /**
     * @var string $name
     */
    private $body;

    /**
     * @var string $subject
     */
    private $subject;

    /**
     * @var array $email_to
     */
    private $emails_to;

    /**
     * @var PHPMailer $mail
     */
    private $mail;

    /**
     * @since 1.1.0
     * 
     * @param string $body
     * @param string $subject
     * @return void
     */
    public function __construct(string $body, string $subject)
    {
        $this->body = $body;
        $this->subject = $subject;
        $this->mail = new PHPMailer(true);
        $this->emails_to = [];
    }

    /**
     * @since 1.0.0
     * 
     * @param string $email
     * @return self
     */
    public function setEmailTo(string $email): self
    {
        array_push($this->emails_to, $email);

        return $this;
    }

    /**
     * @since 1.0.0
     * 
     * @return void
     */
    public function setAddress(): void
    {
        foreach($this->emails_to as $email):
            $this->mail->addAddress($email);
        endforeach;
    }

    /**
     * @since 1.0.0
     * 
     * @return void
     */
    public function send(): void
    {
        if (env('SMTP_SERVICE') === 'true'):
            // $this->mail->SMTPDebug  = SMTP::DEBUG_SERVER;
            // $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->isSMTP();
            $this->mail->Host = env('SMTP_HOST');
            $this->mail->SMTPAuth = true;
            $this->mail->Username = env('SMTP_USERNAME');
            $this->mail->Password = env('SMTP_PASSWORD');
            $this->mail->Port = env('SMTP_PORT');

            $this->mail->setFrom(env('SMTP_EMAIL_FROM'));
            $this->setAddress();

            $this->mail->isHTML(true);
            $this->mail->Subject = $this->subject;
            $this->mail->Body = $this->body;
            $this->mail->AltBody = $this->body;
            $this->mail->CharSet = 'UTF-8';

            $this->mail->send();
        endif;
    }
}
