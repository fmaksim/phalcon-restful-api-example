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

    /**
     * Returns house list
     *
     * @return array
     */
    /**
     * @SWG\Get(
     *   path="/house",
     *   summary="Returns house list",
     *   tags={"house"},
     * @SWG\Parameter(
     *      name="signature",
     *      in="header",
     *      required=true,
     *      description="MAC Signature",
     *      type="string"
     *     ),
     * @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
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
     *     summary="House list by street id",
     *     tags={"house"},
     *     @SWG\Parameter(
     *         name="streetId",
     *         in="path",
     *         required=true,
     *         description="Street Id",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC Signature",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
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
     *     summary="Getting house detail info by id",
     *     tags={"house"},
     *     @SWG\Parameter(
     *         name="houseId",
     *         in="path",
     *         required=true,
     *         description="House ID",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC Signature",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
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
     *     summary="Flats list by house ID",
     *     tags={"house"},
     *     @SWG\Parameter(
     *         name="houseId",
     *         in="path",
     *         required=true,
     *         description="House id",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC Signature",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
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
