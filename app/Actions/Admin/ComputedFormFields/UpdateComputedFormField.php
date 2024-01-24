<?php

namespace App\Actions\Admin\ComputedFormFields;

use App\Models\ComputedFormField;

class UpdateComputedFormField
{
    public function execute($validatedRequest, $id)
    {
        $computedFormField = ComputedFormField::withTrashed()->find($id);
        $computedFormField->update($validatedRequest);
        return $computedFormField;
    }
}
