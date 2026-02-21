<?php

namespace App\apis\_auth\useCasesBase\register\dto;

use JsonSerializable;
use App\apis\_auth\_shared\models\User;

class RegisterAuthOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly int    $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
        public readonly string $message,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            $user->id,
            $user->name,
            $user->email,
            $user->role,
            'Activation code sent to your email',
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
