<?php

namespace App\Http\Requests\Specialist\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
            'name' => ['required'],
            'contact' => ['array'],
            'region_id' =>['required', 'integer'],
            'district_id' =>['required', 'integer'],
            'address' =>['required', 'string'],
            'inn' =>['required', 'string'],
            'deleted_at' =>['required', 'boolean'],
        ];
    }
}
