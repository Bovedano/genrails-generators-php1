<?php

// Config
$r->addRoute('POST', '/_config/migration', 'App\apis\_config\migration\controllers\MigrationController@migrate');

// Auth
$r->addRoute('POST', '/_auth/register', 'App\apis\_auth\controllers\AuthController@register');
$r->addRoute('POST', '/_auth/login',    'App\apis\_auth\controllers\AuthController@login');
$r->addRoute('GET',  '/_auth/me',       'App\apis\_auth\controllers\AuthController@me');
$r->addRoute('POST', '/_auth/refresh',  'App\apis\_auth\controllers\AuthController@refresh');

// Blog
$r->addRoute('GET',    '/blogs',          'App\apis\blog\controllers\BlogController@index');
$r->addRoute('GET',    '/blogs/{id:\d+}', 'App\apis\blog\controllers\BlogController@show');
$r->addRoute('POST',   '/blogs',          'App\apis\blog\controllers\BlogController@store');
$r->addRoute('PUT',    '/blogs/{id:\d+}', 'App\apis\blog\controllers\BlogController@update');
$r->addRoute('DELETE', '/blogs/{id:\d+}', 'App\apis\blog\controllers\BlogController@destroy');
