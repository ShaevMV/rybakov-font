<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatformRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'link' => 'required|url',
            'active' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Поле обязательно для ввода',
            '*.url' => 'Поле должно быть типа url, например https://www.google.com'
        ];
    }
}
