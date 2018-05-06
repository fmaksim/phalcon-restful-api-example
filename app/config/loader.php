<?php

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
    [
        'App\Services' => realpath(__DIR__ . '/../services/'),
        'App\Controllers' => realpath(__DIR__ . '/../controllers/'),
        'App\Models' => realpath(__DIR__ . '/../models/'),
        'App\Middleware' => realpath(__DIR__ . '/../middleware/'),
        'App\Factories' => realpath(__DIR__ . '/../factories/'),
        'App\Helpers' => realpath(__DIR__ . '/../helpers/'),
    ]
);

$loader->register();
