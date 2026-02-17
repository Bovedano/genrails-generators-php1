<?php

$r->addRoute('POST', '/v1/_auth/register', 'App\apis\_auth\controllers\AuthController@register');
$r->addRoute('POST', '/v1/_auth/login',    'App\apis\_auth\controllers\AuthController@login');
$r->addRoute('GET',  '/v1/_auth/me',       'App\apis\_auth\controllers\AuthController@me');
$r->addRoute('POST', '/v1/_auth/refresh',  'App\apis\_auth\controllers\AuthController@refresh');
