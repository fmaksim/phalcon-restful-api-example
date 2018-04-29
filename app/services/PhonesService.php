<?php

namespace App\Services;

use App\Models\Phones;

/**
 * Business-logic for phones
 *
 * Class PhonesService
 */
class PhonesService extends AbstractService
{

    /**
     * Creating a new phones
     *
     * @param array $contactData
     */
    public function createPhones($contactData)
    {
        try {
            $resultPhone = true;
            //$this->deletePhones($contactData['id']);
            if ($contactData["phones"]) {
                foreach ($contactData["phones"] as $phone) {
                    $phones = new Phones();
                    $phone = (array)$phone;
                    $resultPhone = $phones->setName($phone['name'])
                        ->setPhone($phone['phone'])
                        ->setCode($phone['code'])
                        ->setContactId($contactData['id'])
                        ->create();
                }

                if (!$resultPhone)
                    throw new ServiceException("Unable to create phone!");

            }
            return $resultPhone;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete an existing contact phones
     *
     * @param int $contactId
     */
    public function deletePhones($contactId)
    {
        try {

            $result = true;
            $phones = $this->getPhones($contactId, false);
            /*$phones = Phones::find(
                [
                    'conditions' => 'contactId = :contactId:',
                    'bind' => [
                        'contactId' => $contactId
                    ],
                    'columns' => "name, phone, code",
                ]
            );*/
            //$phones = $phones->toArray();
            if ($phones) {
                foreach ($phones as $phone) {
                    $phone->delete();
                }
            }

            if (!$result)
                throw new ServiceException("Unable to delete phones!");

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns phones
     *
     * @return array
     */
    public function getPhones($contactId, $needArray = true)
    {
        try {
            $phones = Phones::find(
                [
                    'conditions' => 'contactId = :contactId:',
                    'bind' => [
                        'contactId' => $contactId
                    ],
                    'columns' => "id, name, phone, code, contactId",
                ]
            );
            if (!$phones) {
                return [];
            }

            return ($needArray === true) ? $phones->toArray() : $phones;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }


}
