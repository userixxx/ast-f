<?php

namespace App\Http\Requests\Admin\ComputedFormFields;

use Illuminate\Foundation\Http\FormRequest;

class StoreComputedFormFieldRequest extends FormRequest
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
            'name' => ['required','string', 'unique:form_fields'],
            'unit' => ['string','nullable'],
            'form_id' => ['required'],
            'field_category_id' => ['required','numeric'],
            'required' => ['boolean'],
            'operator_a' => ['required','string'],
            'operator_b' => ['required','string'],
            'operator_c' => ['required','string'],
            'formula' => ['string', 'nullable'],
        ];
    }
}
