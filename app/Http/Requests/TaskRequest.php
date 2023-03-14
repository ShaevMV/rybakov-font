<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'content' => 'required_if:type,text,video',
            'type' => 'required|in:text,video,testing',
        ];
    }


    public function messages()
    {
        return [
            '*.required' => 'Поле обязательно для ввода'
        ];
    }
}
