<?php

namespace App\Http\Livewire\Admin\FormField;

use App\Models\FieldCategory;
use App\Models\Form;
use Livewire\Component;

class Edit extends Component
{
    public $form_field;
    public $field_categories;
    public $field_units;
    public $types = ['text' => 'Строка','number' => 'Число','select' => 'Выпадающий список','checkbox' => 'Чекбокс','radio' => 'Радиокнопка'];
    public $selectedType;
    public $class = 'fillable';

    public function __construct($form_field, $field_categories=null, $field_units=null)
    {
        $this->form_field = $form_field;
        $this->field_categories = $field_categories;
        $this->field_units = $field_units;
    }

    public function mount()
    {
        $this->selectedType = $this->form_field->type;
        $this->class = $this->form_field?->class ?? 'fillable';
    }

    public function render()
    {
        return view('livewire.admin.form-field.edit');
    }
}
