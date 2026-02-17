<?php

namespace App\apis\_commons\models;

use JsonSerializable;

class Pagination implements JsonSerializable
{
    public function __construct(
        public readonly int $page,
        public readonly int $size,
        public readonly int $total,
        public readonly int $pages,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'page'       => $this->page,
            'size'       => $this->size,
            'total'      => $this->total,
            'pages'      => $this->pages,
        ];
    }
}
