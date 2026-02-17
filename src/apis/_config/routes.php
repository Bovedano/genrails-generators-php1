<?php

$r->addRoute('POST', '/v1/_config/migration', 'App\apis\_config\migration\controllers\MigrationController@migrate');
