<?php

namespace App\Http\Requests\Specialist\Report;

use Illuminate\Foundation\Http\FormRequest;

class CreateReportRequest extends FormRequest
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
            'form_id' =>['required'],
            'farm_id' => ['required'],
            'organization_id' => ['required'],
            'data' => ['required','array'],
            'date' => ['required','date'],
            'files.*' =>['nullable','max:200000'],
        ];
    }
}
