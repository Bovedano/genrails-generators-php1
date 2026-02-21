<?php

namespace App\apis\_auth\_shared\services;

use App\apis\_auth\_shared\models\User;
use App\apis\_commons\services\mail\MailService;
use App\apis\_commons\services\templates\TemplateService;

class ActivationMailService
{
    private MailService $mailService;
    private TemplateService $templateService;

    public function __construct(MailService $mailService, TemplateService $templateService)
    {
        $this->mailService = $mailService;
        $this->templateService = $templateService;
    }

    public function generateCode(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function sendActivationCode(User $user, string $code): void
    {
        $html = $this->templateService->render('activation-code', [
            'appName'           => $_ENV['MAIL_FROM_NAME'],
            'userName'          => $user->name,
            'activationCode'    => $code,
            'expirationMinutes' => '15',
        ]);

        $this->mailService->send($user->email, 'Activation Code', $html);
    }
}
