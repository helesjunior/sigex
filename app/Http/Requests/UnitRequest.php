<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'siafi_code' => ['required', 'unique:units,siafi_code,' . $this->id . ',id'],
            // 'siasg_code' => ['required', 'unique:units,siasg_code,' . $this->id . ',id'],
            'siorg_code' => ['unique:units,siorg_code,' . $this->id . ',id'],
            'description' => ['required', 'min:5', 'max:255'],
            'short_name' => ['required', 'min:3', 'max:50'],
            'country_id' => ['required'],
            // 'state_id' => [''],
            // 'city_id' => [''],
            'phone' => ['max:20'],
            'timezone' => ['required'],
            'organ_id' => ['required'],
            'currency_id' => ['required'],
            'type_id' => ['required'],
            'status' => ['boolean']
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
