<?php

namespace App\apis\_auth\useCasesBase\refresh;

use App\apis\_auth\_shared\models\User;
use App\apis\_auth\useCasesBase\refresh\dto\RefreshAuthOutDTO;
use App\core\request\Request;

class RefreshAuthController
{
    private RefreshAuthService $service;

    public function __construct(RefreshAuthService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->service->execute($user));
    }
}
