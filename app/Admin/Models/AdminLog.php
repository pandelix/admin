<?php

namespace App\Admin\Models;

use App\Admin\Casts\Json;

class AdminLog extends Model
{
    const UPDATED_AT = null;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
        'admin_info' => Json::class,
        'input' => Json::class,
    ];

    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class, 'admin_user_id');
    }

    public function output()
    {
        return $this->hasOne(AdminLogOutput::class, 'log_uuid');
    }
}
