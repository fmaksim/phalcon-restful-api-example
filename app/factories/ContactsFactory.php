<?php

namespace App\Factories;


use App\Models\Contacts;

class ContactsFactory
{

    /**
     * @param $data
     * @return int inserted id
     */
    public function create(array $data): int
    {
        $contact = new Contacts();
        $result = $this->setData($contact, $data)->create();
        return $result === true ? $contact->getWriteConnection()->lastInsertId() : -1;
    }

    public function setData(Contacts $contact, $data): Contacts
    {
        $contact->setDate($data['date'])
            ->setNoteText($data['note_text'])
            ->setFlatId($data['flat_id']);

        return $contact;
    }

}