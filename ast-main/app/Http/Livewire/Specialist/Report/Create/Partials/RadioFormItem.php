<?php

namespace App\Http\Livewire\Specialist\Report\Create\Partials;

use Livewire\Component;

class RadioFormItem extends Component
{
    public mixed $formField;

    public function __construct($formField)
    {
        $this->formField = $formField;
    }

    public function render()
    {
        return view('livewire.specialist.report.create.partials.radio-form-item');
    }
}
