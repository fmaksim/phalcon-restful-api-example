<?php

namespace App\Factories;


use App\Models\Phones;

class PhonesFactory
{

    public function create($data, $contactId): Phones
    {
        $data = (array)$data;
        $phone = new Phones();

        $phone = $phone
            ->setName($data['name'])
            ->setPhone($data['phone'])
            ->setCode($data['code'])
            ->setContactId($contactId)
            ->create();

        return $phone;
    }

}