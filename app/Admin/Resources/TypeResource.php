<?php

namespace App\Admin\Resources;

use App\Admin\Resources\JsonResource;

class TypeResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
