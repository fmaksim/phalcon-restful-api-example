<?php

namespace App\Controllers;

use App\Controllers\HttpExceptions\Http400Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Controllers\HttpExceptions\Http500Exception;
use App\Services\AbstractService;
use App\Services\ServiceException;
use App\Services\UsersService;
use App\Services\HousesService;
use App\Services\FlatsService;

/**
 * Operations with Users: CRUD
 */
class HousesController extends AbstractController
{

    public function __construct()
    {
        try {
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
        }
    }

    /**
     * Returns house list
     *
     * @return array
     */
    /**
     * @SWG\Get(
     *   path="/house",
     *   summary="Список доступных адресов (домов)",
     *   tags={"house"},
     * @SWG\Parameter(
     *      name="signature",
     *      in="header",
     *      required=true,
     *      description="Цифровая подпись",
     *      type="string"
     *     ),
     * @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Логин",
     *         type="string"
     *     ),
     *   @SWG\Response(
     *     response=200,
     *     description="A list with addresses"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function getHouseListAction()
    {
        try {
            $houseList = $this->housesService->getHousesList();
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }

        return $houseList;
    }

    /**
     * @SWG\Get(
     *     path="/house/street/{streetId}",
     *     summary="Список домов по конкретной улице",
     *     tags={"house"},
     *     @SWG\Parameter(
     *         name="streetId",
     *         in="path",
     *         required=true,
     *         description="ИД улицы",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="Цифровая подпись",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Логин",
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Expected response to a valid request"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error"
     *     )
     * )
     */
    public function getHouseListByStreetAction($streetId)
    {
        try {
            $houseList = $this->housesService->getHousesListByStreet($streetId);
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }

        return $houseList;
    }

    /**
     * @SWG\Get(
     *     path="/house/{houseId}",
     *     summary="Детализация по конкретному адресу (дому)",
     *     tags={"house"},
     *     @SWG\Parameter(
     *         name="houseId",
     *         in="path",
     *         required=true,
     *         description="ИД дома",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="Цифровая подпись",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Логин",
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Expected response to a valid request"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error"
     *     )
     * )
     */
    public function getHouseByIdAction($houseId)
    {
        try {
            $house = $this->housesService->getHouseById($houseId);
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }
        return $house;
    }

    /**
     * @SWG\Get(
     *     path="/house/{houseId}/flats",
     *     summary="Список квартир по конкретному дому",
     *     tags={"house"},
     *     @SWG\Parameter(
     *         name="houseId",
     *         in="path",
     *         required=true,
     *         description="ИД дома",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="Цифровая подпись",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Логин",
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Expected response to a valid request"
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error"
     *     )
     * )
     */
    public function getHouseFlatsAction($houseId)
    {
        try {
            $houseList = $this->flatsService->getHouseFlats($houseId);

        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }

        return $houseList;
    }
}
