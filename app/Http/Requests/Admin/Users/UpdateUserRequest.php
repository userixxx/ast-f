<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class UpdateUserRequest extends FormRequest
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
            'name' => [ 'string', 'max:255', 'nullable'],
            'surname' => [ 'string', 'max:255', 'nullable'],
            'email' => [ 'string', 'email', 'max:255', 'nullable'],
            'phone' => [ 'string', 'max:255','regex:/^\+79\d{9}$/', 'nullable'],
            'job_title' => [ 'string', 'max:255', 'nullable'],
            'deleted_at' => [ 'in:1,0','nullable'],
            'roles' => ['array', 'nullable']
        ];
    }
}
