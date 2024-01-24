<?php

namespace App\Actions\Specialist\Farm;

use App\Models\Farm;

class CreateFarm
{
    public function execute($validatedRequest)
    {
        return Farm::firstOrCreate([
            'region_id' => $validatedRequest['region_id'],
            'district_id' => $validatedRequest['district_id'],
            'organization_id' => $validatedRequest['organization_id'],
            'name' => $validatedRequest['name'],
        ],
            [
                'region_id' => $validatedRequest['region_id'],
                'district_id' => $validatedRequest['district_id'],
                'organization_id' => $validatedRequest['organization_id'],
                'name' => $validatedRequest['name'],
                'address' => $validatedRequest['address'],
                'contact_name' => $validatedRequest['contact_name'],
                'contact_job_title' => $validatedRequest['contact_job_title'],
                'contact_value' => $validatedRequest['contact_value'],
            ]);
    }
}
