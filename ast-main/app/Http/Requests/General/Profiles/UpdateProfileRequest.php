<?php

namespace App\Http\Requests\General\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3'],
            'surname' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'string', 'min:12', 'max:12'],
            'email' => ['required', 'email'],
            'job_title' => ['required', 'string', 'min:3'],
        ];
    }
}
