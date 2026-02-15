<?php

namespace App\apis\_auth\services;

use App\apis\_auth\models\User;

class AuthService
{
    public function register(array $data): User
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return User::create($data);
    }

    public function login(string $email, string $password): ?User
    {
        $user = User::where('email', $email)->first();

        if (!$user || !password_verify($password, $user->password)) {
            return null;
        }

        return $user;
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }
}
