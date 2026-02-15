<?php

namespace App\apis\_auth\dto;

use JsonSerializable;
use App\apis\_auth\models\User;

class MeOutDTO implements JsonSerializable
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
