<?php

namespace App\apis\blog\useCasesBase\getAll\dto;

use JsonSerializable;
use App\apis\blog\_shared\models\Blog;

class GetAllBlogOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $user_id,
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
