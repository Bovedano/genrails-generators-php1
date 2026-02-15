<?php

namespace App\apis\_auth\dto;

use JsonSerializable;

class RegisterOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly string $token,
        public readonly int    $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
    ) {}

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
