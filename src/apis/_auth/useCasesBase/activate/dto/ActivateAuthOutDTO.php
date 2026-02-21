<?php

namespace App\apis\_auth\useCasesBase\activate\dto;

use JsonSerializable;
use App\apis\_auth\_shared\models\User;

class ActivateAuthOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly string $token,
        public readonly int    $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
    ) {}

    public static function fromModel(User $user, string $token): self
    {
        return new self(
            $token,
            $user->id,
            $user->name,
            $user->email,
            $user->role,
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
