<?php

$r->addRoute('POST', '/_auth/register', 'App\apis\_auth\controllers\AuthController@register');
$r->addRoute('POST', '/_auth/login',    'App\apis\_auth\controllers\AuthController@login');
$r->addRoute('GET',  '/_auth/me',       'App\apis\_auth\controllers\AuthController@me');
$r->addRoute('POST', '/_auth/refresh',  'App\apis\_auth\controllers\AuthController@refresh');
