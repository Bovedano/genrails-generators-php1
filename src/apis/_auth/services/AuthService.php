<?php

namespace App\apis\_auth\services;

use App\apis\_auth\models\User;
use App\apis\_commons\services\mail\MailService;
use App\apis\_commons\services\templates\TemplateService;

class AuthService
{
    private MailService $mailService;
    private TemplateService $templateService;

    public function __construct(MailService $mailService, TemplateService $templateService)
    {
        $this->mailService = $mailService;
        $this->templateService = $templateService;
    }

    public function register(array $data): User
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $user = User::create($data);

        $activationCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $html = $this->templateService->render('activation-code', [
            'appName'           => $_ENV['MAIL_FROM_NAME'],
            'userName'          => $user->name,
            'activationCode'    => $activationCode,
            'expirationMinutes' => '15',
        ]);

        $this->mailService->send($user->email, 'Activation Code', $html);

        return $user;
    }

    public function login(string $email, string $password): ?User
    {
        $user = User::where('email', $email)->first();

        if (!$user || !password_verify($password, $user->password)) {
            return null;
        }

        return $user;
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }
}
