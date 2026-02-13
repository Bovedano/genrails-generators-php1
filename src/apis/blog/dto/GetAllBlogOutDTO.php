<?php

namespace App\apis\blog\dto;

use JsonSerializable;

class GetAllBlogOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly int    $id,
        public readonly string $title,
        public readonly int    $user_id,
    ) {}

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
