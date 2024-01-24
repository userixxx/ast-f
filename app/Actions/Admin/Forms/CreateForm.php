<?php

namespace App\Actions\Admin\Forms;

use App\Models\Form;

class CreateForm
{
    public function execute($validatedRequest)
    {
        $validatedRequest['creator_id'] = auth()->id();
        return Form::firstOrCreate(['name'=>$validatedRequest['name']], $validatedRequest);
    }
}
