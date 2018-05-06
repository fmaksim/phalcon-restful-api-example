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
            $houses = Houses::find();

            if (!$houses)
                return [];

            $streets = [];
            $flatsCounters = [];

            foreach ($houses as $house) {
                $streets[$house->getId()] = $house->streets->toArray();
                $flatsCounters[$house->getId()] = $house->countFlats();
            }

            $houses = $houses->toArray();
            foreach ($houses as &$house) {
                $house["address"] = Houses::getAddress($house, $streets[$house["id"]]);
                $house["flats_count"] = $flatsCounters[$house["id"]];

                unset($house["street_id"]);
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
                    'conditions' => 'street_id = :street_id:',
                    'bind' => [
                        'street_id' => $streetId
                    ],
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
                ]
            );

            if (!$house)
                return [];

            $street = $house->streets->toArray();
            $flatsCount = $house->countFlats();

            $house = $house->toArray();
            $house["address"] = Houses::getAddress($house, $street);
            $house["flats_count"] = $flatsCount;

            return $house;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
