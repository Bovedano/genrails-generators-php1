<?php

namespace App\apis\_auth\useCasesBase\me\dto;

use JsonSerializable;
use App\apis\_auth\_shared\models\User;

class MeAuthOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly int     $id,
        public readonly string  $name,
        public readonly string  $email,
        public readonly string  $role,
        public readonly ?string $created_at,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            $user->id,
            $user->name,
            $user->email,
            $user->role,
            $user->created_at?->toIso8601String(),
        );
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
