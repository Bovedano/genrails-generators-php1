<?php

namespace App\apis\_auth\controllers;

use App\apis\_auth\models\User;
use App\apis\_auth\services\AuthService;
use App\apis\_auth\services\JWTService;
use App\apis\_auth\validation\AuthValidation;
use App\apis\_auth\dto\RegisterInDTO;
use App\apis\_auth\dto\RegisterOutDTO;
use App\apis\_auth\dto\LoginInDTO;
use App\apis\_auth\dto\LoginOutDTO;
use App\apis\_auth\dto\MeOutDTO;
use App\apis\_auth\dto\RefreshOutDTO;

class AuthController
{
    private AuthService $authService;
    private JWTService $jwtService;

    public function __construct(AuthService $authService, JWTService $jwtService)
    {
        $this->authService = $authService;
        $this->jwtService = $jwtService;
    }

    public function register(): void
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $errors = AuthValidation::validateRegister($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = RegisterInDTO::fromArray($data);
        $user = $this->authService->register($dto->toArray());
        $token = $this->jwtService->encode($user);

        http_response_code(201);
        echo json_encode(new RegisterOutDTO(
            token: $token,
            id:    $user->id,
            name:  $user->name,
            email: $user->email,
            role:  $user->role,
        ));
    }

    public function login(): void
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $errors = AuthValidation::validateLogin($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = LoginInDTO::fromArray($data);
        $user = $this->authService->login($dto->email, $dto->password);

        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid credentials']);
            return;
        }

        $token = $this->jwtService->encode($user);

        echo json_encode(new LoginOutDTO(
            token: $token,
            id:    $user->id,
            name:  $user->name,
            email: $user->email,
            role:  $user->role,
        ));
    }

    public function me(array $params, User $user): void
    {
        header('Content-Type: application/json');
        echo json_encode(MeOutDTO::fromModel($user));
    }

    public function refresh(array $params, User $user): void
    {
        header('Content-Type: application/json');
        $token = $this->jwtService->encode($user, refresh: true);
        echo json_encode(new RefreshOutDTO(token: $token));
    }
}
