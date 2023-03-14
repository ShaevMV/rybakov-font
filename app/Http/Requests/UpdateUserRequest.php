<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateUserRequest extends RegistrationUserRequest
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
        $idUser = auth()->id();

        return [
            'users.email' => ['required', 'email',
                Rule::unique('users')
                    ->ignore($idUser)
            ],
            'organizations.name_organization' => 'required_if:staff,true',
            'organizations.address' => 'required_if:staff,true',
            'users.name' => 'required|string',
            'users.password' => 'confirmed|min:6',
            'users.phone' => [
                'required',
                'regex:/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/'
            ],
        ];
    }


}
