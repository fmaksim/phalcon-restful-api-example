<?php

namespace App\Controllers;

use App\Controllers\HttpExceptions\Http400Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Controllers\HttpExceptions\Http500Exception;
use App\Services\AbstractService;
use App\Services\ServiceException;
use App\Services\UsersService;
use App\Services\ContactsService;

/**
 * Operations with Users: CRUD
 */
class FlatsController extends AbstractController
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
     * Returns flat by id
     *
     * @return array
     */
    /**
     * @SWG\Get(
     *     path="/flat/{flatId}",
     *     summary="Получение информации по конкретной квартире",
     *     tags={"flat"},
     *     @SWG\Parameter(
     *         name="flatId",
     *         in="path",
     *         required=true,
     *         description="ИД квартиры",
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
    public function getFlatByIdAction($flatId)
    {
        try {
            $flat = array(
                "id" => $flatId,
                "date" => "12.12.2017",
                "provider" => "Velcom",
                "payment" => "100",
                "noteText" => "Примечание"
            );
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }

        return $flat;
    }

    /**
     * Returns flat contacts list
     *
     * @return array
     */
    /**
     * @SWG\Get(
     *     path="/flat/{flatId}/contacts",
     *     summary="Получение списка контактов по квартире",
     *     tags={"flat"},
     *     @SWG\Parameter(
     *         name="flatId",
     *         in="path",
     *         required=true,
     *         description="ИД квартиры",
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
    public function getFlatContactsAction($flatId)
    {
        try {
            $flatContacts = $this->contactsService->getFlatContacts($flatId);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }

        return $flatContacts;
    }
}
