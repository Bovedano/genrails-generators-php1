<?php

namespace App\apis\blog\useCasesBase\create;

class CreateBlogValidation
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = 'Title is required';
        }

        if (empty($data['description'])) {
            $errors['description'] = 'Description is required';
        }

        if (empty($data['user_id'])) {
            $errors['user_id'] = 'User ID is required';
        } elseif (!is_numeric($data['user_id'])) {
            $errors['user_id'] = 'User ID must be a number';
        }

        return $errors;
    }
}
