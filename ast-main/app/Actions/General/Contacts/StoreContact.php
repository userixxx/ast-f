<?php

namespace App\Actions\General\Contacts;

use App\Models\Contact;

class StoreContact
{
    public function execute($validatedRequest)
    {
        return Contact::create($validatedRequest);
    }
}
