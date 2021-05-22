<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreditorsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id ?? "NULL";
        $cpf_cnpj = '';
        if($this->type_id == 1 or $this->type_id == 2){
            $cpf_cnpj = 'cpf_cnpj|';
        }

        return [
             'type_id' => 'required',
             'code' => "required|{$cpf_cnpj}unique:creditors,code,{$id}",
             'name' => 'required|min:5|max:255',
             'address' => 'required|min:5|max:255',
             'number' => 'required',
             'consortium' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
