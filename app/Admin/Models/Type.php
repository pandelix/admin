<?php

namespace App\Admin\Models;

use App\Admin\Models\DyModel;

class Type extends DyModel
{
    protected $table = 'dy_type';

    protected $fillable = [
        'type_category',
        'type_name',
        'simple_name',
        'simple_pinyin',
        'is_can_edit',
        'remark',
    ];

}
