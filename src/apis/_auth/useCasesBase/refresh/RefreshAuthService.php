<?php

namespace App\apis\_auth\useCasesBase\refresh;

use App\apis\_auth\_shared\models\User;
use App\apis\_auth\useCasesBase\refresh\dto\RefreshAuthOutDTO;
use App\apis\_commons\services\jwt\JWTService;

class RefreshAuthService
{
    private JWTService $jwtService;

    public function __construct(JWTService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function execute(User $user): RefreshAuthOutDTO
    {
        $token = $this->jwtService->encode($user, refresh: true);
        return new RefreshAuthOutDTO(token: $token);
    }
}
