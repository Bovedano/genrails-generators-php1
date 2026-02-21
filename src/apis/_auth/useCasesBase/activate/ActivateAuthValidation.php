<?php

namespace App\apis\_auth\useCasesBase\activate;

class ActivateAuthValidation
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty($data['email'])) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }

        if (empty($data['code'])) {
            $errors['code'] = 'Activation code is required';
        }

        return $errors;
    }
}
