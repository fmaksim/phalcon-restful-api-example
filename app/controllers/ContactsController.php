<?php

namespace App\Controllers;

use App\Controllers\HttpExceptions\Http400Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Controllers\HttpExceptions\Http500Exception;
use App\Services\AbstractService;
use App\Services\ServiceException;
use App\Services\UsersService;

/**
 * Operations with Contacts: CRUD
 */
class ContactsController extends AbstractController
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
     * @SWG\Post(
     *     path="/contact",
     *     tags={"contact"},
     *     summary="Adding new contact",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Contact data",
     *         required=true,
     *         value = "",
     *         @SWG\Schema(ref="#/definitions/Contacts"),
     *     ),
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
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input",
     *     )
     * )
     */
    public function addContactAction()
    {

        $data = (array)$this->request->getJsonRawBody();
        $errors = $this->validate($data);

        if (empty($data['flatId']))
            $errors['flatId'] = 'FlatId expected';

        if ($errors) {
            $exception = new Http400Exception(_('Input parameters validation error'), self::ERROR_INVALID_REQUEST);
            throw $exception->addErrorDetails($errors);
        }

        /** Passing to business logic and preparing the response **/
        try {
            return $this->contactsService->createContact($data);
        } catch (ServiceException $e) {
            switch ($e->getCode()) {
                case AbstractService::ERROR_ALREADY_EXISTS:
                case ContactsService::ERROR_UNABLE_CREATE_CONTACT:
                    throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
                default:
                    throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
            }
        }
        /** End Passing to business logic and preparing the response  **/
    }

    /**
     * @SWG\Put(
     *     path="/contact/{contactId}",
     *     tags={"contact"},
     *     summary="Редактирование контакта",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="contactId",
     *         in="path",
     *         required=true,
     *         description="ИД контакта",
     *         defaultValue="d34fa50e61b93c4139dad598242ddd42ecbd2fcef3151fe40446e8f5962a03e5admin5"
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
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Данные контакта",
     *         required=true,
     *         value = "ssss",
     *         @SWG\Schema(ref="#/definitions/Contact"),
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input",
     *     )
     * )
     */
    public function editContactAction($contactId)
    {

        $data = (array)$this->request->getJsonRawBody();
        $errors = $this->validate($data);

        if (!ctype_digit($contactId) || ($contactId < 0))
            $errors['id'] = 'Id must be a positive integer';

        $data['id'] = (int)$contactId;

        if ($errors) {
            $exception = new Http400Exception(_('Input parameters validation error'), self::ERROR_INVALID_REQUEST);
            throw $exception->addErrorDetails($errors);
        }

        try {
            return $this->contactsService->updateContact($data);
        } catch (ServiceException $e) {
            switch ($e->getCode()) {
                case ContactsService::ERROR_UNABLE_UPDATE_CONTACT:
                case ContactsService::ERROR_CONTACT_NOT_FOUND:
                    throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
                default:
                    throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
            }
        }
    }

    /**
     * @SWG\Delete(
     *     path="/contact/{contactId}",
     *     tags={"contact"},
     *     summary="Удаление контакта",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="contactId",
     *         in="path",
     *         required=true,
     *         description="ИД контакта",
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
     *         response=405,
     *         description="Invalid input",
     *     )
     * )
     */
    public function deleteContactAction($contactId)
    {
        if (!ctype_digit($contactId) || ($contactId < 0))
            $errors['userId'] = 'Id must be a positive integer';

        try {
            return $this->contactsService->deleteContact((int)$contactId);
        } catch (ServiceException $e) {
            switch ($e->getCode()) {
                case ContactsService::ERROR_UNABLE_DELETE_USER:
                case ContactsService::ERROR_USER_NOT_FOUND:
                    throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
                default:
                    throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
            }
        }
    }

    private function validate($data): array
    {
        $errors = [];

        if (empty($data['time']))
            $errors['time'] = 'Time expected';

        if (empty($data['date']))
            $errors['date'] = 'Date expected';

        if (empty($data['noteText']) && (!is_string($data['noteText'])))
            $errors['noteText'] = 'noteText expected';

        if (empty($data['status']) && (!is_string($data['status'])))
            $errors['status'] = 'Status expected';

        if (empty($data['nextDate']) && (!is_string($data['nextDate'])))
            $errors['nextDate'] = 'NextDate expected';

        return $errors;
    }

}
