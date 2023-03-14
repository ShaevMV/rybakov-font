<?php

namespace App\Http\Requests;

class GroupAddRequest extends UserRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'city' => 'required|string',
        ], parent::rules());
    }

    public function messages()
    {
        return
            array_merge([
                'city.required' => 'Выберите город, в котором хотите провести встречу',
            ], parent::messages());
    }
}
