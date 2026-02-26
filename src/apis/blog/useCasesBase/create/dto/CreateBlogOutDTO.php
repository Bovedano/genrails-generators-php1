<?php

namespace App\apis\blog\useCasesBase\create\dto;

use JsonSerializable;
use App\apis\blog\_shared\models\Blog;

class CreateBlogOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly string  $id,
        public readonly string  $title,
        public readonly string  $description,
        public readonly string  $user_id,
        public readonly ?string $created_at,
    ) {}

    public static function fromModel(Blog $blog): self
    {
        return new self(
            $blog->id,
            $blog->title,
            $blog->description,
            $blog->user_id,
            $blog->created_at?->toIso8601String(),
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
