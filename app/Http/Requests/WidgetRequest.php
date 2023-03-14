<?php

namespace App\Http\Requests;

use App\Classes\Widget\WidgetContainer;
use Illuminate\Foundation\Http\FormRequest;

class WidgetRequest extends FormRequest
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
        return [
            'title' => 'required|string',
            'sort' => 'required|integer',
            'active' => 'required|boolean',
            'template' => 'required|in:'.implode(',',WidgetContainer::TEMPLATE_LIST),
            'params' => 'required|json'
        ];
    }
}
