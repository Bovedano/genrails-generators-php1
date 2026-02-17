<?php

namespace App\apis\_commons\models;

class PaginationRequest
{
    public function __construct(
        public readonly int  $page = 1,
        public readonly ?int $size = null,
    ) {}
}
