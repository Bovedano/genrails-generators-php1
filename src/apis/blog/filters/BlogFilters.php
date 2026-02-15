<?php

namespace App\apis\blog\filters;

use App\apis\_commons\models\Filter;
use App\core\FiltersBuilder;

class BlogFilters
{
    const SEARCHABLE_FIELDS = [
        'title'       => 'like',
        'description' => 'like',
        'user_id'     => 'exact',
        'created_at'  => 'range',
    ];

    /**
     * Build filter conditions for Blog from the incoming query parameters.
     *
     * @param  array $queryParams  Query parameters from the HTTP request.
     * @return Filter[]            List of filter conditions.
     */
    public static function apply(array $queryParams): array
    {
        return FiltersBuilder::build($queryParams, self::SEARCHABLE_FIELDS);
    }
}
