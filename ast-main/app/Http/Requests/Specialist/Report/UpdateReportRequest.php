<?php

namespace App\Http\Requests\Specialist\Report;

class UpdateReportRequest extends \Illuminate\Foundation\Http\FormRequest
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
            'data' => ['required','array'],
            'date' => ['required','date'],
            'form_files.*' =>['nullable'],
            'media_items.*' =>['nullable'],
        ];
    }
}
