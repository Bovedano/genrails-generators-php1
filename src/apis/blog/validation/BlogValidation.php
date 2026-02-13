<?php

namespace App\apis\blog\validation;

class BlogValidation
{
    public static function validateCreate(array $data): array
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

    public static function validateUpdate(array $data): array
    {
        $errors = [];

        if (array_key_exists('title', $data) && empty($data['title'])) {
            $errors['title'] = 'Title cannot be empty';
        }

        if (array_key_exists('description', $data) && empty($data['description'])) {
            $errors['description'] = 'Description cannot be empty';
        }

        return $errors;
    }
}
