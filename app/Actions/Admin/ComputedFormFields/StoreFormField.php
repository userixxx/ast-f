<?php

namespace App\Actions\Admin\ComputedFormFields;

use App\Models\ComputedFormField;

class StoreFormField
{
    public function execute($validatedRequest)
    {
        $formField = ComputedFormField::firstOrCreate([
            'name' => $validatedRequest['name'],
            'form_id' => $validatedRequest['form_id'],
        ],$validatedRequest);
        return $formField;
    }
}
