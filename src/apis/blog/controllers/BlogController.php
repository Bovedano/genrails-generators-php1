<?php

namespace App\apis\blog\controllers;

use App\apis\blog\services\BlogCRUDService;
use App\apis\blog\filters\BlogFilters;
use App\apis\blog\validation\BlogValidation;
use App\apis\blog\dto\GetAllBlogOutDTO;
use App\apis\blog\dto\GetByIdBlogOutDTO;
use App\apis\blog\dto\CreateBlogInDTO;
use App\apis\blog\dto\CreateBlogOutDTO;
use App\apis\blog\dto\UpdateBlogInDTO;
use App\apis\blog\dto\UpdateBlogOutDTO;

class BlogController
{
    private BlogCRUDService $blogService;

    public function __construct(BlogCRUDService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index(): void
    {
        header('Content-Type: application/json');
        $filters = BlogFilters::apply($_GET);
        $blogs = $this->blogService->getAll($filters);
        echo json_encode(array_map(fn($blog) => GetAllBlogOutDTO::fromModel($blog), $blogs->all()));
    }

    public function show(array $params): void
    {
        header('Content-Type: application/json');
        $blog = $this->blogService->getById((int) $params['id']);

        if (!$blog) {
            http_response_code(404);
            echo json_encode(['error' => 'Blog not found']);
            return;
        }

        echo json_encode(GetByIdBlogOutDTO::fromModel($blog));
    }

    public function store(): void
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $errors = BlogValidation::validateCreate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = CreateBlogInDTO::fromArray($data);
        $blog = $this->blogService->create($dto->toArray());

        http_response_code(201);
        echo json_encode(CreateBlogOutDTO::fromModel($blog));
    }

    public function update(array $params): void
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $errors = BlogValidation::validateUpdate($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $dto = UpdateBlogInDTO::fromArray($data);
        $blog = $this->blogService->update((int) $params['id'], $dto->toArray());

        if (!$blog) {
            http_response_code(404);
            echo json_encode(['error' => 'Blog not found']);
            return;
        }

        echo json_encode(UpdateBlogOutDTO::fromModel($blog));
    }

    public function destroy(array $params): void
    {
        header('Content-Type: application/json');
        $deleted = $this->blogService->delete((int) $params['id']);

        if (!$deleted) {
            http_response_code(404);
            echo json_encode(['error' => 'Blog not found']);
            return;
        }

        http_response_code(204);
    }
}
