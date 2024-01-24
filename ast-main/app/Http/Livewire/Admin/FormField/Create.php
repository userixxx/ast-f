<?php

namespace App\Http\Livewire\Admin\FormField;

use App\Models\Unit;
use Livewire\Component;


class Create extends Component
{
    public $form;
    public $field_categories;
    public $field_units;
    public $types = ['text' => 'Строка','number' => 'Число','select' => 'Выпадающий список','checkbox' => 'Чекбокс','radio' => 'Радиокнопка'];
    public $selectedType = 'text';
    public $class = 'fillable';

    public function __construct($form, $field_categories = null, $field_units=null)
    {
        $this->form = $form;
        $this->field_categories = $field_categories;
        $this->field_units = Unit::all();
    }

    public function updatedSelectedType($value, $key)
    {

    }

    public function render()
    {
        return view('livewire.admin.form-field.create');
    }


}
