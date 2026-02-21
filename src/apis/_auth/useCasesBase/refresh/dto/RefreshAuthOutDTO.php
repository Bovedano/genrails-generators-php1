<?php

namespace App\apis\_auth\useCasesBase\refresh\dto;

use JsonSerializable;

class RefreshAuthOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly string $token,
    ) {}

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
