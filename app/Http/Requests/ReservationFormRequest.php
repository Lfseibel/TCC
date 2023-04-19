<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationFormRequest extends FormRequest
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
        $code = $this->code ?? '';

        $rules =[
            'frequency' => ['required'],
            'weekday' => ['required'],
            'acronym' => ['nullable','min:1','max:12'], 
            'class' => ['nullable','min:1', 'max:6'],
            'description' => ['required', 'min:1', 'max:60'],
            'observation' => ['required', 'min:1', 'max:120'],
            'responsible' => ['required', 'min:1', 'max:120'],
            'startTime' => ['required'],
            'endTime' => ['required'],
            'room_code' => ['required', 'min:1', 'max:10', 'exists:rooms,code']
        ];

        return $rules;
    }
}
