<?php

namespace App\middleware;

use App\apis\_auth\models\User;
use App\apis\_auth\services\JWTService;
use App\core\request\Request;
use Illuminate\Container\Container;

class AuthMiddleware
{
    const PUBLIC_ROUTES = ['/_auth/register', '/_auth/login', '/_config/migration'];

    public static function handle(string $uri, Container $container, string $class, string $method, array $params, object $context): void
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $request = new Request($params, $_GET, $body);

        if (!in_array($uri, self::PUBLIC_ROUTES)) {
            $user = self::authenticate($container->make(JWTService::class));

            if (!$user) {
                header('Content-Type: application/json');
                http_response_code(401);
                echo json_encode(['error' => 'Unauthorized']);
                return;
            }

            $context->user_id = $user->id;
            $container->make($class)->$method($request, $user);
            return;
        }

        $container->make($class)->$method($request);
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
