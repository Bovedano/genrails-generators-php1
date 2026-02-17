<?php

$r->addRoute('GET',    '/v1/blogs',          'App\apis\blog\useCasesBase\getAll\GetAllBlogController@__invoke');
$r->addRoute('GET',    '/v1/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\getById\GetByIdBlogController@__invoke');
$r->addRoute('POST',   '/v1/blogs',          'App\apis\blog\useCasesBase\create\CreateBlogController@__invoke');
$r->addRoute('PUT',    '/v1/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\update\UpdateBlogController@__invoke');
$r->addRoute('DELETE', '/v1/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\delete\DeleteBlogController@__invoke');

// /me routes — automatically use the authenticated user's ID
$r->addRoute('GET',    '/v1/me/blogs',          'App\apis\blog\useCasesBase\getAll\GetAllBlogController@me');
$r->addRoute('GET',    '/v1/me/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\getById\GetByIdBlogController@me');
$r->addRoute('POST',   '/v1/me/blogs',          'App\apis\blog\useCasesBase\create\CreateBlogController@me');
$r->addRoute('PUT',    '/v1/me/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\update\UpdateBlogController@me');
$r->addRoute('DELETE', '/v1/me/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\delete\DeleteBlogController@me');
