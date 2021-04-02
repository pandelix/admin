<?php

namespace App\Admin\Models;

use App\Admin\Models\DyModel;

class License extends DyModel
{
    protected $table = 'dy_certificate';

    protected $fillable = [
        'company_id',
        'type_id',
        'certificate_no',
        'certificate_valid_from',
        'certificate_valid_to',
        'certificate_images',
        'perv_inspection_date',
        'next_inspection_date',
        'status',
        'remark',
    ];
}
