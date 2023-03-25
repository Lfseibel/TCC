<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleFormRequest extends FormRequest
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
            'code' => ['required', 'min:1','max:8',"unique:schedules"], 
            'startTime' => ['required', 'time'],
            'endTime' => ['required', 'time'],
        ];

        return $rules;
    }
}