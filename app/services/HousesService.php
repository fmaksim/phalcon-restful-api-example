<?php

namespace App\Services;

use App\Models\Houses;

/**
 * Business-logic for houses
 *
 * Class HousesService
 */
class HousesService extends AbstractService
{

    /**
     * Returns houses list
     *
     * @return array
     */
    public function getHousesList(): array
    {
        try {
            $houses = Houses::find(
                [
                    'conditions' => '',
                    'bind' => [],
                    'columns' => "id, street, streetType, streetId, house, housing, flatsCount, velcom, other, percent",
                ]
            );

            if (!$houses)
                return [];

            $houses = $houses->toArray();
            foreach ($houses as &$house) {
                $house["velcom"] = ($house["velcom"] === "1") ? true : false;
            }

            return $houses;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns houses list by street
     *
     * @return array
     */
    public function getHousesListByStreet($streetId): array
    {
        try {
            $houses = Houses::find(
                [
                    'conditions' => 'streetId = :streetId:',
                    'bind' => [
                        'streetId' => $streetId
                    ],
                    'columns' => "id, house, housing",
                ]
            );

            if (!$houses)
                return [];

            return $houses->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns house by id
     *
     * @return array
     */
    public function getHouseById($houseId): array
    {
        try {
            $house = Houses::findFirst(
                [
                    'conditions' => 'id = :id:',
                    'bind' => [
                        'id' => $houseId
                    ],
                    'columns' => "id, leader, employer, startWorkingTime, endWorkingTime",
                ]
            );

            if (!$house)
                return [];

            return $house->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
