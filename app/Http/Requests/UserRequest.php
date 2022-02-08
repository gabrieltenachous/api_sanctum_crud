<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /** 
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /** 
     * @return array
     */
    public function rules()
    {
        if($this->method() == "POST"){
            //Create
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'type'=> 'required|min:1|max:2|integer',
                'status'=>'required|boolean'
            ];
        }else if($this->method() == "PUT"){ 
            //Update 
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$this->user,
                'password' => 'required|string|min:8',
                'type'=> 'required|min:1|max:2|integer',
                'status'=>'required|boolean'
            ];
        }
        
    }
 
    public function messages()
    {
        return [
            'name.max'=>'Nome deve ter no maximo 255 caracteres',
            'name.required'=>'Nome é tipo string',
            'name.required'=>'Nome é obrigatorio',
            'email.required' => 'Email é obrigatório!',
            'email.string' => 'Email é tipo string!',
            'email.email' => 'Email incorreto!',
            'email.max' => 'Email deve ter no maximo 255 caracteres!',
            'email.unique' => 'Email já existe',
            'password.required' => 'Senha é obrigatório!',
            'password.min' => 'Senha minimo de 8 caracteres',
            'password.string' => 'Senha tem que ser string',
            'status.required' =>'Status é obrigatório!',
            'status.boolean'=>'Status é booleano(true/false)', 
            'type.required'=>'Tipo é obrigatório', 
            'type.min'=>'Tipo minimo 0',
            'type.max'=>'Tipo maximo 1',
            'type.integer'=>'Tipo é inteiro',
        ];
    }
}
