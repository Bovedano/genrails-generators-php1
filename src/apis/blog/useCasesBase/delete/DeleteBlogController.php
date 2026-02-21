<?php

namespace App\apis\blog\useCasesBase\delete;

use App\apis\_auth\_shared\models\User;
use App\apis\blog\_shared\models\Blog;
use App\core\request\Request;

class DeleteBlogController
{
    private DeleteBlogService $service;

    public function __construct(DeleteBlogService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $deleted = $this->service->execute((int) $request->getPathParam('id'));

        if (!$deleted) {
            http_response_code(404);
            echo json_encode(['error' => 'Blog not found']);
            return;
        }

        http_response_code(204);
    }

    public function me(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $id = (int) $request->getPathParam('id');

        $existing = Blog::where('id', $id)->where('user_id', $user->id)->first();
        if (!$existing) {
            http_response_code(404);
            echo json_encode(['error' => 'Blog not found']);
            return;
        }

        $this->service->execute($id);
        http_response_code(204);
    }
}
