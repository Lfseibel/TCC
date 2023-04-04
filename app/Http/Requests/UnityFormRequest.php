<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnityFormRequest extends FormRequest
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
            'code' => ['required', 'min:1','max:8','unique:unities,code'],
            'name' => ['required', 'min:1', 'max:60', ],
        ];

        if($this->method()=="PUT")#como é o mesmo arquivo de regras tanto pro armazenamento tanto pro update, usa isso pra diferenciar de acordo com o metodo http
        { 
            $rules['code'] = ['required',"unique:unities,code,$code,code"];
        }
        return $rules;
    }
}
