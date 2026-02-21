<?php

namespace App\apis\blog\useCasesBase\create;

use App\apis\_auth\_shared\models\User;
use App\apis\blog\useCasesBase\create\dto\CreateBlogInDTO;
use App\apis\blog\useCasesBase\create\dto\CreateBlogOutDTO;
use App\core\request\Request;

class CreateBlogController
{
    private CreateBlogService $service;

    public function __construct(CreateBlogService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $data = $request->getBody();

        $errors = CreateBlogValidation::validate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = CreateBlogInDTO::fromArray($data);
        $blog = $this->service->execute($dto->toArray());

        http_response_code(201);
        echo json_encode(CreateBlogOutDTO::fromModel($blog));
    }

    public function me(Request $request, User $user): void
    {
        header('Content-Type: application/json');
        $data = $request->getBody();
        $data['user_id'] = $user->id;

        $errors = CreateBlogValidation::validate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = CreateBlogInDTO::fromArray($data);
        $blog = $this->service->execute($dto->toArray());

        http_response_code(201);
        echo json_encode(CreateBlogOutDTO::fromModel($blog));
    }
}
