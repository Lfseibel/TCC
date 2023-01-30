<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        $email = $this->email ?? '';

        $rules =[
            'email' => ['required', 'email', 'min:1','max:50', "unique:users"], #se o proprio usuario estiver modificando o proprio email ele abre excecao
            'type' => ['required', 'min:1', 'max:20'],
            'unity_code' => ['required', 'exists:unities,code', 'min:1', 'max:8'],
            'password' => ['required', 'min:1', 'max:60'],
        ];

        if($this->method()=="PUT")#como é o mesmo arquivo de regras tanto pro armazenamento tanto pro update, usa isso pra diferenciar de acordo com o metodo http
        { 
            $rules['password'] = ['nullable', 'min:6', 'max:15'];
            $rules['email'] = ['required', 'email',"unique:users,email,$email,email"];
        }


        return $rules;
    }
}
