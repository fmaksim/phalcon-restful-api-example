<?php

namespace App\Services;

use App\Models\Streets;

/**
 * Business-logic for streets
 *
 * Class StreetsService
 */
class StreetsService extends AbstractService
{

    /**
     * Returns streets list
     *
     * @return array
     */
    public function getStreetsList()
    {
        try {
            $streets = Streets::find(
                [
                    'conditions' => '',
                    'bind' => [],
                    'columns' => "id, street, streetType",
                ]
            );
            if (!$streets) {
                return [];
            }

            return $streets->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
