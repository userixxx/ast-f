<?php

namespace App\Http\Requests\General\Contacts;

use App\Models\Interfaces\Contactable;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'contactable_type' => ['string'],
            'contactable_id' => ['string'],
            'name' => ['string', 'nullable'],
            'surname' => ['string', 'nullable'],
            'patronymic' => ['string', 'nullable'],
            'phone' => ['string', 'nullable'],
            'mobile' => ['string', 'nullable'],
            'work_number' => ['string', 'nullable'],
            'job_title' => ['string', 'nullable'],
            'email' => ['email', 'nullable'],
        ];
    }
}
