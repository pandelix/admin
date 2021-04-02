<?php

namespace App\Admin\Requests;

use App\Admin\Requests\FormRequest;
use Illuminate\Support\Arr;

class CompanyRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'source' => 'required|integer|in:1,2',
            'company_name' => 'required',
            'simple_name' => '',
            'economic_id' => 'required|integer',

            'business_license_no' => 'required', //统一社会信用代码
            'tax_registry_no' => '', //纳税人识别号
            'organization_code' => '', //组织机构代码
            'registered_area_number' => 'required',
            'actual_address' => '',

            'legal_name' => 'required',
            'legal_id_card' => 'required', //法人身份证号码
            'legal_id_card_front' => 'required',
            'legal_id_card_back' => 'required',
            'legal_phone' => 'required',

            'business_scope' => '', //经营范围
            'registered_capital' => 'required|integer', //注册资本
            'found_date' => 'required', //注册日期
            'business_license_from' => 'required',
            'business_license_to' => 'required',
            'business_license_image' => 'required',

            'status' => 'required|boolean',
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
            //
        ];
    }

    public function attributes()
    {
        return [
        ];
    }
}
