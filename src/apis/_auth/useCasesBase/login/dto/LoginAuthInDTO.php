<?php

namespace App\apis\_auth\useCasesBase\login\dto;

class LoginAuthInDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email:    $data['email'],
            password: $data['password'],
        );
    }
}
