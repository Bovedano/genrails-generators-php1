<?php

$r->addRoute('POST', '/v1/_auth/register',    'App\apis\_auth\useCasesBase\register\RegisterAuthController@__invoke');
$r->addRoute('POST', '/v1/_auth/activate',    'App\apis\_auth\useCasesBase\activate\ActivateAuthController@__invoke');
$r->addRoute('POST', '/v1/_auth/resend-code', 'App\apis\_auth\useCasesBase\resendCode\ResendCodeAuthController@__invoke');
$r->addRoute('POST', '/v1/_auth/login',       'App\apis\_auth\useCasesBase\login\LoginAuthController@__invoke');
$r->addRoute('GET',  '/v1/_auth/me',          'App\apis\_auth\useCasesBase\me\MeAuthController@__invoke');
$r->addRoute('POST', '/v1/_auth/refresh',     'App\apis\_auth\useCasesBase\refresh\RefreshAuthController@__invoke');
