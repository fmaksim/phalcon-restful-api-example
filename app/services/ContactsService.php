<?php

namespace App\Services;

use App\Models\Contacts;
use App\Models\Phones;
use App\Factories\ContactsFactory;
use App\Services\AbstractService;

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
     * Returns contacts by flat id
     *
     * @return array
     */
    public function getFlatContacts($flatId): array
    {
        try {

            $contacts = Contacts::find(
                [
                    'conditions' => 'flat_id = :flat_id:',
                    'bind' => [
                        'flat_id' => $flatId
                    ],
                ]
            );

            $phones = [];
            foreach ($contacts as $contact) {
                $phones[$contact->getId()] = $contact->phones;
            }

            $contacts = $contacts->toArray();
            foreach ($contacts as &$contact) {
                $contact["phones"] = $phones[$contact["id"]]->toArray();
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
    public function createContact(array $contactData): array
    {
        try {

            $contactId = $this->contactsFactory->create($contactData);
            if (!$contactId)
                throw new ServiceException('Unable to create contact', self::ERROR_UNABLE_CREATE_CONTACT);

            if ($contactData['phones']) {
                foreach ($contactData["phones"] as $contactPhone) {
                    $this->phonesFactory->create($contactPhone, $contactId);
                }
            }

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
    public function updateContact(array $contactData): array
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

            $result = $this->contactsFactory
                ->setData($contact, $contactData)
                ->update();

            $contact->getPhones()->delete();

            if ($contactData['phones']) {
                foreach ($contactData["phones"] as $phone) {
                    $this->phonesFactory->create($phone, $contactData['id']);
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
    public function deleteContact($contactData): array
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

            $contact->getPhones()->delete();
            $result = $contact->delete();

            if (!$result)
                throw new ServiceException('Unable to delete contact', self::ERROR_UNABLE_DELETE_USER);

            return ["deleted" => true];

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
