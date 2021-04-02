<?php

namespace App\Admin\Models;

use App\Admin\Models\DyModel;
use Carbon\Carbon;

class Category extends DyModel
{
    protected $table = 'dy_type';

    protected $fillable = [
        'type',
        'name',
        'simple_name',
        'simple_pinyin',
        'is_can_edit',
        'remark',
    ];


}
