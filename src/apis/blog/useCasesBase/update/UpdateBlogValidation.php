<?php

namespace App\apis\blog\useCasesBase\update;

class UpdateBlogValidation
{
    public static function validate(array $data): array
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
