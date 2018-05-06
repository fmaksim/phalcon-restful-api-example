<?php

use Phalcon\Events\Manager;
use App\Middleware\SignatureMiddleware;
/**
 * @SWG\Info(
 *   title="Velcom REST API",
 *   description="A sample API",
 *   version="1.0.0",
 *   termsOfService="http://swagger.io/terms/"
 * )
 * @SWG\Swagger(
 *   host="velcom-rest.local",
 *   basePath="/",
 *   schemes={"http"},
 *   produces={"application/json"},
 *   consumes={"application/json"},
 *   @SWG\ExternalDocumentation(
 *     description="find more info here"
 *   )
 * )
 */
/**
 * @SWG\Tag(
 *   name="house",
 *   description="Methods that work with houses"
 * )
 * @SWG\Tag(
 *   name="flat",
 *   description="Methods that work with flats"
 * )
 * @SWG\Tag(
 *   name="street",
 *   description="Methods that work with streets"
 * )
 * @SWG\Tag(
 *   name="contact",
 *   description="Methods that work with contacts"
 * )
 * @SWG\Tag(
 *   name="user",
 *   description="Methods that work with users"
 * )
 *
 */

$eventsManager = new Manager();

/**
 * Прикрепляем middleware к менеджеру событий и приложению
 */
$eventsManager->attach('micro', new SignatureMiddleware());
$app->before(new SignatureMiddleware());

$housesCollection = new \Phalcon\Mvc\Micro\Collection();
$housesCollection->setHandler('\App\Controllers\HousesController', true);
$housesCollection->setPrefix('/house');
$housesCollection->get('', 'getHouseListAction');
$housesCollection->get('/street/{streetId:[1-9][0-9]*}', 'getHouseListByStreetAction');
$housesCollection->get('/{houseId:[1-9][0-9]*}', 'getHouseByIdAction');
$housesCollection->get('/{houseId:[1-9][0-9]*}/flats', 'getHouseFlatsAction');
$app->mount($housesCollection);

$flatsCollection = new \Phalcon\Mvc\Micro\Collection();
$flatsCollection->setHandler('\App\Controllers\FlatsController', true);
$flatsCollection->setPrefix('/flat');
$flatsCollection->get('/{flatId:[1-9][0-9]*}', 'getFlatByIdAction');
$flatsCollection->get('/{flatId:[1-9][0-9]*}/contacts', 'getFlatContactsAction');
$app->mount($flatsCollection);

$streetsCollection = new \Phalcon\Mvc\Micro\Collection();
$streetsCollection->setHandler('\App\Controllers\StreetsController', true);
$streetsCollection->setPrefix('/street');
$streetsCollection->get('', 'getStreetListAction');
$app->mount($streetsCollection);

$contactsCollection = new \Phalcon\Mvc\Micro\Collection();
$contactsCollection->setHandler('\App\Controllers\ContactsController', true);
$contactsCollection->setPrefix('/contact');
$contactsCollection->post('', 'addContactAction');
$contactsCollection->put('/{contactId:[1-9][0-9]*}', 'editContactAction');
$contactsCollection->delete('/{contactId:[1-9][0-9]*}', 'deleteContactAction');
$app->mount($contactsCollection);
//});

$usersCollection = new \Phalcon\Mvc\Micro\Collection();
$usersCollection->setHandler('\App\Controllers\UsersController', true);
$usersCollection->setPrefix('/login');
$usersCollection->post('', 'loginAction');
$app->mount($usersCollection);

// not found URLs
$app->notFound(
    function () use ($app) {
        $exception =
            new \App\Controllers\HttpExceptions\Http404Exception(
                _('URI nots found or error in request.'),
                \App\Controllers\AbstractController::ERROR_NOT_FOUND,
                new \Exception('URI nots found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
            );
        throw $exception;
    }
);

$app->setEventsManager($eventsManager);