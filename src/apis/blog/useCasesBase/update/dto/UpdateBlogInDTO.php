<?php

namespace App\apis\blog\useCasesBase\update\dto;

class UpdateBlogInDTO
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $description,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title:       $data['title'] ?? null,
            description: $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this), fn($v) => $v !== null);
    }
}
