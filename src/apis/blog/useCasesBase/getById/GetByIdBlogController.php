<?php

namespace App\apis\blog\useCasesBase\getById;

use App\apis\_auth\_shared\models\User;
use App\apis\blog\useCasesBase\getById\dto\GetByIdBlogOutDTO;
use App\core\request\Request;

class GetByIdBlogController
{
    private GetByIdBlogService $service;

    public function __construct(GetByIdBlogService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $blog = $this->service->execute((int) $request->getPathParam('id'));

        if (!$blog) {
            http_response_code(404);
            echo json_encode(['error' => 'Blog not found']);
            return;
        }

        echo json_encode(GetByIdBlogOutDTO::fromModel($blog));
    }

    public function me(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $blog = $this->service->execute((int) $request->getPathParam('id'));

        if (!$blog || $blog->user_id !== $user->id) {
            http_response_code(404);
            echo json_encode(['error' => 'Blog not found']);
            return;
        }

        echo json_encode(GetByIdBlogOutDTO::fromModel($blog));
    }
}
