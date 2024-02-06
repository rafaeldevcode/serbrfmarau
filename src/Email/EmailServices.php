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
     * @var string $email_to
     */
    private $email_to;

    /**
     * @since 1.1.0
     * 
     * @param string $body
     * @param string $subject
     * @param ?string $email_to
     * @return void
     */
    public function __construct(string $body, string $subject, ?string $email_to = null)
    {
        $this->body = $body;
        $this->subject = $subject;
        $this->email_to = is_null($email_to) ? env('SMTP_EMAIL_TO') : $email_to;
    }

    /**
     * @since 1.0.0
     * 
     * @return void
     */
    public function send(): void
    {
        if (env('SMTP_SERVICE') === 'true'):
            $mail = new PHPMailer(true);

            // $mail->SMTPDebug  = SMTP::DEBUG_SERVER;
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->isSMTP();
            $mail->Host = env('SMTP_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('SMTP_USERNAME');
            $mail->Password = env('SMTP_PASSWORD');
            $mail->Port = env('SMTP_PORT');

            $mail->setFrom(env('SMTP_EMAIL_FROM'));
            $mail->addAddress($this->email_to);

            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body = $this->body;
            $mail->AltBody = $this->body;
            $mail->CharSet = 'UTF-8';

            $mail->send();
        endif;
    }
}
