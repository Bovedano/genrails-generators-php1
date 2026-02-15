<?php

namespace App\apis\_auth\dto;

use JsonSerializable;

class RefreshOutDTO implements JsonSerializable
{
    public function __construct(
        public readonly string $token,
    ) {}

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
