<?php

namespace App\Services;

use App\Components\SignatureHelper;
use App\Models\Streets;

/**
 * Business-logic for streets
 *
 * Class StreetsService
 */
class StreetsService extends AbstractService
{

    public function __construct(SignatureHelper $signatureHelper)
    {
        $signatureHelper->call($this->app);
    }

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
                    'columns' => "id, street, street_type",
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
