<?php

namespace App\Http\Requests;


class RegistrationUserRequest extends UserRequest
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
     * @return array
     */
    public function rules()
    {
        return array_merge([
            'password' => 'required|confirmed|min:6',
            'kindergarten' => 'required_if:staff,true',
            'kindergartenAddress' => 'required_if:staff,true',
            'organization' => 'required_if:userType,false|string',
            'position' => 'required_if:userType,false|string',
            'address' => 'required_if:userType,false|string',
        ], parent::rules());
    }

    public function messages()
    {
        return array_merge([
            '*.min' => 'Длина пароля минимум 6 символов',
            '*.confirmed' => 'Пароль и подтверждение не совпадают',
        ], parent::messages());
    }
}
