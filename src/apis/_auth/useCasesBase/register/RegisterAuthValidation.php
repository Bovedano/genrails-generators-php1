<?php

namespace App\apis\_auth\useCasesBase\register;

use App\apis\_auth\_shared\models\User;

class RegisterAuthValidation
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        } elseif (User::where('email', $data['email'])->exists()) {
            $errors['email'] = 'Email is already registered';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Password is required';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        return $errors;
    }
}
