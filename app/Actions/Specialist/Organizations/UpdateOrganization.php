<?php

namespace App\Actions\Specialist\Organizations;

use App\Models\Organization;

class UpdateOrganization
{
    public function execute($validatedRequest, $organization)
    {
        return $organization->update($validatedRequest);
    }
}
