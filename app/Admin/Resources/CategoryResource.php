<?php

namespace App\Admin\Resources;

use App\Admin\Resources\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $arr = parent::toArray($request);
        return $arr;
    }
}
