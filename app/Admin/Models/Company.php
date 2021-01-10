<?php

namespace App\Admin\Models;

use App\Admin\Models\DyModel;

class Company extends DyModel
{
    protected $table = 'dy_company';

    protected $fillable = [
        'company_name',
        'simple_name',
        'simple_pinyin',
        'economic_id',
        'source',
        'business_registration_no',
        'tax_registry_no',
        'organization_code',
        'business_license_no',
        'registered_province',
        'registered_city',
        'registered_district',
        'registered_address',
        'registered_area_number',
        'actual_province',
        'actual_city',
        'actual_district',
        'actual_address',
        'actual_zipcode',
        'legal_name',
        'legal_id_card',
        'legal_id_card_front',
        'legal_id_card_back',
        'legal_phone',
        'registered_capital',
        'found_date',
        'business_license_from',
        'business_license_to',
        'business_license_image',
        'business_scope',
        'contact_address',
        'remark',
        'status',
    ];
}
