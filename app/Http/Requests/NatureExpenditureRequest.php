<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CodeRequest
 *
 * @package App\Http\Requests
 * @author Saulo Soares <saulosao@gmail.com
 */
class NatureExpenditureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @author Saulo Soares <saulosao@gmail.com
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
     * @author Saulo Soares <saulosao@gmail.com
     */
    public function rules()
    {
        return [
            'description' => [
                'required',
                'min:4',
                'max:100',
                Rule::unique('nature_expenditures')->ignore(Request()->get('id')),
            ],
            'status' => [
                'boolean'
            ]
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     * @author Saulo Soares <saulosao@gmail.com
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
     * @author Saulo Soares <saulosao@gmail.com
     */
    public function messages()
    {
        return [
            // Default messages are already set
        ];
    }
}
