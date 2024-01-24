<?php

namespace App\Http\Requests\Admin\FormFields;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class UpdateFormFieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required','string'],
            'number' => ['nullable','numeric'],
            'type' => ['required','in:text,number,select,checkbox,radio'],
            'unit' => ['string','nullable'],
            'form_id' => ['required'],
            'step' => ['required_if:type,number','numeric'],
            'required' => ['boolean'],
            'field_category_id' => ['required','numeric'],
            'operator_a' => ['string', 'nullable'],
            'operator_b' => ['string', 'nullable'],
            'operator_c' => ['string', 'nullable'],
            'class' => ['string', 'nullable'],
            'formula' => ['string', 'nullable'],
            'select_fields' => [new RequiredIf(in_array($this->type,['select', 'checkbox','radio'] )), 'string', 'nullable'],
        ];
    }
}
