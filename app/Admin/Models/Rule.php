<?php

namespace App\Admin\Models;

use App\Admin\Models\DyModel;

class Rule extends DyModel
{

    protected $fillable = [
        'rule_name',
        'simple_name',
        'simple_pinyin',
        'company_id',
        'content',
        'status',
        'sort',
        'remark',
    ];
}
