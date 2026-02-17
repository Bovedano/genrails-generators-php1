<?php

namespace App\middleware;

use App\apis\_auth\models\User;
use App\apis\_auth\services\JWTService;
use App\core\request\Request;

class AuthMiddleware
{
    const PUBLIC_ROUTES = ['/v1/_auth/register', '/v1/_auth/login', '/v1/_config/migration'];

    public static function handle(Request $request): User|false|null
    {
        $context = $request->getContext();

        if (in_array($context->getUri(), self::PUBLIC_ROUTES)) {
            return null;
        }

        $user = self::authenticate($context->getContainer()->make(JWTService::class));

        if (!$user) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return false;
        }

        return $user;
    }

    private static function authenticate(JWTService $jwtService): ?User
    {
        $token = self::extractToken();
        if (!$token) {
            return null;
        }

        $payload = $jwtService->decode($token);
        if (!$payload) {
            return null;
        }

        return User::find($payload->sub);
    }

    private static function extractToken(): ?string
    {
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (preg_match('/Bearer\s+(.+)/i', $header, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
