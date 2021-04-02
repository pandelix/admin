<?php

namespace App\Admin\Resources;

use App\Admin\Models\Company;
use App\Admin\Models\Category;
use App\Admin\Resources\JsonResource;

class LicenseResource extends JsonResource
{
    public function toArray($request)
    {

        $data = [
            'categories' => Category::all(),
            'companies' => Company::all(),
        ];

        return array_merge(parent::toArray($request), $data);
    }
}
