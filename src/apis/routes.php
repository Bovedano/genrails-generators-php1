<?php

// Config
$r->addRoute('POST', '/_config/migration', 'App\apis\_config\migration\controllers\MigrationController@migrate');

// Blog
$r->addRoute('GET',    '/blogs',          'App\apis\blog\controllers\BlogController@index');
$r->addRoute('GET',    '/blogs/{id:\d+}', 'App\apis\blog\controllers\BlogController@show');
$r->addRoute('POST',   '/blogs',          'App\apis\blog\controllers\BlogController@store');
$r->addRoute('PUT',    '/blogs/{id:\d+}', 'App\apis\blog\controllers\BlogController@update');
$r->addRoute('DELETE', '/blogs/{id:\d+}', 'App\apis\blog\controllers\BlogController@destroy');
