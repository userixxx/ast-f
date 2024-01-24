<?php

namespace App\Actions\Specialist\Organizations;

use App\Http\Requests\Specialist\Organizations\StoreOrganizationRequest;
use App\Models\Organization;
use App\Services\DadataService;
use Illuminate\Support\Str;
use function App\Helpers\collectR;

class StoreOrganisation
{
    public function execute($validatedRequest, $organizationFromDadata=null)
    {


        $validatedRequest['kpp'] = '';
        $validatedRequest['ogrn'] = '';
        $validatedRequest['data'] = '[]';
        $validatedRequest['creator_id'] = auth()->id();

        return Organization::firstOrCreate(['inn' => $validatedRequest['inn']],$validatedRequest);

    }
}
