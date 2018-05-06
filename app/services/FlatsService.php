<?php

namespace App\Services;

use App\Models\Flats;

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
                    'conditions' => 'houseId = :houseId:',
                    'bind' => [
                        'houseId' => $houseId
                    ],
                    'columns' => "id, flatNumber, status, velcom, name, FIO",
                ]
            );
            if (!$flats)
                return [];

            $flats = $flats->toArray();
            foreach ($flats as &$flat) {
                $flat["velcom"] = ($flat["velcom"] === "1") ? true : false;
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

            return $flat->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
