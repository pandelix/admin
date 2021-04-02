<?php

namespace App\Admin\Requests;

use App\Admin\Requests\FormRequest;
use Illuminate\Support\Arr;

class RemindRequest extends FormRequest
{
    public function rules()
    {
        $rules = [

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
        return [

        ];
    }
}
