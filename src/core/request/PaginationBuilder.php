<?php

namespace App\core\request;

use App\apis\_commons\models\PaginationRequest;

class PaginationBuilder
{
    public static function build(array $queryParams): PaginationRequest
    {
        $page = (int) ($queryParams['_page'] ?? 1);
        $size = isset($queryParams['_size']) ? (int) $queryParams['_size'] : null;

        return new PaginationRequest($page, $size);
    }
}
