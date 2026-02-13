<?php

require __DIR__ . '/../vendor/autoload.php';

use App\db\Connection;

Connection::initialize();

echo "Conexión exitosa";