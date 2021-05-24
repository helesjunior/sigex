<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CodigoRequest
 *
 * @package App\Http\Requests
 * @author Anderson Sathler <asathler@gmail.com
 */
class CodigoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @author Anderson Sathler <asathler@gmail.com
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
     * @author Anderson Sathler <asathler@gmail.com
     */
    public function rules()
    {
        return [
            'descricao' => [
                'required',
                'min:4',
                'max:100',
                Rule::unique('codigos')->ignore(Request()->get('id')),
            ],
            'visivel' => [
                'boolean'
            ]
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     * @author Anderson Sathler <asathler@gmail.com
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
     * @author Anderson Sathler <asathler@gmail.com
     */
    public function messages()
    {
        return [
            // Default messages are already set
        ];
    }
}
