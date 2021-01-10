<?php

namespace App\Admin\Requests;

use App\Admin\Requests\FormRequest;
use Illuminate\Support\Arr;

class DictItemRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'field_name' => 'required',
        ];

        if ($this->isMethod('put')) {
            $rules = Arr::only($rules, $this->keys());
        }

        return $rules;
    }

    public function messages()
    {
        return [
            //
        ];
    }

    public function attributes()
    {
        return [
            'field_name' => '字段名',
        ];
    }
}
