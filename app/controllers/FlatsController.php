<?php

namespace App\Controllers;

use App\Controllers\HttpExceptions\Http500Exception;
use App\Services\ServiceException;

/**
 * Operations with Users: CRUD
 */
class FlatsController extends AbstractController
{

    /**
     * Returns flat by id
     *
     * @return array
     */
    /**
     * @SWG\Get(
     *     path="/flat/{flatId}",
     *     summary="Getting flat info by id",
     *     tags={"flat"},
     *     @SWG\Parameter(
     *         name="flatId",
     *         in="path",
     *         required=true,
     *         description="Flat id",
     *         defaultValue="1",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC Signature",
     *         defaultValue="MWZkOTQ1ZjE4NWRkMzEyMjVkNmIxMGRlOWY0YjUyODc3YmE1MDcyYTU5ZjYzNzRjODU4NWI2MTQ1YTIzZjExYg==",
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
    public function getFlatByIdAction($flatId)
    {
        try {
            return $this->flatsService->getFlatById($flatId);
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
     *     summary="Returns flat contacts list",
     *     tags={"flat"},
     *     @SWG\Parameter(
     *         name="flatId",
     *         in="path",
     *         required=true,
     *         description="Flat ID",
     *         defaultValue="1",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="signature",
     *         in="header",
     *         required=true,
     *         description="MAC Signature",
     *         defaultValue="OGFjMTY2NGJmNDI3MzZjZDFhMWY5N2E0NTQ4NWFiMzMyZDcyZGJiMmNhOWNlY2EwZDE4NDY2MGYxYjg4ZjIzZA==",
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
    public function getFlatContactsAction($flatId)
    {
        try {
            $flatContacts = $this->contactsService->getFlatContacts($flatId);
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }

        return $flatContacts;
    }
}
