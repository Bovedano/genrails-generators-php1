<?php

namespace App\core\request;

use App\apis\_commons\models\Filter;

class FiltersBuilder
{
    /**
     * Build Filter objects from query parameters based on a searchable fields map.
     *
     * @param  array $queryParams     Query parameters from the HTTP request.
     * @param  array $searchableFields  Map of field name => filter type ('like', 'exact', 'range').
     * @return Filter[]
     */
    public static function build(array $queryParams, array $searchableFields): array
    {
        /** @var Filter[] $filters */
        $filters = [];

        foreach ($searchableFields as $field => $type) {
            if ($type === 'range') {
                if (isset($queryParams[$field . '_from'])) {
                    $filters[] = new Filter($field, '>=', $queryParams[$field . '_from']);
                }
                if (isset($queryParams[$field . '_to'])) {
                    $filters[] = new Filter($field, '<=', $queryParams[$field . '_to']);
                }
            } elseif (isset($queryParams[$field])) {
                if ($type === 'like') {
                    $filters[] = new Filter($field, 'LIKE', '%' . $queryParams[$field] . '%');
                } else {
                    $filters[] = new Filter($field, '=', $queryParams[$field]);
                }
            }
        }

        return $filters;
    }
}
