<?php

namespace App\Controllers;

use App\Controllers\HttpExceptions\Http400Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Controllers\HttpExceptions\Http500Exception;
use App\Services\AbstractService;
use App\Services\ServiceException;
use App\Services\UsersService;
use App\Services\StreetsService;

/**
 * Operations with Users: CRUD
 */
class StreetsController extends AbstractController
{

    public function __construct()
    {
        /*try {
            $this->usersService->checkSignature();
        } catch (ServiceException $e) {
            switch ($e->getCode()) {
                case UsersService::ERROR_USER_NOT_FOUND:
                    throw new Http400Exception(_('Incorrect login!'), $e->getCode(), $e);
                case UsersService::ERROR_INVALID_SIGNATURE:
                    throw new Http400Exception(_('Incorrect signature!'), $e->getCode(), $e);
                    break;
                default:
                    throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
            }
        }*/
    }

    /**
     * Returns street list
     *
     * @return array
     */
    /**
     * @SWG\Get(
     *   path="/street",
     *   summary="Get street list",
     *   tags={"street"},
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC signature",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
     *         type="string"
     *     ),
     *   @SWG\Response(
     *     response=200,
     *     description="A list with streets"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function getStreetListAction()
    {
        try {
            $streets = $this->streetsService->getStreetsList();
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }
        return $streets;
    }

}