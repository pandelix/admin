<?php

namespace App\Admin\Requests;

use App\Admin\Requests\FormRequest;
use Illuminate\Support\Arr;

class LicenseRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'company_id' => 'required',
            'category_id' => 'required',
            'certificate_no' => 'required',
            'certificate_valid_from' => '',
            'certificate_valid_to' => '',
            'last_inspection_date' => '',
            'next_inspection_date' => '',
            'certificate_images' => '',
            'status' => '',
            'remark' => '',
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
