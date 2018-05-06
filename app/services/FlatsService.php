<?php

namespace App\Services;

use App\Models\Contacts;
use App\Models\Flats;
use App\Models\Phones;

/**
 * Business-logic for flats
 *
 * Class FlatsService
 */
class FlatsService extends AbstractService
{

    /**
     * Returns house flats list
     *
     * @return array
     */
    public function getHouseFlats($houseId): array
    {
        try {

            $flats = Flats::find(
                [
                    'conditions' => 'house_id = :house_id:',
                    'bind' => [
                        'house_id' => $houseId
                    ],
                ]
            );
            if (!$flats)
                return [];

            $contacts = [];
            foreach ($flats as $flat) {
                $contacts[$flat->getId()] = $flat->contacts;
            }

            $flats = $flats->toArray();
            foreach ($flats as &$flat) {
                $flat["contacts"] = $contacts[$flat["id"]]->toArray();
                if ($flat["contacts"]) {
                    foreach ($flat["contacts"] as &$contact) {
                        $contact["phones"] = Phones::findByContactId($contact["id"])->toArray();
                    }
                }
                unset($flat["house_id"]);
            }

            return $flats;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns flat by id
     *
     * @return array
     */
    public function getFlatById($flatId): array
    {
        try {
            $flat = Flats::findFirst(
                [
                    'conditions' => 'id = :id:',
                    'bind' => [
                        'id' => $flatId
                    ],
                ]
            );

            if (!$flat)
                return [];

            $houseInfo = $flat->houses->toArray();
            $contacts = $flat->contacts->toArray();
            $flat = $flat->toArray();

            $flat["contacts"] = $contacts;
            $flat["house"] = $houseInfo;
            if ($flat["contacts"]) {
                foreach ($flat["contacts"] as &$contact) {
                    $contact["phones"] = Phones::findByContactId($contact["id"])->toArray();
                }
            }
            return $flat;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
