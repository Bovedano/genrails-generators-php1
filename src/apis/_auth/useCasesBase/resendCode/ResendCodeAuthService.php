<?php

namespace App\apis\_auth\useCasesBase\resendCode;

use App\apis\_auth\_shared\models\User;
use App\apis\_auth\_shared\services\ActivationMailService;

class ResendCodeAuthService
{
    private ActivationMailService $activationMailService;

    public function __construct(ActivationMailService $activationMailService)
    {
        $this->activationMailService = $activationMailService;
    }

    public function execute(string $email): bool
    {
        $user = User::where('email', $email)
            ->where('active', false)
            ->first();

        if (!$user) {
            return false;
        }

        $code = $this->activationMailService->generateCode();
        $user->activation_code = $code;
        $user->save();

        $this->activationMailService->sendActivationCode($user, $code);

        return true;
    }
}
