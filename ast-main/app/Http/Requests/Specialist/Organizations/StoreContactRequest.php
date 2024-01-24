<?php

namespace App\Http\Requests\Specialist\Organizations;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest
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
            'name' => ['string', 'max:255'],
            'surname' => ['string', 'max:255', 'nullable'],
            'patronymic' => ['string', 'max:255', 'nullable'],
            'job_tytle' => ['string', 'max:255', 'nullable'],
            'email' => ['string', 'max:255', 'email', 'nullable'],
            'phone' => ['string', 'max:14', 'nullable'],
            'mobile' => ['string', 'max:14', 'nullable'],
            'work_number' => ['string', 'max:14', 'nullable'],
        ];
    }

}
