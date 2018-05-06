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
     *      defaultValue="NWQzMzdlYzlmZGU2N2FkN2ExOWQzZmMwZTJmOGZlZDgwYzAwMjUyMWM1MDhiM2MwYjkzYzFmZjE2ZGI3NWRiYg==",
     *      type="string"
     *     ),
     * @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
     *         defaultValue="admin",
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
     *         defaultValue="1",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC Signature",
     *         defaultValue="ODNmNDg1YmFkM2I5OTBkNDU4ZmM4ZDNmZDcyYTk2ODBhNzM5OTI4ZWZmNjEyZjZlZjNkM2U4OGI0OTBjZjJjNw==",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
     *         defaultValue="admin",
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
     *         defaultValue="1",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC Signature",
     *         defaultValue="YzYwZDJhOGIzYzA3NGFmOTg1ODdkNmY3NGQ3MTY5MDFhN2RiNDRkNGVkMWQ3OTBkMmQxZDhiYWI4MjMyYzgwYw==",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
     *         defaultValue="admin",
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
     *         defaultValue="1",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC Signature",
     *         defaultValue="YmFiY2U1MjhiNjU0MGM3YTA1MWIzNjFiYjc1Y2NlYjg1ZjA4YjQ4OWVjN2M3ZDMwZDgzYjc5Y2RmNjJhYjY4OQ==",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="login",
     *         in="header",
     *         required=true,
     *         description="Login",
     *         defaultValue="admin",
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
