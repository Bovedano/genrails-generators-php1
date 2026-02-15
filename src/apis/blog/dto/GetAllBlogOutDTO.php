<?php

namespace App\apis\blog\dto;

use JsonSerializable;
use App\apis\blog\models\Blog;

class GetAllBlogOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly int    $id,
        public readonly string $title,
        public readonly int    $user_id,
    ) {}

    public static function fromModel(Blog $blog): self
    {
        return new self(
            $blog->id,
            $blog->title,
            $blog->user_id,
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
