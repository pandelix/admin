<?php

namespace App\Admin\Models;

use App\Admin\Models\DyModel;

class Remind extends DyModel
{
    protected $table = 'dy_remind';

    protected $fillable = [
        'certificate_id',
        'user_ids',
        'type',
        'content',
        'remark',
    ];
}