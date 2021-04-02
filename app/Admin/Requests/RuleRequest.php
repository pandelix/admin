<?php

namespace App\Admin\Requests;

use App\Admin\Requests\FormRequest;
use Illuminate\Support\Arr;

class RuleRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'content' => 'required',
            'rule_name' => 'required',
            'simple_name' => 'required',
            'sort' => 'integer',
            'status' => 'required|boolean',
        ];

        if ($this->isMethod('put')) {
            $rules = Arr::only($rules, $this->keys());
        }

        return $rules;
    }

    public function messages()
    {
        return [
        ];
    }

    public function attributes()
    {
        return ['sort' => '排序值'];
    }
}
