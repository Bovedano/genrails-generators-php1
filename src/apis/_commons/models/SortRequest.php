<?php

namespace App\apis\_commons\models;

class SortRequest
{
    public function __construct(
        public readonly string $field,
        public readonly string $order = 'asc',
    ) {}
}
