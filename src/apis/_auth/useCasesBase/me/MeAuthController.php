<?php

namespace App\apis\_auth\useCasesBase\me;

use App\apis\_auth\_shared\models\User;
use App\apis\_auth\useCasesBase\me\dto\MeAuthOutDTO;
use App\core\request\Request;

class MeAuthController
{
    public function __invoke(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        echo json_encode(MeAuthOutDTO::fromModel($user));
    }
}
