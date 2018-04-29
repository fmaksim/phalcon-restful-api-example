<?php

return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'rest_api',
            'charset' => 'utf8',
        ],

        'application' => [
            'controllersDir' => "app/controllers/",
            'modelsDir' => "app/models/",
            'migrationsDir', 'app/migrations/',
            'baseUri' => "/",
        ],
    ]
);