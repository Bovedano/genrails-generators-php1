<?php

namespace App\apis\blog\useCasesBase\update;

use App\apis\_auth\models\User;
use App\apis\blog\_shared\models\Blog;
use App\apis\blog\useCasesBase\update\dto\UpdateBlogInDTO;
use App\apis\blog\useCasesBase\update\dto\UpdateBlogOutDTO;
use App\core\request\Request;

class UpdateBlogController
{
    private UpdateBlogService $service;

    public function __construct(UpdateBlogService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $data = $request->getBody();

        $errors = UpdateBlogValidation::validate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = UpdateBlogInDTO::fromArray($data);
        $blog = $this->service->execute((int) $request->getPathParam('id'), $dto->toArray());

        if (!$blog) {
            http_response_code(404);
            echo json_encode(['error' => 'Blog not found']);
            return;
        }

        echo json_encode(UpdateBlogOutDTO::fromModel($blog));
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

        $data = $request->getBody();

        $errors = UpdateBlogValidation::validate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = UpdateBlogInDTO::fromArray($data);
        $blog = $this->service->execute($id, $dto->toArray());

        echo json_encode(UpdateBlogOutDTO::fromModel($blog));
    }
}
