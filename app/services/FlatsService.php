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
    public function getHouseFlats($houseId)
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
            if (!$flats) {
                return [];
            }
            $flats = $flats->toArray();
            foreach ($flats as &$flat) {
                $flat["velcom"] = ($flat["velcom"] === "1") ? true : false;
            }

            return $flats;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
