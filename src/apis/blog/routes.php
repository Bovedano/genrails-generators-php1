<?php

$r->addRoute('GET',    '/blogs',          'App\apis\blog\useCasesBase\getAll\GetAllBlogController@__invoke');
$r->addRoute('GET',    '/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\getById\GetByIdBlogController@__invoke');
$r->addRoute('POST',   '/blogs',          'App\apis\blog\useCasesBase\create\CreateBlogController@__invoke');
$r->addRoute('PUT',    '/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\update\UpdateBlogController@__invoke');
$r->addRoute('DELETE', '/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\delete\DeleteBlogController@__invoke');

// /me routes — automatically use the authenticated user's ID
$r->addRoute('GET',    '/me/blogs',          'App\apis\blog\useCasesBase\getAll\GetAllBlogController@me');
$r->addRoute('GET',    '/me/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\getById\GetByIdBlogController@me');
$r->addRoute('POST',   '/me/blogs',          'App\apis\blog\useCasesBase\create\CreateBlogController@me');
$r->addRoute('PUT',    '/me/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\update\UpdateBlogController@me');
$r->addRoute('DELETE', '/me/blogs/{id:\d+}', 'App\apis\blog\useCasesBase\delete\DeleteBlogController@me');
