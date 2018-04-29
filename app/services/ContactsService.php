<?php

namespace App\Services;

use App\Models\Contacts;
use App\Models\Phones;

/**
 * Business-logic for contacts
 *
 * Class ContactsService
 */
class ContactsService extends AbstractService
{

    /** Unable to create contact */
    const ERROR_UNABLE_CREATE_CONTACT = 11001;

    /** Contact not found */
    const ERROR_CONTACT_NOT_FOUND = 11002;

    /** No such contact */
    const ERROR_INCORRECT_CONTACT = 11003;

    /** Unable to update contact */
    const ERROR_UNABLE_UPDATE_CONTACT = 11004;

    /** Unable to delete contact */
    const ERROR_UNABLE_DELETE_CONTACT = 1105;

    /**
     * Returns contats by flat id
     *
     * @return array
     */
    public function getFlatContacts($flatId)
    {
        try {
            $contacts = Contacts::find(
                [
                    'conditions' => 'flatId = :flatId:',
                    'bind' => [
                        'flatId' => $flatId
                    ],
                    'columns' => "id, date, noteText, nextDate, time, status, flatId",
                ]
            );

            if (!$contacts) {
                return [];
            }
            $contacts = $contacts->toArray();
            foreach ($contacts as &$contact) {
                $phones = Phones::find(
                    [
                        'conditions' => 'contactId = :contactId:',
                        'bind' => [
                            'contactId' => $contact["id"]
                        ],
                        'columns' => "name, phone, code",
                    ]
                );
                if ($phones)
                    $contact["phones"] = $phones->toArray();

            }

            return $contacts;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Creating a new contact
     *
     * @param array $contactData
     */
    public function createContact(array $contactData)
    {
        try {
            $contact = new Contacts();
            $result = $contact->setDate($contactData['date'])
                ->setNoteText($contactData['noteText'])
                ->setNextDate($contactData['nextDate'])
                ->setTime($contactData['time'])
                ->setStatus($contactData['status'])
                ->setFlatId($contactData['flatId'])
                ->create();

            $contactId = $contact->getWriteConnection()->lastInsertId();
            if ($contactData['phones']) {
                foreach ($contactData["phones"] as $phone) {
                    $phones = new Phones();
                    $phone = (array)$phone;
                    $resultPhone = $phones->setName($phone['name'])
                        ->setPhone($phone['phone'])
                        ->setCode($phone['code'])
                        ->setContactId($contactId)
                        ->create();
                }
            }

            if (!$result)
                throw new ServiceException('Unable to create contact', self::ERROR_UNABLE_CREATE_CONTACT);

            return ["contactId" => $contactId];

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Updating an existing contact
     *
     * @param array $contactData
     */
    public function updateContact(array $contactData)
    {
        try {
            $contact = Contacts::findFirst(
                [
                    'conditions' => 'id = :id:',
                    'bind' => [
                        'id' => $contactData['id']
                    ]
                ]
            );

            $result = $contact->setDate($contactData['date'])
                ->setNoteText($contactData['noteText'])
                ->setNextDate($contactData['nextDate'])
                ->setTime($contactData['time'])
                ->setStatus($contactData['status'])
                ->setFlatId($contactData['flatId'])
                ->update();

            $phones = new Phones();
            $currentPhones = Phones::find(
                [
                    'conditions' => 'contactId = :contactId:',
                    'bind' => [
                        'contactId' => $contactData['id']
                    ]
                ]
            );
            $currentPhones->delete();
            if ($contactData['phones']) {
                foreach ($contactData["phones"] as $phone) {
                    $phones = new Phones();
                    $phone = (array)$phone;
                    $resultPhone = $phones->setName($phone['name'])
                        ->setPhone($phone['phone'])
                        ->setCode($phone['code'])
                        ->setContactId($contactData['id'])
                        ->create();
                }
            }

            if (!$result)
                throw new ServiceException('Unable to update contact', self::ERROR_UNABLE_UPDATE_CONTACT);

            return ["contactId" => $contactData['id']];

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete an existing contact
     *
     * @param int $contactData
     */
    public function deleteContact($contactData)
    {
        try {
            $contact = Contacts::findFirst(
                [
                    'conditions' => 'id = :id:',
                    'bind' => [
                        'id' => $contactData
                    ]
                ]
            );

            if (!$contact)
                throw new ServiceException("Contact not found", self::ERROR_USER_NOT_FOUND);

            $result = $contact->delete();

            if (!$result)
                throw new ServiceException('Unable to delete contact', self::ERROR_UNABLE_DELETE_USER);

            return ["deleted" => true];

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
