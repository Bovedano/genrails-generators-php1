<?php

namespace App\apis\blog\dto;

class CreateBlogInDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly int    $user_id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title:       $data['title'],
            description: $data['description'],
            user_id:     (int) $data['user_id'],
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
