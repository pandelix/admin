<?php

namespace App\Admin\Models;

use App\Admin\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class AdminLogOutput extends Model
{
    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    protected $guarded = [];

    protected $casts = [
        'output' => Json::class,
    ];

    protected $primaryKey = 'log_uuid';

    protected $keyType = 'string';
}
