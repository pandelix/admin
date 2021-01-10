<?php


namespace App\Admin\Models;


use Illuminate\Support\Str;


class DyModel extends \Illuminate\Database\Eloquent\Model
{
    /*
     * 重写getTable,不用复数形式表名
     */
    public function getTable()
    {
        return $this->table ?? Str::snake(class_basename($this));
    }

}
