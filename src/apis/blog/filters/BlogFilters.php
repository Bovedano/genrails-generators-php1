<?php

namespace App\apis\blog\filters;

class BlogFilters
{
    const SEARCHABLE_FIELDS = [
        'title'       => 'like',
        'description' => 'like',
        'user_id'     => 'exact',
        'created_at'  => 'range',
    ];

    public static function apply(array $queryParams): array
    {
        $filters = [];

        foreach (self::SEARCHABLE_FIELDS as $field => $type) {
            if ($type === 'range') {
                if (isset($queryParams[$field . '_from'])) {
                    $filters[] = ['field' => $field, 'operator' => '>=', 'value' => $queryParams[$field . '_from']];
                }
                if (isset($queryParams[$field . '_to'])) {
                    $filters[] = ['field' => $field, 'operator' => '<=', 'value' => $queryParams[$field . '_to']];
                }
            } elseif (isset($queryParams[$field])) {
                if ($type === 'like') {
                    $filters[] = ['field' => $field, 'operator' => 'LIKE', 'value' => '%' . $queryParams[$field] . '%'];
                } else {
                    $filters[] = ['field' => $field, 'operator' => '=', 'value' => $queryParams[$field]];
                }
            }
        }

        return $filters;
    }
}
