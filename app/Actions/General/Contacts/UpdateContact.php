<?php

namespace App\Actions\General\Contacts;

use App\Models\Contact;

class UpdateContact
{
    public function execute($validatedRequest, $id)
    {
        $contact = Contact::withTrashed()->find($id);
        $contact->update($validatedRequest);
        return $contact;
    }
}
