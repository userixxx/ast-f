<?php

namespace App\Actions\Specialist\Organizations;

use App\Models\Contact;

class UpdateContacts
{
    public function execute($validatedRequest, $organization)
    {
        $contact = new Contact();
        $validatedRequest['contact']['contactable_id'] = $organization->id;
        $contact->fill($validatedRequest['contact']);
        $contact->organization()->associate($contact);
        $contact->save();
        return $contact;
    }
}
