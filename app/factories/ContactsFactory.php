<?php

namespace App\Factories;


use App\Models\Contacts;

class ContactsFactory
{

    public function create($data): Contacts
    {
        $contact = new Contacts();
        $contact = $this->setData($contact, $data)->create();

        return $contact;
    }

    public function setData(Contacts $contact, $data): Contacts
    {
        $contact->setDate($data['date'])
            ->setNoteText($data['note_text'])
            ->setFlatId($data['flat_id']);

        return $contact;
    }

}