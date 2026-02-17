<?php

namespace App\core\request;

use App\apis\_commons\models\SortRequest;

class SortBuilder
{
    public static function build(array $queryParams, array $sortableFields): ?SortRequest
    {
        $field = $queryParams['_sort'] ?? null;

        if ($field === null || !in_array($field, $sortableFields)) {
            return null;
        }

        $order = $queryParams['_order'] ?? 'asc';
        $order = in_array($order, ['asc', 'desc']) ? $order : 'asc';

        return new SortRequest($field, $order);
    }
}
