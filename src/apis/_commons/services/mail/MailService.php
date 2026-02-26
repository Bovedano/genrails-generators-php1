<?php

namespace App\apis\_commons\services\mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\logs\Logger;

class MailService
{
    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $encryption;
    private string $fromAddress;
    private string $fromName;

    public function __construct(
        string $host,
        int $port,
        string $username,
        string $password,
        string $encryption,
        string $fromAddress,
        string $fromName
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->encryption = $encryption;
        $this->fromAddress = $fromAddress;
        $this->fromName = $fromName;
    }

    /**
     * @param string[] $cc
     * @param string[] $bcc
     */
    public function send(
        string $to,
        string $subject,
        string $body,
        bool $isHtml = true,
        array $cc = [],
        array $bcc = []
    ): void {
        $this->sendToMany([$to], $subject, $body, $isHtml, $cc, $bcc);
    }

    /**
     * @param string[] $to
     * @param string[] $cc
     * @param string[] $bcc
     */
    public function sendToMany(
        array $to,
        string $subject,
        string $body,
        bool $isHtml = true,
        array $cc = [],
        array $bcc = []
    ): void {
        $mail = $this->createMailer();

        try {
            $mail->setFrom($this->fromAddress, $this->fromName);

            foreach ($to as $address) {
                $mail->addAddress($address);
            }
            foreach ($cc as $address) {
                $mail->addCC($address);
            }
            foreach ($bcc as $address) {
                $mail->addBCC($address);
            }

            $mail->isHTML($isHtml);
            $mail->Subject = $subject;
            $mail->Body = $body;

            if ($isHtml) {
                $mail->AltBody = strip_tags($body);
            }

            $mail->send();

            Logger::channel('app')->info('Mail sent', [
                'to' => $to,
                'subject' => $subject,
            ]);
        } catch (Exception $e) {
            Logger::channel('app')->error('Mail send failed', [
                'to' => $to,
                'subject' => $subject,
                'error' => $mail->ErrorInfo,
            ]);

            throw new MailException("Mail send failed: {$mail->ErrorInfo}", 0, $e);
        }
    }

    private function createMailer(): PHPMailer
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->encryption;
        $mail->Port = $this->port;
        $mail->CharSet = 'UTF-8';
        $mail->Timeout = 10;

        return $mail;
    }
}
