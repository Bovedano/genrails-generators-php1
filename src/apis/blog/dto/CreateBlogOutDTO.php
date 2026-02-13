<?php

namespace App\apis\blog\dto;

use JsonSerializable;

class CreateBlogOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly int     $id,
        public readonly string  $title,
        public readonly string  $description,
        public readonly int     $user_id,
        public readonly ?string $created_at,
    ) {}

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
