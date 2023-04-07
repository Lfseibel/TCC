<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarFormRequest extends FormRequest
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
        $rules =[
            'year' => ['required', 'integer'], 
            'period' => ['required', 'integer'],
            'limitDate' => ['required', 'date'],
            'startSemester' => ['required', 'date'],
            'endSemester' => ['required', 'date'],
        ];

        return $rules;
    }
}
