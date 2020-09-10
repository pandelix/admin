<?php

namespace App\Admin\Filters;

class AdminLogFilter extends Filter
{
    protected $simpleFilters = [
        'uuid',
    ];

    protected $filters = [
        'field_name',
    ];

    protected function fieldName($val)
    {
        $this->builder->where('field_name', $val);
    }
}
