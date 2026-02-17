<?php

namespace App\apis\blog\useCasesBase\getAll;

use App\apis\_auth\models\User;
use App\apis\_commons\models\Filter;
use App\core\request\Request;
use App\core\request\PaginationBuilder;
use App\core\request\SortBuilder;

class GetAllBlogController
{
    private GetAllBlogService $service;

    public function __construct(GetAllBlogService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $filters    = GetAllBlogFilters::apply($request->getQueryParams());
        $pagination = PaginationBuilder::build($request->getQueryParams());
        $sort       = SortBuilder::build($request->getQueryParams(), GetAllBlogFilters::SORTABLE_FIELDS);
        $result     = $this->service->execute($filters, $pagination, $sort);
        echo json_encode($result);
    }

    public function me(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $filters    = GetAllBlogFilters::apply($request->getQueryParams());
        $filters[]  = new Filter('user_id', '=', $user->id);
        $pagination = PaginationBuilder::build($request->getQueryParams());
        $sort       = SortBuilder::build($request->getQueryParams(), GetAllBlogFilters::SORTABLE_FIELDS);
        $result     = $this->service->execute($filters, $pagination, $sort);
        echo json_encode($result);
    }
}
