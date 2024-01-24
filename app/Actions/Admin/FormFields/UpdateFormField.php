<?php

namespace App\Actions\Admin\FormFields;

use App\Models\FormField;
use Illuminate\Support\Facades\DB;

class UpdateFormField
{
    public function execute($validatedRequest, $id)
    {
        $formField = FormField::withTrashed()->find($id);
        $type = $validatedRequest['type'];
        $formField->update($validatedRequest);
        if(!in_array($type, ['select', 'radio', 'checkbox'])) {
            DB::table('form_fields')->where(['id' => $id])->update(['select_fields' => null]);
        }

        return $formField;
    }
}
