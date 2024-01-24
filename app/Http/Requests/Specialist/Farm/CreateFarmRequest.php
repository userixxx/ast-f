<?php

namespace App\Http\Requests\Specialist\Farm;

use Illuminate\Foundation\Http\FormRequest;

class CreateFarmRequest extends FormRequest
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
            'organization_id' => ['uuid', 'required'],
            'region_id' => ['integer', 'required'],
            'district_id' => ['integer', 'required'],
            'address' => ['string', 'required'],
            'name' => ['string', 'required'],
            'contact_name' => ['string', 'nullable'],
            'contact_job_title' => ['string', 'nullable'],
            'contact_value' => ['string', 'nullable'],
        ];
    }
}
