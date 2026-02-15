<?php

namespace App\apis\_auth\dto;

class RegisterInDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name:     $data['name'],
            email:    $data['email'],
            password: $data['password'],
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
