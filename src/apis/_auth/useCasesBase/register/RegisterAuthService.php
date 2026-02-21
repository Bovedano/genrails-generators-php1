<?php

namespace App\apis\_auth\useCasesBase\register;

use App\apis\_auth\_shared\models\User;
use App\apis\_auth\_shared\services\ActivationMailService;

class RegisterAuthService
{
    private ActivationMailService $activationMailService;

    public function __construct(ActivationMailService $activationMailService)
    {
        $this->activationMailService = $activationMailService;
    }

    public function execute(array $data): User
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['active'] = false;
        $data['activation_code'] = $this->activationMailService->generateCode();

        $user = User::create($data);

        $this->activationMailService->sendActivationCode($user, $data['activation_code']);

        return $user;
    }
}
