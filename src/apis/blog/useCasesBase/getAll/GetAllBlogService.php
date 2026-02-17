<?php

namespace App\apis\blog\useCasesBase\getAll;

use App\apis\_commons\models\Pagination;
use App\apis\_commons\models\PaginationRequest;
use App\apis\_commons\models\SortRequest;
use App\apis\blog\_shared\models\Blog;
use App\apis\blog\useCasesBase\getAll\dto\GetAllBlogOutDTO;

class GetAllBlogService
{
    public function execute(array $filters = [], PaginationRequest $pagination = new PaginationRequest(), ?SortRequest $sort = null): array
    {
        $query = Blog::query();

        // ── Filters ─────────────────────────────────────────────
        foreach ($filters as $filter) {
            $query->where($filter->field, $filter->operator, $filter->value);
        }

        // ── Sorting ─────────────────────────────────────────────
        if ($sort !== null) {
            $query->orderBy($sort->field, $sort->order);
        }

        // ── Fetch all (no pagination) ───────────────────────────
        if ($pagination->size === null) {
            $items = $query->get()->all();
            $total = count($items);

            return [
                'data' => array_map(
                    fn(Blog $blog) => GetAllBlogOutDTO::fromModel($blog),
                    $items,
                ),
                '_pagination' => new Pagination($pagination->page, $total, $total, 1),
            ];
        }

        // ── Paginated fetch ─────────────────────────────────────
        $paginator = $query->paginate($pagination->size, ['*'], 'page', $pagination->page);

        return [
            'data' => array_map(
                fn(Blog $blog) => GetAllBlogOutDTO::fromModel($blog),
                $paginator->items(),
            ),
            '_pagination' => new Pagination(
                $paginator->currentPage(),
                $paginator->perPage(),
                $paginator->total(),
                $paginator->lastPage(),
            ),
        ];
    }
}
