<?php

namespace App\Admin\Models;

use App\Admin\Models\DyModel;

class RemindDetail extends DyModel
{
    protected $table = 'dy_remind_detail';

    protected $fillable = [
        'certificate_id',
        'user_ids',
        'type',
        'content',
        'remark',
    ];
}
