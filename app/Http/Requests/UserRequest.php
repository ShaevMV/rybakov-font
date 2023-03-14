<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        Validator::extend('cyrillic', function ($attributes, $value, $parameters) {
            return preg_match( "/(^([А-Яа-яЁё]+)(^\d+)?$)/u", $value );
        });
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone' => [
                'required',
                'regex:/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/'
            ],
            'email' => ['required', 'email',
                Rule::unique('users')
                    ->ignore(auth()->id() ?? 0)
            ],
        ];
    }

    public function messages()
    {

        return [
            '*.required' => 'Поле обязательно для ввода',
            '*.required_if' => 'Поле обязательно для ввода',
            '*.regex' => 'Номер телефона указан не полностью',
            '*.unique' => 'Пользователь с таким емайлом уже зарегистрирован в системе',
            '*.email.email' => 'Неверный тип электронной почты',
            '*.email.unique' => 'Пользователь с такой почтой уже зарегистрирован в системе',
        ];
    }
}
