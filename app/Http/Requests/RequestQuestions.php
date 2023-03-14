<?php

namespace App\Http\Requests;

use App\Models\Direction;
use Illuminate\Foundation\Http\FormRequest;

class RequestQuestions extends FormRequest
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
            'data.text' => 'required',
            'data.options' => 'array',
            'data.type' => 'required|in:text,option,many,testing',
            'typeQuestion' => 'required|in:'.implode (',',array_merge(Direction::DIRECTION_LIST,['any']))
        ];
    }
}
