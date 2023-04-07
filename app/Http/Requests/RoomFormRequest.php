<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomFormRequest extends FormRequest
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
            'code' => ['required', 'min:1','max:10', "unique:rooms"], 
            'capacity' => ['required', 'integer'],
            'reduced_capacity' => ['required', 'integer'],
            'block_code' => ['required', 'min:1', 'max:8', 'exists:blocks,code'],
            'unities' => ['required']
        ];

        if($this->method()=="PUT")#como é o mesmo arquivo de regras tanto pro armazenamento tanto pro update, usa isso pra diferenciar de acordo com o metodo http
        { 
            $rules= [
            'code' => ['required', 'min:1','max:10', "unique:rooms,code,$code,code"], 
            ];
        }

        return $rules;
    }
}
