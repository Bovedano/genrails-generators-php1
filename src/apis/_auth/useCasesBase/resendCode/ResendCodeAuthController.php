<?php

namespace App\apis\_auth\useCasesBase\resendCode;

use App\core\request\Request;

class ResendCodeAuthController
{
    private ResendCodeAuthService $service;

    public function __construct(ResendCodeAuthService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request): void
    {
        header('Content-Type: application/json');
        $data = $request->getBody();

        if (empty($data['email'])) {
            http_response_code(422);
            echo json_encode(['errors' => ['email' => 'Email is required']]);
            return;
        }

        $result = $this->service->execute($data['email']);

        if (!$result) {
            http_response_code(400);
            echo json_encode(['error' => 'No pending activation found for this email']);
            return;
        }

        echo json_encode(['message' => 'Activation code sent to your email']);
    }
}
