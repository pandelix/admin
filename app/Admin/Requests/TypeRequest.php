<?php

namespace App\Admin\Requests;

use App\Admin\Requests\FormRequest;
use Illuminate\Support\Arr;

class TypeRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'type_name' => 'required',
            'simple_name' => '',
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
