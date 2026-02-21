<?php

namespace App\apis\_auth\useCasesBase\activate;

use App\apis\_auth\_shared\models\User;
use App\apis\_commons\services\jwt\JWTService;

class ActivateAuthService
{
    private JWTService $jwtService;

    public function __construct(JWTService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function execute(string $email, string $code): ?array
    {
        $user = User::where('email', $email)
            ->where('activation_code', $code)
            ->where('active', false)
            ->first();

        if (!$user) {
            return null;
        }

        $user->active = true;
        $user->activation_code = null;
        $user->save();

        $token = $this->jwtService->encode($user);

        return ['user' => $user, 'token' => $token];
    }
}
