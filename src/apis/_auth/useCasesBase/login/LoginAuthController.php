<?php

namespace App\apis\_auth\useCasesBase\login;

use App\apis\_auth\useCasesBase\login\dto\LoginAuthInDTO;
use App\apis\_auth\useCasesBase\login\dto\LoginAuthOutDTO;
use App\core\request\Request;

class LoginAuthController
{
    private LoginAuthService $service;

    public function __construct(LoginAuthService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request): void
    {
        header('Content-Type: application/json');
        $data = $request->getBody();

        $errors = LoginAuthValidation::validate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = LoginAuthInDTO::fromArray($data);
        $result = $this->service->execute($dto->email, $dto->password);

        if (isset($result['error'])) {
            http_response_code($result['status']);
            echo json_encode(['error' => $result['error']]);
            return;
        }

        echo json_encode(LoginAuthOutDTO::fromModel($result['user'], $result['token']));
    }
}
