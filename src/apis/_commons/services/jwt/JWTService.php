<?php

namespace App\apis\_commons\services\jwt;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\apis\_auth\models\User;

class JWTService
{
    private string $secret;
    private int $expiration;
    private int $refreshExpiration;

    public function __construct(string $secret, int $expiration, int $refreshExpiration)
    {
        $this->secret = $secret;
        $this->expiration = $expiration;
        $this->refreshExpiration = $refreshExpiration;
    }

    public function encode(User $user, bool $refresh = false): string
    {
        $payload = [
            'sub'  => $user->id,
            'role' => $user->role,
            'iat'  => time(),
            'exp'  => time() + ($refresh ? $this->refreshExpiration : $this->expiration),
        ];

        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function decode(string $token): ?object
    {
        try {
            return JWT::decode($token, new Key($this->secret, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}
