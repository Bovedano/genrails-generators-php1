<?php

namespace App\apis\_auth\useCasesBase\register;

use App\apis\_auth\useCasesBase\register\dto\RegisterAuthInDTO;
use App\apis\_auth\useCasesBase\register\dto\RegisterAuthOutDTO;
use App\core\request\Request;

class RegisterAuthController
{
    private RegisterAuthService $service;

    public function __construct(RegisterAuthService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request): void
    {
        header('Content-Type: application/json');
        $data = $request->getBody();

        $errors = RegisterAuthValidation::validate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = RegisterAuthInDTO::fromArray($data);
        $user = $this->service->execute($dto->toArray());

        http_response_code(201);
        echo json_encode(RegisterAuthOutDTO::fromModel($user));
    }
}
