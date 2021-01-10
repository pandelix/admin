<?php


namespace App\Admin\Models;


use Illuminate\Support\Str;


class DyModel extends \Illuminate\Database\Eloquent\Model
{

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['delete_time'];

    const PREFIX = 'dy_';

    /*
     * 重写getTable,不用复数形式表名
     */
    public function getTable()
    {
        return self::PREFIX . ($this->table ?? Str::snake(class_basename($this)));
    }

}
