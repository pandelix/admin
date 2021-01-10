<?php

namespace App\Admin\Filters;

use App\Admin\Filters\Filter;

class CompanyFilter extends Filter
{
    protected $simpleFilters = [
        'id',
    ];

    protected $filters = [
        'field_name',
    ];

    protected function fieldName($val)
    {
        $this->builder->where('field_name', $val);
    }
}
