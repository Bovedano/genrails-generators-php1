<?php

use Illuminate\Container\Container;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\MappingOperation\Operation;
use App\apis\_config\migration\services\MigrationService;
use App\apis\blog\models\Blog;
use App\apis\blog\dto\GetAllBlogOutDTO;
use App\apis\blog\dto\GetByIdBlogOutDTO;
use App\apis\blog\dto\CreateBlogOutDTO;
use App\apis\blog\dto\UpdateBlogOutDTO;

$container = new Container();

$container->singleton(MigrationService::class, function () {
    return new MigrationService(BASE_PATH . '/src/db/migrations');
});

$container->singleton(AutoMapper::class, function () {
    $config = new AutoMapperConfig();

    $mapFrom = fn(string $field) => Operation::mapFrom(fn(Blog $b) => $b->$field);
    $createdAt = Operation::mapFrom(fn(Blog $b) => $b->created_at?->toIso8601String());

    $config->registerMapping(Blog::class, GetAllBlogOutDTO::class)
        ->forMember('id', $mapFrom('id'))
        ->forMember('title', $mapFrom('title'))
        ->forMember('user_id', $mapFrom('user_id'));

    $config->registerMapping(Blog::class, GetByIdBlogOutDTO::class)
        ->forMember('id', $mapFrom('id'))
        ->forMember('title', $mapFrom('title'))
        ->forMember('description', $mapFrom('description'))
        ->forMember('user_id', $mapFrom('user_id'))
        ->forMember('created_at', $createdAt);

    $config->registerMapping(Blog::class, CreateBlogOutDTO::class)
        ->forMember('id', $mapFrom('id'))
        ->forMember('title', $mapFrom('title'))
        ->forMember('description', $mapFrom('description'))
        ->forMember('user_id', $mapFrom('user_id'))
        ->forMember('created_at', $createdAt);

    $config->registerMapping(Blog::class, UpdateBlogOutDTO::class)
        ->forMember('id', $mapFrom('id'))
        ->forMember('title', $mapFrom('title'))
        ->forMember('description', $mapFrom('description'))
        ->forMember('user_id', $mapFrom('user_id'))
        ->forMember('created_at', $createdAt);

    return new AutoMapper($config);
});

return $container;
