<?php

namespace App\Admin\Requests;

use App\Admin\Requests\FormRequest;
use Illuminate\Support\Arr;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'type' => 'required',
            'simple_name' => '',
            'is_can_edit' => 'required|boolean',
            'remark' => ''
        ];
        if ($this->isMethod('put')) {
            $rules = Arr::only($rules, $this->keys());
        }
        return $rules;
    }
}
