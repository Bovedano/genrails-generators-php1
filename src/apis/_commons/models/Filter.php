<?php

namespace App\apis\_commons\models;

class Filter
{
    public function __construct(
        public readonly string $field,
        public readonly string $operator,
        public readonly mixed  $value,
    ) {}
}
