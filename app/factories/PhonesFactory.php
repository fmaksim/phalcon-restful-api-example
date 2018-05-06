<?php

namespace App\Factories;


use App\Models\Phones;

class PhonesFactory
{

    public function create($data, $contactId): bool
    {
        $data = (array)$data;
        $phone = new Phones();

        return $phone
            ->setName($data['name'])
            ->setPhone($data['phone'])
            ->setCode($data['code'])
            ->setContactId($contactId)
            ->create();

    }

}