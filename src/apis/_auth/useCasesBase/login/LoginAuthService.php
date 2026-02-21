<?php

namespace App\apis\_auth\useCasesBase\login;

use App\apis\_auth\_shared\models\User;
use App\apis\_commons\services\jwt\JWTService;

class LoginAuthService
{
    private JWTService $jwtService;

    public function __construct(JWTService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function execute(string $email, string $password): array
    {
        $user = User::where('email', $email)->first();

        if (!$user || !password_verify($password, $user->password)) {
            return ['error' => 'Invalid credentials', 'status' => 401];
        }

        if (!$user->active) {
            return ['error' => 'Account not activated', 'status' => 403];
        }

        if ($user->blocked) {
            return ['error' => 'Account blocked', 'status' => 403];
        }

        $token = $this->jwtService->encode($user);

        return ['user' => $user, 'token' => $token];
    }
}
