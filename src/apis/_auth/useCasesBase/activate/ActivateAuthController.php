<?php

namespace App\apis\_auth\useCasesBase\activate;

use App\apis\_auth\useCasesBase\activate\dto\ActivateAuthOutDTO;
use App\core\request\Request;

class ActivateAuthController
{
    private ActivateAuthService $service;

    public function __construct(ActivateAuthService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request): void
    {
        header('Content-Type: application/json');
        $data = $request->getBody();

        $errors = ActivateAuthValidation::validate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $result = $this->service->execute($data['email'], $data['code']);

        if (!$result) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid activation code']);
            return;
        }

        echo json_encode(ActivateAuthOutDTO::fromModel($result['user'], $result['token']));
    }
}
