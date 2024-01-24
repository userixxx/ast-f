<?php

namespace App\Http\Livewire\Specialist\Report\Create\Partials;

use Livewire\Component;

class SelectFormItem extends Component
{
    public mixed $formField;

    public function __construct($formField)
    {
        $this->formField = $formField;
    }

    public function render()
    {
        return view('livewire.specialist.report.create.partials.select-form-item');
    }
}
