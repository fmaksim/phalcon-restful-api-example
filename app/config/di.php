<?php

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Events\Manager as EventsManager;

// Initializing a DI Container
$di = new \Phalcon\DI\FactoryDefault();

/**
 * Overriding Response-object to set the Content-type header globally
 */
$di->setShared(
    'response',
    function () {
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'utf-8');

        return $response;
    }
);

/** Common config */
$di->setShared('config', $config);

/** Database */
$di->set(
    "db",
    function () use ($config) {
        return new Mysql(
            [
                "host" => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname" => $config->database->dbname,
                "port" => $config->database->port,
                "charset" => $config->database->charset,
            ]
        );
    }
);

/** Service to perform operations with the Users */
$di->setShared('usersService', '\App\Services\UsersService');
$di->setShared('housesService', '\App\Services\HousesService');
$di->setShared('streetsService', '\App\Services\StreetsService');
$di->setShared('flatsService', '\App\Services\FlatsService');
$di->setShared('contactsService', '\App\Services\ContactsService');
$di->setShared('phonesService', '\App\Services\PhonesService');
$di->setShared('contactsFactory', '\App\Factories\ContactsFactory');

return $di;